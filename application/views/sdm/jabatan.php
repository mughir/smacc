<div id="createJabatan" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Jabatan</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>sdm/jabatan_proses/tambah">
		<div class="modal-body">
		<table class="form">
		  <tr><td>ID: </td><td><input required type="text" name="id"></td></tr>
		  <tr><td>Nama Jabatan : </td><td><input required type="text" name="nama"></td></tr>
		  <tr><td>Gapok : </td><td><input required type="number" name="gapok"></td></tr>
		  <tr><td>Tunjangan : </td><td><input required type="number" name="tunjangan"></td></tr>
		  <tr><td>Periode : </td><td><input required type="text" name="periode"></td></tr>
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

<div id="editJabatan" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Jabatan</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>sdm/jabatan_proses/update">
		<div class="modal-body">
		<table class="form">
		  <tr><td>ID: </td><td><input required type="text" name="id"></td></tr>
		  <tr><td>Nama Jabatan : </td><td><input required type="text" name="nama"></td></tr>
		  <tr><td>Gapok : </td><td><input required type="number" name="gapok"></td></tr>
		  <tr><td>Tunjangan : </td><td><input required type="number" name="tunjangan"></td></tr>
		  <tr><td>Periode : </td><td><input required type="text" name="periode"></td></tr>
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
	<h3>Fungsi Jabatan</h3>
	<p>Fitur ini digunakan untuk mengelola data Jabatan.</p>
</div>


<div class="row">
	<div class="col-sm-3 col-xs-3">
		<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createJabatan">+ Add Jabatan</button>
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
			<th>ID</th>
			<th>Nama Jabatan</th>
			<th>Gaji</th>
			<th>Tunjangan</th>
			<th>Periode</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach($jabatan as $u){
				echo "
					<tr>
						<td>$u->idjabatan</td>
						<td>$u->njabatan</td>
						<td>$u->gapok</td>
						<td>$u->tunjangan</td>
						<td>$u->periode</td>
						<td>
							<a href='#' data-id='$u->idjabatan' data-toggle='modal' data-target='#editJabatan' class='editButton btn btn-default glyphicon glyphicon-pencil'>
							</a>
							<a href='".base_url()."sdm/jabatan_proses/delete/$u->idjabatan' onclick=\"return confirm('Anda yakin?')\" class='btn btn-default glyphicon glyphicon-trash'>
							</a>
						</td>
					</tr>
					";
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
            url: "<?php echo base_url(); ?>sdm/jabatan_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#editJabatan')
                .find('[name="id"]').val(response.idjabatan).end()
                .find('[name="nama"]').val(response.njabatan).end()
                .find('[name="gapok"]').val(response.gapok).end()
                .find('[name="tunjangan"]').val(response.tunjangan).end()
                .find('[name="periode"]').val(response.periode).end();
			}
		});
	});
});
</script>