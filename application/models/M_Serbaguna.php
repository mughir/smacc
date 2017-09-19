<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Serbaguna extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function cek_ganda($table=0, $pk=0, $data=0){
		if(is_array($pk)){
			foreach($pk as $p=>$k){
				$this->db->where($p,$k);
			}
		}
		else{
			$this->db->where($pk,$data);
		}
		$jumlah=$this->db->get($table)->num_rows();
		if($jumlah>0){
			return false;
		}
		else{
			return true;
		}
	}
	
	public function cek_ada($table=0, $pk=0, $data=0){
		if(is_array($pk)){
			foreach($pk as $p=>$k){
				$this->db->where($p,$k);
			}
		}
		else{
			$this->db->where($pk,$data);
		}
		$jumlah=$this->db->get($table)->num_rows();
		if($jumlah<1){
			return false;
		}
		else{
			return true;
		}
	}

	public function cari_narray($nilai,$kolom,$target="kosong",$arr){
		$filterBy =  $nilai; // or Finance etc.

		$new = array_filter($arr, function ($var) use ($filterBy,$kolom) {
		    return ($var[$kolom] == $filterBy);
		});

		$new=array_values($new);

		if($target=="kosong"){
			return $new;
		} else {
			return $new[0][$target];
		}
	}
}
?>