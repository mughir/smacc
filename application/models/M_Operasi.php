<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_operasi extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;

	public function get_operasi(){
		$this->load->database();
		$this->db
			->select("o.nokartu")
			->select("o.idjadwal")
			->select("o.waktu")
			->select("o.namaoperasi")
			->select("o.status")
			->select("j.idorder")
			->select("j.jumlah")
			->select("idbarang");

		return $this->db->from("operasiproduksi o")->join("penjadwalan j","o.idjadwal=j.idjadwal")->join("perintah_prod p","p.idorder=j.idorder")->get()->result();
	}
	
	public function tambah_operasi()
    {
			$batch=$this->input->post("batch");
			$kartu=$this->input->post("kartu");
			$waktu=$this->input->post("tanggal");
			$operasi=$this->input->post("operasi");
			$status=0;if($this->input->post("finish")) $status=1;
		
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');	
			if($this->ms->cek_ada("operasiproduksi","nokartu",$kartu)) return "gagal";

			$data=array(
				"nokartu"=>$kartu,
				"idjadwal"=>$batch,
				"waktu"=>$waktu,
				"namaoperasi"=>$operasi,
				"status"=>$status
			);
			if($this->db->insert("operasiproduksi",$data)){
				if($status==1) $this->db->set("status",1);
				$this->db->set("namaoperasi",$operasi)->where("idjadwal",$batch)->update("penjadwalan");
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
	
	public function delete_operasi($kode)
    {
		//load data
		$id=$kode;
		
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("operasiproduksi","nokartu",$id)==TRUE){
			if($this->db->where("nokartu",$id)->delete("operasiproduksi")){
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