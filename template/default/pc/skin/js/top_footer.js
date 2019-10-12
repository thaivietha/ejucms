$(document).ready(function(){
	//头部弹出层
	$('.af_login01,.af_newlogin01').click(function(){
		$('#af-top-login,.modal-backdrop').css("display","block");
	});
	$('.af_login02,.af_newlogin02').click(function(){
		$('#af-top-zc,.modal-backdrop').css("display","block");
	});
	$('.af-dz').click(function(){
		$('.af-city,.modal-backdrop').css("display","block");
	});
	$('.close,.modal-backdrop').click(function(){
		$('#af-top-zc,#af-top-login,.modal-backdrop,.af-city').css("display","none");
	});

  $('.dl').click(function(){
    $('#af-top-zc').css("display","none");
    $('#af-top-login').css("display","block");
 });
    $('.mfzc').click(function(){
    $('#af-top-login').css("display","none");
    $('#af-top-zc').css("display","block");
 });

	
	
	    //footer - 链接 － tab切换 
	$(".lianjia-link-box .tab").on("mouseenter", "span", function(){
        //tab切换
        $(".lianjia-link-box .tab span.hover").removeClass("hover");
        $(this).addClass("hover");

        //list切换
        var index = $(".lianjia-link-box .tab span").index($(this));
        $(".lianjia-link-box .link-list div").css({
            "display" : 'none'
        });
        $(".lianjia-link-box .link-list div").eq(index).css({
            "display" : 'block'
        });
    });
	


	
	$(".af-jplp-list li").mouseenter(function(){
		$(".af-jplp-nr",this).fadeOut("fast");
   	 	$(".af-jplp-cnr",this).fadeIn("fast");
   	 	
 	});
 		$(".af-jplp-list li").mouseleave(function(){
   	 	$(".af-jplp-cnr",this).fadeOut("fast");
   	 	$(".af-jplp-nr",this).fadeIn("fast");;
 	});



//placeholder属性IE兼容性
$(function(){  
 
  //判断浏览器是否支持placeholder属性
  supportPlaceholder='placeholder'in document.createElement('input'),
 
  placeholder=function(input){
 
    var text = input.attr('placeholder'),
    defaultValue = input.defaultValue;
 
    if(!defaultValue){
 
      input.val(text).addClass("phcolor");
    }
 
    input.focus(function(){
 
      if(input.val() == text){
   
        $(this).val("");
      }
    });
 
  
    input.blur(function(){
 
      if(input.val() == ""){
       
        $(this).val(text).addClass("phcolor");
      }
    });
 
    //输入的字符不为灰色
    input.keydown(function(){
  
      $(this).removeClass("phcolor");
    });
  };
 
  //当浏览器不支持placeholder属性时，调用placeholder函数
  if(!supportPlaceholder){
 
    $('input').each(function(){
 
      text = $(this).attr("placeholder");
 
      if($(this).attr("type") == "text"){
 
        placeholder($(this));
      }
    });
  }
 
});

});

