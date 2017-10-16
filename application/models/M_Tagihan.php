<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tagihan extends CI_Model {
		public function get_detail($kode)
		{
			$this->load->database();
			$datauser=$this->db->where("idtagihan",$kode)->get("tagihan");
			return $datauser->row_array();
		}		

		public function get_baris($kode)
		{
			$this->load->database();
			$datauser=$this->db->where("idtagihan",$kode)->get("isitagihan");
			return $datauser->result_array();
		}

		public function get_harga($kode){
			$this->load->database();
			return $this->db->where('idbarang',$kode)->get("barang")->row();
		}

		public function get_tagihan(){
			$this->load->library("session");
			$awal=$this->session->userdata("periode_dari");
			$sampai=$this->session->userdata("periode_sampai");

			$tagihan=$this->db
					->where("tgltagihan <=",$sampai)
					->where("tgltagihan >=",$awal)
					->from("tagihan p")
					->join("terimabarang k","k.idterimabarang=p.idterimabarang")
					->get()
					->result();

			return $tagihan;
		}
			
	public function tambah_tagihan()
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
			$terima=$this->input->post("terima");
			$tanggal=$this->input->post("tanggal");
			$beban=$this->input->post("beban");

			$barang=$this->input->post("namabarang");
			$jumlah=$this->input->post("jumlah");

			if($this->ms->cek_ada("tagihan","idtagihan",$id)==TRUE) return "gagal";

			$cek=0;
			for($i=0;$i<count($barang);$i++){
				if($this->ms->cek_ada("barang","idbarang",$barang[$i])==FALSE) continue;
				$cek++;
			}

			if($cek==0) return "gagal";

			$data=array(
				"idtagihan"=>$id,
				"tgltagihan"=>$tanggal,
				"idterimabarang"=>$terima,
				"biayapengiriman"=>$beban,
				);

			$this->db->insert("tagihan",$data);

			for($i=0;$i<count($barang);$i++){
				if($this->ms->cek_ada("barang","idbarang",$barang[$i])==FALSE) continue;

				$dbarang=$this->db->where("idbarang",$barang[$i])->get("barang")->row();

				if($this->ms->cek_ada("isitagihan",array("idbarang"=>$barang[$i],"idtagihan"=>$id))){
					$this->db->where("idbarang",$barang[$i])->where("idtagihan",$id)->set("jumlah","jumlah+".$jumlah[$i],false)->set("subtotal","subtotal +".($jumlah[$i]*$dbarang->hjualbarang),false)->update("isitagihan");
					continue;
				}

				$data=array(
						"idtagihan"=>$id,
						"idbarang"=>$barang[$i],
						"jumlah"=>$jumlah[$i],
						"subtotal"=>$jumlah[$i]*$dbarang->hjualbarang
					);

				$this->db->insert("isitagihan",$data);
				
				$this->load->model("M_Barang");
				$this->M_Barang->update_barang($barang[$i],$jumlah[$i],$jumlah[$i]*$dbarang->hjualbarang);
			}

			return "berhasil";
		}
	}

	public function delete_tagihan($kode){
		$id=$kode;
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("pesanan","idtagihan",$id)==TRUE){
			if($this->db->where("idtagihan",$id)->delete("tagihan")){
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