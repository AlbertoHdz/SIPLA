<!DOCTYPE html>
<html>
<head>
  <title>Organizador - SIPLA</title>
  <link rel="stylesheet" href="<?php echo base_url("public/css/bootstrap.min.css")?>">
  <link rel="stylesheet" href="<?php echo base_url("public/css/style-login.css")?>">
    <script src="<?php echo base_url("public/js/jquery.js")?>"></script>
	<script src="<?php echo base_url("public/js/bootstrap.min.js")?>"></script>
</head>
<body>
  	<style type="text/css">
    	body{
      		margin-top: 50px;
      		margin-left: 100px;
      		margin-right: 100px;
    	}
  	</style>
    <nav class="navbar navbar-expand-lg navbar-light shadow p-3 mb-1 bg-white rounded position ">
      	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      	</button>
  		<div class="collapse navbar-collapse nav justify-content-center" id="navbarTogglerDemo01">
        	<span class="navbar-toggler-icon"></span>
    		<a class="navbar-brand" href="#">SIPLAS</a>
			<ul class="nav">
				<li class="nav-item active">
					<a class="nav-link" href="#">Crear una reunión</a>
				</li>
				<li class="nav-item">
					<a class="nav-link disabled" href="#">Registrar Participante</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Invitar a participante</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Agregar más...</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Agregar más...</a>
				</li>
				<li class="nav-item">
					<a  class="nav-link">Admin SIPLAS</a>
				</li>
				<li class="nav-item">
					<a class="dropdown-item nav-link" href="<?php echo base_url(); ?>index.php/logout">Cerrar sesión</a>
				</li>
			</ul>
  		</div>
	</nav>

	<div class="container-fluid">	
		<div class="row justify-content-center">
			<div class="col">
				<div class="card card-light h-100">
					<div class="card-body">
						<div class="row justify-content-center">
							<div class="col-4">
								<?php echo form_open('createInvitado',array(),array("idRol"=>3)); ?>
								<div class="form-group">
									<label for="user" class="font-weight-bold">Usuario</label>
									<input id="usuario" type="text" class="form-control" name="usuario" required>
								</div>
								<div class="form-group">
									<label for="pass1" class="font-weight-bold">Contraseña</label>
									<input id="pass1" type="password" class="form-control" required>
								</div>
								<div class="form-group">
									<label for="password" class="font-weight-bold">Confirmar contraseña</label>
									<input id="pass2" type="password" class="form-control" name="password" required>
								</div>
								<div class="form-group text-right">
									<button id="enviar" type="button" class="btn btn-lg btn-success">
									<span>Continuar</span>
									<span class='spinner-border spinner-border-md d-none' role='status' aria-hidden='true'></span></button>
									<button id="submit" type="submit" class="btn btn-success" hidden>Enviar2</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modalError" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="font-weight-bold mb-0">Error</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					El usuario ya existe
				</div>
				<!--div class="modal-footer">
					<button class="btn btn-success" data-dismiss="modal">OK</button>
				</div-->
			</div>
		</div>
	</div>
</body>
<script>
	$(document).on("ready",function(){
		$("#enviar").on("click",function(){
			var button = $(this);
			button.attr("disabled",true);
			$("#usuario")[0].setCustomValidity("");
			$("#pass1")[0].setCustomValidity("");
			var inputs = $("form input").toArray();
            console.log(inputs);
            var r = inputs.every((input)=>{
                return input.checkValidity();
            });
			console.log(r);
            if(r){
                console.log("Sintaxis válida");
				if($("#pass1").val() == $("#pass2").val()){
                    button.find("span").eq(0).addClass("d-none");
					button.find("span").eq(1).removeClass("d-none");
					$("form input").attr("readonly",true);
					var datos = {'usuario':$("#usuario").val()};
					$.ajax({
                        url: "verificaUsuario",
                        method: 'GET',
                        data: datos,
                        success: function(data){
                            console.log(data);
                            if(data == 1){
                                $("#usuario")[0].setCustomValidity("El usuario ya existe");
								$("form input").attr("readonly",false);
								button.attr("disabled",false);
							}
							button.find("span").eq(1).addClass("d-none");
							button.find("span").eq(0).removeClass("d-none");
							
							$("button:submit").click();

                        }
                    });
                }else{
                    $("#pass1")[0].setCustomValidity("Las contraseñas deben coincidir.");
					console.log("contraseña dif");
					button.attr("disabled",false);
					$("button:submit").click();
                }
            }else{
                button.attr("disabled",false);
				$("button:submit").click();
            }
        });
        /*$("form").submit(function () {
			console.log("submit");
			return false;
		});*/
	})
</script>
</html>
