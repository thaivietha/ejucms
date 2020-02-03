<?php
/**
 * User: xyz
 * Date: 2019/11/5
 * Time: 10:06
 */

namespace think;


class Crawler
{
    private static $cookie_arr = array(
        '__utma' => '147393320.1012092547.1572926778.1572926778.1572940315.2',
        '__utmb' => '147393320.48.10.1572940315',
        '__utmc' => '147393320',
        '__utmt_t0' => '1',
        '__utmt_t1' => '1',
        '__utmt_t2' => '1',
        '__utmz' => '147393320.1572940315.2.2.utmcsr=fang.com|utmccn=(referral)|utmcmd=referral|utmcct=/default.htm',
        'budgetLayer' => '1%7Cbj%7C2019-11-05%2012%3A06%3A15',
        'city' => 'search',
        'csrfToken' => 'oUsgm1fY7FUujonM-PX_rQrX',
        'g_sourcepage' => 'esf_fy%5Exq_pc',
        'global_cookie' => 'datzlgoz7g8ci3h1e0g5wfum78zk2lbqj3d',
        'Integrateactivity'=>'notincludemc',
        'lastscanpage' => '0',
        'logGuid'=>'9e28e514-683f-4a99-9860-f6d8e0712f67',
        'resourceDetail' => "1",
        'unique_cookie' => 'U_nhm18ftcnkvnr70wjyn31axuw4fk2lk0pls*16'

    );

    private $header = array(
        'Connection:keep-alive',
        'user-agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36',
        'upgrade-insecure-requests:1'

    );

    private static function genCookie() {
        $cookie = '';
        foreach(self::$cookie_arr as $k=>$v) {
            if($k != 'isg') {
                $cookie .= $k . '=' . $v .';';
            } else {
                $cookie .= $k .'=' .$v;
            }
        }

        return $cookie;
    }
    /*
     * 获取数据
     */
    public function curlInfo($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_COOKIE,self::genCookie());     //假装自己人
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
//        curl_setopt($ch, CURLOPT_HEADER,$this->header);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //https 请求
        if(strlen($url) > 5 && strtolower(substr($url,0,5)) == "https" ) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        $reponse = curl_exec($ch);
        if (curl_errno($ch))
        {
            throw new Exception(curl_error($ch),0);
        }
        else
        {
            $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (200 !== $httpStatusCode)
            {
                throw new Exception($reponse,$httpStatusCode);
            }
        }

//        $urlinfo = parse_url($url);
//        $re_url = $urlinfo['scheme'] . '://' . $urlinfo['host'] . substr($urlinfo['path'], 0, strrpos($urlinfo['path'], '/')+1);
//        var_dump($re_url);
//        die();
        curl_close($ch);

        if(!mb_check_encoding($reponse,'utf-8')) {
            $reponse = mb_convert_encoding($reponse,'utf-8','gbk');
        }

        return $reponse;
    }
    /*
     * 获取各个部分的值
     */
    public function getBasicInfo($content){
        $basicInfo = [];
        /** 获取价格 */
//        preg_match('/<div class="trl-item price_esf  sty1"><i>(.*?)<\/i>/s', $content, $matchPrice);
//        if(!empty($matchPrice[1])) $basicInfo['total_price'] = $matchPrice[1];
//        /* 1室2厅1卫*/
//        preg_match('/<div class="tt">(.*?)室/s', $content, $matchroom);
//        if(!empty($matchroom[1])) $basicInfo['room'] = $matchroom[1];
//        preg_match('/室(.*?)厅/s', $content, $matchliving_room);
//        if(!empty($matchliving_room[1])) $basicInfo['living_room'] = $matchliving_room[1];
//        preg_match('/厅(.*?)卫/s', $content, $matchtoilet);
//        if(!empty($matchtoilet[1])) $basicInfo['toilet'] = $matchtoilet[1];

        preg_match("/var t4='(.*?)';/s", $content, $matchPrice);
        if(!empty($matchPrice[1])) $basicInfo['heiheihei'] = $matchPrice[1];

        return $basicInfo;
    }
    /*
     * 另外一种方式  不行
     */
    public function getContents($url){
        $header = array("Referer: http://www.baidu.com/");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);  //能无法 抓取跳转后的页面
        ob_start();
        curl_exec($ch);
        $contents = ob_get_contents();
        ob_end_clean();
        curl_close($ch);

        return $contents;
    }
    /*
     * 获取cookie
     */
    public function getCookie($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_HEADERFUNCTION, function ($ch, $str) use(&$setcookie) {
            // 第一个参数是curl资源，第二个参数是每一行独立的header!
            list ($name, $value) = array_map('trim', explode(':', $str, 2));
            $name = strtolower($name);
            if('set-cookie'==$name)
            {
                $setcookie[]=$value;
            }
            return strlen($str);
        });
        curl_exec($ch);
        curl_close($ch);
        $cookie = array();
        foreach($setcookie as $c)
        {
            $tmp = explode(";",$c);
            $cookie[] = $tmp[0];
        }
        $cookiestr = "Cookie:".implode(";", $cookie);
        echo $cookiestr;
    }
}