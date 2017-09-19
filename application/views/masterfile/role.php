<div id="createuser" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Perusahaan</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>masterdata/role_proses/tambah">
		<div class="modal-body">
		<table class="form">
		<input type="hidden" name="user" value="<?php echo $user->USER_USERNAME; ?>">
				<tr><td>Perusahaan</td><td><select name="id"><?php foreach($pt as $p){echo "<option value='$p->PERUSAHAAN_ID'>$p->PERUSAHAAN_NAMA</option>";} ?></select></td></tr>
		 </table>
      </div>
	  <br>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button> <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
	  </form>
    </div>

  </div>
</div>


<div class="dokumen">
<div class="well ">
	<h3>Fungsi Role</h3>
	<p>Fitur ini digunakan untuk mengelola otoritas user terhadap pengelolaan data transaksi perusahaan pada sistem.
</div>


<div class="row">
	<div class="col-sm-3 col-xs-3">
		<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createuser">+ Add Perusahaan</button>
	</div>
</div>


<br>
<br>
<?php if($this->session->flashdata('hasil')=="berhasil"){
	echo "<div class=\"alert alert-success\"><strong>Sukses!</strong> Operasi berhasil.</div>";
}
?>
<?php if($this->session->flashdata('hasil')=="gagal"){
	echo "<div class=\"alert alert-danger\"><strong>Gagal!</strong>Terdapat kesalahan, operasi gagal.</div>";
}
?>
<table class='table' id="ajaxtable">
	<thead>
		<tr>
			<th>Kode Perusahaan</th>
			<th>Nama</th>
			<th>Config</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($role as $u){
				echo "<tr><td>$u->PERUSAHAAN_ID</td><td>$u->PERUSAHAAN_NAMA</td>";
				echo "<td><a href='".base_url()."masterdata/role_proses/delete/$u->USER_USERNAME/$u->PERUSAHAAN_ID' onclick=\"return confirm('Anda yakin?')\" class='btn btn-default glyphicon glyphicon-trash'></a></td></tr>";
			}
		?>
	</tbody>
</table>
</div>