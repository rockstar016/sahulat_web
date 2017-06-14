<?php

/**
 * Created by PhpStorm.
 * User: rock
 * Date: 3/15/17
 * Time: 11:27 PM
 */
class Serviceman_history_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    /*
     * INSERT NEW RECORDS
     * $result->0->reject
     *          1->accept
     */
    public function insertNewHistory($service_id, $order_id, $result, $assigned_time){
        $data = array(
            'service_id' => $service_id,
            'order_id' => $order_id,
            'result' => $result,
            'assigned_time' => $assigned_time
        );
        $this->db->set('replied_time','NOW()',FALSE);
        $this->db->insert('tb_orderman_history', $data);
        return $this->db->insert_id();
    }

//    public function acceptOrRejctHistory($order_id, $service_id, $result){
//        $data = array(
//            'service_id' => 0,
//            'status' => 1
//        );
//        $this->db->set('updated_at','NOW()', FALSE);
//        $this->db->where('id',$order_id);
//        $this->db->update('tb_order', $data);
//    }
    /*
     * GET HISTORY BASED ON ORDER ID
     */
    public function getHistoryBasedOrderID($order_id){
        $query = "SELECT * FROM tb_orderman_history WHERE order_id='".$order_id."'";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    /*
     * GET HISTORY BASED ON SERVICE ID
     */
    public function getHistoryBasedServiceID($service_id){
        $query = "SELECT * FROM tb_orderman_history WHERE service_id='".$service_id."'";
        $result = $this->db->query($query);
        return $result->result_array();
    }
}