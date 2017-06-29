<?php

/**
 * Created by PhpStorm.
 * User: zulaf
 * Date: 17/06/2017
 * Time: 14:50
 */
class SMSApi
{
    private $msisdn;
    private $password;
    private $session_id;

    public function  __construct(){
        $this->msisdn = "923458514579";
        $this->password = "5555";
        $this->session_id = "";
    }

    public function authenticate(){
        $result = false;
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => "https://telenorcsms.com.pk:27677/corporate_sms2/api/auth.jsp?msisdn=$this->msisdn&password=$this->password",
                CURLOPT_USERAGENT => 'Codular Sample cURL Request'
            ));
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT ,0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
            $resp = curl_exec($curl);
            curl_close($curl);
            $xml = new SimpleXMLElement($resp);
            if ($xml->response == "OK") {
                $this->session_id = $xml->data;
                $result = true;
            }
        }catch (Exception $e){

        }

        return $result;
    }

    public function sendSMS($to , $message = ""){
        try {
            if ($this->authenticate()) {
                $message = str_replace(" ", "%20", $message);
                $url = "https://telenorcsms.com.pk:27677/corporate_sms2/api/sendsms.jsp?session_id=$this->session_id&to=$to&text=$message";
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $url,
                    CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17'
                ));
                curl_setopt($curl, CURLOPT_CONNECTTIMEOUT ,0);
                $fp = fopen(dirname(__FILE__) . '/errorlog.txt', 'w');
                curl_setopt($curl, CURLOPT_VERBOSE, 1);
                curl_setopt($curl, CURLOPT_STDERR, $fp);
                $resp = curl_exec($curl);
                curl_close($curl);
                $xml = new SimpleXMLElement($resp);

                if ($xml->response == "OK") {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }catch (Exception $e){
            return false;
        }
    }
}