<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:38:"./template/default/pc/lists_shopcs.htm";i:1580691229;s:63:"D:\ejucms\EjuCMS-V1.3.0-UTF8-SP4\template\default\pc\header.htm";i:1580692664;s:63:"D:\ejucms\EjuCMS-V1.3.0-UTF8-SP4\template\default\pc\footer.htm";i:1580691229;}*/ ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo $eju['field']['seo_title']; ?></title>
<meta name="description" content="<?php echo $eju['field']['seo_description']; ?>" />
<meta name="keywords" content="<?php echo $eju['field']['seo_keywords']; ?>" />
<link href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_cmspath"); echo $__VALUE__; ?>/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<link rel="stylesheet" type="text/css" href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/css/common.css">
<link rel="stylesheet" type="text/css" href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/css/input.css">
<link rel="stylesheet" type="text/css" href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/css/css.css">
<script src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/jquery.min.js"></script>
</head>
<body>
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

<!-- 楼盘列表 S--> 
<!-- 搜索栏 S -->
<div class="searBar ">
  <div class="comWidth clearfix">
    <div class="sear_box fl"> 
     <?php  $tagSearchform = new \think\template\taglib\eju\TagSearchform; $_result = $tagSearchform->getSearchform("24","14","","","","off"); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$k = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
      <form  method="get" action="<?php echo $field['action']; ?>">
        <div class="ipt_area fl">
          <input type="text" name="keywords" id="keywords" autocomplete="off" placeholder="请输入区域、板块开始找房" class="ipt">
          <span class="placeholder">请输入区域、板块开始找房</span>
          <ul id="search-box">
          </ul>
        </div>
        <div class="btn_area fl">
          <input type="submit" class="sbm_btn" value="搜索">
        </div>
        <?php echo $field['hidden']; ?>
      </form>
      <?php ++$e;$k++; endforeach;endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?> </div>
    <a href="<?php  $tagDiyurl = new \think\template\taglib\eju\TagDiyurl; $__VALUE__ = $tagDiyurl->getDiyurl("map"); echo $__VALUE__; ?>" class="map_btn fr">地图找房</a> </div>
