<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Pengambilan extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;

	public function get_pengambilan(){
		$this->load->database();
		return $this->db->from("ambilmat j")->join("penjadwalan p","p.idjadwal=j.idjadwal")->get()->result();
	}

	public function get_detail($id){
		$this->load->database();
		return $this->db->where("noreq",$id)->get("ambilmat")->row();
	}
	
	public function get_detail_isi($id){
		$this->load->database();
		return $this->db->where("noreq",$id)->get("isiambilmat")->result();
	}

	public function tambah_pengambilan()
    {
			$batch=$this->input->post("batch");
			$waktu=$this->input->post("tanggal");
			$req=$this->input->post("req");
			$material=$this->input->post("namamaterial");
			$jumlah=$this->input->post("jumlah");
		
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');		
				$data=array(
					"noreq"=>$req,
					"waktu"=>$waktu,
					"idjadwal"=>$batch
				);
				if($this->db->insert("ambilmat",$data)){
					for($i=0;$i<count($material);$i++){
						//hitung cost
						$cost=$this->db->where("idbarang",$material[$i])->get("barang")->row()->cbarang;
						$data=array(
							"noreq"=>$req,
							"idbarang"=>$material[$i],
							"jumlah"=>$jumlah[$i],
							"cost"=>$cost*$jumlah[$i]
						);
						$this->db->insert("isiambilmat",$data);

						//Update
						$this->db->where("idbarang",$material[$i])->set("jumlah","jumlah-".$jumlah[$i])->update("barang");
					}
					return "berhasil";
				}
				else{
					return "gagal";
				}
	}

	public function delete_pengambilan($kode)
    {
		//load data
		$id=$kode;
		
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("ambilmat","idreq",$id)==TRUE){
			if($this->db->where("idreq",$id)->delete("ambilmat")){
				$this->db->where("idreq",$id)->delete("isiambilmat");
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