<?php
/**
 * 易居CMS
 * ============================================================================
 * 版权所有 2018-2028 海南易而优科技有限公司，并保留所有权利。
 * 网站地址: http://www.ejucms.com
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 小虎哥 <1105415366@qq.com>
 * Date: 2018-4-3
 */

namespace app\home\controller;

use think\Db;

class Lists extends Base
{
    // 模型标识
    public $nid = '';
    // 模型ID
    public $channel = '';

    public function _initialize() {
        parent::_initialize();
    }

    /**
     * 栏目列表
     */
    public function index($tid = '')
    {
        $param = input('param.');
        /*获取当前栏目ID以及模型ID*/
        $page_tmp = input('param.page/s', 0);
        if (empty($tid) || !is_numeric($page_tmp)) {
            abort(404,'页面不存在');
        }
        $web_region_domain = config('ey_config.web_region_domain');  //是否开启子域名
        $web_mobile_domain = config('ey_config.web_mobile_domain');    //手机子域名
        $web_main_domain = tpCache('web.web_main_domain');   //主域名
        $subDomain = input('param.subdomain/s','');
        empty($subDomain) && $subDomain = request()->subDomain();
        //判断是否为合法的二级域名
        if($web_region_domain && $subDomain != $web_mobile_domain && $subDomain != $web_main_domain ){
            $have = false;
            $region_list = get_region_list();
            foreach ($region_list as $val){
                if ($subDomain == $val['domain']){
                    $have = true;
                    break;
                }
            }
            if (!$have){
                abort(404,'页面不存在');
            }
        }
        $map = [];
        /*URL上参数的校验*/
        $seo_pseudo = config('ey_config.seo_pseudo');
        $url_screen_var = config('global.url_screen_var');
        if (!isset($param[$url_screen_var]) && 3 == $seo_pseudo)
        {
            if (stristr($this->request->url(), '&c=Lists&a=index&')) {
                abort(404,'页面不存在');
            }
            $map = array('a.dirname'=>$tid);
        }
        else if (isset($param[$url_screen_var]) || 1 == $seo_pseudo || (2 == $seo_pseudo && isMobile()))
        {
            $seo_dynamic_format = config('ey_config.seo_dynamic_format');
            if (1 == $seo_pseudo && 2 == $seo_dynamic_format && stristr($this->request->url(), '&c=Lists&a=index&')) {
                abort(404,'页面不存在');
            } else if (!is_numeric($tid) || strval(intval($tid)) !== strval($tid)) {
                abort(404,'页面不存在');
            }
            $map = array('a.id'=>$tid);
            
        }else if (2 == $seo_pseudo){ // 生成静态页面代码
            
            $map = array('a.id'=>$tid);
        }
        /*--end*/
        $map['a.is_del'] = 0; // 回收站功能
        $row = M('arctype')->field('a.id, a.current_channel, b.nid')
            ->alias('a')
            ->join('__CHANNELTYPE__ b', 'a.current_channel = b.id', 'LEFT')
            ->where($map)
            ->find();
        if (empty($row)) {
            abort(404,'页面不存在');
        }
        $tid = $row['id'];
        $this->nid = $row['nid'];
        $this->channel = intval($row['current_channel']);
        /*--end*/

        $result = $this->logic($tid); // 模型对应逻辑

        $eju = array(
            'field' => $result,
        );
        $this->eju = array_merge($this->eju, $eju);
        $this->assign('eju', $this->eju);

        /*模板文件*/
        $viewfile = !empty($result['templist'])
        ? str_replace('.'.$this->view_suffix, '',$result['templist'])
        : 'lists_'.$this->nid;
        /*--end*/
        return $this->fetch(":{$viewfile}");
    }

    /**
     * 模型对应逻辑
     * @param intval $tid 栏目ID
     * @return array
     */
    private function logic($tid = '')
    {
        $result = array();

        if (empty($tid)) {
            return $result;
        }

        switch ($this->channel) {
            case '6': // 单页模型
            {
                $arctype_info = model('Arctype')->getInfo($tid);
                if ($arctype_info) {
                    // 读取当前栏目的内容，否则读取每一级第一个子栏目的内容，直到有内容或者最后一级栏目为止。
                    $result_new = $this->readContentFirst($tid);
                    // 阅读权限
                    if ($result_new['arcrank'] == -1) {
                        $this->success('待审核稿件，你没有权限阅读！');
                        exit;
                    }
                    // 外部链接跳转
                    if ($result_new['is_part'] == 1) {
                        header('Location: '.$result_new['typelink']);
                        exit;
                    }
                    /*自定义字段的数据格式处理*/
                    $result_new = $this->fieldLogic->getChannelFieldList($result_new, $this->channel);
                    /*--end*/
                    $result = array_merge($arctype_info, $result_new);

                    $result['templist'] = !empty($arctype_info['templist']) ? $arctype_info['templist'] : 'lists_'. $arctype_info['nid'];
                    $result['dirpath'] = $arctype_info['dirpath'];
                    $result['typeid'] = $arctype_info['typeid'];
                }
                break;
            }

            default:
            {
                $result = model('Arctype')->getInfo($tid);
                break;
            }
        }

        if (!empty($result)) {
            /*自定义字段的数据格式处理*/
            $result = $this->fieldLogic->getTableFieldList($result, config('global.arctype_channel_id'));
            /*--end*/
        }

        /*是否有子栏目，用于标记【全部】选中状态*/
        $result['has_children'] = model('Arctype')->hasChildren($tid);
        /*--end*/

        // seo
        $result['seo_title'] = set_typeseotitle($result['typename'], $result['seo_title']);
        $result['seo_keywords'] = set_str_replace($result['seo_keywords']);
        $result['seo_description'] = set_str_replace($result['seo_description']);

        /*获取当前页面URL*/
        $result['pageurl'] = request()->url(true);
        /*--end*/

        /*给没有type前缀的字段新增一个带前缀的字段，并赋予相同的值*/
        foreach ($result as $key => $val) {
            if (!preg_match('/^type/i',$key)) {
                $key_new = 'type'.$key;
                !array_key_exists($key_new, $result) && $result[$key_new] = $val;
            }
        }
        /*--end*/

        return $result;
    }

