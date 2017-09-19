<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sdm extends CI_Controller {
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
		$data['hal']="hrd/utama";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	public function karyawan()
	{
		//load 
		$this->load->model('m_Navigasi');
		$this->load->model('m_Karyawan');
		$this->load->model('m_Akun');

		//code
		//muatan data
		$data['karyawan']=$this->m_Karyawan->get_karyawan();
		$data['hal']="sdm/karyawan";
		$data['nav']=$this->m_Navigasi->utama();

		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	

	public function karyawan_proses($kode=0,$kode1=0)

	{

		$this->load->library('user_agent');
		$this->load->model('m_Karyawan');

		$hasil="gagal";

		switch($kode){

			case "tambah":

				$hasil=$this->m_Karyawan->tambah_karyawan();

			break;

			case "update":

				$hasil=$this->m_Karyawan->edit_karyawan($kode1);

			break;

			case "delete":

				$hasil=$this->m_Karyawan->delete_karyawan($kode1);

			break;

			default:

			show_404();

		}

		

		$this->session->set_flashdata("hasil",$hasil);

		redirect($this->agent->referrer());

	}

	

	public function karyawan_ajax($kode=1)

	{

		$this->load->model('m_Karyawan');

		echo json_encode($this->m_Karyawan->get_detail($kode));

	}

	public function jabatan()
	{
		//load 
		$this->load->model('m_Navigasi');
		$this->load->model('m_Jabatan');
		$this->load->model('m_Akun');

		//code
		//muatan data
		$data['jabatan']=$this->m_Jabatan->get_jabatan();
		$data['hal']="sdm/jabatan";
		$data['nav']=$this->m_Navigasi->utama();

		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	

	public function jabatan_proses($kode=0,$kode1=0)

	{

		$this->load->library('user_agent');
		$this->load->model('m_Jabatan');

		$hasil="gagal";

		switch($kode){

			case "tambah":

				$hasil=$this->m_Jabatan->tambah_jabatan();

			break;

			case "update":

				$hasil=$this->m_Jabatan->edit_jabatan($kode1);

			break;

			case "delete":

				$hasil=$this->m_Jabatan->delete_jabatan($kode1);

			break;

			default:

			show_404();

		}

		

		$this->session->set_flashdata("hasil",$hasil);

		redirect($this->agent->referrer());

	}

	

	public function jabatan_ajax($kode=1)
	{

		$this->load->model('m_Jabatan');

		echo json_encode($this->m_Jabatan->get_detail($kode));

	}

	public function absensi(){
		//load model
		$this->load->model('m_Navigasi');
		
		//code
		
		//muatan data
		$data['hal']="sdm/absensi";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	public function proses_gaji(){
		//load model
		$this->load->model('m_Navigasi');
		$this->load->model('m_Gaji');
		
		//code
		
		//muatan data
		$data['nav']=$this->m_Navigasi->utama();

		if($this->input->get("proses")&&$this->input->get("tahun")&&$this->input->get("bulan")){
			$data['gaji']=$this->m_Gaji->get_gaji();
			$data['hal']="sdm/penggajian";
		}else{
			$data['hal']="sdm/proses_gaji";
		}
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	public function laporan(){
		//load model
		$this->load->model('m_Navigasi');
		$this->load->model('m_Lap_SDM');
		
		//code
		if($this->input->get("proses")){
			$data['gaji']=$this->m_Lap_SDM->get_laporan();
			$data['hal']="sdm/isilap";
		}else{
			$data['hal']="sdm/laporan";
		}

		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
}
