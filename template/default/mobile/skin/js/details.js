// var slideout = new Slideout({
// 	'panel': document.getElementById('y_sidebarl'),
// 	'menu': document.getElementById('y_sidebarr'),
// 	'padding': 280,
// 	'tolerance': 70,
// 	'side': 'right',
//   });
  
//   document.querySelector('.y_publicright').addEventListener('click', function() {
// 	slideout.toggle();
// 	document.querySelector('.y_sidebarbg').style.display="block";
//   });
//   document.querySelector('.y_sidebarbg').addEventListener('click', function() {
//   	slideout.toggle();
//   	this.style.display="none";
//   });



  /*
*  楼盘预售许可证弹窗
*  
*/
$(function(){
    var lic_id;  //为了这些变量在其它地方用；
    $('.y_ckysz').on('click',function(){
        var $that = $(this);
        var height =  $('.y_licence').outerHeight();
        var width =  $('.y_licence').outerWidth();
        CreatePopLayerDiv6(width,width,'/public/licence');
        $('#offDiv1').css({'top':height+'px'}).animate({top:'20%'})
        // 向弹窗传数据
        parent.lic_id = $that.attr('data-id');                        //把楼盘名称传向父级
    })
})
//创建一个弹出层,width 宽度，height 高度，url
function CreatePopLayerDiv6(width,height,url){
    var Iheight=$(window).outerHeight(); 
    var Iwidth =$(window).outerWidth(); 
    var heights = height || 300; 
    var widths = width || 500; 
    var Oheight= (Iheight -heights) / 2; 
    var Owidth = (Iwidth - widths) /2;
    var div ='<div id="InDiv6" style="width:'+Iwidth+'px;height:'+Iheight+'px;background:rgba(0,0,0,0.6);position:fixed;z-index:10000;top:0;left:0;">';
        div+='<div id="offDiv6" style=" width:100%; height:100%; left:0px; top:30%; position:fixed;z-index:100003;">';
        div+='<div id="Content6"></div>';
        div+='</div>';
        div+='</div>';
    $(document.body).append(div); 
    if(url != ""){ 
        $("#Content6").load(url); 
    } 
} 
//移除弹出层 
function RemoveDiv6(){
    $("#InDiv6").remove();
    $("#offDiv6").remove();
} 
function btnCloses1(){ 
    RemoveDiv6(); 
}




$('.m_licence_zk').on('click',function(){

    $('.m_licencemain').attr('id','m_licencemain');
    $('.m_licence_zk').hide();
    $('.m_licence_sq').show();

})

$('.m_licence_sq').on('click',function(){

    $('.m_licencemain').attr('id','');
    $('.m_licence_sq').hide();
    $('.m_licence_zk').show();

})