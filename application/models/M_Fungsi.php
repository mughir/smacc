<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Fungsi extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;
	
	public function get_fungsi()
	{
		$this->load->database();
		$this->db->order_by("idfungsi","ASC");
		$datauser=$this->db->get("fungsi b")->result();
		return $datauser;
	}
	
	public function get_detail($kode1=1)
	{
		$this->load->database();
		$datauser=$this->db->where("idfungsi",$kode1)->get("fungsi");
		return $datauser->row_array();
	}
	
	public function edit_fungsi($kode)
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('status', 'Status', 'trim|required|max_length[20]');
		
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			
			//load data
			$id=$this->input->post("id");
			$data=array(
			"sfungsi"=>$this->input->post("status")
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ada("fungsi","idfungsi",$id)==TRUE){
				if($this->db->where("idfungsi",$id)->update("fungsi",$data)){
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
	
	public function delete_fungsi($kode1)
    {
		//load data
		$ba=$kode1;
		
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("fungsi",array("idfungsi"=>$ba))==TRUE){
			if($this->db->where("idfungsi",$ba)->delete("fungsi")){
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