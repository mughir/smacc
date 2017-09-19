    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="form-login">
            <h4>Proses Gaji</h4><hr>
			<form class='form' method="get">
			<input type="hidden" value="gaji" name="proses">
<?php 
if($this->session->flashdata('hasil')=="berhasil"){
	echo "<div class=\"alert alert-success\"><strong>Sukses!</strong> Operasi berhasil.</div>";
}
if($this->session->flashdata('hasil')=="gagal"){
	echo "<div class=\"alert alert-danger\"><strong>Gagal!</strong>Terdapat kesalahan, operasi gagal.</div>";
}
?>
				<table class='form'>
			<tr><td>Tahun </td><td><input type="year" name="tahun" value="<?=date('Y');?>"></td></tr>
			<tr><td>Bulan </td><td><input type="number" required min=1 max=12 name="bulan" value="0"></td></tr>
			<tr><td>Hitung </td><td><input type="checkbox" name="hitung"></td></tr>
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