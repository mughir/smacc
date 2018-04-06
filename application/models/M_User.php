<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class M_User extends CI_Model {	

	public function __construct()

	{

		parent::__construct();

	}

	

	public $nav;



    public function cek_login()
    {
		//validasi

        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[40]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[40]');

        if($this->form_validation->run() == FALSE){
			return false;
		}
		else{
			//load data
			$username=$this->input->post("username",true);
			$password=md5(md5($this->input->post("password",true)));
			$periode=$this->input->post("periode",true);

			$this->load->database();
			$su=$this->db->where('username',$username)->where('password',$password)->get('user');
			$pr=$this->db->where('kperiode',$periode)->where("status",1)->get("periode");

			if($su->num_rows()>0){
				if($pr->num_rows()>0) $this->session->set_userdata('periode_dari',$pr->row()->dperiode);
				if($pr->num_rows()>0) $this->session->set_userdata('periode_sampai',$pr->row()->speriode);
				$this->session->set_userdata('username',$su->row()->username);
				$this->session->set_userdata('nama',$su->row()->nuser);
				$this->session->set_userdata('role',$su->row()->idrole);
				return true;
			}
			else{
				return false;
			}
		}
    }

	public function ganti_password()
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('passwordlama', 'Password lama', 'trim|required|max_length[40]');
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|max_length[40]');
		$this->form_validation->set_rules('password2', 'Password', 'trim|required|max_length[40]');


        if($this->form_validation->run() == FALSE){
			return false;
		}
		else{
			//load data
			$username=$this->session->userdata("username");
			$passwordlama=md5(md5($this->input->post("passwordlama",true)));
			$password1=md5(md5($this->input->post("password1",true)));
			$password2=md5(md5($this->input->post("password2",true)));

			$this->load->database();

			$su=$this->db->where('username',$username)->where('password',$passwordlama)->get('user');

			if($su->num_rows()>0 AND $password1==$password2){

				$this->db->set("password",$password1);

				$this->db->where("username",$username)->update("user");

				return "benar";
			}

			else{

				return "salah";
			}
		}
    }

	public function get_user()
	{
		$this->load->database();
		$datauser=$this->db->get("user")->result();
		return $datauser;
	}

	

	public function get_detail($kode=1)
	{
		$this->load->database();

		$this->db->select("username");
		$this->db->select("nuser");
		$this->db->select("suser");
		$this->db->select("idrole");

		$datauser=$this->db->where("username",$kode)->get("user");

		return $datauser->row_array();
	}

	
	public function tambah_user()
    {

		//validasi
        $this->load->library('form_validation');


        $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[40]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[40]');
		$this->form_validation->set_rules('nama', 'Password', 'trim|required|max_length[40]');
		$this->form_validation->set_rules('role', 'Role', 'trim|required');
		

		 if($this->form_validation->run() == FALSE){

			return "gagal";
		}

		else{
			//load data
			$data=array(
			"username"=>$this->input->post("username",true),
			"password"=>md5(md5($this->input->post("password",true))),
			"nuser"=>$this->input->post("nama"),
			"suser"=>1,
			"idrole"=>$this->input->post("role")
			);

			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ganda("USER","username",$data["username"])==TRUE){

				if($this->db->insert("USER",$data)){
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

	

	public function edit_user($kode)

    {

		//validasi

        $this->load->library('form_validation');



        $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[40]');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[40]');
		$this->form_validation->set_rules('status', 'Status User', 'trim|required|numeric');

		

		 if($this->form_validation->run() == FALSE){

			return "gagal";

		}

		else{

			

			//load data

			$username=$this->input->post("username");

			$data=array(

			"nuser"=>$this->input->post("nama"),

			"suser"=>$this->input->post("status")

			);

		

			$this->load->database();

			$this->load->model('m_Serbaguna','ms');

			if($this->ms->cek_ada("user","username",$username)==TRUE){

				if($this->db->where("username",$username)->update("USER",$data)){

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

	

	public function delete_user($kode)

    {

		//load data

		$username=$kode;

		

		$this->load->database();

		$this->load->model('m_Serbaguna','ms');

		if($this->ms->cek_ada("user","username",$username)==TRUE and $username!="admin"){

			if($this->db->where("username",$username)->delete("user")){

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