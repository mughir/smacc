<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_kontak extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;
	
	public function get_kontak()
	{
		$this->load->database();
		$this->db->order_by("idkontak","ASC");
		$datauser=$this->db->get("kontak")->result();
		return $datauser;
	}

	public function get_kontak_tipe($tipe)
	{
		$this->load->database();

		$this->db->where("jkontak",$tipe);
		$this->db->order_by("idkontak","ASC");
		$datauser=$this->db->get("kontak")->result();
		return $datauser;
	}
	
	public function get_detail($kode=1)
	{
		$this->load->database();
		$datauser=$this->db->where("idkontak",$kode)->get("kontak");
		return $datauser->row_array();
	}
	
	public function tambah_kontak()
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'ID', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('nama', 'Nama kontak', 'trim|required|max_length[40]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			
			//load data
			$data=array(
			"idkontak"=>$this->input->post("id",true),
			"jkontak"=>$this->input->post("jenis"),
			"nkontak"=>$this->input->post("nama"),
			"npwp"=>$this->input->post("npwp"),
			"email"=>$this->input->post("email"),
			"provinsi"=>$this->input->post("provinsi"),
			"kota"=>$this->input->post("kota"),
			"kecamatan"=>$this->input->post("kecamatan"),
			"kodepos"=>$this->input->post("kodepos"),
			"alkontak"=>$this->input->post("alamat"),
			"telkontak"=>$this->input->post("telepon"),
			"stkontak"=>"aktif"
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ganda("kontak","idkontak",$data["idkontak"])==TRUE){
				if($this->db->insert("kontak",$data)){
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
	
	public function edit_kontak($kode)
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'ID', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('nama', 'Nama kontak', 'trim|required|max_length[40]');
		$this->form_validation->set_rules('status', 'Nilai Sisa', 'trim|required|max_length[20]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			
			//load data
			$id=$this->input->post("id");
			$data=array(
			"jkontak"=>$this->input->post("jenis"),
			"nkontak"=>$this->input->post("nama"),
			"alkontak"=>$this->input->post("alamat"),
			"npwp"=>$this->input->post("npwp"),
			"email"=>$this->input->post("email"),
			"provinsi"=>$this->input->post("provinsi"),
			"kota"=>$this->input->post("kota"),
			"kecamatan"=>$this->input->post("kecamatan"),
			"kodepos"=>$this->input->post("kodepos"),
			"telkontak"=>$this->input->post("telepon"),
			"stkontak"=>$this->input->post("status")
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ada("kontak","idkontak",$id)==TRUE){
				if($this->db->where("idkontak",$id)->update("kontak",$data)){
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
	
	public function delete_kontak($kode)
    {
		//load data
		$id=$kode;
		
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("kontak","idkontak",$id)==TRUE){
			if($this->db->where("idkontak",$id)->delete("kontak")){
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