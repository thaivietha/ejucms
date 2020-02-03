<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:37:"./template/default/pc/view_shopcs.htm";i:1580691229;s:63:"D:\ejucms\EjuCMS-V1.3.0-UTF8-SP4\template\default\pc\header.htm";i:1580692664;s:63:"D:\ejucms\EjuCMS-V1.3.0-UTF8-SP4\template\default\pc\footer.htm";i:1580691229;}*/ ?>
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
<link rel="stylesheet" type="text/css" href="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/css/spcs.css">
<script src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/jquery.min.js"></script>
<script src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/jquery.qrcode.min.js"></script>
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
<div class="detail-main">
  <div class="position">
    <div class="fix-width"> <a href="javascript:;" rel="nofollow">您的位置：</a>  <?php  $typeid = ""; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagPosition = new \think\template\taglib\eju\TagPosition; $__VALUE__ = $tagPosition->getPosition($typeid, "", ""); echo $__VALUE__; ?>&gt; <?php echo $eju['field']['title']; ?> </div>
  </div>
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
        <div class="tags" style="padding-top:5px;"> 更新时间：<?php echo MyDate('Y-m-d',$eju['field']['add_time']); ?> / 浏览：<?php  $tagArcclick = new \think\template\taglib\eju\TagArcclick; $__VALUE__ = $tagArcclick->getArcclick("", ""); echo $__VALUE__; ?> </div>
      </div>
      <!--<div class="house-follow fr"><a href="javascript:;" class="subscribe J_dialog" data-id="14" data-model="second_house" data-type="1" data-uri="<?php  $tagDiyurl = new \think\template\taglib\eju\TagDiyurl; $__VALUE__ = $tagDiyurl->getDiyurl("form"); echo $__VALUE__; ?>">预约看房</a> </div>-->
    </div>
  </div>
  <div class="fix-header se">
    <div class="container">
      <div class="unstyled">
        <h4><?php echo $eju['field']['title']; ?></h4>
        <p><?php echo $eju['field']['fitment']; ?>，<?php echo $eju['field']['area']; ?><?php echo $eju['field']['area_unit']; ?>，<?php echo $eju['field']['total_price']; ?><?php echo $eju['field']['total_price_unit']; ?></p>
        <div> <i></i>
          <p><?php echo $eju['field']['sale_name']; ?>  <?php echo $eju['field']['sale_phone']; if(!(empty($eju['field']['phone_code']) || (($eju['field']['phone_code'] instanceof \think\Collection || $eju['field']['phone_code'] instanceof \think\Paginator ) && $eju['field']['phone_code']->isEmpty()))): ?> 转 <?php echo $eju['field']['phone_code']; endif; ?></p>
        </div>
      </div>
    </div>
  </div>
  <div class="fix-width">
    <div class="detail-info clearfix">
      <div class="slides-box width600 fl">
        <div class="slides-big-box width600">
          <ul>
            <?php if(is_array($eju['field']['photo_list']) || $eju['field']['photo_list'] instanceof \think\Collection || $eju['field']['photo_list'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $eju['field']['photo_list'];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <li> <a href="javascript:;" title="<?php echo $eju['field']['title']; ?>"> <img onerror="this.src='<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/img/nopic.jpg'" src="<?php echo $vo['photo_pic']; ?>" alt="<?php echo $eju['field']['title']; ?>"> </a> </li>
            <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = []; ?>
          </ul>
          <a href="javascript:;" class="slides-icon slides-big-left"></a> <a href="javascript:;" class="slides-icon slides-big-right"></a> </div>
        <div class="slides-small"> <a href="javascript:;" class="prev iconfont">&#xe62a;</a> <a href="javascript:;" class="next iconfont">&#xe9d1;</a>
          <ul class="slides-small-box width600">
            <?php if(is_array($eju['field']['photo_list']) || $eju['field']['photo_list'] instanceof \think\Collection || $eju['field']['photo_list'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $eju['field']['photo_list'];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
            <li> <a href="javascript:;" title="<?php echo $eju['field']['title']; ?>"> <img onerror="this.src='<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/img/nopic.jpg'" src="<?php echo $vo['photo_pic']; ?>" alt="<?php echo $eju['field']['title']; ?>"> </a> </li>
            <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = []; ?>
          </ul>
        </div>
      </div>
      <div class="spcsdetail-house-info fr">
        <div class="second-box">
          <div class="house-price"> <?php if(!(empty($eju['field']['total_price']) || (($eju['field']['total_price'] instanceof \think\Collection || $eju['field']['total_price'] instanceof \think\Paginator ) && $eju['field']['total_price']->isEmpty()))): ?><b><?php echo $eju['field']['total_price']; ?></b><?php echo $eju['field']['total_price_unit']; else: ?>暂无<?php endif; ?>&nbsp;&nbsp;</div>
          <div class="tags"> </div>
          <div class="house-first-pay"> </div>
        </div>
        <div class="basic">
          <ul>
            <li> <span>装修情况</span>
              <p><?php echo $eju['field']['fitment']; ?></p>
            </li>
            <li> <span>楼盘名称</span>
              <p><?php if(!(empty($eju['field']['xiaoqu']['title']) || (($eju['field']['xiaoqu']['title'] instanceof \think\Collection || $eju['field']['xiaoqu']['title'] instanceof \think\Paginator ) && $eju['field']['xiaoqu']['title']->isEmpty()))): ?><a href="<?php echo $eju['field']['xiaoqu']['arcurl']; ?>"><?php echo $eju['field']['xiaoqu']['title']; ?></a><?php else: ?>暂无数据<?php endif; ?></p>
            </li>
            <li> <span>所在地址</span>
              <p><?php echo get_city_name($eju['field']['xiaoqu']['city_id']); ?> - <?php echo get_area_name($eju['field']['xiaoqu']['area_id']); ?> - <?php echo $eju['field']['xiaoqu']['address']; ?><a href="<?php  $tagDiyurl = new \think\template\taglib\eju\TagDiyurl; $__VALUE__ = $tagDiyurl->getDiyurl("mapershou"); echo $__VALUE__; ?>"><s></s></a></p>
            </li>
          </ul>
        </div>
        <div class="second-padding">
          <ul class="house-tag-box clearfix" style="border-top:none;">
            <li>
              <p>类型</p>
              <p class="house-tag"><?php echo $eju['field']['manage_type']; ?></p>
            </li>
            <li>
              <p>面积</p>
              <p class="house-tag"><?php echo $eju['field']['area']; ?><?php echo $eju['field']['area_unit']; ?></p>
            </li>
            <li>
              <p>分割</p>
              <p class="house-tag"><?php echo $eju['field']['division']; ?></p>
            </li>
          </ul>
          <div class="broker-info clearfix" style="padding-top:20px;">
            <div class="broker-avatar fl"> <a href="javascript:;" class="clearfix" title="" target="_blank"> <?php if(!(empty($eju['field']['saleman']) || (($eju['field']['saleman'] instanceof \think\Collection || $eju['field']['saleman'] instanceof \think\Paginator ) && $eju['field']['saleman']->isEmpty()))): ?> <img src="<?php echo $eju['field']['saleman']['saleman_pic']; ?>" alt="<?php echo $eju['field']['saleman']['saleman_name']; ?>"> <?php else: ?> <img src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/img/noavatar.jpg" alt="头像"> <?php endif; ?> </a> </div>
            <dl class="noyongjin">
              <dt> <a href="#" target="_blank"> <b><?php echo $eju['field']['sale_name']; ?></b> </a> <span>置业管家</span> </dt>
              <dd class="cardTels" ><i class="iconfont">&#xe64d;</i> <?php echo $eju['field']['sale_phone']; if(!(empty($eju['field']['phone_code']) || (($eju['field']['phone_code'] instanceof \think\Collection || $eju['field']['phone_code'] instanceof \think\Paginator ) && $eju['field']['phone_code']->isEmpty()))): ?> 转 <?php echo $eju['field']['phone_code']; endif; ?> </dd>
              <a href="javascript:;" class="J_dialog"  data-id="14" data-model="second_house" data-type="1" data-uri="<?php  $tagDiyurl = new \think\template\taglib\eju\TagDiyurl; $__VALUE__ = $tagDiyurl->getDiyurl("form"); echo $__VALUE__; ?>">
              <div class="dialog" style=""> <img src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/img/liaobei.png" style="">
                <text style="font-size: 16px;color: #FFF;line-height: 40px;letter-spacing: 2px;">聊呗</text>
              </div>
              </a>
            </dl>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="bg-gray">
    <div class="fix-width">
      <div class="detail-content clearfix">
        <div class="detail-left fl">
          
          <div class="detail-row">
            <div class="titlespcs">房源描述 </div>
            <div class="house-content">
              <p ><?php echo $eju['field']['content']; ?></p>
            </div>
          </div>
          <div class="detail-row margin-top20">
            <div class="titlespcs">房屋配套 </div>
            <ul class="mart-info clearfix">
              <?php if(is_array($eju['field']['supporting']) || $eju['field']['supporting'] instanceof \think\Collection || $eju['field']['supporting'] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = $eju['field']['supporting'];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$vo): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
              <li><img src="<?php echo get_supporting_icon($vo); ?>" /><?php echo $vo; ?></li>
              <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $vo = []; ?>
            </ul>
          </div>
          <div class="detail-row margin-top20">
            <div class="titlespcs">房源相册 </div>
            <ul class="spcsphoto-lists clearfix" id="photo">
              <?php  if(!isset($aid) || empty($aid)) : $aid = "0"; endif;if(is_array($eju['field']['photo_list']) || $eju['field']['photo_list'] instanceof \think\Collection || $eju['field']['photo_list'] instanceof \think\Paginator): $i = 0; $e = 1;$k = 0;$__LIST__ = is_array($eju['field']['photo_list']) ? array_slice($eju['field']['photo_list'],0,1000, true) : $eju['field']['photo_list']->slice(0,1000, true); if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $i= intval($key) + 1;$mod = ($i % 2 ); ?>
              <li> <a href="<?php echo $field['photo_pic']; ?>" title="<?php echo $field['photo_title']; ?>" rel="prettyPhoto[]"> <img src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/img/nopic.jpg" data-original="<?php echo $field['photo_pic']; ?>" class="lazy" />
                <p><?php echo $field['photo_title']; ?></p>
                </a> </li>
              <?php ++$e;$k++; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
            </ul>
          </div>
        </div>
        <div class="detail-right fr">
          <div class="right-row">
            <div class="esrecommend">
              <h1><i class="shugang"></i>同区域您可能感兴趣的房源</h1>
              <ul>
                <?php  $typeid = ""; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 6; $channelid = "14"; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> $eju['field']['joinaid'],      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
  'channelid' => '14',
  'joinaid' => '$eju.field.joinaid',
  'orderby' => 'rand',
  'row' => '6',
  'id' => 'field',
); $tagArclist = new \think\template\taglib\eju\TagArclist; $_result = $tagArclist->getArclist($param, $row, "rand", "","desc","",$tag,"0","on");if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $i = 0; $e = 1;$k=0; $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],0, $row, true) : $_result["list"]->slice(0, $row, true);  $__TAG__ = $_result["tag"];if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: foreach($__LIST__ as $key=>$field): $aid = $field["aid"];$field["title"] = text_msubstr($field["title"], 0, 100, false);$field["seo_description"] = text_msubstr($field["seo_description"], 0, 160, true);$i= intval($key) + 1;$mod = ($i % 2 ); ?>
                <li> <a href="<?php echo $field['arcurl']; ?>" target="_blank">
                  <div> <img src="<?php echo $field['litpic']; ?>" alt="<?php echo $field['title']; ?>"> <b><?php echo $field['title']; ?></b>
                    <p><?php echo $field['area']; ?><?php echo $field['area_unit']; ?></p>
                    <s><span><?php echo $field['total_price']; ?></span><i><?php echo $field['total_price_unit']; ?></i></s> </div>
                  </a> </li>
                <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?> 
                

                <a href="<?php  $typeid = "24"; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $tagType = new \think\template\taglib\eju\TagType; $_result = $tagType->getType($typeid, "self", ""); if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator):  $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("");else: $field = $__LIST__;?><?php echo $field['typeurl']; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>" target="_blank">查看更多房源 &gt;</a>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="detail-content clearfix">
        <div class="detail-row "  id="same-estate">
          <div class="titlespcs">周边配套 </div>
          <div class="map-box">
            <div id="map"></div>
            <div class="map-mart">
              <div class="map-mart-title" id="map-keyword"> <a href="javascript:;" class="active">银行</a> <a href="javascript:;">交通</a> <a href="javascript:;">购物</a> <a href="javascript:;">学校</a> <a href="javascript:;">医院</a> </div>
              <ul class="map-mart-lists" id="result">
              </ul>
            </div>
          </div>
          <script type="text/javascript" src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/39ab8a29b2a14bb28d8f98301d331dfe.js"></script> 
          <script src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/peitao.js"></script> 
          <script>
    var lng = "<?php echo $eju['field']['lng']; ?>";
    var lat = "<?php echo $eju['field']['lat']; ?>";
    var streetView = 0;
    BMapApplication.title    = "<?php echo $eju['field']['title']; ?>";
    BMapApplication.price = "<?php echo $eju['field']['total_price']; ?><i><?php echo $eju['field']['total_price_unit']; ?></i>";
    BMapApplication.saleStatus = "1";
    BMapApplication.init({"lng" : lng, "lat" : lat, "mapContainerId" : "map"});
    BMapApplication.getAreaMap("银行", "bank");
    $(function() {
        $("#map-keyword a").on("click", function (evt) {
            $(this).addClass("active").siblings().removeClass("active");
            var iElem = $(this);
            BMapApplication.getAreaMap(iElem.text(), iElem.attr("search-flag"));
            evt.stopPropagation();
        });
    });
</script> 
        </div>
      </div>
      <div class="itr_box margin-top20">
        <ul class="lbtitle bigtit" id="js_jrtab_ul">
          <li class="hover" id="js_jrtab_0" data-index="0">猜你喜欢</li>
          <li id="js_jrtab_1" class="" data-index="1">为您推荐</li>
        </ul>
        <div class=" itr_box_con">
          <div class="huxing_cont" id="js_jrtabi_0" style="">
            <ul class="photo_album pt_h200" style="padding-top: 20px; padding-bottom: 10px;" id="divMaylikeUl">
              <?php  $typeid = ""; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 5; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
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
                <div class="photo_album_txt f14 text_left"> <span class="photo_album_txt_p"> <a href="<?php echo $field['arcurl']; ?>" target="_blank" title=""><b><?php echo $field['title']; ?></b></a> </span> <span style="width:222px;">均价：<b class="red01"><?php if(!(empty($field['total_price']) || (($field['total_price'] instanceof \think\Collection || $field['total_price'] instanceof \think\Paginator ) && $field['total_price']->isEmpty()))): ?><?php echo $field['total_price']; ?><?php echo $field['total_price_unit']; else: ?>暂无<?php endif; ?></b></span> </div>
              </li>
              <?php ++$e;$k++; $aid = 0; endforeach; endif; else: echo htmlspecialchars_decode("");endif; $field = []; ?>
            </ul>
          </div>
          <!--同价位楼盘-->
          <div class="huxing_cont " id="js_jrtabi_1" style="display: none;">
            <ul id="xfptxq_B23_02" class="photo_album pt_h200" style="padding-top: 20px; padding-bottom: 10px;">
              <?php  $typeid = ""; if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif;  $row = 5; $channelid = ""; $param = array(      "typeid"=> $typeid,      "notypeid"=> "",      "flag"=> "c",      "noflag"=> "",      "channel"=> $channelid,      "joinaid"=> "",      "province_id"=> "",      "city_id"=> "",      "area_id"=> "",      "screen"=> "1",      "users_id"=> "", ); $tag = array (
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
                <div class="photo_album_txt f14 text_left"> <span class="photo_album_txt_p"> <a href="<?php echo $field['arcurl']; ?>" target="_blank" title=""><b><?php echo $field['title']; ?></b></a> </span> <span style="width:222px;">均价：<b class="red01"><?php if(!(empty($field['total_price']) || (($field['total_price'] instanceof \think\Collection || $field['total_price'] instanceof \think\Paginator ) && $field['total_price']->isEmpty()))): ?><?php echo $field['total_price']; ?><?php echo $field['total_price_unit']; else: ?>暂无<?php endif; ?></b></span> </div>
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
<script type="text/javascript" src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/jquery.superslide.2.1.1.js"></script> 
<script src="<?php  $tagGlobal = new \think\template\taglib\eju\TagGlobal; $__VALUE__ = $tagGlobal->getGlobal("web_templets_pc"); echo $__VALUE__; ?>/skin/js/qiniuplayer.min.js"></script> 
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
        
        //滚动楼层
        $(".fix-header").scrollFloor({"oNav":"fix-header","floor":"detail-row","navLi":"li","follow":true,"reduceHeight":-0});

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