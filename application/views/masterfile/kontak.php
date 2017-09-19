<div id="createuser" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add kontak</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>masterdata/kontak_proses/tambah">
		<div class="modal-body">
		<table class="form">
		  <tr><td>Id kontak: </td><td><input required type="text" name="id"></td></tr>
		  <tr><td>Jenis: </td><td><select required name="jenis"><option value="1">Vendor</option><option value="2">Pelanggan</option><option value="3">Vendor & Pelanggan</option><option value="4">Lainnya</option></select></td></tr>
		  <tr><td>Nama kontak : </td><td><input required type="text" name="nama"></td></tr>
		  <tr><td>Alamat : </td><td><input required type="text" name="alamat"></td></tr>
		  <tr><td>Telepon : </td><td><input required type="text" name="telepon"></td></tr>
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

<div id="edituser" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit kontak</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>masterdata/kontak_proses/update">
		<div class="modal-body">
		<table class="form">
		  <tr><td>Id kontak: </td><td><input required type="text" name="id"></td></tr>
		  <tr><td>Jenis: </td><td><select required name="jenis"><option value="1">Vendor</option><option value="2">Pelanggan</option><option value="3">Vendor & Pelanggan</option><option value="4">Lainnya</option></select></td></tr>
		  <tr><td>Nama kontak : </td><td><input required type="text" name="nama"></td></tr>
		  <tr><td>Alamat : </td><td><input required type="text" name="alamat"></td></tr>
		  <tr><td>Telepon : </td><td><input required type="text" name="telepon"></td></tr>
		
		   <tr><td>Status kontak: </td><td><select name="status"><option value="aktif">Aktif</option><option value="tidak">Tidak Aktif</option></select></td></tr>
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
	<h3>Masterfile kontak</h3>
	<p>Fitur ini digunakan untuk mengelola data kontak external pada sistem.
</div>


<div class="row">
	<div class="col-sm-3 col-xs-3">
		<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createuser">+ Add kontak</button>
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
			<th>ID kontak</th>
			<th>Jenis</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>Telepon</th>
			<th>Status</th>
			<th>Config</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($user as $u){
				echo "<tr><td>$u->idkontak</td>";
					switch($u->jkontak){
						case "1":
							echo "<td>Vendor</td>";
						break;
						case "2":
							echo "<td>Customer</td>";
						break;
						case "3":
							echo "<td>Vendor & Customer</td>";
						break;
						case "4":
							echo "<td>Lainnya</td>";
						break;
						default:
							echo "<td></td>";
						break;
					}
				echo "<td>$u->nkontak</td><td>$u->alkontak</td><td>$u->telkontak</td>";
				if($u->stkontak=="aktif"){
					echo "<td>Aktif</td>";
				}
				else{
					echo "<td>Tidak aktif</td>";
				}
				echo "<td><a href='#' data-id='$u->idkontak' data-toggle='modal' data-target='#edituser' class='editButton btn btn-default glyphicon glyphicon-pencil'></a><a href='".base_url()."masterdata/kontak_proses/delete/$u->idkontak' onclick=\"return confirm('Anda yakin?')\" class='btn btn-default glyphicon glyphicon-trash'></a></td></tr>";
			}
		?>
	</tbody>
</table>
</div>
<script>
$(document).ready(function() {
    $('.editButton').on('click', function() {
        // tarik record
        var id = $(this).attr('data-id');

        $.ajax({
            url: "<?php echo base_url(); ?>masterdata/kontak_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#edituser')
                .find('[name="id"]').val(response.idkontak).end()
                .find('[name="jenis"]').val(response.jkontak).end()
                .find('[name="nama"]').val(response.nkontak).end()
                .find('[name="alamat"]').val(response.alkontak).end()
                .find('[name="telepon"]').val(response.telkontak).end()
                .find('[name="status"]').val(response.stkontak).end();
			}
		});
	});
});
</script>