<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Foundpets extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('foundpets_model');
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
            $data['foundpets'] = $this->foundpets_model->getfoundpets();
        }
        if ($this->ion_auth->in_group(array('Owner'))) {
            $user_id = $this->ion_auth->user()->row()->id;
            $data['foundpets'] = $this->foundpets_model->getownerfoundpets($user_id);
        }

        if ($this->ion_auth->in_group(array('Doctor'))) {
            $user_id = $this->ion_auth->user()->row()->id;
            $data['foundpets'] = $this->foundpets_model->getdoctorfoundpets($user_id);
        }
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('foundpets', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function delete()
    {
        $data = array();
        $id = $this->input->get('id');
        $this->foundpets_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('foundpets');
    }

    function approve()
    {
        $data = array();
        $id = $this->input->get('id');
        $data = array('approved' => 1);
        $this->foundpets_model->approve($id,$data);
        $this->session->set_flashdata('feedback', 'Approved');
        redirect('foundpets');
    }

    function disapprove()
    {
        $data = array();
        $id = $this->input->get('id');
        $data = array('approved' => 0);
        $this->foundpets_model->disapprove($id,$data);
        $this->session->set_flashdata('feedback', 'Disapproved');
        redirect('foundpets');
    }

    
}

/* End of file appointment.php */
    /* Location: ./application/modules/appointment/controllers/appointment.php */
