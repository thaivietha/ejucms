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

namespace think\template\taglib\eju;

/**
 * 单个广告信息
 */
class TagAd extends Base
{
    //初始化
    protected function _initialize()
    {
        parent::_initialize();
    }

    /**
     * 获取单个广告信息
     * @author wengxianhu by 2018-4-20
     */
    public function getAd($aid = '')
    {
        if (empty($aid)) {
            echo '标签ad报错：缺少属性 aid 值。';
            return false;
        }

        $result = M("ad")->where([
                'id'    => $aid,
            ])
            ->cache(true,EYOUCMS_CACHE_TIME,"ad")
            ->find();
        if (empty($result)) {
            echo '标签ad报错：该广告ID('.$aid.')不存在。';
            return false;
        }
        
        $result['litpic'] = handle_subdir_pic(get_default_pic($result['litpic'])); // 默认无图封面
        $result['intro'] = htmlspecialchars_decode($result['intro']); // 解码内容
        $result['target'] = ($result['target'] == 1) ? 'target="_blank"' : 'target="_self"';

        /*支持子目录*/
        $result['intro'] = handle_subdir_pic($result['intro'], 'html');
        /*--end*/

        return $result;
    }
}