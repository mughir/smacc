<datalist id="material">
<?php foreach($barang as $b){
	echo "<option value='$b->idbarang'>$b->idbarang - $b->nbarang</option>";
}
?>
</datalist>

<div id="createpengambilan" class="modal fade" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pengambilan Material Produksi</h4>
      </div>
	  <form method="post" action="?tipe=tambah">
		<div class="modal-body">
<table class="form"">
	<thead>
	<tr><td>No Batch</td><td><input name="batch" type="number"></td></tr>
	<tr><td>No Pengambilan</td><td><input name="req"  type="number"></td></tr>
	<tr><td>Waktu</td><td><input class="tgl" name="tanggal" type="text"></td></tr>
	<tr><td><br><br></td><td></td></tr>
	  <tr><th>Material</th><th>Jumlah</th></tr>
	  </thead>
	  <tbody >
			 <tr> 
			 	<td>
			 		<input required type="text" list="material" class="namaakun"  autocomplete="off" name="namamaterial[]" placeholder="Material">
			 	</td>
			 	<td>
			 		<input  name="jumlah[]" type="number" min=1 max=1000 value=1>
			 	</td>
			 </tr>
			 <tr><td colspan=4><a href="#" class="addakun btn btn-default">+</a> </td></tr>
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

<div id="editpengambilan" class="modal fade areaprint" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pengambilan Material Produksi</h4>
      </div>
	  <form method="post" action="?tipe=tambah">
		<div class="modal-body">
<table class="form">
	<thead>
	<tr><td>No Batch</td><td><input name="batch" type="number"></td></tr>
	<tr><td>No Pengambilan</td><td><input name="req"  type="number"></td></tr>
	<tr><td>Waktu</td><td><input class="tgl" name="tanggal" type="text"></td></tr>
	<tr><td><br><br></td><td></td></tr>
	  <tr><th>Material</th><th>Jumlah</th></tr>
	  </thead>
	  <tbody id="isipengambilan">
			 <tr> 
			 	<td>
			 		<input required type="text" list="material" class="namaakun"  autocomplete="off" name="namamaterial[]" placeholder="Material">
			 	</td>
			 	<td>
			 		<input  name="jumlah[]" type="number" min=1 max=1000 value=1>
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
	<h3>Fungsi pengambilan</h3>
	<p>Fitur ini digunakan untuk mencatat kegiatan pengambilan material suatu batch produksi.</p>
</div>
	<div class="row">
		<div class="col-sm-3 col-xs-3">
			<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createpengambilan">+ Add Pengambilan Barang</button>
		</div>
	</div>


<br><br>


<table class='table' id="ajaxtable">
	<thead>
		<tr>
			<th>No pengambilan</th>
			<th>Waktu</th>
			<th>No Batch</th>
			<th>Conf</th>
		</tr>
	</thead>	
	<tobdy>
		<tr>
			<?php foreach($req as $r){
			echo "<td>$r->noreq</td>";
			echo "<td>$r->waktu</td>";
			echo "<td>$r->idjadwal</td>";		
			echo "<td>";
			echo "<a href='#' data-id='$r->noreq' data-toggle='modal' data-target='#editpengambilan' class='editButton btn btn-default glyphicon glyphicon-eye-open'></a>";
			echo " <a href='".base_url()."produksi/pengambilan/?tipe=delete&id=$r->noreq' onclick=\"return confirm('Anda yakin?')\" class='btn btn-default glyphicon glyphicon-trash'></a>
				</td>";
			echo "</tr>";
			}
			?>
		</tr>
	</tbody>
</table>

</div>
<script>
$(document).ready(function() {
	//ediit pengambilan
    $('.editButton').on('click', function() {
        // tarik record
        var id = $(this).attr('data-id');

        //ajax header
        $.ajax({
            url: "<?php echo base_url(); ?>produksi/ajax_pengambilan/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#editpengambilan')
                .find('[name="batch"]').val(response.idjadwal).end()
                .find('[name="req"]').val(response.noreq).end()
                .find('[name="tanggal"]').val(response.waktu).end()
			}
		});//end ajax header

   		$("#isipengambilan").empty();
   		
        //ajax detail
        $.ajax({
            url: "<?php echo base_url(); ?>produksi/ajax_pengambilan_detail/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            
		      $.each(response, function(index, value){
		      //alert(value);
		      	var material = value.idbarang;
		      	var jumlah = value.jumlah;

		      	  var akun = $("<tr>");

				  akun.append($("<td><input value='"+material+"' type='text' list='material' class='namaakun' autocomplete='off' name='namamaterial[]' placeholder='Material'></td>"))
					 .append($("<td><input value='"+jumlah+"' class='akun' name='jumlah[]' type='number' value=0 placeholder='jumlah'></td>"))
					 .append($("</tr>"));

				$("#isipengambilan").append(akun);
		      }); // each
		     // $("#isipengambilan").append("<tr><td colspan=6><a href=\"#\" class=\"addakun btn btn-default\">+</a> </td></tr>");
			}
		});//end ajax detail

	});//end edit pengambilan
	


	//add akun dalam pengambilan
	$(document).on('click',".addakun",function() {
	  var row = $("<tr>");

	  row.append($("<td><input type='text' list='produk' class='namaakun' autocomplete='off' name='namamaterial[]' placeholder='Nama Produk'></td>"))
		 .append($("<td><input name='jumlah[]' type='number' value=1 min=1 max=1000></td>")) 
	 .append($("</tr>"));
	 
	  $(this).before(row);

	  $("#daftar").scrollTop($("#daftar")[0].scrollHeight);
	  return false;
	})
}); //end document
</script>