var basePath = "";
var dataConfig = [ {
    type : "traffic",
    item : [ {
        key : "公交",
        icon : "traffic"
    }, {
        key : "地铁",
        icon : "traffic"
    } ]
}, {
    type : "edu",
    item : [ {
        key : "幼儿园",
        icon : "edu"
    }, {
        key : "小学",
        icon : "edu"
    }, {
        key : "中学",
        icon : "edu"
    }, {
        key : "大学",
        icon : "edu"
    } ]
}, {
    type : "hospital",
    item : [ {
        key : "医院",
        icon : "hospital"
    }, {
        key : "药店",
        icon : "hospital"
    } ]
}, {
    type : "shop",
    item : [ {
        key : "商场",
        icon : "shop"
    }, {
        key : "超市",
        icon : "shop"
    }, {
        key : "便利店",
        icon : "shop"
    }, {
        key : "市场",
        icon : "shop"
    } ]
}, {
    type : "life",
    item : [ {
        key : "ATM",
        icon : "life"
    }, {
        key : "银行",
        icon : "life"
    }, {
        key : "快餐",
        icon : "life"
    }, {
        key : "餐厅",
        icon : "life"
    }, {
        key : "咖啡厅",
        icon : "life"
    } ]
}, {
    type : "happy",
    item : [ {
        key : "电影院",
        icon : "happy"
    }, {
        key : "KTV",
        icon : "happy"
    }, {
        key : "体育馆",
        icon : "happy"
    } ]
} ];

var distance = 500;
var local;
var mPoint;
var map;
var f;
var marker1;


function initMapData() {
        var _longitude =$('#longitude').attr('data-jwd'); //获取经纬度

        var pintx = _longitude.split(',')[0];
        var pinty = _longitude.split(',')[1];
        _longitude = new BMap.Point(pintx,pinty);

    map = new BMap.Map("l-map"); // 创建Map实例
    mPoint = new BMap.Point(pintx, pinty);
    map.addControl(new BMap.NavigationControl({
        anchor : BMAP_ANCHOR_TOP_LEFT
    }));
    map.centerAndZoom(mPoint, 14);
    var e = {
        onSearchComplete : function(p) {
            map.clearOverlays();
            map.addOverlay(marker1);
            if (local.getStatus() == BMAP_STATUS_SUCCESS) {
                var temp = "";
                var m = 1;
                var flag=false;
                if($("#localSearch ul li.active").attr("id")=="traffic"){
                    flag = true;
                }
                if(flag){
                    for (var n =  p.length-1; n >=0; n--) {
                        var t = [];
                        var size =  p[n].getCurrentNumPois();
                        for (var q = 0; q < size; q++) {
                            var u = p[n].getPoi(q), s = map.getDistance(
                                u.point, mPoint).toFixed(0);
                            if (s <= distance) {
                                t.push({
                                    title : u.title,
                                    address : u.address,
                                    t_distance : s,
                                    point : u.point,
                                    type : f[n]
                                });
                            }
                        }
                        if (t.length > 0) {
                            t.sort(function(j, k) {
                                return j.t_distance - k.t_distance
                            });
                            temp += "<ul><h5>" + p[n].keyword + "</h5>";
                            var metroFlag = false;
                            if(p[n].keyword=="地铁"){
                                metroFlag=true;
                            }
                            for (var i = 0; i < t.length; i++) {
                                if(flag&&i>=3){

                                }else{
                                    var metro = "";
                                    if(metroFlag){
                                        metro=t[i].address.split('; ')[0];
                                    }
                                    temp += '<li onclick="pointToClick('
                                        + t[i].point.lng + ',' + t[i].point.lat
                                        + ',' + m + ')" onmouseover="pointTo('
                                        + m + ')"><span>A' + m + '</span><em>'
                                        +metro+t[i].title + '</em> <i> '
                                        + t[i].t_distance + 'm</i></li>';
                                }

                                var myCompOverlay = new ComplexOverlay(t[i], m);
                                map.addOverlay(myCompOverlay);
                                m++;
                            }
                            temp += "</ul>";
                        }
                    }
                }else{
                    for (var n =  0; n <p.length; n++) {
                        var t = [];
                        var size =  p[n].getCurrentNumPois();

                        for (var q = 0; q < size; q++) {
                            var u = p[n].getPoi(q), s = map.getDistance(
                                u.point, mPoint).toFixed(0);
                            if (s <= distance) {
                                t.push({
                                    title : u.title,
                                    address : u.address,
                                    t_distance : s,
                                    point : u.point,
                                    type : f[n]
                                });
                            }
                        }
                        if (t.length > 0) {
                            t.sort(function(j, k) {
                                return j.t_distance - k.t_distance
                            });
                            temp += "<ul><h5>" + p[n].keyword + "</h5>";
                            for (var i = 0; i < t.length; i++) {
                                if(flag&&i>=3){

                                }else{
                                    temp += '<li onclick="pointToClick('
                                        + t[i].point.lng + ',' + t[i].point.lat
                                        + ',' + m + ')" onmouseover="pointTo('
                                        + m + ')"><span>A' + m + '</span><em>'
                                        + t[i].title + '</em> <i> '
                                        + t[i].t_distance + 'm</i></li>';
                                }

                                var myCompOverlay = new ComplexOverlay(t[i], m);
                                map.addOverlay(myCompOverlay);
                                m++;
                            }
                            temp += "</ul>";
                        }
                    }
                }
                $(".curList").html(temp);

            }else{
                $(".curList").html('');
            }
        },
        pageCapacity : 12
    };

    local = new BMap.LocalSearch(map, e);
    f = getKeys(dataConfig, 'traffic');
    local.searchNearby(f, mPoint, distance);

    // 自定义覆盖物(周围图标)
    function ComplexOverlay(t, index) {
        this._t = t;
        this._index = index;
    }
    ComplexOverlay.prototype = new BMap.Overlay();
    ComplexOverlay.prototype.initialize = function(map) {
        this._map = map;
        var divStr = '<div id="cover_flag' + this._index
            + '" class="cover_flag cover_unselect" title="'
            + this._t.title + '" address="' + this._t.address
            + '" pointlng="' + this._t.point.lng + '" pointlat="'
            + this._t.point.lat + '">A' + this._index + '</div>';
        var div = parseDom(divStr);
        this._div = div[0];
        var that = this;
        this._div.onmouseover = function() {
            $(".cover_flag").removeClass("cover_select").addClass(
                "cover_unselect");
            $(this).removeClass("cover_unselect").addClass("cover_select");
        };
        this._div.onclick = function() {
            var divPoint = new BMap.Point($(this).attr("pointlng"), $(this)
                .attr("pointlat"));
            var opts = {
                width : 80, // 信息窗口宽度
                height : 60, // 信息窗口高度
                title : $(this).attr("title"), // 信息窗口标题
                offset : new BMap.Size(0, -13),
                enableAutoPan : true,
                enableCloseOnClick : true
            }
            var infoWindow = new BMap.InfoWindow(
                "<p style='font-size:12px;color:#666;'><span style='color:#333;'>地址：</span>"
                + $(this).attr("address") + "</p>", opts); // 创建信息窗口对象
            map.openInfoWindow(infoWindow, divPoint); // 开启信息窗口
        };
        map.getPanes().labelPane.appendChild(this._div);
        return this._div;
    }
    ComplexOverlay.prototype.draw = function() {
        var map1 = this._map;
        var pixel = map1.pointToOverlayPixel(this._t.point);
        this._div.style.left = pixel.x - 10 + "px";
        this._div.style.top = pixel.y - 30 + "px";
    }

    function ComplexOverlayPosition(position) {
        this._position = position;
    }
    ComplexOverlayPosition.prototype = new BMap.Overlay();
    ComplexOverlayPosition.prototype.initialize = function(map) {
        this._map = map;
        var divStr = '<div id="imasgdss" class="cover_position"></div>';
        var div = parseDom(divStr);
        this._div = div[0];
        map.getPanes().labelPane.appendChild(this._div);
        return this._div;
    }
    ComplexOverlayPosition.prototype.draw = function() {
        var map1 = this._map;
        var pixel = map1.pointToOverlayPixel(this._position);
        this._div.style.left = pixel.x - 10 + "px";
        this._div.style.top = pixel.y - 30 + "px";
    }

    marker1 = new ComplexOverlayPosition(mPoint);
    map.addOverlay(marker1);
}

