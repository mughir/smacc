<div id="createSpot" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Spot</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>pos/point/?tipe=tambah">
		<div class="modal-body">
		<table class="form">
		  <tr><td>Nama Printer : </td><td><input required type="text" name="nama"></td></tr>
		  <tr><td>IP : </td><td><input type="text" name="ip"></td></tr>
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

<div id="editSpot" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Spot</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>pos/point/?tipe=update">
		<div class="modal-body">
		<table class="form">
		  <tr><td>ID: </td><td><input required type="text" name="id" readonly></td></tr>
		  <tr><td>Nama Printer : </td><td><input required type="text" name="nama"></td></tr>
		  <tr><td>IP : </td><td><input type="text" name="ip"></td></tr>
		  <tr><td>Status : </td><td><select name="status"><option value="1">Aktif</option><option value="0">Tidak Aktif</option></select></td></tr>
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
	<h3>Kontrol Spot</h3>
	<p>Fitur ini digunakan untuk mengelola spot penjualan yang diisi oleh kasir.
</div>


<div class="row">
	<div class="col-sm-3 col-xs-3">
		<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createSpot">+ Add Spot</button>
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
			<th>Nama Printer</th>
			<th>IP</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach($spot as $u){
				echo "
					<tr>
						<td>$u->idkasir</td>
						<td>$u->nmesin</td>
						<td>$u->ipkasir</td>
					";
				echo ($u->skasir==1) ? "<td>Aktif</td>" : "<td>Tidak Aktif</td>";
				echo "<td>
							<a href='#' data-id='$u->idkasir' data-toggle='modal' data-target='#editSpot' class='editButton btn btn-default glyphicon glyphicon-pencil'>
							</a>
							<a href='".base_url()."pos/point/?tipe=delete&id=$u->idkasir' onclick=\"return confirm('Anda yakin?')\" class='btn btn-default glyphicon glyphicon-trash'>
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
            url: "<?php echo base_url(); ?>pos/point_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#editSpot')
                .find('[name="id"]').val(response.idkasir).end()
                .find('[name="nama"]').val(response.nmesin).end()
                .find('[name="ip"]').val(response.ipkasir).end()
                .find('[name="status"]').val(response.skasir).end();
			}
		});
	});
});
</script>