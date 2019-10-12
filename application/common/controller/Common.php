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

namespace app\common\controller;
use think\Controller;
use think\Session;
use think\Db;
class Common extends Controller {

    public $session_id;
    public $theme_style = '';
    public $view_suffix = 'html';
    public $eju = array();

    public $globalTpCache = array();

    /**
     * 析构函数
     */
    function __construct() 
    {
        /*是否隐藏或显示应用入口index.php*/
        if (tpCache('seo.seo_inlet') == 0) {
            \think\Url::root('/index.php');
        }
        /*--end*/
        parent::__construct();
    }    
    
    /*
     * 初始化操作
     */
    public function _initialize() 
    {
        session('admin_info'); // 传后台信息到前台，此处可视化用到
        if (!session_id()) {
            Session::start();
        }
        header("Cache-control: private");  // history.back返回后输入框值丢失问题 
        $this->session_id = session_id(); // 当前的 session_id
        !defined('SESSION_ID') && define('SESSION_ID', $this->session_id); //将当前的session_id保存为常量，供其它方法调用

        $this->globalTpCache = tpCache('global');

        /*关闭网站*/
        if (empty($this->globalTpCache['web_status'])) {
            die("<div style='text-align:center; font-size:20px; font-weight:bold; margin:50px 0px;'>网站暂时关闭，维护中……</div>");
        }
        /*--end*/

        $this->global_assign($this->globalTpCache); // 获取网站全局变量值
        $this->view_suffix = config('template.view_suffix'); // 模板后缀htm
        $this->theme_style = THEME_STYLE; // 模板目录
        //全局变量
        $this->eju['global'] = $this->globalTpCache;
        // 请求参数
        $this->eju['param'] = $this->request->param();
        // 区域子站点
        $subDomain = input("subdomain/s");
        empty($subDomain) && $subDomain = $this->request->subDomain();
        if (empty($this->eju['global']['web_region_domain'])) {
            $regionInfo = $this->getDefaultCity();
            // $tableFiels = M('region')->getTableFields();
            // foreach ($tableFiels as $key => $val) {
            //     $regionInfo[$val] = '';
            // }
        } else {
            if (!empty($subDomain)){
                $regionInfo =  $this->getDomainCity($subDomain);
            }else{
                $regionInfo =  $this->getDefaultCity();
            }
        }
        \think\Cookie::set("regionInfo",  $regionInfo);
        $this->eju['region'] = $regionInfo;
        /*电脑版与手机版的切换*/
        $v = I('param.v/s', 'pc');
        $v = trim($v, '/');
        $this->assign('v', $v);
        /*--end*/
    }

    /**
     * 获取系统内置变量 
     */
    public function global_assign($globalTpCache = [])
    {
        $this->assign('global', $globalTpCache);
    }

    //根据domain获取区域信息
    private function getDomainCity($subDomain = ''){
        $info = [];
        if(!empty($subDomain) && $subDomain != 'www'){
            $info =  M('region')->field('*')->where(['domain'=>$subDomain,'status'=>1])->find();
            $info = model('Region')->handle_info($info, false);
        }
        if (empty($info)){
            $info = $this->getDefaultCity();
        }

        return $info;
    }

    /**
     * @return array|null|\PDOStatement|string|\think\Model
     * 读取第一个默认城市
     */
    private function getDefaultCity()
    {
        $info =  M('region')->field('*')->where(['is_default'=>1])->find(); //默认城市
        $info = model('Region')->handle_info($info, false);

        return $info;
    }
}