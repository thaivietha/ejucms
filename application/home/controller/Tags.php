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

class Tags extends Base
{
    public function _initialize() {
        parent::_initialize();
    }

    /**
     * 标签主页
     */
    public function index()
    {
        /*获取当前页面URL*/
        $result['pageurl'] = $this->request->url(true);
        /*--end*/
        $eju = array(
            'field' => $result,
        );
        $this->eju = array_merge($this->eju, $eju);
        $this->assign('eju', $this->eju);
        
        /*模板文件*/
        $viewfile = 'index_tags';
        /*--end*/

        return $this->fetch(":{$viewfile}");
    }

    /**
     * 标签列表
     */
    public function lists()
    {
        $param = I('param.');
        
        $tagid = isset($param['tagid']) ? $param['tagid'] : '';
        $tag = isset($param['tag']) ? trim($param['tag']) : '';
        if (!empty($tag)) {
            $tagindexInfo = M('tagindex')->where([
                    'tag'   => $tag,
                ])->find();
        } elseif (intval($tagid) > 0) {
            $tagindexInfo = M('tagindex')->where([
                    'id'   => $tagid,
                ])->find();
        }

        if (!empty($tagindexInfo)) {
            $tagid = $tagindexInfo['id'];
            $tag = $tagindexInfo['tag'];
            //更新浏览量和记录数
            $map = array(
                'tid'   => array('eq', $tagid),
                'arcrank'   => array('gt', -1),
            );
            $total = M('taglist')->where($map)
                ->count('tid');
            M('tagindex')->where([
                    'id'    => $tagid,
                ])->inc('count')
                ->inc('weekcc')
                ->inc('monthcc')
                ->update(array('total'=>$total));

            $ntime = getTime();
            $oneday = 24 * 3600;

            //周统计
            if(ceil( ($ntime - $tagindexInfo['weekup'])/$oneday ) > 7)
            {
                M('tagindex')->where([
                        'id'    => $tagid,
                    ])->update(array('weekcc'=>0, 'weekup'=>$ntime));
            }

            //月统计
            if(ceil( ($ntime - $tagindexInfo['monthup'])/$oneday ) > 30)
            {
                M('tagindex')->where([
                        'id'    => $tagid,
                    ])->update(array('monthcc'=>0, 'monthup'=>$ntime));
            }
        }

        $field_data = array(
            'tag'   => $tag,
            'tagid'   => $tagid,
        );
        $eju = array(
            'field'  => $field_data,
        );
        $this->eju = array_merge($this->eju, $eju);
        $this->assign('eju', $this->eju);

        /*模板文件*/
        $viewfile = 'lists_tags';
        /*--end*/

        return $this->fetch(":{$viewfile}");
    }
}