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

namespace app\admin\controller;

use think\Db;
use think\Page;
use app\admin\logic\MiniproLogic;
use app\admin\model\Minipro as MiniproModel;

class Minipro extends Base
{
    /**
     * 模板nid，每套模板唯一
     */
    private $nid = 'Minipro0001';

    public function _initialize()
    {
        parent::_initialize();
        $this->logic = new MiniproLogic();
        $this->model = new MiniproModel();
    }

    public function lists()
    {
        $count = Db::name('minipro_info')->where('status',1)->count();// 查询满足要求的总记录数
        $Page = new Page($count, config('paginate.list_rows'));// 实例化分页类 传入总记录数和每页显示的记录数
        $list = Db::name('minipro_info')
            ->where('status',1)
            ->order('update_time desc')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();
        $channel = Db::name('channeltype')->field('id,ntitle')->where('is_del',0)->getAllWithIndex('id');
         foreach ($list as $key => $val) {
             //url
             $list[$key]['arcurl'] = get_arcurl($val['aid']).'&aid='.$val['aid'];
             $list[$key]['channel_name'] = $channel[$val['channel']]['ntitle'];
             if ($val['type'] == 1){
                 $list[$key]['type_name'] = '开盘通知';
             }elseif ($val['type'] == 2){
                 $list[$key]['type_name'] = '降价通知';
             }
        }
        $pageStr = $Page->show();// 分页显示输出
        $this->assign('page',$pageStr);// 赋值分页输出
        $this->assign('list',$list);// 赋值数据集
        $this->assign('pager',$Page);// 赋值分页对象

        return $this->fetch();
    }

    /**
     * index
     */
    public function index()
    {
        $this->redirect('Minipro/home_conf');
        exit;
    }

    /**
     * 全局配置
     */
    public function global_conf()
    {
        if (IS_POST) {
            $post = input('post.');
            $data = array();
            foreach ($post as $key => $val) {
                if (1 == preg_match('/(_is_remote|_remote|_local)$/', $key)) { // 处理上传本地与远程图片的字段转化
                    if (1 == preg_match('/(_local)$/', $key)) {
                        $tmpkey        = preg_replace('/^(.*)(_local)$/', '$1', $key);
                        $val           = $post[$tmpkey . '_local'];
                        $data[$tmpkey] = $val;
                        unset($post[$tmpkey . '_local']);
                    }
                } else if (1 == preg_match('/(_path_key)$/', $key)) { // 菜单链接转为小程序路径
                    $mn                  = preg_replace('/^(.*)(_path_key)$/', '$1', $key);
                    $data[$mn . '_path'] = $this->logic->get_pages_path($val, $post[$mn . '_typeid']);
                    $data[$key]          = $val;
                } else {
                    $data[$key] = $val;
                }
            }

            /*保存数据*/
            $newData = array(
                'type'  => $this->model->globalType,
                'value' => json_encode($data),
            );
            $row     = $this->model->getRow($this->model->globalType);
            if (empty($row)) { // 新增
                $newData['add_time'] = getTime();
                $r                   = $this->model->insert($newData);
            } else {
                $newData['update_time'] = getTime();
                $r                      = $this->model->where('type', 'eq', $this->model->globalType)->update($newData);
            }
            if (false !== $r) {
                \think\Cache::clear('minipro');
                $this->success('操作成功', url('Minipro/global_conf'));
            }
            /*--end*/
            $this->error('操作失败');
        }

        $assign_data = array();

        $webConfig          = tpCache('web');
        $assign_data['web'] = $webConfig; // 网站基本信息

        $row = $this->model->getValue($this->model->globalType);

        if (empty($row)) {
            $m1_path_key = 1;
            $m2_path_key = 2;
            $m3_path_key = 7;
            $m4_path_key = 6;
            $row         = array(
                'sel_color'        => '#227ff4',
                'menu_color'       => '#afb4b2',
                'front_color'      => '#ffffff', // 只能黑#000000和白#ffffff
                'nav_title'        => $webConfig['web_name'],
                'copyright'        => $webConfig['web_copyright'],
                'm1_name'          => '首页',
                'm1_show'          => 1,
                'm1_path_key'      => $m1_path_key,
                'm1_img_is_remote' => 0,
                'm1_img_local'     => $this->getImgRealpath('index.png', false),
                'm1_selimg_local'  => $this->getImgRealpath('index_selected.png', false),
                'm2_name'          => '导航',
                'm2_show'          => 1,
                'm2_path_key'      => $m2_path_key,
                'm2_img_is_remote' => 0,
                'm2_img_local'     => $this->getImgRealpath('product.png', false),
                'm2_selimg_local'  => $this->getImgRealpath('product_selected.png', false),
                'm3_name'          => '联系',
                'm3_show'          => 1,
                'm3_path_key'      => $m3_path_key,
                'm3_img_is_remote' => 0,
                'm3_img_local'     => $this->getImgRealpath('contact.png', false),
                'm3_selimg_local'  => $this->getImgRealpath('contact_selected.png', false),
                'm4_name'          => '留言',
                'm4_show'          => 1,
                'm4_path_key'      => $m4_path_key,
                'm4_img_is_remote' => 0,
                'm4_img_local'     => $this->getImgRealpath('guestbook.png', false),
                'm4_selimg_local'  => $this->getImgRealpath('guestbook_selected.png', false),
            );
        } else {
            foreach ($row as $key => $val) {
                /*转换图片为本地与远程*/
                if (1 == preg_match('/(_img|_selimg)$/', $key)) {
                    if (is_http_url($val)) {
                        $row[$key . '_is_remote'] = 1;
                        $row[$key . '_remote']    = $val;
                    } else {
                        $row[$key . '_is_remote'] = 0;
                        $row[$key . '_local']     = $val;
                    }
                }
                /*--end*/
            }
        }
        $assign_data['row']        = $row;
        $assign_data['pages_list'] = $this->logic->pages_list(); // 小程序页面路径链接

        $this->assign($assign_data);
        return $this->fetch();
    }

