<?php
/**
 * 易优CMS
 * ============================================================================
 * 版权所有 2016-2028 海南赞赞网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.eyoucms.com
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 陈风任 <491085389@qq.com>
 * Date: 2019-7-30
 */

namespace app\common\model;

use think\Model;
use think\Db;
use think\Page;
use think\Config;
use app\home\logic\AskLogic;

/**
 * 模型
 */
class Ask extends Model
{
    //初始化
    protected function initialize()
    {
        // 需要调用`Model`的`initialize`方法
        parent::initialize();
        $this->users_db = Db::name('users'); // 会员表
        $this->weapp_ask_db = Db::name('ask'); // 问题表
        $this->weapp_ask_answer_db = Db::name('answer'); // 答案表
        $this->weapp_ask_answer_like_db = Db::name('answer_like'); // 问题回答点赞表
        $this->AskLogic = new AskLogic;
    }

    // 用户信息及问题回答数据
    public function GetUsersAskCount($view_uid = null)
    {
        // 返回参数
        $result = [];

        // 查询会员信息
        $users = session('users');
        if (!empty($users) && $users['users_id'] == $view_uid) {
            $result = [
                'NickName' => $users['nickname'],
                'HeadPic'  => $users['litpic'],
                'IsLogin'  => 1,
            ];
        }else{
            $UsersInfo = $this->users_db->field('nickname,litpic')->where('users_id', $view_uid)->find();
            if (!empty($UsersInfo)) {
                $result = [
                    'NickName' => $UsersInfo['nickname'],
                    'HeadPic'  => $UsersInfo['litpic'],
                    'IsLogin'  => 0,
                ];
            }
        }

        // 问答数量
        if (!empty($result['NickName'])) {
            // 查询问题数量
            $result['AskCount'] = $this->weapp_ask_db->where('users_id', $view_uid)->count();
            // 查询回答数量
            $result['AnswerCount'] = $this->weapp_ask_answer_db->where('users_id', $view_uid)->count();
        }

        // 拼装URL
        $result['UsersAskUrl']    = url('home/Ask/ask_index', ['view_uid'=>$view_uid]);
        // ROOT_DIR.'/index.php?m=home&c=Ask&a=ask_index&view_uid='.$view_uid;
        $result['UsersAnswerUrl'] = url('home/Ask/ask_index', ['view_uid'=>$view_uid, 'method'=>'answer']);
        // ROOT_DIR.'/index.php?m=home&c=Ask&a=ask_index&view_uid='.$view_uid.'&method=answer';
        return $result;
    }

