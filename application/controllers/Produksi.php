<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produksi extends CI_Controller {
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
		$data['hal']="produksi/utama";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	public function rnd(){
		//load model
		$this->load->model('m_Navigasi');
		$this->load->model('m_Barang');
		$this->load->model('m_Rnd');

		//code
		if($this->input->get("tipe")){
			$hasil="gagal";
			$tipe=$this->input->get("tipe");
			switch($tipe){
				case "tambah":
					$hasil=$this->m_Rnd->tambah_rnd();
				break;
				case "delete":
					$hasil=$this->m_Rnd->delete_rnd($this->input->get("id"));
				break;
			}
			$this->session->set_flashdata("hasil",$hasil);
			redirect(base_url()."produksi/rnd");
		}
		
		//muatan data
		$data['rnd']=$this->m_Rnd->get_barang();
		$data['material']=$this->m_Rnd->get_material();
		$data['barang']=$this->m_Barang->get_barang();
		$data['hal']="produksi/rnd";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	public function perintah(){
		//load model
		$this->load->model('m_Navigasi');
		$this->load->model('m_Rnd');
		$this->load->model('m_Perintah');
		
		//code		
		if($this->input->get("tipe")){
			$hasil="gagal";
			$tipe=$this->input->get("tipe");
			switch($tipe){
				case "tambah":
					$hasil=$this->m_Perintah->tambah_perintah();
				break;
				case "delete":
					$hasil=$this->m_Perintah->delete_perintah($this->input->get("id"));
				break;
			}
			$this->session->set_flashdata("hasil",$hasil);
			redirect(base_url()."produksi/perintah");
		}
		
		//muatan data
		$data['perintah']=$this->m_Perintah->get_perintah();
		$data['barang']=$this->m_Rnd->get_barang();
		$data['hal']="produksi/perintah";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	public function penjadwalan(){
		//load model
		$this->load->model('m_Navigasi');
		$this->load->model('m_Penjadwalan');
		
		//code		
		if($this->input->get("tipe")){
			$hasil="gagal";
			$tipe=$this->input->get("tipe");
			switch($tipe){
				case "tambah":
					$hasil=$this->m_Penjadwalan->tambah_jadwal();
				break;
				case "delete":
					$hasil=$this->m_Penjadwalan->delete_jadwal($this->input->get("id"));
				break;
			}
			$this->session->set_flashdata("hasil",$hasil);
			redirect(base_url()."produksi/penjadwalan");
		}
		
		//muatan data
		$data['jadwal']=$this->m_Penjadwalan->get_jadwal();
		$data['hal']="produksi/penjadwalan";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	public function operasi(){
		//load model
		$this->load->model('m_Navigasi');
		
		//code
		
		//muatan data
		$data['hal']="produksi/operasi";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	public function pengambilan(){
		//load model
		$this->load->model('m_Navigasi');
		
		//code
		
		//muatan data
		$data['hal']="produksi/pengambilan";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	public function penyesuaian(){
		//load model
		$this->load->model('m_Navigasi');
		
		//code
		
		//muatan data
		$data['hal']="produksi/penyesuaian";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	public function laporan(){
		//load model
		$this->load->model('m_Navigasi');
		
		//code
		
		//muatan data
		$data['hal']="produksi/laporan";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
}
?>
