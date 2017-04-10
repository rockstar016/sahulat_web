<?php

/**
 * Created by PhpStorm.
 * User: rock
 * Date: 3/15/17
 * Time: 11:27 PM
 */
class Order_model extends CI_Model
{
    public function __construct()
    {

        $this->load->database();
    }

    public function makeOrder($client_id, $ord_lat, $ord_long, $ord_address, $time){
        if(isset($time) == false)
            $time = date("Y-m-d H:i:s");
        if($time == ""){
            $time = date("Y-m-d H:i:s");
        }
        $data = array(
            'client_id' => $client_id,
            'service_id' => 0,
            'status' => 0,
            'ord_lat' => $ord_lat,
            'ord_long' => $ord_long,
            'order_date' => $time,
            'ord_address' => $ord_address,
            'ord_feedback' =>0
        );
        $this->db->set('created_at','NOW()', FALSE);
        $this->db->set('updated_at','NOW()', FALSE);
        $this->db->insert('tb_order',$data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function editOrder($id, $client_id, $lat, $lot, $addr, $date_time_order){
        if(isset($date_time_order) == false)
            $date_time_order = date("Y-m-d H:i:s");
        if($date_time_order == ""){
            $date_time_order = date("Y-m-d H:i:s");
        }
        $data = array(
            'client_id' => $client_id,
            'service_id' => 0,
            'status' => 0,
            'ord_lat' => $lat,
            'ord_long' => $lot,
            'order_date' => $date_time_order,
            'ord_address' => $addr,
            'ord_feedback' =>0
        );
        $this->db->set('updated_at','NOW()', FALSE);
        $this->db->where('id', $id);
        $this->db->update('tb_order',$data);
    }

    public function getRatableList($client_id){
        $query = "SELECT * FROM tb_order WHERE client_id='".$client_id."' AND status=1";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function rateOrder($order_id, $score, $client_id){
       $query = "UPDATE tb_order SET status='2', ord_feedback='".$score."', updated_at=NOW() WHERE id='".$order_id."' AND client_id='".$client_id."'";
       $this->db->query($query);
    }

    public function getHistory($client_id){
        $query = "SELECT * FROM tb_order WHERE client_id='".$client_id."' AND status=2";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function saveFBToken($client_id, $fb_token){
        $query = "SELECT * FROM tb_token WHERE user_id=".$client_id;
        $result = $this->db->query($query);
        $count_recrods = $result->num_rows();
        if($count_recrods == 0){
            $data = array(
                'user_id' => $client_id,
                'fire_token' => $fb_token
            );
            $this->db->insert('tb_token',$data);
        }
        else{
            $data = array(
                'fire_token' => $fb_token
            );
            $this->db->where('user_id', $client_id);
            $this->db->update('tb_token', $data);
        }
    }


    public function getPendingOrders($client_id){
        $query = "SELECT * FROM tb_order WHERE service_id='".$client_id."' AND status = 0";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getActiveOrders($client_id){
        $query = "SELECT * FROM tb_order WHERE service_id='".$client_id."' AND status = 1";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function setOrderStatus($service_id, $order_id, $status){
        if($status == 1){
            $query = "UPDATE tb_order SET status='".$status."', updated_at=NOW() WHERE id='".$order_id."' AND service_id='".$service_id."'";
        }
        else{
            $query = "UPDATE tb_order SET status='".$status."', service_id=0, updated_at=NOW() WHERE id='".$order_id."' AND service_id='".$service_id."'";
        }
        $this->db->query($query);
        return $query;
    }

    public function assignOrderToService($service_id, $order_id){
        $query = "UPDATE tb_order SET status='0', service_id = '".$service_id."', updated_at=NOW() WHERE id='".$order_id."'";
        $this->db->query($query);
    }

    public function getAllOrders($client_id){
        $query = "SELECT * FROM tb_order WHERE client_id = $client_id";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getOrdersOfServiceman($service_id){
        $query = "SELECT * FROM tb_order WHERE service_id = $service_id";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getOrderContent($id){
        $query = "SELECT * FROM tb_order WHERE id = $id";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getOrdersForStatistic($from, $to, $kind){
        $from .= " 00:00:00";
        $to  .= " 23:59:59";

        $query = "SELECT * FROM tb_order WHERE status = '$kind' AND (created_at BETWEEN '$from' AND '$to')";
        $result = $this->db->query($query);
        return $result->num_rows();
    }

    public function getOrdersForList($kind){
        $query = "SELECT * FROM tb_order WHERE status = '$kind' ORDER BY id DESC;";
        $result = $this->db->query($query);
        return $result->result_array();
    }
}