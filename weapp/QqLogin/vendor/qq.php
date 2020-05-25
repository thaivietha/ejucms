<?php

namespace weapp\QqLogin\vendor;
/**
 * User: xyz
 * Date: 2019/11/25
 * Time: 15:05
 */
use think\Model;
use think\Request;

class qq
{
    private $qqappid = '';
    private $qqappkey = '';
    private $scope = "get_user_info,add_share,list_album,add_album,upload_pic,add_topic,add_one_blog,add_weibo,check_page_fans,add_t,add_pic_t,del_t,get_repost_list,get_info,get_other_info,get_fanslist,get_idolist,add_idol,del_idol,get_tenpay_addr";

    public function __construct($app_id,$app_key){
        $this->app_id = $app_id;
        $this->app_key = $app_key;

    }
    //QQ登录
    function login($appid, $callback) {
        $state = md5 ( uniqid ( rand (), true ) ); //CSRF protection
        session('state', $state);
        $login_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=" . $appid . "&redirect_uri=" . urlencode ( $callback ) . "&state=" . $state . "&scope=" . $this->scope;
        header ( "Location: {$login_url}" );
        exit;
    }
    //登录成功回调函数 目的就是获取访问令牌
    function callback($path) {
        if ($_REQUEST ['state'] == session('state')) {
            $token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&" . "client_id=" . $this->app_id . "&redirect_uri=" . urlencode ( $path ) . "&client_secret=" . $this->app_key . "&code=" . $_REQUEST ["code"];
            $response = httpRequest($token_url);
            if (strpos ( $response, "callback" ) !== false) {
                $lpos = strpos ( $response, "(" );
                $rpos = strrpos ( $response, ")" );
                $response = substr ( $response, $lpos + 1, $rpos - $lpos - 1 );
                $msg = json_decode ( $response );
                if (isset ( $msg->error )) {
                    echo "<h3>错误代码:</h3>" . $msg->error;
                    echo "<h3>信息  :</h3>" . $msg->error_description;
                    exit ();
                }
            }
            $params = array ();
            parse_str ( $response, $params );
            $access_token = $params ["access_token"];

            session('access_token', $access_token);

        } else {
            echo ("The state does not match. You may be a victim of CSRF.");
        }
    }
    //获取该QQ用户的openid
    function get_openid() {
        $access_token = session('access_token');
        $graph_url = "https://graph.qq.com/oauth2.0/me?access_token=" . $access_token;

        $str = httpRequest( $graph_url );
        if (strpos ( $str, "callback" ) !== false) {
            $lpos = strpos ( $str, "(" );
            $rpos = strrpos ( $str, ")" );
            $str = substr ( $str, $lpos + 1, $rpos - $lpos - 1 );
        }

        $user = json_decode ( $str );
        if (isset ( $user->error )) {
            echo "<h3>错误代码:</h3>" . $user->error;
            echo "<h3>信息  :</h3>" . $user->error_description;
            exit ();
        }
        $qq_openid = $user->openid;
        session('qq_openid',$qq_openid);

        return $qq_openid;
    }

    //获取用户信息
    function get_user_info() {
        $access_token = session('access_token');
        $qq_openid = session('qq_openid');
        $get_user_info = "https://graph.qq.com/user/get_user_info?" . "access_token=" . $access_token . "&oauth_consumer_key=" . $this->app_id . "&openid=" . $qq_openid . "&format=json";

        return httpRequest( $get_user_info );
    }
}