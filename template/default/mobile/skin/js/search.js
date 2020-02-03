// 头部轮播
var mySwiper1= new Swiper(".swiper-container",{
        loop : true,
        loopedSlides:4,
        autoplay:5500,
        autoplayDisableOnInteraction : false,
        // 如果需要分页器
        pagination: '.swiper-pagination',
        slidesPerView :"auto"
});

function getParams(url) {
    var theRequest = new Object();
    if (!url)
        url = location.href;
    if (url.indexOf("?") !== -1)
    {
        var str = url.substr(url.indexOf("?") + 1) + "&";
        var strs = str.split("&");
        for (var i = 0; i < strs.length - 1; i++)
        {
            var key = strs[i].substring(0, strs[i].indexOf("="));
            var val = strs[i].substring(strs[i].indexOf("=") + 1);
            theRequest[key] = val;
        }
    }
    return theRequest;
}


$.each($('.m_nav_qy').find('a'),function(){
    var each_name = $(this).attr('name');
    var each_val = $(this).attr('value');
    if(each_val == objUrl[each_name]){
        $(this).attr('id','nav');
    }
})
//
$(".y_qylist_cnet_ind").on('click','a.link-item',function(){
    var _this = $(this);
    _this.addClass('on');
    _this.siblings().removeClass('on');
    _this.parent().find('.three_area').hide();
    _this.parent().find('.three_area').animate({left:"100%"});
    $('.'+ _this.attr('id')).show();    
    $('.'+ _this.attr('id')).animate({left:"35%"});
})


function waptab(name1,name2,name3){
    $(name1).on('click',function(){
        $('.y_qylist_con .y_topmain i img');
        $(name2).hide();
        var Idoption = $(this).attr(name3);
        if($(this).hasClass('on')){  //判断css on 是否存在
            $(name2+'['+name3+''+'='+ Idoption +']').hide();
            $('.y_qylist_con .y_topmain i img');
            $(this).removeClass('on');
            $('.m_Mask').hide();
            $('.y_puicfoot').show();
        }else{
            $(this).addClass('on').siblings().removeClass('on');
            $(name2+'['+name3+''+'='+ Idoption +']').show();
            $(this).find('.y_topmain i img');
            $('.m_Mask').show();
            $('.y_puicfoot').hide();

        }
    })
}
waptab('.y_qylist_hoe .y_qylist_con','.y_qylist_cnet_ind','data-id');

$('.m_Mask').on('click',function(){
    $('.y_qylist_con').removeClass('on');
    $('.y_qylist_con .y_topmain i img');
    $('.y_qylist_cnet_ind').hide();
    $(this).hide();
})


// 楼盘动态
function autoScroll(obj){
    $(obj).find("ul").animate({
        marginTop : "-30px"
    },500,function(){
        $(this).css({marginTop : "0px"}).find("li:first").appendTo(this);
    })
}
$(function(){
    setInterval('autoScroll(".headle_right .content")',5000);
})

$(window).scroll(function(){

     var wst =  $(window).scrollTop();
    // console.log(wst);

    if (wst >= 165) {
        $('.m_type').attr('id','y_qylist');
   
    }else{
        $('.m_type').attr('id','');
    }
})


