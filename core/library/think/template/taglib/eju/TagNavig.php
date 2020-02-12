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
use app\common\logic\NavigationLogic;

/**
 * 菜单列表
 */
class TagNavig extends Base
{
    public $tid = '';
    public $navigid = ''; // 当前URL对应的导航菜单ID
    public $topNavigid = ''; // 当前URL对应的顶级导航菜单ID
    public $currentstyle = '';
    public $position_id = '';

    //初始化
    protected function _initialize()
    {
        parent::_initialize();
        $this->navigationlogic = new NavigationLogic();
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

        // 获取当前URL的导航菜单ID、顶级菜单ID
        $navidData = $this->getTopidOrNavigid($this->tid);
        $this->navigid = !empty($navidData['navigid']) ? $navidData['navigid'] : 0;
        $this->topNavigid = !empty($navidData['topNavigid']) ? $navidData['topNavigid'] : 0;
    }

    /**
     * 获取指定级别的菜单列表
     * @param string type son表示下一级菜单,self表示同级菜单,top顶级菜单
     * @param boolean $self 包括自己本身
     * @author wengxianhu by 2018-4-26
     */
    public function getNavig($position_id = '', $navigid = '', $type = '', $currentstyle = '', $notnavigid = '')
    {
        $type = !empty($type) ? $type : 'top';
        $this->currentstyle = $currentstyle;
        $this->position_id = intval($position_id);
        $navigid  = !empty($navigid) ? $navigid : $this->navigid;

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
    public function getSon($navigid, $self = false)
    {
        $result = array();
        if (empty($navigid)) {
            return $result;
        }

        $navig_max_level = intval(config('global.navig_max_level')); // 菜单最多级别
        /*获取所有显示且有效的菜单列表*/
        $map = array(
            'c.position_id'   => $this->position_id,
            'c.status'  => 1,
            'c.is_del'    => 0, // 回收站功能
        );
        $fields = "c.*, count(s.navig_id) as has_children, '' as children";
        $res = db('navig_list')
            ->field($fields)
            ->alias('c')
            ->join('__NAVIG_LIST__ s','s.parent_id = c.navig_id','LEFT')
            ->where($map)
            ->group('c.navig_id')
            ->order('c.parent_id asc, c.sort_order asc, c.navig_id')
            ->cache(true,EYOUCMS_CACHE_TIME,"navig_list")
            ->select();
        $res = convert_arr_key($res,'navig_id');
        /*--end*/
        if ($res) {

            // 菜单对应的所有栏目信息
            $typeids = [];
            foreach ($res as $key => $val) {
                if (!empty($val['type_id'])) {
                    array_push($typeids, intval($val['type_id']));
                }
                if (!empty($val['pointto_id'])) {
                    array_push($typeids, intval($val['pointto_id']));
                }
            }
            $typeids = array_unique($typeids);
            $arctypeRow = Db::name('arctype')->field('id,typename,dirname,current_channel,is_part,typelink')->where(['id'=>['IN', $typeids]])->cache(true,EYOUCMS_CACHE_TIME,"arctype")->getAllWithIndex('id');
            $ctl_name_list = model('Channeltype')->getAll('id,ctl_name', array(), 'id');
            foreach ($res as $key => $val) {

                $arctypeInfo = !empty($arctypeRow[$val['type_id']]) ? $arctypeRow[$val['type_id']] : [];

                /*获取菜单的URL*/
                if (!empty($val['type_id'])) {
                    if ($arctypeInfo['is_part'] == 1) {     //外部链接
                        $val['navig_url'] = $arctypeInfo['typelink'];
                        if (!is_http_url($val['navig_url'])) {
                            $navig_url = '//'.$this->request->host();
                            if (!preg_match('#^'.ROOT_DIR.'(.*)$#i', $val['navig_url'])) {
                                $navig_url .= ROOT_DIR;
                            }
                            $navig_url .= '/'.trim($val['navig_url'], '/');
                            $val['navig_url'] = $navig_url;
                        }
                    } else {
                        if (!empty($arctypeInfo['pointto_id'])) {
                            $arctypeInfo = !empty($arctypeRow[$arctypeInfo['pointto_id']]) ? $arctypeRow[$arctypeInfo['pointto_id']] : [];
                        }

                        $ctl_name = $ctl_name_list[$arctypeInfo['current_channel']]['ctl_name'];
                        $val['navig_url'] = typeurl('home/'.$ctl_name."/lists", $arctypeInfo);

                        if (!empty($val['arctype_sync'])) { // 同步菜单显示栏目名称
                            $val['navig_name'] = $arctypeInfo['typename'];
                        }
                    }
                } else {
                    $val['navig_url'] = $arctypeInfo['typelink'] = $this->GetNavigUrl($val['navig_url']);
                }
                /*--end*/

                /*标记菜单被选中效果*/
                if ($val['navig_id'] == $this->navigid) {
                    $val['currentstyle'] = $this->currentstyle;
                } else {
                    $val['currentstyle'] = '';
                }
                /*--end*/

                $val['target'] = 1 == $value['target'] ? ' target="_blank" ' : ' target="_self" ';
                $val['nofollow'] = 1 == $value['nofollow'] ? ' rel="nofollow" ' : '';

                // 封面图
                $val['navig_pic'] = handle_subdir_pic($val['navig_pic']);

                $res[$key] = $val;
            }
        }

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

        /*取得指定菜单ID对应的阶梯式所有子孙等菜单*/
        $result = array();
        $navigidArr = explode(',', $navigid);
        foreach ($navigidArr as $key => $val) {
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
            $result = $this->getSelf($navigid);
        }
        /*--end*/

        return $result;
    }

    /**
     * 获取当前菜单的第一级菜单下的子菜单
     * @author wengxianhu by 2017-7-26
     */
    public function getFirst($navigid)
    {
        $result = array();
        if (empty($navigid)) {
            return $result;
        }

        $row = Db::name('navig_list')->field('navig_id,topid,parent_id')->where(['navig_id'=>$navigid])->find(); // 当前菜单往上一级级父菜单
        if (!empty($row)) {
            $navigid = !empty($row['parent_id']) ? $row['topid'] : $row['navig_id'];
            $sonRow = $this->getSon($navigid, false); // 获取第一级菜单下的子孙菜单，为空时不获得同级菜单
            $result = $sonRow;
        }

        return $result;
    }

    /**
     * 获取同级菜单
     * @author wengxianhu by 2017-7-26
     */
    public function getSelf($navigid)
    {
        $result = array();
        if (empty($navigid)) {
            return $result;
        }

        /*获取指定菜单ID的上一级菜单ID列表*/
        $map = array(
            'id'   => array('in', $navigid),
            'status'  => 1,
            'is_del'    => 0, // 回收站功能
        );
        $res = M('navig_list')->field('parent_id')
            ->where($map)
            ->group('parent_id')
            ->select();
        /*--end*/

        /*获取上一级菜单ID对应下的子孙菜单*/
        if ($res) {
            $navigidArr = get_arr_column($res, 'parent_id');
            $navigid = implode(',', $navigidArr);
            if ($navigid == 0) {
                $result = $this->getTop();
            } else {
                $result = $this->getSon($navigid, false);
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
        $navig_max_level = intval(config('global.navig_max_level'));
        $map = array(
            'position_id'   => $this->position_id,
            'is_del'    => 0,
            'status'    => 1,
        );
        !empty($notnavigid) && $map['navig_id'] = ['NOTIN', $notnavigid]; // 排除指定菜单ID
        $res = $this->navigationlogic->navig_list(0, 0, false, $navig_max_level, $map);
        /*--end*/

        if (count($res) > 0) {

            // 菜单对应的所有栏目信息
            $typeids = [];
            foreach ($res as $key => $val) {
                if (!empty($val['type_id'])) {
                    array_push($typeids, intval($val['type_id']));
                }
                if (!empty($val['pointto_id'])) {
                    array_push($typeids, intval($val['pointto_id']));
                }
            }
            $typeids = array_unique($typeids);
            $arctypeRow = Db::name('arctype')->field('id,typename,dirname,current_channel,is_part,typelink,pointto_id')->where(['id'=>['IN', $typeids]])->cache(true,EYOUCMS_CACHE_TIME,"arctype")->getAllWithIndex('id');

            $ctl_name_list = model('Channeltype')->getAll('id,ctl_name', array(), 'id');
            $currentstyleArr = []; // 标记选择菜单的数组
            foreach ($res as $key => $val) {
                $arctypeInfo = !empty($arctypeRow[$val['type_id']]) ? $arctypeRow[$val['type_id']] : [];

                /*获取菜单的URL*/
                if (!empty($val['type_id'])) {
                    if ($arctypeInfo['is_part'] == 1) {     //外部链接
                        $val['navig_url'] = $arctypeInfo['typelink'];
                        if (!is_http_url($val['navig_url'])) {
                            $navig_url = '//'.$this->request->host();
                            if (!preg_match('#^'.ROOT_DIR.'(.*)$#i', $val['navig_url'])) {
                                $navig_url .= ROOT_DIR;
                            }
                            $navig_url .= '/'.trim($val['navig_url'], '/');
                            $val['navig_url'] = $navig_url;
                        }
                    } else {
                        if (!empty($arctypeInfo['pointto_id'])) {
                            $arctypeInfo = !empty($arctypeRow[$arctypeInfo['pointto_id']]) ? $arctypeRow[$arctypeInfo['pointto_id']] : [];
                        }
                        $ctl_name = $ctl_name_list[$arctypeInfo['current_channel']]['ctl_name'];
                        $val['navig_url'] = typeurl('home/'.$ctl_name."/lists", $arctypeInfo);

                        if (!empty($val['arctype_sync'])) { // 同步菜单显示栏目名称
                            $val['navig_name'] = $arctypeInfo['typename'];
                        }
                    }
                } else {
                    $val['navig_url'] = $arctypeInfo['typelink'] = $this->GetNavigUrl($val['navig_url']);
                }
                /*--end*/

                /*标记菜单被选中效果*/
                $val['currentstyle'] = '';
                $navig_url = htmlspecialchars_decode($arctypeInfo['typelink']);

                if ($val['navig_id'] == $this->topNavigid || $val['navig_id'] == $this->navigid) {
                    $currentstyleArr[$val['navig_id']] = [
                        'navig_id'   => $val['navig_id'],
                        'currentstyle'  => $this->currentstyle,
                    ];
                }

                $val['target'] = 1 == $value['target'] ? ' target="_blank" ' : ' target="_self" ';
                $val['nofollow'] = 1 == $value['nofollow'] ? ' rel="nofollow" ' : '';

                // 导航图片
                $val['navig_pic'] = handle_subdir_pic($val['navig_pic']);

                $res[$key] = $val;
            }

            // 循环处理选中菜单的标识
            foreach ($res as $key => $val) {
                $currentstyleInfo = !empty($currentstyleArr[$val['navig_id']]) ? $currentstyleArr[$val['navig_id']] : [];
                if (!empty($currentstyleInfo) && $val['navig_id'] == $currentstyleInfo['navig_id']) {
                    $val['currentstyle'] = $currentstyleInfo['currentstyle'];
                }
                $res[$key] = $val;
            }

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
    public function getTopidOrNavigid($typeid = 0)
    {
        if ($typeid > 0) {
            $row = Db::name('navig_list')->field('navig_id,topid,parent_id')->where(['type_id'=>$typeid])->find();
        } else {
            $code = MODULE_NAME.'_'.CONTROLLER_NAME.'_'.ACTION_NAME;
            $params = $this->request->param();
            unset($params['s']);
            unset($params['m']);
            unset($params['c']);
            unset($params['a']);
            foreach ($params as $key => $val) {
                $code .= "_{$key}-{$val}";
            }
            $row = Db::name('navig_list')->field('navig_id,topid,parent_id')->where(['navig_url'=>$code])->find();
        }

        if (empty($row['parent_id'])) {
            $topNavigid = $row['navig_id'];
        } else {
            $topNavigid = $row['topid'];
        }
        $navigid = $row['navig_id'];

        $data = [
            'topNavigid' => $topNavigid,
            'navigid' => $navigid,
        ];

        return $data;
    }

    // 获取URL
    public function GetNavigUrl($navig_url)
    {
        $ReturnData = [];
        $data = $this->navigationlogic->ForegroundFunction();
        foreach ($data as $key => $val) {
            $ReturnData[$val['code']] = $val['url'];
        }

        return $ReturnData[$navig_url];
    }
}