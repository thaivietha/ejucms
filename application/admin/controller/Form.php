<?php
/**
 * Created by PhpStorm.
 * User: 28773
 * Date: 2019/7/22
 * Time: 17:46
 */

namespace app\admin\controller;

use think\Page;
use think\Db;

class Form extends Base
{
    private $field_type_list;

    public function _initialize() {
        parent::_initialize();
        $this->field_type_list = [
            'text'          => '单行文本',
            'multitext'     => '多行文本',
            'radio'         => '单选项',
            'checkbox'      => '多选项',
            'select'        => '下拉框',
            'switch'        => '开关',
        ];
    }
    /*
     * 标签调用
     */
    public function label_call(){
        $form_id = input('form_id/d',0);
        if (!empty($form_id)) {
            $form_list = model('form')->where(['id'=>$form_id])->find();
            $form_attr_list = model("form_attr")->where([
                'form_id'   => $form_list['id'],
                'is_del'    => 0,
            ])->order("sort_order asc")->select();

            $content = '{eju:form formid="'.$form_list['id'].'"}'."\n";
            $content .= '<form method="post" id="{$field.form_name}" action="{$field.action}" onsubmit="{$field.submit}">'."\n";

            foreach ($form_attr_list as $key=>$val){
                $attr_id = $val['attr_id'];
                switch ($val['input_type']){
                    case "multitext":
                        $content .= '<textarea rows="2" cols="60" id="{$field.attr_'.$attr_id.'}" name="{$field.attr_'.$attr_id.'}" placeholder="{$field.itemname_'.$attr_id.'}" style="height:60px;"></textarea>'."\n";
                        break;
                    case "checkbox":
                        $content .= '{eju:volist name="$field.options_'.$attr_id.'" id="attr"}'."\n";
                        $content .= '<input type="checkbox" id="{$field.attr_'.$attr_id.'}" name="{$field.attr_'.$attr_id.'}" value="{$attr.value}">{$attr.value}'."\n";
                        $content .= '{/eju:volist}'."\n";
                        break;
                    case "radio":
                        $content .= '{eju:volist name="$field.options_'.$attr_id.'" id="attr"}'."\n";
                        $content .= '<input type="radio" id="{$field.attr_'.$attr_id.'}" name="{$field.attr_'.$attr_id.'}" value="{$attr.value}">{$attr.value}'."\n";
                        $content .= '{/eju:volist}'."\n";
                        break;
                    case "switch":
                        $content .= '<input type="radio" id="{$field.attr_'.$attr_id.'}" name="{$field.attr_'.$attr_id.'}" value="是">是 &nbsp;
                        <input type="radio" id="{$field.attr_'.$attr_id.'}" name="{$field.attr_'.$attr_id.'}" value="否">否'."\n";
                        break;
                    case "select":
                        $content .= '<select id="{$field.attr_'.$attr_id.'}" name="{$field.attr_'.$attr_id.'}">'."\n";
                        $content .= '{eju:volist name="$field.options_'.$attr_id.'" id="attr"}'."\n";
                        $content .= '<option value="{$attr.value}">{$attr.value}</option>'."\n";
                        $content .= '{/eju:volist}'."\n";
                        $content .= '</select>'."\n";
                        break;
                    default:    //单行文本
                        $content .= '<input type="text" id="{$field.attr_'.$attr_id.'}" name="{$field.attr_'.$attr_id.'}" placeholder="{$field.itemname_'.$attr_id.'}" >'."\n";
                        break;
                }
            }
            $content .=' <input type="submit"  value="报名看房">'."\n";
            $content .='{$field.hidden}'."\n";
            $content .='</form>'."\n";
            $content .='{/eju:form}';
            $assign_data = [
                'form_list' => $form_list,
                'form_attr_list' => $form_attr_list,
                'content' => $content
            ];

            $this->assign($assign_data);

            return $this->fetch();
        }
        $this->error('数据不存在！');
    }
    /*
     * 查看详情
     */
    public function examine(){
        $list_id = input('list_id/d',0);
        if (!empty($list_id)) {

            // 表单内容信息
            $form_list = model('form_list')->where(['list_id'=>$list_id])->find();
            $form_attr_list = model("form_attr")->where([
                    'form_id'   => $form_list['form_id'],
                    'is_del'    => 0,
                ])->order("sort_order asc")->select();
            $value_list = model('form_value')->where(['list_id'=>$list_id])->getAllWithIndex("attr_id");

            // 标记为已读和IP地区
            $city = "";
            $city_arr = getCityLocation($form_list['ip']);
            if (!empty($city_arr)) {
                !empty($city_arr['location']) && $city .= $city_arr['location'];
            }
            $is_read = 1;
            model('form_list')->where(['list_id'=>$list_id])->save([
                    'city'  => $city,
                    'is_read'       => $is_read,
                    'update_time'   => getTime(),
                ]);
            $form_list['city'] = $city;
            $form_list['is_read'] = $city;

            $assign_data = [
                'form_list' => $form_list,
                'form_attr_list' => $form_attr_list,
                'value_list' => $value_list,
            ];
            $this->assign($assign_data);

            return $this->fetch();
        }
        $this->error('数据不存在！');
    }

