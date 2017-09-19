<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Output_pos extends CI_Model {
	public function jumlah(){
		$this->load->database();

		$dari=$this->input->post("dari")." 00:00:00";
		$sampai=$this->input->post("sampai")." 23:59:59";
		$order=$this->input->post("order");

		if(!$dari || !$sampai || !$order) redirect(base_url("pos/laporan"));

		$this->db->where("wtranspos <=",$sampai);
		$this->db->where("wtranspos >=",$dari);

		$this->db->order_by($order=="produk" ? "nbarang" : "tsubtotal","ASC");

		$this->db
				->select("nbarang")
				->select_sum("k.jumlah","tjumlah")
				->select_sum("subtotal","tsubtotal")
				->select_sum("discount","tdiskon")
				->group_by("nbarang");
		$data=$this->db->from("transpos t")
				->join("keranjangpos k","t.idtranspos=k.idtranspos")
				->join("barang b","b.idbarang=k.idbarang")
				->get()->result();

		return($data);
	}
}
?>