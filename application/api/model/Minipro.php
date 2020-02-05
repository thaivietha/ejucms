<?php
/**
 * 易优CMS
 * ============================================================================
 * 版权所有 2016-2028 海南赞赞网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.eyoucms.com
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 小虎哥 <1105415366@qq.com>
 * Date: 2018-4-3
 */

namespace app\api\model;

use think\Model;
use think\Db;
use app\home\logic\FieldLogic;

/**
 * 模型
 */
class Minipro extends Model
{
    // 插件标识
    public $nid;
    // 前台语言标识
    private $home_lang = 'cn';

    //初始化
    protected function initialize()
    {
        // 需要调用`Model`的`initialize`方法
        parent::initialize();
        $this->nid                = 'Minipro';
        $system_home_default_lang = tpCache('system.system_home_default_lang');
        !empty($system_home_default_lang) && $this->home_lang = $system_home_default_lang;
        $this->fieldLogic = new FieldLogic();
    }

    /**
     * 全局常量
     * @param string $type 类型
     * @author 小虎哥 by 2018-8-18
     */
    public function getGlobalsConf()
    {
        $cacheKey = 'model-' . $this->nid . '-getGlobalsConf';
        $result   = cache($cacheKey);
        if (empty($result)) {
            $webData   = tpCache('web');
            $barlist   = $this->getBarlist();
            $webconfig = array(
                'web_name'      => empty($barlist['nav_title']) ? $webData['web_name'] : $barlist['nav_title'],
                'web_copyright' => empty($barlist['copyright']) ? $webData['web_copyright'] : $barlist['copyright'],
            );
            $result    = array(
                'webconfig' => $webconfig,
                'blist'     => $barlist,
            );

            cache($cacheKey, $result, null, 'minipro');
        }

        return $result;
    }

    /**
     * 获取配置值
     * @param string $type 类型
     * @author 小虎哥 by 2018-8-18
     */
    public function getValue($type)
    {
        // $cacheKey = 'model-'.$this->nid.'-getValue-'.$type;
        // $value = cache($cacheKey);
        // if (empty($value)) {
        $map   = array(
            'type' => $type,
        );
        $value = Db::name('minipro')->where($map)->cache(true, EYOUCMS_CACHE_TIME, "minipro")->value('value');
        $value = (array)json_decode($value, true);

        // cache($cacheKey, $value, null, 'minipro');
        // }

        return $value;
    }

    /**
     * 首页配置
     */
    public function getHomeConf()
    {
        // 定义公共常量
        $result = $this->getValue('home');
        foreach ($result as $key => $val) {
            if (is_array($val)) {
                foreach ($val as $k2 => $v2) {
                    /*转换图片为远程http*/
                    if (1 == preg_match('/(_img|_selimg)$/', $k2)) {
                        if (!is_http_url($v2)) {
                            $result[$key][$k2] = request()->domain() . $v2;
                        }
                    }
                    /*--end*/
                }
            }
        }

        return $result;
    }

    /**
     * 获取幻灯片
     * @param int $num 数量
     * @param string $aid 文档ID，多个以逗号隔开
     */
    public function getSwipersList($aid = '')
    {
        // $cacheKey = 'model-'.$this->nid."-getSwipersList-{$aid}";
        // $result = cache($cacheKey);
        // if (empty($result)) {
        if (empty($aid)) {
            $map = array(
                'is_head' => 1,
                'status'  => 1,
                'is_del'  => 0,
            );
            $num = 8;
        } else {
            $map = array(
                'aid'    => array('in', $aid),
                'is_del' => 0,
            );
            $num = '';
        }
        $result = Db::name('archives')->field('aid,litpic')
            ->where($map)
            ->order('sort_order asc, aid desc')
            ->limit($num)
            ->cache(true, EYOUCMS_CACHE_TIME, "minipro")
            ->select();
        foreach ($result as $key => $val) {
            $val['litpic'] = get_default_pic($val['litpic'], true);
            $result[$key]  = $val;
        }

        // cache($cacheKey, $result, null, 'minipro');
        // }

        return $result;
    }

    /**
     * 获取全部栏目
     * @param string $channel 栏目ID，多个以逗号隔开
     * @param int $num 数量
     */
    public function getArctype($channel = '')
    {
        $channel  = intval($channel);
        $args     = func_get_args();
        $cacheKey = 'model-' . $this->nid . "-getArctype-{$args}";
        $result   = cache($cacheKey);
        if (true || empty($result)) {
            $result = Db::name('arctype')
                ->where(['is_hidden' => 0, 'is_del' => 0, 'status' => 1, 'current_channel' => $channel])
                ->where('grade', '>', 0)
                ->select();
            foreach ($result as $k => $v) {
                $result[$k]['title'] = $v['typename'];
            }
            $result = array(
                'conf' => array(//                    'shareTitle' => ($typename ? $typename . '_' : '') . tpCache('web.web_name'),
                ),
                'row'  => $result,
            );

            cache($cacheKey, $result, null, 'minipro');
        }

        return $result;
    }

