<?php
/**
 * User: xyz
 * Date: 2020/3/26
 * Time: 9:38
 */

namespace think\template\taglib\eju;

use think\Request;
use think\Db;

class TagCollect extends Base
{
    public $tid = 0;
    public $aid = 0;
    public $users_id = 0;
    protected function _initialize()
    {
        parent::_initialize();
        $this->tid = I("param.tid/s", ''); // 应用于栏目列表
        /*tid为目录名称的情况下*/
        $this->tid = $this->getTrueTypeid($this->tid);

        $aid = I("param.aid/d", 0);
        $this->aid = $aid;
        if(session('?users_id')){
            $this->users_id = session('users_id');
        }
    }
    public function getCollect($aid,$collectid,$titleid,$styleid,$currentstyle,$withoutstyle,$currenttitle,$withouttitle,$alert = 'off',$success=''){
        empty($aid) && $aid = $this->aid;
        if (empty($aid)) {
            echo '标签Collect报错：缺少属性 aid 值。';
            return false;
        }
        if (empty($collectid)) {
            echo '标签Collect报错：缺少属性 collectid 值。';
            return false;
        }
        if (empty($titleid)) {
            echo '标签Collect报错：缺少属性 titleid 值。';
            return false;
        }
        if (empty($styleid)) {
            echo '标签Collect报错：缺少属性 styleid 值。';
            return false;
        }
        $have = Db::name("users_collect")->where(['users_id'=> $this->users_id ,'aid'=>$aid])->find();
        if ($have){        //已经收藏过了
            $result['currentstyle'] = $currentstyle;
            $result['currenttitle'] = $currenttitle;
        }else{  //暂未收藏过
            $result['currentstyle'] = $withoutstyle;
            $result['currenttitle'] = $withouttitle;
        }
        $login_url = url('user/Users/login');
        $md5 = md5(getTime().uniqid(mt_rand(), TRUE));
        $funname = 'f'.md5("eju_collcet_token_{$collectid}".$md5);
        $token_id = md5('collcet_token_'.$collectid.$md5);
        if (!empty($success)){
            $success .= "();";
        }
        $jsStr = <<<EOF
<script type="text/javascript">
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
        //cancle  0:收藏，1：取消收藏 innerHTML 
        function reset_{$funname}(data){
             var titleid = document.getElementById("{$titleid}");
             var styleid = document.getElementById("{$styleid}");
             var currentstyle = "{$currentstyle}";
             var withoutstyle = "{$withoutstyle}";
             console.log(styleid.classList);
             if (data.cancle == 0){
                 titleid.innerHTML = "{$currenttitle}";
                 if (withoutstyle !== ''){
                     styleid.classList.remove(withoutstyle); 
                 }
                 if (currentstyle !== ''){
                     styleid.classList.add(currentstyle);
                 }
             }else{
                 titleid.innerHTML = "{$withouttitle}";
                 if (currentstyle !== ''){
                     styleid.classList.remove(currentstyle); 
                 }
                 if (withoutstyle !== ''){
                     styleid.classList.add(withoutstyle);
                 }
             }
        }
        var users_id = "{$this->users_id}";
        var btn = document.getElementById("{$collectid}");
        var is_alert = "{$alert}";
        btn.onclick = function(){
            if (users_id=='0') {
                alert("请登录后操作");
                window.location.href="{$login_url}";
                 return false;
            }
            var formData =new FormData();
            formData.append("aid","{$aid}");
            var ajax = new XMLHttpRequest();
            ajax.open("post", "{$this->root_dir}/index.php?m=api&c=Ajax&a=collect_change&_ajax=1"); 
            ajax.setRequestHeader("X-Requested-With","XMLHttpRequest");
            ajax.send(formData); 
            ajax.onreadystatechange = function()
            {
                if(ajax.readyState == 4 && ajax.status == 200)
                {
                    var json = ajax.responseText;
                    var res = JSON.parse(json);
                    if (1 == res.code) {
                        {$funname}();
                        if (is_alert === 'on'){
                            alert(res.msg);
                        }
                        reset_{$funname}(res.data);
                        {$success}
                    } else {
                        {$funname}();
                        alert(res.msg);
                    }
                }
            }
            return false;
        }
        {$funname}();
</script>
EOF;
        $hidden = '<input type="hidden" name="__token__'.$token_id.'" id="'.$token_id.'" value="" />'.$jsStr;
        $result['hidden'] = $hidden;
        return $result;
    }
}