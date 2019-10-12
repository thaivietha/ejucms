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

class Sitemap extends Base
{
    public function _initialize() {
        parent::_initialize();
    }

    /**
     * 生成相应的搜索引擎sitemap
     */
    public function index($ver = 'xml')
    {
        if (empty($ver)) {
            sitemap_all();
        } else {
            $fun_name = 'sitemap_'.$ver;
            $fun_name();
        }
    }
}
