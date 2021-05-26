<?php
/**
 * User: xyz
 * Date: 2020/3/12
 * Time: 17:02
 */

namespace app\user\model;

use think\Model;

class Article extends Model
{
    //初始化
    protected function initialize()
    {
        // 需要调用`Model`的`initialize`方法
        parent::initialize();
    }

    /**
     * 后置操作方法
     * 自定义的一个函数 用于数据保存后做的相应处理操作, 使用时手动调用
     * @param int $aid 产品id
     * @param array $post post数据
     * @param string $opt 操作
     */
    public function afterSave($aid, $post, $opt)
    {
        $post['aid'] = $aid;
        $field = new \app\admin\model\Field();
        $addonFieldExt = !empty($post['addonFieldExt']) ? $post['addonFieldExt'] : array();
        $field->dealChannelPostData($post['channel'], $post, $addonFieldExt);
        // --处理TAG标签
        model('Taglist')->savetags($aid, $post['typeid'], $post['tags']);
    }
    /*
    * 获取单条新房基本信息
    */
    public function getOne($condition,$fields = "c.*,b.*, a.*, a.aid as aid"){
        $row = db('archives')
            ->field($fields)
            ->alias('a')
            ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')
            ->join('article_content c','a.aid = c.aid')
            ->where($condition)
            ->find();

        return $row;
    }
}