<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Generate extends CI_Model {
	public function do_generate()
	{
		//validasi
        $this->load->library('form_validation');
		$this->load->database();

        $this->form_validation->set_rules('periode', 'jenis', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('tahun', 'jenis', 'trim|required|max_length[4]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			$tahun=$this->input->post("tahun");
			$periode=$this->input->post("periode");
			$user=$this->session->userdata("username");
			$tgl=date('Y-m-d');
			$ot=$this->session->userdata("username");
			$this->db->where("PERUSAHAAN_STATUS","1");
			
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
					$this->db->or_where("PERUSAHAAN_ID_J","98989898");
				}
				foreach($ot as $o){
					$this->db->or_where("PERUSAHAAN_ID_J",$o->PERUSAHAAN_ID);
				}
				$this->db->group_end();
			}
			
			$jurnal=$this->db->where("TRANSAKSI_STATUS",1)->from("BSPL_DATA_TRANSAKSI t")->join("BSPL_DATA_JURNAL_TRANSAKSI jt","jt.TRANSAKSI_NO=t.TRANSAKSI_NO")->get()->result();
			foreach($jurnal as $j)
			{
				if($j->TRANSAKSI_STATUS==1 AND $j->JURNAL_TRANSAKSI_GN==1){
					$data=array(
						'JENIS_JURNAL_KODE'=>$j->JENIS_JURNAL_KODE,
						'JURNAL_MANUAL_TAHUN'=>$tahun,
						'PERIODE_KODE'=>$periode,
						'TRANSAKSI_NO'=>$j->TRANSAKSI_NO,
						'JURNAL_MANUAL_DES'=>$j->JURNAL_TRANSAKSI_DES,
						'USER_USERNAME'=>$user
						);
						
					$this->db->set('JURNAL_MANUAL_TANGGAL',"to_date('$tgl','yyyy-mm-dd')",false);
					$this->db->insert('BSPL_DATA_JURNAL_MANUAL',$data);
					
					//isi
					$isi=$this->db->where("JURNAL_TRANSAKSI_ID",$j->JURNAL_TRANSAKSI_ID)->get("BSPL_DATA_JURNAL_TRANSAKSID")->result();
					foreach($isi as $i){
						//get last id
						$id=$this->db->limit(1)->order_by("JURNAL_MANUAL_ID","DESC")->get("BSPL_DATA_JURNAL_MANUAL");
						if($id->num_rows()<1){
							$id=1;
						}else{
							$id=$id->row()->JURNAL_MANUAL_ID;
						}
						$data=array(
							'JURNAL_MANUAL_ID'=>$id,
							'COA_KODE'=>$i->COA_KODE,
							'JURNAL_MANUALD_DEBIT'=>$i->JURNAL_TRANSAKSID_DEBIT,
							'JURNAL_MANUALD_KREDIT'=>$i->JURNAL_TRANSAKSID_KREDIT
							);
						$this->db->insert("BSPL_DATA_JURNAL_MANUALD",$data);
					}
					
				}	
			}

			return "berhasil";
		}
	}

}
?>