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

namespace app\admin\logic;

use think\Model;
use think\Db;
/**
 * 文档逻辑定义
 * Class CatsLogic
 * @package admin\Logic
 */
load_trait('controller/Jump');
class ArchivesLogic extends Model
{
    use \traits\controller\Jump;
    
    /**
     * 析构函数
     */
    function  __construct() {

    }

    /**
     * 删除文档
     */
    public function del($del_id = array(), $thorough = 0)
    {
        if (empty($del_id)) {
            $del_id = input('del_id/a');
        }
        if (empty($thorough)) {
            $thorough = input('thorough/d');
        }

        $id_arr = eyIntval($del_id);
        if(!empty($id_arr)){
            /*分离并组合相同模型下的文档ID*/
            $row = db('archives')
                ->alias('a')
                ->field('a.channel,a.aid,b.table,b.ctl_name,b.ifsystem')
                ->join('__CHANNELTYPE__ b', 'a.channel = b.id', 'LEFT')
                ->where([
                    'a.aid' => ['IN', $id_arr],
                ])
                ->select();
            $data = array();
            foreach ($row as $key => $val) {
                $data[$val['channel']]['aid'][] = $val['aid'];
                $data[$val['channel']]['table'] = $val['table'];
                if (empty($val['ifsystem'])) {
                    $ctl_name = 'Custom';
                } else {
                    $ctl_name = $val['ctl_name'];
                }
                $data[$val['channel']]['ctl_name'] = $ctl_name;
            }
            /*--end*/

            if (1 == $thorough) { // 直接删除，跳过回收站
                $err = 0;
                foreach ($data as $key => $val) {
                    $r = M('archives')->where('aid','IN',$val['aid'])->delete();
                    if ($r) {
                        if (empty($val['ifsystem'])) {
                            model($val['ctl_name'])->afterDel($val['aid'], $val['table']);
                        } else {
                            model($val['ctl_name'])->afterDel($val['aid']);
                        }
                        adminLog('删除文档-id：'.implode(',', $val['aid']));
                    } else {
                        $err++;
                    }
                }
            } else {
                $info['is_del']     = '1'; // 伪删除状态
                $info['update_time']= getTime(); // 更新修改时间
                $info['del_method'] = '1'; // 恢复删除方式为默认

                $err = 0;
                foreach ($data as $key => $val) {
                    $r = M('archives')->where('aid','IN',$val['aid'])->update($info);
                    if ($r) {
                        adminLog('删除文档-id：'.implode(',', $val['aid']));
                    } else {
                        $err++;
                    }
                }
            }

            if (0 == $err) {
                $this->success('删除成功');
            } else if ($err < count($data)) {
                $this->success('删除部分成功');
            } else {
                $this->error('删除失败');
            }
        }else{
            $this->error('文档不存在');
        }
    }

