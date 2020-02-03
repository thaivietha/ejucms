/*fastclick*/
!function(){"use strict";function t(e,o){function i(t,e){return function(){return t.apply(e,arguments)}}var r;if(o=o||{},this.trackingClick=!1,this.trackingClickStart=0,this.targetElement=null,this.touchStartX=0,this.touchStartY=0,this.lastTouchIdentifier=0,this.touchBoundary=o.touchBoundary||10,this.layer=e,this.tapDelay=o.tapDelay||200,this.tapTimeout=o.tapTimeout||700,!t.notNeeded(e)){for(var a=["onMouse","onClick","onTouchStart","onTouchMove","onTouchEnd","onTouchCancel"],c=this,s=0,u=a.length;u>s;s++)c[a[s]]=i(c[a[s]],c);n&&(e.addEventListener("mouseover",this.onMouse,!0),e.addEventListener("mousedown",this.onMouse,!0),e.addEventListener("mouseup",this.onMouse,!0)),e.addEventListener("click",this.onClick,!0),e.addEventListener("touchstart",this.onTouchStart,!1),e.addEventListener("touchmove",this.onTouchMove,!1),e.addEventListener("touchend",this.onTouchEnd,!1),e.addEventListener("touchcancel",this.onTouchCancel,!1),Event.prototype.stopImmediatePropagation||(e.removeEventListener=function(t,n,o){var i=Node.prototype.removeEventListener;"click"===t?i.call(e,t,n.hijacked||n,o):i.call(e,t,n,o)},e.addEventListener=function(t,n,o){var i=Node.prototype.addEventListener;"click"===t?i.call(e,t,n.hijacked||(n.hijacked=function(t){t.propagationStopped||n(t)}),o):i.call(e,t,n,o)}),"function"==typeof e.onclick&&(r=e.onclick,e.addEventListener("click",function(t){r(t)},!1),e.onclick=null)}}var e=navigator.userAgent.indexOf("Windows Phone")>=0,n=navigator.userAgent.indexOf("Android")>0&&!e,o=/iP(ad|hone|od)/.test(navigator.userAgent)&&!e,i=o&&/OS 4_\d(_\d)?/.test(navigator.userAgent),r=o&&/OS [6-7]_\d/.test(navigator.userAgent),a=navigator.userAgent.indexOf("BB10")>0;t.prototype.needsClick=function(t){switch(t.nodeName.toLowerCase()){case"button":case"select":case"textarea":if(t.disabled)return!0;break;case"input":if(o&&"file"===t.type||t.disabled)return!0;break;case"label":case"iframe":case"video":return!0}return/\bneedsclick\b/.test(t.className)},t.prototype.needsFocus=function(t){switch(t.nodeName.toLowerCase()){case"textarea":return!0;case"select":return!n;case"input":switch(t.type){case"button":case"checkbox":case"file":case"image":case"radio":case"submit":return!1}return!t.disabled&&!t.readOnly;default:return/\bneedsfocus\b/.test(t.className)}},t.prototype.sendClick=function(t,e){var n,o;document.activeElement&&document.activeElement!==t&&document.activeElement.blur(),o=e.changedTouches[0],n=document.createEvent("MouseEvents"),n.initMouseEvent(this.determineEventType(t),!0,!0,window,1,o.screenX,o.screenY,o.clientX,o.clientY,!1,!1,!1,!1,0,null),n.forwardedTouchEvent=!0,t.dispatchEvent(n)},t.prototype.determineEventType=function(t){return n&&"select"===t.tagName.toLowerCase()?"mousedown":"click"},t.prototype.focus=function(t){var e;o&&t.setSelectionRange&&0!==t.type.indexOf("date")&&"time"!==t.type&&"month"!==t.type?(e=t.value.length,t.setSelectionRange(e,e)):t.focus()},t.prototype.updateScrollParent=function(t){var e,n;if(e=t.fastClickScrollParent,!e||!e.contains(t)){n=t;do{if(n.scrollHeight>n.offsetHeight){e=n,t.fastClickScrollParent=n;break}n=n.parentElement}while(n)}e&&(e.fastClickLastScrollTop=e.scrollTop)},t.prototype.getTargetElementFromEventTarget=function(t){return t.nodeType===Node.TEXT_NODE?t.parentNode:t},t.prototype.onTouchStart=function(t){var e,n,r;if(t.targetTouches.length>1)return!0;if(e=this.getTargetElementFromEventTarget(t.target),n=t.targetTouches[0],o){if(r=window.getSelection(),r.rangeCount&&!r.isCollapsed)return!0;if(!i){if(n.identifier&&n.identifier===this.lastTouchIdentifier)return t.preventDefault(),!1;this.lastTouchIdentifier=n.identifier,this.updateScrollParent(e)}}return this.trackingClick=!0,this.trackingClickStart=t.timeStamp,this.targetElement=e,this.touchStartX=n.pageX,this.touchStartY=n.pageY,t.timeStamp-this.lastClickTime<this.tapDelay&&t.preventDefault(),!0},t.prototype.touchHasMoved=function(t){var e=t.changedTouches[0],n=this.touchBoundary;return Math.abs(e.pageX-this.touchStartX)>n||Math.abs(e.pageY-this.touchStartY)>n?!0:!1},t.prototype.onTouchMove=function(t){return this.trackingClick?((this.targetElement!==this.getTargetElementFromEventTarget(t.target)||this.touchHasMoved(t))&&(this.trackingClick=!1,this.targetElement=null),!0):!0},t.prototype.findControl=function(t){return void 0!==t.control?t.control:t.htmlFor?document.getElementById(t.htmlFor):t.querySelector("button, input:not([type=hidden]), keygen, meter, output, progress, select, textarea")},t.prototype.onTouchEnd=function(t){var e,a,c,s,u,l=this.targetElement;if(!this.trackingClick)return!0;if(t.timeStamp-this.lastClickTime<this.tapDelay)return this.cancelNextClick=!0,!0;if(t.timeStamp-this.trackingClickStart>this.tapTimeout)return!0;if(this.cancelNextClick=!1,this.lastClickTime=t.timeStamp,a=this.trackingClickStart,this.trackingClick=!1,this.trackingClickStart=0,r&&(u=t.changedTouches[0],l=document.elementFromPoint(u.pageX-window.pageXOffset,u.pageY-window.pageYOffset)||l,l.fastClickScrollParent=this.targetElement.fastClickScrollParent),c=l.tagName.toLowerCase(),"label"===c){if(e=this.findControl(l)){if(this.focus(l),n)return!1;l=e}}else if(this.needsFocus(l))return t.timeStamp-a>100||o&&window.top!==window&&"input"===c?(this.targetElement=null,!1):(this.focus(l),this.sendClick(l,t),o&&"select"===c||(this.targetElement=null,t.preventDefault()),!1);return o&&!i&&(s=l.fastClickScrollParent,s&&s.fastClickLastScrollTop!==s.scrollTop)?!0:(this.needsClick(l)||(t.preventDefault(),this.sendClick(l,t)),!1)},t.prototype.onTouchCancel=function(){this.trackingClick=!1,this.targetElement=null},t.prototype.onMouse=function(t){return this.targetElement?t.forwardedTouchEvent?!0:t.cancelable&&(!this.needsClick(this.targetElement)||this.cancelNextClick)?(t.stopImmediatePropagation?t.stopImmediatePropagation():t.propagationStopped=!0,t.stopPropagation(),t.preventDefault(),!1):!0:!0},t.prototype.onClick=function(t){var e;return this.trackingClick?(this.targetElement=null,this.trackingClick=!1,!0):"submit"===t.target.type&&0===t.detail?!0:(e=this.onMouse(t),e||(this.targetElement=null),e)},t.prototype.destroy=function(){var t=this.layer;n&&(t.removeEventListener("mouseover",this.onMouse,!0),t.removeEventListener("mousedown",this.onMouse,!0),t.removeEventListener("mouseup",this.onMouse,!0)),t.removeEventListener("click",this.onClick,!0),t.removeEventListener("touchstart",this.onTouchStart,!1),t.removeEventListener("touchmove",this.onTouchMove,!1),t.removeEventListener("touchend",this.onTouchEnd,!1),t.removeEventListener("touchcancel",this.onTouchCancel,!1)},t.notNeeded=function(t){var e,o,i,r;if("undefined"==typeof window.ontouchstart)return!0;if(o=+(/Chrome\/([0-9]+)/.exec(navigator.userAgent)||[,0])[1]){if(!n)return!0;if(e=document.querySelector("meta[name=viewport]")){if(-1!==e.content.indexOf("user-scalable=no"))return!0;if(o>31&&document.documentElement.scrollWidth<=window.outerWidth)return!0}}if(a&&(i=navigator.userAgent.match(/Version\/([0-9]*)\.([0-9]*)/),i[1]>=10&&i[2]>=3&&(e=document.querySelector("meta[name=viewport]")))){if(-1!==e.content.indexOf("user-scalable=no"))return!0;if(document.documentElement.scrollWidth<=window.outerWidth)return!0}return"none"===t.style.msTouchAction||"manipulation"===t.style.touchAction?!0:(r=+(/Firefox\/([0-9]+)/.exec(navigator.userAgent)||[,0])[1],r>=27&&(e=document.querySelector("meta[name=viewport]"),e&&(-1!==e.content.indexOf("user-scalable=no")||document.documentElement.scrollWidth<=window.outerWidth))?!0:"none"===t.style.touchAction||"manipulation"===t.style.touchAction?!0:!1)},t.attach=function(e,n){return new t(e,n)},"function"==typeof define&&"object"==typeof define.amd&&define.amd?define(function(){return t}):"undefined"!=typeof module&&module.exports?(module.exports=t.attach,module.exports.FastClick=t):window.FastClick=t}();
$(function(){
	var url = location.href;
    //保存来源到cookie
    //判断若当前路径包含hmsr则把当前路径记录下来
    var _hmsr = getApplySource();
    if(_hmsr) {
    	var seoBid = $("#currentBid").val();
    	document.cookie = "_hmsr=" + _hmsr + "; path=/;";
    	//若存在hmsr则记录投放广告楼盘id
        document.cookie = "_seoBid" + "=" + seoBid + ";path=/" + ";domain=.jiwu.com";
    }
    if(getCookie("_landingPage")==null){
    	document.cookie = "_landingPage"  + "=" + escape($("#triggerPage").val()) + ";path=/" + ";domain=.jiwu.com";
    }
	
	//根据渠道替换400号码
    if($("#centerPhone").length > 0){
    	var hmsr= getCookie("_hmsr");//要判断是否没空
    	if($("#centerPhone").html().indexOf("转")!= -1 ){
    		//替换实现
    		var bid = $("#currentBid").val();
    		if(bid != undefined && bid != "" && bid != null){
    			replacePhone(hmsr,bid)
    		}
    	}
    }
  //判断免费渠道
    var hmsr= getCookie("_hmsr")
    if(hmsr==null){
    	var refer = document.referrer
    	if(refer.indexOf(".baidu.com")>0){
    		document.cookie = "_sourceChannel"  + "=百度搜索;path=/" + ";domain=.jiwu.com";
    	}else if(refer.indexOf(".so.com")>0){
    		document.cookie = "_sourceChannel"  + "=360搜索;path=/" + ";domain=.jiwu.com";
    	}else if(refer.indexOf(".sogou.com")>0){
    		document.cookie = "_sourceChannel"  + "=搜狗搜索;path=/" + ";domain=.jiwu.com";
    	}else if(refer.indexOf(".sm.cn")>0){
    		document.cookie = "_sourceChannel"  + "=神马搜索;path=/" + ";domain=.jiwu.com";
    	}
    }
    /*if($("#domain").val()=='suzhou'){
    	var _hmt = _hmt || [];
    	(function() {
    	  var hm = document.createElement("script");
    	  hm.src = "https://hm.baidu.com/hm.js?62eca70fbe0a2b1dff83b03e12a1e008";
    	  var s = document.getElementsByTagName("script")[0]; 
    	  s.parentNode.insertBefore(hm, s);
    	})();
    }*/
})
/**
 * [jwLineChart]
 * 
 * @param  
 * 		   {obj}    [绘图区]
 *         {ymin}   [纵坐标最小值，默认取所给数据最小值]
 *         {ymax}   [纵坐标最大值，默认取所给数据最大值]
 *         {count}  [纵坐标分段数，默认为三段]
 *         {color}  [全局颜色信息数组，控制线条和点的颜色显示]
 *         {data}   [数据，注意多条线的数据格式,无数据时给null,则不绘制线]
 *         {xaxis}  [横坐标信息]
 *         {legend} [图例文字设置]
 *         {ytxt}   [纵坐标单位，默认为'万']
 *         {unit}   [数值单位信息，默认'元/平']
 *         {autoResize} [屏幕改变时重绘，默认为'true']
 *         
 * @function 
 * 			{scroll_left} [左移，参数为：位移距离]
 *    		{update}
 *    		{rewrite}
 *    		{erasure}
 */
