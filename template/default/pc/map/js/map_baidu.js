var msgwindow = 0;

var zhoubianwindow = 0;

var positions = new Array("0", "-20", "-10", "-30");

var backgroundColors = new Array("#64b400", "#fc5172", "#ff9600", "#9e9e9e");

var borders = new Array("#006600", "#CC0066", "#FF6600", "#4B4B4B");

var optionsList = new Array("周边楼盘", "公交", "餐饮", "银行", "学校", "医院", "购物,超市");

var select_index = 0;

var findbuildarr='';

var searchlocal='';

var countFilterStr="";//记录所有的条件

var searchtypeStr = "-1";//通过searchtype ，-1：显示区域数据，-2：显示片区数据

var subwaysid;//地铁 数据ID

var subwayparentid;//地铁 数据上级ID

var andZoom = 11;//缩放级别，控制所有的缩放级别

var area_Id=0;//区域ID，记录整个页面区域ID

var price_qc = ''; 

var select_point = null;  

var maps ;

var selectSubType;//地铁选中类型，A为选中地铁线路，B为选中地铁站点

var bnames = "";

var subwayXianlu="Y";

var sellat;

var sellng;

var buloading = false;

var buloadtime =0;



//初始化地图 

var map=new BMap.Map("jw-map",{minZoom:10,maxZoom:18,enableMapClick: false});

map.enableContinuousZoom(); // 开启连续缩放效果 



map.getBoundsJiwu = function() {

	var bounds = map.getBounds();	

	bounds.Ie = bounds.Ke || bounds.Ie;

	bounds.Je = bounds.Le || bounds.De;

	

	bounds.De = bounds.Ke || bounds.Ie;

	bounds.Ee =bounds.Le || bounds.De;

	return bounds;

}



var dituObj = {

		area_filterId:"",//区域条件

		area_type:""//是否选中区域 

	};//定义对象





//模拟下拉框

;(function(obj){

	$.fn.modeSelect=function(options){

		var defaluts={};

		var settings=$.extend(defaluts,options);

		return this.each(function(){

			var $txt=$(this).find(".sel-text"),$list=$(this).find(".sel-list");

			$(this).hover(function(){

				$list.css("display","block");

			},function(){

				$list.css("display","none");

			});

			$list.find("a").bind("click",function(){

				

				$(this).closest("ul").find("a").removeClass("on");

				$(this).addClass("on");

				$txt.text($(this).html());

				$list.css("display","none");

			})

		});

	};

	obj.modeSelect();

})($(".mode-select"));



