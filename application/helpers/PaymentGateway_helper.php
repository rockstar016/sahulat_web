<?php

class EasyPayPayments{
    private $amount;
    private $storeId;
    private $postBackURL;
    private $orderRefNum;
    private $authToken;
    private $secondPostBackURL;
    private $paymentURL;
    private $confirmPaymentURL;
    private $status;
    private $desc;

    private $soapWSDL;
    private $soapClient;

    /*
     * @email reason2choose@gmail.com
     * @password Adeel71798!
     */


    public function __construct()
    {
        ini_set('soap.wsdl_cache_enabled', 0);
        ini_set('soap.wsdl_cache_ttl', 900);
        ini_set('default_socket_timeout', 15);

        /*$this->amount = $amount;
        $this->storeId = $storeId;
        $this->postBackURL = $postBackURL;
        $this->orderRefNum = $orderRefNum;
        $this->secondPostBackURL = $secondPostBackURL;
        $this->paymentURL = "https://easypay.easypaisa.com.pk/easypay/Index.jsf";
        $this->confirmPaymentURL = "https://easypay.easypaisa.com.pk/easypay/Confirm.jsf";*/
        $this->soapWSDL = "http://202.69.8.50:9080/easypay-service/PartnerBusinessService/META-INF/wsdl/partner/transaction/PartnerBusinessService.wsdl";
    }

    public function openAPICreditCard($amount, $orderId, $user, $credit_card){
        $params = [
            'username' => 'reason2choose@gmail.com',
            'password' => 'Adeel71798!',
            'orderId' => $orderId,
            'storeId' => '100',
            'transactionAmount' => $amount,
            'transactionType' => 'CC',
            'msisdn'    => $user['user_phone'],
            'emailAddress' => $user['user_email'],
            /*'cardType'  => $credit_card['VISA'],
            'pan'       => $credit_card['pan'],
            'expiryYear' => $credit_card['expiryYear'],
            'expiryMonth' => $credit_card['expiryMonth'],
            'cvv2'  => $credit_card['cvv2']*/
        ];
        try {
            $this->soapClient = new SoapClient($this->soapWSDL);
            return $this->soapClient->__soapCall('initiateCCTransaction', $params);
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    /*public function processPayment(){
        try{
            if(!empty($this->amount) and !empty($this->storeId) and !empty($this->postBackURL) && !empty($this->orderRefNum)) {
                $postArgsQuery = [
                    'amount' => $this->amount,
                    'storeId' => $this->storeId,
                    'postBackURL' => $this->postBackURL,
                    'orderRefNum' => $this->orderRefNum,
                ];
                $curl = curl_init($this->paymentURL);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $postArgsQuery);
                curl_setopt($curl, CURLOPT_TIMEOUT, 60);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                $response = curl_exec($curl);
                if($response === false){

                }
                curl_close($curl);
            }

        }catch (Exception $e){
            $e->getMessage();
        }
    }
    public function confirmPayment($auth_token){
        try{
//            $this->authToken = $_GET['auth_token'];
            $this->authToken = $auth_token;
            $postArgsQuery = [
                'auth_token' => $this->authToken,
                'postBackURL' => $this->secondPostBackURL,
            ];
            $curl = curl_init($this->confirmPaymentURL);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postArgsQuery);
            curl_setopt($curl, CURLOPT_TIMEOUT, 60);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            $response = curl_exec($curl);
            if($response === false){

            }
            curl_close($curl);

        }catch (Exception $e){
            $e->getMessage();
        }

    }

    public function returnResponse($status, $desc, $orderRefNumber){
        $this->status = $_GET['status'];
        $this->desc = $_GET['desc'];
        $this->orderRefNum = $_GET['orderRefNumber'];
        $this->status = $status;
        $this->desc = $desc;
        $this->orderRefNum = $orderRefNumber;
        $response = [
            'status' => $this->status,
            'desc' => $this->desc,
            'orderRefNum' => $this->orderRefNum,
        ];
        return json_encode($response);
    }*/


}