    /**
     * 复制文档
     */
    public function batch_copy($aids = [], $typeid, $channel, $num = 1)
    {
        // 获取复制栏目的模型ID
        $channeltypeRow = Db::name('channeltype')->field('nid,table')
            ->where([
                'id'    => $channel,
            ])->find();
        if (!empty($channeltypeRow)) {
            // 主表数据
            $archivesRow = Db::name('archives')->where(['aid'=>['IN', $aids]])->select();
            // 内容扩展表数据
            $tableExt = $channeltypeRow['table']."_content";
            $contentRow = Db::name($tableExt)->field('id', true)->where(['aid'=>['IN', $aids]])->getAllWithIndex('aid');

            // 拥有特性模型的其他数据处理
            if ('images' == $channeltypeRow['nid']) { // 图集模型的特性表数据
                $imgUploadRow = Db::name('images_upload')->field('img_id', true)->where(['aid'=>['IN', $aids]])->select();
                $imgUploadRow = group_same_key($imgUploadRow, 'aid');
            } else if ('xinfang' == $channeltypeRow['nid']) { // 新房模型的特性表数据
                // 楼盘中间表
                $xinfangSystemRow = Db::name('xinfang_system')->field('id', true)->where(['aid'=>['IN', $aids]])->select();
                $xinfangSystemRow = group_same_key($xinfangSystemRow, 'aid');
                // 户型图
                $xinfangHuxingRow = Db::name('xinfang_huxing')->field('huxing_id', true)->where(['aid'=>['IN', $aids]])->select();
                $xinfangHuxingRow = group_same_key($xinfangHuxingRow, 'aid');
                // 相册
                $xinfangPhotoRow = Db::name('xinfang_photo')->field('photo_id', true)->where(['aid'=>['IN', $aids]])->select();
                $xinfangPhotoRow = group_same_key($xinfangPhotoRow, 'aid');
                // 价格走势
                $xinfangPriceRow = Db::name('xinfang_price')->field('price_id', true)->where(['aid'=>['IN', $aids]])->select();
                $xinfangPriceRow = group_same_key($xinfangPriceRow, 'aid');
            }else if ('xiaoqu' == $channeltypeRow['nid']){  //小区
                $xiaoquSystemRow = Db::name('xiaoqu_system')->field('id', true)->where(['aid'=>['IN', $aids]])->select();
                $xiaoquSystemRow = group_same_key($xiaoquSystemRow, 'aid');
                $xiaoquPhotoRow = Db::name('xiaoqu_photo')->field('photo_id', true)->where(['aid'=>['IN', $aids]])->select();
                $xiaoquPhotoRow = group_same_key($xiaoquPhotoRow, 'aid');
            }else if('ershou' == $channeltypeRow['nid']){  //二手房
                $ershouSystemRow = Db::name('ershou_system')->field('id', true)->where(['aid'=>['IN', $aids]])->select();
                $ershouSystemRow = group_same_key($ershouSystemRow, 'aid');
                $ershouPhotoRow = Db::name('ershou_photo')->field('photo_id', true)->where(['aid'=>['IN', $aids]])->select();
                $ershouPhotoRow = group_same_key($ershouPhotoRow, 'aid');
            }else if('zufang' == $channeltypeRow['nid']){  //租房
                $zufangSystemRow = Db::name('zufang_system')->field('id', true)->where(['aid'=>['IN', $aids]])->select();
                $zufangSystemRow = group_same_key($zufangSystemRow, 'aid');
                $zufangPhotoRow = Db::name('zufang_photo')->field('photo_id', true)->where(['aid'=>['IN', $aids]])->select();
                $zufangPhotoRow = group_same_key($zufangPhotoRow, 'aid');
            }

            foreach ($archivesRow as $key => $val) {
                // 同步数据
                $archivesData = [];
                for ($i = 0; $i < $num; $i++) {
                    // 主表
                    $archivesInfo = $val;
                    unset($archivesInfo['aid']);
                    $archivesInfo['typeid'] = $typeid;
                    $archivesInfo['add_time'] = getTime();
                    $archivesInfo['update_time'] = getTime();
                    $archivesData[] = $archivesInfo;
                }
                if (!empty($archivesData)) {
                    $rdata = model('Archives')->saveAll($archivesData);
                    if ($rdata) {
                        // 内容扩展表的数据
                        $contentData = [];
                        $contentInfo = $contentRow[$val['aid']];

                        // 拥有特性模型的其他数据处理
                        $imgUploadInfo = $imgUploadData = [];
                        $xinfangSystemInfo = $xinfangHuxingInfo = $xinfangPhotoInfo = $xinfangPriceInfo = [];
                        $xinfangSystemData = $xinfangHuxingData = $xinfangPhotoData = $xinfangPriceData = [];

                        $xiaoquSystemInfo = $xiaoquPhotoInfo = $xiaoquPriceInfo = [];
                        $xiaoquSystemData = $xiaoquPhotoData = $xiaoquPriceData = [];

                        $ershouSystemInfo = $ershouPhotoInfo = $ershouPriceInfo = [];
                        $ershouSystemData = $ershouPhotoData = $ershouPriceData = [];

                        $zufangSystemInfo = $zufangPhotoInfo = $zufangPriceInfo = [];
                        $zufangSystemData = $zufangPhotoData = $zufangPriceData = [];
                        if ('images' == $channeltypeRow['nid']) { // 图集模型的特性表数据
                            $imgUploadInfo = !empty($imgUploadRow[$val['aid']]) ? $imgUploadRow[$val['aid']] : [];
                        } else if ('xinfang' == $channeltypeRow['nid']) { // 新房模型的特性表数据
                            // 楼盘中间表
                            $xinfangSystemInfo = !empty($xinfangSystemRow[$val['aid']]) ? $xinfangSystemRow[$val['aid']] : [];
                            // 户型图
                            $xinfangHuxingInfo = !empty($xinfangHuxingRow[$val['aid']]) ? $xinfangHuxingRow[$val['aid']] : [];
                            // 相册
                            $xinfangPhotoInfo = !empty($xinfangPhotoRow[$val['aid']]) ? $xinfangPhotoRow[$val['aid']] : [];
                            // 价格走势
                            $xinfangPriceInfo = !empty($xinfangPriceRow[$val['aid']]) ? $xinfangPriceRow[$val['aid']] : [];
                        }else if ('xiaoqu' == $channeltypeRow['nid']){  //小区
                            // 中间表
                            $xiaoquSystemInfo = !empty($xiaoquSystemRow[$val['aid']]) ? $xiaoquSystemRow[$val['aid']] : [];
                            // 相册
                            $xiaoquPhotoInfo = !empty($xiaoquPhotoRow[$val['aid']]) ? $xiaoquPhotoRow[$val['aid']] : [];
                        }else if('ershou' == $channeltypeRow['nid']){
                            // 中间表
                            $ershouSystemInfo = !empty($ershouSystemRow[$val['aid']]) ? $ershouSystemRow[$val['aid']] : [];
                            // 相册
                            $ershouPhotoInfo = !empty($ershouPhotoRow[$val['aid']]) ? $ershouPhotoRow[$val['aid']] : [];
                        }else if('zufang' == $channeltypeRow['nid']){
                            // 中间表
                            $zufangSystemInfo = !empty($zufangSystemRow[$val['aid']]) ? $zufangSystemRow[$val['aid']] : [];
                            // 相册
                            $zufangPhotoInfo = !empty($zufangPhotoRow[$val['aid']]) ? $zufangPhotoRow[$val['aid']] : [];
                        }

                        // 需要复制的数据与新产生的文档ID进行关联
                        foreach ($rdata as $k1 => $v1) {
                            $aid_new = $v1->getData('aid');

                            // 内容扩展表的数据
                            $contentInfo['aid'] = $aid_new;
                            $contentData[] = $contentInfo;

                            // 图集模型
                            if ('images' == $channeltypeRow['nid']) {
                                foreach ($imgUploadInfo as $img_k => $img_v) {
                                    $img_v['aid'] = $aid_new;
                                    $imgUploadData[] = $img_v;
                                }
                            } else if ('xinfang' == $channeltypeRow['nid']) {
                                // 楼盘中间表
                                foreach ($xinfangSystemInfo as $sys_k => $sys_v) {
                                    $sys_v['aid'] = $aid_new;
                                    $xinfangSystemData[] = $sys_v;
                                }
                                // 户型图
                                foreach ($xinfangHuxingInfo as $hx_k => $hx_v) {
                                    $hx_v['aid'] = $aid_new;
                                    $xinfangHuxingData[] = $hx_v;
                                }
                                // 相册
                                foreach ($xinfangPhotoInfo as $ph_k => $ph_v) {
                                    $ph_v['aid'] = $aid_new;
                                    $xinfangPhotoData[] = $ph_v;
                                }
                                // 价格走势
                                foreach ($xinfangPriceInfo as $pr_k => $pr_v) {
                                    $pr_v['aid'] = $aid_new;
                                    $xinfangPriceData[] = $pr_v;
                                }
                            }else if ('xiaoqu' == $channeltypeRow['nid']){
                                foreach ($xiaoquSystemInfo as $sys_k => $sys_v) {
                                    $sys_v['aid'] = $aid_new;
                                    $xiaoquSystemData[] = $sys_v;
                                }
                                foreach ($xiaoquPhotoInfo as $sys_k => $sys_v) {
                                    $sys_v['aid'] = $aid_new;
                                    $xiaoquPhotoData[] = $sys_v;
                                }
                            }else if('ershou' == $channeltypeRow['nid']){
                                foreach ($ershouSystemInfo as $sys_k => $sys_v) {
                                    $sys_v['aid'] = $aid_new;
                                    $ershouSystemData[] = $sys_v;
                                }
                                foreach ($ershouPhotoInfo as $sys_k => $sys_v) {
                                    $sys_v['aid'] = $aid_new;
                                    $ershouPhotoData[] = $sys_v;
                                }
                            }else if('zufang' == $channeltypeRow['nid']){
                                foreach ($zufangSystemInfo as $sys_k => $sys_v) {
                                    $sys_v['aid'] = $aid_new;
                                    $zufangSystemData[] = $sys_v;
                                }
                                foreach ($zufangPhotoInfo as $sys_k => $sys_v) {
                                    $sys_v['aid'] = $aid_new;
                                    $zufangPhotoData[] = $sys_v;
                                }
                            }
                        }

                        // 批量写入内容扩展表
                        if (!empty($contentData)) {
                            Db::name($tableExt)->insertAll($contentData);
                        }
                        // 批量写入图集模型的图片表
                        if ('images' == $channeltypeRow['nid']) {
                            !empty($imgUploadData) && model('ImagesUpload')->saveAll($imgUploadData);
                        } else if ('xinfang' == $channeltypeRow['nid']) {
                            // 楼盘中间表
                            !empty($xinfangSystemData) && Db::name('xinfang_system')->insertAll($xinfangSystemData);
                            // 户型图
                            !empty($xinfangHuxingData) && Db::name('xinfang_huxing')->insertAll($xinfangHuxingData);
                            // 相册
                            !empty($xinfangPhotoData) && Db::name('xinfang_photo')->insertAll($xinfangPhotoData);
                            // 价格走势
                            !empty($xinfangPriceData) && Db::name('xinfang_price')->insertAll($xinfangPriceData);
                        }else if ('xiaoqu' == $channeltypeRow['nid']){
                            // 中间表
                            !empty($xiaoquSystemData) && Db::name('xiaoqu_system')->insertAll($xiaoquSystemData);
                            // 相册
                            !empty($xiaoquPhotoData) && Db::name('xiaoqu_photo')->insertAll($xiaoquPhotoData);
                        }else if('ershou' == $channeltypeRow['nid']){
                            // 中间表
                            !empty($ershouSystemData) && Db::name('ershou_system')->insertAll($ershouSystemData);
                            // 相册
                            !empty($ershouPhotoData) && Db::name('ershou_photo')->insertAll($ershouPhotoData);
                        }else if('zufang' == $channeltypeRow['nid']){
                            // 中间表
                            !empty($zufangSystemData) && Db::name('zufang_system')->insertAll($zufangSystemData);
                            // 相册
                            !empty($zufangPhotoData) && Db::name('zufang_photo')->insertAll($zufangPhotoData);
                        }
                    }
                    else {
                        $this->error('复制失败！');
                    }
                }
            }
            $this->success('复制成功！');
        } else {
            $this->error('模型不存在！');
        }
    }

    /**
     * 获取文档模板文件列表
     */
    public function getTemplateList($nid = 'article')
    {
        $tpl_theme = config('ey_config.system_tpl_theme');
        $planPath = "template/{$tpl_theme}/pc";
        $dirRes   = opendir($planPath);
        $view_suffix = config('template.view_suffix');

        /*模板PC目录文件列表*/
        $templateArr = array();
        while($filename = readdir($dirRes))
        {
            if (in_array($filename, array('.','..'))) {
                continue;
            }
            array_push($templateArr, $filename);
        }
        /*--end*/

        $templateList = array();
        foreach ($templateArr as $k2 => $v2) {
            $v2 = iconv('GB2312', 'UTF-8', $v2);
            preg_match('/^(view)_'.$nid.'(_(.*))?\.'.$view_suffix.'/i', $v2, $matches1);
            if (!empty($matches1)) {
                if ('view' == $matches1[1]) {
                    array_push($templateList, $v2);
                }
            }
        }

        return $templateList;
    }
}