$(function(){

	 

	buildAssist(); 

	

	 var height = document.documentElement.clientHeight;

	 var width = document.documentElement.clientWidth;

	 document.getElementById('ditumain').style.height = (height-5)+'px';

	 document.getElementById('jw-map').style.height = (height-5)+'px'; 

	 $("#right_map_content").height(height-270);  

	   

	   

	 initDate();//初始化数据

	  

	 function initDate()

	 {

		 //如果地铁数据为空，

		 if(subwaysize == 0 || areasize == 0)

		 {

			/* $("#keleyidiv").width($("#kel"+"eyidiv").width() - 50);*/

			 $("#searchDiv").width(424);     

			 $("#areaMap").css("border","0px");

			 $("#subwayMap").css("border","0px");

		 } 

	 }

	

	//$(".side-right li").children().

	

	$(".area-search .side-right li").each(function(index){

		if(index==1 || index==2 || index==3 || index==0)

		{ 

			$(this).show();

		}

	});

	 

	

	$(".subway-search .side-right li").each(function(index){

		if(index==1 || index==0) 

		{ 

			$(this).show();   

		}    

	});

	



	

	

	//区域找房

	$(".area-search").hover(function(){

		$(this).find(".subbox").css("display","block");

	},function(){

		$(this).find(".subbox").css("display","none");

		

		//默认显示地铁线路数据

		$(".subway-search .side-right li").each(function(index){

			if(index==1 || index==0) 

			{ 

				$(this).show();   

			}    

		}); 

	});

	 

	//地铁找房

	$(".subway-search").hover(function(){

		$(this).find(".subbox").css("display","block");

	},function(){

		$(this).find(".subbox").css("display","none");

		

		//默认显示区域数据

		$(".area-search .side-right li").each(function(index){

			if(index==1 || index==2 || index==3 || index==0)

			{ 

				$(this).show();

			}

		});

		

	});

	 

	$(".subbox .side-left li").not(".lab").mouseover(function(){

		

		$(this).addClass("cur").siblings("li").removeClass("cur");

		$(".side-right").show(); 



		//动态显示div

		$(".subbox .side-right li").css("display","none");



		

		var str = this.id.split("_"); 

		if(str != null && str.length >0)

		{

			if(this.id.indexOf("subway_") > -1)

			{

				$("#subwayS_"+str[1]).show();      

				$("#clearfixsubway_"+str[1]).show();   

			}else{

				$("#A_"+str[0]).show(); 

				$("#clearfix_"+str[0]).show(); 

				if(str != null && str.length >=1 && str[1] != null && $("#"+str[1]+"_") != null)

				{   

					var idStr = "A_"+str[1]; 

					$("#"+idStr).show();      

					$("#clearfix_"+str[1]).show();  

				} 

			}

		} 

		

	});



	

	

	$(".area-search .subbox .side-left li").on("click","a",function(){

		$(".area-search .subbox .side-right li").closest("ul").find("a").removeClass("on");

		var htmStr = $(this).html();

		if(htmStr.indexOf("全部") >-1)

		{

			htmStr ="区域找房";

		}

		$(".area-search .subbox .side-right li").closest(".subbox").siblings(".span-zf").text(htmStr);

		$(".area-search .subbox .side-right li").closest(".subbox").css("display","none");

		

		

	});   

	    

	$(".subway-search .subbox .side-left li").on("click","a",function(){

		$(".subway-search .subbox .side-right li").closest("ul").find("a").removeClass("on");

		

		var htmStr = $.trim($(this).html());

		if(htmStr.indexOf("全部") >-1)

		{

			htmStr ="地铁找房";

		}



		if(htmStr.length >5)

		{

			htmStr = htmStr.substr(0,5);

		}

		

		$(".subway-search .subbox .side-right li").closest(".subbox").siblings(".span-zf").text(htmStr);

		$(".subway-search .subbox .side-right li").closest(".subbox").css("display","none"); 

	});   

	

	

	

	$(".subbox .side-right li").on("click","a",function(){

		

		$(this).closest("ul").find("a").removeClass("on");

		$(this).addClass("on");

		//alert($(this).parent(".clearfix").attr("id"));  

		if($(this).parent(".clearfix").attr("id") != null && $(this).parent(".clearfix").attr("id").indexOf("clearfixsubway_") >-1)

		{ 

			$("#areaMap").text("区域找房"); 

		}else{

			$("#subwayMap").text("地铁找房"); 

		}

		

		var areaAndSubText = $.trim($(this).text());

		if(areaAndSubText.length>5) {

			$(this).closest(".subbox").siblings(".span-zf").text($(this).html()+"&nbsp;&nbsp;");

		}else{

			$(this).closest(".subbox").siblings(".span-zf").text($(this).html());

		}

		$(this).closest(".subbox").css("display","none");

	});

	



	//单价排序、关注度排序

	$("#dj-px,#gzd-px").click(function(){

		if($(this).hasClass("icon-asc")){

			$(this).addClass("icon-desc").removeClass("icon-asc");

			 

			//clickFilter(VALUE,typeId,id,TYPE)

			 

			if(this.id == "gzd-px")

			{

				clickFilter("-qo2","order_filter",'','');

			}

			if(this.id == "dj-px")  

			{

				clickFilter("-qh2","order_filter",'',''); 

			}

		}else{ 

			$(this).addClass("icon-asc").removeClass("icon-desc");

			

			if(this.id == "gzd-px") 

			{ 

				clickFilter("-qo1","order_filter",'','');

			}  

			if(this.id == "dj-px") 

			{

				clickFilter("-qh1","order_filter",'','');

			}

		}

	});



	//左侧楼盘列表收缩面板

	$("p.list-btn").bind("click",function(){

	

		if($(this).data("status")=="expand"){

			$(this).addClass("list-btn-fold").siblings().css("display","none");

		

			//地图平移

			map.panBy(-150,0,map.getCenter());   

			$(this).data("status","fold");  

		}else{

			$(this).removeClass("list-btn-fold").siblings().css("display","block");

			$(this).data("status","expand");

			//地图平移

			map.panBy(150,0,map.getCenter()); 

			

		}  

	});  

	

		

	/*********楼盘搜索框***********/

	var newhightlight =-1;

	var newoInputField;    //考虑到很多函数中都要使用

	//var newoPopDiv;        //因此采用全局变量的形式

	var newoconUl;

	var newtype = 0;//0搜索新盘，1搜索二手房

	function newinitVars(){

	    //初始化变量

	    newoInputField = $("#m_bname");

	    //newoPopDiv = $("#newpopup");

	    newoconUl = $("#m_newcon_ul");

	    /*    var chooseurl = $("#choosediv").attr("chooseurl");//判断所选的搜索类型

	    if(chooseurl == "esf"){//二手房

	    	newtype = 1;

	    }else if(chooseurl == "loupan"){//新房

	    	newtype = 0;

	    }else if(chooseurl == "wenda"){//问答

	    	newtype = 3; 

	    }*/ 

	}



	 



	//楼盘辅助提示status

	function buildAssist(){

		if($("#m_bname"))

		{

			//单击获取焦点后事件

			$("#m_bname").bind("click",newsolderworld);

			//输入内容事件

			$("#m_bname").bind("keyup",newfindcon); 

		} 

		if($("#m_newcon_ul").length>0)

		{

			document.onclick=newclearcon;

		}

	}

	//搜索框单击事件

	function newsolderworld(){		

	    if($.trim($("#m_bname").val())=="" || $.trim($("#m_bname").val())=="输入楼盘名找房")

	    { 

	        newinitVars();

	        if(newtype==0){	        	 

		        $.post("/map/search",{},function(data){		        	

		                var aResult= eval(data);		                 

		                if(aResult.length > 0){

		                	// $("#m_newcon_ul").show(); 

		                   // $("#m_newcon_ul").html(data);  

		            	    $('.search-inp-list').show();   		            	    

		        			$('.search-inp-list').css({'height':'109px','overflow-y':'scroll'});

		        		    for(var i=0;i<aResult.length;i++){

		        		        //将匹配的提示结果逐一显示给用户

		        		    	//$("#m_newcon_ul").append($(obj[i]));

		        		    	$("#m_newcon_ul").append($('<li ><a target="_blank"  href="'+aResult[i].url+'">'+aResult[i].name+'</a></li>')); 

		        		    }        		        			      

		                }

		        }); 

	        } 

	    }

	}

	function newfindcon(event){

		

	    newinitVars();     //初始化变量

	    if(newtype==0){//只有新房才有辅助提示

		    var myEvent = event || window.event;

		    var keycode = myEvent.keyCode;   //获取键盘键值

		    var huilist ="";

		

		    if ((keycode >= 65 && keycode <= 90) || keycode==8 || keycode == 46 || keycode==32 || (keycode>=48 && keycode<=57)) {

		        if($.trim(newoInputField.val()).length > 0 ){

		            //获取异步数据

		       	$.post("/map/search",{"bname":$("#m_bname").val(),"hui":huilist,"type": newtype},function(data){

		                    var aResult = eval(data);  

		                    if(aResult.length > 0){   

		                    	 

		                        newsetcon(aResult);    //显示服务器结果

		                    }

		                    else  

		                    {

		                        //clearcon();   //清除div中的内容

		                        //此处暂时不清除，如果没有查出任何记录，显示上次的记录

		                    }

		            });

		        }

		        else{

		            newclearcon(); //无输入时清除提示框（例如用户按del键）

		            newhightlight = -1

		        }

		      }else if(keycode==38||keycode==40){  //如果输入的是向上向下

		

		            if(keycode==38){

		            //向上

		

		              var autoNodes = newoconUl.find("li");

		

		               if (newhightlight != -1 ){

		                //把高亮节点恢复

		                autoNodes.eq(newhightlight).removeClass("mouseOver");

		                newhightlight--;

		               }else{

		            	   newhightlight = autoNodes.length - 1

		               }

		

		               if(newhightlight == -1){

		                //如果到顶 把高亮移动到最后

		                newhightlight = autoNodes.length - 1;

		               };

		               autoNodes.eq(newhightlight).addClass("mouseOver");



		            }

		            if(keycode==40){

		            //向下

		               var autoNodes =newoconUl.find("li");

		               if (newhightlight != -1 ){

		                //把高亮节点恢复

		                autoNodes.eq(newhightlight).removeClass("mouseOver");

		               }

		               newhightlight++;

		               if(newhightlight == autoNodes.length){

		                //如果到顶 把高亮移动到最后

		                newhightlight = 0;

		

		               }

		               autoNodes.eq(newhightlight).addClass("mouseOver");



		            }

		              var context = newoconUl.find("li").eq(newhightlight).text();

		             newoInputField.val(context);

		        }else if (keycode==13){//回车事件

		        	

		        }

	    }

	}





	function newsetcon(the_con){

	    //显示提示框，传入的参数即为匹配出来的结果组成的数组

	    newclearcon(); //每输入一个字母就先清除原先的提示，再继续

	     

	    

	    var len = 10;

	    if(the_con.length >10)

	    {

	    	len = 10;

	    }else{

	    	len = the_con.length;

	    }

	 

	    for(var i=0;i<len;i++){ 

	        //将匹配的提示结果逐一显示给用户

	       newoconUl.append($('<li ><a href="javascript:;">'+the_con[i].name+'['+the_con[i].url+']</a></li>'));  

	    }     

	    

	    $('.search-inp-list').show();   

	    if($('.search-inp-list li').length > 3){ 

			$('.search-inp-list').css({'height':'109px','overflow-y':'scroll'});

		}else{

			var hi = the_con.length*40;

			$('.search-inp-list').css({'height':'"+hi+"px','overflow-y':'scroll'});

		}

	     

	    newoconUl.find("li").click(function(){

	    	var text = $(this).text();

	    	text = text.substring(0,text.indexOf("["));

	        newoInputField.val(text); 

	        newclearcon();  

	        $(".btn-sty").click(); 

	        

	    }).hover(

	        function(){$(this).addClass("mouseOver");},

	        function(){$(this).removeClass("mouseOver");}

	    );

	}



	function newclearcon(){

	    //清除提示内容

	    if(newoconUl){

	    	newoconUl.empty();

	    	$('.search-inp-list').hide();  

	    	if($('.search-inp-list li').length > 3){

	    		//$('.search-inp-list').css({'height':'109px','overflow-y':'scroll'});

	    	} 

	    }

	}

	

});





//地图和列表交互

function overMapBuild(bid,type) 

{

	//alert($("#mapBid_"+bid).attr("id"));   //$("#mapBid_"+bid).id 

	

	//alert($("#mapBid_"+bid).parent(".labelBubble").attr("z-index"));

	if($("#mapBid_"+bid) != null)

	{

		//alert($("#blay_"+bid).css("z-index"));

		

		if(type ==1)      

		{    

			$("#mapBid_"+bid).addClass("active");

			$("#blay_"+bid).css({"position":"absolute","z-index":"999"});

			//$("#mapBid_"+bid).parent(".labelBubble").css({"position":"absolute","z-index":"1"});

			

		}else if(type ==2){ 

			//$("#mapBid_"+bid).parent(".labelBubble").css({"position":"absolute","z-index":"999"});

			$("#mapBid_"+bid).removeClass("active");

			$("#blay_"+bid).css({"position":"absolute","z-index":"1"});

		}  

		

/*		var zindex = $("#blay_"+bid).css("z-index");

		if(zindex == 999 || zindex == "999")

		{

			$("#blay_"+bid).css({"position":"absolute","z-index":"1"});

			alert(1); 

		} 

		

		if(zindex == 1 || zindex == "1")

		{  

			$("#blay_"+bid).css({"position":"absolute","z-index":"999"});

		}*/

	}    

}     

 



/*地图事件操作*/

