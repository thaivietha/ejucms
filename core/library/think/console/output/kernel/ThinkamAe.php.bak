<?php
namespace think\console\output\kernel;

/**
 * 应用结束
 * 加密方式：by 小虎哥 <1105415366@qq.com>
 */
class ThinkamAe {
    protected static $actionName;
    protected static $controllerName;
    protected static $moduleName;

    /**
     * 构造方法
     * @param Request $request Request对象
     * @access public
     */
    public function __construct()
    {

    }

    // 行为扩展的执行入口必须是run
    public function run(&$params){
        self::$actionName = request()->action();
        self::$controllerName = request()->controller();
        self::$moduleName = request()->module();
        if('GET'==request()->method()) $this->_initialize();
    }

    protected function _initialize() {
        $this->corecall();
    }

    /**
     * 验证葛优瘫
     * @access protected
     */
    protected function corecall() {
        $tmp = 'I3'.'NlcnZpY'.'2VfZX'.'lfdG9rZW'.'4j';
        $token = base64_decode($tmp);
        $token = trim($token, '#');
        $tokenStr = \think\Config::get($token);
        $tmp = 'I3NlcnZ'.'pY2Vf'.'ZXkj';
        $keys = base64_decode($tmp);
        $keys = trim($keys,'#');
        $md5Str = md5('~' . base64_decode(\think\Config::get($keys)) . '~');

        if ($tokenStr != $md5Str) {
            $tmp = 'I+'.'aguO'.'W/g+e'.'oi+W6j'.'+iiq+ev'.'oeaUue+'.'8jOi'.'vt+Ww'.'veW/q'.'+i/mOWO'.'n++8jO'.'aEn+iwou'.'S6q+eUq'.'OW8gOa6'.'kOaYk+WxhS'.'hFanVD'.'TVMp5oi'.'/5Lqn5'.'7O7'.'57ufLiM=';
            $msg = base64_decode($tmp);
            $msg = trim($msg,'#');
            die($msg);
        }
    }
}
?>