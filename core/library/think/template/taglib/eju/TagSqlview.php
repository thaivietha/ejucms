<?php
/**
 * Created by PhpStorm.
 * User: 28773
 * Date: 2019/7/31
 * Time: 15:09
 */

namespace think\template\taglib\eju;

use think\Db;

class TagSqlview extends Base
{
    public $aid = '';
    protected function _initialize()
    {
        parent::_initialize();
        $this->aid = I('param.aid/d', 0);
    }
    
    /*
     * 获取单个信息
     */
    public function getSqlview($aid = 0,$table = '',$map = [],$mapkey = [],$field = "*"){
        $aid = !empty($aid) ? $aid : $this->aid;
        if (empty($table)){
            echo '标签sonarcview报错：缺少属性 table 。';
            return false;
        }
        if (empty($aid)){
           echo '标签sonarcview报错：缺少属性 aid 。';
            return false;
        }
        $where = [];
        if (!empty($map)){
            foreach ($map as $key=>$val){
                $where[$mapkey[$key]] = $val;
            }
        }
        $result = db($table)->field($field)->where($where)->find($aid);
        if (!empty($result['channel'])){
            $channeltype_info = model('Channeltype')->getInfo($result['channel']);
            $controller_name = $channeltype_info['ctl_name'];
        }
        if (isset($result['is_part'])){
            if ($result['is_part'] == 1) {
                $result['typeurl'] = $result['typelink'];
            } else {
                $result['typeurl'] = typeurl('home/'.$controller_name."/lists", $result);
            }
        }
        if (isset($result['is_jump'])){
            if ($result['is_jump'] == 1) {
                $result['arcurl'] = $result['jumplinks'];
            } else {
                $result['arcurl'] = arcurl('home/'.$controller_name.'/view', $result);
            }
        }
        if (isset($result['litpic'])){
            $result['litpic'] = thumb_img(get_default_pic($result['litpic'])); // 默认封面图
        }
        return $result;
    }
}