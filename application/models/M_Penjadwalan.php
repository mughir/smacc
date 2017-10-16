<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_penjadwalan extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;

	public function get_jadwal(){
		$this->load->database();
		return $this->db->from("penjadwalan j")->join("perintah_prod p","p.idorder=j.idorder")->get()->result();
	}
	
	public function tambah_jadwal()
    {
			$perintah=$this->input->post("perintah");
			$waktu=$this->input->post("waktu");
			$jumlah=$this->input->post("jumlah");
			$operasi=$this->input->post("operasi");
		
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');		
				$data=array(
					"idorder"=>$perintah,
					"waktu"=>$waktu,
					"jumlah"=>$jumlah,
					"namaoperasi"=>$operasi,
					"status"=>0
				);
				if($this->db->insert("penjadwalan",$data)){
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
	
	public function delete_jadwal($kode)
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