    /**
     * 读取指定栏目ID下有内容的栏目信息，只读取每一级的第一个栏目
     * @param intval $typeid 栏目ID
     * @return array
     */
    private function readContentFirst($typeid)
    {
        $result = false;
        while (true)
        {
            $result = model('Single')->getInfoByTypeid($typeid);
            if (empty($result['content']) && 'lists_single.htm' == strtolower($result['templist'])) {
                $map = array(
                    'parent_id' => $result['typeid'],
                    'current_channel' => 6,
                    'is_hidden' => 0,
                    'status'    => 1,
                );
                $row = M('arctype')->where($map)->field('*')->order('sort_order asc')->find(); // 查找下一级的单页模型栏目
                if (empty($row)) { // 不存在并返回当前栏目信息
                    break;
                } elseif (6 == $row['current_channel']) { // 存在且是单页模型，则进行继续往下查找，直到有内容为止
                    $typeid = $row['id'];
                }
            } else {
                break;
            }
        }

        return $result;
    }

    /**
     * 留言提交 
     */
    public function gbook_submit()
    {
        $typeid = input('post.typeid/d');

        if (IS_POST && !empty($typeid)) {
            $post = input('post.');

            $token = '__token__';
            foreach ($post as $key => $val) {
                if (preg_match('/^__token__/i', $key)) {
                    $token = $key;
                    continue;
                }
            }
            $ip = clientIP();
            $map = array(
                'ip'    => $ip,
                'typeid'    => $typeid,
                'add_time'  => array('gt', getTime() - 60),
            );
            $count = M('guestbook')->where($map)->count('aid');
            if ($count > 0) {
                $this->error('同一个IP在60秒之内不能重复提交！');
            }

            $this->channel = Db::name('arctype')->where(['id'=>$typeid])->getField('current_channel');

            $newData = array(
                'typeid'    => $typeid,
                'channel'   => $this->channel,
                'ip'    => $ip,
                'add_time'  => getTime(),
                'update_time' => getTime(),
            );
            $data = array_merge($post, $newData);

            // 数据验证
            $rule = [
                'typeid'    => 'require|token:'.$token,
            ];
            $message = [
                'typeid.require' => '表单缺少标签属性{$field.hidden}',
            ];
            $validate = new \think\Validate($rule, $message);
            if(!$validate->batch()->check($data))
            {
                $error = $validate->getError();
                $error_msg = array_values($error);
                $this->error($error_msg[0]);
            } else {
                $guestbookRow = [];
                /*处理是否重复表单数据的提交*/
                $formdata = $data;
                foreach ($formdata as $key => $val) {
                    if (in_array($key, ['typeid']) || preg_match('/^attr_(\d+)$/i', $key)) {
                        continue;
                    }
                    unset($formdata[$key]);
                }
                $md5data = md5(serialize($formdata));
                $data['md5data'] = $md5data;
                $guestbookRow = M('guestbook')->field('aid')->where(['md5data'=>$md5data])->find();
                /*--end*/
                if (empty($guestbookRow)) { // 非重复表单的才能写入数据库
                    $aid = M('guestbook')->insertGetId($data);
                    if ($aid > 0) {
                        $this->saveGuestbookAttr($aid, $typeid);
                    }
                    /*插件 - 邮箱发送*/
                    $data = [
                        'gbook_submit',
                        $typeid,
                        $aid,
                    ];
                    $dataStr = implode('|', $data);
                    /*--end*/
                } else {
                    // 存在重复数据的表单，将在后台显示在最前面
                    M('guestbook')->where('aid',$guestbookRow['aid'])->update([
                            'update_time'   => getTime(),
                        ]);
                }
                $this->success('操作成功！', null, $dataStr, 3);
            }  
        }

        $this->error('表单缺少标签属性{$field.hidden}');
    }

    /**
     *  给指定留言添加表单值到 guestbook_attr
     * @param int $aid  留言id
     * @param int $typeid  留言栏目id
     */
    private function saveGuestbookAttr($aid, $typeid)
    {  
        // post 提交的属性  以 attr_id _ 和值的 组合为键名    
        $post = input("post.");
        $attrArr = [];

        foreach($post as $k => $v)
        {
            if(!strstr($k, 'attr_'))
                continue;                                 

            $attr_id = str_replace('attr_','',$k);

            /*多语言*/
            if (!empty($attrArr)) {
                $attr_id = $attrArr[$attr_id]['attr_id'];
            }
            /*--end*/

            //$v = str_replace('_', '', $v); // 替换特殊字符
            //$v = str_replace('@', '', $v); // 替换特殊字符
            $v = trim($v);
            $adddata = array(
                'aid'   => $aid,
                'attr_id'   => $attr_id,
                'attr_value'   => filter_line_return($v, '。'),
                'add_time'   => getTime(),
                'update_time'   => getTime(),
            );
            M('GuestbookAttr')->add($adddata);                       
        }
    }
}