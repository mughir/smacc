<div id="editPenyesuaian" class="modal fade" role="dialog">
  <div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Penyesuaian</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>transaksi/bspl_Penyesuaian_entri_proses/update">
		<div class="modal-body">
		<table class="form">
		  <tr><td><input readonly required type="hidden" name="id" value=""><input readonly required type="hidden" name="no" value="<?php echo $transaksi->TRANSAKSI_NO ?>">Jenis Penyesuaian: </td><td colspan=2><select name="jenis"><option value=""></option><?php foreach($jenis_Penyesuaian as $j){echo "<option value='$j->JENIS_Penyesuaian_KODE'>$j->JENIS_Penyesuaian_NAMA</option>";} ?></select></td></tr>
		  <tr><td>Deskripsi: </td><td><input type="text" name="des"></td><td></td></tr>	
		
 		 <tr><td>Tipe Post: </td><td><select name="gen"><option value=0>Current</option><option value=1>Carry FW</option><option value=2>Current & Carry FW</option></select></td><td></td></tr>
			</table>
		<table id="editakunPenyesuaian" class="form">
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
			<th>2017080000001</th>
			<th>2017-08-26</th>
			<th>1</th>
			<th>Tes</th>
			<th>10</th>
			<th>10000</th>
			<th>10000</th>
			<th>Belum Disesuaikan</th>
		</tr>
	</tbody>
</table>
</div>
<script>
$(document).ready(function() {
	//ediit Penyesuaian
    $('.editButton').on('click', function() {
        // tarik record
        var id = $(this).attr('data-id');

        //ajax header
        $.ajax({
            url: "<?php echo base_url(); ?>transaksi/bspl_Penyesuaian_entri_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#editPenyesuaian')
                .find('[name="id"]').val(response.Penyesuaian_TRANSAKSI_ID).end()
                .find('[name="jenis"]').val(response.JENIS_Penyesuaian_KODE).end()
                .find('[name="des"]').val(response.Penyesuaian_TRANSAKSI_DES).end()
				.find('[name="gen"]').val(response.Penyesuaian_TRANSAKSI_GN).end();
			}
		});//end ajax header

   		 //request pak adhi
   		$("#editakunPenyesuaian").empty();

   		var judul = $("<tr>");
   		judul.append ($("<td><br></td><td><br></td><td><span class='akun'>Debit</span></td><td><span class='akun'>Kredit</span></td><td></td><td></td>"))
   		judul.append ($("</tr>"))

   		$("#editakunPenyesuaian").append(judul);

        //ajax detail
        $.ajax({
            url: "<?php echo base_url(); ?>transaksi/bspl_Penyesuaian_entri_detail_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            
		      $.each(response, function(index, value){
		      //alert(value);
		      	var coa = value.COA_NO;
		      	var aset = value.ASSET_ID;
		      	var debit = value.Penyesuaian_TRANSAKSID_DEBIT;
		      	var kredit = value.Penyesuaian_TRANSAKSID_KREDIT;
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

				$("#editakunPenyesuaian").append(akun);
		      }) // each
		      $("#editakunPenyesuaian").append("<tr><td colspan=6><a href=\"#\" class=\"addakun btn btn-default\">+</a> </td></tr>");
			}
		});//end ajax detail

	});//end edit Penyesuaian
	


	//add akun dalam Penyesuaian
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