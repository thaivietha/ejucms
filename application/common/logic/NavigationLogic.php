<?php
/**
 * 易居CMS
 * ============================================================================
 * 版权所有 2018-2028 海南易而优科技有限公司，并保留所有权利。
 * 网站地址: http://www.ejucms.com
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 易而优团队 by 陈风任 <491085389@qq.com>
 * Date: 2018-4-3
 */

namespace app\common\logic;

use think\Model;
use think\Db;
/**
 * 栏目逻辑定义
 * @package common\Logic
 */
class NavigationLogic extends Model
{
    /**
     * 检测是否有子菜单
     * @author wengxianhu by 2017-7-26
     */
    public function hasChildren($id)
    {
        if (is_array($id)) {
            $ids = array_unique($id);
            $row = Db::name('navig_list')->field('parent_id, count(navig_) AS total')->where(['parent_id'=>['IN', $ids]])->group('parent_id')->getAllWithIndex('parent_id');
            return $row;
        } else {
            $count = Db::name('navig_list')->where('parent_id', $id)->count('navig_id');
            return ($count > 0 ? 1 : 0);
        }
    }

    /**
     * 全部栏目
     */
    public function GetAllArctype($type_id = 0)
    {
        $where = [
            'current_channel'   => ['egt', 0],
            'is_del' => 0,
            'status' => 1
        ];
        $field = 'id, parent_id, typename, dirname, litpic';
        // 查询所有可投稿的栏目
        $ArcTypeData = Db::name('arctype')->field($field)->where($where)->select();
        // 读取上级ID并去重读取上级栏目
        $ParentIds = array_unique(get_arr_column($ArcTypeData, 'parent_id'));
        if (!empty($ParentIds)){
            $ParentIds = implode(',',$ParentIds);
            $PidData = Db::name('arctype')->field($field)->where("current_channel>0 and is_del=0 and status = 1 and (id in ($ParentIds) or parent_id=0)")->select();
        }else{
            $where['parent_id'] = 0;
            $PidData = Db::name('arctype')->field($field)->where($where)->select();
        }
//        $PidData = Db::name('arctype')->field($field)->where('id', 'IN', $ParentIds)->select();
//        // 处理顶级栏目
//        $PidDataNew = [];
//        foreach ($ArcTypeData as $key => $value) {
//            if (empty($value['parent_id'])) {
//                array_push($PidDataNew, $value);
//            }
//        }
//        $PidData = array_merge($PidData, $PidDataNew);

        // 合并顶级栏目
        static $seo_pseudo = null;
        if (null === $seo_pseudo) {
            $seoConfig = tpCache('seo');
            $seo_pseudo = !empty($seoConfig['seo_pseudo']) ? $seoConfig['seo_pseudo'] : config('ey_config.seo_pseudo');
        }
        // 下拉框拼装
        $HtmlCode = '<select name="type_id" id="type_id" lay-filter="type_id">';
        $HtmlCode .= '<option id="arctype_default" value="0">请选择栏目</option>';
        foreach ($PidData as $yik => $yiv) {
            /*栏目路径*/
            if (2 == $seo_pseudo) {
                // 生成静态
                $typeurl = ROOT_DIR . "/index.php?m=home&c=Lists&a=index&tid={$yiv['id']}";
            } else {
                // 动态或伪静态
                $typeurl = typeurl("home/Lists/index", $yiv, true, '', $seo_pseudo, null);
                $typeurl = auto_hide_index($typeurl);
            }
            /* END */
            /*是否选中*/
            $style1 = $type_id == $yiv['id'] ? 'selected' : '';
            /* END */
            if (0 == $yiv['parent_id']) {
                /*一级下拉框*/
                $HtmlCode .= '<option value="'.$yiv['id'].'" data-typeurl="'.$typeurl.'" data-typename="'.$yiv['typename'].'" '.$style1.'>'.$yiv['typename'].'</option>';
                /* END */
                $type = 0;
            } else {
                /*二级下拉框*/
                $HtmlCode .= '<option value="'.$yiv['id'].'" data-typeurl="'.$typeurl.'" data-typename="'.$yiv['typename'].'" '.$style1.'>&nbsp; &nbsp;'.$yiv['typename'].'</option>';
                /* END */
                $type = 1;
            }

            foreach ($ArcTypeData as $erk => $erv) {
                /*栏目路径*/
                if (2 == $seo_pseudo) {
                    // 生成静态
                    $typeurl = ROOT_DIR . "/index.php?m=home&c=Lists&a=index&tid={$erv['id']}";
                } else {
                    // 动态或伪静态
                    $typeurl = typeurl("home/Lists/index", $erv, true, '', $seo_pseudo, null);
                    $typeurl = auto_hide_index($typeurl);
                }
                /* END */

                if ($erv['parent_id'] == $yiv['id']) {
                    if (0 == $type) {
                        /*是否选中*/
                        $style1 = $type_id == $erv['id'] ? 'selected' : '';
                        /* END */
                        /*二级下拉框*/
                        $HtmlCode .= '<option value="'.$erv['id'].'" data-typeurl="'.$typeurl.'" data-typename="'.$erv['typename'].'" '.$style1.'>&nbsp; &nbsp;'.$erv['typename'].'</option>';
                        /* END */
                    } else {
                        /*三级下拉框*/
                        $HtmlCode .= '<option value="'.$erv['id'].'" data-typeurl="'.$typeurl.'" data-typename="'.$erv['typename'].'">&nbsp; &nbsp; &nbsp; &nbsp;'.$erv['typename'].'</option>';
                        /* END */
                    }
                }
            }
        }
        $HtmlCode .= '</select>';
        return $HtmlCode;
    }

