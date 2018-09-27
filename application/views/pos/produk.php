<div id="createProduk" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Produk</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>pos/produk/?tipe=tambah">
		<div class="modal-body">
		<table class="form">
		  <tr><td>ID Barang </td><td><select autocomplete="off" required type="text" name="id"><option></option><?php foreach($barang as $b) echo "<option value='$b->idbarang'>$b->idbarang - $b->nbarang</option>"; ?></select></td></tr>
		  <tr><td>Harga : </td><td><input type="number" name="harga" value=0 min=1></td></tr>
		  <tr><td>Diskon : </td><td><input type="number" name="diskon" value=0></td></tr>  
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

<div id="editProduk" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Produk</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>pos/produk/?tipe=update">
		<div class="modal-body">
		<table class="form">
		  <tr><td>ID Barang </td><td><input required readonly type="text" name="id"></td></tr>
		  <tr><td>Harga : </td><td><input type="number" name="harga"></td></tr>
		  <tr><td>Diskon : </td><td><input type="number" name="diskon"></td></tr>  
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
	<h3>Kontrol Produk</h3>
	<p>Fitur ini digunakan untuk mengatur barang yang akan dijual.
</div>


<div class="row">
	<div class="col-sm-3 col-xs-3">
		<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createProduk">+ Add Produk</button>
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
			<th>Nama</th>
			<th>Harga</th>
			<th>Diskon</th>
			<th>Status</th>
			<th>Conf</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($produk as $u){
				echo "
					<tr>
						<td>$u->idbarang</td>
						<td>$u->nbarang</td>
						<td>$u->hbarangkasir</td>
						<td>$u->disbarangkasir</td>
					";
				echo ($u->sbarangkasir==1) ? "<td>Aktif</td>" : "<td>Tidak Aktif</td>";
				echo "<td>
							<a href='#' data-id='$u->idbarang' data-toggle='modal' data-target='#editProduk' class='editButton btn btn-default glyphicon glyphicon-pencil'>
							</a>
							<a href='".base_url()."pos/produk/?tipe=delete&id=$u->idbarang' onclick=\"return confirm('Anda yakin?')\" class='btn btn-default glyphicon glyphicon-trash'>
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
            url: "<?php echo base_url(); ?>pos/produk_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#editProduk')
                .find('[name="id"]').val(response.idbarang).end()
                .find('[name="harga"]').val(response.hbarangkasir).end()
                .find('[name="diskon"]').val(response.disbarangkasir).end()
                .find('[name="status"]').val(response.sbarangkasir).end();
			}
		});
	});
});
</script>