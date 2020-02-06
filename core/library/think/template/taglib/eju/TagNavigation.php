<?php
/**
 * 易购CMS
 * ============================================================================
 * 版权所有 2016-2028 海南易而优科技有限公司，并保留所有权利。
 * 网站地址: http://www.ejucms.com
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 易而优团队 by 陈风任 <491085389@qq.com>
 * Date: 2019-4-13
 */

namespace think\template\taglib\eju;

use think\Config;
use think\Db;

/**
 * 导航列表
 */
class TagNavigation extends Base
{   
    public $users_id = 0;
    
    //初始化
    protected function _initialize()
    {
        parent::_initialize();
    }

    /**
     * 获取订单明细数据
     */
    public function getNavigation($position_id = null, $orderby = '', $orderway = '')
    {
        if (!empty($position_id)) {
            $Action = $this->request->action();
            $Get = $this->request->get('tid');

            // 排序
            $Order = "b.{$orderby} {$orderway}";
            $result = Db::name('navig_position')->alias('a')
                ->field('a.position_name, b.*')
                ->join('__NAVIG_LIST__ b', "b.position_id = a.position_id", 'LEFT')
                ->where('a.position_id', $position_id)
                ->order($Order)
                ->cache(true,EYOUCMS_CACHE_TIME, "Navigation")
                ->select();
            if (!empty($result)) {
                foreach ($result as $key => $value) {
                    $result[$key]['is_cart'] = 'shop_cart_list' == $value['navig_url'] ? 1 : 0;
                    $result[$key]['target'] = 1 == $value['target'] ? 'target="_blank"' : 'target="_self"';
                    $result[$key]['nofollow'] = 1 == $value['nofollow'] ? 'rel="nofollow"' : 'rel=""';
                    $result[$key]['class'] = '';
                    $result[$key]['navig_pic'] = handle_subdir_pic(get_default_pic($value['navig_pic']));
                    if ('web_cmsurl' == $value['navig_url'] && 'index' == $Action) {
                        $result[$key]['class'] = ' cur';
                        $result[$key]['navig_url'] = $this->GetNavigUrl($value['navig_url']);
                    } else if (empty($value['arctype_sync']) && empty($value['type_id'])) {
                        $result[$key]['navig_url'] = $this->GetNavigUrl($value['navig_url']);
                        if (!empty($Action) && $Action == $value['navig_url']) $result[$key]['class'] = ' cur';
                    } else if (!empty($Get) && $Get == $value['type_id']) {
                        $result[$key]['class'] = ' cur';
                    }
                }
            }
            return $result;
        } else {
            return false;
        }
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