    // 会员问题回答数据
    public function GetUsersAskData($view_uid = null, $is_ask = true)
    {
        // 返回参数
        $result = [];
        $field = 'a.ask_id, a.ask_title, a.click, a.replies, a.add_time, a.is_review, b.id, b.nickname';
        if (!empty($is_ask)) {
            // 提问问题查询列表
            $where = [
                'a.status'   => ['IN',[0,1]],
                'a.users_id' => $view_uid,
            ];

            /* 分页 */
            $count   = $this->weapp_ask_db->alias('a')->where($where)->count('ask_id');
            $pageObj = new Page($count, 10);
            $result['pageStr'] = $pageObj->show();
            /* END */

            /*问题表数据(问题表+会员表+问题分类表)*/
            $result['AskData'] = $this->weapp_ask_db->field($field)
                ->alias('a')
                ->join('__USERS__ b', 'a.users_id = b.id', 'LEFT')
                ->where($where)
                ->order('a.add_time desc')
                ->limit($pageObj->firstRow.','.$pageObj->listRows)
                ->select();
            /* END */

            /*问题回答人查询*/
            $ask_id = get_arr_column($result['AskData'], 'ask_id');
            $RepliesData = $this->weapp_ask_answer_db->field('a.ask_id, a.users_id, b.nickname')
                ->alias('a')
                ->join('__USERS__ b', 'a.users_id = b.id', 'LEFT')
                ->where('ask_id', 'IN', $ask_id)
                ->select();
            /* END */
        }else{
            // 回答问题查询列表
            /*问题回答人查询*/
            $RepliesData = $this->weapp_ask_answer_db->field('a.ask_id, a.users_id, b.nickname')
                ->alias('a')
                ->join('__USERS__ b', 'a.users_id = b.id', 'LEFT')
                ->select();
            /* END */

            /* 查询条件 */
            $UsersIds = group_same_key($RepliesData, 'users_id');
            $ask_ids  = get_arr_column($UsersIds[$view_uid], 'ask_id');
            // 按主键去重
            $ask_ids  = array_unique($ask_ids, SORT_REGULAR);
            $where = [
                'a.status'   => ['IN', [0, 1]],
                'a.ask_id' 	 => ['IN', $ask_ids],
            ];
            /* END */

            /* 分页 */
            $count 	 = $this->weapp_ask_db->alias('a')->where($where)->count('ask_id');
            $pageObj = new Page($count, 10);
            $result['pageStr'] = $pageObj->show();
            /* END */

            /*问题表数据(问题表+会员表+问题分类表)*/
            $result['AskData'] = $this->weapp_ask_db->field($field)
                ->alias('a')
                ->join('__USERS__ b', 'a.users_id = b.id', 'LEFT')
                ->where($where)
                ->order('a.add_time desc')
                ->limit($pageObj->firstRow.','.$pageObj->listRows)
                ->select();
            /* END */
        }

        // 取出提问问题的ID作为主键
        $RepliesData = group_same_key($RepliesData, 'ask_id');

        /*数据处理*/
        foreach ($result['AskData'] as $key => $value) {
            // 时间友好显示处理
            $result['AskData'][$key]['add_time'] = friend_date($value['add_time']);
            // 问题内容Url
            $result['AskData'][$key]['AskUrl']   = url('home/Ask/details', ['ask_id'=>$value['ask_id']]);
            // ROOT_DIR.'/index.php?m=home&c=Ask&a=details&ask_id='.$value['ask_id'];
            // 回复处理
            if (!empty($RepliesData[$value['ask_id']])) {
                $UsersConut = array_values(array_unique($RepliesData[$value['ask_id']], SORT_REGULAR));
                $result['AskData'][$key]['UsersConut'] = '等'.count($UsersConut).'人参与讨论';
            }else{
                $UsersConut = ['0'=>['nickname'=>$value['nickname']]];
                $result['AskData'][$key]['UsersConut'] = $value['nickname'];
            }
            // 处理参与讨论者的A标签跳转
            foreach ($UsersConut as $kkk => $vvv) {
                $nickname = $vvv['nickname'];
                if (($kkk + 1) == count($UsersConut) || 2 == $kkk) {
                    $result['AskData'][$key]['NickName'] .= '<a href="javascript:void(0);">'. $nickname .'</a>';
                    break;
                }else{
                    $result['AskData'][$key]['NickName'] .= '<a href="javascript:void(0);">'. $nickname .'</a>、';
                }
            }
        }
        /* END */

        return $result;
    }

