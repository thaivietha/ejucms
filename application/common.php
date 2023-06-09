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

// 关闭所有PHP错误报告
error_reporting(0);

include_once EXTEND_PATH."function.php";

// 应用公共文件

if (!function_exists('switch_exception')) 
{
    // 模板错误提示
    function switch_exception() {
        $web_exception = tpCache('web.web_exception');
        if (!empty($web_exception)) {
            config('ey_config.web_exception', $web_exception);
            error_reporting(-1);
        }
    }
}

if (!function_exists('tpCache')) 
{
    /**
     * 获取缓存或者更新缓存，只适用于config表
     * @param string $config_key 缓存文件名称
     * @param array $data 缓存数据  array('k1'=>'v1','k2'=>'v3')
     * @param array $options 缓存配置
     * @return array or string or bool
     */
    function tpCache($config_key,$data = array(), $options = null){
        $tableName = 'config';
        $table_db = \think\Db::name($tableName);

        $param = explode('.', $config_key);
        $cache_inc_type = $tableName.$param[0];
        // $cache_inc_type = $param[0];
        if (empty($options)) {
            $options['path'] = CACHE_PATH;
        }
        if(empty($data)){
            //如$config_key=shop_info则获取网站信息数组
            //如$config_key=shop_info.logo则获取网站logo字符串
            $config = cache($cache_inc_type,'',$options);//直接获取缓存文件
            if(empty($config)){
                //缓存文件不存在就读取数据库
                if ($param[0] == 'global') {
                    $param[0] = 'global';
                    $res = $table_db->where([
                        'is_del'    => 0,
                    ])->select();
                } else {
                    $res = $table_db->where([
                        'inc_type'  => $param[0],
                        'is_del'    => 0,
                    ])->select();
                }
                if($res){
                    foreach($res as $k=>$val){
                        $config[$val['name']] = $val['value'];
                    }
                    cache($cache_inc_type,$config,$options);
                }
                // write_global_params($options);
            }
            if(!empty($param) && count($param)>1){
                $newKey = strtolower($param[1]);
                return isset($config[$newKey]) ? $config[$newKey] : '';
            }else{
                return $config;
            }
        }else{
            //更新缓存
            $result =  $table_db->where([
                'inc_type'  => $param[0],
                'is_del'    => 0,
            ])->select();
            if($result){
                foreach($result as $val){
                    $temp[$val['name']] = $val['value'];
                }
                $add_data = array();
                foreach ($data as $k=>$v){
                    $newK = strtolower($k);
                    $newArr = array(
                        'name'=>$newK,
                        'value'=>trim($v),
                        'inc_type'=>$param[0],
                        'update_time'   => getTime(),
                    );
                    if(!isset($temp[$newK])){
                        array_push($add_data, $newArr); //新key数据插入数据库
                    }else{
                        if ($v != $temp[$newK]) {
                            $table_db->where([
                                'name'  => $newK,
                            ])->save($newArr);//缓存key存在且值有变更新此项
                        }
                    }
                }
                if (!empty($add_data)) {
                    $table_db->insertAll($add_data);
                }
                //更新后的数据库记录
                $newRes = $table_db->where([
                    'inc_type'  => $param[0],
                    'is_del'    => 0,
                ])->select();
                foreach ($newRes as $rs){
                    $newData[$rs['name']] = $rs['value'];
                }
            }else{
                if ($param[0] != 'global') {
                    foreach($data as $k=>$v){
                        $newK = strtolower($k);
                        $newArr[] = array(
                            'name'=>$newK,
                            'value'=>trim($v),
                            'inc_type'=>$param[0],
                            'update_time'   => time(),
                        );
                    }
                    $table_db->insertAll($newArr);
                }
                $newData = $data;
            }

            $result = false;
            $res = $table_db->where([
                'is_del'    => 0,
            ])->select();
            if($res){
                $global = array();
                foreach($res as $k=>$val){
                    $global[$val['name']] = $val['value'];
                }
                $result = cache($tableName.'global',$global,$options);
            } 

            if ($param[0] != 'global') {
                $result = cache($cache_inc_type,$newData,$options);
            }
            
            return $result;
        }
    }
}

if (!function_exists('write_global_params')) 
{
    /**
     * 写入全局内置参数
     * @return array
     */
    function write_global_params($options = null)
    {
        $webConfigParams = \think\Db::name('config')->where([
            'inc_type'  => 'web',
            'is_del'    => 0,
        ])->getAllWithIndex('name');
        $web_basehost = !empty($webConfigParams['web_basehost']) ? $webConfigParams['web_basehost']['value'] : ''; // 网站根网址
        $web_cmspath = !empty($webConfigParams['web_cmspath']) ? $webConfigParams['web_cmspath']['value'] : ''; // EjuCMS安装目录
        /*启用绝对网址，开启此项后附件、栏目连接、arclist内容等都使用http路径*/
        $web_multi_site = !empty($webConfigParams['web_multi_site']) ? $webConfigParams['web_multi_site']['value'] : '';
        if($web_multi_site == 1)
        {
            $web_mainsite = $web_basehost.$web_cmspath;
        }
        else
        {
            $web_mainsite = '';
        }
        /*--end*/
        /*CMS安装目录的网址*/
        $param['web_cmsurl'] = $web_mainsite;
        /*--end*/
        $param['web_templets_dir'] = '/template/'.config('ey_config.system_tpl_theme'); // 前台模板根目录
        $param['web_templeturl'] = $web_mainsite.$param['web_templets_dir']; // 前台模板根目录的网址
        $param['web_templets_pc'] = $web_mainsite.$param['web_templets_dir'].'/pc'; // 前台PC模板主题
        $param['web_templets_m'] = $web_mainsite.$param['web_templets_dir'].'/mobile'; // 前台手机模板主题
        $param['web_ejucms'] = str_replace('#', '', '#h#t#t#p#:#/#/#w#w#w#.#e#j#u#c#m#s#.#c#o#m#'); // eyou网址

        /*将内置的全局变量(页面上没有入口更改的全局变量)存储到web版块里*/
        $inc_type = 'web';
        foreach ($param as $key => $val) {
            if (preg_match("/^".$inc_type."_(.)+/i", $key) !== 1) {
                $nowKey = strtolower($inc_type.'_'.$key);
                $param[$nowKey] = $val;
            }
        }
        tpCache($inc_type, $param, $options);
        /*--end*/
    }
}

if (!function_exists('write_html_cache')) 
{
    /**
     * 写入静态页面缓存
     */
    function write_html_cache($html = ''){
        $html_cache_status = config('HTML_CACHE_STATUS');
        $html_cache_arr = config('HTML_CACHE_ARR');
        if ($html_cache_status && !empty($html_cache_arr) && !empty($html)) {
            $request = \think\Request::instance();
            $param = input('param.');

            /*区域子站点*/
            $subDomain = $request->param('subdomain');
            empty($subDomain) && $subDomain = $request->subDomain();
            $param['subdomain'] = $subDomain;
            /*end*/

            /*URL模式是否启动页面缓存（排除admin后台、前台筛选）*/
            $url_screen_var = config('global.url_screen_var');
            if (isset($param[$url_screen_var]) || 'admin' == $request->module()) {
                return false;
            }
            $seo_pseudo = config('ey_config.seo_pseudo');
            if (!in_array($seo_pseudo, array(1,3)) && (2 == $seo_pseudo && !isMobile())) { // 排除普通动态模式
                return false;
            }
            /*--end*/

            if (1 == $seo_pseudo) {
                isset($param['tid']) && $param['tid'] = input('param.tid/d');
            } else {
                isset($param['tid']) && $param['tid'] = input('param.tid/s');
            }
            isset($param['page']) && $param['page'] = input('param.page/d');

            // aid唯一性的处理
            if (isset($param['aid'])) {
                if (strval(intval($param['aid'])) !== strval($param['aid'])) {
                    abort(404,'页面不存在');
                }
                $param['aid'] = intval($param['aid']);
            }

            $m_c_a_str = $request->module().'_'.$request->controller().'_'.$request->action(); // 模块_控制器_方法
            $m_c_a_str = strtolower($m_c_a_str);
            //exit('write_html_cache写入缓存<br/>');
            foreach($html_cache_arr as $mca=>$val)
            {
                $mca = strtolower($mca);
                if($mca != $m_c_a_str) //不是当前 模块 控制器 方法 直接跳过
                    continue;

                if (empty($val['filename'])) {
                    continue;
                }

                $cache_tag = ''; // 缓存标签
                $filename = '';
                // 组合参数  
                if(isset($val['p']))
                {
                    $tid = '';
                    if (in_array('tid', $val['p'])) {
                        $tid = $param['tid'];
                        if (strval(intval($tid)) != strval($tid)) {
                            $tid = \think\Db::name('arctype')->where([
                                    'dirname'   => $tid,
                                ])->getField('id');
                            $param['tid']   = $tid;
                        }
                    }

                    foreach ($val['p'] as $k=>$v) {
                        if (isset($param[$v])) {
                            if (preg_match('/\/$/i', $filename)) {
                                $filename .= $param[$v];
                            } else {
                                if (!empty($filename)) {
                                    $filename .= '_';
                                }
                                $filename .= $param[$v];
                            }
                        }
                    }
                    /*针对列表缓存的标签*/
                    !empty($tid) && $cache_tag = $tid;
                    /*--end*/
                    /*针对内容缓存的标签*/
                    $aid = input("param.aid/d");
                    !empty($aid) && $cache_tag = $aid;
                    /*--end*/
                }
                empty($filename) && $filename = 'index';

                // 缓存时间
                $web_cmsmode = tpCache('web.web_cmsmode');
                if (1 == intval($web_cmsmode)) { // 永久
                    $path = HTML_PATH.$val['filename'];
                    if (isMobile()) {
                        $path .= "_mobile";
                    } else {
                        $path .= "_pc";
                    }
                    $filename = $path.'_html'.DS."{$filename}.html";
                    tp_mkdir(dirname($filename));
                    !empty($html) && file_put_contents($filename, $html);
                } else {
                    $path = HTML_PATH.$val['filename'];
                    if (isMobile()) {
                        $path .= "_mobile";
                    } else {
                        $path .= "_pc";
                    }
                    $path .= '_cache'.DS;
                    $options = array(
                        'path'  => $path,
                        'expire'=> intval($web_htmlcache_expires_in),
                        'prefix'    => $cache_tag,
                    );
                    !empty($html) && html_cache($filename,$html,$options);
                }
            }
        }
    }
}

