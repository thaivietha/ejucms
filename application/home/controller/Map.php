<?php
/**
 * Created by PhpStorm.
 * User: 28773
 * Date: 2019/7/12
 * Time: 15:19
 */

namespace app\home\controller;

use think\Db;

class Map extends Base
{
    public function _initialize() {
        parent::_initialize();
    }

    /**
     * @return \think\response\Json
     * 异步获取楼盘列表
     */
    public function getHouseLists()
    {
        $zoom    = input('param.zoom/d',13);
        $result  = model('xinfang')->getlists($zoom, 0);
        return json($result);
    }

    /**
     * @return mixed
     * 新房地图
     */
    public function index()
    {
        $aid = input('aid/d',0);
        $lng = !empty($this->eju['region']['lng'])? $this->eju['region']['lng'] : "116.62947";
        $lat = !empty($this->eju['region']['lat'])? $this->eju['region']['lat'] : "23.662623";
        if (!empty($aid)){
            $xinfang_content = db('xinfang_system')->where(['aid'=>$aid])->find();
            if (!empty($xinfang_content['lng']) && !empty($xinfang_content['lat'])){
                $lng = $xinfang_content['lng'];
                $lat = $xinfang_content['lat'];
            }
        }
        $this->assign('lng', $lng);
        $this->assign('lat', $lat);

        return $this->fetch();
    }
}