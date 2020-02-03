<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:57:"./template/default/pc/view_xinfang_column_information.htm";i:1580691229;s:63:"D:\ejucms\EjuCMS-V1.3.0-UTF8-SP4\template\default\pc\header.htm";i:1580692664;s:69:"D:\ejucms\EjuCMS-V1.3.0-UTF8-SP4\template\default\pc\main_xinfang.htm";i:1580691229;s:63:"D:\ejucms\EjuCMS-V1.3.0-UTF8-SP4\template\default\pc\footer.htm";i:1580691229;}*/ ?>
<!doctype html>
<html lang="en" >
<head>
<meta charset="UTF-8">
<title><?php echo $eju['field']['seo_title']; ?>-动态</title>
<meta name="description" content="<?php echo $eju['field']['seo_description']; ?>" />
<meta name="keywords" content="<?php echo $eju['field']['seo_keywords']; ?>" />
<link href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_cmspath"); echo $__VALUE__; ?>/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<link rel="stylesheet" type="text/css" href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/css/common.css">
<link rel="stylesheet" type="text/css" href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/css/input.css">
<link rel="stylesheet" type="text/css" href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/css/css.css">
<link rel="stylesheet" type="text/css" href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/css/xinfangdt.css">
<script src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/jquery.min.js"></script>
</head>
<body  >
<!-- topBar S --> 
<div class="topBar">
  <div class="comWidth clearfix">
    <div class="logo fl"> <a href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_cmsurl"); echo $__VALUE__; ?>" title="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_name"); echo $__VALUE__; ?>"> <img src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_logo"); echo $__VALUE__; ?>" alt="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_name"); echo $__VALUE__; ?>" /> </a> </div>
    
    <div class="fl sele_city"> <a href="javascript:;"  class="sele_city_btn"><?php echo $eju['region']['name']; ?><img src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/img/icon15.png" alt="" class="icon"></a>
      <div class="city_list clearfix"> <i class="city-close">关闭</i>
        <dl class="clearfix">
          <?php  $row = 60; $tagRegion = new \think\template\taglib\eju\TagRegion; $_result = $tagRegion->getRegion("selflevel", "hot", "1,2,3", "", "", "desc", "","","","initial"); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$k = 0;$__LIST__ = is_array($_result) ? array_slice($_result,0, $row, true) : $_result->slice(0, $row, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $field["name"] = text_msubstr($field["name"], 0, 100, false); $__LIST__[$key] = $_result[$key] = $field;$i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <dd><a href="javascript:;"><?php echo $key; ?></a></dd>
            <?php if(is_array($field) || $field instanceof \think\Collection || $field instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $field;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <dd class="<?php echo $vo['currentstyle']; ?>"><a href="<?php echo $vo['domainurl']; ?>" title="<?php echo $vo['name']; ?>"><?php echo $vo['name']; ?></a></dd>
            <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = []; ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
        </dl>
      </div>
    </div>
    <div class="navBar fl">
      <ul class="nav_list fl">
        <li <?php if(CONTROLLER_NAME == 'Index'): ?>class="active"<?php endif; ?>> <a href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_cmsurl"); echo $__VALUE__; ?>">首页</a> </li>
        
        <?php  $typeid = ""; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 10; $tagChannel = new \think\template\taglib\eju\TagChannel; $_result = $tagChannel->getChannel($typeid, "top", "active", "",""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($_result) ? array_slice($_result,0, $row, true) : $_result->slice(0, $row, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $field["typename"] = text_msubstr($field["typename"], 0, 100, false); $__LIST__[$key] = $_result[$key] = $field;$i= intval($key) + 1;$mod = ($i % 2 ); ?>
        <li class="<?php echo $field['currentstyle']; ?>"> <a href="<?php echo $field['typeurl']; ?>"><?php echo $field['typename']; ?></a>
         <?php if((empty($field['children']) != true) or (in_array($field['typeid'],[1,11,12]))): ?>
          <ul>
            <?php  $typeid = ""; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 100;if(is_array($field['children']) || $field['children'] instanceof \think\Collection || $field['children'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($field['children']) ? array_slice($field['children'],0,100, true) : $field['children']->slice(0,100, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field2): $field2["typename"] = text_msubstr($field2["typename"], 0, 100, false); $__LIST__[$key] = $_result[$key] = $field2;$i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <li><a href="<?php echo $field2['typeurl']; ?>"><?php echo $field2['typename']; ?></a></li>
            <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field2 = []; if($field['typeid'] == '1'): ?>
             <li><a href="<?php  $tagDiyurl = new \think\template\taglib\eju\TagDiyurl; $__VALUE__ = $tagDiyurl->getDiyurl("map"); echo $__VALUE__; ?>">地图找房</a></li>
            <?php endif; if($field['typeid'] == '11'): ?>
             <li><a href="<?php  $tagDiyurl = new \think\template\taglib\eju\TagDiyurl; $__VALUE__ = $tagDiyurl->getDiyurl("mapershou"); echo $__VALUE__; ?>">地图找房</a></li>
            <?php endif; if($field['typeid'] == '12'): ?>
             <li><a href="<?php  $tagDiyurl = new \think\template\taglib\eju\TagDiyurl; $__VALUE__ = $tagDiyurl->getDiyurl("mapzufang"); echo $__VALUE__; ?>">地图找房</a></li>
            <?php endif; ?>
          </ul>
            <?php endif; ?>
          </li>
        <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
      </ul>
    </div>
    <div class="log_link fr"> 
      <!-- 未登录状态 -->
      <div class="not_log"> 
       <?php  $tagUser = new \think\template\taglib\eju\TagUser; $__LIST__ = $tagUser->getUser("open", "off", "", "", "");if(!empty($__LIST__) || (($__LIST__ instanceof \think\Collection || $__LIST__ instanceof \think\Paginator ) && $__LIST__->isEmpty())): $field = $__LIST__;  $tagUser = new \think\template\taglib\eju\TagUser; $__LIST__ = $tagUser->getUser("login", "off", "", "", "");if(!empty($__LIST__) || (($__LIST__ instanceof \think\Collection || $__LIST__ instanceof \think\Paginator ) && $__LIST__->isEmpty())): $field = $__LIST__; ?> <a href="<?php echo $field['url']; ?>" id="<?php echo $field['id']; ?>">登录</a> / 
        <?php echo $field['hidden']; endif; $field = [];  $tagUser = new \think\template\taglib\eju\TagUser; $__LIST__ = $tagUser->getUser("reg", "off", "", "", "");if(!empty($__LIST__) || (($__LIST__ instanceof \think\Collection || $__LIST__ instanceof \think\Paginator ) && $__LIST__->isEmpty())): $field = $__LIST__; ?> <a href="<?php echo $field['url']; ?>" id="<?php echo $field['id']; ?>">注册</a> <?php echo $field['hidden']; endif; $field = [];  $tagUser = new \think\template\taglib\eju\TagUser; $__LIST__ = $tagUser->getUser("logout", "off", "", "", "");if(!empty($__LIST__) || (($__LIST__ instanceof \think\Collection || $__LIST__ instanceof \think\Paginator ) && $__LIST__->isEmpty())): $field = $__LIST__; ?> <a href="<?php echo $field['url']; ?>" id="<?php echo $field['id']; ?>">退出</a> <?php echo $field['hidden']; endif; $field = []; endif; $field = []; ?> </div>
    </div>
  </div>
</div> 
<!-- topBar E --> 

<!-- 楼盘详情 S-->
<div class="newhouse_detail"> <script src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/jquery.qrcode.min.js"></script>
 <!-- 页面标识 S-->
  <div class="position">
    <div class="fix-width"> <a href="javascript:;" rel="nofollow">您的位置：</a>  <?php  $typeid = ""; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagPosition = new \think\template\taglib\eju\TagPosition; $__VALUE__ = $tagPosition->getPosition($typeid, "", ""); echo $__VALUE__; ?> > <?php echo $eju['field']['title']; ?> </div>
  </div>
  <!-- 页面标识 E-->
   <div class="house-title">
    <div class="fix-width clearfix">
      <div class="house-qrcode fl" id="qrcode" >
        <div class="layer_wei" style="display: none;" id="layer_wei">
          <p>手机看房<br>
            更方便</p>
        </div>
      </div>
      <script>
			$(function(){
				$('#qrcode').qrcode('<?php echo $eju['field']['arcurl']; ?>');
				$("#qrcode").mouseover(function(){
					$("#layer_wei").show();
				});
				$("#qrcode").mouseleave(function(){
					$("#layer_wei").hide();
				});
			})
			

		</script>
      <div class="house-tags fl">
        <h1><?php echo $eju['field']['title']; ?></h1>
        <div class="tags"> <span><?php echo $eju['field']['sale_status']; ?></span> <?php if(is_array($eju['field']['characteristic']) || $eju['field']['characteristic'] instanceof \think\Collection || $eju['field']['characteristic'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $eju['field']['characteristic'];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 ); ?><span><?php echo $vo; ?></span><?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = []; ?></div>
      </div>
      <div class="liue fr">
        <p class="font14"> 售楼处电话 </p>
        <p><span id="build_centerphone_header"><i style="color:#e8380d;"><?php echo $eju['field']['sale_phone']; ?></i><?php if(!(empty($eju['field']['phone_code']) || (($eju['field']['phone_code'] instanceof \think\Collection || $eju['field']['phone_code'] instanceof \think\Paginator ) && $eju['field']['phone_code']->isEmpty()))): ?>&nbsp;<span>转</span>&nbsp;<?php echo $eju['field']['phone_code']; endif; ?></span></p>
      </div>
    </div>
  </div>
  <div class="fix-width nav_house">
    <div class="house_move_act">
      <ul>
        <li <?php if(empty($eju['param']['column']) || (($eju['param']['column'] instanceof \think\Collection || $eju['param']['column'] instanceof \think\Paginator ) && $eju['param']['column']->isEmpty())): ?> class="hover"<?php endif; ?>> <a href="<?php echo arcurl('home/Xinfang/index',['aid'=>$eju['field']['xinfang']['aid'],'dirname'=>$eju['field']['xinfang']['dirname'],'dirpath'=>$eju['field']['xinfang']['dirpath']]); ?>" >楼盘主页</a> </li>
        <li <?php if(!(empty($eju['param']['column']) || (($eju['param']['column'] instanceof \think\Collection || $eju['param']['column'] instanceof \think\Paginator ) && $eju['param']['column']->isEmpty()))): if($eju['param']['column'] == 'information'): ?> class="hover"<?php endif; endif; ?>>
        <a href="<?php echo arcurl('home/Xinfang/index',['aid'=>$eju['field']['xinfang']['aid'],'dirname'=>$eju['field']['xinfang']['dirname'],'dirpath'=>$eju['field']['xinfang']['dirpath'],'column'=>'information']); ?>" >楼盘动态</a>
        </li>
        <li <?php if(!(empty($eju['param']['column']) || (($eju['param']['column'] instanceof \think\Collection || $eju['param']['column'] instanceof \think\Paginator ) && $eju['param']['column']->isEmpty()))): if($eju['param']['column'] == 'huxing'): ?> class="hover"<?php endif; endif; ?>>
        <a href="<?php echo arcurl('home/Xinfang/index',['aid'=>$eju['field']['xinfang']['aid'],'dirname'=>$eju['field']['xinfang']['dirname'],'dirpath'=>$eju['field']['xinfang']['dirpath'],'column'=>'huxing']); ?>"  >在售户型</a>
        </li>
        <li <?php if(!(empty($eju['param']['column']) || (($eju['param']['column'] instanceof \think\Collection || $eju['param']['column'] instanceof \think\Paginator ) && $eju['param']['column']->isEmpty()))): if($eju['param']['column'] == 'photo'): ?> class="hover"<?php endif; endif; ?>>
        <a href="<?php echo arcurl('home/Xinfang/index',['aid'=>$eju['field']['xinfang']['aid'],'dirname'=>$eju['field']['xinfang']['dirname'],'dirpath'=>$eju['field']['xinfang']['dirpath'],'column'=>'photo']); ?>" >楼盘相册</a>
        </li>
        <li <?php if(!(empty($eju['param']['column']) || (($eju['param']['column'] instanceof \think\Collection || $eju['param']['column'] instanceof \think\Paginator ) && $eju['param']['column']->isEmpty()))): if($eju['param']['column'] == 'detail'): ?> class="hover"<?php endif; endif; ?>>
        <a href="<?php echo arcurl('home/Xinfang/index',['aid'=>$eju['field']['xinfang']['aid'],'dirname'=>$eju['field']['xinfang']['dirname'],'dirpath'=>$eju['field']['xinfang']['dirpath'],'column'=>'detail']); ?>" >楼盘信息</a>
        </li>
        <li <?php if(!(empty($eju['param']['column']) || (($eju['param']['column'] instanceof \think\Collection || $eju['param']['column'] instanceof \think\Paginator ) && $eju['param']['column']->isEmpty()))): if($eju['param']['column'] == 'ask'): ?> class="hover"<?php endif; endif; ?>>
        <a href="<?php echo arcurl('home/Xinfang/index',['aid'=>$eju['field']['xinfang']['aid'],'dirname'=>$eju['field']['xinfang']['dirname'],'dirpath'=>$eju['field']['xinfang']['dirpath'],'column'=>'ask']); ?>" >楼盘问答</a>
        </li>
      </ul>
    </div>
  </div>
  <div class="main_1200 clearfix">
    <div class="w880 clearfix fl">
      <div id="gushi_all" class="select-tab"> 
        <!-- 列表内容 -->
        <ul class="zs-list zxdt-list storyUL">
         <?php  $typeid = "4"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 10; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> $eju['field']['aid'],      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'typeid' => '4',
  'joinaid' => '$eju.field.aid',
  'limit' => '0,10',
  'titlelen' => '30',
  'orderby' => 'new',
  'orderWay' => 'desc',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 30, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
          <li id="xflpdt_A02_01" class="storyList">
            <div class="sLTime"><?php echo MyDate('Y-m-d H:i:s',$eju['field']['add_time']); ?>
              <div class="sLDot"></div>
            </div>
            <h2><a class="bold" href="/<?php echo $field['arcurl']; ?>" target="_blank"><?php echo $field['title']; ?></a></h2>
            <p class="c6_f14"><?php echo html_msubstr($field['seo_description'],0,100,true); ?>
              [<a href="<?php echo $field['arcurl']; ?>" target="_blank">详情</a>]</p>
          </li>
          <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>   
        </ul>
      
      <!--楼盘故事 end--> 
      
     </div>
    </div>
    <div class="right-box"> 
      <?php  $typeid = "6"; $row = 10; $tagChannelartlist = new \think\template\taglib\eju\TagChannelartlist; $_result = $tagChannelartlist->getChannelartlist($typeid, "self"); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($_result) ? array_slice($_result,0, $row, true) : $_result->slice(0, $row, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$channelartlist): $channelartlist["typename"] = text_msubstr($channelartlist["typename"], 0, 100, false); $__LIST__[$key] = $_result[$key] = $channelartlist;$i= intval($key) + 1;$mod = ($i % 2 ); ?>
      <dl class="news-window">
        <dt class="clears"> <span class="djdk"><?php  $__VALUE__ = isset($channelartlist["typename"]) ? $channelartlist["typename"] : "变量名不存在"; echo $__VALUE__; ?></span> 
        </dt>
        <dd style="padding: 8px 0;">
          <ul class="window-link-ul">
            <?php  $typeid = ""; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 5; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'row' => '5',
  'titlelen' => '30',
  'orderby' => 'new',
  'orderWay' => 'desc',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 30, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <li><i></i><a a href="<?php echo $field['arcurl']; ?>" title="<?php echo $field['title']; ?>" target="_blank"><?php echo $field['title']; ?></a></li>
            <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>   
          </ul>
        </dd>
      </dl>
      <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $typeid = $row = ""; unset($channelartlist);  $typeid = "13"; $row = 10; $tagChannelartlist = new \think\template\taglib\eju\TagChannelartlist; $_result = $tagChannelartlist->getChannelartlist($typeid, "self"); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($_result) ? array_slice($_result,0, $row, true) : $_result->slice(0, $row, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$channelartlist): $channelartlist["typename"] = text_msubstr($channelartlist["typename"], 0, 100, false); $__LIST__[$key] = $_result[$key] = $channelartlist;$i= intval($key) + 1;$mod = ($i % 2 ); ?>
      <dl class="news-window">
        <dt class="clears"> <span class="djdk"><?php  $__VALUE__ = isset($channelartlist["typename"]) ? $channelartlist["typename"] : "变量名不存在"; echo $__VALUE__; ?></span> 
        </dt>
        <dd style="padding: 8px 0;">
          <ul class="window-link-ul">
            <?php  $typeid = ""; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 5; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'row' => '5',
  'titlelen' => '30',
  'orderby' => 'new',
  'orderWay' => 'desc',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 30, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <li><i></i><a a href="<?php echo $field['arcurl']; ?>" title="<?php echo $field['title']; ?>" target="_blank"><?php echo $field['title']; ?></a></li>
            <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>   
          </ul>
        </dd>
      </dl>
      <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $typeid = $row = ""; unset($channelartlist); ?>
    </div>
  </div>
</div>
<!-- 楼盘详情 E--> 




<link rel="stylesheet" type="text/css" href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/css/foot.css">
<!-- 公共底部 start -->
<div class="footer-v5">
  <div class="wrap-v5 comWidth">
    <div class="aboutcopy">
      <ul class="clearfix">
        <?php  $typeid = "8"; $row = 10; $tagChannelartlist = new \think\template\taglib\eju\TagChannelartlist; $_result = $tagChannelartlist->getChannelartlist($typeid, "son"); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($_result) ? array_slice($_result,0, $row, true) : $_result->slice(0, $row, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$channelartlist): $channelartlist["typename"] = text_msubstr($channelartlist["typename"], 0, 100, false); $__LIST__[$key] = $_result[$key] = $channelartlist;$i= intval($key) + 1;$mod = ($i % 2 ); ?> 
        <li><a href="<?php  $__VALUE__ = isset($channelartlist["typeurl"]) ? $channelartlist["typeurl"] : "变量名不存在"; echo $__VALUE__; ?>" target="_blank" rel="nofollow"><?php  $__VALUE__ = isset($channelartlist["typename"]) ? $channelartlist["typename"] : "变量名不存在"; echo $__VALUE__; ?></a></li>
       <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $typeid = $row = ""; unset($channelartlist); ?> 
      </ul>
    </div>
    <div class="links-v5"> 
      <!--城市导航 start--> 
      <!-- 展开添加样式on -->
      <div class="linkrow">
        <div class="ftlinkswrap"> <span class="linkstit-v5"><?php echo $eju['region']['name']; ?>导航</span>
          <div class="linkscont-v5">
            <p>你可以按区域查找<?php echo $eju['region']['name']; ?>新房、二手房，也可以按区域查询<?php echo $eju['region']['name']; ?>房价。同时，你买房 过程中遇到的很多问题都可以在这里得到解答。</p>
          </div>
          <i class="footmore"></i> </div>
        <!--展开内容 start-->
        <div class="szdhwrap">
          <div class="szdh-item">
            <div class="szdh-lab">区域新房</div>
            <ul class="szdh-list clearfix">
             <?php  $row = 60; $tagRegion = new \think\template\taglib\eju\TagRegion; $_result = $tagRegion->getRegion("son", "", "", "", "", "desc", "","","",""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$k = 0;$__LIST__ = is_array($_result) ? array_slice($_result,0, $row, true) : $_result->slice(0, $row, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $field["name"] = text_msubstr($field["name"], 0, 100, false); $__LIST__[$key] = $_result[$key] = $field;$i= intval($key) + 1;$mod = ($i % 2 ); ?>
              <li><a href="<?php echo $field['domainurl']; ?>" target="_blank"><?php echo $field['name']; ?></a></li>
             <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
            </ul>
          </div>
          <div class="szdh-item">
            <div class="szdh-lab">区域二手房</div>
            <ul class="szdh-list clearfix">
             <?php  $tagScreening = new \think\template\taglib\eju\TagScreening; $_result = $tagScreening->getScreening("", "", "", "","11","","on","2","2","off","off");if(!empty($_result["list"]) || (($_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator ) && $_result["list"]->isEmpty())): $field = $_result; if(is_array($field['list']) || $field['list'] instanceof \think\Collection || $field['list'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($field['list']) ? array_slice($field['list'],0,1, true) : $field['list']->slice(0,1, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 ); if(is_array($vo['dfvalue']) || $vo['dfvalue'] instanceof \think\Collection || $vo['dfvalue'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $vo['dfvalue'];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo2): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
					<li><a <?php echo $vo2['onClick']; ?>><?php echo $vo2['name']; ?>二手房</a></li>
					<?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo2 = []; ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = []; ?>
				<?php echo $field['hidden']; endif; $field = []; ?> 
            </ul>
          </div>

          
        </div>
        <!--展开内容 end--> 
      </div>
      <!--城市导航 end--> 
      
      <!--热门城市 start--> 
      <!-- 展开添加样式on -->
      <div class="linkrow">
        <div class="ftlinkswrap"> <span class="linkstit-v5">热门城市</span>
          <div class="linkscont-v5">
            <ul class="alinklist clearfix">
              <!--热门城市开始-->
              <?php  $row = 60; $tagRegion = new \think\template\taglib\eju\TagRegion; $_result = $tagRegion->getRegion("son", "", "", "", "", "desc", "","","",""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$k = 0;$__LIST__ = is_array($_result) ? array_slice($_result,0, $row, true) : $_result->slice(0, $row, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $field["name"] = text_msubstr($field["name"], 0, 100, false); $__LIST__[$key] = $_result[$key] = $field;$i= intval($key) + 1;$mod = ($i % 2 ); ?>
              <li><a href="<?php echo $field['domainurl']; ?>" target="_blank"><?php echo $field['name']; ?></a></li>
              <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
              <!--热门城市结束-->
            </ul>
          </div>
          <i class="footmore"></i> </div>
      </div>
      <!--热门城市 end--> 
      <!--周边城市 start--> 
      <!-- 展开添加样式on -->
      
      <!--周边城市 end--> 
      <!-- 展开添加样式on -->
      
      <div class="linkrow" id="yqljdiv">
        <div class="ftlinkswrap"> <span class="linkstit-v5">友情链接</span>
          <div class="linkscont-v5">
            <ul class="alinklist clearfix">
             <?php  $tagFlink = new \think\template\taglib\eju\TagFlink; $_result = $tagFlink->getFlink("text", "0,100"); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$k = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $field["title"] = text_msubstr($field["title"], 0, 20, false); $__LIST__[$key] = $_result[$key] = $field;$i= intval($key) + 1;$mod = ($i % 2 ); ?> 
              <li><a href="<?php echo $field['url']; ?>" <?php echo $field['target']; ?>><?php echo $field['title']; ?></a></li>
             <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
            </ul>
          </div>
          <i class="footmore"></i></div>
      </div>
    </div>
    <div class="conyfiv">
      <p><?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_copyright"); echo $__VALUE__; ?></p>
      <p><?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_recordnum"); echo $__VALUE__; ?><span>|</span>
        <a href="#" target="_blank" rel="nofollow">增值电信业务经营许可证</a><span>|</span>
        <a href="#" target="_blank" rel="nofollow">房地产经纪机构备案</a><span>|</span>
        <a href="http://szcert.ebs.org.cn/" target="_blank" rel="nofollow">工商网监</a><span>|</span>
        <a href="http://si.trustutn.org/" target="_blank" rel="nofollow">中国电子认证服务产业联盟</a><span>|</span>
        <a href="http://www.beian.gov.cn/" target="_blank" rel="nofollow">粤公网安备&nbsp;&nbsp;0000000号&nbsp</a>
      </p>
    </div>
  </div>
</div>
<!-- 公共底部 end --> 
<!-- common.js与老版本js存在冲突，必须放页面最底部     js文件加载顺序有关 --> 
<script type="text/javascript" src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/foot.js"></script>
<script type="text/javascript" src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/common.js"></script>
<!-- 公共底部 end -->
 
<script src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/jquery.lazyload.js"></script> 
<script src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/layer.js"></script> 
<script>
    $("img.lazy").lazyload({
        threshold : 100,
        effect : "fadeIn"
        //event: "scrollstop"
    });
    $(function(){
       $('.follow').on('click',function(){
           var house_id = $(this).data('id'),model = $(this).data('model'),url = $(this).data('uri'),me = $(this);
           $.post(url,{house_id:house_id,model:model},function(result){
               if(result.code == 1)
               {
                   layer.msg(result.msg,{icon:1});
                   if(me.hasClass('on'))
                   {
                       me.removeClass('on').text(result.text);
                   }else{
                       me.addClass('on').text(result.text);
                   }
               }else{
                   layer.msg(result.msg,{icon:2});
               }
           });
       });
    });
</script>
</body>
</html>