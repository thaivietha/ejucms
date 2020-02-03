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

use think\Request;

/**
 * 搜索表单
 */
class TagSearchform extends Base
{
    //初始化
    protected function _initialize()
    {
        parent::_initialize();
    }

    /**
     * 获取搜索表单
     * @author wengxianhu by 2018-4-20
     */
    public function getSearchform($typeid = '', $channelid = '', $notypeid = '', $flag = '', $noflag = '',$present = '')
    {
        $searchurl = url('home/Search/lists');
        $url_screen_var = config('global.url_screen_var');
        $hidden = '';
        if ($present == 'on'){
            $hidden .= '<input type="hidden" name="m" value="'.MODULE_NAME.'" />';
            $hidden .= '<input type="hidden" name="c" value="'.CONTROLLER_NAME.'" />';
            $hidden .= '<input type="hidden" name="a" value="'.ACTION_NAME.'" />';
            $hidden .= '<input type="hidden" name="'.$url_screen_var.'" value="1" />';
            $url_name = MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
            $searchurl = url($url_name);
        }else if (!empty($typeid)){
            $hidden .= '<input type="hidden" name="m" value="home" />';
            $hidden .= '<input type="hidden" name="c" value="Lists" />';
            $hidden .= '<input type="hidden" name="a" value="index" />';
            $hidden .= '<input type="hidden" name="tid" id="tid" value="'.$typeid.'" />';
            $hidden .= '<input type="hidden" name="'.$url_screen_var.'" value="1" />';
            $searchurl = "/";
        }else{
            $hidden .= '<input type="hidden" name="m" value="home" />';
            $hidden .= '<input type="hidden" name="c" value="Search" />';
            $hidden .= '<input type="hidden" name="a" value="lists" />';
            !empty($typeid) && $hidden .= '<input type="hidden" name="typeid" id="typeid" value="'.$typeid.'" />';
            !empty($channelid) && $hidden .= '<input type="hidden" name="channelid" id="channelid" value="'.$channelid.'" />';
            !empty($notypeid) && $hidden .= '<input type="hidden" name="notypeid" id="notypeid" value="'.$notypeid.'" />';
            !empty($flag) && $hidden .= '<input type="hidden" name="flag" id="flag" value="'.$flag.'" />';
            !empty($noflag) && $hidden .= '<input type="hidden" name="noflag" id="noflag" value="'.$noflag.'" />';
        }
        $result[0] = array(
            'searchurl' => $searchurl,
            'action' => $searchurl,
            'hidden'    => $hidden,
        );
        
        return $result;
    }
}