function jwLineChart(setting){
	this.initParam(setting);
	this.initRender();
}

jwLineChart.prototype.initParam=function(setting){
	this.obj=setting.obj;
	this.ymin=setting.ymin||this.getMinData(setting.data);
	this.ymax=setting.ymax||this.getMaxData(setting.data);
	this.count=setting.count||3;
	this.color=['#14be46','#f74a27'];
	this.data=setting.data;
	this.xaxis=setting.xaxis;
	this.legend=setting.legend;
	this.ytxt=setting.ytxt||'万';
	this.unit=setting.unit||'元/平';
	this.h=setting.obj[0].scrollHeight-64*window.DPR;
	this.autoResize=true;
}

jwLineChart.prototype.initRender=function(){
	
	var _this=this;
	var ymax=this.ymax;
	var ymin=this.ymin;
	var count=this.count;
	var r=(ymax-ymin)/count.toFixed(1);
	var chart=['<ul class="yaxis">'];
	for(var i=0;i<=count;i++){
		var val=(i==count)?ymax:ymin+r*i;
		var bot=(100*i/count).toFixed(2);
		chart.push('<li style="bottom:'+bot+'%">'+(val/10000).toFixed(1)+'万</li>');
	}
	chart.push('</ul><div class="scroll"><div class="databox"><ul class="chart_data">');
	var dotsarr=this.creatDots(this.data);
	var alldotslen=dotsarr.length;
	var onelinelen=this.xaxis.length;
	for(var d=0;d<onelinelen;d++){
		var ss='';
		var r=0;
		while(d+onelinelen*r<alldotslen){
			ss+=dotsarr[d+onelinelen*r];
			r++;
		}
		chart.push('<li class="chart_item">'+ss+'</li>');
	}
	chart.push('</div></ul><div class="xtit"><ul>');
	for(var k=0;k<this.xaxis.length;k++){
		chart.push('<li class="x_item">'+this.xaxis[k]+'</li>');
	}
	chart.push('</ul></div></div><div class="signbox">');
	for(var j=0;j<this.legend.length;j++){
		chart.push('<span class="sign-item"><i style="background-color:'+this.color[j%2]+'"></i><span>'+this.legend[j]+'</span></span>');
	}
	chart.push('</div>');
	this.obj.append(chart.join(''));
	this.scroll_left(this.obj.find(".scroll")[0].scrollWidth);
	this.obj.find(".chart_item").on("click",function(){
		$(this).addClass("choosed").siblings("li").removeClass("choosed");
		_this.showInfo($(this));
	});
	$(document).on('click',function(e){
		var _tar=$(e.target);
		if(!_tar.is(".line-chart")&&_tar.closest(".line-chart").length<1){
			_this.obj.find("li.choosed").removeClass("choosed");
			_this.obj.find(".tip").length>0&&_this.obj.find(".tip").remove();
		}
	});
	_this.autoResize&&window.addEventListener("onorientationchange" in window ? "orientationchange" : "resize", function() {
		_this.resize();
	},false);
}

