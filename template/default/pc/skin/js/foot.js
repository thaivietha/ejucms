
var common=(function(){
	var _sy={};
	_sy.bind=function(){
		/* footer */
		$("div.footer-v5").length>0&&this.footFunc();
	};
	
	_sy.footFunc=function(){
		$("#cur-year").text(new Date().getFullYear());
		var _this=this,ind=0;
		$("div.footer-v5 .linkrow").each(function(){
			$(this).click(function(){
				_this.changeClass($(this),"on");
			});
		});
		$("div.szdh-item > .szdh-list li").hover(function() {
			$(this).addClass("on");
			ind=$(this).index();
			$(this).closest(".szdh-item").children(".szdh-detail").css("display","block").children("ul:eq("+ind+")").css("display","block").siblings().css("display","none");
		}, function() {
			$(this).removeClass("on");
			$(this).closest(".szdh-item").children(".szdh-detail").css("display","none")
		});
		$(".szdh-detail").hover(function() {
			$(this).show();
			$(this).siblings("ul").find("li:eq("+ind+")").addClass("on");
		}, function() {
			$(this).hide();
			$(this).siblings("ul").find("li:eq("+ind+")").removeClass("on");
		});
	};
	_sy.changeClass=function(obj,cls){
		obj.hasClass(cls)?obj.removeClass(cls):obj.addClass(cls);
	};
	_sy.repositoryCard=function(){
		$("div.zskcfiv").delegate(".zskmore", "click", function(event) {
			var $obj=$(this).closest(".zskfivpo");
			if($obj.hasClass("zsksec")){
				$obj.removeClass("zsksec");
				$(this).html("展开 ∨");
			}else{
				$obj.siblings(".zskfivpo").each(function(){
					resetState($(this),"zsksec");
				});
				$obj.addClass("zsksec");
				$(this).html("收起 ∧");
			}
		});
		var resetState=function(obj,cls){
			if(obj.hasClass(cls)){
				obj.removeClass(cls);
				obj.find(".zskmore").html("展开 ∨");
			}
		}
	};
	_sy.activitypop=function(){
		$("#float-close").bind("click",function(){
			$(this).closest(".bot-float-520").animate({"left": "-100%"},200, function() {
				$(".bot-float-slide").css({"visibility":"visible","left":"0px"});
				$(".bot-float-520").css({"visibility":"hidden"});
			});
			return false;
	    });
		$(".bot-float-slide").bind("click",function(){
		    $(".bot-float-slide").css({"visibility":"hidden","left":"-150px"});
		    $(".bot-float-520").css({"visibility":"visible"});
		    $(".bot-float-520").animate({"left": "0"},200);
	    });
	};
	
	/**
	 * 点击空白区域关闭
	 * 
	 * @param {[type]}
	 *            $tarobj [点击作用区域]
	 * @param {[type]}
	 *            $closeobj [关闭区域]
	 */
	var bodyClickFunc=function($tarobj,$closeobj){
		$(document).delegate("body", "click", function(e) {
	    	if(!$tarobj.is(e.target) && $tarobj.has(e.target).length === 0){
	        	$closeobj.css("display","none");
	    	}
		});
	};
	_sy.bind();
	return {
	}
})();
