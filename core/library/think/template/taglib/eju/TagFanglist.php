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

/**
 * 楼盘附加信息表的数据列表
 */
class TagFanglist extends Base
{
    private $aid = 0;

    //初始化
    protected function _initialize()
    {
        parent::_initialize();
        $this->aid = input('param.aid/d');
    }

    /**
     * 获取数据列表，比如：户型列表、相册列表、价格趋势
     * @author wengxianhu by 2018-4-20
     */
    public function getFanglist($type = '', $aid = '', $limit = '', $orderby = '', $orderway = '', $group = '',$model = 'xinfang')
    {
        empty($aid) && $aid = $this->aid;

        if (empty($aid)) {
            echo '标签fanglist报错：缺少属性 aid 值。';
            return false;
        }

        if ($model == 'xinfang'){
            switch ($type) {
                case 'huxing':
                    return $this->getHuxingData($aid, $limit, $orderby, $orderway, $group);
                    break;

                case 'photo':
                    return $this->getPhotoData($aid, $limit, $orderby, $orderway, $group);
                    break;

                case 'price':
                    return $this->getPriceData($aid, $limit, $orderby, $orderway, $group);
                    break;

                default:
                    return false;
                    break;
            }
        }else if ($model == 'ershou'){
            switch ($type) {
                case 'photo':
                    return $this->getErshouPhotoData($aid, $limit, $orderby, $orderway, $group);
                    break;
                default:
                    return false;
                    break;
            }
        }else if ($model == 'xiaoqu'){
            switch ($type) {
                case 'photo':
                    return $this->getXiaoquPhotoData($aid, $limit, $orderby, $orderway, $group);
                    break;
                default:
                    return false;
                    break;
            }
        }

        return false;
    }

    /**
     * 获取户型分类列表数据
     * @author wengxianhu by 2018-4-20
     */
    private function getHuxingData($aid = '', $limit = '', $orderby = '', $orderway = '', $group = '')
    {
        $orderby = $this->getOrderBy($orderby, $orderway);
        $list = Db::name('xinfang_huxing')
            ->field('*')
            ->where([
                'aid'   => $aid,
                'is_del'    => 0,
            ])
            ->order($orderby)
            ->select();

        $groupList = array();
        foreach($list as $key => $val){
            $groupList[$val[$group]][] = $val;
        }

        /*截取数量*/
        $limitArr = explode(',', $limit);
        $offset = (2 <= count($limitArr)) ? intval($limitArr[0]) : 0;
        $num = (2 <= count($limitArr)) ? intval($limitArr[1]) : intval($limitArr[0]);
        foreach ($groupList as $key => $sub) {
            $endset = $offset + $num;
            if ($endset > count($sub)) {
                $endset = count($sub);
            }
            $children = [];
            for ($i = $offset; $i < $endset; $i++) { 
                $children[] = $sub[$i];
            }
            $groupList[$key] = [
                $group => $key,
                'count' => count($children),
                'children'  => $children,
            ];
        }
        /*end*/

        $data = [
            'list'  => array_values($groupList),
        ];

        return $data;
    }

    /**
     * 获取相册分类列表数据
     * @author wengxianhu by 2018-4-20
     */
    private function getPhotoData($aid = '', $limit = '', $orderby = '', $orderway = '', $group = '')
    {
        $orderby = $this->getOrderBy($orderby, $orderway);
        $list = Db::name('xinfang_photo')
            ->field('*')
            ->where([
                'aid'   => $aid,
                'is_del'    => 0,
            ])
            ->order($orderby)
            ->select();
        $groupList = array();
        foreach($list as $key => $val){
            $groupList[$val[$group]][] = $val;
        }
        /*截取数量*/
        $limitArr = explode(',', $limit);
        $offset = (2 <= count($limitArr)) ? intval($limitArr[0]) : 0;
        $num = (2 <= count($limitArr)) ? intval($limitArr[1]) : intval($limitArr[0]);
        foreach ($groupList as $key => $sub) {
            $endset = $offset + $num;
            if ($endset > count($sub)) {
                $endset = count($sub);
            }
            $children = [];
            for ($i = $offset; $i < $endset; $i++) { 
                $children[] = $sub[$i];
            }
            $groupList[$key] = [
                $group => $key,
                'count' => count($children),
                'children'  => $children,
            ];
        }

        /*end*/
        $data = [
            'list'  => array_values($groupList),
        ];

        return $data;
    }

