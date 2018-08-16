<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
            $this->load->view('admin/login_page.php');
        }else
        {
            redirect('admin/dashboard', 'refresh');
        }
        
    }
    
    //DASHBOARD PAGE
    public function dashboard()
	{
        if(!$this->session->userdata('logged_in'))
        {
            redirect('admin', 'refresh');
        }
        else
        {
            $this->load->view('admin/includes/header.php');
            $this->load->view('admin/includes/sidebar.php');
            $this->load->view('admin/dashboard_page.php');
            $this->load->view('admin/includes/footer.php');
        }
        
    }

    //CATEGORIES


    //ADD CATEGORY


    //EDIT CATEGORY

    //ADD CATEGORY

    //delete category

    //DELETE CATEGORIES


    //ADD POST
    public function add_post()
    {
        $this->load->view('admin/includes/header.php');
        $this->load->view('admin/includes/sidebar.php');
        $this->load->view('admin/add_post.php');
        $this->load->view('admin/includes/footer.php'); 
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

    private function get_uniq_slug( $table, $field, $slug, $id=null)
    {
        if($id)
        {
            $this->db->where('id !=', $id);
        }
        $query = $this->db->select( $field )->from( $table )->where( $field, $slug )->get();
        $row = $query->row();
        if($row)
        {
            return $slug . "_". mt_rand();
        }
        return $slug;
    }

    private function check_user($username,$password)
    {
        $this->load->model('user');
        if($this->user->login($username,$password))
        {
            return $this->user->login($username,$password);
        }
        return false;
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('admin', 'refresh');
    }
}
