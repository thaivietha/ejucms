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
use app\admin\controller\Base;
use think\Controller;
use think\Db;
use app\admin\logic\FilemanagerLogic;

class Filemanager extends Base
{
    public $filemanagerLogic;
    public $baseDir = '';
    public $maxDir = '';
    public $globalTpCache = array();

    public function _initialize() {
        parent::_initialize();
        $this->filemanagerLogic = new FilemanagerLogic(); 
        $this->globalTpCache = $this->filemanagerLogic->globalTpCache;
        $this->baseDir = $this->filemanagerLogic->baseDir; // 服务器站点根目录绝对路径
        $this->maxDir = $this->filemanagerLogic->maxDir; // 默认文件管理的最大级别目录
    }

    public function index()
    {
        // 获取到所有GET参数
        $param = input('param.', '', null);
        $activepath = input('param.activepath', '', null);
        $activepath = $this->filemanagerLogic->replace_path($activepath, ':', true);

        /*当前目录路径*/
        $activepath = !empty($activepath) ? $activepath : $this->maxDir;
        $tmp_max_dir = preg_replace("#\/#i", "\/", $this->maxDir);
        if (!preg_match("#^".$tmp_max_dir."#i", $activepath)) {
            $activepath = $this->maxDir;
        }
        /*--end*/

        $inpath = "";
        $activepath = str_replace("..", "", $activepath);
        $activepath = preg_replace("#^\/{1,}#", "/", $activepath); // 多个斜杆替换为单个斜杆
        if($activepath == "/") $activepath = "";

        if(empty($activepath)) {
            $inpath = $this->baseDir.$this->maxDir;
        } else {
            $inpath = $this->baseDir.$activepath;
        }

        $list = $this->filemanagerLogic->getDir($inpath, $activepath);
        $assign_data['list'] = $list;

        $assign_data['activepath'] = $activepath;

        $this->assign($assign_data);

        return $this->fetch();
    }

    public function lists()
    {
        // 获取到所有GET参数
        $param = input('param.', '', null);
        $activepath = input('param.activepath', '', null);
        $activepath = $this->filemanagerLogic->replace_path($activepath, ':', true);

        if (empty($activepath) || $this->maxDir == $activepath) {
            $this->redirect('Filemanager/index');
            exit;
        }

        /*当前目录路径*/
        $activepath = !empty($activepath) ? $activepath : $this->maxDir;
        $tmp_max_dir = preg_replace("#\/#i", "\/", $this->maxDir);
        if (!preg_match("#^".$tmp_max_dir."#i", $activepath)) {
            $activepath = $this->maxDir;
        }
        /*--end*/

        $inpath = "";
        $activepath = str_replace("..", "", $activepath);
        $activepath = preg_replace("#^\/{1,}#", "/", $activepath); // 多个斜杆替换为单个斜杆
        if($activepath == "/") $activepath = "";

        if(empty($activepath)) {
            $inpath = $this->baseDir.$this->maxDir;
        } else {
            $inpath = $this->baseDir.$activepath;
        }

        $list = $this->filemanagerLogic->getDirFile($inpath, $activepath);
        $assign_data['list'] = $list;

        /*文件操作*/
        $assign_data['replaceImgOpArr'] = $this->filemanagerLogic->replaceImgOpArr;
        $assign_data['editOpArr'] = $this->filemanagerLogic->editOpArr;
        $assign_data['renameOpArr'] = $this->filemanagerLogic->renameOpArr;
        $assign_data['delOpArr'] = $this->filemanagerLogic->delOpArr;
        $assign_data['moveOpArr'] = $this->filemanagerLogic->moveOpArr;
        /*--end*/

        $assign_data['activepath'] = $activepath;
        $assign_data['maxDir'] = $this->maxDir;

        $this->assign($assign_data);

        return $this->fetch();
    }


    /**
     * 替换图片
     */
    public function replace_img()
    {
        if (IS_POST) {
            $activepath = input('post.activepath/s', '');
            $filename = input('post.filename/s', '');
            $upfile = input('post.upfile/s', '');

            if (empty($activepath) || empty($filename)) {
                $this->error('参数有误');
            }
            if (empty($upfile)) {
                $this->error('请上传图片！');
            } else {
                $image_type = tpCache('basic.image_type');
                $fileExt = !empty($image_type) ? str_replace('|', ',', $image_type) : config('global.image_ext');
                $image_types = explode(',', $fileExt);
                $filename_image_ext = pathinfo($filename, PATHINFO_EXTENSION);
                $upfile_image_ext = pathinfo($upfile, PATHINFO_EXTENSION);
                if (!in_array($filename_image_ext, $image_types) || !in_array($upfile_image_ext, $image_types)) {
                    $this->error('上传图片后缀名必须为'.$fileExt);
                }
            }
            $source = preg_replace('#^'.$this->root_dir.'/uploads/#i', 'uploads/', $upfile);
            $destination = trim($activepath, '/').'/'.$filename;
            if (@copy($source, $destination)) {
                @unlink($source);
                $this->success('操作成功！', url('Filemanager/lists', array('activepath'=>$this->filemanagerLogic->replace_path($activepath, ':', false))));
            } else {
                $this->error('操作失败！');
            }
        }

        $filename = input('param.filename/s', '', null);

        $activepath = input('param.activepath/s', '', null);
        $activepath = $this->filemanagerLogic->replace_path($activepath, ':', true);
        if ($activepath == "") $activepathname = "根目录";
        else $activepathname = $activepath;

        $info = array(
            'activepath'    => $activepath,
            'activepathname'    => $activepathname,
            'filename'  => $filename,
        );
        $this->assign('info', $info);
        return $this->fetch();
    }

