<?php

/**
 * Created by PhpStorm.
 * User: rock
 * Date: 3/15/17
 * Time: 11:27 PM
 */
class Dashboard_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getAllServiceman($name){
        $query = "SELECT * FROM tb_client WHERE kind = 0";
        if($name != "")
            $query .= " AND user_name LIKE '$name%'";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function get_client($id){
        $this->db->where('id',$id);
        $query = $this->db->get('tb_client');
        return $query->result_array();
    }


    public function getAllClient($name){
        $query = "SELECT * FROM tb_client WHERE kind = 1";
        if($name != "")
            $query .= " AND user_name LIKE '$name%'";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function updateUserInformation($id, $name, $phone, $email){
        $data = array(
            'user_name' => $name,
            'user_phone'  => $phone,
            'user_email'  => $email
        );
        $this->db->where('id', $id);
        $this->db->update('tb_client', $data);
    }

    public function getNumberJob($status,$servicemanID)
    {
        $query = "SELECT * FROM tb_order WHERE service_id=".$servicemanID." AND status=".$status;
        $result = $this->db->query($query);
        return $result->num_rows();
    }

    public function getRating($servicemanID)
    {
        $query = "SELECT ord_feedback FROM tb_order WHERE service_id=".$servicemanID;
        $result = $this->db->query($query)->result_array();
        $avg = 0;
        $cn = count($result);

        for($i=0; $i<$cn; $i++)
        {
            $p=(float)($result[$i]['ord_feedback']);
            $avg += $p /$cn;
        }

        return $avg;
    }

    //checked
    public function getOrdersForTable($start_date, $end_date)
    {
        $query = "SELECT * FROM tb_order WHERE tb_order.created_at BETWEEN '".$start_date."' AND '".$end_date."' ORDER BY created_at DESC;";
        $result = $this->db->query($query);
        return $result->result_array();
    }
    //checked
    public function getOrdersForTable2($start_date, $end_date)
    {
        $query = "SELECT * FROM tb_order WHERE tb_order.updated_at BETWEEN '".$start_date."' AND '".$end_date."' ORDER BY created_at DESC;";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    //checked
    public function getOrdersForTable3($date){
        $query = "SELECT * FROM tb_order WHERE tb_order.order_date < '".$date."' AND status <> '2' ORDER BY created_at ASC;";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    //checked
    public function getOrdersForTable4($start_date, $end_date)
    {
        $query = "SELECT * FROM tb_order WHERE tb_order.created_at BETWEEN '".$start_date."' AND '".$end_date."' AND status = '2' ORDER BY created_at DESC;";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getPosData()
    {
        $query = "SELECT * FROM tb_service ORDER BY id DESC;";
        $result = $this->db->query($query);
        return $result->result_array();

    }

    public function getServiceNameFromServiceId($nId)
    {
        $query = "SELECT * FROM tb_client WHERE kind='0' AND id='".$nId."';";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getNoClientRegistration($start_date, $end_date)
    {
        $query = "SELECT * FROM tb_client WHERE created_at < '".$end_date."' AND kind = 1";
        $result = $this->db->query($query);
        return $result->num_rows();
    }

    public function getNoFeedback($start_date, $end_date){

        $query = "SELECT * FROM tb_order WHERE (updated_at BETWEEN '".$start_date."' AND '".$end_date."') AND ord_feedback <> 0";
        $result = $this->db->query($query);
        return $result->num_rows();
    }

    public function getNoServiceRegistration($start_date, $end_date)
    {

        $query = "SELECT * FROM tb_client WHERE created_at < '".$end_date."' AND kind = 0";
        $result = $this->db->query($query);
        return $result->num_rows();
    }

    public function getNoClientOrders($start_date, $end_date)
    {

        $query = "SELECT * FROM tb_order WHERE updated_at BETWEEN '".$start_date."' AND '".$end_date."'";
        $result = $this->db->query($query);
        return $result->num_rows();
    }

    public function getNoPendingOrders($start_date, $end_date)
    {
        $query = "SELECT * FROM tb_order WHERE status = 0 AND updated_at BETWEEN '".$start_date."' AND '".$end_date."'";
        $result = $this->db->query($query);
        return $result->num_rows();
    }

    public function getNoCompletedOrders($start_date, $end_date)
    {
        $query = "SELECT * FROM tb_order WHERE status = 2 AND updated_at BETWEEN '".$start_date."' AND '".$end_date."'";
        $result = $this->db->query($query);
        return $result->num_rows();
    }

    public function getNoProcessedOrders($start_date, $end_date)
    {
        $query = "SELECT * FROM tb_order WHERE status = 1 AND updated_at BETWEEN '".$start_date."' AND '".$end_date."'";
        $result = $this->db->query($query);
        return $result->num_rows();
    }

    public function getDataForFlotChart($start_date, $end_date){
        $query = "SELECT DATE(created_at) AS date, COUNT(id) AS count FROM tb_order WHERE tb_order.created_at BETWEEN '".$start_date."' AND '".$end_date."'  GROUP BY DATE(tb_order.created_at);";
        $result = $this->db->query($query);
        return $result->result_array();
    }
}
