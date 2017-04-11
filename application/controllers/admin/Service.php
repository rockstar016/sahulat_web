<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {

    public function index() {
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/');
        }
        else{
            $admin = $this->session->userdata['master'];
            $data_header['admin'] = $admin;
            $data_header['page'] = 'service';
            $this->load->view('template/headerview', $data_header);

            $data_left['category'] = 1;	//Category manage page selected.
            $data_left['sub_category'] = 1;	//Sub Category manage page selected.
            $left_view = $this->load->view('template/leftview',$data_left, true);

            $data['leftview'] = $left_view;
            $user_list = $this->client_model->getAllServiceman("");
            $data['userlist'] = $user_list;
            $data['search'] = "";
            $this->load->view('admin/services', $data);
        }
    }

    public function view($id = 0){
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/');
        }

        $admin = $this->session->userdata['master'];
        $data_header['admin'] = $admin;
        $data_header['page'] = 'serviceview';
        $this->load->view('template/headerview', $data_header);

        $data_left['category'] = 1;
        $data_left['sub_category'] = 1;
        $left_view = $this->load->view('template/leftview',$data_left, true);

        $data['leftview'] = $left_view;
        $user = $this->client_model->get_client($id);
        $data['user'] = $user;
        $orderlist = $this->order_model->getOrdersOfServiceman($id);

        $data['orderlist'] = $orderlist;
        $this->load->view('admin/service_view', $data);
    }

    public function search($user_name){
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/');
        }
        else{
            $admin = $this->session->userdata['master'];
            $data_header['admin'] = $admin;
            $data_header['page'] = 'service';
            $this->load->view('template/headerview', $data_header);

            $data_left['category'] = 1;	//Category manage page selected.
            $data_left['sub_category'] = 1;	//Sub Category manage page selected.
            $left_view = $this->load->view('template/leftview',$data_left, true);

            $data['leftview'] = $left_view;
            $user_list = $this->client_model->getAllServiceman($user_name);
            $data['userlist'] = $user_list;
            $data['search'] = $user_name;
            $this->load->view('admin/services', $data);
        }
    }

    public function activeuser($id){
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/');
        }
        $this->client_model->update_info($id, 4, 1);
        redirect('admin/service');
    }

    public function verify($kind, $id){
        //$kind = 1: email, 2: phone

        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/');
        }
        if($kind == 1){
            $this->client_model->activate_email($id);
        }
        else if($kind == 2){
            $this->client_model->activate_phone($id);
        }

        redirect('admin/service');
    }

    public function blockuser($id){

        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/');
        }
        $this->client_model->update_info($id, 4, 0);
        redirect('admin/service');
    }

    public function edit($id =0){

        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/');
        }

        $this->form_validation->set_rules('username','UserName','required');
        $this->form_validation->set_rules('userphone','PhoneNumber','required');

        if($this->form_validation->run() != FALSE){
            $name = $this->input->post('username');
            $email = $this->input->post('emailaddress');
            $phone = $this->input->post('userphone');
            $this->client_model->updateUserInformation($id, $name, $phone, $email);
            redirect('admin/service');
        }
        else{
            $admin = $this->session->userdata['master'];
            $data_header['admin'] = $admin;
            $data_header['page'] = 'service_edit';
            $this->load->view('template/headerview', $data_header);

            $data_left['category'] = 1;
            $data_left['sub_category'] = 1;
            $left_view = $this->load->view('template/leftview',$data_left, true);

            $data['leftview'] = $left_view;
            $user = $this->client_model->get_client($id);
            $data['user'] = $user;
            $data['password_error'] = false;
            $this->load->view('admin/service_edit', $data);
        }
    }

    public function change_password($id = 0){
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/');
        }

        $this->form_validation->set_rules('new_pass','Newpassword','required');
        $this->form_validation->set_rules('confirm_pass','ConfirmPassword','required');

        if($this->form_validation->run() != FALSE){
            $new_password = $this->input->post('new_pass');
            $confirm_password = $this->input->post('confirm_pass');
            if($new_password === $confirm_password){
                //change password
                $this->client_model->update_info($id, 3, $new_password);
                redirect('admin/customer');
            }
            else{
                $admin = $this->session->userdata['master'];
                $data_header['admin'] = $admin;
                $data_header['page'] = 'customer_edit';
                $this->load->view('template/headerview', $data_header);
                $data_left['category'] = 1;
                $data_left['sub_category'] = 0;
                $left_view = $this->load->view('template/leftview',$data_left, true);
                $data['leftview'] = $left_view;
                $user = $this->client_model->get_client($id);
                $data['user'] = $user;
                $data['password_error'] = true;
                $this->load->view('admin/customers_edit', $data);
            }
        }
        else{
            $admin = $this->session->userdata['master'];
            $data_header['admin'] = $admin;
            $data_header['page'] = 'customer_edit';
            $this->load->view('template/headerview', $data_header);

            $data_left['category'] = 1;
            $data_left['sub_category'] = 0;
            $left_view = $this->load->view('template/leftview',$data_left, true);

            $data['leftview'] = $left_view;
            $user = $this->client_model->get_client($id);
            $data['user'] = $user;
            $data['password_error'] = false;
            $this->load->view('admin/customers_edit', $data);
        }
    }

    public function create(){
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/');
        }
        $this->form_validation->set_rules('username','UserName','required');
        $this->form_validation->set_rules('userphone','PhoneNumber','required');
        $this->form_validation->set_rules('password','Password','required');
        if($this->form_validation->run() != FALSE){
            $name = $this->input->post('username');
            $pwd = $this->input->post('password');
            $email = $this->input->post('emailaddress');
            $phone = $this->input->post('userphone');
            $duplicated_phone = $this->client_model->is_valid_phone_number($phone);
            if($duplicated_phone == 0){
                $this->client_model->insert_client($name, $pwd, $phone, $email, 0);
                redirect('admin/service');
            }
            else{
                $admin = $this->session->userdata['master'];
                $data_header['admin'] = $admin;
                $data_header['page'] = 'service_create';
                $this->load->view('template/headerview', $data_header);
                $data_left['category'] = 1;
                $data_left['sub_category'] = 1;
                $left_view = $this->load->view('template/leftview',$data_left, true);
                $data['leftview'] = $left_view;
                $data['phone_error'] = true;
                $this->load->view('admin/service_create', $data);
            }
        }
        else{
            $admin = $this->session->userdata['master'];
            $data_header['admin'] = $admin;
            $data_header['page'] = 'service_create';
            $this->load->view('template/headerview', $data_header);
            $data_left['category'] = 1;
            $data_left['sub_category'] = 1;
            $left_view = $this->load->view('template/leftview',$data_left, true);
            $data['leftview'] = $left_view;
            $data['phone_error'] = false;
            $this->load->view('admin/service_create', $data);
        }
    }

    public function getposition(){
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/');
        }
        $id = $this->input->post('serv_id');
        $result = $this->serviceman_model->getPosition($id);
        echo json_encode($result);
    }
}
