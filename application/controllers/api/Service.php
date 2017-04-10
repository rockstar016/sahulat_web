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
class Service extends \Restserver\Libraries\REST_Controller
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
    public function updateposition_post(){
        $token_id = $this->input->post("token");
        $lat = $this->input->post("lat");
        $lot = $this->input->post("lot");
        $user_data = $this->verificationToken($token_id);
        if($user_data['result'] == true){
            $this->serviceman_model->updateposition($user_data['user_data']->id, $lat,$lot);
            $data = array('result'=>'true');
            $this->response($data);
        }
        else{
            $this->response(array("result"=>'false'));
        }
    }

}