    /**
     * 文档列表
     * @param string $param 查询条件的数组
     * @param int $page 页码
     * @param int $pagesize 每页记录数
     */
    public function getArchivesList($param = array(), $page = 1, $pagesize = null, $field = 'aid,title,litpic,seo_description,add_time')
    {
        $param['arcrank'] = isset($param['arcrank']) ? $param['arcrank'] : -1;
        $pagesize         = empty($pagesize) ? config('paginate.list_rows') : $pagesize;
        $cacheKey         = "model-" . $this->nid . "-getArchivesList-" . json_encode($param) . "-{$page}-{$pagesize}-{$field}";
        $result           = cache($cacheKey);
        if (empty($result)) {
            $condition = array();

            // 应用搜索条件
            foreach (['channel', 'typeid', 'flag', 'arcrank', 'keyword'] as $key) {

                if (isset($param[$key]) && ('' !== $param[$key] || null !== $param[$key])) {

                    if ('typeid' == $key) {
                        if (!empty($param[$key])) {
                            if (is_string($param[$key]) && stristr($param[$key], ',')) {
                                // 指定多个栏目ID
                                $typeid = func_preg_replace(array('，'), ',', $param[$key]);
                                $typeid = explode(',', $typeid);
                            } else if (is_string($param[$key]) && !stristr($param[$key], ',')) {
                                /*当前栏目ID，以及所有子栏目ID*/
                                $channel_info = Db::name('Arctype')->field('id,current_channel')->where(['id' => ['eq', $param[$key]], 'is_del' => 0])->find();
                                $childrenRow  = model('Arctype')->getHasChildren($param[$key]);
                                foreach ($childrenRow as $k2 => $v2) {
                                    if ($channel_info['current_channel'] != $v2['current_channel']) {
                                        unset($childrenRow[$k2]); // 排除不是同一模型的栏目
                                    }
                                }
                                $typeid = get_arr_column($childrenRow, 'id');
                                /*--end*/
                            }
                            $condition[$key] = array('IN', $typeid);
                        }
                    } else if ('channel' == $key) {
                        if (!empty($param[$key])) {
                            if (is_string($param[$key])) {
                                $channel = func_preg_replace(array('，'), ',', $param[$key]);
                                $channel = explode(',', $channel);
                            }
                            $condition[$key] = array('IN', $channel);
                        }
                    } else if ('flag' == $key) {
                        $tmp_key_arr = array();
                        $flag_arr    = explode(",", $param[$key]);
                        foreach ($flag_arr as $k2 => $v2) {
                            if ($v2 == "c") {
                                array_push($tmp_key_arr, 'is_recom');
                            } elseif ($v2 == "h") {
                                array_push($tmp_key_arr, 'is_head');
                            } elseif ($v2 == "a") {
                                array_push($tmp_key_arr, 'is_special');
                            } elseif ($v2 == "j") {
                                array_push($tmp_key_arr, 'is_jump');
                            }
                        }
                        $tmp_key_str             = implode('|', $tmp_key_arr);
                        $condition[$tmp_key_str] = array('eq', 1);
                    } else if ('arcrank' == $key) {
                        $condition[$key] = array('gt', $param[$key]);
                    } else if ('keyword' == $key) {
                        $condition['title'] = array('like', "%" . $param[$key] . "%");
                    } else {
                        $condition[$key] = array('eq', $param[$key]);
                    }
                }
            }
            $paginate = array(
                'page' => $page,
            );

            $pages = Db::name('archives')->field($field)
                ->where($condition)
                ->where([
                    'channel' => ['NEQ', 6],
                    'is_del'  => 0
                ])
                ->order('sort_order asc, aid desc')
                ->cache(true, EYOUCMS_CACHE_TIME, "minipro")
                ->paginate($pagesize, false, $paginate);

            $list = array();
            foreach ($pages->items() as $key => $val) {
                /*封面图*/
                if (isset($val['litpic'])) {
                    if (empty($val['litpic'])) {
                        $val['is_litpic'] = 0; // 无封面图
                    } else {
                        $val['is_litpic'] = 1; // 有封面图
                    }
                    $val['litpic'] = get_default_pic($val['litpic'], true); // 默认封面图
                }
                /*--end*/
                if (isset($val['add_time'])) {
                    $val['add_time'] = date('Y-m-d', $val['add_time']);
                }
                array_push($list, $val);
            }

            $result = array(
                'conf' => array(
                    'hasMore' => ($page < $pages->lastPage()) ? 1 : 0,
                ),
                'list' => $list,
            );

            cache($cacheKey, $result, null, 'minipro');
        }

        return $result;
    }

    /**
     * 文档详情
     * @param int $aid 文档ID
     */
    public function getArchivesView($aid = '')
    {
        $aid      = intval($aid);
        $cacheKey = "model-" . $this->nid . "-getArchivesView-{$aid}";
        $result   = cache($cacheKey);
        if (empty($result)) {
            $status = 0;
            $msg    = 'Request Error!';
            $row    = array();
            if (0 < $aid) {
                $archivesModel = new \app\home\model\Archives;
                $row           = $archivesModel->getViewInfo($aid, true);
                $status        = 1;
                if (0 > $row['status']) {
                    $msg = '文档尚未审核，非作者本人无权查看';
                }
                /*--end*/
                $row['add_time']    = date('Y-m-d', $row['add_time']); // 格式化发布时间
                $row['update_time'] = date('Y-m-d', $row['update_time']); // 格式化更新时间
                $row['content']     = $this->get_httpimgurl($row['content']); // 转换内容图片为http路径

                /* 上一篇 */
                $preRow = Db::name('archives')->field('a.aid, a.typeid, a.title')
                    ->alias('a')
                    ->where([
                        'a.typeid'  => $row['typeid'],
                        'a.aid'     => ['lt', $aid],
                        'a.status'  => 1,
                        'a.is_del'  => 0,
                        'a.arcrank' => ['EGT', 0],
                    ])
                    ->order('a.aid desc')
                    ->find();

                /* 下一篇 */
                $nextRow = Db::name('archives')->field('a.aid, a.typeid, a.title')
                    ->alias('a')
                    ->where([
                        'a.typeid'  => $row['typeid'],
                        'a.aid'     => ['gt', $aid],
                        'a.status'  => 1,
                        'a.is_del'  => 0,
                        'a.arcrank' => ['EGT', 0],
                    ])
                    ->order('a.aid asc')
                    ->find();
            }

            $result = array(
                'conf'    => array(
                    'status'       => $status,
                    'msg'          => $msg,
                    'attrTitle'    => '参数列表',
                    'contentTitle' => '详情介绍',
                    'shareTitle'   => $row['title'] . '_' . tpCache('web.web_name'),
                ),
                'row'     => $row,
                'preRow'  => $preRow,
                'nextRow' => $nextRow,
            );

            cache($cacheKey, $result, null, 'minipro');
        }

        return $result;
    }

