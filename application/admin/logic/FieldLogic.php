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
 * 字段逻辑定义
 * Class CatsLogic
 * @package admin\Logic
 */
class FieldLogic extends Model
{
    /**
     * 获得字段创建信息
     *
     * @access    public
     * @param     string  $dtype  字段类型
     * @param     string  $fieldname  字段名称
     * @param     string  $dfvalue  默认值
     * @param     string  $fieldtitle  字段标题
     * @return    array
     */
    function GetFieldMake($dtype, $fieldname, $dfvalue, $fieldtitle)
    {
        $fields = array();
        if("int" == $dtype)
        {
            $default_sql = '';
            if(preg_match("/^\d+$/",$dfvalue) )
            {
                $default_sql = "DEFAULT '$dfvalue'";
            }else{
                $default_sql = "DEFAULT '0'";
                $dfvalue = 0;
            }
            $maxlen = 10;
            $fields[0] = " `$fieldname` int($maxlen) NOT NULL $default_sql COMMENT '$fieldtitle';";
            $fields[1] = "int($maxlen)";
            $fields[2] = $maxlen;
            $fields[3] = $dfvalue;
        }
        else if("datetime" == $dtype)
        {
            $default_sql = '';
            if(preg_match("#[0-9\-]#", $dfvalue))
            {
                $dfvalue = strtotime($dfvalue);
                empty($dfvalue) && $dfvalue = 0;
                $default_sql = "DEFAULT '$dfvalue'";
            }else{
                $dfvalue = "0";
            }
            $maxlen = 11;
            $fields[0] = " `$fieldname` int($maxlen) NOT NULL $default_sql COMMENT '$fieldtitle';";
            $fields[1] = "int($maxlen)";
            $fields[2] = $maxlen;
            $fields[3] = $dfvalue;
        }
        else if("switch" == $dtype)
        {
            if(empty($dfvalue) || preg_match("#[^0-9]#", $dfvalue))
            {
                $dfvalue = 1;
            }else{
                $dfvalue = 0;
            }
            $maxlen = 1;
            $fields[0] = " `$fieldname` tinyint($maxlen) NOT NULL DEFAULT '$dfvalue' COMMENT '$fieldtitle';";
            $fields[1] = "tinyint($maxlen)";
            $fields[2] = $maxlen;
            $fields[3] = $dfvalue;
        }
        else if("float" == $dtype)
        {
            $default_sql = '';
            if(preg_match("/^\d+\.*\d*$/", $dfvalue))
            {
                $default_sql = "DEFAULT '$dfvalue'";
            }else{
                $default_sql = "DEFAULT '0.00'";
                $dfvalue = "0.00";
            }
            $maxlen = 9;
            $fields[0] = " `$fieldname` float($maxlen,2) NOT NULL $default_sql COMMENT '$fieldtitle';";
            $fields[1] = "float($maxlen,2)";
            $fields[2] = $maxlen;
            $fields[3] = $dfvalue;
        }
        else if("decimal" == $dtype)
        {
            $default_sql = '';
            if(preg_match("/^\d+\.*\d*$/", $dfvalue))
            {
                $default_sql = "DEFAULT '$dfvalue'";
            }else{
                $default_sql = "DEFAULT '0.00'";
                $dfvalue = "0.00";
            }
            $maxlen = 10;
            $fields[0] = " `$fieldname` decimal($maxlen,2) NOT NULL $default_sql COMMENT '$fieldtitle';";
            $fields[1] = "decimal($maxlen,2)";
            $fields[2] = $maxlen;
            $fields[3] = $dfvalue;
        }
        else if("img" == $dtype)
        {
            if(empty($dfvalue)) {
                $dfvalue = '';
            }
            $maxlen = 250;
            $fields[0] = " `$fieldname` varchar($maxlen) NOT NULL DEFAULT '$dfvalue' COMMENT '$fieldtitle';";
            $fields[1] = "varchar($maxlen)";
            $fields[2] = $maxlen;
            $fields[3] = $dfvalue;
        }
        else if("imgs" == $dtype)
        {
            if(empty($dfvalue)) {
                $dfvalue = '';
            }
            $maxlen = 10001;
            $fields[0] = " `$fieldname` varchar($maxlen) NOT NULL DEFAULT '$dfvalue' COMMENT '$fieldtitle';";
            $fields[1] = "varchar($maxlen)";
            $fields[2] = $maxlen;
            $fields[3] = $dfvalue;
        }
        else if("files" == $dtype)
        {
            if(empty($dfvalue)) {
                $dfvalue = '';
            }
            $maxlen = 10002;
            $fields[0] = " `$fieldname` varchar($maxlen) NOT NULL DEFAULT '$dfvalue' COMMENT '$fieldtitle';";
            $fields[1] = "varchar($maxlen)";
            $fields[2] = $maxlen;
            $fields[3] = $dfvalue;
        }
        else if("multitext" == $dtype)
        {
            $maxlen = 0;
            $fields[0] = " `$fieldname` text NOT NULL COMMENT '$fieldtitle';";
            $fields[1] = "text";
            $fields[2] = $maxlen;
            $fields[3] = $dfvalue;
        }
        else if("htmltext" == $dtype)
        {
            $maxlen = 0;
            $fields[0] = " `$fieldname` longtext NULL COMMENT '$fieldtitle';";
            $fields[1] = "longtext";
            $fields[2] = $maxlen;
            $fields[3] = $dfvalue;
        }
        else if("checkbox" == $dtype)
        {
            $maxlen = 0;
            $dfvalueArr = explode(',', $dfvalue);
            $default_value = isset($dfvalueArr[0]) ? $dfvalueArr[0] : '';
            $dfvalue = str_replace(',', "','", $dfvalue);
            $dfvalue = "'".$dfvalue."'";
            $fields[0] = " `$fieldname` SET($dfvalue) NULL DEFAULT '' COMMENT '$fieldtitle';";
//            $fields[0] = " `$fieldname` SET($dfvalue) NOT NULL DEFAULT '{$default_value}' COMMENT '$fieldtitle';";
            $fields[1] = "SET($dfvalue)";
            $fields[2] = $maxlen;
            $fields[3] = $default_value;
        }
        else if("select" == $dtype || "radio" == $dtype)
        {
            $maxlen = 0;
            $dfvalueArr = explode(',', $dfvalue);
            $default_value = isset($dfvalueArr[0]) ? $dfvalueArr[0] : '';
            $dfvalue = str_replace(',', "','", $dfvalue);
            $dfvalue = "'".$dfvalue."',''";
            $fields[0] = " `$fieldname` enum($dfvalue) NOT NULL DEFAULT '{$default_value}' COMMENT '$fieldtitle';";
            $fields[1] = "enum($dfvalue)";
            $fields[2] = $maxlen;
            $fields[3] = $default_value;
        }
        else if("region_db" == $dtype)
        {
            $default_sql = "DEFAULT '0'";
            $maxlen = 10;
            $fields[0] = " `$fieldname` int($maxlen) NOT NULL $default_sql COMMENT '$fieldtitle';";
            $fields[1] = "int($maxlen)";
            $fields[2] = $maxlen;
            $fields[3] = 0;
        }
        else
        {
            if(empty($dfvalue))
            {
                $dfvalue = '';
            }
            $maxlen = 200;
            $fields[0] = " `$fieldname` varchar($maxlen) NOT NULL DEFAULT '$dfvalue' COMMENT '$fieldtitle';";
            $fields[1] = "varchar($maxlen)";
            $fields[2] = $maxlen;
            $fields[3] = $dfvalue;
        }

        return $fields;
    }

