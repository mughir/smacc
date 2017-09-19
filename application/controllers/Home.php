<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

       public function __construct()
       {
			parent::__construct();
            //code for allowed
			$this->load->helper('url');
       }
		
	public function index()
	{
		//load model
		$this->load->model('m_Navigasi');
		
		//code
		
		//muatan data
		$data['hal']="hal/utama";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
}
