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
				case "edit":
					$hasil=$this->m_Rnd->edit_rnd();
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

	public function ajax_rnd($id){
		$this->load->model('m_Rnd');
		echo json_encode($this->m_Rnd->get_detail($id));
	}

	public function ajax_rnd_material($id){
		$this->load->model('m_Rnd');
		echo json_encode($this->m_Rnd->get_detail_material($id));
	}

	public function ajax_rnd_operasi($id){
		$this->load->model('m_Rnd');
		echo json_encode($this->m_Rnd->get_detail_operasi($id));
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
		$this->load->model('m_Operasi');
		
		//code		
		if($this->input->get("tipe")){
			$hasil="gagal";
			$tipe=$this->input->get("tipe");
			switch($tipe){
				case "tambah":
					$hasil=$this->m_Operasi->tambah_operasi();
				break;
				case "delete":
					$hasil=$this->m_Operasi->delete_operasi($this->input->get("id"));
				break;
			}
			$this->session->set_flashdata("hasil",$hasil);
			redirect(base_url()."produksi/operasi");
		}
		
		//muatan data
		$data['operasi']=$this->m_Operasi->get_operasi();
		$data['hal']="produksi/operasi";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	public function ajax_operasi($kode){
		$this->load->model("M_Operasi");
		echo json_encode($this->M_Operasi->get_detail($kode));
	}

	public function pengambilan(){
		//load model
		$this->load->model('m_Navigasi');
		$this->load->model('m_Rnd');
		$this->load->model('m_Pengambilan');
		
		//code		
		if($this->input->get("tipe")){
			$hasil="gagal";
			$tipe=$this->input->get("tipe");
			switch($tipe){
				case "tambah":
					$hasil=$this->m_Pengambilan->tambah_pengambilan();
				break;
				case "delete":
					$hasil=$this->m_Pengambilan->delete_pengambilan($this->input->get("id"));
				break;
			}
			$this->session->set_flashdata("hasil",$hasil);
			redirect(base_url()."produksi/pengambilan");
		}
		
		//muatan data
		$data['req']=$this->m_Pengambilan->get_pengambilan();
		$data['barang']=$this->m_Rnd->get_material();
		$data['hal']="produksi/pengambilan";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	public function ajax_pengambilan($id){
		$this->load->model('m_Pengambilan');
		echo json_encode($this->m_Pengambilan->get_detail($id));
	}

	public function ajax_pengambilan_detail($id){
		$this->load->model('m_Pengambilan');
		echo json_encode($this->m_Pengambilan->get_detail_isi($id));
	}


	public function penyesuaian(){
		//load model
		$this->load->model('m_Navigasi');
		$this->load->model("m_PenyesuaianProd","mp");
		
		//code		
		if($this->input->get("proses")=="penyesuaian"){
			$hasil="gagal";
			$hasil=$this->mp->sesuaikan();
			$this->session->set_flashdata("hasil",$hasil);
			redirect(base_url()."produksi/penyesuaian");
		}
		
		//muatan data
		$data['sesuai']=$this->mp->get_penyesuaian();
		$data['hal']="produksi/penyesuaian";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	public function ajax_penyesuaian($id){
		$this->load->model("m_PenyesuaianProd","mp");
		echo json_encode(array("total"=>$this->mp->get_estimasi($id),"idbarang"=>$this->mp->get_detail($id)->idbarang));
	}

	public function ajax_penyesuaian_detail($id){
		$this->load->model("m_PenyesuaianProd","mp");
		echo json_encode($this->mp->get_detail_isi($id));
	}

	public function laporan(){
		//load model
		$this->load->model('m_Navigasi');
		$this->load->model("m_Output_Produksi");
		
		//code
		
		//muatan data
		$data["jumlah"]=($this->input->get("tipe")=="laporan") ? $this->m_Output_Produksi->jumlah() : "";
		$data['hal']= ($this->input->get("tipe")=="laporan") ? "produksi/laporan_output" : "produksi/laporan";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
}
?>
