<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Output_pembelian extends CI_Model {
	public function jumlah(){
		$this->load->database();

		$dari=$this->input->post("dari")." 00:00:00";
		$sampai=$this->input->post("sampai")." 23:59:59";
		$order=$this->input->post("sampai");

		if(!$dari || !$sampai || !$order) redirect(base_url("penjualan/laporan"));

		$this->db->where("tgltagihan <=",$sampai);
		$this->db->where("tgltagihan >=",$dari);

		$this->db->order_by($order=="produk" ? "nbarang" : "tsubtotal","ASC");

		$this->db
				->select("nbarang")
				->select_sum("k.jumlah","tjumlah")
				->select_sum("subtotal","tsubtotal")
				->group_by("nbarang");
		$data=$this->db->from("tagihan t")
				->join("isitagihan k","t.idtagihan=k.idtagihan")
				->join("barang b","b.idbarang=k.idbarang")
				->get()->result();

		return($data);
	}
}
?>