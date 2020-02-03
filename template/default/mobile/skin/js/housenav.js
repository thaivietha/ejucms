$(window).scroll(function (){
    var st = $(this).scrollTop();
    if(st >50){
        $('.y_lpindexnav').fadeIn().addClass('xungua');
        $('.y_lphome_nav').fadeOut();
    }else{
        $('.y_lpindexnav').fadeOut();
        $('.y_lphome_nav').fadeIn();
    }
});