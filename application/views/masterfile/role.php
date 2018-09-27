<div id="createrole" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Role</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>masterdata/role_proses/tambah">
		<div class="modal-body">
		<table class="form">
				<tr>
					<td>Nama Role</td>
					<td>
						<input type="text" name="nama" required>
					</td>
				</tr>
				<tr>
					<td>Fungsi</td>
					<td>
						<select multiple name="fungsi[]" required>
							<option></option>
							<?php
								foreach($fungsi as $f) echo "<option value='$f->idfungsi'>$f->nfungsi</option>";
							?>
						</select>
					</td>
				</tr>
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

<div id="editrole" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Role</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>masterdata/role_proses/update">
		<div class="modal-body">
		<table class="form">
						<input type="hidden" name="id" required>
				<tr>
					<td>Nama Role</td>
					<td>
						<input type="text" name="nama" required>
					</td>
				</tr>
				<tr>
					<td>Fungsi</td>
					<td>
						<select multiple name="fungsi[]" required>
							<option></option>
							<?php
								foreach($fungsi as $f) echo "<option value='$f->idfungsi'>$f->nfungsi</option>";
							?>
						</select>
					</td>
				</tr>
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
	<p>Fitur ini digunakan untuk mengelola fungsionalitas role.
</div>


<div class="row">
	<div class="col-sm-3 col-xs-3">
		<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createrole">+ Add Role</button>
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
			<th>Nama</th>
			<th>Config</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($role as $u){
				echo "<tr><td>$u->nrole</td>";	
				echo "<td><a href='#' data-id='$u->idrole' data-toggle='modal' data-target='#editrole' class='editButton btn btn-default glyphicon glyphicon-pencil'>
							</a><a href='".base_url()."masterdata/role_proses/delete/$u->idrole' onclick=\"return confirm('Anda yakin?')\" class='btn btn-default glyphicon glyphicon-trash'></a></td></tr>";
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
            url: "<?php echo base_url(); ?>masterdata/role_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from servervar 

            $('#editrole')
                .find('[name="id"]').val(response.idrole).end()
                .find('[name="nama"]').val(response.nrole).end();
 			$('#editrole').find('[name="fungsi[]"]').val(response.fungsi).trigger('change');

			}
		});
	});
});
</script>