jwLineChart.prototype.scroll_left=function(w){
	this.obj.find(".scroll")[0].scrollLeft=w;
}

jwLineChart.prototype.update=function(){
	this.erasure();
	this.initRender();
}

jwLineChart.prototype.resize=function(){
	var _this=this;
	clearInterval();
    setTimeout(function() {
        _this.update();
    }, 1e3 / 60)
}

/*重绘*/
jwLineChart.prototype.rewrite=function(setting){
	this.erasure();
	this.initParam(setting);
	this.initRender();
}

/*擦除*/
jwLineChart.prototype.erasure=function(){
	this.obj.empty();
}

/*返回所有数据中最大值*/
jwLineChart.prototype.getMaxData=function(data){
	var itemMax=[];
	for(var i=0;i<data.length;i++){
		var v=Math.max.apply(null,data[i]);
		itemMax.push(v);
	}
	return Math.max.apply(null,itemMax);
}

/*返回所有数据中最小值*/
jwLineChart.prototype.getMinData=function(data){
	var itemMax=[];
	for(var i=0;i<data.length;i++){
		var v=Math.min.apply(null,data[i]);
		itemMax.push(v);
	}
	return Math.min.apply(null,itemMax);
}

/*返回所有的点线*/
jwLineChart.prototype.creatDots=function(arr){
	var dots=[];
	var scrollcon_w=document.documentElement.scrollWidth-75*window.DPR;
	var itemGap=2*scrollcon_w/this.xaxis.length;
	var itVal=this.ymax-this.ymin;
	for(var n=0;n<arr.length;n++){
		if(arr[n]==null) continue;
		for(var i=0;i<arr[n].length;i++){
			var bot=(arr[n][i]-this.ymin)*this.h/itVal;
			if(i+1==arr[n].length){
				dots.push('<span class="dot" data-info="'+this.legend[n]+':'+arr[n][i]+this.unit+'" data-record="'+bot+'" style="background-color:'+this.color[n]+';bottom:'+bot+'px;"></span>');
			}else{
				var hDiff=(arr[n][i+1]-arr[n][i])*this.h/itVal;
				var rotate=-Math.atan(hDiff/itemGap)*180/Math.PI;
				var ww=Math.sqrt(hDiff*hDiff+itemGap*itemGap);
				dots.push('<span class="dot" data-info="'+this.legend[n]+':'+arr[n][i]+this.unit+'" data-record="'+bot+'" style="background-color:'+this.color[n]+';bottom:'+bot+'px;"><span class="line" style="background-color:'+this.color[n]+';width:'+ww+'px;-webkit-transform: rotate('+rotate+'deg);transform: rotate('+rotate+'deg);"></span></span>');
			}
		}
	}
	return dots;
}

