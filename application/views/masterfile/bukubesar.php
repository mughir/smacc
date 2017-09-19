<div id="createuser" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Jenis Jurnal</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>masterdata/jenis_jurnal_proses/tambah">
		<div class="modal-body">
		<table class="form">
		  <tr><td>Kode: </td><td><input required type="text" name="kode"></td></tr>
		  <tr><td>Nama : </td><td><input required type="text" name="nama"></td></tr>
		  <tr><td>Company code : </td><td><select name="cocd"><option value="penjual">penjual</option><option value="pembeli">pembeli</option></select></td></tr>
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
        <h4 class="modal-title">Edit Jenis Jurnal</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>masterdata/jenis_jurnal_proses/update">
		<div class="modal-body">
		<table class="form">
		  <tr><td>Kode: </td><td><input required type="text" name="kode" value=""><td><input readonly required type="hidden" name="kodelama" value=""></td></tr>
		  <tr><td>Nama: </td><td><input required type="text" name="nama" value=""></td></tr>
		  <tr><td>Company code : </td><td><select name="cocd"><option value="penjual">penjual</option><option value="pembeli">pembeli</option></select></td></tr>
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
	<h3>Masterfile Jenis Jurnal</h3>
	<p>Fitur ini digunakan untuk mengelola data Jenis Jurnal pada sistem.
</div>


<div class="row">
	<div class="col-sm-3 col-xs-3">
		<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createuser">+ Add Jenis</button>
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
			<th>Kode</th>
			<th>Nama - Deskripsi kode</th>
			<th>Cocd</th>
			<th>Config</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($user as $u){
				echo "<tr><td>$u->JENIS_JURNAL_KODE</td><td>$u->JENIS_JURNAL_NAMA</td><td>$u->JENIS_JURNAL_COCD</td>";
				echo "<td><a href='#' data-id='$u->JENIS_JURNAL_KODE' data-toggle='modal' data-target='#edituser' class='editButton btn btn-default glyphicon glyphicon-pencil'></a><a href='".base_url()."masterdata/jenis_jurnal_proses/delete/$u->JENIS_JURNAL_KODE' onclick=\"return confirm('Anda yakin?')\" class='btn btn-default glyphicon glyphicon-trash'></a></td></tr>";
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
            url: "<?php echo base_url(); ?>masterdata/jenis_jurnal_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#edituser')
				.find('[name="kodelama"]').val(response.JENIS_JURNAL_KODE).end()
                .find('[name="kode"]').val(response.JENIS_JURNAL_KODE).end()
                .find('[name="nama"]').val(response.JENIS_JURNAL_NAMA).end()
                .find('[name="cocd"]').val(response.JENIS_JURNAL_COCD).end()
			}
		});
	});
});
</script>