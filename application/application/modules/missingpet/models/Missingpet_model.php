<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Missingpet_model extends CI_model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function insertMissingpet($data)
    {
        $this->db->insert('missingpet', $data);
    }

    function getMissingpet($location_search='', $name_search='')
    {
        $this->db->select('Base.id,Base.owner,Base.patient,Base.pet_type,Base.phone,Base.description,Base.add_date,Base.img_url,
        Owner.name as ownerName,Owner.address as ownerAddress, Patient.name as patientName, Patient.address as patientAddress');
        $this->db->from('missingpet as Base');
        $this->db->join('owner as Owner','Owner.id = Base.owner','left');
        $this->db->join('patient as Patient','Patient.id = Base.patient','left');

        if (!empty($name_search)) {
            $this->db->like('owner.name', $name_search);
            $this->db->or_like('patient.name', $name_search);
        }
        if (!empty($location_search)) {

            $this->db->like('owner.address', $location_search);
            $this->db->or_like('patient.address', $location_search);
        }


        $query = $this->db->get();
        return $query->result();
    }

    function getMissingpetById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('missingpet');
        return $query->row();
    }
    function updateMissingpet($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('missingpet', $data);
    }

    function deleteMissingpet($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('missingpet');
    }

    function getMissingpetBySearch($search, $order, $dir)
    {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->select('*')
            ->from('missingpet')
            ->where('hospital_id', $this->session->userdata('hospital_id'))
            ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR phone LIKE '%" . $search . "%' OR address LIKE '%" . $search . "%'OR email LIKE '%" . $search . "%')", NULL, FALSE)
            ->get();
        return $query->result();
    }

    function getMissingpetWithoutSearch($order, $dir)
    {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'asc');
        }
        $query = $this->db->get('missingpet');
        return $query->result();
    }
    function getMissingpetByLimitBySearch($limit, $start, $search, $order, $dir)
    {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
            ->from('missingpet')
            ->where('hospital_id', $this->session->userdata('hospital_id'))
            ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR phone LIKE '%" . $search . "%' OR address LIKE '%" . $search . "%'OR email LIKE '%" . $search . "%')", NULL, FALSE)
            ->get();
        return $query->result();
    }

    function getMissingpetByLimit($limit, $start, $order, $dir)
    {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('missingpet');
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

    function getMissingpetByIonUserId($id)
    {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('missingpet');
        return $query->row();
    }

    function getShareAmountByMissingpetId($id)
    {
        $this->db->order_by('id', 'desc');
        $this->db->where('id', $id);
        $query = $this->db->get('missingpet');
        return $query->result();
    }

    function getDepositByMissingpetId($id)
    {

        $this->db->order_by('id', 'desc');
        $this->db->where('missingpet_id', $id);
        $query = $this->db->get('missingpet_deposit');
        return $query->result();
    }
    function deleteDepositByMissingpetId($id)
    {
        $this->db->where('missingpet_id', $id);
        $this->db->delete('missingpet_deposit');
    }

    function getMissingpetDepositById($id)
    {

        $this->db->where('id', $id);
        $query = $this->db->get('missingpet_deposit');
        return $query->row();
    }
    function deleteMissingpetDeposit($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('missingpet_deposit');
    }
}
