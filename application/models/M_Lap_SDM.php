<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Lap_SDM extends CI_Model {
	public function get_laporan(){
		$this->load->database();

		$tahun=$this->input->post("tahun");

		$dgaji=$this->db
			->select_sum("gaji","tgaji")
			->select_sum("pajak","tpajak")
			->select("idpegawai")
			->group_by("idpegawai")
			->where("tahun",$tahun)
			->get("gaji")->result();

		return $dgaji;
	}
}
?>