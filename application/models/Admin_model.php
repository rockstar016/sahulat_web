<?php

/**
 * Created by PhpStorm.
 * User: rock
 * Date: 3/15/17
 * Time: 11:27 PM
 */
class Admin_model extends CI_Model
{
    public function __construct(){
        $this->load->database();
    }

    public function getHash($password){
        return md5($password);
    }

    public function login($user_auth, $user_password){
        $query = "SELECT * FROM tb_admin WHERE (master_name = '".$user_auth."' OR master_email ='".$user_auth."') AND master_password='".$this->getHash($user_password)."'";
        $row_value = $this->db->query($query);
        if($row_value->num_rows() > 0){
            $return_value['data'] = $row_value->row();
            $return_value['result'] = true;
        }
        else{
            $return_value['data'] = array();
            $return_value['result'] = false;
        }
        return $return_value;
    }

    public function getAllAdmins(){
        $query = "SELECT * FROM tb_admin";
        $result = $this->db->query($query);
        return $result->result_array();
    }
    public function insert_admin($name, $pwd, $email,$phone){
        //name, password, phone_number, email, verified_phone, verified_email, created_at, updated_at
        $data = array(
            'master_name' => $name,
            'master_password' => $this->getHash($pwd),
            'master_phone' => $phone,
            'master_email' => $email,
        );
        $this->db->insert('tb_admin',$data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function get_admin($id){
        $this->db->where('id',$id);
        $query = $this->db->get('tb_admin');
        return $query->result_array();
    }

    public function updateUserInformation($id, $name, $phone, $email, $password){
        $data = array(
            'master_name' => $name,
            'master_phone'  => $phone,
            'master_email'  => $email,
            'master_password' => $this->getHash($password)
        );
        $this->db->where('id', $id);
        $this->db->update('tb_admin', $data);
    }

    public function removeAdmin($id){
        $this->db->delete('tb_admin', array('id' => $id));
    }
}