$(function(){

	

	 

	 var nScrollHight = 0; //滚动距离总长(注意不是滚动条的长度)

    var nScrollTop = 0;   //滚动到的当前位置

    var pages = 1; 

    var nDivHight = $("#right_map_content").height();

    

      $("#right_map_content").scroll(function(){

	       nScrollHight = $(this)[0].scrollHeight;

	       nScrollTop = $(this)[0].scrollTop;

	　　　	   var paddingBottom = parseInt( $(this).css('padding-bottom') ),paddingTop = parseInt( $(this).css('padding-top') );

	       if(nScrollTop + paddingBottom + paddingTop + nDivHight >= nScrollHight)

	       {

		    	pages++;//页数

				bnames = $("#m_bname").val(); 

				var bounds = map.getBoundsJiwu(); 

				//200米、100米、50米、20米时显示具体楼盘。  

				$.post("/map!ajaxbuilds.action",

					{"bname" : $("#m_bname").val(),"wlat":bounds.Ie,"wlng":bounds.Je,

					"elat":bounds.De,"elng":bounds.Ee, 

					"filter":countFilterStr,

					"salestatus":$("#salestatus").val(), "searchtype": 1,"sorttype": $("#sorttype").val(),

					"subwaysid":subwaysid,"page":pages},

					function(data) {

						var obje = eval(data); 

						  

						if(obje != null && obje.length >0)

						{

							louShow(obje,"Y");   

							//dituLou(obje);   

							setbnum(obje,0);  

						}else{

							pages= pages -1;

						} 

				});   

	       }

	    	

  

      }); 

	  

       

	

	

	//定义自定义覆盖物的构造函数

	function SquareOverlay(center,length,html,lng,lat){

		this._center=center;

		this._length=length;

		this._html=html;

		this._lng=lng;

		this._lat=lat;

	}

	//继承API的BMap.Overlay

	SquareOverlay.prototype=new BMap.Overlay();

	//实现初始化方法

	SquareOverlay.prototype.initialize=function(map){

		this._map=map;

		var div=document.createElement("div");

		div.className="labelBubble";

		div.style.position="absolute";

		div.innerHTML=this._html;

		map.getPanes().markerPane.appendChild(div);

		this._div=div;

		return div;

	}

	//实现绘制方法

	SquareOverlay.prototype.draw=function(){

		var position=this._map.pointToOverlayPixel(this._center);

		this._div.style.left=position.x-this._length/2+"px";

		this._div.style.top=position.y-this._length/2+"px";

	}

	//实现显示方法

	SquareOverlay.prototype.show=function(){

		if(this._div){

			this._div.style.display="";

		}

	}

	//实现隐藏方法

	SquareOverlay.prototype.hide=function(){

		if(this._div){

			this._div.style.display="none";

		}

	}

	//自定义覆盖物添加事件方法

	SquareOverlay.prototype.addEventListener=function(event,func){

		this._div['on'+event]=func;

	}

 

	//var areaArr=[],placeArr=[],louArr=[];

	var areaArr=[{}],

	placeArr=[{}], 

	louArr=[{}]; 

 

  

	var point = new BMap.Point($("#map_lng").val(), $("#map_lat").val());

	map.centerAndZoom(point,12);

	//支持缩放 

	map.enableScrollWheelZoom(true);

	//右下角添加控件和比例尺

	var bottom_right_control=new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT});

	var bottom_right_navigation=new BMap.NavigationControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,type:BMAP_NAVIGATION_CONTROL_ZOOM});

	//添加控件和比例尺

	map.addControl(bottom_right_control);

	map.addControl(bottom_right_navigation);

	

	

/*	var map1=new BMap.Map("jw-map",{minZoom:10,maxZoom:18,enableMapClick: false});

	var point1="望城";

	map1.centerAndZoom(point1,12);

	var points1 = map1.getCenter();

	alert(points1.lng); 

	

	alert(map1.getMapType().getProjection().lngLatToPoint(map1.getCenter()));*/

	

	

	

	// 百度地图API功能

/*	var map1 = new BMap.Map("jw-map");

	var point1 = new BMap.Point($("#map_lng").val(), $("#map_lat").val());

	 

	map1.centerAndZoom(point1,12); 

	alert(1) 

	// 创建地址解析器实例 

	var myGeo = new BMap.Geocoder();

	// 将地址解析结果显示在地图上,并调整地图视野

	myGeo.getPoint("望城区", function(point){

		if (point) {

			

			map1.centerAndZoom(point, 16);

			map1.addOverlay(new BMap.Marker(point));

		}else{

			alert("您选择地址没有解析到结果!");

		}

	}, "长沙市");*/

	

	

	

	

	

	

	

	

	

	

	 

/*	firstMap();*/



	//初始化加载数据

//	initMapNew();

	//louShow(louArrs,"");   

	map_moveend(); 

/*	var point = new BMap.Point('114.144764', '22.620315');

	map.centerAndZoom(point,12);*/

	

	

/*	var myCompOverlay1 = new ComplexCustomOverlay('22.620315', '114.144764', '1111', 'dsa', -10, 12, 

			'dafds', 22, 2,33,33,{enableMassClear: true}); 

	//var myCompOverlay = new ComplexCustomOverlay(binfoarr[3], binfoarr[4], binfoarr[1], binfoarr[1]+binfoarr[2], binfoarr[5], binfoarr[0], binfoarr[6], binfoarr[9], binfoarr[7],binfoarr[8],binfoarr[10]);



	map.addOverlay(myCompOverlay1);  

	 alert(myCompOverlay); 

	 */

	

	

	

	

	

	

	

	

	//地图平移

	map.panBy(150,50,map.getCenter()); 

	

	

	/*鼠标缩放事件*/

/*	map.addEventListener("zoomend", function(){    

		if(this.getZoom()>=16){

			thirdMap();

			

		}else if(this.getZoom()>=14){

			secondMap();

		}else{

			firstMap();

		}

	});*/



	/** 地图移动事件 */

/*	map.addEventListener("dragend", function(){

		if(this.getZoom() >= 16){

			//根据不同缩放级别查不同数据，添加不同覆盖物

			//3级覆盖物

		} else if(this.getZoom() >= 14){

			//根据不同缩放级别查不同数据，添加不同覆盖物

			//2级覆盖物

		}else {

			//根据不同缩放级别查不同数据，添加不同覆盖物

			//1级覆盖物

		}

	});





	//一级地图覆盖物初始化

	function firstMap(){

		map.clearOverlays();

		//添加覆盖物

		for(var i=0;i<areaArr.length;i++){

			var _areaData=areaArr[i];

			(function(){

				var name=_areaData.name;

				var total=_areaData.column1;

				var lng=_areaData.column3;

				var lat=_areaData.column2;

				var html="<div class='overlays1 bubble'><p class='pName'>"+name+"</p><p class='pTotal'><span>"+total+"</span>盘</p></div>";

				var point=new BMap.Point(lng,lat);

				var mySquare=new SquareOverlay(point,90,html,lng,lat);

				map.addOverlay(mySquare);

				mySquare.addEventListener("click",function(){

					//点击改变缩放级别

					//alert(name);

					map.centerAndZoom(point, map.getZoom()+1);



				});

			})();

		}

	};

	 */

	

	//二级地图覆盖物初始化

/*	function secondMap(){

		map.clearOverlays();

		//添加覆盖物

		for(var i=0;i<placeArr.length;i++){

			var _placeData=placeArr[i];

			(function(){

				var name=_placeData.name;

				var total=_placeData.column1;

				var lng=_placeData.column3;

				var lat=_placeData.column2;

				var html="<div class='overlays2 bubble'><p class='pName'>"+name+"</p><p class='pTotal'><span>"+total+"</span>盘</p></div>";

				var point=new BMap.Point(lng,lat);

				var mySquare=new SquareOverlay(point,75,html,lng,lat);

				map.addOverlay(mySquare);

				mySquare.addEventListener("click",function(){

					alert(name);

				});

			})();

		}

	}*/

	//三级地图覆盖物初始化

