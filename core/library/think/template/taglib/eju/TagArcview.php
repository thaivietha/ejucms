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
use think\Db;
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
    public function getArcview($aid = '',$fields = '', $addfields = '', $tag = '')
    {
        $aid = !empty($aid) ? $aid : $this->aid;

        if (empty($aid)) {
            if (empty($this->tid)) { // 在内容页才提示
//                echo '标签arcview报错：缺少属性 aid 值，或文档ID不存在。';
            }
            return false;
        }
        /*文档信息*/
        if (!empty($fields) && empty($addfields)){
            $result = Db::name("archives")->field($fields)->find($aid);
        }else{
            $result = Db::name("archives")->field("c.ctl_name,c.table,b.*, a.*")
                ->alias('a')
                ->join('__ARCTYPE__ b', 'b.id = a.typeid', 'LEFT')
                ->join('channeltype c','c.id = a.channel', 'LEFT')
                ->find($aid);
        }


        if (empty($result)) {
//            echo '标签arcview报错：该文档ID('.$aid.')不存在。';
            return false;
        }
        /*--end*/
        $result['litpic'] = !empty($result['litpic']) ? get_default_pic($result['litpic']):""; // 默认封面图
        // 获取查询的控制器名
//        $channelInfo = model('Channeltype')->getInfo($result['channel']);
        $controller_name = !empty($result['ctl_name']) ? $result['ctl_name'] : '';
        $channeltype_table =  !empty($result['table']) ? $result['table'] : '';

        /*栏目链接*/
        if (!empty($result['is_part']) && $result['is_part'] == 1) {
            $result['typeurl'] = $result['typelink'];
        } else if (!empty($controller_name)){
            $result['typeurl'] = typeurl('home/'.$controller_name."/lists", $result);
        }
        /*--end*/
        /*文档链接*/
        if (!empty($result['is_jump']) && $result['is_jump'] == 1) {
            $result['arcurl'] = $result['jumplinks'];
        } else if (!empty($controller_name)){
            $result['arcurl'] = arcurl('home/'.$controller_name.'/view', $result);
        }
        /*--end*/
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
                array_push($arr, $val);
            }
            $addfields = implode(',', $arr);
            $tableContent = $channeltype_table.'_content';
            $model = Db::name($tableContent)->field($addfields)->alias('a');
            $systemArr = ['Xinfang','Xiaoqu','Ershou','Zufang','Shopcs','Shopcz','Officecs','Officecz','Qiuzu'];
            if (in_array($controller_name,$systemArr)){
                $tableSystem = $channeltype_table.'_system';
                $model = $model->join("{$tableSystem} b",'b.aid = a.aid', 'LEFT');
            }
            $row = $model->where('a.aid',$aid)->find();
            if (is_array($row)) {
                $result = array_merge($result, $row);
            }
            $result = $this->fieldLogic->getChannelFieldList($result, $result['channel']); // 自定义字段的数据格式处理
        }
        /*--end*/
        $result = view_logic($aid, $controller_name, $result, false, $tag);
        if (empty($result['add_type'])){    //主动添加，由会员中心添加自动产生的小区（非后台添加）不能出现链接
            unset($result['arcurl']);
        }

        return $result;
    }
}