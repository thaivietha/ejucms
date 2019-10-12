/**
 * Created by junyv on 2017/9/14.
 */
;(function($){
    //联动菜单
    $.fn.cate_select = function(options) {
        var settings = {
            field: 'J_cate_id',
            top_option: '请选择',
            id:'J_cate_select',
            parent_id : 'J_select',
            type : 'num',//返数据格式 num返回数字id str 返回父级id和自己id字符串 如;1,2,3
            level : 3//菜单层级 默认获取一级子菜单
        };
        if(options) {
            $.extend(settings, options);
        }

        var self = $(this),
            pid = self.attr('data-pid'),
            uri = self.attr('data-uri'),
            menuid = self.attr('data-menuid'),
            selected = self.attr('data-selected'),
            selected_arr = [];
        if(selected != undefined && selected != '0'){
            if(selected.indexOf('|')){
                selected_arr = selected.split('|');
            }else{
                selected_arr = [selected];
            }
        }
        self.nextAll('.'+settings.id).remove();
        $('<option value="">--'+settings.top_option+'--</option>').appendTo(self);
        $.getJSON(uri, {id:pid,menuid:menuid}, function(result){
            if(result.code == '1'){
                for(var i=0; i<result.data.length; i++){
                    $('<option value="'+result.data[i].id+'">'+result.data[i].name+'</option>').appendTo(self);
                }
            }
            if(selected_arr.length > 0){
                //IE6 BUG
                setTimeout(function(){
                    self.find('option[value="'+selected_arr[0]+'"]').attr("selected", true);
                    self.trigger('change');
                }, 1);
            }
        });

        var j = 1;
        $('#'+settings.parent_id).on('change','.'+settings.id, function(){
            var _this = $(this),
                _pid = _this.val(),
                _menuid = _this.attr('data-menuid');
            _this.nextAll('.'+settings.id).remove();
            if(_pid != ''){
                if($('.'+settings.id).length < settings.level){
                    $.getJSON(uri, {id:_pid,menuid:_menuid}, function(result){
                        if(result.code == '1'){
                            var _childs = $('<select class="'+settings.id+' mr10" data-pid="'+_pid+'"><option value="">--'+settings.top_option+'--</option></select>');
                            for(var i=0; i<result.data.length; i++){
                                $('<option value="'+result.data[i].id+'">'+result.data[i].name+'</option>').appendTo(_childs);
                            }
                            _childs.insertAfter(_this);
                            if(selected_arr[j] != undefined){
                                //IE6 BUG
                                //setTimeout(function(){
                                _childs.find('option[value="'+selected_arr[j]+'"]').attr("selected", true);
                                _childs.trigger('change');
                                //}, 1);
                            }
                            j++;
                        }
                    });}
                //$('#'+settings.field).val(_pid);
                if(settings.type == 'str'){
                    var c = [];
                    _this.prevAll('.'+settings.id).each(function(){
                        c.push($(this).val());
                    });
                    c.push(_pid);
                    _pid = c.sort(sortNumber).join(',');
                }
            }else{
                _pid = _this.attr('data-pid');
            }
            $('#'+settings.field).val(_pid);
        });
    }
})(jQuery);
