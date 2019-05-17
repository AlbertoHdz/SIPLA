<!DOCTYPE html>
<html>
<head>
	<title>Login - SIPLA</title>
	<link rel="stylesheet" href="<?php echo base_url("public/css/bootstrap.min.css")?>">
	<link rel="stylesheet" href="<?php echo base_url("public/css/style-login.css")?>">
    <script src="<?php echo base_url("public/js/bootstrap.min.js")?>"></script>
    <script src="<?php echo base_url("public/js/jquery.js")?>"></script>
</head>
<body>
<div class="login-reg-panel">
		<div class="login-info-box">
			
		</div>
							
		<div class="register-info-box">
			<h2>SIPLA</h2>
			<p>Sistema de planeación de reuniones. Lleva un control exacto. </p>
		</div>
							
		<div class="white-panel">
			<?php echo form_open('login'); ?>
			<div class="login-show">
				<h2>LOGIN</h2>
				<input type="text" placeholder="Usuario" name="usuario">
				<input type="password" placeholder="Contraseña" name="password">
				<input type="submit" value="Entrar" class="btn btn-primary">
			</div>
			<?php 
						if($this->session->flashdata('error_login'))
						{
					?>
					<div class='alert alert-danger alert-dismissible' role="alert">
						 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
						 </button>
						<?=$this->session->flashdata('error_login')?></div>
					<?php
						}
					?>
		</div>
	</div>
</body>
</html>