    /**
     * 首页参数
     */
    public function home_conf()
    {
        if (IS_POST) {
            $post = input('post.');
            unset($post['_ajax']);
            $data = array();
            foreach ($post as $key => $val) {
                if (is_array($val)) {
                    $data[$key] = array();
                    foreach ($val as $k2 => $v2) {
                        if (1 == preg_match('/(_local)$/', $k2)) { // 处理上传本地与远程图片的字段转化
                            if (1 == preg_match('/(_local)$/', $k2)) {
                                $tmpkey              = preg_replace('/^(.*)(_local)$/', '$1', $k2);
                                $v2                  = $post[$key][$tmpkey . '_local'];
                                $data[$key][$tmpkey] = $v2;
                                unset($post[$key][$tmpkey . '_local']);
                            }
                        } else if (1 == preg_match('/(_path_key)$/', $k2)) { // 栏目里诶包链接转为小程序路径
                            $mn                        = preg_replace('/^(.*)(_path_key)$/', '$1', $k2);
                            $data[$key][$mn . '_path'] = $this->logic->get_pages_path($v2, $post[$key][$mn . '_typeid']);
                            $data[$key][$k2]           = $v2;
                        } else {
                            $data[$key][$k2] = $v2;
                        }

                        /*栏目模块是否显示*/
                        if ('cate' == $key && 1 == preg_match('/^m(\d+)_show$/', $k2)) {
                            $mn = preg_replace('/^(.*)(_show)$/', '$1', $k2);
                            if (1 == $post[$key][$mn . '_show']) {
                                $data[$key]['show'] = 1;
                            }
                        } else if ('video' == $key) {
                            if (!isset($data[$key]['show_video'])) {
                                $data[$key]['show_video'] = false;
                            }
                        }
                        /*--end*/
                    }
                } else {
                    $data[$key] = $val;
                }
            }

            /*保存数据*/
            $newData = array(
                'type'  => $this->model->homeType,
                'value' => json_encode($data),
            );
            $row     = $this->model->getRow($this->model->homeType);
            if (empty($row)) { // 新增
                $newData['add_time'] = getTime();
                $r                   = $this->model->insert($newData);
            } else {
                $newData['update_time'] = getTime();
                $r                      = $this->model->where('type', 'eq', $this->model->homeType)->update($newData);
            }
            if (false !== $r) {
                \think\Cache::clear('minipro');
                $this->success('操作成功', url('Minipro/home_conf'));
            }
            /*--end*/
            $this->error('操作失败');
        }

        $assign_data = array();

        $row = $this->model->getValue($this->model->homeType);
        if (empty($row)) {
            $m1_path_key = 4;
            $m2_path_key = 3;
            $m3_path_key = 3;
            $m4_path_key = 7;
            $row         = array(
                'swipers' => array(
                    'aid'  => '',
                    'show' => 1,
                ),
                'cate'    => array(
                    'show'             => 1,
                    'm1_name'          => '公司简介',
                    'm1_show'          => 1,
                    'm1_path_key'      => $m1_path_key,
                    'm1_img_is_remote' => 0,
                    'm1_img_local'     => $this->getImgRealpath('about.png', false),
                    'm2_name'          => '案例展示',
                    'm2_show'          => 1,
                    'm2_path_key'      => $m2_path_key,
                    'm2_img_is_remote' => 0,
                    'm2_img_local'     => $this->getImgRealpath('images.png', false),
                    'm3_name'          => '新闻中心',
                    'm3_show'          => 1,
                    'm3_path_key'      => $m3_path_key,
                    'm3_img_is_remote' => 0,
                    'm3_img_local'     => $this->getImgRealpath('article.png', false),
                    'm4_name'          => '联系我们',
                    'm4_show'          => 1,
                    'm4_path_key'      => $m4_path_key,
                    'm4_img_is_remote' => 0,
                    'm4_img_local'     => $this->getImgRealpath('business.png', false),
                ),
                'notice'  => array(
                    'icon_img_is_remote' => 0,
                    'icon_img_local'     => $this->getImgRealpath('notice.png', false),
                    'show'               => 1,
                ),
                'video'   => array(
                    'title'           => '视频专区',
                    'src'             => '',
                    'v_img_is_remote' => 0,
                    'v_img_local'     => $this->getImgRealpath('video.jpg', false),
                    'show'            => 1,
                ),
                'images'  => array(
                    'title'         => '案例展示',
                    'typeid'        => '',
                    'num'           => 4,
                    'more_path_key' => 3,
                    'show'          => 1,
                ),
                'article' => array(
                    'title'         => '新闻中心',
                    'typeid'        => '',
                    'channel_id'        => [9],
                    'num'           => 5,
                    'more_path_key' => 3,
                    'show'          => 1,
                ),
            );
        } else {
            foreach ($row as $key => $val) {
                foreach ($val as $k2 => $v2) {
                    /*转换图片为本地与远程*/
                    if (1 == preg_match('/(_img)$/', $k2)) {
                        if (is_http_url($v2)) {
                            $row[$key][$k2 . '_is_remote'] = 1;
                            $row[$key][$k2 . '_remote']    = $v2;
                        } else {
                            $row[$key][$k2 . '_is_remote'] = 0;
                            $row[$key][$k2 . '_local']     = $v2;
                        }
                    }
                    /*--end*/
                }
            }
        }
        //频道
        $channel_list = Db::name('channeltype')
            ->field('id,ntitle')
            ->where(['status'=>1,'is_del'=>0])
            ->where('id','in',[9,12,13])
            ->select();
        foreach ($channel_list as $key=>$val){
            $list[$val['id']] = $channel_list[$key];
        }
        $this->assign('channel_list',$list);
        $assign_data['row']        = $row;
        $assign_data['pages_list'] = $this->logic->pages_list(); // 小程序页面路径链接
        $this->assign($assign_data);
//        dump($assign_data);
        return $this->fetch();
    }

