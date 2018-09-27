

<br>
<div class="dokumen" style="padding:10px 25px 10px 10px;position:relative;">
<form method="post" action="<?php echo base_url() ?>pos/kasir/?tipe=submit">
<div id="daftar" style="height:300px;max-height:300px;overflow-y:scroll;">
<table class="form detail">
	<thead>
	  <tr><th>Produk</th><th>Jumlah</th><th>Harga</th><th colspan=2>Subtotal</th></tr>
	  </thead>
	  <tbody >
			 <tr> 
			 	<td>
			 		<select required class="namabarang long changeble" autocomplete="off" name="namabarang[]" placeholder="nama Produk">
			 			<option></option>
			 			<?php foreach($barang as $b) echo "<option value='$b->idbarang'>$b->nbarang</option>"; ?>
			 		</select>
			 	</td>
			 	<td>
			 		<input  type="number" name="jumlah[]" class="jumlah changeble" min=1 max=1000 value=1>
			 	</td>
			 	<td>
			 		<input  type="number" class="harga" min=0 disabled value=1>
			 	</td>
			 	<td>
			 		<input  type="number" class="subtotal" min=0 disabled value=1>
			 	</td>
			 	<td>
			 		<a href="#" class="glyphicon glyphicon-remove delete"></a>
			 	</td>
			 </tr>
			 <tr><td colspan=4><a href="#" class="addbarang btn btn-default">+</a> </td></tr>
		</tbody>
</table>
</div>
<table class="form">
			 <tr><td style="width:880px" colspan=2></td><td><b> Jumlah </b></td><td class='total'> </td></tr>
</table>
			<div class="row">
				<button class="btn btn-default pull-right">Bayar</button>
			</div>
</form>
</div>
<script>
$(document).ready(function() {   	
	var data = [<?php foreach($barang as $b){echo "{id:'$b->idbarang', text:'$b->nbarang'},";}?>];

	$(document).on('click',".delete",function() {
		$(this).parent().parent().empty();
	});
	//Fungsi update harga dan subtotal
	$(document).on('change',".changeble",function() {
    	var ini=$(this).parent().parent();

    	var id=ini.find('.namabarang').val();
    	var jumlah=ini.find('.jumlah').val();


    	//ajax header
        $.ajax({
            url: "<?php echo base_url(); ?>pos/kasir_ajax_harga/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            if(response){
	            $(ini)
	                .find('.harga').val(response.hbarangkasir-response.disbarangkasir).end()
	                .find('.subtotal').val((response.hbarangkasir-response.disbarangkasir)*jumlah).end();
	            }else{
	             $(ini)
	                .find('.harga').val("0").end()
	                .find('.subtotal').val("0").end();
	            }

				var table=ini.parent();
				var subtotal=table.find('.subtotal');
				var total=0;

				$.each(subtotal,function(){
					total+=$(this).val()*1;
				});

				$(".total").text("Rp "+ total);
			}
		});//end ajax header
    });


	//add item dalam keranjang
	$(document).on('click',".addbarang",function() {
	  var row = $("<tr>");

	  row.append($("<td><select required list='produk' class='namabarang long changeble' autocomplete='off' name='namaakun[]' placeholder='Nama Produk'><option></option></select></td>"))
		 .append($("<td><input type='number' class='jumlah changeble' name='jumlah[]' value=1 min=1 max=1000></td>")) 
		 .append($("<td><input type='number' class='harga' value=0  disabled></td>"))
		 .append($("<td><input value=0 class='subtotal' type='number' disabled></td>"))			 	
		 .append($("<td><a href='#' class='glyphicon glyphicon-remove delete'></a></td>"))	
		 .append($("</tr>"));


		$(this).parent().parent().before(row);

		$("#daftar").scrollTop($("#daftar")[0].scrollHeight);

		$(".namabarang").select2({
			placeholder: "Silahkan Pilih", 
			data: data
		});

		return false;
	});
}); //end document
</script>