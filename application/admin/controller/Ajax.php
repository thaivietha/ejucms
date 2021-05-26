<?php
/**
 * 易居CMS
 * ============================================================================
 * 版权所有 2018-2028 海南易而优科技有限公司，并保留所有权利。
 * 网站地址: http://www.ejucms.com
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 小虎哥 <1105415366@qq.com>
 * Date: 2018-4-3
 */

namespace app\admin\controller;
use think\Db;
use think\Session;
use app\admin\logic\AjaxLogic;

/**
 * 所有ajax请求或者不经过权限验证的方法全放在这里
 */
class Ajax extends Base {
    
    private $ajaxLogic;

    public function _initialize() {
        parent::_initialize();
        $this->ajaxLogic = new AjaxLogic;
    }

    /**
     * 进入欢迎页面需要异步处理的业务
     */
    public function welcome_handle()
    {
        $this->ajaxLogic->welcome_handle();
    }

    /**
     * 版本检测更新弹窗
     */
    public function check_upgrade_version()
    {
        $upgradeLogic = new \app\admin\logic\UpgradeLogic;
        $upgradeMsg = $upgradeLogic->checkVersion(); // 升级包消息
        $this->success('检测成功', null, $upgradeMsg);  
    }
    
    /*
     * 检查是否存在未读的表单信息
     */
    public function check_form_read(){
        Session::pause(); // 暂停session，防止session阻塞机制
        $list = model('form_list')->where("is_read=0 and is_del=0")->find();
        if (empty($list)){
            $this->error();
        }
        $this->success();
    }

    /**
     * 更新stiemap.xml地图
     */
    public function update_sitemap($controller, $action)
    {
        if (IS_AJAX_POST) {
            $cacheKey = "extra_global_channeltype";
            $channeltype_row = \think\Cache::get($cacheKey);
            if (empty($channeltype_row)) {
                $ctlArr = \think\Db::name('channeltype')
                    ->where('id','NOTIN', [6])
                    ->column('ctl_name');
            } else {
                $ctlArr = array();
                foreach($channeltype_row as $key => $val){
                    if (!in_array($val['id'], [6])) {
                        $ctlArr[] = $val['ctl_name'];
                    }
                }
            }

            $systemCtl= ['Arctype'];
            $ctlArr = array_merge($systemCtl, $ctlArr);
            $actArr = ['add','edit'];
            if (in_array($controller, $ctlArr) && in_array($action, $actArr)) {
                Session::pause(); // 暂停session，防止session阻塞机制
                sitemap_auto();
                $this->success('更新sitemap成功！');
            }
        }

        $this->error('更新sitemap失败！');
    }

    /**
     * 发布或编辑文档时，百度自动推送
     */
    public function push_zzbaidu($url = '', $type = 'add')
    {
        try {
            if (IS_AJAX_POST) {
                Session::pause(); // 暂停session，防止session阻塞机制

                // 获取token的值：http://ziyuan.baidu.com/linksubmit/index?site=http://www.eyoucms.com/
                $sitemap_zzbaidutoken = config('tpcache.sitemap_zzbaidutoken');
                if (empty($sitemap_zzbaidutoken)) {
                    $this->error('尚未配置实时推送Url的token！', null, ['code'=>0]);
                } else if (!function_exists('curl_init')) {
                    $this->error('请开启php扩展curl_init', null, ['code'=>1]);
                }

                $urlsArr[] = $url;
                $type = ('edit' == $type) ? 'update' : 'urls';

                $api = 'http://data.zz.baidu.com/'.$type.'?site='.$this->request->host(true).'&token='.$sitemap_zzbaidutoken;
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
                if (!empty($result['success'])) {
                    $this->success('百度推送URL成功！');
                }
            }
        } catch (\Exception $e) {}

        $this->error('百度推送URL失败！');
    }
}