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

namespace weapp\Qiniuyun\controller;

use think\Page;
use think\Db;
use app\common\controller\Weapp;
use weapp\Qiniuyun\model\QiniuyunModel;

/**
 * 插件的控制器
 */
class Qiniuyun extends Weapp
{
    /**
     * 实例化模型
     */
    private $model;

    /**
     * 实例化对象
     */
    private $Weapp_db;

    // 构造方法
    public function __construct(){
        parent::__construct();
        $this->model    = new QiniuyunModel;
        $this->Weapp_db = Db::name('weapp');

        /*插件基本信息*/
        $this->weappInfo = $this->getWeappInfo();
        $this->assign('weappInfo', $this->weappInfo);
        /*--end*/
    }

    // 插件使用指南
    public function doc(){
        return $this->fetch('doc');
    }

    // 插件后台管理
    public function index()
    {
        if (IS_POST) {
            $post = input('post.');
            if (!empty($post)) {
                // 判断提交的数据是否为空
                if (empty($post['access_key'])) {
                    $this->error("AccessKey不可为空！");
                }
                if (empty($post['secret_key'])) {
                    $this->error("SecretKey不可为空！");
                }
                
                // 查询七牛云插件配置信息
                $data = $this->Weapp_db->where('code','Qiniuyun')->field('data')->find();
                if (empty($data['data'])) {
                    // data为空则表示第一次添加插件配置，自动生成一次存储空间
                    $post['bucket'] = 'eyou_qiniuyun';
                    $IsCreate = $this->model->createBucket($post);
                    if (!empty($IsCreate)) {
                        // 创建成功后，拉取对应存储空间下的域名列表，降序排序自动选中第一个，用于存入数据库
                        $Domain = $this->model->listBucketDomain($post);
                        if (!empty($Domain)) {
                            rsort($Domain);
                            $post['domain'] = $Domain['0'];
                        }
                    }else{
                        $this->error("错误代码：101，AccessKey或SecretKey配置有误，请检查！");
                    }

                }else{
                    // data不为空则表示修改插件配置
                    // 查询存储空间列表，判断AccessKey或SecretKey配置是否正确
                    $ResultList = $this->model->listBucket($post);
                    if ('false' == $ResultList) {
                        $this->error("错误代码：102，AccessKey或SecretKey配置有误，请检查！");
                    }

                    if (empty($ResultList)) {
                        // 为空表示配置正确但七牛云上的存储空间已被删除，自动生成一次存储空间
                        $post['bucket'] = 'eyou_qiniuyun';
                        $IsCreate = $this->model->createBucket($post);
                        if (!empty($IsCreate)) {
                            // 创建成功后，拉取对应存储空间下的域名列表，降序排序自动选中第一个，用于存入数据库
                            $Domain = $this->model->listBucketDomain($post);
                            if (!empty($Domain)) {
                                rsort($Domain);
                                $post['domain'] = $Domain['0'];
                            }
                        }else{
                            $this->error("错误代码：103，AccessKey或SecretKey配置有误，请检查！");
                        }
                    }else{
                        if (isset($post['is_bucket']) && !empty($post['is_bucket']) && empty($post['bucket'])) {
                            $this->error("存储空间名不可为空！");
                        } else if (empty($post['bucket'])) {
                            $post['bucket'] = $ResultList[0];
                        }

                        if (isset($post['is_domain']) && !empty($post['is_domain']) && empty($post['domain'])) {
                            $this->error("访问域名不可为空！");
                        }
                    }
                }

                // 更新七牛云插件配置信息
                $data = [
                    'data'        => json_encode($post),
                    'update_time' => getTime(),
                ];
                $IsResult = $this->Weapp_db->where('code','Qiniuyun')->update($data);
                if (!empty($IsResult)) {
                    $this->success("操作成功！");
                }else{
                    $this->error("操作失败！");
                }
            }
        }
       
        // 查询插件配置信息
        $data = $this->Weapp_db->where('code','Qiniuyun')->field('data')->find();
        $Qiniuyun = json_decode($data['data'], true);
        $this->assign('Qiniuyun', $Qiniuyun);

        // 查询七牛云存储空间名称列表
        $ListBucket = $this->model->listBucket($Qiniuyun);
        $this->assign('ListBucket', $ListBucket);

        // 查询七牛云存储空间域名列表
        $ListDomain = $this->model->listBucketDomain($Qiniuyun);
        $this->assign('ListDomain', $ListDomain);

        return $this->fetch('index');
    }

    // 查询选中的存储空间名对应的访问域名
    public function select_domain()
    {
        if (IS_AJAX_POST) {
            $post   = input('post.');
            // 查询插件配置信息
            $data = $this->Weapp_db->where('code','Qiniuyun')->field('data')->find();
            $Qiniuyun = json_decode($data['data'], true);
            // 查询域名
            $Domain = $this->model->listBucketDomain($post);
            // 降序排序
            rsort($Domain);
            // 拼装数据
            if (!empty($Domain)) {
                foreach($Domain as $value){
                    if ($value == $Qiniuyun['domain']) {
                        $html .= "<option value='{$value}' selected>{$value}</option>";
                    }else{
                        $html .= "<option value='{$value}'>{$value}</option>";
                    }
                }
                $this->success("查询正确",'',$html);
            }else{
                $this->error("错误代码：104，存储空间访问域名可能已过期！请检查！");
            }
        }
    }
}