    /**
     * 检测频道模型相关的表字段是否已存在，包括：主表和附加表
     *
     * @access    public
     * @param     string  $slave_table  附加表
     * @return    string $fieldname 字段名
     * @return    int $channel_id 模型ID
     * @param     array  $filter  过滤哪些字段
     */

    public function checkChannelFieldList($slave_table, $fieldname, $channel_id, $filter = array())
    {
        // 栏目表字段
        $arctypeFieldArr = Db::getTableFields(PREFIX.'arctype'); 
        foreach ($arctypeFieldArr as $key => $val) {
            if (!preg_match('/^type/i',$val)) {
                array_push($arctypeFieldArr, 'type'.$val);
            }
        }
        $masterFieldArr = Db::getTableFields(PREFIX.'archives'); // 文档主表字段
        $slaveFieldArr = Db::getTableFields($slave_table); // 文档附加表字段
        $addfields = ['pageurl','has_children','typelitpic','arcurl','typeurl']; // 额外与字段冲突的变量名
        $fieldArr = array_merge($slaveFieldArr, $masterFieldArr, $addfields, $arctypeFieldArr); // 合并字段
         if (!empty($fieldname)) {
            if (!empty($filter) && is_array($filter)) {
                foreach ($filter as $key => $val) {
                    $k = array_search($val, $fieldArr);
                    if (false !== $k) {
                        unset($fieldArr[$k]);
                    }
                }
            }
            return in_array($fieldname, $fieldArr);
        }

        return true;
    }

