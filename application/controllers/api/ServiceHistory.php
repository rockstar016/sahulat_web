<?php

/**
 * Created by PhpStorm.
 * User: rock
 * Date: 5/3/17
 * Time: 8:38 AM
 */
require (APPPATH.'libraries/REST_Controller.php');
require (APPPATH.'libraries/JWT.php');
require_once(APPPATH.'libraries/PHPRequests.php');
use \Firebase\JWT\JWT;
class ServiceHistory extends \Restserver\Libraries\REST_Controller{
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

    public function replyToAssignedJob_post(){
        $token_id = $this->input->post("token");
        $user_data = $this->verificationToken($token_id);
        if($user_data['result'] == true){
            $service_id = $user_data['user_data']->id;
            $is_accept = $this->post('is_accept');
            $order_id = $this->post('order_id');
            $assigned_time = $this->post('assigned_time');
            $this->serviceman_history_model->insertNewHistory($service_id, $order_id, $is_accept, $assigned_time);
            if($is_accept == 0){
                //reject
                $this->order_model->rejectAssignedJob($order_id);
            }
            else{
                //accept
                $estimation_time = $this->post('estimation_time');
                $this->order_model->acceptAssignedJob($order_id, $estimation_time);
            }
        }
        else{
            $this->response(array("result"=>'false'));
        }
    }
}