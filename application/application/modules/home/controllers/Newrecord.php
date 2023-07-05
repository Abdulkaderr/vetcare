<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Newrecord extends MX_Controller {

    function __construct() {
        parent::__construct();
        
    }

    public function index() {
        $this->load->view('dashboard'); // just the header file
        $this->load->view('newrecord');
        $this->load->view('footer');
    }
}