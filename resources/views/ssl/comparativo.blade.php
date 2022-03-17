<!DOCTYPE html>

<html>

<head>
	<title>&Iacute;ndice SSL - Empleados</title>
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
		  <li class="breadcrumb-item"><a class="linkmigas" href="{{ url('indicessl') }}"><strong>Indicadores Nómina SSL - Empleados</strong></a></li> 
		  <li class="breadcrumb-item active"><strong>Comparativo Anual</strong></li> 
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
		<td><!-- Areas --></td>
	</tr>
	<tr>
		<form autocomplete='off' action=""  method="{{route('seleccionaranios')}}" name="RVH">
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
							<option value='02'>Costo SSL Vs Empleado Mes / Año</option>
							<option value='03'>Acumulado Costo SSL Vs Empleado Mes / Año</option>
				</select>
			</center>
		</td>

			<td><center>
<!-- 				<select class='form-control' style='width: 80%' name='area'  placeholder="Seleccione un área">
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
				</select> -->
			</center>
		</td>	
	</tr>
	<tr>		
		<td colspan="5">
			<input type="submit" class="btn btn-warning btn-block" id="boton" name="VerDatosG" value="SELECCIONAR"/>
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
					<tr align="CENTER" class="linkmigas">
						{!!$filtro!!} | @php  echo \Carbon\Carbon::now();  @endphp
						</tr>
					</thead><tbody>

					<tr align='center' style="font-weight: bold">
					<td bgcolor='#C3EE6D' class='inmoEsqDos' rowspan='2'>Detalle</td>
					<td bgcolor='#C3EE6D' class='inmoSup HEnero2015' >2015 EJECUCIÓN</td>
					<td bgcolor='#C3EE6D' class='inmoSup HFebrero2015' >2016 EJECUCIÓN</td>
					<td bgcolor='#C3EE6D' class='inmoSup HMarzo2015' >2017 EJECUCIÓN</td>
					<td bgcolor='#C3EE6D' class='inmoSup HAbril2015' >2018 EJECUCIÓN</td>
					<td bgcolor='#C3EE6D' class='inmoSup HMayo2015' >2019 EJECUCIÓN</td>
					<td bgcolor='#C3EE6D' class='inmoSup HJunio2015' >2020 EJECUCIÓN</td>
					<td bgcolor='#C3EE6D' class='inmoSup HJulio2015' >2015 PRESUPUESTO</td>
					<td bgcolor='#C3EE6D' class='inmoSup HAgosto2015' >2016 PRESUPUESTO</td>
					<td bgcolor='#C3EE6D' class='inmoSup HSeptiembre2015' >2017 PRESUPUESTO</td>
					<td bgcolor='#C3EE6D' class='inmoSup HOctubre2016' >2018 PRESUPUESTO</td>
					<td bgcolor='#C3EE6D' class='inmoSup HNoviembre2015' >2019 PRESUPUESTO</td>
					<td bgcolor='#C3EE6D' class='inmoSup HDiciembre2015' >2020 PRESUPUESTO</td>
					<td bgcolor='#C3EE6D' class='inmoSup HEnero2016' >2021 PRESUPUESTO</td>
					<td bgcolor='#C3EE6D' class='inmoSup HFebrero2016' >2021 EJECUCIÓN</td>
					<td bgcolor='#C3EE6D' class='inmoSup ' colspan="2" >VARIACION NETA (<small>Ejecución {{$at}} - Ejecución {{$anioprev}} </small>)</td>
					<td bgcolor='#C3EE6D' class='inmoSup 'colspan="2" >VARIACION PRESUPUESTO (<small>Ejecución {{$at}} - Presp {{$at}}</small>)</td>
					

		
				


					


