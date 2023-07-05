<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Foundpets_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    
//new queries


function getfoundpets() {
    $query = $this->db->get('found_pets');
    return $query->result();
}

function getownerfoundpets($user_id) {
    $this->db->where('user_id', $user_id);
    $query = $this->db->get('found_pets');
    return $query->result();
}

function getdoctorfoundpets($user_id) {
    $this->db->where('user_id', $user_id);
    $query = $this->db->get('found_pets');
    return $query->result();
}

function insertfoundpets($data) {

    $this->db->insert('found_pets', $data);
}

function delete($id)
{
    $this->db->where('id', $id);
    $this->db->delete('found_pets');
}

function approve($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('found_pets', $data);
    }


    function disapprove($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('found_pets', $data);
    }

}
