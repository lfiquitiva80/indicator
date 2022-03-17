<!DOCTYPE html>

<html>

<head>
    <title>&Iacute;ndice Costos - Fletes </title>
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
        
        .table-containter{ max-width: 100%; max-height: 600px; overflow-x: scroll; overflow-y: scroll; border-left: solid 0.0001px; } .table-bordered{ border-top: solid 1px; } .table-bordered tbody tr { background: white; } .table-bordered tbody tr:nth-child(2n) { background: #f9f9f9; } .table-bordered tbody tr .{ background: white; } .table-bordered tbody tr:nth-child(2n) . { background: #f9f9f9; } .table-bordered tbody tr .inmovilizadaBod{ background: white; } .table-bordered tbody tr:nth-child(2n) .inmovilizadaBod { background: #f9f9f9; } .inmoSup{ position: sticky; top: -1px; left: 116px; background: #C3EE6D; } .inmoSup-2{ white-space:nowrap; position: sticky; top: 36px; left: 116px; background: #C3EE6D; } .{ white-space:nowrap; left: 0px; top: 36px; position: sticky; padding: 1px; } .inmovilizadaBod{ left: 0px; top: 73px; position: sticky; background: #C3EE6D; padding: 1px; } .inmoEsqUna{ white-space:nowrap; position: sticky; top: -1px; left:0px; background: #C3EE6D; }.table-bordered tbody tr .inmoEsqUna{ background: #C3EE6D; } .inmoEsqDos{ white-space:nowrap; position: sticky; top: -1px; left: 0px; background: #C3EE6D; } .table-bordered tbody tr .inmoEsqDos{ background: #C3EE6D; } .inmototal{ left: 0px; position: sticky; background: #EEAC6D; padding: 1px; } 

    </style>

</head> 


<body>        
    <ol class="breadcrumb">
          <li class="breadcrumb-item"><a class="linkmigas" href="{{route('costosfletes.index')}}"><strong>Indicadores Costos - Fletes</strong></a></li> 
          <li class="breadcrumb-item active"><strong>Costos - Fletes</strong></li> 
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
        <form autocomplete='off' action=""  method="{{route('indicessl')}}" name="RVH">
        <td><center>
            <input onFocus="this.value=''" class="form-control" type="month" name="FechaInicio" min="2015-01" max="2022-12" required value="{{old('FechaInicio') }}">
        </center></td>
        <td><center>
            <input onFocus="this.value=''" class="form-control" type="month" name="FechaFin" min="2015-01" max="2022-12" required value="{{old('FechaFin') }}">
        </center></td>
        <td><center>
                <select class='form-control' style='width: 80%' name='Tipo' required>
    <option value="{{old('Tipo') }}">Seleccione un tipo de indicador</option> 
                            <!-- <option value='01'>Comparativo por Año</option> -->
                            <option value='02'>Costo SSL Vs Empleado Mes / Año</option>
                            <option value='03'>Acumulado Costo SSL Vs Empleado Mes / Año</option>
                </select>
            </center>
        </td>

            <td>
        </td>   
    </tr>
    <tr>        
        <td colspan="5">
            <input type="submit" class="btn btn-warning btn-block" id="boton" name="VerDatosG" value="CONSULTAR"/>
            </form>
        </td>
    </tr>
</table> 

<!-- <form action="ExportExcel/ExportMPrincipal.php" method="POST" target="_blank" > 
    <input type="hidden" name ='FechaInicio' value= "2021-01">
    <input type="hidden" name ='FechaFinal' value= "2021-02">
    <input type="hidden" name ='Tipo' value="01"> 
    <input type="submit" class="btn btn-success" id="btnExport" name="VerDatosG" value="Descargar en Excel"/>
</form>  -->

<br>


<center>
<p>&nbsp;</p>
<br>





<table border="0" cellpadding="0" cellspacing="0" id="isPasted" style="border-collapse: collapse;width:908pt;" width="1205">
    <tbody>
        <tr>
            <td class="xl112" dir="LTR" height="72" rowspan="2" style="color:white;font-size:13px;font-weight:700;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:center;vertical-align:middle;border:none;border-top:1.0pt solid windowtext;border-right:none;border-bottom:  1.5pt solid white;border-left:1.0pt solid windowtext;background:#ED7D31;height:54.4pt;width:128pt;" width="14.190871369294605%">ZONA</td>
            <td class="xl110" colspan="3" style="color:black;font-size:15px;font-weight:700;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:center;vertical-align:middle;border:none;border-top:1.0pt solid windowtext;border-right:none;border-bottom:1.0pt solid windowtext;border-left:1.0pt solid windowtext;width:227pt;" width="24.979253112033195%">PRESUPUESTO</td>
            <td class="xl110" colspan="3" style="color:black;font-size:15px;font-weight:700;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:center;vertical-align:middle;border:none;border-top:1.0pt solid windowtext;border-right:1.0pt solid black;border-bottom:1.0pt solid windowtext;border-left:1.0pt solid windowtext;width:204pt;" width="22.406639004149376%">EJECUCI&Oacute;N</td>
            <td class="xl115" colspan="3" style="color:black;font-size:15px;font-weight:700;font-style:normal;text-decoration:underline;font-family:Arial, sans-serif;text-align:center;vertical-align:middle;border:none;border-top:1.0pt solid windowtext;border-right:1.0pt solid black;border-bottom:1.0pt solid windowtext;border-left:none;width:204pt;" width="22.406639004149376%">VARIACIONES</td>
            <td class="xl118" colspan="2" style="color:black;font-size:15px;font-weight:700;font-style:normal;text-decoration:underline;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:center;border-top:1.0pt solid windowtext;border-right:1.0pt solid black;border-bottom:1.0pt solid windowtext;border-left:none;width:145pt;" width="16.016597510373444%">&nbsp;Variaci&oacute;n P X Q&nbsp;</td>
        </tr>
        <tr>
            <td class="xl77" dir="LTR" height="35" style="color:white;font-size:13px;font-weight:700;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:center;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:1.0pt solid white;background:#ED7D31;height:26.25pt;width:91pt;">&nbsp;Precio Unitarios $&nbsp;</td>
            <td class="xl72" dir="LTR" style="color:white;font-size:13px;font-weight:700;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:center;vertical-align:middle;border:none;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:none;background:#ED7D31;width:68pt;">Kilos PPTO</td>
            <td class="xl77" dir="LTR" style="color:white;font-size:13px;font-weight:700;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:center;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:none;background:#ED7D31;width:68pt;">&nbsp;Costo Neto&nbsp;</td>
            <td class="xl77" dir="LTR" style="color:white;font-size:13px;font-weight:700;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:center;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:none;background:#ED7D31;width:68pt;">&nbsp;Precio Unitarios $&nbsp;</td>
            <td class="xl72" dir="LTR" style="color:white;font-size:13px;font-weight:700;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:center;vertical-align:middle;border:none;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:none;background:#ED7D31;width:68pt;">Kilos&nbsp;</td>
            <td class="xl99" dir="LTR" style="color:white;font-size:13px;font-weight:700;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:center;border-top:none;border-right:1.0pt solid windowtext;border-bottom:none;border-left:none;background:#ED7D31;width:68pt;">&nbsp;Costo Neto&nbsp;</td>
            <td class="xl82" style="color:black;font-size:15px;font-weight:700;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:none;border-bottom:none;border-left:none;">&nbsp;Var. Neta $&nbsp;</td>
            <td class="xl83" style="color:black;font-size:15px;font-weight:700;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:none;">% Var Neto</td>
            <td class="xl84" style="color:black;font-size:15px;font-weight:700;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:none;border-left:none;">&nbsp;Var. Tarifa&nbsp;</td>
            <td class="xl82" style="color:black;font-size:15px;font-weight:700;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:none;border-bottom:none;border-left:none;">&nbsp;Var. Precio&nbsp;</td>
            <td class="xl109" style="color:black;font-size:15px;font-weight:700;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:none;border-top:none;border-right:1.0pt solid windowtext;border-bottom:none;border-left:none;">Var por Cant.</td>
        </tr>
        <tr>
            <td class="xl100" dir="LTR" height="27" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:left;vertical-align:middle;border:none;border-top:  none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:1.0pt solid windowtext;background:#F8D7CD;height:20.45pt;width:128pt;" width="14.190871369294605%">BOGOTA</td>
            <td class="xl78" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:91pt;" width="10.04149377593361%">
                <br>
            </td>
            <td class="xl73" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl78" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- &nbsp;&nbsp;</td>
            <td class="xl78" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl73" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl98" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- &nbsp;&nbsp;</td>
            <td class="xl85" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- &nbsp;&nbsp;</td>
            <td align="right" class="xl81" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">0%</td>
            <td align="right" class="xl86" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">0%</td>
            <td class="xl85" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:71pt;" width="7.800829875518672%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - &nbsp;&nbsp;</td>
            <td class="xl98" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:74pt;" width="8.215767634854771%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- &nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td class="xl101" dir="LTR" height="27" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:left;vertical-align:middle;border:none;border-top:  none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:1.0pt solid windowtext;background:#FCECE8;height:20.45pt;width:128pt;" width="14.190871369294605%">PERIFERIA</td>
            <td class="xl79" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#FCECE8;border-top:none;border-left:none;width:91pt;" width="10.04149377593361%">
                <br>
            </td>
            <td class="xl74" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl79" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl79" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl74" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl88" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl87" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl79" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl88" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl87" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:71pt;" width="7.800829875518672%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - &nbsp;&nbsp;</td>
            <td class="xl88" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:74pt;" width="8.215767634854771%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- &nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td class="xl102" dir="LTR" height="27" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:left;vertical-align:middle;border:none;border-top:  none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:1.0pt solid windowtext;background:#F8D7CD;height:20.45pt;width:128pt;" width="14.190871369294605%">ANTIOQUIA</td>
            <td class="xl67" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;text-align:left;background:#F8D7CD;border-top:none;border-left:none;width:91pt;" width="10.04149377593361%">
                <br>
            </td>
            <td class="xl75" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl80" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl67" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;text-align:left;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl75" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl90" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl89" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl80" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl90" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl89" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:71pt;" width="7.800829875518672%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - &nbsp;&nbsp;</td>
            <td class="xl90" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:74pt;" width="8.215767634854771%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- &nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td class="xl101" dir="LTR" height="27" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:left;vertical-align:middle;border:none;border-top:  none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:1.0pt solid windowtext;background:#FCECE8;height:20.45pt;width:128pt;" width="14.190871369294605%">BOYACA</td>
            <td class="xl68" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;text-align:left;background:#FCECE8;border-top:none;border-left:none;width:91pt;" width="10.04149377593361%">
                <br>
            </td>
            <td class="xl74" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl79" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl68" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;text-align:left;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl74" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl88" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl87" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl79" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl88" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl87" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:71pt;" width="7.800829875518672%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - &nbsp;&nbsp;</td>
            <td class="xl88" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:74pt;" width="8.215767634854771%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- &nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td class="xl102" dir="LTR" height="27" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:left;vertical-align:middle;border:none;border-top:  none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:1.0pt solid windowtext;background:#F8D7CD;height:20.45pt;width:128pt;" width="14.190871369294605%">COSTA ATLANTI</td>
            <td class="xl67" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;text-align:left;background:#F8D7CD;border-top:none;border-left:none;width:91pt;" width="10.04149377593361%">
                <br>
            </td>
            <td class="xl75" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl80" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl67" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;text-align:left;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl75" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl90" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl89" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl80" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl90" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl89" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:71pt;" width="7.800829875518672%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - &nbsp;&nbsp;</td>
            <td class="xl90" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:74pt;" width="8.215767634854771%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- &nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td class="xl101" dir="LTR" height="27" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:left;vertical-align:middle;border:none;border-top:  none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:1.0pt solid windowtext;background:#FCECE8;height:20.45pt;width:128pt;" width="14.190871369294605%">EJE CAFETERO</td>
            <td class="xl68" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;text-align:left;background:#FCECE8;border-top:none;border-left:none;width:91pt;" width="10.04149377593361%">
                <br>
            </td>
            <td class="xl74" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl79" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl68" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;text-align:left;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl74" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl88" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl87" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl79" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl88" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl87" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:71pt;" width="7.800829875518672%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - &nbsp;&nbsp;</td>
            <td class="xl88" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:74pt;" width="8.215767634854771%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- &nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td class="xl102" dir="LTR" height="27" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:left;vertical-align:middle;border:none;border-top:  none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:1.0pt solid windowtext;background:#F8D7CD;height:20.45pt;width:128pt;" width="14.190871369294605%">GRANADA</td>
            <td class="xl67" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;text-align:left;background:#F8D7CD;border-top:none;border-left:none;width:91pt;" width="10.04149377593361%">
                <br>
            </td>
            <td class="xl75" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl80" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl67" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;text-align:left;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl75" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl90" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl89" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl80" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl90" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl89" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:71pt;" width="7.800829875518672%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - &nbsp;&nbsp;</td>
            <td class="xl90" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:74pt;" width="8.215767634854771%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- &nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td class="xl101" dir="LTR" height="27" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:left;vertical-align:middle;border:none;border-top:  none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:1.0pt solid windowtext;background:#FCECE8;height:20.45pt;width:128pt;" width="14.190871369294605%">HULA</td>
            <td class="xl68" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;text-align:left;background:#FCECE8;border-top:none;border-left:none;width:91pt;" width="10.04149377593361%">
                <br>
            </td>
            <td class="xl74" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl79" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl68" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;text-align:left;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl74" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl88" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl87" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl79" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl88" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl87" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:71pt;" width="7.800829875518672%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - &nbsp;&nbsp;</td>
            <td class="xl88" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:74pt;" width="8.215767634854771%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- &nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td class="xl102" dir="LTR" height="27" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:left;vertical-align:middle;border:none;border-top:  none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:1.0pt solid windowtext;background:#F8D7CD;height:20.45pt;width:128pt;" width="14.190871369294605%">PUERTO CARRE&Ntilde;O</td>
            <td class="xl67" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;text-align:left;background:#F8D7CD;border-top:none;border-left:none;width:91pt;" width="10.04149377593361%">
                <br>
            </td>
            <td class="xl75" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl80" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl67" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;text-align:left;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl75" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl90" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl89" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl80" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl90" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl89" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:71pt;" width="7.800829875518672%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - &nbsp;&nbsp;</td>
            <td class="xl90" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:74pt;" width="8.215767634854771%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- &nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td class="xl101" dir="LTR" height="27" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:left;vertical-align:middle;border:none;border-top:  none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:1.0pt solid windowtext;background:#FCECE8;height:20.45pt;width:128pt;" width="14.190871369294605%">SAN JOSE DEL GUAVIARE</td>
            <td class="xl68" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;text-align:left;background:#FCECE8;border-top:none;border-left:none;width:91pt;" width="10.04149377593361%">
                <br>
            </td>
            <td class="xl74" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl79" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl68" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;text-align:left;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl74" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl88" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl87" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl79" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl88" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl87" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:71pt;" width="7.800829875518672%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - &nbsp;&nbsp;</td>
            <td class="xl88" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:74pt;" width="8.215767634854771%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- &nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td class="xl102" dir="LTR" height="27" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:left;vertical-align:middle;border:none;border-top:  none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:1.0pt solid windowtext;background:#F8D7CD;height:20.45pt;width:128pt;" width="14.190871369294605%">SANTANDERES</td>
            <td class="xl67" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;text-align:left;background:#F8D7CD;border-top:none;border-left:none;width:91pt;" width="10.04149377593361%">
                <br>
            </td>
            <td class="xl75" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl80" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl67" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;text-align:left;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl75" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl90" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl89" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl80" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl90" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl89" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:71pt;" width="7.800829875518672%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - &nbsp;&nbsp;</td>
            <td class="xl90" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:74pt;" width="8.215767634854771%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- &nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td class="xl101" dir="LTR" height="27" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:left;vertical-align:middle;border:none;border-top:  none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:1.0pt solid windowtext;background:#FCECE8;height:20.45pt;width:128pt;" width="14.190871369294605%">TOLIMA</td>
            <td class="xl68" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;text-align:left;background:#FCECE8;border-top:none;border-left:none;width:91pt;" width="10.04149377593361%">
                <br>
            </td>
            <td class="xl74" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl79" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl68" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;text-align:left;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl74" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl88" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl87" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl79" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl88" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl87" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:71pt;" width="7.800829875518672%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - &nbsp;&nbsp;</td>
            <td class="xl88" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:74pt;" width="8.215767634854771%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- &nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td class="xl102" dir="LTR" height="27" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:left;vertical-align:middle;border:none;border-top:  none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:1.0pt solid windowtext;background:#F8D7CD;height:20.45pt;width:128pt;" width="14.190871369294605%">VALLE DEL CAUCA</td>
            <td class="xl67" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;text-align:left;background:#F8D7CD;border-top:none;border-left:none;width:91pt;" width="10.04149377593361%">
                <br>
            </td>
            <td class="xl75" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl80" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl67" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;text-align:left;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl75" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl90" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl89" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl80" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#F8D7CD;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl90" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl89" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:71pt;" width="7.800829875518672%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - &nbsp;&nbsp;</td>
            <td class="xl90" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:74pt;" width="8.215767634854771%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- &nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td class="xl101" dir="LTR" height="27" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:left;vertical-align:middle;border:none;border-top:  none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:1.0pt solid windowtext;background:#FCECE8;height:20.45pt;width:128pt;" width="14.190871369294605%">VILLAVICENCIO</td>
            <td class="xl68" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;text-align:left;background:#FCECE8;border-top:none;border-left:none;width:91pt;" width="10.04149377593361%">
                <br>
            </td>
            <td class="xl74" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl79" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl68" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;text-align:left;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl74" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:1.0pt solid white;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl88" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl87" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl79" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:1.0pt solid white;vertical-align:middle;background:#FCECE8;border-top:none;border-left:none;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl88" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl87" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:71pt;" width="7.800829875518672%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - &nbsp;&nbsp;</td>
            <td class="xl88" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#FCECE8;width:74pt;" width="8.215767634854771%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- &nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td class="xl103" dir="LTR" height="27" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:left;vertical-align:middle;border:none;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:1.0pt solid windowtext;background:#F8D7CD;height:20.45pt;width:128pt;" width="14.190871369294605%">MAKRO</td>
            <td class="xl69" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:left;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:none;background:#F8D7CD;width:91pt;" width="10.04149377593361%">
                <br>
            </td>
            <td class="xl66" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:left;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl69" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:left;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl69" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:left;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl66" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:left;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl92" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:left;border-top:none;border-right:1.0pt solid windowtext;border-bottom:none;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl91" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:left;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl69" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:left;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl92" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:left;border-top:none;border-right:1.0pt solid windowtext;border-bottom:none;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl91" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:left;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:none;background:#F8D7CD;width:71pt;" width="7.800829875518672%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- &nbsp;&nbsp;</td>
            <td class="xl92" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:left;border-top:none;border-right:1.0pt solid windowtext;border-bottom:none;border-left:none;background:#F8D7CD;width:74pt;" width="8.215767634854771%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - &nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td class="xl104" dir="LTR" height="27" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:left;vertical-align:middle;border:none;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:1.0pt solid windowtext;background:#FCECE8;height:20.45pt;width:128pt;" width="14.190871369294605%">CENCOSUD</td>
            <td class="xl70" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:left;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:none;background:#FCECE8;width:91pt;" width="10.04149377593361%">
                <br>
            </td>
            <td class="xl65" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:left;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl70" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:left;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl70" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:left;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl65" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:left;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl94" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:left;border-top:none;border-right:1.0pt solid windowtext;border-bottom:none;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl93" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:left;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl70" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:left;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl94" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:left;border-top:none;border-right:1.0pt solid windowtext;border-bottom:none;border-left:none;background:#FCECE8;width:68pt;" width="7.468879668049793%">
                <br>
            </td>
            <td class="xl93" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:left;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:none;background:#FCECE8;width:71pt;" width="7.800829875518672%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- &nbsp;&nbsp;</td>
            <td class="xl94" dir="LTR" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:left;border-top:none;border-right:1.0pt solid windowtext;border-bottom:none;border-left:none;background:#FCECE8;width:74pt;" width="8.215767634854771%">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - &nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td class="xl105" height="21" style="color:black;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:none;border-top:none;border-right:none;border-bottom:1.0pt solid windowtext;border-left:1.0pt solid windowtext;height:15.75pt;">
                <br>
            </td>
            <td class="xl106" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:none;border-bottom:1.0pt solid windowtext;border-left:none;">
                <br>
            </td>
            <td class="xl107" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:none;border-top:none;border-right:none;border-bottom:1.0pt solid windowtext;border-left:none;">
                <br>
            </td>
            <td class="xl106" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:none;border-bottom:1.0pt solid windowtext;border-left:none;">
                <br>
            </td>
            <td class="xl106" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:none;border-bottom:1.0pt solid windowtext;border-left:none;">
                <br>
            </td>
            <td class="xl107" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:none;border-top:none;border-right:none;border-bottom:1.0pt solid windowtext;border-left:none;">
                <br>
            </td>
            <td class="xl108" style="color:black;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid windowtext;border-left:none;">
                <br>
            </td>
            <td class="xl95" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid windowtext;border-left:none;background:#F8D7CD;width:68pt;">
                <br>
            </td>
            <td class="xl96" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid windowtext;border-left:none;background:#F8D7CD;width:68pt;">
                <br>
            </td>
            <td class="xl97" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid windowtext;border-left:none;background:#F8D7CD;width:68pt;">
                <br>
            </td>
            <td class="xl95" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid windowtext;border-left:none;background:#F8D7CD;width:71pt;">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - &nbsp;&nbsp;</td>
            <td class="xl97" style="color:windowtext;font-size:13px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid windowtext;border-left:none;background:#F8D7CD;width:74pt;">&nbsp;$ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- &nbsp;&nbsp;</td>
        </tr>
    </tbody>
</table>

</center>

  
           <script>
    $("#btnExport").click(function(e) {
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#dvData').html()));
        e.preventDefault();
    });
    </script>   

 
<br>
 
    

 
</div>
</body>
<footer>

</footer>   
<br>
<br>
 