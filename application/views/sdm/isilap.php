
<div class="dokumen">
<table class='table' id="ajaxtable">
	<thead>
		<tr>
			<th>Pegawai</th>
			<th>Gaji</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach($gaji as $u){
				echo "
					<tr>
						<td>$u->idpegawai</td>
						<td>$u->tgaji</td>
					</tr>
					";
			}
		?>
	</tbody>
</table>
</div>