</div>
<!-- 搜索栏 E -->
<div class="cm_house">
  <div class="comWidth"> 
    <!-- 页面标识 S-->
    <div class="page_tit"> <a href="javascript:;" rel="nofollow">您的位置：</a>  <?php  $typeid = ""; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagPosition = new \think\template\taglib\eju\TagPosition; $__VALUE__ = $tagPosition->getPosition($typeid, "", ""); echo $__VALUE__; ?> </div>
    <!-- 页面标识 E--> 
    <!-- 筛选栏 S -->
   <?php  $tagScreening = new \think\template\taglib\eju\TagScreening; $_result = $tagScreening->getScreening("active", "province_id,city_id,area_id,total_price,area,characteristic,manage_type", "", "全部","","","on","2","2","off","off");if(!empty($_result["list"]) || (($_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator ) && $_result["list"]->isEmpty())): $field = $_result; ?>
    <div class="seleBar">
      <div class="box">
      <div class="item clearfix">
          <h3>供求 :</h3>
          <ul class="list">
            <?php  $typeid = ""; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 2; $tagChannel = new \think\template\taglib\eju\TagChannel; $_result = $tagChannel->getChannel($typeid, "sonself", "active", "",""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($_result) ? array_slice($_result,0, $row, true) : $_result->slice(0, $row, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field2): $field2["typename"] = text_msubstr($field2["typename"], 0, 100, false); $__LIST__[$key] = $_result[$key] = $field2;$i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <li><a class="<?php echo $field2['currentstyle']; ?>" href="<?php echo $field2['typeurl']; ?>"><?php echo $field2['typename']; ?></a></li>
            <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field2 = []; ?>
          </ul>
        </div>
       <?php if(is_array($field['list']) || $field['list'] instanceof \think\Collection || $field['list'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $field['list'];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
        <div class="item clearfix">
          <h3><?php echo $vo['title']; ?> :</h3>
          <ul class="list">
            <?php if(is_array($vo['dfvalue']) || $vo['dfvalue'] instanceof \think\Collection || $vo['dfvalue'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $vo['dfvalue'];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo2): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <li><a class="<?php echo $vo2['currentstyle']; ?>" <?php echo $vo2['onClick']; ?>><?php echo $vo2['name']; ?></a></li>
            <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo2 = []; ?>
          </ul>
        </div>
        <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = []; ?>
        <?php echo $field['hidden']; endif; $field = []; ?> 
       <div class="item clearfix">
          <h3>更多 :</h3>
          <?php  $tagScreening = new \think\template\taglib\eju\TagScreening; $_result = $tagScreening->getScreening("hover", "fitment", "", "on","","","on","2","2","off","off");if(!empty($_result["list"]) || (($_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator ) && $_result["list"]->isEmpty())): $field = $_result; if(is_array($field['list']) || $field['list'] instanceof \think\Collection || $field['list'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $field['list'];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
          <div class="select_box">
            <div class="select_info"> <?php echo $vo['screen']; ?> </div>
            <ul>
              <?php if(is_array($vo['dfvalue']) || $vo['dfvalue'] instanceof \think\Collection || $vo['dfvalue'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $vo['dfvalue'];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo2): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
              <li> <a  class="<?php echo $vo2['currentstyle']; ?>" <?php echo $vo2['onClick']; ?>><?php echo $vo2['name']; ?></a> </li>
              <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo2 = []; ?>
            </ul>
          </div>
          <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = []; ?> 
        </div>
        <?php echo $field['hidden']; endif; $field = []; ?> 
        </div>
    </div>
   <?php  $tagScreening = new \think\template\taglib\eju\TagScreening; $_result = $tagScreening->getScreening("active", "", "", "全部","","","on","2","2","off","off");if(!empty($_result["list"]) || (($_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator ) && $_result["list"]->isEmpty())): $field = $_result; ?>
    <div class="container-super emptySearch" style="display: none;" id="emptySearch" >
      <div class="lp-pb-px">
        <div class="lp-pb-check1">当前找房条件：</div>
        <div class="lp-pb-check2">
          <ul>
            <?php if(is_array($field['list']) || $field['list'] instanceof \think\Collection || $field['list'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $field['list'];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 ); if(!(empty($vo['onName']) || (($vo['onName'] instanceof \think\Collection || $vo['onName'] instanceof \think\Paginator ) && $vo['onName']->isEmpty()))): ?>
            <li> <a class="select-no" <?php echo $vo['handle']; ?>><span><?php echo $vo['onName']; ?></span><b>×</b></a> </li>
            <?php endif; ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = []; ?>
            <li><a  href="<?php echo $field['resetUrl']; ?>" id="emptySearch" title="清空全部"><span>清空全部</span></a></li>
          </ul>
        </div>
      </div>
    </div>
     <?php echo $field['hidden']; endif; $field = []; ?> 

    <!-- 筛选栏 E -->
    <div class="main clearfix"> 
      <!-- 房子列表 S -->
      <div class="houseList_wrap leftArea cm_leftArea newhouse">
       
        <div class="lp_count">
          <div class="lp_con"><a class="allHouses hover" href="<?php echo $eJu['field']['typeurl']; ?>">全部房源</a></div>
          <div class="sort">
            <p id="sortParam"> 
             <?php  $TagOrderlist = new \think\template\taglib\eju\TagOrderlist; $_result = $TagOrderlist->getOrderList("hover","","up","down", "total_price", "", "默认排序","");if(!empty($_result["list"]) || (($_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator ) && $_result["list"]->isEmpty())): $field = $_result; if(is_array($field['list']) || $field['list'] instanceof \think\Collection || $field['list'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $field['list'];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 ); ?> 
              <a href="javascript:;" <?php echo $vo['onClick']; ?> class="<?php if($i != '1'): ?>sort_jg<?php endif; ?> <?php echo $vo['currentstyle']; ?> <?php echo $vo['classstyle']; ?>"><?php echo $vo['title']; ?></a> 
              <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = []; ?>
              <?php echo $field['hidden']; endif; $field = []; ?> 
             </p>
          </div>
          <div class="cl"></div>
        </div>
        <div class="cl"></div>
        <div class="list_con sh_house_list">
          <ul class="clearfix">
            <?php  $typeid = "";  if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "",      "noflag"=> "",      "channel"=> "",      "joinaid"=> "",      "users_id"=> "", ); $tagList = new \think\template\taglib\eju\TagList; $_result_tmp = $tagList->getList($param, 10, "new", "", "desc", "on");if(is_array($_result_tmp) || $_result_tmp instanceof \think\Collection || $_result_tmp instanceof \think\Paginator): $i = 0; $e = 1;$k = 0; $__LIST__ = $_result = $_result_tmp["list"]; $__PAGES__ = $_result_tmp["pages"]; $__COUNT__ = $_result_tmp["count"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 30, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <li> 
             <span class="l_img fl"> 
             <a href="<?php echo $field['arcurl']; ?>"> 
             <img src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/img/nopic.jpg" data-original="<?php echo $field['litpic']; ?>" class="lazy" alt="<?php echo $field['title']; ?>"> 
             </a> 
             </span> 
             <span class="r_con fr">
              <h3> <a href="<?php echo $field['arcurl']; ?>"> <?php echo $field['title']; ?> </a> </h3>
              <p class="shop"> <span class="info">类型：<?php echo $field['manage_type']; ?></span> <span class="info">面积：<?php echo $field['area']; ?><?php echo $field['area_unit']; ?></span></p>
              <p class="shop"> <span class="address"><?php echo get_area_name($field['area_id']); ?>-<?php echo $field['address']; ?> </span> </p>
              <p class="user-info shop"> <span><i class="iconfont">&#xe605;</i>置业顾问：<?php echo $field['sale_name']; ?></span> </p>
              <span class="label_list clearfix">
              <?php if(is_array($field['characteristic']) || $field['characteristic'] instanceof \think\Collection || $field['characteristic'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $field['characteristic'];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
				<i class="item "><?php echo $vo; ?></i>
			  <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = []; ?> 
              </span> 
              <span class="price">
              <h5><?php if(!(empty($field['total_price']) || (($field['total_price'] instanceof \think\Collection || $field['total_price'] instanceof \think\Paginator ) && $field['total_price']->isEmpty()))): ?><strong><?php echo $field['total_price']; ?></strong><?php echo $field['total_price_unit']; else: ?>暂无<?php endif; ?></h5>
              <h2><?php if(!(empty($field['average_price']) || (($field['average_price'] instanceof \think\Collection || $field['average_price'] instanceof \think\Paginator ) && $field['average_price']->isEmpty()))): ?><?php echo $field['average_price']; ?><?php echo $field['average_price_unit']; else: ?>暂无<?php endif; ?></h2>
              </span> </span> </li>
            <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
          </ul>
        </div>
          <div style="display: none" id="countlist_none" data-count=" <?php  $__COUNT__ = isset($__COUNT__) ? $__COUNT__ : ""; echo $__COUNT__; ?>"></div>
        <script  type="text/javascript">
              $(function(){
                  var count = $("#countlist_none").data("count");
                  $("#search_count").html(count);
              });
          </script>
        <div class="page_list clearfix">
          <ul class="pagination">
             <?php  $__PAGES__ = isset($__PAGES__) ? $__PAGES__ : ""; $tagPagelist = new \think\template\taglib\eju\TagPagelist; $__VALUE__ = $tagPagelist->getPagelist($__PAGES__, "pageno,pre,next", "2"); echo $__VALUE__; ?>
          </ul>
        </div>
      </div>
      <!-- 房子列表 E --> 
      <!-- 右边内容 S -->
      <div class="cm_rightArea rightArea"> 
       <?php  $tagUser = new \think\template\taglib\eju\TagUser; $__LIST__ = $tagUser->getUser("login", "off", "", "", "");if(!empty($__LIST__) || (($__LIST__ instanceof \think\Collection || $__LIST__ instanceof \think\Paginator ) && $__LIST__->isEmpty())): $field = $__LIST__; ?>
        <a href="<?php echo $field['url']; ?>" class="sale_btn mt_25">我要出租</a> 
        <a href="<?php echo $field['url']; ?>" class="sale_btn ">我要出售</a> 
        <?php echo $field['hidden']; endif; $field = []; ?>
        <a href="#" class="sale_btn ">商铺选址</a> 
        <!-- 推荐楼盘 S -->
        <div class="rcmd_build mt_25">
          <div class="title">
            <span></span>
            <h3>推荐楼盘</h3>
          </div>
          <div class="con_box">
           
            <ul class="list">
             <?php  $typeid = "1"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 5; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "c",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "0",      "users_id"=> "", ); $tag = array (
  'typeid' => '1',
  'flag' => 'c',
  'orderby' => 'new',
  'limit' => '0,5',
  'id' => 'field',
  'screen' => '0',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
              <li class="clearfix"> <a href="<?php echo $field['arcurl']; ?>">
                <div class="fl l_img"> <img src="<?php echo $field['litpic']; ?>" width="120" height="80" alt=""> </div>
                <div class="fr r_con">
                  <p class="name"><?php echo $field['title']; ?></p>
                  <p class="address"><?php echo get_city_name($field['city_id']); ?></p>
                  <p class="price"><b><?php if(!(empty($field['average_price']) || (($field['average_price'] instanceof \think\Collection || $field['average_price'] instanceof \think\Paginator ) && $field['average_price']->isEmpty()))): ?><?php echo $field['average_price']; ?><?php echo $field['price_units']; else: ?>暂无<?php endif; ?></b></p>
                </div>
                </a> </li>
            <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>  
            </ul>
          </div>
        </div>
        <!-- 推荐楼盘 E --> 
      </div>
      <!-- 右边内容 E --> 
    </div>
  </div>
</div>
<!-- 楼盘列表 S--> 

<script type="text/javascript" src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/laytpl.js"></script> 
<script type="text/javascript">
    $(function(){
        if($(".select-no").length > 0) {
            $("#emptySearch").show();
        }
    });
</script>
<script type="text/javascript">
$(function(){

	$('body').on('click',function(){
		$('#search-box').hide();
	});
})
</script>



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

</script>
</body>
</html>