    /**
     * 关于参数
     */
    public function about_conf()
    {
        if (IS_POST) {
            $post = input('post.');
            $data = array();
            foreach ($post as $key => $val) {
                if (1 == preg_match('/(_local)$/', $key)) { // 处理上传本地与远程图片的字段转化
                    if (1 == preg_match('/(_local)$/', $key)) {
                        $tmpkey        = preg_replace('/^(.*)(_local)$/', '$1', $key);
                        $data[$tmpkey] = $post[$tmpkey . '_local'];
                        unset($post[$tmpkey . '_local']);
                    }
                } else {
                    if ('coordinate' == $key) {
                        $coordinateArr     = explode(',', $val);
                        $data['latitude']  = !empty($coordinateArr[0]) ? $coordinateArr[0] : 0;
                        $data['longitude'] = !empty($coordinateArr[1]) ? $coordinateArr[1] : 0;
                    }
                    $data[$key] = $val;
                }
            }

            /*保存数据*/
            $newData = array(
                'type'  => $this->model->aboutType,
                'value' => json_encode($data),
            );
            $row     = $this->model->getRow($this->model->aboutType);
            if (empty($row)) { // 新增
                $newData['add_time'] = getTime();
                $r                   = $this->model->insert($newData);
            } else {
                $newData['update_time'] = getTime();
                $r                      = $this->model->where('type', 'eq', $this->model->aboutType)->update($newData);
            }
            if (false !== $r) {
                \think\Cache::clear('minipro');
                $this->success('操作成功', url('Minipro/about_conf'));
            }
            /*--end*/
            $this->error('操作失败');
        }

        $assign_data = array();

        $row = $this->model->getValue($this->model->aboutType);
        if (empty($row)) {
//            $miniproModel = new \app\plugins\model\Minipro0001;
            $row = array(
                'logo_is_remote'   => 0,
                'logo_local' => $this->getImgRealpath('logo.png', false),
                'banner_is_remote' => 0,
                'banner_local' => $this->getImgRealpath('banner.jpg', false),
            );
        } else {
            foreach ($row as $key => $val) {
                /*转换图片为本地与远程*/
                if (1 == preg_match('/(logo|banner)$/', $key)) {
                    if (is_http_url($val)) {
                        $row[$key . '_is_remote'] = 1;
                        $row[$key . '_remote']    = $val;
                    } else {
                        $row[$key . '_is_remote'] = 0;
                        $row[$key . '_local']     = $val;
                    }
                }
                /*--end*/
            }
        }
        $assign_data['row'] = $row;

        $this->assign($assign_data);

        return $this->fetch();
    }

