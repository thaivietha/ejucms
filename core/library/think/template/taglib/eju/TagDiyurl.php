<?php
/**
 * User: xyz
 * Date: 2019/9/29
 * Time: 18:03
 */

namespace think\template\taglib\eju;

use think\Request;
use think\Config;

class TagDiyurl extends Base
{
    protected function _initialize()
    {
        parent::_initialize();
    }

    public function getDiyurl($type = 'form',$template = '',$aid = 0)
    {
        $parseStr = "";
        
        switch ($type){
            case "form":
                $tid = I("param.tid/s", ''); // 应用于栏目列表
                /*tid为目录名称的情况下*/
                $tid = $this->getTrueTypeid($tid);
                empty($aid) && $aid = I("param.aid/d", '0');
                $parent_url = request()->url(true);
                $parent_url = $parent_url ? $parent_url : '/';
                $parseStr = url('home/Index/ajax_form', ['ajax_form'=>1,'aid'=>$aid,'tid'=>$tid,'template'=>$template, 'parent_url'=>$parent_url], true, false, 1);
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
            case "mapshopcs":   //商铺出售地图页面
                $parseStr = url('home/Map/shopcs');
                break;
            case "mapshopcslist":   //商铺出售地图列表数据
                $parseStr = url('home/Map/getShopcsLists');
                break;
            case "mapshopcz":   //商铺出租地图页面
                $parseStr = url('home/Map/shopcz');
                break;
            case "mapshopczlist":   //商铺出租地图列表数据
                $parseStr = url('home/Map/getShopczLists');
                break;
            case "mapofficecs":   //写字楼出售地图页面
                $parseStr = url('home/Map/officecs');
                break;
            case "mapofficecslist":   //写字楼出售地图列表数据
                $parseStr = url('home/Map/getOfficecsLists');
                break;
            case "mapofficecz":   //写字楼出租地图页面
                $parseStr = url('home/Map/officecz');
                break;
            case "mapofficeczlist":   //写字楼出租地图列表数据
                $parseStr = url('home/Map/getOfficeczLists');
                break;
            case "panorama":    //全景地图
                empty($aid) && $aid = I("param.aid/s", '');
                $parseStr = url('home/Map/panorama',['aid'=>$aid]);
                break;
            case "jisuanqi":    //房贷计算器
                $parseStr = url('home/Tool/jisuanqi');
                break;
            case "bohao":   //拨号页面
                empty($aid) && $aid = I("param.aid/d", 0);
                $web_mobile_domain = config('ey_config.web_mobile_domain');
                $parseStr = url('home/Tool/bohao',['aid'=>$aid],true,false,null,null,$web_mobile_domain);
                break;
            case 'shouye':
                $request = Request::instance();
                $scheme = $request->isSsl() || Config::get('is_https') ? 'https://' : 'http://';
                $parseStr = $scheme.$request->host();
                $subdomain = input("param.subdomain/s",'');
                if (!empty($subdomain)){
                    $parseStr = getRegionDomainUrl($subdomain);
                }
                break;
            default:
                $parseStr = "";
                break;
        }

        return $parseStr;
    }
}