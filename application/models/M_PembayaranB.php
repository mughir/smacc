<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_pembayaranb extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;
	
	public function get_pembayaran()
	{
		$this->load->database();
		$awal=$this->session->userdata("periode_dari");
		$sampai=$this->session->userdata("periode_sampai");

		$this->db
			->where("tglbayar >=",$awal)
			->where("tglbayar <=",$sampai)
			->order_by("idpembayaran","ASC");
		$datauser=$this->db->get("pembtagihan")->result();
		return $datauser;
	}
	
	public function get_detail($kode=1)
	{
		$this->load->database();
		$datauser=$this->db
			->where("idpembayaran",$kode)
			->get("pembtagihan")
			;
		return $datauser->row_array();
	}
	
	public function tambah_pembayaran()
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'ID', 'trim|required|max_length[20]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			
			$data=array(
			"idpembayaran"=>$this->input->post("id",true),
			"tglbayar"=>$this->input->post("tanggal",true),
			"jmbayar"=>$this->input->post("bayar",true),
			"via"=>$this->input->post("via",true),
			"ket"=>$this->input->post("ket",true),
			"idtagihan"=>$this->input->post("tagihan",true)
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ganda("pembtagihan","idpembayaran",$data["idpembayaran"])==TRUE){
				if($this->db->insert("pembtagihan",$data)){
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
	
	public function edit_pembayaran($kode)
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
				"tglbayar"=>$this->input->post("tanggal",true),
				"jmbayar"=>$this->input->post("bayar",true),
				"via"=>$this->input->post("via",true),
				"ket"=>$this->input->post("ket",true),
				"idtagihan"=>$this->input->post("tagihan",true)
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ada("pembtagihan","idpembayaran",$id)==TRUE){
				if($this->db->where("idpembayaran",$id)->update("pembtagihan",$data)){
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
	
	public function delete_pembayaran($kode)
    {
		//load data
		$id=$kode;
		
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("pembtagihan","idpembayaran",$id)==TRUE){
			if($this->db->where("idpembayaran",$id)->delete("pembtagihan")){
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