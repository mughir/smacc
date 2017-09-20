<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_pembayaran extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;
	
	public function get_pembayaran()
	{
		$this->load->database();
		$this->db->order_by("idpembayaran","ASC");
		$datauser=$this->db->get("pembayaran")->result();
		return $datauser;
	}
	
	public function get_detail($kode=1)
	{
		$this->load->database();
		$datauser=$this->db
			->where("idpembayaran",$kode)
			->get("pembayaran")
			;
		return $datauser->row_array();
	}
	
	public function tambah_pembayaran()
    {
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'ID', 'trim|required|max_length[20]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{

			$kwitansi=$this->input->post("kwitansi",true);

			if(empty($kwitansi)){
				$kwitansi=null;
			} else {
				if($this->ms->cek_ada("kwitansi","idkwitansi",$kwitansi)==FALSE) return "gagal";
				$this->db->set("stkwitansi",1)->where("idkwitansi",$kwitansi)->update("kwitansi");
			}
			
			$data=array(
			"idpembayaran"=>$this->input->post("id",true),
			"tglbayar"=>$this->input->post("tanggal",true),
			"jmbayar"=>$this->input->post("bayar",true),
			"via"=>$this->input->post("via",true),
			"ket"=>$this->input->post("ket",true),
			"idkwitansi"=>$kwitansi
			);


			if($this->ms->cek_ganda("pembayaran","idpembayaran",$data["idpembayaran"])==TRUE){
				if($this->db->insert("pembayaran",$data)){
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
				"idkwitansi"=>$this->input->post("kwitansi",true)
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ada("pembayaran","idpembayaran",$id)==TRUE){
				if($this->db->where("idpembayaran",$id)->update("pembayaran",$data)){
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
		if($this->ms->cek_ada("pembayaran","idpembayaran",$id)==TRUE){
			if($this->db->where("idpembayaran",$id)->delete("pembayaran")){
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