    public function index()
    {
        //获取表头信息
        $form_attr_default_list = model("form_attr")->where([
                'is_del'        => 0,
                'is_default'    => ['gt', 0],
            ])->group('is_default')->order("sort_order asc")->select();
        $this->assign('form_attr_default_list', $form_attr_default_list);

        $condition = array();
        // 获取到所有GET参数
        $param = input('param.');
        $form_id = input("form_id/d",0);
        $this->assign('form_id',$form_id);

        // 应用搜索条件
        foreach (['form_id'] as $key) {
            if (isset($param[$key]) && $param[$key] !== '') {
                $condition['a.'.$key] = array('eq', $param[$key]);
            }
        }

        $condition['a.is_del'] = array('eq', 0);

        $formListM =  M('form_list');
        $count = $formListM->alias('a')->where($condition)->count();// 查询满足要求的总记录数
        $Page = new Page($count, config('paginate.list_rows'));// 实例化分页类 传入总记录数和每页显示的记录数
        $list = $formListM->field('a.*,b.name AS form_name')
            ->alias('a')
            ->join('__FORM__ b', 'a.form_id = b.id', 'LEFT')
            ->where($condition)
            ->order('a.update_time desc, a.list_id desc')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();
        $form_attr_defaults = M("form_attr")->field('attr_id,form_id')->where([
                'form_id'   => ['IN', get_arr_column($list, 'form_id')],
                'is_default'    => ['gt', 0],
            ])->getAllWithIndex('attr_id');
        $form_attrs = group_same_key($form_attr_defaults, 'form_id');
        $form_values = M('form_value')->field('list_id,attr_id,attr_value')->where([
                'list_id'   => ['IN', get_arr_column($list, 'list_id')],
                'attr_id'   => ['IN', get_arr_column($form_attr_defaults, 'attr_id')],
            ])->select();
        $new_form_values = [];
        foreach ($form_values as $key => $val) {
            $new_key = $val['list_id'].'_'.$val['attr_id'];
            $new_form_values[$new_key] = $val;
        }
        foreach ($list as $key=>$val){
            $val = !empty($form_attrs[$val['form_id']]) ? $form_attrs[$val['form_id']] : [];
            if (empty($val)) {
                $val = [];
                foreach ($form_attr_default_list as $k2 => $v2) {
                    array_push($val, []);
                }
            }
            $list[$key]['attr_is_default_list'] = $val;
        }
        $pageStr = $Page->show();// 分页显示输出
        $this->assign('pageStr',$pageStr);// 赋值分页输出
        $this->assign('list',$list);// 赋值数据集
        $this->assign('pager',$pager);// 赋值分页对象
        $this->assign('new_form_values',$new_form_values);// 赋值分页对象
        $form_list = M('form')->where("is_del = 0")->select();
        array_unshift($form_list,['id'=>0,'name'=>'表单选择']);
        $this->assign('form_list',$form_list);// 赋值分页对象

        return $this->fetch();
    }

