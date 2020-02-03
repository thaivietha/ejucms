<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:38:"./template/default/pc/view_xinfang.htm";i:1580692755;s:63:"D:\ejucms\EjuCMS-V1.3.0-UTF8-SP4\template\default\pc\header.htm";i:1580692664;s:69:"D:\ejucms\EjuCMS-V1.3.0-UTF8-SP4\template\default\pc\main_xinfang.htm";i:1580691229;s:63:"D:\ejucms\EjuCMS-V1.3.0-UTF8-SP4\template\default\pc\footer.htm";i:1580691229;}*/ ?>
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

<link type="text/css" href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/css/prettyphoto.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/css/qiniuplayer.min.css">
<link rel="stylesheet" type="text/css" href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/css/video.css">

<div class="detail-main" id="main"> <script src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/jquery.qrcode.min.js"></script>
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
  <div class="fix-header">
    <div class="fix-width">
      <div class="fixnav_tit">
        <h2 class="tf"><a href="<?php echo $eju['field']['arcurl']; ?>"><?php echo $eju['field']['title']; ?></a></h2>
        <span id="phone400_fixnavs"> <span class="shownormalphone" style="display:inline-block;"> <span class="fixnav_num ml15"><?php echo $eju['field']['sale_phone']; ?></span>&nbsp;<?php if(!(empty($eju['field']['phone_code']) || (($eju['field']['phone_code'] instanceof \think\Collection || $eju['field']['phone_code'] instanceof \think\Paginator ) && $eju['field']['phone_code']->isEmpty()))): ?><span class="tf f14">转</span>&nbsp;<span class="fixnav_num"><?php echo $eju['field']['phone_code']; ?></span> <?php endif; ?> </span> </span> </div>
      <div class="tbsearch"> <?php  $tagSearchform = new \think\template\taglib\eju\TagSearchform; $_result = $tagSearchform->getSearchform("1","9","","","","off"); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$k = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
        <form target="_blank" method="get" action="<?php echo $field['action']; ?>">
          <input type="text" style="display:none">
          <div class="fl pr">
            <input name="keywords" id="keywords" autocomplete="off" placeholder="输入楼盘名称" type="text" style="color:#aaa;padding-left:10px;" class="tbsearchinput f14 tf">
          </div>
          <div class="fl">
            <input class="tf tbsearchbtns" type="submit" name="" value="搜&nbsp;索">
          </div>
          <?php echo $field['hidden']; ?>
        </form>
        <?php ++$e;$k++; endforeach;endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?> </div>
    </div>
  </div>
  <div class="fix-width clearfix">
    <div class="detail-info ">
      <div class="slides-box width600 fl">
        <div class="slides-big-box width600">
          <ul>
            <?php if(!(empty($eju['field']['video']) || (($eju['field']['video'] instanceof \think\Collection || $eju['field']['video'] instanceof \think\Paginator ) && $eju['field']['video']->isEmpty()))): ?>
            <li style="height: 400px;">
              <video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered" width="100%" height="100%" controls webkit-playsinline preload="none"
                     poster="<?php echo $eju['field']['litpic']; ?>" data-setup="{}">
                <source src="<?php echo $eju['field']['video']; ?>" type="video/mp4">
                您的浏览器不支持HTML5视频
              </video>
            </li>
            <?php endif;  if(!isset($aid) || empty($aid)) : $aid = "0"; endif; $tagFanglist = new \think\template\taglib\eju\TagFanglist; $_result = $tagFanglist->getFanglist("photo", $aid, "0,1000", "", "desc", "photo_type","xinfang");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k = 0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, 1000, true) : $_result["list"]->slice(0, 1000, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 );  if(!isset($aid) || empty($aid)) : $aid = "0"; endif;if(is_array($vo['children']) || $vo['children'] instanceof \think\Collection || $vo['children'] instanceof \think\Paginator): $i = 0; $e = 1;$k = 0;$__LIST__ = is_array($vo['children']) ? array_slice($vo['children'],0,1, true) : $vo['children']->slice(0,1, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <li> <a href="<?php echo arcurl('home/Xinfang/index',['aid'=>$eju['field']['xinfang']['aid'],'dirname'=>$eju['field']['xinfang']['dirname'],'dirpath'=>$eju['field']['xinfang']['dirpath'],'column'=>'photo','photo_type'=>$field['photo_type']]); ?>"><img src="<?php echo $field['photo_pic']; ?>" alt="<?php echo $field['photo_type']; ?><?php echo $field['photo_title']; ?>"></a> </li>
            <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = []; ?>
          </ul>
          <a href="javascript:;" class="slides-icon slides-big-left"></a> <a href="javascript:;" class="slides-icon slides-big-right"></a> </div>
        <div class="slides-small"> <a href="javascript:;" class="prev iconfont">&#xe62a;</a> <a href="javascript:;" class="next iconfont">&#xe9d1;</a>
          <ul class="slides-small-box width600">
            <?php if(!(empty($eju['field']['video']) || (($eju['field']['video'] instanceof \think\Collection || $eju['field']['video'] instanceof \think\Paginator ) && $eju['field']['video']->isEmpty()))): ?>
            <li>
              <a href="javascript:void(0);"><img class="zmd-index" src="<?php echo $eju['field']['litpic']; ?>"></a>
              <h2>视频看房</h2>
            </li>
            <?php endif;  if(!isset($aid) || empty($aid)) : $aid = "0"; endif; $tagFanglist = new \think\template\taglib\eju\TagFanglist; $_result = $tagFanglist->getFanglist("photo", $aid, "0,1000", "", "desc", "photo_type","xinfang");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k = 0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, 1000, true) : $_result["list"]->slice(0, 1000, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 );  if(!isset($aid) || empty($aid)) : $aid = "0"; endif;if(is_array($vo['children']) || $vo['children'] instanceof \think\Collection || $vo['children'] instanceof \think\Paginator): $i = 0; $e = 1;$k = 0;$__LIST__ = is_array($vo['children']) ? array_slice($vo['children'],0,1, true) : $vo['children']->slice(0,1, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <li> <a href="javascript:;"><img src="<?php echo $field['photo_pic']; ?>" alt="<?php echo $field['photo_type']; ?><?php echo $field['photo_title']; ?>"></a>
              <h2><?php echo $field['photo_type']; ?><?php echo $field['photo_title']; ?></h2>
            </li>
            <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = []; ?>
          </ul>
        </div>
      </div>
      <div class="new-house-info">
        <div class="news-house-right-top">
          <div class="house-price"> <span> 均价：</span><?php if(!(empty($eju['field']['average_price']) || (($eju['field']['average_price'] instanceof \think\Collection || $eju['field']['average_price'] instanceof \think\Paginator ) && $eju['field']['average_price']->isEmpty()))): ?><em><?php echo $eju['field']['average_price']; ?></em><?php echo $eju['field']['price_units']; else: ?>暂无<?php endif; ?>
            <div class="house-price-tool fr"> <a href="<?php  $typeid = "17"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?><?php echo $field['typeurl']; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>" title="" target="_blank"><i class="iconfont">&#xe752;</i> 房贷计算器</a> | <a href="javascript:;" class="J_dialog" data-id="12" data-model="house" data-type="5" data-uri="<?php  $tagDiyurl = new \think\template\taglib\eju\TagDiyurl; $__VALUE__ = $tagDiyurl->getDiyurl("form"); echo $__VALUE__; ?>"><i class="iconfont">&#xe600;</i> 降价通知</a> </div>
          </div>
          <p class="house-price-timeout">价格有效期至：<span><?php echo myDate('Y-m-d',$eju['field']['price_time']); ?></span></p>
        </div>
        <div class="news-house-box">
          <ul class="news-house-base">
            <li>
              <label>开盘时间 ：</label>
              <?php echo myDate('Y年m月d日',$eju['field']['opening_time']); ?><a href="javascript:;" class="J_dialog" data-id="12" data-model="house" data-type="6" data-uri="<?php  $tagDiyurl = new \think\template\taglib\eju\TagDiyurl; $__VALUE__ = $tagDiyurl->getDiyurl("form"); echo $__VALUE__; ?>"><i class="lpt_icon "></i>开盘通知</a> </li>
            <li>
              <label>交房时间 ：</label>
              <?php echo myDate('Y年m月d日',$eju['field']['complate_time']); ?> </li>
            <li class="clearfix">
              <label class="fl">主力户型 ：</label>
              <span class="fl"><?php echo $eju['field']['main_unit']; ?></span> </li>
            <li>
              <label>预&nbsp; 售&nbsp;证  ：</label>
              <?php echo $eju['field']['licence']; ?> </li>
            <li>
              <label>开 &nbsp;发&nbsp;商  ：</label>
              <?php echo $eju['field']['developer']; ?> </li>
            <li>
              <label>项目地址 ：</label>
              <?php echo $eju['field']['address']; ?> <a href="<?php  $tagDiyurl = new \think\template\taglib\eju\TagDiyurl; $__VALUE__ = $tagDiyurl->getDiyurl("map"); echo $__VALUE__; ?>">查看地图<i class="iconfont">&#xe9d1;</i> </a> </li>
          </ul>
          <div class="new-house-telphone clearfix">
            <div class="new-house-telbox fl">
              <div class="telx"><i>售楼处咨询电话</i><?php echo $eju['field']['sale_phone']; if(!(empty($eju['field']['phone_code']) || (($eju['field']['phone_code'] instanceof \think\Collection || $eju['field']['phone_code'] instanceof \think\Paginator ) && $eju['field']['phone_code']->isEmpty()))): ?><b>转</b><?php echo $eju['field']['phone_code']; endif; ?>&nbsp;</div>
            </div>
          </div>
          <button type="button" class="J_dialog " data-id="12" data-model="house" data-type="1" data-uri="<?php  $tagDiyurl = new \think\template\taglib\eju\TagDiyurl; $__VALUE__ = $tagDiyurl->getDiyurl("form"); echo $__VALUE__; ?>">预约看房</button>
          <button type="button" class="J_dialog " data-id="12" data-model="house" data-type="1" data-uri="<?php  $tagDiyurl = new \think\template\taglib\eju\TagDiyurl; $__VALUE__ = $tagDiyurl->getDiyurl("form"); echo $__VALUE__; ?>">免费通话</button>
        </div>
      </div>
    </div>
  </div>
  <div class="bg-gray">
    <div class="fix-width">
      <div class="detail-content clearfix">
        <div class="detail-left fl">
          <div class="detail-row">
            <div class="title">楼盘动态 <a href="<?php echo arcurl('home/Xinfang/index',['aid'=>$eju['field']['xinfang']['aid'],'dirname'=>$eju['field']['xinfang']['dirname'],'dirpath'=>$eju['field']['xinfang']['dirpath'],'column'=>'information']); ?>" class="more fr">更多</a></div>
            <ul class="news-lists">
              <?php  $typeid = "4"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 2; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> $eju['field']['aid'],      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'typeid' => '4',
  'joinaid' => '$eju.field.aid',
  'orderby' => 'new',
  'limit' => '0,2',
  'id' => 'field',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
              <li> <a href="<?php echo $field['arcurl']; ?>" target="_blank" title="<?php echo $field['title']; ?>">
                <h2><em><?php echo $field['typename']; ?></em><?php echo $field['title']; ?> <span><?php echo MyDate('Y-m-d',$field['add_time']); ?></span></h2>
                <p><?php echo html_msubstr($field['seo_description'],0,90,true); ?></p>
                </a> </li>
              <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
            </ul>
          </div>
        </div>
        <div class="detail-right fr">
          <div class="right-row">
            <h2>消息通知<span>（我们将为您保密个人信息）</span></h2>
            <?php  $tagForm = new \think\template\taglib\eju\TagForm; $_result = $tagForm->getForm("3", "", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <form method="post" id="<?php echo $field['form_name']; ?>" action="<?php echo $field['action']; ?>" onsubmit="<?php echo $field['submit']; ?>">
              <div class="right-form">
                <div class="form-type">
                  <p> <?php if(is_array($field['options_8']) || $field['options_8'] instanceof \think\Collection || $field['options_8'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($field['options_8']) ? array_slice($field['options_8'],0,2, true) : $field['options_8']->slice(0,2, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$attr): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
                    <label>
                      <input type="checkbox" id="<?php echo $field['attr_8']; ?>" name="<?php echo $field['attr_8']; ?>" value="<?php echo $attr['value']; ?>">
                      <?php echo $attr['value']; ?> </label>
                    <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $attr = []; ?> </p>
                  <p> <?php if(is_array($field['options_8']) || $field['options_8'] instanceof \think\Collection || $field['options_8'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0;$__LIST__ = is_array($field['options_8']) ? array_slice($field['options_8'],2,2, true) : $field['options_8']->slice(2,2, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$attr): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
                    <label>
                      <input type="checkbox" id="<?php echo $field['attr_8']; ?>" name="<?php echo $field['attr_8']; ?>" value="<?php echo $attr['value']; ?>">
                      <?php echo $attr['value']; ?> </label>
                    <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $attr = []; ?> </p>
                </div>
                <div class="form-input">
                  <p>
                    <input type="text" id="<?php echo $field['attr_6']; ?>" name="<?php echo $field['attr_6']; ?>" autocomplete="off" placeholder="您的<?php echo $field['itemname_6']; ?>" class="input-txt" />
                  </p>
                </div>
                <div class="button">
                  <button class="subscribe-btn" type="submit">立即订阅</button>
                </div>
              </div>
              <?php echo $field['hidden']; ?>
            </form>
            <?php ++$e;$k++; endforeach;endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?> </div>
        </div>
      </div>
      <div class="detail-content clearfix">
        <div class="detail-row margin-top20">
          <div class="title">在售户型 <a href="<?php echo arcurl('home/Xinfang/index',['aid'=>$eju['field']['xinfang']['aid'],'dirname'=>$eju['field']['xinfang']['dirname'],'dirpath'=>$eju['field']['xinfang']['dirpath'],'column'=>'huxing']); ?>" class="more fr">更多</a>
            <div class="room-count fr"> <a href="<?php echo arcurl('home/Xinfang/index',['aid'=>$eju['field']['xinfang']['aid'],'dirname'=>$eju['field']['xinfang']['dirname'],'dirpath'=>$eju['field']['xinfang']['dirpath'],'column'=>'huxing']); ?>" title="全部户型">全部户型(<span><?php echo count($eju['field']['huxing_list']); ?></span>)</a> <?php  if(!isset($aid) || empty($aid)) : $aid = "0"; endif; $tagFanglist = new \think\template\taglib\eju\TagFanglist; $_result = $tagFanglist->getFanglist("huxing", $aid, "0,1000", "", "desc", "huxing_room","xinfang");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k = 0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, 1000, true) : $_result["list"]->slice(0, 1000, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $i= intval($key) + 1;$mod = ($i % 2 ); ?> <a href="<?php echo arcurl('home/Xinfang/index',['aid'=>$eju['field']['xinfang']['aid'],'dirname'=>$eju['field']['xinfang']['dirname'],'dirpath'=>$eju['field']['xinfang']['dirpath'],'column'=>'huxing','room'=>$field['huxing_room']]); ?>" name=".tab_<?php echo $field['huxing_room']; ?>"><?php echo $field['huxing_room']; ?>居室(<span><?php echo $field['count']; ?></span>)</a> <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?> </div>
          </div>
          <div class="room-lists" id="type"> <?php  if(!isset($aid) || empty($aid)) : $aid = "0"; endif;if(is_array($eju['field']['huxing_list']) || $eju['field']['huxing_list'] instanceof \think\Collection || $eju['field']['huxing_list'] instanceof \think\Paginator): $i = 0; $e = 1;$k = 0;$__LIST__ = is_array($eju['field']['huxing_list']) ? array_slice($eju['field']['huxing_list'],0,3, true) : $eju['field']['huxing_list']->slice(0,3, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <div class="loan room-row clearfix" >
             <a href="<?php echo arcurl('home/Xinfang/index',['aid'=>$eju['field']['aid'],'dirname'=>$eju['field']['dirname'],'dirpath'=>$eju['field']['dirpath'],'column'=>'huxing','sid'=>$field['huxing_id']]); ?>">
              <div class="pic-box fl"> <img src="<?php echo $field['huxing_pic']; ?>" alt=""> <span><?php echo $field['huxing_room']; ?>室<?php echo $field['huxing_living_room']; ?>厅</span> </div>
              </a>
              <div class="room-info fl">
                <h2><a href="<?php echo arcurl('home/Xinfang/index',['aid'=>$eju['field']['aid'],'dirname'=>$eju['field']['dirname'],'dirpath'=>$eju['field']['dirpath'],'column'=>'huxing','sid'=>$field['huxing_id']]); ?>"><?php echo $field['huxing_title']; ?></a></h2>
                <ul>
                  <li>
                    <p>面积:<?php echo $field['huxing_area']; ?>㎡</p>
                    <p>朝向:<?php echo $field['huxing_aspect']; ?></p>
                  </li>
                </ul>
                <div class="suanjia"> <a class="view-layout-image" href="<?php echo $field['huxing_pic']; ?>" title="<?php echo $field['huxing_room']; ?>室<?php echo $field['huxing_living_room']; ?>厅<?php echo $field['huxing_toilet']; ?>卫<?php echo $field['huxing_kitchen']; ?>厨" rel="prettyPhoto[]">查看户型原图</a> </div>
              </div>
              <div class="newHouseHxRight">
                <div class="hxPrise">
                  <div><span class="yfyj">
                    <p><?php echo $field['huxing_price']; ?></p>
                    </span> </div>
                  <span>参考总价： </span> </div>
                <input type="button" value="获取最新价格变动" class="getChangePzBtn J_dialog" data-id="12" data-model="house" data-type="1" data-uri="<?php  $tagDiyurl = new \think\template\taglib\eju\TagDiyurl; $__VALUE__ = $tagDiyurl->getDiyurl("form"); echo $__VALUE__; ?>">
              </div>
            </div>
            <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?> </div>
        </div>
        <div class="detail-row margin-top20">
          <div class="title">楼盘相册 <a href="<?php echo arcurl('home/Xinfang/index',['aid'=>$eju['field']['xinfang']['aid'],'dirname'=>$eju['field']['xinfang']['dirname'],'dirpath'=>$eju['field']['xinfang']['dirpath'],'column'=>'photo']); ?>" title="相册" class="more fr">更多</a>
            <div class="room-count fr"> <?php  if(!isset($aid) || empty($aid)) : $aid = "0"; endif; $tagFanglist = new \think\template\taglib\eju\TagFanglist; $_result = $tagFanglist->getFanglist("photo", $aid, "0,1000", "", "desc", "photo_type","xinfang");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k = 0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, 1000, true) : $_result["list"]->slice(0, 1000, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $i= intval($key) + 1;$mod = ($i % 2 ); ?> <a href="<?php echo arcurl('home/Xinfang/index',['aid'=>$eju['field']['xinfang']['aid'],'dirname'=>$eju['field']['xinfang']['dirname'],'dirpath'=>$eju['field']['xinfang']['dirpath'],'column'=>'photo','photo_type'=>$field['photo_type']]); ?>" name=".cate_<?php echo $field['photo_type']; ?>"><?php echo $field['photo_type']; ?>(<?php echo $field['count']; ?>)</a> <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?> </div>
          </div>
          <ul class="photo-lists clearfix" id="photo">
            <?php  if(!isset($aid) || empty($aid)) : $aid = "0"; endif;if(is_array($eju['field']['photo_list']) || $eju['field']['photo_list'] instanceof \think\Collection || $eju['field']['photo_list'] instanceof \think\Paginator): $i = 0; $e = 1;$k = 0;$__LIST__ = is_array($eju['field']['photo_list']) ? array_slice($eju['field']['photo_list'],0,8, true) : $eju['field']['photo_list']->slice(0,8, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <li> <a href="<?php echo $field['photo_pic']; ?>" title="<?php echo $field['photo_type']; ?>" rel="prettyPhoto[]"> <img src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/img/nopic.jpg" data-original="<?php echo $field['photo_pic']; ?>" class="lazy" alt="">
              <p><?php echo $field['photo_type']; ?></p>
              </a> </li>
            <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
          </ul>
        </div>
        <div class="detail-row margin-top20">
          <div class="title">楼盘详情 </div>
          <ul class="base-info clearfix">
            <li>
              <label>开发商</label>
              <?php echo $eju['field']['developer']; ?></li>
            <li>
              <label>产权年限</label>
              <?php echo $eju['field']['property']; ?><?php echo $eju['field']['property_unit']; ?></li>
            <li>
              <label>占地面积</label>
              <?php echo $eju['field']['floor_area']; ?><?php echo $eju['field']['floor_area_unit']; ?></li>
            <li>
              <label>建筑面积</label>
              <?php echo $eju['field']['building_area']; ?><?php echo $eju['field']['building_area_unit']; ?></li>
            <li>
              <label>绿化率</label>
              <?php echo $eju['field']['greening_rate']; ?><?php echo $eju['field']['greening_rate_unit']; ?></li>
            <li>
              <label>容积率</label>
              <?php echo $eju['field']['plot_ratio']; ?><?php echo $eju['field']['plot_ratio_unit']; ?></li>
            <li>
              <label>车位情况</label>
              <?php echo $eju['field']['carport']; ?><?php echo $eju['field']['carport_unit']; ?></li>
            <li>
              <label>规划户数</label>
              <?php echo $eju['field']['households']; ?><?php echo $eju['field']['households_unit']; ?></li>
            <li>
              <label>物业费</label>
              <?php echo $eju['field']['property_fee']; ?><?php echo $eju['field']['property_fee_unit']; ?></li>
            <li>
              <label>物业公司</label>
              <?php echo $eju['field']['manage_company']; ?></li>
            <li>
              <label>装修情况</label>
              <?php echo implode(",",$eju['field']['fitment']); ?></li>
          </ul>
          <div class="house-con">
            <p><?php echo $eju['field']['content']; ?></p>
            <p><br/>
            </p>
          </div>
        </div>
        <div class="detail-row margin-top20">
          <div class="title">周边配套 </div>
          <div class="map-box">
            <div id="map"></div>
            <?php  $tagSurroundings = new \think\template\taglib\eju\TagSurroundings; $_result_tmp = $tagSurroundings->getSurroundings($eju['field'],"map","heihei","active","total","lp-map-tab","result");if(!empty($_result_tmp)): $field = $_result_tmp ;?>
            <div class="map-mart">
              <div class="map-mart-title" id="map-keyword">
                <?php if(is_array($field['list']) || $field['list'] instanceof \think\Collection || $field['list'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $field['list'];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
                <a href="javascript:;" class="heihei" onclick="select_around(<?php echo $key; ?>);"><?php echo $vo; ?></a>
                <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = []; ?>
              </div>
              <ul class="map-mart-lists" id="result">
              </ul>
            </div>
            <?php echo $field['hidden'];  else: echo htmlspecialchars_decode("");endif; $field = []; ?>
          </div>
        </div>
      </div>
      <div class="itr_box margin-top20" id="same-estate">
        <ul class="lbtitle bigtit" id="js_jrtab_ul">
          <li class="hover" id="js_jrtab_0" data-index="0">猜你喜欢</li>
          <li id="js_jrtab_1" class="" data-index="1">为您推荐</li>
        </ul>
        <div class=" itr_box_con">
          <div class="huxing_cont" id="js_jrtabi_0" style="">
            <ul class="photo_album pt_h200" style="padding-top: 20px; padding-bottom: 10px;" id="divMaylikeUl">
             <?php  $typeid = "1"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 5; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'typeid' => '1',
  'orderby' => 'rand',
  'limit' => '0,5',
  'id' => 'field',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "rand", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
              <li style="position:relative;"> 
                <div class="map_comment">
                  <div class="dh_c_alone_img">
                    <p><a href="<?php echo $field['arcurl']; ?>" target="_blank"> <img class="imgts" alt="<?php echo $field['title']; ?>" src="<?php echo $field['litpic']; ?>" border="0" width="220"></a></p>
                  </div>
                </div>
                <div class="photo_album_txt f14 text_left"> <span class="photo_album_txt_p"> <a href="<?php echo $field['arcurl']; ?>" target="_blank" title=""><b><?php echo $field['title']; ?></b></a> </span> <span style="width:222px;">均价：<b class="red01"><?php if(!(empty($field['average_price']) || (($field['average_price'] instanceof \think\Collection || $field['average_price'] instanceof \think\Paginator ) && $field['average_price']->isEmpty()))): ?><?php echo $field['average_price']; ?><?php echo $field['price_units']; else: ?>暂无<?php endif; ?></b></span> </div>
              </li>
              <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
            </ul>
          </div>
          <!--同价位楼盘-->
          <div class="huxing_cont " id="js_jrtabi_1" style="display: none;">
            <ul id="xfptxq_B23_02" class="photo_album pt_h200" style="padding-top: 20px; padding-bottom: 10px;">
             <?php  $typeid = "1"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 5; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "c",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'typeid' => '1',
  'flag' => 'c',
  'orderby' => 'new',
  'limit' => '0,5',
  'id' => 'field',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "new", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
              <li style="position:relative;"> 
                <div class="map_comment">
                  <div class="dh_c_alone_img">
                    <p><a href="<?php echo $field['arcurl']; ?>" target="_blank"> <img class="imgts" alt="<?php echo $field['title']; ?>" src="<?php echo $field['litpic']; ?>" border="0" width="220"></a></p>
                  </div>
                </div>
                <div class="photo_album_txt f14 text_left"> <span class="photo_album_txt_p"> <a href="<?php echo $field['arcurl']; ?>" target="_blank" title=""><b><?php echo $field['title']; ?></b></a> </span> <span style="width:222px;">均价：<b class="red01"><?php if(!(empty($field['average_price']) || (($field['average_price'] instanceof \think\Collection || $field['average_price'] instanceof \think\Paginator ) && $field['average_price']->isEmpty()))): ?><?php echo $field['average_price']; ?><?php echo $field['price_units']; else: ?>暂无<?php endif; ?></b></span> </div>
              </li>
              <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
            </ul>
          </div>
        </div>
      </div>
     <div class="bottom"></div>
    </div>
  </div>
</div>
<script src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/qiniuplayer.min.js"></script> 
<script src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/sandmove.js"></script> 
<script src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/loan.js"></script> 
<script type="text/javascript" src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/jquery.superslide.2.1.1.js"></script> 
<script type="text/javascript" src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/laytpl.js"></script> 
<script type="text/javascript" src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/jquery.prettyphoto.js"></script> 
<script src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/scroll_nav.js"></script> 
<script>
    $(window).scroll(function(e){
        var t = $(window).scrollTop(),
                top = $(".fix-header"),
                right = $(".detail-right > .right-row"),
                right_h = right.height(),
                b = $("#same-estate").offset().top,
                h = $(".detail-content").offset().top;
        if(t > h && t < b-right_h) {
            top.show();
        } else if(t > b - right_h){
        } else {
            top.hide();
            right.removeClass('fix absolute');
        }
    });
    var total = 0,storage = "1",video = "" && storage == 1 ? true : false;
    $(function(){
        
        jQuery(".slides-box").slide({
            titCell:".slides-small-box li",
            mainCell:".slides-big-box ul",
            prevCell:".slides-big-left",
            nextCell:".slides-big-right",
            delayTime:200,
            effect:"left",
            autoPlay:false,
            trigger:"click",
            startFun: function(i, p) {
                if (i == 0) {
                    jQuery(".slides-small .prev").click()
                } else if (i % 4 == 0) {
                    jQuery(".slides-small .next").click()
                }
            }
        });
        jQuery(".slides-box .slides-small").slide({ mainCell:"ul",delayTime:100,vis:4,scroll:4,effect:"left",autoPage:true,prevCell:".prev",nextCell:".next",pnLoop:false });
        jQuery(".excellent-box").slide({titCell:".slide-pages ul",mainCell:".row-lists",autoPage:true,interTime:3500,effect:"left",autoPlay:true,scroll:4,vis:4,trigger:"click"});
        getBanInfo($("#ban_lists a.active").data('id'));
        $("#ban_lists a").on('click',function(){
            var id = $(this).data('id');
            $(this).addClass('active').parent().siblings().find('.active').removeClass('active');
            getBanInfo(id);
        });
        $(".ban").on('click',function(){
            var id = $(this).data('id');
            $("#ban_lists").find('.active').removeClass('active');
            $("#ban_lists").find("a[data-id='"+id+"']").addClass('active');
            getBanInfo(id);
        });
        $("#photo:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
        $("#type:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
        $(".room_count").each(function(){
            total += parseInt($(this).text());
        });
        $('#room_total').text(total);
        $('.J_dialog').on('click',function(){
            var me=$(this),w = 420,h = 270,house_id=me.data('id'),model = me.data('model'),type = me.data('type'),url = me.data('uri');
            url = url + '?house_id='+house_id+'&type='+type+'&model='+model;
            layer.open({
                type: 2,
                title: false,
                fix:true,
                move:false,
                area: [w+'px', h+'px'],
                shade: 0.5,
                closeBtn: 1,
                shadeClose: true,
                content: url
            });
        });
        
    });
    
    function getBanInfo(id)
    {
        var url   = $("#ban_lists").data('uri');
        var param = {id:id};
        if(url)
        {
            $.get(url,param,function(result){
                if(result.code == 1)
                {
                    if(result.data){
                        var gettpl = document.getElementById('template').innerHTML;
                        laytpl(gettpl).render(result.data, function(html){
                            document.getElementById('ban_info').innerHTML = html;
                        });
                    }
                }else{
                    console.log('get data error');
                }
            });
        }

    }
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
	$(function(){
		$('#js_jrtab_ul li').mouseover(function(){
			var index = $(this).data('index');
			$('#js_jrtabi_0,#js_jrtabi_1').hide();
			$('#js_jrtabi_'+index).show();
			$('#js_jrtab_ul li').removeClass('hover');
			$(this).addClass('hover');
		}).mouseout(function(){
			var index = $(this).data('index');
			$('#js_jrtabi_0,#js_jrtabi_1').hide();
			$('#js_jrtabi_'+index).show();
			$('#js_jrtab_ul li').removeClass('hover');
			$(this).addClass('hover');
		});
	});
	
</script>
</body>
</html>