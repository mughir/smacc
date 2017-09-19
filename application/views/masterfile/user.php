

<div id="createuser" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add user</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>masterdata/user_proses/tambah">
		<div class="modal-body">
		<table class="form">
		  <tr><td>Username: </td><td><input required type="text" name="username"></td></tr>
		  <tr><td>Password : </td><td><input required type="password" name="password"></td></tr>
		  <tr><td>Nama Pemilik: </td><td><input required type="text" name="nama"></td></tr>
		  <tr><td>Role: </td><td><select name="role" required><option value="" disabled selected>Pilih Role</option><?php foreach($role as $r){echo "<option value=\"$r->idrole\">$r->nrole</option>";}?></select></td></tr>
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
        <h4 class="modal-title">Edit user</h4>
      </div>
	  <form method="post" action="<?php echo base_url() ?>masterdata/user_proses/update">
		<div class="modal-body">
		<table class="form">
		  	<tr><td>Username: </td><td><input readonly required type="text" name="username" value=""></td></tr>
		  	<tr><td>nama Pemilik: </td><td><input required type="text" name="nama" value=""></td></tr>
		 	<tr><td>Role: </td><td><select name="role" required><?php foreach($role as $r){echo "<option value=\"$r->idrole\">$r->nrole</option>";}?></select></td></tr>
			<tr><td>Status User: </td><td><select name="status"><option value="1">Aktif</option><option value="0">Tidak Aktif</option></select></td></tr>
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
	<h3>Masterfile User</h3>
	<p>Fitur ini digunakan untuk mengelola user pada sistem.
</div>


<div class="row">
	<div class="col-sm-3 col-xs-3">
		<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createuser">+ Add User</button>
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
			<th>Username</th>
			<th>Nama</th>
			<th>Status</th>
			<th>Config</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($user as $u){
				echo "<tr><td>$u->username</td><td>$u->nuser</td>";
				if($u->suser==1){
					echo "<td>Aktif</td>";
				}
				else{
					echo "<td>Tidak aktif</td>";
				}
				echo "<td><a href='#' data-id='$u->username' data-toggle='modal' data-target='#edituser' class='editButton btn btn-default glyphicon glyphicon-pencil'></a><a href='".base_url()."masterdata/user_proses/delete/$u->username' onclick=\"return confirm('Anda yakin?')\" class='btn btn-default glyphicon glyphicon-trash'></a></td></tr>";
			}
		?>
	</tbody>
</table>
</div>



<div id="sidemenu">
<ul class="nav">
	<?php // echo $sidenav ?>

	<li><h3>User</h3></li>
	<li><a href="#">Role</a></li>
	<li><a href="#">Otoritas Role</a></li>
	<li><a href="#">User</a></li>
</ul>
</div>
  <script type="text/javascript">
    $('#sidemenu').BootSideMenu({
    	side:"left",
	  	duration: 500,
	  	pushBody: false,
    	remember: true,
    	autoClose:false
    });
  </script>


<script>
$(document).ready(function() {
    $('.editButton').on('click', function() {
        // tarik record
        var id = $(this).attr('data-id');

        $.ajax({
            url: "<?php echo base_url(); ?>masterdata/user_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#edituser')
                .find('[name="username"]').val(response.username).end()
                .find('[name="nama"]').val(response.nuser).end()
                .find('[name="role"]').val(response.idrole).end()
                .find('[name="status"]').val(response.suser).end();
			}
		});
	});
});
</script>