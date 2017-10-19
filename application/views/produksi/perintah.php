<datalist id="barang">
<?php foreach($barang as $b){
	echo "<option value='$b->idbarang'>$b->idbarang - $b->nbarang</option>";
}
?>
</datalist>


<div id="createperintah" class="modal fade" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Perintah</h4>
      </div>
	  <form method="post" action="?tipe=tambah">
		<div class="modal-body">
			<table class="form"">
				<thead>
				<tr><td>Tanggal</td><td><input name="tanggal" type="date"></td></tr>
				<tr><td>Barang</td><td><input name="barang"  type="text" list="barang" autocomplete="off"></td></tr>
				<tr><td>Jumlah</td><td><input name="jumlah" type="number" min=0></td></tr>
				<tr><td>Prioritas</td><td><input name="prioritas" type="number" min=0 max=3></td></tr>
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
	<h3>Fungsi Perintah Produksi</h3>
	<p>Fitur ini digunakan untuk mencatat perintah produksi suatu produk</p>
</div>
	<div class="row">
		<div class="col-sm-3 col-xs-3">
			<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createperintah">+ Add Perintah Produksi</button>
		</div>
	</div>


<br><br>


<table class='table' id="ajaxtable">
	<thead>
		<tr>
			<th>No perintah</th>
			<th>Waktu</th>
			<th>Barang</th>
			<th>Jumlah</th>
			<th>Terjadwal</th>
			<th>Finish</th>
			<th>Prioritas</th>
			<th>Status</th>
		</tr>
	</thead>	
	<tobdy>
<?php
	$this->load->model("m_Perintah");
	foreach($perintah as $p){
		echo "<tr>";
			echo "<td>$p->idorder</td>";
			echo "<td>$p->tanggal</td>";
			echo "<td>$p->idbarang</td>";
			echo "<td>$p->jumlah</td>";
			echo "<td>".$this->m_Perintah->get_terjadwal($p->idorder)."</td>";
			echo "<td>".$this->m_Perintah->get_finish($p->idorder)."</td>";
			echo "<td>$p->prioritas</td>";
			echo "<td>$p->status</td>";
		echo "</tr>";
	}
?>
	</tbody>
</table>

</div>
<script>
$(document).ready(function() {
}
</script>