    /**
     * 单页栏目详情
     * @param int $typeid 栏目ID
     */
    public function getSingleView($typeid = '')
    {
        $typeid   = intval($typeid);
        $cacheKey = "model-" . $this->nid . "-getSingleView-{$typeid}";
        $result   = cache($cacheKey);
        if (empty($result)) {
            $status = 0;
            $msg    = 'Request Error!';
            $row    = array();
            if (0 < $typeid) {
                $archivesModel = new \app\home\model\Archives;
                $row           = $archivesModel->getSingleInfo($typeid, true);

                $status = 1;
                if (0 == $row['status']) {
                    $msg = '该文档已屏蔽，无权查看';
                }
                /*--end*/
                $row['add_time']    = date('Y-m-d', $row['add_time']); // 格式化发布时间
                $row['update_time'] = date('Y-m-d', $row['update_time']); // 格式化更新时间
                $row['content']     = $this->get_httpimgurl($row['content']); // 转换内容图片为http路径
            }

            $result = array(
                'conf' => array(
                    'status'     => $status,
                    'msg'        => $msg,
                    'shareTitle' => $row['title'] . '_' . tpCache('web.web_name'),
                ),
                'row'  => $row,
            );

            cache($cacheKey, $result, null, 'minipro');
        }

        return $result;
    }

    /**
     * 关于我们
     */
    public function getAbout()
    {
        $cacheKey = "model-" . $this->nid . "-getAbout";
        $result   = cache($cacheKey);
        if (empty($result)) {
            $shareTitle = '';
            $row        = $this->getValue('about');
            if ($row) {
                foreach ($row as $key => $val) {
                    /*转换图片为远程http*/
                    if (1 == preg_match('/^(logo|banner)$/', $key)) {
                        if (!is_http_url($val)) {
                            $row[$key] = request()->domain() . $val;
                        }
                    }
                    /*--end*/
                }
                $row['content'] = $this->get_httpimgurl($row['content']); // 转换内容图片为http路径
                $shareTitle     = $row['webname'];
            }

            $result = array(
                'conf' => array(
                    'shareTitle' => $shareTitle,
                ),
                'row'  => $row,
            );

            cache($cacheKey, $result, null, 'minipro');
        }

        return $result;
    }

    /**
     * 留言栏目表单
     * @param int $typeid 栏目ID
     */
    public function getGuestbookForm($typeid)
    {
        $typeid = intval($typeid);
        // $cacheKey = "model-".$this->nid."-getGuestbookForm-{$typeid}";
        // $result = cache($cacheKey);
        // if (empty($result)) {
        $list     = array();
        $typename = '';
        if (0 < $typeid) {
            $typename = Db::name('arctype')->where('id', 'eq', $typeid)->value('typename');
            $list     = Db::name('GuestbookAttribute')->field('attr_id,attr_name,attr_input_type,attr_values')
                ->where("typeid = $typeid")
                ->order('sort_order asc')
                ->cache(true, EYOUCMS_CACHE_TIME, "minipro")
                ->select();
            foreach ($list as $key => $val) {
                if (in_array($val['attr_input_type'], array(1, 3))) {
                    $val['attr_values'] = explode(PHP_EOL, $val['attr_values']);
                    $list[$key]         = $val;
                }
            }
        }

        $result = array(
            'conf' => array(
                'shareTitle' => $typename . '_' . tpCache('web.web_name'),
            ),
            'row'  => $list,
        );

        // cache($cacheKey, $result, null, 'minipro');
        // }

        return $result;
    }

    /**
     * 留言表单提交
     * @param array $post post数据
     */
    public function getGuestbookSubmit($post = array())
    {
        $typeid = !empty($post['typeid']) ? intval($post['typeid']) : 0;
        $status = 0;
        $msg    = '表单typeid值丢失！';
        if (0 < $typeid) {
            $ip    = clientIP();
            $map   = array(
                'ip'       => $ip,
                'typeid'   => $typeid,
                'add_time' => array('gt', getTime() - 60),
            );
            $count = M('guestbook')->where($map)->count('aid');
            if (!empty($count)) {
                return array(
                    'status' => 0,
                    'msg'    => '同一个IP在60秒之内不能重复提交！',
                );
            }

            $channeltype_list = config('global.channeltype_list');
            $newData          = array(
                'typeid'      => $typeid,
                'channel'     => $channeltype_list['guestbook'],
                'ip'          => $ip,
                'lang'        => $this->home_lang,
                'add_time'    => getTime(),
                'update_time' => getTime(),
            );
            $aid              = M('guestbook')->insertGetId($newData);
            if ($aid > 0) {
                $this->saveGuestbookAttr($post, $aid, $typeid);
            }

            $status = 1;
            $msg    = '操作成功';
        }

        $result = array(
            'gourl'  => "",
            'status' => $status,
            'msg'    => $msg,
        );

        return $result;
    }

    /**
     *  给指定留言添加表单值到 guestbook_attr
     * @param int $aid 留言id
     * @param int $typeid 留言栏目id
     */
    private function saveGuestbookAttr($post, $aid, $typeid)
    {
        // post 提交的属性  以 attr_id _ 和值的 组合为键名    
        foreach ($post as $k => $v) {
            $attr_id = str_replace('attr_', '', $k);
            if (!strstr($k, 'attr_'))
                continue;

            //$v = str_replace('_', '', $v); // 替换特殊字符
            //$v = str_replace('@', '', $v); // 替换特殊字符
            if (is_array($v)) {
                $v = implode(',', $v);
            } else {
                $v = trim($v);
            }
            $adddata = array(
                'aid'         => $aid,
                'attr_id'     => $attr_id,
                'attr_value'  => $v,
                'lang'        => $this->home_lang,
                'add_time'    => getTime(),
                'update_time' => getTime(),
            );
            M('GuestbookAttr')->add($adddata);
        }
    }

