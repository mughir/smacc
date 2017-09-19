<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Lihat_jurnal extends CI_Model {
        public function pagination($num,$per_page)
        {
			$this->load->database();
			$this->load->library('pagination');
			
			
			$config['base_url'] = base_url()."transaksi/lihat_jurnal/";
			$config['uri_segment'] = 3;
			
			$config['total_rows'] = $this->db->get("BSPL_DATA_JURNAL")->num_rows();
			$config['per_page'] = $per_page;
			$config['first_url'] = 1;
			$config['use_page_numbers'] = TRUE;
			$this->pagination->initialize($config);
			$pagi=$this->pagination->create_links();
			return $pagi;
        }
		
		public function get_dataJurnal($num,$per_page)
		{
			$this->load->database();
			
			$jurnal="";
			$no=1;
			
			$this->db->order_by("JURNAL_ID","DESC");
			$this->db->limit($per_page,($num-1)*$per_page);
			$dh=$this->db
				->from("BSPL_DATA_JURNAL l")
				->join("BSPL_DATA_JENIS_JURNAL s","s.JENIS_JURNAL_KODE=l.JENIS_JURNAL_KODE","left")
				->join("BSPL_DATA_TRANSAKSI b","b.TRANSAKSI_NO=l.TRANSAKSI_NO","left")
				
				->join("BSPL_DATA_PERUSAHAAN j","b.PERUSAHAAN_ID_J=j.PERUSAHAAN_ID","left")
				->join("BSPL_DATA_PERUSAHAAN p","b.PERUSAHAAN_ID_B=p.PERUSAHAAN_ID","left")
				->get()->result();
			foreach($dh as $d)
			{
				$jurnal.="<div class='juduljurnal'><b>#$d->JURNAL_ID $d->JENIS_JURNAL_NAMA $d->PERIODE_KODE $d->JURNAL_TAHUN | $d->JURNAL_DES ";
				if($d->TRANSAKSI_NO)
				{
				$jurnal.="| Transaksi no:$d->TRANSAKSI_NO | CoCd J: $d->PERUSAHAAN_ID_J BA: $d->BISNISAREA_ID_J | CoCd B: $d->PERUSAHAAN_ID_B $d->BISNISAREA_ID_B";
				}
				$jurnal.="</b>";
				$jurnal.="</div>";
				$jurnal.="<table class='table jurnal'>";
				$jurnal.="<tr><th>Nama</th><th>Debit</th><th>Kredit</th></tr>";
				$this->db->select("c.COA_KODE");
				$this->db->select("COA_NAMA"); 
				$this->db->select("JURNALD_DEBIT");
				$this->db->select("JURNALD_KREDIT");
				$this->db->select("(JURNALD_DEBIT-JURNALD_KREDIT) as NILAI",false);
				$do=$this->db->order_by('NILAI','DESC')->where('JURNAL_ID',$d->JURNAL_ID)->from("BSPL_DATA_JURNALD d")->join("BSPL_DATA_COA c","c.COA_KODE=d.COA_KODE")->get()->result();
				foreach($do as $k){
					$jurnal.="<tr><td>";
					if($k->NILAI <0){
						$jurnal.="<span class='kredit'></span>";
					}
					$jurnal.= "$k->COA_KODE - $k->COA_NAMA</td><td>$k->JURNALD_DEBIT</td><td>$k->JURNALD_KREDIT</td></tr>";
				}
				$jurnal.="</table><br>";
				$no++;
			}
			
			return $jurnal;
		}
		

}
?>