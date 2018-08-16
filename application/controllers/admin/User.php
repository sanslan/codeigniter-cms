<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct()
	{
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper(array('url'));

        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login', 'refresh');
        }

        $this->load->database();
    }

    public function list()
	{
        $config['base_url'] = site_url('admin/user/list');
        $config['total_rows'] = $this->db->get('categories')->num_rows();
        $config['per_page'] = 10;
        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);

        $this->load->model("user_model");
        $limit= $config['per_page'];
        $page_id = $this->uri->segment(4) ? $this->uri->segment(4) : 1;
        $offset =($page_id - 1) * $limit;
        $order_by = $this->input->get('order_by') ? $this->input->get('order_by') : "id";
        $order = $this->input->get('order') ? $this->input->get('order') : "DESC";
        $data['total_rows']= $config['total_rows'];
        $data['per_page']= $config['per_page'];
        $data['users'] = $this->user_model->list_users( $limit, $offset,$order_by, $order );
        $data['all_categories'] = $this->category_model->all_categories();

        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/category/list_and_add',$data);
        $this->load->view('admin/includes/footer'); 
        
    }


    

}
