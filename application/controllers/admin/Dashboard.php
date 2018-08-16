<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct()
	{
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');

        $this->load->database();
    }
    
    //LOGIN PAGE
	public function index()
	{
        if(!$this->session->userdata('logged_in'))
        {
            redirect('admin/login', 'refresh');
        }
        else
        {
            $this->load->view('admin/includes/header.php');
            $this->load->view('admin/includes/sidebar.php');
            $this->load->view('admin/dashboard_page.php');
            $this->load->view('admin/includes/footer.php');
        }
    }

}
