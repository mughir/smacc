<div id="createpengambilan" class="modal fade" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add pengambilan</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>transaksi/bspl_pengambilan_entri_proses/tambah">
		<div class="modal-body">
<table class="form"">
	<thead>
	<tr><td>Pemesan</td><td><input type="text"></td></tr>
	<tr><td>Tanggal</td><td><input type="date"></td></tr>
	<tr><td><br><br></td><td></td></tr>
	  <tr><th>Produk</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th></tr>
	  </thead>
	  <tbody >
			 <tr> 
			 	<td>
			 		<input required type="text" list="produk" class="namaakun"  autocomplete="off" name="namaakun[]" placeholder="nama Produk">
			 	</td>
			 	<td>
			 		<input  type="number" min=1 max=1000 value=1>
			 	</td>
			 	<td>
			 		<input  type="number" min=0 disabled value=1>
			 	</td>
			 	<td>
			 		<input  type="number" min=0 disabled value=1>
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


<div id="editpengambilan" class="modal fade" role="dialog">
  <div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit pengambilan</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>transaksi/bspl_pengambilan_entri_proses/update">
		<div class="modal-body">
		<table class="form">
		  <tr><td><input readonly required type="hidden" name="id" value=""><input readonly required type="hidden" name="no" value="<?php echo $transaksi->TRANSAKSI_NO ?>">Jenis pengambilan: </td><td colspan=2><select name="jenis"><option value=""></option><?php foreach($jenis_pengambilan as $j){echo "<option value='$j->JENIS_pengambilan_KODE'>$j->JENIS_pengambilan_NAMA</option>";} ?></select></td></tr>
		  <tr><td>Deskripsi: </td><td><input type="text" name="des"></td><td></td></tr>	
		
 		 <tr><td>Tipe Post: </td><td><select name="gen"><option value=0>Current</option><option value=1>Carry FW</option><option value=2>Current & Carry FW</option></select></td><td></td></tr>
			</table>
		<table id="editakunpengambilan" class="form">
			  <tr><td><br><br> </td><td></td><td><br><span class='akun'>Debit</span></td><td><br><span class='akun'>Kredit</span></td></tr>
			 <tr> <td><input required type="text" list="akuns" class="namaakun"  autocomplete="off" name="namaakun[]" placeholder="Nama akun"></td><td><input  type="text" list="assets" class="assets"  autocomplete="off" name="namaasset[]" placeholder="Class asset"></td><td><input class="akun" name="debit[]" type="number" value=0 placeholder="debit"></td><td><input value=0 name="kredit[]" class="akun" type="number" placeholder="kredit"></td><td><input  type="text" list="bisnis" class="ba"  autocomplete="off" name="namabisnisj[]" placeholder="BACC"></td><td><input  type="text" list="bisnis" class=""  autocomplete="off" name="namabisnisb[]" placeholder="BATP"></td></tr>
		 <tr> <td><input required type="text" list="akuns" class="namaakun"  autocomplete="off" name="namaakun[]" placeholder="Nama akun"></td><td><input  type="text" list="assets" class="assets"  autocomplete="off" name="namaasset[]" placeholder="Class asset"></td><td><input class="akun" name="debit[]" type="number" value=0 placeholder="debit"></td><td><input value=0 name="kredit[]" class="akun" type="number" placeholder="kredit"></td><td><input  type="text" list="bisnis" class="ba"  autocomplete="off" name="namabisnisj[]" placeholder="BACC"></td><td><input  type="text" list="bisnis" class=""  autocomplete="off" name="namabisnisb[]" placeholder="BATP"></td></tr>
		 <tr> <td><input  type="text" list="akuns" class="namaakun"  autocomplete="off" name="namaakun[]" placeholder="Nama akun"></td><td><input  type="text" list="assets" class="assets"  autocomplete="off" name="namaasset[]" placeholder="Class asset"></td><td><input class="akun" name="debit[]" type="number" value=0 placeholder="debit"></td><td><input value=0 name="kredit[]" class="akun" type="number" placeholder="kredit"></td><td><input  type="text" list="bisnis" class="ba"  autocomplete="off" name="namabisnisj[]" placeholder="BACC"></td><td><input  type="text" list="bisnis" class=""  autocomplete="off" name="namabisnisb[]" placeholder="BATP"></td></tr>
	 <tr> <td><input  type="text" list="akuns" class="namaakun"  autocomplete="off" name="namaakun[]" placeholder="Nama akun"></td><td><input  type="text" list="assets" class="assets"  autocomplete="off" name="namaasset[]" placeholder="Class asset"></td><td><input class="akun" name="debit[]" type="number" value=0 placeholder="debit"></td><td><input value=0 name="kredit[]" class="akun" type="number" placeholder="kredit"></td><td><input  type="text" list="bisnis" class="ba"  autocomplete="off" name="namabisnisj[]" placeholder="BACC"></td><td><input  type="text" list="bisnis" class=""  autocomplete="off" name="namabisnisb[]" placeholder="BATP"></td></tr>
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


