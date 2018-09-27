<div id="createPengiriman" class="modal fade" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Pengiriman</h4>
      </div>
	  <form method="post" action="?tipe=tambah">
		<div class="modal-body">
	<table class="form"">		
		<tr>
			<td>Kode</td>
			<td><input type="text" name="id" required pattern="[a-zA-Z0-9]+"></td>
		</tr>		
		<tr>
			<td>ID Pesanan</td>
			<td><input type="text" name="pesanan" required pattern="[a-zA-Z0-9]+"> <!-- <button class="btn btn-default get-pesanan">Get</button></td> -->
		</tr>
		<tr>
			<td>Pemesan</td>
			<td><select name="pemesan" required><option value="" disabled>Silahkan Pilih</option><?php foreach($pembeli as $p){echo "<option value=\"$p->idkontak\">$p->nkontak</option>";} ?></select></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td><input class="tgl" type="text" name="tanggal" required max="<?php echo $this->session->userdata("periode_sampai") ?>" min="<?php echo $this->session->userdata("periode_dari") ?>" value="<?php echo date('Y-m-d'); ?>"></td>
		</tr>	
		<tr>
			<td>Term</td>
			<td><select name="term"><option value='fob_shipping_point'>FOB Shipping Point</option><option value='fob_destination_point'>FOB Destination Point</option></select></td>
		</tr>		
		<tr>
			<td>Biaya Pengiriman</td>
			<td><input type="number" name="biaya" min=0 value=0></select></td>
		</tr>
	 </table>
	 <br><br>

<div class="table-responsive">
		<table class='form detail'>
			<thead>
			  <tr><th>Produk</th><th>Jumlah</th></tr>
			 </thead>
			 <tbody>
					 <tr> 
					 	<td>
					 		<select required class='long changeble namabarang' list="barang" autocomplete="off" name="namabarang[]" placeholder="nama Produk" required>
					 				<option></option>
					 				<?php foreach($barang as $b){
	echo "<option value='$b->idbarang'>$b->idbarang - $b->nbarang</option>";
}
?>
					 		</select>
					 	</td>
					 	<td>
					 		<input  class='short jumlah changeble' type="number" min=1 max=1000 value=1 name='jumlah[]'>
					 	</td>
					 </tr>
					 <tr>
					 	<td colspan="2">
							<a href="#" class="addkeranjang btn btn-default">+</a> 
					 	</td>
					 </tr>
				</tbody>
		</table>
		</div>
      </div>
	  <br>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button> <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
	  </form>
    </div>

  </div>
</div>


<div id="editPengiriman" class="modal fade areaprint" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dokumen Pengiriman</h4>
      </div>
	  <form method="post" action="?tipe=tambah">
		<div class="modal-body">
	<table class="form"">		
	<tr>
			<td>ID</td>
			<td><input type="text" name="id" required pattern="[a-zA-Z0-9]+"></td>
		</tr>		
		<tr>
			<td>ID Pesanan</td>
			<td><input type="text" name="pesanan" required pattern="[a-zA-Z0-9]+"></td>
		</tr>
		<tr>
			<td>Pemesan</td>
			<td><select name="pemesan" required><option value="" diabled>Silahkan Pilih</option><?php foreach($pembeli as $p){echo "<option value=\"$p->idkontak\">$p->nkontak</option>";} ?></select></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td><input class="tgl" type="text" name="tanggal" required max="<?php echo $this->session->userdata("periode_sampai") ?>" min="<?php echo $this->session->userdata("periode_dari") ?>" value="<?php echo date('Y-m-d'); ?>"></td>
		</tr>	
		<tr>
			<td>Term</td>
			<td><select name="term"><option value='fob_shipping_point'>FOB Shipping Point</option><option value='fob_destination_point'>FOB Destination Point</option></select></td>
		</tr>		
		<tr>
			<td>Biaya Pengiriman</td>
			<td><input type="number" name="biaya" min=0 value=0></select></td>
		</tr>
		<tr>
			<td>Status Pengiriman Pengiriman</td>
			<td><input type="number" name="biaya" min=0 value=0></select></td>
		</tr>
	 </table>
	 <br><br>
<div class="table-responsive">
		<table class='form detail editdetail'>
			<thead>
			  <tr><th>Produk</th><th>Jumlah</th></tr>
			 </thead>
			 <tbody>
					 <tr> 
					 	<td>
					 		<input required type="text" class='long' list="barang" autocomplete="off" name="namabarang[]" placeholder="nama Produk" required>
					 	</td>
					 	<td>
					 		<input  class='short jumlah' type="number" min=1 max=1000 value=1 name='jumlah[]'>
					 	</td>
					 </tr>
				</tbody>
		</table>
		</div>
      </div>
	  <br>
	  </form>
    </div>
  </div>
</div>

<div class="dokumen">
<div class="well ">
	<h3>Fungsi Pengiriman</h3>
	<p>Fitur ini digunakan untuk mengelola pengiriman barang kepada pelanggan.</p>