    // 前台功能列表
    public function ForegroundFunction()
    {
        return [
            [
                'title' => '首页',
                'code'   => 'home_Index_index',
                'url'   => '/',
            ],
            [
                'title' => '问答',
                'code'   => 'home_Ask_index',
                'url'   => url('home/Ask/index'),
            ],
            [
                'title' => '地图找房',
                'code'   => 'home_Map_index',
                'url'   => url('home/Map/index'),
            ],
            [
                'title' => '地图找小区',
                'code'   => 'home_Map_xiaoqu',
                'url'   => url('home/Map/xiaoqu'),
            ],
            [
                'title' => '地图找二手房',
                'code'   => 'home_Map_ershou',
                'url'   => url('home/Map/ershou'),
            ],
            [
                'title' => '地图找租房',
                'code'   => 'home_Map_zufang',
                'url'   => url('home/Map/zufang'),
            ],

            [
                'title' => '地图找商铺出售',
                'code'   => 'home_Map_shopcs',
                'url'   => url('home/Map/shopcs'),
            ],
            [
                'title' => '地图找商铺出租',
                'code'   => 'home_Map_shopcz',
                'url'   => url('home/Map/shopcz'),
            ],
            [
                'title' => '地图找写字楼出售',
                'code'   => 'home_Map_officecs',
                'url'   => url('home/Map/officecs'),
            ],
            [
                'title' => '地图找写字楼出租',
                'code'   => 'home_Map_officecz',
                'url'   => url('home/Map/officecz'),
            ],
            [
                'title' => '房贷计算器',
                'code'   => 'home_Tool_jisuanqi',
                'url'   => url('home/Tool/jisuanqi'),
            ],
            [
                'title' => '会员中心',
                'code'   => 'user_Users_centre',
                'url'   => url('user/Users/centre'),
            ],
        ];
    }

    /**
     * 获取指定父级的子菜单
     * @param  integer $parent_id 父级ID
     * @return array
     */
    public function getNavigList($position_id, $parent_id = 0)
    {
        $row = Db::name('navig_list')->where(['position_id'=>$position_id,'parent_id'=>$parent_id,'is_del'=>0])->select();

        return $row;
    }

    /**
     * 获得指定菜单下的子菜单的数组
     *
     * @access  public
     * @param   int     $id     菜单的ID
     * @param   int     $selected   当前选中菜单的ID
     * @param   boolean $re_type    返回的类型: 值为真时返回下拉列表,否则返回数组
     * @param   int     $level      限定返回的级数。为0时返回所有级数
     * @param   array   $map      查询条件
     * @return  mix
     */
    public function navig_list($id = 0, $selected = 0, $re_type = true, $level = 0, $map = array(), $is_cache = true)
    {
        static $res = NULL;

        if ($res === NULL)
        {
            $where = array(
                'is_del' => 0,
            );
            if (!empty($map)) {
                $where = array_merge($where, $map);
            }
            foreach ($where as $key => $val) {
                $key_tmp = 'c.'.$key;
                $where[$key_tmp] = $val;
                unset($where[$key]);
            }

            $fields = "c.*, count(s.navig_id) as has_children, '' as children";
            $res = DB::name('navig_list')
                ->field($fields)
                ->alias('c')
                ->join('__NAVIG_LIST__ s','s.parent_id = c.navig_id','LEFT')
                ->where($where)
                ->group('c.navig_id')
                ->order('c.parent_id asc, c.sort_order asc, c.navig_id')
                ->cache($is_cache,EYOUCMS_CACHE_TIME,"navig_list")
                ->select();
            $res = convert_arr_key($res,'navig_id');
        }

        if (empty($res) == true)
        {
            $res = NULL;
            return $re_type ? '' : array();
        }
        $options = $this->navig_options($id, $res); // 获得指定菜单下的子菜单的数组
        /* 截取到指定的缩减级别 */
        if ($level > 0)
        {
            if ($id == 0)
            {
                $end_level = $level;
            }
            else
            {
                $first_item = reset($options); // 获取第一个元素
                $end_level  = $first_item['level'] + $level;
            }

            /* 保留level小于end_level的部分 */
            foreach ($options AS $key => $val)
            {
                if ($val['level'] >= $end_level)
                {
                    unset($options[$key]);
                }
            }
        }

        $pre_key = 0;
        foreach ($options AS $key => $value)
        {
            $options[$key]['has_children'] = 0;
            if ($pre_key > 0)
            {
                if ($options[$pre_key]['navig_id'] == $options[$key]['parent_id'])
                {
                    $options[$pre_key]['has_children'] = 1;
                }
            }
            $pre_key = $key;
        }

        if ($re_type == true)
        {
            $select = '';
            foreach ($options AS $var)
            {
                $select .= '<option value="' . $var['navig_id'] . '" ';
                $select .= ($selected == $var['navig_id']) ? "selected='true'" : '';
                $select .= '>';
                if ($var['level'] > 0)
                {
                    $select .= str_repeat('&nbsp;', $var['level'] * 4);
                }
                $select .= htmlspecialchars(addslashes($var['navig_name'])) . '</option>';
            }
            $res = NULL;
            return $select;
        }
        else
        {
            $res = NULL;
            return $options;
        }
    }