    /**
     * 获取价格趋势分类列表数据
     * @author wengxianhu by 2018-4-20
     */
    private function getPriceData($aid = '', $limit = '', $orderby = '', $orderway = '', $group = '')
    {
        $orderby = $this->getOrderBy($orderby, $orderway);
        $list = Db::name('xinfang_price')
            ->field('*')
            ->where([
                'aid'   => $aid,
            ])
            ->order($orderby)
            ->select();

        $groupList = array();
        foreach($list as $key => $val){
            $groupList[$val[$group]][] = $val;
        }

        /*截取数量*/
        $limitArr = explode(',', $limit);
        $offset = (2 <= count($limitArr)) ? intval($limitArr[0]) : 0;
        $num = (2 <= count($limitArr)) ? intval($limitArr[1]) : intval($limitArr[0]);
        foreach ($groupList as $key => $sub) {
            $endset = $offset + $num;
            if ($endset > count($sub)) {
                $endset = count($sub);
            }
            $children = [];
            for ($i = $offset; $i < $endset; $i++) { 
                $children[] = $sub[$i];
            }
            $groupList[$key] = [
                $group => $key,
                'count' => count($children),
                'children'  => $children,
            ];
        }
        /*end*/

        $data = [
            'list'  => array_values($groupList),
        ];

        return $data;
    }
    /**
     * 获取二手房相册分类列表数据
     * @author wengxianhu by 2018-4-20
     */
    private function getErshouPhotoData($aid = '', $limit = '', $orderby = '', $orderway = '', $group = '')
    {
        $orderby = $this->getOrderBy($orderby, $orderway);
        $list = Db::name('ershou_photo')
            ->field('*')
            ->where([
                'aid'   => $aid,
                'is_del'    => 0,
            ])
            ->order($orderby)
            ->select();

        $groupList = array();
        foreach($list as $key => $val){
            $groupList[$val[$group]][] = $val;
        }

        /*截取数量*/
        $limitArr = explode(',', $limit);
        $offset = (2 <= count($limitArr)) ? intval($limitArr[0]) : 0;
        $num = (2 <= count($limitArr)) ? intval($limitArr[1]) : intval($limitArr[0]);
        foreach ($groupList as $key => $sub) {
            $endset = $offset + $num;
            if ($endset > count($sub)) {
                $endset = count($sub);
            }
            $children = [];
            for ($i = $offset; $i < $endset; $i++) {
                $children[] = $sub[$i];
            }
            $groupList[$key] = [
                $group => $key,
                'count' => count($children),
                'children'  => $children,
            ];
        }
        /*end*/

        $data = [
            'list'  => array_values($groupList),
        ];

        return $data;
    }
    /**
     * 获取二手房相册分类列表数据
     * @author wengxianhu by 2018-4-20
     */
    private function getXiaoquPhotoData($aid = '', $limit = '', $orderby = '', $orderway = '', $group = '')
    {
        $orderby = $this->getOrderBy($orderby, $orderway);
        $list = Db::name('xiaoqu_photo')
            ->field('*')
            ->where([
                'aid'   => $aid,
                'is_del'    => 0,
            ])
            ->order($orderby)
            ->select();

        $groupList = array();
        foreach($list as $key => $val){
            $groupList[$val[$group]][] = $val;
        }

        /*截取数量*/
        $limitArr = explode(',', $limit);
        $offset = (2 <= count($limitArr)) ? intval($limitArr[0]) : 0;
        $num = (2 <= count($limitArr)) ? intval($limitArr[1]) : intval($limitArr[0]);
        foreach ($groupList as $key => $sub) {
            $endset = $offset + $num;
            if ($endset > count($sub)) {
                $endset = count($sub);
            }
            $children = [];
            for ($i = $offset; $i < $endset; $i++) {
                $children[] = $sub[$i];
            }
            $groupList[$key] = [
                $group => $key,
                'count' => count($children),
                'children'  => $children,
            ];
        }
        /*end*/

        $data = [
            'list'  => array_values($groupList),
        ];

        return $data;
    }
    /**
     * 查询排序规则
     * @author wengxianhu by 2018-4-20
     */
    private function getOrderBy($orderby = '', $orderway = '')
    {
        switch ($orderby) {
            case 'now':
            case 'new': // 兼容织梦的写法
            case 'pubdate': // 兼容织梦的写法
            case 'add_time':
                $orderby = "add_time {$orderway}";
                break;

            case 'sortrank': // 兼容织梦的写法
            case 'sort_order':
                $orderby = "sort_order {$orderway}";
                break;

            default:
            {
                if (empty($orderby)) {
                    $orderby = 'add_time desc';
                } elseif (trim($orderby) != 'rand()') {
                    $orderbyArr = explode(',', $orderby);
                    foreach ($orderbyArr as $key => $val) {
                        $val = trim($val);
                        if (preg_match('/^([a-z]+)\./i', $val) == 0) {
                            $val = $val;
                            $orderbyArr[$key] = $val;
                        }
                    }
                    $orderby = implode(',', $orderbyArr);
                }
                break;
            }
        }

        return $orderby;
    }
}