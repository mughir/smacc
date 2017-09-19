<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Penagihan extends CI_Model {
		public function get_detail($kode)
		{
			$this->load->database();
			$datauser=$this->db->where("idkwitansi",$kode)->get("kwitansi");
			return $datauser->row_array();
		}		

		public function get_baris($kode)
		{
			$this->load->database();
			$datauser=$this->db->where("idkwitansi",$kode)->get("isikwitansi");
			return $datauser->result_array();
		}

		public function get_harga($kode){
			$this->load->database();
			return $this->db->where('idbarang',$kode)->get("barang")->row();
		}

		public function get_penagihan(){
			$this->load->library("session");
			$awal=$this->session->userdata("periode_dari");
			$sampai=$this->session->userdata("periode_sampai");

			$kwitansi=$this->db
					->where("tkwitansi <=",$sampai)
					->where("tkwitansi >=",$awal)
					->from("kwitansi p")
					->join("kontak k","k.idkontak=p.idkontak")
					->get()
					->result();

			return $kwitansi;
		}
			
	public function tambah_penagihan()
    {
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
			$pemesan=$this->input->post("pemesan");
			$tanggal=$this->input->post("tanggal");
			$term=$this->input->post("term");
			$beban=$this->input->post("beban");
			$dp=$this->input->post("dp");

			$barang=$this->input->post("namabarang");
			$jumlah=$this->input->post("jumlah");

			if($this->ms->cek_ada("kwitansi","idkwitansi",$id)==TRUE) return "gagal";

			$cek=0;
			for($i=0;$i<count($barang);$i++){
				if($this->ms->cek_ada("barang","idbarang",$barang[$i])==FALSE) continue;
				$cek++;
			}

			if($cek==0) return "gagal";

			$data=array(
				"idkwitansi"=>$id,
				"tkwitansi"=>$tanggal,
				"idkontak"=>$pemesan,
				"stkwitansi"=>0,
				"dp"=>$dp,
				"bpengiriman"=>$beban,
				"termpengiriman"=>$term
				);

			$this->db->insert("kwitansi",$data);

			for($i=0;$i<count($barang);$i++){
				if($this->ms->cek_ada("barang","idbarang",$barang[$i])==FALSE) continue;

				$dbarang=$this->db->where("idbarang",$barang[$i])->get("barang")->row();

				if($this->ms->cek_ada("isikwitansi",array("idbarang"=>$barang[$i],"idkwitansi"=>$id))){
					$this->db->where("idbarang",$barang[$i])->where("idkwitansi",$id)->set("jumlah","jumlah+".$jumlah[$i],false)->set("subtotal","subtotal +".($jumlah[$i]*$dbarang->hjualbarang),false)->update("isikwitansi");
					continue;
				}

				$data=array(
						"idkwitansi"=>$id,
						"idbarang"=>$barang[$i],
						"jumlah"=>$jumlah[$i],
						"subtotal"=>$jumlah[$i]*$dbarang->hjualbarang
					);

				$this->db->insert("isikwitansi",$data);
			}

			return "berhasil";
		}
	}

	public function delete_penagihan($kode){
		$id=$kode;
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("pesanan","idkwitansi",$id)==TRUE){
			if($this->db->where("idkwitansi",$id)->delete("pesanan")){
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