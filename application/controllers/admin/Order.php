<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    private $smsApi;

    public function __construct(){
        $parent = parent::__construct();
        $this->smsApi = new SMSApi();
    }

    public function index() {

        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }

        $admin = $this->session->userdata['master'];
        $data_header['admin'] = $admin;
        $data_header['page'] = 'order';
        $this->load->view('template/headerview', $data_header);

        $data_left['category'] = 2;	//Category manage page selected.
        $data_left['sub_category'] = 0;	//Sub Category manage page selected.
        $data_header['admin'] = $admin;
        $this->load->view('template/headerview', $data_header);
        $left_view = $this->load->view('template/leftview',$data_left, true);
        $data['leftview'] = $left_view;
        $pending_array = $this->order_model->getOrdersForList(0);
        for($i = 0; $i < count($pending_array); $i++){
            $client_id = $pending_array[$i]['client_id'];
            $client_data = $this->client_model->get_client($client_id);
            $pending_array[$i]['client'] = $client_data;

            $service_id = $pending_array[$i]['service_id'];
            $service_data = $this->client_model->get_client($service_id);
            $pending_array[$i]['service'] = $service_data;
        }
        $data['pending'] = $pending_array;

        $accept_array = $this->order_model->getOrdersForList(1);
        for($i = 0; $i < count($accept_array); $i++){
            $client_id = $accept_array[$i]['client_id'];
            $client_data = $this->client_model->get_client($client_id);
            $accept_array[$i]['client'] = $client_data;

            $service_id = $accept_array[$i]['service_id'];
            $service_data = $this->client_model->get_client($service_id);
            $accept_array[$i]['service'] = $service_data;
        }
        $data['accept'] = $accept_array;

        $complete_array = $this->order_model->getOrdersForList(2);
        for($i = 0; $i < count($complete_array); $i++){
            $client_id = $complete_array[$i]['client_id'];
            $client_data = $this->client_model->get_client($client_id);
            $complete_array[$i]['client'] = $client_data;

            $service_id = $complete_array[$i]['service_id'];
            $service_data = $this->client_model->get_client($service_id);
            $complete_array[$i]['service'] = $service_data;
        }
        $data['complete'] = $complete_array;

        $this->load->view('admin/order', $data);
    }

    public function view($id = 0){
        /*
         * load page for customer detail page
         */
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }

        $admin = $this->session->userdata['master'];
        $data_header['admin'] = $admin;
        $data_header['page'] = 'orderview';
        $this->load->view('template/headerview', $data_header);

        $data_left['category'] = 2;	//Category manage page selected.
        $data_left['sub_category'] = 0;	//Sub Category manage page selected.
        $data_header['admin'] = $admin;
        $this->load->view('template/headerview', $data_header);
        $left_view = $this->load->view('template/leftview',$data_left, true);
        $data['leftview'] = $left_view;
        $orderdetail = $this->order_model->getOrderContent($id);
        $client = $this->client_model->get_client($orderdetail[0]['client_id']);
        $client_name = $client[0]['user_name'];

        $service = $this->client_model->get_client($orderdetail[0]['service_id']);
        $location = $order= $this->order_model->getLocation($orderdetail[0]['client_id']);
        $data['location'] = $location;
        $service_name = "";
        if(isset($service[0])){
            $service_name = $service[0]['user_name'];
        }



        $data['orderdetail'] = $orderdetail;
        $data['client_name'] = $client_name;
        $data['service_name'] = $service_name;

        $this->load->view('admin/order_view', $data);
    }

    public function total(){
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $pending = $this->order_model->getOrdersForStatistic($from, $to, 0);
        $accepted = $this->order_model->getOrdersForStatistic($from, $to, 1);
        $completed = $this->order_model->getOrdersForStatistic($from, $to, 2);
        $total = $pending + $accepted + $completed;

        echo json_encode(array("total" =>$total, "pending"=>$pending, "accepted" => $accepted, "completed" =>$completed));
    }

    public function manage(){
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }

        $this->form_validation->set_rules('date_time_order','date_time_order','required');
        $this->form_validation->set_rules('client_list','client_list','required');

        if($this->form_validation->run() != FALSE){
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = 100;
            $config['max_width']     = 1024;
            $config['max_height']    = 768;
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload("image")) {
                $error = array('error' => $this->upload->display_errors());
            }
            $file_data = $this->upload->data();

            $date_time_order = $this->input->post('date_time_order');
            $client_id = $this->input->post('client_list');
            $lat = $this->input->post('loc_lat');
            $lot = $this->input->post('loc_lot');
            $addr = $this->input->post('client_address');
            $date_time_order .= ":00";
            $image_path = $config['upload_path'].$file_data['file_name'];
            $this->order_model->insertOrder($client_id, $date_time_order,  $addr, $image_path);
            redirect('admin/order/pending');
        }
        else {
            $admin = $this->session->userdata['master'];
            $data_header['admin'] = $admin;
            $data_header['page'] = 'order';
            $this->load->view('template/headerview', $data_header);

            $data_left['category'] = 2;    //Category manage page selected.
            $data_left['sub_category'] = 0;    //Sub Category manage page selected.
            $data_header['admin'] = $admin;
            $this->load->view('template/headerview', $data_header);
            $left_view = $this->load->view('template/leftview', $data_left, true);
            $data['leftview'] = $left_view;
            $this->load->view('admin/order_create_remove', $data);
        }
    }

    public function pending(){

        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }

        $admin = $this->session->userdata['master'];
        $data_header['admin'] = $admin;
        $data_header['page'] = 'order';
        $this->load->view('template/headerview', $data_header);

        $data_left['category'] = 2;	//Category manage page selected.
        $data_left['sub_category'] = 1;	//Sub Category manage page selected.
        $data_header['admin'] = $admin;
        $this->load->view('template/headerview', $data_header);
        $left_view = $this->load->view('template/leftview',$data_left, true);
        $data['leftview'] = $left_view;
        $pending_array = $this->order_model->getOrdersForList(0);

        for($i = 0; $i < count($pending_array); $i++){
            $client_id = $pending_array[$i]['client_id'];
            $client_data = $this->client_model->get_client($client_id);
            $pending_array[$i]['client'] = $client_data;

            $service_id = $pending_array[$i]['service_id'];
            $service_data = $this->client_model->get_client($service_id);
            $pending_array[$i]['service'] = $service_data;
        }

        $data['pending'] = $pending_array;
        $this->load->view('admin/order_pending', $data);

    }

    public function pending_API(){

        $pending_array = $this->order_model->getOrdersForList(0);

        for($i = 0; $i < count($pending_array); $i++){
            $client_id = $pending_array[$i]['client_id'];
            $client_data = $this->client_model->get_client($client_id);
            $pending_array[$i]['client'] = $client_data;

            $service_id = $pending_array[$i]['service_id'];
            $service_data = $this->client_model->get_client($service_id);
            $pending_array[$i]['service'] = $service_data;

        }

        echo json_encode($pending_array);

    }

    public function show_accept(){
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }

        $admin = $this->session->userdata['master'];
        $data_header['admin'] = $admin;
        $data_header['page'] = 'order';
        $this->load->view('template/headerview', $data_header);

        $data_left['category'] = 2;	//Category manage page selected.
        $data_left['sub_category'] = 3;	//Sub Category manage page selected.
        $data_header['admin'] = $admin;
        $this->load->view('template/headerview', $data_header);
        $left_view = $this->load->view('template/leftview',$data_left, true);
        $data['leftview'] = $left_view;

        $accept_array = $this->order_model->getOrdersForList(3);
        for($i = 0; $i < count($accept_array); $i++){
            $client_id = $accept_array[$i]['client_id'];
            $client_data = $this->client_model->get_client($client_id);
            $accept_array[$i]['client'] = $client_data;

            $service_id = $accept_array[$i]['service_id'];
            $service_data = $this->client_model->get_client($service_id);
            $accept_array[$i]['service'] = $service_data;
        }
        $data['accept'] = $accept_array;
        $this->load->view('admin/order_accepted', $data);
    }

    public function show_assigned(){
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }

        $admin = $this->session->userdata['master'];
        $data_header['admin'] = $admin;
        $data_header['page'] = 'order';
        $this->load->view('template/headerview', $data_header);

        $data_left['category'] = 2;	//Category manage page selected.
        $data_left['sub_category'] = 2;	//Sub Category manage page selected.
        $data_header['admin'] = $admin;
        $this->load->view('template/headerview', $data_header);
        $left_view = $this->load->view('template/leftview',$data_left, true);
        $data['leftview'] = $left_view;

        $assigned_array = $this->order_model->getOrdersForList(2);
        for($i = 0; $i < count($assigned_array); $i++){
            $client_id = $assigned_array[$i]['client_id'];
            $client_data = $this->client_model->get_client($client_id);
            $assigned_array[$i]['client'] = $client_data;

            $service_id = $assigned_array[$i]['service_id'];
            $service_data = $this->client_model->get_client($service_id);
            $assigned_array[$i]['service'] = $service_data;
        }
        $data['assigned'] = $assigned_array;
        $this->load->view('admin/order_assigned', $data);
    }

    public function show_served(){
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }

        $admin = $this->session->userdata['master'];
        $data_header['admin'] = $admin;
        $data_header['page'] = 'order';
        $this->load->view('template/headerview', $data_header);

        $data_left['category'] = 2;	//Category manage page selected.
        $data_left['sub_category'] = 4;	//Sub Category manage page selected.
        $data_header['admin'] = $admin;
        $this->load->view('template/headerview', $data_header);
        $left_view = $this->load->view('template/leftview',$data_left, true);
        $data['leftview'] = $left_view;

        $served_array = $this->order_model->getOrdersForList(2);
        for($i = 0; $i < count($served_array); $i++){
            $client_id = $served_array[$i]['client_id'];
            $client_data = $this->client_model->get_client($client_id);
            $served_array[$i]['client'] = $client_data;

            $service_id = $served_array[$i]['service_id'];
            $service_data = $this->client_model->get_client($service_id);
            $served_array[$i]['service'] = $service_data;
        }
        $data['served'] = $served_array;
        $this->load->view('admin/order_served', $data);
    }

    public function show_paid(){
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }

        $admin = $this->session->userdata['master'];
        $data_header['admin'] = $admin;
        $data_header['page'] = 'order';
        $this->load->view('template/headerview', $data_header);

        $data_left['category'] = 2;	//Category manage page selected.
        $data_left['sub_category'] = 5;	//Sub Category manage page selected.
        $data_header['admin'] = $admin;
        $this->load->view('template/headerview', $data_header);
        $left_view = $this->load->view('template/leftview',$data_left, true);
        $data['leftview'] = $left_view;

        $paid_array = $this->order_model->getOrdersForList(5);
        for($i = 0; $i < count($paid_array); $i++){
            $client_id = $paid_array[$i]['client_id'];
            $client_data = $this->client_model->get_client($client_id);
            $paid_array[$i]['client'] = $client_data;

            $service_id = $paid_array[$i]['service_id'];
            $service_data = $this->client_model->get_client($service_id);
            $paid_array[$i]['service'] = $service_data;
        }
        $data['paid'] = $paid_array;
        $this->load->view('admin/order_paid', $data);
    }

    public function show_cancelled(){
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }

        $admin = $this->session->userdata['master'];
        $data_header['admin'] = $admin;
        $data_header['page'] = 'order';
        $this->load->view('template/headerview', $data_header);

        $data_left['category'] = 2;	//Category manage page selected.
        $data_left['sub_category'] = 7;	//Sub Category manage page selected.
        $data_header['admin'] = $admin;
        $this->load->view('template/headerview', $data_header);
        $left_view = $this->load->view('template/leftview',$data_left, true);
        $data['leftview'] = $left_view;

        $cancelled_array = $this->order_model->getOrdersForList(7);
        for($i = 0; $i < count($cancelled_array); $i++){
            $client_id = $cancelled_array[$i]['client_id'];
            $client_data = $this->client_model->get_client($client_id);
            $cancelled_array[$i]['client'] = $client_data;

            $service_id = $cancelled_array[$i]['service_id'];
            $service_data = $this->client_model->get_client($service_id);
            $cancelled_array[$i]['service'] = $service_data;
        }
        $data['cancelled'] = $cancelled_array;
        $this->load->view('admin/order_cancelled', $data);
    }

    public function show_processed(){
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }

        $admin = $this->session->userdata['master'];
        $data_header['admin'] = $admin;
        $data_header['page'] = 'order';
        $this->load->view('template/headerview', $data_header);

        $data_left['category'] = 2;	//Category manage page selected.
        $data_left['sub_category'] = 2;	//Sub Category manage page selected.
        $data_header['admin'] = $admin;
        $this->load->view('template/headerview', $data_header);
        $left_view = $this->load->view('template/leftview',$data_left, true);
        $data['leftview'] = $left_view;

        $processed_array = $this->order_model->getOrdersForList(1);
        for($i = 0; $i < count($processed_array); $i++){
            $client_id = $processed_array[$i]['client_id'];
            $client_data = $this->client_model->get_client($client_id);
            $processed_array[$i]['client'] = $client_data;
        }
        $data['processed'] = $processed_array;
        $this->load->view('admin/order_processed', $data);
    }

    public function complete(){
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }

        $admin = $this->session->userdata['master'];
        $data_header['admin'] = $admin;
        $data_header['page'] = 'order';
        $this->load->view('template/headerview', $data_header);

        $data_left['category'] = 2;	//Category manage page selected.
        $data_left['sub_category'] = 6;	//Sub Category manage page selected.
        $data_header['admin'] = $admin;
        $this->load->view('template/headerview', $data_header);
        $left_view = $this->load->view('template/leftview',$data_left, true);
        $data['leftview'] = $left_view;


        $complete_array = $this->order_model->getOrdersForList(6);
        for($i = 0; $i < count($complete_array); $i++){
            $client_id = $complete_array[$i]['client_id'];
            $client_data = $this->client_model->get_client($client_id);
            $complete_array[$i]['client'] = $client_data;
            $service_id = $complete_array[$i]['service_id'];
            $service_data = $this->client_model->get_client($service_id);
            $complete_array[$i]['service'] = $service_data;
        }
        $data['complete'] = $complete_array;
        $this->load->view('admin/order_complete', $data);
    }

    public function assign_order($id){
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }

        $admin = $this->session->userdata['master'];
        $data_header['admin'] = $admin;
        $data_header['page'] = 'order';
        $this->load->view('template/headerview', $data_header);

        $data_left['category'] = 2;    //Category manage page selected.
        $data_left['sub_category'] = 1;    //Sub Category manage page selected.
        $data_header['admin'] = $admin;
        $this->load->view('template/headerview', $data_header);
        $left_view = $this->load->view('template/leftview', $data_left, true);
        $data['leftview'] = $left_view;
        $this->order_model->markOrderInProcessing($id);


        $order= $this->order_model->getOrderContent($id);
        $data['order'] = $order;

        $client = $this->client_model->get_client($order[0]['client_id']);
        $location = $order= $this->order_model->getLocation($order[0]['client_id']);
        $data['location'] = $location;
        $data['client'] = $client;
        $user_phone = ltrim($client[0]['user_phone'], '+');
        $user_phone = str_replace('-', '', $user_phone);
        $this->smsApi->sendSMS($user_phone, "We have received your order. We will get you back soon. Thanks");
        $this->load->view('admin/order_assign', $data);
    }


    /***
     * assign service to team member
     *
     ***/
    public function assign_order_api(){

        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }

        $service_id = $this->input->post('service_id');
        $order_id = $this->input->post('order_id');
        $this->order_model->assignOrder($order_id, $service_id);
        $order= $this->order_model->getOrderContent($order_id);
        $client = $this->client_model->get_client($order[0]['client_id']);
        $service = $this->client_model->get_client($service_id);
        $service_name = $service[0]['user_name'];
        $user_phone = ltrim($client[0]['user_phone'], '+');
        $user_phone = str_replace('-', '', $user_phone);
        $this->smsApi->sendSMS($user_phone, "You order is assigned to $service_name.");
    }

    public function accept_order_api(){

        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }

        $service_id = $this->input->post('service_id');
        $order_id = $this->input->post('order_id');
        $this->order_model->acceptOrder($order_id, $service_id);
        $order= $this->order_model->getOrderContent($order_id);
        $client = $this->client_model->get_client($order[0]['client_id']);
        $service = $this->client_model->get_client($service_id);
        $service_name = $service[0]['user_name'];
        $user_phone = ltrim($client[0]['user_phone'], '+');
        $user_phone = str_replace('-', '', $user_phone);
        $this->smsApi->sendSMS($user_phone, "You order is accepted by $service_name.");
    }

    public function reject_order_api(){

        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }

        $order_id = $this->input->post('order_id');
        $this->order_model->rejectAssignedJob($order_id);
    }

    public function served_order_api(){

        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }

        $service_id = $this->input->post('service_id');
        $order_id = $this->input->post('order_id');
        $this->order_model->serveOrder($order_id, $service_id);
        $order= $this->order_model->getOrderContent($order_id);
        $client = $this->client_model->get_client($order[0]['client_id']);
        $service = $this->client_model->get_client($service_id);
        $service_name = $service[0]['user_name'];
        $user_phone = ltrim($client[0]['user_phone'], '+');
        $user_phone = str_replace('-', '', $user_phone);
        $this->smsApi->sendSMS($user_phone, "You are served as requested by $service_name.");
    }

    public function payout_order_api(){

        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }

        $service_id = $this->input->post('service_id');
        $order_id = $this->input->post('order_id');
        $this->order_model->payOrder($order_id, $service_id);
        $order= $this->order_model->getOrderContent($order_id);
        $client = $this->client_model->get_client($order[0]['client_id']);
        $service = $this->client_model->get_client($service_id);
        $service_name = $service[0]['user_name'];
        $user_phone = ltrim($client[0]['user_phone'], '+');
        $user_phone = str_replace('-', '', $user_phone);
        $this->smsApi->sendSMS($user_phone, "Your have paid to $service_name against your order.");
    }

    public function cancel_order($id){
        $this->order_model->cancelOrder($id);
        $order= $this->order_model->getOrderContent($id);
        $client = $this->client_model->get_client($order[0]['client_id']);
        $user_phone = ltrim($client[0]['user_phone'], '+');
        $user_phone = str_replace('-', '', $user_phone);
        $this->smsApi->sendSMS($user_phone, "Your order is cancelled upon request.");
        $this->load->library('user_agent');
        redirect($this->agent->referrer());
    }

    public function cancel_order_api(){

        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }
        $order_id = $this->input->post('order_id');
        $this->order_model->cancelOrder($order_id);
        $order= $this->order_model->getOrderContent($order_id);
        $client = $this->client_model->get_client($order[0]['client_id']);
        $user_phone = ltrim($client[0]['user_phone'], '+');
        $user_phone = str_replace('-', '', $user_phone);
        $this->smsApi->sendSMS($user_phone, "Your order is cancelled upon request.");
    }

    /****
     * Send Firebase Notification to service team
     *
     */
    public function getFCMToken(){
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }

        $service_id = $this->input->post('service_id');
        $token = $this->fbtoken_model->getToken($service_id);
        $token_id = $token[0]['fire_token'];
        $result['fb_token'] = $token_id;
        $result['key'] = $this->config->item('fb_key');
        echo json_encode($result);
    }

    public function edit_order($id = 0){
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }

        $this->form_validation->set_rules('date_time_order','date_time_order','required');
        $this->form_validation->set_rules('client_name','ClientName','required');
        $this->form_validation->set_rules('client_address','ClientAddress','required');

        if($this->form_validation->run() != FALSE){
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = 100;
            $config['max_width']     = 1024;
            $config['max_height']    = 768;
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload("image")) {
                $error = array('error' => $this->upload->display_errors());
            }
            $file_data = $this->upload->data();
            $date_time_order = $this->input->post('date_time_order');
            $client_id = $this->input->post('client_id');
            $addr = $this->input->post('client_address');
            if(strlen($date_time_order) <15 )
                $date_time_order .= ":00";
            //$image_path = $config['upload_path'].$file_data['file_name'];
            $this->order_model->updateOrderContent($id, $client_id, '', $date_time_order, 0, $addr);
            redirect('admin/order/pending');
        }
        else {
            $admin = $this->session->userdata['master'];
            $data_header['admin'] = $admin;
            $data_header['page'] = 'order';
            $this->load->view('template/headerview', $data_header);

            $data_left['category'] = 2;    //Category manage page selected.
            $data_left['sub_category'] = 1;    //Sub Category manage page selected.
            $data_header['admin'] = $admin;
            $this->load->view('template/headerview', $data_header);
            $left_view = $this->load->view('template/leftview', $data_left, true);
            $data['leftview'] = $left_view;

            $current_order = $this->order_model->getOrderContent($id);
            $data['order'] = $current_order[0];

            $client_id = $current_order[0]['client_id'];
            $client_data = $this->client_model->get_client($client_id);
            $data['client_data'] = $client_data;
            $this->load->view('admin/order_edit', $data);
        }
    }

    public function do_upload($filename) {
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 100;
        $config['max_width']     = 1024;
        $config['max_height']    = 768;
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload($filename)) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
            return false;
        }

        else {
            return true;
        }
    }
}
