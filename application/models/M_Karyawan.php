<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_karyawan extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;
	
	public function get_karyawan()
	{
		$this->load->database();
		$this->db->order_by("idpegawai","ASC");
		$this->db->from("pegawai k")->join("jabatan j",'j.idjabatan=k.idjabatan');
		$datauser=$this->db->get()->result();
		return $datauser;
	}
	
	public function get_detail($kode=1)
	{
		$this->load->database();
		$datauser=$this->db
			->where("idpegawai",$kode)
			->get("pegawai")
			;
		return $datauser->row_array();
	}
	
	public function tambah_karyawan()
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'ID', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('nama', 'Nama pegawai', 'trim|required|max_length[40]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{			
			$data=array(
			"idpegawai"=>$this->input->post("id",true),
			"npegawai"=>$this->input->post("nama",true),
			"alpegawai"=>$this->input->post("alamat",true),
			"telpegawai"=>$this->input->post("telepon",true),
			"idjabatan"=>$this->input->post("jabatan",true),
			"stnikah"=>$this->input->post("nikah",true),
			"tanggungan"=>$this->input->post("tanggungan",true),
			"vartambahan"=>$this->input->post("var",true),
			"stpegawai"=>1
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ganda("pegawai","idpegawai",$data["idpegawai"])==TRUE){
				if($this->db->insert("pegawai",$data)){
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
	
	public function edit_karyawan($kode)
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'ID', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('nama', 'Nama pegawai', 'trim|required|max_length[40]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			
			//load data			
			$id=$this->input->post("id");
			$data=array(
				"idpegawai"=>$this->input->post("id",true),
				"npegawai"=>$this->input->post("nama",true),
				"alpegawai"=>$this->input->post("alamat",true),
				"telpegawai"=>$this->input->post("telepon",true),
				"idjabatan"=>$this->input->post("jabatan",true),
				"stnikah"=>$this->input->post("nikah",true),
				"tanggungan"=>$this->input->post("tanggungan",true),
				"vartambahan"=>$this->input->post("var",true)
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ada("pegawai","idpegawai",$id)==TRUE){
				if($this->db->where("idpegawai",$id)->update("pegawai",$data)){
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
	
	public function delete_karyawan($kode)
    {
		//load data
		$id=$kode;
		
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("pegawai","idpegawai",$id)==TRUE){
			if($this->db->where("idpegawai",$id)->delete("pegawai")){
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