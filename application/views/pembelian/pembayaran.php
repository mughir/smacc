<div id="createPembayaran" class="modal fade" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Pembayaran</h4>
      </div>
	  <form method="post" action="?tipe=tambah">	
	  <div class="modal-body">
		<table class="form">
			<thead>
			<tr><td>ID</td><td><input type="text"  name="id" required pattern="[a-zA-Z0-9]+"></td></tr>
			<tr><td>Tanggal</td><td><input type="text" name="tanggal" class='tgl' required></td></tr>
			<tr><td>No tagihan</td><td><input type="text" name="tagihan"></td></tr>
			<tr><td>Jumlah Bayar</td><td><input type="number" name="bayar"></td></tr>
			<tr><td>Via</td><td><input type="text" name="via"></td></tr>
			<tr><td>Keterangan</td><td><input type="text" name="ket"></td></tr>
			</thead>
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


<div id="editPembayaran" class="modal fade areaprint" role="dialog">
  <div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Pembayaran</h4>
      </div>
	  <form method="post" action="?tipe=update">	
	  <div class="modal-body">
		<table class="form">
			<thead>
			<tr><td>ID</td><td><input type="text"  name="id" required pattern="[a-zA-Z0-9]+"></td></tr>
			<tr><td>Tanggal</td><td><input type="date" name="tanggal"></td></tr>
			<tr><td>No tagihan</td><td><input type="text" name="tagihan"></td></tr>
			<tr><td>Jumlah Bayar</td><td><input type="number" name="bayar"></td></tr>
			<tr><td>Via</td><td><input type="text" name="via"></td></tr>
			<tr><td>Keterangan</td><td><input type="text" name="ket"></td></tr>
		</table>
      </div>
	  <br>
	  </form>
    </div>

  </div>
</div>




<div class="dokumen">

	<div class="well ">
	<h3>Fungsi Pembayaran</h3>
	<p>Fitur ini digunakan untuk mencatat pembayaran dari pelanggan.</p>
	</div>

	<div class="row">
		<div class="col-sm-3 col-xs-3">
			<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createPembayaran">+ Add Pembayaran</button>
		</div>
	</div>
	<br><br>

<table class='table' id="ajaxtable">
	<thead>
		<tr>
			<th>No Pembayaran</th>
			<th>Tanggal</th>
			<th>No Tagihan</th>
			<th>Jumlah Bayar</th>
			<th>Via</th>
			<th>Keterangan</th>
			<th>Conf</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		foreach($bayar as $b){
			echo "<tr>";
				echo "<td>$b->idpembayaran</td>";
				echo "<td>$b->idtagihan</td>";
				echo "<td>$b->tglbayar</td>";
				echo "<td>$b->jmbayar</td>";
				echo "<td>$b->via</td>";
				echo "<td>$b->ket</td>";
				echo "<td>
							<a href='#' data-id='$b->idpembayaran' data-toggle='modal' data-target='#editPembayaran' class='editButton btn btn-default glyphicon glyphicon-eye-open'>
							</a>
							<a href='".base_url()."pembelian/pembayaran/?tipe=delete&id=$b->idpembayaran' onclick=\"return confirm('Anda yakin?')\" class='btn btn-default glyphicon glyphicon-trash'>
							</a>
					</td>";
			echo "</tr>";
		}
	 ?>
	</tbody>
</table>
</div>

<script>
$(document).ready(function() {
	barang();
	function barang(){
		var data = [
			<?php 
				foreach($barang as $b)
					{
						echo "{";
							echo "id:'$b->idbarang',";
							echo "text:'$b->nbarang',";
						echo "},";
					}
					?>
				];
	
    $('.barang').select2({
		  data: data
		})
	}
	//ediit Pembayaran
    $('.editButton').on('click', function() {
        // tarik record
        var id = $(this).attr('data-id');

        //ajax header
        $.ajax({
            url: "<?php echo base_url(); ?>pembelian/pembayaran_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#editPembayaran')
                .find('[name="id"]').val(response.idpembayaran).end()
                .find('[name="tanggal"]').val(response.tglbayar).end()
                .find('[name="tagihan"]').val(response.idtagihan).end()
                .find('[name="bayar"]').val(response.jmbayar).end()
				.find('[name="via"]').val(response.via).end()
                .find('[name="ket"]').val(response.ket).end();
			}
		});//end ajax header
	});//end edit Pembayaran
	


	//add akun dalam Pembayaran
	$(document).on('click',".addakun",function() {
	  var row = $("<tr>");

	  row.append($("<td><input type='text' list='produk' class='namaakun' autocomplete='off' name='namaakun[]' placeholder='Nama Produk'></td>"))
		 .append($("<td><input name='debit[]' type='number' value=1 min=1 max=1000></td>")) 
		 .append($("<td><input name='debit[]' type='number' value=0  ></td>"))
		 .append($("<td><input value=0 name='kredit[]' type='number' disabled></td>"))
	 .append($("</tr>"));
	 
	  $(this).before(row);

	  $("#daftar").scrollTop($("#daftar")[0].scrollHeight);
	  return false;
	})
}); //end document
</script>