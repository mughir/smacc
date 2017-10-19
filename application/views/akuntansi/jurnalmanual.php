
<div id="createjournal" class="modal fade" role="dialog">
  <div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Journal</h4>
      </div>
	  <form method="post" class="fojurnal"  action="<?php echo base_url() ?>akuntansi/jurnalmanual_proses/tambah">
		<div class="modal-body ">
		<table class="form">	  
		  <tr><td>Nama Jurnal</td><td><input type="text" name="nama" placeholder="wajib" value="" required></td></tr>	  
		 <tr><td>Tanggal: </td><td colspan=2 ><input class="tgl" type="text" name="tanggal" value="<?php echo date('Y-m-d') ?>"></td><td></td></tr>
		 <tr><td>Sumber Ref</td><td><input type="text" name="sumber" placeholder="" value=""></td></tr>	  
		  <tr><td>Kode Ref</td><td><input type="text" name="ref" placeholder="" value="" ></td></tr>	  
		</table><br><br>
		<table>
		  <tr><td>Akun</td><td>Debit</td><td>Kredit</td></tr>
				
				 <tr> <td><input required type="text" list="akuns" class="namaakun"  autocomplete="off" name="namaakun[]" placeholder="Nama akun"></td><td><input class="akun debit" name="debit[]" type="text" value=0 placeholder="debit"></td><td><input value=0 name="kredit[]" class="akun kredit" type="text" placeholder="kredit"></td><td>
		 		<a class='btn btn-default glyphicon glyphicon-remove-sign remove'></a>
		 	</td></tr>
<tr><td colspan=3><a href="#" class="addakun btn btn-default">+</a> </td></tr>
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


<div id="editjurnal" class="modal fade" role="dialog">
  <div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Journal</h4>
      </div>
	  <form method="post" class="fojurnal" action="<?php echo base_url() ?>akuntansi/jurnalmanual_proses/update">
		<div class="modal-body">
		<table class="form">
		<input name="id" type="hidden">
		  <tr><td>Nama Jurnal</td><td><input type="text" name="nama" placeholder="wajib" value="" required></td></tr>	  
		 <tr><td>Tanggal: </td><td colspan=2 ><input class="tgl" type="text" name="tanggal" value="<?php echo date('Y-m-d') ?>"></td><td></td></tr>
		 <tr><td>Sumber Ref</td><td><input type="text" name="sumber" placeholder="" value=""></td></tr>	  
		  <tr><td>Kode Ref</td><td><input type="text" name="ref" placeholder="" value="" ></td></tr>	
			</table>		
			<table id="editakunjurnal" class="form">
			  <tr><td></td><span class='akun'>Debit</span></td><td><br><span class='akun'>Kredit</span></td></tr>
			 <tr> <td><input required type="text" list="akuns" class="namaakun"  autocomplete="off" name="namaakun[]" placeholder="Nama akun"></td><td><input  type="text" list="assets" class="assets"  autocomplete="off" name="namaasset[]" placeholder="Class asset"></td><td><input class="akun" name="debit[]" type="text" value=0 placeholder="debit"></td><td><input value=0 name="kredit[]" class="akun" type="text" placeholder="kredit"></td><td><input  type="text" list="bisnis" class="bisnis"  autocomplete="off" name="namabisnisj[]" placeholder="Bisnis Area J"></td><td><input  type="text" list="bisnis" class="bisnis"  autocomplete="off" name="namabisnisb[]" placeholder="Bisnis Area B"></td>	 	<td>
		 		<a class='btn btn-default glyphicon glyphicon-remove-sign remove'></a>
		 	</td></tr>
		 <tr> <td><input required type="text" list="akuns" class="namaakun"  autocomplete="off" name="namaakun[]" placeholder="Nama akun"></td><td><input  type="text" list="assets" class="assets"  autocomplete="off" name="namaasset[]" placeholder="Class asset"></td><td><input class="akun" name="debit[]" type="text" value=0 placeholder="debit"></td><td><input value=0 name="kredit[]" class="akun" type="text" placeholder="kredit"></td><td><input  type="text" list="bisnis" class="bisnis"  autocomplete="off" name="namabisnisj[]" placeholder="Bisnis Area J"></td><td><input  type="text" list="bisnis" class="bisnis"  autocomplete="off" name="namabisnisb[]" placeholder="Bisnis Area B"></td>	 	<td>
		 		<a class='btn btn-default glyphicon glyphicon-remove-sign remove'></a>
		 	</td></tr>
		 <tr> <td><input  type="text" list="akuns" class="namaakun"  autocomplete="off" name="namaakun[]" placeholder="Nama akun"></td><td><input  type="text" list="assets" class="assets"  autocomplete="off" name="namaasset[]" placeholder="Class asset"></td><td><input class="akun" name="debit[]" type="text" value=0 placeholder="debit"></td><td><input value=0 name="kredit[]" class="akun" type="text" placeholder="kredit"></td><td><input  type="text" list="bisnis" class="bisnis"  autocomplete="off" name="namabisnisj[]" placeholder="Bisnis Area J"></td><td><input  type="text" list="bisnis" class="bisnis"  autocomplete="off" name="namabisnisb[]" placeholder="Bisnis Area B"></td>	 	<td>
		 		<a class='btn btn-default glyphicon glyphicon-remove-sign remove'></a>
		 	</td></tr>
	 <tr> <td><input  type="text" list="akuns" class="namaakun"  autocomplete="off" name="namaakun[]" placeholder="Nama akun"></td><td><input  type="text" list="assets" class="assets"  autocomplete="off" name="namaasset[]" placeholder="Class asset"></td><td><input class="akun" name="debit[]" type="text" value=0 placeholder="debit"></td><td><input value=0 name="kredit[]" class="akun" type="text" placeholder="kredit"></td><td><input  type="text" list="bisnis" class="bisnis"  autocomplete="off" name="namabisnisj[]" placeholder="Bisnis Area J"></td><td><input  type="text" list="bisnis" class="bisnis"  autocomplete="off" name="namabisnisb[]" placeholder="Bisnis Area B"></td>	 	<td>
		 		<a class='btn btn-default glyphicon glyphicon-remove-sign remove'></a>
		 	</td></tr>
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


