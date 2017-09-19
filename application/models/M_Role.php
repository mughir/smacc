<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Role extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;
	
	public function get_role()
	{
		$this->load->database();
		$data= $this->db->get("role")->result();
		return $data;
	}
}
?>