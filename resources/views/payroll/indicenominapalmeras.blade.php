<!DOCTYPE html>
	<html>
	<head>
		<title>&Iacute;ndice Costos </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link href="../css/menuHorizontal.css" rel="stylesheet" type="text/css" media="screen" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="../js/submenu.js"></script>
	</head>
	<body>
	<br><br>
		
	<center>
	<form autocomplete='off' action="" method="{{route('indicenomina')}}" name="RVH"> 
		<table style="width: 50%" class="table table-bordered">
			<tr align="center">
				<td bgcolor="#C3EE6D" colspan="2"><strong>INDICADORES NÓMINA</strong></td>
			</tr> 
			<tr>
				<td rowspan="2">TIPO INDICADOR</td>
			</tr>
			<tr>
				<td>   
					<center> 
						<select class='form-control' style='width: 80%' name='Tipo' required onchange="if (this.value) window.location.href=this.value">
							<option value="#">Seleccione un tipo de indicador</option> 
							<option value="{{ url('seleccionaranios') }}" id="comparativo">Comparativo por Año</option>
							<option value="02" selected>Carga Prestacional Mes / Año</option>
							
						</select>
					</center>
				</td>
			</tr>
			<tr>
				<td style="width: 35%">DESDE (MES DE INICIO)</td>
				<td align="center"> 
			    	<input onFocus="this.value=''" style="width: 80%" class="form-control" type="month" aria-describedby="nameHelp" placeholder="Fecha de inicio" min="2015-01" max="2022-12" name="FechaInicio" required>
				</td>
			</tr>
			<tr>
				<td>HASTA (MES FINAL)</td>
				<td align="center"> 
			    	<input onFocus="this.value=''" style="width: 80%" class="form-control" type="month" aria-describedby="nameHelp" placeholder="Fecha Final" min="2015-01" max="2022-12" name="FechaFin" required>
				</td>
			</tr>
			<tr>
				
				<td align="center" colspan="2"><input type="submit" class="btn btn-warning btn-block"  value="¡BUSCAR!"/></td> 
			</tr>
		</table> 
	</form>

		<div id="carga">
	<img src="{{asset('img/spinner.gif')}}" class="rounded mx-auto d-block" alt="Calculando información" >
	<center>Cargando información...</center>
	</div>

	<br>


	
	</center>
 
<br>

		<div align="center">
			<a href="http://192.168.1.251:8081/indicadoresCostos/indiceCostos.php" title="Menu" ><img src="../img/alerta7.gif"alt="" height="14" border="0" /><strong>Regresar al men&uacute; Indicadores de Costos</a></strong>
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
	</html>