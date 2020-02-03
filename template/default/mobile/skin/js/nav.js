$(function(){
  $('.header_menu,.y_publicright a').on('click',function(){
    $('.y_sidebar').animate({left:"0%"});
  })
  $('.y_sidebar_bg').on('click',function(){
    $(this).parent().animate({left:"100%"});
  })

  setInterval(function(){
    $('#LRMINIBar').css({"bottom":"63px","left":"auto","right":"15px"});
    $('#LXB_CONTAINER_SHOW').css({"bottom":"63px","top":"auto","left":"0","right":"auto"});
    $('#cnzz_stat_icon_1273780160 a img').css({"width:":"20px","height":"20px"});
  },80);



  setTimeout(function(){
    group2();
  },5000);
  $('.dlwApply-colorbg,.dlwApply-gb a,.dlwApply-text-gb a').on('click',function(){
      delbox();
  })


  function group2(){
      iBoxWidth = $(".dlwApply-box").width();
      iBoxHeight = $(".dlwApply-box").height();
      iWinWidth = $(window).width();
      iWinHeight = $(window).height();
      $(".dlwApply-box").css("left", (iWinWidth / 2 - iBoxWidth / 2) + "px");
      // $(".dlwApply-box").css("top", ((iWinHeight / 2 - iBoxHeight / 2)-50) + "px");
      $(".dlwApply-box").animate({'top':((iWinHeight / 2 - iBoxHeight / 2)-50) + "px"},300);
      $(".dlwApply-colorbg").height(document.body.offsetHeight);
      $(".dlwApply-colorbg").show();
  }
  function delbox(){
      $(".dlwApply-box").animate({'top':'-100%'},300);
      $(".dlwApply-text").animate({'top':'-100%'},300);
      $(".dlwApply-colorbg").hide();
  }
})


 // 切换区域
 $('.m_head_l').on('click',function(){
      $('#serachBox2').hide();
      $('.footer_copy').hide();
      $('.m_qhcs_box').show();
    });

    $('.m_head_qhcs .m_Return').on('click',function(){
      $('#serachBox2').show();
      $('.m_qhcs_box').hide();
      $('.footer_copy').show();
    });    


