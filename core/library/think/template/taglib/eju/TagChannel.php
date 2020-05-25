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

use think\Request;
use think\Db;
/**
 * 栏目列表
 */
class TagChannel extends Base
{
    public $tid = '';
    public $currentstyle = '';
    private $hidden_arr = [];

    //初始化
    protected function _initialize()
    {
        parent::_initialize();
        $this->tid = I("param.tid/s", ''); // 应用于栏目列表
        /*应用于文档列表*/
        $aid = I('param.aid/d', 0);
        if ($aid > 0) {
            $cacheKey = 'tagChannel_'.strtolower('home_'.CONTROLLER_NAME.'_'.ACTION_NAME);
            $cacheKey .= "_{$aid}";
            $this->tid = cache($cacheKey);
            if ($this->tid == false) {
                $this->tid = M('archives')->where('aid', $aid)->getField('typeid');
                cache($cacheKey, $this->tid);
            }
        }
        /*--end*/
        /*tid为目录名称的情况下*/
        $this->tid = $this->getTrueTypeid($this->tid);
        /*--end*/
    }

    /**
     * 获取指定级别的栏目列表
     * @param string type son表示下一级栏目,self表示同级栏目,top顶级栏目
     * @param boolean $self 包括自己本身
     * @author wengxianhu by 2018-4-26
     */
    public function getChannel($typeid = '', $type = 'top', $currentstyle = '', $notypeid = '', $hidden = '')
    {
        $this->currentstyle = $currentstyle;
        $typeid  = !empty($typeid) ? $typeid : $this->tid;
        if (empty($typeid)) {
            /*应用于没有指定tid的列表，默认获取该控制器下的第一级栏目ID*/
            // http://demo.ejucms.com/index.php/home/Article/lists.html
            if ($hidden == 'on'){
                $map = array(
                    'parent_id' => 0,
                    'is_hidden' => 1,
                    'status'    => 1,
                );
            }else if($hidden == 'off'){
                $map = array(
                    'parent_id' => 0,
                    'status'    => 1,
                );
            }else{

                $map = array(
                    'parent_id' => 0,
                    'is_hidden' => 0,
                    'status'    => 1,
                );
            }
            $controller_name = request()->controller();
            if (!empty($controller_name)){
                $channeltype_info = model('Channeltype')->getInfoByWhere(array('ctl_name'=>$controller_name), 'id');
                if (!empty($channeltype_info['id'])){
                    $channeltype = $channeltype_info['id'];
                    $map['channeltype'] = $channeltype;
                }
            }
            $typeid = Db::name('arctype')->where($map)->order('sort_order asc')->limit(1)->getField('id');
            /*--end*/
        }

        $result = $this->getSwitchType($typeid, $type, $notypeid, $hidden);

        return $result;
    }