    /**
     * 检测指定表的字段是否已存在
     *
     * @access    public
     * @param     string  $table  数据表
     * @return    string $fieldname 字段名
     * @param     array  $filter  过滤哪些字段
     */
    public function checkTableFieldList($table, $fieldname, $filter = array())
    {
        $fieldArr = Db::getTableFields($table); // 表字段
        if (!empty($fieldname)) {
            if (!empty($filter) && is_array($filter)) {
                foreach ($filter as $key => $val) {
                    $k = array_search($val, $fieldArr);
                    if (false !== $k) {
                        unset($fieldArr[$k]);
                    }
                }
            }
            return in_array($fieldname, $fieldArr);
        }

        return true;
    }

    /**
     * 删除指定模型的表字段
     * @param int $id channelfield表ID
     * @return bool
     */
    public function delChannelField($id)
    {
        $code = 0;
        $msg = '参数有误！';
        if (!empty($id)) {
            $id = intval($id);
            $row = model('Channelfield')->getInfo($id, 'channel_id,name,ifsystem');
            if (!empty($row['ifsystem'])) {
                return array('code'=>0, 'msg'=>'禁止删除系统字段！');
            }
            $fieldname = $row['name'];
            $channel_id = $row['channel_id'];
            $table = M('channeltype')->where('id',$channel_id)->getField('table');
            $table = PREFIX.$table.'_content';
            if ($this->checkChannelFieldList($table, $fieldname, $channel_id)) {
                $sql = "ALTER TABLE `{$table}` DROP COLUMN `{$fieldname}`;";
                if(false !== Db::execute($sql)) {
                    /*重新生成数据表字段缓存文件*/
                    try {
                        schemaTable($table);
                    } catch (\Exception $e) {}
                    /*--end*/
                    return array('code'=>1, 'msg'=>'删除成功！');
                } else {
                    $code = 0;
                    $msg = '删除失败！'; 
                }
            } else {
                $code = 2;
                $msg = '字段不存在！';
            }
        }

        return array('code'=>$code, 'msg'=>$msg);
    }

    /**
     * 删除栏目的表字段
     * @param int $id channelfield表ID
     * @return bool
     */
    public function delArctypeField($id)
    {
        $code = 0;
        $msg = '参数有误！';
        if (!empty($id)) {
            $id = intval($id);
            $row = model('Channelfield')->getInfo($id, 'name,ifsystem');
            if (!empty($row['ifsystem'])) {
                return array('code'=>0, 'msg'=>'禁止删除系统字段！');
            }
            $fieldname = $row['name'];
            $table = PREFIX.'arctype';
            if ($this->checkTableFieldList($table, $fieldname)) {
                $sql = "ALTER TABLE `{$table}` DROP COLUMN `{$fieldname}`;";
                if(false !== Db::execute($sql)) {
                    /*重新生成数据表字段缓存文件*/
                    try {
                        schemaTable($table);
                    } catch (\Exception $e) {}
                    /*--end*/
                    return array('code'=>1, 'msg'=>'删除成功！');
                } else {
                    $code = 0;
                    $msg = '删除失败！'; 
                }
            } else {
                $code = 2;
                $msg = '字段不存在！';
            }
        }

        return array('code'=>$code, 'msg'=>$msg);
    }

