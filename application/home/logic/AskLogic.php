<?php
/**
 * User: xyz
 * Date: 2019/12/16
 * Time: 11:43
 */

namespace app\home\logic;


class AskLogic
{
    // 问题查询条件处理
    public function GetAskWhere($param = array(), $users_id = null)
    {
        // 查询条件
        $where = [
            // 0未解决，1已解决
            'a.status' 	  => ['IN',[0, 1]],
            // 问题是否审核，1是，0否
            'a.is_review' => 1,
            'SearchName'  => null,
        ];
        //指定楼盘
        if (!empty($param['aid'])) $where['a.aid'] = $param['aid'];

        // 推荐问题
        if (!empty($param['is_recom']) && 1 == intval($param['is_recom'])) $where['a.is_recom'] = 1;
        // 待回答问题
        if (!empty($param['is_recom']) && 2 == intval($param['is_recom'])) $where['a.replies']  = 0;
        // 已解决问题
        if (!empty($param['is_recom']) && 3 == intval($param['is_recom'])) $where['a.status'] = 1;
        // 热门问题（热门问题只排序，不需要加任何条件）
//        if (!empty($param['is_recom']) && 4 == intval($param['is_recom'])) $where['']  = 0;


        // 搜索问题
        if (!empty($param['search_name'])) {
            $where['a.ask_title'] = ['LIKE', "%{$param['search_name']}%"];
            $where['SearchName']  = $param['search_name'];
        }

        return $where;
    }
    //答案查询条件
    public function getAnswerWhere($param = array(), $users_id = null){
        // 查询条件
        $where = [
            'a.is_review' => 1,
            'a.answer_pid' => 0,
            'a.is_bestanswer' =>0
        ];
        //指定问题
        if (!empty($param['ask_id'])) $where['a.ask_id'] = $param['ask_id'];
        // 搜索问题
        if (!empty($param['search_name'])) {
            $where['a.content'] = ['LIKE', "%{$param['search_name']}%"];
        }

        return $where;
    }

    // Url处理
    public function GetUrlData($param = array(), $SpecifyUrl = null)
    {
        if (empty($param['ask_id'])) $param['ask_id'] = 0;
        if (empty($param['aid'])) $param['aid'] = 0;
        $result = [];
        // 最新问题url
        $result['NewDateUrl'] = url('home/Ask/index');
        // 推荐问题url
        $result['RecomDateUrl'] = url('home/Ask/index', ['is_recom'=>1]);
        // 等待回答url
        $result['PendingAnswerUrl'] = url('home/Ask/index', ['is_recom'=>2]);
        // 已解决问题url
        $result['SolveUrl'] = url('home/Ask/index', ['is_recom'=>3]);
        // 热门问题url
        $result['HotUrl'] = url('home/Ask/index', ['is_recom'=>4]);

        // 问题详情页url
        $result['AskDetailsUrl'] = url('home/Ask/details', ['ask_id'=>$param['ask_id']]);
        // 问题详情页 -- 按点赞量排序url
        $result['AnswerLikeNum'] = url('home/Ask/details', ['ask_id' => $param['ask_id'],'orderby' =>'click'], true, false, 1, 1, 0);
        // 提交回答url
        $result['AddAnswerUrl'] = url('home/Ask/ajax_add_answer', ['ask_id'=>$param['ask_id'], '_ajax'=>1], true, false, 1, 1, 0);

        // 删除回答url
        $result['DelAnswerUrl'] = url('home/Ask/ajax_del_answer', ['ask_id'=>$param['ask_id'], '_ajax'=>1], true, false, 1, 1, 0);

        // 点赞回答url
        $result['ClickLikeUrl'] = url('home/Ask/ajax_click_like', ['_ajax'=>1], true, false, 1, 1, 0);

        // 发布问题url
        if (!empty($param['aid'])){
            $result['AddAskUrl'] = url('home/Ask/add_ask',['aid'=>$param['aid']]);
        }else{
            $result['AddAskUrl'] = url('home/Ask/add_ask');
        }
        // 提交问题url
        $result['SubmitAddAsk'] = url('home/Ask/add_ask');

        // 编辑问题url
        $result['EditAskUrl'] = url('home/Ask/edit_ask', ['ask_id'=>$param['ask_id']]);

        // 用户问题首页
        $result['UsersIndexUrl'] = url('home/Ask/ask_index');

        // 编辑回答url
        $result['EditAnswer'] = url('home/Ask/ajax_edit_answer');
        if ('ajax_edit_answer' == request()->action()) {
            $result['EditAnswer'] = url('home/Ask/ajax_edit_answer', [], true, false, 1, 1, 0);
        }

        // 采纳最佳答案url
        $result['BestAnswerUrl'] = url('home/Ask/ajax_best_answer', ['ask_id'=>$param['ask_id'], '_ajax'=>1], true, false, 1, 1, 0);

        // 获取指定数量的评论数据（分页）
        $result['ShowCommentUrl'] = url('home/Ask/ajax_show_comment', ['ask_id'=>$param['ask_id'], '_ajax'=>1], true, false, 1, 1, 0);

        // 创始人审核评论URL(前台)
        $result['ReviewCommentUrl'] = url('home/Ask/ajax_review_comment', ['ask_id'=>$param['ask_id'], '_ajax'=>1], true, false, 1, 1, 0);

        // 创始人审核问题URL(前台)
        $result['ReviewAskUrl'] = url('home/Ask/ajax_review_ask', ['_ajax'=>1], true, false, 1, 1, 0);

        // 等待回答url
        if (!empty($param['type_id'])) {
            $result['PendingAnswerUrl'] = url('home/Ask/index', ['type_id'=>$param['type_id'], 'is_recom'=>2]);
        }

        if (!empty($SpecifyUrl)) {
            if (!empty($result[$SpecifyUrl])) {
                return $result[$SpecifyUrl];
            }else{
                return $result['NewDateUrl'];
            }
        }else{
            return $result;
        }

    }

