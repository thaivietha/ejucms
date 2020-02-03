$(function(){ 
 setTimeout(function(){
    $('.m_album_box').hide();
 },500)   
});
$('#demo06').navbarscroll({
    defaultSelect: 0 ,   //默认选中
    scrollerWidth:6,
    fingerClick:1,
    endClickScroll:function(obj){
        // console.log(obj.text())
    }
});
var _dataid = ""   
var _hid = 0   

// 相册
$('.m_headImg_ul_li p').on('click',function(){
    $('.wrapper02 .scroller li').attr('class',''); //清除默认样式
    _dataid = $(this).attr('xcid');  //获取类型ID
    _hid = $(this).attr('hid');  //获取楼盘ID
    $('.m_album_box').show();    
    $('.m_album_box').attr('id','block1');
    $('.wrapper02 .scroller li[dataid="'+_dataid+'"]').attr('class','cur');  
    _xcajax();   // 切换ajax调用
})

$('.m_Return').on('click',function(){  //关闭相册
   $('.m_album_box').hide();
})

$('.scroller ul li').on('click',function(){ 
    _dataid = $(this).attr('dataid');  //获取类型ID
    _hid = $(this).attr('hid');  //获取楼盘ID
    _xcajax();   // 切换ajax调用
})


  function _xcajax(){
     var html = '';
        $.ajax({
          url: photoUrl,
          data:{album_id:_dataid,hid:_hid},
          type: "POST",
          dataType: "json",
          success: function(data) {
                  html+='<div class="m_albumlb_box swiper-container" id="swiper10">';
                  html+='<ul class="swiper-wrapper">';
                  $.each(data.data, function (i, data) { 
                        imgpath = PUBLIC+"ico_logo1.jpg";
                        if(data.imgpath) imgpath =  ROOT+"/"+data.imgpath; 
                        html+='<li class="swiper-slide">';
                        html+='<img src="'+imgpath+'" alt="">';
                        html+='<div class="m_album_text">';
                        html+='<div class="m_album_textTop">';
                        html+='<span>'+data.name+'</span>';
                        html+='</div>';
                        html+='</div>';
                        html+='</li>';
                  })
        
                  html+='</ul>';
                  html+='<div class="swiper-pagination"></div>';
                  html+='</div>';

              $('.m_swiper_box').html("");
              $('.m_swiper_box').html(html);



              var _lirWidth = $('#swiper10 ul li').outerWidth();  //获取 LI 宽度
              var _ulWidth= $('#swiper10 ul').outerWidth();       // UL 的 宽度
              var _lilength = $('#swiper10 ul li').length;        //获取 LI 总数
              var Swiper_length = _lirWidth * _lilength +  100  - _ulWidth;   //计算总长度
              


              var _nexttj = true;      
              function _next(){       //只执行一次方法
                  if(_nexttj){        //等于 true 执行
                   // console.log('左边');
                  $('.wrapper02 .scroller li.cur').next().click();  //上一个类型
                  _nexttj = false;    //等于 false 不执行
                  }
              }

              var _prevtj = true;   
              function _prev(){         //只执行一次方法
                  if(_prevtj){          //等于 true 执行  
                  // console.log('右边');
                  $('.wrapper02 .scroller li.cur').prev().click();   //下一个类型
                  _prevtj = false;      //等于 false 不执行
                  }
              }

              var mySwiper10 = new Swiper('#swiper10',{
                    // autoplay:true,  //自动切换
                    loop : false,    //循环
                    pagination: '.swiper-pagination',
                    paginationType : 'fraction',

                    paginationFractionRender: function (swiper, currentClassName, totalClassName) {   //图片数量
                        return '<span class="' + currentClassName + '"></span>' +
                               ' / ' +
                               '<span class="' + totalClassName + '"></span>';
                    },

                    onTouchMove: function(swiper){   // 移动执行 上或下一个类型
                        TR=swiper.translate
                           // console.log(TR);

                           if(TR > 100){
                                  _prev();    //调用  //下一个类型
                           }else if(TR < -Swiper_length){
                                  _next();   //调用  //上一个类型
                           }
                    }
                })

          }
      });
  }
