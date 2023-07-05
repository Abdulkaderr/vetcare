<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Owner_model extends CI_model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function insertOwner($data)
    {

        $this->db->insert('owner', $data);
    }

    function insertDoctorOwner($data)
    {

        $this->db->insert('doctors_owners', $data);
    }

    function getOwner()
    {
        $query = $this->db->get('owner');
        return $query->result();
    }

    function getMyOwners($id)
    {
        $this->db->select('owner.*');
		$this -> db -> from('owner');
        $this -> db -> join('doctors_owners', 'doctors_owners.owner_id = owner.id', 'inner');
		$this -> db -> where('doctor_id', $id);
        //Get All Data from Database
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        } else {
            return $query->result();
        }
    }

    function getOwnerById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('owner');
        return $query->row();
    }

    function updateOwner($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('owner', $data);
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('owner');
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

    function getOwnerByIonUserId($id)
    {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('owner');
        return $query->row();
    }

    function getOwnerBySearch($search, $order, $dir)
    {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->like('id', $search);
        $this->db->or_like('name', $search);
        $this->db->or_like('phone', $search);
        $this->db->or_like('address', $search);
        $this->db->or_like('email', $search);
        $query = $this->db->get('owner');
        return $query->result();
    }

    function getMyOwnerBySearch($id, $search, $order, $dir)
    {
        $this->db->select('owner.*');
		$this -> db -> from('owner');
        $this -> db -> join('doctors_owners', 'doctors_owners.owner_id = owner.id', 'inner');
		$this -> db -> where('doctor_id', $id);
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->like('id', $search);
        $this->db->or_like('name', $search);
        $this->db->or_like('phone', $search);
        $this->db->or_like('address', $search);
        $this->db->or_like('email', $search);
        $query = $this->db->get();
        return $query->result();
    }

    function getOwnerWithoutSearch($order, $dir)
    {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->get('owner');
        return $query->result();
    }

    function getMyOwnerWithoutSearch($id, $order, $dir)
    {
        $this->db->select('owner.*');
		$this -> db -> from('owner');
        $this -> db -> join('doctors_owners', 'doctors_owners.owner_id = owner.id', 'inner');
		$this -> db -> where('doctor_id', $id);
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->get();
        return $query->result();
    }

    function getOwnerByLimitBySearch($limit, $start, $search, $order, $dir)
    {

        $this->db->like('id', $search);

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }

        $this->db->or_like('name', $search);
        $this->db->or_like('phone', $search);
        $this->db->or_like('address', $search);
        $this->db->or_like('email', $search);


        $this->db->limit($limit, $start);
        $query = $this->db->get('owner');
        return $query->result();
    }

    function getMyOwnerByLimitBySearch($id, $limit, $start, $search, $order, $dir)
    {

        $this->db->select('owner.*');
		$this -> db -> from('owner');
        $this -> db -> join('doctors_owners', 'doctors_owners.owner_id = owner.id', 'inner');
        $this -> db -> where('doctors_owners.doctor_id', $id);
        $this->db->like('owner.id', $search);

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('owner.id', 'desc');
        }

        $this->db->or_like('owner.name', $search);
        $this->db->or_like('.owner.phone', $search);
        $this->db->or_like('owner.address', $search);
        $this->db->or_like('owner.email', $search);
        $this->db->or_like('owner.nid', $search);

        

        $this->db->limit($limit, $start);
        
        
        $query = $this->db->get();
        return $query->result();
        
    }

    function getOwnerByLimit($limit, $start, $order, $dir)
    {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('owner');
        return $query->result();
    }

    function getMyOwnerByLimit($id, $limit, $start, $order, $dir)
    {
        $this->db->select('owner.*');
		$this -> db -> from('owner');
        $this -> db -> join('doctors_owners', 'doctors_owners.owner_id = owner.id', 'inner');
		$this -> db -> where('doctor_id', $id);

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }



    function getOwnerInfo($searchTerm)
    {
        if (!empty($searchTerm)) {
            $this->db->select('*');
            $this->db->where("name like '%" . $searchTerm . "%' OR nid like '%" . $searchTerm . "%' OR phone like '%" . $searchTerm . "%'");
            $fetched_records = $this->db->get('owner');
            $users = $fetched_records->result_array();
        } else {
            $this->db->select('*');
            $this->db->limit(10);
            $fetched_records = $this->db->get('owner');
            $users = $fetched_records->result_array();
        }
        // Initialize Array with fetched data
        $data = array();
        foreach ($users as $user) {
            if (empty($user['age'])) {
                $dateOfBirth = $user['birthdate'];
                if (empty($dateOfBirth)) {
                    $age[0] = '0';
                } else {
                    if (strtotime($dateOfBirth)) {
                        $today = date("Y-m-d");
                        $diff = date_diff(date_create($dateOfBirth), date_create($today));
                        $age[0] = $diff->format('%y');
                    } else {
                        $age[0] = '';
                    }
                }
            } else {
                $age = explode('-', $user['age']);
            }
            $data[] = array("id" => $user['id'], "text" => $user['name'] . ' (' . lang('nid') . ': ' . $user['nid'] . ' - ' . lang('phone') . ': ' . $user['phone'] . ')');

        }
        return $data;
    }


    function getOwnerinfoWithAddNewOption($searchTerm)
    {
        if (!empty($searchTerm)) {
            $this->db->select('*');
            $this->db->where("name like '%" . $searchTerm . "%' OR nid like '%" . $searchTerm . "%' OR phone like '%" . $searchTerm . "%'");
            $fetched_records = $this->db->get('owner');
            $users = $fetched_records->result_array();
        } else {
            $this->db->select('*');
            $this->db->limit(10);
            $fetched_records = $this->db->get('owner');
            $users = $fetched_records->result_array();
        }
        // Initialize Array with fetched data
        $data = array();
        $data[] = array("id" => 'add_new', "text" => lang('add_new'));
        foreach ($users as $user) {

            if (empty($user['age'])) {
                $dateOfBirth = $user['birthdate'];
                if (empty($dateOfBirth)) {
                    $age[0] = '0';
                } else {
                    if (strtotime($dateOfBirth)) {
                        $today = date("Y-m-d");
                        $diff = date_diff(date_create($dateOfBirth), date_create($today));
                        $age[0] = $diff->format('%y');
                    } else {
                        $age[0] = '';
                    }
                }
            } else {
                $age = explode('-', $user['age']);
            }
            $data[] = array("id" => $user['id'], "text" => $user['name'] . ' (' . lang('nid') . ': ' . $user['nid'] . ' - ' . lang('phone') . ': ' . $user['phone'] . ')');
        }
        return $data;
    }
}
