<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2019/1/24
 * Time: 16:43
 */
namespace Cxp\Curl;

class Curl
{
    public function httpGet($url, $params = '', $dataType = false)
    {
        $oCurl = curl_init();
        $this->_checkHttps($oCurl, $url);
        $header = $this->_DataType($dataType);
        $params = $this->_checkParams($params);
        if($params) $url = $url.'?'.$params;

        curl_setopt($oCurl,CURLOPT_HTTPHEADER,$header);
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if(intval($aStatus["http_code"])==200) {
            return $sContent;
        } else {
            return false;
        }
    }

    public function httpPost($url, $params, $dataType = false, $file = false)
    {
        $oCurl = curl_init();
        $this->_checkHttps($oCurl, $url);
        $params = $this->_checkParams($params, $file);
        $header = $this->_DataType($dataType);
        curl_setopt($oCurl,CURLOPT_HTTPHEADER,$header);
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($oCurl, CURLOPT_POST,true);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS,$params);
        if($file) curl_setopt($oCurl, CURLOPT_NOBODY, true);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if(intval($aStatus["http_code"])==200) {
            return $sContent;
        } else {
            return false;
        }
    }

    private function _checkParams($params, $file = false)
    {
        if(is_string($params) || $file){
            $data = $params;
        }elseif(is_array($params)){
            $data = array();
            foreach ($params as $k => $v){
                $data[] = $k."=".urlencode($v);
            }
            $data = join('&', $data);
        }else{
            $data = '';
        }
        return $data;
    }

    private function _DataType($dataType = false)
    {
        if($dataType) $header[] = 'Content-Type: application/x-www-form-urlencoded';
        else $header[] = 'Content-Type:application/json;charset=utf-8';
        return $header;
    }

    private function _checkHttps(&$oCurl, $url)
    {
        if(stripos($url, "https://")!==FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1);
        }
    }
}