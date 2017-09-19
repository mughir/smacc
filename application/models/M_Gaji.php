<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Gaji extends CI_Model {
	public function get_gaji(){
		$tahun=$this->input->get("tahun");
		$bulan=$this->input->get("bulan");

		if($this->input->get("hitung")){
			$dpegawai=$this->db->from("pegawai p")->join("jabatan j","j.idjabatan=p.idjabatan")->get();
			foreach($dpegawai->result() as $d){
				$dgaji=$this->db->where("tahun",$tahun)->where("bulan",$bulan)->where("idpegawai",$d->idpegawai)->get("gaji");
				if($dgaji->num_rows()<1){
					$gaji=$d->vartambahan+$d->gapok+$d->tunjangan;
					$tanggal=date('Y-m-d');
					$data=array(
						"idpegawai"=>$d->idpegawai,
						"tahun"=>$tahun,
						"bulan"=>$bulan,
						'tanggal'=>$tanggal,
						"gaji"=>$gaji
					);

					$this->db->insert("gaji",$data);
				}
			}
		}

		if($this->input->get("proses")=="delete"){
			$this->db->where("idgaji",$this->input->get("id"))->delete("gaji");
		}

		$dgaji=$this->db->where("tahun",$tahun)->where("bulan",$bulan)->get("gaji")->result();
		return $dgaji;
	}
}
?>