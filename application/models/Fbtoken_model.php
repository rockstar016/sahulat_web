<?php

/**
 * Created by PhpStorm.
 * User: rock
 * Date: 3/15/17
 * Time: 11:27 PM
 */
class Fbtoken_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    public function updatetoken($id, $token){
        $query = "SELECT * FROM tb_token WHERE user_id=".$id;
        $result = $this->db->query($query);
        $count_recrods = $result->num_rows();
        if($count_recrods == 0){
            $data = array(
                'user_id' => $id,
                'fire_token' => $token
            );
            $this->db->insert('tb_token',$data);
        }
        else{
            $data = array(
                'fire_token' => $token
            );
            $this->db->where('user_id', $id);
            $this->db->update('tb_token', $data);
        }
    }

    public function getToken($id){
        $query = "SELECT * FROM tb_token WHERE user_id=$id";
        $result = $this->db->query($query);
        return $result->result_array();
    }


}