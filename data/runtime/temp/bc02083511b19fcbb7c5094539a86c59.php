<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:44:"./application/admin/template/index\index.htm";i:1580691229;s:78:"D:\ejucms\EjuCMS-V1.3.0-UTF8-SP4\application\admin\template\public\menubox.htm";i:1580691229;s:75:"D:\ejucms\EjuCMS-V1.3.0-UTF8-SP4\application\admin\template\public\left.htm";i:1580691229;s:77:"D:\ejucms\EjuCMS-V1.3.0-UTF8-SP4\application\admin\template\public\footer.htm";i:1580691229;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo (isset($global['web_name']) && ($global['web_name'] !== '')?$global['web_name']:''); ?>-<?php if(!(empty($is_eyou_authortoken) || (($is_eyou_authortoken instanceof \think\Collection || $is_eyou_authortoken instanceof \think\Paginator ) && $is_eyou_authortoken->isEmpty()))): ?>易居CMS房地产管理系统<?php endif; ?><?php echo $version; ?></title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?v=<?php echo $version; ?>" media="screen"/>
  <link rel="stylesheet" href="/public/plugins/layui/css/layui.css?v=<?php echo $version; ?>" media="all">
  <link rel="stylesheet" href="/public/static/admin/css/admin.css?v=<?php echo $version; ?>" media="all">
  <link rel="stylesheet" href="/public/static/admin/css/ey_layui.css?v=<?php echo $version; ?>" media="all">
  <link rel="stylesheet" href="/public/static/admin/font/ali-font/iconfont.css?v=<?php echo $version; ?>" media="all">
  <script type="text/javascript">
    var eyou_basefile = window.location.pathname;
    var module_name = "<?php echo MODULE_NAME; ?>";
    var SITEURL = window.location.host + eyou_basefile + "/" + module_name;
    var __root_dir__ = "";
  </script>

  <script type="text/javascript" src="/public/static/admin/js/jquery.js?v=<?php echo $version; ?>"></script>
  <script type="text/javascript" src="/public/static/admin/js/jquery.cookie.js?v=<?php echo $version; ?>"></script>
  <script type="text/javascript" src="/public/plugins/layer-v3.1.0/layer.js?v=<?php echo $version; ?>"></script>
  <script src="/public/static/admin/js/global.js?v=<?php echo $version; ?>"></script>

</head>
<body class="layui-layout-body">
  <div id="LAY_app">
    <div class="layui-layout layui-layout-admin">
      
      <!-- 顶部功能 -->
      
      <div class="layui-header">
        <!-- 头部区域 -->
        <ul class="layui-nav layui-layout-left">
          <li class="layui-nav-item layadmin-flexible" lay-unselect>
            <a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
              <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
            </a>
          </li>
        </ul>

        <div class="layadmin-pagetabs" id="LAY_app_tabs">
          <div class="layui-icon layadmin-tabs-control layui-icon-prev" layadmin-event="leftPage"></div>
          <div class="layui-icon layadmin-tabs-control layui-icon-next" layadmin-event="rightPage"></div>
<!--
          <div class="layui-icon layadmin-tabs-control layui-icon-down">
            <ul class="layui-nav layadmin-tabs-select" lay-filter="layadmin-pagetabs-nav">
            <li class="layui-nav-item" lay-unselect style="border-right: 1px solid #f6f6f6;">
              <a href="javascript:;"></a>
              <dl class="layui-nav-child layui-anim-fadein">
              <dd layadmin-event="closeThisTabs"><a href="javascript:;">关闭当前标签页</a></dd>
              <dd layadmin-event="closeOtherTabs"><a href="javascript:;">关闭其它标签页</a></dd>
              <dd layadmin-event="closeAllTabs"><a href="javascript:;">关闭全部标签页</a></dd>
              </dl>
            </li>
            </ul>
          </div>