    public function attr_index()
    {
        $condition = array();
        $condition['a.status'] = array('eq', 1);
        $condition['a.is_del'] = array('eq', 0);

        $formM =  M('form');
        $count = $formM->alias('a')->where($condition)->count();// 查询满足要求的总记录数
        $Page = new Page($count, config('paginate.list_rows'));// 实例化分页类 传入总记录数和每页显示的记录数
        $list = $formM->field('a.*')
            ->alias('a')
            ->where($condition)
            ->order('a.id desc')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();
        $pageStr = $Page->show();// 分页显示输出
        $this->assign('pageStr',$pageStr);// 赋值分页输出
        $this->assign('list',$list);// 赋值数据集
        $this->assign('pager',$pager);// 赋值分页对象

        $form_ids = get_arr_column($list, 'id');
        
        // 报名数量
        $form_list_total = Db::name('form_list')->field('form_id, count(form_id) AS total')
            ->where([
                'form_id'   => ['IN', $form_ids],
                'is_del'    => 0,
            ])
            ->group('form_id')
            ->getAllWithIndex('form_id');
        $this->assign('form_list_total',$form_list_total);

        // 字段数量
        $form_attr_total = Db::name('form_attr')->field('form_id, count(form_id) AS total')
            ->where([
                'form_id'   => ['IN', $form_ids],
                'is_del'    => 0,
            ])
            ->group('form_id')
            ->getAllWithIndex('form_id');
        $this->assign('form_attr_total',$form_attr_total);

        return $this->fetch();
    }