    /**
     * 图片地址替换成http路径
     * @param string $content 内容
     */
    private function get_httpimgurl($content = '')
    {
        $pregRule = "/<img(.*?)src(\s*)=(\s*)[\'|\"]\/(.*?(?:[\.jpg|\.jpeg|\.png|\.gif|\.bmp|\.ico]))[\'|\"](.*?)[\/]?(\s*)>/i";
        $content  = preg_replace($pregRule, '<img ${1} src="' . request()->domain() . '/${4}" ${5} />', $content);

        return $content;
    }

    /**
     * 底部导航菜单
     */
    private function getBarlist()
    {
        // 定义公共常量
        $barlist = $this->getValue('global');
        foreach ($barlist as $key => $val) {
            /*转换图片为远程http*/
            if (1 == preg_match('/(_img|_selimg)$/', $key)) {
                if (!is_http_url($val)) {
                    $barlist[$key] = request()->domain() . $val;
                }
            }
            /*--end*/
        }

        return $barlist;
    }

    /**
     * 图片拼接成http路径
     * @param string $filename 路由地址
     * @param bool|string $domain 域名
     */
    public function getImgRealpath($filename, $domain = true)
    {
        $web_cmspath = tpCache('web.web_cmspath');
        $filename    = $web_cmspath . '/' . WEAPP_DIR_NAME . '/' . $this->nid . '/template/skin/images/' . $filename;
        if ($domain) {
            $filename = request()->domain() . $filename;
        }
        return $filename;
    }

