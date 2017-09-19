<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Jenis_jurnal extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;
	
	public function get_jenis_jurnal()
	{
		$this->load->database();
		$this->db->order_by("JENIS_JURNAL_KODE","ASC");
		$datauser=$this->db->get("BSPL_DATA_JENIS_JURNAL")->result();
		return $datauser;
	}
	
	public function get_detail($kode=1)
	{
		$this->load->database();
		$datauser=$this->db->where("JENIS_JURNAL_KODE",$kode)->get("BSPL_DATA_JENIS_JURNAL");
		return $datauser->row_array();
	}
	
	public function tambah_jenis_jurnal()
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('kode', 'Kode Jenis', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('nama', 'Nama Jenis', 'trim|required|max_length[40]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			
			//load data
			$data=array(
			"JENIS_JURNAL_KODE"=>$this->input->post("kode",true),
			"JENIS_JURNAL_NAMA"=>$this->input->post("nama",true),
			"JENIS_JURNAL_COCD"=>$this->input->post("cocd",true)
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ganda("BSPL_DATA_JENIS_JURNAL","JENIS_JURNAL_KODE",$data["JENIS_JURNAL_KODE"])==TRUE){
				if($this->db->insert("BSPL_DATA_JENIS_JURNAL",$data)){
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
	
	public function edit_jenis_jurnal($kode)
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('kode', 'kode', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('nama', 'Nama jurnal', 'trim|required|max_length[40]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			
			//load data
			$id=$this->input->post("kodelama");
			$data=array(
			"JENIS_JURNAL_KODE"=>$this->input->post("kode"),
			"JENIS_JURNAL_NAMA"=>$this->input->post("nama"),
			"JENIS_JURNAL_COCD"=>$this->input->post("cocd")
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ganda("BSPL_DATA_JENIS_JURNAL",array("JENIS_JURNAL_KODE"=>$data["JENIS_JURNAL_KODE"]))==TRUE or $id==$this->input->post("kode")){
				if($this->db->where("JENIS_JURNAL_KODE",$id)->update("BSPL_DATA_JENIS_JURNAL",$data)){
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
	
	public function delete_jenis_jurnal($kode)
    {
		//load data
		$id=$kode;
		
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("BSPL_DATA_JENIS_JURNAL","JENIS_JURNAL_KODE",$id)==TRUE){
			if($this->db->where("JENIS_JURNAL_KODE",$id)->delete("BSPL_DATA_JENIS_JURNAL")){
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