    /**
     * 编辑
     */
    public function edit()
    {
        if (IS_POST) {
            $post = input('post.', '', null);
            $content = input('post.content', '', null);
            $filename = !empty($post['filename']) ? trim($post['filename']) : '';
            $content = !empty($content) ? $content : '';
            $activepath = !empty($post['activepath']) ? trim($post['activepath']) : '';

            if (empty($filename) || empty($activepath)) {
                $this->error('参数有误');
                exit;
            }

            $r = $this->filemanagerLogic->editFile($filename, $activepath, $content);
            if ($r === true) {
                $this->success('操作成功！', url('Filemanager/lists', array('activepath'=>$this->filemanagerLogic->replace_path($activepath, ':', false))));
                exit;
            } else {
                $this->error($r);
                exit;
            }
        }

        $activepath = input('param.activepath/s', '', null);
        $activepath = $this->filemanagerLogic->replace_path($activepath, ':', true);

        $filename = input('param.filename/s', '', null);

        $activepath = str_replace("..", "", $activepath);
        $filename = str_replace("..", "", $filename);
        $path_parts  = pathinfo($filename);
        $path_parts['extension'] = strtolower($path_parts['extension']);

        /*不允许越过指定最大级目录的文件编辑*/
        $tmp_max_dir = preg_replace("#\/#i", "\/", $this->filemanagerLogic->maxDir);
        if (!preg_match("#^".$tmp_max_dir."#i", $activepath)) {
            $this->error('没有操作权限！');
            exit;
        }
        /*--end*/
        
        /*允许编辑的文件类型*/
        if (!in_array($path_parts['extension'], $this->filemanagerLogic->editExt)) {
            $this->error('只允许操作文件类型如下：'.implode('|', $this->filemanagerLogic->editExt));
            exit;
        }
        /*--end*/

        /*读取文件内容*/
        $file = $this->baseDir."$activepath/$filename";
        $content = "";
        if(is_file($file))
        {
            $filesize = filesize($file);
            if (0 < $filesize) {
                $fp = fopen($file, "r");
                $content = fread($fp, $filesize);
                if (mb_detect_encoding($content, 'UTF-8', true) === false) {
                    $content = iconv('GB2312', 'UTF-8', $content);
                }
                fclose($fp);
                if ('htm' == $path_parts['extension']) {
                    $content = htmlspecialchars($content, ENT_QUOTES);
                    foreach ($this->filemanagerLogic->disableFuns as $key => $val) {
                        $val_new = msubstr($val, 0, 1).'-'.msubstr($val, 1);
                        $content = preg_replace("/(@)?".$val."(\s*)\(/i", "{$val_new}(", $content);
                    }
                }
            }
        }
        /*--end*/

        if($path_parts['extension'] == 'js'){
            $extension = 'text/javascript';
        } else if($path_parts['extension'] == 'css'){
            $extension = 'text/css';
        } else {
            $extension = 'text/html';
        }

        $info = array(
            'filename'  => $filename,
            'activepath'=> $activepath,
            'extension' => $extension,
            'content'   => $content,
        );
        $this->assign('info', $info);
        return $this->fetch();
    }

    /**
     * 新建文件
     */
    public function newfile()
    {
        if (IS_POST) {
            $post = input('post.', '', null);
            $content = input('post.content', '', null);
            $filename = !empty($post['filename']) ? trim($post['filename']) : '';
            $content = !empty($content) ? $content : '';
            $activepath = !empty($post['activepath']) ? trim($post['activepath']) : '';

            if (empty($filename) || empty($activepath)) {
                $this->error('参数有误');
                exit;
            }

            $r = $this->filemanagerLogic->editFile($filename, $activepath, $content);
            if ($r === true) {
                $this->success('操作成功！', url('Filemanager/lists', array('activepath'=>$this->filemanagerLogic->replace_path($activepath, ':', false))));
                exit;
            } else {
                $this->error($r);
                exit;
            }
        }

        $activepath = input('param.activepath/s', '', null);
        $activepath = $this->filemanagerLogic->replace_path($activepath, ':', true);
        $filename = 'newfile.htm';
        $content = "";
        $info = array(
            'filename'  => $filename,
            'activepath'=> $activepath,
            'content'   => $content,
            'extension' => 'text/html',
        );
        $this->assign('info', $info);
        return $this->fetch();
    }

    /**
     * 设置模板风格
     */
    public function ajax_set_theme()
    {
        $theme = input('post.theme/s');
        if (IS_POST && !empty($theme)) {
            tpCache('system', ['system_tpl_theme'=>$theme]);
            $this->success('操作成功');
        }
        $this->error('操作失败');
    }
}
