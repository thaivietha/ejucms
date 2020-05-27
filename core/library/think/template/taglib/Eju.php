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

namespace think\template\taglib;

use think\template\TagLib;

/**
 * eju标签库解析类
 * @category   Think
 * @package  Think
 * @subpackage  Driver.Taglib
 * @author    小虎哥 <1105415366@qq.com>
 */
class Eju extends Taglib
{
    // 标签定义
    protected $tags = [
        // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        'php'        => ['attr' => ''],
        'channel'    => ['attr' => 'typeid,notypeid,reid,type,row,currentstyle,id,name,key,empty,mod,titlelen,offset,limit,hidden'],
        'channelartlist' => ['attr' => 'typeid,type,row,id,key,empty,titlelen,mod'],
        'arclist'    => ['attr' => 'users_id,channelid,typeid,notypeid,row,offset,titlelen,limit,orderby,orderway,noflag,flag,infolen,empty,mod,name,id,key,addfields,tagid,pagesize,thumb,joinaid,province,city,area,screen,addwhere,map,mapkey,relate,re_area,re_xiaoqu'],
        'arcpagelist'=> ['attr' => 'tagid,pagesize,id,tips,loading,callback'],
        'list'       => ['attr' => 'users_id,channelid,typeid,notypeid,pagesize,titlelen,orderby,orderway,noflag,flag,infolen,empty,mod,id,key,addfields,thumb,joinaid,relate,re_area,re_xiaoqu'],
        'pagelist'   => ['attr' => 'listitem,listsize', 'close' => 0],
        'countlist'   => ['attr' => '', 'close' => 0],
        'position'   => ['attr' => 'symbol,style', 'close' => 0],
        'type'       => ['attr' => 'typeid,type,empty,dirname,id,addfields,addtable'],
        'arcview'    => ['attr' => 'aid,empty,id,fields,addfields,huxing,photo,price'],
        'arcclick'   => ['attr' => '', 'close' => 0],
        'load'       => ['attr' => 'file,href,type,value,basepath', 'close' => 0, 'alias' => ['import,css,js', 'type']],
        'assign'     => ['attr' => 'name,value', 'close' => 0],
        'empty'      => ['attr' => 'name'],
        'notempty'   => ['attr' => 'name'],
        'foreach'    => ['attr' => 'name,id,item,key,offset,length,mod', 'expression' => true],
        'volist'     => ['attr' => 'name,id,offset,length,key,mod,limit,row', 'alias' => 'iterate'],
        'if'         => ['attr' => 'condition', 'expression' => true],
        'elseif'     => ['attr' => 'condition', 'close' => 0, 'expression' => true],
        'else'       => ['attr' => '', 'close' => 0],
        'switch'     => ['attr' => 'name', 'expression' => true],
        'case'       => ['attr' => 'value,break', 'expression' => true],
        'default'    => ['attr' => '', 'close' => 0],
        'compare'    => ['attr' => 'name,value,type', 'alias' => ['eq,equal,notequal,neq,gt,lt,egt,elt,heq,nheq', 'type']],
        'ad'         => ['attr' => 'aid,id', 'close'=>1], 
        'adv'        => ['attr' => 'pid,row,order,where,id,empty,key,mod,currentstyle', 'close'=>1],  
        'global'     => ['attr' => 'name', 'close' => 0],
        'static'     => ['attr' => 'file,href,code', 'close' => 0], 
        'prenext'    => ['attr' => 'get,titlelen,id,empty'],
        'field'      => ['attr' => 'name,addfields,aid', 'close' => 0], 
        'searchform' => ['attr' => 'channelid,typeid,notypeid,flag,noflag,type,empty,id,mod,key,present', 'close'=>1],
        'tag'        => ['attr' => 'aid,name,row,id,key,mod,typeid,getall,sort,empty,style'],
        'flink'      => ['attr' => 'type,row,id,key,mod,titlelen,empty,limit'],
        'weapp'      => ['attr' => 'type', 'close' => 0], // 网站应用插件
        'range'      => ['attr' => 'name,value,type', 'alias' => ['in,notin,between,notbetween', 'type']],
        'present'    => ['attr' => 'name'],
        'notpresent' => ['attr' => 'name'],
        'defined'    => ['attr' => 'name'],
        'notdefined' => ['attr' => 'name'],
        'define'     => ['attr' => 'name,value', 'close' => 0],
        'for'        => ['attr' => 'start,end,name,comparison,step'],
        'url'        => ['attr' => 'link,vars,suffix,domain', 'close' => 0, 'expression' => true],
        'function'   => ['attr' => 'name,vars,use,call'],
        'diyfield'   => ['attr' => 'name,id,key,mod,type,empty,limit'],
        'attribute'  => ['attr' => 'aid,type,empty,id,mod,key'],
        'attr'       => ['attr' => 'aid,name', 'close' => 0],
        'weapplist'  => ['attr' => 'type,id,key,mod,empty,currentstyle'], // 网站应用插件列表
        // 筛选搜索，region：是否关联区域显示，domain:是否开启二级域名（1：显示同级区域跳转到二级域名首页，0：显示下级区域，跳转到楼盘筛选）
        'screening' => ['attr' => 'empty,id,mod,key,currentstyle,addfields,addfieldids,alltxt,target,region,domain,show,opencity,ajax,present,regionid,typeid,channel'],
        //表单标签
        'inputform'=> ['attr' => 'formid,name,empty,id,success,class'],
        //表单标签
        'form' => ['attr' => 'formid,success,empty,id,mod,key,before,beforeSubmit,is_count,is_list'],
        //子表信息个数标签
        'sonarccount'=>['attr' => 'aid,map,mapkey,table,group,where,map', 'close' => 0],
        //子表信息单条显示
        'sqlview'    => ['attr' => 'aid,map,mapkey,empty,id,table,fields,addwhere'],
        //子表信息标签
        'sqlarclist'=>['attr' => 'currentstyle,id,key,empty,aid,map,mapkey,table,fields,orderby,limit,group,where,mod,addfields,max,min,sum,count,jointable,region,addwhere'],
        //排序标签
        'orderlist' => ['attr' => 'typeid,empty,id,mod,key,currentstyle,upstyle,downstyle,defaultstyle,addfields,addfieldids,alltxt'],
        //价格走势
        'pricetrend' => ['attr' => 'id,key,mod,fields,canvas,month,city,province,area,format,mode,type','close'=>0],
        //周边环境
        'surroundings' => ['attr' => 'id,key,mod,field,canvas,tag,select,total,tab,result'],
        // 区域列表
        'region'    => ['attr' => 'typeid,channel,type,row,currentstyle,id,name,key,empty,mod,titlelen,offset,limit,domain,opencity,orderby,orderway,ishot,groupby,pricetype,province,city,area'],
        //自定义url
        'diyurl'   => ['attr' => 'aid,type,template', 'close' => 0],
        // 楼盘其他表，比如：户型、相册、价格趋势
        'fanglist'        => ['attr' => 'aid,name,row,limit,orderby,orderway,id,empty,key,mod,type,group'],
        //楼盘相关最大最小，比如户型
        'minmax'   => ['attr' =>'currentstyle,id,key,empty,aid,type'],
        //会员登陆状态
        'user'       => ['attr' => 'type,id,currentstyle,img,txt,txtid'],
        //显示关联问答内容
        'ask'   =>['attr' => 'id,key,mod,field,aid,pagesize,answer,bestanswer,answercout,is_recom,status,click,replies,orderby,orderway'],
        //显示关联问答回答列表（针对单个提问）
        'answer'   =>['attr' => 'id,key,mod,field,ask_id,pagesize,orderby,orderway'],
        //显示关联沙盘内容（单楼盘）
        'sand'  =>['attr' => 'id,key,mod,field,aid'],
        //经纪人列表
        'userslist'  => ['attr' => 'pagesize,titlelen,orderby,orderway,noflag,flag,infolen,empty,mod,id,key,thumb,is_saleman,level,is_count'],
        // 导航标签
        'navig' => ['attr' => 'position_id,navigid,notnavigid,type,row,currentstyle,id,name,key,empty,mod,titlelen,offset,limit'],
        //收藏操作标签
        'collect' => ['attr' => 'aid,field,collectid,titleid,styleid,currentstyle,withoutstyle,currenttitle,withouttitle,alert,success'],
        //点评提交标签
        'remark' => ['attr' => 'aid,formid,success,empty,id,beforeSubmit'],
        //点评列表标签
        'remarklist' =>['attr' => 'id,key,mod,field,aid,pagesize,orderby,orderway,usersid'],
        //默认跳转城市
        'regionview'  =>['attr' => 'id,key,mod,field'],
    ];
    /*
     * 点评提交标签
     */
    public function tagRemark($tag, $content)
    {
        $aid    = !empty($tag['aid']) ? $tag['aid'] : '0';
        $formid     = !empty($tag['formid']) ? $tag['formid'] : 'remark_form';
        $success     = !empty($tag['success']) ? $tag['success'] : '';      //提交后执行方法
        $beforeSubmit     = !empty($tag['beforeSubmit']) ? $tag['beforeSubmit'] : '';
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);

        $parseStr = '<?php ';

