<script>
	var idUser = <?php echo $this->session->userdata('idRol');?>;
	$(document).ready(function(){
		$(".verInvitadosReunion").on("click",function(){
			var cls = $(this).attr('data-target');
			var idr = cls.replace("#invitadosReunion",'');
			if(!$(cls).is(":visible")){
				$.ajax({
					url:"<?php echo base_url();?>index.php/reunionUsuarioController/getUsuariosReunion",
					data: {idReunion:idr},
					type:"get",
					beforeSend: function(){
						$("#modalLoading").modal('show');
					},
					sucess: function(data){
						console.log("success");
						
					},
					error: function(e1,e2,e3){
						console.log(e2);
						setTimeout(function(){
							$("#modalLoading").modal('hide');	
						},2000);
						
					}
				}).done(function(data){
					$("#modalLoading").modal('hide');
					data = JSON.parse(data);
					//tabla de usuarios
					var cont = '<tr><th>Usuario</th><th>Tipo de usuario</th><th>confirmó fecha/hora</th><th>Acciones</th></tr>';
					if(data.length == 0)
						$("#tablaInvitados"+idr).html('<div class="alert alert-info">No hay usuarios convocados a esta reunion</div>');
					for (var i = 0; i < data.length; i++) {
						var row = data[i];
						cont += "<tr>";
						cont += "<td>"+row.usuario+"</td>";
						cont += "<td>"+row.nombre+"</td>";
						if(row.confirma == 0){
							cont += "<td>No</td>";
						}else{
							cont += "<td>Si</td>";
						}
						
						if(idUser == 1 && idUser != row.idUsuario){
							cont += "<td><button class='btn btn-danger eliminarusuario' data-info='"+row.idUsuario+"-"+idr+"'>Quitar<span class='glyphicon glyphicon-trash'></span></button></td>";
						}
						cont += "</tr>";

					}
					
					$("#tablaInvitados"+idr).html(cont);
					
				});
				$.ajax({
					url:"<?php echo base_url();?>index.php/AltaInvitadoController/getUsuarios",
					type:"GET"
				}).done(function(data){
					data = JSON.parse(data);
					var combo ="";
					for (var i = 0; i < data.length; i++) {
						var row = data[i];
						combo += "<option value='"+row.idUsuario+"'>"+row.usuario+"</option>";
					}
					$("#comboUsuarios"+idr).html(combo);
				});
			}
		});

		$(".invitarUsuario").on("click", function() {
			var idR = $(this).attr('data-reunion');
			var cu = $("#comboUsuarios"+idR).val();
			console.log(idR);
			$.ajax({
				url:"<?php echo base_url();?>index.php/reunionUsuarioController/agregarInvitadoReunion",
				type: "POST",
				data:{idUsuario:cu,idReunion:idR},
				beforeSend: function(){
					$("#modalLoading").modal('show');
				}
			}).done(function(data){
				$("#modalLoading").modal('hide');
				if(data){
					swal('Excelente','El usuario ha sido invitado','success');
				}else{
					swal('Ups!','ha ocurrido un error','danger');
				}
				$("#invitadosReunion"+idR).collapse('hide');
			});
		});
		
		
		$(".terminarReunion").on("click", function() {
			var idRc = $(this).attr('data-reuniones');
			console.log(idRc);
			$.ajax({
				url:"<?php echo base_url();?>index.php/reunionUsuarioController/cancelarReunion",
				type: "GET",
				data:{idReunion:idRc},
				beforeSend: function(){
					$("#modalLoading").modal('show');
				}
			}).done(function(data){
				$("#modalLoading").modal('hide');
				if(data){
					swal('Ok','Reunión cancelada','success');
				}else{
					swal('Ups!','ha ocurrido un error','danger');
				}
				//$("#invitadosReunion"+idR).collapse('hide');
			});
		});
		

		$(document).off("click",".eliminarusuario");
		$(document).on("click",".eliminarusuario",function(){
			var dur = $(this).attr("data-info");
			swal({
				  title: "¿Sacar usuario de esta reunion?",
				  text: "Esta acción no se puede deshacer, pero lo puede volver a invitar!",
				  icon: "warning",
				  buttons: {
				  	cancel: "No",
				  	Si: true,
				  },
				  dangerMode: true,
				})
				.then((willDelete) => {
				  if (willDelete) {
				  	$.ajax({
				  		url:"<?php echo base_url();?>index.php/reunionUsuarioController/quitarUsuarioReunion",
				  		type: "POST",
				  		data:{idUsuario:dur.split('-')[0],idReunion:dur.split('-')[1]},
				  		beforeSend: function(){
				  			$("#modalLoading").modal("show");
				  		}
				  	}).done(function(data){
				  		$("#modalLoading").modal("hide");
				  		if(data){
				  			swal("Se ha quitado correctamente", {
						      icon: "success",
						    });
				  		}else{
				  			swal("Ha ocurrido un error", {
						      icon: "danger",
						    });
				  		}
				  		$("#invitadosReunion"+dur.split('-')[1]).collapse('hide');
				  	});
				    
				  }
				});
		});
		
		$(document).off("click",".confirmarFechaReunion");
		$(document).on("click",".confirmarFechaReunion",function(){
			var idReunion = $(this).attr('data-reunion');
			var fecha = $("#fechaProp"+idReunion).val();
			var hora = $("#horaPropuesta"+idReunion).val();
			var lugar = $("#lugarPropuesta"+idReunion).val();
			if(fecha == "" || hora == "" || lugar == ""){
				swal("OPS!","rellene todos los campos","warning");
				return false;
			}
			$.ajax({
				url:"<?php echo base_url();?>index.php/propuestasController/agregarPropuesta",
				data:{idReunion:idReunion,fechaPropuesta:fecha,horaPropuesta:hora,lugarPropuesta:lugar},
				type:"post",
				beforeSend: function(){
					$("#modalLoading").modal('show');
				}
			}).done(function(data){
				$("#modalLoading").modal('hide');
				if(data){
		  			swal("Se ha enviado correctamente", {
				      icon: "success",
				    });
		  		}else{
		  			swal("Ha ocurrido un error", {
				      icon: "danger",
				    });
		  		}
		  		$("#fechaPropuesta"+idReunion).collapse('hide');
		  		$("#btnfechaPropuesta"+idReunion).hide();
		  		$("#btnAsistencia"+idReunion).hide();
			});
		});
	});
