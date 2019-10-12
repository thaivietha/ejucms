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

namespace app\home\controller;

class Index extends Base
{
    public function _initialize() {
        parent::_initialize();

        /*首页焦点*/
        $m = input('param.m/s');
        if (empty($m)) {
            $this->request->get(['m'=>'Index']);
        }
        /*end*/
    }

    /*
     * 提交信息
     */
    public function ajax_form(){
        return $this->fetch(":system/ajax_form");
    }

    public function index()
    {
        $filename = 'index.html';

        // 生成静态页面代码 - PC端动态访问跳转到静态
        $seo_pseudo = config('ey_config.seo_pseudo');
        if (file_exists($filename) && 2 == $seo_pseudo) {
            if ((isMobile() && !file_exists("./template/{$this->tpl_theme}/mobile")) || !isMobile()) {
                header('HTTP/1.1 301 Moved Permanently');
                header('Location:index.html');
                exit;
            }
        }

        /*获取当前页面URL*/
        $result['pageurl'] = $this->request->url(true);
        /*--end*/
        $eju = array(
            'field' => $result,
        );
        $this->eju = array_merge($this->eju, $eju);
        $this->assign('eju', $this->eju);

        $html = $this->fetch(":index");
        
        return $html;
    }
}