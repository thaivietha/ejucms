<?php

/**
 * error code ˵��.
 * <ul>

 *    <li>-41001: encodingAesKey �Ƿ�</li>
 *    <li>-41003: aes ����ʧ��</li>
 *    <li>-41004: ���ܺ�õ���buffer�Ƿ�</li>
 *    <li>-41005: base64����ʧ��</li>
 *    <li>-41016: base64����ʧ��</li>
 * </ul>
 */
class ErrorCode
{
    public static $OK = 0;
    public static $IllegalAesKey = -41001;
    public static $IllegalIv = -41002;
    public static $IllegalBuffer = -41003;
    public static $DecodeBase64Error = -41004;
}

?>