    // 问题数据
    public function GetNewAskData($where = array(), $limit = 20, $field = null)
    {
        // 返回参数
        $result = [];
        // 没有传入则默认查询这些字段
        if (empty($field)) {
            $field = 'a.*, b.nickname, b.litpic';
        }

        $result['PendingAsk'] = '';
        if (isset($where['a.replies']) && 0 == $where['a.replies']) {
            $result['PendingAsk'] = '待回答';
        }

        // 提取搜索关键词
        if (!empty($where['SearchName']) || null == $where['SearchName']) {
            $SearchName = $where['SearchName'];
            unset($where['SearchName']);
            $result['SearchName']    = $SearchName;
            $result['SearchNameRed'] = "搜索 <font color='red'>".$SearchName."</font> 结果";
        }

        if (!empty($where['a.type_id'])) {
            // 查询满足要求的总记录数
            $count = $this->weapp_ask_db->alias('a')->where($where)->count('ask_id');
            // 实例化分页类 传入总记录数和每页显示的记录数
            $pageObj = new \weapp\Ask\logic\PageLogic($count, 10);
            /*问题表数据(问题表+会员表+问题分类表)*/
            $result['AskData'] = $this->weapp_ask_db->field($field)
                ->alias('a')
                ->join('__USERS__ b', 'a.users_id = b.id', 'LEFT')
                ->where($where)
                ->order('a.ask_id desc')
                ->limit($pageObj->firstRow.','.$pageObj->listRows)
                ->select();
            // 分页显示输出
            $result['pageStr'] = $pageObj->show();
        }else{
            /*问题表数据(问题表+会员表+问题分类表)*/
            $result['AskData'] = $this->weapp_ask_db->field($field)
                ->alias('a')
                ->join('__USERS__ b', 'a.users_id = b.id', 'LEFT')
                ->where($where)
                ->order('a.ask_id desc')
                ->limit($limit)
                ->select();
            /* END */
            $result['pageStr'] = '';
        }

        /*问题回答人查询*/
        $ask_id = get_arr_column($result['AskData'], 'ask_id');
        $RepliesData = $this->weapp_ask_answer_db->field('a.ask_id, a.users_id, b.litpic, b.nickname')
            ->alias('a')
            ->join('__USERS__ b', 'a.users_id = b.id', 'LEFT')
            ->where('ask_id', 'IN', $ask_id)
            ->select();
        $RepliesDataNew = [];
        foreach ($RepliesData as $key => $value) {
            /*头像处理*/
            $value['litpic'] = get_head_pic($value['litpic']);
            /* END */
            // 将二维数组以ask_id值作为键，并归类数组，效果同等group_same_key
            $RepliesDataNew[$value['ask_id']][] = $value;
        }
        /* END */

        /*数据处理*/
        foreach ($result['AskData'] as $key => $value) {
            /*头像处理*/
            $value['litpic'] = get_head_pic($value['litpic']);
            $result['AskData'][$key]['litpic'] = $value['litpic'];
            /* END */
            $result['AskData'][$key]['content'] = htmlspecialchars_decode($value['content']);
            // 若存在搜索关键词则标红关键词
            if (isset($SearchName) && !empty($SearchName)) {
                $result['AskData'][$key]['ask_title'] = $this->AskLogic->GetRedKeyWord($SearchName, $value['ask_title']);
            }

            // 时间友好显示处理
            $result['AskData'][$key]['add_time'] = friend_date($value['add_time']);
            // 栏目分类Url
            $result['AskData'][$key]['TypeUrl'] = url('home/Ask/index', ['type_id'=>$value['type_id']]);
            // ROOT_DIR.'/index.php?m=home&c=Ask&a=index&type_id='.$value['type_id'];
            // 问题内容Url
            $result['AskData'][$key]['AskUrl']  = url('home/Ask/details', ['ask_id'=>$value['ask_id']]);
            // ROOT_DIR.'/index.php?m=home&c=Ask&a=details&ask_id='.$value['ask_id'];
            // 回复处理
            if (!empty($RepliesDataNew[$value['ask_id']])) {
                $UsersConut = array_unique($RepliesDataNew[$value['ask_id']], SORT_REGULAR);
                // 读取前三条数据
                $result['AskData'][$key]['HeadPic']    = array_slice($UsersConut, 0, 3);
                $result['AskData'][$key]['UsersConut'] = '等'.count($UsersConut).'人参与讨论';
            }else{
                $result['AskData'][$key]['HeadPic']    = ['0'=>['litpic'=>$value['litpic']]];
                $result['AskData'][$key]['UsersConut'] = $value['nickname'];
            }
        }
        /* END */

        // 是否推荐
        if (!empty($where['a.is_recom'])) {
            $result['IsRecom'] = 1;
        }else{
            $result['IsRecom'] = 0;
        }

        return $result;
    }

    // 问题栏目分类数据
    public function GetAskTypeData($param = array(), $is_add = null)
    {
        // 数据初始化
        $result = [
            'IsTypeId' => 0,
            'ParentId' => 0,
            'TypeId'   => 0,
            'TypeName' => '',
            'HtmlCode' => '<span style="color: red;">请先让管理员在插件栏目列表中添加分类！</span>',
            'TypeData' => []
        ];

        /* END */

        return $result;

    }

