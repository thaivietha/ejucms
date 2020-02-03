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

class TagInputform extends Base
{
    private $come_from = '';
    //初始化
    protected function _initialize()
    {
        parent::_initialize();
        $this->tid = I("param.tid/s", ''); // 应用于栏目列表
        /*tid为目录名称的情况下*/
        $this->tid = $this->getTrueTypeid($this->tid);
        /*--end*/
        $aid = I("param.aid/s", '');
        if ($aid){
            $this->come_from = M('Archives')->where([ 'aid'=> $aid])->getField('title');
        }
        if(empty($this->come_from) && $this->tid){
            $this->come_from = M('Arctype')->where(['id'=> $this->tid])->getField('typename');
        }
        if(empty($this->come_from)){
            $this->come_from = tpCache('web.web_title');
        }
    }
    /*
     * 获取表单数据
     */
    public function getInputform($formid = '',$name = '',$success = '',$class = ''){
        if (empty($formid) && empty($name)) {
            echo '标签inputform报错：缺少属性 formid和name 值。';
            return false;
        }
        $condition['is_del'] = 0;
        if (!empty($formid)){
            $condition['id'] = $formid;
        }else{
            $condition['name'] = $name;
        }
        $form = model('form')->where($condition)->find();
        if (empty($form)){
            echo '标签inputform报错：不存在表单。';
            return false;
        }
        $condition_attr['is_del'] = 0;
        $condition_attr['form_id'] = $form['id'];
        $form_attr = model('form_attr')->where($condition_attr)->order("sort_order asc")->select();
        if (empty($form_attr)){
            echo '标签inputform报错：表单不存在字段。';
            return false;
        }
        $md5 = md5(getTime().uniqid(mt_rand(), TRUE));
        $funname = 'f'.md5("ey_inputform_token_{$form['id']}".$md5);
        $form_name = 'form_'.$funname;
        $action = url('api/Ajax/form_submit');
        $token_id = md5('inputform_token_'.$form['id'].$md5);
        $check_js = "";   //检测规则
        $check_name = 'f'.$token_id;
        $input_rule_list = config("global.input_rule");
        foreach ($form_attr as $key=>$val){
            $form_attr[$key]['attr_id_name'] = $field_name = 'attr_'.$val['attr_id'];
            $form_attr[$key]['html'] = $this->getHtml($val['input_type'],$val['attr_values'],$field_name,$val['attr_name'],$class);
            if ($val['is_fill']){
                $check_js .= "
                if($('#".$form_name."').find('".'#attr_'.$val['attr_id']."').val().length == 0)
                                {
                                    alert('".$val['attr_name']."不能为空！');
                                    return false;
                                }";
            }
            if ($val['input_rule'] && !empty($input_rule_list[$val['input_rule']]['value'])){
                $check_js .= " if(!(".$input_rule_list[$val['input_rule']]['value'].".test($('#".$form_name."').find('".'#attr_'.$val['attr_id']."').val()))){
                    alert('".$val['attr_name']."有误，请重填');
                    return false;
                } ";
            }
        }
        if (!empty($success)){
            $success .= "();";
        }

        $tokenStr = <<<EOF
<script type="text/javascript">
    function {$check_name}()
    {
        {$check_js}
        $.ajax({
            url:"{$this->root_dir}/index.php?m=api&c=Ajax&a=form_submit",
            type:"post",
            dataType:"json",
            data:$("#{$form_name}").serialize(),
            success:function(result){
                if (result.code == 1){
                    $("#{$form_name}")[0].reset();
                    alert("提交成功");
                    {$funname}();
                    {$success}
                }
            }
        });
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
    {$funname}();
    


</script>
EOF;
        $hidden = '<input type="hidden" name="come_from" value="'.$this->come_from.'" /><input type="hidden" name="come_url" value="'.$_SERVER['REQUEST_URI'].'" /><input type="hidden" name="form_id" value="'.$form['id'].'" /><input type="hidden" name="__token__'.$token_id.'" id="'.$token_id.'" value="" />'.$tokenStr;
        $result['form_id'] = $form['id'];
        $result['form_name'] = $form_name;
        $result['hidden'] = $hidden;
        $result['check_name'] = "return {$check_name}();";
        $result['list'] = $form_attr;

        $result['action'] = $action;

        return $result;
    }

    /*
     * 获取各种字段类型的html内容
     */
    private function getHtml($input_type,$attr_values,$field_name,$attr_name,$class = "input-text"){
        $html = '';
        switch ($input_type){
            case 'multitext':  //多行文本
                $html .= '<textarea  class="'.$class.'" rows="2" cols="60" id="'.$field_name.'" name="'.$field_name.'"  placeholder="请输入'.$attr_name.'" style="height:60px;"></textarea>';
                break;
            case 'checkbox':    //复选框
                $dfvalue = explode(',',$attr_values);
                if ($dfvalue){
                    foreach ($dfvalue as $val){
                        $html .= '<label   class="'.$class.'">
                                <input type="checkbox" id="'.$field_name.'" name="'.$field_name.'[]" value="'.$val.'">'.$val.'
                            </label>&nbsp;';
                    }
                }
                break;
            case 'radio':   //单选
                $dfvalue = explode(',',$attr_values);
                if ($dfvalue){
                    foreach ($dfvalue as $val){
                        $html .= '<label  class="'.$class.'">
                                <input type="radio" id="'.$field_name.'" name="'.$field_name.'" value="'.$val.'">'.$val.'
                            </label>&nbsp;';
                    }
                }
                break;
            case 'switch':    //单选是否
                $html .= '<label  class="'.$class.'"><input type="radio" id="'.$field_name.'" name="'.$field_name.'" value="是">是 </label>&nbsp;
                <label class="input-rad"><input type="radio" id="'.$field_name.'" name="'.$field_name.'" value="否">否</label>&nbsp;';
                break;
            case 'select':     //下拉框单选
                $dfvalue = explode(',',$attr_values);
                if ($dfvalue){
                    $html .= '<select name="'.$field_name.'"   class="'.$class.'">';

                    foreach ($dfvalue as $val){
                        $html .= '<option value="'.$val.'">'.$val.'</option>';
                    }
                    $html .= '</select>';
                }
                break;
            default:    //单行文本
                $html .= '<input  class="'.$class.'" type="text" name="'.$field_name.'" id="'.$field_name.'"  placeholder="请输入'.$attr_name.'" >';
                break;
        }

        return $html;
    }
}