    <div class="row">
        <div class="col-md-offset-4 col-md-4">
            <div class="form-login"><?php 
				if($this->session->flashdata('hasil')=="berhasil"){
					echo "<div class=\"alert alert-success\"><strong>Sukses!</strong> Operasi berhasil.</div>";
				}
				if($this->session->flashdata('hasil')=="gagal"){
					echo "<div class=\"alert alert-danger\"><strong>Gagal!</strong>Terdapat kesalahan, operasi gagal.</div>";
				}
				?>
		
            <h4>Tutup Buku Periode <br><?php echo $this->session->userdata("periode_dari") ?> s/d <?php echo $this->session->userdata("periode_sampai") ?></h4><hr>
			<form method="post" action="?proses=tutup">
			<?php
			?>
				<input type="password" id="userPassword" name="password1" class="form-control input-sm chat-input" placeholder="password" char="40" required/>
				</br>
				<input type="password" id="userPassword" name="password2" class="form-control input-sm chat-input" placeholder="confirm pass" char="40" required/>
				</br>
				<select name="periode"><option disabled selected>Periode selanjutnya</option><?php foreach($periode as $p){echo "<option value='$p->kperiode'>$p->nperiode</option>"; } ?></select><br><br><br>
				<div class="wrapper">
					<span class="group-btn">     
						<input type="submit" value="Submit" class="btn btn-primary btn-md">
					</span>
				</div>
			</form>
            </div>
        
        </div>
    </div>