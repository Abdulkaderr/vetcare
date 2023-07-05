<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Matingpet_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertMatingpet($data) {
        $this->db->insert('matingpet', $data);
    }

    function getMatingpet($location_search2='',$name_search2='') {
        $this->db->select('Base.id,Base.owner,Base.patient,Base.pet_type,Base.phone,Base.description,Base.add_date,Base.img_url,
        Owner.name as ownerName,Owner.address as ownerAddress, Patient.name as patientName, Patient.address as patientAddresss');
        $this->db->from('matingpet as Base');
        $this->db->join('owner as Owner','Owner.id = Base.owner','left');
        $this->db->join('patient as Patient','Patient.id = Base.patient','left');
        
        if (!empty($name_search2)) {
            $this->db->like('owner.name', $name_search2);
            $this->db->or_like('patient.name', $name_search2);
        }
        if (!empty($location_search2)) {

            $this->db->like('owner.address', $location_search2);
            $this->db->or_like('patient.address', $location_search2);
        }
        

        $query = $this->db->get();
        return $query->result();
    }

    function getMatingpetById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('matingpet');
        return $query->row();
    }
    function updateMatingpet($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('matingpet', $data);
    }

    function deleteMatingpet($id) {
        $this->db->where('id', $id);
        $this->db->delete('matingpet');
    }

    function getMatingpetBySearch($search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->select('*')
                ->from('matingpet')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR phone LIKE '%" . $search . "%' OR address LIKE '%" . $search . "%'OR email LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getMatingpetWithoutSearch($order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'asc');
        }
        $query = $this->db->get('matingpet');
        return $query->result();
    }
    function getMatingpetByLimitBySearch($limit, $start, $search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('matingpet')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR phone LIKE '%" . $search . "%' OR address LIKE '%" . $search . "%'OR email LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getMatingpetByLimit($limit, $start, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('matingpet');
        return $query->result();
    }

    function updateIonUser($username, $email, $password, $ion_user_id)
    {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

    function getMatingpetByIonUserId($id)
    {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('matingpet');
        return $query->row();
    }

    function getShareAmountByMatingpetId($id)
    {
        $this->db->order_by('id', 'desc');
        $this->db->where('id', $id);
        $query = $this->db->get('matingpet');
        return $query->result();
    }

    function getDepositByMatingpetId($id)
    {

        $this->db->order_by('id', 'desc');
        $this->db->where('matingpet_id', $id);
        $query = $this->db->get('matingpet_deposit');
        return $query->result();
    }
    function deleteDepositByMatingpetId($id)
    {
        $this->db->where('matingpet_id', $id);
        $this->db->delete('matingpet_deposit');
    }

    function getMatingpetDepositById($id) {

        $this->db->where('id', $id);
        $query = $this->db->get('matingpet_deposit');
        return $query->row();
    }
    function deleteMatingpetDeposit($id) {
        $this->db->where('id', $id);
        $this->db->delete('matingpet_deposit');
    }
}