/*	function thirdMap() {

		map.clearOverlays();

		//添加覆盖物

		for(var i=0;i<louArr.length;i++){

			var _louData=louArr[i];

			(function(){

				var name=_louData.bname;

				var price=_louData.averagePrice==0?"售价待定":(_louData.averagePrice/1000).toFixed(1)+"万";

				var lng=_louData.longitude;

				var lat=_louData.latitude;

				楼盘覆盖物

				var html="<div class='overlays3'><span class='avgprice'>"+price+"</span><span class='louname'>"+name+"</span></div>";

				地铁站楼盘覆盖物

				//var html="<div class='overlays3 subwoverlays'>"+name+"<em>|</em>"+price+"</div>";

				var point=new BMap.Point(lng,lat);

				var mySquare=new SquareOverlay(point,70,html,lng,lat);

				map.addOverlay(mySquare);

				mySquare.addEventListener("click",function(){

					alert(name);

					$(this).find(".overlays3").addClass("active").end().siblings().find(".overlays3").removeClass("active");

				});

			})();

		}

	}*/ 



	

	

	

	

	//显示楼盘列表 str :为楼盘信息

	function louShow(str,typeStr)

	{



		setbnum(str,0); 

		var htm = ' <ul class="list-lou">';

		if(str != null && str.length >0)

		{

			for(var i=0;i<str.length;i++){

				var arr=str[i];  

				var salestatusStr = getBuildSaleStatuName(arr.salestatus);

				 

				htm += ' <li onmouseover="overMapBuild('+arr.bid+',1)" onmouseout="overMapBuild('+arr.bid+',2)">';

				htm += '<a target="_blank" href="'+jiwuPath+'/lp/'+arr.bid+'.html" class="clearfix" id="bid_'+arr.bid+'">';

				htm += '<div class="img">';

				

				

				htm += '<img src="'+arr.path+'" alt=""/>';  

				

				if(arr.servicechoose != null && arr.servicechoose != "" && arr.servicechoose.indexOf("#1#") > -1)

				{

					htm += '<i class="zckfico"></i>'; 

				} 

				if(arr.mark > 0)

				{

					htm += '<i class="jxtj"></i>'; 

				} 

				

				htm += '<em class="shou">'+salestatusStr+'</em>';

				htm += '</div>';

				htm += '<div class="text">';

				htm += '<p class="mt5 clearfix">';

				htm += ' <span class="name text-ellip">'+arr.bname+'</span>';

				var priceStr = arr.averagePrice;



					

				if(arr.MPrice != null && arr.MPrice != "")

				{

					htm += '<span class="unit-pri text-ellip"><em class="orange fz16">'+arr.MPrice+'</em></span>';

				}else{  

					if(arr.averagePrice == null || arr.averagePrice == 0)

					{

						htm += '<span class="unit-pri text-ellip"><em class="orange fz16">售价待定</em></span>';

					}else{

						htm += '<span class="unit-pri text-ellip"><em class="orange fz16">'+arr.averagePrice+'</em>元/平米</span>';

					}  

				}

				  

				htm += ' </p>';

			

				/*htm += '<p class="mt5 c666"><i class="">'+arr.busName+'</i></p>';*/

	 			

				if(arr.huiString != null && arr.huiString != "")

				{

					htm += '<p class="mt15 c666"><i class="tuan">惠</i>'+arr.huiString+'</p>';

				}else{ 

					htm += '<p class="mt15 c666">';//<div width="20"><a>sssss</a></div>					   

					if(arr.housetype != null && arr.housetype.length >0)

					{

						/*htm += '<i class="tuan">';*/

						//console.log(arr.housetype);

						// var jsonR = eval(arr.housetype); 

						// var huxinStr = "";

						// var rLen = 5;

						// if(jsonR.length <5)

						// {  

						// 	rLen = jsonR.length;

						// }						

						// for(var j = 0;j<rLen;j++)

						// { 

						// 	var objR = jsonR[j];							 

						//             	if(objR[0] == 10 || objR[0] == 0) 

						//             	{ 

						//             		huxinStr += '其他'+'('+objR[1]+')&nbsp;&nbsp;'; ; 

						//             	}else{

						//             		htm += objR[0]+'室('+objR[1]+')&nbsp;&nbsp;'; 

						//             	}   

						// } 

						htm += arr.housetype; 

					/*	htm += '</i>';*/

					}

					htm += '</p>';

				}
				
		
			}

		}

		else{

			if("Y" != typeStr)

			{

				htm +='<li><div class="empty-lou"></div></li>';

			}

		}  

		

		htm += ' </ul>';

		if("Y" == typeStr)

		{

			document.getElementById("right_map_content").innerHTML =document.getElementById("right_map_content").innerHTML +htm; 

		}else{

			document.getElementById("right_map_content").innerHTML =htm; 

		}

		

	}

	 

	

  

	

	function dituLou(list)

	{

		for (var i = 0; i < list.length; i++) {

			var obj = list[i];

			  

			var path = obj.path;

			var phone = obj.centerphone.replace('400-7053-322','400-705-3322')+(obj.agentphone.length>0?('转'+obj.agentphone):'');

		    var priceVal= "";

			if(obj.MPrice != null && obj.MPrice != "")

			{

				priceVal = obj.MPrice;

			}else{

				priceVal = (obj.averagePrice==0?'售价待定':'  '+(obj.averagePrice/10000).toFixed(1)+'万元/㎡') 

			} 

		   

			var myCompOverlay = new ComplexCustomOverlay(obj.longitude, obj.latitude, obj.bname, obj.bname+priceVal, '-11', obj.bid, obj.address, obj.path, phone,priceVal,'',{enableMassClear: true});

			map.addOverlay(myCompOverlay);  

		}  

	}  

	

	

	/**

	 * 显示区域下面的片区数据

	 * @return

	 */

	function map_area(cityId){



		if(msgwindow==1  ){

			msgwindow = 0;

			return 0;

		} 



		var filter = '';

		if(filter==null || filter==''){

			filter = price_qc;

		}

		

		if(dituObj["area_type"] == "Y")//区域为选中状态

		{

			cityId = dituObj["area_filterId"]; 

		}

	 

		 

		var bounds = map.getBoundsJiwu(); 

		searchbuild_ts(); 

		var that = this;

		countFilter();

			 

		$.post("/map/findbuild",

				{"bname" : $("#m_bname").val(),"wlat":bounds.Ie,"wlng":bounds.Je,

				"elat":bounds.De,"elng":bounds.Ee,

				"filter":countFilterStr,

				"salestatus":$("#salestatus").val(), "searchtype": searchtypeStr,"sorttype": $("#sorttype").val(),"areaId":cityId},

				function(data) {     

					var listNew = eval(data);   

					//map.centerAndZoom(point, that.andZoom);  

					 

					if(listNew != null && listNew != "") 

					{

						/*map.clearOverlays();//清楚地图覆盖物  

*/						for (i = 0; i < listNew.length-1; i++) {

							 

							var obj = listNew[i];    

							

							var myCompOverlay = new ComplexCustomOverlay(obj.column3, obj.column2, obj.name, obj.name, obj.column4, obj.cityId, obj.name, obj.column1, '',obj.url,obj.cityId,{enableMassClear: true});

							//var myCompOverlay = new ComplexCustomOverlay(binfoarr[3], binfoarr[4], binfoarr[1], binfoarr[1]+binfoarr[2], binfoarr[5], binfoarr[0], binfoarr[6], binfoarr[9], binfoarr[7],binfoarr[8],binfoarr[10]);

							map.addOverlay(myCompOverlay);

						}

					}  

			});   

	}

	 

	

	var compLists = [];

	var com_index = 0;

	// 复杂的自定义覆盖物

	function ComplexCustomOverlay(point_lng, point_lat, text, mouseoverText, type, bid, address, path, phone1, phone2, news,options) {

		this._point = new BMap.Point(point_lng, point_lat);

		this._text = text;

		this._overText = mouseoverText;

		this._type = getType(type);

		this._y_type = type;

		this._bid = bid;

		this._point_lng = point_lng;

		this._point_lat = point_lat;

		this._address = address;

		this._path = path;

		this._phone1 = phone1;

		this._phone2 = phone2;

		this._news = news;

		

		this.com_index = phone1; 

		  

	       if (!options.enableMassClear) {

	    	   /*alert(myCompOverlays+com_index);

		   		compLists.push(new Object()); 

				compLists[com_index] = myCompOverlays;*/

				    

		          map.addEventListener('clearoverlays', function(){

		        	 /* alert(com_index)*/

		        	  //alert(compList.length);

		        	  

		        	if(subwayXianlu != "Y" ) 

		        	{

				          for ( var i = 0; i < compList.length; i++) {

				        	  map.addOverlay(compList[i]);   

				          }   

		        	}

		     }); 

	       }  

	        

		

		// 复杂的自定义覆盖物

/*	    function ComplexCustomOverlay(point, text, mouseoverText,options){

	      this._point = point;

	      this._text = text;

	      this._overText = mouseoverText;

	       if (!options.enableMassClear) {

	          mp.addEventListener('clearoverlays', function(){

	          mp.addOverlay(myCompOverlay);

	          });

	       }

	    }

	    var myCompOverlay = new ComplexCustomOverlay(new BMap.Point(116.407845,39.914101), "银湖海岸城",mouseoverTxt,{enableMassClear: false});

	    */



		

	}

	ComplexCustomOverlay.prototype = new BMap.Overlay();

	ComplexCustomOverlay.prototype.initialize = function(map) {

		this._map = map;

		  

		var that = this;


		//-7:区域数据，-9:片区数据，-10地铁数据

		if(this._y_type == "-7" ||this._y_type == "-9" ) 

		{      

			//alert(that._point_lng+"----"+that._point_lat+"---"+that._overText);

			

			var div = this._div = document.createElement("div"); 

			div.className="labelBubble";//div圆形样式

			div.innerHTML = "<div class='overlays1 bubble'><p class='pName'>"+that._overText+"</p><p class='pTotal'><span>"+that._path+"盘</span></p></div>";

			div.style.zIndex = BMap.Overlay.getZIndex(that._point.lat,that._point_lng);

			div.style.margin = "0px auto";  

			div.style.position = "absolute";   

			div.style.cursor = "pointer";  

			 

			var arrow = this._arrow = document.createElement("div");

			//arrow.style.background = "url(../template/default/pc/skin/images/label.png) no-repeat";

			arrow.style.backgroundPosition = "0px "+positions[this._type]+"px";

			arrow.style.position = "absolute"; 

			arrow.style.width = "11px";

			arrow.style.height = "10px"; 

			arrow.style.top = "22px";  

			arrow.style.left = "10px";

			arrow.style.overflow = "hidden";  

			div.appendChild(arrow); 

 

			var selectObj = dituObj;   

			//添加鼠标点击事件  

			div.onclick = function(){

				zhoubianwindow = 0;

				 

				//this._y_type="-8"; 

				select_point = new BMap.Point(that._point_lng, that._point_lat)

				select_bid = that._bid;

				select_bname = that._text;

				select_path = that._path;

				select_address = that._address;

				select_type = that._y_type; 

				select_overText = that._overText;   

				select_phone1 = that._phone1;

				select_phone2 = that._phone2;//查询条件

				select_news = that._news;//城市区域/片区id

				select_price = select_overText.replace(select_bname,"");

				

				if(that._y_type == "-7"  ) //区域

				{

/*					selectObj["area_filterId"] = select_news;

					$("#subway_filter").val("");//清空地铁

					that.subwaysid = ""; 

					that.subwayparentid = ""; 

					$("#area_filter").val(select_phone2); 

					

					dituObj["area_type"] = "Y";//区域为选中状态

					searchtypeStr = "-2"; 

					//获取区域对应的片区数据

					map_area(select_bid);

					andZoom = 14;

					map.centerAndZoom(select_point, 14); 

					

					//地图平移

					map.panBy(130,50,map.getCenter()); */

					

					

					selectObj["area_filterId"] = select_news;

					$("#subway_filter").val("");//清空地铁

					that.subwaysid = ""; 

					that.subwayparentid = ""; 

					$("#area_filter").val(select_phone2);  

					

					andZoom = 14;

					dituObj["area_type"] = "N";//区域为选中状态

					map.centerAndZoom(select_point, 14); 

					

					

					$("#area_filter").val("");//

					$("#areaMap").text(that._overText);  

					

					 sellat = that._point_lat;

					 sellng = that._point_lng; 

					

				}else if(that._y_type == "-9" ){

					

/*					selectObj["area_filterId"] = select_news;

					$("#subway_filter").val("");//清空地铁

					that.subwaysid = ""; 

					that.subwayparentid = ""; 

					$("#area_filter").val(select_phone2); 

					

					andZoom = 16;

					dituObj["area_type"] = "N";//区域为选中状态

					map.centerAndZoom(select_point, 16); */

					//根据缩放级别显示对应的数据  

					//map_moveend();  

				}

				else if( that._y_type == "-10"){   

					andZoom = 16;

					map.centerAndZoom(select_point, 16); 

					//根据缩放级别显示对应的数据  

					//map_moveend();   

				}

			 }

			

			div.onmouseover =  function(){

				map_mouseover_box(div, arrow, that,that._bid);

		    }

		 

			div.onmouseout = function(){

				map_mouseout_box(div, arrow, that,that._bid);

		    }

			 

			that._map.getPanes().labelPane.appendChild(div);

     

			return div;  

			   

		}else{  

			

			var div = this._div = document.createElement("div"); 

			var selectObj = dituObj;    

			div.className="labelBubble";

			//var html="<div class='overlays3 subwoverlays'>"+name+"<em>|</em>"+price+"</div>";

			

			if(this._y_type == -11)

			{

				

			}

			// || this._news == this.subwaysid 

			if(this._y_type == -10)//地铁选中的颜色。  && that._news == that.subwaysid  active

			{   

				//div.style.backgroundColor = "red";  

				if(selectSubType == "A")  

				{  

					div.innerHTML = "<div class='overlays3 subwoverlays'>"+that._text+"<em>|</em>"+that._path+"盘</div>";

					div.onclick = function(){  

						  

						subwayXianlu = "Y"; 

						//alert(subwayXianlu); 

						map.clearOverlays();//清楚地图覆盖物 

						

						select_point = new BMap.Point(that._point_lng, that._point_lat);

						andZoom = 16; 

						map.centerAndZoom(select_point, 16);  

						subwaysid=that._news;

						subwayparentid = that._phone2;//上一级地铁id

						selectSubType = "B"; 

						

						

						 sellat = that._point_lat;

						 sellng = that._point_lng;

						

						$("#subway_filter").val("");//清空地铁

						$("#subwayMap").text(that._text);  

						

					}    

				}else 

				{

					div.innerHTML = "<div class='overlays3 subwoverlays'>"+that._text+"<em>|</em>"+that._path+"盘</div>"; 

					//画圆心       

					try{    

						var point = new BMap.Point(this._point_lng, this._point_lat); 

						var siz = 1000;

						   

						//半径为1500  

						var circle = new BMap.Circle(point,siz,{fillColor:"#C0C0C0", strokeWeight: 2 ,fillOpacity: 0.3, strokeOpacity: 0.3});

						circle.setStrokeStyle("dashed"); //设置边框为虚线（dashed）还是实线（solid）， 

						//circle.setStrokeColor("rgba(255,100,0,.9)");//设置边框颜色

						circle.setStrokeColor("red");//设置边框颜色

						 

						circle.setRadius(siz);//设置圆形半径 500米  

						/*circle.setStrokeWeight(2); */

						map.addOverlay(circle);  

					    bounds = getSquareBounds(circle.getCenter(),circle, point);

					    var local1 =  new BMap.LocalSearch(map, options);  

					    local1.searchInBounds("周边楼盘", bounds);         

					}catch(e) 

					{  

					} 

				}

				

			}else{   

 

				if(that._text == bnames )

				{

					bnames="";

					select_point = new BMap.Point(that._point_lng, that._point_lat);

					andZoom = 16;

					map.centerAndZoom(select_point, 16); 

				}



				var divHtm = "<a target='_blank' href='"+jiwuPath+"/lp/"+that._bid+".html' class='clearfix' >";
				// if (jiwuPath == 'http://kunming.lou86.com') {// 昆明区域选择先楼盘名后均价
					divHtm += "<div class='overlays3' id='mapBid_"+that._bid+"'><span class='avgprice'>"+that._text+"</span><span class='louname'>"+that._phone2+"</span></div>";
				/*}else{
					divHtm += "<div class='overlays3' id='mapBid_"+that._bid+"'><span class='avgprice'>"+that._phone2+"</span><span class='louname'>"+that._text+"</span></div>";
				}*/

				divHtm +="</a>"; 

				div.id = "blay_"+that._bid; 

				div.innerHTML = divHtm; 

			} 

			 

			div.style.zIndex = BMap.Overlay.getZIndex(that._point.lat);

			div.style.margin = "-10px auto"; 

			div.style.position = "absolute";    

			div.style.cursor = "pointer";  

	       // div.style.top = "202px";

	        

			var arrow = that._arrow = document.createElement("div");

			//arrow.style.background = "url(../template/default/pc/skin/images/label.png) no-repeat";

			arrow.style.backgroundPosition = "0px "+positions[that._type]+"px";

			arrow.style.position = "absolute"; 

			arrow.style.width = "11px";

			arrow.style.height = "10px"; 

			arrow.style.top = "22px";  

			arrow.style.left = "50px";  

			arrow.style.overflow = "hidden";  

			arrow.id = "arrow_"+that._bid;

			div.appendChild(arrow); 

			

			div.onmouseover =  function(){

				

				map_mouseover(div, arrow, that,that._bid);

		    }

		 

			div.onmouseout = function(){

				map_mouseout(div, arrow, that,that._bid);

		    }

			

			that._map.getPanes().labelPane.appendChild(div); 

			return div; 

		} 

	} 

	



	/**

	 * 得到圆的内接正方形bounds

	 * 

	 * @param {Point}

	 *            centerPoi 圆形范围的圆心

	 * @param {Number}

	 *            r 圆形范围的半径

	 * @return 无返回值

	 */

	function getSquareBounds(centerPoi,r, mPoi){

	    var a = Math.sqrt(2) * r; // 正方形边长



	    mPoi = getMecator(centerPoi);

	    var x0 = mPoi.x, y0 = mPoi.y;



	    var x1 = x0 + a / 2 , y1 = y0 + a / 2;// 东北点

	    var x2 = x0 - a / 2 , y2 = y0 - a / 2;// 西南点

 

	    var ne = getPoi(new BMap.Pixel(x1, y1)), sw = getPoi(new BMap.Pixel(x2, y2));

	    return new BMap.Bounds(sw, ne);

	}



	function select_s_type(type){

		if(type==0){

			document.getElementById("s_t_0").className = 'box_1';

			document.getElementById("s_t_1").className = 'box_2_1';

			// document.getElementById("searchtype").value="0";

		}else{

			document.getElementById("s_t_0").className = 'box_1_1';

			document.getElementById("s_t_1").className = 'box_2';

			// document.getElementById("searchtype").value="1";

		}

	}



	 // 根据球面坐标获得平面坐标。

	function getMecator(poi){

	    return mp.getMapType().getProjection().lngLatToPoint(poi);

	}

	// 根据平面坐标获得球面坐标。

	function getPoi(mecator){

	    return mp.getMapType().getProjection().pointToLngLat(mecator);

	}



	function Hidetitle(ADiv,CDiv){

		$('#'+ADiv).css('display','none');

		$('#'+CDiv).innerHTML=='';

	}



	function showtitle(ADiv,CDiv,Content){

		$('#'+ADiv).css('left','230');

		$('#'+ADiv).css('top','20');

		$('#'+ADiv).css('display','');

		$('#'+CDiv).html(Content);

	} 





	function map_mouseover(div, arrow, that,bid){

		//添加楼盘列表选中样式

		$("#bid_"+bid).addClass("current");   

		 

		//alert($(div).children(".overlays3").attr("id"));

		/*div.style.backgroundColor = backgroundColors[2];*/

		$(div).css("z-index","9999");   

	   /* div.style.borderColor = borders[2];*/

	 /*   div.getElementsByTagName("span")[0].innerHTML = that._overText;*/

	   /* arrow.style.backgroundPosition = "0px "+positions[2]+"px";*/

	} 



	function map_mouseout(div, arrow, that,bid) { 

/*		div.style.backgroundColor = backgroundColors[that._type];*/

		$(div).css("z-index","1");  

		//移除楼盘选中样式

		$("#bid_"+bid).removeClass("current");     

/*	    div.style.borderColor = borders[that._type];

	    //鼠标移出后楼盘显示内容不变

	    div.getElementsByTagName("span")[0].innerHTML = that._overText;

	    arrow.style.backgroundPosition = "0px "+positions[that._type]+"px";*/

	}

	

	function map_mouseover_box(div, arrow, that){

		//div.style.backgroundColor = backgroundColors[2];

		$(div).css("z-index","9999");  

		

		//div.style.borderColor = "green";

		//div.style.borderColor = borders[2];

	    //arrow.style.backgroundPosition = "0px "+positions[2]+"px";

	 

	} 

	 

	function map_mouseout_box(div, arrow, that) {

		//div.style.backgroundColor = "red";

		$(div).css("z-index","1"); 

		//div.style.borderColor = "green"; 

	    //鼠标移出后楼盘显示内容不变

	    //div.getElementsByTagName("span")[0].innerHTML = that._overText;

	    //arrow.style.backgroundPosition = "0px "+positions[that._type]+"px";

	}



	 

	ComplexCustomOverlay.prototype.draw = function() {

/*		var position=this.map.pointToOverlayPixel(this._center);*/



		    

/*	    var pixel = map.pointToOverlayPixel(this._point);  

		this._div.style.left=pixel.x-this._length/2+"px";

		this._div.style.top=pixel.y-this._length/2+"px"; */ 

		var pixel = map.pointToOverlayPixel(this._point);  

	 

	    //this._div.style.left = pixel.x - 28  + "px";

	    this._div.style.left = pixel.x - parseInt(this._arrow.style.left)  + "px";

	    this._div.style.top  = pixel.y - 30 + "px";

	}   

 

	

	function searchbuild_ts(){

	 

		document.getElementById("bnum").innerHTML = "<div style='float:left; padding:5px;'><img src='/public/static/home/map/loadingmap.gif'/></div><div style='float:left; line-height:30px;'>正在为您检索，请稍候！</div>";

	}

	

	function setbnum(obj,type){

		 var num = 0;

		if(obj != null && obj.length>0)

		{

			num = obj.length;

		}else{

			num = 0;

		}

		 

		if (num > 0){

			document.getElementById("bnum").innerHTML = '为您找到<em class="green">'+num+'</em>个新盘';

			//document.getElementById("bnum").innerHTML="找到<span id=\"monitor\" style=\"color:#FF6400;font-weight:bold\">"+ num +"</span>个符合要求的楼盘";

		}else{ 

			if(type==0){

				document.getElementById("bnum").innerHTML="当前地图范围未找到任何楼盘！";

			}else{

				document.getElementById("bnum").innerHTML="找到<span id=\"monitor\" style=\"color:#FF6400;font-weight:bold\">"+ 1 +"</span>个符合要求的楼盘";

			}

		}  

	} 







	//按照区域显示 str:json为数据

	function initMapNew() {

		/*default_rightkey();*/

		//map_area(-1);

	}  



	function getType(type){

		if(type==2 || type==21){ 

			return 1;

		}else if(type==-1){

			return 3;

		}else{

			return 0;

		}

	}

	

	//事件监听

	map.addEventListener("moveend", function(){

		map_moveend();

	});

	map.addEventListener("zoomend", function(){

		map_moveend();

	});  

	



	var subwayMapText= "";

	

	var subwayIsShow="Y";

	

	var compList=[];

	var myCompOverlays;



	/** 

	 * 显示地铁数据，和显示地铁房子数据

	 * @return

	 */

	function map_subway(){



		var bounds = map.getBoundsJiwu();

				  

		//获取地铁数据 subwayparentid:几号线,subwaysid:地铁站点id

		$.post("/map!ajaxSubway.action", 

			{"subwaysid":subwaysid,"subwayparentid":this.subwayparentid},//,"subwayparentid":60

			function(data) {    

			 	if(map.getZoom() <=13)//如果10公里、5公里、2公里时显示地铁圈圈

				{ 

			 		map.clearOverlays();//清楚地图覆盖物    

				} 

			 	

				var listNew = eval(data);     

				 

		/*		var pt = new BMap.Point(116.417, 39.909);*/

/*				var myIcon = new BMap.Icon("http://developer.baidu.com/map/jsdemo/img/fox.gif", new BMap.Size(300,157));

				var marker2 = new BMap.Marker(map.getCenter(),{icon:myIcon});  // 创建标注

				map.addOverlay(marker2);              // 将标注添加到地图中

				marker2.disableMassClear(false); */

 

				

/*				for (i = 0; i < listNew.length; i++) { 

				 	 

					var obj = listNew[i] ;    

					var name = obj.station+"  "+obj.buildNum+"盘"; 

					obj.longitude = obj.longitude -0.001522; 

					myCompOverlays = new ComplexCustomOverlay(obj.longitude, obj.latitude, obj.station, name, -10, obj.cityId, 

							obj.station, obj.buildNum, i,obj.parentId,obj.sid,{enableMassClear: false});

					//var myCompOverlay = new ComplexCustomOverlay(binfoarr[3], binfoarr[4], binfoarr[1], binfoarr[1]+binfoarr[2], binfoarr[5], binfoarr[0], binfoarr[6], binfoarr[9], binfoarr[7],binfoarr[8],binfoarr[10]);

					   

					map.addOverlay(myCompOverlays);      

					map.clearOverlays();       

					 

					$(".overlays3 subwoverlays").addClass("active");  

				}*/

				

				compList = []; 

				for (i = 0; i < listNew.length; i++) { 

				 	 

					var obj = listNew[i] ;    

					var name = obj.station+"  "+obj.buildNum+"盘"; 

/*					obj.longitude = obj.longitude -0.009522; 

					obj.latitude =obj.latitude-0.005252;  */ 

					 

					var myCompOverlays = new ComplexCustomOverlay(obj.longitude, obj.latitude, obj.station, name, -10, obj.cityId, 

							obj.station, obj.buildNum, i,obj.parentId,obj.sid,{enableMassClear: false});

					//var myCompOverlay = new ComplexCustomOverlay(binfoarr[3], binfoarr[4], binfoarr[1], binfoarr[1]+binfoarr[2], binfoarr[5], binfoarr[0], binfoarr[6], binfoarr[9], binfoarr[7],binfoarr[8],binfoarr[10]);

					compList.push(myCompOverlays)

					

/*					map.addOverlay(myCompOverlays);      

					map.clearOverlays();    */   

					

					//$(".overlays3 subwoverlays").addClass("active");  

				}

				  

				for (i = 0; i < compList.length; i++) {

					map.addOverlay(compList[i]);      

					$(".overlays3 subwoverlays").addClass("active");  

				}

				

				if(isShowLous != "N")

				{

					map.clearOverlays();   

				}

				

				 

        

				

/*				 start = listNew[0].station;

				 end = listNew[listNew.length-1].station; 

				 searchTest(); */

				

/*	            setTimeout(function() {

	                $.inArray(g_conf.cityId, ["350200"]) > -1 && c.find('li[data-value="store"]').hide()

	            },

	            100)*/

				

				 

/*				var objs = [];

				

  				for (i = 0; i < listNew.length; i++) { 

  					var obj = listNew[i] ;  

  					objs.push(new BMap.Point(obj.longitude, obj.latitude)); 

  				}*/

  				

/*  				var polyline = new BMap.Polyline([

  				                        		new BMap.Point(116.399, 39.910),

  				                        		new BMap.Point(116.405, 39.920),

  				                        		new BMap.Point(116.423493, 39.907445)

  				                        	], {strokeColor:"blue", strokeWeight:2, strokeOpacity:0.5});   //创建折线

  				                        	map.addOverlay(polyline);   //增加折线

*/  				

/*			var polyline = new BMap.Polyline(objs, {strokeColor:"red", strokeWeight:3, strokeOpacity:0.5});   //创建折线

				map.addOverlay(polyline);   //增加折线      

*/				  

  				

	

/*				if($("#subwayMap").text() != null && $("#subwayMap").text() != "" && subwayMapText != $("#subwayMap").text())

				{

					subwayMapText = $("#subwayMap").text();

					subwayIsShow="N";

					var busName = $("#subwayMap").text();

					busline.getBusList(busName); 

					

					alert(subwayIsShow); 

					subwayIsShow="Y";

				} */

  				   

/*	            setTimeout(function() {

	            	setTimeout(timeBus(), 3000 );

	            });*/

				 

		});

		 

		



		 

/*		

		alert(1);

		 var ls = new BMap.LocalSearch("罗宝线");  

		 ls.setSearchCompleteCallback(function(rs){

			 alert(ls);

			   

             for(j=0;j<rs.getCurrentNumPois();j++)  

             {  

                 var poi=rs.getPoi(j);  

                 map.addOverlay(new BMap.Marker(poi.point)); //如果查询到，则添加红色marker  

                 $("txtResult").value+= poi.title+":" +poi.point.lng+","+poi.point.lat+'\n';  

             }  

             

		 });*/

		 

		

/*		 $("txtResult").value=""//每次生成前清空文本域  

		        map.clearOverlays(); //清除地图上所有标记  

		        var c=$("txtCity").value;  

		        city.search(c);//查找城市  

		        var s=$("txtSearch").value;  

		       

		        ls.search(s);  

		        var i=1;  

		       

		            if (ls.getStatus() == BMAP_STATUS_SUCCESS){  

		                    for(j=0;j<rs.getCurrentNumPois();j++)  

		                    {  

		                        var poi=rs.getPoi(j);  

		                        map.addOverlay(new BMap.Marker(poi.point)); //如果查询到，则添加红色marker  

		                        $("txtResult").value+= poi.title+":" +poi.point.lng+","+poi.point.lat+'\n';  

		                    }   

		                    if(rs.getPageIndex!=rs.getNumPages())    

		          {    

		            ls.gotoPage(i);  

		            i=i+1;  

		          }  

		            }});}  */

		

		

		//获取地铁周边房子数据 

		/*$.post("/map!ajaxSubwayHouse.action", 

				{"subwaysid":1232,"subwayparentid":60},

				function(data) {    

					initMap(data); 

					var listNew = eval(data);    

					for (i = 0; i < listNew.length; i++) { 

						

						var obj = listNew[i] ;    

						var myCompOverlay = new ComplexCustomOverlay(obj.longitude, obj.latitude, obj.station, obj.station, 1, obj.cityId, obj.station, obj.buildNum, '','','');

						//var myCompOverlay = new ComplexCustomOverlay(binfoarr[3], binfoarr[4], binfoarr[1], binfoarr[1]+binfoarr[2], binfoarr[5], binfoarr[0], binfoarr[6], binfoarr[9], binfoarr[7],binfoarr[8],binfoarr[10]);

						mp.addOverlay(myCompOverlay);

					}  

			});*/

		



	} 

	



	var start = "";

	var end = "";

	var routePolicy = [BMAP_TRANSIT_POLICY_LEAST_TIME,BMAP_TRANSIT_POLICY_LEAST_TRANSFER,BMAP_TRANSIT_POLICY_LEAST_WALKING,BMAP_TRANSIT_POLICY_AVOID_SUBWAYS];

	var transit = new BMap.TransitRoute(map, {

			renderOptions: {map: map},

			policy: 0,

			onMarkersSet:function(item)

			{

				/*alert(item); */

				var items = item.LocalResultPoi;

				for ( var i = 0; i < items.length; i++) {

					alert(items[i].title); 

				}

			},onSearchComplete:function(item)

			{

			/*	alert(item); */

				var items= item.getPlan(0);

				for ( var i = 0; i < items.length; i++) {

					alert(items[i]);  

				} 

			}

		});

	

	

	

	function searchTest()

	{

	/*	map.clearOverlays(); */ 

		var i=0;

		search(start,end,routePolicy[i]); 

		subwayIsShow="N"; 

	}



	function search(start,end,route){ 

		transit.setPolicy(route);

		transit.search("前海湾","深圳北站","黄贝岭");

	} 

	

	 

	function timeBus()

	{

		subwayIsShow="Y";

	} 

	

	var busline = new BMap.BusLineSearch(map,{

		renderOptions:{map:map},//,panel:"r-result"   强列表数据显示到哪个div  

			onGetBusListComplete: function(result){

			   if(result) {

				 var fstLine = result.getBusListItem(0);//获取第一个公交列表显示到map上

				 busline.disableAutoViewport();

				 busline.getBusLine(fstLine); 

				 

				 subwayIsShow="N"; 

				 

            	 if(map.getZoom() == 12)

            	 {

            		map.centerAndZoom(map.getCenter(), 13);

        			map.panBy(-150,0,map.getCenter());  

            	 } 

			   }       

			} 

			,

            onGetBusLineComplete:function(result)

            { 

/*            	var busline =  result.getPath();

            	var polyline = new BMap.Polyline(busline, {strokeColor:"red", strokeWeight:3, strokeOpacity:0.5});   //创建折线

				map.addOverlay(polyline);   //增加折线     

*/            }  

	}); 

	

