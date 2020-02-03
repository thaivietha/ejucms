<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:44:"./application/admin/template/tools\index.htm";i:1580691229;s:77:"D:\ejucms\EjuCMS-V1.3.0-UTF8-SP4\application\admin\template\public\layout.htm";i:1580691229;s:77:"D:\ejucms\EjuCMS-V1.3.0-UTF8-SP4\application\admin\template\public\footer.htm";i:1580691229;}*/ ?>
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
  <div class="layui-fluid" id="LAY-component-layer-list">
    <div class="layui-row">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="web-system">
            <div class="layui-tab layui-tab-card">
              <ul class="layui-tab-title">
                  <?php if(is_check_access('Tools@index') == '1'): ?>
                  <li class="layui-this"><a href="<?php echo url('Tools/index'); ?>">数据备份</a></li>
                  <?php endif; if(is_check_access('Tools@restore') == '1'): ?>
                  <li><a href="<?php echo url('Tools/restore'); ?>">数据还原</a></li>
                  <?php endif; ?>
              </ul>
              <div class="layui-tab-content web-system" style="padding:10px 0">
                <div class="layui-tab-item layui-show">
                  <div class="layui-row layui-col-space15">
                    <div class="layui-col-md12">
                      <div class="layui-card">
                        <div class="layui-card-body" pad15>
                          <div class="layui-form layui-border-box layui-table-view house-table" lay-filter="formTest" lay-id="admin-arctype" >
                            <div class="layui-table-box">
                              <div class="layui-table-body " id="export-form">
                                <table cellspacing="0" cellpadding="0" border="0" class="layui-table layui-form" style="width: 100%" lay-skin="line">
                                  <thead >
                                    <tr>
                                      <th class="w40 tc"> 
                                        <div class="layui-table-cell w40 tc laytable-cell-checkbox">
                                          <input type="checkbox" lay-filter="checkAll" class="checkAll" lay-skin="primary" checked>
                                          <div class="layui-unselect layui-form-checkbox" lay-skin="primary"> <i class="layui-icon layui-icon-ok"></i></div>
                                        </div>
                                      </th>
                                      <th> 
                                        <div class="layui-table-cell wauto"><span>数据表</span></div>
                                      </th>
                                      <th class="w100 tc"> 
                                        <div class="layui-table-cell w100 tc"><span>记录条数</span></div>
                                      </th>
                                      <th class="w100 tc"> 
                                        <div class="layui-table-cell w100 tc"><span>占用空间</span></div>
                                      </th>
                                      <th class="w140 tc"> 
                                        <div class="layui-table-cell w140 tc"><span>编码</span></div>
                                      </th>
                                      <th class="w180 tc"> 
                                        <div class="layui-table-cell w180 tc"><span>创建时间</span></div>
                                      </th>
                                      <th class="w120 tc"> 
                                        <div class="layui-table-cell w120 tc"><span>备份状态</span></div>
                                      </th>
                                      <th class="w150 tc"> 
                                        <div class="layui-table-cell w150 tc"><span>操作</span></div>
                                      </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                  <?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?>
                                    <tr>
                                      <td colspan="8" class="no-data tc">
                                         没有符合条件的数据
                                      </td>
                                    </tr>
                                  <?php else: if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $k=>$vo): ?>
                                     <tr data-id="<?php echo $vo['Name']; ?>">
                                        <td>
                                           <div class="layui-table-cell w40 tc laytable-cell-checkbox">
                                              <input type="checkbox" name="tables[]" lay-filter="tables" lay-skin="primary" value="<?php echo $vo['Name']; ?>" checked>
                                           </div>
                                        </td>
                                        <td>
                                            <div class="layui-table-cell wauto">
                                                <?php echo $vo['Name']; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="layui-table-cell w100 tc">
                                                <?php echo $vo['Rows']; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="layui-table-cell w100 tc">
                                                <?php echo format_bytes($vo['Data_length']); ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="layui-table-cell w140 tc">
                                                <?php echo $vo['Collation']; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="layui-table-cell w180 tc">
                                                <?php echo $vo['Create_time']; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="layui-table-cell info_txt w120 tc">
                                                未备份
                                            </div>
                                        </td>
                                        <td>
                                           <div class="layui-table-cell w150 tc right-oper"> 
                                            <?php if(is_check_access(CONTROLLER_NAME.'@optimize') == '1'): ?>
                                                <a class="layui-btn btn-primary" href="javascript:void(0);" data-url="<?php echo url('Tools/optimize',array('tablename'=>$vo['Name'])); ?>" data-type="optimize">优化</a>
                                            <?php endif; if(is_check_access(CONTROLLER_NAME.'@repair') == '1'): ?>
                                                <a class="layui-btn btn-primary" href="javascript:void(0);" data-url="<?php echo url('Tools/repair',array('tablename'=>$vo['Name'])); ?>" data-type="repair">修复</a>
                                            <?php endif; ?>
                                           </div>
                                        </td>
                                      </tr>
                                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                            <div class="layui-table-page footer-oper">
                                <input type="checkbox" lay-filter="checkAll" class="checkAll" checked lay-skin="primary" >
                                <?php if(is_check_access('Tools@export') == '1'): ?>
                                <a class="layui-btn" data-type="export"><span>开始备份</span></a>
                                <?php endif; ?>
                            </div>
                            <div class="layui-table-page">
                              <ul class="pagination">
                                <span class="rows">共 <?php echo $tableNum; ?> 条数据表，共计 <?php echo $total; ?></span>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
     </div>
  </div>

  <script>
  layui.config({
    base: '/public/static/admin/' //静态资源所在路径
    ,version: '<?php echo $version; ?>'
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index', 'form'], function(){
    var $ = layui.$
    ,form = layui.form;

    // 监听复选框全选
    form.on('checkbox(checkAll)', function(data){
        if (data.elem.checked) {
            $('.checkAll').attr('checked', true);
            $('input[name*=tables]').attr('checked', true);
        } else {
            $('.checkAll').attr('checked', false);
            $('input[name*=tables]').attr('checked', false);
        }
        form.render('checkbox');
    });

    // 监听每行复选框
    form.on('checkbox(tables)', function(data){
        if (data.elem.checked && $('input[name*=tables]:checked').length == $('input[name*=tables]').length) {
            $('.checkAll').attr('checked', true);
        } else {
            $('.checkAll').attr('checked', false);
        }
        form.render('checkbox');
    });

    /* 触发事件 */
    var active = {
        optimize: function(){
            var obj = this;
            var load = layer_loading();
            $.ajax({
                type: "POST",
                url: $(obj).attr('data-url'),
                data: {_ajax:1},
                dataType: 'json',
                success: function (res) {
                    layer.close(load);
                    if(res.code == 1){
                        layer.msg(res.msg, {icon: 1, time:1000}, function(){
                            window.location.href = res.url;
                        });
                    }else{
                        showErrorMsg(res.msg);
                    }
                },
                error:function(){
                    layer.close(load);
                    showErrorAlert();
                }
            });
            return false;
        }
        // 修复
        ,repair: function(){
            var obj = this;
            var load = layer_loading();
            $.ajax({
                type: "POST",
                url: $(obj).attr('data-url'),
                data: {_ajax:1},
                dataType: 'json',
                success: function (res) {
                    layer.close(load);
                    if(res.code == 1){
                        layer.msg(res.msg, {icon: 1, time:1000}, function(){
                            window.location.href = res.url;
                        });
                    }else{
                        showErrorMsg(res.msg);
                    }
                },
                error:function(){
                    layer.close(load);
                    showErrorAlert();
                }
            });
            return false;
        }
        // 备份
        ,export: function(){
            var tables = [];
            $('input[name^=tables]').each(function(i,o){
                if($(o).is(':checked')){
                    tables.push($(o).val());
                }
            })
            if(tables.length == 0){
                showErrorAlert('请选中要备份的数据表！');
                return;
            }

            $export = $(this);
            var disabled = $export.attr('data-disabled');
            if (1 == disabled) {
                return false;
            }
            $export.addClass("layui-disabled").attr('data-disabled', 1);
            $export.find('span').html("正在发送备份请求...");
            $.post(
                "<?php echo url('Tools/export', ['_ajax'=>1]); ?>",
                {tables:tables},
                function(res){
                    if(res.status){
                        tables = res.tables;
                        var loading = layer.msg('正在备份表(<font id="upgrade_backup_table">'+res.tab.table+'</font>)……<font id="upgrade_backup_speed">0.01</font>%', 
                        {
                            icon: 1,
                            time: 3600000, //1小时后后自动关闭
                            shade: [0.2] //0.1透明度的白色背景
                        });
                        $export.find('span').html(res.info);
                        backup(res.tab);
                        window.onbeforeunload = function(){ return "正在备份数据库，请不要关闭！" }
                    } else {
                        showErrorAlert(res.info);
                        $export.removeClass("layui-disabled").attr('data-disabled', 0);
                        $export.find('span').html("立即备份");
                    }
                },
                "json"
            );
            return false;

            function backup(tab, status){
                status && showmsg(tab.id, "开始备份……(0%)");
                $.post("<?php echo url('Tools/export', ['_ajax'=>1]); ?>", tab, function(data){
                    if(data.status){
                        if (tab.table) {
                            showmsg(tab.id, data.info);
                            $('#upgrade_backup_table').html(tab.table);
                            $('#upgrade_backup_speed').html(tab.speed);
                            $export.find('span').html('正在备份……'+tab.speed+'%');
                        } else {
                            $export.find('span').html('进入备份……');
                        }
                        if(!$.isPlainObject(data.tab)){
                            var loading = layer.msg('备份完成……100%，请不要关闭本页面！', 
                            {
                                icon: 1,
                                time: 2000, //1小时后后自动关闭
                                shade: [0.2] //0.1透明度的白色背景
                            });
                            $export.removeClass("layui-disabled").attr('data-disabled', 0);
                            $export.find('span').html("开始备份");
                            setTimeout(function(){
                                layer.closeAll();
                                layer.alert('备份成功！', {icon: 1, title:false});
                            }, 1000);
                            window.onbeforeunload = function(){ return null }
                            return;
                        }
                        backup(data.tab, tab.id != data.tab.id);
                    } else {
                        layer.closeAll();
                        $export.removeClass("layui-disabled").attr('data-disabled', 0);
                        $export.find('span').html("立即备份");
                    }
                }, "json");
            }

            function showmsg(id, msg){
                $("#export-form").find("input[value=" + tables[id] + "]").closest("tr").find(".info_txt").html(msg);
            }
        }
    };

    $('.layui-btn').on('click', function(){
      var type = $(this).data('type');
      active[type] && active[type].call(this);
    });

  });

  </script>

</body>
</html>