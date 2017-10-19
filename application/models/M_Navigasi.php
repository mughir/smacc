<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class M_Navigasi extends CI_Model {

	

		public $nav;



        public function utama()

        {

				$this->load->library('session');
				$this->load->helper('url');
				$this->load->model('m_Serbaguna');
				
				$kunci=0;
				if(!$this->session->userdata("periode_dari") || !$this->session->userdata("periode_sampai")) $kunci=1;
				$fungsi=$this->db->get("fungsi")->result_array();


                if(!$this->session->userdata('username')){
					$this->nav="<li><a href=\"".base_url()."\" class=\"halonav\">Home</a></li>";
					$this->nav.="<li><a href=\"".base_url()."user/login\" class=\"halonav\">Login</a></li>";
				}
				else
				{

				$this->nav="<li><a href=\"".base_url()."\" class=\"halonav\">Home</a></li>";
					//Masterdata

					
					$status=$this->m_Serbaguna->cari_narray("10000","idfungsi","sfungsi",$fungsi);

					 if($status==1){

						$this->nav.="<li class=\"dropdown\">";

							$this->nav.="<a href=\"".base_url()."Masterdata\" class=\"halonav dropdown-toggle\" data-toggle=\"dropdown\">Masterdata";

							$this->nav.="<span class=\"caret\"></span></a>";

							$this->nav.="<ul class='dropdown-menu'>";

								$this->nav.="<li><a href=\"".base_url()."masterdata/barang\" class=\"halonav\">Barang</a></li>";

								$this->nav.="<li><a href=\"".base_url()."masterdata/kontak\" class=\"halonav\">Kontak</a></li>";

								$this->nav.="<li><a href=\"".base_url()."masterdata/fungsi\" class=\"halonav\">Fungsi</a></li>";

								$this->nav.="<li><a href=\"".base_url()."masterdata/user\" class=\"halonav\">User</a></li>";

								$this->nav.="<li><a href=\"".base_url()."masterdata/akun\" class=\"halonav\">Akun</a></li>";


								$this->nav.="<li><a href=\"".base_url()."masterdata/periode\" class=\"halonav\">Periode</a></li>";


							$this->nav.="</ul>";

						$this->nav.="</li>";

					}

					//POST
					$status=$this->m_Serbaguna->cari_narray("20000","idfungsi","sfungsi",$fungsi);
					if($status==1 && $kunci==0){
						$this->nav.="<li class=\"dropdown\">";

							$this->nav.="<a href=\"".base_url()."pos\" class=\"halonav dropdown-toggle\" data-toggle=\"dropdown\">Point of Sales";

							$this->nav.="<span class=\"caret\"></span></a>";

							$this->nav.="<ul class='dropdown-menu'>";

								$this->nav.="<li><a href=\"".base_url()."pos/kasir\" class=\"halonav\">Kasir</a></li>";

								$this->nav.="<li><a href=\"".base_url()."pos/point\" class=\"halonav\">Point</a></li>";

								$this->nav.="<li><a href=\"".base_url()."pos/produk\" class=\"halonav\">Produk Dijual</a></li>";

								$this->nav.="<li><a href=\"".base_url()."pos/laporan\" class=\"halonav\">Laporan</a></li>";

							$this->nav.="</ul>";

						$this->nav.="</li>";
					}

					
					//Penjualan
					$status=$this->m_Serbaguna->cari_narray("30000","idfungsi","sfungsi",$fungsi);
					if($status==1 &&  $kunci==0){

						$this->nav.="<li class=\"dropdown\">";

							$this->nav.="<a href=\"".base_url()."penjualan\" class=\"halonav dropdown-toggle\" data-toggle=\"dropdown\">Penjualan";

							$this->nav.="<span class=\"caret\"></span></a>";

							$this->nav.="<ul class='dropdown-menu'>";

								$this->nav.="<li><a href=\"".base_url()."penjualan/pesanan\" class=\"halonav\">Pesanan</a></li>";

								$this->nav.="<li><a href=\"".base_url()."penjualan/pengiriman\" class=\"halonav\">Pengiriman</a></li>";

								$this->nav.="<li><a href=\"".base_url()."penjualan/penagihan\" class=\"halonav\">Penagihan</a></li>";

								$this->nav.="<li><a href=\"".base_url()."penjualan/pembayaran\" class=\"halonav\">Pembayaran</a></li>";
								$this->nav.="<li><a href=\"".base_url()."penjualan/laporan\" class=\"halonav\">Laporan</a></li>";

							$this->nav.="</ul>";

						$this->nav.="</li>";
					}

					//pembelian
					$status=$this->m_Serbaguna->cari_narray("40000","idfungsi","sfungsi",$fungsi);
					if($status==1 &&  $kunci==0){

						$this->nav.="<li class=\"dropdown\">";

							$this->nav.="<a href=\"".base_url()."pembelian\" class=\"halonav dropdown-toggle\" data-toggle=\"dropdown\">Pembelian";

							$this->nav.="<span class=\"caret\"></span></a>";

							$this->nav.="<ul class='dropdown-menu'>";

								$this->nav.="<li><a href=\"".base_url()."Pembelian/permintaan\" class=\"halonav\">Permintaan Stok</a></li>";

								$this->nav.="<li><a href=\"".base_url()."Pembelian/pesanan\" class=\"halonav\">Pemesanan Barang</a></li>";

								$this->nav.="<li><a href=\"".base_url()."pembelian/penerimaan\" class=\"halonav\">Penerimaan Barang</a></li>";
								$this->nav.="<li><a href=\"".base_url()."pembelian/tagihan\" class=\"halonav\">Tagihan</a></li>";

								$this->nav.="<li><a href=\"".base_url()."pembelian/pembayaran\" class=\"halonav\">Pembayaran</a></li>";
								$this->nav.="<li><a href=\"".base_url()."pembelian/laporan\" class=\"halonav\">Laporan</a></li>";

							$this->nav.="</ul>";

						$this->nav.="</li>";
					}

				//produksi
					$status=$this->m_Serbaguna->cari_narray("50000","idfungsi","sfungsi",$fungsi);
					if($status==1 && $kunci==0){

						$this->nav.="<li class=\"dropdown\">";

							$this->nav.="<a href=\"".base_url()."produksi\" class=\"halonav dropdown-toggle\" data-toggle=\"dropdown\">Produksi";

							$this->nav.="<span class=\"caret\"></span></a>";

							$this->nav.="<ul class='dropdown-menu'>";

								$this->nav.="<li><a href=\"".base_url()."produksi/rnd\" class=\"halonav\">Pengembangan produk</a></li>";
								$this->nav.="<li><a href=\"".base_url()."produksi/perintah\" class=\"halonav\">Perintah Produksi</a></li>";

								$this->nav.="<li><a href=\"".base_url()."produksi/penjadwalan\" class=\"halonav\">Penjadwalan</a></li>";

								$this->nav.="<li><a href=\"".base_url()."produksi/operasi\" class=\"halonav\">Operasi</a></li>";
								$this->nav.="<li><a href=\"".base_url()."produksi/pengambilan\" class=\"halonav\">Pengambilan Material</a></li>";

								$this->nav.="<li><a href=\"".base_url()."produksi/penyesuaian\" class=\"halonav\">Penyesuaian</a></li>";
								$this->nav.="<li><a href=\"".base_url()."produksi/laporan\" class=\"halonav\">Laporan</a></li>";

							$this->nav.="</ul>";

						$this->nav.="</li>";
					}
					//HRD
					$status=$this->m_Serbaguna->cari_narray("60000","idfungsi","sfungsi",$fungsi);
					if($status==1 &&  $kunci==0){

						$this->nav.="<li class=\"dropdown\">";

							$this->nav.="<a href=\"".base_url()."produksi\" class=\"halonav dropdown-toggle\" data-toggle=\"dropdown\">SDM";

							$this->nav.="<span class=\"caret\"></span></a>";

							$this->nav.="<ul class='dropdown-menu'>";

								$this->nav.="<li><a href=\"".base_url()."sdm/karyawan\" class=\"halonav\">Karyawan</a></li>";

								$this->nav.="<li><a href=\"".base_url()."sdm/jabatan\" class=\"halonav\">jabatan</a></li>";

								//$this->nav.="<li><a href=\"".base_url()."sdm/absensi\" class=\"halonav\">Absensi</a></li>";

								$this->nav.="<li><a href=\"".base_url()."sdm/proses_gaji\" class=\"halonav\">Proses Gaji</a></li>";
								$this->nav.="<li><a href=\"".base_url()."sdm/laporan\" class=\"halonav\">Laporan</a></li>";

							$this->nav.="</ul>";

						$this->nav.="</li>";
					}

					//Akuntansi
					$status=$this->m_Serbaguna->cari_narray("70000","idfungsi","sfungsi",$fungsi);
					if($status==1 &&  $kunci==0){

						$this->nav.="<li class=\"dropdown\">";

							$this->nav.="<a href=\"".base_url()."produksi\" class=\"halonav dropdown-toggle\" data-toggle=\"dropdown\">Akuntansi";

							$this->nav.="<span class=\"caret\"></span></a>";

							$this->nav.="<ul class='dropdown-menu'>";

								$this->nav.="<li><a href=\"".base_url()."akuntansi/prosesjurnal\" class=\"halonav\">Proses Jurnal</a></li>";

								$this->nav.="<li><a href=\"".base_url()."akuntansi/jurnalmanual\" class=\"halonav\">Review Jurnal & Transaksi Lainnya</a></li>";

								$this->nav.="<li><a href=\"".base_url()."akuntansi/bukubesar\" class=\"halonav\">Periksa Buku Besar</a></li>";

								$this->nav.="<li><a href=\"".base_url()."akuntansi/tutupbuku\" class=\"halonav\">Tutup Buku</a></li>";
								$this->nav.="<li><a href=\"".base_url()."akuntansi/laporan\" class=\"halonav\">Laporan</a></li>";

							$this->nav.="</ul>";

						$this->nav.="</li>";
					}
		}

				return $this->nav;

        }

}

?>