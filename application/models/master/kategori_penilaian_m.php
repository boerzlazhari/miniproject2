<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_penilaian_m extends MY_Model {

	protected $table       = 'kategori_penilaian'; 
	protected $primary_key = 'id';

	function __construct ()
	{
		parent::__construct();
	}
}
