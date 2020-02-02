function EditAnswer(obj, answer_id) {
    var url = $(obj).attr('data-url');
    if (url.indexOf('?') > -1) {
        url += '&';
    } else {
        url += '?';
    }
    url += 'answer_id=' + answer_id;
    window.location.href = url;
    return false;
}

// 点赞
function ClickLike(obj, ask_id, answer_id) {
    if ($(obj).attr('data-is_like')) {
        layer.msg('您已赞过！', {time: 1500});
        return false;
    }
    $.ajax({
        url: $(obj).data('url'),
        type: 'POST',
        dataType: 'json',
        data: {ask_id:ask_id,answer_id:answer_id},
        success: function(res) {
            if (1 == res.code) {
                if (3 < res.data.LikeCount) {
                    $('#click_like_span_'+answer_id).children().eq(2).remove();
                }
                // 追加点赞人
                $("#click_like_name_"+answer_id).prepend(res.data.LikeName);
                // 点赞次数
                $('#click_like_'+answer_id).html(res.data.LikeCount);
                // 显示点赞框
                $('#is_show_'+answer_id).show();
                $('#askanswer_click_like_'+answer_id).html(res.data.LikeCount);
            } else {
                layer.msg(res.msg, {time: 1500});
            }
            // 设置当前用户已点赞过，用户再次点击则不需要执行ajax
            $(obj).attr('data-is_like', true);
        }
    });
}

function DataDel(obj, id, type) {
    if(id <= 0){
        var msg = "没有选择正确信息";
    }else if(type == 1){
        var msg = "你确定要删除该提问?";
    }else if(type == 2){
        // 删除评论回复
        ReplyDel($(obj).data('url'), id); return false;
    }else if(type == 3){
        var msg = "你确定要删除该回答?";
    }

    layer.confirm(msg, {
        btn: ['确认', '取消'],
        title: false,
        closeBtn: 0
    }, function () {
        $.ajax({
            url: $(obj).data('url'),
            data: {id:id, type:type},
            type:'post',
            dataType:'json',
            success:function(res){
                if ('1' == res.code) {
                    layer.msg(res.msg, {time: 1500});
                    if (3 == type) {
                        $('#ul_div_li_'+id).remove();
                    }else if (1 == type) {
                        layer.msg(res.msg, {time: 1000},function(){
                            window.location.href = res.url;
                        });
                    }
                    layer.closeAll();
                }else{
                    layer.msg(res.msg, {time: 2000});
                }
            }
        });
    });
}


// 删除回复
function ReplyDel(url, answer_id) {
    if (!answer_id) layer.msg('请选择删除信息！', {time: 1500});
    $.ajax({
        url:  url,
        type: 'POST',
        dataType: 'json',
        data: {answer_id:answer_id},
        success: function(res){
            if (1 == res.code) {
                $('#'+answer_id+'_answer_li').remove();
            } else {
                layer.msg(res.msg, {time: 1500});
            }
        },
        error: function(e){
            layer.msg('删除失败~~', {time: 1500});
        }
    });
}

/**
 * 回复
 * @param state
 * @return
 */
function replyUser(answer_id, at_users_id, at_username, at_answer_id){
    $("#"+answer_id+"_at_users_id").val(at_users_id);
    $("#"+answer_id+"_at_answer_id").val(at_answer_id);

    var showObj = $("#"+answer_id+"_contentInput");
    var inputObj = $("#"+answer_id+"_i_contentInput");
    showObj.attr("placeholder","回复 "+at_username+ "：");
    inputObj.attr("placeholder","回复 "+at_username+ "：");
    inputObj.val("");
    showObj.val("");

    var showContainer =  $("#"+answer_id+"_init_ta");
    showContainer.hide();
    var inputContainer = $("#"+answer_id+"_ta").val("");
    inputContainer.show();
    inputObj.focus();
    
}


/**
 * 取消回复
 * @param state
 * @return
 */