<div id="postpengambilan" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Post pengambilan</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>transaksi/bspl_pengambilan_entri_proses/post">
		<div class="modal-body">
		<table class="form"><td>
			<input readonly required type="hidden" name="no" value="<?php echo $transaksi->TRANSAKSI_NO ?>">
				  Periode: </td><td><select name="periode"><option value=""></option><?php foreach($periode as $j){echo "<option value='$j->PERIODE_KODE'>$j->PERIODE_NAMA</option>";} ?></select></td></tr>
		  <tr><td>Tahun: </td><td><input type="text" name="tahun" value="<?php echo date('Y'); ?>"></td><td></td></tr>
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
	<h3>Fungsi pengambilan</h3>
	<p>Fitur ini digunakan untuk mencatat kegiatan pengambilan produksi melalui moving ticket.</p>
</div>
	<div class="row">
		<div class="col-sm-3 col-xs-3">
			<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createpengambilan">+ Add Moving Ticket</button>
		</div>
	</div>


<br><br>


<table class='table' id="ajaxtable">
	<thead>
		<tr>
			<th>No pengambilan</th>
			<th>Waktu</th>
			<th>No Batch</th>
			<th>Barang</th>
			<th>Jumlah</th>
			<th>Status</th>
		</tr>
	</thead>	
	<tobdy>
		<tr>
			<th>2017080000001</th>
			<th>2017-08-26</th>
			<th>1</th>
			<th>Tes</th>
			<th>10</th>
			<th>Not Finished</th>
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
            url: "<?php echo base_url(); ?>transaksi/bspl_pengambilan_entri_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#editpengambilan')
                .find('[name="id"]').val(response.pengambilan_TRANSAKSI_ID).end()
                .find('[name="jenis"]').val(response.JENIS_pengambilan_KODE).end()
                .find('[name="des"]').val(response.pengambilan_TRANSAKSI_DES).end()
				.find('[name="gen"]').val(response.pengambilan_TRANSAKSI_GN).end();
			}
		});//end ajax header

   		 //request pak adhi
   		$("#editakunpengambilan").empty();

   		var judul = $("<tr>");
   		judul.append ($("<td><br></td><td><br></td><td><span class='akun'>Debit</span></td><td><span class='akun'>Kredit</span></td><td></td><td></td>"))
   		judul.append ($("</tr>"))

   		$("#editakunpengambilan").append(judul);

        //ajax detail
        $.ajax({
            url: "<?php echo base_url(); ?>transaksi/bspl_pengambilan_entri_detail_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            
		      $.each(response, function(index, value){
		      //alert(value);
		      	var coa = value.COA_NO;
		      	var aset = value.ASSET_ID;
		      	var debit = value.pengambilan_TRANSAKSID_DEBIT;
		      	var kredit = value.pengambilan_TRANSAKSID_KREDIT;
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

				$("#editakunpengambilan").append(akun);
		      }) // each
		      $("#editakunpengambilan").append("<tr><td colspan=6><a href=\"#\" class=\"addakun btn btn-default\">+</a> </td></tr>");
			}
		});//end ajax detail

	});//end edit pengambilan
	


	//add akun dalam pengambilan
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