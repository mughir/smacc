<div id="createPesanan" class="modal fade" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Pesanan</h4>
      </div>
	  <form method="post" action="?tipe=tambah">
		<div class="modal-body">
	<table class="form"">		
	<tr>
			<td>ID</td>
			<td><input type="text" name="id" required pattern="[a-zA-Z0-9]+"></td>
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
			<td>DP</td>
			<td><input type="number" name="dp" min=0 value=0></select></td>
		</tr>
	 </table>
	 <br><br>
		<table class='form detail'>
			<thead>
			  <tr><th>Produk</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th></tr>
			 </thead>
			 <tbody>
					 <tr> 
					 	<td>
					 		<select required class='long changeble' list="barang" autocomplete="off" name="namabarang[]" placeholder="nama Produk" required>
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
					 	<td>
					 		<input  class='harga' type="number" min=0 disabled value=0>
					 	</td>
					 	<td>
					 		<input  class='subtotal' type="number" min=0 disabled value=0>
					 	</td>
					 </tr>
					 <tr>
					 	<td colspan="4">
							<a href="#" class="addkeranjang btn btn-default">+</a> 
					 	</td>
					 </tr>
				</tbody>
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


<div id="editPesanan" class="modal fade areaprint" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dokumen Pesanan</h4>
      </div>
	  <form method="post" action="?tipe=tambah">
		<div class="modal-body">
	<table class="form"">		
	<tr>
			<td>ID</td>
			<td><input type="text" name="id" required pattern="[a-zA-Z0-9]+"></td>
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
			<td>DP</td>
			<td><input type="number" name="dp" min=0 value=0></select></td>
		</tr>
	 </table>
	 <br><br>
		<table class='form detail editdetail'>
			<thead>
			  <tr><th>Produk</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th></tr>
			 </thead>
			 <tbody>
					 <tr> 
					 	<td>
					 		<input required type="text" class='long' list="barang" autocomplete="off" name="namabarang[]" placeholder="nama Produk" required>
					 	</td>
					 	<td>
					 		<input  class='short jumlah' type="number" min=1 max=1000 value=1 name='jumlah[]'>
					 	</td>
					 	<td>
					 		<input  class='harga' type="number" min=0 disabled value=0>
					 	</td>
					 	<td>
					 		<input  class='subtotal' type="number" min=0 disabled value=0>
					 	</td>
					 </tr>
				</tbody>
		</table>
		
      </div>
	  <br>
	  </form>
    </div>

  </div>
</div>

<div class="dokumen">
<div class="well ">
	<h3>Fungsi Pesanan</h3>
	<p>Fitur ini digunakan untuk mengelola pesanan pembelian dari pelanggan.</p>
</div>
	<div class="row">
		<div class="col-sm-3 col-xs-3">
			<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createPesanan">+ Add Pesanan</button>
		</div>
	</div>


<br><br>
<?php if($this->session->flashdata('hasil')=="berhasil"){
	echo "<div class=\"alert alert-success\"><strong>Sukses!</strong> Operasi berhasil.</div>";
}
?>
<?php if($this->session->flashdata('hasil')=="gagal"){
	echo "<div class=\"alert alert-danger\"><strong>Gagal!</strong> Terdapat kesalahan, operasi gagal.</div>";
}
?>

<table class='table' id="ajaxtable">
	<thead>
		<tr>
			<th>ID</th>
			<th>Pemesan</th>
			<th>Tanggal</th>
			<th>Term</th>
			<th>DP</th>
			<th>Status</th>
			<th>Conf</th>
		</tr>
	</thead>	
	<tobdy>
		<?php foreach($pesanan as $p){
			echo "<tr>";
			echo "<td>$p->idpesanan</td>";
			echo "<td>$p->idkontak - $p->nkontak</td>";
			echo "<td>$p->tpesanan</td>";
			echo $p->termpengiriman=="fob_shipping_point" ? "<td>FOB Shipping Point</td>" : "<td>FOB Destination Point</td>";
			echo "<td>$p->dp</td>";
			switch($p->stpesanan){
				case "0":
					echo "<td>Belum Diproses</td>";
				break;
				case "1":
					echo "<td>Sudah Diproses</td>";
				break;
			}
			echo "<td>";
			echo "<a href='#' data-id='$p->idpesanan' data-toggle='modal' data-target='#editPesanan' class='editButton btn btn-default glyphicon glyphicon-eye-open'></a>";
			echo " <a href='".base_url()."penjualan/pesanan/?tipe=delete&id=$p->idpesanan' onclick=\"return confirm('Anda yakin?')\" class='btn btn-default glyphicon glyphicon-trash'></a>
				</td>";
			echo "</tr>";
		}
	?>
	</tbody>
