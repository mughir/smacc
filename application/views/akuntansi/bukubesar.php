    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="form-login">
            <h4>Lihat Buku Besar</h4><hr>
			<form class='form' method="post" action="<?php echo base_url()?>akuntansi/isibukubesar">
<?php 
if($this->session->flashdata('hasil')=="berhasil"){
	echo "<div class=\"alert alert-success\"><strong>Sukses!</strong> Operasi berhasil.</div>";
}
if($this->session->flashdata('hasil')=="gagal"){
	echo "<div class=\"alert alert-danger\"><strong>Gagal!</strong>Terdapat kesalahan, operasi gagal.</div>";
}
?>
				<table class='form'>
			<tr><td>Akun </td><td><select name="akun"><?php foreach($user as $a){echo "<option value='$a->noakun'>$a->nakun</option>"; } ?></select></td></tr>							<tr>
					<td>
						Dari
					</td>
					<td>
						<input name="dari"  required  class="tgl" type="text" max="<?php echo $this->session->userdata("periode_sampai") ?>" min="<?php echo $this->session->userdata("periode_dari") ?>">
					</td>
				</tr>				
				<tr>
					<td>
						Hingga
					</td>
					<td>
						<input name="sampai" required class="tgl" type="text" max="<?php echo $this->session->userdata("periode_sampai") ?>" min="<?php echo $this->session->userdata("periode_dari") ?>">
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