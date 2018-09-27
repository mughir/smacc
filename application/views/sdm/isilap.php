
<div class="dokumen areaprint">
<table class='table' id="ajaxtable">
	<thead>
		<tr>
			<th>Pegawai</th>
			<th>Gaji</th>
			<th>Pajak</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach($gaji as $u){
				echo "
					<tr>
						<td>$u->idpegawai</td>
						<td>$u->tgaji</td>
						<td>$u->tpajak</td>
					</tr>
					";
			}
		?>
	</tbody>
</table>
</div>