</script>
<div class="shadow bg-white col-md-10" style="margin: auto;">
  	<div class="container" style="padding-bottom: 30px;">
    	<div class="">
    		<center><h1>Reuniones por asistir</h1></center>
    		<?php
    			if($reuniones == null){
    				?>
    					<div class="alert alert-info">
    						aun no hay reuniones para usted
    					</div>
    				<?php
    			}else
    			foreach ($reuniones as $reunion) {
    				?>
    				<div class="well">
    				 <div class="panel panel-primary">
					  <div class="panel-heading">
					    <h3 class="panel-title"><?php 
					    	echo $reunion['titulo'];
					    	$estatus = $reunion['estatus'];

					    	if($estatus == 1){
					    		?>
					    		<span style="font-size: 0.5em;margin-right: 20px;color: blue;">[En Planeación]</span>
					    		<?php
					    	}else{
					    		if($estatus == 2){
						    		?>
						    		<span style="font-size: 0.5em;margin-right: 20px;color: green;">[En Proceso]</span>
						    		<?php
						    	}else{
						    		?>
						    		<span style="font-size: 0.5em;margin-right: 20px;color: red;">[Terminada]</span>
						    		<?php
						    	}
						    }
					    ?></h3>
					  </div>
					  <div class="alert alert-default">
					  	<input type="hidden" name="idReunion" value="<?php echo $reunion['idReunion']; ?>">
					    <?php
					    	echo "<p>".$reunion['asunto']."</p>";
					    ?>
					    <hr>
					    <button class="btn btn-primary verInvitadosReunion" type="button" data-toggle="collapse" data-target="#invitadosReunion<?php echo $reunion['idReunion']; ?>" aria-expanded="false" aria-controls="invitadosReunion<?php echo $reunion['idReunion']; ?>">
						  ver invitados a reunion
						</button>
						<!-- modal confirmar Asistencia-->
<?php
						    	if($this->session->userdata('idRol') != 1){
						    		?>							<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Confirmar mi asistencia
</button>
<?php } ?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Esta Apunto de confirmar su asistencia a la reunión, esta seguro?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" value="">Confirmar</button>
      </div>
    </div>
  </div>
</div>


					

						<div class="collapse" id="invitadosReunion<?php echo $reunion['idReunion']; ?>">
						  <div class="well">
						    <p>Lista de los usuario en esta reunion</p>
						    <?php
						    	if($this->session->userdata('idRol') != 3){
						    		?>
						    		<button class="btn btn-primary " type="button" data-toggle="collapse" data-target="#formAgregarInvitados<?php echo $reunion['idReunion']; ?>" aria-expanded="false" aria-controls="">
									  Añadir participante
									</button>
									<div class="collapse" id="formAgregarInvitados<?php echo $reunion['idReunion']; ?>">
									  	<div class="well">
											<div class="form-inline">
											  <div class="form-group">
											    <label for="comboUsuarios<?php echo $reunion['idReunion']; ?>">Usuario: </label>
											    <select type="text" class="form-control comboUsuarios" id="comboUsuarios<?php echo $reunion['idReunion']; ?>" placeholder="seleccione un usuario"></select>
											  </div>
											  
											  <button type="button" class="btn btn-primary invitarUsuario" data-reunion="<?php echo $reunion['idReunion']; ?>">invitar</button>
											</div>
										</div>
									</div>
						    		<?php
						    	}
						    ?>
						    <table class="table table-striped" id="tablaInvitados<?php echo $reunion['idReunion'];?>">
						    	
						    </table>
						  </div>
						</div>
					  </div>
					  <div class="panel-footer">
					  	<?php
					  		echo " Fecha:  ".$reunion['fecha'];
					  		echo " - ";
					  		echo $reunion['hora'];
					  		echo ".  Lugar: ";
		    				echo $reunion['lugar'];

		    				if($estatus == 1 && $this->session->userdata('idUsuario') == $reunion['idUsuario']){
		    					?>

		    					<div>
									<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#fijarFecha<?php echo $reunion['idReunion']; ?>" aria-expanded="false" aria-controls="">
									  Fijar fecha definitiva
									</button>
						    		<button class="btn btn-primary extenderFechas" type="button" data-toggle="collapse" data-target="#rangoFechas<?php echo $reunion['idReunion']; ?>" aria-expanded="false" aria-controls="">
									  Cambiar el rango de fechas
									</button>
									<button class="btn btn-danger " type="button" data-toggle="collapse" data-target="#terminarReunion<?php echo $reunion['idReunion']; ?>" aria-expanded="false" aria-controls="terminarReunion<?php echo $reunion['idReunion']; ?>">
									  Terminar reunion
									</button>
						
									<div class="collapse" id="terminarReunion<?php echo $reunion['idReunion']; ?>">
									  	<div class="well">
											<div class="form-inline">
											  Esta seguro de querer terminar/cancelar la reunión
											  
											  <button type="button" class="btn btn-success terminarReunion" data-reuniones="<?php echo $reunion['idReunion']; ?>"> Sí </button>
											</div>
										</div>
									</div>
						
									<div class="collapse" id="rangoFechas<?php echo $reunion['idReunion']; ?>">
										  <div class="well">
										    
										    
											<div class="">
												<h3>Cambiar rango de fechas</h3>
												<label class="form-label" for="fechaInit<?php echo $reunion['idReunion']; ?>">Fecha Inicio</label>
												<input type="date" class="form-control" placeholder="fecha tentativa inicial" name="fechaInicial" id="fechaInicial<?php echo $reunion['idReunion']; ?>">
												<label class="form-label" for="HoraInit<?php echo $reunion['idReunion']; ?>">Hora inicial</label>
												<input type="time" class="form-control" placeholder="Hora tentativa inicial" name="HoraInicial" id="HoraInit<?php echo $reunion['idReunion']; ?>">
												<br>
												<label class="form-label" for="fechaFinal<?php echo $reunion['idReunion']; ?>">Fecha Final</label>
												<input type="date" class="form-control" placeholder="Fecha tentativa Final" name="fechaFinal" id="fechaFinal<?php echo $reunion['idReunion']; ?>">
												<label class="form-label" for="HoraFinal">Hora Limite</label>
												<input type="time" class="form-control" placeholder="Hora tentativa limite" name="HoraLimite" id="HoraLimite<?php echo $reunion['idReunion']; ?>">
												<hr>
												<button class="btn btn-primary " type="button" data-toggle="collapse" data-reunion="<?php echo $reunion['idReunion']; ?>" aria-expanded="false" aria-controls="">
												  Actualizar Rango
												</button>
											</div>
									    		
										  </div>
										</div>


										<div class="collapse" id="fijarFecha<?php echo $reunion['idReunion']; ?>">
										  <div class="well">
										    
										  
											<form action="<?php echo base_url();?>index.php/reunionUsuarioController/fijarFecha" method="POST">
												<div class="">
												<h3>Fijar fecha</h3>
												<label class="form-label" for="fecha<?php echo $reunion['idReunion']; ?>">Fecha Definitiva</label>
												<input type="date" class="form-control" placeholder="Fecha definitiva" name="fecha" id="fechaDef<?php echo $reunion['idReunion']; ?>" required>
												<input type="text" name="idReunion" value="<?php echo $reunion['idReunion']; ?>" required hidden>
												<button class="btn btn-primary " type="submit" data-toggle="collapse" data-reunion="<?php echo $reunion['idReunion']; ?>" aria-expanded="false" aria-controls="">
												  Guardar
												</button>
											</div>
											</form>
									    		
										  </div>
										</div>
									  </div>
						    		<?php
		    				}else if(isset($reunion['confirmar'])) if($reunion['confirmar'] == 0 && $reunion['idUsuario'] != $this->session->userdata('idUsuario')){
		    					?>
		    					<div>
		    					<button class="btn btn-primary confirmarFechaReunion" type="button" data-toggle="collapse" data-reunion="<?php echo $reunion['idReunion']; ?>" aria-expanded="false" id="btnAsistencia<?php echo $reunion['idReunion']?>" aria-controls="">
									  Confirmar asistencia
									</button>
						    		<button class="btn btn-primary fechaPropuesta" type="button" data-toggle="collapse" data-target="#fechaPropuesta<?php echo $reunion['idReunion']; ?>" id="btnfechaPropuesta<?php echo $reunion['idReunion']; ?>" aria-expanded="false" aria-controls="">
									  Establecer fecha/hora
									</button>
									<div class="collapse" id="fechaPropuesta<?php echo $reunion['idReunion']; ?>">
										  <div class="well">
										    
										    <?php echo form_open('newReunion/fechaPropuesta'); ?>
											<div class="">
												<h3>Ingresa una fecha que si puedas</h3>
												<label class="form-label" for="fechaProp<?php echo $reunion['idReunion']; ?>">Fecha:</label>
												<input type="date" class="form-control" placeholder="fecha tentativa" name="fechaPropuesta" id="fechaProp<?php echo $reunion['idReunion']; ?>">
												<label class="form-label" for="horaPropuesta<?php echo $reunion['idReunion']; ?>">Hora:</label>
												<input type="time" class="form-control" placeholder="Hora tentativa" name="HoraPropuesta" id="horaPropuesta<?php echo $reunion['idReunion']; ?>">
												<label class="form-label" for="lugarPropuesta<?php echo $reunion['idReunion']; ?>">Lugar</label>
												<input class="form-control" name="lugarPropuesta" id="lugarPropuesta<?php echo $reunion['idReunion']; ?>" value="">
												<hr>
												<button class="btn btn-primary confirmarFechaReunion" type="button" data-toggle="collapse" data-reunion="<?php echo $reunion['idReunion']; ?>" aria-expanded="false" aria-controls="">
												  Enviar fecha propuesta
												</button>
											</div>
									    		
										  </div>
										</div>
									  </div>
						    		<?php
		    				}
		    				
					  	?>
					  </div>
					 </div>
					</div>

    				<?php
    				
    			}
    		?>
    	</div>
	</div>
</div>