</table>

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
            url: "<?php echo base_url(); ?>penjualan/pesanan_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#editPesanan')
                .find('[name="id"]').val(response.idpesanan).end()
                .find('[name="pemesan"]').val(response.idkontak).end()
                .find('[name="term"]').val(response.termpengiriman).end()
				.find('[name="tanggal"]').val(response.tpesanan).end()
                .find('[name="dp"]').val(response.dp).end();
			}
		});//end ajax header


   		 //request
        //ajax detail
        $.ajax({
            url: "<?php echo base_url(); ?>penjualan/pesanan_detail_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
   			$(".editdetail").empty();
	   		var judul = $("<tr>");
	   		judul.append ($("<th>Produk</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th>"))
	   		judul.append ($("</tr>"))
   			$(".editdetail").append(judul);

            // Populate the form fields with the data returned from server
		      $.each(response, function(index, value){
		      //alert(value);
		      	var produk = value.idbarang;
		      	var jumlah = value.jumlah;
		      	var harga = value.subtotal/value.jumlah;
		      	var subtotal = value.subtotal;

		      	  var akun = $("<tr>");

				  akun.append($("<td><select class='long changeble namabarang' autocomplete='off' name='namabarang[]' placeholder='Nama Produk'><option></option></select></td>"))
						 .append($("<td><input class='jumlah short changeble' value='"+jumlah+"' short' name='jumlah[]' type='number' value=1 min=1></td>")) 
						 .append($("<td><input class='harga' value='"+harga+"' type='number' value=0 disabled></td>"))
						 .append($("<td><input class='subtotal' value='"+subtotal+"' value=0 type='number' disabled></td>"))
		 				.append($("<td><a href='#' class='glyphicon glyphicon-remove delete'></a></td>"))	
					 .append($("</tr>"));
				akun.find('select').select2({
					placeholder: "Silahkan Pilih", 
					data: data,
					containerCssClass: 'long changeble namabarang',
				}).val(produk).trigger("change");
				$(".editdetail").append(akun);	

		      }) // each
		      //$(".editdetail").append("<tr><td colspan=4><a href=\"#\" class=\"addkeranjang btn btn-default\">+</a> </td></tr>");
			}
		});//end ajax detail

	});//end edit Pesanan
	
    $(document).on('change',".changeble",function() {
    	var ini=$(this).parent().parent();

    	var id=ini.find('[name="namabarang[]"]').val();
    	var jumlah=ini.find('[name="jumlah[]"]').val();


    	//ajax header
        $.ajax({
            url: "<?php echo base_url(); ?>penjualan/pesanan_ajax_harga/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            if(response){
	            $(ini)
	                .find('.harga').val(response.hjualbarang).end()
	                .find('.subtotal').val((response.hjualbarang*jumlah)).end();
	            }else{
	             $(ini)
	                .find('.harga').val("0").end()
	                .find('.subtotal').val("0").end();
	            }
			}
		});//end ajax header

    });

	//add keranjang dalam Pesanan
	$(document).on('click',".addkeranjang",function() {
	  var row = $("<tr>");

	  row.append($("<td><select class='long changeble namabarang' autocomplete='off' name='namabarang[]' placeholder='Nama Produk'><option></option></select></td>"))
		 .append($("<td><input class='jumlah short changeble' name='jumlah[]' type='number' value=1 min=1></td>")) 
		 .append($("<td><input class='harga' type='number' value=0 disabled></td>"))
		 .append($("<td><input class='subtotal' value=0 type='number' disabled></td>")).append($("<td><a href='#' class='glyphicon glyphicon-remove delete'></a></td>"))	
	 .append($("</tr>"));
	 
	  $(this).parent().parent().before(row);

		$(".namabarang").select2({
		placeholder: "Silahkan Pilih", 
		data: data
		});

	  return false;
	})
}); //end document
</script>