    /**
     * 小程序配置
     */
    public function setting()
    {
        if (IS_POST) {
            $post = input('post.');
            if (empty($post['nid'])) {
                $this->error('小程序模板nid不存在');
            }
            $post['domain'] = trim($post['domain'], '/');
            $post['navTitle'] = !empty($post['navTitle']) ? $post['navTitle'] : tpCache('web.web_name');

            /*同步数据到服务器*/
            $response = httpRequest($this->logic->get_api_url("/index.php?m=api&c=CmsMiniproClient&a=minipro"), "POST", $post);
            $params = array();
            $params = json_decode($response, true);
            /*--end*/

            if (!empty($params)) {
                if ($params['errcode'] == 0) {
                    /*保存数据*/
                    $newData = array(
                        'type' => $this->model->miniproType,
                        'value' => json_encode($post),
                    );
                    $row = $this->model->getRow($this->model->miniproType);
                    if (empty($row)) { // 新增
                        $newData['add_time'] = getTime();
                        $r = $this->model->insert($newData);
                    } else {
                        $newData['update_time'] = getTime();
                        $r = $this->model->where('type','eq',$this->model->miniproType)->update($newData);
                    }
                    if (false !== $r) {
                        $this->success('操作成功', url('Minipro/createMinipro'));
                    }
                    /*--end*/
                } else {
                    $this->error($params['errmsg']);
                }
            }
            $this->error('操作失败');
        }

        $assign_data = array();

        $row = $this->logic->getSetting();
        $assign_data['row'] = $row;

        /*模板类型*/
        $template_list = array();
        $response = httpRequest($this->logic->get_api_url("/index.php?m=api&c=CmsMiniproClient&a=get_minipro_list"), "GET");
        $params = json_decode($response,true);
        if (!empty($params) && $params['errcode'] == 0) {
            $template_list = $params['errmsg'];
        } else {
            $this->error('小程序模板不存在');
        }
        $miniproNum = preg_replace('/([a-z])/i', '', $template_list[$this->nid]['nid']);
        $assign_data['version'] = 'v'.intval($miniproNum).'.0';
        $assign_data['template_list'] = $template_list;
        /*--end*/

        $assign_data['nid'] = $this->nid; // 模板nid，每套模板唯一
        $assign_data['type'] = $this->model->miniproType; // 小程序配置信息的type值

        $this->assign($assign_data);

        return $this->fetch();
    }

