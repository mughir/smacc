<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Jurnal_manual extends CI_Model {
		public function get_dataJurnal()
		{
			$this->load->database();
			$user=$this->session->userdata("username");
			
			$jurnal="";
			$no=1;
			
			$this->db->order_by("kjurnalm","DESC");
			$dh=$this->db->get('jurnalm')->result();
			foreach($dh as $d)
			{
				$jurnal.="<div class='juduljurnal'><b>#$d->kjurnalm $d->njurnalm $d->tjurnalm |REF: $d->sref - $d->kref ";
				$jurnal.="</b>";	
				$jurnal.="<a href='#' data-id='$d->kjurnalm' data-toggle='modal' data-target='#editjurnal' class='editButton btn btn-default glyphicon glyphicon-pencil'></a><a href='".base_url()."akuntansi/jurnalmanual_proses/delete/$d->kjurnalm' onclick=\"return confirm('Anda yakin?')\" class='btn btn-default glyphicon glyphicon-trash'></a>";
				$jurnal.="</div>";
				$jurnal.="<table class='table'>";
				$jurnal.="<tr><th>Nama</th><th>Debit</th><th>Kredit</th></tr>";
				$this->db->select("c.noakun");
				$this->db->select("nakun");
				$this->db->select("debit");
				$this->db->select("kredit");
				$this->db->select("(debit-kredit) as NILAI",false);
				$do=$this->db->order_by('NILAI','DESC')->where('kjurnalm',$d->kjurnalm)->from("djurnalm d")->join("coa c","c.noakun=d.noakun")->get()->result();
				foreach($do as $k){
					$jurnal.="<tr><td>";
					if($k->NILAI <0){
						$jurnal.="<span class='kredit'></span>";
					}
					$jurnal.= "$k->noakun - $k->nakun</td><td>$k->debit</td><td>$k->kredit</td></tr>";
				}
				$jurnal.="</table><br>";
				$no++;
			}
			
			return $jurnal;
		}
		
		public function get_detail($kode)
		{
			$this->load->database();
			$datauser=$this->db->where("kjurnalm",$kode)->get("jurnalm");
			return $datauser->row_array();
		}
			
		public function get_detail_jurnal($kode)
		{
			$this->load->database();
				$this->db->select("c.noakun");
				$this->db->select("nakun");
				$this->db->select("debit");
				$this->db->select("kredit");
				$this->db->select("(debit-kredit) as NILAI",false);

				$this->db->order_by('NILAI','DESC')
				->where('kjurnalm',$kode)
				->from("djurnalm d")
				->join("coa c","c.noakun=d.noakun");
				$datauser=$this->db->get();

			return $datauser->result_array();
		}

	public function tambah_jurnal()
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[100]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			//gabung mang
			$akun=$this->input->post("namaakun");
			$debit=$this->input->post("debit");
			$kredit=$this->input->post("kredit");
			
			//Balance?
			if(array_sum($debit) != array_sum($kredit))
			{
				return "gagal";
			}
			
			//load data
			$tanggal=$this->input->post("tanggal");
			$nama=$this->input->post("nama");
			$sumber=$this->input->post("sumber");
			$ref=$this->input->post("ref");
			$uraian=$this->input->post("uraian");
			
			$data=array(
						'njurnalm'=>$nama,
						'tjurnalm'=>$tanggal,
						'sref'=>$sumber,
						'kref'=>$ref,
						"uraian"=>$uraian
			);
		
			
			$this->load->database();
			
			if(count($akun) != count($debit) and count($akun) != count($kredit)){
					return "gagal";
			}
			else{
					$data1=array();
					$c=0;
					for($i=0;$i<count($akun);$i++){	
						$kode=explode(" - ",$akun[$i]);
						if(is_array($kode) and (($debit[$i] != 0 or $kredit[$i] != 0) and ($debit[$i] == 0 or $kredit[$i] == 0))){
							$s=array(
								'kjurnalm'=>'',
								'noakun'=>$kode[0],
								'debit'=>$debit[$i],
								'kredit'=>$kredit[$i]
							);
							$data1[]=$s;
							$c++;
						}
					}
				if($c==0){
					return "gagal";
				}
				else{
					if($this->db->insert("jurnalm",$data)){
					
					//get last id
					$id=$this->db->limit(1)->order_by("kjurnalm","DESC")->get("jurnalm");
					if($id->num_rows()<1){
						$id=1;
					}else{
						$id=$id->row()->kjurnalm;
					}
					
					echo $id;
					foreach($data1 as $b=>$c){
						$data1[$b]["kjurnalm"]="$id";
					}
					
					$this->db->insert_batch("djurnalm",$data1);
					return "berhasil";
					}
					else{
						return "gagal";
					}
				}
			}
		}
	}
	
	public function edit_jurnal($kode)
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'ID Jurnal', 'trim|required|max_length[20]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			
			$tanggal=$this->input->post("tanggal");
			$nama=$this->input->post("nama");
			$sumber=$this->input->post("sumber");
			$ref=$this->input->post("ref");
			$uraian=$this->input->post("uraian");

			//load data
			$id=$this->input->post("id");
			$data=array(
						'njurnalm'=>$nama,
						'tjurnalm'=>$tanggal,
						'sref'=>$sumber,
						'kref'=>$ref,
						"uraian"=>$uraian
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ada("jurnalm","kjurnalm",$id)==TRUE){
				if($this->db->where("kjurnalm",$id)->update("jurnalm",$data)){
					//gabung mang
					$akun=$this->input->post("namaakun");
					$debit=$this->input->post("debit");
					$kredit=$this->input->post("kredit");
			
					if(count($akun) != count($debit) and count($akun) != count($kredit)){
						return "gagal";
					} else {
						$data1=array();
						$c=0;
						for($i=0;$i<count($akun);$i++){	

						$kode=$akun[$i];
						
						//control
						$this->load->model("m_Serbaguna");
						$cekakun=$this->m_Serbaguna->cek_ada("coa","noakun",$kode);

						//Wajib ada
						if($cekakun==false){
							continue;
						}
								$s=array(
									'kjurnalm'=>'',
									'noakun'=>$kode,
									'debit'=>$debit[$i],
									'kredit'=>$kredit[$i],
								);
								$data1[]=$s;
								$c++;
						}//tutup for

						if($c==0){
							return "gagal";
						}
						else{
							foreach($data1 as $b=>$c){
								$data1[$b]["kjurnalm"]="$id";
							}

							$this->db->where("kjurnalm",$id)->delete("djurnalm");
							$this->db->insert_batch("djurnalm",$data1);

							return "berhasil";
						}//tutup batch
				 	}//tutup if count
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
	
	public function delete_jurnal($kode)
    {
		//load data
		$id=$kode;
		
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("jurnalm","kjurnalm",$id)==TRUE){
			if($this->db->where("kjurnalm",$id)->delete("jurnalm")){
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
			
			$jurnal=$this->db->get("jurnalm jt")->result();
			foreach($jurnal as $j)
			{
					$data=array(
						'njurnal'=>$j->njurnalm,
						'tjurnal'=>$j->tjurnalm,
						'sref'=>$j->sref,
						'kref'=>$j->kref,
						'uraian'=>$j->uraian
						);
						
					$this->db->insert('jurnal',$data);
					
					//isi
					$isi=$this->db->where("kjurnalm",$j->kjurnalm)->get("djurnalm")->result();
					foreach($isi as $i){
						//get last id
						$id=$this->db->limit(1)->order_by("kjurnal","DESC")->get("jurnal");
						if($id->num_rows()<1){
							$id=1;
						}else{
							$id=$id->row()->kjurnal;
						}
						$data=array(
							'kjurnal'=>$id,
							'noakun'=>$i->noakun,
							'debit'=>$i->debit,
							'kredit'=>$i->kredit
							);
						$this->db->insert("djurnal",$data);
					}	
			}
			$dari=$this->session->userdata("periode_dari");
			$sampai=$this->session->userdata("periode_sampai");

			$this->db->where("tjurnalm <=",$sampai);
			$this->db->where("tjurnalm >=",$dari);
			$this->db->delete("jurnalm");
			return "berhasil";
	}
	
	public function clear_jurnal()
	{
		$this->load->database();
		$dari=$this->session->userdata("periode_dari");
		$sampai=$this->session->userdata("periode_sampai");

		$this->db->where("tjurnalm <=",$sampai);
		$this->db->where("tjurnalm >=",$dari);
		if($this->db->delete("jurnalm")){
			return "berhasil";
		}else{
			return "gagal";
		}
	}
}
?>