    // 关键词标红
    public function GetRedKeyWord($SearchName, $ask_title)
    {
        $ks = explode(' ',$SearchName);
        foreach($ks as $k){
            $k = trim($k);
            if($k == '') continue;
            if(ord($k[0]) > 0x80 && strlen($k) < 1) continue;
            $ask_title = str_replace($k, "<font color='red'>$k</font>", $ask_title);
        }
        return $ask_title;
    }

    // 内容转义处理
    public function ContentDealWith($param = null)
    {
        if (!empty($param['content'])) {
            $content = $param['content'];
        }else if(!empty($param['ask_content'])){
            $content = $param['ask_content'];
        }else{
            return false;
        }

        // 斜杆转义
        $content = addslashes($content);
        // 过滤内容的style属性
        $content = preg_replace('/style(\s*)=(\s*)[\'|\"](.*?)[\'|\"]/i', '', $content);
        // 过滤内容的class属性
        $content = preg_replace('/class(\s*)=(\s*)[\'|\"](.*?)[\'|\"]/i', '', $content);

        return $content;
    }

    // 栏目分类格式化输出
    public function GetTypeHtmlCode($PidData = array(), $TidData = array(), $type_id = null)
    {
        // 下拉框拼装
        $HtmlCode = '<select name="ask_type_id" id="ask_type_id">';
        $HtmlCode .= '<option value="0">请选择分类</option>';
        foreach ($PidData as $P_key => $PidValue) {
            /*是否默认选中*/
            $selected = '';
            if ($type_id == $PidValue['type_id']) $selected = 'selected';
            /* END */

            /*一级下拉框*/
            $HtmlCode .= '<option value="'.$PidValue['type_id'].'" '.$selected.'>'.$PidValue['type_name'].'</option>';
            /* END */

            foreach ($TidData as $T_key => $TidValue) {
                if ($TidValue['parent_id'] == $PidValue['type_id']) {
                    /*是否默认选中*/
                    $selected = '';
                    if ($type_id == $TidValue['type_id']) $selected = 'selected';
                    /* END */

                    /*二级下拉框*/
                    $HtmlCode .= '<option value="'.$TidValue['type_id'].'" '.$selected.'>&nbsp; &nbsp; &nbsp;'.$TidValue['type_name'].'</option>';
                    /* END */
                }
            }
        }
        $HtmlCode .= '</select>';
        return $HtmlCode;
    }