<tr align='center' style="font-weight: bold">
<td bgcolor='#C3EE6D' class='inmoSup-2 HEnero2015' ><!--Neto--></td><!--<td bgcolor='#C3EE6D' class='inmoSup-2 HEnero2015'>Porcentaje %</td>-->
<td bgcolor='#C3EE6D' class='inmoSup-2 HFebrero2015' ><!--Neto--></td><!--<td bgcolor='#C3EE6D' class='inmoSup-2 HFebrero2015'>Porcentaje %</td>-->
<td bgcolor='#C3EE6D' class='inmoSup-2 HMarzo2015' ><!--Neto--></td><!--<td bgcolor='#C3EE6D' class='inmoSup-2 HMarzo2015'>Porcentaje %</td>-->
<td bgcolor='#C3EE6D' class='inmoSup-2 HAbril2015' ><!--Neto--></td><!--<td bgcolor='#C3EE6D' class='inmoSup-2 HAbril2015'>Porcentaje %</td>-->
<td bgcolor='#C3EE6D' class='inmoSup-2 HMayo2015' ><!--Neto--></td><!--<td bgcolor='#C3EE6D' class='inmoSup-2 HMayo2015'>Porcentaje %</td>-->
<td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2015' ><!--Neto--></td><!--<td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2015'>Porcentaje %</td>-->
<td bgcolor='#C3EE6D' class='inmoSup-2 HJulio2015' ><!--Neto--></td><!--<td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2015'>Porcentaje %</td>-->
<td bgcolor='#C3EE6D' class='inmoSup-2 HAgosto2015' ><!--Neto--></td><!--<td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2015'>Porcentaje %</td>-->
<td bgcolor='#C3EE6D' class='inmoSup-2 HSeptiembre2015' ><!--Neto--></td><!--<td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2015'>Porcentaje %</td>-->
<td bgcolor='#C3EE6D' class='inmoSup-2 HOctubre2016' ><!--Neto--></td><!--<td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2015'>Porcentaje %</td>-->
<td bgcolor='#C3EE6D' class='inmoSup-2 HNoviembre2015' ><!--Neto--></td><!--<td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2015'>Porcentaje %</td>-->
<td bgcolor='#C3EE6D' class='inmoSup-2 HDiciembre2015' ><!--Neto--></td><!--<td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2015'>Porcentaje %</td>-->
<td bgcolor='#C3EE6D' class='inmoSup-2 HEnero2016' ><!--Neto--></td><!--<td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2015'>Porcentaje %</td>-->
<td bgcolor='#C3EE6D' class='inmoSup-2 HFebrero2016' ><!--Neto--></td><!--<td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2015'>Porcentaje %</td>-->
<td bgcolor='#C3EE6D' class='inmoSup-2 HMarzo2016' ><!--Neto--></td><!--<td bgcolor='#C3EE6D' class='inmoSup-2 HJunio2015'>Porcentaje %</td>-->
<td bgcolor='#C3EE6D' class='inmoSup-2 ' >Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 '>Porcentaje %</td>
<td bgcolor='#C3EE6D' class='inmoSup-2 ' >Neto</td><td bgcolor='#C3EE6D' class='inmoSup-2 '>Porcentaje %</td>


@foreach ($querycomparativo as $row)
<tr class="colorfila">
							
