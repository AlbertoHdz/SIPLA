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
						if(row.confirmar){
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
						<?php
						    	if($this->session->userdata('idRol') != 1){
						    		?>
						<button class="btn btn-primary verInvitadosReunion" type="button">
						  Confirmar mi asistencia
						</button>
						<button class="btn btn-primary verInvitadosReunion" type="button">
						  Establecer fecha y horario 
						</button>
						<?php }  ?>
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

		    				if($estatus == 1 and $this->session->userdata('idUsuario') == $reunion['idUsuario']){
		    					?>
						    		<button class="btn btn-primary extenderFechas" type="button" data-toggle="collapse" data-target="#rangoFechas<?php echo $reunion['idReunion']; ?>" aria-expanded="false" aria-controls="">
									  Cambiar el rango de fechas
									</button>
									<div class="collapse" id="rangoFechas<?php echo $reunion['idReunion']; ?>">
										  <div class="well">
										    
										    <?php echo form_open('newReunion/extenderFechas'); ?>
											<div class="">
												<h3>Cambiar rango de fechas</h3>
												<label class="form-label" for="fechaInit">Fecha Inicio</label>
												<input type="date" placeholder="Hora tentativa inicial" name="HoraInicial" id="HoraInit">
												<label class="form-label" for="HoraInit">Hora inicial</label>
												<input type="time" placeholder="Hora tentativa inicial" name="HoraInicial" id="HoraInit">
												<br>
												<label class="form-label" for="fechaFinal">Fecha Final</label>
												<input type="date" placeholder="Fecha tentativa Final" name="fechaFinal" id="fechaFinal">
												<label class="form-label" for="HoraFinal">Hora Limite</label>
												<input type="time" placeholder="Hora tentativa limite" name="HoraLimite" id="HoraLimite">
												<hr>
												<button class="btn btn-primary " type="button" data-toggle="collapse" data-target="#modalInvitarUsuario" aria-expanded="false" aria-controls="">
												  Actualizar Rango
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