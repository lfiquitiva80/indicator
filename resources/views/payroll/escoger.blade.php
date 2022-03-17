
<!DOCTYPE html>
<html>

<head>
	<title>&Iacute;ndice Costos </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="../css/menuHorizontal.css" rel="stylesheet" type="text/css" media="screen" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="../js/submenu.js"></script>
	<script src="{{asset('js/dq3.js')}}"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<style>
		body { display: block; margin: 15px; }
 		td { padding: 1%; }
		body:focus { outline: none; }

		a.linknumero:link {color:#000000; text-decoration-line: underline  }
		a.linknumero:visited {color:#000000; text-decoration-line: underline }
		a.linknumero:active {color:#000000; text-decoration-line: underline }
		a.linknumero:hover {color:#000000; text-decoration-line: underline } 
		i.fa {font-size:100px}
		a.linkmigas:link {color:#EEAC6D }
		a.linkmigas:visited {color:#EEAC6D }
		a.linkmigas:active {color:#EEAC6D }	
		a.linkmigas:hover {color:#EEAC6D } 
 		 
	</style>

</head>   

<!-- Toma de datos primarios -->

	

<!-- Toma de datos secundarios -->

<div> 
	<div id="wrapperMenu">	             
		<ol class="breadcrumb">
		  <li class="breadcrumb-item"><strong><a class="linkmigas" href="{{ url('indicenomina') }}">Indicadores Nómina</a></strong></li> 
 		  <li class="breadcrumb-item active"><strong>Seleccione los a&ntilde;os</strong></li>
		</ol>
	</div>

	<table style="width:70%" align="center" class="table table-hover table-striped table-bordered"> 
		<tr align="center">
			<td bgcolor='#C3EE6D' colspan="4"><font color='black'>Seleccione los parametros de busqueda</font></td>
		</tr>
		<tr align="center">
			<td bgcolor='#C3EE6D' colspan="2"><font color='black'>Numero de a&ntilde;os</font></td>
			<td bgcolor='#C3EE6D' colspan="2"><font color='black'>Limite de meses</font></td>
		</tr>
		<tr>
			<td>Numero de a&ntilde;os elegidos: <strong id="elegidos">0</strong></td> 
			<td>Mes Inicial: <strong id="m1"></strong></td>  
			<td>Mes Final: <strong id="m2"></strong></td>
		</tr>

		<tr>
			
					<td colspan="3"><center>
					<label>Seleccionar un área</label>	
				<select class='form-control' style='width: 80%' name='area'  placeholder="Seleccione un área">
			<option value="">Todas</option> 
		     <option value="PERSONAL CULTIVO">PERSONAL CULTIVO</option>
             <option value="SANIDAD - INFRAESTRUCTURA">SANIDAD - INFRAESTRUCTURA</option>
             <option value="FABRICA">FABRICA</option>
             <option value="GANADERIA">GANADERIA</option>
             <option value="ADMINISTRACION">ADMINISTRACION</option>
             <option value="TALLER">TALLER</option>
             <option value="PROYECTOS">PROYECTOS</option>
             <option value="OBRAS CIVILES">OBRAS CIVILES</option>
             <option value="VARIOS">VARIOS</option>
             <option value="PERSONAL CACAY">PERSONAL CACAY</option>
				</select>
			</center>
	

			</td>


		</tr> 
	</table>

	<table style="width:70%" align="center" class="table table-hover table-striped table-bordered"> 
		<form autocomplete='off' action="" method="{{route('seleccionaranios')}}">
		<tr align="center">
			
		</tr> 
		<tr align="center">
			<td bgcolor='#C3EE6D'><font color='black'>Escriba los a&ntilde;os</font></td>
		</tr> 
		<tr >
			
			<td ocultar><div class='form-group uno'><input class='form-control uno' type='number' aria-describedby='emailHelp' placeholder='Escribir a&ntilde;o ... ' min='2015' max='2021' name='eleAnio[]' required></div></td>
			</tr><tr >
			<td ocultar><div class='form-group dos'><input class='form-control dos' type='number' aria-describedby='emailHelp' placeholder='Escribir a&ntilde;o ... ' min='2015' max='2021' name='eleAnio[]' ></div></td>
			</tr><tr >
			<td ocultar><div class='form-group tres'><input class='form-control tres' type='number' aria-describedby='emailHelp' placeholder='Escribir a&ntilde;o ... ' min='2015' max='2021' name='eleAnio[]' ></div></td>
			</tr><tr >
			<td ocultar><div class='form-group cuatro'><input class='form-control cuatro' type='number' aria-describedby='emailHelp' placeholder='Escribir a&ntilde;o ... ' min='2015' max='2021' name='eleAnio[]' ></div></td>
			</tr>		<tr align="center">
		

			<input type="hidden" name="MesInicial" id="seleccionomesi">
			<input type="hidden" name="MesFinal" id="seleccionomesf">
			<input type="hidden" name="area" class="form-control" value="" id="selectarea">
			<input type="hidden" name="Tipo" class="form-control" value="04">
						
			<td><input type="submit"  class="btn btn-warning" id="boton" name="enviar" value="Enviar"/></td>
		</form>

	
	
		</tr>  
	</table>
</div>


<!-- Se reciben los datos y se hacen la respectivas operaciones y consultas -->
	<div id="carga">
	<center><img src="{{asset('img/spinner.gif')}}" class="rounded mx-auto d-block" alt="Calculando información" >
	Cargando información...</center>
	</div>

</body>



		 <script>
    $(document).ready(function() {
    	$('#carga').hide();
      $('button').data('loading-text', 'Cargando información...');
      $('.btn').on('click', function() {
        var $this = $(this);
        $this.button('Cargando información...');
        $('#carga').show();

        setTimeout(function() {
          $this.button('reset');
        }, 18000);
      });
    })
  </script>
<footer>
	
</footer>
 </html>

