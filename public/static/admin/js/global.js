
//工具栏上的所有的功能按钮和下拉框，可以在new编辑器的实例时选择自己需要的重新定义
window.UEDITOR_HOME_URL = __root_dir__+"/public/plugins/Ueditor/";
var ueditor_toolbars = [[
    'fullscreen', 'source', '|', 'undo', 'redo', '|',
    'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', '|',
    'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
    'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
    'directionalityltr', 'directionalityrtl', 'indent', '|',
    'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
    'link', 'unlink', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
    'simpleupload', 'insertimage', 'emotion', 'insertvideo', 'attachment', 'map', 'insertframe', 'insertcode', '|',
    'horizontal', 'spechars', '|',
    'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
    'preview', 'searchreplace', 'drafts'
]];

var layer_tips; // 全局提示框的对象
var ey_unknown_error = '未知错误，无法继续！';

$(function(){

    try{
        GetUploadInst(); // 上传图片
    }catch(e){
        console.log(e);
    }

    auto_notic_tips();
    /**
     * 自动小提示
     */
    function auto_notic_tips()
    {
        var html = '<i class="layui-icon layui-icon-about helptips" onmouseover="layer_tips = layer.tips($(this).parent().parent().find(\'div.ey_helptips_txt\').html(), this, {time:100000});" onmouseout="layer.close(layer_tips);"></i>';
        $.each($('div.ey_helptips'), function(index, item){
            var txt = $(item).parent().find('div.ey_helptips_txt').html();
            if (txt != '' && undefined != txt) {
                $(item).html(html);
            }
        });
    }
});

/**
 * 批量删除提交
 */
function batch_del(obj, name)
{
    var a = [];
    $('input[name^='+name+']').each(function(i,o){
        if($(o).is(':checked')){
            a.push($(o).val());
        }
    })
    if(a.length == 0){
        showErrorAlert('请至少选择一项');
        return;
    }

    var deltype = $(obj).attr('data-deltype');
    if ('pseudo' == deltype) {
        layer.msg(false, {
            btnAlign: 'c'
            ,time: 0
            ,btn: ['直接删除', '放入回收站', '取消']
            ,yes: function(index, layero){
                batch_del_pseudo(obj, a, 1);
                return false;
            }
            ,btn2: function(index, layero){
                batch_del_pseudo(obj, a, 2);
                return false;
            }
            ,btn3: function(index, layero){
                layer.close(index);
            }
        });
    } else {
        layer.msg(false, {
            btnAlign: 'c'
            ,time: 0
            ,btn: ['直接删除', '取消']
            ,yes: function(index, layero){
                batch_del_pseudo(obj, a, 2);
                return false;
            }
            ,btn2: function(index, layero){
                layer.close(index);
            }
        });
    }
}

/**
 * 批量删除-针对临时存放在回收站的数据
 */