    // 周榜
    public function GetAskWeekListData()
    {
        $time1 = strtotime(date('Y-m-d H:i:s', time()));
        $time2 = $time1 - (86400 * 7);
        $where = [
            'a.add_time' => ['between time', [$time2, $time1]],
            'a.is_review'=> 1,
        ];
        $result['WeekList'] = [];
        $WeekList = $this->weapp_ask_db->field('a.ask_id, a.ask_title, a.click, a.replies, b.litpic')
            ->alias('a')
            ->join('__USERS__ b', 'a.users_id = b.id', 'LEFT')
            ->order('click desc, replies desc')
            ->where($where)
            ->limit('0, 10')
            ->select();
        if (empty($WeekList)) {
            return $result;
        }

        foreach ($WeekList as $key => $value) {
            $result['WeekList'][$key]['AskUrl'] = url('home/Ask/details', ['ask_id'=>$value['ask_id']]);
            // ROOT_DIR.'/index.php?m=home&c=Ask&a=details&ask_id='.$value['ask_id'];
            $result['WeekList'][$key]['ask_title'] = mb_strimwidth($value['ask_title'], 0, 30, "...");
        }

        return $result;
    }

    // 总榜
    public function GetAskTotalListData()
    {
        $result['TotalList'] = [];
        $TotalList = $this->weapp_ask_db->field('a.ask_id, a.ask_title, a.click, a.replies, b.litpic')
            ->alias('a')
            ->join('__USERS__ b', 'a.users_id = b.id', 'LEFT')
            ->order('click desc, replies desc')
            ->where('a.is_review', 1)
            ->limit('0, 10')
            ->select();
        if (empty($TotalList)) {
            return $result;
        }

        foreach ($TotalList as $key => $value) {
            $result['TotalList'][$key]['AskUrl']  = url('home/Ask/details', ['ask_id'=>$value['ask_id']]);
            // ROOT_DIR.'/index.php?m=home&c=Ask&a=details&ask_id='.$value['ask_id'];
            $result['TotalList'][$key]['ask_title'] = mb_strimwidth($value['ask_title'], 0, 30, "...");
        }

        return $result;
    }

    // 问题详情数据
    public function GetAskDetailsData($param = array(),  $parent_id = null, $users_id = null)
    {
        $ResultData['code'] = 1;
        $ResultData['info'] = $this->weapp_ask_db->field('a.*, b.username, b.nickname, b.litpic')
            ->alias('a')
            ->join('__USERS__ b', 'a.users_id = b.id', 'LEFT')
            ->where('ask_id', $param['ask_id'])
            ->find();
        if (empty($ResultData['info'])) return ['code'=>0,'msg'=>'浏览的问题不存在！'];
        if (0 !== $parent_id) {
            if (0 == $ResultData['info']['is_review'] && $ResultData['info']['users_id'] !== $users_id){
                return ['code'=>0,'msg'=>'问题未审核通过，暂时不可浏览！'];
            }
        }

        // 头像处理
        $ResultData['info']['litpic'] = get_head_pic($ResultData['info']['litpic']);

        // 时间友好显示处理
        $ResultData['info']['add_time'] = friend_date($ResultData['info']['add_time']);
        $ResultData['IsUsers'] = 0;
        $session_users_id = session('users_id');
        if (!empty($session_users_id) && $ResultData['info']['users_id'] == $session_users_id){
            $ResultData['IsUsers'] = 1;
        }

        // 处理格式
        $ResultData['info']['content'] = htmlspecialchars_decode($ResultData['info']['content']);

        $ResultData['SearchName'] = null;
        return $ResultData;
    }

