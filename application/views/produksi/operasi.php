<div id="createOperasi" class="modal fade" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Moving Ticket</h4>
      </div>
	  <form method="post" action="?tipe=tambah">
		<div class="modal-body">
<table class="form"">
	<thead>
	<tr><td>No Batch</td><td><input name="batch" type="number"></td></tr>
	<tr><td>No Kartu</td><td><input name="kartu" type="number"></td></tr>
	<tr><td>Tanggal</td><td><input name="tanggal" class="tgl" type="text"></td></tr>
	<tr><td>Nama Operasi</td><td><input name="operasi" type="text"></td></tr>
	<tr><td>Finish?</td><td><input name="finish" type="hidden"><input name="finish" type="checkbox"></td></tr>
	<tr><td><br><br></td><td></td></tr>
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
	<h3>Fungsi Operasi</h3>
	<p>Fitur ini digunakan untuk mencatat kegiatan operasi produksi melalui moving ticket.</p>
</div>
	<div class="row">
		<div class="col-sm-3 col-xs-3">
			<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createOperasi">+ Add Moving Ticket</button>
		</div>
	</div>


<br><br>


<table class='table' id="ajaxtable">
	<thead>
		<tr>
			<th>No Operasi</th>
			<th>No Batch</th>
			<th>No Kartu</th>
			<th>Waktu</th>
			<th>Barang</th>
			<th>Jumlah</th>
			<th>Operasi</th>
			<th>Status</th>
		</tr>
	</thead>	
	<tobdy>
		<?php
			foreach($operasi as $o){
				echo "
					<tr>
						<td>$o->idorder</td>
						<td>$o->idjadwal</td>
						<td>$o->nokartu</td>
						<td>$o->idbarang</td>
						<td>$o->waktu</td>
						<td>$o->jumlah</td>
						<td>$o->namaoperasi</td>
						<td>$o->status</td>
					</tr>
				";
			}
		?>
	</tbody>
</table>

</div>
<script>
$(document).ready(function() {
	//ediit Operasi
    $('.editButton').on('click', function() {
        // tarik record
        var id = $(this).attr('data-id');

        //ajax header
        $.ajax({
            url: "<?php echo base_url(); ?>transaksi/bspl_Operasi_entri_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#editOperasi')
                .find('[name="id"]').val(response.Operasi_TRANSAKSI_ID).end()
                .find('[name="jenis"]').val(response.JENIS_Operasi_KODE).end()
                .find('[name="des"]').val(response.Operasi_TRANSAKSI_DES).end()
				.find('[name="gen"]').val(response.Operasi_TRANSAKSI_GN).end();
			}
		});//end ajax header

   		 //request pak adhi
   		$("#editakunOperasi").empty();

   		var judul = $("<tr>");
   		judul.append ($("<td><br></td><td><br></td><td><span class='akun'>Debit</span></td><td><span class='akun'>Kredit</span></td><td></td><td></td>"))
   		judul.append ($("</tr>"))

   		$("#editakunOperasi").append(judul);

        //ajax detail
        $.ajax({
            url: "<?php echo base_url(); ?>transaksi/bspl_Operasi_entri_detail_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            
		      $.each(response, function(index, value){
		      //alert(value);
		      	var coa = value.COA_NO;
		      	var aset = value.ASSET_ID;
		      	var debit = value.Operasi_TRANSAKSID_DEBIT;
		      	var kredit = value.Operasi_TRANSAKSID_KREDIT;
		      	var bisnisj = value.BISNISAREA_ID_J;
		      	var bisnisb = value.BISNISAREA_ID_B;

		      	(!aset) ? aset="" : aset;
		      	(!bisnisj) ? bisnisj="" : bisnisj;
		      	(!bisnisb) ? bisnisb="" : bisnisb;

		      	  var akun = $("<tr>");

				  akun.append($("<td><input value='"+coa+"' type='text' list='produk' class='namaakun' autocomplete='off' name='namaakun[]' placeholder='Nama akun'></td>"))
					 .append($("<td><input value='"+aset+"' type='text' list='assets' class='namaasset' autocomplete='off' name='namaasset[]' placeholder='Class asset'></td>"))
					 .append($("<td><input value='"+debit+"' class='akun' name='debit[]' type='number' value=0 placeholder='debit'></td>"))
					 .append($("<td><input value='"+kredit+"' value=0 name='kredit[]' class='akun' type='number' placeholder='kredit'></td>"))
					 .append($("<td><input value='"+bisnisj+"' type='text' list='bisnis' class='bisnis' autocomplete='off' name='namabisnisj[]' placeholder='BA CC'></td>"))
					 .append($("<td><input value='"+bisnisb+"' type='text' list='bisnis' class='bisnis' autocomplete='off' name='namabisnisb[]' placeholder='BA TP'></td>"))
					 .append($("</tr>"));

				$("#editakunOperasi").append(akun);
		      }) // each
		      $("#editakunOperasi").append("<tr><td colspan=6><a href=\"#\" class=\"addakun btn btn-default\">+</a> </td></tr>");
			}
		});//end ajax detail

	});//end edit Operasi
}); //end document
</script>