/*信息提示框*/
jwLineChart.prototype.showInfo=function(item){
	var obj=this.obj;
	var tip=obj.find(".tip");
	var n=item.index();
	var s="";
	var botarr=[];
	for(var i=0;i<item.find(".dot").length;i++){
		var info=item.find(".dot").eq(i).data("info").split(":");
		s+='<span><em>'+info[0]+'：</em>'+(info[1]=="0"+this.unit?"暂无数据":info[1])+'</span>';
		botarr.push(item.find(".dot").eq(i).data("record"));
	}
	if(tip.length>0){
		tip.html(s);
	}else{
		tip=$('<div class="tip">'+s+'</div>').appendTo(this.obj);
	}
	var w=tip.width(),h=tip.height();
	var b=Math.max.apply(null,botarr)-h+52*window.DPR;
	var l=this.obj.find(".chart_data")[0].scrollWidth*(n+0.5)/this.obj.find(".chart_item").length-this.obj.find(".scroll")[0].scrollLeft+35*window.DPR-0.5*w;
	b=b<0?0:b;
	l=l<35*window.DPR?35*window.DPR:(l>(this.obj[0].scrollWidth-w)?this.obj[0].scrollWidth-w:l);
	tip.css({"left":l+"px","bottom":b+"px"});
}

