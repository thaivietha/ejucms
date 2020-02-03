$(function(){
    $("#ban_lists a").on('click',function(){
        var id = $(this).data('id');
        $(this).addClass('active').parent().siblings().find('.active').removeClass('active');
        $("#ban_info_"+id).siblings().each(function(){
            if(this.className !== 'tab_nav'){
                $(this).hide();
            }
        });
        $("#ban_info_"+id).show();
    });
    $(".ban").on('click',function(){
        var id = $(this).data('id');
        $("#ban_lists").find('.active').removeClass('active');
        $("#ban_lists").find("a[data-id='"+id+"']").addClass('active');
        $("#ban_info_"+id).siblings().each(function(){
            if(this.className !== 'tab_nav'){
                $(this).hide();
            }
        });
        $("#ban_info_"+id).show();
    });
});