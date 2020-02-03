<?php
/**
 * 易居CMS
 * ============================================================================
 * 版权所有 2018-2028 海南易而优科技有限公司，并保留所有权利。
 * 网站地址: http://www.ejucms.com
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 陈风任 <491085389@qq.com>
 * Date: 2019-1-7
 */

namespace app\common\model;

use think\Db;
use think\Model;

/**
 * 数据库模型
 */
class XinfangPrice extends Model
{
    private $foreign_key = "aid";
    //初始化
    protected function initialize()
    {
        // 需要调用`Model`的`initialize`方法
        parent::initialize();
    }
    public function getForeignKeys(){
        return $this->foreign_key;
    }
    public function getToday($aid, $field = '*', $index_key = ''){
        $beginToday = mktime(0,0,0,date('m'),date('d'),date('Y'));
        $endToday = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
        $map = "aid={$aid} and  create_time >= {$beginToday} AND create_time <= {$endToday}";
        $result = db('xinfang_price')
            ->field($field)
            ->where($map)
            ->select();

        if (!empty($index_key)) {
            $result = convert_arr_key($result, $index_key);
        }

        return $result;
    }
    public function getLast($aid, $field = '*', $index_key = ''){
        $map = "aid={$aid}";
        $result = db('xinfang_price')
            ->field($field)
            ->where($map)
            ->order("create_time desc")
            ->limit(2)
            ->select();
        if (!empty($index_key)) {
            $result = convert_arr_key($result, $index_key);
        }

        return $result;
    }
    
    /**
     * 获取指定楼盘的趋势所有数据
     * @author 小虎哥 by 2018-4-3
     */
    public function getPriceImg($aids = [], $field = '*')
    {
        $where = [];
        !empty($aids) && $where['aid'] = ['IN', $aids];
        $result = db('xinfang_price')->field($field)
            ->where($where)
            ->order('price_id asc')
            ->select();
        if (!empty($result)) {
            $new_result = array();
            foreach($result as $k=>$v ){
                $new_result[$v['aid']][] = $v;
            }
            $result = $new_result;
        }

        return $result;
    }
}