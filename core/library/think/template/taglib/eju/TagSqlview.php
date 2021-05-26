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
    public function getSqlview($aid = 0,$table = '',$map = [],$mapkey = [],$field = "*",$addwhere = ''){
        $aid = !empty($aid) ? $aid : $this->aid;
        if (empty($table)){
            echo '标签sqlview报错：缺少属性 table 。';
            return false;
        }

        $result = [];
        if (!empty($addwhere) || !empty($map)){
            if (!empty($addwhere)){
                $where = $addwhere;
            }else if (!empty($map)){
                foreach ($map as $key=>$val){
                    $where[$mapkey[$key]] = $val;
                }
            }
            $result = db($table)->field($field)->where($addwhere)->find();
        } else {
            if (empty($aid)){
//                echo '标签sqlview报错：缺少属性 aid 。';
                return false;
            } else {
                $result = db($table)->field($field)->find($aid);
            }
        }
        
        if (empty($result)){
            return false;
        }

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
        isset($result['litpic']) && $result['litpic'] = thumb_img(get_default_pic($result['litpic'])); // 默认封面图
        isset($result['saleman_pic']) && $result['saleman_pic'] = thumb_img(get_default_pic($result['saleman_pic'])); // 默认封面图


        return $result;
    }
}