function batch_del_pseudo(obj, a, del_type)
{
    var url = $(obj).attr('data-url');
    if (1 == del_type) {
        layer_loading();
        $.ajax({
            type: "POST",
            url: url,
            data: {del_id:a, thorough:1, _ajax:1},
            dataType: 'json',
            success: function (res) {
                layer.closeAll();
                if(res.code == 1){
                    layer.msg(res.msg, {icon: 1});
                    //window.location.reload();
                    /* 生成静态页面代码 */
                    var slice_start = url.indexOf('m=admin&c=');
                    slice_start = parseInt(slice_start) + 10;
                    var slice_end = url.indexOf('&a=');
                    var ctl_name = url.slice(slice_start,slice_end);
                    $.ajax({
                        url:__root_dir__+"/index.php?m=home&c=Buildhtml&a=upHtml",
                        type:'POST',
                        dataType:'json',
                        data: {del_ids:a,ctl_name:ctl_name,_ajax:1},
                        success:function(data){
                            window.location.reload();
                        },
                        error: function(){
                            window.location.reload();
                        }
                    });
                    /* end */
                }else{
                    showErrorAlert(res.msg);
                }
            },
            error:function(){
                layer.closeAll();
                showErrorAlert();
            }
        });
    } 
    else if (2 == del_type) 
    {
        layer_loading();
        $.ajax({
            type: "POST",
            url: url,
            data: {del_id:a, _ajax:1},
            dataType: 'json',
            success: function (res) {
                layer.closeAll();
                if(res.code == 1){
                    layer.msg(res.msg, {icon: 1});
                    //window.location.reload();
                    /* 生成静态页面代码 */
                    var slice_start = url.indexOf('m=admin&c=');
                    slice_start = parseInt(slice_start) + 10;
                    var slice_end = url.indexOf('&a=');
                    var ctl_name = url.slice(slice_start,slice_end);
                    $.ajax({
                        url:__root_dir__+"/index.php?m=home&c=Buildhtml&a=upHtml",
                        type:'POST',
                        dataType:'json',
                        data: {del_ids:a,ctl_name:ctl_name,_ajax:1},
                        success:function(data){
                            window.location.reload();
                        },
                        error: function(){
                            window.location.reload();
                        }
                    });
                    /* end */
                }else{
                    showErrorAlert(res.msg);
                }
            },
            error:function(){
                layer.closeAll();
                showErrorAlert();
            }
        });
    }
}

/**
 * 单个删除
 */
function delfun(obj) {
    var url = $(obj).attr('data-url');
    var deltype = $(obj).attr('data-deltype');
    if ('pseudo' == deltype) {
        layer.msg(false, {
            btnAlign: 'c'
            ,time: 0
            ,btn: ['直接删除', '放入回收站', '取消']
            ,yes: function(index, layero){
                delfun_pseudo(obj, 1);
                return false;
            }
            ,btn2: function(index, layero){
                delfun_pseudo(obj, 2);
                return false;
            }
            ,btn3: function(index, layero){
                layer.close(index);
            }
        });
    } else {
        layer.msg(false, {
            btnAlign: 'c'
            ,time: 0
            ,btn: ['直接删除', '取消']
            ,yes: function(index, layero){
                delfun_pseudo(obj, 2);
                return false;
            }
            ,btn2: function(index, layero){
                layer.close(index);
            }
        });
    }
}

/**
 * 单个删除 - 执行操作
 */
function delfun_pseudo(obj, del_type) {
    var url = $(obj).attr('data-url');
    if (1 == del_type) {
        // 直接删除
        layer_loading();
        $.ajax({
            type : 'POST',
            url : url,
            data : {del_id:$(obj).attr('data-id'), thorough:1, _ajax:1},
            dataType : 'json',
            success : function(res){
                layer.closeAll();
                if(res.code == 1){
                    layer.msg(res.msg, {icon: 1});

                    /* 生成静态页面代码 */
                    var slice_start = url.indexOf('m=admin&c=');
                    slice_start = parseInt(slice_start) + 10;
                    var slice_end = url.indexOf('&a=');
                    var ctl_name = url.slice(slice_start,slice_end);
                    $.ajax({
                        url:__root_dir__+"/index.php?m=home&c=Buildhtml&a=upHtml",
                        type:'POST',
                        dataType:'json',
                        data: {del_ids:$(obj).attr('data-id'),ctl_name:ctl_name,_ajax:1},
                        success:function(data){
                             window.location.reload();
                        },
                        error: function(){
                            window.location.reload();
                        }
                    });
                    /* end */
                }else{
                    showErrorAlert(res.msg);
                }
            },
            error:function(){
                layer.closeAll();
                showErrorAlert();
            }
        })
    }
    else if (2 == del_type) 
    {
        layer_loading();
        $.ajax({
            type : 'POST',
            url : url,
            data : {del_id:$(obj).attr('data-id'), _ajax:1},
            dataType : 'json',
            success : function(res){
                layer.closeAll();
                if(res.code == 1){
                    layer.msg(res.msg, {icon: 1});
                    //window.location.reload();

                    /* 生成静态页面代码 */
                    var slice_start = url.indexOf('m=admin&c=');
                    slice_start = parseInt(slice_start) + 10;
                    var slice_end = url.indexOf('&a=');
                    var ctl_name = url.slice(slice_start,slice_end);
                    $.ajax({
                        url:__root_dir__+"/index.php?m=home&c=Buildhtml&a=upHtml",
                        type:'POST',
                        dataType:'json',
                        data: {del_ids:$(obj).attr('data-id'),ctl_name:ctl_name,_ajax:1},
                        success:function(data){
                             window.location.reload();
                        },
                        error: function(){
                            window.location.reload();
                        }
                    });
                    /* end */
                }else{
                    showErrorAlert(res.msg);
                }
            },
            error:function(){
                layer.closeAll();
                showErrorAlert();
            }
        })
    }
}