    /**
     * 文档列表
     * @param string $param 查询条件的数组
     * @param int $page 页码
     * @param int $pagesize 每页记录数
     */
    public function getArchivesListNew($param = array(), $page = 1, $pagesize = null, $field = 'a.aid,a.title,a.litpic,a.seo_description,a.add_time,a.province_id,a.city_id')
    {
        $param['arcrank'] = isset($param['arcrank']) ? $param['arcrank'] : -1;
        $pagesize         = empty($pagesize) ? config('paginate.list_rows') : $pagesize;
        $args     = func_get_args();
        $cacheKey = "api-model-" . $this->nid . "-getArchivesListNew-{$args}";
        $result   = cache($cacheKey);
        $status   = 1;
        if (true || empty($result)) {
            $condition = array();
            $order     = '';

            // 应用搜索条件
            foreach (['channel', 'typeid', 'flag', 'arcrank', 'keyword', 'param'] as $key) {

                if (isset($param[$key]) && ('' !== $param[$key] || null !== $param[$key])) {

                    if ('typeid' == $key) {
                        if (!empty($param[$key])) {
//                            if (is_string($param[$key]) && stristr($param[$key], ',')) {
//                                // 指定多个栏目ID
//                                $typeid = func_preg_replace(array('，'), ',', $param[$key]);
//                                $typeid = explode(',', $typeid);
//                            } else if (is_string($param[$key]) && !stristr($param[$key], ',')) {
//                                /*当前栏目ID，以及所有子栏目ID*/
//                                $channel_info = Db::name('Arctype')->field('id,current_channel')->where(['id' => ['eq', $param[$key]], 'is_del' => 0])->find();
//                                $childrenRow  = model('Arctype')->getHasChildren($param[$key]);
//                                foreach ($childrenRow as $k2 => $v2) {
//                                    if ($channel_info['current_channel'] != $v2['current_channel']) {
//                                        unset($childrenRow[$k2]); // 排除不是同一模型的栏目
//                                    }
//                                }
//                                $typeid = get_arr_column($childrenRow, 'id');
//                                /*--end*/
//                            }
//                            $condition['a.' . $key] = array('IN', $typeid);
                            $condition['a.' . $key] = $param[$key];
                        }
                    } else if ('channel' == $key) {
                        if (!empty($param[$key])) {
                            $channel                = $param[$key];
                            $condition['a.' . $key] = $channel;
                        }
                    } else if ('flag' == $key) {
                        $tmp_key_arr = array();
                        $flag_arr    = explode(",", $param[$key]);
                        foreach ($flag_arr as $k2 => $v2) {
                            if ($v2 == "c") {
                                array_push($tmp_key_arr, 'is_recom');
                            } elseif ($v2 == "h") {
                                array_push($tmp_key_arr, 'is_head');
                            } elseif ($v2 == "a") {
                                array_push($tmp_key_arr, 'is_special');
                            } elseif ($v2 == "j") {
                                array_push($tmp_key_arr, 'is_jump');
                            }
                        }
                        $tmp_key_str                    = implode('|', $tmp_key_arr);
                        $condition['a.' . $tmp_key_str] = array('eq', 1);
                    } else if ('arcrank' == $key) {
                        $condition['a.' . $key] = array('gt', $param[$key]);
                    } else if ('keyword' == $key) {
                        if (!empty($param[$key])) {
                            $condition['a.title'] = array('like', "%" . $param[$key] . "%");
                        }
                    } else if ('param' == $key) {//多项筛选
                        foreach ($param[$key] as $k => $v) {
                            if ($k == 'regionId') {
                                $condition["a.province_id|a.city_id"] = $v;
                            } else {
                                $condition["b." . $k] = array('like', "%" . $v . "%");
                            }
                        }
                    } else {
                        $condition['a.' . $key] = array('eq', $param[$key]);
                    }
                }
            }
            if ($channel == 9) {
                if ($param['order'] === '0') {
                    $order = 'b.average_price desc';
                } else if ($param['order'] == 1) {
                    $order = 'b.average_price asc';
                } else if ($param['order'] == 2) {
                    $order = 'b.opening_time asc';
                } else if ($param['order'] == 3) {
                    $order = 'b.opening_time desc';
                }
            } elseif ($channel == 12 || $channel == 13) {
                if ($param['order'] === '0') {
                    $order = 'b.total_price desc';
                } else if ($param['order'] == 1) {
                    $order = 'b.total_price asc';
                }
            } elseif ($channel == 11) {
                if ($param['order'] === '0') {
                    $order = 'b.average_price desc';
                } else if ($param['order'] == 1) {
                    $order = 'b.average_price asc';
                } else if ($param['order'] == 2) {
                    $order = 'b.building_age desc';
                } else if ($param['order'] == 3) {
                    $order = 'b.building_age asc';
                }
            }
            $paginate = array(
                'page' => $page,
            );
            //频道
            $channel_list = Db::name('channeltype')
                ->field('id,ntitle,table')
                ->where(['status' => 1, 'is_del' => 0])
                ->where('id', 'not in', [1, 6])
                ->select();
            $name_list    = [];
            foreach ($channel_list as $key => $val) {
                $name_list[$val['id']] = $channel_list[$key];
            }
            $name = $name_list[$param['channel']]['table'];
            if (in_array($channel, [9, 11, 12, 13])) {
                $pages = Db::name('archives')
                    ->alias('a')
                    ->field($field)
                    ->join($name . '_system b', 'a.aid = b.aid', 'left')
                    ->where($condition)
                    ->where([
                        'a.is_del' => 0, 'a.status' => 1
                    ])
                    ->order($order)
//                ->cache(true, EYOUCMS_CACHE_TIME, "minipro")
                    ->paginate($pagesize, false, $paginate);
                //如果没有数据,就输出推荐
                if($param['sym']<1){
                    if (count($pages) == 0) {
                        $status = 0;
                        //推荐房源
                        $pages = Db::name('archives')
                            ->field('aid,title,litpic,seo_description,add_time,province_id,city_id')
                            ->where([
                                'is_del' => 0, 'status' => 1, 'is_recom' => 1, 'channel' => $channel
                            ])
                            ->where('arcrank', '>', '-1')
                            ->order('sort_order asc, aid desc')
//                    ->fetchSql(true)
//                ->cache(true, EYOUCMS_CACHE_TIME, "minipro")
                            ->paginate($pagesize, false, $paginate);
                    }
                }
                
                //推荐房源为空
                if (count($pages) == 0) {
                    $status = -1;
                }
            } elseif ($channel == 1) {
                //资讯类
                $pages = Db::name('archives')
                    ->alias('a')
                    ->field("a.aid,a.title,a.litpic,a.add_time")
                    ->where($condition)
                    ->where([
                        'a.is_del' => 0, 'a.status' => 1
                    ])
//                ->cache(true, EYOUCMS_CACHE_TIME, "minipro")
                    ->paginate($pagesize, false, $paginate);
                //如果没有数据,就输出推荐
                if (count($pages) == 0) {
                    $status = 0;
                    //推荐房源
                    $pages = Db::name('archives')
                        ->alias('a')
                        ->field("a.aid,a.title,a.litpic,a.add_time")
                        ->where($condition)
                        ->where([
                            'a.is_del' => 0, 'a.status' => 1,'is_recom'=>1
                        ])
//                ->cache(true, EYOUCMS_CACHE_TIME, "minipro")
                        ->paginate($pagesize, false, $paginate);
                }
                //推荐房源为空
                if (count($pages) == 0) {
                    $status = -1;
                }
            }

            $list = [];
            $aids = [];
            foreach ($pages->items() as $key => $val) {
                $aids[]               = $val['aid'];
                $val['province_name'] = get_province_name($val['province_id']);
                $val['city_name']     = get_city_name($val['city_id']);
                /*封面图*/
                if (isset($val['litpic'])) {
                    if (empty($val['litpic'])) {
                        $val['is_litpic'] = 0; // 无封面图
                    } else {
                        $val['is_litpic'] = 1; // 有封面图
                    }
                    $val['litpic'] = get_default_pic($val['litpic'], true); // 默认封面图
                }
                /*--end*/
                if (isset($val['add_time'])) {
                    $val['add_time'] = date('Y-m-d', $val['add_time']);
                }
                array_push($list, $val);
            }

            if ($channel == 9) {
                $content = Db::name($name . '_content')->where('aid', 'in', $aids)->field('aid,sales_address')->getAllWithIndex('aid');
                $huxing  = Db::name($name . '_huxing')->field('aid,min(huxing_area) as min_huxing,max(huxing_area) as max_huxing')->where('aid', 'in', $aids)->group('aid')->getAllWithIndex('aid');
                $system  = Db::name($name . '_system')->field('aid,characteristic,sale_phone,sale_status,average_price')->where('aid', 'in', $aids)->getAllWithIndex('aid');
            } elseif ($channel == 11) {
                $system = Db::name($name . '_system')->field('aid,manage_type,building_age,address,average_price')->where('aid', 'in', $aids)->getAllWithIndex('aid');
                $ershou = Db::name('archives')->field('joinaid,count(*) as count')->where(['is_del' => 0, 'arcrank' => 0, 'status' => 1, 'channel' => 12])->group('joinaid')->getAllWithIndex('joinaid');
                $zufang = Db::name('archives')->field('joinaid,count(*) as count')->where(['is_del' => 0, 'arcrank' => 0, 'status' => 1, 'channel' => 13])->group('joinaid')->getAllWithIndex('joinaid');
            } elseif ($channel == 12) {
                $system = Db::name($name . '_system')->field('aid,total_price,sale_name,characteristic,address,area,aspect,room,living_room,kitchen,toilet')->where('aid', 'in', $aids)->getAllWithIndex('aid');
            } elseif ($channel == 13) {
                $content = Db::name($name . '_content')->where('aid', 'in', $aids)->field('aid,supporting')->getAllWithIndex('aid');
                $system  = Db::name($name . '_system')->field('aid,total_price,sale_name,price_units,characteristic,address,area,aspect,room,living_room,kitchen,toilet')->where('aid', 'in', $aids)->getAllWithIndex('aid');
            }
            if (!empty($content) && $channel != 9) {
                $content = $this->getAllDfvalueUnit($channel, $channel, true);
            }
            if (!empty($system)) {
                $system = $this->getAllDfvalueUnit($channel, $system, true);
            }

            foreach ($list as $key => $val) {
                if (!empty($content)) {
                    if (!empty($content[$val['aid']]['supporting'])) {
                        $content[$val['aid']]['supporting'] = explode(',', $content[$val['aid']]['supporting']);
                    }
                    $list[$key]['ejucms_content'] = $content[$val['aid']];
                }
                if (!empty($huxing)) {
                    $list[$key]['ejucms_huxing'] = $huxing[$val['aid']];
                }
                if (!empty($system)) {
                    if (!empty($system[$val['aid']]['characteristic'])) {
                        $system[$val['aid']]['characteristic'] = explode(',', $system[$val['aid']]['characteristic']);
                    }
                    $list[$key]['ejucms_system'] = $system[$val['aid']];
                }
                if (!empty($ershou)) {
                    $list[$key]['ejucms_ershou'] = $ershou[$val['aid']];
                }
                if (!empty($zufang)) {
                    $list[$key]['ejucms_zufang'] = $zufang[$val['aid']];
                }
            }

            $result = array(
                'conf' => array(
                    'hasMore' => ($page < $pages->lastPage()) ? 1 : 0,
                    'status'  => $status,
                ),
                'list' => $list,
            );

            cache($cacheKey, $result, null, 'minipro');
        }

        return $result;
    }

