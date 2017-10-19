<div class="dokumen">
	<div class="isilaporan">
<h2 class="text-center">Laporan Penjualan</h2><br><br>
<table class="table areaprint">
	<thead>
		<tr>			
			<th>
				No
			</th>
			<th>
				Uraian
			</th>			
			<th>
				Jumlah Terjual
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
</div>
<a href="#" id="printnormal" class="btn btn-default">Print</a>
<a href="#" id="printpdf" class="btn btn-default">Print PDF</a>
<a href="<?=base_url()?>penjualan/laporan" class="btn btn-default">Kembali</a>
</div>
<script src="<?php echo base_url(); ?>asset/js/html2canvas.min.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jspdf.min.js"></script>
<script src="<?php echo base_url(); ?>asset/js/html2pdf.js"></script>
<script>
$(document).ready(function() {
	$("#printnormal").click(function(){
			window.print();
		return false;
	});

	$("#printpdf").click(function(){
			var doc = new jsPDF();

			var html = $(".isilaporan").get(0);
			var option = {
							  margin:       1,
							  filename:     "<?php echo "Laporan Penjualan [".substr(md5(date("Y-m-d H:i:s")),0,8); ?>].pdf",
							  image:        { type: 'jpeg', quality: 0.98 },
							  html2canvas:  { dpi: 400, letterRendering: true },
							  jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait'}
						};

			html2pdf(html, option);

		return false;
	});
});
</script>