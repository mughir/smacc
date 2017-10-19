<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_PenyesuaianProd extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;

	public function get_penyesuaian(){
		$this->load->database();
		$this->db->select("p.idorder");
		$this->db->select("p.idjadwal");
		$this->db->select("p.waktu");
		$this->db->select("idbarang");
		$this->db->select("p.status");
		$this->db->select("p.jumlah");
		return $this->db->where("p.status >=",1)->from("penjadwalan p")->join("perintah_prod t","t.idorder=p.idorder")->get()->result();
	}

	public function get_estimasi($id){
		$this->load->database();
		return $this->db->select_sum("cost","total")->where("idjadwal",$id)->from("ambilmat a")->join("isiambilmat i","i.noreq=a.noreq")->get()->row()->total;
	}

	public function get_detail($id){
		$this->load->database();
		$this->db->select("idbarang");
		$this->db->select("p.jumlah");
		$this->db->select("p.idorder");
		$this->db->select("p.idjadwal");
		$this->db->select("p.status");
		return $this->db->where("idjadwal",$id)->from("penjadwalan p")->join("perintah_prod t","t.idorder=p.idorder")->get()->row();
	}
	
	public function get_detail_isi($id){
		$this->load->database();
		return $this->db->where("idjadwal",$id)->from("ambilmat a")->join("isiambilmat i","i.noreq=a.noreq")->get()->result();
	}

	public function sesuaikan(){
		$this->load->database();

		$id=$this->input->post("id");
		$material=$this->input->post("material");
		$foh=$this->input->post("foh");
		$labor=$this->input->post("labor");

		//databarang
		$barang=$this->get_detail($id);

		//Perhitungan
		$tcost=$material+$foh+$labor;
		$cunit=$tcost/$barang->jumlah;

		$data=array(
			"idjadwal"=>$id,
			"idbarang"=>$barang->idbarang,
			"cmaterial"=>$material,
			"clabor"=>$labor,
			"cfoh"=>$foh,
			"jumlah"=>$barang->jumlah,
			"cunit"=>$cunit
		);
		$this->db->insert("penyesuaianprod",$data);
		$this->db->set("status",2)->where("idjadwal",$id)->update("penjadwalan");

		//Update inventory
		$this->load->model("M_barang");
		$this->M_barang->update_barang($barang->idbarang,$barang->jumlah,$tcost);

		return "berhasil";
	}

}
?>