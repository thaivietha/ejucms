<?php
/**
 * User: xyz
 * Date: 2019/12/16
 * Time: 11:22
 */

namespace app\home\controller;

use think\Db;
use think\Config;
use app\home\logic\AskLogic;

class Ask extends Base
{
    public $users = [
        'users_id' => 0,
        'admin_id' => 0,
        'nickname' => '游客',
        'username' => '游客',
    ];
    public $users_id = 0;
    public $nickname = '游客';
    public $parent_id = -1;

    public function _initialize() {
        parent::_initialize();
        $this->users['litpic'] = get_head_pic();
        // 问题表
        $this->weapp_ask_db        = Db::name('ask');
        // 答案表
        $this->weapp_ask_answer_db = Db::name('answer');
        // 问题回答点赞表
        $this->weapp_ask_answer_like_db = Db::name('answer_like');
        // 问答业务层
        $this->AskLogic = new AskLogic;

        // 问答数据层
        $this->AskModel = model('Ask');

        $LatestData = $this->GetUsersLatestData();
        if (!empty($LatestData)) {
            // 会员全部信息
            $this->users = $LatestData;
            $this->users['nickname'] = !empty($LatestData['nickname']) ? $LatestData['nickname'] : $LatestData['username'];
            // 会员ID
            $this->users_id = $LatestData['users_id'];
            // 会员昵称
            $this->nickname = !empty($LatestData['nickname']) ? $LatestData['nickname'] : $LatestData['username'];
            // 后台管理员信息
//            $this->parent_id = session('admin_info.parent_id');
        }
        $this->assign('users', $this->users);
        $this->assign('nickname', $this->nickname);
        $this->assign('AdminParentId', $this->parent_id);
    }
    /**
     * 获取登录的会员最新数据
     */
    private function GetUsersLatestData($users_id = null) {
        $users_id = empty($users_id) ? session('users_id') : $users_id;
        if(!empty($users_id)) {
            $data =  Db::name('users')->field('b.*,a.*,a.id as users_id')
                ->alias('a')
                ->join('__USERS_LEVEL__ b', "a.level_id = b.id", 'LEFT')
                ->where([
                    'a.id'  => $users_id,
                ])
                ->find();
            empty($data['nickname']) && $data['nickname'] = $data['username'];
//            $data['username'] = $data['nickname'];
            empty($data['litpic']) && $data['litpic'] = ROOT_DIR . '/public/static/common/images/dfboy.png';

            return $data;
        }else{
            // session中不存在会员ID则返回空
            return false;
        }
    }
    //问答首页
    public function index(){
        $param = input('param.');
        // 查询条件处理
        $Where = $this->AskLogic->GetAskWhere($param, $this->users_id);
        // Url处理
        $UrlData = $this->AskLogic->GetUrlData($param);
        $result = $UrlData;
        $eju = array(
            'field' => $result,
            'get' => $param
        );
        $this->eju = array_merge($this->eju, $eju);
        $this->assign('eju', $this->eju);
        return $this->fetch();
    }
    /**
     * 问题详情页
     */
    public function details()
    {
        $param = input('param.');
        if (empty($param['ask_id'])) $this->error('请选择浏览的问题');
        // 增加问题浏览点击量
        $this->AskModel->UpdateAskClick($param['ask_id']);
        // 问题详情数据
        $AskDetails = $this->AskModel->GetAskDetailsData($param, $this->parent_id, $this->users_id);
        if (0 == $AskDetails['code']) $this->error($AskDetails['msg']);
        // Url处理
        $UrlData = $this->AskLogic->GetUrlData($param);

        // 数组合并加载到模板
        $result = array_merge($AskDetails, $UrlData);
        $eju = array(
            'field' => $result,
            'get' => $param
        );
        $this->eju = array_merge($this->eju, $eju);

        $this->assign('eju', $this->eju);
        $this->assign('canAnswer',$this->CanAnswer());
        return $this->fetch();
    }
    // 获取指定数量的评论数据（分页）
    public function ajax_show_comment()
    {
        if (IS_AJAX_POST) {
            $param = input('param.');
            $Comment = $this->AskModel->GetAskReplyData($param, $this->users_id);
            $Data = !empty($param['is_comment']) ? $Comment['AnswerData'][0]['AnswerSubData'] : $Comment['BestAnswer'][0]['AnswerSubData'];
            if (!empty($Data)) {
                $ResultData = $this->AskLogic->ForeachReplyHtml($Data, $this->parent_id);
                if (empty($ResultData['htmlcode'])) $this->error('没有更多数据');
                $this->success('查询成功！', null, $ResultData);
            }else{
                $this->error('没有更多数据');
            }
        }
    }
    // 采纳最佳答案
    public function ajax_best_answer()
    {
        if (IS_AJAX_POST) {
            $param = input('param.');
            if (empty($param['answer_id']) || empty($param['ask_id']) ) $this->error('请选择采纳的回答！');
            $users_id = Db::name("ask")->where("ask_id=".$param['ask_id'])->getField('users_id');
            if (!empty($this->users['admin_id']) || (!empty($users_id) && $this->users_id == $users_id)) {
                // 数据判断处理
                // 更新问题数据表
                $Updata = [
                    'ask_id'        => $param['ask_id'],
                    'status'        => 1,
                    'solve_time'    => getTime(),
                    'bestanswer_id' => $param['answer_id'],
                    'update_time'   => getTime(),
                ];
                $ResultId = $this->weapp_ask_db->update($Updata);

                if (!empty($ResultId)) {
                    // 将这个问题下的所有答案设置为非最佳答案
                    $this->weapp_ask_answer_db->where('ask_id', $param['ask_id'])->update(['is_bestanswer'=>0]);
                    // 设置当前问题为最佳答案
                    $this->weapp_ask_answer_db->where('id', $param['answer_id'])->update(['is_bestanswer'=>1]);
                    $this->success('已采纳！');
                }else{
                    $this->error('请选择采纳的回答！');
                }
            }else{
                $this->error('无操作权限！');
            }
        }
    }
    // 提交问题
    public function add_ask()
    {
        // 检测是否允许发布问题
        $this->IsRelease();
        if (IS_AJAX_POST || IS_POST) {
            $param = input('param.');
            // 是否登录、是否允许发布问题、数据判断及处理，返回内容数据
            if (empty($param['title'])){
                $param['title'] = strlen($param['content']) > 50 ?substr($param['content'],0,50).'...' : $param['content'];
            }
            $content = $this->ParamDealWith($param);
            $param['title'] = htmlspecialchars($param['title']);

            /*添加数据*/
            $AddAsk = [
                'users_id'    => $this->users_id,
                'username'  => $this->users['username'],
                'aid'   => !empty($param['aid']) ? $param['aid'] : 0,
                'ask_title'   => $param['title'],
                'content'     => $content,
                'users_ip'    => clientIP(),
                'add_time'    => getTime(),
                'update_time' => getTime(),
            ];
            // 如果这个会员组属于需要审核的，则追加
            $config = tpCache('question');
            if (1 == $config['question_ask_check']) $AddAsk['is_review'] = 0;
            /* END */

            $ResultId = $this->weapp_ask_db->add($AddAsk);
            if (!empty($ResultId)) {
                $url = $this->AskLogic->GetUrlData($param, 'NewDateUrl');
                if (1 == $config['question_ask_check']) {
                    $this->success('发布成功，但你的提问需要管理员审核！', $url, ['review' => true]);
                }else{
                    $this->success('发布成功！', $url);
                }
            }else{
                $this->error('发布的信息有误，请检查！');
            }
        }
        $param = input('param.');
        // 栏目处理
        $result = $this->AskLogic->GetUrlData();
        $result['aid'] = !empty($param['aid']) ? $param['aid'] : 0;
        $eju = array(
            'field' => $result,
        );
        $this->eju = array_merge($this->eju, $eju);
        $this->assign('eju', $this->eju);

        return $this->fetch();
    }
    // 编辑问题
    public function edit_ask()
    {
        // 是否允许发布问题
        $this->IsRelease(false);
        if (IS_AJAX_POST || IS_POST) {
            $param = input('param.');
            // 是否登录、是否允许发布问题、数据判断及处理，返回内容数据
            $content = $this->ParamDealWith($param, false);
            $param['title'] = htmlspecialchars($param['title']);
            /*添加数据*/
            $UpAsk = [
                'ask_title'   => $param['title'],
                'content'     => $content,
                'users_ip'    => clientIP(),
                'update_time' => getTime(),
            ];
            // 如果这个会员组属于需要审核的，则追加
            $config = tpCache('question');
            if (1 == $config['question_ask_check']) $UpAsk['is_review'] = 0;
            /* END */

            /*条件处理*/
            $where['ask_id'] = $param['ask_id'];
            // 不是后台管理则只能修改自己的问题
            if (empty($this->users['admin_id'])) $where['users_id'] = $this->users_id;
            /* END */

            $ResultId = $this->weapp_ask_db->where($where)->update($UpAsk);
            if (!empty($ResultId)) {
                $url = $this->AskLogic->GetUrlData($param, 'AskDetailsUrl');
                if (1 == $config['question_ask_check']) {
                    $this->success('发布成功，但你的提问需要管理员审核！', $url, ['review' => true]);
                }else{
                    $this->success('发布成功！', $url);
                }
            }else{
                $this->error('编辑的信息有误，请检查！');
            }
        }
        $ask_id = input('ask_id/d');
        $where['ask_id'] = $ask_id;
        // 不是后台管理则只能修改自己的问题
        if (empty($this->users['admin_id'])) $where['users_id'] = $this->users_id;
        $Info = $this->weapp_ask_db->where($where)->find();
        if (empty($Info)) $this->error('请选择编辑的问题！');

        // 栏目处理
//        $result = $this->AskModel->GetAskTypeData($Info, 'edit_ask');
        $result = $this->AskLogic->GetUrlData();
        $result['Info'] = $Info;
        $result['EditAskUrl'] = $this->AskLogic->GetUrlData(['ask_id'=>$ask_id], 'EditAskUrl');
        $eju = array(
            'field' => $result,
        );
        $this->eju = array_merge($this->eju, $eju);
        $this->assign('eju', $this->eju);

        return $this->fetch();
    }
    // 问题数据判断及处理，返回问题内容数据
    private function ParamDealWith($param = [], $is_add = true)
    {
        // 是否允许发布、编辑
        $this->IsRelease($is_add);
        /*数据判断*/
        $content = '';
        if (empty($param)) $this->error('请提交完整信息！');
        if (empty($param['title'])) $this->error('请填写问题标题！');
        $content = $this->AskLogic->ContentDealWith($param);
        if (empty($content)) $this->error('请填写问题描述！');
        // 编辑时执行判断
        if (empty($is_add) && empty($param['ask_id'])) $this->error('请确认编辑问题！');
        /* END */

        return $content;
    }
    // 添加回答
    public function ajax_add_answer()
    {
        if (IS_AJAX_POST || IS_POST) {
            $param = input('param.');
            // 是否允许发布、编辑
            $this->IsAnswer(true);
            // 是否登录、是否允许发布问题、数据判断及处理，返回内容数据
            $content = $this->AnswerDealWith($param, true);
            $config = tpCache('question');
            /*添加数据*/
            $AddAnswer = [
                'ask_id'      => $param['ask_id'],
                // 如果这个会员组属于需要审核的，则追加。 默认1为已审核
                'is_review'   => 1 == $config['question_ans_check'] ? 0 : 1,
                'type_id'     => $param['type_id'],
                'users_id'    => $this->users_id,
                'username'    => $this->users['username'],
                'users_ip'    => clientIP(),
                'content'     => $content,
                // 若是回答答案则追加数据
                'answer_pid'  => !empty($param['answer_id']) ? $param['answer_id'] : 0,
                // 用户则追加数据
                'at_users_id' => !empty($param['at_users_id']) ? $param['at_users_id'] : 0,
                'at_answer_id'=> !empty($param['at_answer_id']) ? $param['at_answer_id'] : 0,
                'add_time'    => getTime(),
                'update_time' => getTime(),
            ];
            $ResultId = $this->weapp_ask_answer_db->add($AddAnswer);
            /* END */

            if (!empty($ResultId)) {
                // 增加问题回复数
                $this->AskModel->UpdateAskReplies($param['ask_id'], true);
                if (1 == $config['question_ans_check']) {
                    $this->success('回答成功，但你的回答需要管理员审核！', null, ['review' => true]);
                }else{
                    $AddAnswer['answer_id'] = $ResultId;
                    $AddAnswer['head_pic']  = $this->users['litpic'];
                    $AddAnswer['at_usersname'] = '';
                    if (!empty($AddAnswer['at_users_id'])) {
                        $FindData = Db::name('users')->field('nickname, username')->where('id', $AddAnswer['at_users_id'])->find();
                        $AddAnswer['at_usersname'] = empty($FindData['nickname']) ? $FindData['username'] : $FindData['nickname'];
                    }
                    $ResultData = $this->AskLogic->GetReplyHtml($AddAnswer);
                    $this->success('回答成功！', null, $ResultData);
                }
            }else{
                $this->error('提交信息有误，请刷新重试！');
            }
        }
    }
    // 编辑回答
    public function ajax_edit_answer()
    {
        if (IS_AJAX_POST || IS_POST) {
            $param = input('param.');
            // 是否登录、是否允许发布问题、数据判断及处理，返回内容数据
            $content = $this->AnswerDealWith($param, false);
            $config = tpCache('question');
            /*编辑数据*/
            $UpAnswerData = [
                'content'     => $content,
                'users_ip'    => clientIP(),
                'update_time' => getTime(),
            ];
            // 如果这个会员组属于需要审核的，则追加
            if (1 == $config['question_ans_check']) $UpAnswerData['is_review'] = 0;
            /* END */

            // 更新条件
            $where = [
                'id' => $param['id'],
                'ask_id'    => $param['ask_id'],
            ];
            if (empty($this->users['admin_id'])) {
                $where['users_id'] = !empty($this->users_id) ? $this->users_id : -1;
            }

            // 更新数据
            $ResultId = $this->weapp_ask_answer_db->where($where)->update($UpAnswerData);
            if (!empty($ResultId)) {
                $url = $this->AskLogic->GetUrlData($param, 'AskDetailsUrl');
                if (1 == $config['question_ans_check']) {
                    $this->success('编辑成功，但你的回答需要管理员审核！', $url, ['review' => true]);
                }else{
                    $this->success('编辑成功！', $url);
                }
            } else {
                $this->error('编辑的信息有误，请检查！');
            }
        }

        $answer_id = input('param.answer_id/d');
        $where = [
            'a.id' => $answer_id,
        ];
        if (empty($this->users['admin_id'])) {
            $where['a.users_id'] = !empty($this->users_id) ? $this->users_id : -1;
        }
        $AnswerData = $this->weapp_ask_answer_db->field('a.id, a.ask_id,a.users_id, a.content, b.ask_title')
            ->alias('a')
            ->join('__ASK__ b', 'a.ask_id = b.ask_id', 'LEFT')
            ->where($where)
            ->find();

        if (empty($AnswerData)) $this->error('要修改的回答不存在！');

        // 更新人
        $AnswerData['nickname'] = $this->nickname;
        $result['Info'] = $AnswerData;
        $result['EditAnswerUrl'] = $this->AskLogic->GetUrlData(['id'=>$answer_id], 'EditAnswer');
        $result['NewDateUrl'] = $this->AskLogic->GetUrlData(null, 'NewDateUrl');
        $eju = array(
            'field' => $result,
        );
        $this->eju = array_merge($this->eju, $eju);
        $this->assign('eju', $this->eju);

        return $this->fetch('edit_answer');
    }
    // 评论回复数据处理，返回评论回复内容数据
    private function AnswerDealWith($param = [], $is_add = true)
    {

        /*数据判断*/
        if (!empty($is_add)) {
            // 添加时执行判断
            if (empty($param) || empty($param['ask_id']) ) $this->error('提交信息有误，请刷新重试！');
        }else{
            // 编辑时执行判断
            if (empty($is_add) && empty($param['ask_id'])) $this->error('请确认编辑问题！');
        }

        $content = '';
        $content = $this->AskLogic->ContentDealWith($param);
        if (empty($content)) $this->error('请写下你的回答！');
        /* END */

        return $content;
    }
    // 点赞
    public function ajax_click_like()
    {
        if (IS_AJAX_POST) {
            // 是否登录
            $this->UsersIsLogin();

            $ask_id    = input('param.ask_id/d');
            $answer_id = input('param.answer_id/d');
            if (empty($answer_id) || empty($ask_id)) $this->error('请选择点赞信息！');

            $Where = [
                'ask_id'    => $ask_id,
                'users_id'  => $this->users_id,
                'answer_id' => $answer_id,
            ];
            $IsCount = $this->weapp_ask_answer_like_db->where($Where)->count();
            if (!empty($IsCount)) {
                $this->error('您已赞过！');
            }else{
                // 添加新的点赞记录
                $AddData = [
                    'users_ip'    => clientIP(),
                    'add_time'    => getTime(),
                    'update_time' => getTime(),
                ];
                $AddData = array_merge($Where, $AddData);
                $ResultId = $this->weapp_ask_answer_like_db->add($AddData);
                if (!empty($ResultId)) {
                    unset($Where['users_id']);
                    $LikeCount = $this->weapp_ask_answer_like_db->where($Where)->count();
                    if (1 == $LikeCount) {
                        $LikeName = '<a href="javascript:void(0);">'.$this->nickname.'</a>';
                    }else{
                        $LikeName = '<a href="javascript:void(0);">'.$this->nickname.'</a>、 ';
                    }
                    $data = [
                        // 点赞数
                        'LikeCount' => $LikeCount,
                        // 点赞人
                        'LikeName'  => $LikeName,
                    ];

                    // 同步点赞次数到答案表
                    $UpdataNew = [
                        'click_like'  => $LikeCount,
                        'update_time' => getTime(),
                    ];
                    $where = [
                        'ask_id'    => $ask_id,
                        'id' => $answer_id,
                    ];
                    $this->weapp_ask_answer_db->where($where)->update($UpdataNew);
                    $this->success('点赞成功！', null, $data);
                }
            }
        }
    }


