!function(t){function e(){var t=document.createElement("div"),o={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(var e in o){if(void 0!==t.style[e]){return{end:o[e]}}}return !1}function i(o){return this.each(function(){var e=t(this),i=e.data("jqDrag"),s=t.extend({},d.defaults,e.data(),"object"==typeof o&&o);i||(e.data("jqDrag",i=new d(this,s)),i.init()),"string"==typeof o&&i[o]()})}function s(o,e){return this.each(function(){var i=t(this),s=i.data("jqModal"),n=t.extend({},r.defaults,i.data(),"object"==typeof o&&o);s?"string"==typeof o?s[o](e):s.toggle():(i.data("jqModal",s=new r(this,n)),s.init(),s.show())})}t.fn.emulateTransitionEnd=function(o){var e=!1,i=this;t(this).one("bsTransitionEnd",function(){e=!0});var s=function(){e||t(i).trigger(t.support.transition.end)};return setTimeout(s,o),this},t(function(){t.support.transition=e(),t.support.transition&&(t.event.special.bsTransitionEnd={bindType:t.support.transition.end,delegateType:t.support.transition.end,handle:function(o){return t(o.target).is(this)?o.handleObj.handler.apply(this,arguments):void 0}})});var n=!-[1,]&&!window.XMLHttpRequest,a=function(o,e,i){var s=t(i?e||window:"body"),n=t(window).scrollTop(),a=o.outerWidth(),d=o.outerHeight(),r=s.width(),l=s.height();return{minL:a>r?r-a:0,minT:d>l?l-d:0,maxL:a>r?0:s.width()-a,maxT:d>l?0:s.height()-d,st:n,h:d}},d=function(o,e){this.o=t.extend({},d.defaults,e),this.$self=t(o),this.$handle=this.o.handle&&this.$self.find(this.o.handle)||this.$self};d.defaults={handle:"",fixed:1,attachment:""},d.prototype.init=function(){var o=this.o,e=this.$self.css("animation-fill-mode","backwards"),i=this.$handle;i.css({cursor:"move"}).on("selectstart",function(){return !1}).on("mousedown",function(t){return e.css({opacity:o.opacity,zIndex:10}).trigger("_mousemove",[t.pageX,t.pageY]),!1}).on("_mousemove",function(i,s,d){var r,l,c=a(e,o.attachment,o.fixed),h=e.position(),f=h.left-s,u=h.top-d;e.trigger("dragStart",[c]),t(document).on("mousemove",function(t){t.preventDefault();var i=f+t.pageX,s=u+t.pageY;r=i<c.minL?c.minL:i>c.maxL?c.maxL:i,l=s<c.minT?c.minT:s>c.maxT?c.maxT:s,e.css({left:r,top:l+(n&&o.fixed&&c.st||0)}).trigger("drag",[r,l])}).on("mouseup",function(){t(this).off("mousemove"),e.trigger("dragEnd",[r,l])})})},t.fn.jqDrag=i;var r=function(o,e){this.o=e,this.Z=parseInt((new Date).getTime()/1000),this.$self=t(o),this.isShown=!1};r.defaults={mclass:"modal",head:"",foot:"",remote:"",fixed:1,overlay:0.3,drag:1,lock:0,timeout:0,css:{},headcss:{},bodycss:{},footcss:{},animate:"bounceInDown"},r.prototype={init:function(){var o=this,e=o.o,i=(e.target,'<div class="jqModal animated">    <div class="m-content m-'+e.mclass+'">        <div class="m-head">'+e.head+'</div>        <div class="m-body"></div>        <div class="m-foot">'+e.foot+'</div>        <a class="m-close" data-close="1" title="信息" href="#"></a>    </div></div>');e.overlay&&(o.$overlay=t('<div class="m-overlay"></div>').appendTo("body").css({opacity:e.overlay,zIndex:o.Z}).on("click",!e.lock&&t.proxy(o.hide,o)||t.noop)),o.$box=t(i).appendTo("body").css(t.extend({},e.css,{zIndex:o.Z,position:e.fixed&&!n&&"fixed"||"absolute"})).on("click","[data-close]",t.proxy(o.hide,o)),o.$hd=o.$box.find(".m-head").css(t.extend({},e.headcss,!e.head&&{display:"none"})),o.$bd=o.$box.find(".m-body").css(e.bodycss),o.$ft=o.$box.find(".m-foot").css(t.extend({},e.footcss,!e.foot&&{display:"none"})),n&&t("select").css("visibility","hidden"),o.$self.is("iframe")?o.$self.attr({scrolling:"no",allowtransparency:!0,frameborder:0,src:e.remote}).appendTo(this.$bd).load(function(){o.setPos(1)}):o.$bd.append(o.$self.css("display","block")),e.drag&&(o.$drag=t('<div class="jqModal-drag"></div>').insertAfter(o.$box),o.$hd.on("mousedown",function(t){o.$drag.css("display","block").trigger("_mousemove",[t.pageX,t.pageY]),e.drag>1&&o.$drag.addClass("jqModal-drag-style")}),t(document).on("mouseup",function(){o.$drag.css("display","none"),e.drag>1&&o.$drag.removeClass("jqModal-drag-style")}),o.$drag.on(e.drag>1?"dragEnd":"drag",function(t,e,i){o.$box.css({left:e,top:i})}),n&&o.$drag.on("dragEnd",function(t,e,i){o.fixedT=i})),this.setPos(),t(document).on("keydown.modal",function(t){return 27==t.which&&o.hide(),!0}),e.fixed&&t(window).on("resize",t.proxy(o.setPos,o))},show:function(){var o=this;o.isShown||(o.$self.trigger("showFun"),o.$overlay&&o.$overlay.css("display","block"),o.$box.css("display","block"),t.support.transition&&o.$box.addClass(o.o.animate),o.$self.trigger("shownFun"),o.isShown=!0,this.o.timeout&&(clearTimeout(this.t),this.t=setTimeout(t.proxy(this.hide,this),this.o.timeout)))},hideModal:function(){this.$box.removeClass(this.o.animate+"H").hide(),this.$overlay&&this.$overlay.hide(),this.$self.trigger("hidenFun")},hide:function(o){return this.$self.trigger("hideFun"),setTimeout(t.proxy(function(){this.$box.removeClass(this.o.animate).addClass(this.o.animate+"H"),t.support.transition&&this.$box.one("bsTransitionEnd",t.proxy(this.hideModal,this)).emulateTransitionEnd(500)||this.hideModal()
},this),o||0),n&&(t("select").css("visibility","visible"),t(window).off("scroll.modal")),this.isShown=!1,!1},toggle:function(t){return this.isShown?this.hide(t):this.show()},setSize:function(){this.$self.is("iframe")&&this.$self.add(this.$bd).height(this.$self.css("background","none").contents().find("body").height())},setPos:function(e){e&&this.setSize();var s=this;if(o=s.o,R=a(s.$box,null,o.fixed),s.fixedT=o.css.bottom>=0?R.maxT-o.css.bottom:o.css.top||(t(window).height()-R.h)/2,s.$box.css({left:o.css.right>=0?"auto":o.css.left||R.maxL/2,top:s.fixedT+((n||!o.fixed)&&R.st)}),n&&o.fixed){var d=t(window);d.on("scroll.modal",function(){s.$box.css({top:s.fixedT+d.scrollTop()})})}o.drag&&(s.$drag[0].style.cssText=s.$box[0].style.cssText,s.$drag.css({width:s.$box.width()-6,height:s.$box.height()-6}),i.call(s.$drag,{fixed:s.o.fixed}))}};var l=t.fn.jqModal;t.fn.jqModal=s,t.fn.jqModal.Constructor=r,t.fn.jqModal.noConflict=function(){return t.fn.jqModal=l,this},t('<link rel="stylesheet">').appendTo("head").attr("href",("undefined"!=typeof tplurl?tplurl:"")+"css/jqmodal.css"),t(document).on("click",".btn-jqModal",function(o){var e=t(this),i=e.data("target")||e.attr("href");if("string"==typeof i){var n=0==i.indexOf("http"),a=t(n&&'<iframe class="jqiframe"/>'||i.replace(/.*(?=#[^\s]+$)/,""));e.data("target",a);var d=t.extend({remote:n&&i},a.data(),e.data())}else{var a=i,d="toggle"}e.is("a")&&o.preventDefault(),s.call(a,d)}),t.jqModal={tip:function(){var o=t(".jqtip"),e=o[0]&&"show"||{mclass:"tip",animate:"shake",css:{top:100},drag:0,lock:1,timeout:arguments[2]||1500};o[0]||(o=t('<div class="jqtip"></div>')),s.call(o.html('<i class="ico ico-'+arguments[1]+'"></i>'+arguments[0]),e,arguments[2]||1500)},alert:function(o){var e=t(".jqalert"),o=e[0]&&"show"||{head:"信息",css:{width:300},foot:'<button data-close="1" class="ok">确定</button>'};e[0]||(e=t('<div class="jqalert"></div>')),s.call(e.html('<i class="ico ico-info"></i>'+o),o)},lay:function(o){var e=o;t(".jqlay").length?("hide"!=o&&t(".jqlay").html(e),t(".jqlay").jqModal(o)):t('<div class="jqlay">'+e+"</div>").appendTo("body").jqModal()},confirm:function(o,e){t(".jqAlert").length?"show"==o||"hide"==o||"toggle"==o?t(".jqAlert").jqModal(o):(t(".jqAlert").data("jqModal").$content.html(e),t(".jqAlert").data("jqModal").show()):s.call(t('<div class="jqAlert">'+e+"</div>").appendTo("body"),{title:o,overlay:0})}}}(jQuery);