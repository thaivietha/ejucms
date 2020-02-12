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

namespace app\home\controller;

use think\Db;

class View extends Base
{
    // 模型标识
    public $nid = '';
    // 模型ID
    public $channel = '';
    // 模型名称
    public $modelName = '';

    public function _initialize() {
        parent::_initialize();
    }

    /**
     * 内容页
     */
    public function index($aid = '')
    {
        if (!is_numeric($aid) || strval(intval($aid)) !== strval($aid)) {
            abort(404,'页面不存在');
        }
        $seo_pseudo = config('ey_config.seo_pseudo');
        $url_screen_var = config('global.url_screen_var');
        /*URL上参数的校验*/
        if (!isset($this->eju['param'][$url_screen_var]) && (3 == $seo_pseudo || (2 == $seo_pseudo && isMobile())))
        {
            if (stristr($this->request->url(), '&c=View&a=index&')) {
                abort(404,'页面不存在');
            }
        }
        else if (1 == $seo_pseudo || (2 == $seo_pseudo && isMobile()))
        {
            $seo_dynamic_format = config('ey_config.seo_dynamic_format');
            if (1 == $seo_pseudo && 2 == $seo_dynamic_format && stristr($this->request->url(), '&c=View&a=index&')) {
                abort(404,'页面不存在');
            }
        }
        /*--end*/
        $aid = intval($aid);
        $where = [
            'a.aid'     => $aid,
            'a.is_del'      => 0,
        ];
        $archivesInfo = M('archives')->field('a.typeid, a.channel,a.status,a.users_id, b.nid, b.ctl_name,a.aid as aid,a.province_id as province_id,a.city_id as city_id,a.area_id as area_id')
            ->alias('a')
            ->join('__CHANNELTYPE__ b', 'a.channel = b.id', 'LEFT')
            ->where($where)
            ->find();
        $users_id = session('users_id');
        if (empty($archivesInfo) || ($archivesInfo['status'] == 0 && (empty($users_id) || $users_id != $archivesInfo['users_id']))) {
            abort(404,'页面不存在');
        }
        //判断多域名下区域和域名是否匹配
        $web_region_domain = config('ey_config.web_region_domain');   //是否开启子域名
        $web_mobile_domain = config('ey_config.web_mobile_domain');    //手机子域名
        if ($web_region_domain && !empty($this->eju['param']['subDomain']) && $this->eju['param']['subDomain'] != $web_mobile_domain){
            $region_list = get_region_list();
            $subDomain = "www";
            if (!empty($archivesInfo['area_id']) && !empty($region_list[$archivesInfo['area_id']]['domain'])){
                $subDomain = $region_list[$archivesInfo['area_id']]['domain'];
            }else if(!empty($archivesInfo['city_id']) && !empty($region_list[$archivesInfo['city_id']]['domain'])){
                $subDomain = $region_list[$archivesInfo['city_id']]['domain'];
            }else if(!empty($archivesInfo['province_id']) && !empty($region_list[$archivesInfo['province_id']]['domain'])){
                $subDomain = $region_list[$archivesInfo['province_id']]['domain'];
            }
            if (!empty($subDomain) && $subDomain != $this->eju['param']['subDomain']){
                abort(404,'页面不存在');
            }
        }
        $this->nid = $archivesInfo['nid'];
        $this->channel = $archivesInfo['channel'];
        $this->modelName = $archivesInfo['ctl_name'];

        $result = model($this->modelName)->getInfo($aid);

        if ($result['arcrank'] == -1) {
            $this->success('待审核稿件，你没有权限阅读！');
        }

        // 外部链接跳转
        if ($result['is_jump'] == 1) {
            header('Location: '.$result['jumplinks']);
            exit;
        }
        /*--end*/

        $tid = $result['typeid'];
        $arctypeInfo = model('Arctype')->getInfo($tid);
        /*自定义字段的数据格式处理*/
        $arctypeInfo = $this->fieldLogic->getTableFieldList($arctypeInfo, config('global.arctype_channel_id'));
        /*--end*/
        if (!empty($arctypeInfo)) {

            /*URL上参数的校验*/
            if (3 == $seo_pseudo) {
                $dirname = input('param.dirname/s');
                $dirname2 = '';
                $seo_rewrite_format = config('ey_config.seo_rewrite_format');
                if (1 == $seo_rewrite_format) {
                    $toptypeRow = model('Arctype')->getAllPid($tid);
                    $toptypeinfo = current($toptypeRow);
                    $dirname2 = $toptypeinfo['dirname'];
                } else if (2 == $seo_rewrite_format) {
                    $dirname2 = $arctypeInfo['dirname'];
                }
                if ($dirname != $dirname2) {
                    abort(404,'页面不存在');
                }
            }
            /*--end*/

            // 是否有子栏目，用于标记【全部】选中状态
            $arctypeInfo['has_children'] = model('Arctype')->hasChildren($tid);
            // 文档模板文件，不指定文档模板，默认以栏目设置的为主
            empty($result['tempview']) && $result['tempview'] = $arctypeInfo['tempview'];
            
            /*给没有type前缀的字段新增一个带前缀的字段，并赋予相同的值*/
            foreach ($arctypeInfo as $key => $val) {
                if (!preg_match('/^type/i',$key)) {
                    $key_new = 'type'.$key;
                    !array_key_exists($key_new, $arctypeInfo) && $arctypeInfo[$key_new] = $val;
                }
            }
            /*--end*/
        } else {
            abort(404,'页面不存在');
        }
        $result = array_merge($arctypeInfo, $result);

        // 文档链接
        $result['arcurl'] = $result['pageurl'] = '';
        if ($result['is_jump'] != 1) {
            $result['arcurl'] = $result['pageurl'] = arcurl('home/View/index', $result, true, true);
        }
        /*--end*/

        // seo
        $result['seo_title'] = set_arcseotitle($result['title'], $result['seo_title'], $result['typename']);
        $result['seo_keywords'] = set_str_replace($result['seo_keywords'], $result['title']);
        $result['seo_description'] = set_str_replace(checkStrHtml($result['seo_description']), $result['title']);
        $result['seo_description'] = @msubstr($result['seo_description'], 0, config('global.arc_seo_description_length'), false);

        /*支持子目录*/
        $result['litpic'] = handle_subdir_pic($result['litpic']);
        /*--end*/
        if ($this->modelName == 'Xinfang'){
            $result['xinfang'] = $result;
        }
		$tag = [
			'huxing' => 'on',
			'photo'	 => 'on',
			'price'	 => 'on',
		];
        $result = view_logic($aid, $this->channel, $result, true, $tag,$this->modelName); // 模型对应逻辑

        /*自定义字段的数据格式处理*/
        $result = $this->fieldLogic->getChannelFieldList($result, $this->channel);
        /*--end*/
        $eju = array(
            'type'  => $arctypeInfo,
            'field' => $result,
        );
        $this->eju['param']['url_screen_var'] = $url_screen_var;
        $this->eju['param']['root_dir'] = ROOT_DIR;
        $this->eju = array_merge($this->eju, $eju);

        $this->assign('eju', $this->eju);

        /*模板文件*/
        $viewfile = !empty($result['tempview'])
        ? str_replace('.'.$this->view_suffix, '',$result['tempview'])
        : 'view_'.$this->nid;
        /*--end*/
        //子栏目模板文件
        $column = input('param.column/s');
        if (!empty($column)){
            $viewfile .= "_column_".$column;
        }
        //子栏目详情模板文件
        $sid  = input('param.sid/d');
        if (!empty($sid)){
            $viewfile .= "_index";
        }

        return $this->fetch(":{$viewfile}");
    }
}