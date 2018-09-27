<div id="createKaryawan" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Karyawan</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>sdm/karyawan_proses/tambah">
		<div class="modal-body">
		<table class="form">
		  <tr><td>ID: </td><td><input required type="text" name="id"></td></tr>
		  <tr><td>Nama : </td><td><input required type="text" name="nama"></td></tr>
		  <tr><td>Alamat : </td><td><input type="text" required name="alamat"></td></tr>
		  <tr><td>Telepon : </td><td><input type="text" required name="telepon"></td></tr>
		  <tr><td>Jabatan : </td><td><input type="text" required name="jabatan"></td></tr>
		  <tr><td>Status Nikah : </td><td><input type="number" required min=0 max=1 name="nikah"></td></tr>
		  <tr><td>Tanggungan : </td><td><input type="number" required name="tanggungan" max=3></td></tr>
		  <tr><td>Penggabungan gaji : </td><td><input type="number" name="gabung" max=1></td></tr>
		  <tr><td>Penambah/Pengurang Penghasilan: </td><td><input type="number" name="var"></td></tr>
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

<div id="editKaryawan" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Karyawan</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>sdm/karyawan_proses/update">
		<div class="modal-body">
		<table class="form">
		  <tr><td>ID: </td><td><input required type="text" name="id"></td></tr>
		  <tr><td>Nama : </td><td><input required type="text" name="nama"></td></tr>
		  <tr><td>Alamat : </td><td><input type="text" required name="alamat"></td></tr>
		  <tr><td>Telepon : </td><td><input type="text" required name="telepon"></td></tr>
		  <tr><td>Jabatan : </td><td><input type="text" required name="jabatan"></td></tr>
		  <tr><td>Status Nikah : </td><td><input type="number" required min=0 max=1 name="nikah"></td></tr>
		  <tr><td>Tanggungan : </td><td><input type="number" required name="tanggungan" max=3></td></tr>
		  <tr><td>Penggabungan gaji : </td><td><input type="number" required name="gabung" max=1></td></tr>
		  <tr><td>Penambah/Pengurang : </td><td><input type="number" name="var"></td></tr>
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
	<h3>Fungsi karyawan</h3>
	<p>Fitur ini digunakan untuk mengelola data karyawan.</p>
</div>


<div class="row">
	<div class="col-sm-3 col-xs-3">
		<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createKaryawan">+ Add Karyawan</button>
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
			<th>Nama Pegawai</th>
			<th>Jabatan</th>
			<th>Telepon</th>
			<th>Alamat</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach($karyawan as $u){
				echo "
					<tr>
						<td>$u->idpegawai</td>
						<td>$u->npegawai</td>
						<td>$u->idjabatan - $u->njabatan</td>
						<td>$u->telpegawai</td>
						<td>$u->alpegawai</td>
						<td>$u->stpegawai</td>
						<td>
							<a href='#' data-id='$u->idpegawai' data-toggle='modal' data-target='#editKaryawan' class='editButton btn btn-default glyphicon glyphicon-pencil'>
							</a>
							<a href='".base_url()."sdm/karyawan_proses/delete/$u->idpegawai' onclick=\"return confirm('Anda yakin?')\" class='btn btn-default glyphicon glyphicon-trash'>
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
            url: "<?php echo base_url(); ?>sdm/karyawan_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#editKaryawan')
                .find('[name="id"]').val(response.idpegawai).end()
                .find('[name="nama"]').val(response.npegawai).end()
                .find('[name="alamat"]').val(response.alpegawai).end()
                .find('[name="telepon"]').val(response.telpegawai).end()
                .find('[name="jabatan"]').val(response.idjabatan).end()
                .find('[name="nikah"]').val(response.stnikah).end()
                .find('[name="tanggungan"]').val(response.tanggungan).end()
                .find('[name="gabung"]').val(response.gabung).end()
                .find('[name="var"]').val(response.vartambahan).end();
			}
		});
	});
});
</script>