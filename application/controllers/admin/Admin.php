<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function index()
    {
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }
        $admin = $this->session->userdata['master'];
        $data_header['admin'] = $admin;
        $data_header['page'] = 'customers';
        $this->load->view('template/headerview', $data_header);

        $data_left['category'] = -1;	//Category manage page selected.
        $data_left['sub_category'] = 0;	//Sub Category manage page selected.
        $left_view = $this->load->view('template/leftview',$data_left, true);

        $data['leftview'] = $left_view;
        $user_list = $this->admin_model->getAllAdmins();
        $data['userlist'] = $user_list;
        $data['search'] = "";
        $this->load->view('admin/admin_list', $data);
    }

    public function create(){
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }

        $admin = $this->session->userdata['master'];
        if($admin->level != 0){
            $data_header['admin'] = $admin;
            $data_header['page'] = 'admin_create';
            $this->load->view('template/headerview', $data_header);
            $data_left['category'] = -1;
            $data_left['sub_category'] = -1;
            $left_view = $this->load->view('template/leftview',$data_left, true);
            $data['leftview'] = $left_view;
            $this->load->view('admin/noaccess', $data);
        }

        $this->form_validation->set_rules('username','UserName','required');
        $this->form_validation->set_rules('emailaddress','EmailAddress','required');
        $this->form_validation->set_rules('password','Password','required');
        $this->form_validation->set_rules('userphone','userphone','required');

        if($this->form_validation->run() != FALSE){
            $name = $this->input->post('username');
            $pwd = $this->input->post('password');
            $email = $this->input->post('emailaddress');
            $phone = $this->input->post('userphone');
            $this->admin_model->insert_admin($name, $pwd, $email,$phone);
            redirect('admin/admin');
        }
        else{

            $admin = $this->session->userdata['master'];
            $data_header['admin'] = $admin;
            $data_header['page'] = 'admin_create';
            $this->load->view('template/headerview', $data_header);
            $data_left['category'] = -1;
            $data_left['sub_category'] = -1;
            $left_view = $this->load->view('template/leftview',$data_left, true);
            $data['leftview'] = $left_view;
            $this->load->view('admin/admin_create', $data);
        }
    }

    public function edit($id =0){

        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }

        $admin = $this->session->userdata['master'];
        if($admin->level != 0){
            $data_header['admin'] = $admin;
            $data_header['page'] = 'admin_create';
            $this->load->view('template/headerview', $data_header);
            $data_left['category'] = -1;
            $data_left['sub_category'] = -1;
            $left_view = $this->load->view('template/leftview',$data_left, true);
            $data['leftview'] = $left_view;
            $this->load->view('admin/noaccess', $data);
        }

        $this->form_validation->set_rules('username','UserName','required');
        $this->form_validation->set_rules('emailaddress','EmailAddress','required');
        $this->form_validation->set_rules('userphone','PhoneNumber','required');
        $this->form_validation->set_rules('password','Password','required');
        if($this->form_validation->run() != FALSE){
            $name = $this->input->post('username');
            $email = $this->input->post('emailaddress');
            $phone = $this->input->post('userphone');
            $password = $this->input->post('password');
            $this->admin_model->updateUserInformation($id, $name, $phone, $email,$password);
            redirect('admin/admin');
        }
        else{
            $admin = $this->session->userdata['master'];
            $data_header['admin'] = $admin;
            $data_header['page'] = 'customer_edit';
            $this->load->view('template/headerview', $data_header);

            $data_left['category'] = -1;
            $data_left['sub_category'] = -1;
            $left_view = $this->load->view('template/leftview',$data_left, true);

            $data['leftview'] = $left_view;
            $user = $this->admin_model->get_admin($id);
            $data['user'] = $user;
            $this->load->view('admin/admin_edit', $data);
        }
    }
    public function del($id =0){

        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
        }

        $admin = $this->session->userdata['master'];
        if($admin->level != 0){
            $data_header['admin'] = $admin;
            $data_header['page'] = 'admin_create';
            $this->load->view('template/headerview', $data_header);
            $data_left['category'] = -1;
            $data_left['sub_category'] = -1;
            $left_view = $this->load->view('template/leftview',$data_left, true);
            $data['leftview'] = $left_view;
            $this->load->view('admin/noaccess', $data);
        }else{
            $this->admin_model->removeAdmin($id);
            redirect('admin/admin');
        }

    }

}
