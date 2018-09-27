<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Pesan extends CI_Model {
	
		public $nav;

        public function hasil()
        {
        	$output="";
        	$pesan="";

        	if($this->session->flashdata('hasil')){
        		$pesan=$this->session->flashdata('hasil');
        		if(is_array($pesan)){
        			$hasil=$pesan[0];
        			$pesan=$pesan[1];
        		}
   				else{
   					$hasil=$pesan;
   				}
   				
        		if($hasil=="berhasil"){
					$output .= "<div class=\"alert alert-success\"><strong>Sukses!</strong> Operasi berhasil. $pesan</div>";
				}

				if($hasil=="gagal"){
					$output .= "<div class=\"alert alert-danger\"><strong>Gagal!</strong> $pesan</div>";
				}
    		}
        	echo $output;
        }
}
?>