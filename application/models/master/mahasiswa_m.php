<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_m extends MY_Model {

	protected $table       = 'mahasiswa'; 
	protected $primary_key = 'id';

	function __construct ()
	{
		parent::__construct();
	}

}
