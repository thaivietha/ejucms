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

namespace app\admin\model;

use think\Model;

/**
 * 小程序主表
 */
class Minipro extends Model
{
    /**
     * 小程序配置信息的type值
     */
    public $miniproType = 'minipro';

    /**
     * 小程序全局配置信息的type值
     */
    public $globalType = 'global';

    /**
     * 小程序首页配置信息的type值
     */
    public $homeType = 'home';

    /**
     * 小程序关于配置信息的type值
     */
    public $aboutType = 'about';

    //初始化
    protected function initialize()
    {
        // 需要调用`Model`的`initialize`方法
        parent::initialize();
    }

    /**
     * 获取配置记录
     * @param string $type 类型
     * @author 小虎哥 by 2018-8-18
     */
    public function getRow($type)
    {
        $map = array(
            'type'  => $type,
        );
        $row = $this->where($map)->find();
        if (!empty($row)) {
            $row['value'] = (array)json_decode($row['value'], true);
        }

        return $row;
    }

    /**
     * 获取配置值
     * @param string $type 类型
     * @author 小虎哥 by 2018-8-18
     */
    public function getValue($type)
    {
        $row = $this->getRow($type);
        $value = array();
        if (!empty($row)) {
            $value = $row['value'];
        }

        return $value;
    }

    /**
     * 设置配置值
     * @param string $type 类型
     * @author 小虎哥 by 2018-8-18
     */
    public function setValue($type, $value)
    {
        $row = $this->getRow($type);
        if (empty($row)) {
            $data = array(
                'type' => $type,
                'value' => json_encode($value),
                'add_time' => getTime(),
            );
            $r = $this->insert($data);
        } else {
            $data = array(
                'type' => $type,
                'value' => json_encode($value),
                'update_time' => getTime(),
            );
            $r = $this->where('type','eq',$type)->update($data);
        }
        if (false !== $r) {
            return true;
        }

        return false;
    }
}