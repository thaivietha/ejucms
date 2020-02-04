<?php
/**
 * Created by PhpStorm.
 * User: 28773
 * Date: 2019/7/24
 * Time: 15:07
 */

namespace think\template\taglib\eju;

use think\Request;
use think\Db;

class TagForm extends Base
{
    private $come_from = '';
    //初始化
    protected function _initialize()
    {
        parent::_initialize();
        $this->tid = I("param.tid/s", ''); // 应用于栏目列表
        /*tid为目录名称的情况下*/
        $this->tid = $this->getTrueTypeid($this->tid);

        $aid = I("param.aid/s", '');
        if ($aid){
            $archives = M('Archives')->field('title,typeid')->where([ 'aid'=> $aid])->find();
            $typename = M('Arctype')->where(['id'=> $archives['typeid']])->getField('typename');
            $this->come_from = $typename.'>'.$archives['title'];
        }
        if(empty($this->come_from) && $this->tid){
            $this->come_from = M('Arctype')->where(['id'=> $this->tid])->getField('typename');
        }
        if(empty($this->come_from)){
            $this->come_from = tpCache('web.web_title');
        }
    }

    /**
     * 获取表单数据
     */
    public function getForm($formid = '', $success = '', $beforeSubmit = '')
    {
        if (empty($formid)) {
            echo '标签form报错：缺少属性 formid 值。';
            return false;
        } else {
            $formid = intval($formid);
        }

        $form = model('form')->where([
                'id'        => $formid,
                'is_del'    => 0,
            ])->find();
        if (empty($form)){
            echo '标签form报错：该表单不存在。';
            return false;
        }

        $form_attr = model('form_attr')->where([
                'form_id'   => $form['id'],
                'is_del'    => 0,
            ])->order("sort_order asc, attr_id asc")->select();
        if (empty($form_attr)){
            echo '标签form报错：表单没有新增字段。';
            return false;
        }

        $ajax_form = input('param.ajax_form/d'); // 是否ajax弹窗报名，还是页面显示报名
        $md5 = md5(getTime().uniqid(mt_rand(), TRUE));
        $funname = 'f'.md5("eju_form_token_{$form['id']}".$md5);
        $form_name = 'form_'.$funname;
        $token_id = md5('form_token_'.$form['id'].$md5);
        $submit = 'f'.$token_id;
        $input_rule_list = config("global.input_rule");
        $result = array();
        $check_js = "
        var x = document.getElementById('".$form_name."');
        for (var i=0;i<x.length;i++){
        ";   //检测规则
        foreach ($form_attr as $key=>$val){
            $attr_id = $val['attr_id'];
            /*字段名称*/
            $name = 'attr_'.$attr_id;
            $result[$name] = $name;
            /*--end*/
            /*表单提示文字*/
            $itemname = 'itemname_'.$attr_id;
            $result[$itemname] = $val['attr_name'];
            /*
             * 区域类型，自动定位关联下级区域
             */
            if ($val['input_type'] == 'region') {
                $regionInfo = \think\Cookie::get("regionInfo");
                $region_id = !empty($regionInfo['id']) ? intval($regionInfo['id']) : 0;
                if (!empty($region_id)) {
                    $level = !empty($regionInfo['level']) ? intval($regionInfo['level']) : 0;
                    $regionList = [];
                    if (1 == $level) {
                        $regionList = group_same_key(get_city_list(), 'parent_id');
                    } else if (2 == $level) {
                        $regionList = group_same_key(get_area_list(), 'parent_id');
                    }
                    if (!empty($regionList[$region_id])) {
                        $val['attr_values'] = implode(',', get_arr_column($regionList[$region_id], 'name'));
                    } else {
                        $val['attr_values'] = '';
                    }
                }
            }
            /*
             * 筛选内容
             */
            if (!empty($val['attr_values'])) {
                $tmp_option_val = explode(',', $val['attr_values']);
                $options = array();
                foreach($tmp_option_val as $k2=>$v2)
                {
                    $tmp_val = array(
                        'value' => $v2,
                    );
                    array_push($options, $tmp_val);
                }
                $result['options_'.$attr_id] = $options;
            }
            //是否必填（js判断）
            if ($val['is_fill']){
                $check_js .= "
                    if(x[i].name == '".'attr_'.$val['attr_id']."' && x[i].value.length == 0){
                        alert('".$val['attr_name']."不能为空！');
                         return false;
                    }
                ";
            }
            //是否正则限制（js判断）
            if ($val['input_rule'] && !empty($input_rule_list[$val['input_rule']]['value'])){
                $check_js .= " 
                if(x[i].name == '".'attr_'.$val['attr_id']."' && !(".$input_rule_list[$val['input_rule']]['value'].".test( x[i].value))){
                    alert('".$val['attr_name']."格式不正确！');
                    return false;
                }
               ";
            }
        }
        $check_js .= "}";

        if (!empty($beforeSubmit)) {
            $beforeSubmit = "try{if(false=={$beforeSubmit}()){return false;}}catch(e){}";
        }

        if (!empty($success)){
            $success .= "();";
        } else if (1 == $ajax_form) {
            $success = <<<EOF
    try{
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        parent.layer.close(index);
    }catch(e){}
EOF;
        }

        $tokenStr = <<<EOF
<script type="text/javascript">
    function {$submit}()
    {
        {$check_js}

        {$beforeSubmit}
        
        var elements = document.getElementById("{$form_name}");
        var formData =new FormData();
        for(var i=0; i<elements.length; i++)
        {
            formData.append(elements[i].name,elements[i].value);
        }
        var ajax = new XMLHttpRequest();
        ajax.open("post", "{$this->root_dir}/index.php?m=api&c=Ajax&a=form_submit&_ajax=1"); 
        ajax.setRequestHeader("X-Requested-With","XMLHttpRequest");
        ajax.send(formData); 
        
        ajax.onreadystatechange = function()
        {
            if(ajax.readyState == 4 && ajax.status == 200)
            {
                var json = ajax.responseText;
                var res = JSON.parse(json);
                if (1 == res.code) {
                    reset_form(elements);
                    {$funname}();
                    {$funname}_notice(res.data.form_id, res.data.list_id);
                    alert(res.msg);
                    {$success}
                } else {
                    alert(res.msg);
                    {$funname}();
                }
            }
        }
        
        return false;
    }

    function {$funname}()
    {
        //步骤一:创建异步对象
        var ajax = new XMLHttpRequest();
        //步骤二:设置请求的url参数,参数一是请求的类型,参数二是请求的url,可以带参数,动态的传递参数starName到服务端
        ajax.open("get", "{$this->root_dir}/index.php?m=api&c=Ajax&a=get_token&name=__token__{$token_id}", true);

        // 给头部添加ajax信息
        ajax.setRequestHeader("X-Requested-With","XMLHttpRequest");
        //步骤三:发送请求+数据
        ajax.send();
        //步骤四:注册事件 onreadystatechange 状态改变就会调用
        ajax.onreadystatechange = function () {
            //步骤五 如果能够进到这个判断 说明 数据 完美的回来了,并且请求的页面是存在的
            if (ajax.readyState==4 && ajax.status==200) {
        　　　　document.getElementById("{$token_id}").value = ajax.responseText;
          　}
        }
    }

    function {$funname}_notice(form_id, list_id)
    {
        //步骤一:创建异步对象
        var ajax = new XMLHttpRequest();
        //步骤二:设置请求的url参数,参数一是请求的类型,参数二是请求的url,可以带参数,动态的传递参数starName到服务端
        ajax.open("post", "{$this->root_dir}/index.php?m=api&c=Ajax&a=send_email", true);
        // 给头部添加ajax信息
        ajax.setRequestHeader("X-Requested-With","XMLHttpRequest");
        // 如果需要像 HTML 表单那样 POST 数据，请使用 setRequestHeader() 来添加 HTTP 头。然后在 send() 方法中规定您希望发送的数据：
        ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        //步骤三:发送请求+数据
        ajax.send("type=form_submit&form_id="+form_id+"&list_id="+list_id);
        //步骤四:注册事件 onreadystatechange 状态改变就会调用
        ajax.onreadystatechange = function () {}
    }

    //重置form表单
    function reset_form(Clear_From){
        for(var a = 0; a< Clear_From.elements.length; a++) {
            if(Clear_From.elements[a].type == "text") {				//类型为text的
                Clear_From.elements[a].value = "";
            } else if(Clear_From.elements[a].type == "password") {	//类型为password的
                Clear_From.elements[a].value = "";
            } else if(Clear_From.elements[a].type == "radio") {		//类型为radio的
                Clear_From.elements[a].checked = false;
            } else if(Clear_From.elements[a].type == "checkbox") {	//类型为
                Clear_From.elements[a].checked = false;
            } else if(Clear_From.elements[a].type == "select-one"){	//单选下拉菜单
                Clear_From.elements[a].options[0].selected = true;	//选中第一个options
            } else if(Clear_From.elements[a].type == "select-multiple") { //多选下拉菜单
                for(var b = 0; b< Clear_From.elements[a].options.length; b++) { //将所有options设为false
                    Clear_From.elements[a].options[b].selected = false;
                }
            } else if(Clear_From.elements[a].type == "textarea") {
                Clear_From.elements[a].value = "";
            }
        }
    }

    {$funname}();
</script>
EOF;

        $hidden = '<input type="hidden" name="ajax_form" value="'.$ajax_form.'" /><input type="hidden" name="come_from" value="'.$this->come_from.'" /><input type="hidden" name="parent_come_url" value="'.input('param.parent_url/s').'" /><input type="hidden" name="come_url" value="'.request()->url().'" /><input type="hidden" name="form_id" value="'.$form['id'].'" /><input type="hidden" name="__token__'.$token_id.'" id="'.$token_id.'" value="" />'.$tokenStr;
        $result['form_id'] = $form['id'];
        $result['form_name'] = $form_name;
        $result['hidden'] = $hidden;
        $result['action'] = url('api/Ajax/form_submit', [], true, false, 1);
        $result['submit'] = "return {$submit}();";

        return [$result];
    }
}