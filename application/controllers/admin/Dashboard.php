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
            $user_list = $this->dashboard_model->getAllClient("");
            $data['userlist'] = $user_list;
            $data['search'] = "";
            $this->load->view('admin/dashboard', $data);
        }
    }

    public function GetIntegratedData()
    {
        $tabledata1 = $this->GetJsonData();

        $tabledata2 = $this->GetJsonDataTableTwo();

        $tabledata3 = $this->GetJsonDataTableThree();

        $tabledata5 = $this->GetJsonDataTableFive();

        $table1 = array("tbData1"=>$tabledata1,"tbData2"=>$tabledata2, "tbData3"=>$tabledata3, "tbData4"=>"","tbData5" => $tabledata5);

        $pp = json_encode($table1);
        echo $pp;
    }

    public function GetJsonData()
    {

        $pending_array = $this->dashboard_model->getOrdersForTable();
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

            $client_data = $this->dashboard_model->get_client($client_id);
            $pending_array[$i]['client'] = $client_data;
            $service_id = $pending_array[$i]['service_id'];
            $service_data = $this->dashboard_model->get_client($service_id);
            $pending_array[$i]['service'] = $service_data;

            $no = $i+1;
            $username = $client_data[0]['user_name'];
            $servicename = "";

            if(!empty($pending_array[$i]['service'][0]['user_name']))
            {
                $servicename = ($pending_array[$i]['service'][0]['user_name']);
            }

            $createdAt = $client_data[0]['created_at'];
            $row_data = array('no' => $no,"created_at" => $createdAt,"State" =>$status, "username" => $username, "servicename" => $servicename);
            array_push($data,$row_data);

        }

        return  $data;

    }


    public function GetJsonDataTableTwo()
    {

        $date = date("Y-m-d");
        $prevdate = date("Y-m-d", mktime(0, 0, 0, date("m"),date("d")-1,date("Y")));


        $model_array = $this->dashboard_model->getOrdersForTable();
        $totalData = count($model_array);

        $data = array();

        for($i = 0; $i < count($model_array); $i++){

            $tmpDate = $model_array[$i]['updated_at'];

            $updatedate = "";

            if((strpos($tmpDate,$date) >0))
            {
                $updatedate = "Today";
            }
            else if(strpos($tmpDate,$prevdate) >0)
            {
                $updatedate = "Yesterday";
            }
            else
            {
                continue;
            }

            $client_id = $model_array[$i]['client_id'];
            switch ($model_array[$i]['status'])
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

            $client_data = $this->dashboard_model->get_client($client_id);
            $model_array[$i]['client'] = $client_data;
            $service_id = $model_array[$i]['service_id'];
            $service_data = $this->dashboard_model->get_client($service_id);
            $model_array[$i]['service'] = $service_data;

            $no = $i+1;
            $username = $client_data[0]['user_name'];
            $servicename = "";

            if(!empty($model_array[$i]['service'][0]['user_name']))
            {
                $servicename = ($model_array[$i]['service'][0]['user_name']);
            }

            $row_data = array('no' => $no,"username" => $username, "servicename" => $servicename,"State" =>$status,"toryes" => $updatedate);
            array_push($data,$row_data);

        }

        return $data;

    }

    public function GetJsonDataTableThree()
    {

        $model_array = $this->dashboard_model->getOrdersForTable();
        $totalData = count($model_array);

        $data = array();

        for($i = 0; $i < count($model_array); $i++){

            $tmpDate = $model_array[$i]['updated_at'];

            $client_id = $model_array[$i]['client_id'];
            $client_data = $this->dashboard_model->get_client($client_id);

            $model_array[$i]['client'] = $client_data;
            $service_id = $model_array[$i]['service_id'];

            $service_data = $this->dashboard_model->get_client($service_id);
            $model_array[$i]['service'] = $service_data;

            $no = $i+1;
            $username = $client_data[0]['user_name'];
            $servicename = "";

            if(!empty($model_array[$i]['service'][0]['user_name']))
            {
                $servicename = ($model_array[$i]['service'][0]['user_name']);
            }
            $orderdate =  $model_array[$i]['order_date'];
            $row_data = array('no' => $no,"username" => $username, "created_date" => $servicename,"order_date" =>$orderdate);
            array_push($data,$row_data);

        }

        return $data;

    }

    public function GetJsonDataTableFour(){
        $client_arr = $this->dashboard_model->getAllServiceman("");
        $data = array();

        for($clId = 0; $clId < count($client_arr); $clId++)
        {
            $pp = $client_arr[$clId];
            $servicename  = $pp['user_name'];
            $phonenumber =  $client_arr[$clId]['user_phone'];
            $servicemanID = $clId;
            $jobAssigned = $this->dashboard_model->getNumberJob($clId,0);
            $JobProcessedNumber = $this->dashboard_model->getNumberJob($clId,1);
            $JobCompletedNumber = $this ->dashboard_model ->getNumberJob($clId,2);
            $JobPendingNumber = 0;
            $AverrespControl = 0;
            $Averrespclient = 0;
            $rating = $this->dashboard_model->getRating($servicemanID);
            $row_data = array('no' => $clId,"servicename" => $servicename, "phonenum" => $phonenumber,"Job_Assign"=>$jobAssigned,"JobProcess"=>$JobProcessedNumber,"JobPend"=>$JobPendingNumber,"AvgRespControl"=>$AverrespControl,"JobComplete"=>$JobCompletedNumber,"AvgrepClient"=>$Averrespclient,"rating"=>$rating);
            array_push($data,$row_data);
        }

        return $data;
    }

    public function GetJsonDataTableFive(){

        $client_arr = $this->dashboard_model->getAllServiceman("");
        $data = array();

        for($clId = 0; $clId < count($client_arr); $clId++)
        {
            $pp = $client_arr[$clId];
            $servicename  = $pp['user_name'];
            $phonenumber =  $client_arr[$clId]['user_phone'];
            $servicemanID = $clId;
            $jobAssigned = $this->dashboard_model->getNumberJob($clId,0);
            $JobProcessedNumber = $this->dashboard_model->getNumberJob($clId,1);
            $JobCompletedNumber = $this ->dashboard_model ->getNumberJob($clId,2);
            $JobPendingNumber = 0;
            $AverrespControl = 0;
            $Averrespclient = 0;
            $rating = $this->dashboard_model->getRating($servicemanID);
            $row_data = array('no' => $clId,"servicename" => $servicename, "phonenum" => $phonenumber,"Job_Assign"=>$jobAssigned,"JobProcess"=>$JobProcessedNumber,"JobPend"=>$JobPendingNumber,"AvgRespControl"=>$AverrespControl,"JobComplete"=>$JobCompletedNumber,"AvgrepClient"=>$Averrespclient,"rating"=>$rating);
            array_push($data,$row_data);

        }

        return $data;
    }

}
