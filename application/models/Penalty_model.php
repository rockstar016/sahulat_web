<?php

/**
 * Created by PhpStorm.
 * User: rock
 * Date: 5/2/17
 * Time: 5:59 PM
 */
class Penalty_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    /*
     * insert new record
     */
    public function insertNewRecord($amount){
        $this->db->set('amount', $amount, FALSE);
        $this->db->insert('tb_penalty');
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    /*
     * get records with client_id and limit
     */
    public function getCurrentPenalty(){
        $query = "SELECT * FROM tb_penalty ORDER BY id DESC LIMIT 1";
        $result = $this->db->query($query);
        return $result->result_array();

    }

}