if (!function_exists('read_html_cache')) 
{
    /**
     * 读取静态页面缓存
     */
    function read_html_cache(){
        $html_cache_status = config('HTML_CACHE_STATUS');
        $html_cache_arr = config('HTML_CACHE_ARR');
        if ($html_cache_status && !empty($html_cache_arr)) {
            $request = \think\Request::instance();
            $seo_pseudo = config('ey_config.seo_pseudo');
            $param = input('param.');

            /*区域子站点*/
            $subDomain = $request->param('subdomain');
            empty($subDomain) && $subDomain = $request->subDomain();
            $param['subdomain'] = $subDomain;
            /*end*/

            /*前台筛选不进行页面缓存*/
            $url_screen_var = config('global.url_screen_var');
            if (isset($param[$url_screen_var]) || 'admin' == $request->module()) {
                return false;
            }
            /*end*/

            if (1 == $seo_pseudo) {
                isset($param['tid']) && $param['tid'] = input('param.tid/d');
            } else {
                isset($param['tid']) && $param['tid'] = input('param.tid/s');
            }
            isset($param['page']) && $param['page'] = input('param.page/d');

            // aid唯一性的处理
            if (isset($param['aid'])) {
                if (strval(intval($param['aid'])) !== strval($param['aid'])) {
                    abort(404,'页面不存在');
                }
                $param['aid'] = intval($param['aid']);
            }

            $m_c_a_str = $request->module().'_'.$request->controller().'_'.$request->action(); // 模块_控制器_方法
            $m_c_a_str = strtolower($m_c_a_str);
            //exit('read_html_cache读取缓存<br/>');
            foreach($html_cache_arr as $mca=>$val)
            {
                $mca = strtolower($mca);
                if($mca != $m_c_a_str) //不是当前 模块 控制器 方法 直接跳过
                    continue;

                if (empty($val['filename'])) {
                    continue;
                }

                $cache_tag = ''; // 缓存标签
                $filename = '';
                // 组合参数  
                if(isset($val['p']))
                {
                    $tid = '';
                    if (in_array('tid', $val['p'])) {
                        $tid = $param['tid'];
                        if (strval(intval($tid)) != strval($tid)) {
                            $tid = \think\Db::name('arctype')->where([
                                    'dirname'   => $tid,
                                ])->getField('id');
                            $param['tid']   = $tid;
                        }
                    }

                    foreach ($val['p'] as $k=>$v) {
                        if (isset($param[$v])) {
                            if (preg_match('/\/$/i', $filename)) {
                                $filename .= $param[$v];
                            } else {
                                if (!empty($filename)) {
                                    $filename .= '_';
                                }
                                $filename .= $param[$v];
                            }
                        }
                    }
                    /*针对列表缓存的标签*/
                    !empty($tid) && $cache_tag = $tid;
                    /*--end*/
                    /*针对内容缓存的标签*/
                    $aid = input("param.aid/d");
                    !empty($aid) && $cache_tag = $aid;
                    /*--end*/
                }
                empty($filename) && $filename = 'index';

                // 缓存时间
                $web_cmsmode = tpCache('web.web_cmsmode');
                if (1 == intval($web_cmsmode)) { // 永久
                    $path = HTML_PATH.$val['filename'];
                    if (isMobile()) {
                        $path .= "_mobile";
                    } else {
                        $path .= "_pc";
                    }
                    $filename = $path.'_html'.DS."{$filename}.html";
                    if(is_file($filename) && file_exists($filename))
                    {
                        echo file_get_contents($filename);
                        exit();
                    }
                } else {
                    $path = HTML_PATH.$val['filename'];
                    if (isMobile()) {
                        $path .= "_mobile";
                    } else {
                        $path .= "_pc";
                    }
                    $path .= '_cache'.DS;
                    $options = array(
                        'path'  => $path,
                        'expire'=> intval($web_htmlcache_expires_in),
                        'prefix'    => $cache_tag,
                    );
                    $html = html_cache($filename, '', $options);
                    // $html = $html_cache->get($filename);
                    if($html)
                    {
                        echo $html;
                        exit();
                    }
                }
            }
        }
    }
}
//运营模式下删除缓存文档文件
if (!function_exists('del_archives_chache')){
    function del_archives_chache($aids = [],$clomn = "")
    {
        $web_cmsmode = tpCache('web.web_cmsmode');
        $html_cache_arr = config('HTML_CACHE_ARR');
        if (1 == intval($web_cmsmode)) { // 页面html静态永久缓存
            foreach ($aids as $aid) {
                if (!empty($clomn)) {
                    $fileList = glob(HTML_ROOT . 'http*/' . $html_cache_arr['home_View_index']['filename'] . '*_html/*' . $aid . '_' . $clomn . '.html');
                } else {
                    $fileList = glob(HTML_ROOT . 'http*/' . $html_cache_arr['home_View_index']['filename'] . '*_html/*' . $aid . '*.html');
                }
                if (!empty($fileList)) {
                    foreach ($fileList as $k2 => $file) {
                        @unlink($file);

                    }
                }
            }
        }
    }
}
//运营模式下删除缓存栏目文件
if (!function_exists('del_type_chache')){
    function del_type_chache($tids = [])
    {
        $web_cmsmode = tpCache('web.web_cmsmode');
        $html_cache_arr = config('HTML_CACHE_ARR');
        if (1 == intval($web_cmsmode)) { // 页面html静态永久缓存
            foreach ($tids as $tid) {
                $fileList = glob(HTML_ROOT . 'http*/' . $html_cache_arr['home_Lists_index']['filename'] . '*_html/*' . $tid . '*.html');
                if (!empty($fileList)) {
                    foreach ($fileList as $k2 => $file) {
                        @unlink($file);

                    }
                }
            }
        }
    }
}
if (!function_exists('is_local_images')) 
{
    /**
     * 判断远程链接是否属于本地图片，并返回本地图片路径
     *
     * @param string $pic_url 图片地址
     * @param boolean $returnbool 返回类型，false 返回图片路径，true 返回布尔值
     */
    function is_local_images($pic_url = '', $returnbool = false)
    {
        $picPath  = parse_url($pic_url, PHP_URL_PATH);
        if (!empty($picPath) && file_exists('.'.$picPath)) {
            $picPath = preg_replace('#^'.ROOT_DIR.'/#i', '/', $picPath);
            $pic_url = ROOT_DIR.$picPath;
            if (true == $returnbool) {
                return $pic_url;
            }
        }

        if (true == $returnbool) {
            return false;
        } else {
            return $pic_url;
        }
    }
}

if (!function_exists('get_head_pic')) 
{
    /**
     * 默认头像
     */
    function get_head_pic($pic_url = '')
    {
        $default_pic = ROOT_DIR . '/public/static/common/images/bag-imgB.jpg';
        return empty($pic_url) ? $default_pic : $pic_url;
    }
}

if (!function_exists('get_default_pic')) 
{
    /**
     * 图片不存在，显示默认无图封面
     * @param string $pic_url 图片路径
     * @param string|boolean $domain 完整路径的域名
     */
    function get_default_pic($pic_url = '', $domain = false)
    {
        if (!is_http_url($pic_url)) {
            if (true === $domain) {
                $domain = request()->domain();
            } else if (false === $domain) {
                $domain = '';
            }
            
            $pic_url = preg_replace('#^(/[/\w]+)?(/public/upload/|/uploads/)#i', '$2', $pic_url); // 支持子目录
            $realpath = realpath(trim($pic_url, '/'));
            if ( is_file($realpath) && file_exists($realpath) ) {
                $pic_url = $domain . ROOT_DIR . $pic_url;
            } else {
                $pic_url = $domain . ROOT_DIR . '/public/static/common/images/not_adv.jpg';
            }
        }

        return $pic_url;
    }
}

if (!function_exists('handle_subdir_pic')) 
{
    /**
     * 处理子目录与根目录的图片平缓切换
     * @param string $str 图片路径或html代码
     */
    function handle_subdir_pic($str = '', $type = 'img')
    {
        $root_dir = ROOT_DIR;
        switch ($type) {
            case 'img':
                if (!is_http_url($str) && !empty($str)) {
                    // if (!empty($root_dir)) { // 子目录之间切换
                        $str = preg_replace('#^(/[/\w]+)?(/public/upload/|/uploads/)#i', $root_dir.'$2', $str);
                    // } else { // 子目录与根目录切换
                        // $str = preg_replace('#^(/[/\w]+)?(/public/upload/|/uploads/)#i', $root_dir.'$2', $str);
                    // }
                }else if (is_http_url($str) && !empty($str)) {
                    // 图片路径处理
                    $str     = preg_replace('#^(/[/\w]+)?(/public/upload/|/uploads/)#i', $root_dir.'$2', $str);
                    $StrData = parse_url($str);
                    $strlen  = strlen($root_dir);
                    if (empty($StrData['scheme'])) {
                        if ('/uploads/'==substr($StrData['path'],$strlen,9) || '/public/upload/'==substr($StrData['path'],$strlen,15)) {
                            // 七牛云配置处理
                            static $Qiniuyun = null;
                            if (null == $Qiniuyun) {
                                // 需要填写你的 Access Key 和 Secret Key
                                $data     = M('weapp')->where('code','Qiniuyun')->field('data,status')->find();
                                $Qiniuyun = json_decode($data['data'], true);
                                $Qiniuyun['status'] = $data['status'];
                            }

                            // 是否开启图片加速
                            if ('1' == $Qiniuyun['status']) {
                                // 开启
                                if ($Qiniuyun['domain'] == $StrData['host']) {
                                    $tcp = !empty($Qiniuyun['tcp']) ? $Qiniuyun['tcp'] : '';
                                    switch ($tcp) {
                                        case '2':
                                            $tcp = 'https://';
                                            break;

                                        case '3':
                                            $tcp = '//';
                                            break;
                                        
                                        case '1':
                                        default:
                                            $tcp = 'http://';
                                            break;
                                    }
                                    $str = $tcp.$Qiniuyun['domain'].$StrData['path'];
                                }else{
                                    // 若切换了存储空间或访问域名，与数据库中存储的图片路径域名不一致时，访问本地路径，保证图片正常
                                    $str = $StrData['path'];
                                }
                            }else{
                                // 关闭
                                $str = $StrData['path'];
                            }
                        }
                    }
                }
                break;

            case 'html':
                // if (!empty($root_dir)) { // 子目录之间切换
                    $str = preg_replace('#(.*)(\#39;|&quot;|"|\')(/[/\w]+)?(/public/upload/|/public/plugins/|/uploads/)(.*)#iU', '$1$2'.$root_dir.'$4$5', $str);
                // } else { // 子目录与根目录切换
                    // $str = preg_replace('#(.*)(\#39;|&quot;|"|\')(/[/\w]+)?(/public/upload/|/public/plugins/|/uploads/)(.*)#iU', '$1$2'.$root_dir.'$4$5', $str);
                // }
                break;

            case 'soft':
                if (!is_http_url($str) && !empty($str)) {
                    $str = preg_replace('#^(/[/\w]+)?(/public/upload/soft/|/uploads/soft/)#i', '$2', $str);
                }
                break;
            
            default:
                # code...
                break;
        }

        return $str;
    }
}