/**
 * 全选
 */
function selectAll(name,obj){
    $('input[name*='+name+']').prop('checked', $(obj).checked);
} 

/**
 * 远程/本地上传图片切换
 */
function clickRemote(obj, id)
{
    if ($(obj).is(':checked')) {
        $('#'+id+'_remote').show();
        $('.div_'+id+'_local').hide();
    } else {
        $('.div_'+id+'_local').show();
        $('#'+id+'_remote').hide();
    }
}

/**
 * 批量移动操作
 */
function batch_move(obj, name) {
    var a = [];
    $('input[name^='+name+']').each(function(i,o){
        if($(o).is(':checked')){
            a.push($(o).val());
        }
    })
    if(a.length == 0){
        showErrorAlert('请至少选择一项');
        return;
    }
    // 删除按钮
    layer.confirm('确认批量移动？', {
        btn: ['确定', '取消'] //按钮
    }, function (index) {
        layer.close(index);
        layer_loading();
        $.ajax({
            type: "POST",
            url: $(obj).attr('data-url'),
            data: {move_id:a, _ajax:1},
            dataType: 'json',
            success: function (data) {
                layer.closeAll();
                if(data.status == 1){
                    layer.msg(data.msg, {icon: 1});
                    window.location.reload();
                }else{
                    layer.alert(data.msg, {icon: 2, title:false});
                }
            },
            error:function(){
                layer.closeAll();
                showErrorAlert();
            }
        });
    }, function (index) {
        layer.closeAll(index);
    });
}

/**
 * 输入为空检查
 * @param name '#id' '.id'  (name模式直接写名称)
 * @param type 类型  0 默认是id或者class方式 1 name='X'模式
 */
function is_empty(name,type){
    if(type == 1){
        if($('input[name="'+name+'"]').val() == ''){
            return true;
        }
    }else{
        if($(name).val() == ''){
            return true;
        }
    }
    return false;
}

/**
 * 邮箱格式判断
 * @param str
 */