    /**
     * 文档详情
     * @param int $aid 文档ID
     */
    public function getArchivesViewNew($aid = '')
    {
        $aid      = intval($aid);
        $args     = func_get_args();
        $cacheKey = "api-model-" . $this->nid . "-getArchivesViewNew-{$args}";
        $result   = cache($cacheKey);
        if (true || empty($result)) {
//            $status = 0;
            if (0 < $aid) {
                $channel = Db::name('archives')->where(['is_del' => 0, 'arcrank' => 0, 'status' => 1, 'aid' => $aid])->value('channel');
                if ($channel == 9) {
                    $row                       = Db::name('archives')->field('d.*,b.*,a.aid,a.channel,a.title,a.litpic,a.province_id,a.city_id')
                        ->alias('a')
                        ->where(['a.is_del' => 0, 'a.arcrank' => 0, 'a.status' => 1])
                        ->join('__XINFANG_CONTENT__ b', 'a.aid = b.aid', 'LEFT')
                        ->join('__XINFANG_SYSTEM__ d', 'a.aid = d.aid', 'LEFT')
                        ->find($aid);
                    $row['ejucms_huxing']      = Db::name('xinfang_huxing')->where(['aid' => $aid, 'is_del' => 0])->order('sort_order asc')->select();
                    $row['ejucms_huxing_area'] = Db::name('xinfang_huxing')->field('aid,min(huxing_area) as min,max(huxing_area) as max')->where(['aid' => $aid, 'is_del' => 0])->group('aid')->find();
                    $row['ejucms_photo']       = Db::name('xinfang_photo')->where(['aid' => $aid, 'is_del' => 0])->select();
                    //相关推荐
                    $relatedRow = $this->getRecomList($channel);
                } elseif ($channel == 11) {
                    $row                  = Db::name('archives')->field('d.*,b.*,a.aid,a.channel,a.joinaid,a.title,a.litpic,a.province_id,a.city_id')
                        ->alias('a')
                        ->where(['a.is_del' => 0, 'a.arcrank' => 0, 'a.status' => 1])
                        ->join('xiaoqu_content b', 'a.aid = b.aid', 'LEFT')
                        ->join('xiaoqu_system d', 'a.aid = d.aid', 'LEFT')
                        ->find($aid);
                    $row['ejucms_photo']  = Db::name('xiaoqu_photo')->where(['aid' => $aid, 'is_del' => 0])->select();
                    $row['ejucms_ershou'] = Db::name('archives')->where(['is_del' => 0, 'arcrank' => 0, 'status' => 1, 'channel' => 12, 'joinaid' => $aid])->count();
                    $row['ejucms_zufang'] = Db::name('archives')->where(['is_del' => 0, 'arcrank' => 0, 'status' => 1, 'channel' => 13, 'joinaid' => $aid])->count();
                    $relatedRow           = $this->getRecomList($row['channel'], $aid);
                } elseif ($channel == 12) {
                    $row                 = Db::name('archives')->field('d.*,b.*,a.aid,a.channel,a.joinaid,a.title,a.litpic,a.province_id,a.city_id')
                        ->alias('a')
                        ->where(['a.is_del' => 0, 'a.arcrank' => 0, 'a.status' => 1])
                        ->join('ershou_content b', 'a.aid = b.aid', 'LEFT')
                        ->join('ershou_system d', 'a.aid = d.aid', 'LEFT')
                        ->find($aid);
                    $row['ejucms_photo'] = Db::name('ershou_photo')->where(['aid' => $aid, 'is_del' => 0])->select();
                    $relatedRow          = $this->getRecomList($row['channel'], $row['joinaid'], $aid);
                } elseif ($channel == 13) {
                    $row                 = Db::name('archives')->field('d.*,b.*,a.aid,a.channel,a.joinaid,a.title,a.litpic,a.province_id,a.city_id')
                        ->alias('a')
                        ->where(['a.is_del' => 0, 'a.arcrank' => 0, 'a.status' => 1])
                        ->join('zufang_content b', 'a.aid = b.aid', 'LEFT')
                        ->join('zufang_system d', 'a.aid = d.aid', 'LEFT')
                        ->find($aid);
                    $row['ejucms_photo'] = Db::name('zufang_photo')->where(['aid' => $aid, 'is_del' => 0])->select();
                    $relatedRow          = $this->getRecomList($row['channel'], $row['joinaid'], $aid);
                } elseif ($channel == 1) {
                    $row = Db::name('archives')->field('b.*,a.aid,a.channel,a.author,a.title,a.litpic,a.click')
                        ->alias('a')
                        ->where(['a.is_del' => 0, 'a.arcrank' => 0, 'a.status' => 1])
                        ->join('article_content b', 'a.aid = b.aid', 'LEFT')
                        ->find($aid);
                }

                /*--end*/
                //拼单位
                $row = $this->getAllDfvalueUnit($channel, $row);
                //所属小区
                if (($row['channel'] == 12 || $row['channel'] == 13) && !empty($row['joinaid'])) {
                    $row['ejucms_xiaoqu_info'] = Db::name('archives')
                        ->alias('a')
                        ->field('a.aid,a.title,b.*,c.*')
                        ->where(['a.is_del' => 0, 'a.arcrank' => 0, 'a.status' => 1, 'a.aid' => $row['joinaid']])
                        ->join('xiaoqu_system c', 'a.aid = c.aid')
                        ->join('xiaoqu_content b', 'a.aid = b.aid')
                        ->find();
                    //小区信息
                    $row['ejucms_xiaoqu_info'] = $this->getAllDfvalueUnit(11, $row['ejucms_xiaoqu_info']);
                }
                if (!empty($row['supporting'])) {
                    $row['supporting'] = explode(',', $row['supporting']);
                    $arr =[];
                    foreach ($row['supporting'] as $key =>$val){
                        $arr[$key]['name'] = $val;
                        $arr[$key]['pinyin'] = get_pinyin($val);
                    }
                    $row['supporting'] = $arr;
                }
                if (!empty($row['characteristic'])) {
                    $row['characteristic'] = explode(',', $row['characteristic']);
                }
                if (!empty($row['ejucms_photo'])) {
                    foreach ($row['ejucms_photo'] as $key => $val) {
                        $row['ejucms_photo'][$key]['photo_pic'] = get_default_pic($val['photo_pic'], true);
                    }
                }
                if (!empty($row['ejucms_huxing'])) {
                    foreach ($row['ejucms_huxing'] as $key => $val) {
                        $row['ejucms_huxing'][$key]['huxing_pic'] = get_default_pic($val['huxing_pic'], true);
                    }
                    $group_huxing = Db::name('xinfang_huxing')->field('huxing_room')->where(aid, $aid)->group('huxing_room')->select();
                    if ($group_huxing) {
                        $row['ejucms_huxing_num'] = '';
                        foreach ($group_huxing as $key => $val) {
                            if ($key == 0) {
                                $row['ejucms_huxing_num'] .= $val['huxing_room'];
                            } else {
                                $row['ejucms_huxing_num'] .= '/' . $val['huxing_room'];
                            }
                        }
                    }
                }
                //经纪人
                if (!empty($row['saleman_id'])) {
                    $row['ejucms_saleman'] = Db::name('saleman')->field('id,saleman_name,saleman_mobile,saleman_pic')->where('id', $row['saleman_id'])->find();
                    if (!empty($row['ejucms_saleman']['saleman_pic'])) {
                        $row['ejucms_saleman']['saleman_pic'] = get_default_pic($row['ejucms_saleman']['saleman_pic'], true);
                    }
                }
                //开盘时间
                if (!empty($row['opening_time'])) {
                    $row['opening_time'] = date('Y-m-d', $row['opening_time']);
                }
                //交房时间
                if (!empty($row['complate_time'])) {
                    $row['complate_time'] = date('Y-m-d', $row['complate_time']);
                }
                $row['litpic']      = get_default_pic($row['litpic'], true);
                $row['add_time']    = date('Y-m-d', $row['add_time']); // 格式化发布时间
                $row['update_time'] = date('Y-m-d', $row['update_time']); // 格式化更新时间
                $row['content']     = $this->get_httpimgurl($row['content']); // 转换内容图片为http路径
            }
//            dump($row);
//            dump($relatedRow);
            $result = array(
                'conf'       => array(
                    'status'       => 1,
                    'msg'          => 'success',
                    'attrTitle'    => '参数列表',
                    'contentTitle' => '详情介绍',
                    'shareTitle'   => $row['title'] . '_' . tpCache('web.web_name'),
                ),
                'row'        => $row,
                'relatedRow' => $relatedRow,
            );
            cache($cacheKey, $result, null, 'minipro');
        }

        return $result;
    }

