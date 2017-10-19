<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Output_produksi extends CI_Model {
	public function jumlah(){
		$this->load->database();

		$dari=$this->input->post("dari")." 00:00:00";
		$sampai=$this->input->post("sampai")." 23:59:59";
		$order=$this->input->post("sampai");

		if(!$dari || !$sampai || !$order) redirect(base_url("penjualan/laporan"));

		$this->db->where("waktu <=",$sampai);
		$this->db->where("waktu >=",$dari);

		$this->db
				->select("nbarang")
				->select("j.waktu")
				->select("s.cmaterial")
				->select("s.clabor")
				->select("s.cfoh");
		$data=$this->db->from("penyesuaianprod s")
				->join("penjadwalan j","s.idjadwal=j.idjadwal")
				->join("perintah_prod h","h.idorder=j.idorder")
				->join("barang b","b.idbarang=h.idbarang")
				->get()->result();

		return($data);
	}
}
?>