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
class Client extends \Restserver\Libraries\REST_Controller
{
    function signup_post(){
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $password = $this->input->post('password');
        $kind = $this->input->post('kind');

        $valid_phone_number = $this->client_model->is_valid_phone_number($phone);
            if($valid_phone_number == 0){
                $last_insert_id = $this->client_model->insert_client($name, $password, $phone, $email, $kind);
                $token = $this->makeTokenKey($last_insert_id);
                $user = $this->client_model->get_client($last_insert_id);
                $data = array('result'=>'true', 'message'=>$token, 'user'=>$user);
                $this->response($data);
            }
            else{
                /**
                 * Phone is duplicated
                 */
                $data = array('result'=>'false', 'message'=>'0');
                $this->response($data);
            }
    }

    private function makeTokenKey($user_id){
        $token['id'] = $user_id;
        $date = new DateTime();
        $token['iat'] = $date->getTimestamp();
        $token['exp'] = $date->getTimestamp() + 60*60*24*5;
        $token_code = JWT::encode($token,$this->config->item('encryption_key'),'HS256');
        return $token_code;
    }

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
/*
    //I think it is useless function. I leave it for future.
    private function send_verification_email($email_code, $email_to_send, $user_name){

        $this->load->library('email');
        $config['protocol']='smtp';
        $config['smtp_host']='ssl://smtp.googlemail.com';
        $config['smtp_port']='465';
        $config['smtp_timeout']='30';
        $config['smtp_user']='zeus.rock0116@gmail.com';
        $config['smtp_pass']='zp.pkk!!!';
        $config['charset']='utf-8';
        $config['newline']="\r\n";
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $this->email->initialize($config);
        $this->email->set_mailtype('html');
        $this->email->from($this->config->item('botemail'), 'Support team');
        $this->email->to($email_to_send);
        $this->email->subject("verify your email address");
        $message = "<html><head></head><body>";
        $message .= "<p>Dear ".$user_name.",</p>";
        $message .= "Thanks for registering our service. Please <strong><a href='".base_url().'api/client/activate-email/'.$email_code."'>Click here</a>
        </strong>to activate your email address.Thanks";
        $message .= "</body></html>";
        $this->email->message($message);
        $this->email->send();
    }
*/
//    function active_email_get($token_id){
//            $user_data = $this->verificationToken($token_id);
//            if($user_data['result'] == true){
//                if($this->client_model->activate_email($user_data['user_data']->id)){
//                    echo ('Thanks.Your email is activated to use service.');
//                }
//            }
//            else{
//                echo('Sorry. Try again later.');
//            }
//    }

//    function active_phone_get($token_id){
//        $user_data = $this->verificationToken($token_id);
//        if($user_data['result'] == true){
//            if($this->client_model->activate_phone($user_data['user_data']->id)){
//                echo ('Thanks.Your phone is activated to use service.');
//            }
//        }
//        else{
//            echo ('Sorry. Try again later');
//        }
//    }

//I think it is useless function. I leave it for future.
/*
    function email_verify_post(){
        $token_id = $this->input->post('token');
        $user_data = $this->verificationToken($token_id);
        if($user_data['result'] == true){
            $user_record = $this->client_model->get_client($user_data['user_data']->id);
            $this->send_verification_email($token_id, $user_record[0]['user_email'], $user_record[0]['user_name']);
            $data = array('result'=>'true');
            $this->response($data);
        }
        else{
            $this->response(array("result"=>'false'));
        }
    }

*/
    function phone_verify_post(){
        $token_id = $this->input->post('token');
        $user_data = $this->verificationToken($token_id);
        if($user_data['result'] == true){
            $data['result'] = true;
            $data['sms'] = $this->config->item('sms_manager');
            $data['pwd'] = $this->config->item('sms_pwd');
            $this->response($data);
            //$this->send_verification_sms($user_record[0]['user_phone'], $user_record[0]['user_name']);

        }
        else{
            $this->response(array("result"=>'false'));
        }
    }

    function login_post(){
        $auth_field = $this->input->post('auth_field');
        $pass_field = $this->input->post('password');
        $usr_value = $this->client_model->login($auth_field, $pass_field);
        if($usr_value['result'] == true){
            $token_value = $this->makeTokenKey($usr_value['id']);
            $user = $this->client_model->get_client($usr_value['id']);
            $data = array('result'=>'true', 'message'=>$token_value, 'user'=>$user);
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }

    function check_post(){
        $token_id = $this->input->post('token');
        $user_data = $this->verificationToken($token_id);
        if($user_data['result'] == true){
            $user = $this->client_model->get_client($user_data['user_data']->id);
            $data = array('result'=>true, 'message'=>$token_id, 'user'=>$user);
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }

    function updateinfo_post(){
        $token_id = $this->input->post('token');
        $update_field = $this->input->post('field');
        $update_value = $this->input->post('value');
        $user_data = $this->verificationToken($token_id);
        if($user_data['result'] == true){
            $this->client_model->update_info($user_data['user_data']->id, $update_field, $update_value);
            $user = $this->client_model->get_client($user_data['user_data']->id);
            $data = array('result'=>true, 'message'=>$token_id, 'user'=>$user);
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }

    function getUserInfo_post(){
        $token_id = $this->input->post('token');
        $user_data = $this->verificationToken($token_id);
        if($user_data['result'] == true){
            $user_id = $this->input->post('user_id');
            $user = $this->client_model->get_client($user_id);
            $data = array('result'=>true, 'user'=>$user[0]);
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }

}