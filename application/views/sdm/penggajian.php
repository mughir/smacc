
<div class="dokumen">
<table class='table' id="ajaxtable">
	<thead>
		<tr>
			<th>No Gaji</th>
			<th>Tahun</th>
			<th>Bulan</th>
			<th>Pegawai</th>
			<th>Gaji</th>
			<th>Pajak</th>
			<th>Conf</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach($gaji as $u){
				echo "
					<tr>
						<td>$u->idgaji</td>
						<td>$u->tahun</td>
						<td>$u->bulan</td>
						<td>$u->idpegawai</td>
						<td>$u->gaji</td>
						<td>$u->pajak</td>
						<td>							
							<a href='?proses=delete&tahun=$u->tahun&bulan=$u->bulan&id=".$u->idgaji."' onclick=\"return confirm('Anda yakin?')\" class='btn btn-default glyphicon glyphicon-trash'></a>
						</td>
					</tr>
					";
			}
		?>
	</tbody>
</table>
</div>