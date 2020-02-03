// 新房搜索页面 单独加载效果
//创建一个弹出层,width 宽度，height 高度，url
function CreatePopLayerDiv2(width,height,url){
    var Iheight=$(window).height(); 
    var Iwidth =$(window).width(); 
    var heights = height || 300; 
    var widths = width || 500; 
    var Oheight= (Iheight -heights) / 2; 
    var Owidth = (Iwidth - widths) /2;
    var div ='<div id="InDiv2" style="width:'+Iwidth+';height:'+Iheight+'; position:fixed;z-index:30;top:0;left:0;">';
        div+='<div id="offDiv2" style=" width:100%; height:100%; left:0px; top:0px; position:fixed;z-index:32;">';
        div+='<div id="Content2"></div>';
        div+='</div>';
        div+='</div>';
    $(document.body).append(div); 

    if(url != ""){ 
        $("#Content2").load(url); 
    } 
} 
//移除弹出层 
function RemoveDiv2(){
    $("#offDiv2").remove(); 
    $("#InDiv2").remove();
} 
function btnCloses2(){ 
	$("#InDiv2").hide();
//    RemoveDiv2();
//    $('#serachBox2').show(); 
//    $('.my_needs').show();
//    $('.home_module_channel').show();
//    $('.footer_copy').show();
} 
$(function(){
    $(".y_lplist_inp").click(function(){
		$("#InDiv2").show();
//        CreatePopLayerDiv2('100%','100%',searchUrl); //添加加载页面
//        $('#serachBox2').hide();
//        $('.my_needs').hide();
//        $('.home_module_channel').hide();
//        $('.footer_copy').hide();
      
    }); 
})




// 二手房搜索页面 单独加载效果
//创建一个弹出层,width 宽度，height 高度，url
function CreatePopLayerDiv2_ershou(width,height,url){
    var Iheight=$(window).height(); 
    var Iwidth =$(window).width(); 
    var heights = height || 300; 
    var widths = width || 500; 
    var Oheight= (Iheight -heights) / 2; 
    var Owidth = (Iwidth - widths) /2;
    var div ='<div id="InDiv2_ershou" style="width:'+Iwidth+';height:'+Iheight+'; position:fixed;z-index:30;top:0;left:0;">';
        div+='<div id="offDiv2_ershou" style=" width:100%; height:100%; left:0px; top:0px; position:fixed;z-index:32;">';
        div+='<div id="Content2_ershou"></div>';
        div+='</div>';
        div+='</div>';
    $(document.body).append(div); 

    if(url != ""){ 
        $("#Content2_ershou").load(url); 
    } 
} 
//移除弹出层 
function RemoveDiv2_ershou(){
    $("#offDiv2_ershou").remove(); 
    $("#InDiv2_ershou").remove();
} 
function btnCloses2_ershou(){ 
	$("#InDiv2_ershou").hide();
} 
$(function(){
    $(".y_lplist_inp_ershou").click(function(){
		$("#InDiv2_ershou").show();
      
    }); 
})



// 租房搜索页面 单独加载效果
//创建一个弹出层,width 宽度，height 高度，url
function CreatePopLayerDiv2_zufang(width,height,url){
    var Iheight=$(window).height(); 
    var Iwidth =$(window).width(); 
    var heights = height || 300; 
    var widths = width || 500; 
    var Oheight= (Iheight -heights) / 2; 
    var Owidth = (Iwidth - widths) /2;
    var div ='<div id="InDiv2_zufang" style="width:'+Iwidth+';height:'+Iheight+'; position:fixed;z-index:30;top:0;left:0;">';
        div+='<div id="offDiv2_zufang" style=" width:100%; height:100%; left:0px; top:0px; position:fixed;z-index:32;">';
        div+='<div id="Content2_zufang"></div>';
        div+='</div>';
        div+='</div>';
    $(document.body).append(div); 

    if(url != ""){ 
        $("#Content2_zufang").load(url); 
    } 
} 
//移除弹出层 
function RemoveDiv2_zufang(){
    $("#offDiv2_zufang").remove(); 
    $("#InDiv2_zufang").remove();
} 
function btnCloses2_zufang(){ 
	$("#InDiv2_zufang").hide();
} 
$(function(){
    $(".y_lplist_inp_zufang").click(function(){
		$("#InDiv2_zufang").show();
      
    }); 
})



// 小区搜索页面 单独加载效果
//创建一个弹出层,width 宽度，height 高度，url
function CreatePopLayerDiv2_xiaoqu(width,height,url){
    var Iheight=$(window).height(); 
    var Iwidth =$(window).width(); 
    var heights = height || 300; 
    var widths = width || 500; 
    var Oheight= (Iheight -heights) / 2; 
    var Owidth = (Iwidth - widths) /2;
    var div ='<div id="InDiv2_xiaoqu" style="width:'+Iwidth+';height:'+Iheight+'; position:fixed;z-index:30;top:0;left:0;">';
        div+='<div id="offDiv2_xiaoqu" style=" width:100%; height:100%; left:0px; top:0px; position:fixed;z-index:32;">';
        div+='<div id="Content2_xiaoqu"></div>';
        div+='</div>';
        div+='</div>';
    $(document.body).append(div); 

    if(url != ""){ 
        $("#Content2_xiaoqu").load(url); 
    } 
} 
//移除弹出层 
function RemoveDiv2_xiaoqu(){
    $("#offDiv2_xiaoqu").remove(); 
    $("#InDiv2_xiaoqu").remove();
} 
function btnCloses2_xiaoqu(){ 
	$("#InDiv2_xiaoqu").hide();
} 
$(function(){
    $(".y_lplist_inp_xiaoqu").click(function(){
		$("#InDiv2_xiaoqu").show();
      
    }); 
})