<div id="createtransaksi" class="modal fade" role="dialog">
  <div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dokumen Transaksi</h4>
      </div>
	  <form method="post" class="fojurnal"  action="<?php echo base_url() ?>akuntansi/jurnalmanual_proses/tambah">
		<div class="modal-body ">
		<table class="form">	  	  
		<tr><td>No Dokumen</td><td><input type="text" name="ref" required placeholder="wajib" value="" ></td></tr>	
		<tr><td>Nama Dokumen</td><td><input type="text" name="sumber" required placeholder="wajib" value=""></td></tr> 
		<tr><td>Tanggal: </td><td colspan=2 ><input class="tgl" type="text" name="tanggal" value="<?php echo date('Y-m-d') ?>"></td><td></td></tr>
   		<tr><td>Uraian</td><td><textarea name="uraian"></textarea></td></tr>	  
   		<tr><td>Nama Jurnal</td><td><input type="text" name="nama" placeholder="wajib" value="" required></td></tr>	  
		</table><br><br>
		<table>
		  <tr><td>Akun</td><td>Debit</td><td>Kredit</td></tr>
				
				 <tr> <td><input required type="text" list="akuns" class="namaakun"  autocomplete="off" name="namaakun[]" placeholder="Nama akun"></td><td><input class="akun debit" name="debit[]" type="text" value=0 placeholder="debit"></td><td><input value=0 name="kredit[]" class="akun kredit" type="text" placeholder="kredit"></td><td>
		 		<a class='btn btn-default glyphicon glyphicon-remove-sign remove'></a>
		 	</td></tr>
<tr><td colspan=3><a href="#" class="addakun btn btn-default">+</a> </td></tr>
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


<datalist id="akuns">
<?php foreach($coa as $c){
	echo "<option value='$c->noakun'>$c->noakun - $c->nakun</option>";
}?>
</datalist>

<div class="dokumen">
<div class="well ">
	<h3>Review Jurnal</h3>
	<p>Fitur ini digunakan untuk mereview jurnal sebelum diposting dan atau menambah jurnal manual</p>
</div>

	<div class="row">
		<div class="col-sm-6 col-xs-6">
			<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createjournal">+ Tambah Jurnal</button>
			<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createtransaksi">+ Tambah Transaksi Lainnya</button>
		</div>
	</div>


<br><br>

<?php 
if($this->session->flashdata('hasil')=="berhasil"){
	echo "<div class=\"alert alert-success\"><strong>Sukses!</strong> Operasi berhasil.</div>";
}
if($this->session->flashdata('hasil')=="gagal"){
	echo "<div class=\"alert alert-danger\"><strong>Gagal!</strong>Terdapat kesalahan, operasi gagal.</div>";
}
	echo $jurnal;
?>
	<div class="row">
		<div class="col-sm-3 col-xs-3">
			<a style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" href="<?php echo base_url()?>akuntansi/jurnalmanual_proses/post" onclick="return confirm('Anda yakin data sudah benar?')">Post Jurnal</a>
			<a style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" href="<?php echo base_url()?>akuntansi/jurnalmanual_proses/clear" onclick="return confirm('Anda yakin?')">Clear Jurnal</a>
		</div>
	</div>

