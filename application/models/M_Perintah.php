<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_perintah extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;

	public function get_perintah(){
		$this->load->database();
		return $this->db->get("perintah_prod")->result();
	}
	
	public function get_terjadwal($kode){
		$this->load->database();
		return $this->db->select_sum("jumlah")->where("idorder",$kode)->get("penjadwalan")->row()->jumlah;
	}

	public function get_finish($kode){
		$this->load->database();	
		return $this->db->select_sum("jumlah")->where("status >",1)->where("idorder",$kode)->get("penjadwalan")->row()->jumlah;
	}

	public function tambah_perintah()
    {
			$barang=$this->input->post("barang");
			$tanggal=$this->input->post("tanggal");
			$jumlah=$this->input->post("jumlah");
			$prioritas=$this->input->post("prioritas");
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');		
				$data=array(
					"idbarang"=>$barang,
					"tanggal"=>$tanggal,
					"jumlah"=>$jumlah,
					"prioritas"=>$prioritas,
					"status"=>0
				);
				if($this->db->insert("perintah_prod",$data)){
					return "berhasil";
				}
				else{
					return "gagal";
				}
	}
	
	public function edit_barang($kode)
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
				"katbarang"=>$this->input->post("kategori",true),
				"nbarang"=>$this->input->post("nama",true),
				"satbarang"=>$this->input->post("satuan",true),
				"jumlah"=>$this->input->post("jumlah",true),
				"cbarang"=>$this->input->post("biaya",true),
				"hjualbarang"=>$this->input->post("harga",true),
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ada("barang","idbarang",$id)==TRUE){
				if($this->db->where("idbarang",$id)->update("barang",$data)){
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
	
	public function delete_perintah($kode)
    {
		//load data
		$id=$kode;
		
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("perintah_prod","idorder",$id)==TRUE){
			if($this->db->where("idorder",$id)->delete("perintah_prod")){
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