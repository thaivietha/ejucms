var pageCount = 1;//总页数	
var regExp = /_ueditor_page_break_tag_/;//根据某处字符来分页	
var saveContent;//用于保存分页数据	
var content, pageList;//保存全局ID		
$(document).ready(function(){		
	UeInitialize("#content-box","#page");	
});
UeInitialize = function (id,page) {		
	var cTxt = $(id).html();		
	content = $(id);		
	pageList = $(page);		
	if (cTxt != null && regExp.test(cTxt)) {					
		saveContent = cTxt.split(regExp);						
		pageCount = saveContent.length;					
	}		
	window.UePageContent(1);	
};		
UePageContent = function (pageIndex) {   
	 if (pageIndex >= 1 && pageIndex <= pageCount && saveContent != null && saveContent.length >= 0) {       
	 	 var pageHtml = pageList;       
		  if ((parseInt(pageIndex) - 1) <= saveContent.length) {            
		  	content.html(saveContent[parseInt(pageIndex) - 1]);       
		  }        
		  pageHtml.html("");
		  var innHtml = "";
		  if(pageIndex>1){
		  	innHtml += "<li><a target='_self' href='javascript:UePageContent("+(parseInt(pageIndex) - 1)+")'>«</a></li>";
		  }else{
		  	innHtml += "<li class='disabled'><span>«</span></li>";
		  }		  
		  for(i=1;i<=pageCount;i++){
		  	  var active="";
		  	  if(pageIndex == i){
		  	  	active = "active";
		  	  }
		  	  innHtml += "<li class='"+active+"'><a target='_self' href='javascript:UePageContent(" + (parseInt(i)) + ")'>"+i+"</a></li>";
		  }
		  if(pageIndex<pageCount){
		  	innHtml += "<li><a target='_self' href='javascript:UePageContent("+(parseInt(pageIndex) + 1)+")'>»</a></li>";
		  }else{
		  	innHtml += "<li class='disabled'><span>»</span></li>";
		  }
		  //innHtml += "<li><a target='_self' href='javascript:UePageContent(" + pageCount + ")'>»</a></li>";       
		  pageHtml.html(innHtml);
		  $('html,body').animate({scrollTop:0},1000);
		  /*
		  var innHtml = "页数：" + pageIndex + "/" + pageCount;
		  innHtml += "<a target='_self' href='javascript:UePageContent(1)'>首页</a>";       
		  if (pageIndex > 1) {           
		  	 innHtml += "<a target='_self' href='javascript:UePageContent(" + (parseInt(pageIndex) - 1) + ")'>上一页</a>";        					              }        
		  if (pageIndex < pageCount) {           
		  		 innHtml += "<a target='_self' href='javascript:UePageContent(" + (parseInt(pageIndex) + 1) + ")'>下一页</a>";              
		  }
		  innHtml += "<a target='_self' href='javascript:UePageContent(" + pageCount + ")'>末页</a>";       
		  pageHtml.html(innHtml);
		  */
	}
}