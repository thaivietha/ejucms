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
use app\admin\logic\UpgradeLogic;
use think\Controller;
use think\Db;
use think\response\Json;
use think\Session;
use app\common\logic\ArctypeLogic;
class Base extends Controller {

    public $session_id;

    /**
     * 析构函数
     */
    function __construct() 
    {
        if (!session_id()) {
            Session::start();
        }
        header("Cache-control: private");  // history.back返回后输入框值丢失问题
        parent::__construct();

        $this->global_assign();
    }
    
    /*
     * 初始化操作
     */
    public function _initialize() 
    {
        $this->session_id = session_id(); // 当前的 session_id
        !defined('SESSION_ID') && define('SESSION_ID', $this->session_id); //将当前的session_id保存为常量，供其它方法调用

        parent::_initialize();
        //过滤不需要登陆的行为
        $ctl_act = CONTROLLER_NAME.'@'.ACTION_NAME;
        $ctl_all = CONTROLLER_NAME.'@*';
        $filter_login_action = config('filter_login_action');
        if (in_array($ctl_act, $filter_login_action) || in_array($ctl_all, $filter_login_action)) {
            //return;
        }else{
            $admin_login_expire = session('admin_login_expire'); // 登录有效期
            if (session('?admin_id') && getTime() - intval($admin_login_expire) < config('login_expire')) {
                session('admin_login_expire', getTime()); // 登录有效期
                $this->check_priv();//检查管理员菜单操作权限
            }else{
                /*自动退出*/
                adminLog('自动退出');
                session_unset();
                session::clear();
                /*--end*/
                $url = $this->request->baseFile().'?s=Admin/login';
                $this->redirect($url);
            }
        }

        /* 增、改的跳转提示页，只限制于发布文档的模型和自定义模型 */
        $channeltype_list = config('global.channeltype_list');
        $controller_name = $this->request->controller();
        $channel = input('param.channel/d');
        if (isset($channeltype_list[strtolower($controller_name)]) || 'Custom' == $controller_name) {
            if (in_array($this->request->action(), ['add','edit'])) {
                $id = input('param.id/d', input('param.aid/d'));
                'GET' == $this->request->method() && cookie('ENV_IS_UPHTML', 0);
            } else if (in_array($this->request->action(), ['index'])) {
                $url = $this->request->url();
                if (stristr($url, '&a=index') && !stristr($url,'&openurl')) {
                    cookie('ENV_GOBACK_URL', $url);
                }
                cookie('ENV_LIST_URL', url($controller_name.'/index', ['channel'=>$channel]));
            }
        }
        if ('Archives' == $controller_name && in_array($this->request->action(), ['index_archives'])) {
            $url = $this->request->url();
            if (stristr($url, '&a=index_archives')) {
                cookie('ENV_GOBACK_URL', $url);
            }
            cookie('ENV_LIST_URL', url('Archives/index_archives', ['channel'=>$channel]));
        }
        /* end */
    }
    
    public function check_priv()
    {
        $ctl = CONTROLLER_NAME;
        $act = ACTION_NAME;
        $ctl_act = $ctl.'@'.$act;
        $bool = is_check_access($ctl_act);
        //检查是否拥有此操作权限
        if (!$bool) {
            $this->error('您没有操作权限，请联系超级管理员分配权限！');
        }
    }


    /**
     * 保存系统设置 
     */
    public function global_assign()
    {
        $this->assign('global', tpCache('global'));
    }
}