    /**
     * 获取指定级别的栏目列表
     * @param string type son表示下一级栏目,self表示同级栏目,top顶级栏目
     * @param boolean $self 包括自己本身
     * @author wengxianhu by 2018-4-26
     */
    public function getSwitchType($typeid = '', $type = 'top', $notypeid = '', $hidden = '')
    {
        $result = array();
        switch ($type) {
            case 'son': // 下级栏目
                $result = $this->getSon($typeid, false);
                break;

            case 'self': // 同级栏目
                $result = $this->getSelf($typeid);
                break;

            case 'top': // 顶级栏目
                $result = $this->getTop($notypeid, $hidden);
                break;

            case 'sonself': // 下级、同级栏目
                $result = $this->getSon($typeid, true);
                break;

            case 'first': // 第一级栏目
                $result = $this->getFirst($typeid);
                break;
        }

        /*处理自定义表字段的值*/
        if (!empty($result)) {
            /*获取自定义表字段信息*/
            $map = array(
                'channel_id'    => config('global.arctype_channel_id'),
            );
            $fieldInfo = model('Channelfield')->getListByWhere($map, '*', 'name');
            /*--end*/
            $fieldLogic = new \app\home\logic\FieldLogic;
            foreach ($result as $key => $val) {
                if (!empty($val)) {
                    $val = $fieldLogic->handleAddonFieldList($val, $fieldInfo);
                    $result[$key] = $val;
                }
            }
        }
        /*--end*/

        return $result;
    }
    /*
     * 获取所有隐藏栏目列表
     * param int 是否获取所有下级  true,false
     */
    public function getHiddenChannel($currentstyle = '',$next = true){
        $this->currentstyle = $currentstyle;
        $map = array(
            'is_hidden'   => 1,
            'status'  => 1,
            'is_del'    => 0,
        );
        $arr = db('arctype')->where($map)->getAllWithIndex("id");//select();

        if (!$arr){
            return false;
        }
        $this->hidden_arr = $arr;
        if ($next){
            $this->getNext(get_arr_column($arr,'id'));
        }
        if ($this->hidden_arr) {
            $pointto_id_arr = [];
            $pointto_arr = [];
            foreach ($this->hidden_arr as $key => $val){
                if ($val['pointto_id']){
                    $pointto_id_arr[] = $val['pointto_id'];
                }
                if (!empty($pointto_id_arr)){
                    $map = array(
                        'id'   => ['in'=>$pointto_id_arr],
                        'status'  => 1,
                        'is_del'    => 0,
                    );
                    $pointto_arr = db('arctype')->where($map)->getAllWithIndex("id");
                }
            }
            $ctl_name_list = model('Channeltype')->getAll('id,ctl_name', array(), 'id');
            foreach ($this->hidden_arr as $key => $val) {
                /*获取指定路由模式下的URL*/
                if ($val['is_part'] == 1) {     //外部链接
                    $val['typeurl'] = $val['typelink'];
                }else if($val['pointto_id'] && !empty($pointto_arr[$val['pointto_id']])){     //指向其他栏目
                    $ctl_name = $ctl_name_list[$pointto_arr[$val['pointto_id']]['current_channel']]['ctl_name'];
                    $val['typeurl'] = typeurl('home/'.$ctl_name."/lists", $pointto_arr[$val['pointto_id']]);
                } else {
                    $ctl_name = $ctl_name_list[$val['current_channel']]['ctl_name'];
                    $val['typeurl'] = typeurl('home/'.$ctl_name."/lists", $val);
                }
                /*--end*/
                /*标记栏目被选中效果*/
                if ($val['id'] == $this->tid) {
                    $val['currentstyle'] = $this->currentstyle;
                } else {
                    $val['currentstyle'] = '';
                }
                /*--end*/
                // 封面图
                $val['litpic'] = handle_subdir_pic($val['litpic']);
                $this->hidden_arr[$key] = $val;
            }
        }

        return $this->hidden_arr;
    }
    /*
     * 获取所有下级栏目id
     */

    private function getNext($id_arr){
        $map = array(
            'status'  => 1,
            'is_del'    => 0,
        );
        $map['parent_id'] = array('in',$id_arr);
        $arr = db('arctype')->where($map)->getAllWithIndex("id");
        if ($arr){
            $this->hidden_arr = $this->hidden_arr + $arr;//array_merge($this->hidden_arr,$arr);
            $this->getNext(get_arr_column($arr,'id'));
        }
    }
    /**
     * 获取下一级栏目
     * @param string $self true表示没有子栏目时，获取同级栏目
     * @author wengxianhu by 2017-7-26
     */
    public function getSon($typeid, $self = false)
    {
        $result = array();
        if (empty($typeid)) {
            return $result;
        }
        $arctype_max_level = intval(config('global.arctype_max_level')); // 栏目最多级别
        /*获取所有显示且有效的栏目列表*/
        $map = array(
            'c.is_hidden'   => 0,
            'c.status'  => 1,
            'c.is_del'    => 0, // 回收站功能
        );
        $fields = "c.*, c.id as typeid, count(s.id) as has_children, '' as children";
        $res = db('arctype')
            ->field($fields)
            ->alias('c')
            ->join('__ARCTYPE__ s','s.parent_id = c.id','LEFT')
            ->where($map)
            ->group('c.id')
            ->order('c.parent_id asc, c.sort_order asc, c.id')
            ->cache(true,EYOUCMS_CACHE_TIME,"arctype")
            ->select();
        $res = convert_arr_key($res,'id');

        /*--end*/
        if ($res) {
            $ctl_name_list = model('Channeltype')->getAll('id,ctl_name', array(), 'id');

            foreach ($res as $key => $val) {
                /*获取指定路由模式下的URL*/
                if ($val['is_part'] == 1) {  //获取外部链接
                    $val['typeurl'] = $val['typelink'];
                    if (!is_http_url($val['typeurl'])) {
                        $typeurl = '//'.request()->host();
                        if (!preg_match('#^'.ROOT_DIR.'(.*)$#i', $val['typeurl'])) {
                            $typeurl .= ROOT_DIR;
                        }
                        $typeurl .= '/'.trim($val['typeurl'], '/');
                        $val['typeurl'] = $typeurl;
                    }
                }else if($val['pointto_id'] && !empty($res[$val['pointto_id']])){       //指向其他栏目
                    $ctl_name = $ctl_name_list[$res[$val['pointto_id']]['current_channel']]['ctl_name'];
                    $val['typeurl'] = typeurl('home/'.$ctl_name."/lists", $res[$val['pointto_id']]);
                } else {
                    $ctl_name = $ctl_name_list[$val['current_channel']]['ctl_name'];
                    $val['typeurl'] = typeurl('home/'.$ctl_name."/lists", $val);
                }
                /*--end*/

                /*标记栏目被选中效果*/
                if ($val['id'] == $typeid || $val['id'] == $this->tid) {
                    $val['currentstyle'] = $this->currentstyle;
                } else {
                    $val['currentstyle'] = '';
                }
                /*--end*/

                // 封面图
                $val['litpic'] = handle_subdir_pic($val['litpic']);

                $res[$key] = $val;
            }

        }
        /*栏目层级归类成阶梯式*/
        $arr = group_same_key($res, 'parent_id');
        for ($i=0; $i < $arctype_max_level; $i++) {
            foreach ($arr as $key => $val) {
                foreach ($arr[$key] as $key2 => $val2) {
                    if (!isset($arr[$val2['id']])) continue;
                    $val2['children'] = $arr[$val2['id']];
                    $arr[$key][$key2] = $val2;
                }
            }
        }
        /*--end*/

        /*取得指定栏目ID对应的阶梯式所有子孙等栏目*/
        $result = array();
        $typeidArr = explode(',', $typeid);
        foreach ($typeidArr as $key => $val) {
            if (!isset($arr[$val])) continue;
            if (is_array($arr[$val])) {
                foreach ($arr[$val] as $key2 => $val2) {
                    array_push($result, $val2);
                }
            } else {
                array_push($result, $arr[$val]);
            }
        }
        /*--end*/

        /*没有子栏目时，获取同级栏目*/
        if (empty($result) && $self == true) {
            $result = $this->getSelf($typeid);
        }
        /*--end*/

        return $result;
    }