    /**
     * 生成小程序
     */
    public function createMinipro()
    {
        $inc = $this->logic->getSetting();
        if (empty($inc)) {
            $this->error('先填写小程序配置');
        }

        if ($inc['authorizerStatus'] == 0) {
            $gourl = urlencode(url('Minipro/createMinipro', '', true, $this->request->domain()));
            $authorization_url = $this->logic->get_api_url("/index.php?m=api&c=CmsMinipro&a=client_authoriza&authorizer_appid=".$inc['appId']."&gourl={$gourl}");
            header('Location: '.$authorization_url);
            exit;
        }

        $post_data = array(
            'appid' => $inc['appId'],
            'domain'    => $this->request->host(true),
        );
        $response = httpRequest($this->logic->get_api_url("/index.php?m=api&c=CmsMinipro&a=createMinipro"), "POST", $post_data);
        $params = array();
        $params = json_decode($response,true);
        if ($params) {
            if ($params['errcode'] === 0) {
                $this->success('正在生成小程序中……', url('Minipro/setting'));
            } else {
                $this->error($params['errmsg']);
            }
        }
    }

    /**
     * 获取体验二维码
     */
    public function getQrcode()
    {
        $inc = $this->logic->getSetting();
        if (empty($inc)) {
            $this->error('先填写小程序配置');
        }

        $post_data = array(
            'appid' => $inc['appId'],
        );
        $response = httpRequest($this->logic->get_api_url("/index.php?m=api&c=CmsMinipro&a=getQrcode"), "POST", $post_data);
        $params = array();
        $params = json_decode($response,true);
        if ($params) {
            if ($params['errcode'] === 0 || $params['errcode'] == 85004) {
                $imgcode = base64_decode($params['errmsg']);
                $filename = session('admin_id').'-'.dd2char(date("ymdHis").mt_rand(100,999)).".jpg";
                $bannerurl = UPLOAD_PATH.'allimg/'.date('Ymd');
                tp_mkdir($bannerurl);
                $bannerurl = $bannerurl."/".$filename;
                $imgurl = '';
                if (file_put_contents($bannerurl, $imgcode)){
                    $imgurl = $this->request->domain().ROOT_DIR."/{$bannerurl}";
                }

                $params['msg'] = $imgurl;
                $this->success('操作成功', null, $params);
            } else {
                $this->error($params['errmsg'], null, $params);
            }
        }

        $this->error('获取体验二维码失败，请多重试几次！');
    }

    /**
     * 提交小程序审核
     */
    public function submitAudit()
    {
        $inc = $this->logic->getSetting();
        if (empty($inc)) {
            $this->error('先填写小程序配置');
        }

        if (2 == $inc['auditstatus']) {
            $estimateTime = date('Y-m-d H:i:s', $inc['estimateTime']);
            $this->success("审核中……预计{$estimateTime}之前完成", url('Minipro/setting'), '', 3);
        }

        $post_data = array(
            'appid' => $inc['appId'],
        );
        $response = httpRequest($this->logic->get_api_url("/index.php?m=api&c=CmsMinipro&a=submitAudit"), "POST", $post_data);
        $params = array();
        $params = json_decode($response,true);
        if ($params) {
            if ($params['errcode'] === 0) {
                $this->success("进入审核中……", url('Minipro/setting'));
            } else {
                $this->error($params['errmsg']);
            }
        }

        $this->error('接口调用失败，请重新尝试');
    }