<td class='inmovilizadaBod'>{{ $row->CTA_AUXILIAR_2 }}</td>
<td class="NEnero2015 HEnero2015" align='right'><a class='linknumero' href=''></a>{{number_format($row->ANIO2015, 0, ',', '')}}</td><!--<td align='right' class="HEnero2015 PEnero2015">$27.7</td>-->
<td class="NFebrero2015 HFebrero2015" align='right'><a class='linknumero' href=''></a>{{number_format($row->ANIO2016, 0, ',', '')}}</td><!--<td align='right' class="HFebrero2015 PFebrero2015">$27.7</td>-->
<td class="NMarzo2015 HMarzo2015" align='right'><a class='linknumero' href=''></a>{{number_format($row->ANIO2017, 0, ',', '')}}</td><!--<td align='right' class="HMarzo2015 PMarzo2015">$27.7</td>-->
<td class="NAbril2015 HAbril2015" align='right'><a class='linknumero' href=''></a>{{number_format($row->ANIO2018, 0, ',', '')}}</td><!--<td align='right' class="HAbril2015 PAbril2015">$27.7</td>-->
<td class="NMayo2015 HMayo2015" align='right'><a class='linknumero' href=''></a>{{number_format($row->ANIO2019, 0, ',', '')}}</td><!--<td align='right' class="HMayo2015 PMayo2015">$27.7</td>-->
<td class="NJunio2015 HJunio2015" align='right'><a class='linknumero' href=''></a>{{number_format($row->ANIO2020, 0, ',', '')}}</td><!--<td align='right' class="HJunio2015 PJunio2015">$27.7</td>-->
<td class="NJulio2015 HJulio2015" align='right'><a class='linknumero' href=''></a>{{number_format($row->PRESP2015, 0, ',', '')}}</td><!--<td align='right' class="HAgosto2015 PAgosto2015">$27.7</td>-->
<td class="NAgosto2015 HAgosto2015" align='right'><a class='linknumero' href=''></a>{{number_format($row->PRESP2016, 0, ',', '')}}</td><!--<td align='right' class="HAgosto2015 PAgosto2015">$27.7</td>-->
<td class="NSeptiembre2015 HSeptiembre2015" align='right'><a class='linknumero' href=''></a>{{number_format($row->PRESP2017, 0, ',', '')}}</td><!--<td align='right' class="HAgosto2015 PAgosto2015">$27.7</td>-->
<td class="NOctubre2016 HOctubre2016" align='right'><a class='linknumero' href=''></a>{{number_format($row->PRESP2018, 0, ',', '')}}</td><!--<td align='right' class="HAgosto2015 PAgosto2015">$27.7</td>-->
<td class="NNoviembre2015 HNoviembre2015" align='right'><a class='linknumero' href=''></a>{{number_format($row->PRESP2019, 0, ',', '')}}</td><!--<td align='right' class="HAgosto2015 PAgosto2015">$27.7</td>-->
<td class="NDiciembre2015 HDiciembre2015" align='right'><a class='linknumero' href=''></a>{{number_format($row->PRESP2020, 0, ',', '')}}</td><!--<td align='right' class="HAgosto2015 PAgosto2015">$27.7</td>-->
<td class="NEnero2016 HEnero2016" align='right'><a class='linknumero' href=''></a>{{number_format($row->PRESP2021, 0, ',', '')}}</td><!--<td align='right' class="HAgosto2015 PAgosto2015">$27.7</td>-->
<td class="NFebrero2016 HFebrero2016" align='right'><a class='linknumero' href=''></a>{{number_format($row->ANIO2021, 0, ',', '')}}</td><!--<td align='right' class="HAgosto2015 PAgosto2015">$27.7</td>-->
<td class="NMayo2016" align='right'><a class='linknumero' href=''></a>{{number_format($row->VARNETA, 0, ',', '')}}</td><!--<td align='right' class="HAgosto2015 PAgosto2015">$27.7</td>-->
<td class="PNeto" align='right'><a class='linknumero' href=''></a>{{number_format($row->VARNETAPORCENTAJE, 2, ',', '')}}</td><!--<td align='right' class="HAgosto2015 PAgosto2015">$27.7</td>-->
<td class="NAbril2016" align='right'><a class='linknumero' href=''></a>{{number_format($row->VARPRES, 0, ',', '')}}</td><!--<td align='right' class="HAgosto2015 PAgosto2015">$27.7</td>-->
<td class="Ppres" align='right'><a class='linknumero' href=''></a>{{number_format($row->VARPRESPORCENTAJE, 2, ',', '')}}</td><!--<td align='right' class="HAgosto2015 PAgosto2015">$27.7</td>-->






