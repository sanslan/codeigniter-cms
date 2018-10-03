<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller {

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
    private function list_files(){
        $config['base_url'] = site_url('admin/page/list');
        $config['total_rows'] = $this->db->get('pages')->num_rows();
        $config['per_page'] = 60;
        $this->pagination->initialize($config);

        $this->load->model("upload_model");
        $limit= $config['per_page'];
        $page_id = $this->uri->segment(4) ? $this->uri->segment(4) : 1;
        $order_by = $this->input->get('order_by') ? $this->input->get('order_by') : "id";
        $order = $this->input->get('order') ? $this->input->get('order') : "DESC";
        $offset =($page_id - 1) * $limit;
        $data['files'] = $this->upload_model->list_files( $limit , $offset, $order_by, $order );
        $data['total_rows']= $config['total_rows'];
        $data['per_page']= $config['per_page'];
        return $data;
    }
    public function files(){
        $data = $this->list_files();
        $this->load->view( 'admin/includes/list_files.php', $data );

    }
    public function select_thumbnail(){
        $data = $this->list_files();
        $this->load->view( 'admin/includes/thumbnail_image.php', $data );
    }

    //List pages
    public function list()
    {

        $config['base_url'] = site_url('admin/page/list');
        $config['total_rows'] = $this->db->get('pages')->num_rows();
        $config['per_page'] = 60;
        $this->pagination->initialize($config);


        $this->load->model("upload_model");
        $limit= $config['per_page'];
        $page_id = $this->uri->segment(4) ? $this->uri->segment(4) : 1;
        $order_by = $this->input->get('order_by') ? $this->input->get('order_by') : "id";
        $order = $this->input->get('order') ? $this->input->get('order') : "DESC";
        $offset =($page_id - 1) * $limit;
        $data['files'] = $this->upload_model->list_files( $limit , $offset, $order_by, $order );
        $data['total_rows']= $config['total_rows'];
        $data['per_page']= $config['per_page'];

        $this->load->view('admin/includes/header.php');
        $this->load->view('admin/includes/sidebar.php');
        $this->load->view('admin/media/list.php',$data);
        $this->load->view('admin/includes/footer.php');
    }
     
    public function delete(){
        $file_id = $this->input->post('file_to_delete');
        $query=$this->db->get_where('files', array( 'id' => $file_id));
        $file = $query->row();
        $file_ext = explode('.',$file->name)[1];
        $length =  (strlen($file->name) - strlen($file_ext) - 1);
        $thumb_file = substr( $file->name, 0, $length ). "_thumb." . $file_ext;
        if(file_exists($file->name)){
            unlink($file->name);
            if(file_exists($thumb_file)){
                unlink($thumb_file);
            }
            $this->db->where('id', $file->id);
            $this->db->delete('files');
        }
        redirect('admin/media/list');
    }
    

  
}