    public function getRecomList($channel = '', $joinaid = '', $aid = '')
    {
        $map              = [];
        $map['a.is_del']  = 0;
        $map['a.arcrank'] = 0;
        $map['a.status']  = 1;
        if ($channel == 9 || $channel == 11) {
            $map['a.channel'] = 9;
            $list['recom']    = Db::name('archives')
                ->alias('a')
                ->field('a.aid,a.title,a.litpic,a.city_id,min(b.huxing_area) as min_huxing,max(b.huxing_area) as max_huxing,c.average_price')
                ->where($map)
                ->where('a.is_recom', 1)
                ->join('xinfang_huxing b', 'a.aid = b.aid')
                ->join('xinfang_system c', 'a.aid = c.aid')
                ->group('b.aid')
                ->limit(0, 10)
                ->select();

            if (!empty($list['recom'])) {
                $list['recom'] = $this->getAllDfvalueUnit($channel, $list['recom'], true);
                $aids          = [];
                foreach ($list['recom'] as $key => $val) {
                    $aids[]                           = $val['aid'];
                    $list['recom'][$key]['litpic']    = get_default_pic($val['litpic'], true);
                    $list['recom'][$key]['city_name'] = get_city_name($val['city_id']);
                }
            }
        }
        if ($channel == 11) {
            $map['a.channel'] = 12;
            $map['a.joinaid'] = $joinaid;
            $list['ershou']   = Db::name('archives')
                ->alias('a')
                ->field('a.aid,a.title,a.litpic,a.city_id,b.total_price,b.room,b.living_room,b.toilet')
                ->where($map)
                ->join('ershou_system b', 'a.aid = b.aid')
                ->limit(0, 10)
                ->select();
            $map['a.channel'] = 13;
            $list['zufang']   = Db::name('archives')
                ->alias('a')
                ->field('a.aid,a.title,a.litpic,a.city_id,b.total_price,b.room,b.living_room,b.toilet,b.price_units')
                ->where($map)
                ->join('zufang_system b', 'a.aid = b.aid')
                ->limit(0, 10)
                ->select();
            if (!empty($list['ershou'])) {
                $list['ershou'] = $this->getAllDfvalueUnit(12, $list['ershou'], true);
                foreach ($list['ershou'] as $key => $val) {
                    $list['ershou'][$key]['litpic'] = get_default_pic($val['litpic'], true);
                }
            }
            if (!empty($list['zufang'])) {
                $list['zufang'] = $this->getAllDfvalueUnit(13, $list['zufang'], true);
                foreach ($list['zufang'] as $key => $val) {
                    $list['zufang'][$key]['litpic'] = get_default_pic($val['litpic'], true);
                }
            }
        }
        if ($channel == 12 || $channel == 13) {
            $map['a.channel'] = $channel;
            $map['a.joinaid'] = $joinaid;
            $map['a.aid']     = ['NEQ', $aid];
            if ($channel == 12) {
                $name = 'ershou';
            } elseif ($channel == 13) {
                $name = 'zufang';
            }
            $list['recom'] = Db::name('archives')
                ->alias('a')
                ->field('a.aid,a.title,a.litpic,a.city_id,c.*')
                ->where($map)
                ->join($name . '_system c', 'a.aid = c.aid')
                ->limit(0, 10)
                ->select();
            if (!empty($list['recom'])) {
                $list['recom'] = $this->getAllDfvalueUnit($channel, $list['recom'], true);

                $aids = [];
                foreach ($list['recom'] as $key => $val) {
                    $aids[]                           = $val['aid'];
                    $list['recom'][$key]['litpic']    = get_default_pic($val['litpic'], true);
                    $list['recom'][$key]['city_name'] = get_city_name($val['city_id']);
                }
            }
        }

        return $list;
    }

