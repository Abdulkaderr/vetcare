<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lostpets extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('lostpets_model');
        $this->load->model('doctor/doctor_model');
        $this->load->model('department/department_model');
        $this->load->model('patient/patient_model');
        $this->load->model('slide/slide_model');
        $this->load->model('owner/owner_model');
        $this->load->model('service/service_model');
        $this->load->model('email/email_model');
        $this->load->model('featured/featured_model');
        $this->load->model('review/review_model');
        $this->load->model('gallery/gallery_model');
        $this->load->model('gridsection/gridsection_model');
        require APPPATH . 'third_party/stripe/stripe-php/init.php';
        $this->load->model('appointment/appointment_model');
        $this->load->model('finance/finance_model');
        $this->load->model('pgateway/pgateway_model');
        $this->load->model('doctor/doctorvisit_model');
        $this->load->model('schedule/schedule_model');
        $this->load->model('missingpet/missingpet_model');
        $this->load->model('matingpet/matingpet_model');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
    }

    public function index()
    {
        $data = array();
        if ($this->ion_auth->in_group(array('Doctor', 'admin'))) {
            $data['lostpets'] = $this->lostpets_model->getlostpets();
        }
        if ($this->ion_auth->in_group(array('Owner'))) {
            $user_id = $this->ion_auth->user()->row()->id;
            $data['lostpets'] = $this->lostpets_model->getownerlostpets($user_id);
        }

        if ($this->ion_auth->in_group(array('Doctor'))) {
            $user_id = $this->ion_auth->user()->row()->id;
            $data['lostpets'] = $this->lostpets_model->getdoctorlostpets($user_id);
        }
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('lostpets', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function delete()
    {
        $data = array();
        $id = $this->input->get('id');
        $this->lostpets_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('lostpets');
    }

    function approve()
    {
        $data = array();
        $id = $this->input->get('id');
        $data = array('approved' => 1);
        $this->lostpets_model->approve($id,$data);
        $this->session->set_flashdata('feedback', 'Approved');
        redirect('lostpets');
    }

    function disapprove()
    {
        $data = array();
        $id = $this->input->get('id');
        $data = array('approved' => 0);
        $this->lostpets_model->disapprove($id,$data);
        $this->session->set_flashdata('feedback', 'Disapproved');
        redirect('lostpets');
    }

    public function foundpets(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        $data = array();
        $data['foundpets'] = $this->frontend_model->getfoundpets();
        $this->load->view('frontend_header', $data);
        $this->load->view('frontend_foundpets', $data);
        $this->load->view('frontend_footer', $data);
    }

    public function addfoundpets(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        $data = array();
        $data['foundpets'] = $this->frontend_model->getfoundpets();
        $this->load->view('frontend_header', $data);
        $this->load->view('frontend_addfoundpets', $data);
        $this->load->view('frontend_footer', $data);
    }

    public function postaddfoundpet(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        $pet_num = $this->input->post('pet_num');
        $pet_name = $this->input->post('pet_name');
        $pet_strain = $this->input->post('pet_strain');
        $pet_gender = $this->input->post('pet_gender');
        $found_date = $this->input->post('found_date');
        $found_location = $this->input->post('found_location');
        $comments = $this->input->post('comments');

        $data = array();

        $data = array(
            'pet_num' => $pet_num,
            'pet_name' => $pet_name,
            'pet_strain' => $pet_strain,
            'pet_gender' => $pet_gender,
            'found_date' => $found_date,
            'found_location' => $found_location,
            'comments' => $comments
        );

        $this->frontend_model->insertfoundpets($data);
        $this->session->set_flashdata('success', 'Added successfully, wait until ADMIN approve it');
        redirect('frontend/foundpets');
    }


    public function lostpets(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        $data = array();
        $data['lostpets'] = $this->frontend_model->getlostpets();
        $this->load->view('frontend_header', $data);
        $this->load->view('frontend_lostpets', $data);
        $this->load->view('frontend_footer', $data);
    }

    public function addlostpets(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        $data = array();
        $data['lostpets'] = $this->frontend_model->getlostpets();
        $this->load->view('frontend_header', $data);
        $this->load->view('frontend_addlostpets', $data);
        $this->load->view('frontend_footer', $data);
    }

    public function postaddlostpet(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        $pet_num = $this->input->post('pet_num');
        $pet_name = $this->input->post('pet_name');
        $pet_strain = $this->input->post('pet_strain');
        $pet_gender = $this->input->post('pet_gender');
        $lost_date = $this->input->post('lost_date');
        $lost_location = $this->input->post('lost_location');
        $comments = $this->input->post('comments');

        $data = array();

        $data = array(
            'pet_num' => $pet_num,
            'pet_name' => $pet_name,
            'pet_strain' => $pet_strain,
            'pet_gender' => $pet_gender,
            'lost_date' => $lost_date,
            'lost_location' => $lost_location,
            'comments' => $comments
        );

        $this->frontend_model->insertlostpets($data);
        $this->session->set_flashdata('success', 'Added successfully, wait until ADMIN approve it');
        redirect('frontend/lostpets');
    }
}

/* End of file appointment.php */
    /* Location: ./application/modules/appointment/controllers/appointment.php */
