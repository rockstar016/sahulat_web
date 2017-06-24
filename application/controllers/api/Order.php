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
require_once(APPPATH.'helpers/PaymentGateway_helper.php');
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
    /*
     * Make Order
     */
    public function make_post(){
//        $token = $_POST['token'];
        $token = $this->input->post('token');
        $this->response($token);
        $user_data = $this->verificationToken($token);
        $attach_file_path="";
        if($user_data['result'] == true){
            $client_id = $user_data['user_data']->id;
            $is_attached = $this->input->post('is_attached');

            if($is_attached == 'true'){
                $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = 1024 * 5 * 1000;//5 mb maximum
                $config['max_width']     = 1024 * 5;
                $config['max_height']    = 768 * 5;
                $config['file_name'] = $client_id."_".time();
                $this->load->library('upload', $config);
                $upload_result = $this->upload->do_upload('attach_file');
                $attach_file_path = $this->upload->data('file_name');
            }
            else{
                $attach_file_path = "";
            }
            $request_time = $this->input->post('request_time');
            $ord_address = $this->input->post('ord_address');

            $this->order_model->insertOrder($client_id, $request_time, $ord_address, $attach_file_path);

            $data['result'] = 'true';
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }

    /*
     * Get Order List with limit for client
     */
    public function getClientOrderList_post(){
        $token = $this->input->post('token');
        $user_data = $this->verificationToken($token);
        if ($user_data['result'] == true) {
            $client_id = $user_data['user_data']->id;
            $limit = $this->post('limit');
            $status = $this->post('status');
            $order_list = $this->order_model->getOrderList_Client($client_id, $status, $limit);
            $data['result'] = 'true';
            $data['order'] = $order_list;
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }

    /**
     * Get Order List with limit for client, Pending and Processed
     *
     */
    public function getClientPendingProcessed_post(){
        $token = $this->input->post('token');
        $user_data = $this->verificationToken($token);
        if ($user_data['result'] == true) {
            $client_id = $user_data['user_data']->id;
            $limit = $this->post('limit');
            $order_list = $this->order_model->getOrderPendingProcessedList_Client($client_id, $limit);
            $data['result'] = 'true';
            $data['order'] = $order_list;
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }

    /*
     * Get Order List with limit for service
     */
    public function getServiceOrderList_post(){
        $token = $this->input->post('token');
        $user_data = $this->verificationToken($token);
        if ($user_data['result'] == true) {
            $client_id = $user_data['user_data']->id;
            $limit = $this->post('limit');
            $status = $this->post('status');
            $order_list = $this->order_model->getOrderList_Service($client_id, $status, $limit);
            $data['result'] = 'true';
            $data['order'] = $order_list;
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }

    /**
     * Cancel Order
     */
    public function cancelOrder_post()
    {
        $token = $this->input->post('token');
        $user_data = $this->verificationToken($token);
        if ($user_data['result'] == true) {
            $client_id = $user_data['user_data']->id;
            $order_id = $this->post('order_id');
            //update status of order
            $this->order_model->updateAssignedJob($order_id, 6);
            /*
             * payment cancel operation here
             */
            $order_item = $this->order_model->getOrderContent($order_id);
            //if job is accepted by service team, penalty fee will be charged to client.
            if($order_item[0]['status'] > 2){
                //make penalty if status is bigger than 1
                $penalty_fee = $this->penalty_model->getCurrentPenalty();
                $this->wallet_model->insertNewCash($client_id, -1 * $penalty_fee[0]['amount'], $order_id);
                $this->client_model->addDepositAmount($client_id, -1 * $penalty_fee[0]['amount']);
            }
            $data['result'] = 'true';
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }

    /**
     * Accept order that is assigned
     */
    public function acceptOrder_post(){
        $token = $this->input->post('token');
        $user_data = $this->verificationToken($token);
        if ($user_data['result'] == true) {
            $order_id = $this->post('order_id');
            $estimation_arrival_time = $this->post('estimation_arrival');
            //insert new record in service_man_history
            $service_id = $user_data['user_data']->id;
            $current_order = $this->order_model->getOrderContent($order_id);
            $assigned_time = $current_order[0]['updated_at'];
            $this->serviceman_history_model->insertNewHistory($service_id, $order_id, '1', $assigned_time);
            //update status of order
            $this->order_model->acceptAssignedJob($order_id, $estimation_arrival_time);



            $data['result'] = 'true';
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }

    /**
     * Reject order that is assigned
     */
    public function rejectOrder_post(){
        $token = $this->input->post('token');
        $user_data = $this->verificationToken($token);
        if ($user_data['result'] == true) {
            $order_id = $this->post('order_id');
            //insert new record in service_man_history
            $service_id = $user_data['user_data']->id;
            $current_order = $this->order_model->getOrderContent($order_id);
            $assigned_time = $current_order[0]['updated_at'];
            $this->serviceman_history_model->insertNewHistory($service_id, $order_id, '0', $assigned_time);

            //update status of order
            $this->order_model->rejectAssignedJob($order_id);


            $data['result'] = 'true';
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }


    /**
     * Service man render service to client. served status.
     */
    public function servedOrder_post(){
        $token = $this->input->post('token');
        $user_data = $this->verificationToken($token);
        if ($user_data['result'] == true) {
            $client_id = $user_data['user_data']->id;
            $order_id = $this->post('order_id');
            //update status of order
            $this->order_model->updateAssignedJob($order_id, 4);

            $data['result'] = 'true';
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }

    /**
     * Payout status
     */
    public function payoutOrder_post(){
        $token = $this->input->post('token');
        $user_data = $this->verificationToken($token);
        if ($user_data['result'] == true) {
            $client_id = $user_data['user_data']->id;
            $order_id = $this->post('order_id');
            //update status of order
            $this->order_model->updateAssignedJob($order_id, 5);
            /**
             * Payout processing here
             */
            $pay_kind = $this->post('pay_kind');
            $amount = $this->post('amount');
            if($pay_kind == 0){
                //pay with wallet
                //update the user wallet amount
                $this->client_model->addDepositAmount($client_id, -1 * $amount);
                //update the user wallet history
                $this->wallet_model->insertNewCash($client_id, -1 * $amount, $order_id);
                //update the user payout history
                $this->checkout_model->insertNewRecord($order_id, $pay_kind, $amount, "Wallet");
            }
            else if($pay_kind == 1){
                //pay with cash
                //update the user payout history
                $this->checkout_model->insertNewRecord($order_id, $pay_kind, $amount, "Cash");
            }
            else if($pay_kind == 2){
                //pay with credit card
                $card_token = $this->post('card_token');
                //transfer money to company account.
                //todo card management should be done here
                //update the user payout history

                /*
                 * @By Zulafqar Ali
                 * I will complete this part of implementation
                 * after getting everything is sort out about
                 * gateway....
                 * 
                 * */
                $payment_handler = new EasyPayPayments();
                print_r($payment_handler->openAPICreditCard($amount, $order_id, $user_data['user_data'], $card_token));
                exit;
                $this->checkout_model->insertNewRecord($order_id, $pay_kind, $amount, "Card token");
            }

            $data['result'] = 'true';
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }


    /**
     * Finish Service and give feedback
     */
    public function finishOrder_post(){
        $token = $this->input->post('token');
        $user_data = $this->verificationToken($token);
        if($user_data['result'] == true){
            $client_id = $user_data['user_data']->id;
            $service_id = $this->post('service_id');
            $order_id = $this->post('order_id');
            $rate_score = $this->post('rate_score');
            $feedback_content = $this->post('feedback');
            $this->order_model->updateAssignedJob($order_id, 6);
            $this->feedback_model->insertNewRecord($order_id, $client_id, $service_id, $rate_score, $feedback_content);
            $data['result'] = 'true';
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }


    /**
     * Get Detail Content of order for client. Order detail view in client activity
     */
    public function orderDetailViewClient_post(){
        $token = $this->input->post('token');
        $user_data = $this->verificationToken($token);
        if($user_data['result'] == true){
            $order_id = $this->post("order_id");
            $order_content = $this->order_model->getOrderContent($order_id);
            $service_man_id = $order_content[0]['service_id'];
            $client_id = $order_content[0]['client_id'];
            $service_content = $this->client_model->get_client($service_man_id);
            $service_position = $this->serviceman_model->getPosition($service_man_id);
            $client_position = $this->serviceman_model->getPosition($client_id);

            $avg_service_rate = $this->feedback_model->getAVGRateFeedback($service_man_id);
            $data['result'] = 'true';
            $data['service_man'] = $service_content;
            $data['service_position'] = $service_position;
            $data['client_position'] = $client_position;
            $data['service_rating'] = $avg_service_rate;
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }

    /**
     * Get List of History
     */
    public function getFeedbackHistory_post(){
        $token = $this->input->post('token');
        $user_data = $this->verificationToken($token);
        if($user_data['result'] == true){
            $limit = $this->post("limit");
            $kind = $this->post("kind");
            $user_id = $user_data['user_data']->id;
            $feedback_history = $this->feedback_model->getFeedback($kind, $user_id, $limit);

            for($i = 0 ; $i < sizeof($feedback_history); $i++){
                $service_model = $this->client_model->get_client($feedback_history[$i]['service_id']);
                $feedback_history[$i]['service_model'] = $service_model[0];
            }

            $data['result'] = 'true';
            $data['feedback'] = $feedback_history;
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }


    /**
     * Give suggestion or compliant
     */
    public function giveSuggestionCompliant_post(){
        $token = $this->input->post('token');
        $user_data = $this->verificationToken($token);
        if($user_data['result'] == true){
            $content = $this->post("content");
            $kind = $this->post("kind");
            $user_id = $user_data['user_data']->id;
            $this->feedback_model->addCompliantSuggestion($user_id, $content, $kind);
            $data['result'] = 'true';
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }

    /**
     * Get Assigned Job for service man
     */
    public function getAssignedJob_post(){
        $token = $this->input->post('token');
        $user_data = $this->verificationToken($token);
        if($user_data['result'] == true){
            $user_id = $user_data['user_data']->id;
            $order_list = $this->order_model->getOrderList_Service($user_id, '2', 0);
            for($i = 0 ; $i < sizeof($order_list); $i++){
                $client_position = $this->serviceman_model->getPosition($order_list[$i]['client_id']);
                $client_model = $this->client_model->get_client($order_list[$i]['client_id']);
                $order_list[$i]['client_position'] = $client_position[0];
                $order_list[$i]['client_model'] = $client_model[0];
            }
            $data['result'] = 'true';
            $data['orders'] = $order_list;
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }

    /**
     * Get Accepted(3), Served(4), Payout(5) Jobs
     */
    public function getCurrentWorkingJob_post(){
        $token = $this->input->post('token');
        $user_data = $this->verificationToken($token);
        if($user_data['result'] == true){
            $user_id = $user_data['user_data']->id;
            $order_list = $this->order_model->getCurrentWorkingJob($user_id);
            for($i = 0 ; $i < sizeof($order_list); $i++){
                $client_position = $this->serviceman_model->getPosition($order_list[$i]['client_id']);
                $client_model = $this->client_model->get_client($order_list[$i]['client_id']);
                $order_list[$i]['client_position'] = $client_position[0];
                $order_list[$i]['client_model'] = $client_model[0];
            }
            $data['result'] = 'true';
            $data['orders'] = $order_list;
            $this->response($data);
        }
        else{
            $data['result'] = 'false';
            $this->response($data);
        }
    }
}