    // 问题回答数据
    public function GetAskReplyData($param = array(), $users_id = null)
    {
        /*查询条件*/
        $bestanswer_id = $this->weapp_ask_db->where('ask_id', $param['ask_id'])->getField('bestanswer_id');
        $RepliesWhere = ['ask_id' => $param['ask_id'], 'is_review' => 1];
        $WhereOr = [];
        if (!empty($users_id)){
            $RepliesWhere = ['ask_id' => $param['ask_id']];
            $WhereOr = ['users_id'=>$users_id, 'is_review' => 1];
        }
        if (!empty($param['answer_id'])) {
            $RepliesWhere = ['is_review' => 1];
            $WhereOr = ['a.id' => $param['answer_id'], 'answer_pid' => $param['answer_id']];
        }
        /* END */
        /*评论读取条数*/
        $firstRow = !empty($param['firstRow']) ? $param['firstRow'] : 0;
        $listRows = !empty($param['listRows']) ? $param['listRows'] : 5;
        $result['firstRow'] = $firstRow;
        $result['listRows'] = $listRows;
        /* END */

        /*排序*/
        $OrderBy = !empty($param['click_like']) ? 'a.click_like '.$param['click_like'].', a.add_time asc' : 'a.add_time asc';
        $click_like = isset($param['click_like']) ? $param['click_like'] : '';
        $result['SortOrder'] = 'desc' == $click_like ? 'asc' : 'desc';
        /* END */

        /*评论回答*/
        $RepliesData = $this->weapp_ask_answer_db->field('a.*,a.id as answer_id, b.litpic, b.nickname, c.nickname as `at_usersname`')
            ->alias('a')
            ->join('__USERS__ b', 'a.users_id = b.id', 'LEFT')
            ->join('__USERS__ c', 'a.at_users_id = c.id', 'LEFT')
            ->order($OrderBy)
            ->where(function ($query) use ($RepliesWhere) {
              $query->where($RepliesWhere);
            })->where(function ($query) use ($WhereOr) {
                $query->whereOr($WhereOr);
              })
//            ->where($RepliesWhere)
//            ->WhereOr($WhereOr)
            ->select();
        if (empty($RepliesData)) return [];
        /* END */

        /*点赞数据*/
        $AnswerIds = get_arr_column($RepliesData, 'answer_id');
        $AnswerLikeData = $this->weapp_ask_answer_like_db->field('a.*, b.nickname')
            ->alias('a')
            ->join('__USERS__ b', 'a.users_id = b.id', 'LEFT')
            ->order('id desc')
            ->where('answer_id','IN',$AnswerIds)
            ->select();
        $AnswerLikeData = group_same_key($AnswerLikeData, 'answer_id');
        /* END */

        /*回答处理*/
        $PidData = $AnswerData = [];
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
                $AnswerData[] = $value;
            }
        }
        /* END */

        /*一级回答*/
        foreach($PidData as $key => $PidValue){

            $result['AnswerData'][] = $PidValue;
            // 子回答
            $result['AnswerData'][$key]['AnswerSubData'] = [];
            // 点赞数据
            $result['AnswerData'][$key]['AnswerLike'] = [];

            /*所属子回答处理*/
            foreach($AnswerData as $AnswerValue){
                if($AnswerValue['answer_pid'] == $PidValue['answer_id']){
                    array_push($result['AnswerData'][$key]['AnswerSubData'], $AnswerValue);
                }
            }
            /* END */

            /*读取指定数据*/
            // 以是否审核排序，审核的优先
            array_multisort(get_arr_column($result['AnswerData'][$key]['AnswerSubData'],'is_review'), SORT_DESC, $result['AnswerData'][$key]['AnswerSubData']);
            // 读取指定条数
            $result['AnswerData'][$key]['AnswerSubData'] = array_slice($result['AnswerData'][$key]['AnswerSubData'], $firstRow, $listRows);
            /* END */

            $result['AnswerData'][$key]['AnswerLike']['LikeNum']  = null;
            $result['AnswerData'][$key]['AnswerLike']['LikeName'] = null;
            /*点赞处理*/
            foreach ($AnswerLikeData as $LikeKey => $LikeValue) {
                if($PidValue['answer_id'] == $LikeKey){
                    // 点赞总数
                    $LikeNum = count($LikeValue);
                    $result['AnswerData'][$key]['AnswerLike']['LikeNum'] = $LikeNum;
                    for ($i=0; $i < $LikeNum; $i++) {
                        // 获取前三个点赞人处理后退出本次for
                        if ($i > 2) break;
                        // 点赞人用户名\昵称
                        $LikeName = $LikeValue[$i]['nickname'];
                        // 在第二个数据前加入顿号，拼装a链接
                        if ($i != 0) {
                            $LikeName = ' 、<a href="javascript:void(0);">'. $LikeName .'</a>';
                        }else{
                            $LikeName = '<a href="javascript:void(0);">'. $LikeName .'</a>';
                        }
                        $result['AnswerData'][$key]['AnswerLike']['LikeName'] .= $LikeName;
                    }
                }
            }
            /* END */
        }
        /* END */

        /*最佳答案数据*/
        foreach ($result['AnswerData'] as $key => $value) {

            if ($bestanswer_id == $value['answer_id']) {
                $result['BestAnswer'][$key] = $value;
                unset($result['AnswerData'][$key]);
            }
        }
        /* NED */

        // 统计回答数
        $result['AnswerCount'] = count($RepliesData);
        return $result;
    }

    // 操作问题表回复数
    public function UpdateAskReplies($ask_id = null, $IsAdd = true, $DelNum = 0)
    {
        if (empty($ask_id)) return false;
        if (!empty($IsAdd)) {
            $Updata = [
                'replies' => Db::raw('replies+1'),
                'update_time' => getTime(),
            ];
        }else{
            $Updata = [
                'replies' => Db::raw('replies-1'),
                'update_time' => getTime(),
            ];
            if ($DelNum > 0) $Updata['replies'] = Db::raw('replies-'.$DelNum);
        }
        $this->weapp_ask_db->where('ask_id', $ask_id)->update($Updata);
    }

    // 增加问题浏览点击量
    public function UpdateAskClick($ask_id = null)
    {
        if (empty($ask_id)) return false;
        $Updata = [
            'click' => Db::raw('click+1'),
            'update_time' => getTime(),
        ];
        $this->weapp_ask_db->where('ask_id', $ask_id)->update($Updata);
    }


    // 会员中心--问题中心--我的问题\回复
    public function GetUsersAskDataNew($view_uid = null, $is_ask = true)
    {
        // 返回参数
        $result = [];
        if (!empty($is_ask)) {
            // 提问问题查询列表
            /*查询字段*/
            $field = 'a.ask_id, a.ask_title, a.click, a.replies, a.add_time, a.is_review';
            /* END */

            /*查询条件*/
            $where = [
                'a.status'   => ['IN', [0, 1]],
                'a.users_id' => $view_uid,
            ];
            /* END */

            /* 分页 */
            $count   = $this->weapp_ask_db->alias('a')->where($where)->count('ask_id');
            $pageObj = new Page($count, 10);
            $result['pageStr'] = $pageObj->show();
            /* END */

            /*问题表数据(问题表+会员表+问题分类表)*/
            $result['AskData'] = $this->weapp_ask_db->field($field)
                ->alias('a')
                ->where($where)
                ->order('a.add_time desc')
                ->limit($pageObj->firstRow.','.$pageObj->listRows)
                ->select();
            /* END */
        }else{
            // 回答问题查询列表
            /*查询字段*/
            $field = 'a.*, b.ask_title';
            /* END */

            /*查询条件*/
            $where = [
                'a.users_id' => $view_uid,
            ];
            /* END */

            /* 分页 */
            $count   = $this->weapp_ask_answer_db->alias('a')->where($where)->count('answer_id');
            $pageObj = new Page($count, 5);
            $result['pageStr'] = $pageObj->show();
            /* END */

            /*问题回答人查询*/
            $result['AskData'] = $this->weapp_ask_answer_db->field($field)
                ->alias('a')
                ->join('__WEAPP_ASK__ b', 'a.ask_id = b.ask_id', 'LEFT')
                ->where($where)
                ->order('a.add_time desc')
                ->limit($pageObj->firstRow.','.$pageObj->listRows)
                ->select();
            /* END */
        }

        /*数据处理*/
        foreach ($result['AskData'] as $key => $value) {
            // 问题内容Url
            $result['AskData'][$key]['AskUrl'] = url('home/Ask/details', ['ask_id'=>$value['ask_id']]);
            // ROOT_DIR.'/index.php?m=home&c=Ask&a=details&ask_id='.$value['ask_id'];
            if (empty($is_ask)) {
                $result['AskData'][$key]['AskUrl'] .= !empty($value['answer_pid']) ? '#ul_div_li_'.$value['answer_pid'] : '#ul_div_li_'.$value['answer_id'];
            }

            if (isset($value['answer_id']) && !empty($value['answer_id'])) {
                $preg = '/<img.*?src=[\"|\']?(.*?)[\"|\']?\s.*?>/i';
                $value['content'] = htmlspecialchars_decode($value['content']);
                $value['content'] = preg_replace($preg,'[图片]',$value['content']);
                $value['content'] = strip_tags($value['content']);
                $result['AskData'][$key]['content'] = mb_strimwidth($value['content'], 0, 120, "...");
            }
        }
        /* END */

        return $result;
    }
}