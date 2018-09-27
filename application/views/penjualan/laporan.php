    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="form-login">
            <h4>Laporan Penjualan</h4><hr>
			<form class='form' method="post" action="?tipe=laporan">
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
						<input name="dari"  required  class="tglo" type="text" max="<?php echo $this->session->userdata("periode_sampai") ?>" min="<?php echo $this->session->userdata("periode_dari") ?>">
					</td>
				</tr>				
				<tr>
					<td>
						Hingga
					</td>
					<td>
						<input name="sampai" required class="tglo" type="text" max="<?php echo $this->session->userdata("periode_sampai") ?>" min="<?php echo $this->session->userdata("periode_dari") ?>">
					</td>
				</tr>
				<tr>
					<td>
						Order by 
					</td>
					<td>
						<select name="order">
							<option value="jenis">Nama Produk</option>
							<option value="jual">Jumlah terjual</option>
						</select>
					</td>
				</tr>				
				<tr>
					<td>
						Group by 
					</td>
					<td>
						<select name="group">
							<option value="produk">Produk</option>
							<option value="pembeli">Pembeli</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<select name="filter" style="width:150px;margin:0">
								<option value=1>Tanpa Filter</option>
								<option value=2>Segment 1</option>
								<option value=3>Segment 2</option>
								<option value=4>Segment 3</option>
						</select>
					</td>
					<td>
						<input type="text" name="isifilter" placeholder="">
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