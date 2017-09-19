<div class="dokumen">
<h2 class="text-center">Laporan Pembelian</h2><br><br>
<table class="table">
	<thead>
		<tr>			
			<th>
				No
			</th>
			<th>
				Uraian
			</th>			
			<th>
				Jumlah Dibeli
			</th>
			<th>
				Jumlah Subtotal
			</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no=0;
			foreach($jumlah as $j){
				$no++;
				echo "<tr>";
					echo "<td>$no</td>";
					echo "<td>$j->nbarang</td>";
					echo "<td>$j->tjumlah</td>";
					echo "<td>$j->tsubtotal</td>";
				echo "</tr>";
			}
		?>
	</tbody>
</table>
<br><br>
<a href="<?=base_url()?>pembelian/laporan" class="btn btn-default">Kembali</a>
</div>