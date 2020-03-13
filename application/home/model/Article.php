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

namespace app\home\model;

use think\Model;
use think\Page;
use think\Db;
use app\home\logic\FieldLogic;

/**
 * 文章
 */
class Article extends Model
{
    //初始化
    protected function initialize()
    {
        // 需要调用`Model`的`initialize`方法
        parent::initialize();
    }

    /**
     * 获取单条记录
     * @author wengxianhu by 2017-7-26
     */
    public function getInfo($aid, $field = '', $isshowbody = true)
    {
        $data = array();
        if (!empty($field)) {
            $field_arr = explode(',', $field);
            foreach ($field_arr as $key => $val) {
                $val = trim($val);
                if (preg_match('/^([a-z]+)\./i', $val) == 0) {
                    array_push($data, 'a.'.$val);
                } else {
                    array_push($data, $val);
                }
            }
            $field = implode(',', $data);
        }

        $result = array();
        if ($isshowbody) {
            $field = !empty($field) ? $field : 'b.*, a.*';
            $result = db('archives')->field($field)
                ->alias('a')
                ->join('__ARTICLE_CONTENT__ b', 'b.aid = a.aid', 'LEFT')
                ->find($aid);
        } else {
            $field = !empty($field) ? $field : 'a.*';
            $result = db('archives')->field($field)
                ->alias('a')
                ->find($aid);
        }

        // 文章TAG标签
        if (!empty($result)) {
            $typeid = isset($result['typeid']) ? $result['typeid'] : 0;
            $tags = model('Taglist')->getListByAid($aid, $typeid);
            $result['tags'] = $tags;
        }
        //关联模型信息
        $channelList = getChanneltypeList();
        $channelOrigin = $channelList[$result['channel']];  //本模型channel信息
        $channelJoin = $channelList[$channelOrigin['join_id']];   //关联channel信息
        if (!empty($result['joinaid']) && !empty($channelJoin)){
            $join = model($channelJoin['ctl_name'])->getInfo($result['joinaid'],'',true);
            $join = view_logic($result['joinaid'], $channelJoin['id'], $join, true, [ 'huxing' => 'off','photo' => 'off','price' => 'off'],$channelJoin['ctl_name']); // 模型对应逻辑
            /*自定义字段的数据格式处理*/
            $fieldLogic = new FieldLogic();
            $join = $fieldLogic->getChannelFieldList($join, $channelJoin['id']);
            $result['join'] = $result['xinfang'] = get_xinfang_info($result['joinaid'],$join);
        }

        return $result;
    }
}