    /**
     * 同步模型附加表的字段记录
     * @author 小虎哥 by 2018-4-16
     * $channel_id     channelid
     * $channel_name   nid
     */
    public function synChannelTableColumns($channel_id,$channel_name = '')
    {
        $where = [];
        if (!empty($channel_id)){
            $where['id'] = $channel_id;
        }
        if (!empty($channel_name)){
            $where['nid'] = strtolower($channel_name);
        }
        if (empty($where)){
            return false;
        }
        $channeltypeInfo = M('channeltype')->field('id,table,nid,ctl_name')->where($where)->find();
        if (empty($channeltypeInfo)){
            return false;
        }
        $channelfieldArr = M('channelfield')->field('name,dtype')->where('channel_id',$channeltypeInfo['id'])->getAllWithIndex('name');
        $this->synArchivesTableColumns($channeltypeInfo['id'],$channelfieldArr);  //主表
        $this->synContentTableColumns($channeltypeInfo['id'],$channelfieldArr,$channeltypeInfo);  //content表
        $this->synSystemTableColumns($channeltypeInfo['id'],$channelfieldArr,$channeltypeInfo);  //system表


        \think\Cache::clear('channelfield');
    }
    /*
     * 同步system表字段记录到指定模型
     */
    private function synSystemTableColumns($channel_id,$channelfieldArr,$channeltypeInfo){
        $systemArr = ['Xinfang','Xiaoqu','Ershou','Zufang','Shopcs','Shopcz','Officecs','Officecz','Qiuzu'];     //存在system表的模型
        if (empty($channeltypeInfo['ctl_name']) || !in_array($channeltypeInfo['ctl_name'],$systemArr)){
            return false;
        }
        $tableExt = PREFIX.$channeltypeInfo['table'].'_system';
        $rowExt = Db::query("SHOW FULL COLUMNS FROM {$tableExt}");
        $new_arr = array(); // 表字段数组
        $addData = array(); // 数据存储变量
        foreach ($rowExt as $key => $val) {
            $fieldname = $val['Field'];
            if (in_array($fieldname, array('id','add_time','update_time','aid'))) {
                continue;
            }
            $new_arr[] = $fieldname;
            // 对比字段记录 表字段有 字段新增记录没有
            if (empty($channelfieldArr[$fieldname])) {
                $dtype = $this->toDtype($val['Type']);
                $dfvalue = $this->toDefault($val['Type'], $val['Default']);

                $maxlength = preg_replace('/^([^\(]+)\(([^\)]+)\)(.*)/i', '$2', $val['Type']);
                $maxlength = intval($maxlength);
                $addData[] = array(
                    'name'  => $fieldname,
                    'channel_id'  => $channel_id,
                    'title'  => !empty($val['Comment']) ? $val['Comment'] : $fieldname,
                    'dtype' => $dtype,
                    'define'    => $val['Type'],
                    'maxlength' => $maxlength,
                    'dfvalue'   => $dfvalue,
                    'ifeditable'    => 1,
                    'ifsystem'  => 1,
                    'ifmain'    => 2,
                    'ifcontrol' => 0,
                    'add_time'  => getTime(),
                    'update_time'  => getTime(),
                );
            }
        }
        if (!empty($addData)) {
            M('channelfield')->insertAll($addData);
        }

        /*字段新增记录有，表字段没有*/
        foreach($channelfieldArr as $k => $v){
            if (!in_array($k, $new_arr)) {
                $map = array(
                    'channel_id'    => $channel_id,
                    'ifmain'    => 2,
                    'name'  => $v['name'],
                );
                M('channelfield')->where($map)->delete();
            }
        }
    }
    /*
     * 同步content表字段记录到指定模型
     */
    private function synContentTableColumns($channel_id,$channelfieldArr,$channeltypeInfo){
        if (empty($channeltypeInfo['table'])){
            return false;
        }
        $tableExt = PREFIX.$channeltypeInfo['table'].'_content';
        $rowExt = Db::query("SHOW FULL COLUMNS FROM {$tableExt}");

        $new_arr = array(); // 表字段数组
        $addData = array(); // 数据存储变量
        $ifsystem = 1;
        foreach ($rowExt as $key => $val) {
            $fieldname = $val['Field'];
            if (in_array($fieldname, array('id','add_time','update_time','aid','typeid'))) {
                continue;
            }
            $new_arr[] = $fieldname;
            // 对比字段记录 表字段有 字段新增记录没有
            if (empty($channelfieldArr[$fieldname])) {
                $dtype = $this->toDtype($val['Type']);
                $dfvalue = $this->toDefault($val['Type'], $val['Default']);
//                if (in_array($fieldname, array('content'))) {
//                    $ifsystem = 1;
//                } else {
//                    $ifsystem = 0;
//                }
                $maxlength = preg_replace('/^([^\(]+)\(([^\)]+)\)(.*)/i', '$2', $val['Type']);
                $maxlength = intval($maxlength);
                $addData[] = array(
                    'name'  => $fieldname,
                    'channel_id'  => $channel_id,
                    'title'  => !empty($val['Comment']) ? $val['Comment'] : $fieldname,
                    'dtype' => $dtype,
                    'define'    => $val['Type'],
                    'maxlength' => $maxlength,
                    'dfvalue'   => $dfvalue,
                    'ifeditable'    => 1,
                    'ifsystem'  => $ifsystem,
                    'ifmain'    => 0,
                    'ifcontrol' => 0,
                    'add_time'  => getTime(),
                    'update_time'  => getTime(),
                );
            }
        }
        if (!empty($addData)) {
            M('channelfield')->insertAll($addData);
        }

        /*字段新增记录有，表字段没有*/
        foreach($channelfieldArr as $k => $v){
            if (!in_array($k, $new_arr)) {
                $map = array(
                    'channel_id'    => $channel_id,
                    'ifmain'    => $ifsystem,
                    'name'  => $v['name'],
                );
                M('channelfield')->where($map)->delete();
            }
        }
    }
    /**
     * 同步文档主表的字段记录到指定模型
     * @author 小虎哥 by 2018-4-16
     */
    public function synArchivesTableColumns($channel_id = '',$channelfieldArr)
    {
        $new_arr = array(); // 表字段数组
        $addData = array(); // 数据存储变量

        $controlFields = ['litpic','author'];
        $channeltype_system_ids = Db::name('channeltype')->where([
                'ifsystem'  => 1,
            ])->column('id');

        $table = PREFIX.'archives';
        $row = Db::query("SHOW FULL COLUMNS FROM {$table}");
        $row = array_reverse($row);
        foreach ($row as $key => $val) {
            $fieldname = $val['Field'];
            $new_arr[] = $fieldname;
            // 对比字段记录 表字段有 字段新增记录没有
            if (empty($channelfieldArr[$fieldname])) {
                $dtype = $this->toDtype($val['Type']);
                $dfvalue = $this->toDefault($val['Type'], $val['Default']);
                if (in_array($fieldname, $controlFields) && !in_array($channel_id, $channeltype_system_ids)) {
                    $ifcontrol = 0;
                } else {
                    $ifcontrol = 1;
                }
                $maxlength = preg_replace('/^([^\(]+)\(([^\)]+)\)(.*)/i', '$2', $val['Type']);
                $maxlength = intval($maxlength);
                $addData[] = array(
                    'name'  => $fieldname,
                    'channel_id'  => $channel_id,
                    'title'  => !empty($val['Comment']) ? $val['Comment'] : $fieldname,
                    'dtype' => $dtype,
                    'define'    => $val['Type'],
                    'maxlength' => $maxlength,
                    'dfvalue'   => $dfvalue,
                    'ifeditable'    => 1,
                    'ifsystem' => 1,
                    'ifmain'    => 1,
                    'ifcontrol' => $ifcontrol,
                    'add_time'  => getTime(),
                    'update_time'  => getTime(),
                );
            }
        }
        if (!empty($addData)) {
            M('channelfield')->insertAll($addData);
        }

        /*字段新增记录有，表字段没有*/
        foreach($channelfieldArr as $k => $v){
            if (!in_array($k, $new_arr)) {
                $map = array(
                    'channel_id'  => $channel_id,
                    'ifmain'    => 1,
                    'name'  => $v['name'],
                );
                M('channelfield')->where($map)->delete();
            }
        }
        /*--end*/
    }