// 商铺出售搜索页面 单独加载效果
//创建一个弹出层,width 宽度，height 高度，url
function CreatePopLayerDiv2_shopcs(width,height,url){
    var Iheight=$(window).height(); 
    var Iwidth =$(window).width(); 
    var heights = height || 300; 
    var widths = width || 500; 
    var Oheight= (Iheight -heights) / 2; 
    var Owidth = (Iwidth - widths) /2;
    var div ='<div id="InDiv2_shopcs" style="width:'+Iwidth+';height:'+Iheight+'; position:fixed;z-index:30;top:0;left:0;">';
        div+='<div id="offDiv2_shopcs" style=" width:100%; height:100%; left:0px; top:0px; position:fixed;z-index:32;">';
        div+='<div id="Content2_shopcs"></div>';
        div+='</div>';
        div+='</div>';
    $(document.body).append(div); 

    if(url != ""){ 
        $("#Content2_shopcs").load(url); 
    } 
} 
//移除弹出层 
function RemoveDiv2_shopcs(){
    $("#offDiv2_shopcs").remove(); 
    $("#InDiv2_shopcs").remove();
} 
function btnCloses2_shopcs(){ 
	$("#InDiv2_shopcs").hide();
} 
$(function(){
    $(".y_lplist_inp_shopcs").click(function(){
		$("#InDiv2_shopcs").show();
      
    }); 
})



// 商铺出租搜索页面 单独加载效果
//创建一个弹出层,width 宽度，height 高度，url
function CreatePopLayerDiv2_shopcz(width,height,url){
    var Iheight=$(window).height(); 
    var Iwidth =$(window).width(); 
    var heights = height || 300; 
    var widths = width || 500; 
    var Oheight= (Iheight -heights) / 2; 
    var Owidth = (Iwidth - widths) /2;
    var div ='<div id="InDiv2_shopcz" style="width:'+Iwidth+';height:'+Iheight+'; position:fixed;z-index:30;top:0;left:0;">';
        div+='<div id="offDiv2_shopcz" style=" width:100%; height:100%; left:0px; top:0px; position:fixed;z-index:32;">';
        div+='<div id="Content2_shopcz"></div>';
        div+='</div>';
        div+='</div>';
    $(document.body).append(div); 

    if(url != ""){ 
        $("#Content2_shopcz").load(url); 
    } 
} 
//移除弹出层 
function RemoveDiv2_shopcz(){
    $("#offDiv2_shopcz").remove(); 
    $("#InDiv2_shopcz").remove();
} 
function btnCloses2_shopcz(){ 
	$("#InDiv2_shopcz").hide();
} 
$(function(){
    $(".y_lplist_inp_shopcz").click(function(){
		$("#InDiv2_shopcz").show();
      
    }); 
})





// 写字楼出售搜索页面 单独加载效果
//创建一个弹出层,width 宽度，height 高度，url
function CreatePopLayerDiv2_officecs(width,height,url){
    var Iheight=$(window).height(); 
    var Iwidth =$(window).width(); 
    var heights = height || 300; 
    var widths = width || 500; 
    var Oheight= (Iheight -heights) / 2; 
    var Owidth = (Iwidth - widths) /2;
    var div ='<div id="InDiv2_officecs" style="width:'+Iwidth+';height:'+Iheight+'; position:fixed;z-index:30;top:0;left:0;">';
        div+='<div id="offDiv2_officecs" style=" width:100%; height:100%; left:0px; top:0px; position:fixed;z-index:32;">';
        div+='<div id="Content2_officecs"></div>';
        div+='</div>';
        div+='</div>';
    $(document.body).append(div); 

    if(url != ""){ 
        $("#Content2_officecs").load(url); 
    } 
} 
//移除弹出层 
function RemoveDiv2_officecs(){
    $("#offDiv2_officecs").remove(); 
    $("#InDiv2_officecs").remove();
} 
function btnCloses2_officecs(){ 
	$("#InDiv2_officecs").hide();
} 
$(function(){
    $(".y_lplist_inp_officecs").click(function(){
		$("#InDiv2_officecs").show();
      
    }); 
})



// 写字楼出租搜索页面 单独加载效果
//创建一个弹出层,width 宽度，height 高度，url
function CreatePopLayerDiv2_officecz(width,height,url){
    var Iheight=$(window).height(); 
    var Iwidth =$(window).width(); 
    var heights = height || 300; 
    var widths = width || 500; 
    var Oheight= (Iheight -heights) / 2; 
    var Owidth = (Iwidth - widths) /2;
    var div ='<div id="InDiv2_officecz" style="width:'+Iwidth+';height:'+Iheight+'; position:fixed;z-index:30;top:0;left:0;">';
        div+='<div id="offDiv2_officecz" style=" width:100%; height:100%; left:0px; top:0px; position:fixed;z-index:32;">';
        div+='<div id="Content2_officecz"></div>';
        div+='</div>';
        div+='</div>';
    $(document.body).append(div); 

    if(url != ""){ 
        $("#Content2_officecz").load(url); 
    } 
} 
//移除弹出层 
function RemoveDiv2_officecz(){
    $("#offDiv2_officecz").remove(); 
    $("#InDiv2_officecz").remove();
} 
function btnCloses2_officecz(){ 
	$("#InDiv2_officecz").hide();
} 
$(function(){
    $(".y_lplist_inp_officecz").click(function(){
		$("#InDiv2_officecz").show();
      
    }); 
})