/**
 * 获取阅读权限
 */
if ( ! function_exists('get_arcrank_list'))
{
    function get_arcrank_list()
    {
        $result = \think\Db::name('arcrank')->order('id asc')
            ->cache(true,0,"arcrank")
            ->getAllWithIndex('rank');

        return $result;
    }
}

if (!function_exists('thumb_img')) 
{
    /**
     * 缩略图 从原始图来处理出来
     * @param type $original_img  图片路径
     * @param type $width     生成缩略图的宽度
     * @param type $height    生成缩略图的高度
     * @param type $thumb_mode    生成方式
     */
    function thumb_img($original_img = '', $width = '', $height = '', $thumb_mode = '')
    {
        // 缩略图配置
        static $thumbConfig = null;
        null === $thumbConfig && $thumbConfig = tpCache('thumb');
        $thumbextra = config('global.thumb');

        if (!empty($width) || !empty($height) || !empty($thumb_mode)) { // 单独在模板里调用，不受缩略图全局开关影响

        } else { // 非单独模板调用，比如内置的arclist\list标签里
            if (empty($thumbConfig['thumb_open'])) {
                return $original_img;
            }
        }

        // 缩略图优先级别高于七牛云，自动把七牛云的图片路径转为本地图片路径，并且进行缩略图
        $original_img = is_local_images($original_img);

        // 未开启缩略图，或远程图片
        if (is_http_url($original_img) || stristr($original_img, '/public/static/common/images/not_adv.jpg')) {
            return $original_img;
        } else if (empty($original_img)) {
            return ROOT_DIR.'/public/static/common/images/not_adv.jpg';
        }

        // 图片文件名
        $filename = '';
        $imgArr = explode('/', $original_img);    
        $imgArr = end($imgArr);
        $filename = preg_replace("/\.([^\.]+)$/i", "", $imgArr);

        // 如果图片参数是缩略图，则直接获取到原图，并进行缩略处理
        if (preg_match('/\/uploads\/thumb\/\d{1,}_\d{1,}\//i', $original_img)) {
            $file_ext = preg_replace("/^(.*)\.([^\.]+)$/i", "$2", $imgArr);
            $pattern = UPLOAD_PATH.'allimg/*/'.$filename;
            if (in_array(strtolower($file_ext), ['jpg','jpeg'])) {
                $pattern .= '.jp*g';
            } else {
                $pattern .= '.'.$file_ext;
            }
            $original_img_tmp = glob($pattern);
            if (!empty($original_img_tmp)) {
                $original_img = '/'.current($original_img_tmp);
            }
        }
        // --end

        $original_img1 = preg_replace('#^'.ROOT_DIR.'#i', '', handle_subdir_pic($original_img));
        $original_img1 = '.' . $original_img1; // 相对路径
        //获取图像信息
        $info = @getimagesize($original_img1);
        //检测图像合法性
        if (false === $info || (IMAGETYPE_GIF === $info[2] && empty($info['bits']))) {
            return $original_img;
        }

        // 缩略图宽高度
        empty($width) && $width = !empty($thumbConfig['thumb_width']) ? $thumbConfig['thumb_width'] : $thumbextra['width'];
        empty($height) && $height = !empty($thumbConfig['thumb_height']) ? $thumbConfig['thumb_height'] : $thumbextra['height'];
        $width = intval($width);
        $height = intval($height);

        //判断缩略图是否存在
        $path = UPLOAD_PATH."thumb/{$width}_{$height}/";
        $img_thumb_name = "{$filename}";

        // 已经生成过这个比例的图片就直接返回了
        if (is_file($path . $img_thumb_name . '.jpg')) return ROOT_DIR.'/' . $path . $img_thumb_name . '.jpg';
        if (is_file($path . $img_thumb_name . '.jpeg')) return ROOT_DIR.'/' . $path . $img_thumb_name . '.jpeg';
        if (is_file($path . $img_thumb_name . '.gif')) return ROOT_DIR.'/' . $path . $img_thumb_name . '.gif';
        if (is_file($path . $img_thumb_name . '.png')) return ROOT_DIR.'/' . $path . $img_thumb_name . '.png';
        if (is_file($path . $img_thumb_name . '.bmp')) return ROOT_DIR.'/' . $path . $img_thumb_name . '.bmp';

        if (!is_file($original_img1)) {
            return ROOT_DIR.'/public/static/common/images/not_adv.jpg';
        }

        try {
            vendor('topthink.think-image.src.Image');
            vendor('topthink.think-image.src.image.Exception');
            if(stristr($original_img1,'.gif'))
            {
                vendor('topthink.think-image.src.image.gif.Encoder');
                vendor('topthink.think-image.src.image.gif.Decoder');
                vendor('topthink.think-image.src.image.gif.Gif');               
            }           
            $image = \think\Image::open($original_img1);

            $img_thumb_name = $img_thumb_name . '.' . $image->type();
            // 生成缩略图
            !is_dir($path) && mkdir($path, 0777, true);
            // 填充颜色
            $thumb_color = !empty($thumbConfig['thumb_color']) ? $thumbConfig['thumb_color'] : $thumbextra['color'];
            // 生成方式参考 vendor/topthink/think-image/src/Image.php
            if (!empty($thumb_mode)) {
                $thumb_mode = intval($thumb_mode);
            } else {
                $thumb_mode = !empty($thumbConfig['thumb_mode']) ? $thumbConfig['thumb_mode'] : $thumbextra['mode'];
            }
            1 == $thumb_mode && $thumb_mode = 6; // 按照固定比例拉伸
            2 == $thumb_mode && $thumb_mode = 2; // 填充空白
            if (3 == $thumb_mode) {
                $img_width = $image->width();
                $img_height = $image->height();
                if ($width < $img_width && $height < $img_height) {
                    // 先进行缩略图等比例缩放类型，取出宽高中最小的属性值
                    $min_width = ($img_width < $img_height) ? $img_width : 0;
                    $min_height = ($img_width > $img_height) ? $img_height : 0;
                    if ($min_width > $width || $min_height > $height) {
                        if (0 < intval($min_width)) {
                            $scale = $min_width / min($width, $height);
                        } else if (0 < intval($min_height)) {
                            $scale = $min_height / $height;
                        } else {
                            $scale = $min_width / $width;
                        }
                        $s_width  = $img_width / $scale;
                        $s_height = $img_height / $scale;
                        $image->thumb($s_width, $s_height, 1, $thumb_color)->save($path . $img_thumb_name, NULL, 100); //按照原图的比例生成一个最大为$width*$height的缩略图并保存
                    }
                }
                $thumb_mode = 3; // 截减
            }
            // 参考文章 http://www.mb5u.com/biancheng/php/php_84533.html  改动参考 http://www.thinkphp.cn/topic/13542.html
            $image->thumb($width, $height, $thumb_mode, $thumb_color)->save($path . $img_thumb_name, NULL, 100); //按照原图的比例生成一个最大为$width*$height的缩略图并保存
            //图片水印处理
            $water = tpCache('water');
            if($water['is_mark']==1 && $water['is_thumb_mark'] == 1 && $image->width()>$water['mark_width'] && $image->height()>$water['mark_height']){
                $imgresource = '.' . ROOT_DIR . '/' . $path . $img_thumb_name;
                if($water['mark_type'] == 'text'){
                    //$image->text($water['mark_txt'],ROOT_PATH.'public/static/common/font/hgzb.ttf',20,'#000000',9)->save($imgresource);
                    $ttf = ROOT_PATH.'public/static/common/font/hgzb.ttf';
                    if (file_exists($ttf)) {
                        $size = $water['mark_txt_size'] ? $water['mark_txt_size'] : 30;
                        $color = $water['mark_txt_color'] ?: '#000000';
                        if (!preg_match('/^#[0-9a-fA-F]{6}$/', $color)) {
                            $color = '#000000';
                        }
                        $transparency = intval((100 - $water['mark_degree']) * (127/100));
                        $color .= dechex($transparency);
                        $image->open($imgresource)->text($water['mark_txt'], $ttf, $size, $color, $water['mark_sel'])->save($imgresource);
                        $return_data['mark_txt'] = $water['mark_txt'];
                    }
                }else{
                    /*支持子目录*/
                    $water['mark_img'] = preg_replace('#^(/[/\w]+)?(/public/upload/|/uploads/)#i', '$2', $water['mark_img']); // 支持子目录
                    /*--end*/
                    //$image->water(".".$water['mark_img'],9,$water['mark_degree'])->save($imgresource);
                    $waterPath = "." . $water['mark_img'];
                    if (eyPreventShell($waterPath) && file_exists($waterPath)) {
                        $quality = $water['mark_quality'] ? $water['mark_quality'] : 80;
                        $waterTempPath = dirname($waterPath).'/temp_'.basename($waterPath);
                        $image->open($waterPath)->save($waterTempPath, null, $quality);
                        $image->open($imgresource)->water($waterTempPath, $water['mark_sel'], $water['mark_degree'])->save($imgresource);
                        @unlink($waterTempPath);
                    }
                }
            }
            $img_url = ROOT_DIR.'/' . $path . $img_thumb_name;

            return $img_url;

        } catch (think\Exception $e) {

            return $original_img;
        }
    }
}

if (!function_exists('get_controller_byct')) {
    /**
     * 根据模型ID获取控制器的名称
     * @return mixed
     */
    function get_controller_byct($current_channel)
    {
        $channeltype_info = model('Channeltype')->getInfo($current_channel);
        return $channeltype_info['ctl_name'];
    }
}

