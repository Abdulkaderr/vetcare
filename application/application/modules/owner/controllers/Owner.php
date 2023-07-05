<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Owner extends MX_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('owner_model');

        // if (!$this->ion_auth->in_group(array('admin'))) {
        //     redirect('home/permission');
        // }
    }

    public function index()
    {

        $data['owners'] = $this->owner_model->getOwner();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('owner', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView()
    {
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new');
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew()
    {

        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $nid = $this->input->post('nid');
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[1]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[1]|max_length[50]|xss_clean');
        // Validating NID Field           
        $this->form_validation->set_rules('nid', 'NID Number', 'trim|required|min_length[1]|max_length[50]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("owner/editOwner?id=$id");
            } else {
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $file_name = $_FILES['img_url']['name'];
            $file_name_pieces = explode('_', $file_name);
            $new_file_name = '';
            $count = 1;
            foreach ($file_name_pieces as $piece) {
                if ($count !== 1) {
                    $piece = ucfirst($piece);
                }

                $new_file_name .= $piece;
                $count++;
            }
            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./uploads/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => False,
                'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "1768",
                'max_width' => "2024"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'img_url' => $img_url,
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone,
                    'nid' => $nid
                );
            } else {

                $data = array();
                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone,
                    'nid' => $nid
                );
            }

            $username = $this->input->post('name');

            if (empty($id)) {     // Adding New Owner
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', lang('this_email_address_is_already_registered'));
                    redirect('owner/addNewView');
                } else {
                    $dfg = 11;
                    $this->ion_auth->register($username, $password, $email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->owner_model->insertOwner($data);
                    $owner_user_id = $this->db->get_where('owner', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->owner_model->updateOwner($owner_user_id, $id_info);

                    //join doctor with owner
                    if ($this->ion_auth->in_group(array('Doctor'))) {
                        $user = $this->ion_auth->user()->row();
                        $u_email = $user->email;
                        $userId = $this->db->get_where('doctor', array('email' => $u_email))->row()->id;
                        $data1 = array();
                        $data1 = array(
                            'doctor_id' => $userId,
                            'owner_id' => $owner_user_id,
                        );

                        $this->owner_model->insertDoctorOwner($data1);
                    }
                    $this->session->set_flashdata('feedback', lang('added'));
                }
            } else {
                $ion_user_id = $this->db->get_where('owner', array('id' => $id))->row()->ion_user_id;
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                } else {
                    $password = $this->ion_auth_model->hash_password($password);
                }
                $this->owner_model->updateIonUser($username, $email, $password, $ion_user_id);
                $this->owner_model->updateOwner($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }

            redirect('owner');
        }
    }

    // function getOwner() {
    //     $data['owners'] = $this->owner_model->getOwner();
    //     $this->load->view('owner', $data);
    // }

    function editOwner()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['owner'] = $this->owner_model->getOwnerById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editOwnerByJason()
    {
        $id = $this->input->get('id');
        $data['owner'] = $this->owner_model->getOwnerById($id);
        echo json_encode($data);
    }

    function delete()
    {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('owner', array('id' => $id))->row();
        $path = $user_data->img_url;
        chmod($oldPicture, 0644);
        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->owner_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('owner');
    }

    function getOwner()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "name",


        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['owners'] = $this->owner_model->getOwnerBySearch($search, $order, $dir);
            } else {
                $data['owners'] = $this->owner_model->getOwnerWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['owners'] = $this->owner_model->getOwnerByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['owners'] = $this->owner_model->getOwnerByLimit($limit, $start, $order, $dir);
            }
        }


        $i = 0;
        foreach ($data['owners'] as $owner) {
            $i = $i + 1;
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
                $options1 = '<button type="button" class="btn btn-info btn-xs btn_width editbutton" title=" ' . lang('edit') . '" data-toggle="modal" data-id=" ' . $owner->id . '"> <i class="fa fa-edit"> </i></button>';
                $options3 = '<a class="btn btn-info btn-xs btn_width delete_button" title="' . lang('delete') . '" href="owner/delete?id=' . $owner->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i> ' . lang('delete') . '</a>';
            }


            $optionspets = '<a class="btn btn-info btn-xs btn_width" title="Pets list" href="patient/ownerpatient/' . $owner->id . '" <i class="fa fa-info"> </i> Pets list</a>';

            $image = '<img height="100" width="150" class="img" src="' . $owner->img_url . '">';


            if (empty($owner->img_url)) {
                $image = '';
            }

            $info[] = array(
                $image,
                $owner->name,
                $owner->email,
                $owner->address,
                $owner->phone,
                $owner->nid,
                $options1 . ' ' . $options3 . ' ' . $optionspets,
            );
        }

        if (!empty($data['owners'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->owner_model->getOwner()),
                "recordsFiltered" => $i,
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }



    public function getOwnerinfo()
    {
        $searchTerm = $this->input->post('searchTerm');
        $response = $this->owner_model->getOwnerInfo($searchTerm);
        echo json_encode($response);
    }

    public function getOwnerinfoWithAddNewOption()
    {
        $searchTerm = $this->input->post('searchTerm');
        $response = $this->owner_model->getOwnerinfoWithAddNewOption($searchTerm);
        echo json_encode($response);
    }

    

    //view doctor owners
    public function myowners()
    {
        $user = $this->ion_auth->user()->row();
        $u_email = $user->email;
        $userId = $this->db->get_where('doctor', array('email' => $u_email))->row()->id;
        $data['owners'] = $this->owner_model->getMyOwners($userId);
        $data['allowners'] = $this->owner_model->getOwner();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('myowners', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function getMyOwners() {
        //doctor email -- ion auth email
        $user = $this->ion_auth->user()->row();
        $u_email = $user->email;
        $userId = $this->db->get_where('doctor', array('email' => $u_email))->row()->id;
        //$userId = $this->ion_auth->get_user_id();
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "name",


        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['owners'] = $this->owner_model->getMyOwnerBySearch($userId, $search, $order, $dir);
                //$data['owners'] = $this->owner_model->getMyOwners($userId);
            } else {
                $data['owners'] = $this->owner_model->getMyOwnerWithoutSearch($userId, $order, $dir);
                //$data['owners'] = $this->owner_model->getMyOwners($userId);
            }
        } else {
            if (!empty($search)) {
                $data['owners'] = $this->owner_model->getMyOwnerByLimitBySearch($userId, $limit, $start, $search, $order, $dir);
                //print_r($data['owners']);
                //$data['owners'] = $this->owner_model->getMyOwners($userId);
            } else {
                $data['owners'] = $this->owner_model->getMyOwnerByLimit($userId, $limit, $start, $order, $dir);
                //$data['owners'] = $this->owner_model->getMyOwners($userId);
            }
        }


        $i = 0;
        foreach ($data['owners'] as $owner) {
            $i = $i + 1;
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
                $options1 = '<button type="button" class="btn btn-info btn-xs btn_width editbutton" title=" ' . lang('edit') . '" data-toggle="modal" data-id=" ' . $owner->id . '"> <i class="fa fa-edit"> </i></button>';
                $options3 = '<a class="btn btn-info btn-xs btn_width delete_button" title="' . lang('delete') . '" href="owner/delete?id=' . $owner->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i> ' . lang('delete') . '</a>';
            }

            $optionspets = '<a class="btn btn-info btn-xs btn_width" title="Pets list" href="patient/ownerpatient/' . $owner->id . '" <i class="fa fa-info"> </i> Pets list</a>';


            $image = '<img height="100" width="150" class="img" src="' . $owner->img_url . '">';


            if (empty($owner->img_url)) {
                $image = '';
            }

            $info[] = array(
                $image,
                $owner->name,
                $owner->email,
                $owner->address,
                $owner->phone,
                $owner->nid,
                $options1 . ' ' . $options3 . ' ' . $optionspets,
            );
        }

        if (!empty($data['owners'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->owner_model->getMyOwners($userId)),
                "recordsFiltered" => $i,
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }


    public function joinowner() {
        $owner_id = $this->input->post('joinowner_id');
        //join doctor with owner
        if ($this->ion_auth->in_group(array('Doctor'))) {
            $user = $this->ion_auth->user()->row();
            $u_email = $user->email;
            $userId = $this->db->get_where('doctor', array('email' => $u_email))->row()->id;
            $data1 = array();

            //join doctor to owner
            $ff = $this->db->get_where('doctors_owners', array('doctor_id' => $userId, 'owner_id' => $owner_id))->row()->id;
            if ($ff == null) {
                $data1 = array(
                    'doctor_id' => $userId,
                    'owner_id' => $owner_id,
                );

                $this->owner_model->insertDoctorOwner($data1);
            }
        }
        $this->session->set_flashdata('feedback', lang('added'));

        redirect('owner/myowners');
    }
    
}

/* End of file owner.php */
/* Location: ./application/modules/owner/controllers/owner.php */
