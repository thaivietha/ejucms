<?php
/**
 * User: xyz
 * Date: 2019/11/6
 * Time: 17:36
 */
// 模板错误提示
switch_exception();

if (!function_exists('getMenuList'))
{
    /**
     * 根据角色权限过滤菜单
     */
    function getMenuList() {
        $menuArr = getAllMenu();

         return $menuArr;
    }
}

if (!function_exists('getAllMenu'))
{
    /**
     * 获取左侧菜单
     */
    function getAllMenu() {
        $menuArr = false;
        if (!$menuArr) {
            $menuArr = get_conf('menu');
            //判断后台频道是否已经关闭,或者不存在栏目
            $channel_list = model('Channeltype')->getArctypeChannel('yes');
            $arctypeLogic = new \app\common\logic\ArctypeLogic();
            $arctype_list = $arctypeLogic->arctype_list(0, 0, false, 0, ['is_del'=>0], false);
            $channeltype = get_arr_column($arctype_list, 'current_channel');
            $channeltype_list = [];
            foreach ($channel_list as $key => $val) {
                if (in_array($val['id'], [6])) {
                    continue;
                }
                if (in_array($val['id'],$channeltype)){
                    $channeltype_list[] = $val['ctl_name'];
                }
            }
            //检查模型是否启用
            foreach ($menuArr[2000]['child'] as $key=>$val){
                if (empty($channeltype_list) || !in_array($val['controller'],$channeltype_list)){
                    unset($menuArr[2000]['child'][$key]);
                }
            }
            //检测是否开启支付设置，用于充值
            $pay_wechat = unserialize(getUsersConfigData('pay.pay_wechat_config'));
            $pay_alipay = unserialize(getUsersConfigData('pay.pay_alipay_config'));
            if((empty($pay_wechat) && empty($pay_alipay)) || (!empty($pay_wechat['is_open_wechat'])  && !empty($pay_alipay['is_open_alipay']))){
                unset($menuArr[3000]['child'][3002]);
            }

            extra_cache('user_all_menu', $menuArr);
        }

        return $menuArr;
    }
}

if (!function_exists('get_conf'))
{
    /**
     * 获取conf配置文件
     */
    function get_conf($name = 'global')
    {
        $arr = include APP_PATH.MODULE_NAME.'/conf/'.$name.'.php';
        return $arr;
    }
}

if (!function_exists('get_arcurl'))
{
    /**
     * 获取文档链接
     *
     * @param array $arctype_info 栏目信息
     * @param boolean $admin 后台访问链接，还是前台链接
     */
    function get_arcurl($arcview_info = array(), $admin = true)
    {
        /*兼容采集没有归属栏目的文档*/
        if (empty($arcview_info['channel'])) {
            $channelRow = \think\Db::name('channeltype')->field('id as channel')
                ->where('id',1)
                ->find();
            $arcview_info = array_merge($arcview_info, $channelRow);
        }
        /*--end*/

        static $result = null;
        null === $result && $result = model('Channeltype')->getAll('id, ctl_name', array(), 'id');
        $ctl_name = '';
        if ($result) {
            $ctl_name = $result[$arcview_info['channel']]['ctl_name'];
        }

        static $seo_pseudo = null;
        static $seo_dynamic_format = null;
        if (null === $seo_pseudo || null === $seo_dynamic_format) {
            $seoConfig = tpCache('seo');
            $seo_pseudo = !empty($seoConfig['seo_pseudo']) ? $seoConfig['seo_pseudo'] : config('ey_config.seo_pseudo');
            $seo_dynamic_format = !empty($seoConfig['seo_dynamic_format']) ? $seoConfig['seo_dynamic_format'] : config('ey_config.seo_dynamic_format');
        }
        static $domain = null;
        null === $domain && $domain = request()->domain();
        if (!empty($arcview_info['room'])){
            unset($arcview_info['room']);
        }
        $arcurl = arcurl("home/{$ctl_name}/view", $arcview_info, true,false,$seo_pseudo,$seo_dynamic_format);
        if (2 != $seo_pseudo){
            // 自动隐藏index.php入口文件
            $arcurl = auto_hide_index($arcurl);
        }


        return $arcurl;
    }
}
if (!function_exists('auto_hide_index'))
{
    /**
     * URL中隐藏index.php入口文件（适用后台显示前台的URL）
     */
    function auto_hide_index($url) {
        static $web_adminbasefile = null;
        if (null === $web_adminbasefile) {
            $web_adminbasefile = tpCache('web.web_adminbasefile');
            $web_adminbasefile = !empty($web_adminbasefile) ? $web_adminbasefile : ROOT_DIR.'/login.php'; // 支持子目录
        }
        $url = str_replace($web_adminbasefile, ROOT_DIR.'/index.php', $url); // 支持子目录
        $seo_inlet = config('ey_config.seo_inlet');
        if (1 == $seo_inlet) {
            $url = str_replace('/index.php/', '/', $url);
        }
        return $url;
    }
}
if (!function_exists('adminLog'))
{
    /**
     * 管理员操作记录
     * @param $log_url 操作URL
     * @param $log_info 记录信息
     */
    function adminLog($log_info = ''){
        $admin_id = session('admin_id');
        $admin_id = !empty($admin_id) ? $admin_id : -1;
        $add['log_time'] = getTime();
        $add['admin_id'] = $admin_id;
        $add['log_info'] = $log_info;
        $add['log_ip'] = clientIP();
        $add['log_url'] = request()->baseUrl() ;
        M('admin_log')->add($add);
    }
}
if (!function_exists('push_zzbaidu'))
{
    /**
     * 将新链接推送给百度蜘蛛
     */
    function push_zzbaidu($type = 'urls', $aid = '', $typeid = '')
    {
        // 获取token的值：http://ziyuan.baidu.com/linksubmit/index?site=http://www.ejucms.com/
        $aid = intval($aid);
        $typeid = intval($typeid);
        $sitemap_zzbaidutoken = tpCache('sitemap.sitemap_zzbaidutoken');
        if (empty($sitemap_zzbaidutoken) || (empty($aid) && empty($typeid)) || !function_exists('curl_init')) {
            return '';
        }

        $urlsArr = array();
        $channeltype_list = model('Channeltype')->getAll('id, ctl_name', array(), 'id');

        if ($aid > 0) {
            $res = M('archives')->field('b.*, a.*, a.aid, b.id as typeid')
                ->alias('a')
                ->join('__ARCTYPE__ b', 'b.id = a.typeid', 'LEFT')
                ->find($aid);
            $arcurl = get_arcurl($res, false);
            array_push($urlsArr, $arcurl);
        }
        if (0 < $typeid) {
            $res = M('arctype')->field('a.*')
                ->alias('a')
                ->find($typeid);
            $typeurl = get_typeurl($res, false);
            array_push($urlsArr, $typeurl);
        }

        $type = ('edit' == $type) ? 'update' : 'urls';
        $api = 'http://data.zz.baidu.com/'.$type.'?site='.request()->host(true).'&token='.$sitemap_zzbaidutoken;
        $ch = curl_init();
        $options =  array(
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => implode("\n", $urlsArr),
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);

        return $result;
    }
}
