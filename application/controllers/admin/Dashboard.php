<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function index() {
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/');
        }
        else{
            $admin = $this->session->userdata['master'];
            $data_header['admin'] = $admin;
            $data_header['page'] = 'customers';
            $this->load->view('template/headerview', $data_header);

            $data_left['category'] = 0;	//Category manage page selected.
            $data_left['sub_category'] = 0;	//Sub Category manage page selected.
            $left_view = $this->load->view('template/leftview',$data_left, true);

            $data['leftview'] = $left_view;
            $user_list = $this->client_model->getAllClient("");
            $data['userlist'] = $user_list;
            $data['search'] = "";
            $this->load->view('admin/customers', $data);
        }
    }

    public function tableone()
    {
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/');
        }
        else{
            $admin = $this->session->userdata['master'];
            $data_header['admin'] = $admin;
            $data_header['page'] = 'customers';
            $this->load->view('template/headerview', $data_header);

            $data_left['category'] = 0;	//Category manage page selected.
            $data_left['sub_category'] = 0;	//Sub Category manage page selected.
            $left_view = $this->load->view('template/leftview',$data_left, true);

            $data['leftview'] = $left_view;
            $user_list = $this->client_model->getAllClient("");
            $data['userlist'] = $user_list;
            $data['search'] = "";
            $this->load->view('admin/dashboard_tableone', $data);
        }
    }

    public function GetJsonData()
    {

        $pending_array = $this->order_model->getOrdersForTableOne();
        $totalData = count($pending_array);

        $data = array();


        for($i = 0; $i < count($pending_array); $i++){

            $client_id = $pending_array[$i]['client_id'];
            switch ($pending_array[$i]['status'])
            {
                case 0:
                    $status = "Pending";
                    break;
                case 1:
                    $status = "Accepted";
                     break;
                case 2:
                    $status = "Completed";
                    break;
            }

            $client_data = $this->client_model->get_client($client_id);
            $pending_array[$i]['client'] = $client_data;
            $service_id = $pending_array[$i]['service_id'];
            $service_data = $this->client_model->get_client($service_id);
            $pending_array[$i]['service'] = $service_data;

            $no = $i+1;
            $username = $client_data[0]['user_name'];
            $servicename = "";

            if(!empty($pending_array[$i]['service'][0]['user_name']))
            {
                $servicename = ($pending_array[$i]['service'][0]['user_name']);
            }

            $createdAt = $client_data[0]['created_at'];
            $updateat = $client_data[0]['updated_at'];
            $orderdata =  $pending_array[$i]['order_date'];

            $linkid = $pending_array[$i]['id'];
            $nestedData = array();

            $row_data = array('no' => $no,"created_at" => $createdAt,"State" =>$status, "username" => $username, "servicename" => $servicename);
            array_push($data,$row_data);

        }

        $result = json_encode($data);
        echo $result;

    }


}
