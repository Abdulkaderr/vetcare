<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Missingpet extends MX_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('missingpet_model');
        $this->load->model('owner/owner_model');
        $this->load->model('patient/patient_model');

        if (!$this->ion_auth->in_group(array('admin', 'Nurse', 'Laboratorist', 'Doctor', 'Patient', 'Owner'))) {
            redirect('home/permission');
        }
    }

    public function index()
    {
        if ($this->ion_auth->in_group(array('Owner'))) {
            $owner_ion_id = $this->ion_auth->get_user_id();
            $owner_id = $this->db->get_where('owner', array('ion_user_id' => $owner_ion_id))->row()->id;
            $data['patients'] = $this->patient_model->getPatientByOwnerId($owner_id);
        } else {
            $data['patients'] = $this->patient_model->getPatient();
            $data['owners'] = $this->owner_model->getOwner();
        }
        // $data['patients'] = $this->patient_model->getPatient();
        // $data['owners'] = $this->owner_model->getOwner();
        // $data['missingpets'] = $this->missingpet_model->getMissingpet();
        $this->load->view('home/dashboard');
        $this->load->view('missingpet', $data);
        $this->load->view('home/footer');
    }

    public function addNewView()
    {
        if ($this->ion_auth->in_group('Patient')) {
            redirect('home/permission');
        }
        $data = array();
        if ($this->ion_auth->in_group(array('Owner'))) {
            $owner_ion_id = $this->ion_auth->get_user_id();
            $owner_id = $this->db->get_where('owner', array('ion_user_id' => $owner_ion_id))->row()->id;
            $data['patients'] = $this->patient_model->getPatientByOwnerId($owner_id);
        } else {
            $data['patients'] = $this->patient_model->getPatient();
            $data['owners'] = $this->owner_model->getOwner();
        }
        $this->load->view('home/dashboard');
        $this->load->view('add_new', $data);
        $this->load->view('home/footer');
    }

    public function addMissingpet()
    {
        if ($this->ion_auth->in_group('Patient')) {
            redirect('home/permission');
        }
        $id = $this->input->post('id');
        $patient = $this->input->post('patient');
        $owner = $this->input->post('owner');
        $phone = $this->input->post('phone');
        $type = $this->input->post('type');
        $description = $this->input->post('description');
        if ((empty($id))) {
            $add_date = date('m/d/y');
        } else {
            $add_date = $this->db->get_where('missingpet', array('id' => $id))->row()->add_date;
        }
        $date = time();
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Pet Field
        $this->form_validation->set_rules('patient', 'Pet', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Owner Field
        $this->form_validation->set_rules('owner', 'Owner', 'trim|required|min_length[1]|max_length[500]|xss_clean');
        // Validating Phone Field
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[2]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();
                $data['patients'] = $this->patient_model->getPatient();
                $data['owners'] = $this->owner_model->getOwner();
                $data['missingpet'] = $this->missingpet_model->getMissingpetById($id);
                $this->load->view('home/dashboard');
                $this->load->view('add_new', $data);
                $this->load->view('home/footer');
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $data['patients'] = $this->patient_model->getPatient();
                $data['owners'] = $this->owner_model->getOwner();
                $this->load->view('home/dashboard');
                $this->load->view('add_new', $data);
                $this->load->view('home/footer');
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
                'max_size' => "10000000",
                'max_height' => "10000",
                'max_width' => "10000"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'img_url' => $img_url,
                    'patient' => $patient,
                    'owner' => $owner,
                    'phone' => $phone,
                    'description' => $description,
                    'pet_type' => $type,
                    'add_date' => $add_date,
                );
            } else {
                $data = array(
                    'patient' => $patient,
                    'owner' => $owner,
                    'phone' => $phone,
                    'description' => $description,
                    'pet_type' => $type,
                    'add_date' => $add_date,
                );
            }
            if (empty($id)) {
                $this->missingpet_model->insertMissingpet($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->missingpet_model->updateMissingpet($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('missingpet');
        }
    }

    function editMissingpet()
    {
        $data = array();

        $id = $this->input->get('id');
        $data['groups'] = $this->donor_model->getBloodBank();
        $data['missingpet'] = $this->missingpet_model->getMissingpetById($id);
        $this->load->view('home/dashboard');
        $this->load->view('add_new', $data);
        $this->load->view('home/footer');
    }

    function editMissingpetByJason()
    {
        $id = $this->input->get('id');
        $data['missingpet'] = $this->missingpet_model->getMissingpetById($id);
        $data['patient'] = $this->patient_model->getPatientById($data['missingpet']->patient);
        $data['owner'] = $this->owner_model->getOwnerById($data['missingpet']->owner);
        echo json_encode($data);
    }

    // function delete()
    // {
    //     $id = $this->input->get('id');
    //     $this->missingpet_model->deleteMissingpet($id);
    //     $this->session->set_flashdata('feedback', lang('deleted'));
    //     redirect('missingpet');
    // }

    function delete()
    {
        if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
            $id = $this->input->get('id');



            $this->missingpet_model->deleteMissingpet($id);
            $this->missingpet_model->deleteDepositByMissingpetId($id);
            $this->session->set_flashdata('feedback', lang('deleted'));
            redirect('missingpet');
        }
    }

    function getMissingpetList()
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
                $data['missingpets'] = $this->missingpet_model->getMissingpetBySearch($search, $order, $dir);
            } else {
                $data['missingpets'] = $this->missingpet_model->getMissingpetWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['missingpets'] = $this->missingpet_model->getMissingpetByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['missingpets'] = $this->missingpet_model->getMissingpetByLimit($limit, $start, $order, $dir);
            }
        }

        $i = 0;
        foreach ($data['missingpets'] as $missingpet) {

           
            $option1 = '<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="' . $missingpet->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</button>';
            $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="missingpet/delete?id=' . $missingpet->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i> ' . lang('delete') . '</a>';
            if ($this->ion_auth->in_group(array('Owner'))) {
                $owner_ion_id = $this->ion_auth->get_user_id();
                $owner_id = $this->db->get_where('owner', array('ion_user_id' => $owner_ion_id))->row()->id;
                if ($missingpet->owner == $owner_id) {
                    $info[] = array(
                        '<img height="100" src="' . $missingpet->img_url . '">',
                        $this->patient_model->getPatientById($missingpet->patient)->name,
                        $missingpet->pet_type,
                        $this->owner_model->getOwnerById($missingpet->owner)->name,
                        $missingpet->phone,
                        $missingpet->description,
                        $option1 . ' ' . $option2
                        //  $options2
                    );
                    $i = $i + 1;
                }
            } else {
                $info[] = array(
                    '<img height="100" src="' . $missingpet->img_url . '">',
                    $this->patient_model->getPatientById($missingpet->patient)->name,
                    $missingpet->pet_type,
                    $this->owner_model->getOwnerById($missingpet->owner)->name,
                    $missingpet->phone,
                    $missingpet->description,
                    $option1 . ' ' . $option2
                    //  $options2
                );
                $i = $i + 1;
            }
        }

        if (!empty($info)) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $i,
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

    public function addNew()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $owner = $this->input->post('owner');
        $pet_type = $this->input->post('pet_type');
        $phone = $this->input->post('phone');
        $description = $this->input->post('description');

        if ((empty($id))) {
            $add_date = date('m/d/y');
        } else {
            $add_date = $this->db->get_where('missingpet', array('id' => $id))->row()->add_date;
        }




        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[2]|max_length[50]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();

                $data['missingpet'] = $this->missingpet_model->getMissingpetById($id);
                $data['owners'] = $this->owner_model->getOwner();
                $this->load->view('home/dashboard');
                $this->load->view('add_new', $data);
                $this->load->view('home/footer');
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $data['owners'] = $this->owner_model->getOwner();
                $this->load->view('home/dashboard');
                $this->load->view('add_new', $data);
                $this->load->view('home/footer');
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
                'max_size' => "10000000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "10000",
                'max_width' => "10000"
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
                    'owner' => $owner,
                    'pet_type' => $pet_type,
                    'phone' => $phone,
                    'description' => $description,
                    'add_date' => $add_date,

                );
            } else {

                $data = array();
                $data = array(
                    'name' => $name,
                    'owner' => $owner,
                    'pet_type' => $pet_type,
                    'phone' => $phone,
                    'description' => $description,
                    'add_date' => $add_date,
                );
            }



            if (empty($id)) {     // Adding New Patient
                $this->missingpet_model->insertMissingpet($data);

                $this->session->set_flashdata('feedback', lang('added'));
            } else {

                $this->missingpet_model->updateMissingpet($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }


            redirect('missingpet');
        }
    }
}

/* End of file accountant.php */
/* Location: ./application/modules/accountant/controllers/accountant.php */