function checkEmail(str){
    var reg = /^[a-z0-9]([a-z0-9\\.]*[-_]{0,4}?[a-z0-9-_\\.]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+([\.][\w_-]+){1,5}$/i;
    if(reg.test(str)){
        return true;
    }else{
        return false;
    }
}
/**
 * 手机号码格式判断
 * @param tel
 * @returns {boolean}
 */
function checkMobile(tel) {
    var reg = /(^1[0-9]{10}$)/;
    if (reg.test(tel)) {
        return true;
    }else{
        return false;
    };
}

/*
 * 上传图片 后台专用
 * @access  public
 */
function GetUploadInst()
{
    var result = typeof layui;
    if ('undefined' == result || undefined == result) {
        return false;
    }

    //单图片上传
    layui.use('upload', function(){
        var upload = layui.upload;
        var load;
        //执行实例
        var uploadInst = upload.render({
            elem: '.test-upload-demoMore' //绑定元素
            ,url: eyou_basefile+'?m=admin&c=Ueditor&a=imageUp&_ajax=1' //上传接口
            ,before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
                this.data.savepath = this.ey_savepath;
                load = layer.load(); //上传loading
            }
            ,done: function(res, index, upload){
                layer.close(load); //关闭loading
                var ey_callback = this.ey_callback;
                //如果上传失败
                if(res.state == 'SUCCESS'){
                    if (!ey_callback) {
                        $('#'+this.ey_inputId).val(res.url);
                        $('#img_'+this.ey_inputId).attr('src',res.url);
                        return;
                    } else {
                        eval('window.'+ey_callback+'(res)');
                        return;
                    }
                } else {
                    return layer.msg(res.state, {icon:5, time: 1500});
                }
                //上传成功
            }
            ,error: function(){
                layer.close(load); //关闭loading
                //重载该实例，支持重载全部基础参数
                // uploadInst.reload({
                //     accept: 'images' //只允许上传图片
                //     ,acceptMime: 'image/*' //只筛选图片
                //     ,exts: 'jpg|png|gif|bmp|jpeg|ico'
                //     // ,size: 1024*2 //限定大小
                // });
            }
        });
    });

    //多图片上传
    layui.use('upload', function(){
        var upload = layui.upload;
        //执行实例
        var uploadInst = upload.render({
            elem: '.multi-upload-demoMore' //绑定元素
            ,acceptMime:'image/*'
            ,multiple:true
            ,auto: false
            ,url: eyou_basefile+'?m=admin&c=Ueditor&a=imageUp&_ajax=1' //上传接口
            ,choose:function (obj) {        //判断文件是否满足上传条件
                if (this.ey_callbefore){
                    if (!eval('window.'+this.ey_callbefore)){
                        return false;
                    }
                }
                obj.preview(function(index, file, result){
                    obj.upload(index, file); //对上传失败的单个文件重新上传，一般在某个事件中使用
                });
            }
            ,before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
                this.data.savepath = this.ey_savepath;
                layer.load(); //上传loading
            }
            ,done: function(res, index, upload){
                layer.closeAll('loading'); //关闭loading
                var ey_callback = this.ey_callback;
                //如果上传失败
                if(res.state == 'SUCCESS'){
                    if (!ey_callback) {
                        $('#'+this.ey_inputId).val(res.url);
                        return;
                    } else {
                        eval('window.'+ey_callback+'(res)');
                        return;
                    }
                } else {
                    return layer.msg(res.state, {icon:2, time: 1500});
                }
                //上传成功
            }
            ,error: function(){
                layer.closeAll('loading'); //关闭loading
            }
        });
    });
}

/*
 * 图库 后台专用
 * @access  public
 * @num int 一次上传图片张图
 * @inputId string 上传成功后返回路径插入指定ID元素内
 * @path  string 指定上传保存文件夹,默认存在public/upload/temp/目录
 * @callback string  回调函数(单张图片返回保存路径字符串，多张则为路径数组 )
 */
var layer_GetPictureFolder;
function GetPictureFolder(num,inputId,callback)
{
    if (layer_GetPictureFolder){
        layer.close(layer_GetPictureFolder);
    }

    if (!callback) {
        callback = '';
    }

    var width = '85%';
    var height = '85%';

    var upurl = eyou_basefile+'?m=admin&c=Uploadify&a=picture_folder&num='+num+'&inputId='+inputId+'&func='+callback;
    layer_GetPictureFolder = layer.open({
        type: 2,
        title: '图库管理',
        shadeClose: false,
        shade: 0.3,
        maxmin: true, //开启最大化最小化按钮
        area: [width, height],
        content: upurl
    });
}
/*
 * 图库 后台专用(存在前置判断)
 * @access  public
 * @num int 一次上传图片张图
 * @inputId string 上传成功后返回路径插入指定ID元素内
 * @path  string 指定上传保存文件夹,默认存在public/upload/temp/目录
 * @callback string  回调函数(单张图片返回保存路径字符串，多张则为路径数组 )
 */