    // 拼装html代码
    public function GetReplyHtml($data = array())
    {
        $ReplyHtml = '';
        // 如果是需要审核的评论则返回空
        if (empty($data['is_review'])) return $ReplyHtml;

        /*拼装html代码*/
        // 友好显示时间
        $data['add_time'] = friend_date($data['add_time']);
        // 处理内容格式
        $data['content']  = htmlspecialchars_decode($data['content']);
        if (!empty($data['at_users_id'])) {
            $data['content'] = '回复 @'.$data['at_usersname'].':&nbsp;'.$data['content'];
        }
        // 删除评论回答URL
        $DelAnswerUrl = $this->GetUrlData($data, 'DelAnswerUrl');

        // 拼装html
        $ReplyHtml = <<<EOF
<li class="secend-li" id="{$data['answer_id']}_answer_li">
    <div class="head-secend">
        <a><img src="{$data['head_pic']}" style="width:30px;height:30px;border-radius:100%;margin-right: 16px;"></a>
        <strong>{$data['username']}</strong>
        <span style="margin:0 10px"> | </span>
        <span>{$data['add_time']}</span>
        <div style="flex-grow:1"></div>
        <span id="{$data['answer_id']}_replyA" onclick="replyUser('{$data['answer_pid']}','{$data['users_id']}','{$data['username']}','{$data['answer_id']}')" class="secend-huifu-btn" style="cursor: pointer;">回复</span>
    </div>
    <div class="secend-huifu-text">
        {$data['content']}
    </div>
</li>
EOF;
        // 返回html
        $ReturnHtml = ['review' => false, 'htmlcode' => $ReplyHtml];
        return $ReturnHtml;
    }

    // 获取指定条数的评论(分页)
    public function ForeachReplyHtml($data = array(), $parent_id = null)
    {
        $ReplyHtml = '';
        foreach ($data as $key => $value) {
            // 如果是需要审核的评论则返回空
            $review = '';
            if (empty($value['is_review']) && 0 == $parent_id) {
                // 创始人审核评论URL(前台)
                $ReviewCommentUrl = $this->GetUrlData($value, 'ReviewCommentUrl');
                $review = <<<EOF
<span id='{$value['answer_id']}_Review'>
    <span data-url='{$ReviewCommentUrl}' onclick="Review(this, '{$value['answer_id']}')" class="secend-huifu-btn" style="cursor: pointer; color: red;" title="该评论未审核，可点击审核，仅创始人可操作">审核</span>
    <span style="margin:0 10px"> | </span>
</span>
EOF;
            } else if (empty($value['is_review'])) {
                // 其他人查询数据，去除未审核评论，跳过这条数据拼装
                unset($value); continue;
            }

            /*拼装html代码*/
            if (!empty($value['at_users_id'])) {
                $value['content'] = '回复 @'.$value['at_usersname'].':&nbsp;'.$value['content'];
            }

            // 删除评论回答URL
            $DelAnswerUrl = $this->GetUrlData($value, 'DelAnswerUrl');
            // 拼装html
            $ReplyHtml .= <<<EOF
<li class="secend-li" id="{$value['answer_id']}_answer_li">
    <div class="head-secend">
        <a><img src="{$value['litpic']}" style="width:30px;height:30px;border-radius:100%;margin-right: 16px;"></a>
        <strong>{$value['username']}</strong>
        <span style="margin:0 10px"> | </span>
        <span>{$value['add_time']}</span>
        <div style="flex-grow:1"></div>
        {$review}
        <span id="{$value['answer_id']}_replyA" onclick="replyUser('{$value['answer_pid']}','{$value['users_id']}','{$value['username']}','{$value['answer_id']}')" class="secend-huifu-btn" style="cursor: pointer;">回复</span>
    </div>
    <div class="secend-huifu-text">
        {$value['content']}
    </div>
</li>
EOF;
        }

        // 返回html
        $ReturnHtml = ['review' => false, 'htmlcode' => $ReplyHtml];
        return $ReturnHtml;
    }

}