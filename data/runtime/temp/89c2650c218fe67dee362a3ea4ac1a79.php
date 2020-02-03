<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:46:"./application/admin/template/index\welcome.htm";i:1580691229;s:77:"D:\ejucms\EjuCMS-V1.3.0-UTF8-SP4\application\admin\template\public\layout.htm";i:1580691229;s:77:"D:\ejucms\EjuCMS-V1.3.0-UTF8-SP4\application\admin\template\public\footer.htm";i:1580691229;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/public/plugins/layui/css/layui.css?v=<?php echo $version; ?>" media="all">
  <link rel="stylesheet" href="/public/static/admin/css/admin.css?v=<?php echo $version; ?>" media="all">
  <link rel="stylesheet" href="/public/static/admin/css/ey_layui.css?v=<?php echo $version; ?>" media="all">
  <link rel="stylesheet" href="/public/static/admin/font/ali-font/iconfont.css?v=<?php echo $version; ?>" media="all">
  <script type="text/javascript">
    var eyou_basefile = window.location.pathname;
    var module_name = "<?php echo MODULE_NAME; ?>";
    var __root_dir__ = "";
  </script>  
  <script type="text/javascript" src="/public/static/admin/js/jquery.js?v=<?php echo $version; ?>"></script>
  <script type="text/javascript" src="/public/static/admin/js/jquery-ui/jquery-ui.min.js?v=<?php echo $version; ?>"></script>
  <script type="text/javascript" src="/public/plugins/layer-v3.1.0/layer.js?v=<?php echo $version; ?>"></script>
  <script type="text/javascript" src="/public/static/admin/js/jquery.cookie.js?v=<?php echo $version; ?>"></script>
  <script type="text/javascript" src="/public/plugins/laydate/laydate.js?v=<?php echo $version; ?>"></script>
  <script src="/public/plugins/layui/layui.js?v=<?php echo $version; ?>"></script>
  <script src="/public/static/admin/js/global.js?v=<?php echo $version; ?>"></script>
