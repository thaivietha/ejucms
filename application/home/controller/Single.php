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

class Single extends Base
{
    // 模型标识
    public $nid = 'single';
    // 模型ID
    public $channeltype = '';
    
    public function _initialize() {
        parent::_initialize();
        $channeltype_list = config('global.channeltype_list');
        $this->channeltype = $channeltype_list[$this->nid];
    }

    public function lists($tid)
    {
        $tid_tmp = $tid;
        $seo_pseudo = config('ey_config.seo_pseudo');
        if (empty($tid)) {
            $map = array(
                'channeltype'   => $this->channeltype,
                'parent_id' => array('eq', 0),
                'is_hidden' => 0,
                'status'    => 1,
            );
            $res = M('arctype')->where($map)->order('sort_order asc')->limit(1)->find();
            $typeurl = model('Arctype')->getTypeUrl($res);
            header('Location: '.$typeurl);
            exit;
        } else {
            if (3 == $seo_pseudo) {
                $map = array('dirname'=>$tid);
            } else {
                if (!is_numeric($tid) || strval(intval($tid)) !== strval($tid)) {
                    abort(404,'页面不存在');
                }
                $map = array('id'=>$tid);
            }
            $row = M('arctype')->field('id,dirname')->where($map)->order('sort_order asc')->limit(1)->find();
            $tid = !empty($row['id']) ? intval($row['id']) : 0;
            $dirname = !empty($row['dirname']) ? $row['dirname'] : '';
            /*301重定向到新的伪静态格式*/
            $this->jumpRewriteFormat($tid, $dirname, 'lists');
            /*--end*/

            if (3 == $seo_pseudo) {
                $tid = $dirname;
            } else {
                $tid = $tid_tmp;
            }
        }

        return action('home/Lists/index', $tid);
    }
}