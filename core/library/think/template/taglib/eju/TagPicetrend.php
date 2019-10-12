<?php
/**
 * Created by PhpStorm.
 * User: 28773
 * Date: 2019/8/7
 * Time: 17:24
 */

namespace think\template\taglib\eju;

use think\Db;

class TagPicetrend extends Base
{
    protected function _initialize()
    {
        parent::_initialize();
    }
    public function getPicetrend($fields = '',$month = 0,$city = 0,$province = 0,$format = "Y-m月",$canvas = "fjChart"){
        $result = ['compareDate'=>"",'maxPrice'=>"",'minPrice'=>"",'buildNowPrices'=>""
            ,'buildPrices'=>"",'buildName'=>"",'cityNowPrices'=>"",'cityPrices'=>"",'cityName'=>"","provinceNowPrices"=>""
            ,"provincePrices"=>"",'provinceName'=>""];
        $time_arr = to_month($month,$format);
        if (!empty($fields)){
            $xinfangInfo =  $this->getXinfangtred($fields,$time_arr);
        }
        if (!empty($xinfangInfo)){
            $result = array_merge($result,$xinfangInfo);
        }
        if (!empty($city)){
            $cityInfo = $this->getCitytrend($city,$time_arr);
        }
        if (!empty($cityInfo)){
            $result = array_merge($result,$cityInfo);
        }
        if (!empty($province)){
            $provinceInfo = $this->getProvincetrend($province,$time_arr);
        }
        if (!empty($provinceInfo)){
            $result = array_merge($result,$provinceInfo);
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
              var datetext = "{$result['compareDate']}";
              var cityPrices  = eval('[' + ctext + ']');
              var buildPrices  = eval('[' + btext + ']');
              var compareDate  = eval('[' + datetext + ']');
              var cityNowPrices = "{$result['cityNowPrices']}";
              var buildNowPrices = "{$result['buildNowPrices']}";
              var cityName = "{$result['cityName']}";
              var buildName = "{$result['buildName']}";
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
                  color:['#ed603d','#00a5e3']
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
    private function getXinfangtred($fields,$time_arr){
        $list = db("xinfang_price")->where("aid={$fields['aid']} and type=1 and create_time<".$time_arr[0][3])
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
    private function getCitytrend($city,$time_arr){
        $aid_arr = db('archives')->where("city_id={$city}")->getField("aid",true);
        $where['aid'] = ['in',$aid_arr];
        $where['type'] = 1;
        $where['create_time'] = ['lt',$time_arr[0][3]];
        $list = db("xinfang_price")->where($where)->order("price_id asc")->field("aid,GROUP_CONCAT(month) as month,GROUP_CONCAT(price) as price")->group('aid')->select();
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
    private function getProvincetrend($province,$time_arr){
        $aid_arr = db('archives')->where("province_id={$province}")->getField("aid",true);
        $where['aid'] = ['in',$aid_arr];
        $where['type'] = 1;
        $where['create_time'] = ['lt',$time_arr[0][3]];
        $list = db("xinfang_price")->where($where)->order("price_id asc")->field("aid,GROUP_CONCAT(month) as month,GROUP_CONCAT(price) as price")->group('aid')->select();
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
        return ['compareDate'=>$compareDate,'cityMaxPrice'=>$maxPrice,'cityMinPrice'=>$minPrice,'cityNowPrices'=>$buildNowPrices
            ,'cityPrices'=>$buildPrices,'cityName'=>$cityName];

    }
}