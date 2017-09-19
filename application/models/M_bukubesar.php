<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_bukubesar extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;
	
	public function get_bukubesar()
	{
		$this->load->database();
		$akun=$this->input->post("akun");
		$dari=$this->input->post("dari");
		$sampai=$this->input->post("sampai");

		$data=$this->db
			->where("tjurnal <=",$sampai)
			->where("tjurnal >=",$dari)
			->where("noakun",$akun)
			->from("jurnal j")
			->join("djurnal d","d.kjurnal=j.kjurnal")
			->get()
			->result();

		return $data;
	}
	
}
?>