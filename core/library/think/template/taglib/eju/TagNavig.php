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

use think\Db;
use think\Request;

/**
 * 菜单列表
 */
class TagNavig extends Base
{
    public $tid = '';
    public $currentstyle = '';
    public $position_id = '';

    //初始化
    protected function _initialize()
    {
        parent::_initialize();
        $this->tid = I("param.tid/s", ''); // 应用于菜单列表
        /*应用于文档列表*/
        $aid = I('param.aid/d', 0);
        if ($aid > 0) {
            $cacheKey = 'tagNavig_'.strtolower('home_'.CONTROLLER_NAME.'_'.ACTION_NAME);
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
     * 获取指定级别的菜单列表
     * @param string type son表示下一级菜单,self表示同级菜单,top顶级菜单
     * @param boolean $self 包括自己本身
     * @author wengxianhu by 2018-4-26
     */
    public function getNavig($position_id = '', $navigid = '', $type = 'top', $currentstyle = '', $notnavigid = '')
    {
        $this->currentstyle = $currentstyle;
        $this->position_id = intval($position_id);
        $navigid  = !empty($navigid) ? $navigid : $this->tid;

        if (empty($navigid)) {
            /*应用于没有指定tid的列表，默认获取该控制器下的第一级菜单ID*/
            // http://demo.ejucms.com/index.php/home/Article/lists.html
            $map = array(
                'position_id'   => $this->position_id,
                'parent_id' => 0,
                'status'    => 1,
            );
            $navigid = M('navig_list')->where($map)->order('sort_order asc')->limit(1)->getField('navig_id');
            /*--end*/
        }

        $result = $this->getSwitchType($navigid, $type, $notnavigid);

        return $result;
    }

    /**
     * 获取指定级别的菜单列表
     * @param string type son表示下一级菜单,self表示同级菜单,top顶级菜单
     * @param boolean $self 包括自己本身
     * @author wengxianhu by 2018-4-26
     */
    public function getSwitchType($navigid = '', $type = 'top', $notnavigid = '')
    {
        $result = array();
        switch ($type) {
            case 'son': // 下级菜单
                $result = $this->getSon($navigid, false);
                break;

            case 'self': // 同级菜单
                $result = $this->getSelf($navigid);
                break;

            case 'top': // 顶级菜单
                $result = $this->getTop($notnavigid);
                break;

            case 'sonself': // 下级、同级菜单
                $result = $this->getSon($navigid, true);
                break;

            case 'first': // 第一级菜单
                $result = $this->getFirst($navigid);
                break;
        }

        return $result;
    }

    /**
     * 获取下一级菜单
     * @param string $self true表示没有子菜单时，获取同级菜单
     * @author wengxianhu by 2017-7-26
     */
    public function getSon($typeid, $self = false)
    {
        $result = array();
        if (empty($typeid)) {
            return $result;
        }

        $arctype_max_level = intval(config('global.arctype_max_level')); // 菜单最多级别
        /*获取所有显示且有效的菜单列表*/
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
                }else if($val['pointto_id'] && !empty($res[$val['pointto_id']])){       //指向其他菜单
                    $ctl_name = $ctl_name_list[$res[$val['pointto_id']]['current_channel']]['ctl_name'];
                    $val['typeurl'] = typeurl('home/'.$ctl_name."/lists", $res[$val['pointto_id']]);
                } else {
                    $ctl_name = $ctl_name_list[$val['current_channel']]['ctl_name'];
                    $val['typeurl'] = typeurl('home/'.$ctl_name."/lists", $val);
                }
                /*--end*/

                /*标记菜单被选中效果*/
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

        /*菜单层级归类成阶梯式*/
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

        /*取得指定菜单ID对应的阶梯式所有子孙等菜单*/
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

        /*没有子菜单时，获取同级菜单*/
        if (empty($result) && $self == true) {
            $result = $this->getSelf($typeid);
        }
        /*--end*/

        return $result;
    }

    /**
     * 获取当前菜单的第一级菜单下的子菜单
     * @author wengxianhu by 2017-7-26
     */
    public function getFirst($typeid)
    {
        $result = array();
        if (empty($typeid)) {
            return $result;
        }

        $row = model('Arctype')->getAllPid($typeid); // 当前菜单往上一级级父菜单
        if (!empty($row)) {
            reset($row); // 重置排序
            $firstResult = current($row); // 顶级菜单下的第一级父菜单
            $typeid = isset($firstResult['id']) ? $firstResult['id'] : '';
            $sonRow = $this->getSon($typeid, false); // 获取第一级菜单下的子孙菜单，为空时不获得同级菜单
            $result = $sonRow;
        }

        return $result;
    }

    /**
     * 获取同级菜单
     * @author wengxianhu by 2017-7-26
     */
    public function getSelf($typeid)
    {
        $result = array();
        if (empty($typeid)) {
            return $result;
        }

        /*获取指定菜单ID的上一级菜单ID列表*/
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

        /*获取上一级菜单ID对应下的子孙菜单*/
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
     * 获取顶级菜单
     * @author wengxianhu by 2017-7-26
     */
    public function getTop($notnavigid = '')
    {
        $result = array();

        /*获取所有菜单*/
        $navigLogic = new \app\common\logic\NavigationLogic();
        $navig_max_level = intval(config('global.navig_max_level'));
        $map = array(
            'position_id'   => $this->position_id,
            'is_del'    => 0,
            'status'    => 1,
        );
        !empty($notnavigid) && $map['navig_id'] = ['NOTIN', $notnavigid]; // 排除指定菜单ID
        $res = $navigLogic->navig_list(0, 0, false, $navig_max_level, $map);
        /*--end*/

        if (count($res) > 0) {
            // $topTypeid = $this->getTopTypeid($this->tid);
            // $ctl_name_list = model('Channeltype')->getAll('id,ctl_name', array(), 'id');
            // $currentstyleArr = [
            //     'tid'   => 0,
            //     'currentstyle'  => '',
            //     'grade' => 100,
            //     'is_part'   => 0,
            // ]; // 标记选择菜单的数组
            // $pageurl = $this->request->url(true);
            // $controller = $this->request->controller();
            // $module = $this->request->module();
            foreach ($res as $key => $val) {
                /*获取菜单的URL*/
                if ('web_cmsurl' == $val['navig_url'] && 'index' == $Action) {
                    // $result[$key]['class'] = ' cur';
                    $val['navig_url'] = $this->GetNavigUrl($val['navig_url']);
                } else if (empty($val['arctype_sync']) && empty($val['type_id'])) {
                    $val['navig_url'] = $this->GetNavigUrl($val['navig_url']);
                    // if (!empty($Action) && $Action == $val['navig_url']) $result[$key]['class'] = ' cur';
                } else if (!empty($this->tid) && $this->tid == $val['type_id']) {
                    // $result[$key]['class'] = ' cur';
                }
                /*--end*/

                /*标记菜单被选中效果*/
                // $val['currentstyle'] = '';
                // $typelink = htmlspecialchars_decode($val['typelink']);

                // $is_currentstyle = false;
                // if ($val['id'] == $topTypeid || (!empty($typelink) && stristr($pageurl, $typelink))) {
                //     $is_currentstyle = false;
                //     if ($topTypeid != $this->tid && 0 == $currentstyleArr['is_part'] && $val['grade'] <= $currentstyleArr['grade']) { // 当前菜单不是顶级菜单，按外部链接优先
                //         $is_currentstyle = true;
                //     }
                //     else if ($topTypeid == $this->tid && $val['grade'] < $currentstyleArr['grade'])
                //     { // 当前菜单是顶级菜单，按顺序优先
                //         $is_currentstyle = true;
                //     }
                // }else if(!empty($val['is_part']) && $val['current_channel'] == -1 && $controller == 'Ask' && $module=='home'){   //问答专属
                //     $is_currentstyle = true;
                // }
                // if ($is_currentstyle) {
                //     $currentstyleArr = [
                //         'tid'   => $val['id'],
                //         'currentstyle'  => $this->currentstyle,
                //         'grade' => $val['grade'],
                //         'is_part'   => $val['is_part'],
                //     ];
                // }
                /*--end*/

                // 导航图片
                $val['navig_pic'] = handle_subdir_pic($val['navig_pic']);

                $res[$key] = $val;
            }

            // 循环处理选中菜单的标识
            // foreach ($res as $key => $val) {
            //     if (!empty($currentstyleArr) && $val['id'] == $currentstyleArr['tid']) {
            //         $val['currentstyle'] = $currentstyleArr['currentstyle'];
            //     }
            //     $res[$key] = $val;
            // }

            /*菜单层级归类成阶梯式*/
            $arr = group_same_key($res, 'parent_id');
            for ($i=0; $i < $navig_max_level; $i++) { 
                foreach ($arr as $key => $val) {
                    foreach ($arr[$key] as $key2 => $val2) {
                        if (!isset($arr[$val2['navig_id']])) continue;
                        $val2['children'] = $arr[$val2['navig_id']];
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
     * 获取最顶级父菜单ID
     */
    public function getTopTypeid($typeid)
    {
        $topTypeId = 0;
        if ($typeid > 0) {
            $result = model('Arctype')->getAllPid($typeid); // 当前菜单往上一级级父菜单
            reset($result); // 重置数组
            /*获取最顶级父菜单ID*/
            $firstVal = current($result);
            $topTypeId = $firstVal['id'];
            /*--end*/
        }

        return intval($topTypeId);
    }

    // 获取URL
    public function GetNavigUrl($navig_url)
    {
        $ReturnData = [
            'web_cmsurl' => "/",
            'map_index' => url('home/Map/index'),
            'map_ershou' => url('home/Map/ershou'),
            'map_zufang' => url('home/Map/zufang'),
            'map_xiaoqu' => url('home/Map/xiaoqu'),
            // 'ask_index' => url('home/Ask/index'),
            // 'ask_index' => url('home/Ask/index', [], true, false, 1, 1, 0),
        ];

        return $ReturnData[$navig_url];
    }
}