    /**
     * 同步栏目主表的字段记录
     * @author 小虎哥 by 2018-4-16
     */
    public function synArctypeTableColumns($channel_id = '')
    {
        $cacheKey = "admin-FieldLogic-synArctypeTableColumns-{$channel_id}";
        $cacheValue = cache($cacheKey);
        if (!empty($cacheValue)) {
            return true;
        }

        $channel_id = !empty($channel_id) ? $channel_id : config('global.arctype_channel_id');
        $channelfieldArr = M('channelfield')->field('name,dtype')->where('channel_id',$channel_id)->getAllWithIndex('name');

        $new_arr = array(); // 表字段数组
        $addData = array(); // 数据存储变量

        $table = PREFIX.'arctype';
        $row = Db::query("SHOW FULL COLUMNS FROM {$table}");
        $row = array_reverse($row);
        $arctypeTableFields = config('global.arctype_table_fields');
        foreach ($row as $key => $val) {
            $fieldname = $val['Field'];
            $new_arr[] = $fieldname;
            // 对比字段记录 表字段有 字段新增记录没有
            if (empty($channelfieldArr[$fieldname])) {
                $dtype = $this->toDtype($val['Type']);
                $dfvalue = $this->toDefault($val['Type'], $val['Default']);
                if (in_array($fieldname, $arctypeTableFields)) {
                    $ifsystem = 1;
                } else {
                    $ifsystem = 0;
                }
                $maxlength = preg_replace('/^([^\(]+)\(([^\)]+)\)(.*)/i', '$2', $val['Type']);
                $maxlength = intval($maxlength);
                $addData[] = array(
                    'name'  => $fieldname,
                    'channel_id'  => $channel_id,
                    'title'  => !empty($val['Comment']) ? $val['Comment'] : $fieldname,
                    'dtype' => $dtype,
                    'define'    => $val['Type'],
                    'maxlength' => $maxlength,
                    'dfvalue'   => $dfvalue,
                    'ifeditable'    => 1,
                    'ifsystem' => $ifsystem,
                    'ifmain'    => 1,
                    'ifcontrol' => 1,
                    'add_time'  => getTime(),
                    'update_time'  => getTime(),
                );
            }
        }
        if (!empty($addData)) {
            M('channelfield')->insertAll($addData);
        }

        /*字段新增记录有，表字段没有*/
        foreach($channelfieldArr as $k => $v){
            if (!in_array($k, $new_arr)) {
                $map = array(
                    'channel_id'  => $channel_id,
                    'name'  => $v['name'],
                );
                M('channelfield')->where($map)->delete();
            }
        }
        /*--end*/

        \think\Cache::clear('channelfield');
        \think\Cache::clear("arctype");

        cache($cacheKey, 1, null, 'channelfield');
    }

