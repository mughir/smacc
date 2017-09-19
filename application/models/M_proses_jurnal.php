<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_proses_jurnal extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;
	
	public function proses()
	{
		$this->load->database();

		$dari=$this->input->post("dari");
		$sampai=$this->input->post("sampai");

		//Proses Transaksi
		$this->proses_pos($dari,$sampai);
		$this->proses_penjualan($dari,$sampai);
		$this->proses_pembelian($dari,$sampai);
		$this->proses_pembelian($dari,$sampai);

		return "berhasil";
	}

	public function proses_pos($dari,$sampai){
		$pos=$this->db
			->select("wtranspos")
			->select("t.idtranspos")
			->select("sum(subtotal-discount+tax) as total",false)
			->group_by("date(wtranspos)")
			->from("transpos t")
			->where("wtranspos >=",$dari." 00:00:00")
			->where("wtranspos <=",$sampai." 23:59:59")
			->join("keranjangpos k","k.idtranspos=t.idtranspos")
			->get()->result();

		foreach($pos as $p){
			$nama="Jurnal Pendapatan POS";
			$tanggal=date("Y-m-d",strtotime($p->wtranspos));
			$sref="pos";
			$kref=$p->idtranspos;
			$total=$p->total;

			$data=array(
				"njurnalm"=>$nama,
				"tjurnalm"=>$tanggal,
				"sref"=>$sref,
				"kref"=>$kref
			);

			$this->db->insert("jurnalm",$data);
			$id=$this->db->insert_id(); 

			$data=array(
				"kjurnalm"=>$id,
				"noakun"=>10100,
				"debit"=>$total,
				"kredit"=>0
			);

			$this->db->insert("djurnalm",$data);

			$data=array(
				"kjurnalm"=>$id,
				"noakun"=>41000,
				"debit"=>0,
				"kredit"=>$total
			);

			$this->db->insert("djurnalm",$data);
		}
	}

	public function proses_penjualan($dari,$sampai){
		$penjualan=$this->db
			->select("tkwitansi")
			->select("t.idkwitansi")
			->select("subtotal as total",false)
			->from("kwitansi t")
			->where("tkwitansi >=",$dari)
			->where("tkwitansi <=",$sampai)
			->join("isikwitansi k","k.idkwitansi=t.idkwitansi")
			->get()->result();

		foreach($penjualan as $p){
			$nama="Jurnal Pendapatan Penjualan";
			$tanggal=$p->tkwitansi;
			$sref="penagihan";
			$kref=$p->idkwitansi;
			$total=$p->total;

			$data=array(
				"njurnalm"=>$nama,
				"tjurnalm"=>$tanggal,
				"sref"=>$sref,
				"kref"=>$kref
			);

			$this->db->insert("jurnalm",$data);
			$id=$this->db->insert_id(); 

			$data=array(
				"kjurnalm"=>$id,
				"noakun"=>10400,
				"debit"=>$total,
				"kredit"=>0
			);

			$this->db->insert("djurnalm",$data);

			$data=array(
				"kjurnalm"=>$id,
				"noakun"=>41000,
				"debit"=>0,
				"kredit"=>$total
			);

			$this->db->insert("djurnalm",$data);
		}

		$pembayaran=$this->db
			->select("tglbayar")
			->select("t.idpembayaran")
			->select("jmbayar as total",false)
			->from("pembayaran t")
			->where("tglbayar >=",$dari)
			->where("tglbayar <=",$sampai)
			->get()->result();

		foreach($pembayaran as $p){
			$nama="Jurnal Penerimaan Pembayaran";
			$tanggal=$p->tglbayar;
			$sref="pembayaran";
			$kref=$p->idpembayaran;
			$total=$p->total;

			$data=array(
				"njurnalm"=>$nama,
				"tjurnalm"=>$tanggal,
				"sref"=>$sref,
				"kref"=>$kref
			);

			$this->db->insert("jurnalm",$data);
			$id=$this->db->insert_id(); 

			$data=array(
				"kjurnalm"=>$id,
				"noakun"=>10100,
				"debit"=>$total,
				"kredit"=>0
			);

			$this->db->insert("djurnalm",$data);

			$data=array(
				"kjurnalm"=>$id,
				"noakun"=>10400,
				"debit"=>0,
				"kredit"=>$total
			);

			$this->db->insert("djurnalm",$data);
		}
	}
	
	public function proses_pembelian($dari,$sampai){
		$tagihan=$this->db
			->select("tgltagihan")
			->select("t.idtagihan")
			->select("subtotal as total",false)
			->from("tagihan t")
			->where("tgltagihan >=",$dari)
			->where("tgltagihan <=",$sampai)
			->join("isitagihan k","k.idtagihan=t.idtagihan")
			->get()->result();

		foreach($tagihan as $p){
			$nama="Jurnal Pembelian Barang Dagang";
			$tanggal=$p->tgltagihan;
			$sref="tagihan";
			$kref=$p->idtagihan;
			$total=$p->total;

			$data=array(
				"njurnalm"=>$nama,
				"tjurnalm"=>$tanggal,
				"sref"=>$sref,
				"kref"=>$kref
			);

			$this->db->insert("jurnalm",$data);
			$id=$this->db->insert_id(); 

			$data=array(
				"kjurnalm"=>$id,
				"noakun"=>10500,
				"debit"=>$total,
				"kredit"=>0
			);

			$this->db->insert("djurnalm",$data);

			$data=array(
				"kjurnalm"=>$id,
				"noakun"=>20100,
				"debit"=>0,
				"kredit"=>$total
			);

			$this->db->insert("djurnalm",$data);
		}

		$pembayaran=$this->db
			->select("tglbayar")
			->select("t.idpembayaran")
			->select("jmbayar as total",false)
			->from("pembtagihan t")
			->where("tglbayar >=",$dari)
			->where("tglbayar <=",$sampai)
			->get()->result();

		foreach($pembayaran as $p){
			$nama="Jurnal pembayaran hutang dagang";
			$tanggal=$p->tglbayar;
			$sref="pembtagihan";
			$kref=$p->idpembayaran;
			$total=$p->total;

			$data=array(
				"njurnalm"=>$nama,
				"tjurnalm"=>$tanggal,
				"sref"=>$sref,
				"kref"=>$kref
			);

			$this->db->insert("jurnalm",$data);
			$id=$this->db->insert_id(); 

			$data=array(
				"kjurnalm"=>$id,
				"noakun"=>20100,
				"debit"=>$total,
				"kredit"=>0
			);

			$this->db->insert("djurnalm",$data);

			$data=array(
				"kjurnalm"=>$id,
				"noakun"=>10100,
				"debit"=>0,
				"kredit"=>$total
			);

			$this->db->insert("djurnalm",$data);
		}
	}
}
?>