<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akuntansi extends CI_Controller {
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
		$data['hal']="akuntansi/utama";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	public function prosesjurnal(){
		//load model
		$this->load->model('m_Navigasi');
		$this->load->model('m_proses_jurnal');
		
		//code
		if($this->input->get("proses")=="jurnal"){
			$hasil="gagal";
			$hasil=$this->m_proses_jurnal->proses();
			$this->session->set_flashdata("hasil",$hasil);
		}
		
		//muatan data
		$data['hal']="akuntansi/prosesjurnal";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}


	public function jurnalmanual(){

		//load model
		$this->load->model('m_Navigasi');
		$this->load->model('m_Jurnal_manual','mj');
		$this->load->model('m_Akun');
		$this->load->model('m_Periode');
		
		//muatan data
		$data['jurnal']=$this->mj->get_dataJurnal();
		$data['coa']=$this->m_Akun->get_akun();

		
		$data['hal']="akuntansi/jurnalmanual";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
	
	public function jurnalmanual_ajax($kode=1){
		
		$this->load->model('m_Jurnal_manual','mj');
		echo json_encode($this->mj->get_detail($kode));
	}

	public function jurnalmanual_detail_ajax($kode=1){
		
		$this->load->model('m_Jurnal_manual','mj');
		echo json_encode($this->mj->get_detail_jurnal($kode));
	}
	
	public function jurnalmanual_proses($kode=0,$kode1=0){
		$this->load->library('user_agent');
		$this->load->model('m_Jurnal_manual','mj');
		
		$hasil="gagal";
		switch($kode){
			case "tambah":
				$hasil=$this->mj->tambah_jurnal();
			break;
			case "update":
				$hasil=$this->mj->edit_jurnal($kode1);
			break;
			case "delete":
				$hasil=$this->mj->delete_jurnal($kode1);
			break;			
			case "post":
				$hasil=$this->mj->post_jurnal($kode1);
			break;			
			case "clear":
				$hasil=$this->mj->clear_jurnal();
			break;
			default:
			show_404();
		}
		
		$this->session->set_flashdata("hasil",$hasil);
		redirect($this->agent->referrer());
	}

	public function bukubesar(){
		//load model
		$this->load->model('m_Navigasi');
		$this->load->model('m_Akun');

		//muatan data
		$data['hal']="akuntansi/bukubesar";
		$data["user"]=$this->m_Akun->get_Akun();
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	public function isibukubesar(){
		$this->load->model('m_Navigasi');
		$this->load->model("m_Bukubesar");

		$data["akun"]=$this->input->post("akun");

		//muatan data
		$data['hal']="akuntansi/isibukubesar";
		$data["bukubesar"]=$this->m_Bukubesar->get_bukubesar();
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}


	public function tutupbuku(){
		//load model
		$this->load->model('m_Navigasi');
		$this->load->model('m_Periode');
		$this->load->database();
		
		//code
		if($this->input->get("proses")=="tutup"){
			$username=$this->session->userdata("username");
			$pass1=$this->input->post("password1");
			$pass2=$this->input->post("password2");
			$target=$this->input->post("periode");
			$dari=$this->session->userdata("periode_dari");
			$sampai=$this->session->userdata("periode_sampai");

			if($pass1!=$pass2) {$hasil="gagal";}else{
				if($this->db->where("password",md5(md5($pass1)))->where("username",$username)->get("user")->num_rows()<1) {$hasil="gagal";} else{
					$tp=$this->db->where("kperiode",$target)->get("periode")->row();
					$td=$tp->dperiode;
					$ts=$tp->speriode;

					$akun=$this->db->where("lakun",2)->where("noakun <",40000)->get("coa")->result();
					foreach($akun as $a){
						$debit=0;
						$kredit=0;

						$balance=$this->db
							->where("tjurnal <=",$sampai)
							->where("tjurnal >=",$dari)
							->where("noakun",$a->noakun)
							->select("sum(debit-kredit) as balance",false)
							->from("jurnal j")
							->join("djurnal d","d.kjurnal=j.kjurnal")
							->get()->row()->balance;

						if($a->noakun==32000){
							$balance+=$this->db
							->where("tjurnal <=",$sampai)
							->where("tjurnal >=",$dari)
							->where("noakun >",40000)
							->select("sum(debit-kredit) as balance",false)
							->from("jurnal j")
							->join("djurnal d","d.kjurnal=j.kjurnal")
							->get()->row()->balance;
						}

						if($balance==0) continue;

						if($balance<0) $kredit=$balance*-1;
						if($balance>0) $debit=$balance;

						$data=array(
							"njurnal"=>"balance awal",
							"tjurnal"=>$td,
							"sref"=>"periode",
							"kref"=>"$sampai"
						);
						$this->db->insert("jurnal",$data);
						$id=$this->db->insert_id();
						$data=array(
							"kjurnal"=>$id,
							"noakun"=>$a->noakun,
							"debit"=>$debit,
							"kredit"=>$kredit
						);

						$this->db->insert("djurnal",$data);
					}
					$hasil="berhasil";
				}
			}

			$this->session->set_flashdata("hasil",$hasil);
		}
		
		//muatan data
		$data['periode']=$this->m_Periode->get_periode();
		$data['hal']="akuntansi/tutupbuku";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	public function laporan(){
		//load model
		$this->load->model('m_Navigasi');
		
		//code
		
		//muatan data
		if($this->input->get("proses")=="laporan"){
			switch($this->input->post("jenis")){
				case "neraca":
					$data['hal']="akuntansi/neraca";
				break;
				case "labarugi":
					$data['hal']="akuntansi/labarugi";
				break;
				default:
					$data['hal']="akuntansi/laporan";
				break;
			}
		}else{
			$data['hal']="akuntansi/laporan";
		}
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
}
