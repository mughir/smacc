<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Pesanbeli extends CI_Model {
		public function get_detail($kode)
		{
			$this->load->database();
			$datauser=$this->db->where("idpesan_beli",$kode)->get("pesan_beli");
			return $datauser->row_array();
		}		

		public function get_baris($kode)
		{
			$this->load->database();
			$datauser=$this->db->where("idpesan_beli",$kode)->get("isipesan_beli");
			return $datauser->result_array();
		}

		public function get_harga($kode){
			$this->load->database();
			return $this->db->where('idbarang',$kode)->get("barang")->row();
		}

		public function get_pesanan(){
			$this->load->library("session");
			$awal=$this->session->userdata("periode_dari");
			$sampai=$this->session->userdata("periode_sampai");

			$pesanan=$this->db
					->where("tglpesan <=",$sampai)
					->where("tglpesan >=",$awal)
					->from("pesan_beli p")
					->join("kontak k","k.idkontak=p.idkontak")
					->get()
					->result();

			return $pesanan;
		}
			
	public function tambah_pesanan(){
		//validasi
        $this->load->library('form_validation');
        $this->load->model("m_Serbaguna","ms");

        $this->form_validation->set_rules('id', 'id', 'trim|required|max_length[20]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			//gabung mang
			$id=$this->input->post("id");
			$vendor=$this->input->post("vendor");
			$tanggal=$this->input->post("tanggal");
			$term=$this->input->post("term");
			$pengajuan=$this->input->post("pengajuan");

			$barang=$this->input->post("namabarang");
			$jumlah=$this->input->post("jumlah");

			if($this->ms->cek_ada("pesan_beli","idpesan_beli",$id)==TRUE) return "gagal";
			if(!$pengajuan){
				 $pengajuan=NULL;
			}else{
				if(!$this->ms->cek_ada("pengajuan","idpengajuan",$pengajuan)) return "gagal";
			}

			$cek=0;
			for($i=0;$i<count($barang);$i++){
				if($this->ms->cek_ada("barang","idbarang",$barang[$i])==FALSE) continue;
				$cek++;
			}

			if($cek==0) return "gagal";

			$data=array(
				"idpesan_beli"=>$id,
				"tglpesan"=>$tanggal,
				"idkontak"=>$vendor,
				"stpesan"=>0,
				"idpengajuan"=>$pengajuan,
				"term"=>$term
				);

			$this->db->insert("pesan_beli",$data);

			for($i=0;$i<count($barang);$i++){
				if($this->ms->cek_ada("barang","idbarang",$barang[$i])==FALSE) continue;

				$dbarang=$this->db->where("idbarang",$barang[$i])->get("barang")->row();

				if($this->ms->cek_ada("isipesan_beli",array("idbarang"=>$barang[$i],"idpesan_beli"=>$id))){
					$this->db->where("idbarang",$barang[$i])->where("idpesan_beli",$id)->set("jumlah","jumlah+".$jumlah[$i],false)->set("subtotal","subtotal +".($jumlah[$i]*$dbarang->hjualbarang),false)->update("isipesan_beli");
					continue;
				}

				$data=array(
						"idpesan_beli"=>$id,
						"idbarang"=>$barang[$i],
						"jumlah"=>$jumlah[$i],
						"subtotal"=>$jumlah[$i]*$dbarang->hjualbarang
					);

				$this->db->insert("isipesan_beli",$data);
			}

			return "berhasil";
		}
	}
	
	public function delete_pesanan($kode){
		$id=$kode;
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("pesan_beli","idpesan_beli",$id)==TRUE){
			if($this->db->where("idpesan_beli",$id)->delete("pesan_beli")){
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