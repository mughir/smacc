<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_akun extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;
	
	public function get_akun()
	{
		$this->load->database();
		$this->db->order_by("noakun","ASC");
		$datauser=$this->db->get("coa")->result();
		return $datauser;
	}
	
	public function get_detail($kode=1)
	{
		$this->load->database();
		$datauser=$this->db->where("noakun",$kode)->get("coa");
		return $datauser->row_array();
	}
	
	public function tambah_akun()
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'ID', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('nama', 'Nama akun', 'trim|required|max_length[40]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			$katakun=$this->input->post("kategori");
			if($katakun == ""){
				$katakun=NULL;
			}

			//load data
			$data=array(
			"noakun"=>$this->input->post("id",true),
			"nakun"=>$this->input->post("nama"),
			"lakun"=>$this->input->post("level"),
			"posakun"=>$this->input->post("posisi"),
			"katakun"=>$katakun
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ganda("coa","noakun",$data["noakun"])==TRUE){
				if($this->db->insert("coa",$data)){
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
	
	public function edit_akun($kode)
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'ID', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('nama', 'Nama akun', 'trim|required|max_length[40]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			$katakun=$this->input->post("kategori");
			if($katakun == ""){
				$katakun=NULL;
			}

			//load data
			$id=$this->input->post("id");
			$data=array(
			"nakun"=>$this->input->post("nama"),
			"lakun"=>$this->input->post("level"),
			"posakun"=>$this->input->post("posisi"),
			"katakun"=>$katakun
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ada("coa","noakun",$id)==TRUE){
				if($this->db->where("noakun",$id)->update("coa",$data)){
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
	
	public function delete_akun($kode)
    {
		//load data
		$id=$kode;
		
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("coa","noakun",$id)==TRUE){
			if($this->db->where("noakun",$id)->delete("coa")){
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