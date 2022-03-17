
<!DOCTYPE html>
<html>

<head>
	<title>&Iacute;ndice Costos </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="../css/menuHorizontal.css" rel="stylesheet" type="text/css" media="screen" />
	<link rel="stylesheet" href="{{asset('css/bootstrap-multiselect.css')}}">
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


<div> 
	<div id="wrapperMenu">	             
		<ol class="breadcrumb">
		  <li class="breadcrumb-item"><strong><a class="linkmigas" href="{{ url('indicessl') }}">Indicadores SSL -  Empleados</a></strong></li> 
 		  <li class="breadcrumb-item active"><strong>Seleccionar años</strong></li>
		</ol>
	</div>

	<table style="width:70%" align="center" class="table table-hover table-striped table-bordered">
		<form autocomplete='off' action="" method="{{route('escogeraniosssl')}}">
		<tr align="center">
			<td colspan="3" bgcolor='#C3EE6D'><font color='black'>Seleccione los parametros de busqueda</font></td>
		</tr>
		<tr align="center">
			<td bgcolor='#C3EE6D'><font color='black'>Numero de a&ntilde;os</td>
			<td  bgcolor='#C3EE6D' colspan="2"><font color='black'>Meses <br></td>
			
		</tr>
		<tr>
			<td>
			<label>Nº Años</label>	

			<input onfocus="this.value=''" list="NomAnios" style="width: 80%" class="form-control" type="num" name="NomAnios" required>
		        <datalist id="NomAnios">
		        <option value="1">  		 
		        <option value="2">  		 
		        <option value="3">  		 
		        <option value="4">  		 
			</td> 
			<td> 
            <!--     <input  onfocus="this.value=''" list="mes" style="width: 80%" class="form-control" type="text"  placeholder="Seleccione el mes" name="mes" required> -->
            <label>Mes Inicial</label>
            <select name="MesInicial" class="form-control form-select" required style="width: 100%" value="Seleccione el mes Inicial" >

           
            
            <option value="01">01-Enero</option>
            <option value="02">02-Febrero</option>
            <option value="03">03-Marzo</option>
            <option value="04">04-Abril</option>
            <option value="05">05-Mayo</option>
            <option value="06">06-Junio</option>
            <option value="07">07-Julio</option>
            <option value="08">08-Agosto</option>
            <option value="09">09-Septiembre</option>
            <option value="10">10-Octubre</option>
            <option value="11">11-Noviembre</option>
            <option value="12">12-Diciembre</option>

        </select>
			</td>

		<td> 
            <!--     <input  onfocus="this.value=''" list="mes" style="width: 80%" class="form-control" type="text"  placeholder="Seleccione el mes" name="mes" required> -->
            <label>Mes Inicial</label>
            <select name="MesFinal" class="form-control form-select" required style="width: 100%" value="Seleccione el mes Final" >

           
          
            <option value="01">01-Enero</option>
            <option value="02">02-Febrero</option>
            <option value="03">03-Marzo</option>
            <option value="04">04-Abril</option>
            <option value="05">05-Mayo</option>
            <option value="06">06-Junio</option>
            <option value="07">07-Julio</option>
            <option value="08">08-Agosto</option>
            <option value="09">09-Septiembre</option>
            <option value="10">10-Octubre</option>
            <option value="11">11-Noviembre</option>
            <option value="12" selected>12-Diciembre</option>

        </select>
			</td>	

			</tr>
		<tr align="center">
			<input type="hidden" name="Tipo" class="form-control" value="03">
			<input type="hidden" name="area" class="form-control" value="" id="selectarea">
			<td colspan="3"><input class="btn btn-warning" type="submit" /></td>
		</tr>
		</form>
	</table>
</div>

	

<!-- Toma de datos secundarios -->


<!-- Se reciben los datos y se hacen la respectivas operaciones y consultas -->


</body>
<footer>
	<script src="{{asset('js/bootstrap-multiselect.js')}}"></script>
<script type="text/javascript">
	
	$(document).ready(function() {
   
  $('#langOpt').multiselect({
  	selectAllName:true,

  });
});

</script>

</footer>
 </html>