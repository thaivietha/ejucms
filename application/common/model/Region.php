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
namespace app\common\model;

use think\Model;

/**
 * 区域分类
 */
class Region extends Model
{
    //初始化
    protected function initialize()
    {
        // 需要调用`Model`的`initialize`方法
        parent::initialize();
    }

    /**
     * 获取单条地区
     * @author wengxianhu by 2017-7-26
     */
    public function getInfo($id, $field = '*')
    {
        $result = db('Region')->field($field)->find($id);

        return $result;
    }

    /**
     * 获取多个地区
     * @author wengxianhu by 2017-7-26
     */
    public function getListByIds($ids = array(), $field = '*', $index_key = '')
    {
        $map = array(
            'id'   => array('IN', $ids),
        );
        $result = db('Region')->field($field)
            ->where($map)
            ->select();

        if (!empty($index_key)) {
            $result = convert_arr_key($result, $index_key);
        }

        return $result;
    }

    /**
     * 获取子地区
     * @author wengxianhu by 2017-7-26
     */
    public function getList($parent_id = 0, $field = '*', $index_key = '')
    {
        $result = $this->getAll($parent_id, $field, $index_key);

        return $result;
    }

    /**
     * 获取全部地区
     * @author wengxianhu by 2017-7-26
     */
    public function getAll($parent_id = false, $field = '*', $index_key = '')
    {
        $map = array();
        if (false !== $parent_id) {
            $map['parent_id'] = $parent_id;
        }

        $result = db('Region')->field($field)
            ->where($map)
            ->select();

        if (!empty($index_key)) {
            $result = convert_arr_key($result, $index_key);
        }

        return $result;
    }

    /**
     * 获取级别的地区
     * @author wengxianhu by 2017-7-26
     */
    public function getListByLevel($level = 1, $field = '*', $index_key = '')
    {
        $map = array(
            'level' => $level,
        );

        $result = db('Region')->field($field)
            ->where($map)
            ->select();

        if (!empty($index_key)) {
            $result = convert_arr_key($result, $index_key);
        }

        return $result;
    }

    /**
     * 获取当前区域的所有父级
     * @author wengxianhu by 2018-4-26
     */
    public function getAllPid($id)
    {
        $cacheKey = array(
            'common',
            'model',
            'Region',
            'getAllPid',
            $id,
        );
        $cacheKey = json_encode($cacheKey);
        $data = cache($cacheKey);
        if (empty($data)) {
            $data = array();
            $regionid = $id;
            $region_list = M('region')->field('*, id as regionid')
                ->where([
                    'status'    => 1,
                ])
                ->getAllWithIndex('id');
            if (isset($region_list[$regionid])) {
                // 第一个先装起来
                $region_list[$regionid]['url'] = $this->getRegionUrl($region_list[$regionid]['domain'], $region_list[$regionid]['parent_id'], $region_list[$regionid]['id']);
                $data[$regionid] = $region_list[$regionid];
            } else {
                return $data;
            }

            while (true)
            {
                $regionid = $region_list[$regionid]['parent_id'];
                if($regionid > 0){
                    if (isset($region_list[$regionid])) {
                        $region_list[$regionid]['url'] = $this->getRegionUrl($region_list[$regionid]['domain'], $region_list[$regionid]['parent_id'], $region_list[$regionid]['id']);
                        $data[$regionid] = $region_list[$regionid];
                    }
                } else {
                    break;
                }
            }
            $data = array_reverse($data, true);

            cache($cacheKey, $data, null, "region");
        }

        return $data;
    }

    /**
     * 处理单条区域数据
     */
    public function handle_info($info = [], $firstTypeid)
    {
        if (!empty($info)) {

            // 封面图
            $info['litpic'] = handle_subdir_pic($info['litpic']);

            /*区域的URL*/
            $web_region_domain = config('ey_config.web_region_domain');
            if (!empty($web_region_domain) && !empty($info['domain']) && 2 >= $info['level']) {
                $domainurl = getRegionDomainUrl($info['domain']);
            } else {
                // 指定模型的第一个区域ID
                empty($firstTypeid) && $firstTypeid = model('Arctype')->getFristTypeid(9); 
                $vars = [
                    'tid'           => $firstTypeid,
                ];
                if (1 == $info['level']) {
                    $vars['province_id'] = $info['id'];
                } else if (2 == $info['level']) {
                    $vars['province_id'] = $info['parent_id'];
                    $vars['city_id'] = $info['id'];
                }
                $url_screen_var = config('global.url_screen_var');
                $vars[$url_screen_var] = 1;
                $domainurl = $this->root_dir.'/index.php?m=home&c=Lists&a=index&'.http_build_query($vars);
            }
            $info['domainurl'] = $domainurl;
            /*--end*/
        }

        return $info;
    }
}