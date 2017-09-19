<div id="createuser" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Chart of Account</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>masterdata/akun_proses/tambah">
		<div class="modal-body">
		<table class="form">
		  <tr><td>Kode Akun: </td><td><input required type="text" name="id"></td></tr>
		  <tr><td>Nama Akun : </td><td><input required type="text" name="nama"></td></tr>
		  <tr><td>Level: </td><td><input required type="number" max="3" min="1" name="level"></td></tr>
		  <tr><td>Posisi Akun: </td><td><select required name="posisi"><option value="D">Debit</option><option value="K">Kredit</option></select></td></tr>
		  <tr><td>Parent: </td><td><select  name="kategori"><option value="">No Parent</option><?php foreach($user as $a){echo "<option value='$a->noakun'>$a->nakun</option>"; } ?></select></td></tr>
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

<div id="edituser" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Chart of Account</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>masterdata/akun_proses/update">
		<div class="modal-body">
		<table class="form">
		  <tr><td>ID akun: </td><td><input readonly required type="text" name="id" value=""></td></tr>  
		  <tr><td>Nama Akun : </td><td><input required type="text" name="nama"></td></tr>
		  <tr><td>Level: </td><td><input required type="number" max="3" min="1" name="level"></td></tr>
		  <tr><td>Posisi Akun: </td><td><select required name="posisi"><option value="D">Debit</option><option value="K">Kredit</option></select></td></tr>
		  <tr><td>Parent: </td><td><select  name="kategori"><option value="">No Parent</option><?php foreach($user as $a){echo "<option value='$a->noakun'>$a->nakun</option>"; } ?></select></td></tr>
	
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
	<h3>Masterfile Chart of Account</h3>
	<p>Fitur ini digunakan untuk mengelola data Chart of Account pada sistem.
</div>


<div class="row">
	<div class="col-sm-3 col-xs-3">
		<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createuser">+ Add Akun</button>
	</div>
</div>


<br>
<br>
<?php if($this->session->flashdata('hasil')=="berhasil"){
	echo "<div class=\"alert alert-success\"><strong>Sukses!</strong> Operasi berhasil.</div>";
}
?>
<?php if($this->session->flashdata('hasil')=="gagal"){
	echo "<div class=\"alert alert-danger\"><strong>Gagal!</strong>Terdapat kesalahan, operasi gagal.</div>";
}
?>
<table class='table' id="ajaxtable">
	<thead>
		<tr>
			<th>akun</th>
			<th>Level</th>
			<th>Posisi</th>
			<th>Parent</th>
			<th>Config</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($user as $u){
				echo "<tr><td>";
				switch($u->lakun){
					case "1":
						echo "<span class='nakun lv1'>";
					break;					
					case "2":
						echo "<span class='nakun lv2'> ";
					break;					
					case "3":
						echo "<span class='nakun lv3'> ";
					break;
				}
				echo $u->noakun ."- ". $u->nakun."</span></td><td>$u->lakun</td><td>$u->posakun</td><td>$u->katakun</td>";
				echo "<td><a href='#' data-id='$u->noakun' data-toggle='modal' data-target='#edituser' class='editButton btn btn-default glyphicon glyphicon-pencil'></a><a href='".base_url()."masterdata/akun_proses/delete/$u->noakun' onclick=\"return confirm('Anda yakin?')\" class='btn btn-default glyphicon glyphicon-trash'></a></td></tr>";
			}
		?>
	</tbody>
</table>
</div>
<script>
$(document).ready(function() {
    $('.editButton').on('click', function() {
        // tarik record
        var id = $(this).attr('data-id');

        $.ajax({
            url: "<?php echo base_url(); ?>masterdata/akun_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#edituser')
                .find('[name="id"]').val(response.noakun).end()
                .find('[name="nama"]').val(response.nakun).end()
                .find('[name="level"]').val(response.lakun).end()
                .find('[name="posisi"]').val(response.posakun).end()
                .find('[name="kategori"]').val(response.katakun).end();
			}
		});
	});
});
</script>