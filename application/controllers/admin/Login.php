<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct()
	{
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper(array('url'));

        $this->load->database();
    }

    public function index()
	{
        if(!$this->session->userdata('logged_in'))
        {
            $this->load->view('admin/login_page.php');
        }else
        {
            redirect('admin/dashboard', 'refresh');
        }
        
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if($this->check_user($username,$password))
        {
            $user = $this->check_user($username,$password);
            $userdata = array(
                'id'  => $user->id,
                'email' => $user->email,
                'fullname'     => $user->fullname,
                'logged_in' => TRUE
            );
        
            $this->session->set_userdata($userdata);
            redirect('admin/dashboard', 'refresh');
        }
        else
        {
            redirect('admin', 'refresh');
        }

    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('admin/login', 'refresh');
    }

    private function check_user($username,$password)
    {
        $this->load->model('user_model');
        if($this->user_model->login($username,$password))
        {
            return $this->user_model->login($username,$password);
        }
        return false;
    }
    

}
