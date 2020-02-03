<?php
/**
 * User: xyz
 * Date: 2020/1/10
 * Time: 16:34
 */

namespace think\template\taglib\eju;

use think\Db;
use app\home\logic\AskLogic;

class TagAnswer extends Base
{
    public $ask_id = '';
    public $orderby = '';     //排序
    protected function _initialize()
    {
        parent::_initialize();
        $this->ask_id = I('param.ask_id/d', 0);
        $this->orderby = I('param.orderby/s', '');
    }
    public function getAnswer($ask_id,$pagesize,$orderby,$orderway){
        $page = I('param.page/d',0);
        $ask_id = !empty($ask_id) ? $ask_id : $this->ask_id;
        if (!empty($ask_id)){
            $where['ask_id'] = $ask_id;
        }else{
            echo "Answer标签错误，ask_id为必传参数！";exit;
        }
        $orderby .= " ".$orderway;

        switch ($this->orderby){
            case 'click':
                $orderby = "click_like desc";
                break;
        }
        $this->AskModel = model('Ask');
        $this->AskLogic = new AskLogic;

        // Url处理
        $UrlData = $this->AskLogic->GetUrlData($where);
        $Where = $this->AskLogic->getAnswerWhere($where);
        $ResultAsk = $this->AskModel->getNewAnswerDataList($Where,"a.*, b.nickname, b.litpic",$pagesize,$orderby);
        $result = array_merge($ResultAsk, $UrlData);
        $result['AnswerData'] = $result['list'];
        //获取最佳答案
        if (empty($page) || $page == 1){
            $bestanswer = Db::name("answer")->field("a.*, b.nickname, b.litpic")->alias("a") ->join('__USERS__ b', 'a.users_id = b.id', 'LEFT')->where("a.is_bestanswer=1")->find();
            if (!empty($bestanswer)){
                array_unshift($result['AnswerData'],$bestanswer);
                $result['count'] += 1;
            }
        }
        $answer_id = get_arr_column($result['AnswerData'], 'id');
        $secondData = Db::name("answer")->field("a.*,a.id as answer_id, b.nickname, b.litpic, c.nickname as at_usersname")->alias("a")
            ->join('__USERS__ b', 'a.users_id = b.id', 'LEFT')
            ->join('__USERS__ c', 'a.at_users_id = c.id', 'LEFT')
            ->where(['a.answer_pid'=>['IN',$answer_id]])
            ->select();
        foreach ($result['AnswerData'] as $key => $value){
            $result['AnswerData'][$key]['AnswerSubData'] = [];
            empty($value['username']) && $result['AnswerData'][$key]['username'] = "游客";
            empty($value['litpic']) && $result['AnswerData'][$key]['litpic'] = "/public/static/common/images/dfboy.png";
            $result['AnswerData'][$key]['add_time_friend'] = friend_date($value['add_time']);
            $result['AnswerData'][$key]['content'] = htmlspecialchars_decode($value['content']);
            foreach($secondData as $AnswerValue){
                empty($AnswerValue['username']) && $AnswerValue['username'] = "游客";
                empty($AnswerValue['litpic']) && $AnswerValue['litpic'] = "/public/static/common/images/dfboy.png";
                $AnswerValue['add_time_friend'] = friend_date($AnswerValue['add_time']);
                if($AnswerValue['answer_pid'] == $value['id']){
                    array_push($result['AnswerData'][$key]['AnswerSubData'], $AnswerValue);
                }
            }
        }

        return $result;
    }
}