if (!function_exists('allow_release_arctype')) 
{
    /**
     * 允许发布文档的栏目列表
     */
    function allow_release_arctype($selected = 0, $allow_release_channel = array(), $selectform = true)
    {
        $where = [];

        $where['c.is_del'] = 0; // 回收站功能

        /*权限控制 by 小虎哥*/
        $admin_info = session('admin_info');
        if (0 < intval($admin_info['role_id'])) {
            $auth_role_info = $admin_info['auth_role_info'];
            if(! empty($auth_role_info)){
                if(! empty($auth_role_info['permission']['arctype'])){
                    $where['c.id'] = array('IN', $auth_role_info['permission']['arctype']);
                }
            }
        }
        /*--end*/

        if (!is_array($selected)) {
            $selected = [$selected];
        }

        $cacheKey = json_encode($selected).json_encode($allow_release_channel).$selectform.json_encode($where);
        $select_html = cache($cacheKey);
        if (empty($select_html) || false == $selectform) {
            /*允许发布文档的模型*/
            $allow_release_channel = !empty($allow_release_channel) ? $allow_release_channel : config('global.allow_release_channel');

            /*所有栏目分类*/
            $arctype_max_level = intval(config('global.arctype_max_level'));
            $where['c.status'] = 1;
            $fields = "c.id, c.parent_id, c.current_channel, c.typename, c.grade, count(s.id) as has_children, '' as children";
            $res = db('arctype')
                ->field($fields)
                ->alias('c')
                ->join('__ARCTYPE__ s','s.parent_id = c.id','LEFT')
                ->where($where)
                ->group('c.id')
                ->order('c.parent_id asc, c.sort_order asc, c.id')
                ->cache(true,EYOUCMS_CACHE_TIME,"arctype")
                ->select();
            /*--end*/
            if (empty($res)) {
                return '';
            }

            /*过滤掉第三级栏目属于不允许发布的模型下*/
            foreach ($res as $key => $val) {
                if ($val['grade'] == ($arctype_max_level - 1) && !in_array($val['current_channel'], $allow_release_channel)) {
                    unset($res[$key]);
                }
            }
            /*--end*/

            /*所有栏目列表进行层次归类*/
            $arr = group_same_key($res, 'parent_id');
            for ($i=0; $i < $arctype_max_level; $i++) {
                foreach ($arr as $key => $val) {
                    foreach ($arr[$key] as $key2 => $val2) {
                        if (!isset($arr[$val2['id']])) {
                            $arr[$key][$key2]['has_children'] = 0;
                            continue;
                        }
                        $val2['children'] = $arr[$val2['id']];
                        $arr[$key][$key2] = $val2;
                    }
                }
            }
            /*--end*/

            /*过滤掉第二级不包含允许发布模型的栏目*/
            $nowArr = $arr[0];
            foreach ($nowArr as $key => $val) {
                if (!empty($nowArr[$key]['children'])) {
                    foreach ($nowArr[$key]['children'] as $key2 => $val2) {
                        if (empty($val2['children']) && !in_array($val2['current_channel'], $allow_release_channel)) {
                            unset($nowArr[$key]['children'][$key2]);
                        }
                    }
                }
                if (empty($nowArr[$key]['children']) && !in_array($nowArr[$key]['current_channel'], $allow_release_channel)) {
                    unset($nowArr[$key]);
                    continue;
                }
            }
            /*--end*/

            /*组装成层级下拉列表框*/
            $select_html = '';
            if (false == $selectform) {
                $select_html = $nowArr;
            } else if (true == $selectform) {
                foreach ($nowArr AS $key => $val)
                {
                    $select_html .= '<option value="' . $val['id'] . '" data-grade="' . $val['grade'] . '" data-current_channel="' . $val['current_channel'] . '"';
                    $select_html .= (in_array($val['id'], $selected)) ? ' selected="selected"' : '';
                    if (!empty($allow_release_channel) && !in_array($val['current_channel'], $allow_release_channel)) {
                        $select_html .= ' disabled="true" style="background-color:#f5f5f5;"';
                    }
                    $select_html .= '>';
                    if ($val['grade'] > 0)
                    {
                        $select_html .= str_repeat('&nbsp;', $val['grade'] * 4);
                    }
                    $select_html .= htmlspecialchars(addslashes($val['typename'])) . '</option>';

                    if (empty($val['children'])) {
                        continue;
                    }
                    foreach ($nowArr[$key]['children'] as $key2 => $val2) {
                        $select_html .= '<option value="' . $val2['id'] . '" data-grade="' . $val2['grade'] . '" data-current_channel="' . $val2['current_channel'] . '"';
                        $select_html .= (in_array($val2['id'], $selected)) ? ' selected="selected"' : '';
                        if (!empty($allow_release_channel) && !in_array($val2['current_channel'], $allow_release_channel)) {
                            $select_html .= ' disabled="true" style="background-color:#f5f5f5;"';
                        }
                        $select_html .= '>';
                        if ($val2['grade'] > 0)
                        {
                            $select_html .= str_repeat('&nbsp;', $val2['grade'] * 4);
                        }
                        $select_html .= htmlspecialchars(addslashes($val2['typename'])) . '</option>';

                        if (empty($val2['children'])) {
                            continue;
                        }
                        foreach ($nowArr[$key]['children'][$key2]['children'] as $key3 => $val3) {
                            $select_html .= '<option value="' . $val3['id'] . '" data-grade="' . $val3['grade'] . '" data-current_channel="' . $val3['current_channel'] . '"';
                            $select_html .= (in_array($val3['id'], $selected)) ? ' selected="selected"' : '';
                            if (!empty($allow_release_channel) && !in_array($val3['current_channel'], $allow_release_channel)) {
                                $select_html .= ' disabled="true" style="background-color:#f5f5f5;"';
                            }
                            $select_html .= '>';
                            if ($val3['grade'] > 0)
                            {
                                $select_html .= str_repeat('&nbsp;', $val3['grade'] * 4);
                            }
                            $select_html .= htmlspecialchars(addslashes($val3['typename'])) . '</option>';
                        }
                    }
                }

                cache($cacheKey, $select_html, null, 'admin_archives_release');
                
            }
        }

        return $select_html;
    }
}

if (!function_exists('every_top_dirname_list')) 
{
    /**
     * 获取一级栏目的目录名称
     */
    function every_top_dirname_list() {
        $arctypeModel = new \app\common\model\Arctype();
        $result = $arctypeModel->getEveryTopDirnameList();
        
        return $result;
    }
}

if (!function_exists('gettoptype')) 
{
    /**
     * 获取当前栏目的第一级栏目
     */
    function gettoptype($typeid, $field = 'typename')
    {
        $parent_list = model('Arctype')->getAllPid($typeid); // 获取当前栏目的所有父级栏目
        $result = current($parent_list); // 第一级栏目
        if (isset($result[$field]) && !empty($result[$field])) {
            return handle_subdir_pic($result[$field]); // 支持子目录
        } else {
            return '';
        }
    }
}

if (!function_exists('send_email')) 
{
    /**
     * 邮件发送
     * @param $to    接收人
     * @param string $subject   邮件标题
     * @param string $content   邮件内容(html模板渲染后的内容)
     * @param string $scene   使用场景
     * @throws Exception
     * @throws phpmailerException
     */
    function send_email($to='', $subject='', $data=array(), $scene=0, $smtp_config = []){
        // 实例化类库，调用发送邮件
        $emailLogic = new \app\common\logic\EmailLogic($smtp_config);
        $res = $emailLogic->send_email($to, $subject, $data, $scene);
        return $res;
    }
}

if (!function_exists('checkEnableSendSms'))
{
    /**
     * 检测是否能够发送短信
     * @param unknown $scene
     * @return multitype:number string
     */
    function checkEnableSendSms($scene)
    {
        $scenes = config('SEND_SCENE');
        $sceneItem = $scenes[$scene];
        if (!$sceneItem) {
            return array("status" => -1, "msg" => "场景参数'scene'错误!");
        }
        $key = $sceneItem[2];
        $sceneName = $sceneItem[0];
        $config = tpCache('sms');
        $smsEnable = $config[$key];

        if (!$smsEnable) {
            return array("status" => -1, "msg" => "['$sceneName']发送短信被关闭'");
        }
        //判断是否添加"注册模板"
        $size = M('sms_template')->where("send_scene", $scene)->count('tpl_id');
        if (!$size) {
            return array("status" => -1, "msg" => "请先添加['$sceneName']短信模板");
        }

        return array("status"=>1,"msg"=>"可以发送短信");
    }
}

if (!function_exists('sendSms'))
{
    /**
     * 发送短信逻辑
     * @param unknown $scene
     */
    function sendSms($scene, $sender, $params,$unique_id=0)
    {
        $smsLogic = new \app\common\logic\SmsLogic;
        return $smsLogic->sendSms($scene, $sender, $params, $unique_id);
    }
}
/**
 * 获得全部区域列表
 */
if (!function_exists('get_region_list')){
    function get_region_list()
    {
        $result = extra_cache('global_get_region_list');
        if (empty($result)) {
            $result = M('region')->field('id, name, domain, parent_id,level')
                ->where('status',1)
                ->order("sort_order asc")
                ->getAllWithIndex('id');

            extra_cache('global_get_region_list', $result);
        }
        return $result;
    }
}
/**
 * 获得全部省份列表
 */
if (!function_exists('get_province_list')){
    function get_province_list()
    {
        $result = extra_cache('global_get_province_list');
        if (empty($result)) {
            $result = M('region')->field('id, name, domain, parent_id')
                ->where('level',1)
                ->where('status',1)
                ->order("sort_order asc")
                ->getAllWithIndex('id');

            extra_cache('global_get_province_list', $result);
        }
        return $result;
    }
}
/**
 * 获得全部城市列表
 */
if (!function_exists('get_city_list')){
    function get_city_list()
    {
        $result = extra_cache('global_get_city_list');
        if (empty($result)) {
            $result = M('region')->field('id, name, parent_id')
                ->where('level',2)
                ->where('status',1)
                ->getAllWithIndex('id');
            extra_cache('global_get_city_list', $result);
        }

        return $result;
    }
}
/**
 * 获得全部地区列表
 */
if (!function_exists('get_area_list')){
    function get_area_list()
    {
        $result = extra_cache('global_get_area_list');
        if (empty($result)) {
            $result = M('region')->field('id, name, parent_id')
                ->where('level',3)
                ->where('status',1)
                ->getAllWithIndex('id');
            extra_cache('global_get_area_list', $result);
        }

        return $result;
    }
}

/*
 * 获取所有下级
 */
if (!function_exists('get_next_region_list')){
    function get_next_region_list($pid){
        $result = extra_cache('global_next_region_list'.$pid);
        if ($result == false) {
            $result = M('region')->field('id,id as rid, name,domain,level')
                ->where('status',1)
                ->where('parent_id',$pid)
                ->order("sort_order asc")
                ->getAllWithIndex('id');
            extra_cache('global_next_region_list'.$pid, $result);
        }

        return $result;
    }
}
/**
 * 根据地区ID获得省份名称
 */
if (!function_exists('get_province_name')){
    function get_province_name($id = '')
    {
        if (empty($id)) {
            return '';
        }
        $result = get_province_list();
        return empty($result[$id]) ? '' : $result[$id]['name'];
    }
}
/**
 * 根据地区ID获得城市名称
 */
if (!function_exists('get_city_name')){
    function get_city_name($id = '')
    {
        if (empty($id)) {
            return '';
        }
        $result = get_city_list();
        return empty($result[$id]) ? '' : $result[$id]['name'];
    }
}


/**
 * 根据地区ID获得县区名称
 */