    /**
     * 获取当前栏目的第一级栏目下的子栏目
     * @author wengxianhu by 2017-7-26
     */
    public function getFirst($typeid)
    {
        $result = array();
        if (empty($typeid)) {
            return $result;
        }

        $row = model('Arctype')->getAllPid($typeid); // 当前栏目往上一级级父栏目
        if (!empty($row)) {
            reset($row); // 重置排序
            $firstResult = current($row); // 顶级栏目下的第一级父栏目
            $typeid = isset($firstResult['id']) ? $firstResult['id'] : '';
            $sonRow = $this->getSon($typeid, false); // 获取第一级栏目下的子孙栏目，为空时不获得同级栏目
            $result = $sonRow;
        }

        return $result;
    }

    /**
     * 获取同级栏目
     * @author wengxianhu by 2017-7-26
     */
    public function getSelf($typeid)
    {
        $result = array();
        if (empty($typeid)) {
            return $result;
        }

        /*获取指定栏目ID的上一级栏目ID列表*/
        $map = array(
            'id'   => array('in', $typeid),
            'is_hidden'   => 0,
            'status'  => 1,
            'is_del'    => 0, // 回收站功能
        );
        $res = M('arctype')->field('parent_id')
            ->where($map)
            ->group('parent_id')
            ->select();
        /*--end*/

        /*获取上一级栏目ID对应下的子孙栏目*/
        if ($res) {
            $typeidArr = get_arr_column($res, 'parent_id');
            $typeid = implode(',', $typeidArr);
            if ($typeid == 0) {
                $result = $this->getTop();
            } else {
                $result = $this->getSon($typeid, false);
            }
        }
        /*--end*/

        return $result;
    }

