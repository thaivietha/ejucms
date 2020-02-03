// 底部推荐

var oid = $('.m_lpqh_box span').eq(0).attr('styleId');


$('.m_lpqh_box span').eq(0).attr('class','on')

$('.m_lpqh_box span').on('click',function(){
    oid = $(this).attr('styleId');
    $(this).attr('class','on').siblings().attr('class','');
})

