$(document).ready(
    function () {
        /*
   * 户型图片轮播
   * */
        var img_w=$(".pic .show .lunbo a img").width()
        var img_x=$(".pic .show .lunbo a ").length
        $(".pic .show .lunbo").width(img_w*(img_x+1))
        $(".pic").mouseenter(
            function () {
                if (img_x>1){
                    $(".pic .left_btn").show()
                    $(".pic .right_btn").show()
                }
            }
        )
        $(".pic").mouseleave(
            function () {
                $(".pic .left_btn").hide()
                $(".pic .right_btn").hide()
            }
        )

        if($(".layer_box .layer .lunbo ul li").length<2){

            $(".layer_box .layer .right_btn").hide()
            $(".layer_box .layer .left_btn").hide()
        }
        var index_x=0
        $(".number .all").text($(".pic .show .lunbo a").length)
        $(".layer_box table .layer .all").text($(".layer_box table .layer ul li").length)
        $(".pic .show .lunbo a:last").after($(".pic .show .lunbo a:first").clone())
        $(".pic .right_btn").click(
            function () {
                if(index_x<$(".pic .show .lunbo a").length-1){
                    index_x++
                    if(index_x==$(".pic .show .lunbo a").length-1){

                        $(".number .index").text(1)
                        $(".layer_box table .layer .index").text(1)
                    }else{
                        $(".number .index").text(index_x+1)
                        $(".layer_box table .layer .index").text(index_x+1)
                    }

                    $(".pic .show .lunbo").animate({left:-index_x*img_w},500,function () {
                        if(index_x==$(".pic .show .lunbo a").length-1){
                            index_x=0
                            $(".number .index").text(index_x+1)
                            $(".layer_box table .layer .index").text(index_x+1)
                            $(".pic .show .lunbo").css("left",0)
                        }
                    })
                    layer_x=index_x
                    $(".layer_box .layer .photo .lunbo").animate({left:-layer_x*600},300,function(){
                        if(layer_x==$(".layer_box .layer .photo ul li").length-1){
                            $(".layer_box .layer .photo .lunbo").css("left",0)
                            layer_x=0
                        }
                    })
                }
            }
        )


        $(".pic .left_btn").click(
            function () {
                if(index_x==0){
                    index_x=$(".pic .show .lunbo a").length-1
                    $(".number .index").text(index_x)
                    $(".layer_box table .layer .index").text(index_x)
                    $(".pic .show .lunbo").css("left",-index_x*img_w)
                    index_x--
                    $(".pic .show .lunbo").animate({left:-index_x*img_w},500)
                    $(".layer_box .layer .photo .lunbo").css("left",-($(".layer_box .layer .photo ul li").length-1)*600)
                    layer_x=index_x
                    $(".layer_box .layer .photo .lunbo").animate({left:-(index_x)*600},300)
                }else{
                    index_x--
                    $(".number .index").text(index_x+1)
                    $(".layer_box table .layer .index").text(index_x+1)
                    $(".pic .show .lunbo").animate({left:-index_x*img_w},500)
                    layer_x=index_x
                    $(".layer_box .layer .photo .lunbo").animate({left:-(layer_x)*600},300)
                }
            }
        )




        /* 点击查看大图 */
        $(".layer_box .layer .photo .lunbo").width(($(".layer_box .layer .photo ul li").length+1)*600)
        $(".layer_box .layer .photo .lunbo ul li:last").after($(".layer_box .layer .photo .lunbo ul li:first").clone())
        var layer_x=index_x
        $(".layer_box .layer .right_btn img").click(
            function(){

                if(layer_x<$(".layer_box .layer .photo ul li").length-1){
                    layer_x++
                    if(layer_x==$(".layer_box .layer .photo ul li").length-1){

                        $(".layer_box table .layer .index").text(1)
                    }else{
                        $(".layer_box table .layer .index").text(layer_x+1)
                    }
                    $(".layer_box .layer .photo .lunbo").animate({left:-layer_x*600},300,function(){
                        if(layer_x==$(".layer_box .layer .photo ul li").length-1){
                            $(".layer_box .layer .photo .lunbo").css("left",0)
                            layer_x=0
                            $(".layer_box table .layer .index").text(layer_x+1)
                        }
                    })

                }
            }
        )
        /* 点击查看大图 */
        $(".layer_box .layer .left_btn img").click(
            function(){
                if(layer_x==0){
                    $(".layer_box .layer .photo .lunbo").css("left",-($(".layer_box .layer .photo ul li").length-1)*600)
                    layer_x=$(".layer_box .layer .photo ul li").length-1
                    $(".layer_box .layer .index").text(layer_x)
                    layer_x--
                    $(".layer_box .layer .photo .lunbo").animate({left:-(layer_x)*600},300)
                }else{
                    layer_x--
                    $(".layer_box .layer .photo .lunbo").animate({left:-(layer_x)*600},300)
                    $(".layer_box .layer .index").text(layer_x+1)
                }
            }
        )

        $(".pic .show").click(
            function () {
                $(".layer_box").show()
            }
        )
        $(".pic .look").click(
            function () {
                $(".layer_box").show()
            }
        )

        $(".layer_box table .layer .close").click(
            function(){
                layer_x=index_x
                $(".layer_box .layer .photo .lunbo").css("left",-(layer_x)*600)
                $(".layer_box").hide()
                if(layer_x==0){
                    $(".layer_box table .layer .index").text(1)
                }else{
                    $(".layer_box table .layer .index").text(layer_x+1)
                }
            }
        )
        $(".layer_box").click(
            function(){
                $(".layer_box").hide()
            }
        )
        $(".layer_box table .layer").click(
            function(e){
                e.stopPropagation();
            }
        )
    }
)