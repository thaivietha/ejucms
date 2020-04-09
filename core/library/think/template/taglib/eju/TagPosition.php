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


/**
 * 栏目位置
 */
class TagPosition extends Base
{
    public $tid = '';

    //初始化
    protected function _initialize()
    {
        parent::_initialize();
        $this->tid = input("param.tid/s", ''); // 应用于栏目列表
        /*应用于文档列表*/
        $aid = input('param.aid/d', 0);
        if ($aid > 0) {
            $this->tid = M('archives')->where('aid', $aid)->getField('typeid');
        }

        /*--end*/
        /*tid为目录名称的情况下*/
        $this->tid = $this->getTrueTypeid($this->tid);
        /*--end*/
    }

    /**
     * 获取面包屑位置
     * @author wengxianhu by 2018-4-20
     */
    public function getPosition($typeid = '', $symbol = '', $style = 'crumb')
    {
        $typeid = !empty($typeid) ? $typeid : $this->tid;

        $basicConfig = tpCache('basic');
        $basic_indexname = !empty($basicConfig['basic_indexname']) ? $basicConfig['basic_indexname'] : '首页';
        $symbol = !empty($symbol) ? $symbol : $basicConfig['list_symbol'];

        /*首页链接*/
        $home_url = $this->root_dir.'/'; // 支持子目录
        // $symbol = htmlspecialchars_decode($symbol);
        $str = "<a href='{$home_url}' class='{$style}'>{$basic_indexname}</a>";
        $result = model('Arctype')->getAllPid($typeid);
        $i = 1;
        foreach ($result as $key => $val) {
            if ($i < count($result)) {
                $str .= " {$symbol} <a href='{$val['typeurl']}' class='{$style}'>{$val['typename']}</a>";
            } else {
                $str .= " {$symbol} <a href='{$val['typeurl']}'>{$val['typename']}</a>";
            }
            ++$i;
        }

        return $str;
    }
}