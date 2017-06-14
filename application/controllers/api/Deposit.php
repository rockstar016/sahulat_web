<?php

/**
 * Created by PhpStorm.
 * User: rock
 * Date: 3/16/17
 * Time: 1:16 AM
 */
require (APPPATH.'libraries/REST_Controller.php');
require (APPPATH.'libraries/JWT.php');
require_once(APPPATH.'libraries/PHPRequests.php');
use \Firebase\JWT\JWT;
class Deposit extends \Restserver\Libraries\REST_Controller
{
    private function verificationToken($token){
        $ret_val = array();
        try{
            $user_data = JWT::decode($token, $this->config->item('encryption_key'), array('HS256'));
            $user_model = $this->client_model->get_client($user_data->id);
            if($user_model[0]['is_activated'] === '0'){
                $ret_val['result'] = false;
                $ret_val['user_data'] = '';
                return $ret_val;
            }
            else{
                $ret_val['result'] = true;
                $ret_val['user_data'] = $user_data;
                return $ret_val;
            }

        }catch (Exception $e){
            $ret_val['result'] = false;
            $ret_val['user_data'] = '';
            return $ret_val;
        }
    }

    /**
     * Charge deposit with card
     */
    public function chargeWalletCard_post(){
        $token = $this->input->post('token');
        $user_data = $this->verificationToken($token);
        if ($user_data['result'] == true) {
            $client_id = $user_data['user_data']->id;
            $card_token = $this->post('card_token');
            //todo transfer money to company account here.
            $amount = $this->post('amount');
            $this->wallet_model->insertNewCash($client_id, $amount, -1);
            $this->client_model->addDepositAmount($client_id, $amount);
            $data['result'] = 'true';
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }

    /**
     * Charge deposit with order
     */
    public function chargeWalletOrder_post(){
        $token = $this->input->post('token');
        $user_data = $this->verificationToken($token);
        if ($user_data['result'] == true) {
            $service_id = $user_data['user_data']->id;
            $order_id = $this->post('order_id');
            $client_id = $this->post('client_id');
            $amount = $this->post('amount');
            $this->wallet_model->insertNewCash($client_id, $amount, $order_id);
            $this->client_model->addDepositAmount($client_id, $amount);
            $data['result'] = 'true';
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }

    /**
     * Get list for wallet history
     */
    public function getWalletHistory_post(){
        $token = $this->input->post('token');
        $user_data = $this->verificationToken($token);
        if ($user_data['result'] == true) {
            $client_id = $user_data['user_data']->id;
            $limit = $this->post('limit');
            $result_array = $this->wallet_model->getRecordsWithClientLimit($client_id, $limit);
            $data['result'] = 'true';
            $data['deposit_history'] = $result_array;
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }
}