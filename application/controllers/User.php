<?php 
class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->load->helper("url");
		$this->load->library('session');
	}

	public function index()
	{	
		redirect(base_url()."user/login");
	}
	
	
	public function login()
	{					
		//load model
		$this->load->model('m_Navigasi');
		$this->load->model("m_User");
		$this->load->model("m_Periode");
		
		//code
		if($this->session->userdata('username'))
		{
			redirect(base_url());
		}
		
		$hasil=TRUE;
		if($this->input->post('username'))
		{
			$hasil=$this->m_User->cek_login();
			if ($hasil == TRUE)
			{
				redirect(base_url());
			}
		}

		//muatan data
		$data['hasil']=$hasil;
		$data['periode']=$this->m_Periode->get_aktif();
		$data['hal']="user/login";
		$data['judul']="Halaman login";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
	
	public function ganti_password()
	{
		if(!$this->session->userdata("username"))
		{
			redirect(base_url());
		}
		
		//load model
		$this->load->model('m_Navigasi');
		$this->load->model("m_User");
		
		$hasil="none";
		if($this->input->post('password1'))
		{
			$hasil=$this->m_User->ganti_password();
		}

		//muatan data
		$data['hasil']=$hasil;
		$data['hal']="user/ganti_password";
		$data['judul']="Ganti Password";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());		
	}
}
?>