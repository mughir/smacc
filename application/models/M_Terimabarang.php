<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_terimabarang extends CI_Model {
		public function get_detail($kode)
		{
			$this->load->database();
			$datauser=$this->db->where("idterimabarang",$kode)->get("terimabarang");
			return $datauser->row_array();
		}		

		public function get_baris($kode)
		{
			$this->load->database();
			$datauser=$this->db->where("idterimabarang",$kode)->get("barangditerima");
			return $datauser->result_array();
		}

		public function get_penerimaan(){
			$this->load->library("session");
			$this->load->database();
			$awal=$this->session->userdata("periode_dari");
			$sampai=$this->session->userdata("periode_sampai");

			$terimabarang=$this->db
					->where("tglterimabarang <=",$sampai)
					->where("tglterimabarang >=",$awal)
					->from("terimabarang p")
					->join("pesan_beli b","b.idpesan_beli=p.idpesan_beli","left")
					->join("kontak k","k.idkontak=b.idkontak","left")
					->get()
					->result();

			return $terimabarang;
		}
			
		public function tambah_penerimaan()
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
				$tanggal=$this->input->post("tanggal");

				//if($this->ms->cek_ada("pesanan","idpesanan",$pesanan)==FALSE) return "gagal";
				$pesanan=empty($pesanan) ? null:$pesanan;

				$barang=$this->input->post("namabarang");
				$jumlah=$this->input->post("jumlah");

				if($this->ms->cek_ada("terimabarang","idterimabarang",$id)==TRUE) return "gagal";

				$cek=0;
				for($i=0;$i<count($barang);$i++){
					if($this->ms->cek_ada("barang","idbarang",$barang[$i])==FALSE) continue;
					$cek++;
				}

				if($cek==0) return "gagal";

				$data=array(
					"idterimabarang"=>$id,
					"idpesan_beli"=>$pesanan,
					"tglterimabarang"=>$tanggal
					);

				$this->db->insert("terimabarang",$data);

				for($i=0;$i<count($barang);$i++){
					if($this->ms->cek_ada("barang","idbarang",$barang[$i])==FALSE) continue;

					$dbarang=$this->db->where("idbarang",$barang[$i])->get("barang")->row();

					if($this->ms->cek_ada("barangditerima",array("idbarang"=>$barang[$i],"idterimabarang"=>$id))){
						$this->db->where("idbarang",$barang[$i])->where("idterimabarang",$id)->set("jumlah","jumlah+".$jumlah[$i],false)->update("barangditerima");
						continue;
					}

					$data=array(
							"idterimabarang"=>$id,
							"idbarang"=>$barang[$i],
							"jumlah"=>$jumlah[$i]
						);

					$this->db->insert("barangditerima",$data);
					$this->db->where("idbarang",$barang[$i])->set("jumlah","jumlah+".$jumlah[$i],false);

				}

				return "berhasil";
			}
		}
	
		public function delete_penerimaan($kode){
			$id=$kode;
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ada("terimabarang","idterimabarang",$id)==TRUE){
				if($this->db->where("idterimabarang",$id)->delete("terimabarang")){
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