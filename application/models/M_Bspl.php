<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Bspl extends CI_Model {
	
		public $nav;

        public function pagination($num,$per_page)
        {
			$this->load->database();
			$this->load->library('pagination');
			
			
			$config['base_url'] = base_url()."transaksi/bspl/";
			$config['uri_segment'] = 3;
			
			
			$ot=$this->session->userdata("username");
			$this->db->where("PERUSAHAAN_STATUS","1");
			$ot=$this->db->where("USER_USERNAME",$ot)->from("BSPL_DATA_ROLE")->join("BSPL_DATA_PERUSAHAAN","BSPL_DATA_PERUSAHAAN.PERUSAHAAN_ID=BSPL_DATA_ROLE.PERUSAHAAN_ID")->get();
			$co=$ot->num_rows();
			$ot=$ot->result();
			
			if($this->session->userdata("username")!="admin"){
				$c=0;
				$this->db->group_start();
				if($co==0)
				{
					$this->db->or_where("PERUSAHAAN_ID","9898");
				}
				foreach($ot as $o){
					$this->db->or_where("PERUSAHAAN_ID",$o->PERUSAHAAN_ID);
				}
				$this->db->group_end();
			}
			
			$config['total_rows'] = $this->db->from('BSPL_DATA_TRANSAKSI')->join("BSPL_DATA_PERUSAHAAN","BSPL_DATA_PERUSAHAAN.PERUSAHAAN_ID=BSPL_DATA_TRANSAKSI.PERUSAHAAN_ID_J")->get()->num_rows();
			$config['per_page'] = $per_page;
			$config['first_url'] = 1;
			$config['use_page_numbers'] = TRUE;
			$this->pagination->initialize($config);
			$pagi=$this->pagination->create_links();
			return $pagi;
        }
		
		public function get_data($num,$per_page){
			$ot=$this->session->userdata("username");
			$this->db->where("PERUSAHAAN_STATUS","1");
			$ot=$this->db->where("USER_USERNAME",$ot)->from("BSPL_DATA_ROLE")->join("BSPL_DATA_PERUSAHAAN","BSPL_DATA_PERUSAHAAN.PERUSAHAAN_ID=BSPL_DATA_ROLE.PERUSAHAAN_ID")->get();
			
			$co=$ot->num_rows();
			$ot=$ot->result();
			
			if($this->session->userdata("username")!="admin"){
				$c=0;
				$this->db->group_start();
				if($co==0)
				{
					$this->db->or_where("PERUSAHAAN_ID_J","9898");
				}
				foreach($ot as $o){
					$this->db->or_where("PERUSAHAAN_ID_J",$o->PERUSAHAAN_ID);
				}
				$this->db->group_end();
			}
			
			$this->db->order_by('TRANSAKSI_NO','desc');
			$this->db->limit($per_page,($num-1)*$per_page);
			$this->db->select("TRANSAKSI_NO");
			$this->db->select("TRANSAKSI_TGL");
			$this->db->select("TRANSAKSI_JENIS");
			$this->db->select("TRANSAKSI_STATUS");
			$this->db->select("TRANSAKSI_DES");
			$this->db->select("j.PERUSAHAAN_NAMA as PENJUAL");
			$this->db->select("p.PERUSAHAAN_NAMA as PEMBELI");
			
			$data=$this->db
				->from('BSPL_DATA_TRANSAKSI b')
				->join("BSPL_DATA_PERUSAHAAN j","b.PERUSAHAAN_ID_J=j.PERUSAHAAN_ID","left")
				->join("BSPL_DATA_PERUSAHAAN p","b.PERUSAHAAN_ID_B=p.PERUSAHAAN_ID","left")
				->get()->result();
			return $data;
		}
		
		public function get_lastnum()
		{
			$cek=$this->db->get('BSPL_DATA_TRANSAKSI')->num_rows();
			if($cek==0){
				return 1;
			}else{
				$last=$this->db->limit(1)->order_by('TRANSAKSI_NO',"DESC")->get('BSPL_DATA_TRANSAKSI')->row()->TRANSAKSI_NO;
				$last=$last+1;
				return $last;
			}
		}
		
		public function get_detail($kode=1)
		{
			$this->load->database();
			$datauser=$this->db->where("TRANSAKSI_NO",$kode)->get("BSPL_DATA_TRANSAKSI");
			return $datauser->row_array();
		}
			
		public function get_perusahaan()
		{
			$this->load->database();
			$this->load->library('session');
			
			$this->db->where("PERUSAHAAN_STATUS","1");		
			$this->db->order_by("PERUSAHAAN_ID","ASC");
			$datauser=$this->db->get("BSPL_DATA_PERUSAHAAN")->result();
			return $datauser;
		}
		
	public function tambah_bspl()
    {
		$this->load->database();
		
		//validasi
        $this->load->library('form_validation');

		$this->form_validation->set_rules('jenis', 'Jenis Transaksi', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required|max_length[4]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			
			//load data
			$periode=$this->input->post("periode");
			$tahun=$this->input->post("tahun",true);
			//get months
			$bulan=$this->db->where("PERIODE_KODE",$periode)->get("BSPL_DATA_PERIODE")->row()->PERIODE_SAMPAI;
			$tgl="$tahun-$bulan-1";
			$tgl=date("Y-m-t", strtotime($tgl));
			
			$data=array(
			"TRANSAKSI_NO"=>'',
			"TRANSAKSI_JENIS"=>$this->input->post("jenis"),
			"PERIODE_KODE"=>$periode,
			"TRANSAKSI_TAHUN"=>$tahun,
			"TRANSAKSI_DES"=>$this->input->post("des"),
			"PERUSAHAAN_ID_J"=>$this->input->post("jual"),
			"PERUSAHAAN_ID_B"=>$this->input->post("beli"),
			"USER_USERNAME"=>$this->session->userdata("username"),
			"TRANSAKSI_STATUS"=>1
			);
		
			
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ganda("BSPL_DATA_TRANSAKSI","TRANSAKSI_NO",$data["TRANSAKSI_NO"])==TRUE){
				$this->db->set('TRANSAKSI_TGL',"to_date('$tgl','yyyy-mm-dd')",false);
				if($this->db->insert("BSPL_DATA_TRANSAKSI",$data)){
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
	
	public function edit_bspl($kode)
    {
		$this->load->database();
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('no', 'No', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('jenis', 'Jenis Transaksi', 'trim|required|max_length[20]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			
			//load data			
			$periode=$this->input->post("periode");
			$tahun=$this->input->post("tahun",true);
			//get months
			$bulan=$this->db->where("PERIODE_KODE",$periode)->get("BSPL_DATA_PERIODE")->row()->PERIODE_SAMPAI;
			$tgl="$tahun-$bulan-1";
			$tgl=date("Y-m-t", strtotime($tgl));
			$id=$this->input->post("no");
			
			$data=array(
			"TRANSAKSI_JENIS"=>$this->input->post("jenis"),
			"PERIODE_KODE"=>$periode,
			"TRANSAKSI_TAHUN"=>$tahun,
			"TRANSAKSI_DES"=>$this->input->post("des"),
			"PERUSAHAAN_ID_J"=>$this->input->post("jual"),
			"PERUSAHAAN_ID_B"=>$this->input->post("beli"),
			"USER_USERNAME"=>$this->session->userdata("username"),
			"TRANSAKSI_STATUS"=>$this->input->post("status")
			);
		
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ada("BSPL_DATA_TRANSAKSI","TRANSAKSI_NO",$id)==TRUE){
				$this->db->set('TRANSAKSI_TGL',"to_date('$tgl','yyyy-mm-dd')",false);
				if($this->db->where("TRANSAKSI_NO",$id)->update("BSPL_DATA_TRANSAKSI",$data)){
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
	
	public function delete_bspl($kode)
    {
		//load data
		$id=$kode;
		
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("BSPL_DATA_TRANSAKSI","TRANSAKSI_NO",$id)==TRUE){
			if($this->db->where("TRANSAKSI_NO",$id)->delete("BSPL_DATA_TRANSAKSI")){
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