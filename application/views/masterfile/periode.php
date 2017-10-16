<div id="createuser" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Periode</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>masterdata/periode_proses/tambah">
		<div class="modal-body">
		<table class="form">
		  <tr><td>Kode Periode: </td><td><input required type="text" name="kode"></td></tr>
		  <tr><td>Nama Periode: </td><td><input required type="text" name="nama"></td></tr>
		  <tr><td>Dari : </td><td><input class="tglo" type="text" name="dari"></td></tr>
		   <tr><td>Sampai : </td><td><input  class="tglo" type="text" name="sampai"></td></tr>
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
        <h4 class="modal-title">Edit Periode</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>masterdata/periode_proses/update">
		<div class="modal-body">
		<table class="form">
			<tr><td>Kode Periode: </td><td><input readonly required type="text" name="kode"></td></tr>
		  <tr><td>Nama Periode: </td><td><input required type="text" name="nama"></td></tr>
		  <tr><td>Dari : </td><td><input class="tglo" type="text" name="dari"></td></tr>
		   <tr><td>Sampai : </td><td><input class="tglo" type="text" name="sampai"></td></tr>
		   <tr><td>Status : </td><td><select name="status"><option value=1>Aktif</option><option value=0>Tidak Aktif</option></select></tr>		
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
	<h3>Masterfile Periode</h3>
	<p>Fitur ini digunakan untuk mengelola data Periode pada sistem.
</div>


<div class="row">
	<div class="col-sm-3 col-xs-3">
		<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createuser">+ Add Periode</button>
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
			<th>Kode Periode</th>
			<th>Nama Periode</th>
			<th>Dari</th>
			<th>Sampai</th>
			<th>Status</th>
			<th>Config</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($user as $u){
				echo "<tr><td>$u->kperiode</td><td>$u->nperiode</td><td>$u->dperiode</td><td>$u->speriode</td>";
				echo "<td>";
				if($u->status==1) echo "Aktif";
				if($u->status==0) echo "Tidak Aktif";
				echo "</td>";
				echo "<td><a href='#' data-id='$u->kperiode' data-toggle='modal' data-target='#edituser' class='editButton btn btn-default glyphicon glyphicon-pencil'></a><a href='".base_url()."masterdata/periode_proses/delete/$u->kperiode' onclick=\"return confirm('Anda yakin?')\" class='btn btn-default glyphicon glyphicon-trash'></a></td></tr>";
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
            url: "<?php echo base_url(); ?>masterdata/periode_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#edituser')
                .find('[name="kode"]').val(response.kperiode).end()
                .find('[name="nama"]').val(response.nperiode).end()
                .find('[name="dari"]').val(response.dperiode).end()
                .find('[name="sampai"]').val(response.speriode).end()
                .find('[name="status"]').val(response.status).end();
			}
		});
	});
});
</script>