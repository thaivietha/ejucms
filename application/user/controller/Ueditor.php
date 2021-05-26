<?php
/**
 * User: xyz
 * Date: 2019/11/8
 * Time: 12:15
 */

namespace app\user\controller;

use think\Db;

class Ueditor extends Base
{
    private $sub_name = array('date', 'Ymd');
    private $savePath = 'allimg/';
    private $fileExt = 'jpg,png,gif,jpeg,bmp,ico';
    private $nowFileName = '';
    public function __construct()
    {
        parent::__construct();


        date_default_timezone_set("Asia/Shanghai");

        $this->savePath = input('savepath','allimg').'/';

        $this->nowFileName = input('nowfilename', '');
        if (empty($this->nowFileName)) {
            $this->nowFileName = md5(time().uniqid(mt_rand(), TRUE));
        }

        error_reporting(E_ERROR | E_WARNING);

        header("Content-Type: text/html; charset=utf-8");

        $image_type = tpCache('basic.image_type');
        $this->fileExt = !empty($image_type) ? str_replace('|', ',', $image_type) : $this->fileExt;
    }
    /*
     * 图片上传
     */
    public function imageUp()
    {
        if (!IS_POST) {
            $return_data['state'] = '非法上传';
            respose($return_data,'json');
        }

        $image_upload_limit_size = intval(tpCache('basic.file_size') * 1024 * 1024);
        // 上传图片框中的描述表单名称，
        // $pictitle = input('pictitle');
        // $dir = input('dir');
        // $title = htmlspecialchars($pictitle , ENT_QUOTES);
        // $path = htmlspecialchars($dir, ENT_QUOTES);
        //$input_file ['upfile'] = $info['Filedata'];  一个是上传插件里面来的, 另外一个是 文章编辑器里面来的
        // 获取表单上传文件
        $file = request()->file('file');
        if(empty($file))
            $file = request()->file('upfile');

        // ico图片文件不进行验证
        if (pathinfo($file->getInfo('name'), PATHINFO_EXTENSION) != 'ico') {
            $result = $this->validate(
                ['file' => $file],
                ['file'=>'image|fileSize:'.$image_upload_limit_size.'|fileExt:'.$this->fileExt],
                ['file.image' => '上传文件必须为图片','file.fileSize' => '上传文件过大','file.fileExt'=>'上传文件后缀名必须为'.$this->fileExt]
            );
        } else {
            $result = true;
        }

        /*验证图片一句话木马*/
        $imgstr = @file_get_contents($file->getInfo('tmp_name'));
        if (false !== $imgstr && (preg_match('#__HALT_COMPILER()#i', $imgstr) || preg_match('#<([^?]*)\?php#i', $imgstr))) {
            $result = '禁止上传木马图片！';
        }
        /*--end*/

        $return_data['oldfilename'] = $file->getInfo('name');
        if (true !== $result || empty($file)) {
            $state = "ERROR：" . $result;
        } else {
            if ('adminlogo/' == $this->savePath) {
                $savePath = 'public/static/admin/logo/';
            } else {
                $savePath = UPLOAD_PATH.$this->savePath.date('Ymd/');
            }
            $ossConfig = tpCache('oss');
            if ($ossConfig['oss_switch']) {
                //商品图片可选择存放在oss
                // $object = $savePath.md5(getTime().uniqid(mt_rand(), TRUE)).'.'.pathinfo($file->getInfo('name'), PATHINFO_EXTENSION);
                $object = $savePath.session('admin_id').'-'.dd2char(date("ymdHis").mt_rand(100,999)).'.'.pathinfo($file->getInfo('name'), PATHINFO_EXTENSION);
                $ossClient = new \app\common\logic\OssLogic;
                $return_url = $ossClient->uploadFile($file->getRealPath(), $object);
                if (!$return_url) {
                    $state = "ERROR" . $ossClient->getError();
                    $return_url = '';
                } else {
                    $state = "SUCCESS";
                }
                @unlink($file->getRealPath());
            } else {
                // 移动到框架应用根目录/public/uploads/ 目录下
                $info = $file->rule(function ($file) {
                    // return  md5(mt_rand()); // 使用自定义的文件保存规则
                    return session('admin_id').'-'.dd2char(date("ymdHis").mt_rand(100,999)); // 使用自定义的文件保存规则
                })->move($savePath);
                if ($info) {
                    $state = "SUCCESS";
                } else {
                    $state = "ERROR" . $file->getError();
                }
                $return_url = '/'.$savePath.$info->getSaveName();
            }
            $return_data['url'] = ROOT_DIR.$return_url; // 支持子目录
        }

        if($state == 'SUCCESS' && pathinfo($file->getInfo('name'), PATHINFO_EXTENSION) != 'ico'){
            if(true || $this->savePath=='news/'){ // 添加水印
                $imgresource = ".".$return_url;
                $image = \think\Image::open($imgresource);
                $water = tpCache('water');
                $return_data['mark_type'] = $water['mark_type'];
                if($water['is_mark']==1 && $image->width()>$water['mark_width'] && $image->height()>$water['mark_height']){
                    if($water['mark_type'] == 'text'){
                        //$image->text($water['mark_txt'],ROOT_PATH.'public/static/common/font/hgzb.ttf',20,'#000000',9)->save($imgresource);
                        $ttf = ROOT_PATH.'public/static/common/font/hgzb.ttf';
                        if (file_exists($ttf)) {
                            $size = $water['mark_txt_size'] ? $water['mark_txt_size'] : 30;
                            $color = $water['mark_txt_color'] ?: '#000000';
                            if (!preg_match('/^#[0-9a-fA-F]{6}$/', $color)) {
                                $color = '#000000';
                            }
                            $transparency = intval((100 - $water['mark_degree']) * (127/100));
                            $color .= dechex($transparency);
                            $image->open($imgresource)->text($water['mark_txt'], $ttf, $size, $color, $water['mark_sel'])->save($imgresource);
                            $return_data['mark_txt'] = $water['mark_txt'];
                        }
                    }else{
                        /*支持子目录*/
                        $water['mark_img'] = preg_replace('#^(/[/\w]+)?(/public/upload/|/uploads/)#i', '$2', $water['mark_img']); // 支持子目录
                        /*--end*/
                        //$image->water(".".$water['mark_img'],9,$water['mark_degree'])->save($imgresource);
                        $waterPath = "." . $water['mark_img'];
                        if (eyPreventShell($waterPath) && file_exists($waterPath)) {
                            $quality = $water['mark_quality'] ? $water['mark_quality'] : 80;
                            $waterTempPath = dirname($waterPath).'/temp_'.basename($waterPath);
                            $image->open($waterPath)->save($waterTempPath, null, $quality);
                            $image->open($imgresource)->water($waterTempPath, $water['mark_sel'], $water['mark_degree'])->save($imgresource);
                            @unlink($waterTempPath);
                        }
                    }
                }
            }
        }
        // $return_data['title'] = $title;
        $return_data['original'] = ''; // 这里好像没啥用 暂时注释起来
        $return_data['state'] = $state;
        // $return_data['path'] = $path;

        // 是否开启七牛云插件
        $data = Db::name('weapp')->where('code','Qiniuyun')->field('status')->find();
        if (!empty($data) && 1 == $data['status']) {
            // 同步图片到七牛云
            $return_data['url'] = SynchronizeQiniu($return_data['url']);
        }

        respose($return_data,'json');
    }

}