function unReplyUser(answer_id){
    $("#"+answer_id+"_at_users_id").val("");
    $("#"+answer_id+"_at_answer_id").val("");

    var showObj = $("#"+answer_id+"_contentInput");
    var inputObj = $("#"+answer_id+"_i_contentInput");
    showObj.attr("placeholder",showObj.attr("defTips"));
    inputObj.attr("placeholder",inputObj.attr("defTips"));
    inputObj.val("");
    showObj.val("");

    $("#"+answer_id+"_init_ta").show();
    $("#"+answer_id+"_ta").val("").hide();
}

function initReply(cid){
    $("#"+cid+"_init_ta").hide();
    $("#"+cid+"_ta").val("").show();
    $("#"+cid+"_ta #"+cid+"_i_contentInput").focus();//设置光标位置
    $("#"+cid+"_ta #"+cid+"_errorMsg").html("");//隐藏回复错误提示
}

function focusTextArea(obj){
    _obj = $(obj);
    if(_obj.val()==_obj.attr("defTips")){
        _obj.val("");
        //$("#numSpan").html(0);
    }
}

function blurTextArea(obj){
    _obj = $(obj);
    if(_obj.val()=='')
        _obj.attr("placeholder",_obj.attr("defTips"));
    else
        dealInputContentAndSize(obj);
}

/**
 * 对输入框限制的内容与字数处理
 * @param obj
 * @return
 */
function dealInputContentAndSize(obj){
    var _obj = $(obj);
    //str = trim(_obj.val());
    str = _obj.val();
    var maxLength=_obj.attr("maxlength");
    
    var returnValue = ''; 
    var count = 0; 
    var temp = 0;
    for (var i = 0; i < str.length; i++) { 
//      if (str[i].match(/[^\x00-\xff]/ig) != null) {
//          count += 2; 
//          temp = 2;
//      }else {
            count += 1; 
            temp = 1;
//      }
        if (count > maxLength) {
            count -= temp;
            break; 
        }
        returnValue += str[i]; 
    } 
    _obj.val(returnValue);
    //$("#numSpan").html(count);
}

/**
 * 回答问题
 * @param state
 * @return
 */
function answer_submit(obj){
    if (!$('textarea[name="ask_content"]').val()) {
        layer.msg('请写下你的回答！', {time: 1500, icon: 2});
        return false;
    }

    layer_loading('正在处理');
    $.ajax({
        url: $(obj).data('url'),
        data: $('#commentForm').serialize(),
        type:'post',
        dataType:'json',
        success:function(res){
            layer.closeAll();
            if (1 == res.code) {
                if (res.data.review) {
                    var times = 2500;
                }else{
                    var times = 1000;
                }
                layer.msg(res.msg, {time: times},function(){
                    window.location.reload();
                });
            } else {
                layer.msg(res.msg, {time: 1500, icon: 2});
            }
        },
        error : function() {
            layer.closeAll();
            layer.alert('网络失败，请刷新页面后重试', {icon: 5, closeBtn: 0});
        }
    });
}

/**
 * 评论
 * @param state
 * @return
 */
function reply(answer_id, obj){
    if($('#'+answer_id+'_i_contentInput').val()== '' || $('#'+answer_id+'_i_contentInput').val() == '写下你的评论'){
        $("#"+answer_id+"_errorMsg").text('请输入评论');
        //输入框内容改变时,清空错误提示
        $('#'+answer_id+'_i_contentInput').bind('input propertychange',function() {
            $("#"+answer_id+"_errorMsg").html("");
        })
        return;
    }

    //提交服务器
    layer_loading('正在处理');
    $.ajax({
        url: $(obj).data('url'),
        type: 'post',
        dataType: 'json',
        data: $('#'+answer_id+'_replyForm').serialize(),
        success: function(res){
            layer.closeAll();
            if (1 == res.code) {
                /*提示及追加html处理*/
                var times = res.data.review ? 2000 : 1000;
                if (res.data.htmlcode) $("#"+answer_id+"_ReplyContainer").append(res.data.htmlcode);
                unReplyUser(answer_id);
                layer.msg(res.msg, {time: times});
                /* END */
            } else {
                layer.msg(res.msg, {time: 1500, icon: 2});
            }
        },
        error : function() {
            layer.closeAll();
            layer.alert('网络失败，请刷新页面后重试', {icon: 5});
        }
    });
    
}

