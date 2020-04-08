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
use think\Controller;
use app\common\controller\Common;
use think\Db;
use think\Request;
use app\home\logic\FieldLogic;

class Base extends Common {

    public $fieldLogic;

    /**
     * 初始化操作
     */
    public function _initialize() {
        parent::_initialize();

        $this->fieldLogic = new FieldLogic();
        
        // 设置URL模式
        set_home_url_mode();
    }

    /**
     * 301重定向到新的伪静态格式（针对被搜索引擎收录的旧伪静态URL）
     * @param intval $id 栏目ID/文档ID
     * @param string $dirname 目录名称
     * @param string $type 栏目页/文档页
     * @return void
     */
    public function jumpRewriteFormat($id, $dirname = null, $type = 'lists')
    {
        $seo_pseudo = config('ey_config.seo_pseudo');
        $seo_rewrite_format = config('ey_config.seo_rewrite_format');
        if (3 == $seo_pseudo && 1 == $seo_rewrite_format) {
            if ('lists' == $type) {
                $url = typeurl('home/Lists/index', array('dirname'=>$dirname));
            } else {
                $url = arcurl('home/View/index', array('dirname'=>$dirname, 'aid'=>$id));
            }
            //重定向到指定的URL地址 并且使用301
            $this->redirect($url, 301);
        }
    }
    /**
     * 获取登录的会员最新数据
     */
    protected function GetUsersLatestData($users_id = null) {
        $users_id = empty($users_id) ? session('users_id') : $users_id;
        if(!empty($users_id)) {
            $data =  Db::name('users')->field('b.*,a.*,a.id as users_id')
                ->alias('a')
                ->join('__USERS_LEVEL__ b', "a.level_id = b.id", 'LEFT')
                ->where([
                    'a.id'  => $users_id,
                ])
                ->find();
            empty($data['nickname']) && $data['nickname'] = $data['username'];
//            $data['username'] = $data['nickname'];
            empty($data['litpic']) && $data['litpic'] = ROOT_DIR . '/public/static/common/images/dfboy.png';

            return $data;
        }else{
            // session中不存在会员ID则返回空
            return false;
        }
    }
}