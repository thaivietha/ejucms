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

namespace app\common\logic;

/**
 * Description of SmsLogic
 *
 * 短信类
 */
class SmsLogic 
{
    private $config;
    
    public function __construct() 
    {
        $this->config = tpCache('sms') ?: [];
    }

    /**
     * 发送短信逻辑
     * @param unknown $scene
     */
    public function sendSms($scene, $sender, $params, $unique_id=0)
    {
        $smsTemp = M('sms_template')->where("send_scene", $scene)->find();
        if (empty($smsTemp) || empty($smsTemp['sms_sign']) || empty($smsTemp['sms_tpl_code'])|| empty($smsTemp['tpl_content'])){
            return $result = ['status' => -1, 'msg' => '请前往设置短信发送配置'];
        }
        $code = !empty($params['code']) ? $params['code'] : '';
        if(empty($unique_id)){
            $session_id = session_id();
        }else{
            $session_id = $unique_id;
        }
        $product = $this->config['sms_product'];
        $msg = $smsTemp['tpl_content'];
        $smsParam_arr = [];
        preg_match_all('/\$\{(.*?)\}/s', $msg, $matchAuthor);
        if (!empty($matchAuthor[1])){   //存在关键字
            foreach ($matchAuthor[1] as $val){
                $content = !empty($params[$val]) ? $params[$val] : '';
                $msg = str_replace('${' . $val . '}', $content, $msg);
                $smsParam_arr[$val] = $content;
            }
        }else{
            return $result = ['status' => -1, 'msg' => '不存在关键字'];
        }
        $smsParam = json_encode($smsParam_arr);
        //发送记录存储数据库
        $log_id = M('sms_log')->insertGetId(array('mobile' => $sender, 'code' => $code, 'add_time' => time(), 'session_id' => $session_id, 'status' => 0, 'scene' => $scene, 'msg' => $msg,'error_msg'=>''));
        if ($sender != '' && check_mobile($sender)) {//如果是正常的手机号码才发送
            try {
                $resp = $this->realSendSms($sender, $smsTemp['sms_sign'], $smsParam, $smsTemp['sms_tpl_code']);
            } catch (\Exception $e) {
                $resp = ['status' => -1, 'msg' => $e->getMessage()];
            }
            if ($resp['status'] == 1) {
                M('sms_log')->where(array('id' => $log_id))->save(array('status' => 1)); //修改发送状态为成功
            }else{
                M('sms_log')->where(array('id' => $log_id))->update(array('error_msg'=>$resp['msg'])); //发送失败, 将发送失败信息保存数据库
            }
            return $resp;
        }else{
           return $result = ['status' => -1, 'msg' => '接收手机号不正确['.$sender.']'];
        }
        
    }

    private function realSendSms($mobile, $smsSign, $smsParam, $templateCode)
    {
        if (config('sms_debug') == true) {
            return array('status' => 1, 'msg' => '专用于越过短信发送');
        }
        $type = (int)$this->config['sms_platform'] ?: 1;
        switch($type) {
            case 1:
                $result = $this->sendSmsByAliyun($mobile, $smsSign, $smsParam, $templateCode);
                break;
            default:
                $result = ['status' => -1, 'msg' => '不支持的短信平台'];
        }
        
        return $result;
    }

    /**
     * 发送短信（阿里云短信）
     * @param $mobile  手机号码
     * @param $code    验证码
     * @return bool    短信发送成功返回true失败返回false
     */
    private function sendSmsByAliyun($mobile, $smsSign, $smsParam, $templateCode)
    {
        include_once './vendor/aliyun-php-sdk-core/Config.php';
        include_once './vendor/Dysmsapi/Request/V20170525/SendSmsRequest.php';
        
        $accessKeyId = $this->config['sms_appkey'];
        $accessKeySecret = $this->config['sms_secretkey'];
        if (empty($accessKeyId) || empty($accessKeySecret)){
            return array('status' => -1, 'msg' => '请设置短信平台appkey和secretKey');
        }
        //短信API产品名
        $product = "Dysmsapi";
        //短信API产品域名
        $domain = "dysmsapi.aliyuncs.com";
        //暂时不支持多Region
        $region = "cn-hangzhou";

        //初始化访问的acsCleint
        $profile = \DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
        \DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);
        $acsClient= new \DefaultAcsClient($profile);

        $request = new \Dysmsapi\Request\V20170525\SendSmsRequest;
        //必填-短信接收号码
        $request->setPhoneNumbers($mobile);
        //必填-短信签名
        $request->setSignName($smsSign);
        //必填-短信模板Code
        $request->setTemplateCode($templateCode);
        //选填-假如模板中存在变量需要替换则为必填(JSON格式)
        $request->setTemplateParam($smsParam);
        //选填-发送短信流水号
        //$request->setOutId("1234");

        //发起访问请求
        $resp = $acsClient->getAcsResponse($request);
        
        //短信发送成功返回True，失败返回false
        if ($resp && $resp->Code == 'OK') {
            return array('status' => 1, 'msg' => $resp->Code);
        } else {
            return array('status' => -1, 'msg' => $resp->Message . '. Code: ' . $resp->Code);
        }
    }
}
