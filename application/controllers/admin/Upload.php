<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

    protected $destination;
    protected $messages = array();
    protected $maxSize = 512000;
    protected $permittedTypes = array(
            'image/jpeg',
            'image/pjpeg',
            'image/gif',
            'image/png',
            'image/webp'
    );
    protected $newName;
    protected $typeCheckingOn = true;
    protected $notTrusted = array('bin', 'cgi', 'exe', 'js', 'pl', 'php', 'py', 'sh');
    protected $suffix = '.upload';
    protected $renameDuplicates;

	protected function directory()
	{
		$upload_folder='file-uploads';
		if(!is_dir($upload_folder)){
			mkdir($upload_folder);
		}
		$year = date('Y');
		$month = date('m');
		if(!is_dir($upload_folder.'/'.$year.'/'.$month)){
			mkdir($upload_folder.'/'.$year.'/'.$month,0777,true);
		}
		return $upload_folder.'/'.$year.'/'.$month.'/';

	}
    function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->destination=$this->directory();
		$this->load->model('upload_model');

        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin', 'refresh');
        }

        $this->load->database();
    }

    //List pages
    public function index()
    {
        $this->load->view('admin/includes/header.php');
        $this->load->view('admin/includes/sidebar.php');
        $this->load->view('admin/media/list.php',$data);
        $this->load->view('admin/includes/footer.php');
    }
    public function upload()
    {
        $this->renameDuplicates = true;
		$uploaded = current($_FILES);
        if (is_array($uploaded['name']))
        {
			foreach ($uploaded['name'] as $key => $value) {
				$currentFile['name'] = $uploaded['name'][$key];
				$currentFile['type'] = $uploaded['type'][$key];
				$currentFile['tmp_name'] = $uploaded['tmp_name'][$key];
				$currentFile['error'] = $uploaded['error'][$key];
				$currentFile['size'] = $uploaded['size'][$key];
				if ($this->checkFile($currentFile)) {
                    $this->moveFile($currentFile);
				}
			}
        } else 
        {
			if ($this->checkFile($uploaded)) {
				$this->moveFile($uploaded);
			}
		}
		$this->session->set_flashdata('msg',$this->messages);
		redirect('admin/media/list');

	}
	


    protected function checkFile($file)
	{
		if ($file['error'] != 0) {
			$this->getErrorMessage($file);
			return false;
		}
		if (!$this->checkSize($file)) {
			return false;
		}
		if ($this->typeCheckingOn) {
		    if (!$this->checkType($file)) {
			    return false;
			}
		}
		$this->checkName($file);
		return true;
	}
	protected function checkType($file) 
	{
		if (in_array($file['type'], $this->permittedTypes)) {
			return true;
		} else {
			$this->messages[] ='<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'. $file['name'] . ' is not permitted type of file.'. '</div>';
			return false;
		}
	}
	protected function checkSize($file)
	{
		if ($file['size'] == 0) {
			$this->messages[] = $file['name'] . ' is empty.';
			return false;
		} elseif ($file['size'] > $this->maxSize) {
			$this->messages[] ='<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'. $file['name'] . ' exceeds the maximum size for a file ('
					. self::convertFromBytes($this->maxSize) . ').'. '</div>';
			return false;
		} else {
			return true;
		}
	}
	protected function getErrorMessage($file)
	{
		switch($file['error']) {
			case 1:
			case 2:
				$this->messages[] =
				'<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.
				$file['name'] . ' is too big: (max: ' . self::convertFromBytes($this->maxSize) . ').' . '</div>';
				break;
			case 3:
				$this->messages[] = 
									'<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.
									$file['name'] . ' was only partially uploaded.' .'</div>';
				break;
			case 4:
				$this->messages[] ='<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'. 'No file submitted.'. '</div>';
				break;
			default:
				$this->messages[] ='<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'. 'Sorry, there was a problem uploading ' . $file['name']. '</div>';
				break;
		}
	}
    
    protected function moveFile($file)
	{
		$filename = isset($this->newName) ? $this->newName : $file['name'];
		$success = move_uploaded_file($file['tmp_name'], $this->destination . $filename);
		if ($success) {
			$this->upload_model->save_filename($this->destination . $filename);

			$config['image_library'] = 'gd2';
			$config['source_image'] = $this->destination . $filename;
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width']         = 75;
			$config['height']       = 50;

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			unset($this->image_lib);
			$result ='<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'. $file['name'] . ' was uploaded successfully';
			if (!is_null($this->newName)) {
				$result .= ', and was renamed ' . $this->newName;
			}
			$result .= '.</div>';
			$this->messages[] = $result;
		} else {
			$this->messages[] ='<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'. 'Could not upload ' . $file['name']. '</div>';
		}
    }
    
    protected function checkName($file)
	{
		$this->newName = null;
		$nospaces = str_replace(' ', '_', $file['name']);
		if ($nospaces != $file['name']) {
			$this->newName = $nospaces;
		}
		$nameparts = pathinfo($nospaces);
		$extension = isset($nameparts['extension']) ? $nameparts['extension'] : '';
		if (!$this->typeCheckingOn && !empty($this->suffix)) {
			if (in_array($extension, $this->notTrusted) || empty($extension)) {
				$this->newName = $nospaces . $this->suffix;
			}
		}
		if ($this->renameDuplicates) {
			$name = isset($this->newName) ? $this->newName : $file['name'];
			$existing = scandir($this->destination);
			if (in_array($name, $existing)) {
				$i = 1;
				do {
					$this->newName = $nameparts['filename'] . '_' . $i++;
					if (!empty($extension)) {
						$this->newName .= ".$extension";
					}
					if (in_array($extension, $this->notTrusted)) {
						$this->newName .= $this->suffix;
					}
				} while (in_array($this->newName, $existing));
			}
		}
	}

	public static function convertToBytes($val)
	{
		$val = trim($val);
		$last = strtolower($val[strlen($val)-1]);
		if (in_array($last, array('g', 'm', 'k'))){
                    // Explicit cast to number
                    $val = (float) $val;
			switch ($last) {
				case 'g':
					$val *= 1024;
				case 'm':
					$val *= 1024;
				case 'k':
					$val *= 1024;
			}
		}
		return $val;
	}
	
	public static function convertFromBytes($bytes)
	{
		$bytes /= 1024;
		if ($bytes > 1024) {
			return number_format($bytes/1024, 1) . ' MB';
		} else {
			return number_format($bytes, 1) . ' KB';
		}
	}
    


}