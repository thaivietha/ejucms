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

use \think\Controller;
use \think\Db;
use think\Request;
/**
 * 广告
 */
class TagAdv extends Base
{
    //初始化
    protected function _initialize()
    {
        parent::_initialize();
    }

    /**
     * 获取广告
     * @author wengxianhu by 2018-4-20
     */
    public function getAdv($pid = '', $where = '', $orderby = '',$row = '')
    {
        if (empty($pid)) {
            echo '标签adv报错：缺少属性 pid 。';
            return false;
        }
        $result = [];
        $uiset = I('param.uiset/s', 'off');
        $uiset = trim($uiset, '/');
        $times = time();
        if (empty($where)) {
            $where = "pid={$pid} and start_time < {$times} and (end_time > {$times} OR end_time = 0) and status = 1";
        }
        // 排序
        switch ($orderby) {
            case 'hot':
            case 'click':
                $orderby = 'click desc';
                break;

            case 'now':
            case 'new': // 兼容织梦的写法
                $orderby = 'add_time desc';
                break;
                
            case 'id':
                $orderby = 'id desc';
                break;

            case 'sort_order':
                $orderby = 'sort_order asc';
                break;

            case 'rand':
                $orderby = 'rand()';
                break;
            
            default:
                if (empty($orderby)) {
                    $orderby = 'sort_order asc, id desc';
                }
                break;
        }
        $regionInfo = \think\Cookie::get("regionInfo");
        $request    = Request::instance();
        $domain = $request->host();
        $domain_arr = explode('.',$domain);
        $web_mobile_domain = config('ey_config.web_mobile_domain');
        if (!empty($domain_arr) && $domain_arr[0] != 'www' && $domain_arr[0] != $web_mobile_domain && !empty($regionInfo)){
            $where_region = $where;
            if ($regionInfo['level'] == 1){
                $where_region .= " and province_id={$regionInfo['id']} and city_id=0 and area_id=0";
            }else if ($regionInfo['level'] == 2){
                $where_region .= " and city_id={$regionInfo['id']} and area_id=0";
            }else if ($regionInfo['level'] == 3){
                $where_region .= " and area_id={$regionInfo['id']}";
            }
            $result = M("ad")->field("*")
                ->where($where_region)
                ->orderRaw($orderby)
                ->cache(true,EYOUCMS_CACHE_TIME,"ad")
                ->select();
        }
        if (empty($result) || empty($row) ||  count($result) <$row ){
            $where .=  " and province_id=0 and city_id=0 and area_id=0";
            $result2 = M("ad")->field("*")
                ->where($where)
                ->orderRaw($orderby)
                ->cache(true,EYOUCMS_CACHE_TIME,"ad")
                ->select();

            $result = array_merge($result,$result2);
        }
        foreach ($result as $key => $val) {
            $val['litpic'] = handle_subdir_pic(get_default_pic($val['litpic'])); // 默认无图封面
            $val['target'] = ($val['target'] == 1) ? 'target="_blank"' : 'target="_self"';
            $val['intro'] = htmlspecialchars_decode($val['intro']);
            /*支持子目录*/
            $val['intro'] = handle_subdir_pic($val['intro'], 'html');
            /*--end*/
            if ($uiset == 'on') {
                $val['links'] = "javascript:void(0);";
            }
            $result[$key] = $val;
        }

        return $result;
    }
}