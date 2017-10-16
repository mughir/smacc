<datalist id="barang">
<?php foreach($barang as $b){
	echo "<option value='$b->idbarang'>$b->idbarang - $b->nbarang</option>";
}
?>
</datalist>

<datalist id="material">
<?php foreach($material as $b){
	echo "<option value='$b->idbarang'>$b->idbarang - $b->nbarang</option>";
}
?>
</datalist>


<div id="creaternd" class="modal fade" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add rnd</h4>
      </div>
	  <form method="post" action="?tipe=tambah">
		<div class="modal-body">
	<table class="form"">		
	<tr>
			<td>ID Barang</td>
			<td><input type="text" name="id" list="barang" autocomplete="off" required pattern="[a-zA-Z0-9]+"></td>
		</tr>			
	 </table>
	 <hr>
	 <h3>Material</h3>
		<table class='form detail'>
			 <tbody>
					 <tr> 
					 	<td>
					 		<input required type="text" class='long changeble' list="material" autocomplete="off" name="namabarang[]" placeholder="nama material" required>
					 	</td>
					 	<td>
					 		<input  class='short jumlah changeble' type="number" min=1 max=1000 value=1 name='jumlah[]'>
					 	</td>			 	
						 <td>
				 			<a href="#" class="glyphicon glyphicon-remove delete"></a>
				 		</td>
					 </tr>
					 <tr>
					 	<td colspan="3">
							<a href="#" class="addmaterial btn btn-default">+</a> 
					 	</td>
					 </tr>
				</tbody>
		</table>
			 <hr>
	 <h3>Operasi</h3>
		<table class='form detail'>
			 <tbody>
					 <tr> 
					 	<td>
					 		<input required type="text" class='long changeble' name="namaoperasi[]" placeholder="nama operasi" required>
					 	</td>			 	
						 <td>
				 			<a href="#" class="glyphicon glyphicon-remove delete"></a>
				 		</td>
					 </tr>
					 <tr>
					 	<td colspan="2">
							<a href="#" class="addoperation btn btn-default">+</a> 
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
	<h3>Fungsi rnd</h3>
	<p>Fitur ini digunakan untuk mengelola rnd pembelian oleh usaha Anda.</p>
</div>
	<div class="row">
		<div class="col-sm-3 col-xs-3">
			<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#creaternd">+ Add rnd</button>
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
			<th>Nama Barang</th>
			<th>Conf</th>
		</tr>
	</thead>	
	<tobdy>
		<?php foreach($rnd as $p){
			echo "<tr>";
			echo "<td>$p->idbarang</td>";
			echo "<td>$p->nbarang</td>";
			echo "<td>
							<a href='#' data-id='$p->idbarang' data-toggle='modal' data-target='#editrnd' class='editButton btn btn-default glyphicon glyphicon-eye-open'>
							</a>
							<a href='".base_url()."produksi/rnd/?tipe=delete&id=$p->idbarang' onclick=\"return confirm('Anda yakin?')\" class='btn btn-default glyphicon glyphicon-trash'>
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
	//ediit rnd
    $('.editButton').on('click', function() {
        // tarik record
        var id = $(this).attr('data-id');

        //ajax header
        $.ajax({
            url: "<?php echo base_url(); ?>pembelian/rnd_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#editrnd')
                .find('[name="id"]').val(response.idpesan_beli).end()
                .find('[name="vendor"]').val(response.idkontak).end()
                .find('[name="term"]').val(response.term).end()
				.find('[name="tanggal"]').val(response.tglpesan).end()
                .find('[name="pengajuan"]').val(response.idpengajuan).end();
			}
		});//end ajax header

   		 //request
   		$(".editdetail").empty();

   		var judul = $("<tr>");
   		judul.append ($("<th>Produk</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th>"))
   		judul.append ($("</tr>"))

   		$(".editdetail").append(judul);

        //ajax detail
        $.ajax({
            url: "<?php echo base_url(); ?>pembelian/rnd_detail_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            
		      $.each(response, function(index, value){
		      //alert(value);
		      	var produk = value.idbarang;
		      	var jumlah = value.jumlah;
		      	var harga = value.subtotal/value.jumlah;
		      	var subtotal = value.subtotal;

		      	  var akun = $("<tr>");

				  akun.append($("<td><input type='text' value='"+produk+"' list='barang' class='long changeble' autocomplete='off' name='namabarang[]' placeholder='Nama Produk'></td>"))
						 .append($("<td><input class='jumlah short changeble' value='"+jumlah+"' short' name='jumlah[]' type='number' value=1 min=1></td>")) 
						 .append($("<td><input class='harga' value='"+harga+"' type='number' value=0 disabled></td>"))
						 .append($("<td><input class='subtotal' value='"+subtotal+"' value=0 type='number' disabled></td>"))
					 .append($("</tr>"));

				$(".editdetail").append(akun);
		      }) // each
		      $(".editdetail").append("<tr><td colspan=4><a href=\"#\" class=\"addkeranjang btn btn-default\">+</a> </td></tr>");
			}
		});//end ajax detail

	});//end edit rnd
	
    $(document).on('change',".changeble",function() {
    	var ini=$(this).parent().parent();

    	var id=ini.find('[name="namabarang[]"]').val();
    	var jumlah=ini.find('[name="jumlah[]"]').val();


    	//ajax header
        $.ajax({
            url: "<?php echo base_url(); ?>pembelian/rnd_ajax_harga/" + id,
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

	//add material  dalam rnd
	$(document).on('click',".addmaterial",function() {
	  var row = $("<tr>");

	  row.append($("<td><input type='text' list='material' class='long changeble' autocomplete='off' name='namabarang[]' placeholder='Nama Material'></td>"))
		 .append($("<td><input class='jumlah short changeble' name='jumlah[]' type='number' value=1 min=1></td>"))  
		 .append($('<td><a href="#" class="glyphicon glyphicon-remove delete"></a></td>')) 
	 .append($("</tr>"));
	 
	  $(this).parent().parent().before(row);
	  return false;
	})

	//Add operasi
	$(document).on('click',".addoperation",function() {
	  var row = $("<tr>");

	  row.append($("<td><input type='text' class='long changeble' autocomplete='off' name='namaoperasi[]' placeholder='Nama Operasi'></td>"))
	  .append($('<td><a href="#" class="glyphicon glyphicon-remove delete"></a></td>')) 
	 .append($("</tr>"));
	 
	  $(this).parent().parent().before(row);
	  return false;
	})

	$(document).on('click',".delete",function() {
		$(this).parent().parent().empty();
	});
}); //end document
</script>