//	function selbusline()

//	{

//		

//	}

//	

	



	var isShowLous="Y";

	var seachStr = 0;

	function map_moveend(){

		var nowtime =new Date().getTime();

		if(buloading&&(buloadtime+2000)> nowtime){

			return;

		}

		buloadtime = nowtime;

		buloading = true;

		//map.clearOverlays();//清楚地图覆盖物   

		pages = 1;  

		if(subwayIsShow == "N")

		{ 

			subwayIsShow="Y";

			return 0; 

		}

		//map_subway();

		if(msgwindow==1 || zhoubianwindow==1){

			msgwindow = 0;

			return 0; 

		} 

		var filter = '';

		if(filter==null || filter==''){ 

			filter = price_qc; 

		}

		var bounds = map.getBoundsJiwu();

		

		var isArea="N";

		

		if( $("#subway_filter").val() != "") 

		{  

		 	if(map.getZoom() <=13 )//如果10公里、5公里、2公里时显示城市区域 

			{

		 		subwayXianlu = "N";

				subwayMapText = $("#subwayMap").text(); 

				/*subwayIsShow="N";*/

				isShowLous="Y";

				   

		 		map_subway();//显示地铁

		 		//检索地铁线路

                setTimeout(function() {

    				var busName = $("#subwayMap").text();

    				busline.disableAutoViewport();  

                	busline.getBusList(busName); 

	            },

	            100);  

		 		return 0; 

			} 

		}else{

			//通过缩放级别显示区域，或者片区 

		 	if(map.getZoom() <=13 )//如果10公里、5公里、2公里时显示城市区域

			{

		 		map.clearOverlays();//清楚地图覆盖物    

				searchtypeStr = "-1";

				map_area(-1); 

				isArea="Y";

				//return 0;  

			}

/*			else if(map.getZoom() ==14 || map.getZoom() ==15)//如果10公里、5公里、2公里时显示城市区域

			{

				searchtypeStr = "-2";  

				map_area(-1);    

				isArea="Y";

				subwayXianlu = "Y";

				//return 0;    

			} */    

		} 

		

/*		sellat =lat;//获取经纬度

		sellng =lng;*/

		

		//alert("bounds.Ie:"+bounds.Ie+"bounds.Je"+bounds.Je+"bounds.De:"+bounds.De+"bounds.Ee:"+bounds.Ee); 

		if(sellng != null && sellng != "" && sellng >0 && sellat != null && sellat != "" && sellat >0 )

		{

			var numb = map.getDistance(map.getCenter(),  new BMap.Point(sellng, sellat));

			if(numb > 4000)

			{

				$("#area_filter").val("");//

				$("#areaMap").text("区域找房"); 

			}

			

			if(numb > 2000)

			{

				$("#subway_filter").val("");//

				$("#subwayMap").text("地铁找房"); 

			}  

		} 

		

 

		countFilter(); 

		

		searchbuild_ts();     

		//200米、100米、50米、20米时显示具体楼盘。 

		$.post("/map/findbuild",

			{"bname" : $("#m_bname").val(),"wlat":bounds.Ie,"wlng":bounds.Je,

			"elat":bounds.De,"elng":bounds.Ee,

			"filter":countFilterStr,

			"salestatus":$("#salestatus").val(), "searchtype": 1,"sorttype": $("#sorttype").val(),

			"subwaysid":subwaysid},

			function(data) {

				

				if(isArea != "Y") 

				{ 

					subwayXianlu = "Y";

					map.clearOverlays();//清楚地图覆盖物   

				} 

				

				var obje = eval(data);

				louShow(obje,"N");

				

				if(isArea != "Y") 

				{

					dituLou(obje); 

				} 

			

				//alert(map.getOverlays());  

				 

				if($("#subway_filter").val() != "")

				{

					isShowLous = "N";

					map_subway();//显示地铁    

				}   

				buloading =false;

		});   

		

	}  

	

	$(".btn-sty").bind("click",function(){

		countFilter();

		seachStr = 1;

		bnames = $("#m_bname").val(); 

		var bounds = map.getBoundsJiwu(); 

		//200米、100米、50米、20米时显示具体楼盘。 

		$.post("/map/findbuild",

			{"bname" : $("#m_bname").val(),"wlat":bounds.Ie,"wlng":bounds.Je,

			"elat":bounds.De,"elng":bounds.Ee, 

			"filter":countFilterStr,

			"salestatus":$("#salestatus").val(), "searchtype": 1,"sorttype": $("#sorttype").val(),

			"subwaysid":subwaysid},

			function(data) {

				map.clearOverlays();//清楚地图覆盖物    

				var obje = eval(data); 

				louShow(obje,"N"); 

				dituLou(obje); 

				 

				if($("#subway_filter").val() != "")//如果地铁不为空，那么就显示地铁数据

				{ 

					this.map_subway();//显示地铁    

				}    

		});     

	}); 

	

	function buildNameClick()

	{

		

	}

	 

});



