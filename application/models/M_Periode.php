<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Periode extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;
	
	public function get_periode()
	{
		$this->load->database();
		$this->db->order_by("kperiode","ASC");
		$datauser=$this->db->get("periode")->result();
		return $datauser;
	}	

	public function get_aktif()
	{
		$this->load->database();
		$this->db->where("status","1");
		$this->db->order_by("kperiode","ASC");
		$datauser=$this->db->get("periode")->result();
		return $datauser;
	}
	
	public function get_detail($kode=1)
	{
		$this->load->database();
		$datauser=$this->db->where("kperiode",$kode)->get("periode");
		return $datauser->row_array();
	}
	
	public function tambah_periode()
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('kode', 'Kode Periode', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('nama', 'Nama Periode', 'trim|required|max_length[40]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			
			//load data
			$data=array(
			"kperiode"=>$this->input->post("kode",true),
			"nperiode"=>$this->input->post("nama"),
			"dperiode"=>$this->input->post("dari"),
			"speriode"=>$this->input->post("sampai"),
			"status"=>0
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ganda("periode","kperiode",$data["KODE"])==TRUE){
				if($this->db->insert("periode",$data)){
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
	
	public function edit_periode($kode)
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('kode', 'kode', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('nama', 'Nama coa', 'trim|required|max_length[40]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			
			//load data
			$id=$this->input->post("kode");
			$data=array(
			"nperiode"=>$this->input->post("nama"),
			"dperiode"=>$this->input->post("dari"),
			"speriode"=>$this->input->post("sampai"),
			"status"=>$this->input->post("status")
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ada("periode","kperiode",$id)==TRUE){
				if($this->db->where("kperiode",$id)->update("periode",$data)){
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
	
	public function delete_periode($kode)
    {
		//load data
		$id=$kode;
		
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("periode","kperiode",$id)==TRUE){
			if($this->db->where("kperiode",$id)->delete("periode")){
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