<?php
/**
 * User: xyz
 * Date: 2020/3/31
 * Time: 15:59
 */

namespace app\home\controller;

use think\Db;
use think\Verify;

class Remark extends Base
{
    public $users = [
        'users_id' => 0,
        'admin_id' => 0,
        'nickname' => '游客',
        'username' => '游客',
    ];
    public $users_id = 0;
    public $nickname = '游客';

    public function _initialize() {
        parent::_initialize();
        $this->users['litpic'] = get_head_pic();
        // 问题表
        $LatestData = $this->GetUsersLatestData();
        if (!empty($LatestData)) {
            // 会员全部信息
            $this->users = $LatestData;
            $this->users['nickname'] = !empty($LatestData['nickname']) ? $LatestData['nickname'] : $LatestData['username'];
            // 会员ID
            $this->users_id = $LatestData['users_id'];
            // 会员昵称
            $this->nickname = !empty($LatestData['nickname']) ? $LatestData['nickname'] : $LatestData['username'];

        }
        $this->assign('users', $this->users);
    }
    // 是否允许发布、编辑问题
    private function IsRelease($is_add = true)
    {
        $config = tpCache('remark');
        if (empty($this->users_id) && !empty($config['remark_add_status'])) {
            if (!empty($is_add)) {
                $this->error('游客不允许发布点评，请先登陆！',url('user/Users/login'));
            }else{
                $this->error('游客不允许编辑点评，请先登陆！',url('user/Users/login'));
            }
        }
    }
    public function add(){
        $this->IsRelease();
        // 默认开启验证码
        $is_vertify = 1;
        $users_login_captcha = config('captcha.form_submit');
        if (!function_exists('imagettftext') || empty($users_login_captcha['is_on'])) {
            $is_vertify = 0; // 函数不存在，不符合开启的条件
        }
        if (IS_AJAX_POST){
            $config = tpCache('remark');
            $param = input('param.');
            foreach ($param as $key=>$val){
                $param[$key] = remove_xss($val);
            }
            if (empty($param['content'])) {
                $this->error('点评内容不能为空！', null, ['status'=>1]);
            }
            if (1 == $is_vertify) {
                if (empty($param['verify'])) {
                    $this->error('图片验证码不能为空！', null, ['status'=>1]);
                }
                $verify = new Verify();
                if (!$verify->check($param['verify'], "form_submit")) {
                    $this->error('验证码错误', null, ['status'=>'vertify']);
                }
            }
            $aid = !empty($param['aid']) ? $param['aid'] : 0;
            if (!empty($config['remark_add_status']) && empty($config['remark_add_more'])){     //不可重复点评
                $have = Db::name("remark")->where(['aid'=>$aid,'users_id'=>$this->users_id])->find();
                if ($have){
                    $this->error('您已经点评过本楼盘，不允许重复点评！', null, ['status'=>1]);
                }
            }
            $param['content'] = htmlspecialchars($param['content']);
            $AddData = [
                'users_id'    => $this->users_id,
                'aid'   => $aid,
                'add_time'    => getTime(),
                'update_time' => getTime(),
            ];
            if (!empty($config['remark_add_check']) && 1 == $config['remark_add_check']) $AddData['status'] = 0;
            $AddData = array_merge($param,$AddData);
            $ResultId = Db::name("remark")->add($AddData);
            if (!empty($ResultId)) {
                if (1 == $config['remark_add_check']) {
                    $this->success('发布成功，但你的点评需要管理员审核！');
                }else{
                    $this->success('发布成功！');
                }
            }else{
                $this->error('发布的信息有误，请检查！');
            }

        }
    }
}