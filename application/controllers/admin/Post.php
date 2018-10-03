<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

    function __construct()
	{
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper(array('url','crud_helper'));

        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin', 'refresh');
        }

        $this->load->database();
    }

    //List pages
    public function list()
    {
        $config['base_url'] = site_url('admin/post/list');
        $config['total_rows'] = $this->db->get('posts')->num_rows();
        $config['per_page'] = 10;
        $this->pagination->initialize($config);

        $this->load->model("post_model");
        $limit= $config['per_page'];
        $page_id = $this->uri->segment(4) ? $this->uri->segment(4) : 1;
        $offset =($page_id - 1) * $limit;
        $data['posts'] = $this->post_model->list_posts( $limit , $offset );
        $data['total_rows']= $config['total_rows'];
        $data['per_page']= $config['per_page'];
        
        $this->load->view('admin/includes/header.php');
        $this->load->view('admin/includes/sidebar.php');
        $this->load->view('admin/post/list.php',$data);
        $this->load->view('admin/includes/footer.php');
    }
    public function add()
    {
        $this->form_validation->set_rules('title', 'Title', 'required|min_length[3]');
        $this->form_validation->set_rules('body', 'Body', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('thumbnail', '', 'callback_file_check');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->model('category_model');
            $data['categories'] = $this->category_model->all_categories();

            $this->load->view('admin/includes/header.php');
            $this->load->view('admin/includes/sidebar.php');
            $this->load->view('admin/post/add.php',$data);
            $this->load->view('admin/includes/footer.php');
        }
        else
        {
            $title = $this->input->post("title");
            $body = $this->input->post("body");
            $publish_date = $this->input->post('publish_date');
            $categories = $this->input->post("categories");
            $thumbnail= $this->input->post("thumbnail");

            $this->insertPost( $title, $body, $categories, $publish_date, $thumbnail );
        }
    }

    public function file_check($str)
    {
        return true;
        // $this->load->helper('file');
        
        // $allowed_mime_type_arr = array('image/jpeg','image/pjpeg','image/png','image/x-png');
        // $mime = get_mime_by_extension($_FILES['thumbnail']['name']);
        // if(isset($_FILES['thumbnail']['name']) && $_FILES['thumbnail']['name']!=""){
        //     if(in_array($mime, $allowed_mime_type_arr)){
        //         if($_FILES['thumbnail']['size'] > 1048576 || $_FILES['thumbnail']['size'] == 0){
        //             $this->form_validation->set_message('file_check', 'File should not be bigger than 1 mb.');
        //             return false;
        //         }
        //         return true;
        //     }else{
        //         $this->form_validation->set_message('file_check', 'Please select only jpg or png file.');
        //         return false;
        //     }
        // }else{
        //     $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
        //     return false;
        // }
    }



    private function insertPost( $title, $body, $categories, $publish_date, $thumbnail=NULL ){

        if($categories == NULL){
            $categories= "";
        }else{
            $categories = implode(",",$categories);
        }
        $this->load->model('post_model');
        $this->post_model->insertPost( $title, $body, $categories, $publish_date, $thumbnail );
        redirect($this->uri->uri_string());

    }


    //EDIT PAGE
    public function edit($slug)
    {
        $this->form_validation->set_rules('title', 'Title', 'required|min_length[3]'
        );
        $this->form_validation->set_rules('body', 'Body', 'required');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger mt-2">', '</div>');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->model('page_model');
            $page = $this->page_model->get_page($slug);
            $data['page'] = $page;
            $this->load->view('admin/includes/header');
            $this->load->view('admin/includes/sidebar');
            $this->load->view('admin/page/edit',$data);
            $this->load->view('admin/includes/footer');
        }
        else
        {
            $this->load->model('page_model');
            $page = $this->page_model->get_page($slug);
            $title = $this->input->post("title");
            $body = $this->input->post("body");
            $newslug= $this->get_uniq_slug( 'pages', 'slug', url_title($title), $page->id );

            $this->page_model->edit_page( $title, $newslug, $body, $slug );
            $this->session->set_flashdata('success', 'Page updated');

            redirect("admin/page/list");
        }
    }

    //DELETE PAGE
    public function delete( $id, $post_id )
    {
        $this->db->where('id', $id);
        $this->db->delete('posts');

        redirect("admin/post/list/".$post_id);
        
    }

    public function bulk_delete()
    {
        $posts=$this->input->post('posts');
        if(!empty($posts))
        {
            foreach($posts as $post_id){
                $this->db->where('id', $post_id);
                $this->db->delete('posts');
            }
            
            redirect("admin/post/list");
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

  
}
