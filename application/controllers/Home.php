<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public $menu       = 1;
	public $menu_child = 0;

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
			'header_child' => 'Kerja Praktek STMIK Bandung',
			'view'         => 'kp/pengajuan', 
		);

 		$this->load->view('layout', $data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('home');
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */