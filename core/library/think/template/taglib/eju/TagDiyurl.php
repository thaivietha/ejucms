<?php
/**
 * User: xyz
 * Date: 2019/9/29
 * Time: 18:03
 */

namespace think\template\taglib\eju;


class TagDiyurl extends Base
{
    protected function _initialize()
    {
        parent::_initialize();
    }

    public function getDiyurl($type = 'form')
    {
        $parseStr = "";
        
        switch ($type){
            case "form":
                $tid = I("param.tid/s", ''); // 应用于栏目列表
                /*tid为目录名称的情况下*/
                $tid = $this->getTrueTypeid($tid);
                $aid = I("param.aid/s", '');
                $parent_url = request()->url();
                $parent_url = $parent_url ? $parent_url : '/';
                $parseStr = url('home/Index/ajax_form', ['ajax_form'=>1, 'parent_url'=>$parent_url,'aid'=>$aid,'tid'=>$tid], true, false, 1);
                break;

            case "map":     //新房地图有页面
                $parseStr = url('home/Map/index');
                break;

            case "maphouselist":    //新房地图列表数据
                $parseStr = url('home/Map/getHouseLists');
                break;
            case "mapxiaoqu":   //小区地图页面
                $parseStr = url('home/Map/xiaoqu');
                break;
            case "mapxiaoqulist":   //小区地图列表数据
                $parseStr = url('home/Map/getXiaoquLists');
                break;
            case "mapershou":   //二手地图页面
                $parseStr = url('home/Map/ershou');
                break;
            case "mapershoulist":   //二手地图列表数据
                $parseStr = url('home/Map/getErshouLists');
                break;
            case "mapzufang":   //租房地图页面
                $parseStr = url('home/Map/zufang');
                break;
            case "mapzufanglist":   //租房地图列表数据
                $parseStr = url('home/Map/getZufangLists');
                break;
            case "panorama":    //全景地图
                $aid = I("param.aid/s", '');
                $parseStr = url('home/Map/panorama',['aid'=>$aid]);
                break;
            default:
                $parseStr = "";
                break;
        }

        return $parseStr;
    }
}