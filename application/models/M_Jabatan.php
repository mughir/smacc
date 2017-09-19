<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_jabatan extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;
	
	public function get_jabatan()
	{
		$this->load->database();
		$this->db->order_by("idjabatan","ASC");
		$datauser=$this->db->get("jabatan")->result();
		return $datauser;
	}
	
	public function get_detail($kode=1)
	{
		$this->load->database();
		$datauser=$this->db
			->where("idjabatan",$kode)
			->get("jabatan")
			;
		return $datauser->row_array();
	}
	
	public function tambah_jabatan()
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'ID', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('nama', 'Nama jabatan', 'trim|required|max_length[40]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{			
			$data=array(
			"idjabatan"=>$this->input->post("id",true),
			"njabatan"=>$this->input->post("nama",true),
			"gapok"=>$this->input->post("gapok",true),
			"tunjangan"=>$this->input->post("tunjangan",true),
			"periode"=>$this->input->post("periode",true)
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ganda("jabatan","idjabatan",$data["idjabatan"])==TRUE){
				if($this->db->insert("jabatan",$data)){
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
	
	public function edit_jabatan($kode)
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'ID', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('nama', 'Nama jabatan', 'trim|required|max_length[40]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			
			//load data			
			$id=$this->input->post("id");
			$data=array(
				"idjabatan"=>$this->input->post("id",true),
				"njabatan"=>$this->input->post("nama",true),
				"gapok"=>$this->input->post("gapok",true),
				"tunjangan"=>$this->input->post("tunjangan",true),
				"periode"=>$this->input->post("periode",true)
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ada("jabatan","idjabatan",$id)==TRUE){
				if($this->db->where("idjabatan",$id)->update("jabatan",$data)){
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
	
	public function delete_jabatan($kode)
    {
		//load data
		$id=$kode;
		
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("jabatan","idjabatan",$id)==TRUE){
			if($this->db->where("idjabatan",$id)->delete("jabatan")){
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