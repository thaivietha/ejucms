<?php
/**
 * User: xyz
 * Date: 2019/11/11
 * Time: 16:36
 */

namespace app\user\controller;

use app\user\logic\SmtpmailLogic;

class Smtpmail extends Base
{
    public $smtpmailLogic;

    /**
     * 构造方法
     */
    public function __construct(){
        parent::__construct();
        $this->smtpmailLogic = new SmtpmailLogic;
    }
    /**
     * 发送邮件
     */
    public function send_email($email = '', $title = '', $type = 'reg', $scene = 2)
    {
        // 超时后，断掉邮件发送
        function_exists('set_time_limit') && set_time_limit(5);

        $data = $this->smtpmailLogic->send_email($email, $title, $type, $scene);
        if (1 == $data['code']) {
            $this->success($data['msg']);
        } else {
            $this->error($data['msg']);
        }
    }

}