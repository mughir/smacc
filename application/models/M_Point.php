<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Point extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;
	
	public function get_point()
	{
		$this->load->database();
		$this->db->order_by("idkasir","ASC");
		$datauser=$this->db->get("kasir")->result();
		return $datauser;
	}
	
	public function get_detail($kode=1)
	{
		$this->load->database();
		$datauser=$this->db
			->where("idkasir",$kode)
			->get("kasir")
			;
		return $datauser->row_array();
	}
	
	public function tambah_point()
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama', 'Nama barang', 'trim|required|max_length[40]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			
			$data=array(
			"idkasir"=>$this->input->post("id",true),
			"nmesin"=>$this->input->post("nama",true),
			"ipkasir"=>$this->input->post("ip",true),
			"skasir"=>1
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ganda("kasir","idkasir",$data["idkasir"])==TRUE){
				if($this->db->insert("kasir",$data)){
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
	
	public function edit_point()
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'ID', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('nama', 'Nama barang', 'trim|required|max_length[40]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			
			//load data			
			$id=$this->input->post("id");
			$data=array(
				"nmesin"=>$this->input->post("nama",true),
				"skasir"=>$this->input->post("status",true),
				"ipkasir"=>$this->input->post("ip",true)
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ada("kasir","idkasir",$id)==TRUE){
				if($this->db->where("idkasir",$id)->update("kasir",$data)){
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
	
	public function delete_point($kode)
    {
		//load data
		$id=$kode;
		
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("kasir","idkasir",$id)==TRUE){
			if($this->db->where("idkasir",$id)->delete("kasir")){
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