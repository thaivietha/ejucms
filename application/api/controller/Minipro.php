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

namespace app\api\controller;

use think\Db;

class Minipro extends Base
{
    // 小程序插件标识
    public $nid = '';
    // 模型对象
    public $modelObj = '';

    /**
     * 构造方法
     */
    public function __construct()
    {
        parent::__construct();
        $this->modelObj = model('Minipro');
    }

    /**
     * 全局常量API
     */
    public function globals()
    {
        $data = $this->modelObj->getGlobalsConf();

        exit(json_encode($data));
    }

    /**
     * 首页API
     */
    public function index()
    {
        /*配置值*/
        $indexConfig = $this->modelObj->getHomeConf();
        /*--end*/
        //默认城市
        $location = Db::name('region')->field('id,name')->where(['is_default'=>1,'status'=>1])->find();
        /*幻灯片*/
        $aid         = !empty($indexConfig['swipers']['aid']) ? $indexConfig['swipers']['aid'] : '';
        $swipersList = $this->modelObj->getSwipersList($aid);
        $swipersData = array(
            'list' => $swipersList,
        );
        /*--end*/

        /*栏目列表*/
        $whereCate                    = [];
        $whereCate['a.is_del']          = 0;
        $whereCate['a.is_hidden']       = 0;
        $whereCate['a.current_channel'] = array(['>',0],['in',"1,9,12,13"]);
        /*栏目列表*/
        $cateData = Db::name('arctype')
            ->alias('a')
            ->field('a.current_channel,b.nid,ntitle')
            ->join('channeltype b','a.current_channel = b.id','left')
            ->where($whereCate)
            ->group('a.current_channel')
            ->order('b.sort_order asc')
//            ->fetchSql(true)
            ->select();
        /*--end*/

        /*频道start*/
        $channelList = $indexConfig['article']['channel_id'];
        foreach ($channelList as $key) {
            $title  = Db::name('channeltype')->where('id', $key)->value('ntitle');
            $channelData[] = ['id'    => $key,
                              'title' => $title
            ];
        }
        /*频道end*/

        $globalData = $this->modelObj->getGlobalsConf();

        $data = array(
            'swipersData'   => $swipersData,
            'cateData'      => $cateData,
            'miniproConfig' => $indexConfig,
            'globalData'    => $globalData,
            'location'=>$location,
            'channelData'   => $channelData,

        );
        exit(json_encode($data));
    }

    /**
     * 全部栏目
     */
    public function arctype($channel = '')
    {

        /*栏目列表*/
        $data = $this->modelObj->getArctype($channel);
        /*--end*/

        exit(json_encode($data));
    }

    public function region($channel = '')
    {
        $data = $this->modelObj->getRegion($channel);
        exit(json_encode($data));
    }


    /**
     * 文档列表
     * sym=1 首页标志 其他页面调取无需传值
     * param 筛选条件
     */
    public function lists($typeid = '', $page = 1, $keyword = '', $channel = '', $sym = '', $param = [], $order = '')
    {

        $param = htmlspecialchars_decode($param);
        parse_str($param, $paramArr);
        $param=[];
        foreach ($paramArr as $k => $v){
            $k = str_replace("amp;","",$k);
            $param[$k] = $v;
        }
        /*文档列表*/
        $map = array(
            'typeid'  => $typeid,
            'keyword' => $keyword,
            'channel' => $channel,
            'param'   => $param,
            'order'   => $order
        );
        $map['sym'] = 0;
        $num = '';
        //首页取列表
        if (!empty($sym) && $sym == 1) {
            /*配置值*/
            $indexConfig = $this->modelObj->getHomeConf();
            /*--end*/
            //每页显示条数
            $num = !empty($indexConfig['article']['num']) ? $indexConfig['article']['num'] : '';
            $map['sym'] = 1;
        }

        $data = $this->modelObj->getArchivesListNew($map, $page, $num);
//        $data = $this->modelObj->getArchivesList($map, $page);
        /*--end*/
        exit(json_encode($data));
    }

    /**
     * 文档详情（新房,小区,二手,租房,团购）
     */
    public function view($aid)
    {
//        $data = $this->modelObj->getArchivesView($aid);
        $data = $this->modelObj->getArchivesViewNew($aid);

        exit(json_encode($data));
    }

    /**
     * 单页栏目
     */
    public function single($typeid)
    {
        $data = $this->modelObj->getSingleView($typeid);

        exit(json_encode($data));
    }

    public function city()
    {
        $where = [];
        $where['level'] = 2;
        $where['status'] = 1;
        $initial = Db::name('region')->field('id, name,initial')
            ->where($where)
            ->group('initial')
            ->order('initial asc')
            ->getAllWithIndex('initial');
        foreach ($initial as $k =>$v){
            $data['city'][$k] = Db::name('region')->field('id, name,initial')
                ->where($where)
                ->where('initial',$k)
                ->order('domain asc')
                ->select();
        }
        $where['is_hot'] = 1;
        $data['hot_city'] = Db::name('region')->field('id, name')
            ->where($where)
            ->select();
        exit(json_encode($data));
    }

    /**
     * 留言栏目
     */
    public function guestbook($typeid = '')
    {
        if (IS_POST) {
            $post = I('post.');
            $data = $this->modelObj->getGuestbookSubmit($post);
            exit(json_encode($data));
        } else {
            $data = $this->modelObj->getGuestbookForm($typeid);

            exit(json_encode($data));
        }

    }

    /**
     * 关于我们
     */
    public function about()
    {
        $data = $this->modelObj->getAbout();

        exit(json_encode($data));
    }

    /**
     * 获取用户手机
     */
    public function phone()
    {
        if (IS_POST) {
            $post = input('post.');
            $data = $this->modelObj->getPhone($post);
            exit(json_encode($data));
        }
    }

    /**
     * 小程序登录获取用户信息
     */
    public function getInfo()
    {
        if (IS_POST) {
            $post = input('post.');
            require VENDOR_PATH . 'wechatgetphone/wxBizDataCrypt.php';
            $appInfo = $this->modelObj->getValue('minipro');
            //通过code获得 access_token + openid
            $url          = "https://api.weixin.qq.com/sns/jscode2session?appid=" . $appInfo['appId']
                . "&secret=" . $appInfo['appSecret'] . "&js_code=" . $post['code'] . "&grant_type=authorization_code";
            $jsonResult   = file_get_contents($url);
            if (!empty($jsonResult)){
                $resultArray  = json_decode($jsonResult, true);
                $pc = new \WXBizDataCrypt($appInfo['appId'], $resultArray['session_key']);
                $errCode = $pc->decryptData($post['encryptedData'], $post['iv'], $data );
                if ($errCode == 0) {
                    exit($data);
                } else {
                    exit(json_encode($errCode));
                }
            }
//        $data = $this->modelObj->getPhone($post);
//        exit(json_encode($data));
        }
    }
}