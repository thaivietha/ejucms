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

$cacheKey = "extra_global_channeltype";
$channeltype_row = \think\Cache::get($cacheKey);
if (empty($channeltype_row)) {
    $channeltype_row = \think\Db::name('channeltype')->field('id,nid,ctl_name')
        ->order('sort_order asc, id asc')
        ->select();
    \think\Cache::set($cacheKey, $channeltype_row, EYOUCMS_CACHE_TIME, "channeltype");
}

$channeltype_list = [];
$allow_release_channel = [];
foreach ($channeltype_row as $key => $val) {
    $channeltype_list[$val['nid']] = $val['id'];
    if (!in_array($val['nid'], ['guestbook','single'])) {
        array_push($allow_release_channel, $val['id']);
    }
}

return array(
    // CMS根目录文件夹
    'wwwroot_dir' => ['application','core','data','extend','install','public','template','uploads','vendor','weapp'],
    // 禁用栏目的目录名称
    'disable_dirname' => ['application','core','data','extend','install','public','plugins','uploads','template','vendor','weapp','tags','search','user','users','member','reg','centre','login','cart'],
    // CMS类型
    'cms_type' => 1,
    // 发送邮箱默认有效时间，会员中心，邮箱验证时用到
    'email_default_time_out' => 3600,
    // 邮箱发送倒计时 2分钟
    'email_send_time' => 120,
    // 文档SEO描述截取长度，一个字符表示一个汉字或字母
    'arc_seo_description_length' => 125,
    // 栏目最多级别
    'arctype_max_level' => 3,
    // 导航菜单最多级别
    'navig_max_level' => 2,
    // 模型标识
    'channeltype_list' => $channeltype_list,
    // 发布文档的模型ID
    'allow_release_channel' => $allow_release_channel,
    // 广告类型
    'ad_media_type' => array(
        1   => '图片',
        // 2   => 'flash',
        // 3   => '文字',
    ),
    'attr_input_type_arr' => array(
        0   => '单行文本',
        1   => '下拉框',
        2   => '多行文本',
        3   => 'HTML文本',
    ),
    // 栏目自定义字段的channel_id值
    'arctype_channel_id' => -99,
    // 栏目表原始字段
    'arctype_table_fields' => array('id','channeltype','current_channel','parent_id','pointto_id','typename','dirname','dirpath','englist_name','grade','typelink','litpic','templist','tempview','seo_title','seo_keywords','seo_description','sort_order','is_hidden','is_part','admin_id','is_del','del_method','status','add_time','update_time'),
    // 网络图片扩展名
    'image_ext' => 'jpg,jpeg,gif,bmp,ico,png,webp',
    // URL全局参数（比如：多模板v、多站点）
    'parse_url_param'   => ['v','subdomain'],
    // 缩略图默认宽高度
    'thumb' => [
        'open'  => 0,
        'mode'  => 2,
        'color' => '#FFFFFF',
        'width' => 300,
        'height' => 300,
    ],
    // 特殊地区(中国四个省直辖市)，目前在自定义字段控制器中使用
    'field_region_type' => ['1','338','10543','31929'],
    // 选择指定区域ID处理其他操作，目前在自定义字段控制器中使用
    'field_region_all_type' => ['-1','0','1','338','10543','31929'],
    // URL中筛选标识变量
    'url_screen_var' => '_screen',
    // 清理文件时，需要查询的数据表和字段
    'get_tablearray' => [
        [
            'table' => 'ad',
            'field' => 'litpic',
        ],
        [
            'table' => 'ad',
            'field' => 'intro',
        ],
        [
            'table' => 'admin',
            'field' => 'head_pic',
        ],
        [
            'table' => 'archives',
            'field' => 'litpic',
        ],
        [
            'table' => 'arctype',
            'field' => 'litpic',
        ],
        [
            'table' => 'article_content',
            'field' => 'content',
        ],
        [
            'table' => 'config',
            'field' => 'value',
        ],
        [
            'table' => 'images_content',
            'field' => 'content',
        ],
        [
            'table' => 'images_upload',
            'field' => 'image_url',
        ],
        [
            'table' => 'links',
            'field' => 'logo',
        ],
        [
            'table' => 'region',
            'field' => 'litpic',
        ],
        [
            'table' => 'saleman',
            'field' => 'saleman_pic',
        ],
        [
            'table' => 'single_content',
            'field' => 'content',
        ],
        [
            'table' => 'tuan_content',
            'field' => 'content',
        ],
        [
            'table' => 'xinfang_content',
            'field' => 'qr_code',
        ],
        [
            'table' => 'xinfang_content',
            'field' => 'phone_qr_code',
        ],
        [
            'table' => 'xinfang_content',
            'field' => 'content',
        ],
        [
            'table' => 'xinfang_huxing',
            'field' => 'huxing_pic',
        ],
        [
            'table' => 'xinfang_photo',
            'field' => 'photo_pic',
        ],
        // 后续可持续添加数据表和字段，格式参照以上
    ],
    'baidu_map_ak'           => 'ETLXgCxIoVixggHcAk6mKpMd',   //百度地图ak值
    // 前台模板主题
    'tpl_theme' => 'default',
    //表单正则规则管理
    'input_rule' => [
        '1'=> [
            'name' => '电话',
            'value' => '/^1\d{10}$/'
        ],
        '2' => [
            'name' => '邮箱',
            'value' => '/^[A-Za-z0-9\u4e00-\u9fa5]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/'
        ],
    ],
);