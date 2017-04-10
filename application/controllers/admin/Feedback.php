<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends CI_Controller {

    public function index() {
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/');
        }
        $admin = $this->session->userdata['master'];
        $data_header['admin'] = $admin;
        $data_header['page'] = 'customerview';
        $this->load->view('template/headerview', $data_header);
        $data_left['category'] = 2;
        $data_left['sub_category'] = 0;
        $left_view = $this->load->view('template/leftview',$data_left, true);
        $data['leftview'] = $left_view;
        $this->load->view('admin/feedback', $data);

    }
    public function view($id = 0){
        /*
         * load page for customer detail page
         */
    }
}
