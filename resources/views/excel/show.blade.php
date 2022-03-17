<!DOCTYPE html>
    <html>
    <head>
        <title>&Iacute;ndice Nómina SSL - Empleados </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="../css/menuHorizontal.css" rel="stylesheet" type="text/css" media="screen" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="../js/submenu.js"></script>
    </head>
    <body>
    <ol class="breadcrumb">
          <li class="breadcrumb-item"><a class="linkmigas" href="{{ url('indicessl') }}"><strong>Indicadores SSL - Empleados</strong></a></li> 
          <li class="breadcrumb-item active"><strong>Excel SSL - Empleados</strong></li> 
          <li class="breadcrumb-item active"><strong>Menú General</strong></li>
    </ol>    
    <br><br>
        
    <center>
     {!! Form::open(['route' => 'excel.index', 'method'=>'GET']) !!}
        <table style="width: 50%" class="table table-bordered">
            <tr align="center">
                <td bgcolor="#C3EE6D" colspan="2"><strong>DESCARGAR EMPLEADOS</strong></td>
            </tr> 
            
            <tr>
                <td style="width: 35%">DESDE (MES DE INICIO)</td>
                <td align="center"> 
                    <input onFocus="this.value=''" style="width: 80%" class="form-control" type="month" aria-describedby="nameHelp" placeholder="Fecha de inicio" min="2015-01" max="2021-11" name="FechaInicio" required>
                </td>
            </tr>
            <tr>
                <td>HASTA (MES FINAL)</td>
                <td align="center"> 
                    <input onFocus="this.value=''" style="width: 80%" class="form-control" type="month" aria-describedby="nameHelp" placeholder="Fecha Final" min="2015-01" max="2021-11" name="FechaFin" required>
                </td>
            </tr>
            <tr>
                
                <td align="center" colspan="2"><input type="submit" class="btn btn-warning btn-block"  value="¡DESCARGAR EXCEL!"/></td> 
            </tr>
        </table> 
   {!! Form::close() !!}

    <br>
<!-- <div id="carga">
    <img src="{{asset('img/spinner.gif')}}" class="rounded mx-auto d-block" alt="Calculando información" >
    <center>Cargando información...</center>
    </div>
 -->
    
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

    function cambiar(e){
        if (e == '02' || e == '03') {
        }
        else {
            window.location.href=e;
        }
    }
   

  </script>

  
    </html>
