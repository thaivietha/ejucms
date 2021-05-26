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

namespace app\admin\logic;

use think\Model;
use think\Db;
use app\admin\model\Minipro;

/**
 * 小程序逻辑定义
 * Class CatsLogic
 * @package admin\Logic
 */
load_trait('controller/Jump');
class MiniproLogic extends Model
{
    use \traits\controller\Jump;

    /**
     * 析构函数
     */
    function __construct()
    {
        $this->model = new Minipro;
    }

    /**
     * 小程序链接类型列表
     */
    public function pages_list()
    {
        $pages = array(
            1   => array(
                'title' => '首页',
                'path' => '/pages/index/index',
                'showtext'  => false,
            ),
            2   => array(
                'title' => '导航页',
                'path' => '/pages/arctype/index',
                'showtext'  => false,
            ),
            3   => array(
                'title' => '列表页',
                'path' => '/pages/plus/lists?typeid=',
                'showtext'  => true,
            ),
            4   => array(
                'title' => '单页面',
                'path' => '/pages/plus/single?typeid=',
                'showtext'  => true,
            ),
            5   => array(
                'title' => '内容页',
                'path' => '/pages/plus/view?aid=',
                'showtext'  => true,
            ),
            6   => array(
                'title' => '报名管理',
                'path' => '/pages/plus/form?id=',
                'showtext'  => true,
            ),
            7   => array(
                'title' => '联系我们',
                'path' => '/pages/contact/index',
                'showtext'  => false,
            ),
        );

        return $pages;
    }

    /**
     * 获取小程序链接
     */
    public function get_pages_path($key, $typeid = '')
    {
        $pages = $this->pages_list();
        $path = $pages[1];
        if (!empty($pages[$key])) {
            $path = $pages[$key]['path'];
            if (!in_array(intval($key), [1,2,7])) {
                $path .= $typeid;
            }
        }

        return $path;
    }

    /**
     * 接口转化
     */
    public function get_api_url($query_str)
    {
        $cms_type = config('global.cms_type');
        $apiUrl = 'aHR0cHM6Ly9zZXJ2aWNlLmV5b3VjbXMuY29t';
        $url = base64_decode($apiUrl).rtrim($query_str, '&')."&cms_type=".$cms_type;
        return $url;
    }

    /**
     * 获取最新的小程序参数配置
     */
    public function getSetting()
    {
        $data = $this->model->getValue($this->model->miniproType);
        if (!empty($data)) {
            $cms_type = config('global.cms_type');
            $url = "/index.php?m=api&c=CmsMiniproClient&a=minipro&cms_type={$cms_type}&appId=".$data['appId']."&appSecret=".$data['appSecret'];
            $response = httpRequest($this->get_api_url($url));
            $params = array();
            $params = json_decode($response, true);
            if (!empty($params) && $params['errcode'] == 0) {
                $bool = $this->model->setValue($this->model->miniproType, $params['errmsg']);
                if ($bool) {
                    $data = $this->model->getValue($this->model->miniproType);
                } else {
                    $data = $params['errmsg'];
                }
            }
        }

        return $data;
    }
}