    public function getAllDfvalueUnit($channel = '', $data = [], $arr = false)
    {
        $channelfield = Db::name('channelfield')
            ->field('name,title,dfvalue_unit')
            ->where(['channel_id' => $channel, 'status' => 1])
            ->where('dfvalue_unit', 'NEQ', '')
            ->getAllWithIndex('name');
        //拼单位
        if ($arr) {
            foreach ($data as $k => $v) {
                foreach ($channelfield as $key => $val) {
                    if (!empty($data[$k][$key])) {
                        if ($channel == 13 && $key == 'total_price') {
                            continue;
                        } else {
                            $data[$k][$key] = $data[$k][$key] . $val['dfvalue_unit'];
                        }
                    }
                }
            }
        } else {
            foreach ($channelfield as $key => $val) {
                if (!empty($data[$key])) {
                    if ($channel == 13 && $key == 'total_price') {
                        continue;
                    } else {
                        $data[$key] = $data[$key] . $val['dfvalue_unit'];
                    }
                }
            }
        }

        return $data;
    }

    /**
     * 获取地区
     */
    public function getRegion($channel = '')
    {
        /*根据频道查询允许发布文档列表的栏目*/
        $type_list = Db::name('arctype')
            ->field('id,typename as name,current_channel,is_hidden')
            ->where(['is_del' => 0,  'status' => 1, 'current_channel' => $channel, 'grade' => 1])
            ->select();
        foreach ($type_list as $key => $v) {
            $type_list[$key]['childModel'] = Db::name('arctype')
                ->field('id,typename as name,current_channel')
                ->where(['is_del' => 0, 'is_hidden' => 0, 'status' => 1, 'parent_id' => $v['id'], 'grade' => 2])
                ->select();
            if (empty( $type_list[$key]['childModel']) &&$v['is_hidden'] == 1){
                unset($type_list[$key]);
            }
        }
        $arr = [];
        $type_list = array_merge($type_list,$arr);

        $channel = intval($channel);
        $filter  = Db::name('channelfield')
            ->field('id,name,title,dfvalue')
            ->where(['channel_id' => $channel, 'is_screening' => 1])
            ->where('dtype', 'IN', ['checkbox', 'radio', 'select'])
            ->order('dtype desc,sort_order desc')
            ->select();
        foreach ($filter as $key => $val) {
            if (!empty($val['dfvalue'])) {
                $dfvalue                 = explode(',', $val['dfvalue']);
                $filter[$key]['dfvalue'] = [];
                foreach ($dfvalue as $k => $v) {
                    $filter[$key]['dfvalue'][] = ['id' => $k + 1, 'title' => $v, 'symb' => $val['name']];
                }
            }
        }
//        dump($filter);
        //省份
        $list = get_province_list();
        foreach ($list as $key => $v) {
            $list[$key]['childModel'] = get_next_region_list($v['id']);
        }
        $result = array(
            'conf'      => array(
                'status' => 1,
                'msg'    => 'success',
            ),
            'row'       => $list,
            'filter'    => $filter,
            'type_list' => $type_list
        );

        return $result;
    }

    public function getPhone($param)
    {
        //查重
        $count = Db::name('minipro_info')
            ->where([
                'channel'=>$param['channel'],
                'type'=>$param['type'],
                'aid'=>$param['aid']])
            ->count();
        $param['update_time'] = getTime();
        if ($count){
            $data = Db::name('minipro_info')->where([
                'channel'=>$param['channel'],
                'type'=>$param['type'],
                'aid'=>$param['aid']])
                ->update([
                    'ip'=>$param['ip'],
                    'update_time'=>$param['update_time']
                ]);
        }else{
            $param['add_time'] = getTime();
            $data = Db::name('minipro_info')->insert($param);
        }
        if($data){
            $result = array(
                'conf'      => array(
                    'status' => 1,
                    'msg'    => '已提交',
                )
            );
            return $result;
        }
    }

}