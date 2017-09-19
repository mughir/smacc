<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Output extends CI_Model {
		public function get_Jurnal()
		{
			
			$jurnal="";
			$no=1;

			if(!$this->input->post("tahun")=="")
			{
				$this->db->where("JURNAL_TAHUN",$this->input->post("tahun"));
			}
			
			if(!$this->input->post("periode")=="")
			{
				$this->db->where("p.PERIODE_KODE",$this->input->post("periode"));
			}

			if(!$this->input->post("jual")=="all")
			{
				$this->db->where("bt.PERUSAHAAN_ID_J",$this->input->post("jual"));
			}
			if(!$this->input->post("beli")=="all")
			{
				$this->db->where("bt.PERUSAHAAN_ID_B",$this->input->post("beli"));
			}
			
			
			if(!$this->input->post("jenis")=="all")
			{
				$this->db->where("bj.JENIS_JURNAL_KODE",$this->input->post("jenis"));
			}
			
		
			switch($this->input->post("grup"))
			{
				case "jenis":
				$this->db->order_by("bj.JENIS_JURNAL_KODE");
				break;				
				case "jual":
				$this->db->order_by("PERUSAHAAN_ID_J");
				break;				
				case "beli":
				$this->db->order_by("PERUSAHAAN_ID_B");
				break;				
				case "akun":
				$this->db->order_by("COA_KODE");
				break;
			}
			
			$jurnal=$this->db
				->select("JENIS_JURNAL_NAMA||' '||PERIODE_NAMA||'-'||JURNAL_TAHUN as KODE",false)
				->select("'RCP' as rcp",false)
				->select("BISNISAREA_ID_J as Cocp",false)
				->select("PERUSAHAAN_ID_B as CocpLawan",false)
				->select("BISNISAREA_ID_B as BaTP",false)
				->select("'SEG001' as SEGMENT",false)
				->select("'1000' as COA",false)
				->select("COA_KODE as LACCOUNT",false)
				->select("'10' as CURTYPE",false)
				->select("'1' as Version",false)
				->select('"p"."PERIODE_KODE" as Period',false)
				->select('JURNAL_TAHUN as YEAR',false)
				->select("'IDR' as CURR",false)
				->select('(JURNALD_DEBIT-JURNALD_KREDIT) as YTD_Balance',false)
				->select('JURNAL_DES as Keterangan',false)
			
				->from("BSPL_DATA_JURNAL bj")
				->join("BSPL_DATA_JURNALD jd","jd.JURNAL_ID=bj.JURNAL_ID")
				->join("BSPL_DATA_TRANSAKSI bt","bt.TRANSAKSI_NO=bj.TRANSAKSI_NO","left")
				->join("BSPL_DATA_JENIS_JURNAL bjt","bjt.JENIS_JURNAL_KODE=bj.JENIS_JURNAL_KODE","left")
				->join("BSPL_DATA_PERIODE p","p.PERIODE_KODE=bj.PERIODE_KODE","left")
				->get()
				->result_array();
			
			return $jurnal;
		}
}
?>