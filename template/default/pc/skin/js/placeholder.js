(function($){
    function placeholder(target){
        var browser=navigator.appName
     
        var b_version=navigator.appVersion
         
        var version=b_version.split(";");
        if(!version[1]){
          return ;
        } 
        var trim_Version=version[1].replace(/[ ]/g,"");
        
        if(browser=="Microsoft Internet Explorer" && trim_Version=="MSIE7.0" || browser=="Microsoft Internet Explorer" && trim_Version=="MSIE8.0" || browser=="Microsoft Internet Explorer" && trim_Version=="MSIE9.0")
         
        {
            $(target).siblings("span").show();
            $(target).focus(function() {
                $(this).siblings("span").hide();
            })
            $(target).blur(function(){
                if($(this).val() == "") {
                    $(this).siblings("span").show();
                }
            })
        }
    }

    placeholder(".ipt")

  
})(jQuery)