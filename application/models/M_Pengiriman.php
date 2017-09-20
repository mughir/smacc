<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_pengiriman extends CI_Model {
		public function get_detail($kode)
		{
			$this->load->database();
			$datauser=$this->db->where("idpengiriman",$kode)->get("pengiriman");
			return $datauser->row_array();
		}		

		public function get_baris($kode)
		{
			$this->load->database();
			$datauser=$this->db->where("idpengiriman",$kode)->get("isipengiriman");
			return $datauser->result_array();
		}

		public function get_pengiriman(){
			$this->load->library("session");
			$awal=$this->session->userdata("periode_dari");
			$sampai=$this->session->userdata("periode_sampai");

			$pengiriman=$this->db
					->where("tpengiriman <=",$sampai)
					->where("tpengiriman >=",$awal)
					->from("pengiriman p")
					->join("kontak k","k.idkontak=p.idkontak")
					->get()
					->result();

			return $pengiriman;
		}
			
		public function tambah_pengiriman()
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
				$pesanan=$this->input->post("pesanan");
				$pemesan=$this->input->post("pemesan");
				$tanggal=$this->input->post("tanggal");
				$term=$this->input->post("term");
				$biaya=$this->input->post("biaya");
				$barang=$this->input->post("namabarang");
				$jumlah=$this->input->post("jumlah");

				if(empty($pesanan)){
					$pesanan=null;
				} else {
					if($this->ms->cek_ada("pesanan","idpesanan",$pesanan)==FALSE) return "gagal";
				}

				if($this->ms->cek_ada("pengiriman","idpengiriman",$id)==TRUE) return "gagal";

				$cek=0;
				for($i=0;$i<count($barang);$i++){
					if($this->ms->cek_ada("barang","idbarang",$barang[$i])==FALSE) continue;
					$cek++;
				}

				if($cek==0) return "gagal";

				$data=array(
					"idpengiriman"=>$id,
					"idpesanan"=>$pesanan,
					"tpengiriman"=>$tanggal,
					"idkontak"=>$pemesan,
					"stpengiriman"=>0,
					"bpengiriman"=>$biaya,
					"termpengiriman"=>$term
					);

				$this->db->insert("pengiriman",$data);

				for($i=0;$i<count($barang);$i++){
					if($this->ms->cek_ada("barang","idbarang",$barang[$i])==FALSE) continue;

					$dbarang=$this->db->where("idbarang",$barang[$i])->get("barang")->row();

					if($this->ms->cek_ada("isipengiriman",array("idbarang"=>$barang[$i],"idpengiriman"=>$id))){
						$this->db->where("idbarang",$barang[$i])->where("idpengiriman",$id)->set("jumlah","jumlah+".$jumlah[$i],false)->update("isipengiriman");
						continue;
					}

					$data=array(
							"idpengiriman"=>$id,
							"idbarang"=>$barang[$i],
							"jumlah"=>$jumlah[$i]
						);

					$this->db->where("idbarang",$barang[$i])->set("jumlah","jumlah-".$jumlah[$i],false);

					$this->db->insert("isipengiriman",$data);
				}

				//Update status pesanan
				$this->db->set("stpesanan",1)->where("idpesanan",$pesanan)->update("pesanan");
				return "berhasil";
			}
		}
	
		public function delete_pengiriman($kode){
			$id=$kode;
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ada("pengiriman","idpengiriman",$id)==TRUE){
				if($this->db->where("idpengiriman",$id)->delete("pengiriman")){
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