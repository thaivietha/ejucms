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
 * 多条数据
 */
class TagSqlarclist extends Base
{
    //初始化
    protected function _initialize()
    {
        parent::_initialize();
    }

    /**
     * 获取多条信息
     * @author wengxianhu by 2018-4-20
     */
    public function getSqlarclist($table = '', $fields = '', $addwhere = '', $limit = '')
    {
        if (empty($table)) {
            echo '标签sqlarclist报错：缺少属性 table 值。';
            return false;
        }

        $fields = !empty($fields) ? $fields : '*';
        $where = "";
        if (!empty($addwhere)) {
            if (!empty($where)) {
                $where = "(".$addwhere.") AND ".$where;
            } else {
                $where = $addwhere;
            }
        }

        $result = M($table)->field($fields)->where($where)->limit($limit)->select();

        switch ($table) {
            case 'region':
                {
                    $web_region_domain = config('ey_config.web_region_domain'); // 是否开启子站点
                    $url_screen_var = config('global.url_screen_var'); // 筛选动态标识
                    $firstTypeid = model('Arctype')->getFristTypeid(9); // 指定模型的第一个区域ID
                    foreach ($result as $key => $val) {
                        // 封面图
                        $val['litpic'] = !empty($val['litpic']) ? handle_subdir_pic($val['litpic']) : get_default_pic($val['litpic']);

                        /*区域的URL*/
                        if (!empty($web_region_domain) && !empty($val['domain']) && 2 >= $val['level']) {
                            $domainurl = getRegionDomainUrl($val['domain']);
                        } else {
                            $vars = [
                                'tid'           => $firstTypeid,
                                'province_id'   => $val['parent_id'],
                                'city_id'   => $val['id'],
                                $url_screen_var => 1,
                            ];
                            $domainurl = $this->root_dir.'/index.php?m=home&c=Lists&a=index&'.http_build_query($vars);
                        }
                        $val['domainurl'] = $domainurl;
                        /*--end*/

                        $result[$key] = $val;
                    }
                }
                break;
            
            default:
                # code...
                break;
        }

        return $result;
    }
}