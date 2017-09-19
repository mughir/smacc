<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_ProdukPos extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;
	
	public function get_barang()
	{
		$this->load->database();
		$this->db->order_by("barangkasir.idbarang","ASC");
		$datauser=$this->db->from("barangkasir")->join('barang','barang.idbarang=barangkasir.idbarang')->get()->result();
		return $datauser;
	}
	
	public function get_detail($kode=1)
	{
		$this->load->database();
		$datauser=$this->db
			->where("idbarang",$kode)
			->get("barangkasir")
			;
		return $datauser->row_array();
	}
	
	public function tambah_barang()
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'ID', 'trim|required|max_length[20]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			
			$data=array(
			"idbarang"=>$this->input->post("id",true),
			"hbarangkasir"=>$this->input->post("harga",true),
			"disbarangkasir"=>$this->input->post("diskon",true),
			"sbarangkasir"=>1
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ganda("barangkasir","idbarang",$data["idbarang"])==TRUE){
				if($this->db->insert("barangkasir",$data)){
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
	
	public function edit_barang()
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'ID', 'trim|required|max_length[20]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			
			//load data			
			$id=$this->input->post("id");
				$data=array(
				"hbarangkasir"=>$this->input->post("harga",true),
				"disbarangkasir"=>$this->input->post("diskon",true),
				"sbarangkasir"=>$this->input->post("status",true)
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ada("barangkasir","idbarang",$id)==TRUE){
				if($this->db->where("idbarang",$id)->update("barangkasir",$data)){
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
		if($this->ms->cek_ada("barangkasir","idbarang",$id)==TRUE){
			if($this->db->where("idbarang",$id)->delete("barangkasir")){
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