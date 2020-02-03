$(function(){
    $('img[alt="code"]').css({"width":"40%","margin":"0 auto"});        //单独处理二维码的问题样式
})

$('#demo06').navbarscroll({
    defaultSelect: 0 ,   //默认选中
    scrollerWidth:4,
    fingerClick:1,
    endClickScroll:function(obj){
        // console.log(obj.text())
    }
});
var _imgid = ""; 
var xcdata=[];  



//var hid = $('.hu_main ul li').eq(0).attr('hid');
//var type_id = $('.hu_main ul li').eq(0).attr('value');
$('.hu_main ul li').eq(0).attr('class','in');
$('.hu_main ul li').on('click',function(){ 
     //hid = $(this).attr('hid');
     //type_id = $(this).attr('value');
    $(this).attr('class','in').siblings().attr('class','')
     //index_lp();
	var index = $(this).attr('data-index');
	$('#div_huxing').find('ul').hide();
	$("#huxing_"+index).show();
	 $('.hu_box').html(html);
            $('#zh_housetype-list ul li').eq(0).click();
                    // 打开相册
                    $('#lightgallery li').on('click',function(){
                        _imgid = $(this).attr('data-index');// 索引第几张图片
                        // console.log(_imgid);
                        $('.m_swiper_xc').show();

                         ajax_xc();
                    })

                   
                     $('#lightgallery li').each(function(){
                           var _src = $(this).find('img').attr('src');
                           var text = $(this).attr('data-sub-html');

                    
                           xcdata.push({'img':_src,'title':text});
                          

                     

                     })

})
//index_lp();

// 打开相册
$('.huxing_lightgallery li').on('click',function(){
	_imgid = $(this).attr('data-index');// 索引第几张图片
	// console.log(_imgid);
	$('.m_swiper_xc').show();

	 ajax_xc();
})


 $('.huxing_lightgallery li').each(function(){
	   var _src = $(this).find('img').attr('src');
	   var text = $(this).attr('data-sub-html');


	   xcdata.push({'img':_src,'title':text});




 })

$('.m_signup_gb').on('click',function(){
  $('.m_signup_box').hide();
})
$('.m_signup_zhez').on('click',function(){
  $('.m_signup_box').hide();
})







// 相册ajax_xc
  function ajax_xc (){ 
  // console.log(xcdata);
      var html = '';
    
          html+=  '<div class="m_swiper_box">';
          html+=  '<div class="m_swiper_gb"><img src="/template/default/mobile/skin/img/m_bm4.png" alt=""></div>';
          html+=  '<div class="m_swiper swiper-container">';
          html+=  '<div class="m_swiper_ul swiper-wrapper">';
           
          $.each(xcdata, function (i, xcdata) {  
              html+=  '<div class="m_swiper_li swiper-slide" data-id="1">';
              html+=  '<div class="swiper-zoom-container">';
              html+=  '<img src="'+xcdata.img+'">';
              html+=  '</div>';
              html+=  '</div>';
            });

          html+=  '</div>';
          html+=  '</div>';
          html+=  '<div class="swiper-pagination"></div>';

          $.each(xcdata, function (i, xcdata) {  
               html+=  '<div class="text">'+xcdata.title+'</div>';
          });

          html+=  '</div>';

           $('.m_swiper_ajax').html(html);

           $('.m_swiper_box .text').eq(0).attr('id','on');
         
           // 相册插件
          var swiper = new Swiper('.m_swiper', {
              zoom: true,
              // autoHeight: true,
              initialSlide :_imgid,

              pagination: '.swiper-pagination',
              paginationType : 'fraction',

              paginationFractionRender: function (swiper, currentClassName, totalClassName) {   //图片数量
                  return '<span class="' + currentClassName + '"></span>' +
                         ' / ' +
                         '<span class="' + totalClassName + '"></span>';
              },

              observer:true,//修改swiper自己或子元素时，自动初始化swiper    

              onSlideChangeStart: function(swiper){
                // console.log(swiper.activeIndex);
                 $('.m_swiper_box .text').attr('id','');
                 $('.m_swiper_box .text').eq(swiper.activeIndex).attr('id','on');
              }     
          
          });


          // 关闭相册
          $('.m_swiper_gb').on('click',function(){
            $('.m_swiper_ajax').html('');
              $('.m_swiper_xc').hide();
          })

          //限制字符个数
          $(".m_swiper_box .text").each(function(){
                  var maxwidth=80;
                  if($(this).text().length>maxwidth){ $(this).text($(this).text().substring(0,maxwidth)); $(this).html($(this).html()+'…');
                  }
          });

        
     
    }