//区域片区点击获取坐标和查询条件

/**

* id :主键ID

* filter :查询条件

* name :隐藏表单name

* type :类型，用户点击的类型，A：地铁线路，B：地铁站点，Y：区域，N：片区，

* lat :纬度

* lng :经度

* parentId:上级ID，如地铁站点上级iD为地铁线路ID，片区上级id为区域id

*/

function clickArea(id,filter,name,type,lat,lng,parentId)

{  

 

	if(lng == "0" || lat == "0" )

	{

		if(type== "Y")

		{ 

			$("#subwayMap").text("地铁找房"); 

		}else if (type== "A" || type== "B")//地铁被选中

		{

			$("#areaMap").text("区域找房");  

		}else{

			$("#areaMap").text("区域找房"); 

		} 

		 

		$("#"+name).val("");

	}else{

		$("#"+name).val(filter);

	}

	

	dituObj["area_filterId"] = id.replace(",","");;

	dituObj["area_type"] = type;//区域为选中状态

	

	id = id.replace(",","");//去掉多余字符

	 

	//区域被选中 

	if(type== "Y")

	{  

		this.andZoom = 14; 

		$("#subway_filter").val("");//清空地铁

		this.subwaysid = ""; 

		this.subwayparentid = ""; 

		this.selectSubType = "";

		$("#subwayMap").text("地铁找房"); 

		

		sellat =lat;//获取经纬度

		sellng =lng;

	

	}else if (type== "A" || type== "B")//地铁被选中

	{ 

		if(type== "A")

		{ 

			this.andZoom = 13; 

			this.selectSubType = "A";

		}else{ 

			this.andZoom = 16; 

			this.selectSubType = "B";

			

			sellat =lat;//获取经纬度

			sellng =lng;

		} 

		$("#areaMap").text("区域找房");  

		$("#area_filter").val("");//清空区域

		$("#buildtype_filter").val("");//清空物业类型

	    $("#feature_filter").val("");//清空特色

	    $("#salesType_filter").val("");//清空销售状态

	    $("#kaipan_filter").val("");//清空开盘时间

	    $("#price_filter").val("");//清空价格区间

		this.subwaysid = id; 

		this.subwayparentid = parentId;

		

		

	}else{ 

		this.andZoom = 16; 

		$("#subwayMap").text("地铁找房");  

		$("#subway_filter").val("");//清空地铁 

		this.subwaysid = ""; 

		this.subwayparentid = "";  

		this.selectSubType = "";

		

		sellat =lat;//获取经纬度

		sellng =lng;

	}  

	



	

	countFilter();//拼接查询条件 

	if(lng == "0" || lat == "0" )

	{

		if(type == "A" && this.countFilterStr == "")

		{ 

			subwaysid =""; 

			andZoom = 12;  

			subwayXianlu = "Y"; 

			this.map.clearOverlays();//清楚地图覆盖物 

		 

			this.map.centerAndZoom(this.map.getCenter(), 12); //否则缩放级别为16，显示房源

		

		} else{  

			

			initMap();   

		}

	

	}else{   

		/*alert(this.andZoom);*/ 

		select_point = new BMap.Point(lng,lat); 

		this.map.centerAndZoom(select_point, this.andZoom);  

		//地图平移

		this.map.panBy(150,50,map.getCenter());  

	}

}    



