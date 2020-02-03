<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:31:"./template/default/pc/index.htm";i:1580691229;s:63:"D:\ejucms\EjuCMS-V1.3.0-UTF8-SP4\template\default\pc\header.htm";i:1580692664;s:63:"D:\ejucms\EjuCMS-V1.3.0-UTF8-SP4\template\default\pc\footer.htm";i:1580691229;}*/ ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_title"); echo $__VALUE__; ?></title>
<meta name="description" content="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_description"); echo $__VALUE__; ?>" />
<meta name="keywords" content="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_keywords"); echo $__VALUE__; ?>" />
<link href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_cmspath"); echo $__VALUE__; ?>/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/css/common.css">
<link rel="stylesheet" type="text/css" href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/css/input.css">
<link rel="stylesheet" type="text/css" href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/css/swiper.min.css">
<link rel="stylesheet" type="text/css" href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/css/index.css">
<link rel="stylesheet" type="text/css" href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/css/jquery.slide-packer.css">
<script type="text/javascript" src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/swiper.min.js"></script>
<script type="text/javascript" src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/jquery.slide-packer.js"></script>
</head>
<body>
<div class="index"> 
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
  
  <!-- banner S -->
  
  <div class="banner" >
    <div class="banner-2"> 
      <!--图片轮播-->
      <div class="carousel-inner">
        <div class="swiper-container">
          <div class="swiper-wrapper"> <?php  $tagAdv = new \think\template\taglib\eju\TagAdv; $_result = $tagAdv->getAdv(1, "", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($_result) ? array_slice($_result,0, 10, true) : $_result->slice(0, 10, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field):  if ($i == 0) : $field["currentstyle"] = ""; else:  $field["currentstyle"] = ""; endif;$i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <div class="swiper-slide"><a href="<?php echo $field['links']; ?>" style="background-image:url(<?php echo $field['litpic']; ?>);" target="_blank" class=""></a></div>
            <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?> </div>
        </div>
        <div class="swiper-pagination swiper-pagination-white"></div>
        <div class="fxe_banner"> <a class="prev" href="javascript:void(0)" style="left: 10%;"></a> <a class="next" href="javascript:void(0)" style="right: 10%;"></a> </div>
      </div>
      <script>
		//轮播图初始化
		var swiper = new Swiper('.swiper-container', {
		pagination: '.swiper-pagination',
		paginationClickable: '.swiper-pagination',
		nextButton: '.next',
		prevButton: '.prev',
		spaceBetween: 30,
		effect: 'fade',
		centeredSlides: true,
		autoplay: 5000,
		autoplayDisableOnInteraction: false,
		loop: true
        });
    </script>
      <div class="search-box">
        <div class="opacity"></div>
        <div class="search-content">
          <div class="search-type"> <a href="javascript:;" class="active" data-uri="/loupan.html">新房</a> <a href="javascript:;" data-uri="/esf.html">二手</a> <a href="javascript:;" data-uri="/chuzu.html">出租</a> <a href="javascript:;" data-uri="/xiaoqu.html">小区</a> </div>
          <div class="search-input clearfix" id="ser1"> <i></i> <?php  $tagSearchform = new \think\template\taglib\eju\TagSearchform; $_result = $tagSearchform->getSearchform("","9","","","","off"); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$k = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <form  method="get" action="<?php echo $field['action']; ?>">
              <input type="text" name="keywords" class="search-input-text fl" placeholder="输入关键词搜索">
              <button  type="submit"  class="search-btn fl"></button>
              <?php echo $field['hidden']; ?>
            </form>
            <?php ++$e;$k++; endforeach;endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?> </div>
          <div class="search-keyword"> <span>热门搜索：</span> <?php  $typeid = "1"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 3; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "a",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'typeid' => '1',
  'flag' => 'a',
  'orderby' => 'new',
  'limit' => '0,3',
  'id' => 'field',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?><a href="<?php echo $field['arcurl']; ?>" target="_blank"><?php echo $field['title']; ?></a>
              <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?> </div>
        </div>
      </div>
    </div>
  </div>
  <!-- banner E --> <!-- menu S -->
  <div class="label_menu">
    <div class="newtool">
      <div class="newtoolnr">
        <div class="Ntd">
          <div class="tjf10"></div>
          
          <div class="s3"> <a href="<?php  $typeid = "1"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?><?php echo $field['typeurl']; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>" target="_blank">买房</a> </div>
          
          <div class="s2">
            <p> 
            <?php  $typeid = "1"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?>
            <a href="<?php echo $field['typeurl']; ?>" target="_blank"><?php echo $field['typename']; ?></a> 
            <?php endif; else: echo htmlspecialchars_decode("");endif; $field = [];  $typeid = "11"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?>
            <a href="<?php echo $field['typeurl']; ?>" target="_blank"><?php echo $field['typename']; ?></a> 
            <?php endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
            </p>
            <p> 
            <?php  $typeid = "3"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?>
            <a href="<?php echo $field['typeurl']; ?>" target="_blank"><?php echo $field['typename']; ?></a> 
            <?php endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
            </p>
            </div>
        </div>
        <div class="Ntd mal01">
          <div class="s3"> <a href="<?php  $typeid = "36"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?><?php echo $field['typeurl']; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>" target="_blank">卖房</a> </div>
          <div class="s2">
            <p> 
            <?php  $typeid = "36"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?>
            <a href="<?php echo $field['typeurl']; ?>" target="_blank"><?php echo $field['typename']; ?></a> 
            <?php endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
            </p>
            <p> <a href="#" target="_blank" >查房价</a> </p>
          </div>
        </div>
        <div class="Ntd mal01">
          <div class="s3"> <a href="<?php  $typeid = "21"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?><?php echo $field['typeurl']; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>" target="_blank">租房</a> </div>
          <div class="s2">
            <p> 
            <?php  $typeid = "21"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?>
            <a href="<?php echo $field['typeurl']; ?>" target="_blank">找租房</a> 
            <?php endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
            </p>
            <p> 
            <?php  $typeid = "32"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?>
            <a href="<?php echo $field['typeurl']; ?>" target="_blank"><?php echo $field['typename']; ?></a> 
            <?php endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
            </p>
          </div>
        </div>
        <div class="Ntd mal01">
          <div class="s3"> <a href="<?php  $typeid = "24"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?><?php echo $field['typeurl']; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>" target="_blank">商用</a> </div>
          <div class="s2">
            <p> 
            <?php  $typeid = "24"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?>
            <a href="<?php echo $field['typeurl']; ?>" target="_blank"><?php echo $field['typename']; ?></a> 
            <?php endif; else: echo htmlspecialchars_decode("");endif; $field = [];  $typeid = "27"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?>
            <a href="<?php echo $field['typeurl']; ?>" target="_blank"><?php echo $field['typename']; ?></a> 
            <?php endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
            </p>
            <p> 
            <?php  $typeid = "25"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?>
            <a href="<?php echo $field['typeurl']; ?>" target="_blank"><?php echo $field['typename']; ?></a> 
            <?php endif; else: echo htmlspecialchars_decode("");endif; $field = [];  $typeid = "28"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?>
            <a href="<?php echo $field['typeurl']; ?>" target="_blank"><?php echo $field['typename']; ?></a> 
            <?php endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
            </p>
          </div>
        </div>
        <div class="Ntd mal01 nob">
          <div class="s3"> <a href="<?php  $typeid = "17"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?><?php echo $field['typeurl']; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>" target="_blank" id="dsy_D03_62">其他</a> </div>
          <div class="s2">
            <p> 
            <?php  $typeid = "17"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?>
            <a href="<?php echo $field['typeurl']; ?>" target="_blank"><?php echo $field['typename']; ?></a> 
            <?php endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
            <a href="<?php  $tagDiyurl = new \think\template\taglib\eju\TagDiyurl; $__VALUE__ = $tagDiyurl->getDiyurl("map"); echo $__VALUE__; ?>" target="_blank">地图找房</a> 
            </p>
            <p> 
            <a href="<?php  $tagDiyurl = new \think\template\taglib\eju\TagDiyurl; $__VALUE__ = $tagDiyurl->getDiyurl("map"); echo $__VALUE__; ?>" target="_blank">地图找房</a> 
            </p>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- menu E --> <!-- 内容 S-->
  <div class="wrap">
    <div class="comWidth bgfff"> 
      <!-- 热门房子 S -->
      <div class="hot_house">
        <div class="hot_house">
          <ul class="poster clearfix">
            <?php  $tagAdv = new \think\template\taglib\eju\TagAdv; $_result = $tagAdv->getAdv(2, "", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($_result) ? array_slice($_result,0, 4, true) : $_result->slice(0, 4, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field):  if ($i == 0) : $field["currentstyle"] = ""; else:  $field["currentstyle"] = ""; endif;$i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <li><a href="<?php echo $field['links']; ?>" <?php echo $field['target']; ?>><img alt="<?php echo $field['title']; ?>" src="<?php echo $field['litpic']; ?>" width="100%"></a></li>
            <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
          </ul>
        </div>
      </div>
      <!-- 热门房子 E -->
      <div class="rent_house cm_wrap">
        <div class="hostit clearfix">
          <ul class="r_nav fr" id="rec_house">
            <li class="active"> <a href="javascript:;">特价楼盘</a></li>
            <li> <a href="javascript:;">刚需楼盘</a></li>
            <li> <a href="javascript:;">热销楼盘</a></li>
          </ul>
        </div>
        <div class="content"> 
          <!-- 楼盘列表 S -->
          <div class="build_list" id="rec_house_box">
            <ul class="clearfix" >
              <?php  $typeid = "1"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 4; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "h",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'typeid' => '1',
  'flag' => 'h',
  'orderby' => 'new',
  'limit' => '0,4',
  'id' => 'field',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
              <li> <a href="<?php echo $field['arcurl']; ?>" target="_blank"> <span class="img"> <img src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/img/nopic.jpg" data-original="<?php echo $field['litpic']; ?>" class="lazy" alt="<?php echo $field['title']; ?>"> <span class="img_ft"><em>查看详情</em> <span class="txt_box clearfix"> <span class="tit"><?php echo $field['title']; ?></span> </span> <span class="tit_bg"></span> </span> </span> <span class="ft clearfix"> <span class="fr area"><?php echo get_city_name($field['city_id']); ?></span> <span class="fl"><?php if(!(empty($field['average_price']) || (($field['average_price'] instanceof \think\Collection || $field['average_price'] instanceof \think\Paginator ) && $field['average_price']->isEmpty()))): ?><i class="price"><?php echo $field['average_price']; ?></i><?php echo $field['price_units']; else: ?>价格待定<?php endif; ?></span> </span> </a> </li>
              <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
            </ul>
            <ul class="clearfix" style="display:none;">
              <?php  $typeid = "1"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 4; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "c",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'typeid' => '1',
  'flag' => 'c',
  'orderby' => 'new',
  'limit' => '0,4',
  'id' => 'field',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
              <li> <a href="<?php echo $field['arcurl']; ?>" target="_blank"> <span class="img"> <img src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/img/nopic.jpg" data-original="<?php echo $field['litpic']; ?>" class="lazy" alt="<?php echo $field['title']; ?>"> <span class="img_ft"><em>查看详情</em> <span class="txt_box clearfix"> <span class="tit"><?php echo $field['title']; ?></span> </span> <span class="tit_bg"></span> </span> </span> <span class="ft clearfix"> <span class="fr area"><?php echo get_city_name($field['city_id']); ?></span> <span class="fl"><?php if(!(empty($field['average_price']) || (($field['average_price'] instanceof \think\Collection || $field['average_price'] instanceof \think\Paginator ) && $field['average_price']->isEmpty()))): ?><i class="price"><?php echo $field['average_price']; ?></i><?php echo $field['price_units']; else: ?>价格待定<?php endif; ?></span> </span> </a> </li>
              <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
            </ul>
            <ul class="clearfix" style="display:none;">
              <?php  $typeid = "1"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 4; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "a",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'typeid' => '1',
  'flag' => 'a',
  'orderby' => 'new',
  'limit' => '0,4',
  'id' => 'field',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
              <li> <a href="<?php echo $field['arcurl']; ?>" target="_blank"> <span class="img"> <img src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/img/nopic.jpg" data-original="<?php echo $field['litpic']; ?>" class="lazy" alt="<?php echo $field['title']; ?>"> <span class="img_ft"><em>查看详情</em> <span class="txt_box clearfix"> <span class="tit"><?php echo $field['title']; ?></span> </span> <span class="tit_bg"></span> </span> </span> <span class="ft clearfix"> <span class="fr area"><?php echo get_city_name($field['city_id']); ?></span> <span class="fl"><?php if(!(empty($field['average_price']) || (($field['average_price'] instanceof \think\Collection || $field['average_price'] instanceof \think\Paginator ) && $field['average_price']->isEmpty()))): ?><i class="price"><?php echo $field['average_price']; ?></i><?php echo $field['price_units']; else: ?>价格待定<?php endif; ?></span> </span> </a> </li>
              <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
            </ul>
          </div>
          <!-- 楼盘列表 E --> 
        </div>
      </div>
      <div class="poster-margin-top">
        <ul class="poster clearfix">
          <?php  $tagAd = new \think\template\taglib\eju\TagAd; $_result = $tagAd->getAd("9"); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "";else: $field = $__LIST__;?>
          <li><a href="<?php echo $field['links']; ?>" <?php echo $field['target']; ?>><img alt="<?php echo $field['title']; ?>" src="<?php echo $field['litpic']; ?>" width="100%"></a></li>
          <?php endif; else: echo "";endif; $field = []; ?>
        </ul>
      </div>
      <!--资讯中心--> 
      <?php  $typeid = "2"; $row = 10; $tagChannelartlist = new \think\template\taglib\eju\TagChannelartlist; $_result = $tagChannelartlist->getChannelartlist($typeid, "self"); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($_result) ? array_slice($_result,0, $row, true) : $_result->slice(0, $row, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$channelartlist): $channelartlist["typename"] = text_msubstr($channelartlist["typename"], 0, 100, false); $__LIST__[$key] = $_result[$key] = $channelartlist;$i= intval($key) + 1;$mod = ($i % 2 ); ?>
      <div class="news cm_wrap">
        <div class="head clearfix">
          <h2 class="icon-news fl"><?php  $__VALUE__ = isset($channelartlist["typename"]) ? $channelartlist["typename"] : "变量名不存在"; echo $__VALUE__; ?></h2>
          <ul class="r_nav fr">
            <?php  $typeid = ""; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 10; $tagChannel = new \think\template\taglib\eju\TagChannel; $_result = $tagChannel->getChannel($typeid, "son", "", "",""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($_result) ? array_slice($_result,0, $row, true) : $_result->slice(0, $row, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $field["typename"] = text_msubstr($field["typename"], 0, 100, false); $__LIST__[$key] = $_result[$key] = $field;$i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <li> <a href="<?php echo $field['typeurl']; ?>" target="_blank"><?php echo $field['typename']; ?></a> </li>
            <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
          </ul>
        </div>
        <div class="content clearfix">
          <div class="news-left fl">
            <div class="news-left-slide">
              <div class="slider slider-6">
                <div class="switchable-box poster">
                  <ul class="switchable-content">
                    <?php  $tagAdv = new \think\template\taglib\eju\TagAdv; $_result = $tagAdv->getAdv(4, "", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($_result) ? array_slice($_result,0, 10, true) : $_result->slice(0, 10, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field):  if ($i == 0) : $field["currentstyle"] = ""; else:  $field["currentstyle"] = ""; endif;$i= intval($key) + 1;$mod = ($i % 2 ); ?>
                    <li><a style="background-image:url(<?php echo $field['litpic']; ?>);" href="<?php echo $field['links']; ?>" title="<?php echo $field['title']; ?>" target="_blank"><img src="<?php echo $field['litpic']; ?>" title="<?php echo $field['title']; ?>" width="100%"  /></a></li>
                    <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
                    </li>
                  </ul>
                  <div class="ui-arrow"><a class="ui-prev"></a><a class="ui-next"></a></div>
                </div>
              </div>
              <script>
             $(function(){
             $('body').find('.slider-6').slide({
			 effect: 'fade', 
			 speed: 'slow',
			 navCls: 'switchable-nav',
			 contentCls: 'switchable-content',
			 caption: false,
		 	 prevBtnCls:'ui-prev',
			 nextBtnCls:'ui-next',
			 evtype: 'click'
			 });
			 });
           </script> 
            </div>
            <ul class="news-left-list clearfix">
              <?php  $typeid = ""; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 2; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "a",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'flag' => 'a',
  'orderby' => 'new',
  'row' => '2',
  'id' => 'field',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
              <li> <a href="<?php echo $field['arcurl']; ?>" target="_blank"> <span class="img"> <img src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/img/nopic.jpg" data-original="<?php echo $field['litpic']; ?>" class="lazy" alt="<?php echo $field['title']; ?>" width="180" height="140"> <span class="img_ft"> <span class="txt_box clearfix"> <span class="tit fl"><?php echo $field['title']; ?></span> </span> <span class="tit_bg"></span> </span> </span> </a> </li>
              <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
            </ul>
          </div>
          <ul class="news-center fl">
            <?php  $typeid = ""; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 1; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "h",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'orderby' => 'new',
  'limit' => '0,1',
  'flag' => 'h',
  'id' => 'field',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <li>
              <h2> <a href="<?php echo $field['arcurl']; ?>" target="_blank"><?php echo $field['title']; ?></a> </h2>
              <p><?php echo html_msubstr($field['seo_description'],0,45,true); ?></p>
            </li>
            <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = [];  $typeid = ""; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 10; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "",      "noflag"=> "h",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'orderby' => 'new',
  'limit' => '1,10',
  'noflag' => 'h',
  'id' => 'field',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],1, $row, true) : $_result["list"]->slice(1, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <li class="nowarp"> <a href="<?php echo $field['typeurl']; ?>" target="_blank"><?php echo $field['typename']; ?></a> | <a href="<?php echo $field['arcurl']; ?>" title="<?php echo $field['title']; ?>" target="_blank"><?php echo $field['title']; ?></a> </li>
            <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
          </ul>
          <?php  $typeid = "6"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?>
          <div class="news-right build_shoppers fr">
            <div class="r_box">
              <div class="sct_item buy_way">
                <h3><?php echo $field['typename']; ?></h3>
                <ul class="list" style="height:auto;">
                  <?php  $typeid = ""; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 13; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "",      "noflag"=> "h",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'orderby' => 'new',
  'row' => '13',
  'noflag' => 'h',
  'id' => 'field',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
                  <li class="clearfix"><s><?php echo $i; ?></s><a href="<?php echo $field['typeurl']; ?>" target="_blank"><?php echo $field['title']; ?></a></li>
                  <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
                </ul>
              </div>
            </div>
          </div>
          <?php endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?> </div>
      </div>
      <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $typeid = $row = ""; unset($channelartlist); ?> 
      <!--资讯中心-->
      <div class="poster-margin-top"> <?php  $tagAd = new \think\template\taglib\eju\TagAd; $_result = $tagAd->getAd("12"); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "";else: $field = $__LIST__;?>
        <ul class="poster clearfix">
          <li><a href="<?php echo $field['links']; ?>" <?php echo $field['target']; ?>><img alt="<?php echo $field['title']; ?>" src="<?php echo $field['litpic']; ?>" width="100%"></a></li>
        </ul>
        <?php endif; else: echo "";endif; $field = []; ?> </div>
      <!-- 新房 S -->
      <div class="build_shoppers cm_wrap">
        <div class="head clearfix">
          <h2 class="fl margin-right-120">新房</h2>
          <ul class="r_nav fl" id="tab-2">
            <?php  $tagSqlview = new \think\template\taglib\eju\TagSqlview; $_result = $tagSqlview->getSqlview("0", "channelfield", [], [], "*","name='characteristic' and channel_id=9"); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;if(is_array(explode(",",$field['dfvalue'])) || explode(",",$field['dfvalue']) instanceof \think\Collection || explode(",",$field['dfvalue']) instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = explode(",",$field['dfvalue']);if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field1): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <li class="<?php if($e == '1'): ?>active<?php endif; ?>"><a href="javascript:;"><?php echo $field1; ?></a>
              <div class="b_l"></div>
            </li>
            <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field1 = []; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
          </ul>
          <div class="map fr ">
          <a href="<?php  $tagDiyurl = new \think\template\taglib\eju\TagDiyurl; $__VALUE__ = $tagDiyurl->getDiyurl("map"); echo $__VALUE__; ?>">地图找房</a>
          </div>
        </div>
        <div class="content clearfix"> 
          <!-- 筛选 S-->
          <div class="l_box fl"> <?php  $tagScreening = new \think\template\taglib\eju\TagScreening; $_result = $tagScreening->getScreening("active", "province_id,city_id,area_id,characteristic,manage_type,average_price", "", "off","1","","on","2","2","off","off");if(!empty($_result["list"]) || (($_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator ) && $_result["list"]->isEmpty())): $field = $_result; if(is_array($field['list']) || $field['list'] instanceof \think\Collection || $field['list'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($field['list']) ? array_slice($field['list'],0,4, true) : $field['list']->slice(0,4, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <ul class="filter-row">
              <li class="filter-row-title iconfont"><?php echo $vo['title']; ?></li>
              <li class="filter-val"> <?php if(is_array($vo['dfvalue']) || $vo['dfvalue'] instanceof \think\Collection || $vo['dfvalue'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($vo['dfvalue']) ? array_slice($vo['dfvalue'],0,10, true) : $vo['dfvalue']->slice(0,10, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo2): $i= intval($key) + 1;$mod = ($i % 2 ); ?> <a <?php echo $vo2['onClick']; ?> target="_blank"><?php echo $vo2['name']; ?></a> <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo2 = []; ?> </li>
              <li class="filter-more" style="display: none;"> <?php if(is_array($vo['dfvalue']) || $vo['dfvalue'] instanceof \think\Collection || $vo['dfvalue'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $vo['dfvalue'];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo2): $i= intval($key) + 1;$mod = ($i % 2 ); ?> <a <?php echo $vo2['onClick']; ?> target="_blank"><?php echo $vo2['name']; ?></a> <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo2 = []; ?> </li>
            </ul>
            <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = []; ?>
            <?php echo $field['hidden']; endif; $field = []; ?> </div>
          <!-- 筛选 E--> 
          <!-- 楼盘列表 S -->
          <div class="c_box build_list fl">
            <div id="content-box"> 
             <?php  $tagSqlview = new \think\template\taglib\eju\TagSqlview; $_result = $tagSqlview->getSqlview("0", "channelfield", [], [], "*","name='characteristic' and channel_id=9"); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;if(is_array(explode(",",$field['dfvalue'])) || explode(",",$field['dfvalue']) instanceof \think\Collection || explode(",",$field['dfvalue']) instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = explode(",",$field['dfvalue']);if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field1): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
              <ul class="clearfix" <?php if($i != '1'): ?>style="display:none;"<?php endif; ?>>
                <?php  $tagSqlarclist = new \think\template\taglib\eju\TagSqlarclist; $_result = $tagSqlarclist->getSqlarclist("0",[], [], "archives", "*", "a.aid desc", "0,6", "", "average_price,characteristic", "", "","","",[['table'=>'xinfang_system d','map'=>'a.aid = d.aid','method'=>'LEFT']],"", "channel=9 and is_del=0 and FIND_IN_SET('$field1',characteristic)"); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo_xinfang):  if ($i == 0) : $vo_xinfang["currentstyle"] = ""; else:  $vo_xinfang["currentstyle"] = ""; endif;$i= intval($key) + 1;$mod = ($i % 2 ); ?>
                <li> <a href="<?php echo $vo_xinfang['arcurl']; ?>"  target="_blank" title="<?php echo $vo_xinfang['title']; ?>"> <span class="img"> <img src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/img/nopic.jpg" data-original="<?php echo $vo_xinfang['litpic']; ?>" class="lazy" alt="<?php echo $vo_xinfang['title']; ?>"> <span class="img_ft"> <span class="txt_box clearfix"> <span class="tit fl"><?php echo $vo_xinfang['title']; ?></span> </span> <span class="tit_bg"></span> </span> </span> 
                <span class="ft clearfix"> <span class="fr area"><?php echo get_city_name($vo_xinfang['city_id']); ?></span> <span class="fl"><?php if(!(empty($vo_xinfang['average_price']) || (($vo_xinfang['average_price'] instanceof \think\Collection || $vo_xinfang['average_price'] instanceof \think\Paginator ) && $vo_xinfang['average_price']->isEmpty()))): ?><i class="price"><?php echo $vo_xinfang['average_price']; ?></i><?php echo $vo_xinfang['price_units']; else: ?><i class="price">价格待定</i><?php endif; ?></span> </span>
                <span class="ft clearfix nowarp"><?php if(is_array($vo_xinfang['characteristic']) || $vo_xinfang['characteristic'] instanceof \think\Collection || $vo_xinfang['characteristic'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($vo_xinfang['characteristic']) ? array_slice($vo_xinfang['characteristic'],0,3, true) : $vo_xinfang['characteristic']->slice(0,3, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 ); ?> <i class="item "><?php echo $vo; ?></i> <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = []; ?></span> </a> 
                </li>
                <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo_xinfang = []; ?>
              </ul>
              <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field1 = []; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?> </div>
          </div>
          <!-- 楼盘列表 E --> 
          <!-- 购房指南 && 楼盘导购 S-->
          <div class="l_box lastly_open fr">
            <h3>近期开盘</h3>
            <ul class="list">
              <li class="item">
                <h4 class="tit">热盘推荐</h4>
                <ol>
                  <?php  $typeid = "1"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 10; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'typeid' => '1',
  'orderby' => 'new',
  'row' => '10',
  'id' => 'field',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
                  <li class="clearfix"> <a href="<?php echo $field['arcurl']; ?>" target="_blank" class="name fl"><?php echo $field['title']; ?></a> <span class="price fr"><?php if(!(empty($field['average_price']) || (($field['average_price'] instanceof \think\Collection || $field['average_price'] instanceof \think\Paginator ) && $field['average_price']->isEmpty()))): ?><?php echo $field['average_price']; ?><?php echo $field['price_units']; else: ?>暂无<?php endif; ?></span> </li>
                  <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
                </ol>
                <div class="l_l">
                  <div class="c"></div>
                </div>
              </li>
            </ul>
          </div>
          <!-- 购房指南 && 新房 E--> 
        </div>
      </div>
      <!-- 新房 E -->
      <div class="poster-margin-top"> <?php  $tagAd = new \think\template\taglib\eju\TagAd; $_result = $tagAd->getAd("15"); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "";else: $field = $__LIST__;?>
        <ul class="poster clearfix">
          <li><a href="<?php echo $field['links']; ?>" title="<?php echo $field['title']; ?>" <?php echo $field['target']; ?>><img alt="<?php echo $field['title']; ?>" src="<?php echo $field['litpic']; ?>" width="100%"></a></li>
        </ul>
        <?php endif; else: echo "";endif; $field = []; ?> </div>
      <!-- 楼盘导购 S -->
      <div class="new_house cm_wrap">
        <div class="head clearfix">
          <h2 class="fl margin-right-120">楼盘导购</h2>
          <ul class="r_nav fl" id="tab-1">
            <li class="active"> <a href="<?php  $typeid = "3"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?><?php echo $field['typeurl']; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>" target="_blank">新房团购</a>
              <div class="b_l"></div>
            </li>
            <li> <a href="<?php  $typeid = "1"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?><?php echo $field['typeurl']; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>" target="_blank">人气楼盘</a>
              <div class="b_l"></div>
            </li>
          </ul>
          <div class="map fr ">
          <a href="<?php  $tagDiyurl = new \think\template\taglib\eju\TagDiyurl; $__VALUE__ = $tagDiyurl->getDiyurl("map"); echo $__VALUE__; ?>">地图找房</a>
          </div>
        </div>
        <div class="content clearfix"> 
          <!-- 最近开盘 S-->
          <div class="l_box fl">
            <div class="kanfang">
              <h4 class="fl">看房报名</h4>
              <div class="fr">已有 <span class="num">43</span> 人报名 </div>
              <div id="bmtip"></div>
            </div>
            <!-- 预约看房 S -->
            <div class="appoint">
              <div class="form_box"> <?php  $tagForm = new \think\template\taglib\eju\TagForm; $_result = $tagForm->getForm("1", "", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
                <form method="post" id="<?php echo $field['form_name']; ?>" action="<?php echo $field['action']; ?>" onsubmit="<?php echo $field['submit']; ?>">
                  <div class="sct clearfix">
                    <div class="sct_ipt">
                      <input type="text" class="ipt"  id="<?php echo $field['attr_1']; ?>" name="<?php echo $field['attr_1']; ?>" placeholder="<?php echo $field['itemname_1']; ?>">
                      <span class="placeholder"><?php echo $field['itemname_1']; ?></span> </div>
                  </div>
                  <div class="sct clearfix">
                    <div class="sct_ipt">
                      <input type="text" class="ipt"  id="<?php echo $field['attr_4']; ?>" name="<?php echo $field['attr_4']; ?>" placeholder="<?php echo $field['itemname_4']; ?>">
                      <span class="placeholder"><?php echo $field['itemname_4']; ?></span> </div>
                  </div>
                  <div class="sct btn_area">
                    <input type="submit" value="立即提交" class="sbm subscribe-btn">
                  </div>
                  <?php echo $field['hidden']; ?>
                </form>
                <?php ++$e;$k++; endforeach;endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?> </div>
            </div>
            <!-- 预约看房 E --> 
            <!-- 看房团 S -->
            <div class="look_team">
              <div class="list" id="subscribe">
                <ul>
                  <li class="clearfix now"> 刘**&nbsp;138*** &nbsp; 报名了<a href="https://house.08cms.com/topic/detail/120.html" class="" target="_blank" title="盛世华南商铺">盛世华南商铺</a> </li>
                  <li class="clearfix now"> 张**&nbsp;130*** &nbsp; 报名了<a href="https://house.08cms.com/topic/detail/120.html" class="" target="_blank" title="盛世华南商铺">盛世华南商铺</a> </li>
                  <li class="clearfix now"> 王**&nbsp;136*** &nbsp; 报名了<a href="https://house.08cms.com/topic/detail/120.html" class="" target="_blank" title="盛世华南商铺">盛世华南商铺</a> </li>
                  <li class="clearfix now"> 李**&nbsp;135*** &nbsp; 报名了<a href="https://house.08cms.com/topic/detail/120.html" class="" target="_blank" title="盛世华南商铺">盛世华南商铺</a> </li>
                  <li class="clearfix now"> 刘**&nbsp;134*** &nbsp; 报名了<a href="https://house.08cms.com/topic/detail/120.html" class="" target="_blank" title="盛世华南商铺">盛世华南商铺</a> </li>
                  <li class="clearfix now"> 蔡**&nbsp;137*** &nbsp; 报名了<a href="https://house.08cms.com/topic/detail/120.html" class="" target="_blank" title="盛世华南商铺">盛世华南商铺</a> </li>
                  <li class="clearfix now"> 陈**&nbsp;139*** &nbsp; 报名了<a href="https://house.08cms.com/topic/detail/120.html" class="" target="_blank" title="盛世华南商铺">盛世华南商铺</a> </li>
                  <li class="clearfix now"> 徐**&nbsp;130*** &nbsp; 报名了<a href="https://house.08cms.com/topic/detail/120.html" class="" target="_blank" title="盛世华南商铺">盛世华南商铺</a> </li>
                </ul>
              </div>
            </div>
            <!-- 看房团 E --> 
            
          </div>
          <!-- 最近开盘 E--> 
          <!-- 楼盘列表 S -->
          <div class="c_box build_list fl">
            <div id="house-content-box">
              <ul class="clearfix">
                <?php  $typeid = "3"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 6; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'typeid' => '3',
  'orderby' => 'new',
  'row' => '6',
  'id' => 'field',
  'addfields' => 'price,end_time',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "price,end_time","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
                <li> <a href="<?php echo $field['arcurl']; ?>"  target="_blank"> <span class="img"> <img src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/img/nopic.jpg" data-original="<?php echo $field['litpic']; ?>" class="lazy" alt="<?php echo $field['title']; ?>">  </span>
                <?php  $aid = $field['joinaid']; $tag = array (
  'aid' => '$field.joinaid',
  'id' => 'field2',
  'huxing' => 'off',
  'photo' => 'off',
  'price' => 'off',
); if(!isset($aid) || empty($aid)) : $aid = $field['joinaid']; endif; $tagArcview = new \think\template\taglib\eju\TagArcview; $_result = $tagArcview->getArcview($aid, "",$tag); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field2 = $__LIST__;?>
                <span class="ft clearfix"> <span class="fr area"><?php echo get_city_name($field['city_id']); ?></span> <span class="fl"><?php if(!(empty($field['price']) || (($field['price'] instanceof \think\Collection || $field['price'] instanceof \think\Paginator ) && $field['price']->isEmpty()))): ?><i class="price"><?php echo $field['price']; ?></i><?php echo $field['price_units']; else: ?>暂无<?php endif; ?></span>
                <span class="ftuan clearfix nowarp"> 截止时间：<?php echo MyDate('Y-m-d',$field['end_time']); ?> </span> </a> </li>
                <?php endif; else: echo htmlspecialchars_decode("");endif; unset($aid); $field2 = []; ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
              </ul>
              <ul class="clearfix" style="display:none;">
                <?php  $typeid = "1"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 6; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'typeid' => '1',
  'orderby' => 'new',
  'row' => '6',
  'id' => 'field',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
                <li> <a href="<?php echo $field['arcurl']; ?>"  target="_blank" > <span class="img"> <img src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/img/nopic.jpg" data-original="<?php echo $field['litpic']; ?>" class="lazy" alt="<?php echo $field['title']; ?>">  </span> <span class="ft clearfix"> <span class="fr area"><?php echo get_city_name($field['city_id']); ?></span> <span class="fl"><?php if(!(empty($field['average_price']) || (($field['average_price'] instanceof \think\Collection || $field['average_price'] instanceof \think\Paginator ) && $field['average_price']->isEmpty()))): ?><i class="price"><?php echo $field['average_price']; ?></i><?php echo $field['price_units']; else: ?>暂无<?php endif; ?></span> </span> 
                <span class="ft clearfix nowarp"><?php if(is_array($field['characteristic']) || $field['characteristic'] instanceof \think\Collection || $field['characteristic'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($field['characteristic']) ? array_slice($field['characteristic'],0,3, true) : $field['characteristic']->slice(0,3, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 ); ?> <i class="item "><?php echo $vo; ?></i> <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = []; ?></span>
                </a> </li>
                <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
              </ul>
            </div>
          </div>
          <!-- 楼盘列表 E --> 
          <!-- 房产资讯 S --> 
          <?php  $typeid = "5"; $row = 10; $tagChannelartlist = new \think\template\taglib\eju\TagChannelartlist; $_result = $tagChannelartlist->getChannelartlist($typeid, "self"); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($_result) ? array_slice($_result,0, $row, true) : $_result->slice(0, $row, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$channelartlist): $channelartlist["typename"] = text_msubstr($channelartlist["typename"], 0, 100, false); $__LIST__[$key] = $_result[$key] = $channelartlist;$i= intval($key) + 1;$mod = ($i % 2 ); ?>
          <div class="r_box house_news fr">
            <div class="hd clearfix">
              <h3><?php  $__VALUE__ = isset($channelartlist["typename"]) ? $channelartlist["typename"] : "变量名不存在"; echo $__VALUE__; ?></h3>
              <a href="<?php  $__VALUE__ = isset($channelartlist["typeurl"]) ? $channelartlist["typeurl"] : "变量名不存在"; echo $__VALUE__; ?>" title="<?php  $__VALUE__ = isset($channelartlist["typename"]) ? $channelartlist["typename"] : "变量名不存在"; echo $__VALUE__; ?>" target="_blank" class="more">更多 &gt;</a> </div>
            <div class="list">
              <ul>
                <li>
                  <ol>
                    <?php  $typeid = ""; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 12; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "",      "noflag"=> "h",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'orderby' => 'new',
  'row' => '12',
  'noflag' => 'h',
  'id' => 'field',
  'mod' => '6',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 6 ); ?>
                    <li <?php if($mod == '1'): ?>class="on"<?php endif; ?>><a href="<?php echo $field['typeurl']; ?>" target="_blank"><?php echo $field['title']; ?></a></li>
                    <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
                  </ol>
                </li>
              </ul>
            </div>
          </div>
          <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $typeid = $row = ""; unset($channelartlist); ?> 
          <!-- 房产资讯 E --> 
        </div>
      </div>
      
      <!-- 楼盘导购 E -->
      <div class="poster-margin-top"> <?php  $tagAd = new \think\template\taglib\eju\TagAd; $_result = $tagAd->getAd("16"); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "";else: $field = $__LIST__;?>
        <ul class="poster clearfix">
          <li><a href="<?php echo $field['links']; ?>" title="<?php echo $field['title']; ?>" <?php echo $field['target']; ?>><img alt="<?php echo $field['title']; ?>" src="<?php echo $field['litpic']; ?>" width="100%"></a></li>
        </ul>
        <?php endif; else: echo "";endif; $field = []; ?> </div>
      <!-- 二手房 S -->
      <div class="sed_house cm_wrap ">
        <div class="head clearfix">
          <h2 class="fl margin-right-120">二手房出租房</h2>
          <ul class="r_nav fl" id="tab-3">
            <?php  $typeid = "11"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?>
            <li class="active"> <a href="<?php echo $field['typeurl']; ?>" target="_blank" title="<?php echo $field['typename']; ?>"><?php echo $field['typename']; ?></a>
              <div class="b_l"></div>
            </li>
            <?php endif; else: echo htmlspecialchars_decode("");endif; $field = [];  $typeid = "12"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?>
            <li> <a href="<?php echo $field['typeurl']; ?>" target="_blank" title="<?php echo $field['typename']; ?>"><?php echo $field['typename']; ?></a>
              <div class="b_l"></div>
            </li>
            <?php endif; else: echo htmlspecialchars_decode("");endif; $field = [];  $typeid = "10"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?>
            <li> <a href="<?php echo $field['typeurl']; ?>" target="_blank" title="<?php echo $field['typename']; ?>"><?php echo $field['typename']; ?></a>
              <div class="b_l"></div>
            </li>
            <?php endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
          </ul>
          <div class="map fr ">
          <a href="<?php  $tagDiyurl = new \think\template\taglib\eju\TagDiyurl; $__VALUE__ = $tagDiyurl->getDiyurl("mapershou"); echo $__VALUE__; ?>">地图找房</a>
          </div>
        </div>
        <div class="content clearfix"> 
          
          <!-- 楼盘列表 S -->
          <div class="b_box ezxld_list fl" id="second-content-box">
            <div  class="clearfix">
              <div class="l_box fl"> 
               <?php  $tagScreening = new \think\template\taglib\eju\TagScreening; $_result = $tagScreening->getScreening("active", "", "", "off","11","","on","2","2","off","off");if(!empty($_result["list"]) || (($_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator ) && $_result["list"]->isEmpty())): $field = $_result; if(is_array($field['list']) || $field['list'] instanceof \think\Collection || $field['list'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($field['list']) ? array_slice($field['list'],0,4, true) : $field['list']->slice(0,4, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
                <ul class="filter-row ezxsx">
                  <li class="filter-row-title iconfont"><?php echo $vo['title']; ?></li>
                  <li class="filter-val"> <?php if(is_array($vo['dfvalue']) || $vo['dfvalue'] instanceof \think\Collection || $vo['dfvalue'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($vo['dfvalue']) ? array_slice($vo['dfvalue'],0,10, true) : $vo['dfvalue']->slice(0,10, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo2): $i= intval($key) + 1;$mod = ($i % 2 ); ?> <a <?php echo $vo2['onClick']; ?> target="_blank"><?php echo $vo2['name']; ?></a> <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo2 = []; ?> </li>
                  <li class="filter-more" style="display: none;"> <?php if(is_array($vo['dfvalue']) || $vo['dfvalue'] instanceof \think\Collection || $vo['dfvalue'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $vo['dfvalue'];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo2): $i= intval($key) + 1;$mod = ($i % 2 ); ?> <a <?php echo $vo2['onClick']; ?> target="_blank"><?php echo $vo2['name']; ?></a> <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo2 = []; ?> </li>
                </ul>
                <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = []; ?>
                <?php echo $field['hidden']; endif; $field = []; ?> 
                </div>
              <ul class="list">
                <?php  $typeid = "11"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 6; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'orderby' => 'new',
  'row' => '6',
  'id' => 'field',
  'typeid' => '11',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
                <li> <a href="<?php echo $field['arcurl']; ?>"  target="_blank"> <span class="img"> <img src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/img/nopic.jpg" data-original="<?php echo $field['litpic']; ?>" class="lazy" alt="<?php echo $field['title']; ?>">  </span> 
                <span class="ft clearfix nowarp"><?php echo get_area_name($field['area_id']); ?> -<?php  $aid = $field['joinaid']; $tag = array (
  'aid' => '$field.joinaid',
  'id' => 'field2',
  'huxing' => 'off',
  'photo' => 'off',
  'price' => 'off',
); if(!isset($aid) || empty($aid)) : $aid = $field['joinaid']; endif; $tagArcview = new \think\template\taglib\eju\TagArcview; $_result = $tagArcview->getArcview($aid, "",$tag); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field2 = $__LIST__;?><?php echo $field2['title']; endif; else: echo htmlspecialchars_decode("");endif; unset($aid); $field2 = []; ?></span>
                <span class="ft clearfix"> <span class="fr type_area nowarp" style="width:90px;"><?php echo $field['room']; ?>室<?php echo $field['living_room']; ?>厅-<?php echo $field['area']; ?><?php echo $field['area_unit']; ?></span> <span class="fl"><i class="price"><?php if(!(empty($field['total_price']) || (($field['total_price'] instanceof \think\Collection || $field['total_price'] instanceof \think\Paginator ) && $field['total_price']->isEmpty()))): ?><?php echo $field['total_price']; ?></i><?php echo $field['total_price_unit']; else: ?>价格待定<?php endif; ?></span> </span> </a> </li>
                <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
              </ul>
            </div>
            <div  class="clearfix" style="display: none;">
              <div class="l_box fl"> <?php  $tagScreening = new \think\template\taglib\eju\TagScreening; $_result = $tagScreening->getScreening("active", "", "", "off","12","","on","2","2","off","off");if(!empty($_result["list"]) || (($_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator ) && $_result["list"]->isEmpty())): $field = $_result; if(is_array($field['list']) || $field['list'] instanceof \think\Collection || $field['list'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($field['list']) ? array_slice($field['list'],0,4, true) : $field['list']->slice(0,4, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
                <ul class="filter-row ezxsx">
                  <li class="filter-row-title iconfont"><?php echo $vo['title']; ?></li>
                  <li class="filter-val"> <?php if(is_array($vo['dfvalue']) || $vo['dfvalue'] instanceof \think\Collection || $vo['dfvalue'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($vo['dfvalue']) ? array_slice($vo['dfvalue'],0,10, true) : $vo['dfvalue']->slice(0,10, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo2): $i= intval($key) + 1;$mod = ($i % 2 ); ?> <a <?php echo $vo2['onClick']; ?> target="_blank"><?php echo $vo2['name']; ?></a> <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo2 = []; ?> </li>
                  <li class="filter-more" style="display: none;"> <?php if(is_array($vo['dfvalue']) || $vo['dfvalue'] instanceof \think\Collection || $vo['dfvalue'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $vo['dfvalue'];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo2): $i= intval($key) + 1;$mod = ($i % 2 ); ?> <a <?php echo $vo2['onClick']; ?> target="_blank"><?php echo $vo2['name']; ?></a> <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo2 = []; ?> </li>
                </ul>
                <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = []; ?>
                <?php echo $field['hidden']; endif; $field = []; ?> </div>
              <ul class="list">
                <?php  $typeid = "12"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 6; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'orderby' => 'new',
  'row' => '6',
  'id' => 'field',
  'typeid' => '12',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
                <li> <a href="<?php echo $field['arcurl']; ?>"  target="_blank"> <span class="img"> <img src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/img/nopic.jpg" data-original="<?php echo $field['litpic']; ?>" class="lazy" alt="<?php echo $field['title']; ?>">  </span> 
                <span class="ft clearfix nowarp"><?php echo get_area_name($field['area_id']); ?> -<?php  $aid = $field['joinaid']; $tag = array (
  'aid' => '$field.joinaid',
  'id' => 'field2',
  'huxing' => 'off',
  'photo' => 'off',
  'price' => 'off',
); if(!isset($aid) || empty($aid)) : $aid = $field['joinaid']; endif; $tagArcview = new \think\template\taglib\eju\TagArcview; $_result = $tagArcview->getArcview($aid, "",$tag); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field2 = $__LIST__;?><?php echo $field2['title']; endif; else: echo htmlspecialchars_decode("");endif; unset($aid); $field2 = []; ?></span>
                <span class="ft clearfix"> <span class="fr type_area nowarp" style="width:90px;"><?php echo $field['room']; ?>室<?php echo $field['living_room']; ?>厅-<?php echo $field['area']; ?><?php echo $field['area_unit']; ?></span> <span class="fl"><?php if(!(empty($field['total_price']) || (($field['total_price'] instanceof \think\Collection || $field['total_price'] instanceof \think\Paginator ) && $field['total_price']->isEmpty()))): ?><i class='price'><?php echo $field['total_price']; ?></i><?php echo $field['price_units']; else: ?>价格待定<?php endif; ?></span> </span> </a> </li>
                <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
              </ul>
            </div>
            <div  class="clearfix" style="display: none;">
              <div class="l_box fl"> <?php  $tagScreening = new \think\template\taglib\eju\TagScreening; $_result = $tagScreening->getScreening("active", "", "", "off","10","","on","2","2","off","off");if(!empty($_result["list"]) || (($_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator ) && $_result["list"]->isEmpty())): $field = $_result; if(is_array($field['list']) || $field['list'] instanceof \think\Collection || $field['list'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($field['list']) ? array_slice($field['list'],0,4, true) : $field['list']->slice(0,4, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
                <ul class="filter-row ezxsx">
                  <li class="filter-row-title iconfont"><?php echo $vo['title']; ?></li>
                  <li class="filter-val"> <?php if(is_array($vo['dfvalue']) || $vo['dfvalue'] instanceof \think\Collection || $vo['dfvalue'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($vo['dfvalue']) ? array_slice($vo['dfvalue'],0,10, true) : $vo['dfvalue']->slice(0,10, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo2): $i= intval($key) + 1;$mod = ($i % 2 ); ?> <a <?php echo $vo2['onClick']; ?> target="_blank"><?php echo $vo2['name']; ?></a> <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo2 = []; ?> </li>
                  <li class="filter-more" style="display: none;"> <?php if(is_array($vo['dfvalue']) || $vo['dfvalue'] instanceof \think\Collection || $vo['dfvalue'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $vo['dfvalue'];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo2): $i= intval($key) + 1;$mod = ($i % 2 ); ?> <a <?php echo $vo2['onClick']; ?> target="_blank"><?php echo $vo2['name']; ?></a> <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo2 = []; ?> </li>
                </ul>
                <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = []; ?>
                <?php echo $field['hidden']; endif; $field = []; ?> </div>
              <ul class="list">
                <?php  $typeid = "10"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 6; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'orderby' => 'new',
  'row' => '6',
  'id' => 'field',
  'typeid' => '10',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
                <li> <a href="<?php echo $field['arcurl']; ?>"  target="_blank"> <span class="img"> <img src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/img/nopic.jpg" data-original="<?php echo $field['litpic']; ?>" class="lazy" alt="<?php echo $field['title']; ?>">  </span> 
                <span class="ft clearfix">  <?php echo get_area_name($field['area_id']); ?>-<?php echo $field['title']; ?></span>
                <span class="ft clearfix"> <span class="fr type_area nowarp" style="width:90px;"><?php echo $field['building_age']; ?>年建成</span> <span class="fl"><i class="price"><?php echo $field['average_price']; ?></i><?php echo $field['price_units']; ?></span> </span> </a> </li>
                <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
              </ul>
            </div>
          </div>
          <!-- 楼盘列表 E --> 
          <!-- 优秀导购员 S -->
          <div class="r_box top_director fr">
            <div class="release-news clearfix"> <a href="#" title="" target="_blank"> <i class="font-index-1"></i>发布二手 </a> <a href="#" title="" target="_blank"> <i class="font-index-2"></i>发布出租 </a> <a href="#" title="" target="_blank"> <i class="font-index-3"></i>发布求购 </a> <a href="#" title="" target="_blank"> <i class="font-index-4"></i>发布求租 </a></div>
            <ul class="broker" data-tag="jpjjr">
              <li> <a href="#" target="_blank"> <img alt="星语心愿" width="56" height="56" class="lazy" data-original="https://house.08cms.com/uploads/house/000/00/00/1/000/010/855b4e0650f9a356094798e5a596b5e1.jpg" src="https://house.08cms.com/uploads/house/000/00/00/1/000/010/855b4e0650f9a356094798e5a596b5e1.jpg" style="display: block;"> </a>
                <div>
                  <p> <a href="#" target="_blank" class="f-color">星语心愿</a> </p>
                  <p>手机：12587459685</p>
                  <p>售 <span class="f-color"> 0 </span>套，租 <span class="f-color"> 0 </span>套 </p>
                </div>
              </li>
              <li> <a href="#" target="_blank"> <img alt="青草" width="56" height="56" class="lazy" data-original="https://house.08cms.com/uploads/house/000/00/00/1/000/009/bedea81ccad4f3045e03248f0a9bd224.jpg" src="https://house.08cms.com/uploads/house/000/00/00/1/000/009/bedea81ccad4f3045e03248f0a9bd224.jpg" style="display: block;"> </a>
                <div>
                  <p> <a href="#" target="_blank" class="f-color">青草</a> </p>
                  <p>手机：13365487458</p>
                  <p>售 <span class="f-color"> 0 </span>套，租 <span class="f-color"> 0 </span>套 </p>
                </div>
              </li>
              <li> <a href="#" target="_blank"> <img alt="青草" width="56" height="56" class="lazy" data-original="https://house.08cms.com/uploads/house/000/00/00/1/000/009/bedea81ccad4f3045e03248f0a9bd224.jpg" src="https://house.08cms.com/uploads/house/000/00/00/1/000/009/bedea81ccad4f3045e03248f0a9bd224.jpg" style="display: block;"> </a>
                <div>
                  <p> <a href="#" target="_blank" class="f-color">青草</a> </p>
                  <p>手机：13365487458</p>
                  <p>售 <span class="f-color"> 0 </span>套，租 <span class="f-color"> 0 </span>套 </p>
                </div>
              </li>
            </ul>
            <div class="clearfix"> <a href="#" target="_blank" class="more-broker">更多经纪人</a> </div>
          </div>
          <!-- 优秀导购员 E --> 
        </div>
      </div>
      <!-- 二手房 E -->
      <div class="poster-margin-top"> <?php  $tagAd = new \think\template\taglib\eju\TagAd; $_result = $tagAd->getAd("18"); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "";else: $field = $__LIST__;?>
        <ul class="poster clearfix">
          <li><a href="<?php echo $field['links']; ?>" <?php echo $field['target']; ?>><img alt="<?php echo $field['title']; ?>" src="<?php echo $field['litpic']; ?>" width="100%"></a></li>
        </ul>
        <?php endif; else: echo "";endif; $field = []; ?> </div>
      <!-- 商铺-写字楼 S -->
      <div class="sed_house cm_wrap ">
        <div class="head clearfix">
          <h2 class="fl margin-right-120">商业地产</h2>
          <ul class="r_nav fl" id="tab-4">
            <?php  $typeid = "24"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?>
            <li class="active"> <a href="<?php echo $field['typeurl']; ?>" target="_blank">商铺出售</a>
              <div class="b_l"></div>
            </li>
            <?php endif; else: echo htmlspecialchars_decode("");endif; $field = [];  $typeid = "27"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?>
            <li> <a href="<?php echo $field['typeurl']; ?>" target="_blank">写字楼出售</a>
              <div class="b_l"></div>
            </li>
            <?php endif; else: echo htmlspecialchars_decode("");endif; $field = [];  $typeid = "25"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?>
            <li> <a href="<?php echo $field['typeurl']; ?>" target="_blank">商铺出租</a>
              <div class="b_l"></div>
            </li>
            <?php endif; else: echo htmlspecialchars_decode("");endif; $field = [];  $typeid = "28"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?>
            <li> <a href="<?php echo $field['typeurl']; ?>" target="_blank">写字楼出租</a>
              <div class="b_l"></div>
            </li>
            <?php endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
          </ul>
          <div class="mffb fr ">
          <a href="<?php  $tagDiyurl = new \think\template\taglib\eju\TagDiyurl; $__VALUE__ = $tagDiyurl->getDiyurl("mapshopcs"); echo $__VALUE__; ?>">免费发布</a>
          </div>
        </div>
        <div class="content clearfix"> 
          
          <!-- 楼盘列表 S -->
          <div class="b_box ezxld_list fl" id="spxzl-content-box">
            <div  class="clearfix">
              <div class="l_box fl"> 
                <?php  $tagScreening = new \think\template\taglib\eju\TagScreening; $_result = $tagScreening->getScreening("active", "", "", "off","24","","on","2","2","off","off");if(!empty($_result["list"]) || (($_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator ) && $_result["list"]->isEmpty())): $field = $_result; if(is_array($field['list']) || $field['list'] instanceof \think\Collection || $field['list'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($field['list']) ? array_slice($field['list'],0,4, true) : $field['list']->slice(0,4, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
                <ul class="filter-row ezxsx">
                  <li class="filter-row-title iconfont"><?php echo $vo['title']; ?></li>
                  <li class="filter-val"> <?php if(is_array($vo['dfvalue']) || $vo['dfvalue'] instanceof \think\Collection || $vo['dfvalue'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($vo['dfvalue']) ? array_slice($vo['dfvalue'],0,10, true) : $vo['dfvalue']->slice(0,10, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo2): $i= intval($key) + 1;$mod = ($i % 2 ); ?> <a <?php echo $vo2['onClick']; ?> target="_blank"><?php echo $vo2['name']; ?></a> <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo2 = []; ?> </li>
                  <li class="filter-more" style="display: none;"> <?php if(is_array($vo['dfvalue']) || $vo['dfvalue'] instanceof \think\Collection || $vo['dfvalue'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $vo['dfvalue'];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo2): $i= intval($key) + 1;$mod = ($i % 2 ); ?> <a <?php echo $vo2['onClick']; ?> target="_blank"><?php echo $vo2['name']; ?></a> <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo2 = []; ?> </li>
                </ul>
                <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = []; ?>
                <?php echo $field['hidden']; endif; $field = []; ?> </div>
              <ul class="list">
                <?php  $typeid = "24"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 6; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'orderby' => 'new',
  'row' => '6',
  'id' => 'field',
  'typeid' => '24',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
                <li> <a href="<?php echo $field['arcurl']; ?>"  target="_blank"> <span class="img"> <img src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/img/nopic.jpg" data-original="<?php echo $field['litpic']; ?>" class="lazy" alt="<?php echo $field['title']; ?>">  </span> 
                <span class="ft clearfix nowarp"><?php echo get_area_name($field['area_id']); ?> -<?php  $aid = $field['joinaid']; $tag = array (
  'aid' => '$field.joinaid',
  'id' => 'field2',
  'huxing' => 'off',
  'photo' => 'off',
  'price' => 'off',
); if(!isset($aid) || empty($aid)) : $aid = $field['joinaid']; endif; $tagArcview = new \think\template\taglib\eju\TagArcview; $_result = $tagArcview->getArcview($aid, "",$tag); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field2 = $__LIST__;?><?php echo $field2['title']; endif; else: echo htmlspecialchars_decode("");endif; unset($aid); $field2 = []; ?></span>
                <span class="ft clearfix"> <span class="fr type_area nowarp" style="width:90px;"><?php echo $field['room']; ?>室<?php echo $field['living_room']; ?>厅-<?php echo $field['area']; ?><?php echo $field['area_unit']; ?></span> <span class="fl"><i class="price"><?php if(!(empty($field['total_price']) || (($field['total_price'] instanceof \think\Collection || $field['total_price'] instanceof \think\Paginator ) && $field['total_price']->isEmpty()))): ?><?php echo $field['total_price']; ?></i><?php echo $field['total_price_unit']; else: ?>价格待定<?php endif; ?></span> </span> </a> </li>
                <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
              </ul>
            </div>
            <div  class="clearfix" style="display: none;">
              <div class="l_box fl"> 
                <?php  $tagScreening = new \think\template\taglib\eju\TagScreening; $_result = $tagScreening->getScreening("active", "", "", "off","27","","on","2","2","off","off");if(!empty($_result["list"]) || (($_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator ) && $_result["list"]->isEmpty())): $field = $_result; if(is_array($field['list']) || $field['list'] instanceof \think\Collection || $field['list'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($field['list']) ? array_slice($field['list'],0,4, true) : $field['list']->slice(0,4, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
                <ul class="filter-row ezxsx">
                  <li class="filter-row-title iconfont"><?php echo $vo['title']; ?></li>
                  <li class="filter-val"> <?php if(is_array($vo['dfvalue']) || $vo['dfvalue'] instanceof \think\Collection || $vo['dfvalue'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($vo['dfvalue']) ? array_slice($vo['dfvalue'],0,10, true) : $vo['dfvalue']->slice(0,10, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo2): $i= intval($key) + 1;$mod = ($i % 2 ); ?> <a <?php echo $vo2['onClick']; ?> target="_blank"><?php echo $vo2['name']; ?></a> <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo2 = []; ?> </li>
                  <li class="filter-more" style="display: none;"> <?php if(is_array($vo['dfvalue']) || $vo['dfvalue'] instanceof \think\Collection || $vo['dfvalue'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $vo['dfvalue'];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo2): $i= intval($key) + 1;$mod = ($i % 2 ); ?> <a <?php echo $vo2['onClick']; ?> target="_blank"><?php echo $vo2['name']; ?></a> <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo2 = []; ?> </li>
                </ul>
                <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = []; ?>
                <?php echo $field['hidden']; endif; $field = []; ?> 
              </div>
              <ul class="list">
                <?php  $typeid = "27"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 6; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'orderby' => 'new',
  'row' => '6',
  'id' => 'field',
  'typeid' => '27',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
                <li> <a href="<?php echo $field['arcurl']; ?>"  target="_blank"> <span class="img"> <img src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/img/nopic.jpg" data-original="<?php echo $field['litpic']; ?>" class="lazy" alt="<?php echo $field['title']; ?>">  </span> 
                <span class="ft clearfix nowarp"><?php echo get_area_name($field['area_id']); ?> -<?php  $aid = $field['joinaid']; $tag = array (
  'aid' => '$field.joinaid',
  'id' => 'field2',
  'huxing' => 'off',
  'photo' => 'off',
  'price' => 'off',
); if(!isset($aid) || empty($aid)) : $aid = $field['joinaid']; endif; $tagArcview = new \think\template\taglib\eju\TagArcview; $_result = $tagArcview->getArcview($aid, "",$tag); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field2 = $__LIST__;?><?php echo $field2['title']; endif; else: echo htmlspecialchars_decode("");endif; unset($aid); $field2 = []; ?></span>
                <span class="ft clearfix"> <span class="fr type_area nowarp" style="width:90px;"><?php echo $field['room']; ?>室<?php echo $field['living_room']; ?>厅-<?php echo $field['area']; ?><?php echo $field['area_unit']; ?></span> <span class="fl"><?php if(!(empty($field['total_price']) || (($field['total_price'] instanceof \think\Collection || $field['total_price'] instanceof \think\Paginator ) && $field['total_price']->isEmpty()))): ?><i class='price'><?php echo $field['total_price']; ?></i><?php echo $field['total_price_unit']; else: ?>价格待定<?php endif; ?></span> </span> </a> </li>
                <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
              </ul>
            </div>
            <div  class="clearfix" style="display: none;">
              <div class="l_box fl"> 
                <?php  $tagScreening = new \think\template\taglib\eju\TagScreening; $_result = $tagScreening->getScreening("active", "", "", "off","25","","on","2","2","off","off");if(!empty($_result["list"]) || (($_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator ) && $_result["list"]->isEmpty())): $field = $_result; if(is_array($field['list']) || $field['list'] instanceof \think\Collection || $field['list'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($field['list']) ? array_slice($field['list'],0,4, true) : $field['list']->slice(0,4, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
                <ul class="filter-row ezxsx">
                  <li class="filter-row-title iconfont"><?php echo $vo['title']; ?></li>
                  <li class="filter-val"> <?php if(is_array($vo['dfvalue']) || $vo['dfvalue'] instanceof \think\Collection || $vo['dfvalue'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($vo['dfvalue']) ? array_slice($vo['dfvalue'],0,10, true) : $vo['dfvalue']->slice(0,10, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo2): $i= intval($key) + 1;$mod = ($i % 2 ); ?> <a <?php echo $vo2['onClick']; ?> target="_blank"><?php echo $vo2['name']; ?></a> <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo2 = []; ?> </li>
                  <li class="filter-more" style="display: none;"> <?php if(is_array($vo['dfvalue']) || $vo['dfvalue'] instanceof \think\Collection || $vo['dfvalue'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $vo['dfvalue'];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo2): $i= intval($key) + 1;$mod = ($i % 2 ); ?> <a <?php echo $vo2['onClick']; ?> target="_blank"><?php echo $vo2['name']; ?></a> <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo2 = []; ?> </li>
                </ul>
                <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = []; ?>
                <?php echo $field['hidden']; endif; $field = []; ?> 
              </div>
              <ul class="list">
                <?php  $typeid = "25"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 6; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'orderby' => 'new',
  'row' => '6',
  'id' => 'field',
  'typeid' => '25',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
                <li> <a href="<?php echo $field['arcurl']; ?>"  target="_blank"> <span class="img"> <img src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/img/nopic.jpg" data-original="<?php echo $field['litpic']; ?>" class="lazy" alt="<?php echo $field['title']; ?>">  </span> 
                <span class="ft clearfix nowarp"><?php echo get_area_name($field['area_id']); ?> -<?php  $aid = $field['joinaid']; $tag = array (
  'aid' => '$field.joinaid',
  'id' => 'field2',
  'huxing' => 'off',
  'photo' => 'off',
  'price' => 'off',
); if(!isset($aid) || empty($aid)) : $aid = $field['joinaid']; endif; $tagArcview = new \think\template\taglib\eju\TagArcview; $_result = $tagArcview->getArcview($aid, "",$tag); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field2 = $__LIST__;?><?php echo $field2['title']; endif; else: echo htmlspecialchars_decode("");endif; unset($aid); $field2 = []; ?></span>
                <span class="ft clearfix"> <span class="fr type_area nowarp" style="width:90px;"><?php echo get_city_name($field['city_id']); ?></span> <span class="fl"><i class="price"><?php echo $field['total_price']; ?></i><?php echo $field['price_units']; ?></span> </span> </a> </li>
                <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
              </ul>
            </div>
            <div  class="clearfix" style="display: none;">
              <div class="l_box fl"> <?php  $tagScreening = new \think\template\taglib\eju\TagScreening; $_result = $tagScreening->getScreening("active", "", "", "off","28","","on","2","2","off","off");if(!empty($_result["list"]) || (($_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator ) && $_result["list"]->isEmpty())): $field = $_result; if(is_array($field['list']) || $field['list'] instanceof \think\Collection || $field['list'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($field['list']) ? array_slice($field['list'],0,4, true) : $field['list']->slice(0,4, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
                <ul class="filter-row ezxsx">
                  <li class="filter-row-title iconfont"><?php echo $vo['title']; ?></li>
                  <li class="filter-val"> <?php if(is_array($vo['dfvalue']) || $vo['dfvalue'] instanceof \think\Collection || $vo['dfvalue'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($vo['dfvalue']) ? array_slice($vo['dfvalue'],0,10, true) : $vo['dfvalue']->slice(0,10, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo2): $i= intval($key) + 1;$mod = ($i % 2 ); ?> <a <?php echo $vo2['onClick']; ?> target="_blank"><?php echo $vo2['name']; ?></a> <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo2 = []; ?> </li>
                  <li class="filter-more" style="display: none;"> <?php if(is_array($vo['dfvalue']) || $vo['dfvalue'] instanceof \think\Collection || $vo['dfvalue'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $vo['dfvalue'];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo2): $i= intval($key) + 1;$mod = ($i % 2 ); ?> <a <?php echo $vo2['onClick']; ?> target="_blank"><?php echo $vo2['name']; ?></a> <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo2 = []; ?> </li>
                </ul>
                <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = []; ?>
                <?php echo $field['hidden']; endif; $field = []; ?> </div>
              <ul class="list">
                <?php  $typeid = "28"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 6; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'orderby' => 'new',
  'row' => '6',
  'id' => 'field',
  'typeid' => '28',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
                <li> <a href="<?php echo $field['arcurl']; ?>"  target="_blank"> <span class="img"> <img src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/img/nopic.jpg" data-original="<?php echo $field['litpic']; ?>" class="lazy" alt="<?php echo $field['title']; ?>">  </span> 
                <span class="ft clearfix nowarp"><?php echo get_area_name($field['area_id']); ?> -<?php  $aid = $field['joinaid']; $tag = array (
  'aid' => '$field.joinaid',
  'id' => 'field2',
  'huxing' => 'off',
  'photo' => 'off',
  'price' => 'off',
); if(!isset($aid) || empty($aid)) : $aid = $field['joinaid']; endif; $tagArcview = new \think\template\taglib\eju\TagArcview; $_result = $tagArcview->getArcview($aid, "",$tag); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field2 = $__LIST__;?><?php echo $field2['title']; endif; else: echo htmlspecialchars_decode("");endif; unset($aid); $field2 = []; ?></span>
                <span class="ft clearfix"> <span class="fr type_area nowarp" style="width:90px;"><?php echo get_city_name($field['city_id']); ?></span> <span class="fl"><i class="price"><?php echo $field['total_price']; ?></i><?php echo $field['price_units']; ?></span> </span> </a> </li>
                <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
              </ul>
            </div>
          </div>
          <!-- 楼盘列表 E --> 
          <!-- 优秀导购员 S --> 
          
          <?php  $typeid = "7"; $row = 10; $tagChannelartlist = new \think\template\taglib\eju\TagChannelartlist; $_result = $tagChannelartlist->getChannelartlist($typeid, "self"); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($_result) ? array_slice($_result,0, $row, true) : $_result->slice(0, $row, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$channelartlist): $channelartlist["typename"] = text_msubstr($channelartlist["typename"], 0, 100, false); $__LIST__[$key] = $_result[$key] = $channelartlist;$i= intval($key) + 1;$mod = ($i % 2 ); ?>
          <div class="r_box house_news fr">
            <div class="sct_item buy_way">
              <div class="hd clearfix">
                <h3><?php  $__VALUE__ = isset($channelartlist["typename"]) ? $channelartlist["typename"] : "变量名不存在"; echo $__VALUE__; ?></h3>
                <a href="<?php  $__VALUE__ = isset($channelartlist["typeurl"]) ? $channelartlist["typeurl"] : "变量名不存在"; echo $__VALUE__; ?>" title="<?php  $__VALUE__ = isset($channelartlist["typename"]) ? $channelartlist["typename"] : "变量名不存在"; echo $__VALUE__; ?>" target="_blank" class="more">更多 &gt;</a> </div>
              <ul class="list office-list">
                <?php  $typeid = ""; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 12; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "",      "noflag"=> "h",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'orderby' => 'new',
  'row' => '12',
  'noflag' => 'h',
  'id' => 'field',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
                <li class="clearfix"><a href="<?php echo $field['typeurl']; ?>" target="_blank"><?php echo $field['title']; ?></a></li>
                <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
              </ul>
            </div>
          </div>
          <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $typeid = $row = ""; unset($channelartlist); ?> 
          <!-- 优秀导购员 E --> 
        </div>
      </div>
      <!-- 商铺-写字楼 E -->
      <div class="poster-margin-top"> <?php  $tagAd = new \think\template\taglib\eju\TagAd; $_result = $tagAd->getAd("18"); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "";else: $field = $__LIST__;?>
        <ul class="poster clearfix">
          <li><a href="<?php echo $field['links']; ?>" <?php echo $field['target']; ?>><img alt="<?php echo $field['title']; ?>" src="<?php echo $field['litpic']; ?>" width="100%"></a></li>
        </ul>
        <?php endif; else: echo "";endif; $field = []; ?> </div>
       
      <div class="cm_wrap order_modl clearfix"> 
        <div class="fcphb index_block">
            <div class="index_title">
                <h1 class="index_h1 bnzf_h1">
                    <span>房产排行榜</span>
                    <a href="<?php  $typeid = "1"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?><?php echo $field['typeurl']; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>" target="_blank"><i></i><label>楼盘搜索</label></a>
                </h1>
                <a href="<?php  $typeid = "2"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?><?php echo $field['typeurl']; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>" target="_blank" class="fr index_title_right">
                    <span class="index_icon lskx_icon lou_wei"></span>
                    楼市快讯
                </a>
            </div>
            <div class="rplp">
                <h3>热门楼盘</h3>
                <ul>
                   <?php  $typeid = ""; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 10; $channelid = "9"; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'channelid' => '9',
  'orderby' => 'click',
  'row' => '10',
  'id' => 'field',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "click", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
                    <li><s><?php echo $i; ?></s><p class="n1"><a href="<?php echo $field['arcurl']; ?>" target="_blank"><?php echo $field['title']; ?></a></p>
                        <p class="n2"><?php if(!(empty($field['average_price']) || (($field['average_price'] instanceof \think\Collection || $field['average_price'] instanceof \think\Paginator ) && $field['average_price']->isEmpty()))): ?><i><?php echo $field['average_price']; ?></i><?php echo $field['price_units']; else: ?>房价待定<?php endif; ?></p>
                    </li>
                    <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
                </ul>
            </div>
            <div class="zxzx">
                <h3>最热咨询</h3>
                <ul>
                   <?php  $param = array(      "is_recom"=> "",      "status"=> "",      "click"=> "",      "replies"=> "" ); $tagAsk = new \think\template\taglib\eju\TagAsk; $_result_tmp = $tagAsk->getAsk($param,"","on","off","1","10","ask_id","desc");if(!empty($_result_tmp)):  $__PAGES__ = $_result_tmp["pages"]; $__COUNT__ = $_result_tmp["count"];$field = $_result_tmp ;?>
					<?php echo $field['hidden']; if(is_array($field['AskData']) || $field['AskData'] instanceof \think\Collection || $field['AskData'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $field['AskData'];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
                    <li><s><?php echo $i; ?></s><p class="n1"><a href="<?php echo $vo['AskUrl']; ?>" target="_blank"><?php echo $vo['ask_title']; ?></a></p>
                        <p class="n2"><?php echo $vo['click']; ?></p>
                    </li>
                    <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = [];  else: echo htmlspecialchars_decode("");endif; $field = []; ?>
                </ul>
            </div>
            <div class="rmxq">
                <h3>热门小区</h3>
                <ul>
                   <?php  $typeid = ""; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 10; $channelid = "11"; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'channelid' => '11',
  'orderby' => 'new',
  'row' => '10',
  'id' => 'field',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
                    <li><s><?php echo $i; ?></s><p class="n1"><a href="<?php echo $field['arcurl']; ?>" target="_blank"><?php echo $field['title']; ?></a></p>
                        <p class="n2">二手房<?php  $tagSonarclist = new \think\template\taglib\eju\TagSonarclist; $_result = $tagSonarclist->getSonCount("0", [$field['aid'],0,12], ['joinaid','is_del','channel'], "archives", ""); echo $_result; unset($_result);?>套</p>
                        <p class="n3">租房<?php  $tagSonarclist = new \think\template\taglib\eju\TagSonarclist; $_result = $tagSonarclist->getSonCount("0", [$field['aid'],0,13], ['joinaid','is_del','channel'], "archives", ""); echo $_result; unset($_result);?>套</p>
                    </li>
                   <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
                </ul>
            </div>
        </div>
      </div>
    </div>
  </div>
  <!-- 内容 E--> 
</div>



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
 
<script type="text/javascript" src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/laytpl.js"></script> 
<script src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/layer.js"></script> 
<script type="text/javascript" src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/placeholder.js"></script> 
<script type="text/javascript" src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/echarts.common.min.js"></script> 
<script src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/jquery.lazyload.js"></script> 
<script>
    $(function(){
        $('#tab-1 li').on('mouseover',function(){
            $(this).addClass('active').siblings().removeClass('active');
            var index = $(this).index(),box = $('#house-content-box').children().hide().eq(index);
            box.show();
            var i = box.find('img'),s = i.attr('src'),o = i.data('original');
            if(s != o)
            {
                box.find("img.lazy").lazyload({
                    threshold : 100,
                    effect : "fadeIn",
                    event: "showstop"
                });
            }
        });
        $('#tab-2 li').on('mouseover',function(){
            $(this).addClass('active').siblings().removeClass('active');
            var index = $(this).index(),box = $('#content-box').children().hide().eq(index);
            box.show();
            var i = box.find('img'),s = i.attr('src'),o = i.data('original');
            if(s != o)

            {
                box.find("img.lazy").lazyload({
                    threshold : 100,
                    effect : "fadeIn",
                    event: "showstop"
                });
            }
        });
        $('#tab-3 li').on('mouseover',function(){
            $(this).addClass('active').siblings().removeClass('active');
            var index = $(this).index(),box = $('#second-content-box').children().hide().eq(index);
            box.show();
            var i = box.find('img'),s = i.attr('src'),o = i.data('original');
            if(s != o)
            {
                box.find("img.lazy").lazyload({
                    threshold : 100,
                    effect : "fadeIn",
                    event: "showstop"
                });
            }
        });
		$('#tab-4 li').on('mouseover',function(){
            $(this).addClass('active').siblings().removeClass('active');
            var index = $(this).index(),box = $('#spxzl-content-box').children().hide().eq(index);
            box.show();
            var i = box.find('img'),s = i.attr('src'),o = i.data('original');
            if(s != o)
            {
                box.find("img.lazy").lazyload({
                    threshold : 100,
                    effect : "fadeIn",
                    event: "showstop"
                });
            }
        });
        $('#rec_house li').on('mouseover',function(){
            $(this).addClass('active').siblings().removeClass('active');
            var index = $(this).index(),box = $('#rec_house_box').children().hide().eq(index);
            box.show();
            var i = box.find('img'),s = i.attr('src'),o = i.data('original');
            if(s != o)
            {
                box.find("img.lazy").lazyload({
                    threshold : 100,
                    effect : "fadeIn",
                    event: "showstop"
                });
            }
        });
        $("#second_tab .tit").on('click',function(){
            var index = $(this).index();
            $(this).addClass('active').siblings().removeClass('active');
            $("#second_content").children().hide().eq(index).show();
        });
        $("#house_tab .tit").on('click',function(){
            var index = $(this).index();
            $(this).addClass('active').siblings().removeClass('active');
            $("#house_content").children().hide().eq(index).show();
        });
        $("img.lazy").lazyload({
            threshold : 100,
            effect : "fadeIn"
            //event: "scrollstop"
        });
		$(".filter-row").hover(function(){
            var more = $(this).find(".filter-more"),c = more.html().replace(/[\r\n]/g,""),len = $.trim(c).length;
            if(len > 0){
                more.show();
            }
        },function(){
            $(".filter-more").hide();
        });
		$("#subscribe").Scroll({line:4,speed:1000,timer:3000});
		$(".search-type a").on('click',function(){
            var url = $(this).data('uri');
            $(this).addClass('active').siblings().removeClass('active');
            $("#form").attr('action',url);
        });
        $(".search-btn").on('click',function(){
            $("#form").submit();
        });
    });
</script>
</body>
</html>