    /**
     * 获取顶级栏目
     * @author wengxianhu by 2017-7-26
     */
    public function getTop($notypeid = '', $hidden = '')
    {
        $result = array();

        /*获取所有栏目*/
        $arctypeLogic = new \app\common\logic\ArctypeLogic();
        $arctype_max_level = intval(config('global.arctype_max_level'));
        if ($hidden == 'on'){
            $map = array(
                'is_hidden' => 1,
                'is_del'    => 0,
                'status'    => 1,
            );
        }else if($hidden == 'off'){
            $map = array(
                'is_del'    => 0,
                'status'    => 1,
            );
        }else{
            $map = array(
                'is_hidden' => 0,
                'is_del'    => 0,
                'status'    => 1,
            );
        }
        !empty($notypeid) && $map['id'] = ['NOTIN', $notypeid]; // 排除指定栏目ID
        $res = $arctypeLogic->arctype_list(0, 0, false, $arctype_max_level, $map);
        /*--end*/

        if (count($res) > 0) {
            $topTypeid = $this->getTopTypeid($this->tid);
            $ctl_name_list = model('Channeltype')->getAll('id,ctl_name', array(), 'id');
            $currentstyleArr = [
                'tid'   => 0,
                'currentstyle'  => '',
                'grade' => 100,
                'is_part'   => 0,
            ]; // 标记选择栏目的数组
            $pageurl = request()->url(true);
            $controller = request()->controller();
            $module = request()->module();
            foreach ($res as $key => $val) {
                /*获取指定路由模式下的URL*/
                if ($val['is_part'] == 1) {     //外部链接
                    $val['typeurl'] = $val['typelink'];
                    if (!is_http_url($val['typeurl'])) {
                        $typeurl = '//'.request()->host();
                        if (!preg_match('#^'.ROOT_DIR.'(.*)$#i', $val['typeurl'])) {
                            $typeurl .= ROOT_DIR;
                        }
                        $typeurl .= '/'.trim($val['typeurl'], '/');
                        $val['typeurl'] = $typeurl;
                    }
                }else if($val['pointto_id'] && !empty($res[$val['pointto_id']])){   //指向其他栏目
                    $ctl_name = $ctl_name_list[$res[$val['pointto_id']]['current_channel']]['ctl_name'];
                    $val['typeurl'] = typeurl('home/'.$ctl_name."/lists", $res[$val['pointto_id']]);
                } else {
                    $ctl_name = $ctl_name_list[$val['current_channel']]['ctl_name'];
                    $val['typeurl'] = typeurl('home/'.$ctl_name."/lists", $val);
                }
                /*--end*/

                /*标记栏目被选中效果*/
                $val['currentstyle'] = '';
                $typelink = htmlspecialchars_decode($val['typelink']);

                $is_currentstyle = false;
                if ($val['id'] == $topTypeid || (!empty($typelink) && stristr($pageurl, $typelink))) {
                    $is_currentstyle = false;
                    if ($topTypeid != $this->tid && 0 == $currentstyleArr['is_part'] && $val['grade'] <= $currentstyleArr['grade']) { // 当前栏目不是顶级栏目，按外部链接优先
                        $is_currentstyle = true;
                    }
                    else if ($topTypeid == $this->tid && $val['grade'] < $currentstyleArr['grade'])
                    { // 当前栏目是顶级栏目，按顺序优先
                        $is_currentstyle = true;
                    }
                }else if(!empty($val['is_part']) && $val['current_channel'] == -1 && $controller == 'Ask' && $module=='home'){   //问答专属
                    $is_currentstyle = true;
                }
                if ($is_currentstyle) {
                    $currentstyleArr = [
                        'tid'   => $val['id'],
                        'currentstyle'  => $this->currentstyle,
                        'grade' => $val['grade'],
                        'is_part'   => $val['is_part'],
                    ];
                }
                /*--end*/

                // 封面图
                $val['litpic'] = handle_subdir_pic($val['litpic']);

                $res[$key] = $val;
            }

            // 循环处理选中栏目的标识
            foreach ($res as $key => $val) {
                if (!empty($currentstyleArr) && $val['id'] == $currentstyleArr['tid']) {
                    $val['currentstyle'] = $currentstyleArr['currentstyle'];
                }
                $res[$key] = $val;
            }

            /*栏目层级归类成阶梯式*/
            $arr = group_same_key($res, 'parent_id');
            for ($i=0; $i < $arctype_max_level; $i++) { 
                foreach ($arr as $key => $val) {
                    foreach ($arr[$key] as $key2 => $val2) {
                        if (!isset($arr[$val2['id']])) continue;
                        $val2['children'] = $arr[$val2['id']];
                        $arr[$key][$key2] = $val2;
                    }
                }
            }
            /*--end*/

            reset($arr);  // 重置数组
            /*获取第一个数组*/
            $firstResult = current($arr);
            $result = $firstResult;
            /*--end*/
        }

        return $result;
    }

    /**
     * 获取最顶级父栏目ID
     */
    public function getTopTypeid($typeid)
    {
        $topTypeId = 0;
        if ($typeid > 0) {
            $result = model('Arctype')->getAllPid($typeid); // 当前栏目往上一级级父栏目
            reset($result); // 重置数组
            /*获取最顶级父栏目ID*/
            $firstVal = current($result);
            $topTypeId = $firstVal['id'];
            /*--end*/
        }

        return intval($topTypeId);
    }
}