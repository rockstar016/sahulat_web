<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

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
            $date_time_order = $this->input->post('date_time_order');
            $client_id = $this->input->post('client_list');
            $lat = $this->input->post('loc_lat');
            $lot = $this->input->post('loc_lot');
            $addr = $this->input->post('client_address');
            $date_time_order .= ":00";
            $this->order_model->makeOrder($client_id, $lat, $lot, $addr, $date_time_order);
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
        $data_left['sub_category'] = 2;	//Sub Category manage page selected.
        $data_header['admin'] = $admin;
        $this->load->view('template/headerview', $data_header);
        $left_view = $this->load->view('template/leftview',$data_left, true);
        $data['leftview'] = $left_view;

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
        $this->load->view('admin/order_accepted', $data);
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
        $data_left['sub_category'] = 3;	//Sub Category manage page selected.
        $data_header['admin'] = $admin;
        $this->load->view('template/headerview', $data_header);
        $left_view = $this->load->view('template/leftview',$data_left, true);
        $data['leftview'] = $left_view;


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
        $order= $this->order_model->getOrderContent($id);
        $data['order'] = $order;

        $client = $this->client_model->get_client($order[0]['client_id']);
        $data['client'] = $client;
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
        $this->order_model->assignOrderToService($service_id, $order_id);
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
        $this->form_validation->set_rules('loc_lot','ClientAddress','required');
        $this->form_validation->set_rules('loc_lat','ClientAddress','required');

        if($this->form_validation->run() != FALSE){
            $date_time_order = $this->input->post('date_time_order');
            $client_id = $this->input->post('client_id');
            $lat = $this->input->post('loc_lat');
            $lot = $this->input->post('loc_lot');
            $addr = $this->input->post('client_address');
            if(strlen($date_time_order) <15 )
                $date_time_order .= ":00";
            $this->order_model->editOrder($id, $client_id, $lat, $lot, $addr, $date_time_order);
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
}
