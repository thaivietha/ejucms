<?php
/**
 * User: xyz
 * Date: 2019/12/31
 * Time: 15:53
 */

namespace think\template\taglib\eju;

use think\Db;

class TagSand extends Base
{
    public $aid = '';
    protected function _initialize()
    {
        parent::_initialize();
        $this->aid = I('param.aid/d', 0);
    }
    public function getSand($aid){
        $aid = !empty($aid) ? $aid : $this->aid;
        if (empty($aid)){
            echo '标签sand报错：aid属性值语法错误，不能为空。';
            return false;
        }
        $result = Db::name('xinfang_sand_pic')->where("aid={$aid}")->find();
        if ($result){
            $data = json_decode($result['data'],true);
            foreach ($data as $key=>$val){
                $point = explode(',',$val['point']);
                $data[$key]['lpoint'] = $point[0];
                $data[$key]['tpoint'] = $point[1];
                if ($val['sale'] == '预售'){
                    $data[$key]['currentstyle'] = 'yushou';
                }else if($val['sale'] == '在售'){
                    $data[$key]['currentstyle'] = 'zaishou';
                }else{
                    $data[$key]['currentstyle'] = 'shouqing';
                }
            }
            $result['data'] = $data;
            $sand_list = Db::name('xinfang_sand')->where("aid={$aid}")->select();
            $huxing_list = Db::name('xinfang_huxing')->where("aid={$aid}")->select();
            foreach ($huxing_list as $key=>$val){
                $huxing_list[$key]['open_time'] = !empty($val['open_time']) ? MyDate("Y-m-d",$val['open_time']) : '';
                $huxing_list[$key]['complate_time'] = !empty($val['complate_time']) ? MyDate("Y-m-d",$val['complate_time']) : '';
            }
            $huxing_list = convert_arr_key($huxing_list,'huxing_id');
            foreach ($sand_list as $key=>$val){
                $sand_list[$key]['open_time'] = !empty($val['open_time']) ? MyDate("Y-m-d",$val['open_time']) : '';
                $sand_list[$key]['complate_time'] = !empty($val['complate_time']) ? MyDate("Y-m-d",$val['complate_time']) : '';
                if (!empty($val['huxing_id'])){
                    $huxing_id_arr = explode(',',$val['huxing_id']);
                    foreach ($huxing_id_arr as $v){
                        !empty($huxing_list[$v]) && $sand_list[$key]['huxing_list'][] = $huxing_list[$v];
                    }
                }
            }
            $result['sand_list'] = $sand_list;
            $result['sale_status'] = get_sale_status_list();
            $result['label'] = <<<EOF
        <div class="label">
                <div class="item clearfix">
                    <span class="bg yushou"></span>
                    <span class="txt">预售</span>
                </div>
                <div class="item clearfix">
                    <span class="bg zaishou"></span>
                    <span class="txt">在售</span>
                </div>
                <div class="item clearfix">
                    <span class="bg shouqing"></span>
                    <span class="txt">售罄</span>
                </div>
                <div class="opacity"></div>
            </div>
EOF;
            $version   = getCmsVersion();
            $result['hidden'] = <<<EOF
        <script type="text/javascript" src="{$this->root_dir}/public/static/common/js/tag_sand.js?v={$version}"></script>
        <link rel="stylesheet" type="text/css" href="{$this->root_dir}/public/static/common/css/tag_sand.css?v={$version}" />
EOF;
        }
        return $result;
    }
}