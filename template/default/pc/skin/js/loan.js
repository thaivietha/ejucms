/**
 * Created by junyv on 2018/7/25.
 */
$(function(){
   $(".loan").each(function(i,o){
      var total = $(this).data('total'),first = 0,month = 0,m = 360,y = 30,f = 0.3,r = 0.049,mr = r / 12;
       if(total > 0)
       {
           first = (total * f).toFixed(1);
           //month = parseInt((total * 10000 + total * 1000 * r * y) / m);
           month = parseInt(total * 10000 * 0.7 * mr * Math.pow(1 + mr, m) / (Math.pow(1 + mr, m) - 1));
           $(this).find(".first-payment").text('约'+first+'万');//首付
           $(this).find(".monthly-payment").text('约'+month+'元');//月供
       }

   });
});