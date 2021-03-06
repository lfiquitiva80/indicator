<!DOCTYPE html>

<html>

<head>
	<title>&Iacute;ndice Nómina </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

	<!-- <script src="./js/xlsx.full.min.js"></script>
    <script src="./js/FileSaver.min.js"></script>
    <script src="./js/tableexport.min.js"></script>
     --> <script src="{{asset('js/dq3.js')}}"></script>

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
 		
		.table-containter{ max-width: 100%; max-height: 600px; overflow-x: scroll; overflow-y: scroll; border-left: solid 0.0001px;	} .table-bordered{ border-top: solid 1px; } .table-bordered tbody tr { background: white; } .table-bordered tbody tr:nth-child(2n) { background: #f9f9f9; } .table-bordered tbody tr .{ background: white; } .table-bordered tbody tr:nth-child(2n) . { background: #f9f9f9; } .table-bordered tbody tr .inmovilizadaBod{ background: white; } .table-bordered tbody tr:nth-child(2n) .inmovilizadaBod { background: #f9f9f9; } .inmoSup{ position: sticky; top: -1px; left: 116px; background: #C3EE6D; } .inmoSup-2{ white-space:nowrap; position: sticky; top: 36px; left: 116px; background: #C3EE6D; } .{ white-space:nowrap; left: 0px; top: 36px; position: sticky; padding: 1px; } .inmovilizadaBod{ left: 0px; top: 73px; position: sticky; background: #C3EE6D; padding: 1px; } .inmoEsqUna{ white-space:nowrap; position: sticky; top: -1px; left:0px; background: #C3EE6D; }.table-bordered tbody tr .inmoEsqUna{ background: #C3EE6D; } .inmoEsqDos{ white-space:nowrap; position: sticky; top: 36px; left: 0px; background: #C3EE6D; } .table-bordered tbody tr .inmoEsqDos{ background: #C3EE6D; } .inmototal{ left: 0px; position: sticky; background: #EEAC6D; padding: 1px; } 

	</style>

</head> 


<body>        
	<ol class="breadcrumb">
		  <li class="breadcrumb-item"><a class="linkmigas" href="{{ url('indicenomina') }}"><strong>Indicadores Nómina</strong></a></li> 
		  <li class="breadcrumb-item active"><strong>Carga Prestacional</strong></li> 
		  <li class="breadcrumb-item active"><strong>Menú General</strong></li>
	</ol>

<table style="width: 100%" class="table table-bordered" id="tblData">
	<tr>
		<td><strong>Fecha Inicio</strong></td>
		<td id="fi"></td>
		<td><strong>Fecha Final</strong></td>
		<td id="ff"></td>
	</tr>	
</table>

<table style="width: 100%" class="table table-bordered">
	<tr align="center">
		<td style="width: 20%" rowspan="2">Para cambiar los datos, complete los campos a continuación.</td>
		<td style="width: 10%">Fecha de Inicio</td>
		<td style="width: 10%">Fecha de Fin</td>
		<td>Tipo de Indicadores</td>
		<td>Areas</td>
	</tr>
	<tr>
		<form autocomplete='off' action=""  method="{{route('indicenomina')}}" name="RVH">
		<td><center>
			<input onFocus="this.value=''" class="form-control" type="month" name="FechaInicio" min="2015-01" max="2021-11" required value="{{old('FechaInicio') }}">
		</center></td>
		<td><center>
			<input onFocus="this.value=''" class="form-control" type="month" name="FechaFin" min="2015-01" max="2021-11" required value="{{old('FechaFin') }}">
		</center></td>
		<td><center>
				<select class='form-control' style='width: 80%' name='Tipo' required>
	<option value="{{old('Tipo') }}">Seleccione un tipo de indicador</option> 
							<option value='01'>Comparativo por Año</option>
							<option value='02'>Carga Prestacional Mes / Año</option>
				</select>
			</center>
		</td>

			<td><center>
				<select class='form-control' style='width: 80%' name='area' >
			 <option value="">Seleccione un área</option> 
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
	<tr>		
		<td colspan="5">
			<input type="submit" class="btn btn-warning btn-block" id="boton" name="VerDatosG" value="CONSULTAR"/>
			</form>
		</td>
	</tr>
</table> 

<form action="ExportExcel/ExportMPrincipal.php" method="POST" target="_blank" > 
    <input type="hidden" name ='FechaInicio' value= "2021-01">
    <input type="hidden" name ='FechaFinal' value= "2021-02">
	<input type="hidden" name ='Tipo' value="01"> 
	<input type="submit" class="btn btn-success" id="btnExport" name="VerDatosG" value="Descargar en Excel"/>
</form> 

<br>

<center> 
		<div class="table-containter">
			<div id="dvData">
			<table id="tbl_principal" style="width: 100%" class="table table-bordered" > 
				<thead>
					<tr align="CENTER">
						{{ $filtro }} | @php  echo \Carbon\Carbon::now();  @endphp
						</tr>
					</thead><tbody>

					<tr align='center' style="font-weight: bold">
					<td bgcolor='#C3EE6D' class='inmoEsqDos' rowspan='2'>DETALLE</td>
					<td bgcolor='#C3EE6D' class='inmoSup HEnero2015' colspan='2'>Enero del 2015</td>
					<td bgcolor='#C3EE6D' class='inmoSup HFebrero2015' colspan='2'>Febrero del 2015</td>
					<td bgcolor='#C3EE6D' class='inmoSup HMarzo2015' colspan='2'>Marzo del 2015</td>
					<td bgcolor='#C3EE6D' class='inmoSup HAbril2015' colspan='2'>Abril del 2015</td>
					<td bgcolor='#C3EE6D' class='inmoSup HMayo2015' colspan='2'>Mayo del 2015</td>
					<td bgcolor='#C3EE6D' class='inmoSup HJunio2015' colspan='2'>Junio del 2015</td>
					<td bgcolor='#C3EE6D' class='inmoSup HJulio2015' colspan='2'>Julio del 2015</td>
					<td bgcolor='#C3EE6D' class='inmoSup HAgosto2015' colspan='2'>Agosto del 2015</td>
					<td bgcolor='#C3EE6D' class='inmoSup HSeptiembre2015' colspan='2'>Septiembre del 2015</td>
					<td bgcolor='#C3EE6D' class='inmoSup HOctubre2015' colspan='2'>Octubre del 2015</td>
					<td bgcolor='#C3EE6D' class='inmoSup HNoviembre2015' colspan='2'>Noviembre del 2015</td>
					<td bgcolor='#C3EE6D' class='inmoSup HDiciembre2015' colspan='2'>Diciembre del 2015</td>
					<td bgcolor='#C3EE6D' class='inmoSup HEnero2016' colspan='2'>Enero del 2016</td>
					<td bgcolor='#C3EE6D' class='inmoSup HFebrero2016' colspan='2'>Febrero del 2016</td>
					<td bgcolor='#C3EE6D' class='inmoSup HMarzo2016' colspan='2'>Marzo del 2016</td>
					<td bgcolor='#C3EE6D' class='inmoSup HAbril2016' colspan='2'>Abril del 2016</td>
					<td bgcolor='#C3EE6D' class='inmoSup HMayo2016' colspan='2'>Mayo del 2016</td>
					<td bgcolor='#C3EE6D' class='inmoSup HJunio2016' colspan='2'>Junio del 2016</td>
					<td bgcolor='#C3EE6D' class='inmoSup HJulio2016' colspan='2'>Julio del 2016</td>
					<td bgcolor='#C3EE6D' class='inmoSup HAgosto2016' colspan='2'>Agosto del 2016</td>
					<td bgcolor='#C3EE6D' class='inmoSup HSeptiembre2016' colspan='2'>Septiembre del 2016</td>
					<td bgcolor='#C3EE6D' class='inmoSup HOctubre2016' colspan='2'>Octubre del 2016</td>
					<td bgcolor='#C3EE6D' class='inmoSup HNoviembre2016' colspan='2'>Noviembre del 2016</td>
					<td bgcolor='#C3EE6D' class='inmoSup HDiciembre2016' colspan='2'>Diciembre del 2016</td>
					<td bgcolor='#C3EE6D' class='inmoSup HEnero2017' colspan='2'>Enero del 2017</td>
					<td bgcolor='#C3EE6D' class='inmoSup HFebrero2017' colspan='2'>Febrero del 2017</td>
					<td bgcolor='#C3EE6D' class='inmoSup HMarzo2017' colspan='2'>Marzo del 2017</td>
					<td bgcolor='#C3EE6D' class='inmoSup HAbril2017' colspan='2'>Abril del 2017</td>
					<td bgcolor='#C3EE6D' class='inmoSup HMayo2017' colspan='2'>Mayo del 2017</td>
					<td bgcolor='#C3EE6D' class='inmoSup HJunio2017' colspan='2'>Junio del 2017</td>
					<td bgcolor='#C3EE6D' class='inmoSup HJulio2017' colspan='2'>Julio del 2017</td>
					<td bgcolor='#C3EE6D' class='inmoSup HAgosto2017' colspan='2'>Agosto del 2017</td>
					<td bgcolor='#C3EE6D' class='inmoSup HSeptiembre2017' colspan='2'>Septiembre del 2017</td>
					<td bgcolor='#C3EE6D' class='inmoSup HOctubre2017' colspan='2'>Octubre del 2017</td>
					<td bgcolor='#C3EE6D' class='inmoSup HNoviembre2017' colspan='2'>Noviembre del 2017</td>
					<td bgcolor='#C3EE6D' class='inmoSup HDiciembre2017' colspan='2'>Diciembre del 2017</td>
					<td bgcolor='#C3EE6D' class='inmoSup HEnero2018' colspan='2'>Enero del 2018</td>
					<td bgcolor='#C3EE6D' class='inmoSup HFebrero2018' colspan='2'>Febrero del 2018</td>
					<td bgcolor='#C3EE6D' class='inmoSup HMarzo2018' colspan='2'>Marzo del 2018</td>
					<td bgcolor='#C3EE6D' class='inmoSup HAbril2018' colspan='2'>Abril del 2018</td>
					<td bgcolor='#C3EE6D' class='inmoSup HMayo2018' colspan='2'>Mayo del 2018</td>
					<td bgcolor='#C3EE6D' class='inmoSup HJunio2018' colspan='2'>Junio del 2018</td>
					<td bgcolor='#C3EE6D' class='inmoSup HJulio2018' colspan='2'>Julio del 2018</td>
					<td bgcolor='#C3EE6D' class='inmoSup HAgosto2018' colspan='2'>Agosto del 2018</td>
					<td bgcolor='#C3EE6D' class='inmoSup HSeptiembre2018' colspan='2'>Septiembre del 2018</td>
					<td bgcolor='#C3EE6D' class='inmoSup HOctubre2018' colspan='2'>Octubre del 2018</td>
					<td bgcolor='#C3EE6D' class='inmoSup HNoviembre2018' colspan='2'>Noviembre del 2018</td>
					<td bgcolor='#C3EE6D' class='inmoSup HDiciembre2018' colspan='2'>Diciembre del 2018</td>
					<td bgcolor='#C3EE6D' class='inmoSup HEnero2019' colspan='2'>Enero del 2019</td>
					<td bgcolor='#C3EE6D' class='inmoSup HFebrero2019' colspan='2'>Febrero del 2019</td>
					<td bgcolor='#C3EE6D' class='inmoSup HMarzo2019' colspan='2'>Marzo del 2019</td>
					<td bgcolor='#C3EE6D' class='inmoSup HAbril2019' colspan='2'>Abril del 2019</td>
					<td bgcolor='#C3EE6D' class='inmoSup HMayo2019' colspan='2'>Mayo del 2019</td>
					<td bgcolor='#C3EE6D' class='inmoSup HJunio2019' colspan='2'>Junio del 2019</td>
					<td bgcolor='#C3EE6D' class='inmoSup HJulio2019' colspan='2'>Julio del 2019</td>
					<td bgcolor='#C3EE6D' class='inmoSup HAgosto2019' colspan='2'>Agosto del 2019</td>
					<td bgcolor='#C3EE6D' class='inmoSup HSeptiembre2019' colspan='2'>Septiembre del 2019</td>
					<td bgcolor='#C3EE6D' class='inmoSup HOctubre2019' colspan='2'>Octubre del 2019</td>
					<td bgcolor='#C3EE6D' class='inmoSup HNoviembre2019' colspan='2'>Noviembre del 2019</td>
					<td bgcolor='#C3EE6D' class='inmoSup HDiciembre2019' colspan='2'>Diciembre del 2019</td>
					<td bgcolor='#C3EE6D' class='inmoSup HEnero2020' colspan='2'>Enero del 2020</td>
					<td bgcolor='#C3EE6D' class='inmoSup HFebrero2020' colspan='2'>Febrero del 2020</td>
					<td bgcolor='#C3EE6D' class='inmoSup HMarzo2020' colspan='2'>Marzo del 2020</td>
					<td bgcolor='#C3EE6D' class='inmoSup HAbril2020' colspan='2'>Abril del 2020</td>
					<td bgcolor='#C3EE6D' class='inmoSup HMayo2020' colspan='2'>Mayo del 2020</td>
					<td bgcolor='#C3EE6D' class='inmoSup HJunio2020' colspan='2'>Junio del 2020</td>
					<td bgcolor='#C3EE6D' class='inmoSup HJulio2020' colspan='2'>Julio del 2020</td>
					<td bgcolor='#C3EE6D' class='inmoSup HAgosto2020' colspan='2'>Agosto del 2020</td>
					<td bgcolor='#C3EE6D' class='inmoSup HSeptiembre2020' colspan='2'>Septiembre del 2020</td>
					<td bgcolor='#C3EE6D' class='inmoSup HOctubre2020' colspan='2'>Octubre del 2020</td>
					<td bgcolor='#C3EE6D' class='inmoSup HNoviembre2020' colspan='2'>Noviembre del 2020</td>
					<td bgcolor='#C3EE6D' class='inmoSup HDiciembre2020' colspan='2'>Diciembre del 2020</td>
					<td bgcolor='#C3EE6D' class='inmoSup HEnero2021' colspan='2'>Enero del 2021</td>
					<td bgcolor='#C3EE6D' class='inmoSup HFebrero2021' colspan='2'>Febrero del 2021</td>
					<td bgcolor='#C3EE6D' class='inmoSup HMarzo2021' colspan='2'>Marzo del 2021</td>
					<td bgcolor='#C3EE6D' class='inmoSup HAbril2021' colspan='2'>Abril del 2021</td>
					<td bgcolor='#C3EE6D' class='inmoSup HMayo2021' colspan='2'>Mayo del 2021</td>
					<td bgcolor='#C3EE6D' class='inmoSup HJunio2021' colspan='2'>Junio del 2021</td>
					<td bgcolor='#C3EE6D' class='inmoSup HJulio2021' colspan='2'>Julio del 2021</td>
					<td bgcolor='#C3EE6D' class='inmoSup HAgosto2021' colspan='2'>Agosto del 2021</td>
					<td bgcolor='#C3EE6D' class='inmoSup HSeptiembre2021' colspan='2'>Septiembre del 2021</td>
					<td bgcolor='#C3EE6D' class='inmoSup HOctubre2021' colspan='2'>Octubre del 2021</td>
					<td bgcolor='#C3EE6D' class='inmoSup HNoviembre2021' colspan='2'>Noviembre del 2021</td>
					<td bgcolor='#C3EE6D' class='inmoSup HDiciembre2021' colspan='2'>Diciembre del 2021</td>
					<td bgcolor='#C3EE6D' class='inmoSup HEnero2022' colspan='2'>Enero del 2022</td>
					<td bgcolor='#C3EE6D' class='inmoSup HFebrero2022' colspan='2'>Febrero del 2022</td>
					<td bgcolor='#C3EE6D' class='inmoSup HMarzo2022' colspan='2'>Marzo del 2022</td>
					<td bgcolor='#C3EE6D' class='inmoSup HAbril2022' colspan='2'>Abril del 2022</td>
					<td bgcolor='#C3EE6D' class='inmoSup HMayo2022' colspan='2'>Mayo del 2022</td>
					<td bgcolor='#C3EE6D' class='inmoSup HJunio2022' colspan='2'>Junio del 2022</td>
					<td bgcolor='#C3EE6D' class='inmoSup HJulio2022' colspan='2'>Julio del 2022</td>
					<td bgcolor='#C3EE6D' class='inmoSup HAgosto2022' colspan='2'>Agosto del 2022</td>
					<td bgcolor='#C3EE6D' class='inmoSup HSeptiembre2022' colspan='2'>Septiembre del 2022</td>
					<td bgcolor='#C3EE6D' class='inmoSup HOctubre2022' colspan='2'>Octubre del 2022</td>
					<td bgcolor='#C3EE6D' class='inmoSup HNoviembre2022' colspan='2'>Noviembre del 2022</td>
					<td bgcolor='#C3EE6D' class='inmoSup HDiciembre2022' colspan='2'>Diciembre del 2022</td>

					<td bgcolor='#C3EE6D' class='inmoSup' colspan='2'>Acumulado año</td></tr>


<tr align='center' style="font-weight: bold">
<td bgcolor='#C3EE6D' class='inmoSup-2 HEnero2015'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HEnero2015'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HFebrero2015'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HFebrero2015'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HMarzo2015'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HMarzo2015'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HAbril2015'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HAbril2015'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HMayo2015'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HMayo2015'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2015'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2015'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HJulio2015'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HJulio2015'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HAgosto2015'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HAgosto2015'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HSeptiembre2015'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HSeptiembre2015'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HOctubre2015'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HOctubre2015'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HNoviembre2015'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HNoviembre2015'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HDiciembre2015'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HDiciembre2015'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HEnero2016'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HEnero2016'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HFebrero2016'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HFebrero2016'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HMarzo2016'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HMarzo2016'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HAbril2016'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HAbril2016'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HMayo2016'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HMayo2016'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2016'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2016'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HJulio2016'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HJulio2016'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HAgosto2016'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HAgosto2016'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HSeptiembre2016'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HSeptiembre2016'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HOctubre2016'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HOctubre2016'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HNoviembre2016'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HNoviembre2016'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HDiciembre2016'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HDiciembre2016'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HEnero2017'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HEnero2017'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HFebrero2017'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HFebrero2017'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HMarzo2017'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HMarzo2017'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HAbril2017'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HAbril2017'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HMayo2017'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HMayo2017'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2017'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2017'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HJulio2017'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HJulio2017'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HAgosto2017'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HAgosto2017'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HSeptiembre2017'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HSeptiembre2017'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HOctubre2017'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HOctubre2017'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HNoviembre2017'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HNoviembre2017'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HDiciembre2017'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HDiciembre2017'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HEnero2018'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HEnero2018'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HFebrero2018'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HFebrero2018'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HMarzo2018'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HMarzo2018'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HAbril2018'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HAbril2018'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HMayo2018'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HMayo2018'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2018'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2018'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HJulio2018'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HJulio2018'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HAgosto2018'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HAgosto2018'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HSeptiembre2018'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HSeptiembre2018'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HOctubre2018'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HOctubre2018'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HNoviembre2018'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HNoviembre2018'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HDiciembre2018'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HDiciembre2018'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HEnero2019'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HEnero2019'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HFebrero2019'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HFebrero2019'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HMarzo2019'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HMarzo2019'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HAbril2019'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HAbril2019'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HMayo2019'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HMayo2019'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2019'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2019'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HJulio2019'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HJulio2019'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HAgosto2019'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HAgosto2019'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HSeptiembre2019'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HSeptiembre2019'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HOctubre2019'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HOctubre2019'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HNoviembre2019'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HNoviembre2019'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HDiciembre2019'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HDiciembre2019'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HEnero2020'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HEnero2020'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HFebrero2020'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HFebrero2020'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HMarzo2020'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HMarzo2020'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HAbril2020'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HAbril2020'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HMayo2020'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HMayo2020'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2020'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2020'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HJulio2020'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HJulio2020'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HAgosto2020'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HAgosto2020'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HSeptiembre2020'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HSeptiembre2020'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HOctubre2020'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HOctubre2020'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HNoviembre2020'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HNoviembre2020'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HDiciembre2020'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HDiciembre2020'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HEnero2021'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HEnero2021'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HFebrero2021'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HFebrero2021'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HMarzo2021'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HMarzo2021'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HAbril2021'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HAbril2021'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HMayo2021'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HMayo2021'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2021'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2021'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HJulio2021'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HJulio2021'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HAgosto2021'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HAgosto2021'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HSeptiembre2021'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HSeptiembre2021'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HOctubre2021'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HOctubre2021'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HNoviembre2021'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HNoviembre2021'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HDiciembre2021'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HDiciembre2021'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HEnero2022'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HEnero2022'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HFebrero2022'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HFebrero2022'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HMarzo2022'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HMarzo2022'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HAbril2022'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HAbril2022'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HMayo2022'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HMayo2022'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2022'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2022'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HJulio2022'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HJulio2022'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HAgosto2022'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HAgosto2022'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HSeptiembre2022'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HSeptiembre2022'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HOctubre2022'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HOctubre2022'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HNoviembre2022'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HNoviembre2022'>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 HDiciembre2022'>Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 HDiciembre2022'>Porcentaje %</td>


<td bgcolor='#C3EE6D' class='inmoSup-2'>Acum. Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2'>Acum. Porcentaje %</td>
@foreach ($query as $row)
<tr>
							
<td class='inmovilizadaBod'>{{ $row->CTA_AUXILIAR_2 }}</td>
<td class="NEnero2015 HEnero2015" align='right'><a class='linknumero' href=''></a>{{number_format($row->Enero2015, 0, ',', '')}}</td><td align='right' class="HEnero2015 PEnero2015">$27.7</td>
<td class="NFebrero2015 HFebrero2015" align='right'><a class='linknumero' href=''></a>{{number_format($row->Febrero2015, 0, ',', '')}}</td><td align='right' class="HFebrero2015 PFebrero2015">$27.7</td>
<td class="NMarzo2015 HMarzo2015" align='right'><a class='linknumero' href=''></a>{{number_format($row->Marzo2015, 0, ',', '')}}</td><td align='right' class="HMarzo2015 PMarzo2015">$27.7</td>
<td class="NAbril2015 HAbril2015" align='right'><a class='linknumero' href=''></a>{{number_format($row->Abril2015, 0, ',', '')}}</td><td align='right' class="HAbril2015 PAbril2015">$27.7</td>
<td class="NMayo2015 HMayo2015" align='right'><a class='linknumero' href=''></a>{{number_format($row->Mayo2015, 0, ',', '')}}</td><td align='right' class="HMayo2015 PMayo2015">$27.7</td>
<td class="NJunio2015 HJunio2015" align='right'><a class='linknumero' href=''></a>{{number_format($row->Junio2015, 0, ',', '')}}</td><td align='right' class="HJunio2015 PJunio2015">$27.7</td>
<td class="NJulio2015 HJulio2015" align='right'><a class='linknumero' href=''></a>{{number_format($row->Julio2015, 0, ',', '')}}</td><td align='right' class="HJulio2015 PJulio2015">$27.7</td>
<td class="NAgosto2015 HAgosto2015" align='right'><a class='linknumero' href=''></a>{{number_format($row->Agosto2015, 0, ',', '')}}</td><td align='right' class="HAgosto2015 PAgosto2015">$27.7</td>
<td class="NSeptiembre2015 HSeptiembre2015" align='right'><a class='linknumero' href=''></a>{{number_format($row->Septiembre2015, 0, ',', '')}}</td><td align='right' class="HSeptiembre2015 PSeptiembre2015">$27.7</td>
<td class="NOctubre2015 HOctubre2015" align='right'><a class='linknumero' href=''></a>{{number_format($row->Octubre2015, 0, ',', '')}}</td><td align='right' class="HOctubre2015 POctubre2015">$27.7</td>
<td class="NNoviembre2015 HNoviembre2015" align='right'><a class='linknumero' href=''></a>{{number_format($row->Noviembre2015, 0, ',', '')}}</td><td align='right' class="HNoviembre2015 PNoviembre2015">$27.7</td>
<td class="NDiciembre2015 HDiciembre2015" align='right'><a class='linknumero' href=''></a>{{number_format($row->Diciembre2015, 0, ',', '')}}</td><td align='right' class="HDiciembre2015 PDiciembre2015">$27.7</td>
<td class="NEnero2016 HEnero2016" align='right'><a class='linknumero' href=''></a>{{number_format($row->Enero2016, 0, ',', '')}}</td><td align='right' class="HEnero2016 PEnero2016">$27.7</td>
<td class="NFebrero2016 HFebrero2016" align='right'><a class='linknumero' href=''></a>{{number_format($row->Febrero2016, 0, ',', '')}}</td><td align='right' class="HFebrero2016 PFebrero2016">$27.7</td>
<td class="NMarzo2016 HMarzo2016" align='right'><a class='linknumero' href=''></a>{{number_format($row->Marzo2016, 0, ',', '')}}</td><td align='right' class="HMarzo2016 PMarzo2016">$27.7</td>
<td class="NAbril2016 HAbril2016" align='right'><a class='linknumero' href=''></a>{{number_format($row->Abril2016, 0, ',', '')}}</td><td align='right' class="HAbril2016 PAbril2016">$27.7</td>
<td class="NMayo2016 HMayo2016" align='right'><a class='linknumero' href=''></a>{{number_format($row->Mayo2016, 0, ',', '')}}</td><td align='right' class="HMayo2016 PMayo2016">$27.7</td>
<td class="NJunio2016 HJunio2016" align='right'><a class='linknumero' href=''></a>{{number_format($row->Junio2016, 0, ',', '')}}</td><td align='right' class="HJunio2016 PJunio2016">$27.7</td>
<td class="NJulio2016 HJulio2016" align='right'><a class='linknumero' href=''></a>{{number_format($row->Julio2016, 0, ',', '')}}</td><td align='right' class="HJulio2016 PJulio2016">$27.7</td>
<td class="NAgosto2016 HAgosto2016" align='right'><a class='linknumero' href=''></a>{{number_format($row->Agosto2016, 0, ',', '')}}</td><td align='right' class="HAgosto2016 PAgosto2016">$27.7</td>
<td class="NSeptiembre2016 HSeptiembre2016" align='right'><a class='linknumero' href=''></a>{{number_format($row->Septiembre2016, 0, ',', '')}}</td><td align='right' class="HSeptiembre2016 PSeptiembre2016">$27.7</td>
<td class="NOctubre2016 HOctubre2016" align='right'><a class='linknumero' href=''></a>{{number_format($row->Octubre2016, 0, ',', '')}}</td><td align='right' class="HOctubre2016 POctubre2016">$27.7</td>
<td class="NNoviembre2016 HNoviembre2016" align='right'><a class='linknumero' href=''></a>{{number_format($row->Noviembre2016, 0, ',', '')}}</td><td align='right' class="HNoviembre2016 PNoviembre2016">$27.7</td>
<td class="NDiciembre2016 HDiciembre2016" align='right'><a class='linknumero' href=''></a>{{number_format($row->Diciembre2016, 0, ',', '')}}</td><td align='right' class="HDiciembre2016 PDiciembre2016">$27.7</td>
<td class="NEnero2017 HEnero2017" align='right'><a class='linknumero' href=''></a>{{number_format($row->Enero2017, 0, ',', '')}}</td><td align='right' class="HEnero2017 PEnero2017">$27.7</td>
<td class="NFebrero2017 HFebrero2017" align='right'><a class='linknumero' href=''></a>{{number_format($row->Febrero2017, 0, ',', '')}}</td><td align='right' class="HFebrero2017 PFebrero2017">$27.7</td>
<td class="NMarzo2017 HMarzo2017" align='right'><a class='linknumero' href=''></a>{{number_format($row->Marzo2017, 0, ',', '')}}</td><td align='right' class="HMarzo2017 PMarzo2017">$27.7</td>
<td class="NAbril2017 HAbril2017" align='right'><a class='linknumero' href=''></a>{{number_format($row->Abril2017, 0, ',', '')}}</td><td align='right' class="HAbril2017 PAbril2017">$27.7</td>
<td class="NMayo2017 HMayo2017" align='right'><a class='linknumero' href=''></a>{{number_format($row->Mayo2017, 0, ',', '')}}</td><td align='right' class="HMayo2017 PMayo2017">$27.7</td>
<td class="NJunio2017 HJunio2017" align='right'><a class='linknumero' href=''></a>{{number_format($row->Junio2017, 0, ',', '')}}</td><td align='right' class="HJunio2017 PJunio2017">$27.7</td>
<td class="NJulio2017 HJulio2017" align='right'><a class='linknumero' href=''></a>{{number_format($row->Julio2017, 0, ',', '')}}</td><td align='right' class="HJulio2017 PJulio2017">$27.7</td>
<td class="NAgosto2017 HAgosto2017" align='right'><a class='linknumero' href=''></a>{{number_format($row->Agosto2017, 0, ',', '')}}</td><td align='right' class="HAgosto2017 PAgosto2017">$27.7</td>
<td class="NSeptiembre2017 HSeptiembre2017" align='right'><a class='linknumero' href=''></a>{{number_format($row->Septiembre2017, 0, ',', '')}}</td><td align='right' class="HSeptiembre2017 PSeptiembre2017">$27.7</td>
<td class="NOctubre2017 HOctubre2017" align='right'><a class='linknumero' href=''></a>{{number_format($row->Octubre2017, 0, ',', '')}}</td><td align='right' class="HOctubre2017 POctubre2017">$27.7</td>
<td class="NNoviembre2017 HNoviembre2017" align='right'><a class='linknumero' href=''></a>{{number_format($row->Noviembre2017, 0, ',', '')}}</td><td align='right' class="HNoviembre2017 PNoviembre2017">$27.7</td>
<td class="NDiciembre2017 HDiciembre2017" align='right'><a class='linknumero' href=''></a>{{number_format($row->Diciembre2017, 0, ',', '')}}</td><td align='right' class="HDiciembre2017 PDiciembre2017">$27.7</td>
<td class="NEnero2018 HEnero2018" align='right'><a class='linknumero' href=''></a>{{number_format($row->Enero2018, 0, ',', '')}}</td><td align='right' class="HEnero2018 PEnero2018">$27.7</td>
<td class="NFebrero2018 HFebrero2018" align='right'><a class='linknumero' href=''></a>{{number_format($row->Febrero2018, 0, ',', '')}}</td><td align='right' class="HFebrero2018 PFebrero2018">$27.7</td>
<td class="NMarzo2018 HMarzo2018" align='right'><a class='linknumero' href=''></a>{{number_format($row->Marzo2018, 0, ',', '')}}</td><td align='right' class="HMarzo2018 PMarzo2018">$27.7</td>
<td class="NAbril2018 HAbril2018" align='right'><a class='linknumero' href=''></a>{{number_format($row->Abril2018, 0, ',', '')}}</td><td align='right' class="HAbril2018 PAbril2018">$27.7</td>
<td class="NMayo2018 HMayo2018" align='right'><a class='linknumero' href=''></a>{{number_format($row->Mayo2018, 0, ',', '')}}</td><td align='right' class="HMayo2018 PMayo2018">$27.7</td>
<td class="NJunio2018 HJunio2018" align='right'><a class='linknumero' href=''></a>{{number_format($row->Junio2018, 0, ',', '')}}</td><td align='right' class="HJunio2018 PJunio2018">$27.7</td>
<td class="NJulio2018 HJulio2018" align='right'><a class='linknumero' href=''></a>{{number_format($row->Julio2018, 0, ',', '')}}</td><td align='right' class="HJulio2018 PJulio2018">$27.7</td>
<td class="NAgosto2018 HAgosto2018" align='right'><a class='linknumero' href=''></a>{{number_format($row->Agosto2018, 0, ',', '')}}</td><td align='right' class="HAgosto2018 PAgosto2018">$27.7</td>
<td class="NSeptiembre2018 HSeptiembre2018" align='right'><a class='linknumero' href=''></a>{{number_format($row->Septiembre2018, 0, ',', '')}}</td><td align='right' class="HSeptiembre2018 PSeptiembre2018">$27.7</td>
<td class="NOctubre2018 HOctubre2018" align='right'><a class='linknumero' href=''></a>{{number_format($row->Octubre2018, 0, ',', '')}}</td><td align='right' class="HOctubre2018 POctubre2018">$27.7</td>
<td class="NNoviembre2018 HNoviembre2018" align='right'><a class='linknumero' href=''></a>{{number_format($row->Noviembre2018, 0, ',', '')}}</td><td align='right' class="HNoviembre2018 PNoviembre2018">$27.7</td>
<td class="NDiciembre2018 HDiciembre2018" align='right'><a class='linknumero' href=''></a>{{number_format($row->Diciembre2018, 0, ',', '')}}</td><td align='right' class="HDiciembre2018 PDiciembre2018">$27.7</td>
<td class="NEnero2019 HEnero2019" align='right'><a class='linknumero' href=''></a>{{number_format($row->Enero2019, 0, ',', '')}}</td><td align='right' class="HEnero2019 PEnero2019">$27.7</td>
<td class="NFebrero2019 HFebrero2019" align='right'><a class='linknumero' href=''></a>{{number_format($row->Febrero2019, 0, ',', '')}}</td><td align='right' class="HFebrero2019 PFebrero2019">$27.7</td>
<td class="NMarzo2019 HMarzo2019" align='right'><a class='linknumero' href=''></a>{{number_format($row->Marzo2019, 0, ',', '')}}</td><td align='right' class="HMarzo2019 PMarzo2019">$27.7</td>
<td class="NAbril2019 HAbril2019" align='right'><a class='linknumero' href=''></a>{{number_format($row->Abril2019, 0, ',', '')}}</td><td align='right' class="HAbril2019 PAbril2019">$27.7</td>
<td class="NMayo2019 HMayo2019" align='right'><a class='linknumero' href=''></a>{{number_format($row->Mayo2019, 0, ',', '')}}</td><td align='right' class="HMayo2019 PMayo2019">$27.7</td>
<td class="NJunio2019 HJunio2019" align='right'><a class='linknumero' href=''></a>{{number_format($row->Junio2019, 0, ',', '')}}</td><td align='right' class="HJunio2019 PJunio2019">$27.7</td>
<td class="NJulio2019 HJulio2019" align='right'><a class='linknumero' href=''></a>{{number_format($row->Julio2019, 0, ',', '')}}</td><td align='right' class="HJulio2019 PJulio2019">$27.7</td>
<td class="NAgosto2019 HAgosto2019" align='right'><a class='linknumero' href=''></a>{{number_format($row->Agosto2019, 0, ',', '')}}</td><td align='right' class="HAgosto2019 PAgosto2019">$27.7</td>
<td class="NSeptiembre2019 HSeptiembre2019" align='right'><a class='linknumero' href=''></a>{{number_format($row->Septiembre2019, 0, ',', '')}}</td><td align='right' class="HSeptiembre2019 PSeptiembre2019">$27.7</td>
<td class="NOctubre2019 HOctubre2019" align='right'><a class='linknumero' href=''></a>{{number_format($row->Octubre2019, 0, ',', '')}}</td><td align='right' class="HOctubre2019 POctubre2019 ">$27.7</td>
<td class="NNoviembre2019 HNoviembre2019" align='right'><a class='linknumero' href=''></a>{{number_format($row->Noviembre2019, 0, ',', '')}}</td><td align='right' class="HNoviembre2019 PNoviembre2019">$27.7</td>
<td class="NDiciembre2019 HDiciembre2019" align='right'><a class='linknumero' href=''></a>{{number_format($row->Diciembre2019, 0, ',', '')}}</td><td align='right' class="HDiciembre2019 PDiciembre2019">$27.7</td>
<td class="NEnero2020 HEnero2020" align='right'><a class='linknumero' href=''></a>{{number_format($row->Enero2020, 0, ',', '')}}</td><td align='right' class="HEnero2020 PEnero2020">$27.7</td>
<td class="NFebrero2020 HFebrero2020" align='right'><a class='linknumero' href=''></a>{{number_format($row->Febrero2020, 0, ',', '')}}</td><td align='right' class="HFebrero2020 PFebrero2020">$27.7</td>
<td class="NMarzo2020 HMarzo2020" align='right'><a class='linknumero' href=''></a>{{number_format($row->Marzo2020, 0, ',', '')}}</td><td align='right' class="HMarzo2020 PMarzo2020">$27.7</td>
<td class="NAbril2020 HAbril2020" align='right'><a class='linknumero' href=''></a>{{number_format($row->Abril2020, 0, ',', '')}}</td><td align='right' class="HAbril2020 PAbril2020">$27.7</td>
<td class="NMayo2020 HMayo2020" align='right'><a class='linknumero' href=''></a>{{number_format($row->Mayo2020, 0, ',', '')}}</td><td align='right' class="HMayo2020 PMayo2020">$27.7</td>
<td class="NJunio2020 HJunio2020" align='right'><a class='linknumero' href=''></a>{{number_format($row->Junio2020, 0, ',', '')}}</td><td align='right' class="HJunio2020 PJunio2020">$27.7</td>
<td class="NJulio2020 HJulio2020" align='right'><a class='linknumero' href=''></a>{{number_format($row->Julio2020, 0, ',', '')}}</td><td align='right' class="HJulio2020 PJulio2020">$27.7</td>
<td class="NAgosto2020 HAgosto2020" align='right'><a class='linknumero' href=''></a>{{number_format($row->Agosto2020, 0, ',', '')}}</td><td align='right' class="HAgosto2020 PAgosto2020">$27.7</td>
<td class="NSeptiembre2020 HSeptiembre2020" align='right'><a class='linknumero' href=''></a>{{number_format($row->Septiembre2020, 0, ',', '')}}</td><td align='right' class="HSeptiembre2020 PSeptiembre2020">$27.7</td>
<td class="NOctubre2020 HOctubre2020" align='right'><a class='linknumero' href=''></a>{{number_format($row->Octubre2020, 0, ',', '')}}</td><td align='right' class="HOctubre2020 POctubre2020">$27.7</td>
<td class="NNoviembre2020 HNoviembre2020" align='right'><a class='linknumero' href=''></a>{{number_format($row->Noviembre2020, 0, ',', '')}}</td><td align='right' class="HNoviembre2020 PNoviembre2020">$27.7</td>
<td class="NDiciembre2020 HDiciembre2020" align='right'><a class='linknumero' href=''></a>{{number_format($row->Diciembre2020, 0, ',', '')}}</td><td align='right' class="HDiciembre2020 PDiciembre2020">$27.7</td>
<td class="NEnero2021 HEnero2021" align='right'><a class='linknumero' href=''></a>{{number_format($row->Enero2021, 0, ',', '')}}</td><td align='right' class="HEnero2021 PEnero2021">$27.7</td>
<td class="NFebrero2021 HFebrero2021" align='right'><a class='linknumero' href=''></a>{{number_format($row->Febrero2021, 0, ',', '')}}</td><td align='right' class="HFebrero2021 PFebrero2021">$27.7</td>
<td class="NMarzo2021 HMarzo2021" align='right'><a class='linknumero' href=''></a>{{number_format($row->Marzo2021, 0, ',', '')}}</td><td align='right' class="HMarzo2021 PMarzo2021">$27.7</td>
<td class="NAbril2021 HAbril2021" align='right'><a class='linknumero' href=''></a>{{number_format($row->Abril2021, 0, ',', '')}}</td><td align='right' class="HAbril2021 PAbril2021">$27.7</td>
<td class="NMayo2021 HMayo2021" align='right'><a class='linknumero' href=''></a>{{number_format($row->Mayo2021, 0, ',', '')}}</td><td align='right' class="HMayo2021 PMayo2021">$27.7</td>
<td class="NJunio2021 HJunio2021" align='right'><a class='linknumero' href=''></a>{{number_format($row->Junio2021, 0, ',', '')}}</td><td align='right' class="HJunio2021 PJunio2021">$27.7</td>
<td class="NJulio2021 HJulio2021" align='right'><a class='linknumero' href=''></a>{{number_format($row->Julio2021, 0, ',', '')}}</td><td align='right' class="HJulio2021 PJulio2021">$27.7</td>
<td class="NAgosto2021 HAgosto2021" align='right'><a class='linknumero' href=''></a>{{number_format($row->Agosto2021, 0, ',', '')}}</td><td align='right' class="HAgosto2021 PAgosto2021">$27.7</td>
<td class="NSeptiembre2021 HSeptiembre2021" align='right'><a class='linknumero' href=''></a>{{number_format($row->Septiembre2021, 0, ',', '')}}</td><td align='right' class="HSeptiembre2021 PSeptiembre2021">$27.7</td>
<td class="NOctubre2021 HOctubre2021" align='right'><a class='linknumero' href=''></a>{{number_format($row->Octubre2021, 0, ',', '')}}</td><td align='right' class="HOctubre2021 POctubre2021">$27.7</td>
<td class="NNoviembre2021 HNoviembre2021" align='right'><a class='linknumero' href=''></a>{{number_format($row->Noviembre2021, 0, ',', '')}}</td><td align='right' class="HNoviembre2021 PNoviembre2021">$27.7</td>
<td class="NDiciembre2021 HDiciembre2021" align='right'><a class='linknumero' href=''></a>{{number_format($row->Diciembre2021, 0, ',', '')}}</td><td align='right' class="HDiciembre2021 PDiciembre2021">$27.7</td>

<td class="NAcumulado HAcumulado" align='right'><a class='linknumero' href=''></a>{{number_format($row->Total, 0, ',', '')}}</td><td align='right' class="HAcumulado PAcumulado">0.00%</td>


<tr style="font-weight: bold">
@endforeach	
	<td bgcolor='#EEAC6D' class='inmototal'>TOTAL</td>  
<td bgcolor='#EEAC6D' align='right' class="TEnero2015 HEnero2015">$0.00</td><td bgcolor='#EEAC6D' class="HEnero2015 TPEnero2015" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TFebrero2015 HFebrero2015">$0.00</td><td bgcolor='#EEAC6D' class="HFebrero2015 TPFebrero2015" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TMarzo2015 HMarzo2015">$0.00</td><td bgcolor='#EEAC6D' class="HMarzo2015 TPMarzo2015" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TAbril2015 HAbril2015">$0.00</td><td bgcolor='#EEAC6D' class="HAbril2015 TPAbril2015" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TMayo2015 HMayo2015">$0.00</td><td bgcolor='#EEAC6D' class="HMayo2015 TPMayo2015" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TJunio2015 HJunio2015">$0.00</td><td bgcolor='#EEAC6D' class="HJunio2015 TPJunio2015" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TJulio2015 HJulio2015">$0.00</td><td bgcolor='#EEAC6D' class="HJulio2015 TPJulio2015" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TAgosto2015 HAgosto2015">$0.00</td><td bgcolor='#EEAC6D' class="HAgosto2015 TPAgosto2015" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TSeptiembre2015 HSeptiembre2015">$0.00</td><td bgcolor='#EEAC6D' class="HSeptiembre2015 TPSeptiembre2015" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TOctubre2015 HOctubre2015">$0.00</td><td bgcolor='#EEAC6D' class="HOctubre2015 TPOctubre2015" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TNoviembre2015 HNoviembre2015">$0.00</td><td bgcolor='#EEAC6D' class="HNoviembre2015 TPNoviembre2015" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TDiciembre2015 HDiciembre2015">$0.00</td><td bgcolor='#EEAC6D' class="HDiciembre2015 TPDiciembre2015" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TEnero2016 HEnero2016">$0.00</td><td bgcolor='#EEAC6D' class="HEnero2016 TPEnero2016" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TFebrero2016 HFebrero2016">$0.00</td><td bgcolor='#EEAC6D' class="HFebrero2016 TPFebrero2016 " align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TMarzo2016 HMarzo2016">$0.00</td><td bgcolor='#EEAC6D' class="HMarzo2016 TPMarzo2016" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TAbril2016 HAbril2016">$0.00</td><td bgcolor='#EEAC6D' class="HAbril2016 TPAbril2016" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TMayo2016 HMayo2016">$0.00</td><td bgcolor='#EEAC6D' class="HMayo2016 TPMayo2016" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TJunio2016 HJunio2016">$0.00</td><td bgcolor='#EEAC6D' class="HJunio2016 TPJunio2016" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TJulio2016 HJulio2016">$0.00</td><td bgcolor='#EEAC6D' class="HJulio2016 TPJulio2016" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TAgosto2016 HAgosto2016">$0.00</td><td bgcolor='#EEAC6D' class="HAgosto2016 TPAgosto2016" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TSeptiembre2016 HSeptiembre2016">$0.00</td><td bgcolor='#EEAC6D' class="HSeptiembre2016 TPSeptiembre2016" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TOctubre2016 HOctubre2016">$0.00</td><td bgcolor='#EEAC6D' class="HOctubre2016 TPOctubre2016" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TNoviembre2016 HNoviembre2016">$0.00</td><td bgcolor='#EEAC6D' class="HNoviembre2016 TPNoviembre2016" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TDiciembre2016 HDiciembre2016">$0.00</td><td bgcolor='#EEAC6D' class="HDiciembre2016 TPDiciembre2016" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TEnero2017 HEnero2017">$0.00</td><td bgcolor='#EEAC6D' class="HEnero2017 TPEnero2017" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TFebrero2017 HFebrero2017">$0.00</td><td bgcolor='#EEAC6D' class="HFebrero2017 TPFebrero2017" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TMarzo2017 HMarzo2017">$0.00</td><td bgcolor='#EEAC6D' class="HMarzo2017 TPMarzo2017" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TAbril2017 HAbril2017">$0.00</td><td bgcolor='#EEAC6D' class="HAbril2017 TPAbril2017" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TMayo2017 HMayo2017">$0.00</td><td bgcolor='#EEAC6D' class="HMayo2017 TPMayo2017" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TJunio2017 HJunio2017">$0.00</td><td bgcolor='#EEAC6D' class="HJunio2017 TPJunio2017" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TJulio2017 HJulio2017">$0.00</td><td bgcolor='#EEAC6D' class="HJulio2017 TPJulio2017" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TAgosto2017 HAgosto2017">$0.00</td><td bgcolor='#EEAC6D' class="HAgosto2017 TPAgosto2017" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TSeptiembre2017 HSeptiembre2017">$0.00</td><td bgcolor='#EEAC6D' class="HSeptiembre2017 TPSeptiembre2017" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TOctubre2017 HOctubre2017">$0.00</td><td bgcolor='#EEAC6D' class="HOctubre2017 TPOctubre2017" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TNoviembre2017 HNoviembre2017">$0.00</td><td bgcolor='#EEAC6D' class="HNoviembre2017 TPNoviembre2017" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TDiciembre2017 HDiciembre2017">$0.00</td><td bgcolor='#EEAC6D' class="HDiciembre2017 TPDiciembre2017" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TEnero2018 HEnero2018">$0.00</td><td bgcolor='#EEAC6D' class="HEnero2018 TPEnero2018" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TFebrero2018 HFebrero2018">$0.00</td><td bgcolor='#EEAC6D' class="HFebrero2018 TPFebrero2018" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TMarzo2018 HMarzo2018">$0.00</td><td bgcolor='#EEAC6D' class="HMarzo2018 TPMarzo2018" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TAbril2018 HAbril2018">$0.00</td><td bgcolor='#EEAC6D' class="HAbril2018 TPAbril2018" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TMayo2018 HMayo2018">$0.00</td><td bgcolor='#EEAC6D' class="HMayo2018 TPMayo2018" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TJunio2018 HJunio2018">$0.00</td><td bgcolor='#EEAC6D' class="HJunio2018 TPJunio2018" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TJulio2018 HJulio2018">$0.00</td><td bgcolor='#EEAC6D' class="HJulio2018 TPJulio2018" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TAgosto2018 HAgosto2018">$0.00</td><td bgcolor='#EEAC6D' class="HAgosto2018 TPAgosto2018" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TSeptiembre2018 HSeptiembre2018">$0.00</td><td bgcolor='#EEAC6D' class="HSeptiembre2018 TPSeptiembre2018" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TOctubre2018 HOctubre2018">$0.00</td><td bgcolor='#EEAC6D' class="HOctubre2018 TPOctubre2018" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TNoviembre2018 HNoviembre2018">$0.00</td><td bgcolor='#EEAC6D' class="HNoviembre2018 TPNoviembre2018" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TDiciembre2018 HDiciembre2018">$0.00</td><td bgcolor='#EEAC6D' class="HDiciembre2018 TPDiciembre2018" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TEnero2019 HEnero2019">$0.00</td><td bgcolor='#EEAC6D' class="HEnero2019 TPEnero2019" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TFebrero2019 HFebrero2019">$0.00</td><td bgcolor='#EEAC6D' class="HFebrero2019 TPFebrero2019" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TMarzo2019 HMarzo2019">$0.00</td><td bgcolor='#EEAC6D' class="HMarzo2019 TPMarzo2019" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TAbril2019 HAbril2019">$0.00</td><td bgcolor='#EEAC6D' class="HAbril2019 TPAbril2019" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TMayo2019 HMayo2019">$0.00</td><td bgcolor='#EEAC6D' class="HMayo2019 TPMayo2019" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TJunio2019 HJunio2019">$0.00</td><td bgcolor='#EEAC6D' class="HJunio2019 TPJunio2019" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TJulio2019 HJulio2019">$0.00</td><td bgcolor='#EEAC6D' class="HJulio2019 TPJulio2019" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TAgosto2019 HAgosto2019">$0.00</td><td bgcolor='#EEAC6D' class="HAgosto2019 TPAgosto2019" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TSeptiembre2019 HSeptiembre2019">$0.00</td><td bgcolor='#EEAC6D' class="HSeptiembre2019 TPSeptiembre2019" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TOctubre2019 HOctubre2019">$0.00</td><td bgcolor='#EEAC6D' class="HOctubre2019 TPOctubre2019" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TNoviembre2019 HNoviembre2019">$0.00</td><td bgcolor='#EEAC6D' class="HNoviembre2019 TPNoviembre2019" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TDiciembre2019 HDiciembre2019">$0.00</td><td bgcolor='#EEAC6D' class="HDiciembre2019 TPDiciembre2019" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TEnero2020 HEnero2020">$0.00</td><td bgcolor='#EEAC6D' class="HEnero2020 TPEnero2020" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TFebrero2020 HFebrero2020">$0.00</td><td bgcolor='#EEAC6D' class="HFebrero2020 TPFebrero2020" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TMarzo2020 HMarzo2020">$0.00</td><td bgcolor='#EEAC6D' class="HMarzo2020 TPMarzo2020" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TAbril2020 HAbril2020">$0.00</td><td bgcolor='#EEAC6D' class="HAbril2020 TPAbril2020" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TMayo2020 HMayo2020">$0.00</td><td bgcolor='#EEAC6D' class="HMayo2020 TPMayo2020" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TJunio2020 HJunio2020">$0.00</td><td bgcolor='#EEAC6D' class="HJunio2020 TPJunio2020" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TJulio2020 HJulio2020">$0.00</td><td bgcolor='#EEAC6D' class="HJulio2020 TPJulio2020" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TAgosto2020 HAgosto2020">$0.00</td><td bgcolor='#EEAC6D' class="HAgosto2020 TPAgosto2020" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TSeptiembre2020 HSeptiembre2020">$0.00</td><td bgcolor='#EEAC6D' class="HSeptiembre2020 TPSeptiembre2020" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TOctubre2020 HOctubre2020">$0.00</td><td bgcolor='#EEAC6D' class="HOctubre2020 TPOctubre2020" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TNoviembre2020 HNoviembre2020">$0.00</td><td bgcolor='#EEAC6D' class="HNoviembre2020 TPNoviembre2020" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TDiciembre2020 HDiciembre2020">$0.00</td><td bgcolor='#EEAC6D' class="HDiciembre2020 TPDiciembre2020" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TEnero2021 HEnero2021">$0.00</td><td bgcolor='#EEAC6D' class="HEnero2021 TPEnero2021" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TFebrero2021 HFebrero2021">$0.00</td><td bgcolor='#EEAC6D' class="HFebrero2021 TPFebrero2021" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TMarzo2021 HMarzo2021">$0.00</td><td bgcolor='#EEAC6D' class="HMarzo2021 TPMarzo2021" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TAbril2021 HAbril2021">$0.00</td><td bgcolor='#EEAC6D' class="HAbril2021 TPAbril2021" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TMayo2021 HMayo2021">$0.00</td><td bgcolor='#EEAC6D' class="HMayo2021 TPMayo2021" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TJunio2021 HJunio2021">$0.00</td><td bgcolor='#EEAC6D' class="HJunio2021 TPJunio2021" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TJulio2021 HJulio2021">$0.00</td><td bgcolor='#EEAC6D' class="HJulio2021 TPJulio2021" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TAgosto2021 HAgosto2021">$0.00</td><td bgcolor='#EEAC6D' class="HAgosto2021 TPAgosto2021" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TSeptiembre2021 HSeptiembre2021">$0.00</td><td bgcolor='#EEAC6D' class="HSeptiembre2021 TPSeptiembre2021" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TOctubre2021 HOctubre2021">$0.00</td><td bgcolor='#EEAC6D' class="HOctubre2021 TPOctubre2021" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TNoviembre2021 HNoviembre2021">$0.00</td><td bgcolor='#EEAC6D' class="HNoviembre2021 TPNoviembre2021" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="TDiciembre2021 HDiciembre2021">$0.00</td><td bgcolor='#EEAC6D' class="HDiciembre2021 TPDiciembre2021" align='right'>%0.0</td>


<td bgcolor='#EEAC6D' align='right' class="TAcumulado HAcumulado">$0.00</td><td bgcolor='#EEAC6D' class="HAcumulado TPAcumulado" align='right'>0.00%</td>					  


</tr>						
			</tbody>
		</table>
		</div> 
           <script>
    $("#btnExport").click(function(e) {
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#dvData').html()));
        e.preventDefault();
    });
    </script>	

	</div>
</center>
<br>
 
	

 
</div>
</body>
<footer>

</footer>	
<br>
<br>
 