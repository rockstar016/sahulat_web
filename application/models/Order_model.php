<?php

/**
 * Created by PhpStorm.
 * User: rock
 * Date: 3/15/17
 * Time: 11:27 PM
 */
class Order_model extends CI_Model
{
    public function __construct(){
        $this->load->database();
    }

    /**
     * INSERT ORDER
     */
    public function insertOrder($client_id, $request_time, $ord_address, $attach_file){
        $data = array(
                        'client_id' => $client_id,
                        'service_id' => 0,
                        'request_time'=> $request_time,
                        'status' => 0,
                        'ord_address' => $ord_address,
                        'attach_file' => $attach_file
                        );
        $this->db->set('request_time', 'NOW()', false);
        $this->db->set('created_at', 'NOW()', FALSE);
        $this->db->set('updated_at', 'NOW()', FALSE);
        $this->db->insert('tb_order', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    /**
     * ASSIGN ORDER TO SERVICE MAN
     */

    public function markOrderInProcessing($order_id){
        $data = array(
            'status' => 1
        );
        $this->db->set('updated_at','NOW()', FALSE);
        $this->db->where('id',$order_id);
        $this->db->update('tb_order', $data);
    }

    public function acceptOrder($order_id, $service_id){
        $data = array(
            'service_id' => $service_id,
            'status' => 3
        );
        $this->db->set('updated_at','NOW()', FALSE);
        $this->db->where('id',$order_id);
        $this->db->update('tb_order', $data);
    }

    public function cancelOrder($order_id){
        $data = array(
            'service_id' => '',
            'status' => 7
        );
        $this->db->set('updated_at','NOW()', FALSE);
        $this->db->where('id',$order_id);
        $this->db->update('tb_order', $data);
    }

    public function serveOrder($order_id, $service_id){
        $data = array(
            'service_id' => $service_id,
            'status' => 4
        );
        $this->db->set('updated_at','NOW()', FALSE);
        $this->db->where('id',$order_id);
        $this->db->update('tb_order', $data);
    }



    public function assignOrder($order_id, $service_id){
        $data = array(
            'service_id' => $service_id,
            'status' => 2
        );
        $this->db->set('updated_at','NOW()', FALSE);
        $this->db->where('id',$order_id);
        $this->db->update('tb_order', $data);
    }

    public function payOrder($order_id, $service_id){
        $data = array(
            'service_id' => $service_id,
            'status' => 6
        );
        $this->db->set('updated_at','NOW()', FALSE);
        $this->db->where('id',$order_id);
        $this->db->update('tb_order', $data);
    }

    /*
     * ACCEPT ASSIGNED JOB
     */
    public function acceptAssignedJob($order_id, $estimation_arrival){
        $data = array(
            'status' => 3,
            'estimation_arrival' => $estimation_arrival
        );
        $this->db->set('updated_at','NOW()', FALSE);
        $this->db->where('id',$order_id);
        $this->db->update('tb_order', $data);
    }

    /*
     * REJECT ASSIGNED JOB
     */
    public function rejectAssignedJob($order_id){
        $data = array(
            'service_id' => 0,
            'status' => 1
        );
        $this->db->set('updated_at','NOW()', FALSE);
        $this->db->where('id',$order_id);
        $this->db->update('tb_order', $data);
    }

    /*
     * DELIVERED, FINISHED, CANCELLED
     */
    public function updateAssignedJob($order_id, $status){
        $data = array(
            'status' => $status
        );
        $this->db->set('updated_at','NOW()', FALSE);
        $this->db->where('id',$order_id);
        $this->db->update('tb_order', $data);
    }
    /**
     * UPDATE ORDER CONTENT
     */
    public function updateOrderContent($id, $client_id,$service_id, $estimation_arrival, $status,  $ord_address){
        $data = array(
            'client_id' => $client_id,
            'service_id' => $service_id,
            'estimation_arrival'=> $estimation_arrival,
            'status' => $status,
            'ord_address' => $ord_address,
        );
        $this->db->set('updated_at','NOW()', FALSE);
        $this->db->where('id', $id);
        $this->db->update('tb_order', $data);
    }

    /****
     * GET ORDER LIST FOR CLIENT
     */
    public function getOrderList_Client($client_id, $status, $count){
        $query = "SELECT * FROM tb_order WHERE client_id='".$client_id."' AND status = '".$status."' ORDER BY id DESC";
        if($count > 0)
            $query .= " LIMIT ".$count;
        $result = $this->db->query($query);
        return $result->result_array();
    }


    /**
     * GET ORDER LIST OF PENDING, PROCESSED FOR CLIENT
     *
     */
    public function getOrderPendingProcessedList_Client($client_id, $count){
        $query = "SELECT * FROM tb_order WHERE client_id='".$client_id."' AND status < '4' ORDER BY id DESC";
        if($count > 0)
            $query .= " LIMIT ".$count;
        $result = $this->db->query($query);
        return $result->result_array();
    }
    /***
     * GET ORDER LIST FOR SERVICE MAN
     */
    public function getOrderList_Service($service_id, $status = '', $count){
        $query = "SELECT * FROM tb_order WHERE service_id='".$service_id."'";
        if($status != ''){
            $query .= "AND status = '".$status."'";
        }else{
            $query .= "AND status < 5 ";
        }
        $query .= "  ORDER BY id DESC";
        if($count > 0)
            $query .= " LIMIT ".$count;
        $result = $this->db->query($query);
        return $result->result_array();
    }


    /**
     * GET ORDER ITEM FROM ORDER_ID
     */
    public function getOrderContent($id){
        $query = "SELECT * FROM tb_order WHERE id = $id";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    /**
     * GET NUMBER OF COUNT IN ORDER LIST BASED ON DURATION
     */
    public function getOrdersForStatistic($from, $to, $kind){
        $from .= " 00:00:00";
        $to  .= " 23:59:59";
        $query = "SELECT * FROM tb_order WHERE status = '$kind' AND (created_at BETWEEN '$from' AND '$to')";
        $result = $this->db->query($query);
        return $result->num_rows();
    }
    /*
     * GET ORDER LIST BASED ON ORDER KIND
     */
    public function getOrdersForList($kind){
        $query = "SELECT * FROM tb_order WHERE status = '$kind' ORDER BY id DESC;";
        $result = $this->db->query($query);
        return $result->result_array();
    }


    /**
     * Current Working Jobs for service man
     */
    public function getCurrentWorkingJob($service_id){
        $query = "SELECT * FROM tb_order WHERE status > '2' AND status < '6' AND service_id = '".$service_id."'";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getLocation($id){
        $query = "SELECT * FROM tb_order WHERE service_id = '".$id."' ORDER BY id DESC LIMIT 1";
        $result = $this->db->query($query);
        return $result->result_array();
    }

}