    /**
     * 新增
     */
    public function add()
    {
        if (IS_POST) {
            $post = input('post.');
            if (empty($post['name'])){
                throw new \Exception("表单名称不能为空！");
            }else if (empty($post['attr_name'])){
                $this->error('请新增字段！');
            }
            $map = array(
                'name' => trim($post['name']),
            );
            $form = M('form');
            if($form->where($map)->count() > 0){
                $this->error('该表单名称已存在，请检查', url('Form/index'));
            }
            $data = array(
                'name'       => trim($post['name']),
                'intro'       => $post['intro'],
                'admin_id'    => session('admin_id'),
                'add_time'    => getTime(),
                'update_time' => getTime(),
            );
            $insertId = $form->insertGetId($data);
            if ($insertId) {
                // 读取组合广告位的图片及信息
                foreach ($post['attr_name'] as $key => $value) {
                    if (!empty($value)) {
                        $attr_values = !empty($post['attr_values'][$key]) ? $post['attr_values'][$key] : '';
                        /*去除中文逗号，过滤左右空格与空值、以及单双引号*/
                        if (!empty($attr_values)) {
                            $attr_values = str_replace('，', ',', $attr_values);
                            $attr_values = func_preg_replace(['"','\''], '', $attr_values);
                            $attr_values_arr = explode(',', $attr_values);
                            foreach ($attr_values_arr as $k2 => $v2) {
                                $tmp_val = trim($v2);
                                if ('' == $tmp_val) {
                                    unset($attr_values_arr[$k2]);
                                    continue;
                                }
                                $attr_values_arr[$k2] = trim($v2);
                            }
                            $attr_values = implode(',', $attr_values_arr);
                        }
                        /*--end*/
                        // 主要参数
                        $attrData[$key]['attr_name']      = trim($value);
                        $attrData[$key]['form_id']         = $insertId;
                        $attrData[$key]['input_type']       = trim($post['input_type'][$key]);
                        $attrData[$key]['attr_values']       = $attr_values;
                        $attrData[$key]['is_fill']      = trim($post['is_fill'][$key]);
                        $attrData[$key]['is_default']      = trim($post['is_default'][$key]);
                        $attrData[$key]['input_rule']      = trim($post['input_rule'][$key]);
                        $attrData[$key]['sort_order']      = trim($post['sort_order'][$key]);
                        $attrData[$key]['add_time']    = getTime();
                        $attrData[$key]['update_time'] = getTime();
                    }
                }
                $is_true = model('form_attr')->saveAll($attrData);
                if (!$is_true){
                    $form->where("id=".$form)->delete();
                    $this->error("操作失败", url('Form/attr_index'));
                }
                adminLog('新增表单：'.$post['name']);
            } else {
                $this->error("操作失败", url('Form/attr_index'));
            }

            $this->success("操作成功", url('Form/attr_index'));
            exit;
        }

        // 字段类型
        $field_type_html = '<select name="input_type[]" lay-ignore>';
        foreach ($this->field_type_list as $key => $val) {
            $field_type_html .= '<option value="'.$key.'">'.$val.'</option>';
        }
        $field_type_html .= '</select>';
        $this->assign('field_type_html',$field_type_html);

        // 规则
        $input_rule_list = config("global.input_rule");
        $input_rule_html = '<select name="input_rule[]" lay-ignore><option value="0">无</option>';
        foreach ($input_rule_list as $key=>$val){
            $input_rule_html .= '<option value="'.$key.'">'.$val['name'].'</option>';
        }
        $input_rule_html .= '</select>';
        $this->assign('input_rule_html',$input_rule_html);

        return $this->fetch();
    }
    /*
     * 编辑
     */
    public function edit(){
        if (IS_POST){
            $post = input('post.');
            if(empty($post['id'])){
                $this->error('表单不存在，请联系管理员！');
            }
            $map = array(
                'id'    => array('NEQ', $post['id']),
                'name' => trim($post['name']),
            );
            $form = M('form');
            if($form->where($map)->count() > 0){
                $this->error('该表单名称已存在，请检查', url('Form/index'));
            }
            $data = array(
                'id'          => $post['id'],
                'name'       => trim($post['name']),
                'intro'       => $post['intro'],
                'update_time' => getTime(),
            );

            $r = $form->update($data);
            if ($r) {
                $addData = [];
                $editData = [];
                $id_arr = [];
                foreach ($post['attr_id'] as $key => $value) {
                    $attr_values = !empty($post['attr_values'][$key]) ? $post['attr_values'][$key] : '';
                    /*去除中文逗号，过滤左右空格与空值、以及单双引号*/
                    if (!empty($attr_values)) {
                        $attr_values = str_replace('，', ',', $attr_values);
                        $attr_values = func_preg_replace(['"','\''], '', $attr_values);
                        $attr_values_arr = explode(',', $attr_values);
                        foreach ($attr_values_arr as $k2 => $v2) {
                            $tmp_val = trim($v2);
                            if ('' == $tmp_val) {
                                unset($attr_values_arr[$k2]);
                                continue;
                            }
                            $attr_values_arr[$k2] = trim($v2);
                        }
                        $attr_values = implode(',', $attr_values_arr);
                    }
                    /*--end*/

                    if (empty($value)) {
                        $addData[] = [
                            'attr_name'=>trim($post['attr_name'][$key]),
                            'form_id'=>$post['id'],
                            'input_type'=>trim($post['input_type'][$key]),
                            'attr_values'=>$attr_values,
                            'is_fill' => trim($post['is_fill'][$key]),
                            'is_default' => trim($post['is_default'][$key]),
                            'input_rule' => trim($post['input_rule'][$key]),
                            'sort_order'=>trim($post['sort_order'][$key]),
                            'add_time'=>getTime(),
                            'update_time'=>getTime()
                        ];
                    }else{
                        $editData[] = [
                            'attr_id'=>$value,
                            'attr_name'=>trim($post['attr_name'][$key]),
                            'form_id'=>$post['id'],
                            'input_type'=>trim($post['input_type'][$key]),
                            'attr_values'=>$attr_values,
                            'is_fill' => trim($post['is_fill'][$key]),
                            'is_default' => trim($post['is_default'][$key]),
                            'input_rule' => trim($post['input_rule'][$key]),
                            'sort_order'=>trim($post['sort_order'][$key]),
                            'add_time'=>getTime(),
                            'update_time'=>getTime()
                        ];
                        $id_arr[] = $value;
                    }
                }
                if (!empty($id_arr)){
                    model('form_attr')->where(['attr_id'=>['not in',$id_arr],'form_id'=>$post['id']])->save(['is_del'=>1]);
                }
                if (!empty($editData)){
                    model('form_attr')->saveAll($editData);
                }
                if (!empty($addData)){
                    model('form_attr')->saveAll($addData);
                }
                adminLog('编辑表单：'.$post['name']);
            } else {
                $this->error("操作失败", url('Form/attr_index'));
            }

            $this->success("操作成功", url('Form/attr_index'));
        }
        $id = input('form_id/d',0);
        $field = M('form')->field('a.*')
            ->alias('a')
            ->where(array('a.id'=>$id))
            ->find();
        if (empty($field)) {
            $this->error('表单不存在，请联系管理员！');
            exit;
        }
        $assign_data['field'] = $field;
        $form_attr_list = model('form_attr')->field('*')->where("form_id={$id} and is_del=0")->select();
        $assign_data['form_attr_list'] = $form_attr_list;

        // 字段类型
        $field_type_html = '<select name="input_type[]" lay-ignore>';
        foreach ($this->field_type_list as $key => $val) {
            $field_type_html .= '<option value="'.$key.'">'.$val.'</option>';
        }
        $field_type_html .= '</select>';
        $this->assign('field_type_html',$field_type_html);
        $assign_data['field_type_list'] = $this->field_type_list;

        // 规则
        $input_rule_list = config("global.input_rule");
        $input_rule_html = '<select name="input_rule[]" lay-ignore><option value="0">无</option>';
        foreach ($input_rule_list as $key=>$val){
            $input_rule_html .= '<option value="'.$key.'">'.$val['name'].'</option>';
        }
        $input_rule_html .= '</select>';
        $assign_data['input_rule_html'] = $input_rule_html;
        $assign_data['input_rule_list'] = $input_rule_list;

        $this->assign($assign_data);

        return $this->fetch();
    }

