<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		if (!$this->session->userdata('is_login')) {
	 		$this->load->view('login');

	 		// $this->session->set_flashdata('a', 'b');
	 		// die_dump($this->session);
		} 
		else {
	 		redirect('home');
		}
	}

	public function validasi() {

		$this->load->model('user_m');
		$this->load->model('master/mahasiswa_m');
		$this->load->model('master/dosen_m');

		$username = $this->input->post('username');	
		$password = $this->input->post('password');	

		$result = $this->user_m->login($username, $password);

		if (!empty($result)) {
			
			$set_session = array(
				'id'         => $result->id,
				'user_name'  => $result->name,
				'user_level' => $result->user_level_id,
				'is_login'   => TRUE
			);

			// jika mahasiswa
			if ($result->user_level_id == 3) {
				
				$data_user = $this->mahasiswa_m->get($result->user_id);
				
				$set_session['user_id'] = $data_user->id;
				$set_session['nim']     = $data_user->nim;
				$set_session['sks']     = $data_user->sks;
			}

			// jika dosen
			if ($result->user_level_id == 2) {
				
				$data_user = $this->dosen_m->get($result->user_id);
				
				$set_session['user_id'] = $data_user->id;
				$set_session['nid']     = $data_user->nid;
			}

			$this->session->set_userdata($set_session);
		} 
		else {
	 		$this->session->set_flashdata('error', 'Username dan Password Salah!');
	 		$this->session->set_flashdata('username', $username);
		}

		redirect('login');
	}
}
