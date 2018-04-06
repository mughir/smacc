<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_rnd extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;
	
	public function get_barang()
	{
		$this->load->database();
		$this->db->order_by("barangrnd.idbarang","ASC");
		$datauser=$this->db->from("barangrnd")->join("barang","barang.idbarang=barangrnd.idbarang")->get()->result();
		return $datauser;
	}

	public function get_material()
	{
		$this->load->database();
		$this->db->order_by("idbarang","ASC");
		$this->db->where("katbarang","Material");
		$datauser=$this->db->get("barang")->result();
		return $datauser;
	}
	
	public function get_detail($kode=1)
	{
		$this->load->database();
		$datauser=$this->db
			->where("r.idbarang",$kode)
			->from("barangrnd r")
			->join("barang b","b.idbarang=r.idbarang")
			->get()
			;
		return $datauser->row_array();
	}

	public function get_detail_material($kode=1)
	{
		$this->load->database();
		$datauser=$this->db
			->select("idbarang_mat")
			->select("nbarang")
			->select("r.jumlah")
			->where("idbarang_rnd",$kode)
			->from("matrnd r")
			->join("barang b","b.idbarang=r.idbarang_mat")
			->get()
			;
		return $datauser->result();
	}

	public function get_detail_operasi($kode=1)
	{
		$this->load->database();
		$datauser=$this->db
			->where("idbarang",$kode)
			->get("listoperasirnd")
			;
		return $datauser->result();
	}
	
	public function tambah_rnd()
    {
			$id=$this->input->post("id");
			$material=$this->input->post("namabarang");
			$jumlah=$this->input->post("jumlah");
			$operasi=$this->input->post("namaoperasi");
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ganda("barangrnd","idbarang",$id)==TRUE){			
				$data=array(
					"idbarang"=>$id,
					"srnd"=>1
				);
				if($this->db->insert("barangrnd",$data)){
					//Input material
					for($i=0;$i<count($material);$i++){
						$data=array(
							"idbarang_rnd"=>$id,
							"idbarang_mat"=>$material[$i],
							"jumlah"=>$jumlah[$i],
						);
						$this->db->insert("matrnd",$data);
					}

					//Input operasi
					for($i=0;$i<count($operasi);$i++){
						$data=array(
							"idbarang"=>$id,
							"namaoperasi"=>$operasi[$i]
						);
						$this->db->insert("listoperasirnd",$data);
					}
					return "berhasil";
				}
				else{
					return "gagal";
				}
			}
	}
	
	public function edit_rnd()
    {
			$id=$this->input->post("id");
			$material=$this->input->post("namabarang");
			$jumlah=$this->input->post("jumlah");
			$operasi=$this->input->post("namaoperasi");
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');		
				$data=array(
					"srnd"=>1
				);
				if($this->db->where("idbarang",$id)->update("barangrnd",$data)){
					//Input material
					$this->db->where("idbarang_rnd",$id)->delete("matrnd");
					for($i=0;$i<count($material);$i++){
						$data=array(
							"idbarang_rnd"=>$id,
							"idbarang_mat"=>$material[$i],
							"jumlah"=>$jumlah[$i],
						);
						$this->db->insert("matrnd",$data);
					}

					//Input operasi
					$this->db->where("idbarang",$id)->delete("listoperasirnd");
					for($i=0;$i<count($operasi);$i++){
						$data=array(
							"idbarang"=>$id,
							"namaoperasi"=>$operasi[$i]
						);
						$this->db->insert("listoperasirnd",$data);
					}
					return "berhasil";
				}
				else{
					return "gagal";
				}
	}
	
	public function delete_rnd($kode)
    {
		//load data
		$id=$kode;
		
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("barangrnd","idbarang",$id)==TRUE){
			$this->db->where("idbarang_rnd",$id)->delete("matrnd");
			$this->db->where("idbarang",$id)->delete("listoperasirnd");
			if($this->db->where("idbarang",$id)->delete("barangrnd")){
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