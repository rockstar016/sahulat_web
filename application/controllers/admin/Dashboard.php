<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function index() {
        if($this->session->has_userdata('logged_in') == false){
            redirect('admin/login');
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
            $current_date = new DateTime;
            $last_month = new DateTime;
            $last_month->modify('-1 month');

            $data['start_date'] = $last_month->format("Y-m-d");
            $data['end_date'] =  $current_date->format("Y-m-d");
            $this->load->view('admin/dashboard', $data);
        }
    }

    public function GetIntegratedData()
    {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $start_date .= " 00:00:00";
        $end_date .= " 23:59:59";

        $tabledata1 = $this->GetJsonData($start_date, $end_date);

        $tabledata2 = $this->GetJsonDataTableTwo($start_date, $end_date);

        $tabledata3 = $this->GetJsonDataTableThree($start_date, $end_date);

        $tabledata4 = $this->GetJsonDataTableFour($start_date, $end_date);

        $tabledata5 = $this->GetJsonDataTableFive($start_date, $end_date);

        $table1 = array("tbData1"=>$tabledata1,"tbData2"=>$tabledata2, "tbData3"=>$tabledata3, "tbData4"=>$tabledata4,"tbData5" => $tabledata5);

        $pp = json_encode($table1);

        echo $pp;
    }


    //checked
    public function GetIntegratedSummary()
    {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $start_date .= " 00:00:00";
        $end_date .= " 23:59:59";

        $noClient = $this->dashboard_model->getNoClientRegistration($start_date, $end_date);
        $noService = $this->dashboard_model->getNoServiceRegistration($start_date, $end_date);
        $noFeedback = $this->dashboard_model->getNoFeedback($start_date, $end_date);
        $noClientOrder = $this->dashboard_model->getNoClientOrders($start_date, $end_date);

        $noPendingOrders = $this->dashboard_model->getNoPendingOrders($start_date, $end_date);

        $noCompletedOrders = $this->dashboard_model->getNoCompletedOrders($start_date, $end_date);

        $noProcessOrders = $this->dashboard_model->getNoProcessedOrders($start_date, $end_date);

        $summary = array("noClientReg"=>$noClient, "noServiceReg" => $noService, "noFeedback" => $noFeedback, "noTotalOrders" => $noClientOrder, "noPendingOrders"=>$noPendingOrders,"noProcessOrders"=>$noProcessOrders, "noCompletedOrders" => $noCompletedOrders);

        $pp = json_encode($summary);

        echo $pp;
    }

    //checked
    public function GetChartData(){
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $start_date .= " 00:00:00";
        $end_date .= " 23:59:59";

        $total_orders = $this->dashboard_model->getNoClientOrders($start_date, $end_date);

        $pending_orders = $this->dashboard_model->getNoPendingOrders($start_date, $end_date);

        $completed_orders = $this->dashboard_model->getNoCompletedOrders($start_date, $end_date);

        $accepted_orders = $this->dashboard_model->getNoProcessedOrders($start_date, $end_date);

        /**
         * Get Flot Chart structure
         * [index, date, count]
         */

        $flotChartData = $this->dashboard_model->getDataForFlotChart($start_date, $end_date);
        $pie_statistic = array("total"=>$total_orders, "pending" => $pending_orders, "complete" => $completed_orders, "accept" => $accepted_orders);
        $ret_val = array("pie_static"=>$pie_statistic,"flot_static"=>$flotChartData);
        $pp = json_encode($ret_val);

        echo $pp;

    }

    public function GetJsonData($start_date, $end_date)
    {
        $pending_array = $this->dashboard_model->getOrdersForTable($start_date, $end_date);
        $totalData = count($pending_array);
        $data = array();
        for($i = 0; $i < $totalData; $i++){
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
            $username = $client_data[0]['user_name']."(".$client_data[0]['user_phone'].")";
            $servicename = "";

            if(!empty($pending_array[$i]['service'][0]['user_name']))
            {
                $servicename = ($pending_array[$i]['service'][0]['user_name']."(".$pending_array[$i]['service'][0]['user_phone'].")");
            }

            $createdAt = $pending_array[$i]['created_at'];
            $row_data = array('no' => $no,"created_at" => $createdAt,"State" =>$status, "username" => $username, "servicename" => $servicename);
            array_push($data,$row_data);

        }

        return  $data;

    }


    public function GetJsonDataTableTwo($start_date, $end_date)
    {

        $date = date("Y-m-d");
        $prevdate = date("Y-m-d", mktime(0, 0, 0, date("m"),date("d")-1,date("Y")));

        $date = $date." 23:59:59";
        $prevdate = $prevdate." 00:00:00";
        $model_array = $this->dashboard_model->getOrdersForTable2($prevdate, $date);
        $totalData = count($model_array);

        $data = array();

        for($i = 0; $i < $totalData; $i++){
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
            $username = $client_data[0]['user_name']."(".$client_data[0]['user_phone'].")";
            $servicename = "";

            if(!empty($model_array[$i]['service'][0]['user_name']))
            {
                $servicename = ($model_array[$i]['service'][0]['user_name']."(".$model_array[$i]['service'][0]['user_phone'].")");
            }
            $updated_date = $model_array[$i]['updated_at'];
            $updated_date = substr($updated_date, 0,10);
            $row_data = array('no' => $no,"username" => $username, "servicename" => $servicename,"State" =>$status,"toryes" => $updated_date);
            array_push($data,$row_data);

        }

        return $data;

    }

    public function GetJsonDataTableThree($start_date, $end_date)
    {
        $date = date("Y-m-d");
        $date = $date." 23:59:59";

        $model_array = $this->dashboard_model->getOrdersForTable3($date);
        $totalData = count($model_array);

        $data = array();

        for($i = 0; $i < $totalData; $i++){

            $client_id = $model_array[$i]['client_id'];
            $client_data = $this->dashboard_model->get_client($client_id);

            $model_array[$i]['client'] = $client_data;
            $service_id = $model_array[$i]['service_id'];

            $service_data = $this->dashboard_model->get_client($service_id);
            $model_array[$i]['service'] = $service_data;

            $no = $i+1;
            $username = $client_data[0]['user_name']."(".$client_data[0]['user_phone'].")";
            $servicename = "";

            if(!empty($model_array[$i]['service'][0]['user_name'])) {
                $servicename = ($model_array[$i]['service'][0]['user_name']."(".$model_array[$i]['service'][0]['user_phone'].")");
            }

            $orderdate =  $model_array[$i]['order_date'];
            $row_data = array('no' => $no,"username" => $username, "created_date" => $servicename,"order_date" =>$orderdate);
            array_push($data,$row_data);

        }

        return $data;

    }

    public function GetJsonDataTableFour($start_date, $end_date){
        $pending_array = $this->dashboard_model->getOrdersForTable4($start_date, $end_date);
        $totalData = count($pending_array);
        $data = array();
        for($i = 0; $i < $totalData; $i++){
            $client_id = $pending_array[$i]['client_id'];
            $client_data = $this->dashboard_model->get_client($client_id);
            $pending_array[$i]['client'] = $client_data;
            $no = $i+1;
            $username = $client_data[0]['user_name']."(".$client_data[0]['user_phone'].")";
            $row_data = array('no' => $no,"created_date" => $pending_array[$i]['created_at'], "username" => $username, "order_date" =>$pending_array[$i]['order_date'], "completed_date" => $pending_array[$i]['updated_at']);
            array_push($data,$row_data);
        }

        return  $data;
    }

    public function GetJsonDataTableFive($start_date, $end_date){

        $client_arr = $this->dashboard_model->getAllServiceman("");
        $data = array();

        for($clId = 0; $clId < count($client_arr); $clId++)
        {
            $pp = $client_arr[$clId];
            $servicename  = $pp['user_name'];
            $phonenumber =  $client_arr[$clId]['user_phone'];
            $service_man_id = $client_arr[$clId]['id'];
            $jobAssigned = $this->dashboard_model->getNumberJob(0, $service_man_id);
            $JobProcessedNumber = $this->dashboard_model->getNumberJob(1, $service_man_id);
            $JobCompletedNumber = $this ->dashboard_model ->getNumberJob(2, $service_man_id);
            $JobPendingNumber = 0;
            $AverrespControl = 0;
            $Averrespclient = 0;
            $rating = $this->dashboard_model->getRating($service_man_id);
            $row_data = array('no' => $clId,"servicename" => $servicename, "phonenum" => $phonenumber,"Job_Assign"=>$jobAssigned,"JobProcess"=>$JobProcessedNumber,"JobPend"=>$JobPendingNumber,"AvgRespControl"=>$AverrespControl,"JobComplete"=>$JobCompletedNumber,"AvgrepClient"=>$Averrespclient,"rating"=>$rating);
            array_push($data,$row_data);

        }

        return $data;
    }

    public function GetPosData()
    {
        $client_arr = $this->dashboard_model->getPosData();
        $data = array();
        for($clId = 0; $clId < count($client_arr); $clId++) {
            $pp = $client_arr[$clId];
            $servicedata= $this->dashboard_model->getServiceNameFromServiceId($pp['service_id']);
            $row_data = array('log' => $pp['service_cur_long'], 'lat'=>$pp['service_cur_lat'], 'servicename' => $servicedata[0]['user_name'], 'servicephone'=>$servicedata[0]['user_phone']);
            array_push($data,$row_data);
        }

        $rval = json_encode($data);

        echo $rval;

    }

    public function getNoServiceManVisits()
    {
        $volVisit =array();
        $volAccepted =array();
        $volRejected =array();

        $labels = array();
        $servicemanarr =  $this->dashboard_model->getAllServiceUsername();

        for($i=0; $i<count($servicemanarr); $i++)
        {
            array_push($labels,$servicemanarr[$i]['user_name']);
            array_push($volVisit,4);
            array_push($volAccepted,7);
            array_push($volRejected,2);
        }

        $data= array("labels"=>$labels, "series_visit"=>$volVisit, "series_accepted"=>$volAccepted, "series_rejected"=>$volRejected);
        $rval = json_encode($data);

        echo $rval;
    }


}
