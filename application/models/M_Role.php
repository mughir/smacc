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
		$this->db->order_by("idrole","ASC");
		$datauser=$this->db->get("role")->result();
		return $datauser;
	}
	
	public function get_detail($kode=1)
	{
		$this->load->database();
		$datauser=$this->db
			->where("idrole",$kode)
			->get("role")
			;
		return $datauser->row_array();
	}
	
	public function tambah_role()
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama', 'Nama role', 'trim|required|max_length[40]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			
			$data=array(
				"nrole"=>$this->input->post("nama",true)
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->db->insert("role",$data)){
				$fungsi = $this->input->post("fungsi");
				$lastid = $this->db->insert_id();
				foreach($fungsi as $f){
					$this->db->set("idrole",$lastid)->set("idfungsi",$f)->insert("fungsirole");
				}
				return "berhasil";
			}
			else{
				return "gagal";
			}
		}
	}
	
	public function edit_role($kode)
    {
		//load data			
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'ID', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('nama', 'Nama role', 'trim|required|max_length[40]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			
			$id=$this->input->post("id");
			$data=array(
				"nrole"=>$this->input->post("nama",true)
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->db->where("idrole",$id)->update("role",$data)){
				$fungsi = $this->input->post("fungsi");
				$lastid = $id;
				$this->db->where("idrole",$lastid)->delete("fungsirole");
				foreach($fungsi as $f){
					$this->db->set("idrole",$lastid)->set("idfungsi",$f)->insert("fungsirole");
				}
				return "berhasil";
			}
			else{
				return "gagal";
			}
		}
	}
	
	public function delete_role($kode)
    {
		//load data
		$id=$kode;
		
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("role","idrole",$id)==TRUE){
			if($this->db->where("idrole",$id)->delete("role")){
				return "berhasil";
			}
		else{
				return "gagal";
			}
		}
		else{
			return "gagal";
		}
	}
}
?>