    /**
     * 查询审核状态
     */
    public function getAuditstatus()
    {
        $inc = $this->logic->getSetting();
        if (empty($inc)) {
            $this->error('先填写小程序配置');
        }

        $post_data = array(
            'appid' => $inc['appId'],
        );
        $response = httpRequest($this->logic->get_api_url("/index.php?m=api&c=CmsMinipro&a=getAuditstatus"), "POST", $post_data);
        $params = array();
        $params = json_decode($response,true);
        if ($params) {
            echo json_encode($params);
            exit;
        }

        echo json_encode(array('errcode'=>-1, 'errmsg'=>'查询审核状态出错！'));
        exit;
    }

    /**
     * 发布小程序
     */
    public function release()
    {
        $inc = $this->logic->getSetting();
        if (empty($inc)) {
            $this->error('先填写小程序配置');
        }

        if ($inc['auditstatus'] == 2) {
            $estimateTime = date('Y-m-d H:i:s', $inc['estimateTime']);
            $this->success("审核中……预计{$estimateTime}之前完成", url('Minipro/setting'), '', 3);
        } else if ($inc['auditstatus'] == 1) {
            $this->error('审核失败，原因：'.$inc['reason'], url('Minipro/setting'), '', 5);
        }

        $post_data = array(
            'appid' => $inc['appId'],
        );
        $response = httpRequest($this->logic->get_api_url("/index.php?m=api&c=CmsMinipro&a=release"), "POST", $post_data);
        $params = array();
        $params = json_decode($response,true);
        if ($params) {
            if ($params['errcode'] === 0) {
                $this->success("发布成功", url('Minipro/setting'));
            } else {
                $this->error($params['errmsg'].'(代码'.$params['errcode'].')', url('Minipro/setting'), '', 3);
            }
        }

        $this->error('接口调用失败，请重新尝试');
    }

    /**
     * 下载小程序码
     */
    public function getWxaCodeunlimit()
    {
        $inc = $this->logic->getSetting();
        if (empty($inc)) {
            $this->error('先填写小程序配置');
        }

        $post_data = array(
            'appid' => $inc['appId'],
        );
        $response = httpRequest($this->logic->get_api_url("/index.php?m=api&c=CmsMinipro&a=getWxaCodeunlimit"), "POST", $post_data);
        $params = array();
        $params = json_decode($response,true);
        if ($params) {
            if ($params['errcode'] === 0) {
                $imgcode = base64_decode($params['errmsg']);
                $filename = session('admin_id').'-'.dd2char(date("ymdHis").mt_rand(100,999)).".jpg";
                $bannerurl = UPLOAD_PATH.'allimg/'.date('Ymd');
                tp_mkdir($bannerurl);
                $bannerurl = $bannerurl."/".$filename;
                $imgurl = '';
                if (file_put_contents($bannerurl, $imgcode)){
                    $imgurl = $this->request->domain().ROOT_DIR."/{$bannerurl}";
                }
                
                // header("Cache-control: private");
                header("Content-Type:application/force-download"); //设置要下载的文件类型
                header("Content-Disposition: attachment; filename={$filename}"); //设置要下载文件的文件名
                readfile($imgurl);
                exit();
            }
        }

        $this->error('接口调用失败，请重新尝试');
    }

    /**
     * 图片拼接成http路径
     * @param string $filename 路由地址
     * @param bool|string $domain 域名
     */
    public function getImgRealpath($filename, $domain = true)
    {
        $filename = '/public/static/admin/images/minipro/' . $filename;
        if ($domain) {
            $filename = \think\Request::instance()->Domain() . $filename;
        }
        return $filename;
    }

