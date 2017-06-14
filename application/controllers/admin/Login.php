<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
        $this->form_validation->set_rules('mastername', 'MasterName' , 'required');
        $this->form_validation->set_rules('password', 'Password' , 'required');

        if($this->form_validation->run() == TRUE){
            $user_auth = $this->input->post('mastername');
            $user_password = $this->input->post('password');

            if($this->session->has_userdata['logged_in'] == true && $this->session->userdata('logged_in') == true){
                redirect('admin');
            }
            else{
                $login_result = $this->admin_model->login($user_auth, $user_password);
                if($login_result['result'] === true){
                    $session_value = array(
                        'logged_in' => $login_result['result'],
                        'master' => $login_result['data']
//                        'master_email' => $login_result['data']->master_email,
//                        'master_phone' => $login_result['data']->master_phone
                    );
                    $this->session->set_userdata($session_value);
                    redirect('admin');
                }
                else{

                    $data = array();
                    $data['error'] = true;
                    $this->load->view('login/admin_login',$data);
                }
            }
        }
        else{

            $data = array();
            $data['error'] = false;
            $this->load->view('login/admin_login', $data);
        }
	}

	public function logout(){
        $array_items = array('logged_in', 'master');
        $this->session->unset_userdata($array_items);
        redirect('admin/login');
    }
}
