    <div class="row">

        <div class="col-md-offset-4 col-md-4">

            <div class="form-login">

            <h4>Login System</h4><hr>

			<form method="post">

			<?php

				if($hasil==false)

				{

					echo "<div id='logingagal'>Username atau Password salah</div>";

				}

			?>

				<input type="text" id="username" name="username" class="form-control input-sm chat-input" placeholder="username" char="40" required/>

				</br>

				<input type="password" id="userPassword" name="password" class="form-control input-sm chat-input" placeholder="password" char="40" required/>

				</br>

				<select name="periode">
    				<option value="" disabled selected>Pilih Periode</option>
    				<?php 
    					foreach($periode as $p){echo "<option value='$p->kperiode'>$p->nperiode</option>";}
    				?>
    			</select>	</br></br>



				<div class="wrapper">

					<span class="group-btn">     

						<input type="submit" value="Login" class="btn btn-primary btn-md">

					</span>

				</div>

			</form>

            </div>

        

        </div>

    </div>