function GetBeforePictureFolder(num,inputId,callback,callbeofre)
{
    if (layer_GetPictureFolder){
        layer.close(layer_GetPictureFolder);
    }
    if (callbeofre){
        if (!eval('window.'+callbeofre)){
            return false;
        }
    }
    if (!callback) {
        callback = '';
    }
    var width = '85%';
    var height = '85%';

    var upurl = eyou_basefile+'?m=admin&c=Uploadify&a=picture_folder&num='+num+'&inputId='+inputId+'&func='+callback;
    layer_GetPictureFolder = layer.open({
        type: 2,
        title: '图库管理',
        shadeClose: false,
        shade: 0.3,
        maxmin: true, //开启最大化最小化按钮
        area: [width, height],
        content: upurl
    });
}
/*
 * 上传图片 在弹出窗里的上传图片
 * @access  public
 * @null int 一次上传图片张图
 * @elementid string 上传成功后返回路径插入指定ID元素内
 * @path  string 指定上传保存文件夹,默认存在public/upload/temp/目录
 * @callback string  回调函数(单张图片返回保存路径字符串，多张则为路径数组 )
 */
var layer_GetUploadifyFrame;
function GetUploadifyFrame(num,elementid,path,callback,url)
{
    if (layer_GetUploadifyFrame){
        layer.close(layer_GetUploadifyFrame);
    } 
    if (num > 0) {
        if (url.indexOf('?') > -1) {
            url += '&';
        } else {
            url += '?';
        }

        var upurl = url + 'num='+num+'&input='+elementid+'&path='+path+'&func='+callback;
        layer_GetUploadifyFrame = layer.open({
            type: 2,
            title: '上传图片',
            shadeClose: false,
            shade: 0.3,
            maxmin: true, //开启最大化最小化按钮
            area: ['85%', '85%'],
            content: upurl
         });
    } else {
        layer.alert('允许上传0张图片', {icon:2, title:false});
        return false;
    }
}
    
// 获取活动剩余天数 小时 分钟
//倒计时js代码精确到时分秒，使用方法：注意 var EndTime= new Date('2013/05/1 10:00:00'); //截止时间 这一句，特别是 '2013/05/1 10:00:00' 这个js日期格式一定要注意，否则在IE6、7下工作计算不正确哦。
//js代码如下：
function GetRTime(end_time){
      // var EndTime= new Date('2016/05/1 10:00:00'); //截止时间 前端路上 http://www.51xuediannao.com/qd63/
       var EndTime= new Date(end_time); //截止时间 前端路上 http://www.51xuediannao.com/qd63/
       var NowTime = new Date();
       var t =EndTime.getTime() - NowTime.getTime();
       /*var d=Math.floor(t/1000/60/60/24);
       t-=d*(1000*60*60*24);
       var h=Math.floor(t/1000/60/60);
       t-=h*60*60*1000;
       var m=Math.floor(t/1000/60);
       t-=m*60*1000;
       var s=Math.floor(t/1000);*/

       var d=Math.floor(t/1000/60/60/24);
       var h=Math.floor(t/1000/60/60%24);
       var m=Math.floor(t/1000/60%60);
       var s=Math.floor(t/1000%60);
       if(s >= 0)   
       return d + '天' + h + '小时' + m + '分' +s+'秒';
   }
   
/**
 * 获取多级联动
 */
function get_select_options(t,next){
    var parent_id = $(t).val();
    var url = $(t).attr('data-url');
    if(!parent_id > 0 || url == ''){
        return;
    }
    url = url + '?pid='+ parent_id;
    $.ajax({
        type : "GET",
        url  : url,
        data : {_ajax:1},
        error: function(request) {
            showErrorAlert();
            return;
        },
        success: function(v) {
            $('#'+next).html(v);
        }
    });
}

