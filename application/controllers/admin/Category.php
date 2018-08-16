<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    function __construct()
	{
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('url','crud_helper'));

        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login', 'refresh');
        }

        $this->load->library('form_validation');
        $this->load->database();
    }
    
    //LOGIN PAGE
	public function list()
	{
        $config['base_url'] = site_url('admin/category/list');
        $config['total_rows'] = $this->db->get('categories')->num_rows();
        $config['per_page'] = 10;
        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);

        $this->load->model("category_model");
        $limit= $config['per_page'];
        $page_id = $this->uri->segment(4) ? $this->uri->segment(4) : 1;
        $offset =($page_id - 1) * $limit;
        $order_by = $this->input->get('order_by') ? $this->input->get('order_by') : "id";
        $order = $this->input->get('order') ? $this->input->get('order') : "DESC";
        $data['total_rows']= $config['total_rows'];
        $data['per_page']= $config['per_page'];
        $data['categories'] = $this->category_model->list_categories( $limit, $offset,$order_by, $order );
        $data['all_categories'] = $this->category_model->all_categories();

        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/category/list_and_add',$data);
        $this->load->view('admin/includes/footer'); 
    }
  
    public function add()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|is_unique[categories.name]');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() === FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/category/list');
        }
        else
        {
            $name = $this->input->post( "name" );
            $parent = $this->input->post( "parent" );
            $slug = url_title( $name );
            $this->load->model( "category_model" );
            $this->category_model->save_category( $name, $slug, $parent );
            $this->session->set_flashdata('success', 'New category added');
            redirect("admin/category/list");
        }

    }

    public function edit($slug)
    {
        $this->load->model("category_model");
        $data['all_categories'] = $this->category_model->all_categories($slug);
        $data['cur_category'] = $this->category_model->cur_category($slug);

        $this->load->view('admin/includes/header.php');
        $this->load->view('admin/includes/sidebar.php');
        $this->load->view('admin/category/edit',$data);
        $this->load->view('admin/includes/footer.php'); 
    }

    public function update()
    {
        $this->load->model("category_model");
        $cur_slug = $this->input->post('slug');
        $cur_name = $this->category_model->get_category_name($cur_slug);
        if($this->input->post('name') != $cur_name) {
            $is_unique =  '|is_unique[categories.name]';
            } else {
            $is_unique =  '';
            }
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]'.$is_unique);

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger mt-2">', '</div>');

        if ($this->form_validation->run() === FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/category/edit/'.$cur_slug);
        }
        else
        {
            $name = $this->input->post( "name" );
            $parent = $this->input->post( "parent" );
            $slug = url_title( $name );
            $this->category_model->update_category( $name, $slug, $parent, $cur_slug );
            $this->session->set_flashdata('success', 'Category updated');
            redirect("admin/category/list");
        }

    }

    public function delete( $id, $to_page)
    {
        $this->load->model("category_model");
        $this->category_model->delete_category($id);
        redirect('admin/category/list/'.$to_page);
    }

    public function bulk_delete()
    {
        $categories = $this->input->post('categories');
        foreach($categories as $category)
        {
            $this->db->where('id', $category);
            $this->db->delete('categories');
        }
    }

}
