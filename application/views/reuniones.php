<div class="shadow bg-white col-md-10" style="margin: auto;">
  	<div class="container">
    	<div class="">
    		<center><h1>Reuniones por asistir</h1></center>
    		<?php
    			foreach ($reuniones as $reunion) {
    				?>
    				<div class="well">
    				 <div class="panel panel-primary">
					  <div class="panel-heading">
					    <h3 class="panel-title"><?php 
					    	echo $reunion['titulo'];
					    	$estatus = $reunion['estatus'];
					    	if($estatus){
					    		?>
					    		<span style="font-size: 0.5em;margin-right: 20px;color: green;">[En proceso]</span>
					    		<?php
					    	}else{
					    		?>
					    		<span style="font-size: 0.5em;margin-right: 20px;color: green;">[Terminada]</span>
					    		<?php
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
						<div class="collapse" id="invitadosReunion<?php echo $reunion['idReunion']; ?>">
						  <div class="well">
						    <p>Lista de los usuario en esta reunion</p>
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