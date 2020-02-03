// 头部轮播
var mySwiper2= new Swiper(".swiper-container2",{
    loop : true,
    loopedSlides:4,
    // autoplay:5500,
    autoplayDisableOnInteraction : false,
    // 如果需要分页器
    pagination: '.swiper-pagination',
    slidesPerView :"auto"
});


var mySwiper3 = new Swiper('.swiper-container3',{
	onTransitionEnd: function(swiper){

		$('.w').css('transform', 'translate3d(0px, 0px, 0px)')
		$('.swiper-container3 .swiper-slide-active').css('height','auto').siblings('.swiper-slide').css('height','0px');


		$('.tab a').eq(mySwiper3.activeIndex).addClass('active').siblings('a').removeClass('active');
	}

});

$('.tab a').click(function(){

	$(this).addClass('active').siblings('a').removeClass('active');
	mySwiper3.slideTo($(this).index(), 500, false)

	$('.w').css('transform', 'translate3d(0px, 0px, 0px)')
	$('.swiper-container3 .swiper-slide-active').css('height','auto').siblings('.swiper-slide').css('height','0px');
});

// 头条
var Total = $('.content ul li').length
if(Total > 1){
    function autoScroll(obj){
        $(obj).find("ul").animate({
            marginTop : "-55px"
        },500,function(){
            $(this).css({marginTop : "0px"}).find("li:first").appendTo(this);
        })
    }
    $(function(){
        setInterval('autoScroll(".headle_right .content")',5000);
    })
}

var mySwipers = new Swiper('#nav', {
            pagination: '.swiper-pagination',
            paginationClickable: true
        });
// 好房推荐
var oid = $('.m_Recommend_nav span').eq(0).attr('styleId');
$('.m_Recommend_nav span').eq(0).attr('class','on')

$('.m_Recommend_nav span').on('click',function(){
   oid = $(this).attr('styleId');
   $(this).attr('class','on').siblings().attr('class','');
	ajax_lp(this);
})
function ajax_lp(obj){
	$(".m_Recommend_lb").hide();
	var id = $(obj).data("id");
	$("#haofangtuijian"+id).show();
}

var mySwiper1= new Swiper(".swiper-container1",{
	loop : true,
	loopedSlides:4,
	autoplay:5500,
	autoplayDisableOnInteraction : false,
	// 如果需要分页器
	slidesPerView :"auto"
});

// 热门资讯
var m_Huxing_lunbo = new Swiper('.m_zx_lunbo', {
    loop : true,
    spaceBetween: 10,
    centeredSlides: true,
    slidesPerView: 'auto',
    touchRatio: 0.5,
    slideToClickedSlide: true
});



