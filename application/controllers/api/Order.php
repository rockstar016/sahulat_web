<?php
/**
 * Created by PhpStorm.
 * User: rock
 * Date: 3/18/17
 * Time: 10:08 AM
 */
require (APPPATH.'libraries/REST_Controller.php');
require (APPPATH.'libraries/JWT.php');
require_once(APPPATH.'libraries/PHPRequests.php');
use \Firebase\JWT\JWT;
class Order extends \Restserver\Libraries\REST_Controller
{
    private function verificationToken($token){
        $ret_val = array();
        try{
            $user_data = JWT::decode($token, $this->config->item('encryption_key'), array('HS256'));
            $ret_val['result'] = true;
            $ret_val['user_data'] = $user_data;
            return $ret_val;
        }catch (Exception $e){
            $ret_val['result'] = false;
            $ret_val['user_data'] = '';
            return $ret_val;
        }
    }
    public function make_post(){
        $token = $this->input->post('token');
        $user_data = $this->verificationToken($token);


        if($user_data['result'] == true){
            $client_id = $user_data['user_data']->id;
            $ord_lat = $this->input->post('ord_lat');
            $ord_long = $this->input->post('ord_long');
            $ord_address = $this->input->post('address');
            $ord_date = $this->input->post('order_time');
            $this->order_model->makeOrder($client_id, $ord_lat, $ord_long, $ord_address,$ord_date);
            $data['result'] = 'true';
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }

    public function getRatableList_post(){
        $token = $this->input->post('token');
        $user_data = $this->verificationToken($token);
        if($user_data['result'] == true){
            $client_id = $user_data['user_data']->id;
            $order_array = $this->order_model->getRatableList($client_id);

            for ($i = 0; $i < count($order_array); ++$i) {
                $service_man = $this->client_model->get_client($order_array[$i]['service_id']);
                $order_array[$i]['service_man'] = $service_man[0];
            }

            $data['result'] = 'true';
            $data['ratelist'] = $order_array;
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }
    public function rate_post(){
        $token = $this->input->post('token');
        $order_id = $this->input->post('order');
        $score = $this->input->post('score');
        $user_data = $this->verificationToken($token);
        if($user_data['result'] == true){
            $client_id = $user_data['user_data']->id;
            $this->order_model->rateOrder($order_id, $score, $client_id);
            $data['result'] = 'true';
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }

    public function history_post(){
        $token = $this->input->post('token');
        $user_data = $this->verificationToken($token);
        if($user_data['result'] == true){
            $client_id = $user_data['user_data']->id;
            $order_array = $this->order_model->getHistory($client_id);
            for ($i = 0; $i < count($order_array); ++$i) {
                $service_man = $this->client_model->get_client($order_array[$i]['service_id']);
                $order_array[$i]['service_man'] = $service_man[0];
            }

            $data['result'] = 'true';
            $data['history'] = $order_array;
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }

    public function savetoken_post(){
        $token = $this->input->post('token');
        $fb_token = $this->input->post('fb_token');
        $user_data = $this->verificationToken($token);
        if($user_data['result'] == true){
            $client_id = $user_data['user_data']->id;
            $this->order_model->saveFBToken($client_id, $fb_token);
            $data['result'] = 'true';
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }

    public function getpending_post(){
        $token = $this->input->post('token');
        $user_data = $this->verificationToken($token);
        if($user_data['result'] == true){
            $user_id = $user_data['user_data']->id;
            $order_array = $this->order_model->getPendingOrders($user_id);
            for ($i = 0; $i < count($order_array); ++$i) {
                $service_man = $this->client_model->get_client($order_array[$i]['service_id']);
                $order_array[$i]['service_man'] = $service_man[0];
            }
            $data['result'] = 'true';
            $data['history'] = $order_array;
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }

    public function getactive_post(){
        $token = $this->input->post('token');
        $user_data = $this->verificationToken($token);
        if($user_data['result'] == true){
            $user_id = $user_data['user_data']->id;
            $order_array = $this->order_model->getActiveOrders($user_id);
            for ($i = 0; $i < count($order_array); ++$i) {
                $service_man = $this->client_model->get_client($order_array[$i]['service_id']);
                $client_man = $this->client_model->get_client($order_array[$i]['client_id']);
                $order_array[$i]['service_man'] = $service_man[0];
                $order_array[$i]['client'] = $client_man[0];
            }
            $data['result'] = 'true';
            $data['history'] = $order_array;
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }

    public function setStatus_post(){
        $token = $this->input->post('token');
        $order_id = $this->input->post('order_id');
        $order_status = $this->input->post('status');

        $user_data = $this->verificationToken($token);
        if($user_data['result'] == true){
            $user_id = $user_data['user_data']->id;
            $this->order_model->setOrderStatus($user_id, $order_id, $order_status);
            $data['result'] = 'true';
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }
}