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
}

/* End of file Pengajuan.php */
/* Location: ./application/controllers/Pengajuan.php */