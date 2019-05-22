
<div class="shadow p-3 mb-5 bg-white rounded card offset-md-3" style="width: 40rem; margin-top: 60px;">
  <h4 class="text-center">NUEVA REUNIÓN</h4>
  <form class="" action="<?php echo base_url();?>index.php/newReunion/enviar_datos" method="post">
  <div class="form-group">
    <input type="text" class="form-control text-center" id="titulo" name="titulo" aria-describedby="emailHelp" placeholder="Introduzca el título" required=""  value="<?php echo set_value('titulo'); ?>">
  </div>
   <div class="form-group">
    <input type="text" class="form-control text-center" id="lugar" aria-describedby="emailHelp" name="lugar" placeholder="Introduzca el lugar" required=""  value="<?php echo set_value('lugar'); ?>">
  </div>
   <div class="form-group">
    <input type="date" class="form-control text-center" id="fecha" name="fecha" aria-describedby="emailHelp" required=""  value="<?php echo set_value('fecha'); ?>">
  </div>
  <div class="form-group">
    <input type="time" class="form-control text-center" id="hora" name="hora" aria-describedby="emailHelp" required=""  value="<?php echo set_value('hora'); ?>">
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Motivos de la reunión</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required=""  name="asunto" value="<?php echo set_value('asunto'); ?>"></textarea>
  </div>
  <input type="submit" class="btn btn-primary offset-md-9" value="Crear Reunión"></input>
</form>
</div>