if (!function_exists('get_area_name')){
    function get_area_name($id = '')
    {
        if (empty($id)) {
            return '';
        }
        $result = get_area_list();
        return empty($result[$id]) ? '' : $result[$id]['name'];
    }
}

if (!function_exists('download_file')) 
{
    /**
     * 下载文件
     * @param $down_path 文件路径
     * @param $file_mime 文件类型
     */
    function download_file($down_path = '', $file_mime = '')
    {
        /*支持子目录*/
        $down_path = handle_subdir_pic($down_path, 'soft');
        /*--end*/

        //文件名
        $filename = explode('/', $down_path);
        $filename = end($filename);
        //以只读和二进制模式打开文件
        $file = fopen('.'.$down_path, "rb");
        //文件大小
        $file_size = filesize('.'.$down_path);
        //告诉浏览器这是一个文件流格式的文件    
        header("Content-type: ".$file_mime);
        //请求范围的度量单位
        Header("Accept-Ranges: bytes");
        //Content-Length是指定包含于请求或响应中数据的字节长度
        Header("Accept-Length: " . $file_size);
        //用来告诉浏览器，文件是可以当做附件被下载，下载后的文件名称为$filename该变量的值。
        Header("Content-Disposition: attachment; filename=" . $filename); 
        //读取文件内容并直接输出到浏览器    
        echo fread($file, $file_size);    
        fclose($file);    
        exit();
    }
}

if (!function_exists('is_realdomain')) 
{
    /**
     * 简单判断当前访问的域名是否真实
     * @param string $domain 不带协议的域名
     * @return boolean
     */
    function is_realdomain($domain = '')
    {
        $is_real = false;
        $domain = !empty($domain) ? $domain : request()->host();
        if (!preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/i', $domain) && 'localhost' != $domain && '127.0.0.1' != serverIP()) {
            $is_real = true;
        }

        return $is_real;
    }
}

if (!function_exists('img_style_wh')) 
{
    /**
     * 追加指定内嵌样式到编辑器内容的img标签，兼容图片自动适应页面
     */
    function img_style_wh($content = '', $title = '')
    {
        if (!empty($content)) {
            preg_match_all('/<img.*(\/)?>/iUs', $content, $imginfo);
            $imginfo = !empty($imginfo[0]) ? $imginfo[0] : [];
            if (!empty($imginfo)) {
                $num = 1;
                $appendStyle = "max-width:100%!important;height:auto;";
                $title = preg_replace('/("|\')/i', '', $title);
                foreach ($imginfo as $key => $imgstr) {
                    $imgstrNew = $imgstr;
                    
                    /* 兼容已存在的多重追加样式，处理去重 */
                    if (stristr($imgstrNew, $appendStyle.$appendStyle)) {
                        $imgstrNew = preg_replace('/'.$appendStyle.$appendStyle.'/i', '', $imgstrNew);
                    }
                    if (stristr($imgstrNew, $appendStyle)) {
                        $content = str_ireplace($imgstr, $imgstrNew, $content);
                        $num++;
                        continue;
                    }
                    /* end */

                    // 追加style属性
                    $imgstrNew = preg_replace('/style(\s*)=(\s*)[\'|\"](.*?)[\'|\"]/i', 'style="'.$appendStyle.'${3}"', $imgstrNew);
                    if (!preg_match('/<img(.*?)style(\s*)=(\s*)[\'|\"](.*?)[\'|\"](.*?)[\/]?(\s*)>/i', $imgstrNew)) {
                        // 新增style属性
                        $imgstrNew = str_ireplace('<img', "<img style=\"".$appendStyle."\" ", $imgstrNew);
                    }

                    // 移除img中多余的title属性
                    // $imgstrNew = preg_replace('/title(\s*)=(\s*)[\'|\"]([\w\.]*?)[\'|\"]/i', '', $imgstrNew);

                    // 追加alt属性
                    $altNew = $title."(图{$num})";
                    $imgstrNew = preg_replace('/alt(\s*)=(\s*)[\'|\"]([\w\.]*?)[\'|\"]/i', 'alt="'.$altNew.'"', $imgstrNew);
                    if (!preg_match('/<img(.*?)alt(\s*)=(\s*)[\'|\"](.*?)[\'|\"](.*?)[\/]?(\s*)>/i', $imgstrNew)) {
                        // 新增alt属性
                        $imgstrNew = str_ireplace('<img', "<img alt=\"{$altNew}\" ", $imgstrNew);
                    }

                    // 追加title属性
                    $titleNew = $title."(图{$num})";
                    $imgstrNew = preg_replace('/title(\s*)=(\s*)[\'|\"]([\w\.]*?)[\'|\"]/i', 'title="'.$titleNew.'"', $imgstrNew);
                    if (!preg_match('/<img(.*?)title(\s*)=(\s*)[\'|\"](.*?)[\'|\"](.*?)[\/]?(\s*)>/i', $imgstrNew)) {
                        // 新增alt属性
                        $imgstrNew = str_ireplace('<img', "<img alt=\"{$titleNew}\" ", $imgstrNew);
                    }
                    
                    // 新的img替换旧的img
                    $content = str_ireplace($imgstr, $imgstrNew, $content);
                    $num++;
                }
            }
        }

        return $content;
    }
}

if (!function_exists('SynchronizeQiniu')) 
{
    /**
     * 参数说明：
     * $images   本地图片地址
     * $Qiniuyun 七牛云插件配置信息
     * $is_tcp 是否携带协议
     * 返回说明：
     * return false 没有配置齐全
     * return true  同步成功
     */
    function SynchronizeQiniu($images,$Qiniuyun=null,$is_tcp=false)
    {
        static $Qiniuyun = null;
        // 若没有传入配信信息则读取数据库
        if (null == $Qiniuyun) {
            // 需要填写你的 Access Key 和 Secret Key
            $data     = M('weapp')->where('code','Qiniuyun')->field('data')->find();
            $Qiniuyun = json_decode($data['data'], true);
        }
        // 配置为空则返回原图片路径
        if (empty($Qiniuyun)) {
            return $images;
        }

        //引入七牛云的相关文件
        weapp_vendor('Qiniu.src.Qiniu.Auth', 'Qiniuyun');
        weapp_vendor('Qiniu.src.Qiniu.Storage.UploadManager', 'Qiniuyun');
        require_once ROOT_PATH.'weapp/Qiniuyun/vendor/Qiniu/autoload.php';

        // 配置信息
        $accessKey = $Qiniuyun['access_key'];
        $secretKey = $Qiniuyun['secret_key'];
        $bucket    = $Qiniuyun['bucket'];
        $domain    = $Qiniuyun['domain'];
        // 图片处理，去除图片途径中的第一个斜杠
        $images    = ltrim($images, '/'); 
        // 构建鉴权对象
        $auth      = new Qiniu\Auth($accessKey, $secretKey);
        // 生成上传 Token
        $token     = $auth->uploadToken($bucket);
        // 要上传文件的本地路径
        $filePath  = ROOT_PATH.$images;
        // 上传到七牛后保存的文件名
        $key       = $images;
        // 初始化 UploadManager 对象并进行文件的上传。
        $uploadMgr = new Qiniu\Storage\UploadManager;
        // 调用 UploadManager 的 putFile 方法进行文件的上传。
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
        // list($ret, $err) = $uploadMgr->put($token, $key, $filePath);
        if (empty($err) || $err === null) {
            $tcp = '//';
            if ($is_tcp) {
                $tcp = !empty($Qiniuyun['tcp']) ? $Qiniuyun['tcp'] : '';
                switch ($tcp) {
                    case '2':
                        $tcp = 'https://';
                        break;

                    case '3':
                        $tcp = '//';
                        break;
                    
                    case '1':
                    default:
                        $tcp = 'http://';
                        break;
                }
            }
            return $tcp.$domain.'/'.$images;
        }
        return $images;
    }
}

if (!function_exists('getAllChild')) 
{   
    /**
     * 递归查询所有的子类
     * @param array $arctype_child_all 存放所有的子栏目
     * @param int $id 栏目ID 或 父栏目ID
     * @param int $type 1=栏目，2=文章
     */ 
    function getAllChild(&$arctype_child_all,$id,$type = 1){
        if($type == 1){
            $arctype_child = db('arctype')->where(['is_del'=>0,'status'=>1,'parent_id'=>$id])->getfield('id',true);
        }else{
            $where['is_del'] = 0;
            $where['status'] = 1;
            $where['parent_id'] = $id;
            $where['current_channel'] = array(array('neq',6),array('neq',8));
            $arctype_child = db('arctype')->where($where)->getfield('id',true); 
        }
        
        if(!empty($arctype_child)){
            $arctype_child_all = array_merge($arctype_child_all,$arctype_child);
            for($i=0;$i<count($arctype_child);$i++){
                getAllChild($arctype_child_all,$arctype_child[$i],$type);
            }
        }
    }
}
    
if (!function_exists('getAllChildByList')) 
{   
    /**
     * 生成栏目页面时获取同模型下级
     * @param array $arctype_child_all 存放所有的子栏目
     * @param int $id 栏目ID 或 父栏目ID
     * @param int $current_channel 当前栏目的模型ID
     */ 
    function getAllChildByList(&$arctype_child_all,$id,$current_channel){
        $arctype_child = db('arctype')->where(['is_del'=>0,'status'=>1,'parent_id'=>$id,'current_channel'=>$current_channel])->getfield('id',true);
        if(!empty($arctype_child)){
            $arctype_child_all = array_merge($arctype_child_all,$arctype_child);
            for($i=0;$i<count($arctype_child);$i++){
                getAllChild($arctype_child_all,$arctype_child[$i]);
            }
        }
    }
}

if (!function_exists('getAllChildArctype'))
{
    //递归查询所有的子类
    function getAllChildArctype(&$arctype_child_all,$id){
        $where['a.is_del'] = 0;
        $where['a.status'] = 1;
        $where['a.parent_id'] = $id;
        $arctype_child = db('arctype')->field('c.*, a.*, a.id as typeid')
            ->alias('a')
            ->join('__CHANNELTYPE__ c', 'c.id = a.current_channel', 'LEFT')
            ->where($where)
            ->select();
        if(!empty($arctype_child)){
            $arctype_child_all = array_merge($arctype_child,$arctype_child_all);
            for($i=0;$i<count($arctype_child);$i++){
                getAllChildArctype($arctype_child_all,$arctype_child[$i]['typeid']);
            }
        }
    }
}

