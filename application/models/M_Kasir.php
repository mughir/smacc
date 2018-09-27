<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Kasir extends CI_Model {
		public function get_barang(){
			$this->load->database();
			$this->db->order_by("barangkasir.idbarang","ASC");
			$datauser=$this->db->from("barangkasir")->join("barang","barang.idbarang=barangkasir.idbarang")->get()->result();
			return $datauser;
		}

		public function get_detail($kode)
		{
			$this->load->database();
			$datauser=$this->db->where("idtranspos",$kode)->get("transpos");
			return $datauser->row_array();
		}	

		public function get_isi_detail($kode){
			$this->load->database();
			$this->db
				->select("k.jumlah")
				->select("subtotal")
				->select("nbarang");
			$datauser=$this->db->where("idtranspos",$kode)->from("keranjangpos k")->join("barang b","b.idbarang=k.idbarang")->get();
			return $datauser->result();
		}

		public function get_baris($kode)
		{
			$this->load->database();
			$datauser=$this->db->where("idpesanan",$kode)->get("barispesanan");
			return $datauser->result_array();
		}

		public function get_harga($kode){
			$this->load->database();
			return $this->db->where('idbarang',$kode)->get("barangkasir")->row();
		}

		public function get_pesanan(){
			$this->load->library("session");
			$awal=$this->session->userdata("periode_dari");
			$sampai=$this->session->userdata("periode_sampai");

			$pesanan=$this->db
					->where("tpesanan <=",$sampai)
					->where("tpesanan >=",$awal)
					->from("pesanan p")
					->join("kontak k","k.idkontak=p.idkontak")
					->get()
					->result();

			return $pesanan;
		}
			
	public function transaksi(){
		//validasi
        $this->load->library('form_validation');
        $this->load->model("m_Serbaguna","ms");

		//gabung mang
		$id=$this->input->post("id");
		$username=$this->session->userdata("username");
		$waktu=date("Y-m-d H:i:s");

		$barang=$this->input->post("namabarang");
		$jumlah=$this->input->post("jumlah");

		$cek=0;
		for($i=0;$i<count($barang);$i++){
			if($this->ms->cek_ada("barangkasir","idbarang",$barang[$i])==FALSE) continue;
			$cek++;
		}

		if($cek==0) return "gagal";

		$data=array(
			"wtranspos"=>$waktu,
			"stranspos"=>1,
			"username"=>$username,
			"idkasir"=>3
			);

		$this->db->insert("transpos",$data);
		$id=$this->db->insert_id();

		for($i=0;$i<count($barang);$i++){
			if($this->ms->cek_ada("barang","idbarang",$barang[$i])==FALSE) continue;

			$dbarang=$this->db->where("b.idbarang",$barang[$i])->from("barangkasir k")->join("barang b","b.idbarang=k.idbarang")->get()->row();

			$data=array(
					"idtranspos"=>$id,
					"idbarang"=>$barang[$i],
					"jumlah"=>$jumlah[$i],
					"subtotal"=>$jumlah[$i]*$dbarang->hbarangkasir,
					"discount"=>$jumlah[$i]*$dbarang->disbarangkasir,
					"cogs"=>$dbarang->cbarang
				);

			$this->db->insert("keranjangpos",$data);
			$this->db->where("idbarang",$barang[$i])->set("jumlah","jumlah-".$jumlah[$i],false);
		}

		redirect(base_url()."pos/kasir_print/".$id);
	}

	public function get_summary($kode){
	$this->load->database();

		$summary=array(
			'notrans'=>$kode,
			'subtotal'=>0,
			'diskon'=>0,
			'tax'=>0
			);

		$summary['subtotal']=$this->db->select_sum("subtotal","total")->from("transpos t")->join("keranjangpos k","k.idtranspos=t.idtranspos")->where("t.idtranspos",$kode)->get()->row("total");
		$summary['diskon']=$this->db->select_sum("discount","total")->from("transpos t")->join("keranjangpos k","k.idtranspos=t.idtranspos")->where("t.idtranspos",$kode)->get()->row("total");
		$summary['tax']=$this->db->select_sum("tax","total")->from("transpos t")->join("keranjangpos k","k.idtranspos=t.idtranspos")->where("t.idtranspos",$kode)->get()->row("total");

		return $summary;
	}
}
?>