</div>
<script>
$(document).ready(function() {
    $('.editButton').on('click', function() {
        // tarik record
        var id = $(this).attr('data-id');

        $.ajax({
            url: "<?php echo base_url(); ?>akuntansi/jurnalmanual_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#editjurnal')
                .find('[name="id"]').val(response.kjurnalm).end()
				.find('[name="tanggal"]').val(response.tjurnalm).end()
                .find('[name="nama"]').val(response.njurnalm).end()
                .find('[name="sumber"]').val(response.sref).end()
				 .find('[name="ref"]').val(response.kref).end();
			}
		});

		$("#editakunjurnal").empty();

   		var judul = $("<tr>");
   		judul.append ($("<span class='akun'>Debit</span></td><td><span class='akun'>Kredit</span></td>"))
   		judul.append ($("</tr>"))

   		$("#editakunjurnal").append(judul);

        //ajax detail
        $.ajax({
            url: "<?php echo base_url(); ?>akuntansi/jurnalmanual_detail_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            
		      $.each(response, function(index, value){
		      //alert(value);
		      	var coa = value.noakun;
		     	var debit = value.debit;
		      	var kredit = value.kredit;
		 
		      	  var akun = $("<tr>");

				  akun.append($("<td><input value='"+coa+"' type='text' list='akuns' class='namaakun' autocomplete='off' name='namaakun[]' placeholder='Nama akun'></td>"))
					 .append($("<td><input value='"+debit+"' class='akun' name='debit[]' type='text' value=0 placeholder='debit'></td>"))
					 .append($("<td><input value='"+kredit+"' value=0 name='kredit[]' class='akun' type='text' placeholder='kredit'></td>"))
					 .append($("<td><a class='btn btn-default glyphicon glyphicon-remove-sign remove'></a></td>"))
					 .append($("</tr>"));

				$("#editakunjurnal").append(akun);
		      }) // each
		      $("#editakunjurnal").append("<tr><td colspan=6><a href=\"#\" class=\"addakun btn btn-default\">+</a> </td></tr>");
			}
		});//end ajax detail
	}); //end edit


	//add akun dalam jurnal
	$(document).on('click',".addakun",function() {
	  var row = $("<tr>");

	  row.append($("<td><input type='text' list='akuns' class='namaakun' autocomplete='off' name='namaakun[]' required placeholder='Nama akun'></td>"))
		 .append($("<td><input class='akun debit' name='debit[]' type='text' value=0 placeholder='debit'></td>"))
		 .append($("<td><input value=0 name='kredit[]' class='akun kredit' type='text' placeholder='kredit'></td>"))
		 .append($("<td><a class='btn btn-default glyphicon glyphicon-remove-sign remove'></a></td>"))
		 .append($("</tr>"));
	 
	  $(this).before(row);
	  return false;
	});

	$(document).on('paste',"input[name^='namaakun']",function(){
		var ini = $(this);
		var element = this;
		var text;
		var tiap;
		var i;
		var piro=0;
		  setTimeout(function () {
		     text = $(element).val();
		    
		     tiap=text.split(/\s+/);

			ini.val(tiap[0]);
		    for(i=1;i<tiap.length;i++){
		    	ini.closest('tr').nextAll().find("input[name^='namaakun']").slice(piro,i).val(tiap[i]);
		    	piro++;
		    }
		  }, 100)

	});

		$(document).on('paste',"input[name^='debit']",function(){
		var ini = $(this);
		var element = this;
		var text;
		var tiap;
		var i;
		var piro=0;
		  setTimeout(function () {
		     text = $(element).val();
		    
		     tiap=text.split(/\s+/);

		    numb1=tiap[0].replace(/\D/g,'');
			ini.val(numb1);
		    for(i=1;i<tiap.length;i++){
		    	numb = tiap[i].replace(/\D/g,'');
		    	ini.closest('tr').nextAll().find("input[name^='debit']").slice(piro,i).val(numb);
		    	piro++;
		    }
		  }, 100)

	});

	$(document).on('paste',"input[name^='kredit']",function(){
		var ini = $(this);
		var element = this;
		var text;
		var tiap;
		var i;
		var numb;
		var piro=0;
		  setTimeout(function () {
		     text = $(element).val();
		    
		     tiap=text.split(/\s+/);
		    numb1=tiap[0].replace(/\D/g,'');
			ini.val(numb1);
		    for(i=1;i<tiap.length;i++){
		    	numb = tiap[i].replace(/\D/g,'');
		    	ini.closest('tr').nextAll().find("input[name^='kredit']").slice(piro,i).val(numb);
		    	piro++;
		    }
		  }, 100)

	});

	$(document).on('click','.remove',function(){
		$(this).parent().parent().remove();
	});

	$(document).on("submit",".fojurnal",function(){
		var totald=0;
		var totalk=0;
		var err=0;

		$(this).find('input[name^="namaakun"]').each(function() {
    		var debit = 0;
    		var kredit = 0;

    		debit=$(this).parent().parent().find('input[name^="debit"]').val()*1;
    		kredit=$(this).parent().parent().find('input[name^="kredit"]').val()*1;

    		totald += debit;
    		totalk += kredit;

    		if((debit+kredit)==0){
    			err++;
    		}
		});

		selisih = totald-totalk;

		if(err>0){
			alert('Error, debit atau kredit kosong');
	 		return false;
		}

		if(totald==0 && totalk==0){
			alert('Error, debit dan kredit kosong');
	 		return false;
		}

		if(selisih !=0){
	 		alert('Error, terdapat selisih: '+selisih);
	 		return false;
	 	}
	});
}); //end document
</script>