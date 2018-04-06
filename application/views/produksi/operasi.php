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

<div id="viewkartu" class="areaprint modal fade" role="dialog">
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
	<tr><td>No Batch</td><td><input name="batch" readonly type="text"></td></tr>
	<tr><td>No Kartu</td><td><input name="kartu" readonly type="text"></td></tr>
	<tr><td>Tanggal</td><td><input name="tanggal" readonly class="tgl" type="text"></td></tr>
	<tr><td>Nama Operasi</td><td><input name="operasi" readonly type="text"></td></tr>
	<tr><td><br><br></td><td></td></tr>
</table>
		
      </div>
	  <br>
      <div class="modal-footer">
        <a class="btn btn-default" onclick="window.print()">Print</a> <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
			<th>NO/NB/NK</th>
			<th>Waktu</th>
			<th>Barang</th>
			<th>Jumlah</th>
			<th>Operasi</th>
			<th>Status</th>
			<th>Conf</th>
		</tr>
	</thead>	
	<tobdy>
		<?php
			foreach($operasi as $o){
				echo "
					<tr>
						<td>$o->idorder / $o->idjadwal / $o->nokartu</td>
						<td>$o->waktu</td>
						<td>$o->idbarang - $o->nbarang</td>
						<td>$o->jumlah</td>
						<td>$o->namaoperasi</td>
						<td>$o->status</td>
						<td><a gref='#' data-target='#viewkartu' data-id='$o->nokartu' data-toggle='modal' class='viewbutton btn btn-default glyphicon glyphicon-eye-open'></a></td>
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
    $('.viewbutton').on('click', function() {
        // tarik record
        var id = $(this).attr('data-id');

        //ajax header
        $.ajax({
            url: "<?php echo base_url(); ?>produksi/ajax_operasi/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#viewkartu')
                .find('[name="batch"]').val(response.idjadwal).end()
                .find('[name="kartu"]').val(response.nokartu).end()
                .find('[name="tanggal"]').val(response.waktu).end()
				.find('[name="operasi"]').val(response.namaoperasi).end();
			}
		});//end ajax header

	});//end edit Operasi
}); //end document
</script>