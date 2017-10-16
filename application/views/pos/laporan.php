    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="form-login">
            <h4>Laporan Penjualan POS</h4><hr>
			<form class='form' method="post" action="<?php echo base_url()?>pos/laporan/?tipe=laporan">
<?php 
if($this->session->flashdata('hasil')=="berhasil"){
	echo "<div class=\"alert alert-success\"><strong>Sukses!</strong> Operasi berhasil.</div>";
}
if($this->session->flashdata('hasil')=="gagal"){
	echo "<div class=\"alert alert-danger\"><strong>Gagal!</strong>Terdapat kesalahan, operasi gagal.</div>";
}
?>
				<table class='form'>				
				<tr>
					<td>
						Dari
					</td>
					<td>
						<input class="tgl" type="text" name="dari" required max="<?php echo $this->session->userdata("periode_sampai") ?>" min="<?php echo $this->session->userdata("periode_dari") ?>">
					</td>
				</tr>				
				<tr>
					<td>
						Hingga
					</td>
					<td>
						<input class="tgl" type="text" name="sampai" required max="<?php echo $this->session->userdata("periode_sampai") ?>" min="<?php echo $this->session->userdata("periode_dari") ?>">
					</td>
				</tr>
				<tr>
					<td>
						Order by 
					</td>
					<td>
						<select name="order">
							<option value="produk">Nama Produk</option>
							<option value="jual">Jumlah terjual</option>
						</select>
					</td>
				</tr>				
				</table>
				</br>
				<div class="wrapper">
					<span class="group-btn">     
						<input type="submit" value="Submit" class="btn btn-primary btn-md">
					</span>
				</div>
			</form>
            </div>
         </div>
        </div>