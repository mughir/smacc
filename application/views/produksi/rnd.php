<div id="createRND" class="modal fade" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add RND</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>transaksi/bspl_RND_entri_proses/tambah">
		<div class="modal-body">
<table class="form"">
	<thead>
	<tr><td>Nama Barang</td><td><input type="text"></td></tr>
	<tr><td>Sifat</td><td><input type="text"></td></tr>
	<tr><td><br><br></td><td></td></tr>
	  <tr><th>Material</th><th>Jumlah</th></tr>
	  </thead>
	  <tbody >
			 <tr> 
			 	<td>
			 		<input required type="text" list="produk" class="namabarang"  autocomplete="off" name="namabarang[]" placeholder="nama Produk">
			 	</td>
			 	<td>
			 		<input  type="number" min=1 max=1000 value=1>
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


<div id="editRND" class="modal fade" role="dialog">
  <div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit RND</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>transaksi/bspl_RND_entri_proses/update">
		<div class="modal-body">
		<table class="form">
		  <tr><td><input readonly required type="hidden" name="id" value=""><input readonly required type="hidden" name="no" value="<?php echo $transaksi->TRANSAKSI_NO ?>">Jenis RND: </td><td colspan=2><select name="jenis"><option value=""></option><?php foreach($jenis_RND as $j){echo "<option value='$j->JENIS_RND_KODE'>$j->JENIS_RND_NAMA</option>";} ?></select></td></tr>
		  <tr><td>Deskripsi: </td><td><input type="text" name="des"></td><td></td></tr>	
		
 		 <tr><td>Tipe Post: </td><td><select name="gen"><option value=0>Current</option><option value=1>Carry FW</option><option value=2>Current & Carry FW</option></select></td><td></td></tr>
			</table>
		<table id="editakunRND" class="form">
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
	<h3>Fungsi RnD</h3>
	<p>Fitur ini digunakan untuk mencatat formula suatu produk.</p>
</div>
	<div class="row">
		<div class="col-sm-3 col-xs-3">
			<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createRND">+ Add RND</button>
		</div>
	</div>


<br><br>


<table class='table' id="ajaxtable">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nama Barang</th>
			<th>Material</th>
			<th>Operation list</th>
			<th>Conf</th>
		</tr>
	</thead>	
	<tobdy>
		<tr>
			<th>1000</th>
			<th>tes</th>
			<th>Cek</th>
			<th>Cek</th>
			<th>Cek</th>
		</tr>
	</tbody>
</table>
</div>
<script>
$(document).ready(function() {
	//ediit RND
    $('.editButton').on('click', function() {
        // tarik record
        var id = $(this).attr('data-id');

        //ajax header
        $.ajax({
            url: "<?php echo base_url(); ?>transaksi/bspl_RND_entri_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#editRND')
                .find('[name="id"]').val(response.RND_TRANSAKSI_ID).end()
                .find('[name="jenis"]').val(response.JENIS_RND_KODE).end()
                .find('[name="des"]').val(response.RND_TRANSAKSI_DES).end()
				.find('[name="gen"]').val(response.RND_TRANSAKSI_GN).end();
			}
		});//end ajax header

   		 //request pak adhi
   		$("#editakunRND").empty();

   		var judul = $("<tr>");
   		judul.append ($("<td><br></td><td><br></td><td><span class='akun'>Debit</span></td><td><span class='akun'>Kredit</span></td><td></td><td></td>"))
   		judul.append ($("</tr>"))

   		$("#editakunRND").append(judul);

        //ajax detail
        $.ajax({
            url: "<?php echo base_url(); ?>transaksi/bspl_RND_entri_detail_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            
		      $.each(response, function(index, value){
		      //alert(value);
		      	var coa = value.COA_NO;
		      	var aset = value.ASSET_ID;
		      	var debit = value.RND_TRANSAKSID_DEBIT;
		      	var kredit = value.RND_TRANSAKSID_KREDIT;
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

				$("#editakunRND").append(akun);
		      }) // each
		      $("#editakunRND").append("<tr><td colspan=6><a href=\"#\" class=\"addakun btn btn-default\">+</a> </td></tr>");
			}
		});//end ajax detail

	});//end edit RND
	


	//add akun dalam RND
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