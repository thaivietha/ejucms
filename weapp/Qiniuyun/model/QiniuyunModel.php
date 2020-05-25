<?php
/**
 * 易优CMS
 * ============================================================================
 * 版权所有 2016-2028 海南赞赞网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.eyoucms.com
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 陈风任 <491085389@qq.com>
 * Date: 2019-04-23
 */

namespace weapp\Qiniuyun\model;

use think\Model;
use think\Db;

//引入七牛云的相关文件
use Qiniu\Auth as Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;
use Qiniu\Http\Client;
use Qiniu\Http\Error;
/**
 * 模型
 */
class QiniuyunModel extends Model
{
    //初始化
    protected function initialize()
    {
        $this->weapp_db = Db::name('weapp');
        // 需要调用`Model`的`initialize`方法
        parent::initialize();
        require_once ROOT_PATH.'weapp/Qiniuyun/vendor/Qiniu/autoload.php';
    }

    // 获取bucket列表
    public function listBucket($Qiniuyun=null){
        // 判断传入的七牛云配置信息并实例化七牛云操作类
        if (!empty($Qiniuyun) && is_array($Qiniuyun)) {
            $auth     = new Auth($Qiniuyun['access_key'], $Qiniuyun['secret_key']);
        }else{
            $data     = $this->weapp_db->where('code','Qiniuyun')->field('data')->find();
            $Qiniuyun = json_decode($data['data'], true);
            $auth     = new Auth($Qiniuyun['access_key'], $Qiniuyun['secret_key']);
        }
        
        // 查询空间
        $url     = "http://rs.qbox.me/buckets";
        $headers = $auth->authorization($url);
        $ret     = Client::get($url, $headers);

        // 结果返回
        $result  = json_decode(json_encode($ret),true);
        $body    = json_decode($result['body'],true);
        if ('200' == $result['statusCode']) {
            if (!empty($body)) {
                return $body;
            }else{
                return false;
            }
        }else{
            return 'false';
        }
    }

    // 生成bucket
    public function createBucket($Qiniuyun,$region="z0"){
        if (!is_array($Qiniuyun)) {
            return false;
        }

        // 七牛云配置信息并实例化七牛云操作类
        $auth    = new Auth($Qiniuyun['access_key'], $Qiniuyun['secret_key']);

        // bucket加密
        $find    = array('+', '/');
        $replace = array('-', '_');
        $bucket  = str_replace($find, $replace, base64_encode($Qiniuyun['bucket']));

        // 生成bucket空间
        $url     = "http://rs.qiniu.com/mkbucketv2/$bucket/region/$region";
        $headers = $auth->authorization($url);
        $ret     = Client::post($url,"", $headers);

        // 结果返回
        $result  = json_decode(json_encode($ret),true);
        if ('614' == $result['statusCode']) {
            // 这个状态表示七牛云上已有相同的存储空间名，生成失败，但是返回TRUE，添加成功时，会获取七牛云相关存储空间回来
            return true;
        }
        if ('200' == $result['statusCode']) {
            return true;
        }else{
            return false;
        }
    }

    // 获取bucket空间域名
    public function listBucketDomain($Qiniuyun=null){
        // 判断传入的七牛云配置信息并实例化七牛云操作类
        if (!empty($Qiniuyun) && is_array($Qiniuyun)) {
            $auth     = new Auth($Qiniuyun['access_key'], $Qiniuyun['secret_key']);
            $bucket   = $Qiniuyun['bucket'];
        }else{
            $data     = $this->weapp_db->where('code','Qiniuyun')->field('data')->find();
            $Qiniuyun = json_decode($data['data'], true);
            $auth     = new Auth($Qiniuyun['access_key'], $Qiniuyun['secret_key']);
            $bucket   = $Qiniuyun['bucket'];
        }

        // 查询空间
        $url     = "http://api.qiniu.com/v6/domain/list?tbl=$bucket";
        $headers = $auth->authorization($url);
        $ret     = Client::get($url, $headers);

        // 结果返回
        $result  = json_decode(json_encode($ret),true);
        $body    = json_decode($result['body'],true);
        if ('200' == $result['statusCode']) {
            if (!empty($body)) {
                return $body;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // 判断bucket是否已存在
    public function doBucketExist($Qiniuyun){
        $result = $this->listBucket($Qiniuyun);
        if ('false' != $result) {
            if(in_array($Qiniuyun['bucket'], $result)){
                return '存储空间名已经存在，请检查！';
            }
        }
        return false;
    }
}