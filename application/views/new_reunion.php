
<div class="shadow p-3 mb-5 bg-white rounded card offset-md-3" style="width: 40rem; margin-top: 60px;">
  <h4 class="text-center">NUEVA REUNIÓN</h4>
  <form>
  <div class="form-group">
    <input type="email" class="form-control text-center" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Introduzca el título">
  </div>
   <div class="form-group">
    <input type="email" class="form-control text-center" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Introduzca el lugar">
  </div>
   <div class="form-group">
    <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
        </script>
   <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control"  />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Motivos de la reunión</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary offset-md-9">Crear Reunión</button>
</form>
</div>
