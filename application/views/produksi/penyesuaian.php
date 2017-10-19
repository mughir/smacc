<div id="penyesuaian" class="modal fade" role="dialog">
  <div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Penyesuaian</h4>
      </div>
	  <form method="post" action="?proses=penyesuaian">
		<div class="modal-body">
		<table class="form">
			  <tr><td>No Batch: </td><td><input type="text" readonly name="id"></td></tr>
			  <tr><td>Produk: </td><td><input type="text" readonly name="barang"></td></tr>
			  <tr><td>Biaya Material: </td><td><input type="number" name="material"></td></tr>	
			  <tr><td>Biaya Labor: </td><td><input type="number" min=0 value=0 name="labor"></td></tr>	 
			  <tr><td>Biaya FOH: </td><td><input type="number" min=0  value=0 name="foh"></td></tr>		
		</table>
		<br>
		<hr>
		<h3>Daftar Biaya Material</h3>
		<table id="materialcost" class="form">
			  <tr><th>Material</th><th>Jumlah</th><th>Total Cost</th></tr>
			 <tr> 
			 	<td><input required type="text" list="akuns" class="namaakun"  autocomplete="off" name="material[]" placeholder="Nama akun"></td>
			 	<td><input  type="text" list="assets" class="assets"  autocomplete="off" name="namaasset[]" placeholder="Jumlah"></td>
			 	<td><input class="akun" name="debit[]" type="number" value=0 placeholder="Total Cost"></td>
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
	<h3>Fungsi Penyesuaian</h3>
	<p>Fitur ini digunakan untuk menyesuaikan biaya produksi real dengan sistem.</p>
</div>


<br>


<table class='table' id="ajaxtable">
	<thead>
		<tr>
			<th>No Operasi</th>
			<th>Waktu</th>
			<th>No Batch</th>
			<th>Barang</th>
			<th>Jumlah</th>
			<th>Biaya Estimasi</th>
			<th>Biaya Disesuaikan</th>
			<th>Status</th>
		</tr>
	</thead>	
	<tobdy>
		<tr>
<?php
	$this->load->model("M_PenyesuaianProd","mp");
	foreach($sesuai as $s){
		echo "<tr>";
			echo "<td>$s->idorder</td>";
			echo "<td>$s->waktu</td>";
			echo "<td>$s->idjadwal</td>";
			echo "<td>$s->idbarang</td>";
			echo "<td>$s->jumlah</td>";
			echo "<td>".$this->mp->get_estimasi($s->idjadwal)."</td>";
			if($s->status==1){
					echo "<td>";
						echo "<a class='btn btn-default sesuaikan' data-toggle='modal' data-target='#penyesuaian' data-id='$s->idjadwal'>Penyesuaian</a>";
					echo "</td>";
			}else{
				echo "<td>Selesai</td>";
			}
			if($s->status==1){
					echo "<td>";
						echo "Belum Disesuaikan";
					echo "</td>";
			}else{
				echo "<td>Selesai</td>";
			}
		echo "</tr>";
	}
?>
		</tr>
	</tbody>
</table>
</div>
<script>
$(document).ready(function() {
	//ediit Penyesuaian
    $('.sesuaikan').on('click', function() {
        // tarik record
        var id = $(this).attr('data-id');

        //ajax header
        $.ajax({
            url: "<?php echo base_url(); ?>produksi/ajax_penyesuaian/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#penyesuaian')
                .find('[name="id"]').val(id).end()
                .find('[name="barang"]').val(response.idbarang).end()
                .find('[name="material"]').val(response.total).end()
			}
		});//end ajax header

   		$("#materialcost").empty();

   		var judul = $("<tr>");
   		judul.append ($("<th>Material</th><th>Jumlah</th><th>Total Cost</th>"))
   		judul.append ($("</tr>"))

   		$("#materialcost").append(judul);

        //ajax detail
        $.ajax({
            url: "<?php echo base_url(); ?>produksi/ajax_penyesuaian_detail/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            
		      $.each(response, function(index, value){
		      //alert(value);
		      	var material = value.idbarang;
		      	var jumlah = value.jumlah;
		      	var cost = value.cost;

		      	  var akun = $("<tr>");

				  akun.append($("<td><input value='"+material+"' type='text' disabled list='produk' class='namaakun' autocomplete='off' name='material[]' placeholder='Material'></td>"))
					 .append($("<td><input value='"+jumlah+"' type='text' disabled class='namaasset' autocomplete='off' name='jumlah[]' placeholder='Jumlah'></td>"))
					 .append($("<td><input value='"+cost+"' class='text' disabled name='debit[]' type='number' value=0 placeholder='Total Cost'></td>"))
					 .append($("</tr>"));

				$("#materialcost").append(akun);
		      }) // each
		    }
		});//end ajax detail
	});//end edit Penyesuaian
}); //end document
</script>