    /**
     * 根据链接获取栏目或者文档
     */
    public function getTypeList()
    {
        if (IS_POST) {
            $id       = input('post.id/i');
            $selected = input('post.selected/i');
            $selected = isset($selected) ? $selected : 0;
            if ($id == 3) {
                $list = allow_release_arctype($selected);
            } elseif ($id == 4) {
                $list = allow_release_arctype($selected, [6]);
            } elseif ($id == 5) {
                $form_list = Db::name('archives')->field('aid,title')->where(['arcrank' => 0, 'is_del' => 0, 'status' => 1])->select();
                $list      = '';
                foreach ($form_list as $key => $v) {
                    if ($selected && $v['aid'] == $selected) {
                        $list .= "<option value='" . $v['aid'] . "' selected='selected'> " . $v['title'] . "</option> ";
                    } else {
                        $list .= "<option value='" . $v['aid'] . "'> " . $v['title'] . "</option> ";
                    }
                }
            } elseif ($id == 6) {
                $form_list = Db::name('form')->field('id,name')->where(['status' => 1, 'is_del' => 0])->select();
                $list      = '';
                foreach ($form_list as $key => $v) {
                    if ($selected && $v['id'] == $selected) {
                        $list .= "<option value='" . $v['id'] . "' selected='selected'> " . $v['name'] . "</option> ";
                    } else {
                        $list .= "<option value='" . $v['id'] . "'> " . $v['name'] . "</option> ";
                    }
                }
            }
            $this->success('success', null, $list);
        }
    }

    /**
     * 栏目列表 多选
     * @return mixed
     */
    public function ajax_arctype_list()
    {
        $func = input('func/s');
        $sort = input('sort/s');
        // 目录列表
        $arctypeLogic = new ArctypeLogic();
        $where['is_del'] = '0'; // 回收站功能
        $where['current_channel'] = ['gt',0]; // 非自定义（问答）
        $assign_data['list'] = $arctypeLogic->arctype_list(0, 0, false, 0, $where, false);
        $assign_data['func'] = $func;
        $assign_data['sort'] = $sort;
        $this->assign($assign_data);
        return $this->fetch();
    }

    /**
     * 文档列表-选择(单选)
     */
    public function ajax_archives_list()
    {
        $assign_data = array();
        $condition = array();
        // 获取到所有GET参数
        $param = input('param.');
        $typeid = input('typeid/d', 0);
        $func = input('func/s');
        $sort = input('sort/s');
        
        // 应用搜索条件
        foreach (['keywords','typeid','flag'] as $key) {
            if (isset($param[$key]) && $param[$key] !== '') {
                if ($key == 'keywords') {
                    $condition['a.title'] = array('LIKE', "%{$param[$key]}%");
                } else if ($key == 'typeid') {
                    $typeid = $param[$key];
                    $hasRow = model('Arctype')->getHasChildren($typeid);
                    $typeids = get_arr_column($hasRow, 'id');
                    if(!empty($auth_role_info['permission']['arctype']) && !empty($typeids)){
                        $typeids = array_intersect($typeids, $auth_role_info['permission']['arctype']);
                    }
                    $condition['a.typeid'] = array('IN', $typeids);
                } else if ($key == 'flag') {
                    $condition['a.'.$param[$key]] = array('eq', 1);
                } else {
                    $condition['a.'.$key] = array('eq', $param[$key]);
                }
            }
        }

        // 回收站
        $condition['a.is_del'] = array('eq', 0);

        /**
         * 数据查询，搜索出主键ID的值
         */
        $count = DB::name('archives')->alias('a')->where($condition)->count('aid');// 查询满足要求的总记录数
        unset($param['openurl']);
        $Page = new Page($count, config('paginate.list_rows'),$param);// 实例化分页类 传入总记录数和每页显示的记录数
        $list = DB::name('archives')
            ->field("a.aid")
            ->alias('a')
            ->where($condition)
            ->order('a.aid desc')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->getAllWithIndex('aid');

        /**
         * 完善数据集信息
         * 在数据量大的情况下，经过优化的搜索逻辑，先搜索出主键ID，再通过ID将其他信息补充完整；
         */
        if ($list) {
            $aids = array_keys($list);
            $fields = "b.*, a.*, a.aid as aid";
            $row = DB::name('archives')
                ->field($fields)
                ->alias('a')
                ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')
                ->where('a.aid', 'in', $aids)
                ->getAllWithIndex('aid');
            foreach ($list as $key => $val) {
                $row[$val['aid']]['arcurl'] = get_arcurl($row[$val['aid']]);
                $row[$val['aid']]['litpic'] = handle_subdir_pic($row[$val['aid']]['litpic']); // 支持子目录
                $list[$key] = $row[$val['aid']];
            }
        }
        $show = $Page->show(); // 分页显示输出
        $assign_data['page'] = $show; // 赋值分页输出
        $assign_data['list'] = $list; // 赋值数据集
        $assign_data['pager'] = $Page; // 赋值分页对象

        /*允许发布文档列表的栏目*/
        $arctype_html = allow_release_arctype($typeid);
        $typeidNum = substr_count($arctype_html, '</option>');
        $assign_data['arctype_html'] = $arctype_html;
        $assign_data['typeidNum'] = $typeidNum;
        /*--end*/

        $assign_data['func'] = $func;
        $assign_data['sort'] = $sort;
        $this->assign($assign_data);

        return $this->fetch();
    }

