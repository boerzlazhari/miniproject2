<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen_m extends MY_Model {

	protected $table       = 'dosen'; 
	protected $primary_key = 'id';

	function __construct ()
	{
		parent::__construct();
	}

}
