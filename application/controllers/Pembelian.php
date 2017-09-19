<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller {

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
		$data['hal']="pembelian/utama";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	public function permintaan(){
		//load model
		$this->load->model('m_Navigasi');
		$this->load->library('user_agent');
		$this->load->model('m_Kontak');
		$this->load->model('m_Barang');
		$this->load->model('m_Permintaan');
		
		//code
		
		//muatan data
		$data['barang']=$this->m_Barang->get_barang("2");
		$data['pengajuan']=$this->m_Permintaan->get_permintaan();
		$data['hal']="pembelian/permintaan";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);		

		//Apabila ada post
		if($this->input->get("tipe")){
			$hasil="gagal";
			$tipe=$this->input->get("tipe");
			switch($tipe){
				case "tambah":
				$hasil=$this->m_Permintaan->tambah_permintaan();
				break;
				case "delete":
				$hasil=$this->m_Permintaan->delete_permintaan($this->input->get("id"));
				break;
			}

			$this->session->set_flashdata("hasil",$hasil);
			redirect($this->agent->referrer());
		}
	}	

	public function permintaan_ajax($kode=0){
		if($kode!==0){
			$this->load->model("m_Permintaan");
			echo json_encode($this->m_Permintaan->get_detail($kode));
		}
	}	

	public function  permintaan_detail_ajax($kode=0){
		if($kode!==0){
			$this->load->model("m_Permintaan");
			echo json_encode($this->m_Permintaan->get_baris($kode));
		}
	}

	public function pesanan(){
		//load model
		$this->load->library('user_agent');
		$this->load->model('m_Navigasi');
		$this->load->model('m_Kontak');
		$this->load->model('m_Barang');
		$this->load->model('m_Pesanbeli');
		
		//code
		
		//muatan data
		$data['barang']=$this->m_Barang->get_barang("2");
		$data['pembeli']=$this->m_Kontak->get_kontak_tipe("1");
		$data['pesanan']=$this->m_Pesanbeli->get_pesanan();
		$data['hal']="pembelian/pesanan";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);

		//Apabila ada post
		if($this->input->get("tipe")){
			$hasil="gagal";
			$tipe=$this->input->get("tipe");
			switch($tipe){
				case "tambah":
				$hasil=$this->m_Pesanbeli->tambah_pesanan();
				break;				
				case "update":
				$hasil=$this->m_Pesanbeli->update_pesanan();
				break;
				case "delete":
				$hasil=$this->m_Pesanbeli->delete_pesanan($this->input->get("id"));
				break;
			}

			$this->session->set_flashdata("hasil",$hasil);
			redirect($this->agent->referrer());
		}		
	}	

	public function pesanan_ajax($kode=0){
		if($kode!==0){
			$this->load->model("m_Pesanbeli");
			echo json_encode($this->m_Pesanbeli->get_detail($kode));
		}
	}	

	public function pesanan_detail_ajax($kode=0){
		if($kode!==0){
			$this->load->model("m_Pesanbeli");
			echo json_encode($this->m_Pesanbeli->get_baris($kode));
		}
	}


	public function pesanan_ajax_harga($kode=0){
		if($kode!==0){
			$this->load->model("m_Pesanbeli");
			echo json_encode($this->m_Pesanbeli->get_harga($kode));
		}
	}

	public function penerimaan(){
		//load model
		$this->load->library('user_agent');
		$this->load->model('m_Barang');
		$this->load->model('m_Navigasi');
		$this->load->model('m_Terimabarang');
		
		//code
		
		//muatan data
		$data['barang']=$this->m_Barang->get_barang("2");
		$data['terima']=$this->m_Terimabarang->get_penerimaan();
		$data['hal']="pembelian/penerimaan";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);

		//Apabila ada post
		if($this->input->get("tipe")){
			$hasil="gagal";
			$tipe=$this->input->get("tipe");
			switch($tipe){
				case "tambah":
				$hasil=$this->m_Terimabarang->tambah_penerimaan();
				break;
				case "delete":
				$hasil=$this->m_Terimabarang->delete_penerimaan($this->input->get("id"));
				break;
			}

			$this->session->set_flashdata("hasil",$hasil);
			redirect($this->agent->referrer());
		}
	}	

	public function penerimaan_ajax($kode=0){
		if($kode!==0){
			$this->load->model("m_Terimabarang");
			echo json_encode($this->m_Terimabarang->get_detail($kode));
		}
	}	

	public function  penerimaan_detail_ajax($kode=0){
		if($kode!==0){
			$this->load->model("m_Terimabarang");
			echo json_encode($this->m_Terimabarang->get_baris($kode));
		}
	}


	public function penerimaan_ajax_harga($kode=0){
		if($kode!==0){
			$this->load->model("m_Terimabarang");
			echo json_encode($this->m_Terimabarang->get_harga($kode));
		}
	}


		public function tagihan(){
		//load model
		$this->load->library('user_agent');
		$this->load->model('m_Navigasi');
		$this->load->model('m_Kontak');
		$this->load->model('m_Barang');
		$this->load->model('m_tagihan');
		
		//code
		
		//muatan data
		$data['barang']=$this->m_Barang->get_barang("2");
		$data['pembeli']=$this->m_Kontak->get_kontak_tipe("2");
		$data['kwitansi']=$this->m_tagihan->get_tagihan();
		$data['hal']="pembelian/tagihan";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);

		//Apabila ada post
		if($this->input->get("tipe")){
			$hasil="gagal";
			$tipe=$this->input->get("tipe");
			switch($tipe){
				case "tambah":
				$hasil=$this->m_tagihan->tambah_tagihan();
				break;				
				case "update":
				$hasil=$this->m_tagihan->update_tagihan();
				break;
				case "delete":
				$hasil=$this->m_tagihan->delete_tagihan($this->input->get("id"));
				break;
			}

			$this->session->set_flashdata("hasil",$hasil);
			redirect($this->agent->referrer());
		}		
	}	

	public function tagihan_ajax($kode=0){
		if($kode!==0){
			$this->load->model("m_tagihan");
			echo json_encode($this->m_tagihan->get_detail($kode));
		}
	}	

	public function tagihan_detail_ajax($kode=0){
		if($kode!==0){
			$this->load->model("m_tagihan");
			echo json_encode($this->m_tagihan->get_baris($kode));
		}
	}


	public function pembayaran(){
		//load model
		$this->load->library('user_agent');
		$this->load->model('m_Navigasi');
		$this->load->model('m_PembayaranB');
		
		//code
		
		//muatan data
		$data['bayar']=$this->m_PembayaranB->get_pembayaran();
		$data['hal']="pembelian/pembayaran";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);

		//Apabila ada post
		if($this->input->get("tipe")){
			$hasil="gagal";
			$tipe=$this->input->get("tipe");
			switch($tipe){
				case "tambah":
				$hasil=$this->m_PembayaranB->tambah_pembayaran();
				break;				
				case "update":
				$hasil=$this->m_PembayaranB->update_pembayaran();
				break;
				case "delete":
				$hasil=$this->m_PembayaranB->delete_pembayaran($this->input->get("id"));
				break;
			}

			$this->session->set_flashdata("hasil",$hasil);
			redirect($this->agent->referrer());
		}		
	}	

	public function pembayaran_ajax($kode=0){
		if($kode!==0){
			$this->load->model("m_PembayaranB");
			echo json_encode($this->m_PembayaranB->get_detail($kode));
		}
	}	

	public function laporan(){
		//load model
		$this->load->model('m_Navigasi');
		$this->load->model('m_Output_Pembelian');
		
		//code
		
		//muatan data
		//muatan data
		$data["jumlah"]=($this->input->get("tipe")=="laporan") ? $this->m_Output_Pembelian->jumlah() : "";
		$data['hal']= ($this->input->get("tipe")=="laporan") ? "pembelian/laporan_output" : "pembelian/laporan";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
}
