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

use app\home\logic\FieldLogic;

/**
 * 文档基本信息
 */
class TagArcview extends Base
{
    public $aid = '';
    public $tid = '';
    public $fieldLogic;
    
    //初始化
    protected function _initialize()
    {
        parent::_initialize();
        $this->fieldLogic = new FieldLogic();
        /*应用于文档列表*/
        $this->aid = I('param.aid/d', 0);
        $this->tid = I('param.tid/d', 0);
        /*--end*/
    }

    /**
     * 获取栏目基本信息
     * @author wengxianhu by 2018-4-20
     */
    public function getArcview($aid = '', $addfields = '', $tag = '')
    {
        $aid = !empty($aid) ? $aid : $this->aid;

        if (empty($aid)) {
            if (empty($this->tid)) { // 在内容页才提示
                echo '标签arcview报错：缺少属性 aid 值，或文档ID不存在。';
            }
            return false;
        }

        /*文档信息*/
        $result = M("archives")->field('b.*, a.*')
            ->alias('a')
            ->join('__ARCTYPE__ b', 'b.id = a.typeid', 'LEFT')
            ->find($aid);
        if (empty($result)) {
            echo '标签arcview报错：该文档ID('.$aid.')不存在。';
            return false;
        }
        /*--end*/
        $result['litpic'] = get_default_pic($result['litpic']); // 默认封面图

        // 获取查询的控制器名
        $channelInfo = model('Channeltype')->getInfo($result['channel']);
        $controller_name = $channelInfo['ctl_name'];
        $channeltype_table = $channelInfo['table'];

        /*栏目链接*/
        if ($result['is_part'] == 1) {
            $result['typeurl'] = $result['typelink'];
        } else {
            $result['typeurl'] = typeurl('home/'.$controller_name."/lists", $result);
        }
        /*--end*/

        /*文档链接*/
        if ($result['is_jump'] == 1) {
            $result['arcurl'] = $result['jumplinks'];
        } else {
            $result['arcurl'] = arcurl('home/'.$controller_name.'/view', $result);
        }
        /*--end*/

        if (9 == $result['channel']) {
            $row = M('xinfang_system')->field('id,aid,add_time,update_time', true)->where('aid',$aid)->find();
            !empty($row) && $result = array_merge($result, $row);
        }

        /*附加表*/
        if (!empty($addfields)) {
            $addfields = str_replace('，', ',', $addfields); // 替换中文逗号
            $addfieldsArr = explode(',', $addfields);
            $arr = [];
            foreach ($addfieldsArr as $key => $val) {
                $val = trim($val);
                if (empty($val)) {
                    continue;
                }
                array_push($arr, 'a.'.$val);
            }
            $addfields = implode(',', $arr);
            $tableContent = $channeltype_table.'_content';
            $row = M($tableContent)->alias('a')->field($addfields)->where('a.aid',$aid)->find();
            if (is_array($row)) {
                $result = array_merge($result, $row);
            } else {
                $saveData = [
                    'aid'           => $aid,
                    'add_time'      => getTime(),
                    'update_time'   => getTime(),
                ];
                M($tableContent)->save($saveData);
            }
            $result = $this->fieldLogic->getChannelFieldList($result, $result['channel']); // 自定义字段的数据格式处理
        }
        /*--end*/

        $result = view_logic($aid, $result['channel'], $result, true, $tag);
        //小区隐藏不显示
        if ($channeltype_table == 'xiaoqu'){
            $ishoutai = M('xiaoqu_system')->where(['aid'=>$aid,'is_houtai'=>1])->find();
            if (empty($ishoutai)){
                unset($result['arcurl']);
            }
        }
        return $result;
    }
}