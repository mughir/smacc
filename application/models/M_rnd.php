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
			->where("idbarang",$kode)
			->get("barangrnd")
			;
		return $datauser->row_array();
	}

	public function get_detail_material($kode=1)
	{
		$this->load->database();
		$datauser=$this->db
			->where("idbarang_rnd",$kode)
			->get("matrnd")
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
	
	public function edit_barang($kode)
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'ID', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('nama', 'Nama barang', 'trim|required|max_length[40]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			
			//load data			
			$id=$this->input->post("id");
			$data=array(
				"katbarang"=>$this->input->post("kategori",true),
				"nbarang"=>$this->input->post("nama",true),
				"satbarang"=>$this->input->post("satuan",true),
				"jumlah"=>$this->input->post("jumlah",true),
				"cbarang"=>$this->input->post("biaya",true),
				"hjualbarang"=>$this->input->post("harga",true),
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ada("barang","idbarang",$id)==TRUE){
				if($this->db->where("idbarang",$id)->update("barang",$data)){
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