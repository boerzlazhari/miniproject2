<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prodi extends CI_Controller {

	public $menu       = 4;
	public $menu_child = 1;

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('is_login')){
			redirect('login');
		}

		$this->load->model('master/prodi_m');
	}

	public function index()
	{
		$data = array(
			'menu'         => $this->menu,
			'menu_child'   => $this->menu_child,	
			'header'       => 'Program Studi',
			'header_child' => 'STMIK Bandung',
			'view'         => 'master/prodi', 
		);

 		$this->load->view('layout', $data);
	}

}

/* End of file Prodi.php */
/* Location: ./application/controllers/Prodi.php */