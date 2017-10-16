<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Barang extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;
	
	public function get_barang()
	{
		$this->load->database();
		$this->db->order_by("idbarang","ASC");
		$datauser=$this->db->get("barang")->result();
		return $datauser;
	}
	
	public function get_detail($kode=1)
	{
		$this->load->database();
		$datauser=$this->db
			->where("idbarang",$kode)
			->get("barang")
			;
		return $datauser->row_array();
	}
	
	public function tambah_barang()
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'ID', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('nama', 'Nama barang', 'trim|required|max_length[40]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			
			$data=array(
			"idbarang"=>$this->input->post("id",true),
			"katbarang"=>$this->input->post("kategori",true),
			"nbarang"=>$this->input->post("nama",true),
			"satbarang"=>$this->input->post("satuan",true),
			"jumlah"=>$this->input->post("jumlah",true),
			"cbarang"=>$this->input->post("biaya",true),
			"hjualbarang"=>$this->input->post("harga",true),
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ganda("barang","idbarang",$data["idbarang"])==TRUE){
				if($this->db->insert("barang",$data)){
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
	
	public function delete_barang($kode)
    {
		//load data
		$id=$kode;
		
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("barang","idbarang",$id)==TRUE){
			if($this->db->where("idbarang",$id)->delete("barang")){
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

	public function update_barang($kode,$jumlah,$subtotal=0){
		$dbarang=$this->db->where("idbarang",$kode)->get("barang");
		$djumlah=$dbarang->jumlah;
		$cbarang=$dbarang->cbarang;
		$hbaru=$subtotal/$jumlah;

		if($cbarang==0) $cbarang=$hbaru;
		$subtotall=$djumlah*$cbarang;
		$subtotalb=$subtotall+$subtotal;
		$jumlahb=$jumlah+$djumlah;
		$costb=$subtotalb/$jumlahb;

		$this->db->set("jumlah",$jumlahb)->set("cbarang",$costb)->where("idbarang",$kode)->update("barang");
	}
}
?>