/**
 * 是否外链访问
 */
function isExternalLinks(){
	var referer = document.referrer;
	return !(referer && /^http:\/\/([a-zA-Z]+)\.jiwu\.com/.test(referer));
}

/**
 * 返回上一步
 * */
function goBackStep(obj, backUrl) {
	if(!isEmpty($(obj).attr("onclick"))){
		return;
	}
	var href = $(obj).attr("href");
	if(!isEmpty(href) && href != "javascript:;"){
		window.location.href = href;
		return;
	}
	window.history.go(-1);
    /*if(!isExternalLinks()) {
        window.history.go(-1);
    }else {
    	if (typeof backUrl != 'undefined') {
			window.location.href = backUrl;
			return;
		}
    	var test = window.location.href;
    	if(test.indexOf("/news/")>=0||test.indexOf("/loupan/")>=0||test.indexOf("/zhinan/")>=0||test.indexOf("/esf/")>=0||test.indexOf("/wenda/")>=0||test.indexOf("/info/")>=0||test.indexOf("/fangjia/")>=0){
    		var domin = $("#domain").val();
    		window.location.href = "http://m.jiwu.com/"+domin;
    	}else{
    		window.location.href = "http://m.jiwu.com";
    	}
    }*/
	// if (window.history.length > 1) {
	// 	window.history.go(-1);
     //    return false;
	// }else{
	// 	window.location = "/";
	// }
}

/**
 * 验证是否空值
 * */
function isEmpty(val) {
    var v = false;
    if (val == '' || val == 'null' || val == null || val == 'undefined'
        || val == undefined) {
        v = true;
    }
    return v;
}

//弹出层禁用touchmove事件
$(".pop-mask").on("touchmove", function (event) {
	event.preventDefault();
});

/*信息提示框,调用方式如：poptip("修改成功");*/
var poptip=function(txt,delay){
	var delay=delay||3000;
	var html='<div class="poptips"><p>'+txt+'</p></div>';
	$("body").append(html);
	setTimeout(function(){
		$(".poptips").remove();
	},delay);
}
/*等待toast提示框,调用方式如：poploading();*/
var poploading=function(delay){
	var delay=delay||3000;
	$("body").append("<div class='poploading'></div>");
	setTimeout(function(){
		$(".poploading").remove();
	},delay);
}

function telPhone(centerph,phone){
	var html='<div class="pop-content-main">';
	    html+='<i class="close-pop" onclick="_close()">×</i>';
	    html+='<div class="text-center"><p class="subtit">电话拨通后，请拨打分机号<br/><br/><span class="f60">'+phone+'</span></p></div>';
	    html+='<a href="javascript:;" class="default-btn mt10" onclick="_call('+centerph+')">立即拨打</a>';
	    html+='</div>';
	popup.dialog(html);
}

var popup={
	/*带有2个参数，分别为提示文本、延迟关闭（默认为3秒）*/
	tip:function(msg,delay){
		var delay=delay||3000;
		var html='<div class="pop-wrap pop-tip">'+
					'<div class="pop-box">'+
						'<div class="pop-content">'+
							'<p>'+msg+'</p>'+
						'</div>'+
					'</div>'+
				  '</div>';
		$("body").append(html);
		setTimeout(function(){$('.pop-wrap').remove();},delay);
	},
	dialog:function(content){
		var html='<div class="pop-wrap">'+
					'<div class="mask" style="display:block"></div>'+
					'<div class="pop-box">'+
						'<div class="pop-content">'+content+
						'</div>'+
					'</div>'+
				  '</div>';
		$("body").append(html);
	},close:function(){
		$('.pop-wrap').remove();
	}
};