if (!function_exists('getAllArctype'))
{
    /*
     * 递归查询所有栏目
     * $id          栏目id    存在则获取指定的栏目，不存在获取全部
     * $parent      是否获取下级栏目    true：获取，false：不获取
     * $aid
     */
    function getAllArctype($id,$view_suffix,$parent = true,$aid = 0){
        $map = [];
        if (!empty($id)){
            $map['a.id'] = $id;
        }
        $map['a.is_del'] = 0;
        $map['a.status'] = 1;
        $info = db('arctype')->field('c.*, a.*, a.id as typeid')
            ->alias('a')
            ->join('__CHANNELTYPE__ c', 'c.id = a.current_channel', 'LEFT')
            ->where($map)
            ->order("a.id desc")    //order("a.is_hidden asc,a.parent_id asc,a.id desc")
            ->cache(true,EYOUCMS_CACHE_TIME,"arctype")
            ->select();
        if (!empty($id) && $parent && $aid == 0){ // $aid > 0 表示栏目生成不生成子栏目
            getAllChildArctype($info,$id);
        }
        $info = getAllArctypeCount($info,$id,$view_suffix,$aid);
        return $info;
    }
}

if (!function_exists('getAllArctypeCount'))
{
    /*
     * 获取所有栏目数据条数
     * 获取需要生成的栏目页的静态文件的个数   缓存到channel_page_total
     */
    function getAllArctypeCount($info,$id = 0,$view_suffix = ".htm",$aid = 0){
        $pagetotal = 0;
        if ($id){
            $map_arc['typeid'] = array('in',get_arr_column($info,'typeid'));
        }
        $map_arc['is_del'] = 0;
        $map_arc['status'] = 1;
        $tpl_theme = config('ey_config.system_tpl_theme');
        $info = convert_arr_key($info,'typeid');
        $count_type = db('archives')->field("count(*) as count,typeid")->where($map_arc)->group("typeid")->select();
        $count_type = convert_arr_key($count_type,'typeid');
        foreach ($info as $k=>$v){
            if (!isset($info[$k]['count'])){    //判断当前栏目的count是否已经存在
                $info[$k]['count'] = 0;
            }
            if (isset($count_type[$v['typeid']])){    //存在当前栏目个数
                $info[$k]['count'] += $count_type[$v['typeid']]['count'];
            }
            if ($v['parent_id'] && $v['current_channel'] != 6 && $v['current_channel'] != 8 && isset($info[$v['parent_id']]) && $v['current_channel'] == $info[$v['parent_id']]['current_channel']){     //判断是否存在上级目录
                if (isset($info[$v['parent_id']]['count'])){
                    $info[$v['parent_id']]['count'] += $info[$k]['count'];
                }else{
                    $info[$v['parent_id']]['count'] = $info[$k]['count'];
                }
            }
        }
        foreach($info as $k=>$v){
            if ($v['current_channel'] == 6 || $v['current_channel'] == 8){
                $info[$k]['pagesize'] = 1;
                $pagetotal += $info[$k]['pagetotal'] = 1;
            }else{
                $tpl = !empty($v['templist']) ? str_replace('.'.$view_suffix, '',$v['templist']) : 'lists_'. $v['nid'];
                $template_html = "./template/{$tpl_theme}/pc/{$tpl}.htm";
                $content = file_get_contents($template_html);
                if($content){
                    preg_match_all('/\{eju:list(.*)pagesize=[\'\"](\d+)[\'\"](.*)\}/',$content,$rese);
                    $pagesize =  !empty($rese[2][0]) ? $rese[2][0] : 10;
                    if ($aid){
                        preg_match_all('/\{eju:list(.*)orderby=[\'\"](.*)[\'\"](.*)\}/',$content,$reseby);
                        $orderby =  !empty($reseby[2][0]) ? $reseby[2][0] : "";
                        preg_match_all('/\{eju:list(.*)orderway=[\'\"](.*)[\'\"](.*)\}/',$content,$reseway);
                        $orderway =  !empty($reseway[2][0]) ? $reseway[2][0] : "desc";
                    }
                }
                $info[$k]['pagesize'] = $pagesize = !empty($pagesize)?$pagesize:10;
                $pagetotal += $info[$k]['pagetotal'] = !empty($info[$k]['count']) ? ceil($info[$k]['count']/$pagesize):1;




            }
            $info[$k]['orderby'] = !empty($orderby)?$orderby:"";
            $info[$k]['orderway'] = !empty($orderway)?$orderway:"desc";
        }
        $info = array_merge($info);


        return ["info"=>$info,"pagetotal"=>$pagetotal];
    }
}
//一下几个方法为生成静态时使用
//获取所有文档信息
if (!function_exists('getAllArchives'))
{
    //递归查询所有栏目
    function getAllArchives($id,$aid = 0){
        $map = [];
        if(!empty($aid)){
            $map['a.aid'] = $aid;
        }else if (!empty($id)){
            $id_arr = [$id];
            getAllChild($id_arr,$id,2);
            $map['a.typeid'] = ['in',$id_arr];
        }
        $allow_release_channel = config('global.allow_release_channel');
        $map['a.channel']  = ['IN', $allow_release_channel];
        $map['a.is_del'] = 0;
        $map['a.status'] = 1;
        $info_origin = db('archives')->field('a.*')
            ->alias('a')
            ->where($map)
            ->select();
        $typeids = get_arr_column($info_origin, 'typeid');
        $info = getAllContent($info_origin);

        /*栏目信息*/
        $arctypeRow = db('arctype')->field('c.*, a.*, a.id as typeid')
            ->alias('a')
            ->join('__CHANNELTYPE__ c', 'c.id = a.current_channel', 'LEFT')
            ->cache(true,EYOUCMS_CACHE_TIME,"arctype")
            ->getAllWithIndex('typeid');

        return [
            'info'          => $info,
            'arctypeRow'   => $arctypeRow,
        ];
    }
}
if (!function_exists('getPreviousArchives'))
{
    //获取上一条文章数据
    function getPreviousArchives($id,$aid = 0){
        $map = [];
        if(!empty($aid)){
            $map['a.aid'] = ['lt',$aid];
        }
        if (!empty($id)){
            $id_arr = [$id];
            getAllChild($id_arr,$id,2);
            $map['a.typeid'] = ['in',$id_arr];
        }
        $allow_release_channel = config('global.allow_release_channel');
        $map['a.channel']  = ['IN', $allow_release_channel];
        $map['a.is_del'] = 0;
        $map['a.status'] = 1;
        $info = db('archives')->field('a.*')
            ->alias('a')
            ->where($map)
            ->order("a.aid desc")
            ->limit(1)
            ->select();
        $typeids = get_arr_column($info, 'typeid');
        $info = getAllContent($info);

        /*栏目信息*/
        $arctypeRow = db('arctype')->field('c.*, a.*, a.id as typeid')
            ->alias('a')
            ->join('__CHANNELTYPE__ c', 'c.id = a.current_channel', 'LEFT')
            ->cache(true,EYOUCMS_CACHE_TIME,"arctype")
            ->getAllWithIndex('typeid');

        return [
            'info'          => $info,
            'arctypeRow'   => $arctypeRow,
        ];
    }
}
if (!function_exists('getNextArchives'))
{
    //获取下一条文章数据
    function getNextArchives($id,$aid = 0){
        $map = [];
        if(!empty($aid)){
            $map['a.aid'] = ['gt',$aid];
        }
        if (!empty($id)){
            $id_arr = [$id];
            getAllChild($id_arr,$id,2);
            $map['a.typeid'] = ['in',$id_arr];
        }
        $allow_release_channel = config('global.allow_release_channel');
        $map['a.channel']  = ['IN', $allow_release_channel];
        $map['a.is_del'] = 0;
        $map['a.status'] = 1;
        $info = db('archives')->field('a.*')
            ->alias('a')
            ->where($map)
            ->order("a.aid asc")
            ->limit(1)
            ->select();
        $typeids = get_arr_column($info, 'typeid');
        $info = getAllContent($info);

        /*栏目信息*/
        $arctypeRow = db('arctype')->field('c.*, a.*, a.id as typeid')
            ->alias('a')
            ->join('__CHANNELTYPE__ c', 'c.id = a.current_channel', 'LEFT')
            ->cache(true,EYOUCMS_CACHE_TIME,"arctype")
            ->getAllWithIndex('typeid');

        return [
            'info'          => $info,
            'arctypeRow'   => $arctypeRow,
        ];
    }
}
//获得所有详情页信息
if (!function_exists('getAllContent'))
{
    //获取指定文档列表的内容附加表字段值
    function getAllContent($archivesList = []){
        $contentList = [];
        $db = new \think\Db;
        $channeltype_list = config('global.channeltype_list');
        $arr = group_same_key($archivesList, 'channel');
        foreach ($arr as $nid => $list) {
            $table = array_search($nid, $channeltype_list);
            if (!empty($table)) {
                $aids = get_arr_column($list, 'aid');
                $row = $db::name($table.'_content')->field('id,add_time,update_time', true)
                    ->where(['aid'=>['IN', $aids]])
                    ->getAllWithIndex('aid');
                $contentList += $row;
            }
        }

        $firstFieldData = current($contentList);
        foreach ($archivesList as $key => $val) {

            /*文档所属模型是不存在，或已被禁用*/
            $table = array_search($val['channel'], $channeltype_list);
            if (empty($table)) {
                unset($archivesList[$key]);
                continue;
            }
            /*end*/

            /*文档内容表没有记录的特殊情况*/
            if (!isset($contentList[$val['aid']])) {
                $contentList[$val['aid']] = [];
                foreach ($firstFieldData as $k2 => $v2) {
                    if (in_array($k2, ['aid'])) {
                        $contentList[$val['aid']][$k2] = $val[$k2];
                    } else {
                        $contentList[$val['aid']][$k2] = '';
                    }
                }
            }
            /*end*/
            $val = array_merge($val, $contentList[$val['aid']]);
            $archivesList[$key] = $val;
        }

        return $archivesList;
    }
}
//获取所有标签
if (!function_exists('getAllTags'))
{
    //递归查询所有栏目内容
    function getAllTags($aid_arr){
        $map = [];
        $info = [];
        $map['aid'] = ['in',$aid_arr];
        $result = db('taglist')->field("aid,tag")->where($map)->select();
        if ($result) {
            foreach ($result as $key => $val) {
                if (!isset($info[$val['aid']])) $info[$val['aid']] = array();
                array_push($info[$val['aid']], $val['tag']);
            }
        }

        return $info;
    }
}
//获取所有标签内容
if (!function_exists('getAllAttrInfo'))
{
    //递归查询所有栏目内容
    function getAllAttrInfo($aid_arr){
        $info = [];
        $info['product_img'] = model('ProductImg')->getProImg($aid_arr);
        $info['product_attr'] = model('ProductAttr')->getProAttr($aid_arr);
        $info['images_upload'] = model('ImagesUpload')->getImgUpload($aid_arr);
        $info['download_file'] = model('DownloadFile')->getDownFile($aid_arr);

        return $info;
    }
}

