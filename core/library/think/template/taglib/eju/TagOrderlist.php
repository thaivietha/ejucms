<?php
/**
 * Created by PhpStorm.
 * User: 28773
 * Date: 2019/8/2
 * Time: 10:21
 */

namespace think\template\taglib\eju;

use think\Db;

class TagOrderlist extends Base
{
    public $tid = '';
    public $channelfield_db = '';
    public $dirname = '';
    protected function _initialize()
    {
        parent::_initialize();
        $this->channelfield_db = Db::name('channelfield');
        $this->dirname = input('param.tid/s');
        $this->tid = input('param.tid/s', '');
        $this->tid = $this->getTrueTypeid($this->tid);
    }
    // URL中隐藏index.php入口文件，此方法仅此控制器使用到
    private function auto_hide_index($url = '')
    {
        if (empty($url)) return false;
        // 是否开启去除index.php文件
        $seo_inlet = null;
        $seo_inlet === null && $seo_inlet = config('ey_config.seo_inlet');
        if (1 == $seo_inlet) {
            $url = str_replace('/index.php', '/', $url);
        }
        return $url;
    }
    /*
     * $upstyle     向上，正序
     * $downstyle   向下，倒序
     */
    public function getOrderList($currentstyle='',$upstyle='',$downstyle='', $addfields='', $addfieldids='', $alltxt_o='',$typeid = 0){
        if (empty($this->tid) && empty($typeid)){
            return false;
        }else if (empty($this->tid) && !empty($typeid)){
            $this->tid = $typeid;
        }
        $param = input('param.');
        // 定义筛选标识
        $url_screen_var = config('global.url_screen_var');
        // 隐藏域参数处理
        $hidden  = '';
        // 是否在伪静态下搜索
        $seo_pseudo = config('ey_config.seo_pseudo');
        // 查询数据条件
        $where = [
//            'a.is_order' => 1,
            'a.ifeditable'   => 1,
            'b.id'=>$this->tid,
//            'b.type'   => 2,
//            'b.typeid'       => $this->tid,


            // 根据需求新增条件
        ];

        // 是否指定参数读取
        if (!empty($addfields)) {
            $where['a.name'] = array('IN',$addfields);
        }else if (!empty($addfieldids)){
            $where['a.id'] = array('IN',$addfieldids);
        }

        // 数据查询
        $row = $this->channelfield_db
            ->field('a.id,a.title,a.name,a.dfvalue,a.dtype,a.define')
            ->alias('a')
            ->join('__ARCTYPE__ b','b.current_channel= a.channel_id', 'LEFT')
//            ->join('__CHANNELFIELD_BIND__ b', 'b.field_id = a.id', 'LEFT')
            ->where($where)
            ->order("a.sort_order asc")
            ->select();
        // Onclick点击事件方法名称加密，防止冲突
        $OnclickOrderlist  = 'ey_'.md5('OnclickOrderlist');
        // Onchange改变事件方法名称加密，防止冲突
        $OnchangeOrderlist = 'ey_'.md5('OnchangeOrderlist');
        // 在伪静态下拼装控制器方式参数名
        $seo_pseudo  = config('ey_config.seo_pseudo');
        if (!isset($param[$url_screen_var]) && 3 == $seo_pseudo) {
            $param_query = [];
            $param_query['m'] = 'home';
            $param_query['c'] = 'Lists';
            $param_query['a'] = 'index';
            $param_query['tid'] = $this->tid;
            $param_new = request()->param();
            unset($param_new['tid']);
            unset($param_new['s']);
            $param_query = array_merge($param_query, $param_new);
        } else {
            $param_query = request()->param();
        }
        /* 生成静态页面代码 */
        if (2 == $seo_pseudo && !isMobile()) {
            $param_query['m'] = 'home';
            $param_query['c'] = 'Lists';
            $param_query['a'] = 'index';
            unset($param_query['_ajax']);
        }
        // 数据处理输出
        $alltxt = $alltxt_o;
        if (!empty($alltxt_o)) {
            // 等于OFF表示关闭，不需要此项
            if ('off' == $alltxt_o) {
                $alltxt = '';
            }
        }else{
            $alltxt = '默认排序';
        }
        $all[0] = [
            'name'   => '',
            'title' => $alltxt,
        ];
        $row = array_merge($all,$row);
        foreach ($row as $key => $value) {
            // 封装onClick事件
            $row[$key]['onClick']  = " onClick='{$OnclickOrderlist}(this);' ";
            // 封装onchange事件
            $row[$key]['onChange'] = " onChange='{$OnchangeOrderlist}(this);' ";
            /* end */

            $row[$key]['classstyle'] = "";
            $row[$key]['SelectValue'] = "";
            $row[$key]['currentstyle'] = "";
            // 参数拼装URL
            if (!empty($value['name'])) {
                $row[$key]['classstyle'] = $upstyle;
                $param_query["orderby"] = $value['name'];
                $param_query["orderway"] = !empty($param["orderway"]) && $param["orderway"] == 'asc' ? "desc" : "asc" ;
                if (!empty($param["orderby"]) && $param["orderby"] == $value['name']){
                    $row[$key]['SelectValue'] = "selected";
                    $row[$key]['currentstyle'] = $currentstyle;
                    if (!empty($param["orderway"]) && $param["orderway"] == 'desc'){
                        $row[$key]['classstyle'] = $downstyle;
                    }
                }
            }else{      //选择不限，去掉该字段已选项
                unset($param_query["orderby"]);
                unset($param_query["orderway"]);
                if (empty($param["orderby"])){
                    $row[$key]['SelectValue'] = "selected";
                    $row[$key]['currentstyle'] = $currentstyle;
                }
            }
            $param_query[$url_screen_var] = 1;
//            $url = ROOT_DIR.'/index.php?'.http_build_query($param_query);
//            $url = urldecode($url);
//            $this->auto_hide_index($url);
            $domain = 0;
//            if (!empty($vv['level']) && !empty($opencity_arr) && in_array($vv['level'],$opencity_arr)){
//                $domain = 1;
//            }
            $url = $this->makeUrl($param_query,$domain);
            $row[$key]['onClick'] .= " data-url='{$url}' ";
            $row[$key]['onChange']  .= " data-url='{$url}' ";
        }

        $resetUrl = ROOT_DIR.'/index.php?m=home&c=Lists&a=index&tid='.$this->tid;

        $hidden .= <<<EOF
<script type="text/javascript">
    function {$OnclickOrderlist}(obj) {
        var dataurl = obj.getAttribute('data-url') ; //obj.attributes['data-url'].value;
        if (dataurl) {
            window.location.href = dataurl;
        }else{
            console.log('内部错误，data-url 没有赋值！');
        }
    }

    function {$OnchangeOrderlist}(obj) {
        var index = obj.selectedIndex
        var dataurl = obj.options[index].attributes['data-url'].value;
        if (dataurl) {
            window.location.href = dataurl;
        }else{
            console.log('内部错误，data-url 没有赋值！');
        }
    }
</script>
EOF;
        $result = array(
            'hidden'    => $hidden,
            'resetUrl' => $resetUrl,
            'list'       => $row,
        );
        return $result;
    }
    /*
     * 根据传值,生成url
     * $domain  是否开启
     */
    private function makeUrl($param_query,$domain){
        $web_region_domain = tpCache('web.web_region_domain');
        if ($web_region_domain && $domain == '1' && $param_query['domain'] != ""){
            $first_url = '//'.$param_query['domain'].'.'.request()->rootDomain().ROOT_DIR.'/index.php?';
        }else{
            $first_url = ROOT_DIR.'/index.php?';
        }
        unset($param_query['domain']);
        $param_url = http_build_query($param_query);
        $url = $first_url.$param_url;
        $url = urldecode($url);
        return $this->auto_hide_index($url);
    }

}