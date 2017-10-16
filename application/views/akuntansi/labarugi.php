<div class="dokumen"><div id="areaprint">
<h2 class="text-center">Laporan laba rugi <?php echo $this->session->userdata("periode_dari") ?> - <?php echo $this->session->userdata("periode_sampai") ?></h2><br><br>

<table class='table' id="ajaxtable">
	<thead>
		<tr>
			<th>Uraian</th>
			<th>Balance</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$this->load->database();
			$dari=$this->session->userdata("periode_dari");
			$sampai=$this->session->userdata("periode_sampai");

			$net=0;
			$utama=$this->db->where_in("noakun",array(40000,50000))->get("coa")->result();
			foreach($utama as $t){
			echo "<tr><td colspan=3>$t->noakun-$t->nakun</td></tr>";
			$akun=$this->db
				->select("c.noakun")
				->select("lakun")			
				->select("nakun")
				->where("c.katakun",$t->noakun)->get("coa c");
			$total=0;
			$tdebit=0;
			$tkredit=0;

			foreach($akun->result() as $u){
				$debit=0;
				$kredit=0;
				$balance=$this->db
							->where("tjurnal <=",$sampai)
							->where("tjurnal >=",$dari)
							->where("noakun",$u->noakun)
							->select("sum(debit-kredit) as balance",false)
							->from("jurnal j")
							->join("djurnal d","d.kjurnal=j.kjurnal")
							->get()->row()->balance;

				$total+=$balance;
				$net+=$total;

				if($balance<0){
					$balance=$balance*-1;
				}else{
					$balance=$balance;
				}

				echo "<tr><td>";
				switch($u->lakun){
					case "1":
						echo "<span class='nakun lv1'>";
					break;					
					case "2":
						echo "<span class='nakun lv2'> ";
					break;					
					case "3":
						echo "<span class='nakun lv3'> ";
					break;
				}
				echo $u->noakun ."- ". $u->nakun;
				if($u->lakun>1) echo "<td>$balance</td>";
				if($u->lakun<2) echo "<td></td><td></td>";
			}
				if($total<0){
					$tkredit=$total*-1;
				}else{
					$tdebit=$total;
				}


			echo "<tr><td colspan=1><b>Total $t->nakun<br><br></b><td><b>$balance</b></td></tr>";
		}
		$net=$net*-1;
		echo "<tr><td colspan=1><b>Net Profit<br><br></b></td><td><b>$net</b></td></tr>";
		?>
	</tbody>
</table>
<br><br>
</div>
<a href="<?=base_url()?>akuntansi/laporan" class="btn btn-default">Kembali</a>
</div>