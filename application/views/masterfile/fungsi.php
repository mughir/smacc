
<div id="edituser" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit fungsi</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>masterdata/fungsi_proses/update">
		<div class="modal-body">
		<table class="form">
			<input readonly required type="hidden" name="pt" value="">
<input readonly required type="hidden" name="id" value="">
		  <tr><td>Status Fungsi : </td><td><select name="status"><option value="1">Aktif</option><option value="0">Tidak Aktif</option></select></td></tr> 
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
	<h3>Masterfile fungsi</h3>
	<p>Fitur ini digunakan untuk mengelola data fungsi pada sistem.
</div>

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
			<th>ID fungsi</th>
			<th>Nama</th>
			<th>Status</th>
			<th>Config</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($fungsi as $u){
			echo	"<td>$u->idfungsi</td><td>$u->nfungsi</td>";

			if($u->sfungsi=="1"){
				echo "<td>Aktif</td>";
				}
				else{
					echo "<td>Tidak aktif</td>";
				}
			echo "<td><a href='#' data-id='$u->idfungsi' data-toggle='modal' data-target='#edituser' class='editButton btn btn-default glyphicon glyphicon-pencil'></a></td></tr>";
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
            url: "<?php echo base_url(); ?>masterdata/fungsi_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#edituser')
                .find('[name="id"]').val(response.idfungsi).end()
                .find('[name="status"]').val(response.sfungsi).end();
			}
		});
	});
});
</script>