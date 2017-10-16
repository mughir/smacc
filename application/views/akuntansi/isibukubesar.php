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
			<th>
				Balance Debit
			</th>			
			<th>
				Balance Kredit
			</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no=0;
			$b=0;
			foreach($bukubesar as $j){
				$no++;
				$bd=0;
				$bk=0;
				echo "<tr>";
					echo "<td>$j->tjurnal</td>";
					echo "<td>$j->njurnal</td>";
					echo "<td>$j->sref - $j->kref</td>";
					echo "<td>$j->debit</td>";
					echo "<td>$j->kredit</td>";
					$b+=($j->debit-$j->kredit);
					if($b<0){
						$bk+=$b*-1;
					}else{
						$bd+=$b;
					}
					echo "<td>$bd</td>";
					echo "<td>$bk</td>";
				echo "</tr>";
			}
		?>
	</tbody>
</table>
<br><br>
<a href="<?=base_url()?>akuntansi/bukubesar" class="btn btn-default">Kembali</a>
</div>