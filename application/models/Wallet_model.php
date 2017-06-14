<?php

/**
 * Created by PhpStorm.
 * User: rock
 * Date: 5/2/17
 * Time: 5:59 PM
 */
class Wallet_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    /*
     * insert new record
     */
    public function insertNewCash($client_id, $amount, $order_id){
        $data = array(
                    'client_id' => $client_id,
                    'amount' => $amount,
                    'order_id' => $order_id
        );
        $this->db->set('created_at', 'NOW()', FALSE);
        $this->db->insert('tb_wallet', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    /*
     * get records with client_id and limit
     */
    public function getRecordsWithClientLimit($client_id, $limit){
        $query = "SELECT * FROM tb_wallet WHERE client_id ='".$client_id."' ORDER BY id DESC";
        if($limit > 0)
            $query .= " LIMIT ".$limit;
        $result = $this->db->query($query);
        return $result->result_array();

    }

}