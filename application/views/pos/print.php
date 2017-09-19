    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="form-login">
            <h4>Total Tagihan</h4>
			<form class='form' method="post" action="<?php echo base_url()?>output/download_summary">
<?php 
if($this->session->flashdata('hasil')=="berhasil"){
	echo "<div class=\"alert alert-success\"><strong>Sukses!</strong> Operasi berhasil.</div>";
}
if($this->session->flashdata('hasil')=="gagal"){
	echo "<div class=\"alert alert-danger\"><strong>Gagal!</strong>Terdapat kesalahan, operasi gagal.</div>";
}
?>
				<table class='table'>
				<tr><td>No Trans</td><td style="text-align:right;"><?php echo $summary['notrans'] ?></td></tr>
				<tr><td>Subtotal</td><td style="text-align:right;"><?php echo  number_format($summary['subtotal']) ?></td></tr>
				<tr><td>Discount</td><td style="text-align:right;"><?php echo  number_format($summary['diskon']) ?></td></tr>
				<tr><td>Tax</td><td style="text-align:right;"><?php echo number_format($summary['tax']) ?></td></tr>
			</table>
				</br>
				<a href="<?=base_url()?>pos/kasir" class="btn btn-default"> Transaksi Baru</a>
			</form>
            </div>
         </div>
        </div>