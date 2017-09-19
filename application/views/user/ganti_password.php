    <div class="row">
        <div class="col-md-offset-4 col-md-4">
            <div class="form-login">
            <h4>Ganti Password</h4><hr>
			<form method="post">
			<?php
				if($hasil=="salah")
				{
					echo "<div class='alert alert-danger'>Isi password lama dengan benar, dan password baru serta konfirm password harus sama</div>";
				}
				elseif($hasil=="benar")
				{
					echo "<div class='alert alert-success'>Password berhasil diganti</div>";
				}
			?>
				<input type="password" id="username" name="passwordlama" class="form-control input-sm chat-input" placeholder="password lama" char="40" required/>
				</br>
				<input type="password" id="userPassword" name="password1" class="form-control input-sm chat-input" placeholder="password" char="40" required/>
				</br>
				<input type="password" id="userPassword" name="password2" class="form-control input-sm chat-input" placeholder="confirm pass" char="40" required/>
				</br>
				<div class="wrapper">
					<span class="group-btn">     
						<input type="submit" value="Submit" class="btn btn-primary btn-md">
					</span>
				</div>
			</form>
            </div>
        
        </div>
    </div>