</div>
	<div class="row">
		<div class="col-sm-3 col-xs-3">
			<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createPengiriman">+ Add Pengiriman</button>
		</div>
	</div>


<br><br>
<?=$this->M_Pesan->hasil() ?>

<div class="table-responsive">
<table class='table' id="ajaxtable">
	<thead>
		<tr>
			<th>ID</th>
			<th>Pemesan</th>
			<th>Tanggal</th>
			<th>Term</th>
			<th>Biaya</th>
			<th>Status</th>
			<th>Conf</th>
		</tr>
	</thead>	
	<tbody>
		<?php foreach($pengiriman as $p){
			echo "<tr>";
			echo "<td>$p->idpengiriman</td>";
			echo "<td>$p->idkontak - $p->nkontak</td>";
			echo "<td>$p->tpengiriman</td>";
			echo "<td>$p->termpengiriman</td>";
			echo "<td>$p->bpengiriman</td>";
			switch($p->stpengiriman){
				case "0":
					echo "<td>Belum Diproses</td>";
				break;
				case "1":
					echo "<td>Sudah Diproses</td>";
				break;
			}
			echo "<td>";
			echo "<a href='#' data-id='$p->idpengiriman' data-toggle='modal' data-target='#editPengiriman' class='editButton btn btn-default glyphicon glyphicon-eye-open'></a>";
			echo "<a href='".base_url()."penjualan/pengiriman/?tipe=delete&id=$p->idpengiriman' onclick=\"return confirm('Anda yakin?')\" class='btn btn-default glyphicon glyphicon-trash'>
							</a>
				</td>";
			echo "</tr>";
		}
	?>
	</tbody>
</table>
</div>
</div>
<script>
$(document).ready(function() {
	var data = [<?php foreach($barang as $b){echo "{id:'$b->idbarang', text:'$b->nbarang'},";}?>];

	$(document).on('click',".delete",function() {
		$(this).parent().parent().empty();
	});
	//ediit Pesanan
    $('.editButton').on('click', function() {
        // tarik record
        var id = $(this).attr('data-id');

        //ajax header
        $.ajax({
            url: "<?php echo base_url(); ?>penjualan/pengiriman_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#editPengiriman')
                .find('[name="id"]').val(response.idpengiriman).end()
                .find('[name="pesanan"]').val(response.idpesanan).end()
                .find('[name="pemesan"]').val(response.idkontak).end()
                .find('[name="term"]').val(response.termpengiriman).end()
				.find('[name="tanggal"]').val(response.tpengiriman).end()
                .find('[name="biaya"]').val(response.bpengiriman).end();
			}
		});//end ajax header

   		 //request
   		$(".editdetail").empty();

   		var judul = $("<tr>");
   		judul.append ($("<th>Produk</th><th>Jumlah</th>"))
   		judul.append ($("</tr>"))

   		$(".editdetail").append(judul);

        //ajax detail
        $.ajax({
            url: "<?php echo base_url(); ?>penjualan/pengiriman_detail_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            
		      $.each(response, function(index, value){
		      //alert(value);
		      	var produk = value.idbarang;
		      	var jumlah = value.jumlah;

		      	  var akun = $("<tr>");

				  akun.append($("<td><select value='"+produk+"' list='barang' class='long changeble' autocomplete='off' name='namabarang[]' placeholder='Nama Produk'><option></option></select></td>"))
						 .append($("<td><input class='jumlah short changeble' value='"+jumlah+"' short' name='jumlah[]' type='number' value=1 min=1></td>")) 
			 .append($("</tr>"));
				akun.find('select').select2({
					placeholder: "Silahkan Pilih", 
					data: data,
					containerCssClass: 'long changeble namabarang',
				}).val(produk).trigger("change");
				$(".editdetail").append(akun);
		      }) // each
		     // $(".editdetail").append("<tr><td colspan=4><a href=\"#\" class=\"addkeranjang btn btn-default\">+</a> </td></tr>");
			}
		});//end ajax detail

	});//end edit Pesanan

	//add keranjang dalam Pesanan
	$(document).on('click',".addkeranjang",function() {
	  var row = $("<tr>");

	  row.append($("<td><input type='text' list='barang' class='long changeble' autocomplete='off' name='namabarang[]' placeholder='Nama Produk'></td>"))
		 .append($("<td><input class='jumlah short changeble' name='jumlah[]' type='number' value=1 min=1></td>")) 

		 .append($("<td><a href='#' class='glyphicon glyphicon-remove delete'></a></td>"))	
	 .append($("</tr>"));
	 
	  $(this).parent().parent().before(row);
		$(".namabarang").select2({
		placeholder: "Silahkan Pilih", 
		data: data
		});
	  $("#daftar").scrollTop($("#daftar")[0].scrollHeight);
	  return false;
	})
}); //end document
</script>