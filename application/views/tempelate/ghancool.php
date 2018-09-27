<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=0.6"/>
    <link href="<?php echo base_url(); ?>assets/img/favicon.ico" rel="icon" type="image/x-icon" />
    <title>SMACUP - Small and Medium Enterprise Accounting Software UNPAD</title>
	
	<!-- JS -->
	<script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/BootSideMenu.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.datetimepicker.js"></script>
	<script>
	$(document).ready(function() {
		$(".tgl").datetimepicker({
			timepicker:false,
			format:"Y-m-d",
		    minDate: "<?php echo $this->session->userdata("periode_dari") ?>",
		    maxDate: "<?php echo $this->session->userdata("periode_sampai") ?>",
		});
		$(".tglo").datetimepicker({
			timepicker:false,
			format:"Y-m-d"
		}); 
		$('select').select2({placeholder : 'Silahkan Pilih'});
	});
	</script>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.js"></script>
	
	<!-- Bootstrap core JS -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/jquery.datetimepicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/BootSideMenu.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/smacc.css" rel="stylesheet">

</head>
<body>
<header id="navbar">
	<nav class="navbar-default">
 	 	<div class="container-fluid">
	<a class="navbar-brand" href="#"><img src="<?=base_url("assets/img/logo.gif") ?>"></a>
	<p id="navbar-text" class="navbar-text hidden-xs" href="#">SMACUP - Small and Medium Entrprise Accounting Software UNPAD</p>
    			<ul class="nav navbar-upper navbar-right nav-user">
					<?php
						$lg="";
						if($this->session->userdata("username")){
						$lg.="<li class=\"dropdown\">";
											$lg.="<a href=\"".base_url()."user\" class=\"halonav dropdown-toggle\" data-toggle=\"dropdown\">Logged as ".$this->session->userdata('nama');
												$lg.="<span class=\"caret\"></span></a>";
												$lg.="<ul class='dropdown-menu'>";
													$lg.="<li><a href=\"".base_url()."user/ganti_password\" class=\"halonav\">Ganti Password</a></li>";
													$lg.="<li><a href=\"".base_url()."user/logout\" class=\"halonav\">Logout</a></li>";
												$lg.="</ul>";
											$lg.="</li>";
						}
						echo $lg;
					?>
    			</ul>
  		</div>
	</nav>
	<nav id="nafix" class="navbar navbar-inverse navbar-static-top navbar-lower" data-spy="affix" data-offset-top="10">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false"> <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	    </div>
	    <div class="collapse navbar-collapse">
	      <ul class="nav navbar-nav navbar-left">
		<?=$nav; ?>
	      </ul>
	     </div>
	  </div>
	</nav>
	</header>
	<div class="body">
		<div class="container">
			<?php $this->load->view($hal); ?>
		</div>
	</div>
	<footer>
		<hr>
		<div class="container">
			<p>&copy; 2017</p>
		</div>
	</footer>
	</body>
</html>