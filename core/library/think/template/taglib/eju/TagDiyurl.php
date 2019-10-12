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

            case "map":
                $parseStr = url('home/Map/index');
                break;

            case "maphouselist":
                $parseStr = url('home/Map/getHouseLists');
                break;

            default:
                $parseStr = "";
                break;
        }

        return $parseStr;
    }
}