    // 是否登录
    private function UsersIsLogin()
    {
        if (empty($this->users) || empty($this->users_id)) $this->error('请先登录！');
    }
    // 是否允许发布、编辑问题
    private function IsRelease($is_add = true)
    {
        $config = tpCache('question');
        if (empty($this->users_id) && !empty($config['question_ask_status'])) {
            if (!empty($is_add)) {
                $this->error('游客不允许发布问题，请先登陆！',url('user/Users/login'));
            }else{
                $this->error('游客不允许编辑问题，请先登陆！',url('user/Users/login'));
            }
        }
    }
    //是否允许回答、编辑回答
    private function IsAnswer($is_add = true,$users_id = 0){
        if (!$this->CanAnswer($is_add,$users_id)) {
            if (!empty($is_add)) {
                $this->error('游客不允许回答问题，请先登陆！',url('user/Users/login'));
            }else{
                $this->error('不允许编辑别人的答案！');
            }
        }
    }
    //编辑时判断是否为自己的回答，$users_id为添加人的id
    private function CanAnswer($is_add = true,$users_id = 0){
        $config = tpCache('question');
        if ($is_add && (empty($this->users_id) && !empty($config['question_ans_status']))){    //回答问题
            return false;
        }else if(!$is_add && (empty($this->users_id) || $this->users_id != $users_id)){   //编辑答案，非自己的不能编辑
            return false;
        }

        return true;
    }
}