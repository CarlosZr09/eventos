<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function check_credentials($email, $password) {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get('users'); 

        if ($query->num_rows() === 1) {
            return $query->row();
        } else {
            return false;
        }
    }
}