// 读取 cookie
function getCookie(c_name)
{
    if (document.cookie.length>0)
    {
      c_start = document.cookie.indexOf(c_name + "=")
      if (c_start!=-1)
      { 
        c_start=c_start + c_name.length+1 
        c_end=document.cookie.indexOf(";",c_start)
        if (c_end==-1) c_end=document.cookie.length
            return unescape(document.cookie.substring(c_start,c_end))
      } 
    }
    return "";
}

function setCookies(name, value, time)
{
    var cookieString = name + "=" + escape(value) + ";";
    if (time != 0) {
        var Times = new Date();
        Times.setTime(Times.getTime() + time);
        cookieString += "expires="+Times.toGMTString()+";"
    }
    document.cookie = cookieString+"path=/";
}
function delCookie(name){
    var exp=new Date();
    exp.setTime(exp.getTime()-1);
    var cval=getCookie(name);
    if(cval!=null){
        document.cookie=name+"="+cval+";expires="+exp.toGMTString() +"path=/";
    }
}

function layConfirm(msg , callback){
    layer.confirm(msg, {
          btn: ['确定','取消'] //按钮
        }, function(){
            callback();
            layer.closeAll();
        }, function(index){
            layer.close(index);
            return false;// 取消
        }
    );
}

function isMobile(){
    return "yes";
}

// 判断是否手机浏览器
function isMobileBrowser()
{
    var sUserAgent = navigator.userAgent.toLowerCase();    
    var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";    
    var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";    
    var bIsMidp = sUserAgent.match(/midp/i) == "midp";    
    var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";    
    var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";    
    var bIsAndroid = sUserAgent.match(/android/i) == "android";    
    var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";    
    var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";    
    if (bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM ){    
        return true;
    }else 
        return false;
}

function getCookieByName(name) {
    var start = document.cookie.indexOf(name + "=");
    var len = start + name.length + 1;
    if ((!start) && (name != document.cookie.substring(0, name.length))) {
        return null;
    }
    if (start == -1)
        return null;
    var end = document.cookie.indexOf(';', len);
    if (end == -1)
        end = document.cookie.length;
    return unescape(document.cookie.substring(len, end));
}
function showErrorMsg(msg){
    if (!msg || undefined == msg) {
        msg = '未知错误，操作中断！';
    }
    layer.msg(msg, {icon: 5,time: 2000});
}
function showErrorAlert(msg){
    if (!msg || undefined == msg) {
        msg = '未知错误，操作中断！';
    }
    layer.alert(msg, {icon: 5, title: false, closeBtn: false});
}
//关闭页面
function CloseWebPage(){
    if (navigator.userAgent.indexOf("MSIE") > 0) {
        if (navigator.userAgent.indexOf("MSIE 6.0") > 0) {
            window.opener = null;
            window.close();
        } else {
            window.open('', '_top');
            window.top.close();
        }
    }
    else if (navigator.userAgent.indexOf("Firefox") > -1 || navigator.userAgent.indexOf("Chrome") > -1) {
        window.location.href = 'about:blank';
    } else {
        window.opener = null;
        window.open('', '_self', '');
        window.close();
    }
}
function getHsonLength(json){
    var jsonLength=0;
    for (var i in json) {
        jsonLength++;
    }
    return jsonLength;
}

// post提交之前，切换编辑器从【源代码】到【设计】视图
function ueditorHandle()
{
    try {
        var funcStr = "";
        $('textarea[class*="ckeditor"]').each(function(index, item){
            var func = $(item).data('func');
            if (undefined != func && func) {
                funcStr += func+"();";
            }
        });
        eval(funcStr);
    }catch(e){}
}

/**
 * 封装的加载层
 */
