<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Output_penjualan extends CI_Model {
	public function jumlah(){
		$this->load->database();

		$dari=$this->input->post("dari")." 00:00:00";
		$sampai=$this->input->post("sampai")." 23:59:59";
		$order=$this->input->post("sampai");
		$filter=$this->input->post("filter");
		$isifilter=$this->input->post("isifilter");

		if(!$dari || !$sampai || !$order) redirect(base_url("penjualan/laporan"));

		switch($filter){
			case 2:
				$this->db->where("segment1",$isifilter);
			break;
			case 3:
				$this->db->where("segment2",$isifilter);
			break;
			case 4:
				$this->db->where("segment3",$isifilter);
			break;
		}

		$this->db->where("tkwitansi <=",$sampai);
		$this->db->where("tkwitansi >=",$dari);

		$this->db->order_by($order=="produk" ? "nbarang" : "tsubtotal","ASC");

		$this->db
				->select("nbarang")
				->select_sum("k.jumlah","tjumlah")
				->select_sum("subtotal","tsubtotal")
				->group_by("nbarang");
		$data=$this->db->from("kwitansi t")
				->join("isikwitansi k","t.idkwitansi=k.idkwitansi")
				->join("barang b","b.idbarang=k.idbarang")
				->get()->result();

		return($data);
	}
}
?>