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
        $query = "SELECT * FROM tb_order WHERE service_id=".$servicemanID." AND STATUS=".$status;
        $result = $this->db->query($query);
        return count($result);
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

    public function getOrdersForTable()
    {
        $query = "SELECT * FROM tb_order ORDER BY created_at DESC;";
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
        $serviceman_arr = $this->getAllServiceman("");
        for ($i=0; $i<count($serviceman_arr);$i++)
        {
            if($i == $nId)
            {
                return $serviceman_arr[$i];
            }
        }
        return "";
    }
}
