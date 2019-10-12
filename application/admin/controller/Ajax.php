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
        $list = model('form_list')->where("is_read=0 and is_del=0")->find();
        if (empty($list)){
            $this->error();
        }
        $this->success();
    }
}