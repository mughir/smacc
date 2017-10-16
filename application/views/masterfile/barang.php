<div id="createbarang" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add barang</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>masterdata/barang_proses/tambah">
		<div class="modal-body">
		<table class="form">
		  <tr><td>ID barang: </td><td><input required type="text" name="id"></td></tr>
		  <tr><td>Kategori : </td><td><select required name="kategori"><option value="Barang Dagang">Barang Dagang</option><option value="Material">Material</option></select></td></tr>
		  <tr><td>Segment 1 : </td><td><input type="text" name="segment1"></td></tr>
		  <tr><td>Segment 2 : </td><td><input type="text" name="segment2"></td></tr>
		  <tr><td>Segment 3 : </td><td><input type="text" name="segment3"></td></tr>
		  <tr><td>Nama : </td><td><input type="text" name="nama"></td></tr>
		  <tr><td>Satuan : </td><td><input type="text" name="satuan"></td></tr>
		  <tr><td>Jumlah : </td><td><input type="number" name="jumlah"></td></tr>
		  <tr><td>Biaya : </td><td><input required type="number" name="biaya"></td></tr>
		  <tr><td>Harga : </td><td><input required type="number" name="harga"></td></tr>
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

<div id="editbarang" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit barang</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>masterdata/barang_proses/update">
		<div class="modal-body">
		<table class="form">
		  <tr><td>ID barang: </td><td><input required type="text" name="id"></td></tr>
		  <tr><td>Kategori : </td><td><input required type="text" name="kategori"></td></tr>		  
		  <tr><td>Segment 1 : </td><td><input type="text" name="segment1"></td></tr>
		  <tr><td>Segment 2 : </td><td><input type="text" name="segment2"></td></tr>
		  <tr><td>Segment 3 : </td><td><input type="text" name="segment3"></td></tr>
		  <tr><td>Nama : </td><td><input type="text" name="nama"></td></tr>
		  <tr><td>Satuan : </td><td><input type="text" name="satuan"></td></tr>
		  <tr><td>Jumlah : </td><td><input type="number" name="jumlah"></td></tr>
		  <tr><td>Biaya : </td><td><input required type="number" name="biaya"></td></tr>
		  <tr><td>Harga : </td><td><input required type="number" name="harga"></td></tr>
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
	<h3>Masterfile barang</h3>
	<p>Fitur ini digunakan untuk mengelola data barang pada sistem.
</div>


<div class="row">
	<div class="col-sm-3 col-xs-3">
		<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createbarang">+ Add barang</button>
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
			<th>Kategori</th>
			<th>Nama</th>
			<th>Satuan</th>
			<th>Jumlah</th>
			<th>Biaya</th>
			<th>Harga</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($barang as $u){
				echo "
					<tr>
						<td>$u->idbarang</td>
						<td>$u->katbarang</td>
						<td>$u->nbarang</td>
						<td>$u->satbarang</td>
						<td>$u->jumlah</td>
						<td>$u->cbarang</td>
						<td>$u->hjualbarang</td>
						<td>
							<a href='#' data-id='$u->idbarang' data-toggle='modal' data-target='#editbarang' class='editButton btn btn-default glyphicon glyphicon-pencil'>
							</a>
							<a href='".base_url()."masterdata/barang_proses/delete/$u->idbarang' onclick=\"return confirm('Anda yakin?')\" class='btn btn-default glyphicon glyphicon-trash'>
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
            url: "<?php echo base_url(); ?>masterdata/barang_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#editbarang')
                .find('[name="id"]').val(response.idbarang).end()
                .find('[name="kategori"]').val(response.katbarang).end()
                .find('[name="segment1"]').val(response.segment1).end()
                .find('[name="segment2"]').val(response.segment2).end()
                .find('[name="segment3"]').val(response.segment3).end()
                .find('[name="nama"]').val(response.nbarang).end()
                .find('[name="satuan"]').val(response.satbarang).end()
                .find('[name="jumlah"]').val(response.jumlah).end()
                .find('[name="biaya"]').val(response.cbarang).end()
                .find('[name="harga"]').val(response.hjualbarang).end();
			}
		});
	});
});
</script>