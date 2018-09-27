<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Masterdata extends CI_Controller {
	public function __construct(){
		parent::__construct();
		//code for all
		$this->load->helper('url');
		$this->load->library('session');
		if(!$this->session->userdata("username")=="admin"){
			redirect(base_url("user/login"));
		}
	}
	public function index(){
		redirect(base_url());
	}
	public function barang()
	{
		//load 
		$this->load->model('m_Navigasi');
		$this->load->model('m_Barang');
		$this->load->model('m_Akun');
		//code
		//muatan data
		$data['barang']=$this->m_Barang->get_barang();
		$data['hal']="masterfile/barang";
		$data['nav']=$this->m_Navigasi->utama();
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
	
	public function barang_proses($kode=0,$kode1=0)
	{
		$this->load->library('user_agent');
		$this->load->model('m_Barang');
		$hasil="gagal";
		switch($kode){
			case "tambah":
				$hasil=$this->m_Barang->tambah_barang();
			break;
			case "update":
				$hasil=$this->m_Barang->edit_barang($kode1);
			break;
			case "delete":
				$hasil=$this->m_Barang->delete_barang($kode1);
			break;
			default:
			show_404();
		}
		
		$this->session->set_flashdata("hasil",$hasil);
		redirect($this->agent->referrer());
	}
	
	public function barang_ajax($kode=1)
	{
		$this->load->model('m_Barang');
		echo json_encode($this->m_Barang->get_detail($kode));
	}
	
	
	public function kontak()
	{
		//load 
		$this->load->model('m_Navigasi');
		$this->load->model('m_Kontak');
		
		//code
		//muatan data
		$data["user"]=$this->m_Kontak->get_kontak();
		$data['hal']="masterfile/kontak";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
	
	public function kontak_proses($kode=0,$kode1=0)
	{
		$this->load->library('user_agent');
		$this->load->model('m_Kontak');
		
		$hasil="gagal";
		switch($kode){
			case "tambah":
				$hasil=$this->m_Kontak->tambah_kontak();
			break;
			case "update":
				$hasil=$this->m_Kontak->edit_kontak($kode1);
			break;
			case "delete":
				$hasil=$this->m_Kontak->delete_kontak($kode1);
			break;
			default:
			show_404();
		}
		
		$this->session->set_flashdata("hasil",$hasil);
		redirect($this->agent->referrer());
	}
	
	public function kontak_ajax($kode=1)
	{
		$this->load->model('m_Kontak');
		echo json_encode($this->m_Kontak->get_detail($kode));
	}
	
	public function fungsi()
	{
		//load 
		$this->load->model('m_Navigasi');
		$this->load->model('m_Fungsi');
		
		//code
		//muatan data
		$data["fungsi"]=$this->m_Fungsi->get_fungsi();
		$data['hal']="masterfile/fungsi";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
	
	public function fungsi_proses($kode=0,$kode1=0,$kode2=0)
	{
		$this->load->library('user_agent');
		$this->load->model('m_Fungsi');
		
		$hasil="gagal";
		switch($kode){
			case "tambah":
				$hasil=$this->m_Fungsi->tambah_fungsi();
			break;
			case "update":
				$hasil=$this->m_Fungsi->edit_fungsi($kode1);
			break;
			case "delete":
				$hasil=$this->m_Fungsi->delete_fungsi($kode1,$kode2);
			break;
			default:
			show_404();
		}
		
		$this->session->set_flashdata("hasil",$hasil);
		redirect($this->agent->referrer());
	}
	
	public function fungsi_ajax($kode=1)
	{
		$this->load->model('m_Fungsi');
		echo json_encode($this->m_Fungsi->get_detail($kode));
	}
	
	public function akun()
	{
		//load 
		$this->load->model('m_Akun');
		$this->load->model('m_Navigasi');
		
		//code
		//muatan data
		$data["user"]=$this->m_Akun->get_Akun();
		$data['hal']="masterfile/akun";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
	
	public function akun_proses($kode=0,$kode1=0)
	{
		$this->load->library('user_agent');
		$this->load->model('m_Akun');
		
		$hasil="gagal";
		switch($kode){
			case "tambah":
				$hasil=$this->m_Akun->tambah_akun();
			break;
			case "update":
				$hasil=$this->m_Akun->edit_akun($kode1);
			break;
			case "delete":
				$hasil=$this->m_Akun->delete_akun($kode1);
			break;
			default:
			show_404();
		}
		
		$this->session->set_flashdata("hasil",$hasil);
		redirect($this->agent->referrer());
	}
	
	public function akun_ajax($kode)
	{
		$this->load->model('m_Akun');
		echo json_encode($this->m_Akun->get_detail($kode));
	}
	
	public function user()
	{
		//load 
		$this->load->model('m_Navigasi');
		$this->load->model('m_User');
		$this->load->model("m_Role");
		
		//code
		//muatan data
		$data["role"]=$this->m_Role->get_role();
		$data["user"]=$this->m_User->get_user();
		$data['hal']="masterfile/user";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
	
	public function user_proses($kode=0,$kode1=0)
	{
		$this->load->library('user_agent');
		$this->load->model('m_User');
		
		$hasil="gagal";
		switch($kode){
			case "tambah":
				$hasil=$this->m_User->tambah_user();
			break;
			case "update":
				$hasil=$this->m_User->edit_user($kode1);
			break;
			case "delete":
				$hasil=$this->m_User->delete_user($kode1);
			break;
			default:
			show_404();
		}
		
		$this->session->set_flashdata("hasil",$hasil);
		redirect($this->agent->referrer());
	}
	
	public function user_ajax($kode=1)
	{
		$this->load->model('m_User');
		echo json_encode($this->m_User->get_detail($kode));
	}
	
	
	public function periode()
	{
		//load 
		$this->load->model('m_Periode');
		$this->load->model('m_Navigasi');
		
		//code
		//muatan data
		$data["user"]=$this->m_Periode->get_periode();
		$data['hal']="masterfile/periode";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
	
	public function periode_proses($kode=0,$kode1=0)
	{
		$this->load->library('user_agent');
		$this->load->model('m_Periode');
		
		$hasil="gagal";
		switch($kode){
			case "tambah":
				$hasil=$this->m_Periode->tambah_periode();
			break;
			case "update":
				$hasil=$this->m_Periode->edit_periode($kode1);
			break;
			case "delete":
				$hasil=$this->m_Periode->delete_periode($kode1);
			break;
			default:
			show_404();
		}
		
		$this->session->set_flashdata("hasil",$hasil);
		redirect($this->agent->referrer());
	}
	
	public function periode_ajax($kode=1)
	{
		$this->load->model('m_Periode');
		echo json_encode($this->m_Periode->get_detail($kode));
	}

	public function role(){
		//load 
		$this->load->model('m_Navigasi');
		$this->load->model('m_Role');
		$this->load->model('m_Fungsi');
		$this->load->model('m_Akun');
		//code
		//muatan data
		$data['role']=$this->m_Role->get_role();
		$data['fungsi']=$this->m_Fungsi->get_fungsi();
		$data['hal']="masterfile/role";
		$data['nav']=$this->m_Navigasi->utama();
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
	
	public function role_proses($kode=0,$kode1=0)
	{
		$this->load->library('user_agent');
		$this->load->model('m_Role');
		$hasil="gagal";
		switch($kode){
			case "tambah":
				$hasil=$this->m_Role->tambah_role();
			break;
			case "update":
				$hasil=$this->m_Role->edit_role($kode1);
			break;
			case "delete":
				$hasil=$this->m_Role->delete_role($kode1);
			break;
			default:
			show_404();
		}
		
		$this->session->set_flashdata("hasil",$hasil);
		redirect($this->agent->referrer());
	}
	
	public function role_ajax($kode=1)
	{
		$this->load->model('m_Role');
		$role = $this->m_Role->get_detail($kode);
		$fungsi = $this->db->where("idrole",$kode)->get("fungsirole")->result_array();
		$ar=[];
		foreach($fungsi as $f) $ar[] = $f['idfungsi'];
		$role+= ['fungsi'=>$ar];
		echo json_encode($role);
	}
}
