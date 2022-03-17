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
        
        .table-containter{ max-width: 100%; max-height: 600px; overflow-x: scroll; overflow-y: scroll; border-left: solid 0.0001px; } .table-bordered{ border-top: solid 1px; } .table-bordered tbody tr { background: white; } .table-bordered tbody tr:nth-child(2n) { } .table-bordered tbody tr .{ background: white; } .table-bordered tbody tr:nth-child(2n) . { background: #f9f9f9; } .table-bordered tbody tr .inmovilizadaBod{ background: white; } .table-bordered tbody tr:nth-child(2n) .inmovilizadaBod {  } .inmoSup{ position: sticky; top: -1px; left: 116px; background: white; } .inmoSup-2{ white-space:nowrap; position: sticky; top: 59px; left: 116px; background: white; } .{ white-space:nowrap; left: 0px; top: 36px; position: sticky; padding: 1px; } .inmovilizadaBod{ left: 0px; top: -1px; position: sticky; background: white; padding: 1px; } .inmoEsqUna{ white-space:nowrap; position: sticky; top: -1px; left:0px; background: #C3EE6D; }.table-bordered tbody tr .inmoEsqUna{ background: #C3EE6D; } .inmoEsqDos{ white-space:nowrap; position: sticky; top: -1px; left: 0px; background: #C3EE6D; } .table-bordered tbody tr .inmoEsqDos{ background: #C3EE6D; } .inmototal{ left: 0px; position: sticky; background: white; padding: 1px; }
        dt {
             position: -webkit-sticky;
          position: sticky;
          top: -1px;
        }


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
        {!! Form::open(['route' => 'fletesmes', 'method'=>'GET']) !!}
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
                            <option value="02" selected >Costo Fletes Mes / Año</option>
                            
                </select>
            </center>
        </td>

            <td>
        </td>   
    </tr>
    <tr>        
        <td colspan="5">
            <input type="submit" class="btn btn-warning btn-block" id="boton" name="VerDatosG" value="CONSULTAR"/>
            {!! Form::close() !!}
        </td>
    </tr>
</table>

<form action="ExportExcel/ExportMPrincipal.php" method="POST" target="_blank" > 
    <input type="hidden" name ='FechaInicio' value= "2021-01">
    <input type="hidden" name ='FechaFinal' value= "2021-02">
    <input type="hidden" name ='Tipo' value="01"> 
    <input type="submit" class="btn btn-success" id="btnExport" name="VerDatosG" value="Descargar en Excel"/>
</form>  

<center>

<strong>{!!$filtro!!}</strong>
<hr>
<div id="dvData">


    
<table class="table-hover" border="0" cellpadding="0" cellspacing="0" id="isPasted" style="border-collapse: collapse;width:1305pt;" width="1205">

    <tbody>
        <dt class="">
            <td class="xl112 inmoEsqUna" dir="LTR" height="72" rowspan="2" style="color:white;font-size:15px;font-weight:700;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:center;vertical-align:middle;border:none;border-top:1.0pt solid windowtext;border-right:none;border-bottom:  1.5pt solid white;border-left:1.0pt solid windowtext;background:#ED7D31;height:54.4pt;width:128pt;" width="14.190871369294605%">ZONA</td>
            <td class="xl110 inmoSup" colspan="3" style="color:black;font-size:15px;font-weight:700;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:center;vertical-align:middle;border:none;border-top:1.0pt solid windowtext;border-right:none;border-bottom:1.0pt solid windowtext;border-left:1.0pt solid windowtext;width:227pt;" width="24.979253112033195%">PRESUPUESTO</td>
            <td class="xl110 inmoSup" colspan="3" style="color:black;font-size:15px;font-weight:700;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:center;vertical-align:middle;border:none;border-top:1.0pt solid windowtext;border-right:1.0pt solid black;border-bottom:1.0pt solid windowtext;border-left:1.0pt solid windowtext;width:204pt;" width="22.406639004149376%">EJECUCI&Oacute;N</td>
            <td class="xl115 inmoSup" colspan="4" style="color:black;font-size:15px;font-weight:700;font-style:normal;text-decoration:underline;font-family:Arial, sans-serif;text-align:center;vertical-align:middle;border:none;border-top:1.0pt solid windowtext;border-right:1.0pt solid black;border-bottom:1.0pt solid windowtext;border-left:none;width:204pt;" width="22.406639004149376%">VARIACIONES</td>
            <td class="xl118 inmoSup" colspan="2" style="color:black;font-size:15px;font-weight:700;font-style:normal;text-decoration:underline;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:center;border-top:1.0pt solid windowtext;border-right:1.0pt solid black;border-bottom:1.0pt solid windowtext;border-left:none;width:145pt;" width="16.016597510373444%">&nbsp;Variaci&oacute;n P X Q&nbsp;</td>
        </tr>
        <dt class="inmovilizadaBod">
            <td class="xl77 inmoSup-2" dir="LTR" height="35" style="color:white;font-size:15px;font-weight:700;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:center;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:1.0pt solid white;background:#ED7D31;height:26.25pt;width:91pt;">&nbsp;Precio Unitarios $&nbsp;</td>
            <td class="xl72 inmoSup-2" dir="LTR" style="color:white;font-size:18px;font-weight:700;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:center;vertical-align:middle;border:none;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:none;background:#ED7D31;width:68pt;">Kilos PPTO</td>
            <td class="xl77 inmoSup-2" dir="LTR" style="color:white;font-size:18px;font-weight:700;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:center;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:none;background:#ED7D31;width:68pt;">&nbsp;Costo Neto&nbsp;</td>
            <td class="xl77 inmoSup-2" dir="LTR" style="color:white;font-size:18px;font-weight:700;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:center;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:none;background:#ED7D31;width:68pt;">&nbsp;Precio Unitarios $&nbsp;</td>
            <td class="xl72 inmoSup-2" dir="LTR" style="color:white;font-size:18px;font-weight:700;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:center;vertical-align:middle;border:none;border-top:none;border-right:1.0pt solid white;border-bottom:none;border-left:none;background:#ED7D31;width:68pt;">Kilos&nbsp;</td>
            <td class="xl99 inmoSup-2" dir="LTR" style="color:white;font-size:18px;font-weight:700;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:general;vertical-align:middle;border:none;text-align:center;border-top:none;border-right:1.0pt solid windowtext;border-bottom:none;border-left:none;background:#ED7D31;width:68pt;">&nbsp;Costo Neto&nbsp;</td>
            <td class="xl82 inmoSup-2" style="color:black;font-size:18px;font-weight:700;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:none;border-bottom:none;border-left:none;">&nbsp;Var. Neta $&nbsp;</td>
            <td class="xl83 inmoSup-2" style="color:black;font-size:18px;font-weight:700;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:none;">% Var Neto</td>

            <td class="xl83 inmoSup-2" style="color:black;font-size:18px;font-weight:700;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:none;">% Var. Tarifa</td>

            <td class="xl84 inmoSup-2" style="color:black;font-size:18px;font-weight:700;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:1.0pt solid windowtext;border-bottom:none;border-left:none;">&nbsp;Var. Volumen&nbsp;</td>

            <td class="xl82 inmoSup-2" style="color:black;font-size:18px;font-weight:700;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:bottom;border:none;vertical-align:middle;border-top:none;border-right:none;border-bottom:none;border-left:none;">&nbsp;Var. Precio&nbsp;</td>
            <td class="xl109 inmoSup-2" style="color:black;font-size:18px;font-weight:700;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:general;vertical-align:middle;border:none;border-top:none;border-right:1.0pt solid windowtext;border-bottom:none;border-left:none;">Var por Cant.</td>
        </tr>

        @foreach($query as $row)
        <tr class ="colordos">
            <td class="xl100 zona" dir="LTR" height="27" style="color:black;font-size:18px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:left;vertical-align:middle;border:none;border-top:  none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:1.0pt solid windowtext;background:#F8D7CD;height:20.45pt;width:128pt;" width="14.190871369294605%">{{$row->ZONA}}</td>
            <td class="xl78 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:91pt;" width="10.04149377593361%">
                {{number_format($row->VALOR_PPTO,2,',','')}}
              
            </td>
            <td class="xl73 formatonumero" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
              
                {{number_format($row->KILOS_PTTO,0,',','.')}} 
            </td>
            <td class="xl73 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                {{number_format($row->COSTO_NETO,0,',','')}}
            </td>
            <td class="xl78 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                {{number_format($row->VLR_FLETE,0,',','')}} 
            </td>
                
            </td>
            <td class="xl73 formatonumero" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                 {{number_format($row->Kilos,0,',','.')}} 
              
            </td>
            <td class="xl98 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                {{number_format($row->TNETO,0,',','')}}

            </td>
            <td class="xl85 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">{{number_format($row->VARNETA,2,',','')}}</td>

            <td align="right" class="xl81 formatoporcentaje" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                {{number_format($row->PVARNETA,2,',','')}} %
            </td>

            <td align="right" class="xl81 formatoporcentaje" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                {{number_format($row->VARTARIFA,2,',','')}} %
            </td>

            <td align="right" class="xl86 formatoporcentaje" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">{{number_format($row->VARVOLUM,2,',','')}} %
            </td>
            <td class="xl85 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:71pt;" width="7.800829875518672%">
                {{number_format($row->VARPRECIO,2,',','')}}
            </td>

            <td class="xl98 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:74pt;" width="8.215767634854771%">{{number_format($row->VARCANT,2,',','')}}</td>
        </tr>
            @endforeach

@foreach($bogota as $row)
        <tr class ="colordos">
            <td class="xl100 zona" dir="LTR" height="27" style="color:black;font-size:18px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:left;vertical-align:middle;border:none;border-top:  none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:1.0pt solid windowtext;background:#F8D7CD;height:20.45pt;width:128pt;" width="14.190871369294605%">{{$row->ZONA}}</td>
            <td class="xl78 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:91pt;" width="10.04149377593361%">
                {{number_format($row->VALOR_PPTO,0,',','')}}
              
            </td>
            <td class="xl73 formatonumero" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
              
                {{number_format($row->KILOS_PTTO,0,',','.')}} 
            </td>
            <td class="xl73 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                {{number_format($row->COSTO_NETO,0,',','')}}
            </td>
            <td class="xl78 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                {{number_format($row->VLR_FLETE,0,',','')}} 
            </td>
                
            </td>
            <td class="xl73 formatonumero" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                 {{number_format($row->Kilos,0,',','.')}} 
              
            </td>
            <td class="xl98 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                {{number_format($row->TNETO,0,',','')}}

            </td>
            <td class="xl85 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">{{number_format($row->VARNETA,2,',','')}}</td>

            <td align="right" class="xl81 formatoporcentaje" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                {{number_format($row->PVARNETA,2,',','')}} %
            </td>

            <td align="right" class="xl81 formatoporcentaje" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                {{number_format($row->VARTARIFA,2,',','')}} %
            </td>

            <td align="right" class="xl86 formatoporcentaje" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">{{number_format($row->VARVOLUM,2,',','')}} %
            </td>
            <td class="xl85 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:71pt;" width="7.800829875518672%">
                {{number_format($row->VARPRECIO,2,',','')}}
            </td>

            <td class="xl98 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:74pt;" width="8.215767634854771%">{{number_format($row->VARCANT,2,',','')}}</td>
        </tr>
            @endforeach

@foreach($nacional as $row)
        <tr class ="colordos">
            <td class="xl100 zona" dir="LTR" height="27" style="color:black;font-size:18px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:left;vertical-align:middle;border:none;border-top:  none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:1.0pt solid windowtext;background:#F8D7CD;height:20.45pt;width:128pt;" width="14.190871369294605%">{{$row->ZONA}}</td>
            <td class="xl78 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:91pt;" width="10.04149377593361%">
                {{number_format($row->VALOR_PPTO,2,',','')}}
              
            </td>
            <td class="xl73 formatonumero" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
              
                {{number_format($row->KILOS_PTTO,0,',','.')}} 
            </td>
            <td class="xl73 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                {{number_format($row->COSTO_NETO,0,',','')}}
            </td>
            <td class="xl78 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                {{number_format($row->VLR_FLETE,0,',','')}} 
            </td>
                
            </td>
            <td class="xl73 formatonumero" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                 {{number_format($row->Kilos,0,',','.')}} 
              
            </td>
            <td class="xl98 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                {{number_format($row->TNETO,0,',','')}}

            </td>
            <td class="xl85 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">{{number_format($row->VARNETA,2,',','')}}</td>

            <td align="right" class="xl81 formatoporcentaje" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                {{number_format($row->PVARNETA,2,',','')}} %
            </td>

            <td align="right" class="xl81 formatoporcentaje" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                {{number_format($row->VARTARIFA,2,',','')}} %
            </td>

            <td align="right" class="xl86 formatoporcentaje" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">{{number_format($row->VARVOLUM,2,',','')}} %
            </td>
            <td class="xl85 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:71pt;" width="7.800829875518672%">
                {{number_format($row->VARPRECIO,2,',','')}}
            </td>

            <td class="xl98 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:74pt;" width="8.215767634854771%">{{number_format($row->VARCANT,2,',','')}}</td>
        </tr>
            @endforeach
            
@foreach($total as $row)
        <tr class ="colordos">
            <td class="xl100 zona" dir="LTR" height="27" style="color:black;font-size:18px;font-weight:400;font-style:normal;text-decoration:none;font-family:Calibri, sans-serif;text-align:left;vertical-align:middle;border:none;border-top:  none;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:1.0pt solid windowtext;background:#F8D7CD;height:20.45pt;width:128pt;" width="14.190871369294605%">{{$row->ZONA}}</td>
            <td class="xl78 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:91pt;" width="10.04149377593361%">
                {{number_format($row->VALOR_PPTO,0,',','')}}
              
            </td>
            <td class="xl73 formatonumero" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
              
                {{number_format($row->KILOS_PTTO,0,',','.')}} 
            </td>
            <td class="xl73 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                {{number_format($row->COSTO_NETO,0,',','')}}
            </td>
            <td class="xl78 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                {{number_format($row->VLR_FLETE,0,',','')}} 
            </td>
                
            </td>
            <td class="xl73 formatonumero" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                 {{number_format($row->Kilos,0,',','.')}} 
              
            </td>
            <td class="xl98 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                {{number_format($row->TNETO,0,',','')}}

            </td>
            <td class="xl85 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">{{number_format($row->VARNETA,2,',','')}}</td>

            <td align="right" class="xl81 formatoporcentaje" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                {{number_format($row->PVARNETA,2,',','')}} %
            </td>

            <td align="right" class="xl81 formatoporcentaje" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">
                {{number_format($row->VARTARIFA,2,',','')}} %
            </td>

            <td align="right" class="xl86 formatoporcentaje" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:middle;border:none;border-top:1.5pt solid white;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:68pt;" width="7.468879668049793%">{{number_format($row->VARVOLUM,2,',','')}} %
            </td>
            <td class="xl85 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid white;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:71pt;" width="7.800829875518672%">
                {{number_format($row->VARPRECIO,2,',','')}}
            </td>

            <td class="xl98 formatoprecio" style="color:windowtext;font-size:15px;font-weight:400;font-style:normal;text-decoration:none;font-family:Arial, sans-serif;text-align:right;vertical-align:bottom;border:none;vertical-align:middle;border-top:1.5pt solid white;border-right:1.0pt solid windowtext;border-bottom:1.0pt solid white;border-left:none;background:#F8D7CD;width:74pt;" width="8.215767634854771%">{{number_format($row->VARCANT,2,',','')}}</td>
        </tr>
            @endforeach

            </tbody>

</table>

</div>
<br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
</center>

  
<script>
        const formatterPeso = new Intl.NumberFormat('es-CO', {
         style: 'currency',
         currency: 'COP'
         ,minimumFractionDigits: 0
     })

        $("#btnExport").click(function(e) {
            window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#dvData').html()));
            e.preventDefault();
        });

        $('.colordos').each(function(index, el) {
            if (index % 2 == 1) {
                $("td", this).css({
                    'background-color': '#F8D7CD'
                })
            } else {
                $("td", this).css({
                    'background-color': '#FCECE8'
            });
        }
        });


        $('.formatoprecio').each(function(index, el) {
            $(this).text(formatterPeso.format(parseFloat($(this).text())));
        });

        var tam = $('.colordos').length; 
        console.log(tam);

        $('.colordos').each(function(index, el) {
           if (index == 2 || index == 5 || index == tam-2) {
            $("td", this).css({
                'background-color': '#ED7D31',
                'color': 'black',
                'font-weight': 'bold'
            });;
        }

        if (index == tam-1) {
         $("td", this).css({
            'background-color': '#5cb85c',
            'color': 'black',
            'font-weight': 'bold'
        });

        }   
 });



</script>   
 
</div>
</body>
<footer>

</footer>   
 