/*自定义弹框，options为配置参数*/
var confirmPop=function(options){
	var defaults={
		id:'box'+Math.round(Math.random() * 10000),
		cls:'',
		title:'标题',
		subtitle:'副标题',
		text:'',
		contentHTML:'',
		okVal:'确定',
		okFunc:null,
		cancelVal:'取消',
		cancelFunc:null,
		closeFunc:null,
		callback:null
	};
	var settings=$.extend(defaults,options);
	var mcls=settings.cls?(' '+settings.cls):'';
	var html='<div class="pop-wrap'+mcls+'" id="'+settings.id+'"><div class="mask" style="display:block"></div><div class="pop-box"><div class="pop-content"><div class="pop-content-main"><i class="close-pop">×</i>';
	if(settings.title!=''){
		html+='<h3 class="tit">'+settings.title+'</h3>';
	}
	if(settings.subtitle!=''){
		html+='<p class="stats">'+settings.subtitle+'</p>';
	}
	if(settings.text!=''){
		html+='<div class="text">'+settings.text+'</div>';
	}
	if(settings.contentHTML!=''){
		html+=settings.contentHTML;
	}
	html+='<div class="btnwrap">';
	if(settings.cancelVal!=''){
		html+='<a href="javascript:;" class="btn btn-gray cancel">'+settings.cancelVal+'</a>';
	}
	if(settings.okVal!=''){
		html+='<a href="javascript:;" class="btn btn-green ok">'+settings.okVal+'</a>';
	}
	html+='</div></div></div></div></div>';
	$("body").append(html);
	settings.okFunc&&$('#'+settings.id).find(".ok").on("click",function(){
		eval(settings.okFunc());
	});
	settings.cancelFunc&&$('#'+settings.id).find(".cancel").on("click",function(){
		eval(settings.cancelFunc());
	});
	settings.closeFunc&&$('#'+settings.id).find(".close-pop").on("click",function(){
		eval(settings.closeFunc());
	});
	settings.callback&&eval(settings.callback());
	return $('#'+settings.id);//返回弹框
}

/**
 * 下拉选择列表函数
 * updateList方法参数说明：
 *  a.name:弹出框标题
 *  b.arr:弹出框初始化列表数组
 *  c.check_key:初始化时选中项的键值，无选中项则为-1
 *  callback:点击列表项后回调函数
 */
function buildBottomLayer(){
	this.initLayer();
}

buildBottomLayer.prototype.initLayer=function(){
	var domArr=['<div class="bottom_layer"><div class="layer_title"><span class="close">取消</span>','<p class="name"></p>','</div>','<div class="layer_con"><ul>','</ul></div></div>'];
	$("body").append(domArr.join('')).append("<div class='layer_mask'></div>");
}

buildBottomLayer.prototype.bindEvent=function(callback){
	var _this=this;
	$("body").off("click");
	$("body").on("click",".layer_title .close",function(){
		$(".bottom_layer,.layer_mask").css("display","none");
		$("body").removeClass("noscroll");
	});
	$("body").on("click",".layer_con li",function(){
		var txt=$(this).text(),_key=$(this).data("key"),_id=$(this).data("id"),_domain=$(this).data("dm");
		$(this).addClass("on").siblings().removeClass("on");
		$(".bottom_layer,.layer_mask").css("display","none");
		$("body").removeClass("noscroll");
		if(!!callback){
			callback(_key,txt,_id,_domain);
		}
	});
}

buildBottomLayer.prototype.updateList=function(name,arr,check_key,callback){
	var str='';
	for(var i=0;i<arr.length;i++){
		var cls=(i==check_key)?'on':'';
		str+='<li data-key='+i+' data-id='+arr[i].id+' data-dm='+arr[i].domain+' class='+cls+'>'+arr[i].val+'</li>';
	}
	!!name&&$(".layer_title .name").text(name);
	$(".layer_con ul").html(str);
    $(".bottom_layer,.layer_mask").css("display","block");
	$("body").addClass("noscroll");
	this.bindEvent(callback);
    $(".layer_con").scrollTop(0);
}

/**
 * 账号密码验证登录
 */