</head>
<body>
  <script type="text/javascript" src="/public/static/admin/js/jquery.js?v=<?php echo $version; ?>"></script>
  <script src="/public/static/admin/js/upgrade.js?v=<?php echo $version; ?>"></script>
  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md8">
        <div class="layui-row layui-col-space15">
          <div class="layui-col-md12">
            <div class="layui-card">
              <div class="layui-card-header">内容统计</div>
              <div class="layui-card-body">
                <div class="layui-carousel layadmin-carousel layadmin-backlog">
                  <div carousel-item>
                    <ul class="layui-row layui-col-space10">
                      <?php if(is_array($contentTotal) || $contentTotal instanceof \think\Collection || $contentTotal instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($contentTotal) ? array_slice($contentTotal,0,7, true) : $contentTotal->slice(0,7, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if(!(empty($vo['is_menu']) || (($vo['is_menu'] instanceof \think\Collection || $vo['is_menu'] instanceof \think\Paginator ) && $vo['is_menu']->isEmpty()))): ?>
                      <li class="layui-col-xs4 layui-col-md3">
                        <a lay-href="<?php echo url($vo['controller'].'/'.$vo['action'], $vo['vars']); ?>" lay-text="<?php echo $vo['laytext']; ?>" class="layadmin-backlog-body">
                          <h3><?php echo $vo['title']; ?></h3>
                          <p><cite><?php echo (isset($vo['total']) && ($vo['total'] !== '')?$vo['total']:'0'); ?></cite></p>
                        </a>
                      </li>
                      <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                      <li class="layui-col-xs4 layui-col-md3">
                        <a href="javascript:;" id="contentTotalAdd" class="layadmin-backlog-body">
                          <h3>添加统计</h3>
                          <p><cite><i style="font-size: 30px" class="layui-icon layui-icon-add-1"></i></cite></p>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="layui-col-md4">
        <div class="layui-card">
          <div class="layui-card-header">版本信息</div>
          <div class="layui-card-body layui-text">
            <table class="layui-table mt8 mb8">
              <colgroup>
                <col width="100">
                <col>
              </colgroup>
              <tbody>
                <tr>
                  <td>系统更新</td>
                  <td id="td_upgrade_msg">
                    <div id="upgrade_filelist" style="display:none;"></div> 
                    <div id="upgrade_intro" style="display:none;"></div> 
                    <div id="upgrade_notice" style="display:none;"></div> 
                    <a href="javascript:void(0);" id="a_upgrade" data-version="" data-max_version="" data-iframe="workspace" title="" data-tips_url="<?php echo url('Upgrade/setPopupUpgrade'); ?>" data-upgrade_url="<?php echo url('Upgrade/OneKeyUpgrade'); ?>" data-check_authority="<?php echo url('Upgrade/check_authority'); ?>">正在版本检测中……</a>
                  </td>
                </tr>
                <tr>
                  <td>当前版本</td>
                  <td>
                    <?php echo (isset($sys_info['curent_version']) && ($sys_info['curent_version'] !== '')?$sys_info['curent_version']:'v1.0.0'); if(!(empty($is_eyou_authortoken) || (($is_eyou_authortoken instanceof \think\Collection || $is_eyou_authortoken instanceof \think\Paginator ) && $is_eyou_authortoken->isEmpty()))): ?>
                    <a href="http://www.ejucms.com/shengjihuizong/" target="_blank" style="padding-left: 15px;">更新日志</a>
                    <?php endif; ?>
                 </td>
                </tr>
                <tr>
                  <td>程序名称</td>
                  <td><?php echo (isset($sys_info['web_name']) && ($sys_info['web_name'] !== '')?$sys_info['web_name']:'易居cms房产网站建设系统'); ?></td>
                </tr>
                <tr>
                  <td>商用许可</td>
                  <?php if(!(empty($is_eyou_authortoken) || (($is_eyou_authortoken instanceof \think\Collection || $is_eyou_authortoken instanceof \think\Paginator ) && $is_eyou_authortoken->isEmpty()))): ?>
                  <td style="padding-bottom: 0;">
                    <div class="layui-btn-container">
                      <a href="http://www.ejucms.com/baojiafuwu/" target="_blank" class="layui-btn layui-btn-danger layui-btn layui-btn-sm">购买授权</a>
                      <a data-url="<?php echo url('Index/authortoken'); ?>" href="javascript:void(0);" id="check_authortoken" class="layui-btn layui-btn layui-btn-sm">立即校验</a>
                    </div>
                  </td>
                  <?php else: ?>
                  <td>正版软件</td>
                  <?php endif; ?>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
	
	<div class="layui-row layui-col-space15">
	  <div class="layui-col-md12">
	        <div class="layui-card">
	          <div class="layui-card-header">内容管理</div>
	          <div class="layui-card-body">
	            <div class="console-menu">
	               <ul class="layui-row layui-col-space10 pt10 pb20">
	                <li class="layui-col-xs3 layui-col-md2">
						<div class="admin-ico-nav">
							<i  class="iconfont icon-haiwaixinfang "></i>
							<cite>新房</cite> 
							<a href="">新房列表</a><a href="">团购列表</a>
						</div>
	                 </li>
					  <li class="layui-col-xs3 layui-col-md2 ">
						 <div class="admin-ico-nav">
							 <i  class="iconfont icon-xinwen"></i>
							 <cite>资讯</cite> 
							 <a href="">资讯列表</a><a href="">资讯新增</a>
						 </div>
					   </li>
					   <li class="layui-col-xs3 layui-col-md2 ">
							 <div class="admin-ico-nav">
								 <i  class="iconfont icon-xiaoquguanli"></i>
								 <cite>小区</cite> 
								 <a href="">小区列表</a><a href="">小区新增</a>
							 </div>
					    </li>
						<li class="layui-col-xs3 layui-col-md2 ">
							 <div class="admin-ico-nav">
								 <i  class="iconfont icon-ershoufang"></i>
								 <cite>二手房</cite> 
								 <a href="">二手房列表</a><a href="">二手房新增</a>
							 </div>
						</li>
						<li class="layui-col-xs3 layui-col-md2 ">
							 <div class="admin-ico-nav">
								 <i  class="iconfont icon-xiaoquchuzuanli"></i>
								 <cite>租房</cite> 
								 <a href="">租房列表</a><a href="">租房新增</a>
							 </div>
						</li>
						<li class="layui-col-xs3 layui-col-md2 ">
							 <div class="admin-ico-nav">
								 <i  class="iconfont icon-daochuSVG-"></i>
								 <cite>商铺</cite> 
								 <a href="">商铺出售</a><a href="">商铺出租</a>
							 </div>
						</li>
						<li class="layui-col-xs3 layui-col-md2 ">
							 <div class="admin-ico-nav">
								 <i  class="iconfont icon-xiezilou"></i>
								 <cite>写字楼</cite> 
								 <a href="">写字楼出售</a><a href="">写字楼出租</a>
							 </div>
						</li>
	                </ul>
	             </div> 
	          </div>
	        </div>
	      </div>
	</div>
    
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
            <div class="layui-card">
              <div class="layui-card-header">快捷导航</div>
              <div class="layui-card-body">
                <div class="console-menu">
                   <ul class="layui-row layui-col-space10">
                    <?php if(is_array($quickMenu) || $quickMenu instanceof \think\Collection || $quickMenu instanceof \think\Paginator): $i = 0; $__LIST__ = $quickMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if(!(empty($vo['is_menu']) || (($vo['is_menu'] instanceof \think\Collection || $vo['is_menu'] instanceof \think\Paginator ) && $vo['is_menu']->isEmpty()))): ?>
                      <li class="layui-col-xs3 layui-col-md2">
                        <a lay-href="<?php echo url($vo['controller'].'/'.$vo['action'], $vo['vars']); ?>" lay-text="<?php echo $vo['laytext']; ?>">
                          <i class="layui-icon"><cite><?php echo $vo['title']; ?></cite></i>
                        </a>
                      </li>
                     <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    <li class="layui-col-xs3 layui-col-md2">
                        <a href="javascript:void(0);" id="quickMenuAdd">
                          <cite><i style="font-size: 30px" class="layui-icon layui-icon-add-1"></i></cite>
                        </a>
                      </li>
                    </ul>
                 </div> 
              </div>
            </div>
          </div>
    </div>
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md8">
        <div class="layui-card">
          <div class="layui-tab layui-tab-brief layadmin-latestData">
            <ul class="layui-tab-title">
              <li class="layui-this">最新楼盘</li>
              <li>最新楼市</li>
            </ul>
            <div class="layui-tab-content">
              <div class="layui-tab-item layui-show">
                <table id="table-index-xinfang" ></table>
                <a class="layui-btn layui-btn-sm mt10" lay-text="内容管理" lay-href="<?php echo url('Archives/index_archives',['channel'=>9]); ?>">查看更多</a>
              </div>
              <div class="layui-tab-item">
                <table id="table-index-article"></table>
                <a class="layui-btn layui-btn-sm mt10"  lay-text="内容管理" lay-href="<?php echo url('Archives/index_archives',['channel'=>1]); ?>">查看更多</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="layui-col-md4">
        <div class="layui-card">
          <div class="layui-card-header">服务器信息</div>
          <div class="layui-card-body layui-text">
          <table class="layui-table">
            <colgroup>
            <col width="150">
            <col>
            </colgroup>
            <tbody>
            <tr>
              <td>服务器操作系统：</td>
              <td><?php echo $sys_info['os']; ?></td>
            </tr>
            <tr>
              <td>服务器域名/IP：</td>
              <td><?php echo $sys_info['domain']; ?> / [ <?php echo $sys_info['ip']; ?> ]</td>
            </tr>
            <tr>
              <td>服务器环境：</td>
              <td><?php echo $sys_info['web_server']; ?></td>
            </tr>
            <tr>
              <td>PHP 版本：</td>
              <td><?php echo $sys_info['phpv']; ?></td>
            </tr>
            <tr>
              <td>Mysql 版本：</td>
              <td><?php echo $sys_info['mysql_version']; ?></td>
            </tr>
            <tr>
              <td>GD 版本：</td>
              <td><?php echo $sys_info['gdinfo']; ?></td>
            </tr>
            <tr>
              <td>文件上传限制：</td>
              <td><?php echo $sys_info['fileupload']; ?></td>
            </tr>
            <tr>
              <td>最大占用内存：</td>
              <td><?php echo $sys_info['memory_limit']; ?></td>
            </tr>
            <tr>
              <td>POST限制：</td>
              <td><?php echo (isset($sys_info['postsize']) && ($sys_info['postsize'] !== '')?$sys_info['postsize']:'unknown'); ?></td>
            </tr>
            <tr>
              <td>最大执行时间：</td>
              <td><?php echo $sys_info['max_ex_time']; ?></td>
            </tr>
            <tr>
              <td>Zip支持：</td>
              <td><?php echo $sys_info['zip']; ?></td>
            </tr>
            <tr>
              <td>Zlib支持：</td>
              <td><?php echo $sys_info['zlib']; ?></td>
            </tr>
            </tbody>
          </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    layui.config({
      base: '/public/static/admin/' //静态资源所在路径
      ,version: '<?php echo $version; ?>'
    }).extend({
      index: 'lib/index' //主入口模块
    }).use(['index', 'console','table'], function(){
      var $ = layui.$
      // ,device = layui.device()
      ,layer = layui.layer
      ,table = layui.table;

      table.render({
          elem: '#table-index-xinfang'
          ,url: "<?php echo url('Xinfang/getAjaxList'); ?>" //模拟接口
          ,page:false
          ,cols: [[
              {field: 'aid', title: 'ID', width:80, sort: true, fixed: 'left'}
              ,{field: 'title', title: '标题',templet: '<div><a lay-text="内容管理" lay-href="{{d.lay_href}}" class="layui-table-link ">{{ d.title }}</div>'}
//              ,{field: 'title', title: '标题',templet: '<div><a href="{{ d.arcurl }}" target="_blank" class="layui-table-link">{{ d.title }}</div>'}
              ,{field: 'typename', title: '所属栏目', width: 120, sort: true}
              ,{field: 'click', title: '浏览量', width: 80, sort: true}
          ]]
      });

      table.render({
          elem: '#table-index-article'
          ,url: "<?php echo url('Article/getAjaxList'); ?>" //模拟接口
          ,page:false
          ,cols: [[
              {field: 'aid', title: 'ID', width:80, sort: true, fixed: 'left'}
                  ,{field: 'title', title: '标题',templet: '<div><a  lay-text="内容管理" lay-href="{{d.lay_href}}" class="layui-table-link ">{{ d.title }}</div>'}
//              ,{field: 'title', title: '标题',templet: '<div><a href="{{ d.arcurl }}" target="_blank" class="layui-table-link">{{ d.title }}</div>'}
              ,{field: 'typename', title: '所属栏目', width: 120, sort: true}
              ,{field: 'click', title: '浏览量', width: 80, sort: true}
          ]]
      });

      check_upgrade_version(); // 版本检测更新弹窗
      $.get("<?php echo url('Ajax/welcome_handle', ['_ajax'=>1]); ?>"); // 进入欢迎页面需要异步处理的业务
      checkInlet(); // 自动检测隐藏index.php
      
      // 新增内容统计
      $('#contentTotalAdd').click(function(){
        //iframe窗
        var iframes = layer.open({
            type: 2,
            title: '内容统计管理',
            fixed: true, //不固定
            shadeClose: false,
            shade: 0.3,
            // maxmin: false, //开启最大化最小化按钮
            area: ['550px', '400px'],
            content: "<?php echo url('Index/ajax_content_total'); ?>"
        });
      });

      // 新增快捷导航
      $('#quickMenuAdd').click(function(){
        //iframe窗
        var iframes = layer.open({
            type: 2,
            title: '快捷导航管理',
            fixed: true, //不固定
            shadeClose: false,
            shade: 0.3,
            // maxmin: false, //开启最大化最小化按钮
            area: ['550px', '400px'],
            content: "<?php echo url('Index/ajax_quickmenu'); ?>"
        });
      });

      // 功能面板 - 更多功能
      // $('.moreFunction').click(function(){
      //   var othis = $('.layadmin-shortcut');
      //   othis.find('div.layui-carousel-ind ul li').each(function(index,element){
      //     if (1 == index) {
      //       var trigger = (device.ios || device.android) ? 'click' : 'mouseover';
      //       $(element).trigger(trigger);
      //     }
      //   });
      // });

      $('#check_authortoken').click(function(){
          var load = layer_loading();
          $.ajax({
              type : "GET",
              url  : $(this).data('url'),
              data : {_ajax:1},
              dataType : "JSON",
              success: function(res) {
                  layer.close(load); //关闭loading
                  if (1 == res.code) {
                      layer.msg(res.msg, {icon: 1, time: 1000}, function(){
                          top.window.location.reload();
                      });
                  }else{
                      showErrorMsg(res.msg);
                  }
              }
              ,error: function(e){
                  layer.close(load); //关闭loading
                  showErrorAlert();
              }
          }); 
      });

      function check_upgrade_version(){
          $.ajax({
              type : "GET",
              url  : "<?php echo url('Ajax/check_upgrade_version'); ?>",
              data : {_ajax:1},
              dataType : "JSON",
              success: function(res) {
                  if (1 == res.code) {
                      if (2 == res.data.code) {
                          $('#upgrade_filelist').html(res.data.msg.upgrade);
                          $('#upgrade_intro').html(res.data.msg.intro);
                          $('#upgrade_notice').html(res.data.msg.notice);
                          $('#a_upgrade').attr('data-version', res.data.msg.key_num)
                          .attr('data-max_version', res.data.msg.max_version)
                          .attr('title', res.data.msg.tips);
                          $('#a_upgrade').html('检测到新版本'+res.data.msg.key_num+'[点击查看]').css('color', '#F00');

                          <?php if(1 == $web_show_popup_upgrade AND (0 >= \think\Session::get('admin_info.role_id') OR 1 == \think\Session::get('admin_info.auth_role_info.online_update'))): ?>
                              btn_upgrade($("#a_upgrade"), 1);
                          <?php endif; ?>
                      } else {
                          $('#td_upgrade_msg').html(res.data.msg);
                      }
                  }
              }
          }); 
      }

      // 自动检测隐藏index.php
      function checkInlet() {
          layer.open({
              type: 2,
              title: false,
              area: ['0px', '0px'],
              shade: 0.0,
              closeBtn: 0,
              shadeClose: true,
              content: '//<?php echo \think\Request::instance()->host(); ?>/api/Rewrite/setInlet.html',
              success: function(layero, index){
                  layer.close(index);
                  var body = layer.getChildFrame('body', index);
                  var content = body.html();
                  if (content.indexOf("Congratulations on passing") == -1)
                  {
                      $.ajax({
                          type : "POST",
                          url  : "/index.php?m=api&c=Rewrite&a=setInlet&_ajax=1",
                          data : {seo_inlet:0},
                          dataType : "JSON",
                          success: function(res) {

                          }
                      }); 
                  }
              }
          });
      }
    });

  </script>

</body>
</html>