function loadScript() {
	var script = document.createElement("script");
	script.src = "https://api.map.baidu.com/api?v=2.0&ak=yXFAtK1UdGGSmKNk865VQdVr&callback=initMapData";
	document.body.appendChild(script);
}

// 在地图上显示
window.onload = loadScript;
$().ready(function() {

	basePath = $('#basePath').val();

	var url = basePath + "red/haveOrNotActivity";
	var romId = $("#romId").val();


	$('#currentUrl').val(window.location.href);
	$('#lastUrl').val(document.referrer);
    $(function(){
        var _ali=$("#rimMating-new  .rimTab .tabNav ul li");
        var _adiv=$("#rimMating-new  .rimTab .tabCont .contCur");
        _ali.click(function () {
            var _this=$(this);
            var index=_ali.index(_this);
            _ali.removeClass();
            _this.addClass("active");
            _adiv.eq(index).addClass("active").siblings().removeClass("active");
        });
    });

    $(function(){
        var _bli=$("#rimMating-new  .rimTab .tabCont .contCur ol li");
        _bli.click(function () {
            var _this=$(this);
            var index=_bli.index(_this);
            _bli.removeClass();
            _this.addClass("current");
        });
    });
    var _ali = $("#localSearch ul li");
    _ali.click(function() {
        var _this = $(this);
        var index = _ali.index(_this);
        var nameStr = _ali.eq(index).attr("id");
        f = getKeys(dataConfig, nameStr);
        local.searchNearby(f, mPoint, distance);
    });

    var _bli = $("#distance ol li");
    _bli.click(function() {
        var _this = $(this);
        var index = _bli.index(_this);
        distance = parseInt(_bli.eq(index).attr("value"));
        local.searchNearby(f, mPoint, distance);
    });
});



function getKeys(e, g) {
    var c = [];
    for (var f = 0; f < e.length; f++) {
        var type = e[f].type;
        var h = e[f].item;
        if (type == g) {
            for (var d = 0; d < h.length; d++) {
                c.push(h[d].key)
            }
        }
    }
    return c;
}

function pointTo(m) {
    $(".cover_flag").removeClass("cover_select").addClass("cover_unselect");
    $("#cover_flag" + m).removeClass("cover_unselect").addClass("cover_select");
}

function pointToClick(lng, lat, m) {
    var point = new BMap.Point(lng, lat);
    map.panTo(point);
    $("#cover_flag" + m).click();
}

function parseDom(arg) {
    var objE = document.createElement("div");
    objE.innerHTML = arg;
    return objE.childNodes;

}

