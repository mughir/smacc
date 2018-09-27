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
					//total gaji
					$gaji=$d->vartambahan+$d->gapok+$d->tunjangan+$d->vartambahan;

					//pajak
					$pajak = 0;
					$ptkp = 54000000;
					if($d->gabung == 1) $ptkp += 54000000;
					if($d->stnikah == 1) $ptkp += 4500000;
					if($d->tanggungan = 1) $ptkp += 1500000;
					if($d->tanggungan = 2) $ptkp += 3000000;
					if($d->tanggungan = 3) $ptkp += 4500000;

					if($gaji*12 > $ptkp){
						$pkp = $gaji*12-$ptkp;
						if($pkp <= 50000000) $pajak = 0.05*$pkp;
						if($pkp > 50000000 && $pkp <=250000000) $pajak = 0.15*$pkp;
						if($pkp > 250000000 && $pkp <=50000000) $pajak = 0.25*$pkp;
						if($pkp > 500000000) $pajak = 0.3*$pkp;					
					}

					$tanggal=date('Y-m-d');
					$data=array(
						"idpegawai"=>$d->idpegawai,
						"tahun"=>$tahun,
						"bulan"=>$bulan,
						'tanggal'=>$tanggal,
						"gaji"=>$gaji,
						"pajak"=>$pajak/12
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