<tr style="font-weight: bold">
@endforeach	
<td bgcolor='#EEAC6D' class='inmototal'>COSTO X EMPLEADO</td>  
<td bgcolor='#EEAC6D' align='right' class="CTEnero2015 HEnero2015" >$0.00</td><!--<td bgcolor='#EEAC6D' class="HEnero2015 TPEnero2015" align='right'>%0.0</td>-->
<td bgcolor='#EEAC6D' align='right' class="CTFebrero2015 HFebrero2015" >$0.00</td><!--<td bgcolor='#EEAC6D' class="HFebrero2015 TPFebrero2015" align='right'>%0.0</td>-->
<td bgcolor='#EEAC6D' align='right' class="CTMarzo2015 HMarzo2015" >$0.00</td><!--<td bgcolor='#EEAC6D' class="HMarzo2015 TPMarzo2015" align='right'>%0.0</td>-->
<td bgcolor='#EEAC6D' align='right' class="CTAbril2015 HAbril2015" >$0.00</td><!--<td bgcolor='#EEAC6D' class="HAbril2015 TPAbril2015" align='right'>%0.0</td>-->
<td bgcolor='#EEAC6D' align='right' class="CTMayo2015 HMayo2015" >$0.00</td><!--<td bgcolor='#EEAC6D' class="HMayo2015 TPMayo2015" align='right'>%0.0</td>-->
<td bgcolor='#EEAC6D' align='right' class="CTJunio2015 HJunio2015" >$0.00</td><!--<td bgcolor='#EEAC6D' class="HJunio2015 TPJunio2015" align='right'>%0.0</td>-->
<td bgcolor='#EEAC6D' align='right' class="CTJulio2015 HJulio2015" >$0.00</td><!--<td bgcolor='#EEAC6D' class="HJulio2015 TPJulio2015" align='right'>%0.0</td>-->
<td bgcolor='#EEAC6D' align='right' class="CTAgosto2015 HAgosto2015" >$0.00</td><!--<td bgcolor='#EEAC6D' class="HJulio2015 TPJulio2015" align='right'>%0.0</td>-->
<td bgcolor='#EEAC6D' align='right' class="CTSeptiembre2015 HSeptiembre2015" >$0.00</td><!--<td bgcolor='#EEAC6D' class="HJulio2015 TPJulio2015" align='right'>%0.0</td>-->
<td bgcolor='#EEAC6D' align='right' class="CTOctubre2016 HOctubre2016" >$0.00</td><!--<td bgcolor='#EEAC6D' class="HJulio2015 TPJulio2015" align='right'>%0.0</td>-->
<td bgcolor='#EEAC6D' align='right' class="CTNoviembre2015 HNoviembre2015" >$0.00</td><!--<td bgcolor='#EEAC6D' class="HJulio2015 TPJulio2015" align='right'>%0.0</td>-->
<td bgcolor='#EEAC6D' align='right' class="CTDiciembre2015 HDiciembre2015" >$0.00</td><!--<td bgcolor='#EEAC6D' class="HJulio2015 TPJulio2015" align='right'>%0.0</td>-->

<td bgcolor='#EEAC6D' align='right' class="CTEnero2016 HEnero2016" >$0.00</td><!--<td bgcolor='#EEAC6D' class="HJulio2015 TPJulio2015" align='right'>%0.0</td>-->
<td bgcolor='#EEAC6D' align='right' class="CTFebrero2016 HFebrero2016" >$0.00</td><!--<td bgcolor='#EEAC6D' class="HJulio2015 TPJulio2015" align='right'>%0.0</td>-->
<td bgcolor='#EEAC6D' align='right' class="CTAbril2016 HMarzo2016" >$0.00</td><!--<td bgcolor='#EEAC6D' class="HJulio2015 TPJulio2015" align='right'>%0.0</td>

align='right'>%0.0</td>-->
<td bgcolor='#EEAC6D' align='right' class="CTMayo2016 " >$0.00</td><td bgcolor='#EEAC6D' class="Porcentaje1" align='right'>%0.0</td>
<td bgcolor='#EEAC6D' align='right' class="CTAbril2016 " >$0.00</td><td bgcolor='#EEAC6D' class="Porcentaje2" align='right'>%0.0</td>


			  


</tr>						
			</tbody>
		</table>
		</div> 
        <!-- <script src="./js/script.js"></script> -->

	</div>
</center>
<br>
 
    <script>
    $("#btnExport").click(function(e) {
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#dvData').html()));
        e.preventDefault();
    });
    </script>	

 
</div>
</body>
<footer>

</footer>	
<br>
<br>
 