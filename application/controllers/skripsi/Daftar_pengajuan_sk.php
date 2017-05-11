<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Daftar_pengajuan_sk extends CI_Controller {

	public $menu       = 3;
	public $menu_child = 2;

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('is_login')){
			redirect('login');
		}

		$this->load->model('master/sk_pengajuan_m');
		$this->load->model('master/mahasiswa_m');
		$this->load->model('master/dosen_m');
	}

	public function index()
	{	
		if ($this->session->userdata('user_level') == 5) {
			$data_pengajuan = $this->sk_pengajuan_m->get_data_pengajuan(array(1));
		}
		elseif ($this->session->userdata('user_level') == 4) {
			$data_pengajuan = $this->sk_pengajuan_m->get_data_pengajuan(array(2));
		}
		elseif ($this->session->userdata('user_level') == 2) {
			$data_pengajuan = $this->sk_pengajuan_m->get_data_pengajuan(array(3,4,5,6));
		}
		else {
			$data_pengajuan = array();
		}

		$data = array(
			'menu'           => $this->menu,
			'menu_child'     => $this->menu_child,	
			'header'         => 'Daftar Pengajuan',
			'header_child'   => 'Skripsi STMIK Bandung',
			'view'           => 'sk/daftar_pengajuan', 
			'data_pengajuan' => $data_pengajuan
		);

 		$this->load->view('layout', $data);
	}

	public function proses($id, $is_edit = null)
	{
		$mahasiswa = $this->sk_pengajuan_m->get_data_pengajuan_mhs($id);
		$dosen     = $this->dosen_m->get();
		// die_dump($mahasiswa);
		$data = array(
			'menu'         => $this->menu,
			'menu_child'   => $this->menu_child,	
			'header'       => 'Daftar Pengajuan',
			'header_child' => 'Skripsi STMIK Bandung',
			'view'         => 'sk/proses', 
			'pk'           => $id,
			'data_mhs'     => $mahasiswa,
			'data_dosen'   => $dosen,
			'is_edit'      => $is_edit
		);

 		$this->load->view('layout', $data);
	}

	public function simpan()
	{	
		$array_post = $this->input->post();
		$id         = $array_post['pk'];
		$approved   = $array_post['setuju'];

		if ($approved) {

			switch ($this->session->userdata('user_level')) {
				case 5: $data['status'] = 2; break; // dosen ke baak
				case 4: $data['status'] = 3; break; // baak ke kaprodi
				
				case 2: // kaprodi ke wawancara
					$data['status']            = 4; 
					$data['tanggal_approved']  = date('Y-m-d H:i:s'); 
					$data['tanggal_wawancara'] = date('Y-m-d', strtotime($array_post['tgl_pengajuan'])); 
					break;

				default: $data['status'] = 1; break;
			}

			$data['dosen_id'] = '';
			if ($array_post['dosen']) {
				$data['dosen_id'] = $array_post['dosen'];
				$data['status']   = 5;
			}
			
		} else {
			$data['status'] = 6; // ditolak
		}


		$sk_pengajuan_id = $this->sk_pengajuan_m->update($data, array('id' => $id));
		$this->session->set_flashdata('insert_success', '1');

		redirect('skripsi/daftar_pengajuan_sk');
	}
}

/* End of file Daftar_pengajuan_sk.php */
/* Location: ./application/controllers/Daftar_pengajuan_sk.php */