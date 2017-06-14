<?php

/**
 * Created by PhpStorm.
 * User: rock
 * Date: 5/2/17
 * Time: 7:27 PM
 */
class Feedback_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    /**
     * INSERT NEW Feedback
     */
    public function insertNewRecord($order_id, $client_id, $service_id, $rate_scroe, $feedback){
        $data = array(
            'order_id' => $order_id,
            'client_id' => $client_id,
            'service_id' => $service_id,
            'rate_score' => $rate_scroe,
            'feedback' => $feedback
        );
        $this->db->set('created_at','NOW()', FALSE);
        $this->db->insert('tb_feedback', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    /**
     * GET FEED BACK ARRAY
     */
    public function getFeedback($kind, $user_id, $limit){
        $query="";
        if($kind == '0'){
            //FOR CLIENT
            $query = "SELECT * FROM tb_feedback WHERE client_id='".$user_id."' ORDER BY id DESC LIMIT ".$limit;
        }
        else{
            //FOR SERVICE MAN
            $query = "SELECT * FROM tb_feedback WHERE service_id='".$user_id."' ORDER BY id DESC LIMIT ".$limit;
        }

        $result = $this->db->query($query);
        return $result->result_array();
    }

    /**
     * GET AVG RATE OF SERVICE MAN
     *
     */
    public function getAVGRateFeedback($user_id){
        $query = "SELECT Avg(rate_score) AS average FROM tb_feedback WHERE service_id ='".$user_id."'";
        $result = $this->db->query($query);
        return $result->result_array();
    }
    /*
     * GET FEEDBACK ITEM
     */
    public function getFeedbackItem($id){
        $query = "SELECT * FROM tb_feedback WHERE id = $id";
        $result = $this->db->query($query);
        return $result->result_array();
    }


    /**
     * ADD COMPLIANT OR SUGGESTION
     */
    public function addCompliantSuggestion($user_id, $content, $kind){
        $data = array(
            'kind' => $kind,
            'user_id' => $user_id,
            'content' => $content
        );
        $this->db->set('created_at','NOW()', FALSE);
        $this->db->insert('tb_suggestion', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
}