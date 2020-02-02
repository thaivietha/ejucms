<?php
/**
 * User: xyz
 * Date: 2019/12/17
 * Time: 15:54
 */

namespace think\template\taglib\eju;

use think\Db;
use app\home\logic\AskLogic;

class TagAsk extends Base
{
    public $aid = '';
    protected function _initialize()
    {
        parent::_initialize();
        $this->aid = I('param.aid/d', 0);
    }
    public function getAsk($aid,$answer = 'on',$bestanswer = 'on',$askcount = 3,$answercout = 3){
        $aid = !empty($aid) ? $aid : $this->aid;
        if (!empty($aid)){
            $param['aid'] = $aid;
        }
        $param['is_review'] = 1;
        $this->AskModel = model('Ask');
        $this->AskLogic = new AskLogic;
        // Url处理
        $UrlData = $this->AskLogic->GetUrlData($param);
        // 最新问题，默认读取20条，可传入条数及字段名称进行获取
        $Where = $this->AskLogic->GetAskWhere($param);
        $ResultAsk = $this->AskModel->GetNewAskData($Where,$askcount);
        //获取所有回答
        if ($answer == 'on'){
            $AskIds = get_arr_column($ResultAsk['AskData'], 'ask_id');
            if ($bestanswer == 'on'){
                $AnswerData = Db::name("answer")->where('ask_id','IN',$AskIds)->where("is_review","eq","1")->where("is_bestanswer","eq","1")->select();
            }else{
                $AnswerData = Db::name("answer")->where('ask_id','IN',$AskIds)->where("is_review","eq","1")->select();
            }

            $AnswerData = $this->formattingAnswer($AnswerData);

            $AnswerData = group_same_key($AnswerData, 'ask_id',$answercout);
            foreach ($ResultAsk['AskData'] as $key=>$val){
                if (!empty($AnswerData[$val['ask_id']])){
                    $ResultAsk['AskData'][$key]['AnswerData'] = $AnswerData[$val['ask_id']];
                }
            }
        }

        $result = array_merge($ResultAsk, $UrlData);
        $version   = getCmsVersion();
        $result['hidden'] = <<<EOF
        <link rel="stylesheet" type="text/css" href="{$this->root_dir}/public/static/common/css/tag_ask.css?v={$version}" />
EOF;


        return $result;
    }
    //整理显示数据
    private function formattingAnswer($RepliesData){
        $PidData = $AnswerSubData = $AnswerData = [];
        foreach ($RepliesData as $key => $value) {
            // 友好显示时间
            $value['add_time'] = friend_date($value['add_time']);

            // 处理格式
            $value['content'] = htmlspecialchars_decode($value['content']);
            // 头像处理
            $value['litpic'] = get_head_pic($value['litpic']);

            // 是否上一级回答
            if($value['answer_pid'] == 0){
                $PidData[]	  = $value;
            }else{
                $AnswerSubData[] = $value;
            }
        }
        /* END */
        /*一级回答*/
        foreach($PidData as $key => $PidValue) {
            $AnswerData[] = $PidValue;
            // 子回答
            $AnswerData[$key]['AnswerSubData'] = [];
            // 点赞数据
            $AnswerData[$key]['AnswerLike'] = [];

            /*所属子回答处理*/
            foreach ($AnswerSubData as $AnswerValue) {
                if ($AnswerValue['answer_pid'] == $PidValue['answer_id']) {
                    array_push($AnswerData[$key]['AnswerSubData'], $AnswerValue);
                }
            }
            /* END */
            /*读取指定数据*/
            // 以是否审核排序，审核的优先
            array_multisort(get_arr_column($AnswerData[$key]['AnswerSubData'], 'is_review'), SORT_DESC, $AnswerData[$key]['AnswerSubData']);
            // 读取指定条数
//            $firstRow = 0;
//            $listRows = 10;
//            $AnswerData[$key]['AnswerSubData'] = array_slice($AnswerData[$key]['AnswerSubData'], $firstRow, $listRows);
            /* END */
        }

        return $AnswerData;
    }
}