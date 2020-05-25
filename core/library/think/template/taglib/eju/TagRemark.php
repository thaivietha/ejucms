<?php
/**
 * User: xyz
 * Date: 2020/3/31
 * Time: 18:20
 */

namespace think\template\taglib\eju;

use think\Db;

class TagRemark extends Base
{
    public $aid = '';
    protected function _initialize()
    {
        parent::_initialize();
        $this->aid = I('param.aid/d', 0);
    }
    public function getRemark($aid,$formid,$success,$beforeSubmit){
        $aid = !empty($aid) ? $aid : $this->aid;
        $md5 = md5(getTime().uniqid(mt_rand(), TRUE));
        $formid .= $md5;
        $token_id = md5('remark_token_'.$md5);
        $img_url = url("api/Ajax/vertify",['type'=>'form_submit']);
        $SubmitAdd = url('home/Remark/add');
        $version   = getCmsVersion();
        $tokenStr = <<<EOF
         <link rel="stylesheet" type="text/css" href="{$this->root_dir}/public/static/common/css/tag_remark.css?v={$version}" />
        <script>
                            $(function(){
                                var init = {'price':3,'place' : 3,'mating' : 3,'traffic' : 3,'science' : 3};
                                $('.score-grade i').on('mouseenter',function () {
                                    var index = $(this).index()+ 1,score = $(this).data('value');
                                    $(this).prevAll().addClass('on');
                                    $(this).addClass('on');
                                    $(this).nextAll().removeClass('on');
                                    $(this).parent().parent().find('.one-score').text(score);
                                });
                                $('.score-grade').on('mouseleave',function () {
                                    var title = $(this).data('title');
                                    $(this).find('.on').removeClass('on');
                                    var count = init[title];
                                    if(count == 5) {
                                        $(this).find('i').addClass('on');
                                    } else {
                                        $(this).find('i').eq(count).prevAll().addClass('on');
                                    }
                                    $(this).parent().find('.one-score').text(init[title]);
                                });
                                $('.score-grade i').on('click',function () {
                                    var total = 0,len  = 5,average = 0,score = $(this).data('value'),parent = $(this).parent(),title = parent.data('title');
                                    $(this).prevAll().addClass('on');
                                    $(this).addClass('on');
                                    init[title] = score;
                                    parent.parent().find('.one-score').text(score);
                                    for(var i in init)
                                    {
                                        total += init[i];
                                    }
                                    average = 1*(total / len).toFixed(1);
                                    $("#"+title).val(score);
                                    $("#score").val(average);
                                    $("#average-score").text(average);
                                });
                            });
                            function SubmitRemarkData(obj) {
                                if (!$('#content').val()) {
                                    alert('请填写评论内容！');
//                                    layer.msg('请填写评论内容！', {time: 1500, icon: 2});
                                    return false;
                                }
                                var content = $('#content').val();
                                $.ajax({
                                    url: $(obj).data('url'),
                                    data: $('#{$formid}').serialize(),
                                    type:'post',
                                    dataType:'json',
                                    success:function(res){
//                                        layer.closeAll();
                                        alert(res.msg);
                                        if (1 == res.code) {
                                            location.reload();
//                                            layer.msg(res.msg, {time: 1000},function(){
//                                                location.reload();
//                                            });
                                        } else {
                                            if (res.url != null && res.url != ''){
                                                    window.location.href = res.url;
                                                }else{
                                                    $('#LAY-user-get-vercode').trigger('click');
                                                }
//                                            layer.msg(res.msg, {time: 1500, icon: 2},function () {
//                                                if (res.url != null && res.url != ''){
//                                                    window.location.href = res.url;
//                                                }else{
//                                                    $('#LAY-user-get-vercode').trigger('click');
//                                                }
//                                            });
                                        }
                                    },
                                    error : function() {
                                        alert('网络失败，请刷新页面后重试');
//                                        layer.closeAll();
//                                        layer.alert('网络失败，请刷新页面后重试', {icon: 5, closeBtn: 0});
                                    }
                                });
                            }
                            $(document).on('click','.changeVerifyRemark', function(){
                                var src = "{$img_url}";
                                if (src.indexOf('?') > -1) {
                                    src += '&';
                                } else {
                                    src += '?';
                                }
                                src += 'r='+Math.floor(Math.random()*100);
                                $("#LAY-user-get-vercode").attr('src', src);//重载验证码
                            });
                        </script>

EOF;
        $hidden = '<form action="#" id="'.$formid.'">
                                        <div class="select-score clearfix">
                                            <ul class="select-score-left fl">
                                                <li>
                                                    <span class="score-name">价格：</span>
                                                    <span class="score-grade" data-title="price">
                                                        <i class="on" data-value="1"></i>
                                                        <i class="on" data-value="2"></i>
                                                        <i class="on" data-value="3"></i>
                                                        <i data-value="4"></i>
                                                        <i data-value="5"></i>
                                                    </span>
                                                    <span class="score-desc color-red"><span class="one-score">3</span>分</span>
                                                    <span class="score-desc">项目性价比情况</span>
                                                </li>
                                                <li>
                                                    <span class="score-name">地段：</span>
                                                    <span class="score-grade" data-title="place">
                                                        <i class="on" data-value="1"></i>
                                                        <i class="on" data-value="2"></i>
                                                        <i class="on" data-value="3"></i>
                                                        <i data-value="4"></i>
                                                        <i data-value="5"></i>
                                                    </span>
                                                    <span class="score-desc color-red"><span class="one-score">3</span>分</span>
                                                    <span class="score-desc">项目所在地理位置情况</span>
                                                </li>
                                                <li>
                                                    <span class="score-name">配套：</span>
                                                    <span class="score-grade" data-title="mating">
                                                        <i class="on" data-value="1"></i>
                                                        <i class="on" data-value="2"></i>
                                                        <i class="on" data-value="3"></i>
                                                        <i data-value="4"></i>
                                                        <i data-value="5"></i>
                                                    </span>
                                                    <span class="score-desc color-red"><span class="one-score">3</span>分</span>
                                                    <span class="score-desc">配套与项目的距离及规模大小</span>
                                                </li>
                                                <li>
                                                    <span class="score-name">交通：</span>
                                                    <span class="score-grade" data-title="traffic">
                                                        <i class="on" data-value="1"></i>
                                                        <i class="on" data-value="2"></i>
                                                        <i class="on" data-value="3"></i>
                                                        <i data-value="4"></i>
                                                        <i data-value="5"></i>
                                                    </span>
                                                    <span class="score-desc color-red"><span class="one-score">3</span>分</span>
                                                    <span class="score-desc">项目到交通实际距离远近</span>
                                                </li>
                                                <li>
                                                    <span class="score-name">环境：</span>
                                                    <span class="score-grade" data-title="science">
                                                        <i class="on" data-value="1"></i>
                                                        <i class="on" data-value="2"></i>
                                                        <i class="on" data-value="3"></i>
                                                        <i data-value="4"></i>
                                                        <i data-value="5"></i>
                                                    </span>
                                                    <span class="score-desc color-red"><span class="one-score">3</span>分</span>
                                                    <span class="score-desc">项目内绿化及周边污染情况</span>
                                                </li>
                                            </ul>
                                            <div class="select-score-right fl">
                                                <div class="score-average">综合评分</div>
                                                <div class="score-average-point color-red"><span id="average-score">3</span>分</div>
                                                <div class="score-average-desc">根据评分项目自动计算</div>
                                            </div>
                                        </div>
                                        <div class="form">
                                            <p>
                                                <textarea name="content" id="content" cols="30" rows="10" placeholder="请输入评论内容"></textarea>
                                            </p>
                                            <div class="submit clearfix">
                                                <div class="verify fl">
                                                    <input type="text" placeholder="填写验证码" name="verify" id="verify">
                                                    <img src="'.$img_url.'" style="height: 40px;" class="changeVerifyRemark" id="LAY-user-get-vercode" alt="验证码">
                                                    <span class="changeVerifyRemark">换一张</span>
                                                </div>
                                                <input type="hidden" id="price" name="price" value="3">
                                                <input type="hidden" id="place" name="place" value="3">
                                                <input type="hidden" id="mating" name="mating" value="3">
                                                <input type="hidden" id="traffic" name="traffic" value="3">
                                                <input type="hidden" id="science" name="science" value="3">
                                                <input type="hidden" id="score" name="score" value="3">
                                                <input type="hidden"  name="aid" value="'.$aid.'">
                                                 <input type="hidden" name="__token__'.$token_id.'" id="'.$token_id.'" value="" />
                                                <div class="sub-btn">
                                                    <input type="button" class="but11 sub-comment" data-url="'.$SubmitAdd.'" onclick="SubmitRemarkData(this);" value="提交">
                                                </div>
                                            </div>
                                        </div>
                                    </form>'.$tokenStr;
        $result['hidden'] = $hidden;
        $result['SubmitAdd'] =$SubmitAdd;
        return $result;
    }
}