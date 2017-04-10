<?php

/**
 * Created by PhpStorm.
 * User: rock
 * Date: 3/15/17
 * Time: 11:27 PM
 */
class Serviceman_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    public function updateposition($id, $lat, $lot){
        $query = "SELECT * FROM tb_service WHERE service_id=".$id;
        $result = $this->db->query($query);
        $count_recrods = $result->num_rows();
        if($count_recrods === 0){
            $data = array(
                'service_id' => $id,
                'service_cur_long' => $lot,
                'service_cur_lat' => $lat
            );
            $this->db->set('updated_at','NOW()', FALSE);
            $this->db->insert('tb_service',$data);
            $this->db->insert_id();
        }
        else{
            $data = array(
                'service_id' => $id,
                'service_cur_long' => $lot,
                'service_cur_lat' => $lat
            );
            $this->db->set('updated_at','NOW()', FALSE);
            $this->db->where('service_id', $id);
            $this->db->update('tb_service', $data);
        }
    }

    public function getPosition($id){
        $query = "SELECT * FROM tb_service WHERE service_id=$id";
        $result = $this->db->query($query);
        return $result->result_array();
    }


}