function ajaxLogin(subit)
{
    var usname = $.trim($("#username").val());
    var psw =$("#password").val();
    if(usname == "请输入用户名"){
        usname = "";
    }
    if(psw == "您的密码"){
        psw = "";
    }
    if(usname.length<=0)
    {
        poptip("用户名不能为空！");
        return;
    }
    if(psw.length<=0)
    {
        poptip("密码不能为空！");
        return;
    }
    
    if(subit != 1){
    	SetCookie("cjye",subit,1);
	}
    SetCookie("zhanghaomima",subit,24*60*6);
    $.post("/user!ajaxLogin.action",{"username":usname,"password":psw},function(data){
        if(data==0){
            // removeDialog();
            var joinId = GetQueryString("joinId");
            var acid = GetQueryString("acid");
            $("#joinId").val(joinId);
            $("#acid").val(acid);
            $("#password-1").val(psw);
            $("#username-1").val(usname);
            $("#myForm").submit();
        }else{
            poptip("用户名或密码不正确！");
        }
    });
}

function SetCookie(name,value, days){
    var exp  = new Date();
    exp.setTime(exp.getTime() + days*10*1000);
    document.cookie = name + "="+ escape(value)+ ";expires=" + exp.toGMTString()+";path=/;domain=.jiwu.com";
}

/**
 * 手机验证码登录
 * @returns {boolean}
 */
function login(issubit){
    var username = $.trim($("#tel-username").val());
    var code=$("#code").val();
    var subit = issubit
    if (!username.match(/^(((1[1-9]{1}[0-9]{1})|(14[0-9]{1})|(17[0]{1})|(15[0-3]{1})|(15[5-9]{1})|(18[0-9]{1}))+\d{8})$/)) {
        poptip("手机格式不正确,请重新填写！");
        return false;
    }
    if (code.length<=0){
        poptip("验证码不能为空！");
        return false;
    }
    
    if(subit != 1){
    	SetCookie("cjye",subit,1);
	}
    
    $.post("/user!checkCode.action",{"mobile":$("#tel-username").val(),'code':$('#code').val()},function(data){
        if(data==0){
        	var sid = GetQueryString("sid");
        	var joinId = GetQueryString("joinId");
        	var acid = GetQueryString("acid");
            $("#joinId").val(joinId);
            $("#acid").val(acid);
            $("#username-1").val($("#tel-username").val());
            $("#myForm").submit();

            // if(sid != null && sid != ""){
        		// $.post("/user!grzx.action",{"username":$("#tel-username").val(),'code':$('#code').val(),'sid':sid},function (data) {
			// 		console.log(data);
             //    })
			// }else if(joinId != null && joinId != ""){
             //    $.post("/user!grzx.action",{"username":$("#tel-username").val(),'code':$('#code').val(),'joinId':joinId},function (data) {
            //
             //    })
			// }else if(acid != null && acid != ""){
             //    $.post("/user!grzx.action",{"username":$("#tel-username").val(),'code':$('#code').val(),'acid':acid},function (data) {
            //
             //    })
			// }else{
             //    $.post("/user!grzx.action",{"username":$("#tel-username").val(),'code':$('#code').val()},function (data) {
            //
             //    })
			// }
            //$("#form1").submit();
			//处理手机登录逻辑
        }else if(data==3){
            poptip("验证码错误！");
        }else{
            poptip("服务器忙！");
        }
    });
}

//获取地址栏参数
function GetQueryString(name) {
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if(r!=null)return  unescape(r[2]); return null;
}

/**
 * 发送手机验证码
 * @returns {boolean}
 */
function sendMsg() {
    var username = $.trim($("#tel-username").val());
    if (!username.match(/^(((1[1-9]{1}[0-9]{1})|(14[0-9]{1})|(17[0]{1})|(15[0-3]{1})|(15[5-9]{1})|(18[0-9]{1}))+\d{8})$/)) {
        poptip("手机格式不正确,请重新填写！");
        return false;
    }
    var param = {username:username};
    $.post('/user!sendMobileLogin.action', param, function(data){
        if(data.result == 1){
            poptip("验证码已发送");
        }else if(data.result == -1){
            poptip("手机号不正确");
        }else if(data.result == -4){
            poptip("该账号不存在,请先注册再登录 ");
        }else{
            poptip("验证码发送失败！");
        }
    }, 'json');
    return true;
}
//手机验证
function isMobilePhone(obj){
    var partten = /^0?1[23456789]\d{9}$/;
    if(partten.test(obj)){
        return true;
    }else{
        return false;
    }
}

/**
 * 获取用户uid
 * @returns {*}
 */
function getCookieKey(){
    var uid = getCookie("nid");
    if(uid==null){
        var name = "cookie_key";
        uid = getCookie(name);
        if(uid==null){
            var value = "";
            for(var i=0;i<8;i++)
                value += Math.floor(Math.random()*10);
            var exp = new Date();
            exp.setTime(exp.getTime() + 3650*24*60*60*1000);
            document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString()+";path=/"+";domain=.jiwu.com";
            uid = value;
        }
    }
    return uid;
}
function getCookie(name){
    var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
    if(arr != null) return unescape(arr[2]); return null;
}


