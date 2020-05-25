<?php
/**
 * User: xyz
 * Date: 2019/9/25
 * Time: 18:36
 */

namespace think\template\taglib\eju;

use think\Db;

class TagSurroundings extends Base
{
    protected function _initialize()
    {
        parent::_initialize();
    }
    public function getSurroundings($fields = '',$map_canvas,$map_tag,$map_select,$map_total,$map_tab,$map_result,$around = "0"){
        $result = [];
        if (empty($fields)){
            echo '标签surroundings报错：缺少属性 field 。';
            return false;
        }
        if (!isset($fields['average_price']) && isset($fields['total_price'])){
            $fields['average_price'] = $fields['total_price'];
        }else if (!isset($fields['average_price'])){
            $fields['average_price'] = 0;
        }
        $version   = getCmsVersion();
        $result['list'] = [0=>"商业",1=>"交通",2=>"教育",3=>"医疗"];
        $result['hidden'] = <<<EOF
        <script type="text/javascript" src="//api.map.baidu.com/api?v=2.0&ak=ETLXgCxIoVixggHcAk6mKpMd&s=1"></script>
        <script type="text/javascript" src="{$this->root_dir}/public/static/common/js/baidu_surroundings.js?v={$version}"></script>
        <!--<link rel="stylesheet" type="text/css" href="{$this->root_dir}/public/static/common/css/bmap_20.css?v={$version}" />-->
        <link rel="stylesheet" type="text/css" href="{$this->root_dir}/public/static/common/css/tag_surroundings.css?v={$version}" />
      <script type="text/javascript">
          var lng = "{$fields['lng']}";
          var lat = "{$fields['lat']}";
          var bid = '1';
          var bname = "{$fields['title']}";
          var address = "{$fields['address']}"; 
          var price =  "{$fields['average_price']}元/㎡"; 
          var bprice = bname+"  "+price;
          if (!isNaN(price))
          {
              bprice = bname+"  "+(price>0?(price+"元/㎡"):"售价待定");
          }
          // 百度地图API功能****begin
          var mp = new BMap.Map("{$map_canvas}",{minZoom: 6, maxZoom: 14});								//50米-5公里缩放
          //mp.addControl(new BMap.OverviewMapControl()); 											//添加默认缩略地图控件
          //mp.addControl(new BMap.OverviewMapControl({isOpen:true, anchor: BMAP_ANCHOR_BOTTOM_RIGHT})); //右下角，打开
          mp.addControl(new BMap.ScaleControl()); 													// 添加默认比例尺控件
          mp.addControl(new BMap.ScaleControl({anchor: BMAP_ANCHOR_BOTTOM_LEFT})); 					// 左下
          mp.addControl(new BMap.NavigationControl()); 												//添加默认缩放平移控件
          //mp.addControl(new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_LEFT, type: BMAP_NAVIGATION_CONTROL_SMALL})); //左上角，仅包含平移和缩放按钮
          var pointA=new BMap.Point(lng,lat);
          mp.centerAndZoom(pointA, 15);
          //mp.enableScrollWheelZoom();//启用滚轮放大缩小，默认禁用
          mp.enableKeyboard();
          mp.enableContinuousZoom(); 							// 开启连续缩放效果
          mp.enableInertialDragging();　						// 开启惯性拖拽效果
          //开始搜索
          var local = new BMap.LocalSearch(mp, {pageCapacity:10});
          
          //多个关键字搜索返回结果 ****begin
          local.setSearchCompleteCallback(function(results){
              //判断状态是否正确
              if(local.getStatus() == BMAP_STATUS_SUCCESS){
                  //openInfoWinFuns = [];
                  var map_total=0;
                  var pm=[];
                  for(var index=0;index<results.length;index++){
                      pm[index]=[];
                      var zbcount=0;
                      for(var i=0;i<results[index].getCurrentNumPois();i++){
                          //初始化,拼装对象
                          var _title=results[index].getPoi(i).title;
                          var _keyword=results[index].keyword;
                          var _address=results[index].getPoi(i).address;
                          var _point=results[index].getPoi(i).point;
                          var _poi=results[index].getPoi(i);
                          var dist=mp.getDistance(pointA,results[index].getPoi(i).point).toFixed(0);//距离计算
                          if(dist<=2000){
                              var myPointMarker=new pointMarker(_title,_keyword,_address,dist,_point,_poi);
                              pm[index][zbcount]=myPointMarker;
                              zbcount++;
                              map_total++;
                          }
                      }
                  }
                  $("#{$map_total}").html(map_total);//总记录数
                  //排序
                  sortOrder(pm,"{$map_result}","{$map_tab}");
                  //document.getElementById("map_result").innerHTML = s.join("");
              }else{
                  document.getElementById("{$map_result}").innerHTML = '没有查到, 您可以尝试把地图放大之后再查找';
              }
          });
          //多个关键字搜索返回结果 ****end
          //默认选择第一项
          function select_around(i){
              aaa = $(".{$map_tag}").eq(i);
              for(var n=0;n<4;n++){
                  $(".{$map_tag}").removeClass('{$map_select}-'+(n+1));
                  $(".{$map_tag}").removeClass('{$map_select}');
              }
              aaa.addClass('{$map_select}-'+(i+1));
              aaa.addClass('{$map_select}');
              search(i,local);
          }
         select_around(0);
          
          
      </script>
EOF;

    return $result;
    }
}