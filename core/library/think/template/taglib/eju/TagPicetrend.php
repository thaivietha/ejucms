<?php
/**
 * Created by PhpStorm.
 * User: 28773
 * Date: 2019/8/7
 * Time: 17:24
 */

/*
 * 类型，1：均价，2：起价，3：总价
 * 类型，1：新房均价，2：新房起价,3：二手房均价，4：二手房总价，5：租房均价，6：租房总价，7：商铺出售均价，8：商铺出售总价，9：商铺出租均价，10：商铺出租总价，11：写字楼出售均价，12：写字楼出售总价，13：写字楼出租均价，14：写字楼出租总价
 */
namespace think\template\taglib\eju;

use think\Db;

class TagPicetrend extends Base
{
    protected function _initialize()
    {
        parent::_initialize();
    }
    public function getPicetrend($fields = '',$month = 0,$city = 0,$province = 0,$area = 0,$format = "Y-m月",$canvas = "fjChart",$mode = 'xinfang',$type = 1){
        $result = ['compareDate'=>"",'maxPrice'=>"",'minPrice'=>"",'buildNowPrices'=>""
            ,'buildPrices'=>"",'buildName'=>"",'cityNowPrices'=>"",'cityPrices'=>"",'cityName'=>"","provinceNowPrices"=>""
            ,"provincePrices"=>"",'provinceName'=>"","areaNowPrices"=>"","areaPrices"=>"",'areaName'=>""];
        $time_arr = to_month($month,$format);
        if (!empty($fields)){
            $channel = Db::name("channeltype")->where("id=".$fields['channel'])->find();
            $channel && $mode = $channel['table'];
            $xinfangInfo =  $this->getXinfangtred($fields,$time_arr,$mode,$type);
        }
        if (!empty($xinfangInfo)){
            $result = array_merge($result,$xinfangInfo);
        }
        if (!empty($province)){
            $provinceInfo = $this->getProvincetrend($province,$time_arr,$mode,$type);
        }
        if (!empty($provinceInfo)){
            $result = array_merge($result,$provinceInfo);
        }
        if (!empty($city)){
            $cityInfo = $this->getCitytrend($city,$time_arr,$mode,$type);
        }
        if (!empty($cityInfo)){
            $result = array_merge($result,$cityInfo);
        }
        if (!empty($area)){
            $areaInfo = $this->getAreatrend($area,$time_arr,$mode,$type);
        }
        if (!empty($areaInfo)){
            $result = array_merge($result,$areaInfo);
        }
        if (empty($result['buildPrices']) && empty($result['cityPrices']) && empty($result['provincePrices']) && empty($result['areaPrices'])){ //没有任何的统计，显示当前默认省份（城市、区域）的价格走势图
            if ($city == 0 && $province == 0 && $area == 0){
                $regionInfo = \think\Cookie::get("regionInfo");
                if(is_json($regionInfo))
                {
                    $regionInfo = json_decode($regionInfo,true);
                }
                if ($regionInfo['level'] == 1){
                    $province =  $regionInfo['id'];
                    if (!empty($province)){
                        $provinceInfo = $this->getProvincetrend($province,$time_arr,$mode,$type);
                    }
                    if (!empty($provinceInfo)){
                        $result = array_merge($result,$provinceInfo);
                    }
                }else if ($regionInfo['level'] == 2){
                    $city =  $regionInfo['id'];
                    if (!empty($city)){
                        $cityInfo = $this->getCitytrend($city,$time_arr,$mode,$type);
                    }
                    if (!empty($cityInfo)){
                        $result = array_merge($result,$cityInfo);
                    }
                }else if($regionInfo['level'] == 3){
                    $area =  $regionInfo['id'];
                    if (!empty($area)){
                        $areaInfo = $this->getAreatrend($area,$time_arr,$mode,$type);
                    }
                    if (!empty($areaInfo)){
                        $result = array_merge($result,$areaInfo);
                    }
                }
            }
        }
        $version   = getCmsVersion();
        $result['hidden'] = <<<EOF
        <script type="text/javascript" src="{$this->root_dir}/public/static/common/js/echarts.min.js?v={$version}"></script>
        <script type="text/javascript">
          $(document).ready(function(){
              createChart();
          });

          function createChart(){
              var ctext = "{$result['cityPrices']}";
              var btext = "{$result['buildPrices']}"; 
              var ptext = "{$result['provincePrices']}"; 
              var atext = "{$result['areaPrices']}";
              var datetext = "{$result['compareDate']}";
              var cityPrices  = eval('[' + ctext + ']');
              var buildPrices  = eval('[' + btext + ']');
              var provincePrices  = eval('[' + ptext + ']');
              var areaPrices  = eval('[' + atext + ']');
              var compareDate  = eval('[' + datetext + ']');
              var cityNowPrices = "{$result['cityNowPrices']}";
              var buildNowPrices = "{$result['buildNowPrices']}";
              var provinceNowPrices = "{$result['provinceNowPrices']}";
               var areaNowPrices = "{$result['areaNowPrices']}";
              var cityName = "{$result['cityName']}";
              var buildName = "{$result['buildName']}";
              var provinceName = "{$result['provinceName']}";
              var areaName = "{$result['areaName']}";
              var monthLength = "{$month}";
              var legend_data = [] ; //[{name:'新房',icon:'circle'},{name:'二手',icon:'circle'}];
              var series = []; //[{name: '新房', type: 'line',symbol: 'circle',symbolSize: monthLength,data: cityPrices},{name: '二手',type: 'line', symbol: 'circle',symbolSize: monthLength,data: cityPrices}];
              var formatter = ""; //'{a0}：{c0}元/m²<br/>{a1}：{c1}元/m²'
              var i = 0;
              if (buildName){
                  legend_data.push({name:buildName,icon:'circle',price:buildNowPrices});
                  series.push({name: buildName, type: 'line',symbol: 'circle',symbolSize: monthLength,data: buildPrices});
                  formatter = formatter + "{a"+ i +"}：{c"+ i +"}元/m²";
                  i = i + 1;
              }
              if (cityName){
                  legend_data.push({name:cityName,icon:'circle',price:cityNowPrices});
                  series.push({name: cityName, type: 'line',symbol: 'circle',symbolSize: monthLength,data: cityPrices});
                    formatter = formatter + "<br/>{a"+ i +"}：{c"+ i +"}元/m²";
                    i = i + 1;
              }
              if (provinceName){
                  legend_data.push({name:provinceName,icon:'circle',price:provinceNowPrices});
                  series.push({name: provinceName, type: 'line',symbol: 'circle',symbolSize: monthLength,data: provincePrices});
                    formatter = formatter + "<br/>{a"+ i +"}：{c"+ i +"}元/m²";
                    i = i + 1;
              }
              if (areaName){
                  legend_data.push({name:areaName,icon:'circle',price:areaNowPrices});
                  series.push({name: areaName, type: 'line',symbol: 'circle',symbolSize: monthLength,data: areaPrices});
                    formatter = formatter + "<br/>{a"+ i +"}：{c"+ i +"}元/m²";
                    i = i + 1;
              }
              var myChart = echarts.init(document.getElementById('{$canvas}'));
              var option = {
                  legend:{
                      left:-5,
                      top:5,
                      itemWidth:6,
                      itemHeight:6,
                      itemGap:15,
                      textStyle:{
                          color:'#333'
                      },
                      data:legend_data,
                      formatter:function(name){
                          return name ; 
                      }
                  },
                  tooltip: {
                      trigger:'axis',
                      axisPointer:{
                          lineStyle:{
                              color:'#888'
                          },
                          z:1
                      },
                      formatter:formatter
                  },
                  grid:{
                      left:0,
                      top:35,
                      right:0,
                      bottom:20
                  },
                  xAxis: {
                      name:'月份',
                      axisTick:{
                          inside:true,
                          lineStyle:{
                              color:'#ddd'
                          },
                          alignWithLabel:true
                      },
                      axisLabel:{
                          textStyle:{
                              color:'#333'
                          }
                      },
                      axisLine:{
                          lineStyle:{
                              color:'#ddd'
                          }
                      },
                      data: compareDate
                  },
                  yAxis: {
                      splitLine:{
                          lineStyle:{
                              color:'#ddd'
                          }
                      },
                      axisLine:{
                          show:false
                      }
                  },
                  series: series,
                  color:['#ed603d','#00a5e3','#1431e2','#e2dd27']
              };
              myChart.setOption(option);
          }
      </script>
EOF;

        return $result['hidden'];
    }
    /*
     * 获取楼盘价格走向
     */
    private function getXinfangtred($fields,$time_arr,$mode,$type){
        $table = $mode.'_price';
        $list = Db::name($table)->where("aid={$fields['aid']} and type={$type} and create_time<".$time_arr[0][3])
            ->field("price,month")->order("price_id asc")->getAllWithIndex("month");
        $compareDate = [];  //日期数组
        $buildPrices = [];  //楼盘价格数组
        $maxPrice = $minPrice = 0;   //最大最小值
        $last_price = 0;  //最后的价钱
        foreach ($time_arr as $key=>$val){
            $compareDate[] = $val[0];
            if (!empty($list[$val[1]])){
                $buildPrices[] = $last_price = $list[$val[1]]['price'];
                unset($list[$val[1]]);
            }else if($result = end($list)){
                $buildPrices[] = $last_price = $result['price'];
            }else{
                $buildPrices[] = $last_price;
            }
            if ($maxPrice < $last_price){
                $maxPrice = $last_price;
            }
            if ($minPrice == 0 || $minPrice > $last_price){
                $minPrice = $last_price;
            }
        }
        $compareDate = "'". implode("','",array_reverse($compareDate))."'";
        $buildNowPrices = !empty($buildPrices[0]) ? $buildPrices[0]: "";
        $buildPrices = !empty($buildPrices) ? implode(',',array_reverse($buildPrices)): "";
        return ['compareDate'=>$compareDate,'buildMaxPrice'=>$maxPrice,'buildMinPrice'=>$minPrice,'buildNowPrices'=>$buildNowPrices
            ,'buildPrices'=>$buildPrices,'buildName'=>$fields['title']];
    }
    /*
     * 获取城市价格走向
     */
    private function getCitytrend($city,$time_arr,$mode,$type){
        $table = $mode."_price";
        $aid_arr = db('archives')->where("city_id={$city}")->getField("aid",true);
        $where['aid'] = ['in',$aid_arr];
        $where['type'] = $type;
        $where['create_time'] = ['lt',$time_arr[0][3]];
        $list = Db::name($table)->where($where)->order("price_id asc")->field("aid,GROUP_CONCAT(month) as month,GROUP_CONCAT(price) as price")->group('aid')->select();
        $count = count($list);
        $compareDate = [];  //日期数组
        $buildPrices = [];  //楼盘价格数组
        $maxPrice = $minPrice = 0;   //最大最小值
        foreach ($list as $k=>$v){
            $price_list = [];
            if (!empty($v['month']) && !empty($v['price'])){
                $month_arr = explode(',',$v['month']);
                $price_arr = explode(',',$v['price']);
                foreach ($month_arr as $key=>$val){
                    $price_list[$val] = $price_arr[$key];
                }
            }
            $last_price = 0;  //最后的价钱
            foreach ($time_arr as $key=>$val){
                if ($k == 0){    //第一轮的时候给日期赋值
                    $compareDate[$key] = $val[0];
                }
                if (!empty($price_list[$val[1]])){
                    $last_price = $price_list[$val[1]];
                    $buildPrices[$key] = empty($buildPrices[$key]) ? $price_list[$val[1]] : $buildPrices[$key] + $price_list[$val[1]];
                    unset($price_list[$val[1]]);
                }else if($result = end($price_list)){
                    $last_price = $result;
                    $buildPrices[$key] = empty($buildPrices[$key]) ? $result : $buildPrices[$key] + $result;
                }else{
                    $buildPrices[$key] = empty($buildPrices[$key]) ? $last_price : $buildPrices[$key] + $last_price;
                }
                if ($maxPrice < $last_price){
                    $maxPrice = $last_price;
                }
                if ($minPrice == 0 || $minPrice > $last_price){
                    $minPrice = $last_price;
                }
                if ($k == ($count -1)){
                    $buildPrices[$key] = round($buildPrices[$key]/$count,2);
                }
            }
        }
        $cityName = M("region")->where("id={$city}")->getField('name');
        $compareDate = "'". implode("','",array_reverse($compareDate))."'";
        $buildNowPrices = !empty($buildPrices[0]) ? $buildPrices[0]: "";
        $buildPrices = !empty($buildPrices) ? implode(',',array_reverse($buildPrices)): "";
        return ['compareDate'=>$compareDate,'cityMaxPrice'=>$maxPrice,'cityMinPrice'=>$minPrice,'cityNowPrices'=>$buildNowPrices
            ,'cityPrices'=>$buildPrices,'cityName'=>$cityName];

    }
    /*
     * 获取省份价格走向
     */
    private function getProvincetrend($province,$time_arr,$mode,$type){
        $table = $mode."_price";
        $aid_arr = db('archives')->where("province_id={$province}")->getField("aid",true);
        $where['aid'] = ['in',$aid_arr];
        $where['type'] = $type;
        $where['create_time'] = ['lt',$time_arr[0][3]];
        $list = Db::name($table)->where($where)->order("price_id asc")->field("aid,GROUP_CONCAT(month) as month,GROUP_CONCAT(price) as price")->group('aid')->select();
        $count = count($list);
        $compareDate = [];  //日期数组
        $buildPrices = [];  //楼盘价格数组
        $maxPrice = $minPrice = 0;   //最大最小值
        foreach ($list as $k=>$v){
            $price_list = [];
            if (!empty($v['month']) && !empty($v['price'])){
                $month_arr = explode(',',$v['month']);
                $price_arr = explode(',',$v['price']);
                foreach ($month_arr as $key=>$val){
                    $price_list[$val] = $price_arr[$key];
                }
            }
            $last_price = 0;  //最后的价钱
            foreach ($time_arr as $key=>$val){
                if ($k == 0){    //第一轮的时候给日期赋值
                    $compareDate[$key] = $val[0];
                }
                if (!empty($price_list[$val[1]])){
                    $last_price = $price_list[$val[1]];
                    $buildPrices[$key] = empty($buildPrices[$key]) ? $price_list[$val[1]] : $buildPrices[$key] + $price_list[$val[1]];
                    unset($price_list[$val[1]]);
                }else if($result = end($price_list)){
                    $last_price = $result;
                    $buildPrices[$key] = empty($buildPrices[$key]) ? $result : $buildPrices[$key] + $result;
                }else{
                    $buildPrices[$key] = empty($buildPrices[$key]) ? $last_price : $buildPrices[$key] + $last_price;
                }
                if ($maxPrice < $last_price){
                    $maxPrice = $last_price;
                }
                if ($minPrice == 0 || $minPrice > $last_price){
                    $minPrice = $last_price;
                }
                if ($k == ($count -1)){
                    $buildPrices[$key] = round($buildPrices[$key]/$count,2);
                }
            }
        }
        $cityName = M("region")->where("id={$province}")->getField('name');
        $compareDate = "'". implode("','",array_reverse($compareDate))."'";
        $buildNowPrices = !empty($buildPrices[0]) ? $buildPrices[0]: "";
        $buildPrices = !empty($buildPrices) ? implode(',',array_reverse($buildPrices)): "";
        return ['compareDate'=>$compareDate,'provinceMaxPrice'=>$maxPrice,'provinceMinPrice'=>$minPrice,'provinceNowPrices'=>$buildNowPrices
            ,'provincePrices'=>$buildPrices,'provinceName'=>$cityName];

    }
    /*
     * 获取区域价格走向
     */
    private function getAreatrend($area,$time_arr,$mode,$type){
        $table = $mode."_price";
        $aid_arr = db('archives')->where("area_id={$area}")->getField("aid",true);
        $where['aid'] = ['in',$aid_arr];
        $where['type'] = $type;
        $where['create_time'] = ['lt',$time_arr[0][3]];
        $list = Db::name($table)->where($where)->order("price_id asc")->field("aid,GROUP_CONCAT(month) as month,GROUP_CONCAT(price) as price")->group('aid')->select();
        $count = count($list);
        $compareDate = [];  //日期数组
        $buildPrices = [];  //楼盘价格数组
        $maxPrice = $minPrice = 0;   //最大最小值
        foreach ($list as $k=>$v){
            $price_list = [];
            if (!empty($v['month']) && !empty($v['price'])){
                $month_arr = explode(',',$v['month']);
                $price_arr = explode(',',$v['price']);
                foreach ($month_arr as $key=>$val){
                    $price_list[$val] = $price_arr[$key];
                }
            }
            $last_price = 0;  //最后的价钱
            foreach ($time_arr as $key=>$val){
                if ($k == 0){    //第一轮的时候给日期赋值
                    $compareDate[$key] = $val[0];
                }
                if (!empty($price_list[$val[1]])){
                    $last_price = $price_list[$val[1]];
                    $buildPrices[$key] = empty($buildPrices[$key]) ? $price_list[$val[1]] : $buildPrices[$key] + $price_list[$val[1]];
                    unset($price_list[$val[1]]);
                }else if($result = end($price_list)){
                    $last_price = $result;
                    $buildPrices[$key] = empty($buildPrices[$key]) ? $result : $buildPrices[$key] + $result;
                }else{
                    $buildPrices[$key] = empty($buildPrices[$key]) ? $last_price : $buildPrices[$key] + $last_price;
                }
                if ($maxPrice < $last_price){
                    $maxPrice = $last_price;
                }
                if ($minPrice == 0 || $minPrice > $last_price){
                    $minPrice = $last_price;
                }
                if ($k == ($count -1)){
                    $buildPrices[$key] = round($buildPrices[$key]/$count,2);
                }
            }
        }
        $cityName = M("region")->where("id={$area}")->getField('name');
        $compareDate = "'". implode("','",array_reverse($compareDate))."'";
        $buildNowPrices = !empty($buildPrices[0]) ? $buildPrices[0]: "";
        $buildPrices = !empty($buildPrices) ? implode(',',array_reverse($buildPrices)): "";
        return ['compareDate'=>$compareDate,'areaMaxPrice'=>$maxPrice,'areaMinPrice'=>$minPrice,'areaNowPrices'=>$buildNowPrices
            ,'areaPrices'=>$buildPrices,'areaName'=>$cityName];

    }
}