        // 查询数据库获取的数据集
        $parseStr .= ' $tagRemark = new \think\template\taglib\eju\TagRemark;';
        $parseStr .= ' $_result = $tagRemark->getRemark('.$aid.', "'.$formid.'", "'.$success.'", "'.$beforeSubmit.'");';
        $parseStr .= 'if(!empty($_result)): ';
        $parseStr .= '$' . $id.' = $_result ;?>';
        $parseStr .= $content;
        $parseStr .= '<?php  else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用
        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }
    /*
     * 点评列表标签
     */
    public function tagRemarklist($tag, $content){
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $aid    = !empty($tag['aid']) && is_numeric($tag['aid']) ? intval($tag['aid']) : 0;
        $key    = !empty($tag['key']) ? $tag['key'] : 'i';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $mod    = !empty($tag['mod']) && is_numeric($tag['mod']) ? $tag['mod'] : '2';
        $pagesize = !empty($tag['pagesize']) && is_numeric($tag['pagesize']) ? intval($tag['pagesize']) : 10;
        $orderby    = isset($tag['orderby']) ? $tag['orderby'] : 'add_time';
        $orderway    = isset($tag['orderway']) ? $tag['orderway'] : 'desc';
        $users_id = isset($tag['usersid']) ? $tag['usersid'] : '';      //经纪人id
        $parseStr = '<?php ';
        // 声明变量
        // 查询数据库获取的数据集
        $parseStr .= ' $param = array(';
        $parseStr .= '      "users_id"=> "'.$users_id.'",';
        $parseStr .= ' );';
        // $parseStr .= ' $orderby = "'.$orderby.'";';
        $parseStr .= ' $tagRemarkList = new \think\template\taglib\eju\TagRemarkList;';
        $parseStr .= ' $_result_tmp = $tagRemarkList->getRemarklist($param, '.$aid.','.$pagesize.', "'.$orderby.'", "'.$orderway.'");';


        $parseStr .= 'if(!empty($_result_tmp)): ';
        $parseStr .= ' $__PAGES__ = $_result_tmp["pages"];';
        $parseStr .= ' $__COUNT__ = $_result_tmp["count"];';
        $parseStr .= '$' . $id.' = $_result_tmp ;?>';
        $parseStr .= $content;
        $parseStr .= '<?php  else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }
    /*
     * 经纪人列表模块
     */
    public function tagUserslist($tag, $content){
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $key    = !empty($tag['key']) ? $tag['key'] : 'i';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $mod    = !empty($tag['mod']) && is_numeric($tag['mod']) ? $tag['mod'] : '2';
        $pagesize = !empty($tag['pagesize']) && is_numeric($tag['pagesize']) ? intval($tag['pagesize']) : 10;
        $thumb   = !empty($tag['thumb']) ? $tag['thumb'] : 'on';     //是否使用缩略图
        $orderby    = isset($tag['orderby']) ? $tag['orderby'] : '';
        $orderway    = isset($tag['orderway']) ? $tag['orderway'] : 'desc';
        $flag    = isset($tag['flag']) ? $tag['flag'] : '';     //flag='c' 自定义属性值：推荐[c]跳转[j]
        $noflag    = isset($tag['noflag']) ? $tag['noflag'] : '';
        $titlelen = !empty($tag['titlelen']) && is_numeric($tag['titlelen']) ? intval($tag['titlelen']) : 100;
        $infolen = !empty($tag['infolen']) && is_numeric($tag['infolen']) ? intval($tag['infolen']) : 160;

        $is_saleman = isset($tag['is_saleman']) ? $tag['is_saleman'] : '';      //是否内部经纪人
        $level = isset($tag['level']) ? $tag['level'] : '';   //经纪人级别
        $is_count = isset($tag['is_count']) ? $tag['is_count'] : '';       //获取二手房、租房等数据条数,填写需要统计的channel_id

        $parseStr = '<?php ';
        // 声明变量
        // 查询数据库获取的数据集
        $parseStr .= ' $param = array(';
        $parseStr .= '      "flag"=> "'.$flag.'",';
        $parseStr .= '      "noflag"=> "'.$noflag.'",';
        $parseStr .= '      "is_saleman"=> "'.$is_saleman.'",';
        $parseStr .= '      "level"=> "'.$level.'",';
        $parseStr .= '      "is_count"=> "'.$is_count.'",';
        $parseStr .= ' );';
        // $parseStr .= ' $orderby = "'.$orderby.'";';
        $parseStr .= ' $tagUsersList = new \think\template\taglib\eju\TagUsersList;';
        $parseStr .= ' $_result_tmp = $tagUsersList->getUserslist($param, '.$pagesize.', "'.$orderby.'", "'.$orderway.'", "'.$thumb.'");';

        $parseStr .= 'if(is_array($_result_tmp) || $_result_tmp instanceof \think\Collection || $_result_tmp instanceof \think\Paginator): $' . $key . ' = 0; $e = 1;$k = 0;';
        $parseStr .= ' $__LIST__ = $_result = $_result_tmp["list"];';
        $parseStr .= ' $__PAGES__ = $_result_tmp["pages"];';
        $parseStr .= ' $__COUNT__ = $_result_tmp["count"];';

        $parseStr .= 'if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("' . $empty . '");';
        $parseStr .= 'else: ';
        $parseStr .= 'foreach($__LIST__ as $key=>$' . $id . '): ';
//        $parseStr .= '$aid = $'.$id.'["aid"];';
//        $parseStr .= '$' . $id . '["title"] = text_msubstr($' . $id . '["title"], 0, '.$titlelen.', false);';
//        $parseStr .= '$' . $id . '["seo_description"] = text_msubstr($' . $id . '["seo_description"], 0, '.$infolen.', true);';

        $parseStr .= '$' . $key . '= intval($key) + 1;?>';
        $parseStr .= '<?php $mod = ($' . $key . ' % ' . $mod . ' ); ?>';
        $parseStr .= $content;
        $parseStr .= '<?php ++$e;$k++; ?>';
        $parseStr .= '<?php $aid = 0; ?>';
        $parseStr .= '<?php endforeach; endif; else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }
    /*
     * 问答模块
     * aid  关联楼盘（文档）id
     */
    public function tagAnswer($tag, $content){
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $ask_id     = isset($tag['ask_id']) ? $tag['ask_id'] : '';
        $ask_id  = $this->varOrvalue($ask_id);
        $pagesize = !empty($tag['pagesize']) && is_numeric($tag['pagesize']) ? intval($tag['pagesize']) : 10;   //每页显示提问数

        $orderby    = isset($tag['orderby']) ? $tag['orderby'] : 'a.id';        //排序
        $orderway    = isset($tag['orderway']) ? $tag['orderway'] : 'desc';

        $parseStr = '<?php ';
        // 声明变量
        $parseStr .= ' $tagAnswer = new \think\template\taglib\eju\TagAnswer;';
        $parseStr .= ' $_result_tmp = $tagAnswer->getAnswer('.$ask_id.',"'.$pagesize.'","'.$orderby.'","'.$orderway.'");';
        $parseStr .= 'if(!empty($_result_tmp)): ';
        $parseStr .= ' $__PAGES__ = $_result_tmp["pages"];';
        $parseStr .= ' $__COUNT__ = $_result_tmp["count"];';
        $parseStr .= '$' . $id.' = $_result_tmp ;?>';
        $parseStr .= $content;
        $parseStr .= '<?php  else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }
    /*
     * 沙盘模块
     */
    public function tagSand($tag, $content){
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $aid     = isset($tag['aid']) ? $tag['aid'] : '';
        $aid  = $this->varOrvalue($aid);

        $parseStr = '<?php ';
        // 声明变量
        $parseStr .= ' $tagSand = new \think\template\taglib\eju\TagSand;';
        $parseStr .= ' $_result_tmp = $tagSand->getSand('.$aid.');';
        $parseStr .= 'if(!empty($_result_tmp)): ';
        $parseStr .= '$' . $id.' = $_result_tmp ;?>';
        $parseStr .= $content;
        $parseStr .= '<?php  else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }
    /*
     * 默认二级城市
     */
    public function tagRegionview($tag, $content){
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);

        $parseStr = '<?php ';
        // 声明变量
        $parseStr .= ' $tagRegionview = new \think\template\taglib\eju\TagRegionview;';
        $parseStr .= ' $_result_tmp = $tagRegionview->getRegionview();';
        $parseStr .= 'if(!empty($_result_tmp)): ';
        $parseStr .= '$' . $id.' = $_result_tmp ;?>';
        $parseStr .= $content;
        $parseStr .= '<?php  else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }
    /*
     * 问答模块
     * aid  关联楼盘（文档）id
     *
     */
    public function tagAsk($tag, $content){
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $aid     = isset($tag['aid']) ? $tag['aid'] : '';
        $aid  = $this->varOrvalue($aid);
        $pagesize = !empty($tag['pagesize']) && is_numeric($tag['pagesize']) ? intval($tag['pagesize']) : 10;   //每页显示提问数
        $answer     = !empty($tag['answer']) ? $tag['answer'] : 'on';        //是否获取显示回答
        $bestanswer = !empty($tag['bestanswer']) ? $tag['bestanswer'] : 'on';//是否只获取采纳为最佳答案的回答(默认只显示最佳答案)
        $answercout = !empty($tag['answercout']) ? $tag['answercout'] : '1';//每个问题最多获取回答数量(默认最多显示1条回答)

        $is_recom   = isset($tag['is_recom']) ? $tag['is_recom'] : '';  //1：推荐（推荐问题）
        $is_recom  = $this->varOrvalue($is_recom);
        $status   = isset($tag['status']) ? $tag['status'] : '';  //1：不存在回复（待解决）
        $status  = $this->varOrvalue($status);
        $click   = isset($tag['click']) ? $tag['click'] : '';  //1：存在点击（热门问题）
        $click  = $this->varOrvalue($click);
        $replies   = isset($tag['replies']) ? $tag['replies'] : '';  //1：存在回复（已解决）
        $replies  = $this->varOrvalue($replies);

        $orderby    = isset($tag['orderby']) ? $tag['orderby'] : 'ask_id';        //排序
        $orderway    = isset($tag['orderway']) ? $tag['orderway'] : 'desc';


        $parseStr = '<?php ';
        $parseStr .= ' $param = array(';
        $parseStr .= '      "is_recom"=> '.$is_recom.',';
        $parseStr .= '      "status"=> '.$status.',';
        $parseStr .= '      "click"=> '.$click.',';
        $parseStr .= '      "replies"=> '.$replies;
        $parseStr .= ' );';
        // 声明变量
        $parseStr .= ' $tagAsk = new \think\template\taglib\eju\TagAsk;';
        $parseStr .= ' $_result_tmp = $tagAsk->getAsk($param,'.$aid.',"'.$answer.'","'.$bestanswer.'","'.$answercout.'","'.$pagesize.'","'.$orderby.'","'.$orderway.'");';
        $parseStr .= 'if(!empty($_result_tmp)): ';
        $parseStr .= ' $__PAGES__ = $_result_tmp["pages"];';
        $parseStr .= ' $__COUNT__ = $_result_tmp["count"];';
        $parseStr .= '$' . $id.' = $_result_tmp ;?>';
        $parseStr .= $content;
        $parseStr .= '<?php  else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }
    /**
     * user 标签解析
     * 在模板中获取会员登录入口
     * 格式：
     * {eyou:user type='default'}
     *  <a href="{$field.url}">{$field.username}</a>
     * {/eyou:user}
     * @access public
     * @param array $tag 标签属性
     * @return string
     */
    public function tagUser($tag, $content)
    {
        $type  =  !empty($tag['type']) ? $tag['type'] : 'default';
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $txt  =  !empty($tag['txt']) ? $tag['txt'] : '';
        $txt  = $this->varOrvalue($txt);
        $txtid  =  !empty($tag['txtid']) ? $tag['txtid'] : '';
        $img  =  !empty($tag['img']) ? $tag['img'] : 'off';
        $currentstyle   = !empty($tag['currentstyle']) ? $tag['currentstyle'] : '';

        $parseStr = '<?php ';
        $parseStr .= ' $tagUser = new \think\template\taglib\eju\TagUser;';
        $parseStr .= ' $__LIST__ = $tagUser->getUser("'.$type.'", "'.$img.'", "'.$currentstyle.'", '.$txt.', "'.$txtid.'");';
        $parseStr .= '?>';

        $parseStr .= '<?php if(!empty($__LIST__) || (($__LIST__ instanceof \think\Collection || $__LIST__ instanceof \think\Paginator ) && $__LIST__->isEmpty())): ?>';
        $parseStr .= '<?php $'.$id.' = $__LIST__; ?>';
        $parseStr .= $content;
        $parseStr .= '<?php endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }
    /*
     * minmax 标签解析
     * 获取最大最小
     */
    public function tagMinmax($tag,$content){
        $currentstyle   = !empty($tag['currentstyle']) ? $tag['currentstyle'] : '';
        $id     = isset($tag['id']) ? $tag['id'] : 'vo';
        $key    = !empty($tag['key']) ? $tag['key'] : 'i';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $aid  =  !empty($tag['aid']) ? $tag['aid'] : "0";//查询字段内容
        $aid = $this->varOrvalue($aid);
        $type = !empty($tag['type']) ? $tag['type'] : '';
        $type = $this->varOrvalue($type);
        $mod    = !empty($tag['mod']) && is_numeric($tag['mod']) ? $tag['mod'] : '2';
        $parseStr = '<?php ';
        // 查询数据库获取的数据集
        $parseStr .= ' $tagMinmax = new \think\template\taglib\eju\TagMinmax;';
        $parseStr .= ' $_result = $tagMinmax->getMinmax('.$aid.','.$type.');';
        $parseStr .= ' if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $' . $key . ' = 0; $e = 1;$k=0;';
        // 设置了输出数组长度
        $parseStr .= ' $__LIST__ = $_result;';
        $parseStr .= 'if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("' . $empty . '");';
        $parseStr .= 'else: ';
        $parseStr .= 'foreach($__LIST__ as $key=>$' . $id . '): ';

        $parseStr .= ' if ($' . $key . ' == 0) :';
        $parseStr .= ' $'.$id.'["currentstyle"] = "'.$currentstyle.'";';
        $parseStr .= ' else: ';
        $parseStr .= ' $'.$id.'["currentstyle"] = "";';
        $parseStr .= ' endif;';

        $parseStr .= '$' . $key . '= intval($key) + 1;?>';
        $parseStr .= '<?php $mod = ($' . $key . ' % ' . $mod . ' ); ?>';
        $parseStr .= $content;
        $parseStr .= '<?php ++$e;$k++; ?>';
        $parseStr .= '<?php endforeach; endif; else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用
        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }
    /**
     * diyurl 标签解析
     * 在内容页模板追加显示浏览量
     * 格式： {eju:diyurl type='form' /}
     * @access public
     * @param array $tag 标签属性
     * @return string
     */
    public function tagDiyurl($tag)
    {
        $aid  =  !empty($tag['aid']) ? $tag['aid'] : 0;//查询字段内容
        $aid  = $this->varOrvalue($aid);
        $type = isset($tag['type']) ? $tag['type'] : '';
        $type  = $this->varOrvalue($type);
        $template = isset($tag['template']) ? $tag['template'] : '';
        $parseStr = '<?php ';

        // 查询数据库获取的数据集
        $parseStr .= ' $tagDiyurl = new \think\template\taglib\eju\TagDiyurl;';
        $parseStr .= ' $__VALUE__ = $tagDiyurl->getDiyurl('.$type.',"'.$template.'",'.$aid.');';
        $parseStr .= ' echo $__VALUE__;';
        $parseStr .= ' ?>';

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }
    /*
     * surroundings 周边环境
     */
    public function tagSurroundings($tag,$content){
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $field = isset($tag['field']) ? $tag['field'] : "[]";

        $select     = isset($tag['select']) ? $tag['select'] : 'lp-map-a';   //选中class
        $select  = $this->varOrvalue($select);
        $total     = isset($tag['total']) ? $tag['total'] : 'map_total';   //总记录数class
        $total  = $this->varOrvalue($total);
        $tab     = isset($tag['tab']) ? $tag['tab'] : 'lp-map-tab';
        $tab  = $this->varOrvalue($tab);
        $result     = isset($tag['result']) ? $tag['result'] : 'map_result';
        $result  = $this->varOrvalue($result);
        $canvas     = isset($tag['canvas']) ? $tag['canvas'] : 'map_canvas';  //地图布景id
        $canvas  = $this->varOrvalue($canvas);
        $tag     = isset($tag['tag']) ? $tag['tag'] : 'lp-map-s';   //选择li的固定class
        $tag  = $this->varOrvalue($tag);



        $parseStr = '<?php ';
        // 声明变量
        $parseStr .= ' $tagSurroundings = new \think\template\taglib\eju\TagSurroundings;';
        $parseStr .= ' $_result_tmp = $tagSurroundings->getSurroundings('.$field.','.$canvas.','.$tag.','.$select.','.$total.','.$tab.','.$result.');';
        $parseStr .= 'if(!empty($_result_tmp)): ';
        $parseStr .= '$' . $id.' = $_result_tmp ;?>';
        $parseStr .= $content;
        $parseStr .= '<?php  else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /*
     * pricetrend 价格走势 , 获取楼盘与区域价格走势
     */
    public function tagPricetrend($tag){
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $key    = !empty($tag['key']) ? $tag['key'] : 'i';
        $mod    = !empty($tag['mod']) && is_numeric($tag['mod']) ? $tag['mod'] : '2';

        $canvas     = isset($tag['canvas']) ? $tag['canvas'] : 'fjChart';   //画布（承载的class）
        $canvas  = $this->varOrvalue($canvas);
        $province = isset($tag['province']) ? $tag['province'] : '0';    //传值表示统计省份
        $city = isset($tag['city']) ? $tag['city'] : '0';       //传值表示统计城市
        $area = isset($tag['area']) ? $tag['area'] : '0';       //传值表示统计区域
        $month  = !empty($tag['month']) ? $tag['month'] : '';   //月份长度
        $month  = $this->varOrvalue($month);
        $fields = isset($tag['fields']) ? $tag['fields'] : "[]";        //楼盘信息

        $mode = isset($tag['mode']) ? $tag['mode'] : 'xinfang';  //价格模块，默认为新房,当'fields'有传值时，可省略本参数
        $mode  = $this->varOrvalue($mode);
        $type = isset($tag['type']) ? $tag['type'] : '1';  //获取价格类型，默认为均价（1：均价，2：起价，3：总价）

        $format  = !empty($tag['format']) ? $tag['format'] : 'Y-m月';    //时间显示格式
        $format  = $this->varOrvalue($format);

        $parseStr = '<?php ';
        // 查询数据库获取的数据集
        $parseStr .= ' $tagPicetrend = new \think\template\taglib\eju\TagPicetrend;';
        $parseStr .= ' $_result = $tagPicetrend->getPicetrend('.$fields.', '.$month.', '.$city.','.$province.','.$area.','.$format.','.$canvas.','.$mode.','.$type.');';
        $parseStr .= ' echo $_result;';
        $parseStr .= ' unset($_result);?>';


        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * orderlist 标签解析 用于获取排序字段列表
     * 格式：
     * {eju:orderlist typeid='1' type='son' row='10' reid='0' empty='' name='' id='' key='' titlelen='' offset='' mod='' currentstyle='active'}
     *  <li><a href='{$field:typelink}'>{$field:typename}</a> </li>
     * {/eju:orderlist}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string|void
     */
    public function tagOrderlist($tag, $content)
    {
        $typeid  = !empty($tag['typeid']) ? $tag['typeid'] : '';
        $typeid  = $this->varOrvalue($typeid);


        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $key    = !empty($tag['key']) ? $tag['key'] : 'i';
        $mod    = !empty($tag['mod']) && is_numeric($tag['mod']) ? $tag['mod'] : '2';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);

        $currentstyle = !empty($tag['currentstyle']) ? $tag['currentstyle'] : ''; // 自定义class  defaultstyle
        $upstyle = !empty($tag['upstyle']) ? $tag['upstyle'] : ''; // 自定义class
        $downstyle = !empty($tag['downstyle']) ? $tag['downstyle'] : ''; // 自定义class
        $defaultstyle = !empty($tag['defaultstyle']) ? $tag['defaultstyle'] : ''; // 默认class
        // 自定义字段名
        $addfields = isset($tag['addfields']) ? $tag['addfields'] : '';
        $addfields = $this->varOrvalue($addfields);
        // 自定义字段ID
        $addfieldids = isset($tag['addfieldids']) ? $tag['addfieldids'] : '';
        $addfieldids = $this->varOrvalue($addfieldids);

        // 全部字样
        $alltxt = isset($tag['alltxt']) ? $tag['alltxt'] : '';
        $alltxt = $this->varOrvalue($alltxt);

        $parseStr = '<?php ';
        // 查询数据库获取的数据集
        $parseStr .= ' $TagOrderlist = new \think\template\taglib\eju\TagOrderlist;';
        $parseStr .= ' $_result = $TagOrderlist->getOrderList("'.$currentstyle.'","'.$defaultstyle.'","'.$upstyle.'","'.$downstyle.'", '.$addfields.', '.$addfieldids.', '.$alltxt.','.$typeid.');';
        $parseStr .= '?>';

        $parseStr .= '<?php if(!empty($_result["list"]) || (($_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator ) && $_result["list"]->isEmpty())): ?>';
        $parseStr .= '<?php $'.$id.' = $_result; ?>';
        $parseStr .= $content;
        $parseStr .= '<?php endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;

    }

    /**
     * sqlview标签解析 获取单条记录
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string|void
     */
    public function tagSqlview($tag, $content)
    {
        $aid  =  !empty($tag['aid']) ? $tag['aid'] : 0;//查询字段内容
        $aid  = $this->varOrvalue($aid);
        $map  =  !empty($tag['map']) ? $tag['map'] : "[]";//查询字段内容
        $mapkey = !empty($tag['mapkey']) ? $tag['mapkey'] : "[]";   //查询字段名数组
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $fields     = isset($tag['fields']) ? $tag['fields'] : '*';
        $fields  = $this->varOrvalue($fields);
        $table = !empty($tag['table']) ? $tag['table'] : '';
        $table  = $this->varOrvalue($table);
        $addwhere = !empty($tag['addwhere']) ? $tag['addwhere'] : '';

        $parseStr = '<?php ';
        // 声明变量
        $parseStr .= ' $tagSqlview = new \think\template\taglib\eju\TagSqlview;';
        $parseStr .= ' $_result = $tagSqlview->getSqlview('.$aid.', '.$table.', '.$map.', '.$mapkey.', '.$fields.',"'.$addwhere.'");';
        $parseStr .= ' ?>';
        $parseStr .= '<?php if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): ';
        $parseStr .= ' $__LIST__ = $_result;';
        $parseStr .= 'if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("' . $empty . '");';
        $parseStr .= 'else: ';
        $parseStr .= '$'.$id.' = $__LIST__;';
        $parseStr .= '?>';
        $parseStr .= $content;
        $parseStr .= '<?php endif; else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用
        /*--end*/

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * 子表信息标签
     * 在模板中给某个变量赋值 支持变量赋值
     * 格式：
     * {eju:sonarclist aid="$eju['field']['aid']" table="xinfang_huxing" id="vo"}
     *  {$vo.title}
     * {/eju:sonarclist}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string
     */
    public function tagSonarccount($tag)
    {
        $aid  =  !empty($tag['aid']) ? $tag['aid'] : "0";//查询字段内容
        $aid = $this->varOrvalue($aid);
        $map  =  !empty($tag['map']) ? $tag['map'] : "[]";//查询字段内容
        $mapkey = !empty($tag['mapkey']) ? $tag['mapkey'] : "[]";   //查询字段名数组
        $table = !empty($tag['table']) ? $tag['table'] : '';
        $group = !empty($tag['group']) ? $tag['group'] : '';
        $parseStr = '<?php ';
        // 查询数据库获取的数据集
        $parseStr .= ' $tagSonarclist = new \think\template\taglib\eju\TagSonarclist;';
        $parseStr .= ' $_result = $tagSonarclist->getSonCount('.$aid.', '.$map.', '.$mapkey.', "'.$table.'", "'.$group.'");';
        $parseStr .= ' echo $_result;';
        $parseStr .= ' unset($_result);?>';

        return $parseStr;
    }

    /**
     * 子表信息标签
     * 在模板中给某个变量赋值 支持变量赋值
     * 格式：
     * {eju:sonarclist aid="$eju['field']['aid']" table="xinfang_huxing" id="vo"}
     *  {$vo.title}
     * {/eju:sonarclist}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string
     */
    public function tagSqlarclist($tag, $content)
    {
        $currentstyle   = !empty($tag['currentstyle']) ? $tag['currentstyle'] : '';
        $id     = isset($tag['id']) ? $tag['id'] : 'vo';
        $key    = !empty($tag['key']) ? $tag['key'] : 'i';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $aid  =  !empty($tag['aid']) ? $tag['aid'] : "0";//查询字段内容
        $aid = $this->varOrvalue($aid);
        $map  =  !empty($tag['map']) ? $tag['map'] : "[]";//查询字段内容
        $mapkey = !empty($tag['mapkey']) ? $tag['mapkey'] : "[]";   //查询字段名数组
        $table = !empty($tag['table']) ? $tag['table'] : '';
        $fields = !empty($tag['fields']) ? $tag['fields'] : '*';
        $orderby = !empty($tag['orderby']) ? $tag['orderby'] : ''; //排序
        $limit = !empty($tag['limit']) ? $tag['limit'] : '';
        $group = !empty($tag['group']) ? $tag['group'] : '';
        $mod    = !empty($tag['mod']) && is_numeric($tag['mod']) ? $tag['mod'] : '2';
        $addfields =  !empty($tag['addfields']) ? $tag['addfields'] : '';   //关联archives表字段
        $max =  !empty($tag['max']) ? $tag['max'] : '';
        $min =  !empty($tag['min']) ? $tag['min'] : '';
        $sum =  !empty($tag['sum']) ? $tag['sum'] : '';
        $count =  !empty($tag['count']) ? $tag['count'] : '';
        $jointable =  !empty($tag['jointable']) ? $tag['jointable'] : "[]";
        $region = isset($tag['region']) ? $tag['region'] : '';
        $region = $this->varOrvalue($region);
        $addwhere = !empty($tag['addwhere']) ? $tag['addwhere'] : '';

        $parseStr = '<?php ';
        // 查询数据库获取的数据集
        $parseStr .= ' $tagSqlarclist = new \think\template\taglib\eju\TagSqlarclist;';
        $parseStr .= ' $_result = $tagSqlarclist->getSqlarclist('.$aid.','.$map.', '.$mapkey.', "'.$table.'", "'.$fields.'", "'.$orderby.'", "'.$limit.'", "'.$group.'", "'.$addfields.'", "'.$max.'", "'.$min.'","'.$sum.'","'.$count.'",'.$jointable.','.$region.', "'.$addwhere.'");';
        $parseStr .= ' if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $' . $key . ' = 0; $e = 1;$k=0;';
        // 设置了输出数组长度
        $parseStr .= ' $__LIST__ = $_result;';
        $parseStr .= 'if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("' . $empty . '");';
        $parseStr .= 'else: ';
        $parseStr .= 'foreach($__LIST__ as $key=>$' . $id . '): ';

        $parseStr .= ' if ($' . $key . ' == 0) :';
        $parseStr .= ' $'.$id.'["currentstyle"] = "'.$currentstyle.'";';
        $parseStr .= ' else: ';
        $parseStr .= ' $'.$id.'["currentstyle"] = "";';
        $parseStr .= ' endif;';

        $parseStr .= '$' . $key . '= intval($key) + 1;?>';
        $parseStr .= '<?php $mod = ($' . $key . ' % ' . $mod . ' ); ?>';
        $parseStr .= $content;
        $parseStr .= '<?php ++$e;$k++; ?>';
        $parseStr .= '<?php endforeach; endif; else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用
        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }
    //收藏标签
    public function tagCollect($tag, $content){
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $collectid = !empty($tag['collectid']) ? $tag['collectid'] : ''; //点击收藏的sapn的id
        $titleid = !empty($tag['titleid']) ? $tag['titleid'] : ''; //显示收藏名称的id
        $styleid = !empty($tag['styleid']) ? $tag['styleid'] : ''; //显示收藏风格的id
        $currentstyle   = !empty($tag['currentstyle']) ? $tag['currentstyle'] : ''; //已经收藏的class
        $withoutstyle = !empty($tag['withoutstyle']) ? $tag['withoutstyle'] : ''; //暂未收藏的class
        $currenttitle   = !empty($tag['currenttitle']) ? $tag['currenttitle'] : '取消收藏'; //已经收藏显示名称
        $withouttitle = !empty($tag['withouttitle']) ? $tag['withouttitle'] : '加入收藏'; //暂未收藏显示名称
        $alert =  !empty($tag['alert']) ? $tag['alert'] : 'off'; //off不弹出，on弹出
        $aid     = isset($tag['aid']) ? $tag['aid'] : '0';
        $success     = !empty($tag['success']) ? $tag['success'] : '';      //提交后执行方法

        $parseStr = '<?php ';
        $parseStr .= ' $tagCollect = new \think\template\taglib\eju\TagCollect;';
        $parseStr .= ' $__LIST__ = $tagCollect->getCollect('.$aid.',"'.$collectid.'", "'.$titleid.'", "'.$styleid.'" ,"'.$currentstyle.'", "'.$withoutstyle.'", "'.$currenttitle.'", "'.$withouttitle.'", "'.$alert.'", "'.$success.'");';
        $parseStr .= '?>';

        $parseStr .= '<?php if(!empty($__LIST__) || (($__LIST__ instanceof \think\Collection || $__LIST__ instanceof \think\Paginator ) && $__LIST__->isEmpty())): ?>';
        $parseStr .= '<?php $'.$id.' = $__LIST__; ?>';
        $parseStr .= $content;
        $parseStr .= '<?php endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;

    }
    //表单标签
    public function tagForm($tag, $content)
    {
        $formid     = !empty($tag['formid']) ? $tag['formid'] : '';
        $formid  = $this->varOrvalue($formid);
        $success     = !empty($tag['success']) ? $tag['success'] : '';      //提交后执行方法
        $beforeSubmit     = !empty($tag['before']) ? $tag['before'] : '';   //提交前执行方法
        if (empty($beforeSubmit)) {
            $beforeSubmit     = !empty($tag['beforeSubmit']) ? $tag['beforeSubmit'] : '';
        }
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $key    = !empty($tag['key']) ? $tag['key'] : 'i';
        $mod    = !empty($tag['mod']) && is_numeric($tag['mod']) ? $tag['mod'] : '2';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);

        $is_count     = !empty($tag['is_count']) ? $tag['is_count'] : '';       //计算已报名个数
        $is_list = isset($tag['is_list']) ? $tag['is_list'] : '';       //是否获取已报名列表

        $parseStr = '<?php ';

        // 查询数据库获取的数据集
        $parseStr .= ' $tagForm = new \think\template\taglib\eju\TagForm;';
        $parseStr .= ' $_result = $tagForm->getForm('.$formid.', "'.$success.'", "'.$beforeSubmit.'","'.$is_count.'","'.$is_list.'");';
        $parseStr .= ' if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $' . $key . ' = 0; $e = 1;$k=0;';
        $parseStr .= ' $__LIST__ = $_result;';

        $parseStr .= 'if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("' . $empty . '");';
        $parseStr .= 'else: ';
        $parseStr .= 'foreach($__LIST__ as $key=>$' . $id . '): ';
        $parseStr .= '$' . $key . '= intval($key) + 1;?>';
        $parseStr .= '<?php $mod = ($' . $key . ' % ' . $mod . ' ); ?>';
        $parseStr .= $content;
        $parseStr .= '<?php ++$e;$k++; ?>';
        $parseStr .= '<?php endforeach;';
        $parseStr .= 'endif; else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }
    public function tagInputform($tag, $content)
    {
        $formid     = !empty($tag['formid']) ? $tag['formid'] : '';
        $formid  = $this->varOrvalue($formid);
        $name     = !empty($tag['name']) ? $tag['name'] : '';
        $name  = $this->varOrvalue($name);

        $success     = !empty($tag['success']) ? $tag['success'] : '';
        $success  = $this->varOrvalue($success);

        $class     = !empty($tag['class']) ? $tag['class'] : 'input-text';
        $class  = $this->varOrvalue($class);

        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);

        $parseStr = '<?php ';
        // 声明变量
        $parseStr .= ' $tagInputform = new \think\template\taglib\eju\TagInputform;';
        $parseStr .= ' $_result_tmp = $tagInputform->getInputform('.$formid.', '.$name.', '.$success.','.$class.');';
        $parseStr .= 'if(!empty($_result_tmp)): ';
        $parseStr .= '$' . $id.' = $_result_tmp ;?>';
        $parseStr .= $content;
        $parseStr .= '<?php  else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }
    /**
     * 自动识别构建变量，传值可以使变量也可以是值
     * @access private
     * @param string $value 值或变量
     * @return string
     */
    private function varOrvalue($value)
    {
        $flag  = substr($value, 0, 1);
        if ('$' == $flag || ':' == $flag) {
            $value = $this->autoBuildVar($value);
        } else {
            $value = str_replace('"', '\"', $value);
            $value = '"' . $value . '"';
        }

        return $value;
    }
    
    /**
     * load 标签解析 {load file="/static/js/base.js" /}
     * 格式：{load file="/static/css/base.css" /}
     * @access public
     * @param array $tag 标签属性
     * @return string
     */
    public function tagLoad($tag)
    {
        $file     = isset($tag['file']) ? $tag['file'] : $tag['href'];
        $type     = isset($tag['type']) ? strtolower($tag['type']) : '';
        $ver     = !empty($tag['ver']) ? $tag['ver'] : 'on';
        $startStr = '';
        $parseStr = '';
        $endStr   = '';
        // 判断是否存在加载条件 允许使用函数判断(默认为isset)
        if (isset($tag['value'])) {
            $name = $tag['value'];
            $name = $this->autoBuildVar($name);
            $name = 'isset(' . $name . ')';
            $startStr = '<?php if(' . $name . '): ?>';
            $endStr = '<?php endif; ?>';
        }

        $parseStr .= $startStr;
        $parseStr .= ' <? $tagLoad = new \think\template\taglib\eju\TagLoad;';
        $parseStr .= ' $__VALUE__ = $tagLoad->getLoad("'.$file.'", "'.$ver.'");';
        $parseStr .= ' echo $__VALUE__;';
        $parseStr .= ' ?>';
        $parseStr .= $endStr;

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * static 标签解析 {eju:static file="/static/js/base.js" /}
     * 格式：{eju:static file="/static/css/base.css" /}
     * @access public
     * @param array $tag 标签属性
     * @return string
     */
    public function tagStatic($tag)
    {
        $file  = isset($tag['file']) ? $tag['file'] : '';
        $file = $this->varOrvalue($file);
        $href  = isset($tag['href']) ? $tag['href'] : '';
        $href = $this->varOrvalue($href);
        $code = !empty($tag['code']) ? $tag['code'] : '';

        $parseStr = '<?php ';

        // 查询数据库获取的数据集
        $parseStr .= ' $tagStatic = new \think\template\taglib\eju\TagStatic;';
        $parseStr .= ' $__VALUE__ = $tagStatic->getStatic('.$file.','.$href.',"'.$code.'");';
        $parseStr .= ' echo $__VALUE__;';
        $parseStr .= ' ?>';

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * channel 标签解析 用于获取栏目列表
     * 格式：type:son表示下级栏目,self表示同级栏目,top顶级栏目
     * {eju:channel typeid='1' type='son' row='10' reid='0' empty='' name='' id='' key='' titlelen='' offset='' mod='' currentstyle='active'}
     *  <li><a href='{$field:typelink}'>{$field:typename}</a> </li> 
     * {/eju:channel}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string|void
     */
    public function tagChannel($tag, $content)
    {
        $typeid  = !empty($tag['typeid']) ? $tag['typeid'] : '';
        $typeid  = $this->varOrvalue($typeid);

        $notypeid  = !empty($tag['notypeid']) ? $tag['notypeid'] : '';
        $notypeid  = $this->varOrvalue($notypeid);

        $name   = !empty($tag['name']) ? $tag['name'] : '';
        $type   = !empty($tag['type']) ? $tag['type'] : 'son';
        $currentstyle   = !empty($tag['currentstyle']) ? $tag['currentstyle'] : '';
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $key    = !empty($tag['key']) ? $tag['key'] : 'i';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $mod    = !empty($tag['mod']) && is_numeric($tag['mod']) ? $tag['mod'] : '2';
        $titlelen = !empty($tag['titlelen']) && is_numeric($tag['titlelen']) ? intval($tag['titlelen']) : 100;
        $offset = !empty($tag['offset']) && is_numeric($tag['offset']) ? intval($tag['offset']) : 0;
        $row = !empty($tag['row']) && is_numeric($tag['row']) ? intval($tag['row']) : 10;
        if (!empty($tag['limit'])) {
            $limitArr = explode(',', $tag['limit']);
            $offset = !empty($limitArr[0]) ? intval($limitArr[0]) : 0;
            $row = !empty($limitArr[1]) ? intval($limitArr[1]) : 0;
        }
        $hidden   = !empty($tag['hidden']) ? $tag['hidden'] : '';   //不传值表示只显示不隐藏，on：只显示隐藏，off：隐藏和不隐藏全部显示
        // 获取最顶级父栏目ID
        // $topTypeId = 0;
        // if ($tid >0 && $type == 'top') {
        //     $result = model('Arctype')->getAllPid($tid);
        //     reset($result);
        //     $firstVal = current($result);
        //     $topTypeId = $firstVal['id'];
        // }

        $parseStr = '<?php ';
        // 声明变量
        /*typeid的优先级别从高到低：装修数据 -> 标签属性值 -> 外层标签channelartlist属性值*/
        $parseStr .= ' $typeid = '.$typeid.';';
        $parseStr .= ' if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif; ';
        /*--end*/
        $parseStr .= ' $row = '.$row.';';

        if ($name) { // 从模板中传入数据集
            $symbol     = substr($name, 0, 1);
            if (':' == $symbol) {
                $name = $this->autoBuildVar($name);
                $parseStr .= '$_result=' . $name . ';';
                $name = '$_result';
            } else {
                $name = $this->autoBuildVar($name);
            }

            $parseStr .= 'if(is_array(' . $name . ') || ' . $name . ' instanceof \think\Collection || ' . $name . ' instanceof \think\Paginator): $' . $key . ' = 0; $e = 1;$k=0;';
            // 设置了输出数组长度
            if (0 != $offset || 'null' != $row) {
                $parseStr .= '$__LIST__ = is_array(' . $name . ') ? array_slice(' . $name . ',' . $offset . ',' . $row . ', true) : ' . $name . '->slice(' . $offset . ',' . $row . ', true); ';
            } else {
                $parseStr .= ' $__LIST__ = ' . $name . ';';
            }

        } else { // 查询数据库获取的数据集
            $parseStr .= ' $tagChannel = new \think\template\taglib\eju\TagChannel;';
            $parseStr .= ' $_result = $tagChannel->getChannel($typeid, "'.$type.'", "'.$currentstyle.'", '.$notypeid.',"'.$hidden.'");';
            $parseStr .= ' if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $' . $key . ' = 0; $e = 1;$k=0;';
            // 设置了输出数组长度
            if (0 != $offset || 'null' != $row) {
                $parseStr .= '$__LIST__ = is_array($_result) ? array_slice($_result,' . $offset . ', $row, true) : $_result->slice(' . $offset . ', $row, true); ';
            } else {
                $parseStr .= ' if(intval($row) > 0) :';
                $parseStr .= ' $__LIST__ = is_array($_result) ? array_slice($_result,' . $offset . ', $row, true) : $_result->slice(' . $offset . ', $row, true); ';
                $parseStr .= ' else:';
                $parseStr .= ' $__LIST__ = $_result;';
                $parseStr .= ' endif;';
            }
        }

        $parseStr .= 'if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("' . $empty . '");';
        $parseStr .= 'else: ';
        $parseStr .= 'foreach($__LIST__ as $key=>$' . $id . '): ';
        $parseStr .= '$' . $id . '["typename"] = text_msubstr($' . $id . '["typename"], 0, '.$titlelen.', false);';

        // $parseStr .= ' $' . $id . '["typeurl"] = model("Arctype")->getTypeUrl($' . $id . ');';
        
        // $parseStr .= ' if (strval($'.$id.'["id"]) == strval($typeid) || strval($'.$id.'["id"]) == '.$topTypeId.') :';
        // $parseStr .= ' $'.$id.'["currentstyle"] = "'.$currentstyle.'";';
        // $parseStr .= ' else: ';
        // $parseStr .= ' $'.$id.'["currentstyle"] = "";';
        // $parseStr .= ' endif;';

        $parseStr .= ' $__LIST__[$key] = $_result[$key] = $' . $id . ';';
        $parseStr .= '$' . $key . '= intval($key) + 1;?>';
        $parseStr .= '<?php $mod = ($' . $key . ' % ' . $mod . ' ); ?>';
        $parseStr .= $content;
        $parseStr .= '<?php ++$e;$k++; ?>';
        $parseStr .= '<?php endforeach; endif; else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * channelartlist 标签解析 用于获取栏目列表
     * 格式：type:son表示下级栏目,self表示同级栏目,top顶级栏目
     * {eju:channelartlist typeid='1' type='son' row='10'}
     *  <li><a href='{$field:typelink}'>{$field:typename}</a> </li> 
     * {/eju:channelartlist}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string|void
     */
    public function tagChannelartlist($tag, $content)
    {
        $typeid  = !empty($tag['typeid']) ? $tag['typeid'] : '';
        $typeid  = $this->varOrvalue($typeid);

        $type   = !empty($tag['type']) ? $tag['type'] : 'self';
        $id     = 'channelartlist';
        $key    = !empty($tag['key']) ? $tag['key'] : 'i';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $row = !empty($tag['row']) && is_numeric($tag['row']) ? intval($tag['row']) : 10;
        $mod    = !empty($tag['mod']) && is_numeric($tag['mod']) ? $tag['mod'] : '2';
        $titlelen = !empty($tag['titlelen']) && is_numeric($tag['titlelen']) ? intval($tag['titlelen']) : 100;

        $parseStr = '<?php ';
        // 声明变量
        $parseStr .= ' $typeid = '.$typeid.';';
        $parseStr .= ' $row = '.$row.';';

        // 查询数据库获取的数据集
        $parseStr .= ' $tagChannelartlist = new \think\template\taglib\eju\TagChannelartlist;';
        $parseStr .= ' $_result = $tagChannelartlist->getChannelartlist($typeid, "'.$type.'");';
        $parseStr .= ' if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $' . $key . ' = 0; $e = 1;$k=0;';
        // 设置了输出数组长度
        if ('null' != $row) {
            $parseStr .= '$__LIST__ = is_array($_result) ? array_slice($_result,0, $row, true) : $_result->slice(0, $row, true); ';
        } else {
            $parseStr .= ' if(intval($row) > 0) :';
            $parseStr .= ' $__LIST__ = is_array($_result) ? array_slice($_result,0, $row, true) : $_result->slice(0, $row, true); ';
            $parseStr .= ' else:';
            $parseStr .= ' $__LIST__ = $_result;';
            $parseStr .= ' endif;';
        }

        $parseStr .= 'if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("' . $empty . '");';
        $parseStr .= 'else: ';
        $parseStr .= 'foreach($__LIST__ as $key=>$' . $id . '): ';
        $parseStr .= '$' . $id . '["typename"] = text_msubstr($' . $id . '["typename"], 0, '.$titlelen.', false);';

        $parseStr .= ' $__LIST__[$key] = $_result[$key] = $' . $id . ';';
        $parseStr .= '$' . $key . '= intval($key) + 1;?>';
        $parseStr .= '<?php $mod = ($' . $key . ' % ' . $mod . ' ); ?>';
        $parseStr .= $content;
        $parseStr .= '<?php ++$e;$k++; ?>';
        $parseStr .= '<?php endforeach; endif; else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= ' <?php $typeid = $row = ""; unset($'.$id.'); ?>';

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * arclist标签解析 获取指定文档列表（兼容tp的volist标签语法）
     * 格式：
     * {eju:arclist channelid='1' typeid='1' row='10' offset='0' titlelen='30' orderby ='aid desc' flag='' infolen='160' empty='' id='field' mod='' name=''}
     *  {$field.title}
     *  {$field.typeid}
     * {/eju:arclist}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string|void
     */
    public function tagArclist($tag, $content)
    {
        $typeid     = !empty($tag['typeid']) ? $tag['typeid'] : '';
        $typeid  = $this->varOrvalue($typeid);

        $notypeid     = !empty($tag['notypeid']) ? $tag['notypeid'] : '';
        $notypeid  = $this->varOrvalue($notypeid);

        $channelid   = isset($tag['channelid']) ? $tag['channelid'] : '';
        $channelid  = $this->varOrvalue($channelid);

        $addfields     = isset($tag['addfields']) ? $tag['addfields'] : '';
        $addfields  = $this->varOrvalue($addfields);

        $addwhere     = isset($tag['addwhere']) ? $tag['addwhere'] : '';
        $addwhere  = $this->varOrvalue($addwhere);

        $joinaid   = isset($tag['joinaid']) ? $tag['joinaid'] : '';
        $joinaid  = $this->varOrvalue($joinaid);
        $province   = isset($tag['province']) ? $tag['province'] : '';
        $province  = $this->varOrvalue($province);
        $city   = isset($tag['city']) ? $tag['city'] : '';
        $city  = $this->varOrvalue($city);
        $area   = isset($tag['area']) ? $tag['area'] : '';
        $area  = $this->varOrvalue($area);
        $screen   = isset($tag['screen']) ? $tag['screen'] : '1';   //是否筛选(存在)从表 screen = 1启用页面筛选项目（默认）,screen = 0 不启用页面筛选项
        $screen  = $this->varOrvalue($screen);

        $name   = !empty($tag['name']) ? $tag['name'] : '';
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $key    = !empty($tag['key']) ? $tag['key'] : 'i';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $mod    = !empty($tag['mod']) && is_numeric($tag['mod']) ? $tag['mod'] : '2';
        $orderby    = isset($tag['orderby']) ? $tag['orderby'] : '';
        $orderway    = isset($tag['orderway']) ? $tag['orderway'] : 'desc';
        $flag    = isset($tag['flag']) ? $tag['flag'] : '';
        $noflag    = isset($tag['noflag']) ? $tag['noflag'] : '';
        $tagid    = isset($tag['tagid']) ? $tag['tagid'] : ''; // 标签ID
        $pagesize = !empty($tag['pagesize']) && is_numeric($tag['pagesize']) ? intval($tag['pagesize']) : 0;
        $thumb   = !empty($tag['thumb']) ? $tag['thumb'] : 'on';
        $titlelen = !empty($tag['titlelen']) && is_numeric($tag['titlelen']) ? intval($tag['titlelen']) : 100;
        $infolen = !empty($tag['infolen']) && is_numeric($tag['infolen']) ? intval($tag['infolen']) : 160;
        $offset = !empty($tag['offset']) && is_numeric($tag['offset']) ? intval($tag['offset']) : 0;
        $row = !empty($tag['row']) && is_numeric($tag['row']) ? intval($tag['row']) : 10;
        if (!empty($tag['limit'])) {
            $limitArr = explode(',', $tag['limit']);
            $offset = !empty($limitArr[0]) ? intval($limitArr[0]) : 0;
            $row = !empty($limitArr[1]) ? intval($limitArr[1]) : 0;
        }
        $users_id = isset($tag['users_id']) ? $tag['users_id'] : '';    //楼盘所有人
        $users_id  = $this->varOrvalue($users_id);
        $map  =  !empty($tag['map']) ? $tag['map'] : "[]";//查询字段内容
        $mapkey = !empty($tag['mapkey']) ? $tag['mapkey'] : "[]";   //查询字段名数组
        $relate = isset($tag['relate']) ? $tag['relate'] : '0';   //是否需要获取关联经纪人信息
        $re_area = isset($tag['re_area']) ? $tag['re_area'] : '0';   //是否获取关联经纪人关联区域
        $re_xiaoqu = isset($tag['re_xiaoqu']) ? $tag['re_xiaoqu'] : '0';   //是否获取关联经纪人关联小区

        $parseStr = '<?php ';
        // 声明变量
        /*typeid的优先级别从高到低：装修数据 -> 标签属性值 -> 外层标签channelartlist属性值*/
        $parseStr .= ' $typeid = '.$typeid.';';
        $parseStr .= ' if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif; ';
        /*--end*/
        $parseStr .= ' $row = '.$row.';';
        $parseStr .= ' $channelid = '.$channelid.';';

        if ($name) { // 从模板中传入数据集
            $symbol     = substr($name, 0, 1);
            if (':' == $symbol) {
                $name = $this->autoBuildVar($name);
                $parseStr .= '$_result=' . $name . ';';
                $name = '$_result';
            } else {
                $name = $this->autoBuildVar($name);
            }

            $parseStr .= 'if(is_array(' . $name . ') || ' . $name . ' instanceof \think\Collection || ' . $name . ' instanceof \think\Paginator): $' . $key . ' = 0; $e = 1;$k=0;';
            // 设置了输出数组长度
            if (0 != $offset || 'null' != $row) {
                $parseStr .= '$__LIST__ = is_array(' . $name . ') ? array_slice(' . $name . ',' . $offset . ',' . $row . ', true) : ' . $name . '->slice(' . $offset . ',' . $row . ', true); ';
            } else {
                $parseStr .= ' $__LIST__ = ' . $name . ';';
            }

        } else { // 查询数据库获取的数据集
            $parseStr .= ' $param = array(';
            $parseStr .= '      "typeid"=> $typeid,';
            $parseStr .= '      "notypeid"=> '.$notypeid.',';
            $parseStr .= '      "flag"=> "'.$flag.'",';
            $parseStr .= '      "noflag"=> "'.$noflag.'",';
            $parseStr .= '      "channel"=> $channelid,';
            $parseStr .= '      "joinaid"=> '.$joinaid.',';
            $parseStr .= '      "province_id"=> '.$province.',';
            $parseStr .= '      "city_id"=> '.$city.',';
            $parseStr .= '      "area_id"=> '.$area.',';
            $parseStr .= '      "screen"=> '.$screen.',';
            $parseStr .= '      "users_id"=> '.$users_id.',';
            $parseStr .= '      "relate"=> '.$relate.',';
            $parseStr .= '      "re_area"=> '.$re_area.',';
            $parseStr .= '      "re_xiaoqu"=> '.$re_xiaoqu.',';
            $parseStr .= ' );';
            $parseStr .= ' $tag = '.var_export($tag,true).';';
            $parseStr .= ' $tagArclist = new \think\template\taglib\eju\TagArclist;';
            $parseStr .= ' $_result = $tagArclist->getArclist($param, $row, "'.$orderby.'", '.$addfields.',"'.$orderway.'","'.$tagid.'",$tag,"'.$pagesize.'","'.$thumb.'",'.$addwhere.','.$map.','.$mapkey.');';

            $parseStr .= 'if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $' . $key . ' = 0; $e = 1;$k=0;';
            // 设置了输出数组长度
            if (0 != $offset || 'null' != $row) {
                $parseStr .= ' $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],' . $offset . ', $row, true) : $_result["list"]->slice(' . $offset . ', $row, true); ';
            } else {
                $parseStr .= ' $__LIST__ = $_result["list"];';
            }
            $parseStr .= ' $__TAG__ = $_result["tag"];';
        }
        $parseStr .= 'if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("' . $empty . '");';
        $parseStr .= 'else: ';
        $parseStr .= 'foreach($__LIST__ as $key=>$' . $id . '): ';
        $parseStr .= '$aid = $'.$id.'["aid"];';
        $parseStr .= '$' . $id . '["title"] = text_msubstr($' . $id . '["title"], 0, '.$titlelen.', false);';
        $parseStr .= '$' . $id . '["seo_description"] = text_msubstr($' . $id . '["seo_description"], 0, '.$infolen.', true);';

        $parseStr .= '$' . $key . '= intval($key) + 1;?>';
        $parseStr .= '<?php $mod = ($' . $key . ' % ' . $mod . ' ); ?>';
        $parseStr .= $content;
        $parseStr .= '<?php ++$e;$k++; ?>';
        $parseStr .= '<?php $aid = 0; ?>';
        $parseStr .= '<?php endforeach; endif; else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * list 标签解析 获取指定文档分页列表（兼容tp的volist标签语法）
     * 格式：
     * {eju:list channelid='1' typeid='1' row='10' titlelen='30' orderby ='aid desc' flag='' infolen='160' empty='' id='field' mod='' name=''}
     *  {$field.title}
     *  {$field.typeid}
     * {/eju:list}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string|void
     */
    public function tagList($tag, $content)
    {
        $typeid     = !empty($tag['typeid']) ? $tag['typeid'] : '';
        $typeid  = $this->varOrvalue($typeid);

        $notypeid     = !empty($tag['notypeid']) ? $tag['notypeid'] : '';
        $notypeid  = $this->varOrvalue($notypeid);

        $channelid   = isset($tag['channelid']) ? $tag['channelid'] : '';
        $channelid  = $this->varOrvalue($channelid);
        
        $addfields     = isset($tag['addfields']) ? $tag['addfields'] : '';
        $addfields  = $this->varOrvalue($addfields);

        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $key    = !empty($tag['key']) ? $tag['key'] : 'i';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $mod    = !empty($tag['mod']) && is_numeric($tag['mod']) ? $tag['mod'] : '2';
        $pagesize = !empty($tag['pagesize']) && is_numeric($tag['pagesize']) ? intval($tag['pagesize']) : 10;
        $thumb   = !empty($tag['thumb']) ? $tag['thumb'] : 'on';
        $orderby    = isset($tag['orderby']) ? $tag['orderby'] : '';
        $orderway    = isset($tag['orderway']) ? $tag['orderway'] : 'desc';
        $flag    = isset($tag['flag']) ? $tag['flag'] : '';
        $noflag    = isset($tag['noflag']) ? $tag['noflag'] : '';
        $titlelen = !empty($tag['titlelen']) && is_numeric($tag['titlelen']) ? intval($tag['titlelen']) : 100;
        $infolen = !empty($tag['infolen']) && is_numeric($tag['infolen']) ? intval($tag['infolen']) : 160;
        $users_id = isset($tag['users_id']) ? $tag['users_id'] : '';
        $users_id  = $this->varOrvalue($users_id);
        $joinaid   = isset($tag['joinaid']) ? $tag['joinaid'] : '';
        $joinaid  = $this->varOrvalue($joinaid);
        $relate = isset($tag['relate']) ? $tag['relate'] : '0';   //是否需要获取关联经纪人信息
        $re_area = isset($tag['re_area']) ? $tag['re_area'] : '0';   //是否获取关联经纪人关联区域
        $re_xiaoqu = isset($tag['re_xiaoqu']) ? $tag['re_xiaoqu'] : '0';   //是否获取关联经纪人关联小区
        $parseStr = '<?php ';
        // 声明变量
        /*typeid的优先级别从高到低：装修数据 -> 标签属性值 -> 外层标签channelartlist属性值*/
        $parseStr .= ' $typeid = '.$typeid.'; ';
        $parseStr .= ' if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif; ';
        /*--end*/

        // 查询数据库获取的数据集
        $parseStr .= ' $param = array(';
        $parseStr .= '      "typeid"=> $typeid,';
        $parseStr .= '      "notypeid"=> '.$notypeid.',';
        $parseStr .= '      "flag"=> "'.$flag.'",';
        $parseStr .= '      "noflag"=> "'.$noflag.'",';
        $parseStr .= '      "channel"=> '.$channelid.',';
        $parseStr .= '      "joinaid"=> '.$joinaid.',';
        $parseStr .= '      "users_id"=> '.$users_id.',';
        $parseStr .= '      "relate"=> '.$relate.',';
        $parseStr .= '      "re_area"=> '.$re_area.',';
        $parseStr .= '      "re_xiaoqu"=> '.$re_xiaoqu.',';
        $parseStr .= ' );';
        // $parseStr .= ' $orderby = "'.$orderby.'";';
        $parseStr .= ' $tagList = new \think\template\taglib\eju\TagList;';
        $parseStr .= ' $_result_tmp = $tagList->getList($param, '.$pagesize.', "'.$orderby.'", '.$addfields.', "'.$orderway.'", "'.$thumb.'");';

        $parseStr .= 'if(is_array($_result_tmp) || $_result_tmp instanceof \think\Collection || $_result_tmp instanceof \think\Paginator): $' . $key . ' = 0; $e = 1;$k = 0;';
        $parseStr .= ' $__LIST__ = $_result = $_result_tmp["list"];';
        $parseStr .= ' $__PAGES__ = $_result_tmp["pages"];';
        $parseStr .= ' $__COUNT__ = $_result_tmp["count"];';

        $parseStr .= 'if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("' . $empty . '");';
        $parseStr .= 'else: ';
        $parseStr .= 'foreach($__LIST__ as $key=>$' . $id . '): ';
        $parseStr .= '$aid = $'.$id.'["aid"];';
        $parseStr .= '$' . $id . '["title"] = text_msubstr($' . $id . '["title"], 0, '.$titlelen.', false);';
        $parseStr .= '$' . $id . '["seo_description"] = text_msubstr($' . $id . '["seo_description"], 0, '.$infolen.', true);';

        $parseStr .= '$' . $key . '= intval($key) + 1;?>';
        $parseStr .= '<?php $mod = ($' . $key . ' % ' . $mod . ' ); ?>';
        $parseStr .= $content;
        $parseStr .= '<?php ++$e;$k++; ?>';
        $parseStr .= '<?php $aid = 0; ?>';
        $parseStr .= '<?php endforeach; endif; else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }
    /*
     * 列表数据总数
     */
    public function tagCountlist($tag){
        $parseStr = ' <?php ';
        $parseStr .= ' $__COUNT__ = isset($__COUNT__) ? $__COUNT__ : "";';
        $parseStr .= ' echo $__COUNT__;';
        $parseStr .= ' ?>';

        return $parseStr;
    }
    /**
     * pagelist 标签解析
     * 在模板中获取列表的分页
     * 格式： {eju:pagelist listitem='info,index,end,pre,next,pageno' listsize='2'/}
     * @access public
     * @param array $tag 标签属性
     * @return string
     */
    public function tagPagelist($tag)
    {
        $listitem = !empty($tag['listitem']) ? $tag['listitem'] : '';
        $listsize   = !empty($tag['listsize']) ? intval($tag['listsize']) : '';

        $parseStr = ' <?php ';
        $parseStr .= ' $__PAGES__ = isset($__PAGES__) ? $__PAGES__ : "";';
        $parseStr .= ' $tagPagelist = new \think\template\taglib\eju\TagPagelist;';
        $parseStr .= ' $__VALUE__ = $tagPagelist->getPagelist($__PAGES__, "'.$listitem.'", "'.$listsize.'");';
        $parseStr .= ' echo $__VALUE__;';
        $parseStr .= ' ?>';

        return $parseStr;
    }

    /**
     * arcpagelist 标签解析
     * 在模板中获取arclist标签列表的ajax分页
     * 格式： {eju:arcpagelist tagid='' pagesize='2'} {/eju:arcpagelist}
     * @access public
     * @param array $tag 标签属性
     * @return string
     */
    public function tagArcpagelist($tag, $content)
    {
        $tagid = !empty($tag['tagid']) ? $tag['tagid'] : '';
        $pagesize = !empty($tag['pagesize']) && is_numeric($tag['pagesize']) ? intval($tag['pagesize']) : 0;
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $tips     = isset($tag['tips']) ? $tag['tips'] : '';
        $callback     = isset($tag['callback']) ? $tag['callback'] : '';
        $loading     = isset($tag['loading']) ? $tag['loading'] : '';
        $loading  = $this->varOrvalue($loading);

        $parseStr = ' <?php ';

        // 查询数据库获取的数据集
        $parseStr .= ' empty($__TAG__) && $__TAG__ = [];';
        $parseStr .= ' $tagArcpagelist = new \think\template\taglib\eju\TagArcpagelist;';
        $parseStr .= ' $_result = $tagArcpagelist->getArcpagelist("'.$tagid.'","'.$pagesize.'","'.$tips.'",'.$loading.',"'.$callback.'", $__TAG__);';

        $parseStr .= ' if(!empty($_result) || (($_result instanceof \think\Collection || $_result instanceof \think\Paginator ) && $_result->isEmpty())): ?>';
        $parseStr .= '<?php $'.$id.' = $_result; ?>';
        $parseStr .= $content;
        $parseStr .= '<?php ';
        $parseStr .= ' endif; ?>';
        $parseStr .= '<?php echo $_result["js"]; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * position 标签解析
     * 在模板中获取列表的分页
     * 格式： {eju:position typeid="" symbol=" > "/}
     * @access public
     * @param array $tag 标签属性
     * @return string
     */
    public function tagPosition($tag)
    {
        $typeid = !empty($tag['typeid']) ? $tag['typeid'] : '';
        $typeid = $this->varOrvalue($typeid);

        $symbol     = isset($tag['symbol']) ? $tag['symbol'] : '';
        $style   = !empty($tag['style']) ? $tag['style'] : '';

        $parseStr = ' <?php ';

        /*typeid的优先级别从高到低：装修数据 -> 标签属性值 -> 外层标签channelartlist属性值*/
        $parseStr .= ' $typeid = '.$typeid.';';
        $parseStr .= ' if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif; ';
        /*--end*/
        
        $parseStr .= ' $tagPosition = new \think\template\taglib\eju\TagPosition;';
        $parseStr .= ' $__VALUE__ = $tagPosition->getPosition($typeid, "'.$symbol.'", "'.$style.'");';
        $parseStr .= ' echo $__VALUE__;';
        $parseStr .= ' ?>';

        return $parseStr;
    }

    /**
     * searchform 搜索表单标签解析 TAG调用
     * {eju:searchform type='default'}
        {$field.searchurl}
     * {/eju:searchform}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string|void
     */
    public function tagSearchform($tag, $content)
    {
        $channelid   = !empty($tag['channelid']) ? $tag['channelid'] : '';
        $channelid  = $this->varOrvalue($channelid);
        $typeid   = !empty($tag['typeid']) ? $tag['typeid'] : '';
        $typeid  = $this->varOrvalue($typeid);
        $notypeid   = !empty($tag['notypeid']) ? $tag['notypeid'] : '';
        $notypeid  = $this->varOrvalue($notypeid);
        $flag   = !empty($tag['flag']) ? $tag['flag'] : '';
        $flag  = $this->varOrvalue($flag);
        $noflag   = !empty($tag['noflag']) ? $tag['noflag'] : '';
        $noflag  = $this->varOrvalue($noflag);
        $type   = !empty($tag['type']) ? $tag['type'] : 'default';
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $key    = !empty($tag['key']) ? $tag['key'] : 'i';
        $mod    = !empty($tag['mod']) && is_numeric($tag['mod']) ? $tag['mod'] : '2';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $present = isset($tag['present']) ? $tag['present'] : 'off'; //跳转当前栏目
        $present = $this->varOrvalue($present);

        $parseStr = '<?php ';
        // 查询数据库获取的数据集
        $parseStr .= ' $tagSearchform = new \think\template\taglib\eju\TagSearchform;';
        $parseStr .= ' $_result = $tagSearchform->getSearchform('.$typeid.','.$channelid.','.$notypeid.','.$flag.','.$noflag.','.$present.');';
        $parseStr .= ' if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $' . $key . ' = 0; $e = 1;$k = 0;';
        $parseStr .= ' $__LIST__ = $_result;';

        $parseStr .= 'if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("' . $empty . '");';
        $parseStr .= 'else: ';
        $parseStr .= 'foreach($__LIST__ as $key=>$' . $id . '): ';
        $parseStr .= '$' . $key . '= intval($key) + 1;?>';
        $parseStr .= '<?php $mod = ($' . $key . ' % ' . $mod . ' ); ?>';
        $parseStr .= $content;
        $parseStr .= '<?php ++$e;$k++; ?>';
        $parseStr .= '<?php endforeach;';
        $parseStr .= 'endif; else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * type标签解析 指定的单个栏目的链接
     * 格式：
     * {eju:type typeid='' empty=''}
     *  <a href="{$field:typelink}">{$field:typename}</a>
     * {/eju:type}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string|void
     */
    public function tagType($tag, $content)
    {
        $typeid  = isset($tag['typeid']) ? $tag['typeid'] : '';
        $typeid  = $this->varOrvalue($typeid);

        $type  = !empty($tag['type']) ? $tag['type'] : 'self';
        $empty  = !empty($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $id     = isset($tag['id']) ? $tag['id'] : 'field';

        $addfields     = isset($tag['addfields']) ? $tag['addfields'] : '';
        if (!empty($tag['addtable'])) {
            $addfields = $tag['addtable'];
        }
        $addfields  = $this->varOrvalue($addfields);

        $parseStr = '<?php ';
        // 声明变量
        /*typeid的优先级别从高到低：装修数据 -> 标签属性值 -> 外层标签channelartlist属性值*/
        $parseStr .= ' $typeid = '.$typeid.';';
        $parseStr .= ' if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif; ';
        /*--end*/
        $parseStr .= ' $tagType = new \think\template\taglib\eju\TagType;';
        $parseStr .= ' $_result = $tagType->getType($typeid, "'.$type.'", '.$addfields.');';
        $parseStr .= ' ?>';

        /*方式一*/
        /*$parseStr .= '<?php if((!empty($_result) || (($_result instanceof \think\Collection || $_result instanceof \think\Paginator ) && $_result->isEmpty()))): ?>';
        $parseStr .= '<?php $'.$id.' = $_result; ?>';
        $parseStr .= $content;
        $parseStr .= '<?php endif; ?>';*/
        /*--end*/

        /*方式二*/
        $parseStr .= '<?php if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): ';
        $parseStr .= ' $__LIST__ = $_result;';
        $parseStr .= 'if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("' . $empty . '");';
        $parseStr .= 'else: ';
        $parseStr .= '$'.$id.' = $__LIST__;';
        $parseStr .= '?>';
        $parseStr .= $content;
        $parseStr .= '<?php endif; else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用
        /*--end*/

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * arcview标签解析 指定的单个栏目的链接
     * 格式：
     * {eju:arcview aid='' empty=''}
     *  <a href="{$field:arcurl}">{$field:title}</a>
     * {/eju:arcview}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string|void
     */
    public function tagArcview($tag, $content)
    {
        $aid_tmp  = isset($tag['aid']) ? $tag['aid'] : '0';
        $aid  = $this->varOrvalue($aid_tmp);

        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $fields =  isset($tag['fields']) ? $tag['fields'] : '';   //只获取主表部分字段信息
        $fields  = $this->varOrvalue($fields);
        $addfields     = isset($tag['addfields']) ? $tag['addfields'] : '';
        $addfields  = $this->varOrvalue($addfields);
        $tag['huxing']  = !empty($tag['huxing']) ? $tag['huxing'] : 'off';
        $tag['photo']  = !empty($tag['photo']) ? $tag['photo'] : 'off';
        $tag['price']  = !empty($tag['price']) ? $tag['price'] : 'off';

        $parseStr = '<?php ';
        // 声明变量
        if (!empty($aid_tmp)) {
            $parseStr .= ' $aid = '.$aid.';';
        } else {
            $parseStr .= ' if(!isset($aid) || empty($aid)) : $aid = '.$aid.'; endif;';
        }

        $parseStr .= ' $tag = '.var_export($tag,true).';';
        $parseStr .= ' if(!isset($aid) || empty($aid)) : $aid = '.$aid.'; endif;';
        $parseStr .= ' $tagArcview = new \think\template\taglib\eju\TagArcview;';
        $parseStr .= ' $_result = $tagArcview->getArcview($aid,'.$fields.', '.$addfields.',$tag);';
        $parseStr .= ' ?>';

        /*方式一*/
        $parseStr .= '<?php if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): ';
        $parseStr .= ' $__LIST__ = $_result;';
        $parseStr .= 'if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("' . $empty . '");';
        $parseStr .= 'else: ';
        $parseStr .= '$'.$id.' = $__LIST__;';
        $parseStr .= '?>';
        $parseStr .= $content;
        $parseStr .= '<?php endif; else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php unset($aid); ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用
        /*--end*/

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * tag 标签解析 TAG调用
     * 格式：sort:排序方式 month，rand，week
     *       getall:获取类型 0 为当前内容页TAG标记，1为获取全部TAG标记
     * {eju:tag row='1' getall='0' sort=''}
     *  <li><a href='{$field.link}'>{$field.tag}</a> </li> 
     * {/eju:tag}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string|void
     */
    public function tagTag($tag, $content)
    {
        $aid   = !empty($tag['aid']) ? $tag['aid'] : '0';
        $aid  = $this->varOrvalue($aid);
        $typeid   = !empty($tag['typeid']) ? $tag['typeid'] : '';
        $typeid  = $this->varOrvalue($typeid);
        $getall   = !empty($tag['getall']) ? $tag['getall'] : '0';
        $name   = !empty($tag['name']) ? $tag['name'] : '';
        $style   = !empty($tag['style']) ? $tag['style'] : '';
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $key    = !empty($tag['key']) ? $tag['key'] : 'i';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $mod    = !empty($tag['mod']) && is_numeric($tag['mod']) ? $tag['mod'] : '2';
        $row = !empty($tag['row']) && is_numeric($tag['row']) ? intval($tag['row']) : 100;
        $sort   = !empty($tag['sort']) ? $tag['sort'] : 'new';

        $parseStr = '<?php ';

        /*typeid的优先级别从高到低：装修数据 -> 标签属性值 -> 外层标签channelartlist属性值*/
        $parseStr .= ' $typeid = '.$typeid.';';
        $parseStr .= ' if(empty($typeid) && isset($channelartlist["id"]) && !empty($channelartlist["id"])) : $typeid = intval($channelartlist["id"]); endif; ';
        // 声明变量
        $parseStr .= ' if(!isset($aid) || empty($aid)) : $aid = '.$aid.'; endif;';
        /*--end*/

        // 查询数据库获取的数据集
        $parseStr .= ' $tagTag = new \think\template\taglib\eju\TagTag;';
        $parseStr .= ' $_result = $tagTag->getTag('.$getall.', $typeid, $aid, '.$row.', "'.$sort.'");';
        $parseStr .= ' if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $' . $key . ' = 0; $e = 1;$k=0;';
        // 设置了输出数组长度
        if ('null' != $row) {
            $parseStr .= '$__LIST__ = is_array($_result) ? array_slice($_result,0, '.$row.', true) : $_result->slice(0, '.$row.', true); ';
        } else {
            $parseStr .= ' $__LIST__ = $_result;';
        }

        $parseStr .= 'if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("' . $empty . '");';
        $parseStr .= 'else: ';
        $parseStr .= 'foreach($__LIST__ as $key=>$' . $id . '): ';
        $parseStr .= '$' . $key . '= intval($key) + 1;?>';
        $parseStr .= '<?php $mod = ($' . $key . ' % ' . $mod . ' ); ?>';
        $parseStr .= $content;
        $parseStr .= '<?php ++$e;$k++; ?>';
        $parseStr .= '<?php endforeach; endif; else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php unset($aid); ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * flink 标签解析 TAG调用
     * 格式：sort:排序方式 month，rand，week
     *       getall:获取类型 0 为当前内容页TAG标记，1为获取全部TAG标记
     * {eju:flink row='1' titlelen='20'}
     *  <li><a href='{$field:url}'>{$field:title}</a> </li> 
     * {/eju:flink}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string|void
     */
    public function tagFlink($tag, $content)
    {
        $type   = !empty($tag['type']) ? $tag['type'] : 'text';
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $key    = !empty($tag['key']) ? $tag['key'] : 'i';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $mod    = !empty($tag['mod']) && is_numeric($tag['mod']) ? $tag['mod'] : '2';
        $titlelen = !empty($tag['titlelen']) && is_numeric($tag['titlelen']) ? intval($tag['titlelen']) : 100;
        $row = !empty($tag['row']) ? intval($tag['row']) : 0;
        $limit   = !empty($tag['limit']) ? $tag['limit'] : '';
        if (empty($limit) && !empty($row)) {
            $limit = "0,{$row}";
        }

        $parseStr = '<?php ';

        // 查询数据库获取的数据集
        $parseStr .= ' $tagFlink = new \think\template\taglib\eju\TagFlink;';
        $parseStr .= ' $_result = $tagFlink->getFlink("'.$type.'", "'.$limit.'");';
        $parseStr .= ' if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $' . $key . ' = 0; $e = 1;$k = 0;';
        $parseStr .= ' $__LIST__ = $_result;';

        $parseStr .= 'if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("' . $empty . '");';
        $parseStr .= 'else: ';
        $parseStr .= 'foreach($__LIST__ as $key=>$' . $id . '): ';
        $parseStr .= '$' . $id . '["title"] = text_msubstr($' . $id . '["title"], 0, '.$titlelen.', false);';
        $parseStr .= ' $__LIST__[$key] = $_result[$key] = $' . $id . ';';
        $parseStr .= '$' . $key . '= intval($key) + 1;?>';
        $parseStr .= '<?php $mod = ($' . $key . ' % ' . $mod . ' ); ?>';
        $parseStr .= $content;
        $parseStr .= '<?php ++$e;$k++; ?>';
        $parseStr .= '<?php endforeach; endif; else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * ad标签解析 指定的单个广告的信息
     * 格式：
     * {eju:ad aid=''}
     *  <a href="{$field:links}">{$field:title}</a>
     * {/eju:ad}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string|void
     */
    public function tagAd($tag, $content)
    {
        $aid  = isset($tag['aid']) ? $tag['aid'] : '0';
        $aid  = $this->varOrvalue($aid);

        $id     = isset($tag['id']) ? $tag['id'] : 'field';

        $parseStr = '<?php ';
        // 声明变量
        $parseStr .= ' $tagAd = new \think\template\taglib\eju\TagAd;';
        $parseStr .= ' $_result = $tagAd->getAd('.$aid.');';
        $parseStr .= ' ?>';

        $parseStr .= '<?php if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): ';
        $parseStr .= ' $__LIST__ = $_result;';
        $parseStr .= 'if( count($__LIST__)==0 ) : echo "";';
        $parseStr .= 'else: ';
        $parseStr .= '$'.$id.' = $__LIST__;';
        $parseStr .= '?>';
        $parseStr .= $content;
        $parseStr .= '<?php endif; else: echo "";endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * adv 广告标签
     * 在模板中给某个变量赋值 支持变量赋值
     * 格式：
     * {eju:adv pid='' limit=''}
     *  <a href="{$field:links}" {$field.target}>{$field:title}</a>
     * {/eju:adv}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string
     */
    public function tagAdv($tag, $content)
    {
        $pid  =  !empty($tag['pid']) ? $tag['pid'] : '0';// 返回的变量pid
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $orderby = !empty($tag['orderby']) ? $tag['orderby'] : ''; //排序
        $row = !empty($tag['row']) ? $tag['row'] : '10'; 
        $where = !empty($tag['where']) ? $tag['where'] : ''; //查询条件
        $key  =  !empty($tag['key']) ? $tag['key'] : 'key';// 返回的变量key
        $key    = !empty($tag['key']) ? $tag['key'] : 'i';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $mod    = !empty($tag['mod']) && is_numeric($tag['mod']) ? $tag['mod'] : '2';
        $currentstyle   = !empty($tag['currentstyle']) ? $tag['currentstyle'] : '';

        $parseStr = '<?php ';

        // 查询数据库获取的数据集
        $parseStr .= ' $tagAdv = new \think\template\taglib\eju\TagAdv;';
        $parseStr .= ' $_result = $tagAdv->getAdv('.$pid.', "'.$where.'", "'.$orderby.'","'.$row.'");';
        $parseStr .= ' if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $' . $key . ' = 0; $e = 1;$k=0;';
        // 设置了输出数组长度
        if ('null' != $row) {
            $parseStr .= '$__LIST__ = is_array($_result) ? array_slice($_result,0, '.$row.', true) : $_result->slice(0, '.$row.', true); ';
        } else {
            $parseStr .= ' $__LIST__ = $_result;';
        }
        $parseStr .= 'if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("' . $empty . '");';
        $parseStr .= 'else: ';
        $parseStr .= 'foreach($__LIST__ as $key=>$' . $id . '): ';

        $parseStr .= ' if ($' . $key . ' == 0) :';
        $parseStr .= ' $'.$id.'["currentstyle"] = "'.$currentstyle.'";';
        $parseStr .= ' else: ';
        $parseStr .= ' $'.$id.'["currentstyle"] = "";';
        $parseStr .= ' endif;';

        $parseStr .= '$' . $key . '= intval($key) + 1;?>';
        $parseStr .= '<?php $mod = ($' . $key . ' % ' . $mod . ' ); ?>';
        $parseStr .= $content;
        $parseStr .= '<?php ++$e;$k++; ?>';
        $parseStr .= '<?php endforeach; endif; else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * prenext 标签解析
     * 在模板中获取内容页的上下篇
     * 格式：
     * {eju:prenext get='pre'}
     *  <a href="{$field:arcurl}">{$field:title}</a>
     * {/eju:prenext}
     * @access public
     * @param array $tag 标签属性
     * @return string
     */
    public function tagPrenext($tag, $content)
    {
        $get  =  !empty($tag['get']) ? $tag['get'] : 'pre';
        $titlelen = !empty($tag['titlelen']) && is_numeric($tag['titlelen']) ? intval($tag['titlelen']) : 100;
        $id     = isset($tag['id']) ? $tag['id'] : 'field';

        if (isset($tag['empty'])) {
            $style = 1; // 第一种默认标签写法，带属性empty
        } else {
            $style = 2; // 第二种支持判断写法，可以 else
        }

        if (1 == $style) {
            $empty     = isset($tag['empty']) ? $tag['empty'] : '暂无';
            $empty  = htmlspecialchars($empty);
            
            $parseStr = '<?php ';
            $parseStr .= ' $tagPrenext = new \think\template\taglib\eju\TagPrenext;';
            $parseStr .= ' $_result = $tagPrenext->getPrenext("'.$get.'");';
            $parseStr .= 'if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): ';
            $parseStr .= ' $__LIST__ = $_result;';
            $parseStr .= 'if( empty($__LIST__) ) : echo htmlspecialchars_decode("' . $empty . '");';
            $parseStr .= 'else: ';
            $parseStr .= '$'.$id.' = $__LIST__;';
            $parseStr .= '$' . $id . '["title"] = text_msubstr($' . $id . '["title"], 0, '.$titlelen.', false);';

            $parseStr .= '?>';
            $parseStr .= $content;
            $parseStr .= '<?php endif; else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        
        } else {
            $parseStr = '<?php ';
            $parseStr .= ' $tagPrenext = new \think\template\taglib\eju\TagPrenext;';
            $parseStr .= ' $_result = $tagPrenext->getPrenext("'.$get.'");';
            $parseStr .= '?>';

            $parseStr .= '<?php if(!empty($_result) || (($_result instanceof \think\Collection || $_result instanceof \think\Paginator ) && $_result->isEmpty())): ?>';
            $parseStr .= '<?php $'.$id.' = $_result; ?>';
            $parseStr .= '<?php $' . $id . '["title"] = text_msubstr($' . $id . '["title"], 0, '.$titlelen.', false); ?>';
            $parseStr .= $content;
            $parseStr .= '<?php endif; ?>';
        }

        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * field 标签解析
     * 在模板中获取变量值，只适用于标签channelartlist
     * 格式： {eju:field name="typename|html_msubstr=###,0,2" /}
     * @access public
     * @param array $tag 标签属性
     * @return string
     */
    public function tagField($tag)
    {
        $name  = isset($tag['name']) ? $tag['name'] : '';
        $addfields    = isset($tag['addfields']) ? $tag['addfields'] : '';
        $aid  = isset($tag['aid']) ? $tag['aid'] : '';
        $aid  = $this->varOrvalue($aid);

        $parseStr = '';

        if (!empty($name)) {
            $arr = explode('|', $name);
            $name = $arr[0];

            // 查询数据库获取的数据集
            $parseStr .= '<?php ';
            $parseStr .= ' $__VALUE__ = isset($channelartlist["'.$name.'"]) ? $channelartlist["'.$name.'"] : "变量名不存在";';

            if (1 < count($arr)) {
                $funcArr = explode('=', $arr[1]);
                $funcName = $funcArr[0]; // 函数名
                $funcParam = !empty($funcArr[1]) ? $funcArr[1] : ''; // 函数参数
                if (!empty($funcParam)) {
                    $funcParamStr = '';
                    foreach (explode(',', $funcParam) as $key => $val) {
                        if ('###' == $val) {
                            $val = '$__VALUE__';
                        }
                        if (0 < $key) {
                            $funcParamStr .= ', ';
                        }
                        $funcParamStr .= $val;
                    }
                    $parseStr .= '$__VALUE__ = '.$funcName.'('.$funcParamStr.');';
                }
            }

            $parseStr .= ' echo $__VALUE__;';
            $parseStr .= ' ?>';

        } else if (!empty($addfields)) {

            $addfieldsArr = explode('|', $addfields);

            $parseStr .= '<?php ';

            // 查询数据库获取的数据集
            $parseStr .= ' $tagField = new \think\template\taglib\eju\TagField;';
            $parseStr .= ' $__VALUE__ = $tagField->getField("'.$addfieldsArr[0].'", '.$aid.');';

            // 字段指定的函数
            if (!empty($addfieldsArr[1])) {
                $funcArr = explode('=', $addfieldsArr[1]);
                $funcName = $funcArr[0]; // 函数名
                $funcParam = !empty($funcArr[1]) ? $funcArr[1] : ''; // 函数参数
                if (!empty($funcParam)) {
                    $funcParamStr = '';
                    foreach (explode(',', $funcParam) as $key => $val) {
                        if ('###' == $val) {
                            $val = '$__VALUE__';
                        }
                        if (0 < $key) {
                            $funcParamStr .= ', ';
                        }
                        $funcParamStr .= $val;
                    }
                    $parseStr .= '$__VALUE__ = '.$funcName.'('.$funcParamStr.');';
                }
            }

            $parseStr .= ' echo $__VALUE__;';
            $parseStr .= ' ?>';
        }

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * empty标签解析
     * 如果某个变量为empty 则输出内容
     * 格式： {eju:empty name="" }content{/eju:empty}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string
     */
    public function tagEmpty($tag, $content)
    {
        $name     = $tag['name'];
        $name     = $this->autoBuildVar($name);
        $parseStr = '<?php if(empty(' . $name . ') || ((' . $name . ' instanceof \think\Collection || ' . $name . ' instanceof \think\Paginator ) && ' . $name . '->isEmpty())): ?>' . $content . '<?php endif; ?>';
        return $parseStr;
    }

    /**
     * notempty 标签解析
     * 如果某个变量不为empty 则输出内容
     * 格式： {eju:notempty name="" }content{/eju:notempty}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string
     */
    public function tagNotempty($tag, $content)
    {
        $name     = $tag['name'];
        $name     = $this->autoBuildVar($name);
        $parseStr = '<?php if(!(empty(' . $name . ') || ((' . $name . ' instanceof \think\Collection || ' . $name . ' instanceof \think\Paginator ) && ' . $name . '->isEmpty()))): ?>' . $content . '<?php endif; ?>';
        return $parseStr;
    }

    /**
     * assign标签解析
     * 在模板中给某个变量赋值 支持变量赋值
     * 格式： {eju:assign name="" value="" /}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string
     */
    public function tagAssign($tag, $content)
    {
        $name = $this->autoBuildVar($tag['name']);
        $flag = substr($tag['value'], 0, 1);
        if ('$' == $flag || ':' == $flag) {
            $value = $this->autoBuildVar($tag['value']);
        } else {
            $value = '\'' . $tag['value'] . '\'';
        }
        $parseStr = '<?php ' . $name . ' = ' . $value . '; ?>';
        return $parseStr;
    }

    /**
     * foreach标签解析 循环输出数据集
     * 格式：
     * {eju:foreach name="userList" id="user" key="key" index="i" mod="2" offset="3" length="5" empty=""}
     * {user.username}
     * {/eju:foreach}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string|void
     */
    public function tagForeach($tag, $content)
    {
        // 直接使用表达式
        if (!empty($tag['expression'])) {
            $expression = ltrim(rtrim($tag['expression'], ')'), '(');
            $expression = $this->autoBuildVar($expression);
            $parseStr   = '<?php foreach(' . $expression . '): ?>';
            $parseStr .= $content;
            $parseStr .= '<?php endforeach; ?>';
            return $parseStr;
        }
        $name   = $tag['name'];
        $key    = !empty($tag['key']) ? $tag['key'] : 'key';
        $item   = !empty($tag['id']) ? $tag['id'] : $tag['item'];
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $offset = !empty($tag['offset']) && is_numeric($tag['offset']) ? intval($tag['offset']) : 0;
        $length = !empty($tag['length']) && is_numeric($tag['length']) ? intval($tag['length']) : 'null';

        $parseStr = '<?php ';
        // 支持用函数传数组
        if (':' == substr($name, 0, 1)) {
            $var  = '$_' . uniqid();
            $name = $this->autoBuildVar($name);
            $parseStr .= $var . '=' . $name . '; ';
            $name = $var;
        } else {
            $name = $this->autoBuildVar($name);
        }
        $parseStr .= 'if(is_array(' . $name . ') || ' . $name . ' instanceof \think\Collection || ' . $name . ' instanceof \think\Paginator): ';
        // 设置了输出数组长度
        if (0 != $offset || 'null' != $length) {
            if (!isset($var)) {
                $var = '$_' . uniqid();
            }
            $parseStr .= $var . ' = is_array(' . $name . ') ? array_slice(' . $name . ',' . $offset . ',' . $length . ', true) : ' . $name . '->slice(' . $offset . ',' . $length . ', true); ';
        } else {
            $var = &$name;
        }

        $parseStr .= 'if( count(' . $var . ')==0 ) : echo htmlspecialchars_decode("' . $empty . '");';
        $parseStr .= 'else: ';

        // 设置了索引项
        if (isset($tag['index'])) {
            $index = $tag['index'];
            $parseStr .= '$' . $index . '=0; $e = 1;$k=0;';
        }
        $parseStr .= 'foreach(' . $var . ' as $' . $key . '=>$' . $item . '): ';
        // 设置了索引项
        if (isset($tag['index'])) {
            $index = $tag['index'];
            if (!empty($tag['mod']) && is_numeric($tag['mod'])) {
                $mod = (int) $tag['mod'];
                $parseStr .= '$mod = ($e % ' . $mod . '); ';
            }
            $parseStr .= '++$' . $index . ';';
        }
        $parseStr .= '?>';
        // 循环体中的内容
        $parseStr .= $content;
        $parseStr .= '<?php ++$e;$k++; ?>';
        $parseStr .= '<?php endforeach; endif; else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * if标签解析
     * 格式：
     * {eju:if condition=" $a eq 1"}
     * {eju:elseif condition="$a eq 2" /}
     * {eju:else /}
     * {/eju:if}
     * 表达式支持 eq neq gt egt lt elt == > >= < <= or and || &&
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string
     */
    public function tagIf($tag, $content)
    {
        $condition = !empty($tag['expression']) ? $tag['expression'] : $tag['condition'];
        $condition = $this->parseCondition($condition);
        $parseStr  = '<?php if(' . $condition . '): ?>' . $content . '<?php endif; ?>';
        return $parseStr;
    }

    /**
     * elseif标签解析
     * 格式：见if标签
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string
     */
    public function tagElseif($tag, $content)
    {
        $condition = !empty($tag['expression']) ? $tag['expression'] : $tag['condition'];
        $condition = $this->parseCondition($condition);
        $parseStr  = '<?php elseif(' . $condition . '): ?>';
        return $parseStr;
    }

    /**
     * else 标签解析
     * 格式：见if标签
     * @access public
     * @param array $tag 标签属性
     * @return string
     */
    public function tagElse($tag)
    {
        $parseStr = '<?php else: ?>';
        return $parseStr;
    }

    /**
     * switch标签解析
     * 格式：
     * {eju:switch name="a.name"}
     * {eju:case value="1" break="false"}1{/case}
     * {eju:case value="2" }2{/case}
     * {eju:default /}other
     * {/eju:switch}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string
     */
    public function tagSwitch($tag, $content)
    {
        $name     = !empty($tag['expression']) ? $tag['expression'] : $tag['name'];
        $name     = $this->autoBuildVar($name);
        $parseStr = '<?php switch(' . $name . '): ?>' . $content . '<?php endswitch; ?>';
        return $parseStr;
    }

    /**
     * case标签解析 需要配合switch才有效
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string
     */
    public function tagCase($tag, $content)
    {
        $value = !empty($tag['expression']) ? $tag['expression'] : $tag['value'];
        $flag  = substr($value, 0, 1);
        if ('$' == $flag || ':' == $flag) {
            $value = $this->autoBuildVar($value);
            $value = 'case ' . $value . ':';
        } elseif (strpos($value, '|')) {
            $values = explode('|', $value);
            $value  = '';
            foreach ($values as $val) {
                $value .= 'case "' . addslashes($val) . '":';
            }
        } else {
            $value = 'case "' . $value . '":';
        }
        $parseStr = '<?php ' . $value . ' ?>' . $content;
        $isBreak  = isset($tag['break']) ? $tag['break'] : '';
        if ('' == $isBreak || $isBreak) {
            $parseStr .= '<?php break; ?>';
        }
        return $parseStr;
    }

    /**
     * default标签解析 需要配合switch才有效
     * 使用： {eju:default /}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string
     */
    public function tagDefault($tag)
    {
        $parseStr = '<?php default: ?>';
        return $parseStr;
    }

    /**
     * compare标签解析
     * 用于值的比较 支持 eq neq gt lt egt elt heq nheq 默认是eq
     * 格式： {eju:compare name="" type="eq" value="" }content{/eju:compare}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string
     */
    public function tagCompare($tag, $content)
    {
        $name  = $tag['name'];
        $value = $tag['value'];
        $type  = isset($tag['type']) ? $tag['type'] : 'eq'; // 比较类型
        $name  = $this->autoBuildVar($name);
        $flag  = substr($value, 0, 1);
        if ('$' == $flag || ':' == $flag) {
            $value = $this->autoBuildVar($value);
        } else {
            $value = '\'' . $value . '\'';
        }
        switch ($type) {
            case 'equal':
                $type = 'eq';
                break;
            case 'notequal':
                $type = 'neq';
                break;
        }
        $type     = $this->parseCondition(' ' . $type . ' ');
        $parseStr = '<?php if(' . $name . ' ' . $type . ' ' . $value . '): ?>' . $content . '<?php endif; ?>';
        return $parseStr;
    }

    /**
     * volist标签解析 循环输出数据集
     * 格式：
     * {eju:volist name="userList" id="user" empty=""}
     * {user.username}
     * {user.email}
     * {/eju:volist}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string|void
     */
    public function tagVolist($tag, $content)
    {
        $name   = $tag['name'];
        $id  = isset($tag['id']) ? $tag['id'] : 'field';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $key    = !empty($tag['key']) ? $tag['key'] : 'i';
        $mod    = !empty($tag['mod']) && is_numeric($tag['mod']) ? $tag['mod'] : '2';
        $offset = !empty($tag['offset']) && is_numeric($tag['offset']) ? intval($tag['offset']) : 0;
        $length = !empty($tag['length']) && is_numeric($tag['length']) ? intval($tag['length']) : 'null';
        if (!empty($tag['row'])) {
            $length = !empty($tag['row']) && is_numeric($tag['row']) ? intval($tag['row']) : 'null';
        }
        if (!empty($tag['limit'])) {
            $limit = str_replace('，', ',', $tag['limit']);
            $limitArr = explode(',', $limit);
            $offset = !empty($limitArr[0]) ? intval($limitArr[0]) : 0;
            $length = !empty($limitArr[1]) ? intval($limitArr[1]) : 'null';
        }
        // 允许使用函数设定数据集 <volist name=":fun('arg')" id="vo">{$vo.name}</volist>
        $parseStr = '<?php ';
        $flag     = substr($name, 0, 1);
        if (':' == $flag) {
            $name = $this->autoBuildVar($name);
            $parseStr .= '$_result=' . $name . ';';
            $name = '$_result';
        } else {
            $name = $this->autoBuildVar($name);
        }

        $parseStr .= 'if(is_array(' . $name . ') || ' . $name . ' instanceof \think\Collection || ' . $name . ' instanceof \think\Paginator): $' . $key . ' = 0; $e = 1;$k=0;';
        // 设置了输出数组长度
        if (0 != $offset || 'null' != $length) {
            $parseStr .= '$__LIST__ = is_array(' . $name . ') ? array_slice(' . $name . ',' . $offset . ',' . $length . ', true) : ' . $name . '->slice(' . $offset . ',' . $length . ', true); ';
        } else {
            $parseStr .= ' $__LIST__ = ' . $name . ';';
        }
        $parseStr .= 'if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("' . $empty . '");';
        $parseStr .= 'else: ';
        $parseStr .= 'foreach($__LIST__ as $key=>$' . $id . '): ';
        $parseStr .= '$' . $key . '= intval($key) + 1;?>';
        $parseStr .= '<?php $mod = ($' . $key . ' % ' . $mod . ' ); ?>';
        $parseStr .= $content;
        $parseStr .= '<?php ++$e;$k++; ?>';
        $parseStr .= '<?php endforeach; endif; else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * global 标签解析
     * 在模板中获取系统的变量值
     * 格式： {eju:global name="" /}
     * @access public
     * @param array $tag 标签属性
     * @return string
     */
    public function tagGlobal($tag)
    {
        $name = $tag['name'];
        $name  = $this->varOrvalue($name);

        $parseStr = '<?php ';

        // 查询数据库获取的数据集
        $parseStr .= ' $tagGlobal = new \think\template\taglib\eju\TagGlobal;';
        $parseStr .= ' $__VALUE__ = $tagGlobal->getGlobal('.$name.');';
        $parseStr .= ' echo $__VALUE__;';
        $parseStr .= ' ?>';

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * arcclick 标签解析
     * 在内容页模板追加显示浏览量
     * 格式： {eju:arcclick aid='' /}
     * @access public
     * @param array $tag 标签属性
     * @return string
     */
    public function tagArcclick($tag)
    {
        $aid = isset($tag['aid']) ? $tag['aid'] : '';
        $aid  = $this->varOrvalue($aid);

        $value = isset($tag['value']) ? $tag['value'] : '';
        $value  = $this->varOrvalue($value);

        $parseStr = '<?php ';

        // 查询数据库获取的数据集
        $parseStr .= ' $tagArcclick = new \think\template\taglib\eju\TagArcclick;';
        $parseStr .= ' $__VALUE__ = $tagArcclick->getArcclick('.$aid.', '.$value.');';
        $parseStr .= ' echo $__VALUE__;';
        $parseStr .= ' ?>';

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * php标签解析
     * 格式：
     * {eju:php}echo $name{/eju:php}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string
     */
    public function tagPhp($tag, $content)
    {
        $parseStr = '<?php ' . $content . ' ?>';
        return $parseStr;
    }

    /**
     * weapp标签解析
     * 安装网站应用插件时自动在页面上追加代码
     * 格式： {eju:weapp type='default'}content{/eju:weapp}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string
     */
    public function tagWeapp($tag, $content)
    {
        $type     = isset($tag['type']) ? $tag['type'] : 'default';

        $parseStr = ' <?php ';
        $parseStr .= ' $tagWeapp = new \think\template\taglib\eju\TagWeapp;';
        $parseStr .= ' $__VALUE__ = $tagWeapp->getWeapp("'.$type.'");';
        $parseStr .= ' echo $__VALUE__;';
        $parseStr .= ' ?>';

        return $parseStr;
    }

    /**
     * range标签解析
     * 如果某个变量存在于某个范围 则输出内容 type= in 表示在范围内 否则表示在范围外
     * 格式： {eju:range name="var|function"  value="val" type='in|notin' }content{/eju:range}
     * example: {eju:range name="a"  value="1,2,3" type='in' }content{/eju:range}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string
     */
    public function tagRange($tag, $content)
    {
        $name  = $tag['name'];
        $value = $tag['value'];
        $type  = isset($tag['type']) ? $tag['type'] : 'in'; // 比较类型

        $name = $this->autoBuildVar($name);
        $flag = substr($value, 0, 1);
        if ('$' == $flag || ':' == $flag) {
            $value = $this->autoBuildVar($value);
            $str   = 'is_array(' . $value . ')?' . $value . ':explode(\',\',' . $value . ')';
        } else {
            $value = '"' . $value . '"';
            $str   = 'explode(\',\',' . $value . ')';
        }
        if ('between' == $type) {
            $parseStr = '<?php $_RANGE_VAR_=' . $str . ';if(' . $name . '>= $_RANGE_VAR_[0] && ' . $name . '<= $_RANGE_VAR_[1]):?>' . $content . '<?php endif; ?>';
        } elseif ('notbetween' == $type) {
            $parseStr = '<?php $_RANGE_VAR_=' . $str . ';if(' . $name . '<$_RANGE_VAR_[0] || ' . $name . '>$_RANGE_VAR_[1]):?>' . $content . '<?php endif; ?>';
        } else {
            $fun      = ('in' == $type) ? 'in_array' : '!in_array';
            $parseStr = '<?php if(' . $fun . '((' . $name . '), ' . $str . ')): ?>' . $content . '<?php endif; ?>';
        }
        return $parseStr;
    }

    /**
     * present标签解析
     * 如果某个变量已经设置 则输出内容
     * 格式： {eju:present name="" }content{/eju:present}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string
     */
    public function tagPresent($tag, $content)
    {
        $name     = $tag['name'];
        $name     = $this->autoBuildVar($name);
        $parseStr = '<?php if(isset(' . $name . ')): ?>' . $content . '<?php endif; ?>';
        return $parseStr;
    }

    /**
     * notpresent标签解析
     * 如果某个变量没有设置，则输出内容
     * 格式： {eju:notpresent name="" }content{/eju:notpresent}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string
     */
    public function tagNotpresent($tag, $content)
    {
        $name     = $tag['name'];
        $name     = $this->autoBuildVar($name);
        $parseStr = '<?php if(!isset(' . $name . ')): ?>' . $content . '<?php endif; ?>';
        return $parseStr;
    }

    /**
     * 判断是否已经定义了该常量
     * {eju:defined name='TXT'}已定义{/eju:defined}
     * @param array $tag
     * @param string $content
     * @return string
     */
    public function tagDefined($tag, $content)
    {
        $name     = $tag['name'];
        $parseStr = '<?php if(defined("' . $name . '")): ?>' . $content . '<?php endif; ?>';
        return $parseStr;
    }

    /**
     * for标签解析
     * 格式：
     * {eju:for start="" end="" comparison="" step="" name=""}
     * content
     * {/eju:for}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string
     */
    public function tagFor($tag, $content)
    {
        //设置默认值
        $start      = 0;
        $end        = 0;
        $step       = 1;
        $comparison = 'lt';
        $name       = 'i';
        $rand       = rand(); //添加随机数，防止嵌套变量冲突
        //获取属性
        foreach ($tag as $key => $value) {
            $value = trim($value);
            $flag  = substr($value, 0, 1);
            if ('$' == $flag || ':' == $flag) {
                $value = $this->autoBuildVar($value);
            }

            switch ($key) {
                case 'start':
                    $start = $value;
                    break;
                case 'end':
                    $end = $value;
                    break;
                case 'step':
                    $step = $value;
                    break;
                case 'comparison':
                    $comparison = $value;
                    break;
                case 'name':
                    $name = $value;
                    break;
            }
        }

        $parseStr = '<?php $__FOR_START_' . $rand . '__=' . $start . ';$__FOR_END_' . $rand . '__=' . $end . ';';
        $parseStr .= 'for($' . $name . '=$__FOR_START_' . $rand . '__;' . $this->parseCondition('$' . $name . ' ' . $comparison . ' $__FOR_END_' . $rand . '__') . ';$' . $name . '+=' . $step . '){ ?>';
        $parseStr .= $content;
        $parseStr .= '<?php } ?>';
        return $parseStr;
    }

    /**
     * url函数的tag标签
     * 格式：{eju:url link="模块/控制器/方法" vars="参数" suffix="true或者false 是否带有后缀" domain="true或者false 是否携带域名" /}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string
     */
    public function tagUrl($tag, $content)
    {
        $url    = isset($tag['link']) ? $tag['link'] : '';
        $vars   = isset($tag['vars']) ? $tag['vars'] : '';
        $suffix = isset($tag['suffix']) ? $tag['suffix'] : 'true';
        $domain = isset($tag['domain']) ? $tag['domain'] : 'false';
        return '<?php echo url("' . $url . '","' . $vars . '",' . $suffix . ',' . $domain . ');?>';
    }

    /**
     * function标签解析 匿名函数，可实现递归
     * 使用：
     * {eju:function name="func" vars="$data" call="$list" use="&$a,&$b"}
     *      {eju:if is_array($data)}
     *          {eju:foreach $data as $val}
     *              {~func($val) /}
     *          {/eju:foreach}
     *      {eju:else /}
     *          {$data}
     *      {/eju:if}
     * {/eju:function}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string
     */
    public function tagFunction($tag, $content)
    {
        $name = !empty($tag['name']) ? $tag['name'] : 'func';
        $vars = !empty($tag['vars']) ? $tag['vars'] : '';
        $call = !empty($tag['call']) ? $tag['call'] : '';
        $use  = ['&$' . $name];
        if (!empty($tag['use'])) {
            foreach (explode(',', $tag['use']) as $val) {
                $use[] = '&' . ltrim(trim($val), '&');
            }
        }
        $parseStr = '<?php $' . $name . '=function(' . $vars . ') use(' . implode(',', $use) . ') {';
        $parseStr .= ' ?>' . $content . '<?php }; ';
        $parseStr .= $call ? '$' . $name . '(' . $call . '); ?>' : '?>';
        return $parseStr;
    }

    /**
     * diyfield标签解析 循环输出自定义字段图集
     * 格式：
     * {eju:diyfield type="default" name="$eju.field.imgs" id="field"}
     * <img src="{$field.image_url}" />
     * {/eju:diyfield}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string|void
     */
    public function tagDiyfield($tag, $content)
    {
        $name   = $tag['name'];
        $id  = isset($tag['id']) ? $tag['id'] : 'field';
        $key    = !empty($tag['key']) ? $tag['key'] : 'i';
        $mod    = !empty($tag['mod']) && is_numeric($tag['mod']) ? $tag['mod'] : '2';
        $type    = isset($tag['type']) ? $tag['type'] : 'default';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $offset = 0;
        $length = 'null';
        if (!empty($tag['limit'])) {
            $limitArr = explode(',', $tag['limit']);
            $offset = !empty($limitArr[0]) ? intval($limitArr[0]) : 0;
            $length = !empty($limitArr[1]) ? intval($limitArr[1]) : 'null';
        }

        $parseStr = '<?php ';
        $flag     = substr($name, 0, 1);
        if (':' == $flag) {
            $name = $this->autoBuildVar($name);
            $parseStr .= '$_result=' . $name . ';';
            $name = '$_result';
        } else {
            $name = $this->autoBuildVar($name);
        }
        $name1 = '$heiheihei';  //中间参数，不改变原来的值
        // 查询数据库获取的数据集
        $parseStr .= ' $tagDiyfield = new \think\template\taglib\eju\TagDiyfield;';
        $parseStr .= $name1 . ' = $tagDiyfield->getDiyfield('.$name.', "'.$type.'");';

        $parseStr .= 'if(is_array(' . $name1 . ') || ' . $name1 . ' instanceof \think\Collection || ' . $name1 . ' instanceof \think\Paginator): $' . $key . ' = 0; $e = 1;$k=0;';
        // 设置了输出数组长度
        if (0 != $offset || 'null' != $length) {
            $parseStr .= '$__LIST__ = is_array(' . $name1 . ') ? array_slice(' . $name1 . ',' . $offset . ',' . $length . ', true) : ' . $name1 . '->slice(' . $offset . ',' . $length . ', true); ';
        } else {
            $parseStr .= ' $__LIST__ = ' . $name1 . ';';
        }
        $parseStr .= 'if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("' . $empty . '");';
        $parseStr .= 'else: ';
        $parseStr .= 'foreach($__LIST__ as $key=>$' . $id . '): ';
        $parseStr .= '$' . $key . '= intval($key) + 1;?>';
        $parseStr .= '<?php $mod = ($' . $key . ' % ' . $mod . ' ); ?>';
        $parseStr .= $content;
        $parseStr .= '<?php ++$e;$k++; ?>';
        $parseStr .= '<?php endforeach; endif; else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * attribute 栏目属性标签解析 TAG调用
     * {eju:attribute type='default'}
        {$field.itemname_2}:{$field.attr_2}
     * {/eju:attribute}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string|void
     */
    public function tagAttribute($tag, $content)
    {
        $aid   = !empty($tag['aid']) ? $tag['aid'] : '';
        $aid  = $this->varOrvalue($aid);
        $type   = !empty($tag['type']) ? $tag['type'] : 'default';
        $id     = isset($tag['id']) ? $tag['id'] : 'attr';
        $key    = !empty($tag['key']) ? $tag['key'] : 'i';
        $mod    = !empty($tag['mod']) && is_numeric($tag['mod']) ? $tag['mod'] : '2';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);

        $parseStr = '<?php ';

        /*aid的优先级别从高到低：标签属性值 -> 外层标签list/arclist属性值*/
        $parseStr .= ' if(empty($aid)) : $aid_tmp = '.$aid.'; endif; ';
        $parseStr .= ' $taid = 0; ';
        $parseStr .= ' if(!empty($aid_tmp)) : $taid = $aid_tmp; elseif(!empty($aid)) : $taid = $aid; endif;';
        /*--end*/

        // 查询数据库获取的数据集
        $parseStr .= ' $tagAttribute = new \think\template\taglib\eju\TagAttribute;';
        $parseStr .= ' $_result = $tagAttribute->getAttribute($taid, "'.$type.'");';
        $parseStr .= ' if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $' . $key . ' = 0; $e = 1;$k=0;';
        $parseStr .= ' $__LIST__ = $_result;';

        $parseStr .= 'if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("' . $empty . '");';
        $parseStr .= 'else: ';
        $parseStr .= 'foreach($__LIST__ as $key=>$' . $id . '): ';
        $parseStr .= '$' . $key . '= intval($key) + 1;?>';
        $parseStr .= '<?php $mod = ($' . $key . ' % ' . $mod . ' ); ?>';
        $parseStr .= $content;
        $parseStr .= '<?php ++$e;$k++; ?>';
        $parseStr .= '<?php endforeach;';
        $parseStr .= 'endif; else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * attr 标签解析
     * 在模板中获取栏目属性值
     * 格式： {eju:attr name="" /}
     * @access public
     * @param array $tag 标签属性
     * @return string
     */
    public function tagAttr($tag)
    {
        $aid   = !empty($tag['aid']) ? $tag['aid'] : '';
        $aid  = $this->varOrvalue($aid);
        $name     = isset($tag['name']) ? $tag['name'] : '';

        $parseStr = '<?php ';

        /*aid的优先级别从高到低：标签属性值 -> 外层标签list/arclist属性值*/
        $parseStr .= ' $aid_tmp = '.$aid.'; ';
        $parseStr .= ' if(!empty($aid_tmp)) : $taid = $aid_tmp; else : $taid = $aid; endif;';
        /*--end*/

        // 查询数据库获取的数据集
        $parseStr .= ' $tagAttr = new \think\template\taglib\eju\TagAttr;';
        $parseStr .= ' $__VALUE__ = $tagAttr->getAttr($taid,"'.$name.'");';
        $parseStr .= ' echo $__VALUE__;';
        $parseStr .= ' ?>';
        $parseStr .= '<?php unset($aid_tmp); ?>';

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * weapplist标签解析
     * 安装网站应用插件时自动在页面上追加代码
     * 格式： {eju:weapplist type='default'}content{/eju:weapplist}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string
     */
    public function tagWeapplist($tag, $content)
    {
        $type     = isset($tag['type']) ? $tag['type'] : 'default';
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $key     = isset($tag['key']) ? $tag['key'] : 'i';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $mod    = !empty($tag['mod']) && is_numeric($tag['mod']) ? $tag['mod'] : '2';
        $currentstyle   = !empty($tag['currentstyle']) ? $tag['currentstyle'] : '';

        $parseStr = '<?php ';

        // 查询数据库获取的数据集
        $parseStr .= ' $tagWeapplist = new \think\template\taglib\eju\TagWeapplist;';
        $parseStr .= ' $_result = $tagWeapplist->getWeapplist("'.$type.'","'.$currentstyle.'");';
        $parseStr .= ' if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $' . $key . ' = 0; $e = 1;$k=0;';
        $parseStr .= ' $__LIST__ = $_result;';

        $parseStr .= 'if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("' . $empty . '");';
        $parseStr .= 'else: ';
        $parseStr .= 'foreach($__LIST__ as $key=>$' . $id . '): ';
        $parseStr .= '$' . $key . '= intval($key) + 1;?>';
        $parseStr .= '<?php $mod = ($' . $key . ' % ' . $mod . ' ); ?>';
        $parseStr .= $content;
        $parseStr .= '<?php ++$e;$k++; ?>';
        $parseStr .= '<?php endforeach; endif; else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * screening 筛选搜索标签解析 TAG调用
     * {eju:screening id='field'}
        {$field.searchurl}
     * {/eju:screening}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string|void
     */
    public function tagScreening($tag, $content)
    {
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $key    = !empty($tag['key']) ? $tag['key'] : 'i';
        $mod    = !empty($tag['mod']) && is_numeric($tag['mod']) ? $tag['mod'] : '2';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);

        // 自定义class
        $currentstyle = !empty($tag['currentstyle']) ? $tag['currentstyle'] : '';

        // 自定义字段名
        $addfields = isset($tag['addfields']) ? $tag['addfields'] : '';
        $addfields = $this->varOrvalue($addfields);

        // 自定义字段ID
        $addfieldids = isset($tag['addfieldids']) ? $tag['addfieldids'] : '';
        $addfieldids = $this->varOrvalue($addfieldids);

        $region = !empty($tag['region']) ? $tag['region'] : 'off';  //区域关联,默认不关联
        $region = $this->varOrvalue($region);
        //显示级别，0：从头开始显示（province），1：同级开始显示（默认），2：下级开始显示
        $show = !empty($tag['show']) ? $tag['show'] : '0';
        $show = $this->varOrvalue($show);
        //开启二级域名，默认关闭,'1,2,3'
        $opencity = !empty($tag['opencity']) ? $tag['opencity'] : '';
        $opencity = $this->varOrvalue($opencity);
        //支持js选中筛选
        $ajax = !empty($tag['ajax']) ? $tag['ajax'] : 'off';
        $ajax = $this->varOrvalue($ajax);
        // 全部字样
        $alltxt = isset($tag['alltxt']) ? $tag['alltxt'] : '';
        $alltxt = $this->varOrvalue($alltxt);

        $present = isset($tag['present']) ? $tag['present'] : 'off'; //跳转当前栏目
        $present = $this->varOrvalue($present);

        $typeid  = !empty($tag['typeid']) ? $tag['typeid'] : '';
        $typeid  = $this->varOrvalue($typeid);

        $target  = !empty($tag['target']) ? $tag['target'] : '';  //是否新页面打开
        $target  = $this->varOrvalue($target);
        $regionid = !empty($tag['regionid']) ? $tag['regionid'] : '0';    //关联区域id
        $regionid = $this->varOrvalue($regionid);
        $parseStr = '<?php ';

        // 查询数据库获取的数据集
        $parseStr .= ' $tagScreening = new \think\template\taglib\eju\TagScreening;';
        $parseStr .= ' $_result = $tagScreening->getScreening("'.$currentstyle.'", '.$addfields.', '.$addfieldids.', '.$alltxt.','.$typeid.','.$target.','.$region.','.$opencity.','.$show.','.$ajax.','.$present.','.$regionid.');';
        $parseStr .= '?>';

        $parseStr .= '<?php if(!empty($_result["list"]) || (($_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator ) && $_result["list"]->isEmpty())): ?>';
        $parseStr .= '<?php $'.$id.' = $_result; ?>';
        $parseStr .= $content;
        $parseStr .= '<?php endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * region 标签解析 用于获取区域列表
     * 格式：type:son表示下级区域,self表示同级区域,top顶级区域
     * {eju:region regionid='1' type='son' row='10' pid='0' empty='' name='' id='' key='' titlelen='' offset='' mod='' currentstyle='active'}
     *  <li><a href='{$field:typelink}'>{$field:typename}</a> </li> 
     * {/eju:region}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string|void
     */
    public function tagRegion($tag, $content)
    {
        $name   = !empty($tag['name']) ? $tag['name'] : '';
        $type   = !empty($tag['type']) ? $tag['type'] : 'son';  //type:son表示下级区域,self表示同级区域,top顶级区域
        $currentstyle   = !empty($tag['currentstyle']) ? $tag['currentstyle'] : '';
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $key    = !empty($tag['key']) ? $tag['key'] : 'i';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $mod    = !empty($tag['mod']) && is_numeric($tag['mod']) ? $tag['mod'] : '2';
        $titlelen = !empty($tag['titlelen']) && is_numeric($tag['titlelen']) ? intval($tag['titlelen']) : 100;
        $offset = !empty($tag['offset']) && is_numeric($tag['offset']) ? intval($tag['offset']) : 0;
        $row = !empty($tag['row']) && is_numeric($tag['row']) ? intval($tag['row']) : 100;
        if (!empty($tag['limit'])) {
            $limitArr = explode(',', $tag['limit']);
            $offset = !empty($limitArr[0]) ? intval($limitArr[0]) : 0;
            $row = !empty($limitArr[1]) ? intval($limitArr[1]) : 0;
        }
        $domain  = !empty($tag['domain']) ? $tag['domain'] : '';   //指定子域名
        $domain  = $this->varOrvalue($domain);
        $opencity  = !empty($tag['opencity']) ? $tag['opencity'] : '';   //子域名级别（1,2,3），1：省份，2：城市，3：区域
        $orderby    = isset($tag['orderby']) ? $tag['orderby'] : '';
        $orderway    = isset($tag['orderway']) ? $tag['orderway'] : 'desc';
        $ishot    = isset($tag['ishot']) ? $tag['ishot'] : '';   //off：只显示热门城市，on：只显示非热门城市，默认显示全部
        $groupby    = isset($tag['groupby']) ? $tag['groupby'] : '';   //分组，默认不分组，可以按照区域首字母分组和上级分组（initial、parent_id）


        $typeid    = isset($tag['typeid']) ? $tag['typeid'] : '';    //跳转栏目id,值为“on”时表示获取当前栏目tid
        $typeid  = $this->varOrvalue($typeid);
        $channel    = isset($tag['channel']) ? $tag['channel'] : '';    //跳转模型id
        $channel  = $this->varOrvalue($channel);

        $province   = isset($tag['province']) ? $tag['province'] : '';  //获取所有省份价格
        $province  = $this->varOrvalue($province);
        $city   = isset($tag['city']) ? $tag['city'] : '';  //获取所有城市价格
        $city  = $this->varOrvalue($city);
        $area   = isset($tag['area']) ? $tag['area'] : ''; //获取所有区域价格
        $area  = $this->varOrvalue($area);
        $pricetype   = isset($tag['pricetype']) ? $tag['pricetype'] : 'xinfang';  //获取价格类型
        $pricetype  = $this->varOrvalue($pricetype);

        $parseStr = '<?php ';
        $parseStr .= ' $row = '.$row.';';

        if ($name) { // 从模板中传入数据集
            $symbol     = substr($name, 0, 1);
            if (':' == $symbol) {
                $name = $this->autoBuildVar($name);
                $parseStr .= '$_result=' . $name . ';';
                $name = '$_result';
            } else {
                $name = $this->autoBuildVar($name);
            }
            $parseStr .= 'if(is_array(' . $name . ') || ' . $name . ' instanceof \think\Collection || ' . $name . ' instanceof \think\Paginator): $' . $key . ' = 0; $e = 1;$k = 0;';
            // 设置了输出数组长度
            if (0 != $offset || 'null' != $row) {
                $parseStr .= '$__LIST__ = is_array(' . $name . ') ? array_slice(' . $name . ',' . $offset . ',' . $row . ', true) : ' . $name . '->slice(' . $offset . ',' . $row . ', true); ';
            } else {
                $parseStr .= ' $__LIST__ = ' . $name . ';';
            }
        } else { // 查询数据库获取的数据集
            $parseStr .= ' $param = array(';
            $parseStr .= '      "province_id"=> '.$province.',';
            $parseStr .= '      "city_id"=> '.$city.',';
            $parseStr .= '      "area_id"=> '.$area.',';
            $parseStr .= '      "pricetype"=> '.$pricetype.',';
            $parseStr .= ' );';
            $parseStr .= ' $tagRegion = new \think\template\taglib\eju\TagRegion;';
            $parseStr .= ' $_result = $tagRegion->getRegion($param,"'.$type.'", "'.$currentstyle.'", "'.$opencity.'", '.$domain.', "'.$orderby.'", "'.$orderway.'", "'.$ishot.'",'.$typeid.','.$channel.',"'.$groupby.'");';
            $parseStr .= ' if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $' . $key . ' = 0; $e = 1;$k = 0;';
            // 设置了输出数组长度
            if (0 != $offset || 'null' != $row) {
                $parseStr .= '$__LIST__ = is_array($_result) ? array_slice($_result,' . $offset . ', $row, true) : $_result->slice(' . $offset . ', $row, true); ';
            } else {
                $parseStr .= ' if(intval($row) > 0) :';
                $parseStr .= ' $__LIST__ = is_array($_result) ? array_slice($_result,' . $offset . ', $row, true) : $_result->slice(' . $offset . ', $row, true); ';
                $parseStr .= ' else:';
                $parseStr .= ' $__LIST__ = $_result;';
                $parseStr .= ' endif;';
            }
        }

        $parseStr .= 'if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("' . $empty . '");';
        $parseStr .= 'else: ';
        $parseStr .= 'foreach($__LIST__ as $key=>$' . $id . '): ';
        $parseStr .= '$' . $id . '["name"] = text_msubstr($' . $id . '["name"], 0, '.$titlelen.', false);';

        $parseStr .= ' $__LIST__[$key] = $_result[$key] = $' . $id . ';';
        $parseStr .= '$' . $key . '= intval($key) + 1;?>';
        $parseStr .= '<?php $mod = ($' . $key . ' % ' . $mod . ' ); ?>';
        $parseStr .= $content;
        $parseStr .= '<?php ++$e;$k++; ?>';
        $parseStr .= '<?php endforeach; endif; else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }


    /**
     * fanglist标签解析 获取指定文档列表（兼容tp的volist标签语法）
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string|void
     */
    public function tagFanglist($tag, $content)
    {
        $aid_tmp  = isset($tag['aid']) ? $tag['aid'] : 0;
        $aid  = $this->varOrvalue($aid_tmp);

        $name   = !empty($tag['name']) ? $tag['name'] : '';
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $key    = !empty($tag['key']) ? $tag['key'] : 'i';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $mod    = !empty($tag['mod']) && is_numeric($tag['mod']) ? $tag['mod'] : '2';
        $type   = !empty($tag['type']) ? $tag['type'] : '';
        $offset = 0;
        $length = !empty($tag['row']) && is_numeric($tag['row']) ? intval($tag['row']) : 1000;
        if (!empty($tag['limit'])) {
            $limit = str_replace('，', ',', $tag['limit']);
            $limitArr = explode(',', $limit);
            $offset = !empty($limitArr[0]) ? intval($limitArr[0]) : 0;
            $length = !empty($limitArr[1]) ? intval($limitArr[1]) : 0;
        } else {
            $limit = "{$offset},{$length}";
        }
        $orderby    = isset($tag['orderby']) ? $tag['orderby'] : '';
        $orderway    = isset($tag['orderway']) ? $tag['orderway'] : 'desc';
        $group   = !empty($tag['group']) ? $tag['group'] : '';
        $model =  !empty($tag['model']) ? $tag['model'] : 'xinfang';
        $parseStr = '<?php ';
        // 声明变量
        if (!empty($aid_tmp)) {
            $parseStr .= ' $aid = '.$aid.';';
        } else {
            $parseStr .= ' if(!isset($aid) || empty($aid)) : $aid = '.$aid.'; endif;';
        }

        if ($name) { // 从模板中传入数据集
            $symbol     = substr($name, 0, 1);
            if (':' == $symbol) {
                $name = $this->autoBuildVar($name);
                $parseStr .= '$_result=' . $name . ';';
                $name = '$_result';
            } else {
                $name = $this->autoBuildVar($name);
            }

            $parseStr .= 'if(is_array(' . $name . ') || ' . $name . ' instanceof \think\Collection || ' . $name . ' instanceof \think\Paginator): $' . $key . ' = 0; $e = 1;$k = 0;';
            // 设置了输出数组长度
            if (0 != $offset || 'null' != $length) {
                $parseStr .= '$__LIST__ = is_array(' . $name . ') ? array_slice(' . $name . ',' . $offset . ',' . $length . ', true) : ' . $name . '->slice(' . $offset . ',' . $length . ', true); ';
            } else {
                $parseStr .= ' $__LIST__ = ' . $name . ';';
            }

        } else { // 查询数据库获取的数据集
            $parseStr .= ' $tagFanglist = new \think\template\taglib\eju\TagFanglist;';
            $parseStr .= ' $_result = $tagFanglist->getFanglist("'.$type.'", $aid, "'.$limit.'", "'.$orderby.'", "'.$orderway.'", "'.$group.'","'.$model.'");';

            $parseStr .= 'if(is_array($_result["list"]) || $_result["list"] instanceof \think\Collection || $_result["list"] instanceof \think\Paginator): $' . $key . ' = 0; $e = 1;$k = 0;';
            // 设置了输出数组长度
            if (0 != $offset || 'null' != $length) {
                $parseStr .= ' $__LIST__ = is_array($_result["list"]) ? array_slice($_result["list"],' . $offset . ', '.$length.', true) : $_result["list"]->slice(' . $offset . ', '.$length.', true); ';
            } else {
                $parseStr .= ' $__LIST__ = $_result["list"];';
            }
        }
        $parseStr .= 'if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("' . $empty . '");';
        $parseStr .= 'else: ';
        $parseStr .= 'foreach($__LIST__ as $key=>$' . $id . '): ';

        $parseStr .= '$' . $key . '= intval($key) + 1;?>';
        $parseStr .= '<?php $mod = ($' . $key . ' % ' . $mod . ' ); ?>';
        $parseStr .= $content;
        $parseStr .= '<?php ++$e;$k++; ?>';
        $parseStr .= '<?php endforeach; endif; else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }

    /**
     * navig 标签解析 用于获取导航菜单列表
     * 格式：type:son表示下级导航菜单,self表示同级导航菜单,top顶级导航菜单
     * {eju:navig navigid='1' type='son' row='10' empty='' name='' id='' key='' titlelen='' offset='' mod='' currentstyle='active'}
     *  <li><a href='{$field:navig_link}'>{$field:navig_name}</a> </li> 
     * {/eju:navig}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string|void
     */
    public function tagNavig($tag, $content)
    {
        $navigid  = !empty($tag['navigid']) ? $tag['navigid'] : '';
        $navigid  = $this->varOrvalue($navigid);

        $notnavigid  = !empty($tag['notnavigid']) ? $tag['notnavigid'] : '';
        $notnavigid  = $this->varOrvalue($notnavigid);

        $name   = !empty($tag['name']) ? $tag['name'] : '';
        $type   = !empty($tag['type']) ? $tag['type'] : '';
        $currentstyle   = !empty($tag['currentstyle']) ? $tag['currentstyle'] : '';
        $id     = isset($tag['id']) ? $tag['id'] : 'field';
        $key    = !empty($tag['key']) ? $tag['key'] : 'i';
        $empty  = isset($tag['empty']) ? $tag['empty'] : '';
        $empty  = htmlspecialchars($empty);
        $mod    = !empty($tag['mod']) && is_numeric($tag['mod']) ? $tag['mod'] : '2';
        $titlelen = !empty($tag['titlelen']) && is_numeric($tag['titlelen']) ? intval($tag['titlelen']) : 100;
        $offset = !empty($tag['offset']) && is_numeric($tag['offset']) ? intval($tag['offset']) : 0;
        $row = !empty($tag['row']) && is_numeric($tag['row']) ? intval($tag['row']) : 100;
        if (!empty($tag['limit'])) {
            $limitArr = explode(',', $tag['limit']);
            $offset = !empty($limitArr[0]) ? intval($limitArr[0]) : 0;
            $row = !empty($limitArr[1]) ? intval($limitArr[1]) : 0;
        }
        $position_id  = !empty($tag['position_id']) ? $tag['position_id'] : 0;
        $position_id  = $this->varOrvalue($position_id);

        $parseStr = '<?php ';
        // 声明变量
        /*typeid的优先级别从高到低：装修数据 -> 标签属性值 -> 外层标签navigartlist属性值*/
        $parseStr .= ' $navigid = '.$navigid.';';
        $parseStr .= ' if(empty($navigid) && isset($navigartlist["navig_id"]) && !empty($navigartlist["navig_id"])) : $navigid = intval($navigartlist["navig_id"]); endif; ';
        /*--end*/
        $parseStr .= ' $row = '.$row.';';

        if ($name) { // 从模板中传入数据集
            $symbol     = substr($name, 0, 1);
            if (':' == $symbol) {
                $name = $this->autoBuildVar($name);
                $parseStr .= '$_result=' . $name . ';';
                $name = '$_result';
            } else {
                $name = $this->autoBuildVar($name);
            }

            $parseStr .= 'if(is_array(' . $name . ') || ' . $name . ' instanceof \think\Collection || ' . $name . ' instanceof \think\Paginator): $' . $key . ' = 0; $e = 1;$k=0;';
            // 设置了输出数组长度
            if (0 != $offset || 'null' != $row) {
                $parseStr .= '$__LIST__ = is_array(' . $name . ') ? array_slice(' . $name . ',' . $offset . ',' . $row . ', true) : ' . $name . '->slice(' . $offset . ',' . $row . ', true); ';
            } else {
                $parseStr .= ' $__LIST__ = ' . $name . ';';
            }

        } else { // 查询数据库获取的数据集
            $parseStr .= ' $tagNavig = new \think\template\taglib\eju\TagNavig;';
            $parseStr .= ' $_result = $tagNavig->getNavig('.$position_id.', $navigid, "'.$type.'", "'.$currentstyle.'", '.$notnavigid.');';
            $parseStr .= ' if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $' . $key . ' = 0; $e = 1;$k=0;';
            // 设置了输出数组长度
            if (0 != $offset || 'null' != $row) {
                $parseStr .= '$__LIST__ = is_array($_result) ? array_slice($_result,' . $offset . ', $row, true) : $_result->slice(' . $offset . ', $row, true); ';
            } else {
                $parseStr .= ' if(intval($row) > 0) :';
                $parseStr .= ' $__LIST__ = is_array($_result) ? array_slice($_result,' . $offset . ', $row, true) : $_result->slice(' . $offset . ', $row, true); ';
                $parseStr .= ' else:';
                $parseStr .= ' $__LIST__ = $_result;';
                $parseStr .= ' endif;';
            }
        }

        $parseStr .= 'if( count($__LIST__)==0 ) : echo htmlspecialchars_decode("' . $empty . '");';
        $parseStr .= 'else: ';
        $parseStr .= 'foreach($__LIST__ as $key=>$' . $id . '): ';
        $parseStr .= '$' . $id . '["navig_name"] = text_msubstr($' . $id . '["navig_name"], 0, '.$titlelen.', false);';

        $parseStr .= ' $__LIST__[$key] = $_result[$key] = $' . $id . ';';
        $parseStr .= '$' . $key . '= intval($key) + 1;?>';
        $parseStr .= '<?php $mod = ($' . $key . ' % ' . $mod . ' ); ?>';
        $parseStr .= $content;
        $parseStr .= '<?php ++$e;$k++; ?>';
        $parseStr .= '<?php endforeach; endif; else: echo htmlspecialchars_decode("' . $empty . '");endif; ?>';
        $parseStr .= '<?php $'.$id.' = []; ?>'; // 清除变量值，只限于在标签内部使用

        if (!empty($parseStr)) {
            return $parseStr;
        }
        return;
    }
}