function layer_loading(msg){
    ueditorHandle(); // post提交之前，切换编辑器从【源代码】到【设计】视图

    if (!msg || undefined == msg) {
        //loading层
        var loading = layer.load(3, {
            shade: [0.1] //0.1透明度的白色背景
        });
    } else {
        var loading = layer.msg(
        msg+'...&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;请勿刷新页面', 
        {
            icon: 1,
            time: 3600000, //1小时后后自动关闭
            shade: [0.2] //0.1透明度的白色背景
        });
        //loading层
        var index = layer.load(3, {
            shade: [0.1,'#fff'] //0.1透明度的白色背景
        });
    }

    return loading;
}

/**
 * 父窗口 - 封装的加载层
 */
function parent_layer_loading(msg){
    if (!msg || undefined == msg) {
        //loading层
        var loading = parent.layer.load(3, {
            shade: [0.1] //0.1透明度的白色背景
        });
    } else {
        var loading = parent.layer.msg(
        msg+'...&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;请勿刷新页面', 
        {
            icon: 1,
            time: 3600000, //1小时后后自动关闭
            shade: [0.2] //0.1透明度的白色背景
        });
        //loading层
        var index = parent.layer.load(3, {
            shade: [0.1,'#fff'] //0.1透明度的白色背景
        });
    }

    return loading;
}

function tipsText(){  
    $('.ey-text').each(function(){  
        var _this = $(this);  
        var elm = _this.find('.ey-input');  
        var txtElm = _this.find('.ey-textTips');  
        var maxNum = _this.find('.ey-input').attr('data-num') || 500;  
        // console.log($.support.leadingWhitespace);
        changeNum(elm,txtElm,maxNum,_this);
        if(!$.support.leadingWhitespace){  
            _this.find('textarea').on('propertychange',function(){  
                changeNum(elm,txtElm,maxNum,_this);  
            });  
            _this.find('input').on('propertychange',function(){  
                changeNum(elm,txtElm,maxNum,_this);  
            });  
        } else {
            _this.on('input',function(){  
                changeNum(elm,txtElm,maxNum,_this);  
            });  
        }  
    });  
}  
  
//获取文字输出字数，可以遍历使用  
//txtElm动态改变的dom，maxNum获取data-num值默认为120个字，ps数字为最大字数*2  
function changeNum(elm,txtElm,maxNum,_this) {  
    //汉字的个数  
    //var str = (elm.val().replace(/\w/g, "")).length;  
    //非汉字的个数  
    //var abcnum = elm.val().length - str;  
    var bigtxtElm = _this.find('.ey-big-text');
    total = elm.val().length;  
    if(total <= maxNum ){  
        texts = maxNum - total;  
        txtElm.html('还可以输入<em>'+texts+'</em>个字符');  
        if (bigtxtElm) {
            bigtxtElm.hide();
        }
    }else{  
        texts = total - maxNum ;  
        txtElm.html('已超出<font color="red">'+texts+'</font>个字符');
        if (bigtxtElm) {
            bigtxtElm.show();
        }
    }  
    return ;  
} 

// 修改指定表的指定字段值 包括有按钮点击切换是否 或者 排序 或者输入框文字
function changeTableVal(table,id_name,id_value,field,obj)
{
    if('on' == obj.value) // 图片点击是否操作
    {
        obj.value = 'off';
        var value = 1;
        try {  
            if ($(obj).attr('data-value')) {
                value = $(obj).attr('data-value');
                if ('weapp' == table && 'status' == field) {
                    $(obj).attr('data-value', -1); // 插件的禁用
                }
            }
        } catch(e) {  
            // 出现异常以后执行的代码  
            // e:exception，用来捕获异常的信息  
        } 
            
    }else if('off' == obj.value){ // 图片点击是否操作                     
        obj.value = 'on';
        var value = 0;
        try {  
            if ($(obj).attr('data-value')) {
                value = $(obj).attr('data-value');
                $(obj).attr('data-value', 1); // 插件的启用
            }
        } catch(e) {  
            // 出现异常以后执行的代码  
            // e:exception，用来捕获异常的信息  
        } 
    }else{ // 其他输入框操作
        var value = $(obj).val();            
    }

    var url = eyou_basefile + "?m="+module_name+"&c=Index&a=changeTableVal&_ajax=1";

    $.ajax({
        type: 'POST',
        url: url,
        data: {table:table,id_name:id_name,id_value:id_value,field:field,value:value},
        dataType: 'json',
        success: function(res){
            if (res.code == 1) {
                if('switch' != $(obj).attr('lay-skin')){
                    layer.msg(res.msg, {icon: 1});
                }
                if (1 == res.data.refresh) {
                    window.location.reload();
                }
            } else {
                layer.msg(res.msg, {icon: 5}, function(){
                    window.location.reload();
                });  
            }
        }
    }); 
}

