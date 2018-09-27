<datalist id="barang">
<?php foreach($barang as $b){
	echo "<option value='$b->idbarang'>$b->idbarang - $b->nbarang</option>";
}
?>
</datalist>


<div id="createPengiriman" class="modal fade" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Penerimaan</h4>
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
			<td>Tanggal</td>
			<td><input type="text" name="tanggal" class='tgl' required></td>
		</tr>
	 </table>
	 <br><br>
		<table class='form detail'>
			<thead>
			  <tr><th>Produk</th><th>Jumlah</th></tr>
			 </thead>
			 <tbody>
					 <tr> 
					 	<td>
					 		<select required type="text" class='long changeble barang' list="barang" autocomplete="off" name="namabarang[]" placeholder="nama Produk"></select>
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
	  <br>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button> <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
	  </form>
    </div>

  </div>
</div>


<div id="editPenerimaan" class="modal fade areaprint" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dokumen Penerimaan Barang</h4>
      </div>
	  <form method="post" action="?tipe=update">
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
			<td>Tanggal</td>
			<td><input type="date" name="tanggal" required max="<?php echo $this->session->userdata("periode_sampai") ?>" min="<?php echo $this->session->userdata("periode_dari") ?>" value="<?php echo date('Y-m-d'); ?>"></td>
		</tr>	
	 </table>
	 <br><br>
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
					 <tr>
					 	<td colspan="2">
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

<div class="dokumen">
<div class="well ">
	<h3>Fungsi Penerimaan Barang</h3>
	<p>Fitur ini digunakan untuk mencatat penerimaan barang yang dipesan dari vendor.</p>
</div>
	<div class="row">
		<div class="col-sm-3 col-xs-3">
			<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createPengiriman">+ Add Penerimaan</button>
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
			<th>No Pesanan</th>
			<th>Vendor</th>
			<th>Tanggal</th>
			<th>Term</th>
			<th>Status</th>
			<th>Conf</th>
		</tr>
	</thead>	
	<tobdy>
		<?php foreach($terima as $p){
			echo "<tr>";
			echo "<td>$p->idterimabarang</td>";
			echo "<td>$p->idpesan_beli</td>";
			echo "<td>$p->idkontak - $p->nkontak</td>";
			echo "<td>$p->tglterimabarang</td>";			
			echo $p->term=="fob_shipping_point" ? "<td>FOB Shipping Point</td>" : "<td>FOB Destination Point</td>";
			switch($p->stpesan){
				case "0":
					echo "<td>Belum Diproses</td>";
				break;
				case "1":
					echo "<td>Sudah Diproses</td>";
				break;
			}
			echo "<td>
							<a href='#' data-id='$p->idterimabarang' data-toggle='modal' data-target='#editPenerimaan' class='editButton btn btn-default glyphicon glyphicon-eye-open'>
							</a>
							<a href='".base_url()."pembelian/penerimaan/?tipe=delete&id=$p->idterimabarang' onclick=\"return confirm('Anda yakin?')\" class='btn btn-default glyphicon glyphicon-trash'>
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
	//ediit Pesanan
    $('.editButton').on('click', function() {
        // tarik record
        var id = $(this).attr('data-id');

        //ajax header
        $.ajax({
            url: "<?php echo base_url(); ?>pembelian/penerimaan_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#editPenerimaan')
                .find('[name="id"]').val(response.idterimabarang).end()
                .find('[name="pesanan"]').val(response.idpesan_beli).end()
				.find('[name="tanggal"]').val(response.tglterimabarang).end()
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
            url: "<?php echo base_url(); ?>pembelian/penerimaan_detail_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            
		      $.each(response, function(index, value){
		      //alert(value);
		      	var produk = value.idbarang;
		      	var jumlah = value.jumlah;

		      	  var akun = $("<tr>");

				  akun.append($("<td><input type='text' value='"+produk+"' list='barang' class='long changeble' autocomplete='off' name='namabarang[]' placeholder='Nama Produk'></td>"))
						 .append($("<td><input class='jumlah short changeble' value='"+jumlah+"' short' name='jumlah[]' type='number' value=1 min=1></td>")) 
			 .append($("</tr>"));

				$(".editdetail").append(akun);
		      }) // each
		    //  $(".editdetail").append("<tr><td colspan=4><a href=\"#\" class=\"addkeranjang btn btn-default\">+</a> </td></tr>");
			}
		});//end ajax detail

	});//end edit Pesanan

	//add keranjang dalam Pesanan
	$(document).on('click',".addkeranjang",function() {
	  var row = $("<tr>");

	  row.append($("<td><input type='text' list='barang' class='long changeble' autocomplete='off' name='namabarang[]' placeholder='Nama Produk'></td>"))
		 .append($("<td><input class='jumlah short changeble' name='jumlah[]' type='number' value=1 min=1></td>")) 
	 .append($("</tr>"));
	 
	  $(this).parent().parent().before(row);

	  $("#daftar").scrollTop($("#daftar")[0].scrollHeight);
	  return false;
	})
}); //end document
</script>