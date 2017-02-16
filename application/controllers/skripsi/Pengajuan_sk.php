<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengajuan_sk extends CI_Controller {

	public $menu       = 3;
	public $menu_child = 1;

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('is_login')){
			redirect('login');
		}
	}

	public function index()
	{
		$data = array(
			'menu'         => $this->menu,
			'menu_child'   => $this->menu_child,	
			'header'       => 'Pengajuan',
			'header_child' => 'Skripsi STMIK Bandung',
			'view'         => 'sk/pengajuan', 
		);

 		$this->load->view('layout', $data);
	}

	public function tambah()
	{
		$data = array(
			'menu'           => $this->menu,
			'menu_child'     => $this->menu_child,	
			'header'         => 'Pengajuan',
			'header_child'   => 'Tambah Pengajuan Skripsi',
			'view'           => 'sk/tambah', 
		);

 		$this->load->view('layout', $data);
	}

	public function do_upload($type)
	{
		$path = 'upload/'.$this->session->userdata('nim').'_'.$this->session->userdata('user_name');
		create_folder($path);

		switch ($type) {
			case 1:
				$file_name   = 'transkrip_nilai';
				$upload_name = 'fileupload_nilai';
				break;
			case 2:
				$file_name   = 'bukti_transfer';
				$upload_name = 'fileupload_transfer';
				break;
			case 3:
				$file_name   = 'proposal';
				$upload_name = 'fileupload_proposal';
				break;
			default: break;
		}

		$config['upload_path']   = $path;
		$config['file_name']     = $file_name;

		$this->load->library('upload', $config);
        $this->upload->initialize($config);        
        $this->upload->set_allowed_types('*');
		
		if ( ! $this->upload->do_upload($upload_name)){
			$error = array('error' => $this->upload->display_errors());
		}
		else{
			$data = array('upload_data' => $this->upload->data());
			echo json_encode($data);
		}	
	}
}

/* End of file Pengajuan.php */
/* Location: ./application/controllers/Pengajuan.php */