function clickFilter(value,typeId,id,type)

{

	$("#"+typeId).val(value);

	$("#subway_filter").val("");

	countFilter();

	

	

	if(this.countFilterStr == null || this.countFilterStr == "")

	{

	 

		initMap(); 

	}else{

	

		andZoom = map.getZoom();

		this.map.centerAndZoom(this.map.getCenter(), map.getZoom()); //否则缩放级别为16，显示房源

		//this.map_moveend();

	}      

	//map_moveend();  

}   



//默认显示城市数据

function initMap()

{

	

	subwayXianlu = "Y"; 

	map.clearOverlays();//清楚地图覆盖物 

	 

	select_point = new BMap.Point($("#map_lng").val(), $("#map_lat").val());

	andZoom = 12;

	this.map.centerAndZoom(this.select_point, 12); //否则缩放级别为16，显示房源

	//地图平移

	map.panBy(150,50,map.getCenter());

	

	

}



//将所有的filter组合在一起

function countFilter()

{

	 var buildtype_filter = $("#buildtype_filter").val();//物业类型

	 var feature_filter = $("#feature_filter").val();//物业类型

	 var salesType_filter = $("#salesType_filter").val();//销售状态

	 var kaipan_filter = $("#kaipan_filter").val();//开盘时间

	 var price_filter = $("#price_filter").val();//价格区间

	 var order_filter = $("#order_filter").val();//排序

	 var area_filter = $("#area_filter").val();//区域条件

	 var subway_filter = $("#subway_filter").val();//地铁

	  

	 var counStr = buildtype_filter+feature_filter+salesType_filter+kaipan_filter+price_filter+order_filter+area_filter+subway_filter;

	 this.countFilterStr = counStr; 

/*	 alert(this.countFilterStr); */ 

 }    

 