    /**
     * 删除信息
     */
    public function del()
    {
        $id_arr = input('del_id/a');
        $id_arr = eyIntval($id_arr);
        if(IS_POST && !empty($id_arr)){
            $r = M('form_list')->where('list_id','IN',$id_arr)->save(['is_del'=>1]);
            if ($r) {
                adminLog('删除表单信息内容-id：'.implode(',', $id_arr));
                $this->success('删除成功');
            } else {
                $this->error('删除失败');
            }
        }else{
            $this->error('参数有误');
        }
    }
    /*
     * 标志已读
     */
    public function read(){
        $id_arr = input('list_id/a');
        $id_arr = eyIntval($id_arr);
        if(IS_POST && !empty($id_arr)){
            $r =  M("form_list")->where('list_id','IN',$id_arr)->save(['is_read'=>1]);
            if ($r) {
                adminLog('标志已读-id：'.implode(',', $id_arr));
                $this->success('操作成功');
            } else {
                $this->error('操作失败');
            }
        }else{
            $this->error('参数有误');
        }
    }
    /*
     * 全部标志已读
     */
    public function readAll(){
        if(IS_POST){
            $r =  M("form_list")->where('is_del=0')->save(['is_read'=>1]);
            if ($r) {
                adminLog('全部标志已读');
                $this->success('操作成功');
            } else {
                $this->error('操作失败');
            }
        }else{
            $this->error('参数有误');
        }
    }
    /*
     * 删除表单
     */
    public function form_del(){
        $id_arr = input('del_id/a');
        $id_arr = eyIntval($id_arr);
        if(IS_POST && !empty($id_arr)){
            $r = M('form')->where('id','IN',$id_arr)->delete();
            if ($r) {
                M('form_attr')->where('form_id','IN',$id_arr)->delete();
                M('form_list')->where('form_id','IN',$id_arr)->delete();
                M('form_value')->where('form_id','IN',$id_arr)->delete();
                adminLog('删除表单-id：'.implode(',', $id_arr));
                $this->success('删除成功');
            } else {
                $this->error('删除失败');
            }
        }else{
            $this->error('参数有误');
        }
    }
}