    /**
     * 表字段类型转为自定义字段类型
     * @author 小虎哥 by 2018-4-16
     */
    public function toDtype($fieldtype = '')
    {
        if (preg_match('/^int/i', $fieldtype)) {
            $maxlen = preg_replace('/^int\((.*)\)/i', '$1', $fieldtype);
            if (10 == $maxlen) {
                $dtype = 'int';
            } else if (11 == $maxlen) {
                $dtype = 'datetime';
            }
        } else if (preg_match('/^longtext/i', $fieldtype)) {
            $dtype = 'htmltext';
        } else if (preg_match('/^text/i', $fieldtype)) {
            $dtype = 'multitext';
        } else if (preg_match('/^enum/i', $fieldtype)) {
            $dtype = 'select';
        } else if (preg_match('/^set/i', $fieldtype)) {
            $dtype = 'checkbox';
        } else if (preg_match('/^float/i', $fieldtype)) {
            $dtype = 'float';
        } else if (preg_match('/^decimal/i', $fieldtype)) {
            $dtype = 'decimal';
        } else if (preg_match('/^tinyint/i', $fieldtype)) {
            $dtype = 'switch';
        } else if (preg_match('/^varchar/i', $fieldtype)) {
            $maxlen = preg_replace('/^varchar\((.*)\)/i', '$1', $fieldtype);
            if (250 == $maxlen) {
                $dtype = 'img';
            } else if (1001 == $maxlen || 10001 == $maxlen) {
                $dtype = 'imgs';
            } else if (1002 == $maxlen || 10002 == $maxlen) {
                $dtype = 'files';
            } else {
                $dtype = 'text';
            }
        } else {
            $dtype = 'text';
        }

        return $dtype;
    }

