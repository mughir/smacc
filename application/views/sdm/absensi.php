<div id="createAbsensi" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Absensi</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>masterdata/Absensi_proses/tambah">
		<div class="modal-body">
		<table class="form">
		  <tr><td>ID: </td><td><input required type="text" name="id"></td></tr>
		  <tr><td>No Absensi : </td><td><input required type="text" name="kategori"></td></tr>
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

<div id="editAbsensi" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Absensi</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>masterdata/Absensi_proses/update">
		<div class="modal-body">
		<table class="form">
		  <tr><td>ID: </td><td><input required type="text" name="id"></td></tr>
		  <tr><td>No Absensi : </td><td><input required type="text" name="kategori"></td></tr>
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
	<h3>Fungsi Absensi</h3>
	<p>Fitur ini digunakan untuk mengelola data Absensi.</p>
</div>


<div class="row">
	<div class="col-sm-3 col-xs-3">
		<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createAbsensi">+ Add Absensi</button>
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
			<th>No Absensi</th>
		</tr>
	</thead>
	<tbody>
		<?php /*
			foreach($Absensi as $u){
				echo "
					<tr>
						<td>$u->idAbsensi</td>
						<td>$u->katAbsensi</td>
						<td>$u->nAbsensi</td>
						<td>$u->satAbsensi</td>
						<td>
							<a href='#' data-id='$u->idAbsensi' data-toggle='modal' data-target='#editAbsensi' class='editButton btn btn-default glyphicon glyphicon-pencil'>
							</a>
							<a href='".base_url()."masterdata/Absensi_proses/delete/$u->idAbsensi' onclick=\"return confirm('Anda yakin?')\" class='btn btn-default glyphicon glyphicon-trash'>
							</a>
						</td>
					</tr>
					";
			}
	*/	?>
	</tbody>
</table>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>Absensi/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Absensi/js/jquery.datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>Absensi/css/jquery.datetimepicker.css"/>
<script>
$(document).ready(function() {
	
		$('.date').datetimepicker()
		.datetimepicker({timepicker:false,format: 'd-M-Y',mask:'39-19-9999'});
    $('.editButton').on('click', function() {
        // tarik record
        var id = $(this).attr('data-id');

        $.ajax({
            url: "<?php echo base_url(); ?>masterdata/Absensi_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#editAbsensi')
                .find('[name="id"]').val(response.idAbsensi).end()
                .find('[name="kategori"]').val(response.katAbsensi).end()
                .find('[name="nama"]').val(response.nAbsensi).end()
                .find('[name="satuan"]').val(response.satAbsensi).end()
                .find('[name="jumlah"]').val(response.jumlah).end()
                .find('[name="biaya"]').val(response.cAbsensi).end()
                .find('[name="harga"]').val(response.hjualAbsensi).end();
			}
		});
	});
});
</script>