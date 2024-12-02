<!-- Scripts -->

<script src="{{ asset('js/app.js') }}" defer></script>   

<!-- Styles -->

<link href="{{ asset('css/app.css') }}" rel="stylesheet">



<?php //dd ($data[0]['nombre']);  //die;


?>


<div class="row">
	<div class="col-md-12">
		<section class="panel"> 
			<div class="panel-body">

                
                <!--  Acá el formulario en Limpio para crear un nuevo registro -->

                <div class="form-group">
                        <label for="nombre" class="negrita">Nombre:</label> 
                        <div>
                            <input class="form-control" placeholder="Jugo de Fresa" required="required" name="nombre" type="text" id="nombre"> 
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label for="precio" class="negrita">Precio:</label> 
                        <div>
                            <input class="form-control" placeholder="4.50" required="required" name="precio" type="text" id="precio"> 
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label for="stock" class="negrita">Stock:</label> 
                        <div>
                            <input class="form-control" placeholder="40" required="required" name="stock" type="text" id="stock"> 
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label for="img" class="negrita">Selecciona una imagen:</label>
                        <div>
                            <input name="img" type="file" id="img"> 
                        </div>
                    </div>
                

                
                    <button type="submit" class="btn btn-info">Guardar</button>
                    <a href="{{ route('profesionales') }}" class="btn btn-warning">Cancelar</a>

                    <br>
                    <br> 
            </div>
		</section>
	</div>
</div>


<form method="POST" action="{{ route('profesionales/update', 1) }}" role="form" enctype="multipart/form-data">
 
  <input type="hidden" name="_method" value="PUT">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
 
  @include('profesionales.formulario.parte')
                                                          
</form>