    /**
     * 文档列表-多选(仅有图文档)
     */
    public function ajax_archives_list_pic()
    {
        $assign_data = array();
        $condition = array();
        // 获取到所有GET参数
        $param = input('param.');
        $flag = input('flag/s');
        $typeid = input('typeid/d', 0);
        $func = input('func/s');
        $sort = input('sort/s');
        $ids = input('ids/s');

        // 应用搜索条件
        foreach (['keywords','typeid','flag'] as $key) {
            if (isset($param[$key]) && $param[$key] !== '') {
                if ($key == 'keywords') {
                    $condition['a.title'] = array('LIKE', "%{$param[$key]}%");
                } else if ($key == 'typeid') {
                    $typeid = $param[$key];
                    $hasRow = model('Arctype')->getHasChildren($typeid);
                    $typeids = get_arr_column($hasRow, 'id');
                    if(!empty($auth_role_info['permission']['arctype']) && !empty($typeids)){
                        $typeids = array_intersect($typeids, $auth_role_info['permission']['arctype']);
                    }
                    $condition['a.typeid'] = array('IN', $typeids);
                } else if ($key == 'flag') {
                    $condition['a.'.$param[$key]] = array('eq', 1);
                } else {
                    $condition['a.'.$key] = array('eq', $param[$key]);
                }
            }
        }

        // 回收站
        $condition['a.is_del'] = array('eq', 0);
        $condition['a.litpic'] = array('>', '');

        /**
         * 数据查询，搜索出主键ID的值
         */
        $count = DB::name('archives')->alias('a')->where($condition)->count('aid');// 查询满足要求的总记录数
        unset($param['openurl']);
        $Page = new Page($count, config('paginate.list_rows'),$param);// 实例化分页类 传入总记录数和每页显示的记录数
        $list = DB::name('archives')
            ->field("a.aid")
            ->alias('a')
            ->where($condition)
            ->order('a.aid desc')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->getAllWithIndex('aid');
        /**
         * 完善数据集信息
         * 在数据量大的情况下，经过优化的搜索逻辑，先搜索出主键ID，再通过ID将其他信息补充完整；
         */
        if ($list) {
            $aids = array_keys($list);
            $fields = "b.*, a.*, a.aid as aid";
            $row = DB::name('archives')
                ->field($fields)
                ->alias('a')
                ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')
                ->where('a.aid', 'in', $aids)
                ->getAllWithIndex('aid');
            foreach ($list as $key => $val) {
                $row[$val['aid']]['arcurl'] = get_arcurl($row[$val['aid']]);
                $row[$val['aid']]['litpic'] = handle_subdir_pic($row[$val['aid']]['litpic']); // 支持子目录
                $list[$key] = $row[$val['aid']];
            }
        }
        $show = $Page->show(); // 分页显示输出
        $assign_data['page'] = $show; // 赋值分页输出
        $assign_data['list'] = $list; // 赋值数据集
        $assign_data['pager'] = $Page; // 赋值分页对象

        /*允许发布文档列表的栏目*/
        $arctype_html = allow_release_arctype($typeid);
        $typeidNum = substr_count($arctype_html, '</option>');
        $assign_data['arctype_html'] = $arctype_html;
        $assign_data['typeidNum'] = $typeidNum;
        /*--end*/
        $assign_data['func'] = $func;
        $assign_data['sort'] = $sort;
        $assign_data['ids'] = $ids;
        $this->assign($assign_data);

        return $this->fetch();
    }
}