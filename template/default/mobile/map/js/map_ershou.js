
/**
 * 百度地图
 */
var BMapApplication = {
    'map' : null,                      // 百度地图实例
    'panorama' : null,                 // 街景地图实例
    'sPoint' : null,                   // 基础地图坐标点实例
    'pPoint' : null,                   // 街景地图坐标点
    'bssw'   : null,                  //可视化区域左下角坐标
    'bsne'   : null,                  //可视化区域右上角坐标
    'viewArea' : true,//是否只搜索可视区域内
    'requestUrl' : null,//请求地址
    'requestParam' : null,//请求参数
    'requestNum'   : 0,
    '_point' : null,
    '_text'  : null,
    '_overText' : null,
    '_type'     : 0,
    '_url'      : '',
    '_ite'      :null,              //数据集合
    '_ite_arr'  : [],              //数据集合（多组）
    'positions' : ["0", "-20", "-10", "-30"],//三角箭头位置
    'backgroundColors' : ["#33C0D0", "#fc5172", "#ff9600", "#9e9e9e"],//背景颜色
    'borders' : ["#0D5780", "#CC0066", "#FF6600", "#4B4B4B"],//边框颜色
    /**
     * 初始化方法
     * @param lng
     * @param lat
     * @param elemId
     */
    'init' : function (args){
        var lng = args.lng ? args.lng : 0;
        var lat = args.lat ? args.lat : 0;
        var mapContainerId = args.mapContainerId ? args.mapContainerId : '';
        var streetContainerId = args.streetContainerId ? args.streetContainerId : '';
        if (mapContainerId != '')
        {
            this.setBmapContainer(mapContainerId);
            this.setSPoint(lng, lat);
        }
        if (streetContainerId != '')
        {
            this.setPanoramaContainer(streetContainerId);
            this.setPPoint(lng, lat);
        }
    },
    /**
     * 设置基本地图容器
     * @param elemId
     */
    'setBmapContainer' : function (elemId){
        elemId = elemId == undefined ? 'allmap' : elemId;
        this.map = (this.map == null) ? new BMap.Map(elemId,{ enableMapClick: false,minZoom : 9 }) : this.map;
    },
    /* 清空基本地图容器 */
    'clearBmapContainer' : function (){
        this.map = null;
    },
    /**
     * 设置街景地图容器
     * @param elemId
     */
    'setPanoramaContainer' : function (elemId){
        this.panorama = (this.panorama == null) ? new BMap.Panorama(elemId, {
            albumsControl: true    // 显示相册控件
        }) : this.panorama;
    },
    /**
     * 设置经纬坐标点
     * @param lng
     * @param lat
     */
    'setSPoint' : function (lng, lat){
        this.sPoint = (this.sPoint == null) ? new BMap.Point(lng, lat) : this.sPoint;
    },
    /**
     * 设置 街景地图经纬度坐标
     * @param lng
     * @param lat
     */
    'setPPoint' : function (lng, lat){
        this.pPoint = (this.pPoint == null) ? new BMap.Point(lng, lat) : this.pPoint;
    },
    /**
     * 根据球面坐标获得平面坐标
     * @param poi
     * @returns {*}
     */
    'getMecator' : function (poi){
        return this.map.getMapType().getProjection().lngLatToPoint(poi);
    },
    /**
     * 根据平面坐标获得球面坐标
     * @param mecator
     * @returns {*}
     */
    'getPoi' : function (mecator){
        return this.map.getMapType().getProjection().pointToLngLat(mecator);
    },
    /**
     * 街景地图
     */
    'getStreetMap' : function (){
        this.panorama.setPosition(this.pPoint);
        this.panorama.setPov({pitch: 5, heading: 343.92});
        //设置相册位置为右上角
        this.panorama.setOptions({
            albumsControlOptions: {
                anchor: BMAP_ANCHOR_BOTTOM_LEFT
            }
        });
        //设置偏移量，距离上面15px，距离左边100px（距离那边受anchor位置的影响）
        this.panorama.setOptions({
            albumsControlOptions: {
                offset: new BMap.Size(0, 0)
            }
        });
        //设置相册的长度和图片大小,相册的最大宽度为60%，相册内图片的大小为80px
        this.panorama.setOptions({
            albumsControlOptions: {
                maxWidth: '60%',
                imageHeight: 80,
                border:0
            }
        });
    },
    //初始化地图
    'getMap' : function(){
        var _this = this;                         // 解决闭包作用域问题
        this.map.enableScrollWheelZoom();
        this.map.centerAndZoom(this.sPoint,13);
        //监听地图加载完成事件---获取数据
        this.map.addEventListener("tilesloaded",function(){_this.getData();});
    },
    "setCenter" :function(lng,lat,name){
        if(lng!=0 && lat!=0)
        {
            this.map.centerAndZoom(new BMap.Point(lng,lat),13);
        }else{
            this.map.centerAndZoom(name,13);
        }
    },
    //获取可视化区域
    "getMapBounds" : function(){
        var bounds = this.map.getBounds();   //获取可视区域
        this.bssw = bounds.getSouthWest();   //可视区域左下角
        this.bsne = bounds.getNorthEast();
    },
    "getData" : function(){
        var that = this,pointArr = [];
        this.getMapBounds();
        //按条件筛选在地图可视范围内 按楼盘名搜索不限制

        if(this.viewArea)
        {
            this.requestParam.bssw_lat = this.bssw.lat;
            this.requestParam.bssw_lng = this.bssw.lng;
            this.requestParam.bsne_lat = this.bsne.lat;
            this.requestParam.bsne_lng = this.bsne.lng;
        }else{
            this.requestNum++;
        }
        this.requestParam.zoom     = this.map.getZoom();//获取地图缩放级别
        //解决按楼盘名称搜索死循环问题
        if(this.requestNum > 1){
            this.requestNum = 0;
            this.viewArea = true;
            this.requestParam.keyword = null;
            return false;
        }
        that.map.clearOverlays();
        if(this.requestUrl){
            layer.msg('数据加载中……',{time:10000});
            $.get(this.requestUrl,this.requestParam,function(result){
                layer.closeAll();
                if(result.code == 1 && result.data)
                {
                    var gettpl = document.getElementById('template').innerHTML;
                    laytpl(gettpl).render(result.data, function(html){
                        $('#right_map_ul').html(html);
                    });
                    var data = result.estate ? result.estate:result.data;
                    $(data).each(function (i, ite) {
                        that._ite_arr[ite.aid] = ite;
                        var unit = ite.unit?ite.unit:'套';
                        var price = ite.price;
                        if(!isNaN(ite.price)){
                            price += unit;
                        }
                        var txt = ite.title, mouseoverTxt = txt + " " + price;
                        var point = new BMap.Point(ite.lng,ite.lat);
                        pointArr.push(point);
                        that.setComplexPrototype();
                        var myCompOverlay = new that.ComplexCustomOverlay(point,txt,ite);
                        that.map.addOverlay(myCompOverlay);
                    });
                    //按楼盘名称搜索所有结果显示在可视区域内
                    if(!that.viewArea)
                    {
                        var view = that.map.getViewport(pointArr);
                        var mapZoom = view.zoom;
                        var centerPoint = view.center;
                        that.map.centerAndZoom(centerPoint,mapZoom);
                    }

                }
            });
        }
    },
    //获取数据
    "ComplexCustomOverlay" : function(point, text,ite){
        this._point = point;
        this._text = text;
        this._ite = ite;

    },
    //生成区域楼盘总数
    "setClustererComplexPrototype" : function(){
        this.ComplexCustomOverlay.prototype = new BMap.Overlay();
        var _this = this;
        this.ComplexCustomOverlay.prototype.initialize = function(){
            var that = this;
            var div = this._div = document.createElement("ul");
            div.style.position = "absolute";
            div.style.zIndex = BMap.Overlay.getZIndex(this._point.lat);

            div.setAttribute("class","lpNum labelBubble");
            var li = document.createElement("li");
            div.appendChild(li);
            li.style.backgroundColor = "rgba(241,80,68,.9)";
            var a = li.appendChild(document.createElement("a"));
            a.innerHTML = that._text;
            _this.map.getPanes().labelPane.appendChild(div);
            div.onmouseout = function () {
                li.style.backgroundColor = "rgba(241,80,68,.9)";
            };
            div.onmouseover = function () {
                li.style.backgroundColor = "rgba(84,144,244,.9)";
            };
            div.onclick = function(){
                _this.map.setZoom(_this.map.getZoom()+3);
                _this.setCenter(that._point.lng,that._point.lat);
                _this.requestNum = 0;
            };
            return div;
        };
        this.ComplexCustomOverlay.prototype.draw = function(){
            var map = _this.map;
            var pixel = map.pointToOverlayPixel(this._point);
            this._div.style.left = pixel.x  + "px";
            this._div.style.top  = pixel.y - 30 + "px";
        }
    },
    //生成地图楼盘
    "setComplexPrototype" : function(){
        this.ComplexCustomOverlay.prototype = new BMap.Overlay();
        var _this = this;
        this.ComplexCustomOverlay.prototype.initialize = function(){
            var that = this;
            var div = this._div = document.createElement("div");
            div.style.position = "absolute";
            div.style.zIndex = BMap.Overlay.getZIndex(this._point.lat);
            div.style.backgroundColor = "rgba(241,80,68,.9)";//_this.backgroundColors[that._type];
            div.style.border = "1px solid " + _this.borders[that._type];
            div.style.color = "white";
            div.style.height = "18px";
            div.style.padding = "2px";
            div.style.lineHeight = "18px";
            div.style.whiteSpace = "nowrap";
            div.style.MozUserSelect = "none";
            div.style.fontSize = "12px";
            var span = this._span = document.createElement("span");
            div.appendChild(span);
            span.appendChild(document.createTextNode(that._text));

            var arrow = this._arrow = document.createElement("div");
            arrow.style.background = "url(../template/default/pc/map/images/label.png) no-repeat";
            arrow.style.backgroundPosition = "0px " + _this.positions[that._type] + "px";
            arrow.style.position = "absolute";
            arrow.style.width = "11px";
            arrow.style.height = "10px";
            arrow.style.top = "22px";
            arrow.style.left = "10px";
            arrow.style.overflow = "hidden";
            div.appendChild(arrow);
            div.onmouseover = function(){
                this.style.backgroundColor =  "rgba(84,144,244,.9)";
            };
            div.onmouseout = function(){
                this.style.backgroundColor =  "rgba(241,80,68,.9)";
            };
            div.onclick = function(){
                _this.makeInfoWindow(that._ite.aid);
            };
            _this.map.getPanes().labelPane.appendChild(div);

            return div;
        };
        this.ComplexCustomOverlay.prototype.draw = function(){
            var map = _this.map;
            var pixel = map.pointToOverlayPixel(this._point);
            this._div.style.left = pixel.x - parseInt(this._arrow.style.left) + "px";
            this._div.style.top  = pixel.y - 30 + "px";
        }
    },
    //生成楼盘详情信息弹出框
    "makeInfoWindow" : function (key) {
        _ite = this._ite_arr[key];
        if (_ite.phone_code){
            _ite.sale_phone += '转'+_ite.phone_code;
        }
        $("#list_item").html("");
        var html = '<a class="item" href="'+ _ite.arcurl+'">' +
            '<img src="'+_ite.litpic+'">' +
            '<div class="item_info">'+
            '<div class="item_title">'+_ite.title+'</div>' +
            '<div class="item_youhui">'+
            '<div class="favourable">'+_ite.manage_type+'</div>' +
            '</div>'+
            '<div class="item_address">'+_ite.address+'</div>'+
            '<div class="item_bot">'+_ite.characteristic_name_i+'</div>'+
            '<div class="item_price"><span>价    格：<label>'+_ite.total_price+'</label>万元</span></div>' +
            '</div>'+
            '<div class="cl"></div>' +
            '</a>';
        $("#list_item").append(html);
        $("#list_item").slideDown(500,function () {
            var hh = $("#list_item").height()
            $("#search_box").animate({bottom: hh + 15}, 400)
        });
    }

};