-->
          <div class="layui-tab" lay-unauto lay-allowClose="true" lay-filter="layadmin-layout-tabs">
            <ul class="layui-tab-title" id="LAY_app_tabsheader">
            <li lay-id="home/console.html" lay-attr="home/console.html" class="layui-this"><i class="layui-icon layui-icon-home"></i></li>
            </ul>
          </div>
        </div>

        <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">
          <li class="layui-nav-item" lay-unselect>
            <a lay-href="<?php echo url('Form/index'); ?>" layadmin-event="message" lay-text="消息中心">
              <i class="layui-icon layui-icon-notice"></i>  
              <!-- 如果有新消息，则显示小圆点 -->
              <span class="layui-badge-dot form_index_read"></span>
            </a>
          </li>
          <li class="layui-nav-item" lay-unselect>
            <a href="javascript:void(0);" data-url="<?php echo url('System/clear_cache'); ?>" layadmin-event="clear" title="清除缓存">
              <i class="layui-icon layui-icon-refresh-3"></i>
            </a>
          </li>
          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="<?php echo $home_url; ?>" target="_blank" title="网站主页">
              <i class="iconfont icon-diannao1" style="top: 1px;position: relative;"></i>
            </a>
          </li>
          <li class="layui-nav-item layui-hide-xs" lay-unselect="">
            <a href="javascript:;" layadmin-event="fullscreen" title="全屏">
              <i class="layui-icon layui-icon-screen-full"></i>
            </a>
          </li>
          <li class="layui-nav-item mr20" lay-unselect>
            <a href="javascript:;">
              <div class="user-img fl">
                <img src="<?php echo get_head_pic($admin_info['head_pic']); ?>" alt="您的形象" id="admin_head_pic">
              </div>
            </a>
            <dl class="layui-nav-child">
              <dd><a lay-href="<?php echo url('Admin/admin_edit', ['id'=>$admin_info['admin_id']]); ?>">基本资料</a></dd>
              <dd><a lay-href="<?php echo url('Admin/admin_pwd', ['id'=>$admin_info['admin_id']]); ?>">修改密码</a></dd>
              <hr>
              <dd><a lay-href="<?php echo url('Admin/admin_edit', ['id'=>$admin_info['admin_id']]); ?>" lay-text="基本资料"><?php echo $admin_info['user_name']; ?></a></dd>
              <dd layadmin-event="logout"><a>退出</a></dd>
            </dl>
          </li>
        </ul>
      </div>
      
      <!-- 侧边菜单 -->
      
      <div class="layui-side layui-side-menu">
        <div class="layui-side-scroll">
          <div class="layui-logo" href="<?php echo \think\Request::instance()->baseFile(); ?>">
             <span>
              <a href="<?php echo \think\Request::instance()->baseFile(); ?>"><img style="margin-top: 20px" width="120" src="<?php echo (isset($web_adminlogo) && ($web_adminlogo !== '')?$web_adminlogo:'/public/static/admin/images/logo.png'); ?>?v=<?php echo time(); ?>"></a>
             </span>
          </div>
         <!-- <div class="tit-nav">
             <a href="<?php echo \think\Request::instance()->baseFile(); ?>">后台</a>
             <span class="mx-1">|</span>
             <a href="<?php echo $home_url; ?>" target="_blank">首页</a>
             <span class="mx-1">|</span>
             <a href="" target="_blank">功能项</a>
          </div>-->
		  <div style="margin-top: 70px"></div>
          <ul class="layui-nav layui-nav-tree layui-nav-left" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">

            <li data-name="get" class="layui-nav-item layui-this">
              <a href="<?php echo \think\Request::instance()->baseFile(); ?>" lay-tips="系统首页" lay-direction="2">
                <i class="layui-icon layui-icon-home"></i>
                <cite>系统首页</cite>
              </a>
            </li>

            <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if(!(empty($vo['is_menu']) || (($vo['is_menu'] instanceof \think\Collection || $vo['is_menu'] instanceof \think\Paginator ) && $vo['is_menu']->isEmpty()))): ?>
            <li data-name="<?php echo $vo['controller']; ?>_<?php echo $vo['action']; ?>" class="layui-nav-item <?php if($i == '1'): ?>layui-nav-itemed<?php endif; if($vo['is_menu'] == 0): ?>none<?php endif; ?>">
              <a <?php if(!empty($vo['url'])): if($vo['target'] == '_self'): ?>lay-<?php endif; ?>href="<?php echo $vo['url']; ?>"<?php elseif(!empty($vo['action'])): ?>lay-href="<?php echo url($vo['controller'].'/'.$vo['action']); ?>"<?php endif; ?> lay-tips="<?php echo $vo['name']; ?>" target="<?php echo $vo['target']; ?>" lay-direction="2">
                <i class="layui-icon <?php echo $vo['icon']; ?>"></i>
                <cite><?php echo $vo['name']; ?></cite>
                <?php if($vo['controller'] == 'Form' AND $vo['action'] == 'index'): ?><span class="layui-badge-dot form_index_read"></span><?php endif; ?>
              </a>
              <?php if(!(empty($vo['child']) || (($vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator ) && $vo['child']->isEmpty()))): ?>
              <dl class="layui-nav-child">
                <?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;if(!(empty($v2['is_menu']) || (($v2['is_menu'] instanceof \think\Collection || $v2['is_menu'] instanceof \think\Paginator ) && $v2['is_menu']->isEmpty()))): ?>
                <dd data-name="<?php echo $v2['controller']; ?>_<?php echo $v2['action']; ?>" class="<?php if($v2['is_menu'] == 0): ?>none<?php endif; ?>">
                  <a <?php if(!empty($v2['url'])): if($v2['target'] == '_self'): ?>lay-<?php endif; ?>href="<?php echo $v2['url']; ?>"<?php elseif(!empty($v2['action'])): ?>lay-href="<?php echo url($v2['controller'].'/'.$v2['action']); ?>"<?php endif; ?> target="<?php echo $v2['target']; ?>"><?php echo $v2['name']; ?></a>
                </dd>
                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
              </dl>
              <?php endif; ?>
            </li>
            <?php endif; endforeach; endif; else: echo "" ;endif; ?>
          </ul>
        </div>
      </div>
      
      <!-- 主体内容 -->
      <div class="layui-body" id="LAY_app_body">
        <div class="layadmin-tabsbody-item layui-show">
          <iframe src="<?php echo url('Index/welcome'); ?>" class="layadmin-iframe" frameborder="0"></iframe>
        </div>
      </div>
      
      <!-- 辅助元素，一般用于移动设备下遮罩 -->
      <div class="layadmin-body-shade" layadmin-event="shade"></div>
    </div>
  </div>
  <script src="/public/plugins/layui/layui.js?v=<?php echo $version; ?>"></script>

  <script type="text/javascript">
      $(function(){
          otherRemainds();
      })
      function otherRemainds(){
          $('.form_index_read').hide();
          $.ajax({
              type : "GET",
              url  : "<?php echo url('Ajax/check_form_read'); ?>",
              data : {_ajax:1},
              dataType : "JSON",
              success: function(res) {
                  if (1 == res.code){
                      $('.form_index_read').css('display', 'unset');
                  } else {
                      $('.form_index_read').hide();
                  }
              }
          });
      }
      setInterval("otherRemainds()",10000);
  </script>

  <script type="text/javascript">
    layui.config({
      base: '/public/static/admin/' //静态资源所在路径
      ,version: '<?php echo $version; ?>'
    }).extend({
      index: 'lib/index' //主入口模块
    }).use('index');
  </script>
  
  
</body>
</html>