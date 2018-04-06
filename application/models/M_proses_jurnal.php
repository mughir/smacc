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
		$this->proses_gaji($dari,$sampai);
		$this->proses_produksi($dari,$sampai);

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
		//sales
		$penjualan=$this->db
			->select("tkwitansi")
			->select("t.idkwitansi")
			->select("t.dp")
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
			$piutang=$total-$p->dp;
			$cash=$p->dp;

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
				"debit"=>$piutang,
				"kredit"=>0
			);

			$this->db->insert("djurnalm",$data);

			if($cash != 0){			
				$data=array(
				"kjurnalm"=>$id,
				"noakun"=>10100,
				"debit"=>$cash,
				"kredit"=>0
			);

			$this->db->insert("djurnalm",$data);

			}

			$data=array(
				"kjurnalm"=>$id,
				"noakun"=>41000,
				"debit"=>0,
				"kredit"=>$total
			);

			$this->db->insert("djurnalm",$data);
		}

		//cogs
		$cogs=$this->db
			->select("tpengiriman")
			->select("t.idpengiriman")
			->select("tcost as total",false)
			->from("pengiriman t")
			->where("tpengiriman >=",$dari)
			->where("tpengiriman <=",$sampai)
			->join("isipengiriman k","k.idpengiriman=t.idpengiriman")
			->get()->result();

		foreach($cogs as $p){
			$nama="Jurnal Pengakuan Beban Pokok Penjualan";
			$tanggal=$p->tpengiriman;
			$sref="pengiriman";
			$kref=$p->idpengiriman;
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
				"noakun"=>51000,
				"debit"=>$total,
				"kredit"=>0
			);

			$this->db->insert("djurnalm",$data);


			$data=array(
				"kjurnalm"=>$id,
				"noakun"=>10500,
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

	public function proses_gaji($dari,$sampai){
		$gaji=$this->db
			->select("tanggal")
			->select("idgaji")
			->select("gaji")
			->from("gaji")
			->where("tanggal >=",$dari)
			->where("tanggal <=",$sampai)
			->get()->result();

		foreach($gaji as $p){
			$nama="Jurnal Pembayaran Gaji";
			$tanggal=$p->tanggal;
			$sref="gaji";
			$kref=$p->idgaji;
			$total=$p->gaji;

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
				"noakun"=>52000,
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

	public function proses_produksi($dari,$sampai){
		//barang jadi
		$produksi=$this->db
			->select("waktu")
			->select("t.idjadwal")
			->select("cmaterial")
			->select("clabor")
			->select("cfoh")
			->from("penjadwalan t")
			->where("status",2)
			->where("t.waktu >=",$dari)
			->where("t.waktu <=",$sampai)
			->join("penyesuaianprod k","k.idjadwal=t.idjadwal")
			->get()->result();

		foreach($produksi as $p){
			$nama="Jurnal Pengakuan Finish Goods";
			$tanggal=$p->waktu;
			$sref="Batch produksi";
			$kref=$p->idjadwal;
			$total=$p->cmaterial+$p->clabor+$p->cfoh;
			$labor=$p->clabor;
			$foh=$p->cfoh;

			$data=array(
				"njurnalm"=>$nama,
				"tjurnalm"=>$tanggal,
				"sref"=>$sref,
				"kref"=>$kref
			);

			$this->db->insert("jurnalm",$data);
			$id=$this->db->insert_id(); 

			//Add fg
			$data=array(
				"kjurnalm"=>$id,
				"noakun"=>10500,
				"debit"=>$total,
				"kredit"=>0
			);

			$this->db->insert("djurnalm",$data);
	
				$data=array(
				"kjurnalm"=>$id,
				"noakun"=>10500,
				"debit"=>0,
				"kredit"=>$p->cmaterial
			);
			$this->db->insert("djurnalm",$data);

			$data=array(
				"kjurnalm"=>$id,
				"noakun"=>53000,
				"debit"=>0,
				"kredit"=>$p->clabor
			);

			$this->db->insert("djurnalm",$data);


			$data=array(
				"kjurnalm"=>$id,
				"noakun"=>54000,
				"debit"=>0,
				"kredit"=>$p->cfoh
			);

			$this->db->insert("djurnalm",$data);
		}
	}
}
?>