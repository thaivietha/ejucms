<?php
/**
 * User: xyz
 * Date: 2019/11/11
 * Time: 11:35
 */

namespace app\admin\controller;

use think\Db;
use weapp\QqLogin\model\QqLoginModel;
use weapp\WxLogin\model\WxLoginModel;

class UsersConfig extends Base
{
    private $qqmodel;
    private $wxmodel;
    public function __construct(){
        parent::__construct();
        $this->qqmodel = new QqLoginModel;
        $this->wxmodel = new WxLoginModel;
        /*--end*/
    }
    /*
     * 注册设置
     */
    public function register(){
        if (IS_POST) {
            $post = input('post.');
            if (!empty($post['users'])){
                getUsersConfigData('users', $post['users']);
            }
            $this->success('操作成功');
        }
        $users_verification_list = ['不验证','后台激活','邮件验证','短信验证'];
        $info = getUsersConfigData('all');
        $assign_data = ['users_verification_list'=>$users_verification_list,'info'=>$info];
        //qq登陆配置
        $web_basehost = tpCache('web.web_basehost');
        $qqcallback = $web_basehost.$this->root_dir.'/index.php?m=plugins&c=QqLogin&a=login';
        $assign_data['qqcallback'] = $qqcallback;
        $qqinfo = $this->qqmodel->getWeappData();
        $assign_data['qqinfo'] = $qqinfo;
        //微信登陆配置
        $wxinfo = $this->wxmodel->getWeappData();
        $assign_data['wxinfo'] = $wxinfo;
        $wxlogin_url = url('Users/wxlogin', [], true, false, 1, 1, 0);
        $assign_data['wxlogin_url'] = $wxlogin_url;

        $this->assign($assign_data);

        return $this->fetch();
    }
    //qq登陆配置提交
    public function qqlogin(){
        if (IS_POST) {
            $data = input('post.');
            $data['appid']  = trim($data['appid']);
            if (empty($data['appid'])) {
                $this->error('QQ应用appid不能为空！');
            }
            $data['appkey'] = trim($data['appkey']);
            if (empty($data['appkey'])) {
                $this->error('QQ应用appkey不能为空！');
            }
            $info = $this->qqmodel->getWeappData();
            if (empty($info['data'])) {
                if (!empty($data['appid']) && !empty($data['appkey'])) {
                    $data['login_show'] = 1;
                }
            }
            $saveData = array(
                'data'        => serialize($data),
                'update_time' => getTime(),
            );
            $r = Db::name('weapp')->where(array('code' => 'QqLogin'))->update($saveData);
            if ($r) {
                adminLog('编辑qq登陆配置成功'); // 写入操作日志
                $this->success("操作成功!");
            }
        }
        $this->error("操作失败");
    }
    //微信登陆配置提交
    public function wxlogin(){
        if (IS_POST) {
            $post = input('post.');
            $data = $post['wx'];
            $data['appid']  = trim($data['appid']);
            if (empty($data['appid'])) {
                $this->error('微信应用appid不能为空！');
            }
            $data['secret'] = trim($data['secret']);
            if (empty($data['secret'])) {
                $this->error('微信应用secret不能为空！');
            }
            $info = $this->wxmodel->getWeappData();
            if (empty($info['data'])) {
                if (!empty($data['appid']) && !empty($data['secret'])) {
                    $data['login_show'] = 1;
                }
            }
            $saveData = array(
                'data'        => serialize($data),
                'update_time' => getTime(),
            );
            $r = Db::name('weapp')->where(array('code' => 'WxLogin'))->update($saveData);
            if ($r) {
                adminLog('编辑微信登陆配置成功'); // 写入操作日志
                $this->success("操作成功!");
            }
        }
        $this->error("操作失败");
    }
}