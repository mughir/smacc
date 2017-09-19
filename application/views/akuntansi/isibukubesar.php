<div class="dokumen">
            <h4>Buku Besar <?php echo $akun ?></h4><hr>
<table class="table">
	<thead>
		<tr>			
			<th>
				Tanggal
			</th>
			<th>
				Nama Jurnal
			</th>			
			<th>
				Ref
			</th>
			<th>
				Debit
			</th>
			<th>
				Kredit
			</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no=0;
			foreach($bukubesar as $j){
				$no++;
				echo "<tr>";
					echo "<td>$j->tjurnal</td>";
					echo "<td>$j->njurnal</td>";
					echo "<td>$j->sref - $j->kref</td>";
					echo "<td>$j->debit</td>";
					echo "<td>$j->kredit</td>";
				echo "</tr>";
			}
		?>
	</tbody>
</table>
<br><br>
<a href="<?=base_url()?>akuntansi/bukubesar" class="btn btn-default">Kembali</a>
</div>