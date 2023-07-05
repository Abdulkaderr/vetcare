<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lostpets_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    
//new queries


function getlostpets() {
    $query = $this->db->get('lost_pets');
    return $query->result();
}

function getownerlostpets($user_id) {
    $this->db->where('user_id', $user_id);
    $query = $this->db->get('lost_pets');
    return $query->result();
}

function getdoctorlostpets($user_id) {
    $this->db->where('user_id', $user_id);
    $query = $this->db->get('lost_pets');
    return $query->result();
}

function insertlostpets($data) {

    $this->db->insert('lost_pets', $data);
}

function delete($id)
{
    $this->db->where('id', $id);
    $this->db->delete('lost_pets');
}

function approve($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('lost_pets', $data);
    }


    function disapprove($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('lost_pets', $data);
    }

}