function gourl(url)
{
    window.location.href = url;
}

// 查看大图
function BigImages(imgpath){
    var max_width = 650;
    var max_height = 350;
    var img = "<img src='"+imgpath+"'/>";
    $(img).load(function() {
        width  = this.width;
        height = this.height;
        if (width > height) {
            if (width > max_width) {
                width = max_width;
            }
            width += 'px';
        } else {
            width = 'auto';
        }
        if (width < height) {
            if (height > max_height) {
                height = max_height;
            }
            height += 'px';
        } else {
            height = 'auto';
        }

        var content = "<img style='width:"+width+";height:"+height+";' src="+imgpath+">";

        layer.open({
            type: 1,
            title: false,
            closeBtn: true,
            shadeClose:true,
            area: [width, height],
            skin: 'layui-layer-nobg', //没有背景色
            content: content
        });
    });
}

// 清空上传缩略图的图片显示
function DelImages(obj)
{
    var inputid = $(obj).data('inputid');
    try{
        $("#"+inputid).val('');
        $("input[name='"+inputid+"']").val('');
    }catch(e){
        console.log(e);
    }
    $('#img_'+inputid).attr('src', __root_dir__+'/public/static/common/images/not_adv.jpg');
}
//关闭当前弹框
function close_this(){
    var index=parent.layer.getFrameIndex(window.name); //获取当前窗口的name
    parent.layer.close(index);
}

/**
 * 格式化数字
 * @param num 数字
 * @param ext 保留多少位小数
 * @returns {*}
 */
function number_format(num, ext){
    if(ext < 0){
        return num;
    }
    num = Number(num);
    if(isNaN(num)){
        num = 0;
    }
    var _str = num.toString();
    var _arr = _str.split('.');
    var _int = _arr[0];
    var _flt = _arr[1];
    if(_str.indexOf('.') == -1){
        /* 找不到小数点，则添加 */
        if(ext == 0){
            return _str;
        }
        var _tmp = '';
        for(var i = 0; i < ext; i++){
            _tmp += '0';
        }
        _str = _str + '.' + _tmp;
    }else{
        if(_flt.length == ext){
            return _str;
        }
        /* 找得到小数点，则截取 */
        if(_flt.length > ext){
            _str = _str.substr(0, _str.length - (_flt.length - ext));
            if(ext == 0){
                _str = _int;
            }
        }else{
            for(var i = 0; i < ext - _flt.length; i++){
                _str += '0';
            }
        }
    }

    return _str;
}

// 百度自动推送
function push_zzbaidu(url, type)
{
    $.ajax({
        url:__root_dir__+"/index.php?m=admin&c=Ajax&a=push_zzbaidu",
        type:'POST',
        dataType:'json',
        data:{"url":url,"type":type,"_ajax":1},
        success:function(res){
            console.log(res.msg);
        },
        error: function(e){
            console.log(e);
        }
    });
}

// 更新sitemap.xml地图
function update_sitemap(controller, action)
{
    $.ajax({
        url:__root_dir__+"/index.php?m=admin&c=Ajax&a=update_sitemap",
        type:'POST',
        dataType:'json',
        data:{"controller":controller,"action":action,"_ajax":1},
        success:function(res){
            console.log(res.msg);
        },
        error: function(e){
            console.log(e);
        }
    });
}