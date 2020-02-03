var mySwiper1= new Swiper("#swiper1",{
        loop : false,
        loopedSlides:4,
        // autoplay:5500,
        autoplayDisableOnInteraction : false,

        slidesPerView :"auto"
    });


//移除弹出层 
function RemoveDiv5(){
    $("#m_InDivv2").remove();
    $("#m_offDivv2").remove();
} 
function btnCloses1(){ 
    RemoveDiv5(); 
}


// 头部显示隐藏
$(window).scroll(function (){
    var st = $(this).scrollTop();
    // console.log(st);
    if(st >220){
        $('.y_lpindexnav').show();
    }else{
        $('.y_lpindexnav').hide();
    }

 
});





