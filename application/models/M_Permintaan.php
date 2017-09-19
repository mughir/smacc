<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Permintaan extends CI_Model {
		public function get_detail($kode)
		{
			$this->load->database();
			$datauser=$this->db->where("idpengajuan",$kode)->get("pengajuan");
			return $datauser->row_array();
		}		

		public function get_baris($kode)
		{
			$this->load->database();
			$datauser=$this->db->where("idpengajuan",$kode)->get("barangpengajuan");
			return $datauser->result_array();
		}

		public function get_permintaan(){
			$this->load->library("session");
			$awal=$this->session->userdata("periode_dari");
			$sampai=$this->session->userdata("periode_sampai");

			$pengajuan=$this->db
					->where("tpengajuan <=",$sampai)
					->where("tpengajuan >=",$awal)
					->from("pengajuan p")
					->get()
					->result();

			return $pengajuan;
		}
			
		public function tambah_permintaan()
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
				$prioritas=$this->input->post("prioritas");
				$tanggal=$this->input->post("tanggal");
				$user=$this->session->userdata("username");
				$status=0;

				//if($this->ms->cek_ada("pesanan","idpesanan",$pesanan)==FALSE) return "gagal";
				$pesanan=empty($pesanan) ? null:$pesanan;

				$barang=$this->input->post("namabarang");
				$jumlah=$this->input->post("jumlah");

				if($this->ms->cek_ada("pengajuan","idpengajuan",$id)==TRUE) return "gagal";

				$cek=0;
				for($i=0;$i<count($barang);$i++){
					if($this->ms->cek_ada("barang","idbarang",$barang[$i])==FALSE) continue;
					$cek++;
				}

				if($cek==0) return "gagal";

				$data=array(
					"idpengajuan"=>$id,
					"tpengajuan"=>$tanggal,
					"prioritas"=>$prioritas,
					"username"=>$user,
					"stpengajuan"=>$status
					);

				$this->db->insert("pengajuan",$data);

				for($i=0;$i<count($barang);$i++){
					if($this->ms->cek_ada("barang","idbarang",$barang[$i])==FALSE) continue;

					$dbarang=$this->db->where("idbarang",$barang[$i])->get("barang")->row();

					if($this->ms->cek_ada("barangpengajuan",array("idbarang"=>$barang[$i],"idpengajuan"=>$id))){
						$this->db->where("idbarang",$barang[$i])->where("idpengajuan",$id)->set("jumlah","jumlah+".$jumlah[$i],false)->update("barangpengajuan");
						continue;
					}

					$data=array(
							"idpengajuan"=>$id,
							"idbarang"=>$barang[$i],
							"jumlah"=>$jumlah[$i]
						);

					$this->db->insert("barangpengajuan",$data);
				}

				return "berhasil";
			}
		}
	
		public function delete_permintaan($kode){
			$id=$kode;
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ada("pengajuan","idpengajuan",$id)==TRUE){
				if($this->db->where("idpengajuan",$id)->delete("pengajuan")){
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