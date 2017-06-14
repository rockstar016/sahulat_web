<?php

/**
 * Created by PhpStorm.
 * User: rock
 * Date: 3/15/17
 * Time: 11:27 PM
 */
class Client_model extends CI_Model
{
    public function __construct()
    {

        $this->load->database();
    }
    public function getHash($password){
        return md5($password);
    }
    public function insert_client($name, $pwd, $phone, $email, $kind){
        //name, password, phone_number, email, verified_phone, verified_email, created_at, updated_at

        $data = array(
            'kind' => $kind,
            'user_name' => $name,
            'user_pwd' => $this->getHash($pwd),
            'user_phone' => $phone,
            'user_email' => $email,
            'verified_phone' => '0',
            'verified_email' => '0'
        );
        $this->db->set('created_at','NOW()', FALSE);
        $this->db->set('updated_at','NOW()', FALSE);
        $this->db->insert('tb_client',$data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    //checked
    public function is_valid_phone_number($phone_number){
        $query = $this->db->get_where('tb_client', array('user_phone'=>$phone_number));
        return $query->num_rows();
    }

    //checked
    public function is_valid_email_address($email_address){
        $query = $this->db->get_where('tb_client', array('user_email'=>$email_address));
        return $query->num_rows();
    }
    //checked
    public function get_client($id){
        $this->db->where('id',$id);
        $query = $this->db->get('tb_client');
        return $query->result_array();
    }

    public function activate_email($id){
        $data = array(
            'verified_email' => '1'
        );
        $this->db->where('id', $id);
        return $this->db->update('tb_client',$data);
    }

    public function activate_phone($id){
        $data = array(
            'verified_phone' => '1'
        );
        $this->db->where('id', $id);
        return $this->db->update('tb_client',$data);
    }

    public function login($authentication_field, $password){
        $hash_pwd = $this->getHash($password);
        $query = "SELECT * FROM tb_client WHERE (user_phone = '".$authentication_field."') AND user_pwd = '".$hash_pwd."' AND is_activated = 1";
        $result = $this->db->query($query);
        $return_value = array();
        $row_value = $result->row();

        if(isset($row_value)){
            $return_value['id'] = $row_value->id;
            $return_value['result'] = true;
        }
        else{
            $return_value['id'] = -1;
            $return_value['result'] = false;
        }
        return $return_value;
    }

    public function update_info($id, $field, $value){
        //0:name, 1: email, 2: phone 3: password 4: is_activated 5: is_agree
        $query = "";
        if($field == 0){
            $query = "UPDATE tb_client SET user_name='".$value."' WHERE id='".$id."'";
        }
        else if($field == 1){
            $query = "UPDATE tb_client SET user_email='".$value."', verified_email='0' WHERE id='".$id."'";
        }
        else if($field == 2){
            $query = "UPDATE tb_client SET user_phone='".$value."', verified_phone = '0' WHERE id='".$id."'";
        }
        else if($field == 3){
            $query = "UPDATE tb_client SET user_pwd='".$this->getHash($value)."' WHERE id='".$id."'";
        }
        else if($field == 4){
            $query = "UPDATE tb_client SET is_activated='".$value."' WHERE id='".$id."'";
        }
        else if($field == 5){
            $query = "UPDATE tb_client SET is_agree='".$value."' WHERE id='".$id."'";
        }
        $this->db->query($query);
    }

    public function getAllClient($name){
        $query = "SELECT * FROM tb_client WHERE kind = 1";
        if($name != "")
            $query .= " AND user_name LIKE '$name%'";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function getAllServiceman($name){
        $query = "SELECT * FROM tb_client WHERE kind = 0";
        if($name != "")
            $query .= " AND user_name LIKE '$name%'";
        $result = $this->db->query($query);
        return $result->result();
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


    /**
     * Update Deposit Amount
     * @param $id indicates client id
     * @param $amount indicates the amount of deposit(that will be added or subracted.
     */
    public function addDepositAmount($id, $amount){
        $this->db->select('current_deposit');
        $this->db->where('id', $id);
        $query = $this->db->get('tb_client');
        $data = $query->result_array();
        $current_amount = $data[0]['current_deposit'];
        $current_amount += $amount;

        $this->db->set('current_deposit', $current_amount, FALSE);
        $this->db->where('id',$id);
        $this->db->update('tb_client');
    }
}