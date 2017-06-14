<?php

/**
 * Created by PhpStorm.
 * User: rock
 * Date: 5/2/17
 * Time: 7:27 PM
 */
class Checkout_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    /**
     * INSERT NEW RECORD
     */
    public function insertNewRecord($order_id, $checkout_type, $pay_amount, $other_info){
        $data = array(
            'order_id' => $order_id,
            'checkout_type' => $checkout_type,
            'other_info' => $other_info,
            'amount' => $pay_amount
        );
        $this->db->set('created_time','NOW()', FALSE);
        $this->db->insert('tb_checkout', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    /**
     * UPDATE RECORD
     */
    public function updateRecord($id, $amount){
        $this->db->set('amount', $amount);
        $this->db->where('id', $id);
        $this->update('tb_checkout');
    }
}