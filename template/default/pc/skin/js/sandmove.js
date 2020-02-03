/**
 * 海南俱进科技有限公司 版权所有 盗版必究
 * TP房产系统
 * Created by junyv on 2019/8/27.
 */
window.onload = function(){
    var draging = false, lastPoint;
    var body = document.body;
    var img = document.getElementById('img') || false;
    img.onmousedown = function(e){
        e = e || window.event;
        var x = e.clientX;
        var y = e.clientY;
        if(!lastPoint){
            lastPoint = {};
        }
        lastPoint.x = x;
        lastPoint.y = y;
        draging = true;
        if(e.preventDefault){
            e.preventDefault();
        }else{
            return false;
        }
    }
    img.ondragstart = function(e){
        e = e || window.event;
        if(e.preventDefault){
            e.preventDefault();
        }else{
            return false;
        }
    }
    img.onmouseup = function(){
        draging = false;
        lastPoint = undefined;
    }
    if(document.addEventListener){
        body.addEventListener('mousemove',function(e){
            onMouseMove(e);
        },false);
        body.addEventListener('mouseup',onMouseUp,false);
    }else{
        body.attachEvent('onmousemove',function(){
            var event = window.event;
            onMouseMove(event);
        })
        body.attachEvent('onmouseup',onMouseUp);
    }

    function onMouseMove(e){
        if(!draging){
            return;
        }
        var img = document.getElementById('img');
        var ldxx_img = document.getElementById('ldxx-img');
        if(lastPoint){
            var x = e.clientX , y = e.clientY;
            var imgTop = parseFloat(img.style.top || '0');
            var imgLeft = parseFloat(img.style.left || '0');
            var changeX = x - lastPoint.x , changeY = y - lastPoint.y;
            var dis_X = imgLeft + changeX;
            var dis_Y = imgTop + changeY;
            var sub_img = img.getElementsByTagName('img')[0];
            var sub_img_width = sub_img.offsetWidth;
            var sub_img_height = sub_img.offsetHeight;
            var img_width = ldxx_img.offsetWidth;
            var img_height = ldxx_img.offsetHeight;
            var dis_w = img_width -  sub_img_width;
            var dis_h = img_height - sub_img_height;
            if(dis_X>0){
                dis_X = 0;
            }
            if(dis_X < dis_w){
                dis_X = dis_w;
            }

            if(dis_Y>0){
                dis_Y = 0;
            }
            if(dis_Y < dis_h){
                dis_Y = dis_h;
            }

            img.style.top = dis_Y + 'px';
            img.style.left = dis_X + 'px';
            lastPoint.x = x, lastPoint.y = y;
        }
    }
    function onMouseUp(){
        draging = false;
        lastPoint = undefined;
    }
}