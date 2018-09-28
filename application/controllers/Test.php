<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    function __construct()
	{
        parent::__construct();
    }

    public function index(){
        $myconfig = $this->config->load('upload');
        $this->load->view('test');
        print_r($myconfig);
    }

    public function do_upload()
    {

            $myconfig = $this->config->load('upload', true);
            $this->load->library('upload', $this->config->config);

            if ( ! $this->upload->do_upload('userfile'))
            {
                    $error = array('error' => $this->upload->display_errors());

                    var_dump($error);
            }
            else
            {
                    $data = array('upload_data' => $this->upload->data());
                    var_dump($data);
            }
    }
}