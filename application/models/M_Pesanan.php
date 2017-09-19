<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Pesanan extends CI_Model {
		public function get_detail($kode)
		{
			$this->load->database();
			$datauser=$this->db->where("idpesanan",$kode)->get("pesanan");
			return $datauser->row_array();
		}		

		public function get_baris($kode)
		{
			$this->load->database();
			$datauser=$this->db->where("idpesanan",$kode)->get("barispesanan");
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
					->where("tpesanan <=",$sampai)
					->where("tpesanan >=",$awal)
					->from("pesanan p")
					->join("kontak k","k.idkontak=p.idkontak")
					->get()
					->result();

			return $pesanan;
		}
			
	public function tambah_pesanan()
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
			$dp=$this->input->post("dp");

			$barang=$this->input->post("namabarang");
			$jumlah=$this->input->post("jumlah");

			if($this->ms->cek_ada("pesanan","idpesanan",$id)==TRUE) return "gagal";

			$cek=0;
			for($i=0;$i<count($barang);$i++){
				if($this->ms->cek_ada("barang","idbarang",$barang[$i])==FALSE) continue;
				$cek++;
			}

			if($cek==0) return "gagal";

			$data=array(
				"idpesanan"=>$id,
				"tpesanan"=>$tanggal,
				"idkontak"=>$pemesan,
				"stpesanan"=>0,
				"dp"=>$dp,
				"termpengiriman"=>$term
				);

			$this->db->insert("pesanan",$data);

			for($i=0;$i<count($barang);$i++){
				if($this->ms->cek_ada("barang","idbarang",$barang[$i])==FALSE) continue;

				$dbarang=$this->db->where("idbarang",$barang[$i])->get("barang")->row();

				if($this->ms->cek_ada("barispesanan",array("idbarang"=>$barang[$i],"idpesanan"=>$id))){
					$this->db->where("idbarang",$barang[$i])->where("idpesanan",$id)->set("jumlah","jumlah+".$jumlah[$i],false)->set("subtotal","subtotal +".($jumlah[$i]*$dbarang->hjualbarang),false)->update("barispesanan");
					continue;
				}

				$data=array(
						"idpesanan"=>$id,
						"idbarang"=>$barang[$i],
						"jumlah"=>$jumlah[$i],
						"subtotal"=>$jumlah[$i]*$dbarang->hjualbarang
					);

				$this->db->insert("barispesanan",$data);
			}

			return "berhasil";
		}
	}
	
	public function edit_jurnal($kode)
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'ID Jurnal', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('jenis', 'jenis', 'trim|required|max_length[20]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			
			//load data
			$id=$this->input->post("id");
			$data=array(
			"JURNAL_TRANSAKSI_DES"=>$this->input->post("des"),
			"JENIS_JURNAL_KODE"=>$this->input->post("jenis"),
			"JURNAL_TRANSAKSI_GN"=>$this->input->post("gen")
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ada("BSPL_DATA_JURNAL_TRANSAKSI","JURNAL_TRANSAKSI_ID",$id)==TRUE){
				if($this->db->where("JURNAL_TRANSAKSI_ID",$id)->update("BSPL_DATA_JURNAL_TRANSAKSI",$data)){
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
	
	public function delete_pesanan($kode){
		$id=$kode;
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("pesanan","idpesanan",$id)==TRUE){
			if($this->db->where("idpesanan",$id)->delete("pesanan")){
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
	
	public function post_jurnal($kode)
	{
		//validasi
        $this->load->library('form_validation');
		$this->load->database();

        $this->form_validation->set_rules('no', 'No Transaksi', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('periode', 'jenis', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('tahun', 'jenis', 'trim|required|max_length[4]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			$no=$this->input->post("no",true);
			$tahun=$this->input->post("tahun");
			$periode=$this->input->post("periode");
			$user=$this->session->userdata("username");
			$tgl=date('Y-m-d');
			
			$jurnal=$this->db->where("t.TRANSAKSI_NO",$no)->from("BSPL_DATA_TRANSAKSI t")->join("BSPL_DATA_JURNAL_TRANSAKSI jt","jt.TRANSAKSI_NO=t.TRANSAKSI_NO")->get()->result();
			foreach($jurnal as $j)
			{
				if($j->JURNAL_TRANSAKSI_GN==1){
					$data=array(
						'JENIS_JURNAL_KODE'=>$j->JENIS_JURNAL_KODE,
						'JURNAL_TAHUN'=>$tahun,
						'PERIODE_KODE'=>$periode,
						'TRANSAKSI_NO'=>$no,
						'JURNAL_DES'=>$j->JURNAL_TRANSAKSI_DES,
						'USER_USERNAME'=>$user
						);
						
					$this->db->set('JURNAL_TANGGAL',"to_date('$tgl','yyyy-mm-dd')",false);
					$this->db->insert('BSPL_DATA_JURNAL',$data);
					
					//isi
					$isi=$this->db->where("JURNAL_TRANSAKSI_ID",$j->JURNAL_TRANSAKSI_ID)->get("BSPL_DATA_JURNAL_TRANSAKSID")->result();
					foreach($isi as $i){
						//get last id
						$id=$this->db->limit(1)->order_by("JURNAL_ID","DESC")->get("BSPL_DATA_JURNAL");
						if($id->num_rows()<1){
							$id=1;
						}else{
							$id=$id->row()->JURNAL_ID;
						}
						$data=array(
							'JURNAL_ID'=>$id,
							'COA_KODE'=>$i->COA_KODE,
							'JURNALD_DEBIT'=>$i->JURNAL_TRANSAKSID_DEBIT,
							'JURNALD_KREDIT'=>$i->JURNAL_TRANSAKSID_KREDIT
							);
						$this->db->insert("BSPL_DATA_JURNALD",$data);
					}
					
				}	
			}

			return "berhasil";
		}
	}
}
?>