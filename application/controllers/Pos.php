<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pos extends CI_Controller {

       public function __construct(){
			parent::__construct();
            //code for allowed
			$this->load->helper('url');
       }
		
	public function index(){
		//load model
		$this->load->model('m_Navigasi');
		
		//code
		
		//muatan data
		$data['hal']="pos/utama";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	public function kasir(){
		//load model
		$this->load->library('user_agent');
		$this->load->model('m_Navigasi');
		$this->load->model('m_Kasir');
		
		//code
		
		//muatan data
		$data['barang']=$this->m_Kasir->get_barang();
		$data['hal']="pos/kasir";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);

		//Apabila ada post
		if($this->input->get("tipe")){
			$tipe=$this->input->get("tipe");
			$hasil= ($tipe=="submit") ? $this->m_Kasir->transaksi() : "gagal";
			$this->session->set_flashdata("hasil",$hasil);
			redirect($this->agent->referrer());
		}	
	}

	public function kasir_ajax_harga($kode=0){
		if($kode!==0){
			$this->load->model("m_Kasir");
			echo json_encode($this->m_Kasir->get_harga($kode));
		}
	}

	public function kasir_print($kode=0){
		//load model
		$this->load->library('user_agent');
		$this->load->model('m_Navigasi');
		$this->load->model('m_Kasir');
		
		//code
		if($kode==0) redirect(base_url."pos/kasir");

		//muatan data
		$data['isi']=$this->m_Kasir->get_isi_detail($kode);
		$data['summary']=$this->m_Kasir->get_summary($kode);
		$data['hal']="pos/print";
		$data['nav']=$this->m_Navigasi->utama();

		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	public function point(){
		//load model
		$this->load->model('m_Navigasi');
		$this->load->model('m_Point');
		$this->load->library('m_Point');
		$this->load->library('user_agent');
		
		//code
		
		//muatan data
		$data['hal']="pos/point";
		$data['spot']=$this->m_Point->get_point();
		$data['nav']=$this->m_Navigasi->utama();		

		//load tempelate
		$this->load->view("tempelate/ghancool",$data);


		if($this->input->get("tipe")){
			$hasil="gagal";
			$tipe=$this->input->get("tipe");
			switch($tipe){
				case "tambah":
				$hasil=$this->m_Point->tambah_point();
				break;				
				case "update":
				$hasil=$this->m_Point->edit_point();
				break;
				case "delete":
				$hasil=$this->m_Point->delete_point($this->input->get("id"));
				break;
			}

			$this->session->set_flashdata("hasil",$hasil);
			redirect($this->agent->referrer());
		}	
		
	}

	public function point_ajax($kode=0){
		if($kode!==0){
			$this->load->model("m_Point");
			echo json_encode($this->m_Point->get_detail($kode));
		}
	}	

	public function produk(){
		//load model
		$this->load->model('m_Navigasi');
		$this->load->model('m_ProdukPos',"msp");
		$this->load->model('m_Barang',"brg");
		$this->load->library('user_agent');
		
		//code
		
		//muatan data
		$data['hal']="pos/produk";
		$data['barang']=$this->brg->get_barang();
		$data['produk']=$this->msp->get_barang();
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);

		if($this->input->get("tipe")){
			$hasil="gagal";
			$tipe=$this->input->get("tipe");
			switch($tipe){
				case "tambah":
				$hasil=$this->msp->tambah_barang();
				break;				
				case "update":
				$hasil=$this->msp->edit_barang();
				break;
				case "delete":
				$hasil=$this->msp->delete_barang($this->input->get("id"));
				break;
			}

			$this->session->set_flashdata("hasil",$hasil);
			redirect($this->agent->referrer());
		}	
	}

	public function produk_ajax($kode=0){
		if($kode!==0){
			$this->load->model("m_ProdukPos");
			echo json_encode($this->m_ProdukPos->get_detail($kode));
		}
	}	

	public function laporan(){
		//load model
		$this->load->model('m_Navigasi');
		$this->load->model('m_output_pos');
		
		//code
		
		//muatan data
		$data["jumlah"]=($this->input->get("tipe")=="laporan") ? $this->m_output_pos->jumlah() : "";
		$data['hal']= ($this->input->get("tipe")=="laporan") ? "pos/laporan_output" : "pos/laporan";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
}
