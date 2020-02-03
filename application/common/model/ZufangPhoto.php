<?php
/**
 * User: xyz
 * Date: 2019/10/21
 * Time: 11:04
 */

namespace app\common\model;

use think\Model;

class ZufangPhoto extends Model
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
    public function getListByWhere($map = array(), $field = '*',$typeName = true, $index_key = ''){

        $result = db('zufang_photo')
            ->field($field)
            ->where($map)
            ->order("sort_order asc, photo_id asc")
            ->select();

        if ($result){
            foreach ($result as $key=>$val){
                $result[$key]['photo_pic'] = handle_subdir_pic($val['photo_pic']);
            }
        }
        if (!empty($index_key)) {
            $result = convert_arr_key($result, $index_key);
        }

        return $result;
    }

    /**
     * 获取指定楼盘的相册所有图片
     * @author 小虎哥 by 2018-4-3
     */
    public function getPhotoImg($aids = [], $field = '*')
    {
        $where = ['is_del'=>0];
        !empty($aids) && $where['aid'] = ['IN', $aids];
        $result = db('zufang_photo')->field($field)
            ->where($where)
            ->order('photo_id asc')
            ->select();
        if (!empty($result)) {
            $new_result = array();
            foreach($result as $k=>$v ){
                $v['photo_pic'] = handle_subdir_pic($v['photo_pic']); // 支持子目录
                $new_result[$v['aid']][] = $v;
            }
            $result = $new_result;
        }

        return $result;
    }
}