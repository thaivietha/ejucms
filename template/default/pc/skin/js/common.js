(function($){
    $('.sele_city_btn').click(function(){
      $(this).next().slideToggle(100);

    });
	$(".city-close").on('click',function(){
		$(".city_list").hide();
	});
    $('.loged ').hover(
    	function(){
    		$(this).find('.slide_tog').stop(true,true).slideDown(100);
   		},
   		function(){
   			$(this).find('.slide_tog').stop(true,true).slideUp(100);
   		}
    );

})(jQuery);

(function($){
	$.fn.extend({
		Scroll:function(opt,callback){
			//参数初始化
			if(!opt) var opt={};
			var _this=this.eq(0).find("ul:first");
			var    lineH=_this.find("li:first").height(), //获取行高
				line=opt.line?parseInt(opt.line,10):parseInt(this.height()/lineH,10), //每次滚动的行数，默认为一屏，即父容器高度
				speed=opt.speed?parseInt(opt.speed,10):500, //卷动速度，数值越大，速度越慢（毫秒）
				timer=opt.timer?parseInt(opt.timer,10):3000; //滚动的时间间隔（毫秒）
			if(line==0) line=1;
			var upHeight=0-line*lineH;
			//滚动函数
			scrollUp=function(){
				_this.animate({
					marginTop:upHeight
				},speed,function(){
					for(i=1;i<=line;i++){
						_this.find("li:first").appendTo(_this);
					}
					_this.css({marginTop:0});
				});
			}
			//鼠标事件绑定
			_this.hover(function(){
				clearInterval(timerID);
			},function(){
				timerID=setInterval("scrollUp()",timer);
			}).mouseout();
		}
	})
})(jQuery);
// ripple start
var addRippleEffect = function(e) {
	var target = e.target;
	if (target.localName !== 'a' || $(target).parents('.nav_list').length == 0) return false;
	var rect = target.getBoundingClientRect();
	var ripple = target.querySelector('.ripple');
	if (!ripple) {
		ripple = document.createElement('span');
		ripple.className = 'ripple';
		ripple.style.height = ripple.style.width = Math.max(rect.width, rect.height) + 'px';
		target.appendChild(ripple);
	}
	ripple.classList.remove('show');
	var top = e.pageY - rect.top - ripple.offsetHeight / 2 - document.body.scrollTop;
	var left = e.pageX - rect.left - ripple.offsetWidth / 2 - document.body.scrollLeft;
	ripple.style.top = top + 'px';
	ripple.style.left = left + 'px';
	ripple.classList.add('show');
	return false;
};
document.addEventListener('click', addRippleEffect, false);
// ripple end