    /**
     * 表字段的默认值
     * @author 小虎哥 by 2018-4-16
     */
    public function toDefault($fieldtype, $dfvalue = '')
    {
        if (preg_match('/^(enum|set)/i', $fieldtype)) {
            $str = preg_replace('/^(enum|set)\((.*)\)/i', '$2', $fieldtype);
            $str = str_replace("'", "", $str);
        } else {
            $str = $dfvalue;
        }
        $str = ("" != $str) ? $str : '';

        return $str;
    }

    /**
     * 处理栏目自定义字段的值
     * @author 小虎哥 by 2018-4-16
     */
    public function handleAddonField($channel_id, $dataExt)
    {
        $nowDataExt = array();
        if (!empty($dataExt) && !empty($channel_id)) {
            $fieldTypeList = model('Channelfield')->getListByWhere(array('channel_id'=>$channel_id), 'name,dtype', 'name');
            foreach ($dataExt as $key => $val) {
                
                $key = preg_replace('/^(.*)(_eyou_is_remote|_eyou_remote|_eyou_local)$/', '$1', $key);
                $dtype = !empty($fieldTypeList[$key]) ? $fieldTypeList[$key]['dtype'] : '';
                switch ($dtype) {

                    case 'checkbox':
                    {
                        $val = implode(',', $val);
                        break;
                    }

                    case 'switch':
                    case 'int':
                    {
                        $val = intval($val);
                        break;
                    }

                    case 'img':
                    {
                        $is_remote = !empty($dataExt[$key.'_eyou_is_remote']) ? $dataExt[$key.'_eyou_is_remote'] : 0;
                        if (1 == $is_remote) {
                            $val = $dataExt[$key.'_eyou_remote'];
                        } else {
                            $val = $dataExt[$key.'_eyou_local'];
                        }
                        break;
                    }

                    case 'imgs':
                    case 'files':
                    {
                        foreach ($val as $k2 => $v2) {
                            if (empty($v2)) {
                                unset($val[$k2]);
                                continue;
                            }
                            $val[$k2] = trim($v2);
                        }
                        $val = implode(',', $val);
                        break;
                    }

                    case 'datetime':
                    {
                        $val = !empty($val) ? strtotime($val) : getTime();
                        break;
                    }

                    case 'decimal':
                    {
                        $moneyArr = explode('.', $val);
                        $money1 = !empty($moneyArr[0]) ? intval($moneyArr[0]) : '0';
                        $money2 = !empty($moneyArr[1]) ? intval(msubstr($moneyArr[1], 0, 2)) : '00';
                        $val = $money1.'.'.$money2;
                        break;
                    }
                    
                    default:
                    {
                        $val = trim($val);
                        break;
                    }
                }
                $nowDataExt[$key] = $val;
            }
        }

        return $nowDataExt;
    }
    /*
     * 更新 eju_channelfield 表 dfvalue_unit、remark字段
     */
    public function synChannelUnit(){
        M('channelfield')->where("name='average_price' and ifsystem=1 and channel_id>10")->save(['dfvalue_unit'=>'元/㎡']);
        M('channelfield')->where("name='building_age' and ifsystem=1 and channel_id>10")->save(['dfvalue_unit'=>'年']);
        M('channelfield')->where("name='area' and ifsystem=1 and channel_id>10")->save(['dfvalue_unit'=>'㎡']);
        M('channelfield')->where("name='building_area' and ifsystem=1 and channel_id>10")->save(['dfvalue_unit'=>'㎡']);
        M('channelfield')->where("name='floor_area' and ifsystem=1 and channel_id>10")->save(['dfvalue_unit'=>'㎡']);
        M('channelfield')->where("name='floor_count' and ifsystem=1 and channel_id>10")->save(['dfvalue_unit'=>'层']);
        M('channelfield')->where("name='floor_count' and ifsystem=1 and channel_id>10")->save(['dfvalue_unit'=>'层']);
        M('channelfield')->where("name='property' and ifsystem=1 and channel_id>10")->save(['dfvalue_unit'=>'年']);
        M('channelfield')->where("name='total_price' and ifsystem=1 and channel_id>10")->save(['dfvalue_unit'=>'万元']);
        M('channelfield')->where("name='province_id' and ifsystem=1 and channel_id>10")->save(['is_screening'=>'1','dtype'=>'region_db','sort_order'=>'-3']);
        M('channelfield')->where("name='city_id' and ifsystem=1 and channel_id>10")->save(['is_screening'=>'1','dtype'=>'region_db','dfvalue'=>'province_id','sort_order'=>'-2']);
        M('channelfield')->where("name='area_id' and ifsystem=1 and channel_id>10")->save(['is_screening'=>'1','dtype'=>'region_db','dfvalue'=>'city_id','sort_order'=>'-1']);
    }
    public function synChannelUnit20(){
        M('channelfield')->where("name='panoram' or name='video'")->save(['ifsystem'=>'1']);
    }
    public function synAreaChannelUnit(){
        M('channelfield')->where("name='province_id'")->save(['dtype'=>'region_db','define'=>'int(10)','is_screening'=>1,'sort_order'=>'-3','short_name'=>'pv']);
        M('channelfield')->where("name='city_id'")->save(['dtype'=>'region_db','define'=>'int(10)','is_screening'=>1,'sort_order'=>'-2','dfvalue'=>'province_id','short_name'=>'ct']);
        M('channelfield')->where("name='area_id'")->save(['dtype'=>'region_db','define'=>'int(10)','is_screening'=>1,'sort_order'=>'-1','dfvalue'=>'city_id','short_name'=>'ar']);
    }
    //检查用于筛选的字段简称是否合法
    public function checkChannelShortName($custom_route,$short_name,$name,$id = 0){
        if (!empty($custom_route['schema']) && $custom_route['schema'] == 2){

        }
        $where['short_name'] = ['eq',$short_name];
        $where['name'] = ['neq',$name];
        if ($id){
            $where['id'] = ['neq',$id];
        }
        $have = Db::name("channelfield")->where($where)->find();
        if ($have){
            return true;
        }

        return false;
    }
    //同步更新同name字段到sort_name、清空（重置）global_get_route_field_list缓存
    public function snyChannelShortName($short_name,$name){
        Db::name("channelfield")->where(['name'=>['eq',$name]])->setField(['short_name'=>$short_name]);
        extra_cache('global_get_route_field_list', null);
    }
}