//手机验证
function isMobilePhone(obj){
    var partten = /^0?1[3456789]\d{9}$/;
    if(partten.test(obj)){
        return true;
    }else{
        return false;
    }
}

/**
 * v6.0免费通话公用方法
 */
function freeCallNew() {
    var phone = $("#phone").val().replace(/-/g, "");
    window.location.href = "tel:" + phone;
}
/**
 * 获得报名来源
 */
function getApplySource() {
	var ref = window.location.href;
	var source = "";
	var result = ref.match("hmsr=([^&]+)");
	if(result) {
		source = result[1];
	}
	return source;
}
//替换电话
function replacePhone(hmsr,bid){
	if(hmsr!=null){
		var phone = ""
		$.post("/mbuild!semPhone.action",{"bid":bid,"hmsr":hmsr},function(data) {
			if(data.data!="" && data.data!=null){
				phone=data.data;
				if($("#haha").length>0){
					$("#haha").html("<span id='dgphone'>" + phone.replace(",","转") + "</span>")
					$("#phone").val(phone)
				}
				if($("#centerPhone").length>0){
					$("#centerPhone").html( phone.replace(",","转"))
					$("#phone").val(phone)
				}
				if($("#dgphone").length>0){
					$("#dgphone").html("<i>"+ phone.replace(",","转")+"</i>")
					$("#phone").val(phone)
				}
			}
		});
	}
}
//记录客户登记日志表
//mobile 手机号
//triggerPage 触发页面名称
//mobile 触发按钮名称
//jwChannel 频道名称
//buildId 楼盘id
function recordUserlog(mobile,triggerButton,buildingId) {
	var hmsr= getCookie("_hmsr")
	if(mobile!=null){
		 var bid = 0;
		 if($("#buildingId").val()){
			 bid = $("#buildingId").val();
		 }
		 if(buildingId){
			 bid = buildingId
		 }
		 if($("#currentBid").val()){
			 bid = $("#currentBid").val();
		 }
		 if($("#bid").val()) {
		     bid = $("#bid").val();
		 }
		 $.post("/userLog!recordUserlog.action", {
		         "mobile":mobile,
		         "bid":bid,
		         "triggerPage":$("#triggerPage").val(),
		         "triggerButton":triggerButton,
		         "jwChannel":$("#jwChannel").val()
		     },function(data){
		 });
		 $.post("/channelCount!recordChannelCount.action", {
	         "mobile":mobile,
	         "bid":bid,
	         "triggerPage":$("#triggerPage").val(),
	         "triggerButton":triggerButton,
	         "jwChannel":$("#jwChannel").val()
	     },function(data){
	 });
	}
}

//设置当前页面导航名称
function setCurNavName(){
	var href = window.location.href;
	var curNavName = "详情";
	if(/\/([a-zA-Z]+)\/detail\/(\d+)\.html/.test(href)
			|| /\/([a-zA-Z]+)\/xq_([a-zA-Z]+)\/(\d+)\.html/.test(href)){
		curNavName = "详情";
	} else if(/\/([a-zA-Z]+)\/tu\/list-loupan(\d+)\.html/.test(href)
			|| /\/([a-zA-Z]+)\/tu\/list-loupan(\d+)-baid(\d+)\.html/.test(href)){
		curNavName = "相册";
	} else if(/\/([a-zA-Z]+)\/news\/list-loupan(\d+)\.html/.test(href)
			|| /\/([a-zA-Z]+)\/info\/(\d+)\.html&bid=(\d+)/.test(href)){
		curNavName = "动态";
	} else if(/\/([a-zA-Z]+)\/jiaotong\/(\d+)\.html/.test(href)){
		curNavName = "周边";
	} else if(/\/([a-zA-Z]+)\/fangjia\/(\d+)\.html/.test(href)){
		curNavName = "房价";
	}
	$("#curNavName").html(curNavName);
}

//自动匹配当前页是否属于导航的一项，高亮
function navHighlight(){
	var href = window.location.href;
	var $a =$("#float-nav-new a");
	$a.not(".home-menu").removeAttr("class")
	$a.each(function(){
		var html = $(this).html();
		if((/\/([a-zA-Z]+)\/news\/list-loupan(\d+)\.html/.test(href)
				|| /\/([a-zA-Z]+)\/info\/(\d+)\.html&bid=(\d+)/.test(href))
				&& html == "动态"){
			$(this).attr("class", "on");
			return false;
		} else if(/\/([a-zA-Z]+)\/fangjia\/(\d+)\.html/.test(href) && html == "房价"){
			$(this).attr("class", "on");
			return false;
		} else if(/\/([a-zA-Z]+)\/jiaotong\/(\d+)\.html/.test(href) && html == "周边"){
			$(this).attr("class", "on");
			return false;
		}
	});
}