    /**
     * 过滤和排序所有文章菜单，返回一个带有缩进级别的数组
     *
     * @access  private
     * @param   int     $id     上级菜单ID
     * @param   array   $arr        含有所有菜单的数组
     * @param   int     $level      级别
     * @return  void
     */
    public function navig_options($spec_id, $arr)
    {
        static $cat_options = array();

        // $cat_options = array();

        if (isset($cat_options[$spec_id]))
        {
            $cat_options = array();
            return $cat_options[$spec_id];
        }

        if (!isset($cat_options[0]))
        {
            $level = $last_id = 0;
            $options = $id_array = $level_array = array();
            while (!empty($arr))
            {
                foreach ($arr AS $key => $value)
                {
                    $id = $value['navig_id'];
                    if ($level == 0 && $last_id == 0)
                    {
                        if ($value['parent_id'] > 0)
                        {
                            break;
                        }

                        $options[$id]          = $value;
                        $options[$id]['level'] = $level;
                        $options[$id]['navig_id']    = $id;
                        $options[$id]['navig_name']  = $value['navig_name'];
                        unset($arr[$key]);

                        if ($value['has_children'] == 0)
                        {
                            continue;
                        }
                        $last_id  = $id;
                        $id_array = array($id);
                        $level_array[$last_id] = ++$level;
                        continue;
                    }

                    if ($value['parent_id'] == $last_id)
                    {
                        $options[$id]          = $value;
                        $options[$id]['level'] = $level;
                        $options[$id]['navig_name']    = $id;
                        $options[$id]['navig_name']  = $value['navig_name'];
                        unset($arr[$key]);

                        if ($value['has_children'] > 0)
                        {
                            if (end($id_array) != $last_id)
                            {
                                $id_array[] = $last_id;
                            }
                            $last_id    = $id;
                            $id_array[] = $id;
                            $level_array[$last_id] = ++$level;
                        }
                    }
                    elseif ($value['parent_id'] > $last_id)
                    {
                        break;
                    }
                }

                $count = count($id_array);
                if ($count > 1)
                {
                    $last_id = array_pop($id_array);
                }
                elseif ($count == 1)
                {
                    if ($last_id != end($id_array))
                    {
                        $last_id = end($id_array);
                    }
                    else
                    {
                        $level = 0;
                        $last_id = 0;
                        $id_array = array();
                        continue;
                    }
                }

                if ($last_id && isset($level_array[$last_id]))
                {
                    $level = $level_array[$last_id];
                }
                else
                {
                    $level = 0;
                    break;
                }
            }
            $cat_options[0] = $options;
        }
        else
        {
            $options = $cat_options[0];
        }

        if (!$spec_id)
        {
            $cat_options = array();
            return $options;
        }
        else
        {
            if (empty($options[$spec_id]))
            {
                $cat_options = array();
                return array();
            }

            $spec_id_level = $options[$spec_id]['level'];

            foreach ($options AS $key => $value)
            {
                if ($key != $spec_id)
                {
                    unset($options[$key]);
                }
                else
                {
                    break;
                }
            }

            $spec_id_array = array();
            foreach ($options AS $key => $value)
            {
                if (($spec_id_level == $value['level'] && $value['navig_id'] != $spec_id) ||
                    ($spec_id_level > $value['level']))
                {
                    break;
                }
                else
                {
                    $spec_id_array[$key] = $value;
                }
            }
            $cat_options[$spec_id] = $spec_id_array;

            $cat_options = array();
            return $spec_id_array;
        }
    }
}