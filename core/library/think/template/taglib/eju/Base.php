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

namespace think\template\taglib\eju;

use think\Config;
use think\Cookie;

/**
 * 基类
 */
class Base
{
    /**
     * 子目录
     */
    public $root_dir = '';

    /**
     * 是否手机端
     */
    public $isMobile = 0;

    public static $request = null;

    //构造函数
    function __construct()
    {
        // 控制器初始化
        $this->_initialize();
    }

    // 初始化
    protected function _initialize()
    {
        // 子目录安装路径
        $this->root_dir = ROOT_DIR;

        // 是否手机端
        $this->isMobile = isMobile() ? 1 : 0;

        null === $this->request && $this->request = request();
    }

    /**
     * 在typeid传值为目录名称的情况下，获取栏目ID
     */
    public function getTrueTypeid($typeid = '')
    {
        /*tid为目录名称的情况下*/
        if (!empty($typeid) && strval($typeid) != strval(intval($typeid))) {
            $typeid = M('Arctype')->where([
                    'dirname'   => $typeid,
                ])->cache(true,EYOUCMS_CACHE_TIME,"arctype")
                ->getField('id');
        }
        /*--end*/

        return intval($typeid);
    }
}