<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events_model extends CI_Model {

    public function list(){
        $this->db->where('status',1);
        $query = $this->db->get('events');
        if ($query->num_rows() >0) {
            return $query->result();
        } else {
            return []; 
        }
    }

    public function addEvent($insert){
        if($this->db->insert('events',$insert)){
			return $this->db->insert_id();
		}else{
			return 0;
		}
	}

    public function getEventById($eventId) {
        $query = $this->db->get_where('events', array('id' => $eventId));
        return $query->row();
    }
    
}