//获得所有详情页信息
if (!function_exists('getAllChildData'))
{
    function getAllChildData($nid,$child){
        $info = [];
        $id = $child."_id";
        $pid = "aid";//$nid."_id";
        $info = db($nid.'_'.$child)->field($pid.",GROUP_CONCAT(".$id.") as ".$child)->group($pid)->getAllWithIndex($pid);

        return $info;
    }
}

if (!function_exists('getOrderBy'))
{
    //根据tags-list规则，获取查询排序，用于标签文件 TagArclist / TagList
    function getOrderBy($orderby,$orderway,$isrand = false,$isinput = true){
        $orderbys = input('param.orderby/s', '');
        $orderways = input('param.orderway/s', '');
        if($isinput && !empty($orderbys)){
            return "{$orderbys} {$orderways}";
        }

        switch ($orderby) {
            case 'hot':
            case 'click':
                $orderby = "a.click {$orderway}";
                break;

            case 'id': // 兼容织梦的写法
            case 'aid':
                $orderby = "a.aid {$orderway}";
                break;

            case 'now':
            case 'new': // 兼容织梦的写法
                $orderby = "a.show_time {$orderway}";
            break;
            case 'pubdate': // 兼容织梦的写法
                $orderby = "a.update_time {$orderway}";
                break;
            case 'add_time':
                $orderby = "a.add_time {$orderway}";
                break;
            case 'sortrank': // 兼容织梦的写法
            case 'sort_order':
                $orderby = "a.sort_order {$orderway}, a.show_time desc";
                break;

            case 'rand':
                if (true === $isrand) {
                    $orderby = "rand()";
                } else {
                    $orderby = "a.show_time {$orderway}";
                }
                break;

            default:
            {
                if (empty($orderby)) {
                    $orderby = 'a.sort_order asc, a.show_time desc';
                } elseif (trim($orderby) != 'rand()') {
                    $orderbyArr = explode(',', $orderby);
                    foreach ($orderbyArr as $key => $val) {
                        $val = trim($val);
                        if (preg_match('/^([a-z]+)\./i', $val) == 0) {
                            $val = 'a.'.$val;
                            $orderbyArr[$key] = $val;
                        }
                    }
                    $orderby = implode(',', $orderbyArr);
                }
                break;
            }
        }

        return $orderby;
    }
}

if (!function_exists('getLocationPages'))
{
    /*
     * 获取当前文章属于栏目第几条
     */
    function getLocationPages($tid,$aid,$order){
        $map_arc = [];
        if (!empty($tid)){
            $id_arr = [$tid];
            getAllChild($id_arr,$tid,2);
            $map_arc['typeid'] = ['in',$id_arr];
        }
        $map_arc['is_del'] = 0;
        $map_arc['status'] = 1;
        $result = db('archives')->alias('a')->field("a.aid")->where($map_arc)->orderRaw($order)->select();

        foreach ($result as $key=>$val){
            if ($aid == $val['aid']){
                return $key + 1;
            }
        }
        return false;
    }
}

/**
 * 获得全部置业人员列表
 */
if (!function_exists('get_saleman_list')){
    function get_saleman_list()
    {
        $result = extra_cache('global_get_saleman_list');
        if ($result == false) {
            $result =  \think\Db::name("users")
                ->alias('a')
                ->join("users_content b","a.id = b.users_id","left")
                ->field("b.*,a.*,nickname as saleman_name,mobile as saleman_mobile,qq as saleman_qq,litpic as saleman_pic")
                ->where(['a.status'=>1,'a.is_saleman'=>1])->getAllWithIndex('a.id');
            extra_cache('global_get_saleman_list', $result);
        }
        return $result;
    }
}
/*
 * 获取所有相册类型
 */
if (!function_exists('get_photo_type_list')){
    function get_photo_type_list($type = 1)
    {
        $photo_type = config("xinfang.photo_type");
        if ($type == 1){
            return $photo_type;
        }
        $photo_type_list = [];
        foreach ($photo_type as $val){
            $photo_type_list += $val['next'];
        }
        return $photo_type_list;
    }
}
if (!function_exists('get_sale_status_list')){
    function get_sale_status_list()
    {
        $list = config("xinfang.sale_status");
        return $list;
    }
}
if (!function_exists('get_characteristic_list')){
    function get_characteristic_list()
    {
        $list = config("xinfang.characteristic");
        return $list;
    }
}
if (!function_exists('get_huxing_aspect_list')){
    function get_huxing_aspect_list()
    {
        $list = config("xinfang.aspect");
        return $list;
    }
}
if (!function_exists('get_huxing_fitment_list')){
    function get_huxing_fitment_list()
    {
        $list = config("xinfang.fitment");
        return $list;
    }
}
if (!function_exists('get_huxing_manage_type_list')){
    function get_huxing_manage_type_list()
    {
        $list = config("xinfang.manage_type");
        return $list;
    }
}

if (!function_exists('get_huxing_characteristic_list')){
    function get_huxing_characteristic_list()
    {
        $list = config("xinfang.huxing_characteristic");
        return $list;
    }
}
if (!function_exists('get_average_price_list')){
    function get_average_price_list()
    {
        $list = config("xinfang.average_price");
        return $list;
    }
}
if (!function_exists('get_average_price_select')){
    //单价筛选区间转化为查询条件
    function get_average_price_select($key = 0)
    {
        $data = config("xinfang.average_price");

        try{
            if(!empty($data[$key])){
                $str = [$data[$key]['mark'],$data[$key]['value']];
            }else{
                $str = '';
            }
            return $str;
        }catch(\Exception $e){
            \think\facade\Log::write($e->getMessage(),'error');
            return '';
        }
    }
}
if (!function_exists('getParentRegionId')){
    //获取所有上级区域id
    function getParentRegionId($id){
        static $regionArr = array();
        static $countnext = 0;
        $countnext++;
        $regionArr[] = $id;
        if(!empty($id)){
            $list = db('region')->field('id,parent_id')->where('id='.$id)->find();
            if($list && $list['parent_id']!=0){
                getParentRegionId($list['parent_id']);
            }
        }
        $countnext--;
        $result = $regionArr;
        if($countnext == 0){
            $regionArr = array();
        }
        return $result;
    }
}
/**
 * @param $string
 * @return bool
 * 判断是否是json字符串
 */
if (!function_exists('is_json')){
    function is_json($string)
    {
        if(is_string($string))
        {
            json_decode($string);
            return (json_last_error() == JSON_ERROR_NONE);
        }else{
            return false;
        }
    }
}
/*获取下级部门
 * 参数：$departmentId  部门id
 * 参数：$status 部门状态
 */
function nextDeparts($departmentId,$status=5){
    static $departmentArr=array();
    static $countnext = 0;
    $countnext++;
    $departmentArr[] = $departmentId;
    $list = M('roleDepartment')->field('id,pid')->where('status>='.$status.' and pid='.$departmentId)->select();
    if($list){
        foreach($list as $val){
            nextDeparts($val['id'],$status);
        }
    }
    $countnext--;
    $heheda = $departmentArr;
    if($countnext == 0){
        $departmentArr = array();
    }
    return $heheda;
}

//获取某个表的数据
if (!function_exists('get_next_info_list')){
    function get_next_info_list($aid = 0,$table = 'xinfang_huxing',$id='aid',$field = "*",$order = "",$limit = "",$group = "",$map = "")
    {
        if ($aid && $map){
            $map .= " and {$id}={$aid}";
        }else if ($aid){
            $map = "{$id}={$aid}";
        }
        $result = db($table)->field($field)->where($map);
        if (!empty($group)){
            $result = $result->group($group);
        }
        if (!empty($order)){
            $result = $result->order($order);
        }
        if (!empty($limit)){
            $result = $result->limit($limit);
        }
        $result = $result->select();

        return $result;
    }
}
//获取某个表的列表信息(全部)
if (!function_exists('get_info_list')){
    function get_info_list($table = 'region',$id = 'id',$map = "")
    {
        $result = extra_cache("global_get_{$table}_list");
        if ($result == false) {
            $result = db($table)->field("*")
                ->where($map)
                ->getAllWithIndex($id);
            extra_cache("global_get_{$table}_list", $result);
        }

        return $result;
    }
}
//获取某个表的单个信息
if (!function_exists('get_info_name')){
    function get_info_name($key,$table,$id = 'id',$name = "",$map = "")
    {
        $result = get_info_list($table,$id,$map);
        if (!empty($result[$key][$name])){
            return $result[$key][$name];
        }else if (!empty($result[$key])){
            return empty($result[$key]);
        }
        return "";
    }
}
//获取过去数月的时间
if (!function_exists('to_month')){
    function to_month($length,$format = "Y-m月")
    {
        $arr = array();
        for($i = 0;$i<$length; ++$i)
        {
            $t = strtotime("-$i month");
            $end_time = $i > 0 ?strtotime(date("Y-m-d 23:59:59", strtotime("-".($i-1)." month-".date('d').'day'))):time(); //结束时间
            $arr[] = [
                date($format,$t),  //显示
                date('Y-m',$t),   //值
                strtotime(date('Y-m-01 00:00:00',$t)),   //本月起始时间
                $end_time];  //本月结束时间
        }
//        for($i = $length;$i > 0; --$i)
//        {
//            $t = strtotime("-$i month");
//            $arr[] = [
//                date('Y-m月',$t),
//                date('Y-m',$t),   //值
//                strtotime(date('Y-m-01 00:00:00',$t)),   //本月起始时间
//                strtotime(date("Y-m-d 23:59:59", strtotime("-".($i-1)." month-".date('d').'day')))  //本月结束时间
//            ];
//        }
        return $arr;
    }
}
//返回关联房源信息的arcurl
if (!function_exists('get_xinfang_info')){
    function get_xinfang_info($aid,$result)
    {
        if (!empty($result) && !empty($result['add_type'])){  //主动添加
            if ($result['is_jump'] == 1) {
                $result['arcurl'] = $result['jumplinks'];
            } else {
                $param = $result;
                if(isset($param['room'])){
                    unset($param['room']);
                }
                $result['arcurl'] = arcurl('home/View/index', $param);
            }
        }
        return $result;
    }
}
//获取路径下所有名称符合正则规则的文件
if (!function_exists('getPregMatchFilePath')){
    function  getPregMatchFilePath($path,$str){
        $handle = opendir($path);
        $result = [];
        while(($item=readdir($handle)) != false){
            if($item!="."&&$item!=".."){
                if(preg_match($str,$item,$matches)){
//                    $result[] = $item;
                    $result[] = $matches;
                }
            }
        }
        return $result;
    }
}
/*
 *  获取楼盘内页链接
 * @param string        $url 路由地址
 * @param string|array  $param 变量
 */

