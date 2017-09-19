<div class="dokumen">
<h2 class="text-center">Laporan Penjualan Pos</h2><br><br>
<table class="table">
	<thead>
		<tr>			
			<th>
				No
			</th>
			<th>
				Nama Produk
			</th>			
			<th>
				Jumlah Terjual
			</th>
			<th>
				Jumlah Subtotal
			</th>
			<th>
				Jumlah Diskon
			</th>
			<th>
				Jumlah Bersih
			</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no=0;
			foreach($jumlah as $j){
				$bersih=$j->tsubtotal-$j->tdiskon;
				$no++;
				echo "<tr>";
					echo "<td>$no</td>";
					echo "<td>$j->nbarang</td>";
					echo "<td>$j->tjumlah</td>";
					echo "<td>$j->tsubtotal</td>";
					echo "<td>$j->tdiskon</td>";
					echo "<td>".$bersih."</td>";
				echo "</tr>";
			}
		?>
	</tbody>
</table>
<br><br>
<a href="<?=base_url()?>pos/laporan" class="btn btn-default">Kembali</a>
</div>