function BestAnswer(obj, answer_id, users_id) {
    if (!answer_id) layer.msg('请选择采纳的回答！', {time: 1500, icon: 2});
    //提交服务器
    layer_loading('正在处理');
    $.ajax({
        url: $(obj).data('url'),
        type: 'post',
        dataType: 'json',
        data: {answer_id:answer_id,users_id:users_id},
        success: function(res){
            layer.closeAll();
            if (1 == res.code) {
                layer.msg(res.msg, {time: 1000},function(){
                    window.location.reload();
                });
            } else {
                layer.msg(res.msg, {time: 1500, icon: 2});
            }
        },
        error : function() {
            layer.closeAll();
            layer.alert('网络失败，请刷新页面后重试', {icon: 5});
        }
    });
}

function ReviewAsk(obj, ask_id) {
    layer.confirm('确认审核该问题？', {
        btn: ['确认', '取消'],
        title: false
    }, function () {
        layer_loading('正在处理');
        $.ajax({
            url: $(obj).data('url'),
            type:'post',
            data: {ask_id:ask_id},
            dataType:'json',
            success:function(res){
                layer.closeAll();
                if ('1' == res.code) {
                    // 删除对应的审核按钮
                    $('#'+ask_id+'_Ask').remove();
                    layer.msg(res.msg, {time: 1500});
                }else{
                    layer.msg(res.msg, {time: 2000});
                }
            },
            error:function() {
                layer.closeAll();
                layer.alert('未知错误！', {icon: 5});
            }
        });
    });
}

// 管理员审核评论
function Review(obj, answer_id, status) {
    layer.confirm('确认审核该评论？', {
        btn: ['确认', '取消'],
        title: false
    }, function () {
        layer_loading('正在处理');
        $.ajax({
            url: $(obj).data('url'),
            data: {answer_id:answer_id},
            type:'post',
            dataType:'json',
            success:function(res){
                layer.closeAll();
                if ('1' == res.code) {
                    // 删除对应的审核按钮
                    $('#'+answer_id+'_Review').remove();
                    // 显示对应的采纳最佳答案按钮
                    if (1 == status) $('#'+answer_id+'_Best').show();
                    layer.msg(res.msg, {time: 1500});
                }else{
                    layer.msg(res.msg, {time: 2000});
                }
            },
            error:function() {
                layer.closeAll();
                layer.alert('未知错误！', {icon: 5});
            }
        });
    });
}

// 获取指定数量的评论数据（分页）
function ShowComment(obj, answer_id, is_comment) {
    /*处理查询数据*/
    var firstRow = $(obj).attr('data-firstRow');
    var listRows = $(obj).attr('data-listRows');
    firstRow = Number(firstRow)+5;
    /* END */

    //提交服务器
    layer_loading('正在处理');
    $.ajax({
        url: $(obj).data('url'),
        type: 'post',
        dataType: 'json',
        data: {answer_id:answer_id, firstRow:firstRow, listRows:listRows, is_comment:is_comment},
        success: function(res){
            layer.closeAll();
            if (1 == res.code) {
                // 追加html处理
                if (res.data.htmlcode) $("#"+answer_id+"_ReplyContainer").append(res.data.htmlcode);
                // 更新下一次提交查询数量
                $(obj).attr('data-firstRow', firstRow);
            } else {
                layer.msg(res.msg, {time: 1500, icon: 1});
                $(obj).hide();
            }
        },
        error : function() {
            layer.closeAll();
            layer.alert('未知错误！', {icon: 5});
        }
    });
}

// 排序
function AnswerLike(obj) {
    var url = $(obj).data('url');
    var sort_order = $(obj).data('sort_order');
    if (url.indexOf('?') > -1) {
        url += '&';
    } else {
        url += '?';
    }
    url += 'click_like=' + sort_order + '#comment';
    window.location.href = url;
}

// 加载层
function layer_loading(msg){
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

    return loading;
}