if (!function_exists('sonarcurl')){
    function sonarcurl($url = '', $param = '',$column = '',$sid = '',$photo_type = ''){
        if (!empty($column)){
            $param['column'] = $column;
        }
        if (!empty($sid)){
            $param['sid'] = $sid;
        }
        if (!empty($photo_type)){
            $param['photo_type'] = $photo_type;
        }
        return arcurl($url,$param);
    }
}

if (!function_exists('get_default_subdomain')) 
{
    /**
     * 获取默认子站点
     */
    function get_default_subdomain()
    {
        $request = \think\Request::instance();
        if (stristr($request->baseFile(), 'index.php')) {
            $default_subdomain = \think\Config::get('ey_config.system_default_subdomain');
        }

        return $default_subdomain;
    }
}
if (!function_exists('getScreeningFieldName')){
    /*
     * 获取所有筛选字段
     * $channel_id  指定模型
     */
    function getScreeningFieldName($channel_id = ""){
        $map['is_screening'] = 1;
        if (!empty($channel_id)){
            $map['channel_id'] = $channel_id;
        }
        return \think\Db::name("channelfield")->where($map)->getField("name",true);
    }
}
if (!function_exists('getUsersConfigData'))
{
    // 专用于获取users_config，会员配置表数据处理。
    // 参数1：必须传入，传入值不同，获取数据不同：
    // 例：获取配置所有数据，传入：all，
    // 获取分组所有数据，传入：分组标识，如：member，
    // 获取分组中的单个数据，传入：分组标识.名称标识，如：users.users_open_register
    // 参数2：data数据，为空则查询，否则为添加或修改。
    // 参数3：多语言标识，为空则获取当前默认语言。
    function getUsersConfigData($config_key,$data=array(), $options = null){
        $tableName = 'users_config';
        $table_db = \think\Db::name($tableName);

        $param = explode('.', $config_key);
        $cache_inc_type = $tableName.$param[0];
        if (empty($options)) {
            $options['path'] = CACHE_PATH.DS;
        }
        if(empty($data)){
            //如$config_key=shop_info则获取网站信息数组
            //如$config_key=shop_info.logo则获取网站logo字符串
            $config = cache($cache_inc_type,'',$options);//直接获取缓存文件
            if(empty($config)){
                //缓存文件不存在就读取数据库
                if ($param[0] == 'all') {
                    $param[0] = 'all';
                    $res = $table_db->where([
                    ])->select();
                } else {
                    $res = $table_db->where([
                        'inc_type'  => $param[0],
                    ])->select();
                }
                if($res){
                    foreach($res as $k=>$val){
                        $config[$val['name']] = $val['value'];
                    }
                    cache($cache_inc_type,$config,$options);
                }
            }
            if(!empty($param) && count($param)>1){
                $newKey = strtolower($param[1]);
                return isset($config[$newKey]) ? $config[$newKey] : '';
            }else{
                return $config;
            }
        }else{
            //更新缓存
            $result =  $table_db->where([
                'inc_type'  => $param[0],
            ])->select();

            if($result){
                foreach($result as $val){
                    $temp[$val['name']] = $val['value'];
                }
                $add_data = array();
                foreach ($data as $k=>$v){
                    $newK = strtolower($k);
                    $newArr = array(
                        'name'=>$newK,
                        'value'=>trim($v),
                        'inc_type'=>$param[0],
                        'update_time'   => time(),
                    );
                    if(!isset($temp[$newK])){
                        array_push($add_data, $newArr); //新key数据插入数据库
                    }else{
                        if ($v != $temp[$newK]) {
                            $table_db->where([
                                'name'  => $newK,
                            ])->save($newArr);//缓存key存在且值有变更新此项
                        }
                    }
                }
                if (!empty($add_data)) {
                    $table_db->insertAll($add_data);
                }
                //更新后的数据库记录
                $newRes = $table_db->where([
                    'inc_type'  => $param[0],
                ])->select();
                foreach ($newRes as $rs){
                    $newData[$rs['name']] = $rs['value'];
                }
            }else{
                if ($param[0] != 'all') {
                    foreach($data as $k=>$v){
                        $newK = strtolower($k);
                        $newArr[] = array(
                            'name'=>$newK,
                            'value'=>trim($v),
                            'inc_type'=>$param[0],
                            'update_time'   => time(),
                        );
                    }
                    $table_db->insertAll($newArr);
                }
                $newData = $data;
            }

            $result = false;
            $res = $table_db->where([
            ])->select();
            if($res){
                $global = array();
                foreach($res as $k=>$val){
                    $global[$val['name']] = $val['value'];
                }
                $result = cache($tableName.'all',$global,$options);
            }
            if ($param[0] != 'all') {
                $result = cache($cache_inc_type,$newData,$options);
            }

            return $result;
        }
    }
}
if (!function_exists('number2chinese')){
    /*
     * 将数字转化为汉字数字
     * $num        需要转换的数字
     * $mode       true转化为金额，false转化为数字
     *$sim         true简单汉字，false大写汉字
     */
    function number2chinese($num,$mode = false,$sim = true){
        if(!is_numeric($num)) return $num;  //含有非数字字符
        $char    = $sim ? array('零','一','二','三','四','五','六','七','八','九')
            : array('零','壹','贰','叁','肆','伍','陆','柒','捌','玖');
        $unit    = $sim ? array('','十','百','千','','万','亿','兆')
            : array('','拾','佰','仟','','萬','億','兆');
        //小数部分
        if(strpos($num, '.')){
            $retval  = $mode ? '元':'点';
            list($num,$dec) = explode('.', $num);
            $dec = strval(round($dec,2));
            if($mode){
                $retval .= "{$char[$dec['0']]}角{$char[$dec['1']]}分";
            }else{
                for($i = 0,$c = strlen($dec);$i < $c;$i++) {
                    $retval .= $char[$dec[$i]];
                }
            }
        }
        //整数部分
        $str = $mode ? strrev(intval($num)) : strrev($num);
        for($i = 0,$c = strlen($str);$i < $c;$i++) {
            $out[$i] = $char[$str[$i]];
            if($mode){
                $out[$i] .= $str[$i] != '0'? $unit[$i%4] : '';
                if($i>1 and $str[$i]+$str[$i-1] == 0){
                    $out[$i] = '';
                }
                if($i%4 == 0){
                    $out[$i] .= $unit[4+floor($i/4)];
                }
            }
        }
        $retval = join('',array_reverse($out)) . $retval;
        return $retval;
    }
}
if (!function_exists('remove_xss')) {
    //使用htmlpurifier防范xss攻击
    function remove_xss($string){
        //相对index.php入口文件，引入HTMLPurifier.auto.php核心文件
        require_once './vendor/purifier/HTMLPurifier.auto.php';
        // 生成配置对象
        $cfg = HTMLPurifier_Config::createDefault();
        // 以下就是配置：
        $cfg -> set('Core.Encoding', 'UTF-8');
        // 设置允许使用的HTML标签
        $cfg -> set('HTML.Allowed','div,b,strong,i,em,a[href|title],ul,ol,li,br,p[style],span[style],img[width|height|alt|src]');
        // 设置允许出现的CSS样式属性
        $cfg -> set('CSS.AllowedProperties', 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align');
        // 设置a标签上是否允许使用target="_blank"
        $cfg -> set('HTML.TargetBlank', TRUE);
        // 使用配置生成过滤用的对象
        $obj = new HTMLPurifier($cfg);
        // 过滤字符串
        return $obj -> purify($string);
    }
}
if ( ! function_exists('getChanneltypeList'))
{
    /**
     * 获取全部的模型
     */
    function getChanneltypeList()
    {
        $result = extra_cache('admin_channeltype_list_logic');
        if ($result == false)
        {
            $result = model('Channeltype')->getAll('*', array(), 'id');
            extra_cache('admin_channeltype_list_logic', $result);
        }

        return $result;
    }
}

if (!function_exists('get_qiuzu_price_list')){
    function get_qiuzu_price_list()
    {
        $list = config("qiuzu.price");
        return $list;
    }
}

if (!function_exists('get_qiuzu_area_list')){
    function get_qiuzu_area_list()
    {
        $list = config("qiuzu.area");
        return $list;
    }
}
if(!function_exists('get_route_field_list')){
    /*
     * 获取所有route值
     *$group      是否需要根据频道分组
     */
    function get_route_field_list($group = ''){
        $result = extra_cache('global_get_route_field_list');
        if (empty($result)) {
            $route_list = config('route');
            $list = \think\Db::name("channelfield")->field("channel_id,name,short_name")->where("is_screening=1 and channel_id>0")->order("name asc")->select();
            $result = $list_group = [];
            foreach ($list as $val){
                $list_group[$val['channel_id']][] = $val;
            }
            foreach ($list_group as $key=>$val){
                $temp = $temp_result = [];
                $count = count($val);
                foreach ($val as $v){
                    if (empty($v['short_name']) || (!empty($route_list['schema']) && $route_list['schema'] == 3)){
                        $temp[] =  '<'.$v['name'].'>';
                    }else{
                        $temp[] = $v['short_name'].'_<'.$v['name'].'>';
                    }
                }
                for ($i=1;$i<$count+1;$i++){
                    $temp_result = array_merge($temp_result,getCombinationToString($temp,$i));  //合并数据
                }
//                for ($i=$count;$i>0;$i--){
//                    $temp_result = array_merge($temp_result,getCombinationToString($temp,$i));  //合并数据
//                }
                if ($group){
                    $result[$key] = $temp_result;
                }else{
                    $result = array_unique(array_merge($result,$temp_result));    //合并数据
                }
            }
            extra_cache('global_get_route_field_list', $result);
        }

        return $result;
    }
}
if(!function_exists('getCombinationToString')){
    /*
     * 获取数组中任意个数元素的集合
     * $arr     原数组
     * $m       个数
     * $middle  中间分隔符
     */
    function getCombinationToString($arr,$m,$middle='-')
    {
        $result = array();
        if ($m == 1) {
            return $arr;
        }
        if ($m == count($arr)) {//当取出的个数等于数组的长度，就是只有一种组合，即本身
            $result[] = implode($middle, $arr);
            return $result;
        }
        $temp_firstelement = $arr[0];
        unset($arr[0]);
        $arr = array_values($arr);
        $temp_first1 = getCombinationToString($arr, $m - 1);
        foreach ($temp_first1 as $s) {
            $s = $temp_firstelement . $middle . $s;
            $result[] = $s;
        }
        unset($temp_first1);
        $temp_first2 = getCombinationToString($arr, $m);
        foreach ($temp_first2 as $s) {
            $result[] = $s;
        }
        unset($temp_first2);
        return $result;
    }
}

















