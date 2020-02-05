<?php

/**
 * ��΢��С�����û��������ݵĽ���ʾ������.
 *
 * @copyright Copyright (c) 1998-2014 Tencent Inc.
 */


include_once "errorCode.php";


class WXBizDataCrypt
{
    private $appid;
    private $sessionKey;

    /**
     * ���캯��
     * @param $sessionKey string �û���С�����¼���ȡ�ĻỰ��Կ
     * @param $appid string С�����appid
     */
    public function __construct( $appid, $sessionKey)
    {
        $this->sessionKey = $sessionKey;
        $this->appid = $appid;
    }


    /**
     * �������ݵ���ʵ�ԣ����һ�ȡ���ܺ������.
     * @param $encryptedData string ���ܵ��û�����
     * @param $iv string ���û�����һͬ���صĳ�ʼ����
     * @param $data string ���ܺ��ԭ��
     *
     * @return int �ɹ�0��ʧ�ܷ��ض�Ӧ�Ĵ�����
     */
    public function decryptData( $encryptedData, $iv, &$data )
    {
        if (strlen($this->sessionKey) != 24) {
            return ErrorCode::$IllegalAesKey;
        }
        $aesKey=base64_decode($this->sessionKey);


        if (strlen($iv) != 24) {
            return ErrorCode::$IllegalIv;
        }
        $aesIV=base64_decode($iv);

        $aesCipher=base64_decode($encryptedData);

        $result=openssl_decrypt( $aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);

        $dataObj=json_decode( $result );
        if( $dataObj  == NULL )
        {
            return ErrorCode::$IllegalBuffer;
        }
        if( $dataObj->watermark->appid != $this->appid )
        {
            return ErrorCode::$IllegalBuffer;
        }
        $data = $result;
        return ErrorCode::$OK;
    }

}

