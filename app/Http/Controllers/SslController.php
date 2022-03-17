<?php

namespace App\Http\Controllers;

use App\Http\Requests\SslStoreRequest;
use App\Http\Requests\SslUpdateRequest;
use App\Models\Ssl;
use DB;
use Illuminate\Http\Request;

class SslController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    set_time_limit(3000000);
    ini_set('memory_limit', '-1'); 


    $json = json_encode($request->input('Mes'),TRUE);
    $anio= Carbon::now();
    $area=$request->input('area') == null ? "'ADMINISTRACION'" : "'".$request->input('area')."'";
    
    
    $cambiar = array("]");
    $cambiar1 = array("[");
    $cambiar2 = array("\"");
    $cambiado =str_replace($cambiar, "",$json);
    $cambiado1 =str_replace($cambiar1, "",$cambiado);
    $cambiado2 =str_replace($cambiar2, "'",$cambiado1);

    //$mes=$request->input('Mes') == null ? '' : $request->input('Mes');
    $mes=$request->input('Mes') == null ? "'01-Ene','02-Feb','03-Mar','04-Abr','05-May','06-Jun','07-Jul','08-Ago','09-Sep','10-Oct','11-Nov','12-Dic'" : $cambiado2;
    

$procedure=DB::connection('palmeras')->select(DB::raw("

    SELECT A.ORDEN,A.CTA_AUXILIAR_2,IIF(A.ORDEN IN(1,2), A.NETO,A.PORCENTAJE) AS ANIO2019,IIF(B.ORDEN IN(1,2), B.NETO,B.PORCENTAJE) AS ANIO2020,IIF(C.ORDEN IN(1,2), C.NETO,C.PORCENTAJE) AS ANIO2021P
    , IIF(D.ORDEN IN(1,2), D.NETO,D.PORCENTAJE) AS ANIO2021E
    , PV=(IIF(D.ORDEN IN(1,2), 
        D.NETO,D.PORCENTAJE)-IIF(B.ORDEN IN(1,2), B.NETO,B.PORCENTAJE))/IIF(B.ORDEN IN(1,2), B.NETO,B.PORCENTAJE) * 100, 
    PVP=(IIF(D.ORDEN IN(1,2), D.NETO,D.PORCENTAJE)-IIF(C.ORDEN IN(1,2), C.NETO,C.PORCENTAJE))/NULLIF(IIF(C.ORDEN IN(1,2), C.NETO,C.PORCENTAJE),0) * 100, 
    VP=NULLIF((IIF(D.ORDEN IN(1,2), D.NETO,D.PORCENTAJE)-IIF(C.ORDEN IN(1,2), C.NETO,C.PORCENTAJE)),0)

    FROM (
        SELECT ORDEN, CTA_AUXILIAR_2, SUM(NETO) AS NETO, (SELECT SUM(NETO) FROM BaseContabilidadPresupuestoIndicadorNomina WHERE AÑO=YEAR(GETDATE())-2  AND MES IN ($mes) AND ORDEN IN (1,2)  AND EMPRESA='EJECUTADO') AS TNOM,
        NULLIF((SUM(NETO) / (SELECT SUM(NETO) FROM BaseContabilidadPresupuestoIndicadorNomina WHERE AÑO=YEAR(GETDATE())-2  AND MES IN ($mes) AND ORDEN IN (1,2) AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND EMPRESA='EJECUTADO' )) *100,0) AS PORCENTAJE
        FROM BaseContabilidadPresupuestoIndicadorNomina WHERE AÑO=YEAR(GETDATE())-2  AND MES IN ($mes) AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS',
            '16 - PRODUCCION',
            '90 - CIERRE CUENTAS TRIBUTARIAS'
        ) GROUP BY ORDEN, CTA_AUXILIAR_2 ) AS A

    LEFT JOIN (
        SELECT ORDEN, CTA_AUXILIAR_2, SUM(NETO) AS NETO, (SELECT SUM(NETO) FROM BaseContabilidadPresupuestoIndicadorNomina WHERE AÑO=YEAR(GETDATE())-1  AND MES IN ($mes) AND ORDEN IN (1,2)  AND EMPRESA='EJECUTADO') AS TNOM,
        NULLIF((SUM(NETO) / (SELECT SUM(NETO) FROM BaseContabilidadPresupuestoIndicadorNomina WHERE AÑO=YEAR(GETDATE())-1  AND MES IN ($mes) AND ORDEN IN (1,2) AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND EMPRESA='EJECUTADO' )) *100,0) AS PORCENTAJE
        FROM BaseContabilidadPresupuestoIndicadorNomina WHERE AÑO=YEAR(GETDATE())-1 AND MES IN ($mes) AND EMPRESA='EJECUTADO'  AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS',
            '16 - PRODUCCION',
            '90 - CIERRE CUENTAS TRIBUTARIAS'
        ) GROUP BY ORDEN, CTA_AUXILIAR_2 ) AS B ON B.ORDEN =A.ORDEN

    LEFT JOIN (
        SELECT ORDEN, CTA_AUXILIAR_2, SUM(NETO) AS NETO, (SELECT SUM(NETO) FROM BaseContabilidadPresupuestoIndicadorNomina WHERE AÑO=YEAR(GETDATE())  AND MES IN ($mes) AND ORDEN IN (1,2) AND EMPRESA='PRESUPUESTO'  ) AS TNOM,
        NULLIF((SUM(NETO) / (SELECT SUM(NETO) FROM BaseContabilidadPresupuestoIndicadorNomina WHERE AÑO=YEAR(GETDATE())  AND MES IN ($mes) AND ORDEN IN (1,2)  AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND EMPRESA='PRESUPUESTO' )) *100,0) AS PORCENTAJE
        FROM BaseContabilidadPresupuestoIndicadorNomina WHERE AÑO=YEAR(GETDATE()) AND MES IN ($mes) AND EMPRESA='PRESUPUESTO' AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS',
            '16 - PRODUCCION',
            '90 - CIERRE CUENTAS TRIBUTARIAS'
        )GROUP BY ORDEN, CTA_AUXILIAR_2) AS C ON C.ORDEN =A.ORDEN

    LEFT JOIN (
        SELECT ORDEN, CTA_AUXILIAR_2, SUM(NETO) AS NETO, (SELECT SUM(NETO) FROM BaseContabilidadPresupuestoIndicadorNomina WHERE AÑO=YEAR(GETDATE())  AND MES IN ($mes) AND ORDEN IN (1,2) AND EMPRESA='EJECUTADO'  ) AS TNOM,
        NULLIF((SUM(NETO) / (SELECT SUM(NETO) FROM BaseContabilidadPresupuestoIndicadorNomina WHERE AÑO=YEAR(GETDATE())  AND MES IN ($mes) AND ORDEN IN (1,2) AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND EMPRESA='EJECUTADO' )) *100,0) AS PORCENTAJE
        FROM BaseContabilidadPresupuestoIndicadorNomina WHERE AÑO=YEAR(GETDATE())  AND MES IN ($mes) AND EMPRESA='EJECUTADO' AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS',
            '16 - PRODUCCION',
            '90 - CIERRE CUENTAS TRIBUTARIAS'
        )GROUP BY ORDEN, CTA_AUXILIAR_2) AS D ON D.ORDEN =A.ORDEN

    ORDER BY A.ORDEN"));

$areas=DB::connection('palmeras')->select(DB::raw("

    SELECT A.ORDEN,A.AREA,A.CTA_AUXILIAR_2,IIF(A.ORDEN IN(1,2), A.NETO,A.PORCENTAJE) AS ANIO2019,IIF(B.ORDEN IN(1,2), B.NETO,B.PORCENTAJE) AS ANIO2020,IIF(C.ORDEN IN(1,2), C.NETO,C.PORCENTAJE) AS ANIO2021P
    , IIF(D.ORDEN IN(1,2), D.NETO,D.PORCENTAJE) AS ANIO2021E
    , PV=(IIF(D.ORDEN IN(1,2), 
        D.NETO,D.PORCENTAJE)-IIF(B.ORDEN IN(1,2), B.NETO,B.PORCENTAJE))/IIF(B.ORDEN IN(1,2), B.NETO,B.PORCENTAJE)* 100 , 
    PVP=(IIF(D.ORDEN IN(1,2), D.NETO,D.PORCENTAJE)-IIF(C.ORDEN IN(1,2), C.NETO,C.PORCENTAJE))/NULLIF(IIF(C.ORDEN IN(1,2), C.NETO,C.PORCENTAJE),0) * 100, 
    VP=NULLIF((IIF(D.ORDEN IN(1,2), D.NETO,D.PORCENTAJE)-IIF(C.ORDEN IN(1,2), C.NETO,C.PORCENTAJE)),0)

    FROM (
        SELECT ORDEN, AREA, CTA_AUXILIAR_2, SUM(NETO) AS NETO, (SELECT SUM(NETO) FROM BaseContabilidadPresupuestoIndicadorNomina WHERE AÑO=YEAR(GETDATE())-2  AND MES IN ($mes) AND ORDEN IN (1,2) AND AREA = $area ) AS TNOM,
        
        NULLIF((SUM(NETO) / (SELECT SUM(NETO) FROM BaseContabilidadPresupuestoIndicadorNomina WHERE AÑO=YEAR(GETDATE())-2  AND MES IN ($mes) AND ORDEN IN (1,2) AND AREA = $area  AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') )) *100,0) AS PORCENTAJE

        FROM BaseContabilidadPresupuestoIndicadorNomina WHERE AÑO=YEAR(GETDATE())-2  AND MES IN ($mes) AND AREA = $area AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS',
            '16 - PRODUCCION',
            '90 - CIERRE CUENTAS TRIBUTARIAS'
        ) GROUP BY ORDEN, AREA, CTA_AUXILIAR_2 ) AS A

    LEFT JOIN (
        SELECT ORDEN, CTA_AUXILIAR_2, SUM(NETO) AS NETO, (SELECT SUM(NETO) FROM BaseContabilidadPresupuestoIndicadorNomina WHERE AÑO=YEAR(GETDATE())-1  AND MES IN ($mes) AND ORDEN IN (1,2)  AND AREA = $area AND EMPRESA='EJECUTADO' ) AS TNOM,

        NULLIF((SUM(NETO) / (SELECT SUM(NETO) FROM BaseContabilidadPresupuestoIndicadorNomina WHERE AÑO=YEAR(GETDATE())-1  AND MES IN ($mes) AND ORDEN IN (1,2) AND AREA = $area AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND EMPRESA='EJECUTADO')) *100,0) AS PORCENTAJE

        FROM BaseContabilidadPresupuestoIndicadorNomina WHERE AÑO=YEAR(GETDATE())-1  AND MES IN ($mes) AND AREA = $area AND EMPRESA='EJECUTADO' AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS',
            '16 - PRODUCCION',
            '90 - CIERRE CUENTAS TRIBUTARIAS'
        )GROUP BY ORDEN, CTA_AUXILIAR_2 ) AS B ON B.ORDEN =A.ORDEN

    LEFT JOIN (
        SELECT ORDEN, CTA_AUXILIAR_2, SUM(NETO) AS NETO, (SELECT SUM(NETO) FROM BaseContabilidadPresupuestoIndicadorNomina WHERE AÑO=YEAR(GETDATE())  AND MES IN ($mes) AND ORDEN IN (1,2) AND EMPRESA='PRESUPUESTO' AND AREA = $area AND EMPRESA='PRESUPUESTO') AS TNOM,
        NULLIF((SUM(NETO) / (SELECT SUM(NETO) FROM BaseContabilidadPresupuestoIndicadorNomina WHERE AÑO=YEAR(GETDATE())  AND MES IN ($mes) AND ORDEN IN (1,2) AND AREA = $area AND EMPRESA='PRESUPUESTO' AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS',
            '16 - PRODUCCION',
            '90 - CIERRE CUENTAS TRIBUTARIAS'
        )AND EMPRESA='PRESUPUESTO')) *100,0) AS PORCENTAJE
        FROM BaseContabilidadPresupuestoIndicadorNomina WHERE AÑO=YEAR(GETDATE())  AND MES IN ($mes) AND AREA = $area AND EMPRESA='PRESUPUESTO' AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS',
            '16 - PRODUCCION',
            '90 - CIERRE CUENTAS TRIBUTARIAS'
        ) GROUP BY ORDEN, CTA_AUXILIAR_2) AS C ON C.ORDEN =A.ORDEN

    LEFT JOIN (
        SELECT ORDEN, CTA_AUXILIAR_2, SUM(NETO) AS NETO, (SELECT SUM(NETO) FROM BaseContabilidadPresupuestoIndicadorNomina WHERE AÑO=YEAR(GETDATE())  AND MES IN ($mes) AND ORDEN IN (1,2) AND EMPRESA='EJECUTADO' AND AREA = $area ) AS TNOM,
        NULLIF((SUM(NETO) / (SELECT SUM(NETO) FROM BaseContabilidadPresupuestoIndicadorNomina WHERE AÑO=YEAR(GETDATE())  AND MES IN ($mes) AND ORDEN IN (1,2) AND AREA = $area AND EMPRESA='EJECUTADO'  )) *100,0) AS PORCENTAJE
        FROM BaseContabilidadPresupuestoIndicadorNomina WHERE AÑO=YEAR(GETDATE())  AND MES IN ($mes)  AND AREA = $area AND EMPRESA='EJECUTADO' AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS',
            '16 - PRODUCCION',
            '90 - CIERRE CUENTAS TRIBUTARIAS'
        ) GROUP BY ORDEN, CTA_AUXILIAR_2) AS D ON D.ORDEN =A.ORDEN


    ORDER BY A.ORDEN


    "));


    
    return view('ssl.index', compact('procedure','mes','areas','area'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('ssl.create');
    }

    /**
     * @param \App\Http\Requests\PayrollStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(sslStoreRequest $request)
    {
        $ssl = ssl::create($request->validated());

        $request->session()->flash('ssl.id', $ssl->id);

        return redirect()->route('ssl.index');
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Payroll $payroll
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Payroll $payroll)
    {
        return view('payroll.edit', compact('payroll'));
    }

    /**
     * @param \App\Http\Requests\PayrollUpdateRequest $request
     * @param \App\Models\Payroll $payroll
     * @return \Illuminate\Http\Response
     */
    public function update(PayrollUpdateRequest $request, Payroll $payroll)
    {
        $payroll->update($request->validated());

        $request->session()->flash('payroll.id', $payroll->id);

        return redirect()->route('payroll.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Payroll $payroll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Payroll $payroll)
    {
        $payroll->delete();

        return redirect()->route('payroll.index');
    }

        public function indicenomina(Request $request)
    {
        
               
        if (empty($request->all())) {
            return view('ssl.indicenominapalmeras');
        } else {
            
             set_time_limit(3000000);
            ini_set('memory_limit', '-1'); 

        


            $FechaIni=strtotime($request->input('FechaInicio'));  
            $FechaFin=strtotime($request->input('FechaFin'));  
            $AniIni=date("Y", $FechaIni);  
            $MesIni=date("m", $FechaIni);  
            $AniFin=date("Y", $FechaFin);
            $MesFin=date("m", $FechaFin); 
            $area="'%".$request->input('area')."%'";  
            $informe= $request->input('Tipo')=='01' ? "Informe Comparativo Anual" : "Informe Indicadores SSL - Empleados  Mes ";
            $AnioActual=date("Y");  

            //dd($area,$AniIni, $MesIni, $AniFin, $MesFin, $AnioActual);
            $filtro = $informe." Año Inicial: ". $AniIni." Año Final: ". $AniFin . " Mes Inicial : ". $MesIni . " Mes Final: ". $MesFin. " Area: ". $request->input('area');
           
             //dd($filtro);   
           $query=DB::connection('palmeras')->select(DB::raw("


SELECT *, 

AEnero2015= (isnull(Enero2015,0)),
AFebrero2015= (isnull(Febrero2015,0)+isnull(Enero2015,0)),
AMarzo2015= (isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AAbril2015= (isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AMayo2015= (isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AJunio2015= (isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AJulio2015= (isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AAgosto2015= (isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
ASeptiembre2015= (isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AOctubre2015= (isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
ANoviembre2015= (isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
ADiciembre2015= (isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AEnero2016= (isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AFebrero2016= (isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AMarzo2016= (isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AAbril2016= (isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AMayo2016= (isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AJunio2016= (isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AJulio2016= (isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AAgosto2016= (isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
ASeptiembre2016= (isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AOctubre2016= (isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
ANoviembre2016= (isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
ADiciembre2016= (isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AEnero2017= (isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AFebrero2017= (isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AMarzo2017= (isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AAbril2017= (isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AMayo2017= (isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AJunio2017= (isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AJulio2017= (isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AAgosto2017= (isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
ASeptiembre2017= (isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AOctubre2017= (isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
ANoviembre2017= (isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
ADiciembre2017= (isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AEnero2018= (isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AFebrero2018= (isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AMarzo2018= (isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AAbril2018= (isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AMayo2018= (isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AJunio2018= (isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AJulio2018= (isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AAgosto2018= (isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
ASeptiembre2018= (isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AOctubre2018= (isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
ANoviembre2018= (isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
ADiciembre2018= (isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AEnero2019= (isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AFebrero2019= (isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AMarzo2019= (isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AAbril2019= (isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AMayo2019= (isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AJunio2019= (isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AJulio2019= (isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AAgosto2019= (isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
ASeptiembre2019= (isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AOctubre2019= (isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
ANoviembre2019= (isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
ADiciembre2019= (isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AEnero2020= (isnull(Enero2020,0)+isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AFebrero2020= (isnull(Febrero2020,0)+isnull(Enero2020,0)+isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AMarzo2020= (isnull(Marzo2020,0)+isnull(Febrero2020,0)+isnull(Enero2020,0)+isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AAbril2020= (isnull(Abril2020,0)+isnull(Marzo2020,0)+isnull(Febrero2020,0)+isnull(Enero2020,0)+isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AMayo2020= (isnull(Mayo2020,0)+isnull(Abril2020,0)+isnull(Marzo2020,0)+isnull(Febrero2020,0)+isnull(Enero2020,0)+isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AJunio2020= (isnull(Junio2020,0)+isnull(Mayo2020,0)+isnull(Abril2020,0)+isnull(Marzo2020,0)+isnull(Febrero2020,0)+isnull(Enero2020,0)+isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AJulio2020= (isnull(Julio2020,0)+isnull(Junio2020,0)+isnull(Mayo2020,0)+isnull(Abril2020,0)+isnull(Marzo2020,0)+isnull(Febrero2020,0)+isnull(Enero2020,0)+isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AAgosto2020= (isnull(Agosto2020,0)+isnull(Julio2020,0)+isnull(Junio2020,0)+isnull(Mayo2020,0)+isnull(Abril2020,0)+isnull(Marzo2020,0)+isnull(Febrero2020,0)+isnull(Enero2020,0)+isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
ASeptiembre2020= (isnull(Septiembre2020,0)+isnull(Agosto2020,0)+isnull(Julio2020,0)+isnull(Junio2020,0)+isnull(Mayo2020,0)+isnull(Abril2020,0)+isnull(Marzo2020,0)+isnull(Febrero2020,0)+isnull(Enero2020,0)+isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AOctubre2020= (isnull(Octubre2020,0)+isnull(Septiembre2020,0)+isnull(Agosto2020,0)+isnull(Julio2020,0)+isnull(Junio2020,0)+isnull(Mayo2020,0)+isnull(Abril2020,0)+isnull(Marzo2020,0)+isnull(Febrero2020,0)+isnull(Enero2020,0)+isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
ANoviembre2020= (isnull(Noviembre2020,0)+isnull(Octubre2020,0)+isnull(Septiembre2020,0)+isnull(Agosto2020,0)+isnull(Julio2020,0)+isnull(Junio2020,0)+isnull(Mayo2020,0)+isnull(Abril2020,0)+isnull(Marzo2020,0)+isnull(Febrero2020,0)+isnull(Enero2020,0)+isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
ADiciembre2020= (isnull(Diciembre2020,0)+isnull(Noviembre2020,0)+isnull(Octubre2020,0)+isnull(Septiembre2020,0)+isnull(Agosto2020,0)+isnull(Julio2020,0)+isnull(Junio2020,0)+isnull(Mayo2020,0)+isnull(Abril2020,0)+isnull(Marzo2020,0)+isnull(Febrero2020,0)+isnull(Enero2020,0)+isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AEnero2021= (isnull(Enero2021,0)+isnull(Diciembre2020,0)+isnull(Noviembre2020,0)+isnull(Octubre2020,0)+isnull(Septiembre2020,0)+isnull(Agosto2020,0)+isnull(Julio2020,0)+isnull(Junio2020,0)+isnull(Mayo2020,0)+isnull(Abril2020,0)+isnull(Marzo2020,0)+isnull(Febrero2020,0)+isnull(Enero2020,0)+isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AFebrero2021= (isnull(Febrero2021,0)+isnull(Enero2021,0)+isnull(Diciembre2020,0)+isnull(Noviembre2020,0)+isnull(Octubre2020,0)+isnull(Septiembre2020,0)+isnull(Agosto2020,0)+isnull(Julio2020,0)+isnull(Junio2020,0)+isnull(Mayo2020,0)+isnull(Abril2020,0)+isnull(Marzo2020,0)+isnull(Febrero2020,0)+isnull(Enero2020,0)+isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AMarzo2021= (isnull(Marzo2021,0)+isnull(Febrero2021,0)+isnull(Enero2021,0)+isnull(Diciembre2020,0)+isnull(Noviembre2020,0)+isnull(Octubre2020,0)+isnull(Septiembre2020,0)+isnull(Agosto2020,0)+isnull(Julio2020,0)+isnull(Junio2020,0)+isnull(Mayo2020,0)+isnull(Abril2020,0)+isnull(Marzo2020,0)+isnull(Febrero2020,0)+isnull(Enero2020,0)+isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AAbril2021= (isnull(Abril2021,0)+isnull(Marzo2021,0)+isnull(Febrero2021,0)+isnull(Enero2021,0)+isnull(Diciembre2020,0)+isnull(Noviembre2020,0)+isnull(Octubre2020,0)+isnull(Septiembre2020,0)+isnull(Agosto2020,0)+isnull(Julio2020,0)+isnull(Junio2020,0)+isnull(Mayo2020,0)+isnull(Abril2020,0)+isnull(Marzo2020,0)+isnull(Febrero2020,0)+isnull(Enero2020,0)+isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AMayo2021= (isnull(Mayo2021,0)+isnull(Abril2021,0)+isnull(Marzo2021,0)+isnull(Febrero2021,0)+isnull(Enero2021,0)+isnull(Diciembre2020,0)+isnull(Noviembre2020,0)+isnull(Octubre2020,0)+isnull(Septiembre2020,0)+isnull(Agosto2020,0)+isnull(Julio2020,0)+isnull(Junio2020,0)+isnull(Mayo2020,0)+isnull(Abril2020,0)+isnull(Marzo2020,0)+isnull(Febrero2020,0)+isnull(Enero2020,0)+isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AJunio2021= (isnull(Junio2021,0)+isnull(Mayo2021,0)+isnull(Abril2021,0)+isnull(Marzo2021,0)+isnull(Febrero2021,0)+isnull(Enero2021,0)+isnull(Diciembre2020,0)+isnull(Noviembre2020,0)+isnull(Octubre2020,0)+isnull(Septiembre2020,0)+isnull(Agosto2020,0)+isnull(Julio2020,0)+isnull(Junio2020,0)+isnull(Mayo2020,0)+isnull(Abril2020,0)+isnull(Marzo2020,0)+isnull(Febrero2020,0)+isnull(Enero2020,0)+isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AJulio2021= (isnull(Julio2021,0)+isnull(Junio2021,0)+isnull(Mayo2021,0)+isnull(Abril2021,0)+isnull(Marzo2021,0)+isnull(Febrero2021,0)+isnull(Enero2021,0)+isnull(Diciembre2020,0)+isnull(Noviembre2020,0)+isnull(Octubre2020,0)+isnull(Septiembre2020,0)+isnull(Agosto2020,0)+isnull(Julio2020,0)+isnull(Junio2020,0)+isnull(Mayo2020,0)+isnull(Abril2020,0)+isnull(Marzo2020,0)+isnull(Febrero2020,0)+isnull(Enero2020,0)+isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AAgosto2021= (isnull(Agosto2021,0)+isnull(Julio2021,0)+isnull(Junio2021,0)+isnull(Mayo2021,0)+isnull(Abril2021,0)+isnull(Marzo2021,0)+isnull(Febrero2021,0)+isnull(Enero2021,0)+isnull(Diciembre2020,0)+isnull(Noviembre2020,0)+isnull(Octubre2020,0)+isnull(Septiembre2020,0)+isnull(Agosto2020,0)+isnull(Julio2020,0)+isnull(Junio2020,0)+isnull(Mayo2020,0)+isnull(Abril2020,0)+isnull(Marzo2020,0)+isnull(Febrero2020,0)+isnull(Enero2020,0)+isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
ASeptiembre2021= (isnull(Septiembre2021,0)+isnull(Agosto2021,0)+isnull(Julio2021,0)+isnull(Junio2021,0)+isnull(Mayo2021,0)+isnull(Abril2021,0)+isnull(Marzo2021,0)+isnull(Febrero2021,0)+isnull(Enero2021,0)+isnull(Diciembre2020,0)+isnull(Noviembre2020,0)+isnull(Octubre2020,0)+isnull(Septiembre2020,0)+isnull(Agosto2020,0)+isnull(Julio2020,0)+isnull(Junio2020,0)+isnull(Mayo2020,0)+isnull(Abril2020,0)+isnull(Marzo2020,0)+isnull(Febrero2020,0)+isnull(Enero2020,0)+isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
AOctubre2021= (isnull(Octubre2021,0)+isnull(Septiembre2021,0)+isnull(Agosto2021,0)+isnull(Julio2021,0)+isnull(Junio2021,0)+isnull(Mayo2021,0)+isnull(Abril2021,0)+isnull(Marzo2021,0)+isnull(Febrero2021,0)+isnull(Enero2021,0)+isnull(Diciembre2020,0)+isnull(Noviembre2020,0)+isnull(Octubre2020,0)+isnull(Septiembre2020,0)+isnull(Agosto2020,0)+isnull(Julio2020,0)+isnull(Junio2020,0)+isnull(Mayo2020,0)+isnull(Abril2020,0)+isnull(Marzo2020,0)+isnull(Febrero2020,0)+isnull(Enero2020,0)+isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
ANoviembre2021= (isnull(Noviembre2021,0)+isnull(Octubre2021,0)+isnull(Septiembre2021,0)+isnull(Agosto2021,0)+isnull(Julio2021,0)+isnull(Junio2021,0)+isnull(Mayo2021,0)+isnull(Abril2021,0)+isnull(Marzo2021,0)+isnull(Febrero2021,0)+isnull(Enero2021,0)+isnull(Diciembre2020,0)+isnull(Noviembre2020,0)+isnull(Octubre2020,0)+isnull(Septiembre2020,0)+isnull(Agosto2020,0)+isnull(Julio2020,0)+isnull(Junio2020,0)+isnull(Mayo2020,0)+isnull(Abril2020,0)+isnull(Marzo2020,0)+isnull(Febrero2020,0)+isnull(Enero2020,0)+isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0)),
ADiciembre2021= (isnull(Diciembre2021,0)+isnull(Noviembre2021,0)+isnull(Octubre2021,0)+isnull(Septiembre2021,0)+isnull(Agosto2021,0)+isnull(Julio2021,0)+isnull(Junio2021,0)+isnull(Mayo2021,0)+isnull(Abril2021,0)+isnull(Marzo2021,0)+isnull(Febrero2021,0)+isnull(Enero2021,0)+isnull(Diciembre2020,0)+isnull(Noviembre2020,0)+isnull(Octubre2020,0)+isnull(Septiembre2020,0)+isnull(Agosto2020,0)+isnull(Julio2020,0)+isnull(Junio2020,0)+isnull(Mayo2020,0)+isnull(Abril2020,0)+isnull(Marzo2020,0)+isnull(Febrero2020,0)+isnull(Enero2020,0)+isnull(Diciembre2019,0)+isnull(Noviembre2019,0)+isnull(Octubre2019,0)+isnull(Septiembre2019,0)+isnull(Agosto2019,0)+isnull(Julio2019,0)+isnull(Junio2019,0)+isnull(Mayo2019,0)+isnull(Abril2019,0)+isnull(Marzo2019,0)+isnull(Febrero2019,0)+isnull(Enero2019,0)+isnull(Diciembre2018,0)+isnull(Noviembre2018,0)+isnull(Octubre2018,0)+isnull(Septiembre2018,0)+isnull(Agosto2018,0)+isnull(Julio2018,0)+isnull(Junio2018,0)+isnull(Mayo2018,0)+isnull(Abril2018,0)+isnull(Marzo2018,0)+isnull(Febrero2018,0)+isnull(Enero2018,0)+isnull(Diciembre2017,0)+isnull(Noviembre2017,0)+isnull(Octubre2017,0)+isnull(Septiembre2017,0)+isnull(Agosto2017,0)+isnull(Julio2017,0)+isnull(Junio2017,0)+isnull(Mayo2017,0)+isnull(Abril2017,0)+isnull(Marzo2017,0)+isnull(Febrero2017,0)+isnull(Enero2017,0)+isnull(Diciembre2016,0)+isnull(Noviembre2016,0)+isnull(Octubre2016,0)+isnull(Septiembre2016,0)+isnull(Agosto2016,0)+isnull(Julio2016,0)+isnull(Junio2016,0)+isnull(Mayo2016,0)+isnull(Abril2016,0)+isnull(Marzo2016,0)+isnull(Febrero2016,0)+isnull(Enero2016,0)+isnull(Diciembre2015,0)+isnull(Noviembre2015,0)+isnull(Octubre2015,0)+isnull(Septiembre2015,0)+isnull(Agosto2015,0)+isnull(Julio2015,0)+isnull(Junio2015,0)+isnull(Mayo2015,0)+isnull(Abril2015,0)+isnull(Marzo2015,0)+isnull(Febrero2015,0)+isnull(Enero2015,0))

 
 FROM (
--CALCULO TOTAL EN TOTAL COSTOS SSL

SELECT ORDEN=35, CTA_AUXILIAR_2='TOTAL COSTOS SSL' , 
SUM(Enero2015) as Enero2015,
SUM(Febrero2015) as Febrero2015,
SUM(Marzo2015) as Marzo2015,
SUM(Abril2015) as Abril2015,
SUM(Mayo2015) as Mayo2015,
SUM(Junio2015) as Junio2015,
SUM(Julio2015) as Julio2015,
SUM(Agosto2015) as Agosto2015,
SUM(Septiembre2015) as Septiembre2015,
SUM(Octubre2015) as Octubre2015,
SUM(Noviembre2015) as Noviembre2015,
SUM(Diciembre2015) as Diciembre2015,
SUM(Enero2016) as Enero2016,
SUM(Febrero2016) as Febrero2016,
SUM(Marzo2016) as Marzo2016,
SUM(Abril2016) as Abril2016,
SUM(Mayo2016) as Mayo2016,
SUM(Junio2016) as Junio2016,
SUM(Julio2016) as Julio2016,
SUM(Agosto2016) as Agosto2016,
SUM(Septiembre2016) as Septiembre2016,
SUM(Octubre2016) as Octubre2016,
SUM(Noviembre2016) as Noviembre2016,
SUM(Diciembre2016) as Diciembre2016,
SUM(Enero2017) as Enero2017,
SUM(Febrero2017) as Febrero2017,
SUM(Marzo2017) as Marzo2017,
SUM(Abril2017) as Abril2017,
SUM(Mayo2017) as Mayo2017,
SUM(Junio2017) as Junio2017,
SUM(Julio2017) as Julio2017,
SUM(Agosto2017) as Agosto2017,
SUM(Septiembre2017) as Septiembre2017,
SUM(Octubre2017) as Octubre2017,
SUM(Noviembre2017) as Noviembre2017,
SUM(Diciembre2017) as Diciembre2017,
SUM(Enero2018) as Enero2018,
SUM(Febrero2018) as Febrero2018,
SUM(Marzo2018) as Marzo2018,
SUM(Abril2018) as Abril2018,
SUM(Mayo2018) as Mayo2018,
SUM(Junio2018) as Junio2018,
SUM(Julio2018) as Julio2018,
SUM(Agosto2018) as Agosto2018,
SUM(Septiembre2018) as Septiembre2018,
SUM(Octubre2018) as Octubre2018,
SUM(Noviembre2018) as Noviembre2018,
SUM(Diciembre2018) as Diciembre2018,
SUM(Enero2019) as Enero2019,
SUM(Febrero2019) as Febrero2019,
SUM(Marzo2019) as Marzo2019,
SUM(Abril2019) as Abril2019,
SUM(Mayo2019) as Mayo2019,
SUM(Junio2019) as Junio2019,
SUM(Julio2019) as Julio2019,
SUM(Agosto2019) as Agosto2019,
SUM(Septiembre2019) as Septiembre2019,
SUM(Octubre2019) as Octubre2019,
SUM(Noviembre2019) as Noviembre2019,
SUM(Diciembre2019) as Diciembre2019,
SUM(Enero2020) as Enero2020,
SUM(Febrero2020) as Febrero2020,
SUM(Marzo2020) as Marzo2020,
SUM(Abril2020) as Abril2020,
SUM(Mayo2020) as Mayo2020,
SUM(Junio2020) as Junio2020,
SUM(Julio2020) as Julio2020,
SUM(Agosto2020) as Agosto2020,
SUM(Septiembre2020) as Septiembre2020,
SUM(Octubre2020) as Octubre2020,
SUM(Noviembre2020) as Noviembre2020,
SUM(Diciembre2020) as Diciembre2020,
SUM(Enero2021) as Enero2021,
SUM(Febrero2021) as Febrero2021,
SUM(Marzo2021) as Marzo2021,
SUM(Abril2021) as Abril2021,
SUM(Mayo2021) as Mayo2021,
SUM(Junio2021) as Junio2021,
SUM(Julio2021) as Julio2021,
SUM(Agosto2021) as Agosto2021,
SUM(Septiembre2021) as Septiembre2021,
SUM(Octubre2021) as Octubre2021,
SUM(Noviembre2021) as Noviembre2021,
SUM(Diciembre2021) as Diciembre2021,
SUM(Enero2022) as Enero2022,
SUM(Febrero2022) as Febrero2022,
SUM(Marzo2022) as Marzo2022,
SUM(Abril2022) as Abril2022,
SUM(Mayo2022) as Mayo2022,
SUM(Junio2022) as Junio2022,
SUM(Julio2022) as Julio2022,
SUM(Agosto2022) as Agosto2022,
SUM(Septiembre2022) as Septiembre2022,
SUM(Octubre2022) as Octubre2022,
SUM(Noviembre2022) as Noviembre2022,
SUM(Diciembre2022) as Diciembre2022,
SUM(Total) as Total

FROM (

SELECT ORDEN,CTA_AUXILIAR_2,
                            isnull(PivotTable.[201501],0) as Enero2015,
                            isnull(PivotTable.[201502],0) as Febrero2015,
                            isnull(PivotTable.[201503],0) as Marzo2015,
                            isnull(PivotTable.[201504],0) as Abril2015,
                            isnull(PivotTable.[201505],0) as Mayo2015,
                            isnull(PivotTable.[201506],0) as Junio2015,
                            isnull(PivotTable.[201507],0) as Julio2015,
                            isnull(PivotTable.[201508],0) as Agosto2015,
                            isnull(PivotTable.[201509],0) as Septiembre2015,
                            isnull(PivotTable.[201510],0) as Octubre2015,
                            isnull(PivotTable.[201511],0) as Noviembre2015,
                            isnull(PivotTable.[201512],0) as Diciembre2015,
                            isnull(PivotTable.[201601],0) as Enero2016,
                            isnull(PivotTable.[201602],0) as Febrero2016,
                            isnull(PivotTable.[201603],0) as Marzo2016,
                            isnull(PivotTable.[201604],0) as Abril2016,
                            isnull(PivotTable.[201605],0) as Mayo2016,
                            isnull(PivotTable.[201606],0) as Junio2016,
                            isnull(PivotTable.[201607],0) as Julio2016,
                            isnull(PivotTable.[201608],0) as Agosto2016,
                            isnull(PivotTable.[201609],0) as Septiembre2016,
                            isnull(PivotTable.[201610],0) as Octubre2016,
                            isnull(PivotTable.[201611],0) as Noviembre2016,
                            isnull(PivotTable.[201612],0) as Diciembre2016,
                            isnull(PivotTable.[201701],0) as Enero2017,
                            isnull(PivotTable.[201702],0) as Febrero2017,
                            isnull(PivotTable.[201703],0) as Marzo2017,
                            isnull(PivotTable.[201704],0) as Abril2017,
                            isnull(PivotTable.[201705],0) as Mayo2017,
                            isnull(PivotTable.[201706],0) as Junio2017,
                            isnull(PivotTable.[201707],0) as Julio2017,
                            isnull(PivotTable.[201708],0) as Agosto2017,
                            isnull(PivotTable.[201709],0) as Septiembre2017,
                            isnull(PivotTable.[201710],0) as Octubre2017,
                            isnull(PivotTable.[201711],0) as Noviembre2017,
                            isnull(PivotTable.[201712],0) as Diciembre2017,
                            isnull(PivotTable.[201801],0) as Enero2018,
                            isnull(PivotTable.[201802],0) as Febrero2018,
                            isnull(PivotTable.[201803],0) as Marzo2018,
                            isnull(PivotTable.[201804],0) as Abril2018,
                            isnull(PivotTable.[201805],0) as Mayo2018,
                            isnull(PivotTable.[201806],0) as Junio2018,
                            isnull(PivotTable.[201807],0) as Julio2018,
                            isnull(PivotTable.[201808],0) as Agosto2018,
                            isnull(PivotTable.[201809],0) as Septiembre2018,
                            isnull(PivotTable.[201810],0) as Octubre2018,
                            isnull(PivotTable.[201811],0) as Noviembre2018,
                            isnull(PivotTable.[201812],0) as Diciembre2018,
                            isnull(PivotTable.[201901],0) as Enero2019,
                            isnull(PivotTable.[201902],0) as Febrero2019,
                            isnull(PivotTable.[201903],0) as Marzo2019,
                            isnull(PivotTable.[201904],0) as Abril2019,
                            isnull(PivotTable.[201905],0) as Mayo2019,
                            isnull(PivotTable.[201906],0) as Junio2019,
                            isnull(PivotTable.[201907],0) as Julio2019,
                            isnull(PivotTable.[201908],0) as Agosto2019,
                            isnull(PivotTable.[201909],0) as Septiembre2019,
                            isnull(PivotTable.[201910],0) as Octubre2019,
                            isnull(PivotTable.[201911],0) as Noviembre2019,
                            isnull(PivotTable.[201912],0) as Diciembre2019,
                            isnull(PivotTable.[202001],0) as Enero2020,
                            isnull(PivotTable.[202002],0) as Febrero2020,
                            isnull(PivotTable.[202003],0) as Marzo2020,
                            isnull(PivotTable.[202004],0) as Abril2020,
                            isnull(PivotTable.[202005],0) as Mayo2020,
                            isnull(PivotTable.[202006],0) as Junio2020,
                            isnull(PivotTable.[202007],0) as Julio2020,
                            isnull(PivotTable.[202008],0) as Agosto2020,
                            isnull(PivotTable.[202009],0) as Septiembre2020,
                            isnull(PivotTable.[202010],0) as Octubre2020,
                            isnull(PivotTable.[202011],0) as Noviembre2020,
                            isnull(PivotTable.[202012],0) as Diciembre2020,
                            isnull(PivotTable.[202101],0) as Enero2021,
                            isnull(PivotTable.[202102],0) as Febrero2021,
                            isnull(PivotTable.[202103],0) as Marzo2021,
                            isnull(PivotTable.[202104],0) as Abril2021,
                            isnull(PivotTable.[202105],0) as Mayo2021,
                            isnull(PivotTable.[202106],0) as Junio2021,
                            isnull(PivotTable.[202107],0) as Julio2021,
                            isnull(PivotTable.[202108],0) as Agosto2021,
                            isnull(PivotTable.[202109],0) as Septiembre2021,
                            isnull(PivotTable.[202110],0) as Octubre2021,
                            isnull(PivotTable.[202111],0) as Noviembre2021,
                            isnull(PivotTable.[202112],0) as Diciembre2021,
                            isnull(PivotTable.[202201],0) as Enero2022,
                            isnull(PivotTable.[202202],0) as Febrero2022,
                            isnull(PivotTable.[202203],0) as Marzo2022,
                            isnull(PivotTable.[202204],0) as Abril2022,
                            isnull(PivotTable.[202205],0) as Mayo2022,
                            isnull(PivotTable.[202206],0) as Junio2022,
                            isnull(PivotTable.[202207],0) as Julio2022,
                            isnull(PivotTable.[202208],0) as Agosto2022,
                            isnull(PivotTable.[202209],0) as Septiembre2022,
                            isnull(PivotTable.[202210],0) as Octubre2022,
                            isnull(PivotTable.[202211],0) as Noviembre2022,
                            isnull(PivotTable.[202212],0) as Diciembre2022,
                            Total= (
                            isnull(PivotTable.[201501],0)+
        isnull(PivotTable.[201502],0)+
        isnull(PivotTable.[201503],0)+
        isnull(PivotTable.[201504],0)+
        isnull(PivotTable.[201505],0)+
        isnull(PivotTable.[201506],0)+
        isnull(PivotTable.[201507],0)+
        isnull(PivotTable.[201508],0)+
        isnull(PivotTable.[201509],0)+
        isnull(PivotTable.[201510],0)+
        isnull(PivotTable.[201511],0)+
        isnull(PivotTable.[201512],0)+
        isnull(PivotTable.[201601],0)+
        isnull(PivotTable.[201602],0)+
        isnull(PivotTable.[201603],0)+
        isnull(PivotTable.[201604],0)+
        isnull(PivotTable.[201605],0)+
        isnull(PivotTable.[201606],0)+
        isnull(PivotTable.[201607],0)+
        isnull(PivotTable.[201608],0)+
        isnull(PivotTable.[201609],0)+
        isnull(PivotTable.[201610],0)+
        isnull(PivotTable.[201611],0)+
        isnull(PivotTable.[201612],0)+
        isnull(PivotTable.[201701],0)+
        isnull(PivotTable.[201702],0)+
        isnull(PivotTable.[201703],0)+
        isnull(PivotTable.[201704],0)+
        isnull(PivotTable.[201705],0)+
        isnull(PivotTable.[201706],0)+
        isnull(PivotTable.[201707],0)+
        isnull(PivotTable.[201708],0)+
        isnull(PivotTable.[201709],0)+
        isnull(PivotTable.[201710],0)+
        isnull(PivotTable.[201711],0)+
        isnull(PivotTable.[201712],0)+
        isnull(PivotTable.[201801],0)+
        isnull(PivotTable.[201802],0)+
        isnull(PivotTable.[201803],0)+
        isnull(PivotTable.[201804],0)+
        isnull(PivotTable.[201805],0)+
        isnull(PivotTable.[201806],0)+
        isnull(PivotTable.[201807],0)+
        isnull(PivotTable.[201808],0)+
        isnull(PivotTable.[201809],0)+
        isnull(PivotTable.[201810],0)+
        isnull(PivotTable.[201811],0)+
        isnull(PivotTable.[201812],0)+
        isnull(PivotTable.[201901],0)+
        isnull(PivotTable.[201902],0)+
        isnull(PivotTable.[201903],0)+
        isnull(PivotTable.[201904],0)+
        isnull(PivotTable.[201905],0)+
        isnull(PivotTable.[201906],0)+
        isnull(PivotTable.[201907],0)+
        isnull(PivotTable.[201908],0)+
        isnull(PivotTable.[201909],0)+
        isnull(PivotTable.[201910],0)+
        isnull(PivotTable.[201911],0)+
        isnull(PivotTable.[201912],0)+
        isnull(PivotTable.[202001],0)+
        isnull(PivotTable.[202002],0)+
        isnull(PivotTable.[202003],0)+
        isnull(PivotTable.[202004],0)+
        isnull(PivotTable.[202005],0)+
        isnull(PivotTable.[202006],0)+
        isnull(PivotTable.[202007],0)+
        isnull(PivotTable.[202008],0)+
        isnull(PivotTable.[202009],0)+
        isnull(PivotTable.[202010],0)+
        isnull(PivotTable.[202011],0)+
        isnull(PivotTable.[202012],0)+
        isnull(PivotTable.[202101],0)+
        isnull(PivotTable.[202102],0)+
        isnull(PivotTable.[202103],0)+
        isnull(PivotTable.[202104],0)+
        isnull(PivotTable.[202105],0)+
        isnull(PivotTable.[202106],0)+
        isnull(PivotTable.[202107],0)+
        isnull(PivotTable.[202108],0)+
        isnull(PivotTable.[202109],0)+
        isnull(PivotTable.[202110],0)+
        isnull(PivotTable.[202111],0)+
        isnull(PivotTable.[202112],0)+
		isnull(PivotTable.[202201],0)+
		isnull(PivotTable.[202202],0)+
		isnull(PivotTable.[202203],0)+
		isnull(PivotTable.[202204],0)+
		isnull(PivotTable.[202205],0)+
		isnull(PivotTable.[202206],0)+
		isnull(PivotTable.[202207],0)+
		isnull(PivotTable.[202208],0)+
		isnull(PivotTable.[202209],0)+
		isnull(PivotTable.[202210],0)+
		isnull(PivotTable.[202211],0)+
		isnull(PivotTable.[202212],0)

                            )


FROM
(
  select  ORDEN=29,CTA_AUXILIAR_2 ='COSTO NETO OTROS SSL',  ANIOMES, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras()
  WHERE AÑO BETWEEN $AniIni AND $AniFin AND NMES BETWEEN $MesIni AND $MesFin AND CTA_AUXILIAR_2 NOT IN ('TEMPORALES') AND EMPRESA='EJECUTADO' AND AREA like '%%'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS')  
        
GROUP BY ORDEN,CTA_AUXILIAR_2,ANIOMES 
) AS SourceTable 

PIVOT(SUM(NETO) FOR ANIOMES IN([201501],
[201502],
[201503],
[201504],
[201505],
[201506],
[201507],
[201508],
[201509],
[201510],
[201511],
[201512],
[201601],
[201602],
[201603],
[201604],
[201605],
[201606],
[201607],
[201608],
[201609],
[201610],
[201611],
[201612],
[201701],
[201702],
[201703],
[201704],
[201705],
[201706],
[201707],
[201708],
[201709],
[201710],
[201711],
[201712],
[201801],
[201802],
[201803],
[201804],
[201805],
[201806],
[201807],
[201808],
[201809],
[201810],
[201811],
[201812],
[201901],
[201902],
[201903],
[201904],
[201905],
[201906],
[201907],
[201908],
[201909],
[201910],
[201911],
[201912],
[202001],
[202002],
[202003],
[202004],
[202005],
[202006],
[202007],
[202008],
[202009],
[202010],
[202011],
[202012],
[202101],
[202102],
[202103],
[202104],
[202105],
[202106],
[202107],
[202108],
[202109],
[202110],
[202111],
[202112],
[202201],
[202202],
[202203],
[202204],
[202205],
[202206],
[202207],
[202208],
[202209],
[202210],
[202211],
[202212]
)) AS PivotTable

UNION ALL


SELECT ORDEN,CTA_AUXILIAR_2,
                            PivotTable.[201501] as Enero2015,
                            PivotTable.[201502] as Febrero2015,
                            PivotTable.[201503] as Marzo2015,
                            PivotTable.[201504] as Abril2015,
                            PivotTable.[201505] as Mayo2015,
                            PivotTable.[201506] as Junio2015,
                            PivotTable.[201507] as Julio2015,
                            PivotTable.[201508] as Agosto2015,
                            PivotTable.[201509] as Septiembre2015,
                            PivotTable.[201510] as Octubre2015,
                            PivotTable.[201511] as Noviembre2015,
                            PivotTable.[201512] as Diciembre2015,
                            PivotTable.[201601] as Enero2016,
                            PivotTable.[201602] as Febrero2016,
                            PivotTable.[201603] as Marzo2016,
                            PivotTable.[201604] as Abril2016,
                            PivotTable.[201605] as Mayo2016,
                            PivotTable.[201606] as Junio2016,
                            PivotTable.[201607] as Julio2016,
                            PivotTable.[201608] as Agosto2016,
                            PivotTable.[201609] as Septiembre2016,
                            PivotTable.[201610] as Octubre2016,
                            PivotTable.[201611] as Noviembre2016,
                            PivotTable.[201612] as Diciembre2016,
                            PivotTable.[201701] as Enero2017,
                            PivotTable.[201702] as Febrero2017,
                            PivotTable.[201703] as Marzo2017,
                            PivotTable.[201704] as Abril2017,
                            PivotTable.[201705] as Mayo2017,
                            PivotTable.[201706] as Junio2017,
                            PivotTable.[201707] as Julio2017,
                            PivotTable.[201708] as Agosto2017,
                            PivotTable.[201709] as Septiembre2017,
                            PivotTable.[201710] as Octubre2017,
                            PivotTable.[201711] as Noviembre2017,
                            PivotTable.[201712] as Diciembre2017,
                            PivotTable.[201801] as Enero2018,
                            PivotTable.[201802] as Febrero2018,
                            PivotTable.[201803] as Marzo2018,
                            PivotTable.[201804] as Abril2018,
                            PivotTable.[201805] as Mayo2018,
                            PivotTable.[201806] as Junio2018,
                            PivotTable.[201807] as Julio2018,
                            PivotTable.[201808] as Agosto2018,
                            PivotTable.[201809] as Septiembre2018,
                            PivotTable.[201810] as Octubre2018,
                            PivotTable.[201811] as Noviembre2018,
                            PivotTable.[201812] as Diciembre2018,
                            PivotTable.[201901] as Enero2019,
                            PivotTable.[201902] as Febrero2019,
                            PivotTable.[201903] as Marzo2019,
                            PivotTable.[201904] as Abril2019,
                            PivotTable.[201905] as Mayo2019,
                            PivotTable.[201906] as Junio2019,
                            PivotTable.[201907] as Julio2019,
                            PivotTable.[201908] as Agosto2019,
                            PivotTable.[201909] as Septiembre2019,
                            PivotTable.[201910] as Octubre2019,
                            PivotTable.[201911] as Noviembre2019,
                            PivotTable.[201912] as Diciembre2019,
                            PivotTable.[202001] as Enero2020,
                            PivotTable.[202002] as Febrero2020,
                            PivotTable.[202003] as Marzo2020,
                            PivotTable.[202004] as Abril2020,
                            PivotTable.[202005] as Mayo2020,
                            PivotTable.[202006] as Junio2020,
                            PivotTable.[202007] as Julio2020,
                            PivotTable.[202008] as Agosto2020,
                            PivotTable.[202009] as Septiembre2020,
                            PivotTable.[202010] as Octubre2020,
                            PivotTable.[202011] as Noviembre2020,
                            PivotTable.[202012] as Diciembre2020,
                            PivotTable.[202101] as Enero2021,
                            PivotTable.[202102] as Febrero2021,
                            PivotTable.[202103] as Marzo2021,
                            PivotTable.[202104] as Abril2021,
                            PivotTable.[202105] as Mayo2021,
                            PivotTable.[202106] as Junio2021,
                            PivotTable.[202107] as Julio2021,
                            PivotTable.[202108] as Agosto2021,
                            PivotTable.[202109] as Septiembre2021,
                            PivotTable.[202110] as Octubre2021,
                            PivotTable.[202111] as Noviembre2021,
                                                        PivotTable.[202112] as Diciembre2021,
                            PivotTable.[202201] as Enero2022,
                            PivotTable.[202202] as Febrero2022,
                            PivotTable.[202203] as Marzo2022,
                            PivotTable.[202204] as Abril2022,
                            PivotTable.[202205] as Mayo2022,
                            PivotTable.[202206] as Junio2022,
                            PivotTable.[202207] as Julio2022,
                            PivotTable.[202208] as Agosto2022,
                            PivotTable.[202209] as Septiembre2022,
                            PivotTable.[202210] as Octubre2022,
                            PivotTable.[202211] as Noviembre2022,
                            PivotTable.[202212] as Diciembre2022,
                            Total= (
                            isnull(PivotTable.[201501],0)+
isnull(PivotTable.[201502],0)+
isnull(PivotTable.[201503],0)+
isnull(PivotTable.[201504],0)+
isnull(PivotTable.[201505],0)+
isnull(PivotTable.[201506],0)+
isnull(PivotTable.[201507],0)+
isnull(PivotTable.[201508],0)+
isnull(PivotTable.[201509],0)+
isnull(PivotTable.[201510],0)+
isnull(PivotTable.[201511],0)+
isnull(PivotTable.[201512],0)+
isnull(PivotTable.[201601],0)+
isnull(PivotTable.[201602],0)+
isnull(PivotTable.[201603],0)+
isnull(PivotTable.[201604],0)+
isnull(PivotTable.[201605],0)+
isnull(PivotTable.[201606],0)+
isnull(PivotTable.[201607],0)+
isnull(PivotTable.[201608],0)+
isnull(PivotTable.[201609],0)+
isnull(PivotTable.[201610],0)+
isnull(PivotTable.[201611],0)+
isnull(PivotTable.[201612],0)+
isnull(PivotTable.[201701],0)+
isnull(PivotTable.[201702],0)+
isnull(PivotTable.[201703],0)+
isnull(PivotTable.[201704],0)+
isnull(PivotTable.[201705],0)+
isnull(PivotTable.[201706],0)+
isnull(PivotTable.[201707],0)+
isnull(PivotTable.[201708],0)+
isnull(PivotTable.[201709],0)+
isnull(PivotTable.[201710],0)+
isnull(PivotTable.[201711],0)+
isnull(PivotTable.[201712],0)+
isnull(PivotTable.[201801],0)+
isnull(PivotTable.[201802],0)+
isnull(PivotTable.[201803],0)+
isnull(PivotTable.[201804],0)+
isnull(PivotTable.[201805],0)+
isnull(PivotTable.[201806],0)+
isnull(PivotTable.[201807],0)+
isnull(PivotTable.[201808],0)+
isnull(PivotTable.[201809],0)+
isnull(PivotTable.[201810],0)+
isnull(PivotTable.[201811],0)+
isnull(PivotTable.[201812],0)+
isnull(PivotTable.[201901],0)+
isnull(PivotTable.[201902],0)+
isnull(PivotTable.[201903],0)+
isnull(PivotTable.[201904],0)+
isnull(PivotTable.[201905],0)+
isnull(PivotTable.[201906],0)+
isnull(PivotTable.[201907],0)+
isnull(PivotTable.[201908],0)+
isnull(PivotTable.[201909],0)+
isnull(PivotTable.[201910],0)+
isnull(PivotTable.[201911],0)+
isnull(PivotTable.[201912],0)+
isnull(PivotTable.[202001],0)+
isnull(PivotTable.[202002],0)+
isnull(PivotTable.[202003],0)+
isnull(PivotTable.[202004],0)+
isnull(PivotTable.[202005],0)+
isnull(PivotTable.[202006],0)+
isnull(PivotTable.[202007],0)+
isnull(PivotTable.[202008],0)+
isnull(PivotTable.[202009],0)+
isnull(PivotTable.[202010],0)+
isnull(PivotTable.[202011],0)+
isnull(PivotTable.[202012],0)+
isnull(PivotTable.[202101],0)+
isnull(PivotTable.[202102],0)+
isnull(PivotTable.[202103],0)+
isnull(PivotTable.[202104],0)+
isnull(PivotTable.[202105],0)+
isnull(PivotTable.[202106],0)+
isnull(PivotTable.[202107],0)+
isnull(PivotTable.[202108],0)+
isnull(PivotTable.[202109],0)+
isnull(PivotTable.[202110],0)+
isnull(PivotTable.[202111],0)+
	    isnull(PivotTable.[202112],0)+
		isnull(PivotTable.[202201],0)+
		isnull(PivotTable.[202202],0)+
		isnull(PivotTable.[202203],0)+
		isnull(PivotTable.[202204],0)+
		isnull(PivotTable.[202205],0)+
		isnull(PivotTable.[202206],0)+
		isnull(PivotTable.[202207],0)+
		isnull(PivotTable.[202208],0)+
		isnull(PivotTable.[202209],0)+
		isnull(PivotTable.[202210],0)+
		isnull(PivotTable.[202211],0)+
		isnull(PivotTable.[202212],0)

                            )


FROM
(
  select  ORDEN = 30 ,CTA_AUXILIAR_2 ='DPTO. DE SEGURIDAD Y SALUD LABORAL',  ANIOMES, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras2()
 WHERE AÑO BETWEEN $AniIni AND $AniFin AND NMES BETWEEN $MesIni AND $MesFin AND EMPRESA='EJECUTADO' AND AREA like '%%' AND CC_MAYOR='6 - ADMINISTRACION' AND CENTRO_DE_COSTO='60228-SEGURIDAD Y SALUD LABORAL'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND CTA_AUXILIAR NOT IN ('511025 - ASESORIA JURIDICA','511095 - OTROS - HONORARIOS')
        
GROUP BY ORDEN,CTA_AUXILIAR_2,ANIOMES 
) AS SourceTable 

PIVOT(SUM(NETO) FOR ANIOMES IN([201501],
[201502],
[201503],
[201504],
[201505],
[201506],
[201507],
[201508],
[201509],
[201510],
[201511],
[201512],
[201601],
[201602],
[201603],
[201604],
[201605],
[201606],
[201607],
[201608],
[201609],
[201610],
[201611],
[201612],
[201701],
[201702],
[201703],
[201704],
[201705],
[201706],
[201707],
[201708],
[201709],
[201710],
[201711],
[201712],
[201801],
[201802],
[201803],
[201804],
[201805],
[201806],
[201807],
[201808],
[201809],
[201810],
[201811],
[201812],
[201901],
[201902],
[201903],
[201904],
[201905],
[201906],
[201907],
[201908],
[201909],
[201910],
[201911],
[201912],
[202001],
[202002],
[202003],
[202004],
[202005],
[202006],
[202007],
[202008],
[202009],
[202010],
[202011],
[202012],
[202101],
[202102],
[202103],
[202104],
[202105],
[202106],
[202107],
[202108],
[202109],
[202110],
[202111],
[202112],
[202201],
[202202],
[202203],
[202204],
[202205],
[202206],
[202207],
[202208],
[202209],
[202210],
[202211],
[202212]
)) AS PivotTable

UNION ALL

SELECT ORDEN,CTA_AUXILIAR_2,
                            PivotTable.[201501] as Enero2015,
                            PivotTable.[201502] as Febrero2015,
                            PivotTable.[201503] as Marzo2015,
                            PivotTable.[201504] as Abril2015,
                            PivotTable.[201505] as Mayo2015,
                            PivotTable.[201506] as Junio2015,
                            PivotTable.[201507] as Julio2015,
                            PivotTable.[201508] as Agosto2015,
                            PivotTable.[201509] as Septiembre2015,
                            PivotTable.[201510] as Octubre2015,
                            PivotTable.[201511] as Noviembre2015,
                            PivotTable.[201512] as Diciembre2015,
                            PivotTable.[201601] as Enero2016,
                            PivotTable.[201602] as Febrero2016,
                            PivotTable.[201603] as Marzo2016,
                            PivotTable.[201604] as Abril2016,
                            PivotTable.[201605] as Mayo2016,
                            PivotTable.[201606] as Junio2016,
                            PivotTable.[201607] as Julio2016,
                            PivotTable.[201608] as Agosto2016,
                            PivotTable.[201609] as Septiembre2016,
                            PivotTable.[201610] as Octubre2016,
                            PivotTable.[201611] as Noviembre2016,
                            PivotTable.[201612] as Diciembre2016,
                            PivotTable.[201701] as Enero2017,
                            PivotTable.[201702] as Febrero2017,
                            PivotTable.[201703] as Marzo2017,
                            PivotTable.[201704] as Abril2017,
                            PivotTable.[201705] as Mayo2017,
                            PivotTable.[201706] as Junio2017,
                            PivotTable.[201707] as Julio2017,
                            PivotTable.[201708] as Agosto2017,
                            PivotTable.[201709] as Septiembre2017,
                            PivotTable.[201710] as Octubre2017,
                            PivotTable.[201711] as Noviembre2017,
                            PivotTable.[201712] as Diciembre2017,
                            PivotTable.[201801] as Enero2018,
                            PivotTable.[201802] as Febrero2018,
                            PivotTable.[201803] as Marzo2018,
                            PivotTable.[201804] as Abril2018,
                            PivotTable.[201805] as Mayo2018,
                            PivotTable.[201806] as Junio2018,
                            PivotTable.[201807] as Julio2018,
                            PivotTable.[201808] as Agosto2018,
                            PivotTable.[201809] as Septiembre2018,
                            PivotTable.[201810] as Octubre2018,
                            PivotTable.[201811] as Noviembre2018,
                            PivotTable.[201812] as Diciembre2018,
                            PivotTable.[201901] as Enero2019,
                            PivotTable.[201902] as Febrero2019,
                            PivotTable.[201903] as Marzo2019,
                            PivotTable.[201904] as Abril2019,
                            PivotTable.[201905] as Mayo2019,
                            PivotTable.[201906] as Junio2019,
                            PivotTable.[201907] as Julio2019,
                            PivotTable.[201908] as Agosto2019,
                            PivotTable.[201909] as Septiembre2019,
                            PivotTable.[201910] as Octubre2019,
                            PivotTable.[201911] as Noviembre2019,
                            PivotTable.[201912] as Diciembre2019,
                            PivotTable.[202001] as Enero2020,
                            PivotTable.[202002] as Febrero2020,
                            PivotTable.[202003] as Marzo2020,
                            PivotTable.[202004] as Abril2020,
                            PivotTable.[202005] as Mayo2020,
                            PivotTable.[202006] as Junio2020,
                            PivotTable.[202007] as Julio2020,
                            PivotTable.[202008] as Agosto2020,
                            PivotTable.[202009] as Septiembre2020,
                            PivotTable.[202010] as Octubre2020,
                            PivotTable.[202011] as Noviembre2020,
                            PivotTable.[202012] as Diciembre2020,
                            PivotTable.[202101] as Enero2021,
                            PivotTable.[202102] as Febrero2021,
                            PivotTable.[202103] as Marzo2021,
                            PivotTable.[202104] as Abril2021,
                            PivotTable.[202105] as Mayo2021,
                            PivotTable.[202106] as Junio2021,
                            PivotTable.[202107] as Julio2021,
                            PivotTable.[202108] as Agosto2021,
                            PivotTable.[202109] as Septiembre2021,
                            PivotTable.[202110] as Octubre2021,
                            PivotTable.[202111] as Noviembre2021,
                                                        PivotTable.[202112] as Diciembre2021,
                            PivotTable.[202201] as Enero2022,
                            PivotTable.[202202] as Febrero2022,
                            PivotTable.[202203] as Marzo2022,
                            PivotTable.[202204] as Abril2022,
                            PivotTable.[202205] as Mayo2022,
                            PivotTable.[202206] as Junio2022,
                            PivotTable.[202207] as Julio2022,
                            PivotTable.[202208] as Agosto2022,
                            PivotTable.[202209] as Septiembre2022,
                            PivotTable.[202210] as Octubre2022,
                            PivotTable.[202211] as Noviembre2022,
                            PivotTable.[202212] as Diciembre2022,
                            Total= (
                            isnull(PivotTable.[201501],0)+
isnull(PivotTable.[201502],0)+
isnull(PivotTable.[201503],0)+
isnull(PivotTable.[201504],0)+
isnull(PivotTable.[201505],0)+
isnull(PivotTable.[201506],0)+
isnull(PivotTable.[201507],0)+
isnull(PivotTable.[201508],0)+
isnull(PivotTable.[201509],0)+
isnull(PivotTable.[201510],0)+
isnull(PivotTable.[201511],0)+
isnull(PivotTable.[201512],0)+
isnull(PivotTable.[201601],0)+
isnull(PivotTable.[201602],0)+
isnull(PivotTable.[201603],0)+
isnull(PivotTable.[201604],0)+
isnull(PivotTable.[201605],0)+
isnull(PivotTable.[201606],0)+
isnull(PivotTable.[201607],0)+
isnull(PivotTable.[201608],0)+
isnull(PivotTable.[201609],0)+
isnull(PivotTable.[201610],0)+
isnull(PivotTable.[201611],0)+
isnull(PivotTable.[201612],0)+
isnull(PivotTable.[201701],0)+
isnull(PivotTable.[201702],0)+
isnull(PivotTable.[201703],0)+
isnull(PivotTable.[201704],0)+
isnull(PivotTable.[201705],0)+
isnull(PivotTable.[201706],0)+
isnull(PivotTable.[201707],0)+
isnull(PivotTable.[201708],0)+
isnull(PivotTable.[201709],0)+
isnull(PivotTable.[201710],0)+
isnull(PivotTable.[201711],0)+
isnull(PivotTable.[201712],0)+
isnull(PivotTable.[201801],0)+
isnull(PivotTable.[201802],0)+
isnull(PivotTable.[201803],0)+
isnull(PivotTable.[201804],0)+
isnull(PivotTable.[201805],0)+
isnull(PivotTable.[201806],0)+
isnull(PivotTable.[201807],0)+
isnull(PivotTable.[201808],0)+
isnull(PivotTable.[201809],0)+
isnull(PivotTable.[201810],0)+
isnull(PivotTable.[201811],0)+
isnull(PivotTable.[201812],0)+
isnull(PivotTable.[201901],0)+
isnull(PivotTable.[201902],0)+
isnull(PivotTable.[201903],0)+
isnull(PivotTable.[201904],0)+
isnull(PivotTable.[201905],0)+
isnull(PivotTable.[201906],0)+
isnull(PivotTable.[201907],0)+
isnull(PivotTable.[201908],0)+
isnull(PivotTable.[201909],0)+
isnull(PivotTable.[201910],0)+
isnull(PivotTable.[201911],0)+
isnull(PivotTable.[201912],0)+
isnull(PivotTable.[202001],0)+
isnull(PivotTable.[202002],0)+
isnull(PivotTable.[202003],0)+
isnull(PivotTable.[202004],0)+
isnull(PivotTable.[202005],0)+
isnull(PivotTable.[202006],0)+
isnull(PivotTable.[202007],0)+
isnull(PivotTable.[202008],0)+
isnull(PivotTable.[202009],0)+
isnull(PivotTable.[202010],0)+
isnull(PivotTable.[202011],0)+
isnull(PivotTable.[202012],0)+
isnull(PivotTable.[202101],0)+
isnull(PivotTable.[202102],0)+
isnull(PivotTable.[202103],0)+
isnull(PivotTable.[202104],0)+
isnull(PivotTable.[202105],0)+
isnull(PivotTable.[202106],0)+
isnull(PivotTable.[202107],0)+
isnull(PivotTable.[202108],0)+
isnull(PivotTable.[202109],0)+
isnull(PivotTable.[202110],0)+
isnull(PivotTable.[202111],0)+
	    isnull(PivotTable.[202112],0)+
		isnull(PivotTable.[202201],0)+
		isnull(PivotTable.[202202],0)+
		isnull(PivotTable.[202203],0)+
		isnull(PivotTable.[202204],0)+
		isnull(PivotTable.[202205],0)+
		isnull(PivotTable.[202206],0)+
		isnull(PivotTable.[202207],0)+
		isnull(PivotTable.[202208],0)+
		isnull(PivotTable.[202209],0)+
		isnull(PivotTable.[202210],0)+
		isnull(PivotTable.[202211],0)+
		isnull(PivotTable.[202212],0)

                            )


FROM
(
  select  ORDEN = 31 ,CTA_AUXILIAR_2 ='HONORARIOS ABOGADO',  ANIOMES, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras2()
WHERE AÑO BETWEEN $AniIni AND $AniFin AND NMES BETWEEN $MesIni AND $MesFin AND EMPRESA='EJECUTADO' AND AREA like '%%' AND CC_MAYOR='6 - ADMINISTRACION' AND CENTRO_DE_COSTO='60228-SEGURIDAD Y SALUD LABORAL'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND CTA_AUXILIAR = '511025 - ASESORIA JURIDICA'
        
GROUP BY ORDEN,CTA_AUXILIAR_2,ANIOMES 
) AS SourceTable 

PIVOT(SUM(NETO) FOR ANIOMES IN([201501],
[201502],
[201503],
[201504],
[201505],
[201506],
[201507],
[201508],
[201509],
[201510],
[201511],
[201512],
[201601],
[201602],
[201603],
[201604],
[201605],
[201606],
[201607],
[201608],
[201609],
[201610],
[201611],
[201612],
[201701],
[201702],
[201703],
[201704],
[201705],
[201706],
[201707],
[201708],
[201709],
[201710],
[201711],
[201712],
[201801],
[201802],
[201803],
[201804],
[201805],
[201806],
[201807],
[201808],
[201809],
[201810],
[201811],
[201812],
[201901],
[201902],
[201903],
[201904],
[201905],
[201906],
[201907],
[201908],
[201909],
[201910],
[201911],
[201912],
[202001],
[202002],
[202003],
[202004],
[202005],
[202006],
[202007],
[202008],
[202009],
[202010],
[202011],
[202012],
[202101],
[202102],
[202103],
[202104],
[202105],
[202106],
[202107],
[202108],
[202109],
[202110],
[202111],
[202112],
[202201],
[202202],
[202203],
[202204],
[202205],
[202206],
[202207],
[202208],
[202209],
[202210],
[202211],
[202212]
)) AS PivotTable

UNION ALL

SELECT ORDEN,CTA_AUXILIAR_2,
                            PivotTable.[201501] as Enero2015,
                            PivotTable.[201502] as Febrero2015,
                            PivotTable.[201503] as Marzo2015,
                            PivotTable.[201504] as Abril2015,
                            PivotTable.[201505] as Mayo2015,
                            PivotTable.[201506] as Junio2015,
                            PivotTable.[201507] as Julio2015,
                            PivotTable.[201508] as Agosto2015,
                            PivotTable.[201509] as Septiembre2015,
                            PivotTable.[201510] as Octubre2015,
                            PivotTable.[201511] as Noviembre2015,
                            PivotTable.[201512] as Diciembre2015,
                            PivotTable.[201601] as Enero2016,
                            PivotTable.[201602] as Febrero2016,
                            PivotTable.[201603] as Marzo2016,
                            PivotTable.[201604] as Abril2016,
                            PivotTable.[201605] as Mayo2016,
                            PivotTable.[201606] as Junio2016,
                            PivotTable.[201607] as Julio2016,
                            PivotTable.[201608] as Agosto2016,
                            PivotTable.[201609] as Septiembre2016,
                            PivotTable.[201610] as Octubre2016,
                            PivotTable.[201611] as Noviembre2016,
                            PivotTable.[201612] as Diciembre2016,
                            PivotTable.[201701] as Enero2017,
                            PivotTable.[201702] as Febrero2017,
                            PivotTable.[201703] as Marzo2017,
                            PivotTable.[201704] as Abril2017,
                            PivotTable.[201705] as Mayo2017,
                            PivotTable.[201706] as Junio2017,
                            PivotTable.[201707] as Julio2017,
                            PivotTable.[201708] as Agosto2017,
                            PivotTable.[201709] as Septiembre2017,
                            PivotTable.[201710] as Octubre2017,
                            PivotTable.[201711] as Noviembre2017,
                            PivotTable.[201712] as Diciembre2017,
                            PivotTable.[201801] as Enero2018,
                            PivotTable.[201802] as Febrero2018,
                            PivotTable.[201803] as Marzo2018,
                            PivotTable.[201804] as Abril2018,
                            PivotTable.[201805] as Mayo2018,
                            PivotTable.[201806] as Junio2018,
                            PivotTable.[201807] as Julio2018,
                            PivotTable.[201808] as Agosto2018,
                            PivotTable.[201809] as Septiembre2018,
                            PivotTable.[201810] as Octubre2018,
                            PivotTable.[201811] as Noviembre2018,
                            PivotTable.[201812] as Diciembre2018,
                            PivotTable.[201901] as Enero2019,
                            PivotTable.[201902] as Febrero2019,
                            PivotTable.[201903] as Marzo2019,
                            PivotTable.[201904] as Abril2019,
                            PivotTable.[201905] as Mayo2019,
                            PivotTable.[201906] as Junio2019,
                            PivotTable.[201907] as Julio2019,
                            PivotTable.[201908] as Agosto2019,
                            PivotTable.[201909] as Septiembre2019,
                            PivotTable.[201910] as Octubre2019,
                            PivotTable.[201911] as Noviembre2019,
                            PivotTable.[201912] as Diciembre2019,
                            PivotTable.[202001] as Enero2020,
                            PivotTable.[202002] as Febrero2020,
                            PivotTable.[202003] as Marzo2020,
                            PivotTable.[202004] as Abril2020,
                            PivotTable.[202005] as Mayo2020,
                            PivotTable.[202006] as Junio2020,
                            PivotTable.[202007] as Julio2020,
                            PivotTable.[202008] as Agosto2020,
                            PivotTable.[202009] as Septiembre2020,
                            PivotTable.[202010] as Octubre2020,
                            PivotTable.[202011] as Noviembre2020,
                            PivotTable.[202012] as Diciembre2020,
                            PivotTable.[202101] as Enero2021,
                            PivotTable.[202102] as Febrero2021,
                            PivotTable.[202103] as Marzo2021,
                            PivotTable.[202104] as Abril2021,
                            PivotTable.[202105] as Mayo2021,
                            PivotTable.[202106] as Junio2021,
                            PivotTable.[202107] as Julio2021,
                            PivotTable.[202108] as Agosto2021,
                            PivotTable.[202109] as Septiembre2021,
                            PivotTable.[202110] as Octubre2021,
                            PivotTable.[202111] as Noviembre2021,
                                                        PivotTable.[202112] as Diciembre2021,
                            PivotTable.[202201] as Enero2022,
                            PivotTable.[202202] as Febrero2022,
                            PivotTable.[202203] as Marzo2022,
                            PivotTable.[202204] as Abril2022,
                            PivotTable.[202205] as Mayo2022,
                            PivotTable.[202206] as Junio2022,
                            PivotTable.[202207] as Julio2022,
                            PivotTable.[202208] as Agosto2022,
                            PivotTable.[202209] as Septiembre2022,
                            PivotTable.[202210] as Octubre2022,
                            PivotTable.[202211] as Noviembre2022,
                            PivotTable.[202212] as Diciembre2022,
                            Total= (
                            isnull(PivotTable.[201501],0)+
isnull(PivotTable.[201502],0)+
isnull(PivotTable.[201503],0)+
isnull(PivotTable.[201504],0)+
isnull(PivotTable.[201505],0)+
isnull(PivotTable.[201506],0)+
isnull(PivotTable.[201507],0)+
isnull(PivotTable.[201508],0)+
isnull(PivotTable.[201509],0)+
isnull(PivotTable.[201510],0)+
isnull(PivotTable.[201511],0)+
isnull(PivotTable.[201512],0)+
isnull(PivotTable.[201601],0)+
isnull(PivotTable.[201602],0)+
isnull(PivotTable.[201603],0)+
isnull(PivotTable.[201604],0)+
isnull(PivotTable.[201605],0)+
isnull(PivotTable.[201606],0)+
isnull(PivotTable.[201607],0)+
isnull(PivotTable.[201608],0)+
isnull(PivotTable.[201609],0)+
isnull(PivotTable.[201610],0)+
isnull(PivotTable.[201611],0)+
isnull(PivotTable.[201612],0)+
isnull(PivotTable.[201701],0)+
isnull(PivotTable.[201702],0)+
isnull(PivotTable.[201703],0)+
isnull(PivotTable.[201704],0)+
isnull(PivotTable.[201705],0)+
isnull(PivotTable.[201706],0)+
isnull(PivotTable.[201707],0)+
isnull(PivotTable.[201708],0)+
isnull(PivotTable.[201709],0)+
isnull(PivotTable.[201710],0)+
isnull(PivotTable.[201711],0)+
isnull(PivotTable.[201712],0)+
isnull(PivotTable.[201801],0)+
isnull(PivotTable.[201802],0)+
isnull(PivotTable.[201803],0)+
isnull(PivotTable.[201804],0)+
isnull(PivotTable.[201805],0)+
isnull(PivotTable.[201806],0)+
isnull(PivotTable.[201807],0)+
isnull(PivotTable.[201808],0)+
isnull(PivotTable.[201809],0)+
isnull(PivotTable.[201810],0)+
isnull(PivotTable.[201811],0)+
isnull(PivotTable.[201812],0)+
isnull(PivotTable.[201901],0)+
isnull(PivotTable.[201902],0)+
isnull(PivotTable.[201903],0)+
isnull(PivotTable.[201904],0)+
isnull(PivotTable.[201905],0)+
isnull(PivotTable.[201906],0)+
isnull(PivotTable.[201907],0)+
isnull(PivotTable.[201908],0)+
isnull(PivotTable.[201909],0)+
isnull(PivotTable.[201910],0)+
isnull(PivotTable.[201911],0)+
isnull(PivotTable.[201912],0)+
isnull(PivotTable.[202001],0)+
isnull(PivotTable.[202002],0)+
isnull(PivotTable.[202003],0)+
isnull(PivotTable.[202004],0)+
isnull(PivotTable.[202005],0)+
isnull(PivotTable.[202006],0)+
isnull(PivotTable.[202007],0)+
isnull(PivotTable.[202008],0)+
isnull(PivotTable.[202009],0)+
isnull(PivotTable.[202010],0)+
isnull(PivotTable.[202011],0)+
isnull(PivotTable.[202012],0)+
isnull(PivotTable.[202101],0)+
isnull(PivotTable.[202102],0)+
isnull(PivotTable.[202103],0)+
isnull(PivotTable.[202104],0)+
isnull(PivotTable.[202105],0)+
isnull(PivotTable.[202106],0)+
isnull(PivotTable.[202107],0)+
isnull(PivotTable.[202108],0)+
isnull(PivotTable.[202109],0)+
isnull(PivotTable.[202110],0)+
isnull(PivotTable.[202111],0)+
	    isnull(PivotTable.[202112],0)+
		isnull(PivotTable.[202201],0)+
		isnull(PivotTable.[202202],0)+
		isnull(PivotTable.[202203],0)+
		isnull(PivotTable.[202204],0)+
		isnull(PivotTable.[202205],0)+
		isnull(PivotTable.[202206],0)+
		isnull(PivotTable.[202207],0)+
		isnull(PivotTable.[202208],0)+
		isnull(PivotTable.[202209],0)+
		isnull(PivotTable.[202210],0)+
		isnull(PivotTable.[202211],0)+
		isnull(PivotTable.[202212],0)

                            )


FROM
(
  select  ORDEN=32 ,CTA_AUXILIAR_2 ='HONORARIOS MEDICO LABORAL' ,  ANIOMES, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras2()
  WHERE AÑO BETWEEN $AniIni AND $AniFin AND NMES BETWEEN $MesIni AND $MesFin AND EMPRESA='EJECUTADO' AND AREA like '%%' AND CC_MAYOR='6 - ADMINISTRACION' AND CENTRO_DE_COSTO='60228-SEGURIDAD Y SALUD LABORAL'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND CTA_AUXILIAR = '511095 - OTROS - HONORARIOS'
    
GROUP BY ORDEN,CTA_AUXILIAR_2,ANIOMES 
) AS SourceTable 

PIVOT(SUM(NETO) FOR ANIOMES IN([201501],
[201502],
[201503],
[201504],
[201505],
[201506],
[201507],
[201508],
[201509],
[201510],
[201511],
[201512],
[201601],
[201602],
[201603],
[201604],
[201605],
[201606],
[201607],
[201608],
[201609],
[201610],
[201611],
[201612],
[201701],
[201702],
[201703],
[201704],
[201705],
[201706],
[201707],
[201708],
[201709],
[201710],
[201711],
[201712],
[201801],
[201802],
[201803],
[201804],
[201805],
[201806],
[201807],
[201808],
[201809],
[201810],
[201811],
[201812],
[201901],
[201902],
[201903],
[201904],
[201905],
[201906],
[201907],
[201908],
[201909],
[201910],
[201911],
[201912],
[202001],
[202002],
[202003],
[202004],
[202005],
[202006],
[202007],
[202008],
[202009],
[202010],
[202011],
[202012],
[202101],
[202102],
[202103],
[202104],
[202105],
[202106],
[202107],
[202108],
[202109],
[202110],
[202111],
[202112],
[202201],
[202202],
[202203],
[202204],
[202205],
[202206],
[202207],
[202208],
[202209],
[202210],
[202211],
[202212]
)) AS PivotTable

) D

UNION ALL

 

--FIN CONSULTA TOTAL COSTOS SSL


/*CALCULO NETO DE HONORARIOS DPTO. DE SEGURIDAD Y SALUD LABORAL
HONORARIOS ABOGADO
HONORARIOS MEDICO LABORAL*/


SELECT ORDEN=34, CTA_AUXILIAR_2='COSTO NETO SSL - HON' , 
SUM(Enero2015) as Enero2015,
SUM(Febrero2015) as Febrero2015,
SUM(Marzo2015) as Marzo2015,
SUM(Abril2015) as Abril2015,
SUM(Mayo2015) as Mayo2015,
SUM(Junio2015) as Junio2015,
SUM(Julio2015) as Julio2015,
SUM(Agosto2015) as Agosto2015,
SUM(Septiembre2015) as Septiembre2015,
SUM(Octubre2015) as Octubre2015,
SUM(Noviembre2015) as Noviembre2015,
SUM(Diciembre2015) as Diciembre2015,
SUM(Enero2016) as Enero2016,
SUM(Febrero2016) as Febrero2016,
SUM(Marzo2016) as Marzo2016,
SUM(Abril2016) as Abril2016,
SUM(Mayo2016) as Mayo2016,
SUM(Junio2016) as Junio2016,
SUM(Julio2016) as Julio2016,
SUM(Agosto2016) as Agosto2016,
SUM(Septiembre2016) as Septiembre2016,
SUM(Octubre2016) as Octubre2016,
SUM(Noviembre2016) as Noviembre2016,
SUM(Diciembre2016) as Diciembre2016,
SUM(Enero2017) as Enero2017,
SUM(Febrero2017) as Febrero2017,
SUM(Marzo2017) as Marzo2017,
SUM(Abril2017) as Abril2017,
SUM(Mayo2017) as Mayo2017,
SUM(Junio2017) as Junio2017,
SUM(Julio2017) as Julio2017,
SUM(Agosto2017) as Agosto2017,
SUM(Septiembre2017) as Septiembre2017,
SUM(Octubre2017) as Octubre2017,
SUM(Noviembre2017) as Noviembre2017,
SUM(Diciembre2017) as Diciembre2017,
SUM(Enero2018) as Enero2018,
SUM(Febrero2018) as Febrero2018,
SUM(Marzo2018) as Marzo2018,
SUM(Abril2018) as Abril2018,
SUM(Mayo2018) as Mayo2018,
SUM(Junio2018) as Junio2018,
SUM(Julio2018) as Julio2018,
SUM(Agosto2018) as Agosto2018,
SUM(Septiembre2018) as Septiembre2018,
SUM(Octubre2018) as Octubre2018,
SUM(Noviembre2018) as Noviembre2018,
SUM(Diciembre2018) as Diciembre2018,
SUM(Enero2019) as Enero2019,
SUM(Febrero2019) as Febrero2019,
SUM(Marzo2019) as Marzo2019,
SUM(Abril2019) as Abril2019,
SUM(Mayo2019) as Mayo2019,
SUM(Junio2019) as Junio2019,
SUM(Julio2019) as Julio2019,
SUM(Agosto2019) as Agosto2019,
SUM(Septiembre2019) as Septiembre2019,
SUM(Octubre2019) as Octubre2019,
SUM(Noviembre2019) as Noviembre2019,
SUM(Diciembre2019) as Diciembre2019,
SUM(Enero2020) as Enero2020,
SUM(Febrero2020) as Febrero2020,
SUM(Marzo2020) as Marzo2020,
SUM(Abril2020) as Abril2020,
SUM(Mayo2020) as Mayo2020,
SUM(Junio2020) as Junio2020,
SUM(Julio2020) as Julio2020,
SUM(Agosto2020) as Agosto2020,
SUM(Septiembre2020) as Septiembre2020,
SUM(Octubre2020) as Octubre2020,
SUM(Noviembre2020) as Noviembre2020,
SUM(Diciembre2020) as Diciembre2020,
SUM(Enero2021) as Enero2021,
SUM(Febrero2021) as Febrero2021,
SUM(Marzo2021) as Marzo2021,
SUM(Abril2021) as Abril2021,
SUM(Mayo2021) as Mayo2021,
SUM(Junio2021) as Junio2021,
SUM(Julio2021) as Julio2021,
SUM(Agosto2021) as Agosto2021,
SUM(Septiembre2021) as Septiembre2021,
SUM(Octubre2021) as Octubre2021,
SUM(Noviembre2021) as Noviembre2021,
SUM(Diciembre2021) as Diciembre2021,
SUM(Enero2022) as Enero2022,
SUM(Febrero2022) as Febrero2022,
SUM(Marzo2022) as Marzo2022,
SUM(Abril2022) as Abril2022,
SUM(Mayo2022) as Mayo2022,
SUM(Junio2022) as Junio2022,
SUM(Julio2022) as Julio2022,
SUM(Agosto2022) as Agosto2022,
SUM(Septiembre2022) as Septiembre2022,
SUM(Octubre2022) as Octubre2022,
SUM(Noviembre2022) as Noviembre2022,
SUM(Diciembre2022) as Diciembre2022,
SUM(Total) as Total

FROM (


SELECT ORDEN,CTA_AUXILIAR_2,
                            PivotTable.[201501] as Enero2015,
                            PivotTable.[201502] as Febrero2015,
                            PivotTable.[201503] as Marzo2015,
                            PivotTable.[201504] as Abril2015,
                            PivotTable.[201505] as Mayo2015,
                            PivotTable.[201506] as Junio2015,
                            PivotTable.[201507] as Julio2015,
                            PivotTable.[201508] as Agosto2015,
                            PivotTable.[201509] as Septiembre2015,
                            PivotTable.[201510] as Octubre2015,
                            PivotTable.[201511] as Noviembre2015,
                            PivotTable.[201512] as Diciembre2015,
                            PivotTable.[201601] as Enero2016,
                            PivotTable.[201602] as Febrero2016,
                            PivotTable.[201603] as Marzo2016,
                            PivotTable.[201604] as Abril2016,
                            PivotTable.[201605] as Mayo2016,
                            PivotTable.[201606] as Junio2016,
                            PivotTable.[201607] as Julio2016,
                            PivotTable.[201608] as Agosto2016,
                            PivotTable.[201609] as Septiembre2016,
                            PivotTable.[201610] as Octubre2016,
                            PivotTable.[201611] as Noviembre2016,
                            PivotTable.[201612] as Diciembre2016,
                            PivotTable.[201701] as Enero2017,
                            PivotTable.[201702] as Febrero2017,
                            PivotTable.[201703] as Marzo2017,
                            PivotTable.[201704] as Abril2017,
                            PivotTable.[201705] as Mayo2017,
                            PivotTable.[201706] as Junio2017,
                            PivotTable.[201707] as Julio2017,
                            PivotTable.[201708] as Agosto2017,
                            PivotTable.[201709] as Septiembre2017,
                            PivotTable.[201710] as Octubre2017,
                            PivotTable.[201711] as Noviembre2017,
                            PivotTable.[201712] as Diciembre2017,
                            PivotTable.[201801] as Enero2018,
                            PivotTable.[201802] as Febrero2018,
                            PivotTable.[201803] as Marzo2018,
                            PivotTable.[201804] as Abril2018,
                            PivotTable.[201805] as Mayo2018,
                            PivotTable.[201806] as Junio2018,
                            PivotTable.[201807] as Julio2018,
                            PivotTable.[201808] as Agosto2018,
                            PivotTable.[201809] as Septiembre2018,
                            PivotTable.[201810] as Octubre2018,
                            PivotTable.[201811] as Noviembre2018,
                            PivotTable.[201812] as Diciembre2018,
                            PivotTable.[201901] as Enero2019,
                            PivotTable.[201902] as Febrero2019,
                            PivotTable.[201903] as Marzo2019,
                            PivotTable.[201904] as Abril2019,
                            PivotTable.[201905] as Mayo2019,
                            PivotTable.[201906] as Junio2019,
                            PivotTable.[201907] as Julio2019,
                            PivotTable.[201908] as Agosto2019,
                            PivotTable.[201909] as Septiembre2019,
                            PivotTable.[201910] as Octubre2019,
                            PivotTable.[201911] as Noviembre2019,
                            PivotTable.[201912] as Diciembre2019,
                            PivotTable.[202001] as Enero2020,
                            PivotTable.[202002] as Febrero2020,
                            PivotTable.[202003] as Marzo2020,
                            PivotTable.[202004] as Abril2020,
                            PivotTable.[202005] as Mayo2020,
                            PivotTable.[202006] as Junio2020,
                            PivotTable.[202007] as Julio2020,
                            PivotTable.[202008] as Agosto2020,
                            PivotTable.[202009] as Septiembre2020,
                            PivotTable.[202010] as Octubre2020,
                            PivotTable.[202011] as Noviembre2020,
                            PivotTable.[202012] as Diciembre2020,
                            PivotTable.[202101] as Enero2021,
                            PivotTable.[202102] as Febrero2021,
                            PivotTable.[202103] as Marzo2021,
                            PivotTable.[202104] as Abril2021,
                            PivotTable.[202105] as Mayo2021,
                            PivotTable.[202106] as Junio2021,
                            PivotTable.[202107] as Julio2021,
                            PivotTable.[202108] as Agosto2021,
                            PivotTable.[202109] as Septiembre2021,
                            PivotTable.[202110] as Octubre2021,
                            PivotTable.[202111] as Noviembre2021,
                                                        PivotTable.[202112] as Diciembre2021,
                            PivotTable.[202201] as Enero2022,
                            PivotTable.[202202] as Febrero2022,
                            PivotTable.[202203] as Marzo2022,
                            PivotTable.[202204] as Abril2022,
                            PivotTable.[202205] as Mayo2022,
                            PivotTable.[202206] as Junio2022,
                            PivotTable.[202207] as Julio2022,
                            PivotTable.[202208] as Agosto2022,
                            PivotTable.[202209] as Septiembre2022,
                            PivotTable.[202210] as Octubre2022,
                            PivotTable.[202211] as Noviembre2022,
                            PivotTable.[202212] as Diciembre2022,
                            Total= (
                            isnull(PivotTable.[201501],1)+
                        isnull(PivotTable.[201502],1)+
                        isnull(PivotTable.[201503],1)+
                        isnull(PivotTable.[201504],1)+
                        isnull(PivotTable.[201505],1)+
                        isnull(PivotTable.[201506],1)+
                        isnull(PivotTable.[201507],1)+
                        isnull(PivotTable.[201508],1)+
                        isnull(PivotTable.[201509],1)+
                        isnull(PivotTable.[201510],1)+
                        isnull(PivotTable.[201511],1)+
                        isnull(PivotTable.[201512],1)+
                        isnull(PivotTable.[201601],1)+
                        isnull(PivotTable.[201602],1)+
                        isnull(PivotTable.[201603],1)+
                        isnull(PivotTable.[201604],1)+
                        isnull(PivotTable.[201605],1)+
                        isnull(PivotTable.[201606],1)+
                        isnull(PivotTable.[201607],1)+
                        isnull(PivotTable.[201608],1)+
                        isnull(PivotTable.[201609],1)+
                        isnull(PivotTable.[201610],1)+
                        isnull(PivotTable.[201611],1)+
                        isnull(PivotTable.[201612],1)+
                        isnull(PivotTable.[201701],1)+
                        isnull(PivotTable.[201702],1)+
                        isnull(PivotTable.[201703],1)+
                        isnull(PivotTable.[201704],1)+
                        isnull(PivotTable.[201705],1)+
                        isnull(PivotTable.[201706],1)+
                        isnull(PivotTable.[201707],1)+
                        isnull(PivotTable.[201708],1)+
                        isnull(PivotTable.[201709],1)+
                        isnull(PivotTable.[201710],1)+
                        isnull(PivotTable.[201711],1)+
                        isnull(PivotTable.[201712],1)+
                        isnull(PivotTable.[201801],1)+
                        isnull(PivotTable.[201802],1)+
                        isnull(PivotTable.[201803],1)+
                        isnull(PivotTable.[201804],1)+
                        isnull(PivotTable.[201805],1)+
                        isnull(PivotTable.[201806],1)+
                        isnull(PivotTable.[201807],1)+
                        isnull(PivotTable.[201808],1)+
                        isnull(PivotTable.[201809],1)+
                        isnull(PivotTable.[201810],1)+
                        isnull(PivotTable.[201811],1)+
                        isnull(PivotTable.[201812],1)+
                        isnull(PivotTable.[201901],1)+
                        isnull(PivotTable.[201902],1)+
                        isnull(PivotTable.[201903],1)+
                        isnull(PivotTable.[201904],1)+
                        isnull(PivotTable.[201905],1)+
                        isnull(PivotTable.[201906],1)+
                        isnull(PivotTable.[201907],1)+
                        isnull(PivotTable.[201908],1)+
                        isnull(PivotTable.[201909],1)+
                        isnull(PivotTable.[201910],1)+
                        isnull(PivotTable.[201911],1)+
                        isnull(PivotTable.[201912],1)+
                        isnull(PivotTable.[202001],1)+
                        isnull(PivotTable.[202002],1)+
                        isnull(PivotTable.[202003],1)+
                        isnull(PivotTable.[202004],1)+
                        isnull(PivotTable.[202005],1)+
                        isnull(PivotTable.[202006],1)+
                        isnull(PivotTable.[202007],1)+
                        isnull(PivotTable.[202008],1)+
                        isnull(PivotTable.[202009],1)+
                        isnull(PivotTable.[202010],1)+
                        isnull(PivotTable.[202011],1)+
                        isnull(PivotTable.[202012],1)+
                        isnull(PivotTable.[202101],1)+
                        isnull(PivotTable.[202102],1)+
                        isnull(PivotTable.[202103],1)+
                        isnull(PivotTable.[202104],1)+
                        isnull(PivotTable.[202105],1)+
                        isnull(PivotTable.[202106],1)+
                        isnull(PivotTable.[202107],1)+
                        isnull(PivotTable.[202108],1)+
                        isnull(PivotTable.[202109],1)+
                        isnull(PivotTable.[202110],1)+
                        isnull(PivotTable.[202111],1)+
                        	    isnull(PivotTable.[202112],1)+
                        		isnull(PivotTable.[202201],1)+
                        		isnull(PivotTable.[202202],1)+
                        		isnull(PivotTable.[202203],1)+
                        		isnull(PivotTable.[202204],1)+
                        		isnull(PivotTable.[202205],1)+
                        		isnull(PivotTable.[202206],1)+
                        		isnull(PivotTable.[202207],1)+
                        		isnull(PivotTable.[202208],1)+
                        		isnull(PivotTable.[202209],1)+
                        		isnull(PivotTable.[202210],1)+
                        		isnull(PivotTable.[202211],1)+
                        		isnull(PivotTable.[202212],0)

                            )


FROM
(
  select  ORDEN = 30 ,CTA_AUXILIAR_2 ='DPTO. DE SEGURIDAD Y SALUD LABORAL',  ANIOMES, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras2()
 WHERE AÑO BETWEEN $AniIni AND $AniFin AND NMES BETWEEN $MesIni AND $MesFin AND EMPRESA='EJECUTADO' AND AREA like '%%' AND CC_MAYOR='6 - ADMINISTRACION' AND CENTRO_DE_COSTO='60228-SEGURIDAD Y SALUD LABORAL'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND CTA_AUXILIAR NOT IN ('511025 - ASESORIA JURIDICA','511095 - OTROS - HONORARIOS')
        
GROUP BY ORDEN,CTA_AUXILIAR_2,ANIOMES 
) AS SourceTable 

PIVOT(SUM(NETO) FOR ANIOMES IN([201501],
[201502],
[201503],
[201504],
[201505],
[201506],
[201507],
[201508],
[201509],
[201510],
[201511],
[201512],
[201601],
[201602],
[201603],
[201604],
[201605],
[201606],
[201607],
[201608],
[201609],
[201610],
[201611],
[201612],
[201701],
[201702],
[201703],
[201704],
[201705],
[201706],
[201707],
[201708],
[201709],
[201710],
[201711],
[201712],
[201801],
[201802],
[201803],
[201804],
[201805],
[201806],
[201807],
[201808],
[201809],
[201810],
[201811],
[201812],
[201901],
[201902],
[201903],
[201904],
[201905],
[201906],
[201907],
[201908],
[201909],
[201910],
[201911],
[201912],
[202001],
[202002],
[202003],
[202004],
[202005],
[202006],
[202007],
[202008],
[202009],
[202010],
[202011],
[202012],
[202101],
[202102],
[202103],
[202104],
[202105],
[202106],
[202107],
[202108],
[202109],
[202110],
[202111],
[202112],
[202201],
[202202],
[202203],
[202204],
[202205],
[202206],
[202207],
[202208],
[202209],
[202210],
[202211],
[202212]
)) AS PivotTable

UNION ALL

SELECT ORDEN,CTA_AUXILIAR_2,
                            PivotTable.[201501] as Enero2015,
                            PivotTable.[201502] as Febrero2015,
                            PivotTable.[201503] as Marzo2015,
                            PivotTable.[201504] as Abril2015,
                            PivotTable.[201505] as Mayo2015,
                            PivotTable.[201506] as Junio2015,
                            PivotTable.[201507] as Julio2015,
                            PivotTable.[201508] as Agosto2015,
                            PivotTable.[201509] as Septiembre2015,
                            PivotTable.[201510] as Octubre2015,
                            PivotTable.[201511] as Noviembre2015,
                            PivotTable.[201512] as Diciembre2015,
                            PivotTable.[201601] as Enero2016,
                            PivotTable.[201602] as Febrero2016,
                            PivotTable.[201603] as Marzo2016,
                            PivotTable.[201604] as Abril2016,
                            PivotTable.[201605] as Mayo2016,
                            PivotTable.[201606] as Junio2016,
                            PivotTable.[201607] as Julio2016,
                            PivotTable.[201608] as Agosto2016,
                            PivotTable.[201609] as Septiembre2016,
                            PivotTable.[201610] as Octubre2016,
                            PivotTable.[201611] as Noviembre2016,
                            PivotTable.[201612] as Diciembre2016,
                            PivotTable.[201701] as Enero2017,
                            PivotTable.[201702] as Febrero2017,
                            PivotTable.[201703] as Marzo2017,
                            PivotTable.[201704] as Abril2017,
                            PivotTable.[201705] as Mayo2017,
                            PivotTable.[201706] as Junio2017,
                            PivotTable.[201707] as Julio2017,
                            PivotTable.[201708] as Agosto2017,
                            PivotTable.[201709] as Septiembre2017,
                            PivotTable.[201710] as Octubre2017,
                            PivotTable.[201711] as Noviembre2017,
                            PivotTable.[201712] as Diciembre2017,
                            PivotTable.[201801] as Enero2018,
                            PivotTable.[201802] as Febrero2018,
                            PivotTable.[201803] as Marzo2018,
                            PivotTable.[201804] as Abril2018,
                            PivotTable.[201805] as Mayo2018,
                            PivotTable.[201806] as Junio2018,
                            PivotTable.[201807] as Julio2018,
                            PivotTable.[201808] as Agosto2018,
                            PivotTable.[201809] as Septiembre2018,
                            PivotTable.[201810] as Octubre2018,
                            PivotTable.[201811] as Noviembre2018,
                            PivotTable.[201812] as Diciembre2018,
                            PivotTable.[201901] as Enero2019,
                            PivotTable.[201902] as Febrero2019,
                            PivotTable.[201903] as Marzo2019,
                            PivotTable.[201904] as Abril2019,
                            PivotTable.[201905] as Mayo2019,
                            PivotTable.[201906] as Junio2019,
                            PivotTable.[201907] as Julio2019,
                            PivotTable.[201908] as Agosto2019,
                            PivotTable.[201909] as Septiembre2019,
                            PivotTable.[201910] as Octubre2019,
                            PivotTable.[201911] as Noviembre2019,
                            PivotTable.[201912] as Diciembre2019,
                            PivotTable.[202001] as Enero2020,
                            PivotTable.[202002] as Febrero2020,
                            PivotTable.[202003] as Marzo2020,
                            PivotTable.[202004] as Abril2020,
                            PivotTable.[202005] as Mayo2020,
                            PivotTable.[202006] as Junio2020,
                            PivotTable.[202007] as Julio2020,
                            PivotTable.[202008] as Agosto2020,
                            PivotTable.[202009] as Septiembre2020,
                            PivotTable.[202010] as Octubre2020,
                            PivotTable.[202011] as Noviembre2020,
                            PivotTable.[202012] as Diciembre2020,
                            PivotTable.[202101] as Enero2021,
                            PivotTable.[202102] as Febrero2021,
                            PivotTable.[202103] as Marzo2021,
                            PivotTable.[202104] as Abril2021,
                            PivotTable.[202105] as Mayo2021,
                            PivotTable.[202106] as Junio2021,
                            PivotTable.[202107] as Julio2021,
                            PivotTable.[202108] as Agosto2021,
                            PivotTable.[202109] as Septiembre2021,
                            PivotTable.[202110] as Octubre2021,
                            PivotTable.[202111] as Noviembre2021,
                                                        PivotTable.[202112] as Diciembre2021,
                            PivotTable.[202201] as Enero2022,
                            PivotTable.[202202] as Febrero2022,
                            PivotTable.[202203] as Marzo2022,
                            PivotTable.[202204] as Abril2022,
                            PivotTable.[202205] as Mayo2022,
                            PivotTable.[202206] as Junio2022,
                            PivotTable.[202207] as Julio2022,
                            PivotTable.[202208] as Agosto2022,
                            PivotTable.[202209] as Septiembre2022,
                            PivotTable.[202210] as Octubre2022,
                            PivotTable.[202211] as Noviembre2022,
                            PivotTable.[202212] as Diciembre2022,
                            Total= (
                            isnull(PivotTable.[201501],0)+
isnull(PivotTable.[201502],0)+
isnull(PivotTable.[201503],0)+
isnull(PivotTable.[201504],0)+
isnull(PivotTable.[201505],0)+
isnull(PivotTable.[201506],0)+
isnull(PivotTable.[201507],0)+
isnull(PivotTable.[201508],0)+
isnull(PivotTable.[201509],0)+
isnull(PivotTable.[201510],0)+
isnull(PivotTable.[201511],0)+
isnull(PivotTable.[201512],0)+
isnull(PivotTable.[201601],0)+
isnull(PivotTable.[201602],0)+
isnull(PivotTable.[201603],0)+
isnull(PivotTable.[201604],0)+
isnull(PivotTable.[201605],0)+
isnull(PivotTable.[201606],0)+
isnull(PivotTable.[201607],0)+
isnull(PivotTable.[201608],0)+
isnull(PivotTable.[201609],0)+
isnull(PivotTable.[201610],0)+
isnull(PivotTable.[201611],0)+
isnull(PivotTable.[201612],0)+
isnull(PivotTable.[201701],0)+
isnull(PivotTable.[201702],0)+
isnull(PivotTable.[201703],0)+
isnull(PivotTable.[201704],0)+
isnull(PivotTable.[201705],0)+
isnull(PivotTable.[201706],0)+
isnull(PivotTable.[201707],0)+
isnull(PivotTable.[201708],0)+
isnull(PivotTable.[201709],0)+
isnull(PivotTable.[201710],0)+
isnull(PivotTable.[201711],0)+
isnull(PivotTable.[201712],0)+
isnull(PivotTable.[201801],0)+
isnull(PivotTable.[201802],0)+
isnull(PivotTable.[201803],0)+
isnull(PivotTable.[201804],0)+
isnull(PivotTable.[201805],0)+
isnull(PivotTable.[201806],0)+
isnull(PivotTable.[201807],0)+
isnull(PivotTable.[201808],0)+
isnull(PivotTable.[201809],0)+
isnull(PivotTable.[201810],0)+
isnull(PivotTable.[201811],0)+
isnull(PivotTable.[201812],0)+
isnull(PivotTable.[201901],0)+
isnull(PivotTable.[201902],0)+
isnull(PivotTable.[201903],0)+
isnull(PivotTable.[201904],0)+
isnull(PivotTable.[201905],0)+
isnull(PivotTable.[201906],0)+
isnull(PivotTable.[201907],0)+
isnull(PivotTable.[201908],0)+
isnull(PivotTable.[201909],0)+
isnull(PivotTable.[201910],0)+
isnull(PivotTable.[201911],0)+
isnull(PivotTable.[201912],0)+
isnull(PivotTable.[202001],0)+
isnull(PivotTable.[202002],0)+
isnull(PivotTable.[202003],0)+
isnull(PivotTable.[202004],0)+
isnull(PivotTable.[202005],0)+
isnull(PivotTable.[202006],0)+
isnull(PivotTable.[202007],0)+
isnull(PivotTable.[202008],0)+
isnull(PivotTable.[202009],0)+
isnull(PivotTable.[202010],0)+
isnull(PivotTable.[202011],0)+
isnull(PivotTable.[202012],0)+
isnull(PivotTable.[202101],0)+
isnull(PivotTable.[202102],0)+
isnull(PivotTable.[202103],0)+
isnull(PivotTable.[202104],0)+
isnull(PivotTable.[202105],0)+
isnull(PivotTable.[202106],0)+
isnull(PivotTable.[202107],0)+
isnull(PivotTable.[202108],0)+
isnull(PivotTable.[202109],0)+
isnull(PivotTable.[202110],0)+
isnull(PivotTable.[202111],0)+
	    isnull(PivotTable.[202112],0)+
		isnull(PivotTable.[202201],0)+
		isnull(PivotTable.[202202],0)+
		isnull(PivotTable.[202203],0)+
		isnull(PivotTable.[202204],0)+
		isnull(PivotTable.[202205],0)+
		isnull(PivotTable.[202206],0)+
		isnull(PivotTable.[202207],0)+
		isnull(PivotTable.[202208],0)+
		isnull(PivotTable.[202209],0)+
		isnull(PivotTable.[202210],0)+
		isnull(PivotTable.[202211],0)+
		isnull(PivotTable.[202212],0)

                            )


FROM
(
  select  ORDEN = 31 ,CTA_AUXILIAR_2 ='HONORARIOS ABOGADO',  ANIOMES, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras2()
WHERE AÑO BETWEEN $AniIni AND $AniFin AND NMES BETWEEN $MesIni AND $MesFin AND EMPRESA='EJECUTADO' AND AREA like '%%' AND CC_MAYOR='6 - ADMINISTRACION' AND CENTRO_DE_COSTO='60228-SEGURIDAD Y SALUD LABORAL'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND CTA_AUXILIAR = '511025 - ASESORIA JURIDICA'
        
GROUP BY ORDEN,CTA_AUXILIAR_2,ANIOMES 
) AS SourceTable 

PIVOT(SUM(NETO) FOR ANIOMES IN([201501],
[201502],
[201503],
[201504],
[201505],
[201506],
[201507],
[201508],
[201509],
[201510],
[201511],
[201512],
[201601],
[201602],
[201603],
[201604],
[201605],
[201606],
[201607],
[201608],
[201609],
[201610],
[201611],
[201612],
[201701],
[201702],
[201703],
[201704],
[201705],
[201706],
[201707],
[201708],
[201709],
[201710],
[201711],
[201712],
[201801],
[201802],
[201803],
[201804],
[201805],
[201806],
[201807],
[201808],
[201809],
[201810],
[201811],
[201812],
[201901],
[201902],
[201903],
[201904],
[201905],
[201906],
[201907],
[201908],
[201909],
[201910],
[201911],
[201912],
[202001],
[202002],
[202003],
[202004],
[202005],
[202006],
[202007],
[202008],
[202009],
[202010],
[202011],
[202012],
[202101],
[202102],
[202103],
[202104],
[202105],
[202106],
[202107],
[202108],
[202109],
[202110],
[202111],
[202112],
[202201],
[202202],
[202203],
[202204],
[202205],
[202206],
[202207],
[202208],
[202209],
[202210],
[202211],
[202212]
)) AS PivotTable

UNION ALL

SELECT ORDEN,CTA_AUXILIAR_2,
                            PivotTable.[201501] as Enero2015,
                            PivotTable.[201502] as Febrero2015,
                            PivotTable.[201503] as Marzo2015,
                            PivotTable.[201504] as Abril2015,
                            PivotTable.[201505] as Mayo2015,
                            PivotTable.[201506] as Junio2015,
                            PivotTable.[201507] as Julio2015,
                            PivotTable.[201508] as Agosto2015,
                            PivotTable.[201509] as Septiembre2015,
                            PivotTable.[201510] as Octubre2015,
                            PivotTable.[201511] as Noviembre2015,
                            PivotTable.[201512] as Diciembre2015,
                            PivotTable.[201601] as Enero2016,
                            PivotTable.[201602] as Febrero2016,
                            PivotTable.[201603] as Marzo2016,
                            PivotTable.[201604] as Abril2016,
                            PivotTable.[201605] as Mayo2016,
                            PivotTable.[201606] as Junio2016,
                            PivotTable.[201607] as Julio2016,
                            PivotTable.[201608] as Agosto2016,
                            PivotTable.[201609] as Septiembre2016,
                            PivotTable.[201610] as Octubre2016,
                            PivotTable.[201611] as Noviembre2016,
                            PivotTable.[201612] as Diciembre2016,
                            PivotTable.[201701] as Enero2017,
                            PivotTable.[201702] as Febrero2017,
                            PivotTable.[201703] as Marzo2017,
                            PivotTable.[201704] as Abril2017,
                            PivotTable.[201705] as Mayo2017,
                            PivotTable.[201706] as Junio2017,
                            PivotTable.[201707] as Julio2017,
                            PivotTable.[201708] as Agosto2017,
                            PivotTable.[201709] as Septiembre2017,
                            PivotTable.[201710] as Octubre2017,
                            PivotTable.[201711] as Noviembre2017,
                            PivotTable.[201712] as Diciembre2017,
                            PivotTable.[201801] as Enero2018,
                            PivotTable.[201802] as Febrero2018,
                            PivotTable.[201803] as Marzo2018,
                            PivotTable.[201804] as Abril2018,
                            PivotTable.[201805] as Mayo2018,
                            PivotTable.[201806] as Junio2018,
                            PivotTable.[201807] as Julio2018,
                            PivotTable.[201808] as Agosto2018,
                            PivotTable.[201809] as Septiembre2018,
                            PivotTable.[201810] as Octubre2018,
                            PivotTable.[201811] as Noviembre2018,
                            PivotTable.[201812] as Diciembre2018,
                            PivotTable.[201901] as Enero2019,
                            PivotTable.[201902] as Febrero2019,
                            PivotTable.[201903] as Marzo2019,
                            PivotTable.[201904] as Abril2019,
                            PivotTable.[201905] as Mayo2019,
                            PivotTable.[201906] as Junio2019,
                            PivotTable.[201907] as Julio2019,
                            PivotTable.[201908] as Agosto2019,
                            PivotTable.[201909] as Septiembre2019,
                            PivotTable.[201910] as Octubre2019,
                            PivotTable.[201911] as Noviembre2019,
                            PivotTable.[201912] as Diciembre2019,
                            PivotTable.[202001] as Enero2020,
                            PivotTable.[202002] as Febrero2020,
                            PivotTable.[202003] as Marzo2020,
                            PivotTable.[202004] as Abril2020,
                            PivotTable.[202005] as Mayo2020,
                            PivotTable.[202006] as Junio2020,
                            PivotTable.[202007] as Julio2020,
                            PivotTable.[202008] as Agosto2020,
                            PivotTable.[202009] as Septiembre2020,
                            PivotTable.[202010] as Octubre2020,
                            PivotTable.[202011] as Noviembre2020,
                            PivotTable.[202012] as Diciembre2020,
                            PivotTable.[202101] as Enero2021,
                            PivotTable.[202102] as Febrero2021,
                            PivotTable.[202103] as Marzo2021,
                            PivotTable.[202104] as Abril2021,
                            PivotTable.[202105] as Mayo2021,
                            PivotTable.[202106] as Junio2021,
                            PivotTable.[202107] as Julio2021,
                            PivotTable.[202108] as Agosto2021,
                            PivotTable.[202109] as Septiembre2021,
                            PivotTable.[202110] as Octubre2021,
                            PivotTable.[202111] as Noviembre2021,
                             PivotTable.[202112] as Diciembre2021,
                            PivotTable.[202201] as Enero2022,
                            PivotTable.[202202] as Febrero2022,
                            PivotTable.[202203] as Marzo2022,
                            PivotTable.[202204] as Abril2022,
                            PivotTable.[202205] as Mayo2022,
                            PivotTable.[202206] as Junio2022,
                            PivotTable.[202207] as Julio2022,
                            PivotTable.[202208] as Agosto2022,
                            PivotTable.[202209] as Septiembre2022,
                            PivotTable.[202210] as Octubre2022,
                            PivotTable.[202211] as Noviembre2022,
                            PivotTable.[202212] as Diciembre2022,
                            Total= (
                            isnull(PivotTable.[201501],0)+
                            isnull(PivotTable.[201502],0)+
                            isnull(PivotTable.[201503],0)+
                            isnull(PivotTable.[201504],0)+
                            isnull(PivotTable.[201505],0)+
                            isnull(PivotTable.[201506],0)+
                            isnull(PivotTable.[201507],0)+
                            isnull(PivotTable.[201508],0)+
                            isnull(PivotTable.[201509],0)+
                            isnull(PivotTable.[201510],0)+
                            isnull(PivotTable.[201511],0)+
                            isnull(PivotTable.[201512],0)+
                            isnull(PivotTable.[201601],0)+
                            isnull(PivotTable.[201602],0)+
                            isnull(PivotTable.[201603],0)+
                            isnull(PivotTable.[201604],0)+
                            isnull(PivotTable.[201605],0)+
                            isnull(PivotTable.[201606],0)+
                            isnull(PivotTable.[201607],0)+
                            isnull(PivotTable.[201608],0)+
                            isnull(PivotTable.[201609],0)+
                            isnull(PivotTable.[201610],0)+
                            isnull(PivotTable.[201611],0)+
                            isnull(PivotTable.[201612],0)+
                            isnull(PivotTable.[201701],0)+
                            isnull(PivotTable.[201702],0)+
                            isnull(PivotTable.[201703],0)+
                            isnull(PivotTable.[201704],0)+
                            isnull(PivotTable.[201705],0)+
                            isnull(PivotTable.[201706],0)+
                            isnull(PivotTable.[201707],0)+
                            isnull(PivotTable.[201708],0)+
                            isnull(PivotTable.[201709],0)+
                            isnull(PivotTable.[201710],0)+
                            isnull(PivotTable.[201711],0)+
                            isnull(PivotTable.[201712],0)+
                            isnull(PivotTable.[201801],0)+
                            isnull(PivotTable.[201802],0)+
                            isnull(PivotTable.[201803],0)+
                            isnull(PivotTable.[201804],0)+
                            isnull(PivotTable.[201805],0)+
                            isnull(PivotTable.[201806],0)+
                            isnull(PivotTable.[201807],0)+
                            isnull(PivotTable.[201808],0)+
                            isnull(PivotTable.[201809],0)+
                            isnull(PivotTable.[201810],0)+
                            isnull(PivotTable.[201811],0)+
                            isnull(PivotTable.[201812],0)+
                            isnull(PivotTable.[201901],0)+
                            isnull(PivotTable.[201902],0)+
                            isnull(PivotTable.[201903],0)+
                            isnull(PivotTable.[201904],0)+
                            isnull(PivotTable.[201905],0)+
                            isnull(PivotTable.[201906],0)+
                            isnull(PivotTable.[201907],0)+
                            isnull(PivotTable.[201908],0)+
                            isnull(PivotTable.[201909],0)+
                            isnull(PivotTable.[201910],0)+
                            isnull(PivotTable.[201911],0)+
                            isnull(PivotTable.[201912],0)+
                            isnull(PivotTable.[202001],0)+
                            isnull(PivotTable.[202002],0)+
                            isnull(PivotTable.[202003],0)+
                            isnull(PivotTable.[202004],0)+
                            isnull(PivotTable.[202005],0)+
                            isnull(PivotTable.[202006],0)+
                            isnull(PivotTable.[202007],0)+
                            isnull(PivotTable.[202008],0)+
                            isnull(PivotTable.[202009],0)+
                            isnull(PivotTable.[202010],0)+
                            isnull(PivotTable.[202011],0)+
                            isnull(PivotTable.[202012],0)+
                            isnull(PivotTable.[202101],0)+
                            isnull(PivotTable.[202102],0)+
                            isnull(PivotTable.[202103],0)+
                            isnull(PivotTable.[202104],0)+
                            isnull(PivotTable.[202105],0)+
                            isnull(PivotTable.[202106],0)+
                            isnull(PivotTable.[202107],0)+
                            isnull(PivotTable.[202108],0)+
                            isnull(PivotTable.[202109],0)+
                            isnull(PivotTable.[202110],0)+
                            isnull(PivotTable.[202111],0)+
                    	    isnull(PivotTable.[202112],0)+
                    		isnull(PivotTable.[202201],0)+
                    		isnull(PivotTable.[202202],0)+
                    		isnull(PivotTable.[202203],0)+
                    		isnull(PivotTable.[202204],0)+
                    		isnull(PivotTable.[202205],0)+
                    		isnull(PivotTable.[202206],0)+
                    		isnull(PivotTable.[202207],0)+
                    		isnull(PivotTable.[202208],0)+
                    		isnull(PivotTable.[202209],0)+
                    		isnull(PivotTable.[202210],0)+
                    		isnull(PivotTable.[202211],0)+
                    		isnull(PivotTable.[202212],0)

                            )


FROM
(
  select  ORDEN=32 ,CTA_AUXILIAR_2 ='HONORARIOS MEDICO LABORAL' ,  ANIOMES, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras2()
  WHERE AÑO BETWEEN $AniIni AND $AniFin AND NMES BETWEEN $MesIni AND $MesFin AND EMPRESA='EJECUTADO' AND AREA like '%%' AND CC_MAYOR='6 - ADMINISTRACION' AND CENTRO_DE_COSTO='60228-SEGURIDAD Y SALUD LABORAL'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND CTA_AUXILIAR = '511095 - OTROS - HONORARIOS'
    
GROUP BY ORDEN,CTA_AUXILIAR_2,ANIOMES 
) AS SourceTable 

PIVOT(SUM(NETO) FOR ANIOMES IN([201501],
[201502],
[201503],
[201504],
[201505],
[201506],
[201507],
[201508],
[201509],
[201510],
[201511],
[201512],
[201601],
[201602],
[201603],
[201604],
[201605],
[201606],
[201607],
[201608],
[201609],
[201610],
[201611],
[201612],
[201701],
[201702],
[201703],
[201704],
[201705],
[201706],
[201707],
[201708],
[201709],
[201710],
[201711],
[201712],
[201801],
[201802],
[201803],
[201804],
[201805],
[201806],
[201807],
[201808],
[201809],
[201810],
[201811],
[201812],
[201901],
[201902],
[201903],
[201904],
[201905],
[201906],
[201907],
[201908],
[201909],
[201910],
[201911],
[201912],
[202001],
[202002],
[202003],
[202004],
[202005],
[202006],
[202007],
[202008],
[202009],
[202010],
[202011],
[202012],
[202101],
[202102],
[202103],
[202104],
[202105],
[202106],
[202107],
[202108],
[202109],
[202110],
[202111],
[202112],
[202201],
[202202],
[202203],
[202204],
[202205],
[202206],
[202207],
[202208],
[202209],
[202210],
[202211],
[202212]
)) AS PivotTable

) D

UNION ALL

--FIN CALCULO

SELECT ORDEN,CTA_AUXILIAR_2,
                            PivotTable.[201501] as Enero2015,
                            PivotTable.[201502] as Febrero2015,
                            PivotTable.[201503] as Marzo2015,
                            PivotTable.[201504] as Abril2015,
                            PivotTable.[201505] as Mayo2015,
                            PivotTable.[201506] as Junio2015,
                            PivotTable.[201507] as Julio2015,
                            PivotTable.[201508] as Agosto2015,
                            PivotTable.[201509] as Septiembre2015,
                            PivotTable.[201510] as Octubre2015,
                            PivotTable.[201511] as Noviembre2015,
                            PivotTable.[201512] as Diciembre2015,
                            PivotTable.[201601] as Enero2016,
                            PivotTable.[201602] as Febrero2016,
                            PivotTable.[201603] as Marzo2016,
                            PivotTable.[201604] as Abril2016,
                            PivotTable.[201605] as Mayo2016,
                            PivotTable.[201606] as Junio2016,
                            PivotTable.[201607] as Julio2016,
                            PivotTable.[201608] as Agosto2016,
                            PivotTable.[201609] as Septiembre2016,
                            PivotTable.[201610] as Octubre2016,
                            PivotTable.[201611] as Noviembre2016,
                            PivotTable.[201612] as Diciembre2016,
                            PivotTable.[201701] as Enero2017,
                            PivotTable.[201702] as Febrero2017,
                            PivotTable.[201703] as Marzo2017,
                            PivotTable.[201704] as Abril2017,
                            PivotTable.[201705] as Mayo2017,
                            PivotTable.[201706] as Junio2017,
                            PivotTable.[201707] as Julio2017,
                            PivotTable.[201708] as Agosto2017,
                            PivotTable.[201709] as Septiembre2017,
                            PivotTable.[201710] as Octubre2017,
                            PivotTable.[201711] as Noviembre2017,
                            PivotTable.[201712] as Diciembre2017,
                            PivotTable.[201801] as Enero2018,
                            PivotTable.[201802] as Febrero2018,
                            PivotTable.[201803] as Marzo2018,
                            PivotTable.[201804] as Abril2018,
                            PivotTable.[201805] as Mayo2018,
                            PivotTable.[201806] as Junio2018,
                            PivotTable.[201807] as Julio2018,
                            PivotTable.[201808] as Agosto2018,
                            PivotTable.[201809] as Septiembre2018,
                            PivotTable.[201810] as Octubre2018,
                            PivotTable.[201811] as Noviembre2018,
                            PivotTable.[201812] as Diciembre2018,
                            PivotTable.[201901] as Enero2019,
                            PivotTable.[201902] as Febrero2019,
                            PivotTable.[201903] as Marzo2019,
                            PivotTable.[201904] as Abril2019,
                            PivotTable.[201905] as Mayo2019,
                            PivotTable.[201906] as Junio2019,
                            PivotTable.[201907] as Julio2019,
                            PivotTable.[201908] as Agosto2019,
                            PivotTable.[201909] as Septiembre2019,
                            PivotTable.[201910] as Octubre2019,
                            PivotTable.[201911] as Noviembre2019,
                            PivotTable.[201912] as Diciembre2019,
                            PivotTable.[202001] as Enero2020,
                            PivotTable.[202002] as Febrero2020,
                            PivotTable.[202003] as Marzo2020,
                            PivotTable.[202004] as Abril2020,
                            PivotTable.[202005] as Mayo2020,
                            PivotTable.[202006] as Junio2020,
                            PivotTable.[202007] as Julio2020,
                            PivotTable.[202008] as Agosto2020,
                            PivotTable.[202009] as Septiembre2020,
                            PivotTable.[202010] as Octubre2020,
                            PivotTable.[202011] as Noviembre2020,
                            PivotTable.[202012] as Diciembre2020,
                            PivotTable.[202101] as Enero2021,
                            PivotTable.[202102] as Febrero2021,
                            PivotTable.[202103] as Marzo2021,
                            PivotTable.[202104] as Abril2021,
                            PivotTable.[202105] as Mayo2021,
                            PivotTable.[202106] as Junio2021,
                            PivotTable.[202107] as Julio2021,
                            PivotTable.[202108] as Agosto2021,
                            PivotTable.[202109] as Septiembre2021,
                            PivotTable.[202110] as Octubre2021,
                            PivotTable.[202111] as Noviembre2021,
                                                        PivotTable.[202112] as Diciembre2021,
                            PivotTable.[202201] as Enero2022,
                            PivotTable.[202202] as Febrero2022,
                            PivotTable.[202203] as Marzo2022,
                            PivotTable.[202204] as Abril2022,
                            PivotTable.[202205] as Mayo2022,
                            PivotTable.[202206] as Junio2022,
                            PivotTable.[202207] as Julio2022,
                            PivotTable.[202208] as Agosto2022,
                            PivotTable.[202209] as Septiembre2022,
                            PivotTable.[202210] as Octubre2022,
                            PivotTable.[202211] as Noviembre2022,
                            PivotTable.[202212] as Diciembre2022,
                            Total= (
                            isnull(PivotTable.[201501],0)+
isnull(PivotTable.[201502],0)+
isnull(PivotTable.[201503],0)+
isnull(PivotTable.[201504],0)+
isnull(PivotTable.[201505],0)+
isnull(PivotTable.[201506],0)+
isnull(PivotTable.[201507],0)+
isnull(PivotTable.[201508],0)+
isnull(PivotTable.[201509],0)+
isnull(PivotTable.[201510],0)+
isnull(PivotTable.[201511],0)+
isnull(PivotTable.[201512],0)+
isnull(PivotTable.[201601],0)+
isnull(PivotTable.[201602],0)+
isnull(PivotTable.[201603],0)+
isnull(PivotTable.[201604],0)+
isnull(PivotTable.[201605],0)+
isnull(PivotTable.[201606],0)+
isnull(PivotTable.[201607],0)+
isnull(PivotTable.[201608],0)+
isnull(PivotTable.[201609],0)+
isnull(PivotTable.[201610],0)+
isnull(PivotTable.[201611],0)+
isnull(PivotTable.[201612],0)+
isnull(PivotTable.[201701],0)+
isnull(PivotTable.[201702],0)+
isnull(PivotTable.[201703],0)+
isnull(PivotTable.[201704],0)+
isnull(PivotTable.[201705],0)+
isnull(PivotTable.[201706],0)+
isnull(PivotTable.[201707],0)+
isnull(PivotTable.[201708],0)+
isnull(PivotTable.[201709],0)+
isnull(PivotTable.[201710],0)+
isnull(PivotTable.[201711],0)+
isnull(PivotTable.[201712],0)+
isnull(PivotTable.[201801],0)+
isnull(PivotTable.[201802],0)+
isnull(PivotTable.[201803],0)+
isnull(PivotTable.[201804],0)+
isnull(PivotTable.[201805],0)+
isnull(PivotTable.[201806],0)+
isnull(PivotTable.[201807],0)+
isnull(PivotTable.[201808],0)+
isnull(PivotTable.[201809],0)+
isnull(PivotTable.[201810],0)+
isnull(PivotTable.[201811],0)+
isnull(PivotTable.[201812],0)+
isnull(PivotTable.[201901],0)+
isnull(PivotTable.[201902],0)+
isnull(PivotTable.[201903],0)+
isnull(PivotTable.[201904],0)+
isnull(PivotTable.[201905],0)+
isnull(PivotTable.[201906],0)+
isnull(PivotTable.[201907],0)+
isnull(PivotTable.[201908],0)+
isnull(PivotTable.[201909],0)+
isnull(PivotTable.[201910],0)+
isnull(PivotTable.[201911],0)+
isnull(PivotTable.[201912],0)+
isnull(PivotTable.[202001],0)+
isnull(PivotTable.[202002],0)+
isnull(PivotTable.[202003],0)+
isnull(PivotTable.[202004],0)+
isnull(PivotTable.[202005],0)+
isnull(PivotTable.[202006],0)+
isnull(PivotTable.[202007],0)+
isnull(PivotTable.[202008],0)+
isnull(PivotTable.[202009],0)+
isnull(PivotTable.[202010],0)+
isnull(PivotTable.[202011],0)+
isnull(PivotTable.[202012],0)+
isnull(PivotTable.[202101],0)+
isnull(PivotTable.[202102],0)+
isnull(PivotTable.[202103],0)+
isnull(PivotTable.[202104],0)+
isnull(PivotTable.[202105],0)+
isnull(PivotTable.[202106],0)+
isnull(PivotTable.[202107],0)+
isnull(PivotTable.[202108],0)+
isnull(PivotTable.[202109],0)+
isnull(PivotTable.[202110],0)+
isnull(PivotTable.[202111],0)+
	    isnull(PivotTable.[202112],0)+
		isnull(PivotTable.[202201],0)+
		isnull(PivotTable.[202202],0)+
		isnull(PivotTable.[202203],0)+
		isnull(PivotTable.[202204],0)+
		isnull(PivotTable.[202205],0)+
		isnull(PivotTable.[202206],0)+
		isnull(PivotTable.[202207],0)+
		isnull(PivotTable.[202208],0)+
		isnull(PivotTable.[202209],0)+
		isnull(PivotTable.[202210],0)+
		isnull(PivotTable.[202211],0)+
		isnull(PivotTable.[202212],0)

                            )


FROM
(
  select  ORDEN,CTA_AUXILIAR_2,  ANIOMES, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras()
  WHERE AÑO BETWEEN $AniIni AND $AniFin AND NMES BETWEEN $MesIni AND $MesFin AND CTA_AUXILIAR_2 NOT IN ('TEMPORALES') AND EMPRESA='EJECUTADO' AND AREA like '%%'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS')  
        
GROUP BY ORDEN,CTA_AUXILIAR_2,ANIOMES 
) AS SourceTable 

PIVOT(SUM(NETO) FOR ANIOMES IN([201501],
[201502],
[201503],
[201504],
[201505],
[201506],
[201507],
[201508],
[201509],
[201510],
[201511],
[201512],
[201601],
[201602],
[201603],
[201604],
[201605],
[201606],
[201607],
[201608],
[201609],
[201610],
[201611],
[201612],
[201701],
[201702],
[201703],
[201704],
[201705],
[201706],
[201707],
[201708],
[201709],
[201710],
[201711],
[201712],
[201801],
[201802],
[201803],
[201804],
[201805],
[201806],
[201807],
[201808],
[201809],
[201810],
[201811],
[201812],
[201901],
[201902],
[201903],
[201904],
[201905],
[201906],
[201907],
[201908],
[201909],
[201910],
[201911],
[201912],
[202001],
[202002],
[202003],
[202004],
[202005],
[202006],
[202007],
[202008],
[202009],
[202010],
[202011],
[202012],
[202101],
[202102],
[202103],
[202104],
[202105],
[202106],
[202107],
[202108],
[202109],
[202110],
[202111],
[202112],
[202201],
[202202],
[202203],
[202204],
[202205],
[202206],
[202207],
[202208],
[202209],
[202210],
[202211],
[202212]
)) AS PivotTable

UNION ALL

SELECT ORDEN,CTA_AUXILIAR_2,
                            PivotTable.[201501] as Enero2015,
                            PivotTable.[201502] as Febrero2015,
                            PivotTable.[201503] as Marzo2015,
                            PivotTable.[201504] as Abril2015,
                            PivotTable.[201505] as Mayo2015,
                            PivotTable.[201506] as Junio2015,
                            PivotTable.[201507] as Julio2015,
                            PivotTable.[201508] as Agosto2015,
                            PivotTable.[201509] as Septiembre2015,
                            PivotTable.[201510] as Octubre2015,
                            PivotTable.[201511] as Noviembre2015,
                            PivotTable.[201512] as Diciembre2015,
                            PivotTable.[201601] as Enero2016,
                            PivotTable.[201602] as Febrero2016,
                            PivotTable.[201603] as Marzo2016,
                            PivotTable.[201604] as Abril2016,
                            PivotTable.[201605] as Mayo2016,
                            PivotTable.[201606] as Junio2016,
                            PivotTable.[201607] as Julio2016,
                            PivotTable.[201608] as Agosto2016,
                            PivotTable.[201609] as Septiembre2016,
                            PivotTable.[201610] as Octubre2016,
                            PivotTable.[201611] as Noviembre2016,
                            PivotTable.[201612] as Diciembre2016,
                            PivotTable.[201701] as Enero2017,
                            PivotTable.[201702] as Febrero2017,
                            PivotTable.[201703] as Marzo2017,
                            PivotTable.[201704] as Abril2017,
                            PivotTable.[201705] as Mayo2017,
                            PivotTable.[201706] as Junio2017,
                            PivotTable.[201707] as Julio2017,
                            PivotTable.[201708] as Agosto2017,
                            PivotTable.[201709] as Septiembre2017,
                            PivotTable.[201710] as Octubre2017,
                            PivotTable.[201711] as Noviembre2017,
                            PivotTable.[201712] as Diciembre2017,
                            PivotTable.[201801] as Enero2018,
                            PivotTable.[201802] as Febrero2018,
                            PivotTable.[201803] as Marzo2018,
                            PivotTable.[201804] as Abril2018,
                            PivotTable.[201805] as Mayo2018,
                            PivotTable.[201806] as Junio2018,
                            PivotTable.[201807] as Julio2018,
                            PivotTable.[201808] as Agosto2018,
                            PivotTable.[201809] as Septiembre2018,
                            PivotTable.[201810] as Octubre2018,
                            PivotTable.[201811] as Noviembre2018,
                            PivotTable.[201812] as Diciembre2018,
                            PivotTable.[201901] as Enero2019,
                            PivotTable.[201902] as Febrero2019,
                            PivotTable.[201903] as Marzo2019,
                            PivotTable.[201904] as Abril2019,
                            PivotTable.[201905] as Mayo2019,
                            PivotTable.[201906] as Junio2019,
                            PivotTable.[201907] as Julio2019,
                            PivotTable.[201908] as Agosto2019,
                            PivotTable.[201909] as Septiembre2019,
                            PivotTable.[201910] as Octubre2019,
                            PivotTable.[201911] as Noviembre2019,
                            PivotTable.[201912] as Diciembre2019,
                            PivotTable.[202001] as Enero2020,
                            PivotTable.[202002] as Febrero2020,
                            PivotTable.[202003] as Marzo2020,
                            PivotTable.[202004] as Abril2020,
                            PivotTable.[202005] as Mayo2020,
                            PivotTable.[202006] as Junio2020,
                            PivotTable.[202007] as Julio2020,
                            PivotTable.[202008] as Agosto2020,
                            PivotTable.[202009] as Septiembre2020,
                            PivotTable.[202010] as Octubre2020,
                            PivotTable.[202011] as Noviembre2020,
                            PivotTable.[202012] as Diciembre2020,
                            PivotTable.[202101] as Enero2021,
                            PivotTable.[202102] as Febrero2021,
                            PivotTable.[202103] as Marzo2021,
                            PivotTable.[202104] as Abril2021,
                            PivotTable.[202105] as Mayo2021,
                            PivotTable.[202106] as Junio2021,
                            PivotTable.[202107] as Julio2021,
                            PivotTable.[202108] as Agosto2021,
                            PivotTable.[202109] as Septiembre2021,
                            PivotTable.[202110] as Octubre2021,
                            PivotTable.[202111] as Noviembre2021,
                                                        PivotTable.[202112] as Diciembre2021,
                            PivotTable.[202201] as Enero2022,
                            PivotTable.[202202] as Febrero2022,
                            PivotTable.[202203] as Marzo2022,
                            PivotTable.[202204] as Abril2022,
                            PivotTable.[202205] as Mayo2022,
                            PivotTable.[202206] as Junio2022,
                            PivotTable.[202207] as Julio2022,
                            PivotTable.[202208] as Agosto2022,
                            PivotTable.[202209] as Septiembre2022,
                            PivotTable.[202210] as Octubre2022,
                            PivotTable.[202211] as Noviembre2022,
                            PivotTable.[202212] as Diciembre2022,
                            Total= (
                            isnull(PivotTable.[201501],0)+
        isnull(PivotTable.[201502],0)+
        isnull(PivotTable.[201503],0)+
        isnull(PivotTable.[201504],0)+
        isnull(PivotTable.[201505],0)+
        isnull(PivotTable.[201506],0)+
        isnull(PivotTable.[201507],0)+
        isnull(PivotTable.[201508],0)+
        isnull(PivotTable.[201509],0)+
        isnull(PivotTable.[201510],0)+
        isnull(PivotTable.[201511],0)+
        isnull(PivotTable.[201512],0)+
        isnull(PivotTable.[201601],0)+
        isnull(PivotTable.[201602],0)+
        isnull(PivotTable.[201603],0)+
        isnull(PivotTable.[201604],0)+
        isnull(PivotTable.[201605],0)+
        isnull(PivotTable.[201606],0)+
        isnull(PivotTable.[201607],0)+
        isnull(PivotTable.[201608],0)+
        isnull(PivotTable.[201609],0)+
        isnull(PivotTable.[201610],0)+
        isnull(PivotTable.[201611],0)+
        isnull(PivotTable.[201612],0)+
        isnull(PivotTable.[201701],0)+
        isnull(PivotTable.[201702],0)+
        isnull(PivotTable.[201703],0)+
        isnull(PivotTable.[201704],0)+
        isnull(PivotTable.[201705],0)+
        isnull(PivotTable.[201706],0)+
        isnull(PivotTable.[201707],0)+
        isnull(PivotTable.[201708],0)+
        isnull(PivotTable.[201709],0)+
        isnull(PivotTable.[201710],0)+
        isnull(PivotTable.[201711],0)+
        isnull(PivotTable.[201712],0)+
        isnull(PivotTable.[201801],0)+
        isnull(PivotTable.[201802],0)+
        isnull(PivotTable.[201803],0)+
        isnull(PivotTable.[201804],0)+
        isnull(PivotTable.[201805],0)+
        isnull(PivotTable.[201806],0)+
        isnull(PivotTable.[201807],0)+
        isnull(PivotTable.[201808],0)+
        isnull(PivotTable.[201809],0)+
        isnull(PivotTable.[201810],0)+
        isnull(PivotTable.[201811],0)+
        isnull(PivotTable.[201812],0)+
        isnull(PivotTable.[201901],0)+
        isnull(PivotTable.[201902],0)+
        isnull(PivotTable.[201903],0)+
        isnull(PivotTable.[201904],0)+
        isnull(PivotTable.[201905],0)+
        isnull(PivotTable.[201906],0)+
        isnull(PivotTable.[201907],0)+
        isnull(PivotTable.[201908],0)+
        isnull(PivotTable.[201909],0)+
        isnull(PivotTable.[201910],0)+
        isnull(PivotTable.[201911],0)+
        isnull(PivotTable.[201912],0)+
        isnull(PivotTable.[202001],0)+
        isnull(PivotTable.[202002],0)+
        isnull(PivotTable.[202003],0)+
        isnull(PivotTable.[202004],0)+
        isnull(PivotTable.[202005],0)+
        isnull(PivotTable.[202006],0)+
        isnull(PivotTable.[202007],0)+
        isnull(PivotTable.[202008],0)+
        isnull(PivotTable.[202009],0)+
        isnull(PivotTable.[202010],0)+
        isnull(PivotTable.[202011],0)+
        isnull(PivotTable.[202012],0)+
        isnull(PivotTable.[202101],0)+
        isnull(PivotTable.[202102],0)+
        isnull(PivotTable.[202103],0)+
        isnull(PivotTable.[202104],0)+
        isnull(PivotTable.[202105],0)+
        isnull(PivotTable.[202106],0)+
        isnull(PivotTable.[202107],0)+
        isnull(PivotTable.[202108],0)+
        isnull(PivotTable.[202109],0)+
        isnull(PivotTable.[202110],0)+
        isnull(PivotTable.[202111],0)+
        	    isnull(PivotTable.[202112],0)+
		isnull(PivotTable.[202201],0)+
		isnull(PivotTable.[202202],0)+
		isnull(PivotTable.[202203],0)+
		isnull(PivotTable.[202204],0)+
		isnull(PivotTable.[202205],0)+
		isnull(PivotTable.[202206],0)+
		isnull(PivotTable.[202207],0)+
		isnull(PivotTable.[202208],0)+
		isnull(PivotTable.[202209],0)+
		isnull(PivotTable.[202210],0)+
		isnull(PivotTable.[202211],0)+
		isnull(PivotTable.[202212],0)

                            )


FROM
(
  select  ORDEN=29,CTA_AUXILIAR_2 ='COSTO NETO OTROS SSL',  ANIOMES, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras()
  WHERE AÑO BETWEEN $AniIni AND $AniFin AND NMES BETWEEN $MesIni AND $MesFin AND CTA_AUXILIAR_2 NOT IN ('TEMPORALES') AND EMPRESA='EJECUTADO' AND AREA like '%%'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS')  
        
GROUP BY ORDEN,CTA_AUXILIAR_2,ANIOMES 
) AS SourceTable 

PIVOT(SUM(NETO) FOR ANIOMES IN([201501],
[201502],
[201503],
[201504],
[201505],
[201506],
[201507],
[201508],
[201509],
[201510],
[201511],
[201512],
[201601],
[201602],
[201603],
[201604],
[201605],
[201606],
[201607],
[201608],
[201609],
[201610],
[201611],
[201612],
[201701],
[201702],
[201703],
[201704],
[201705],
[201706],
[201707],
[201708],
[201709],
[201710],
[201711],
[201712],
[201801],
[201802],
[201803],
[201804],
[201805],
[201806],
[201807],
[201808],
[201809],
[201810],
[201811],
[201812],
[201901],
[201902],
[201903],
[201904],
[201905],
[201906],
[201907],
[201908],
[201909],
[201910],
[201911],
[201912],
[202001],
[202002],
[202003],
[202004],
[202005],
[202006],
[202007],
[202008],
[202009],
[202010],
[202011],
[202012],
[202101],
[202102],
[202103],
[202104],
[202105],
[202106],
[202107],
[202108],
[202109],
[202110],
[202111],
[202112],
[202201],
[202202],
[202203],
[202204],
[202205],
[202206],
[202207],
[202208],
[202209],
[202210],
[202211],
[202212]
)) AS PivotTable

UNION ALL


SELECT ORDEN,CTA_AUXILIAR_2,
                            PivotTable.[201501] as Enero2015,
                            PivotTable.[201502] as Febrero2015,
                            PivotTable.[201503] as Marzo2015,
                            PivotTable.[201504] as Abril2015,
                            PivotTable.[201505] as Mayo2015,
                            PivotTable.[201506] as Junio2015,
                            PivotTable.[201507] as Julio2015,
                            PivotTable.[201508] as Agosto2015,
                            PivotTable.[201509] as Septiembre2015,
                            PivotTable.[201510] as Octubre2015,
                            PivotTable.[201511] as Noviembre2015,
                            PivotTable.[201512] as Diciembre2015,
                            PivotTable.[201601] as Enero2016,
                            PivotTable.[201602] as Febrero2016,
                            PivotTable.[201603] as Marzo2016,
                            PivotTable.[201604] as Abril2016,
                            PivotTable.[201605] as Mayo2016,
                            PivotTable.[201606] as Junio2016,
                            PivotTable.[201607] as Julio2016,
                            PivotTable.[201608] as Agosto2016,
                            PivotTable.[201609] as Septiembre2016,
                            PivotTable.[201610] as Octubre2016,
                            PivotTable.[201611] as Noviembre2016,
                            PivotTable.[201612] as Diciembre2016,
                            PivotTable.[201701] as Enero2017,
                            PivotTable.[201702] as Febrero2017,
                            PivotTable.[201703] as Marzo2017,
                            PivotTable.[201704] as Abril2017,
                            PivotTable.[201705] as Mayo2017,
                            PivotTable.[201706] as Junio2017,
                            PivotTable.[201707] as Julio2017,
                            PivotTable.[201708] as Agosto2017,
                            PivotTable.[201709] as Septiembre2017,
                            PivotTable.[201710] as Octubre2017,
                            PivotTable.[201711] as Noviembre2017,
                            PivotTable.[201712] as Diciembre2017,
                            PivotTable.[201801] as Enero2018,
                            PivotTable.[201802] as Febrero2018,
                            PivotTable.[201803] as Marzo2018,
                            PivotTable.[201804] as Abril2018,
                            PivotTable.[201805] as Mayo2018,
                            PivotTable.[201806] as Junio2018,
                            PivotTable.[201807] as Julio2018,
                            PivotTable.[201808] as Agosto2018,
                            PivotTable.[201809] as Septiembre2018,
                            PivotTable.[201810] as Octubre2018,
                            PivotTable.[201811] as Noviembre2018,
                            PivotTable.[201812] as Diciembre2018,
                            PivotTable.[201901] as Enero2019,
                            PivotTable.[201902] as Febrero2019,
                            PivotTable.[201903] as Marzo2019,
                            PivotTable.[201904] as Abril2019,
                            PivotTable.[201905] as Mayo2019,
                            PivotTable.[201906] as Junio2019,
                            PivotTable.[201907] as Julio2019,
                            PivotTable.[201908] as Agosto2019,
                            PivotTable.[201909] as Septiembre2019,
                            PivotTable.[201910] as Octubre2019,
                            PivotTable.[201911] as Noviembre2019,
                            PivotTable.[201912] as Diciembre2019,
                            PivotTable.[202001] as Enero2020,
                            PivotTable.[202002] as Febrero2020,
                            PivotTable.[202003] as Marzo2020,
                            PivotTable.[202004] as Abril2020,
                            PivotTable.[202005] as Mayo2020,
                            PivotTable.[202006] as Junio2020,
                            PivotTable.[202007] as Julio2020,
                            PivotTable.[202008] as Agosto2020,
                            PivotTable.[202009] as Septiembre2020,
                            PivotTable.[202010] as Octubre2020,
                            PivotTable.[202011] as Noviembre2020,
                            PivotTable.[202012] as Diciembre2020,
                            PivotTable.[202101] as Enero2021,
                            PivotTable.[202102] as Febrero2021,
                            PivotTable.[202103] as Marzo2021,
                            PivotTable.[202104] as Abril2021,
                            PivotTable.[202105] as Mayo2021,
                            PivotTable.[202106] as Junio2021,
                            PivotTable.[202107] as Julio2021,
                            PivotTable.[202108] as Agosto2021,
                            PivotTable.[202109] as Septiembre2021,
                            PivotTable.[202110] as Octubre2021,
                            PivotTable.[202111] as Noviembre2021,
                                                        PivotTable.[202112] as Diciembre2021,
                            PivotTable.[202201] as Enero2022,
                            PivotTable.[202202] as Febrero2022,
                            PivotTable.[202203] as Marzo2022,
                            PivotTable.[202204] as Abril2022,
                            PivotTable.[202205] as Mayo2022,
                            PivotTable.[202206] as Junio2022,
                            PivotTable.[202207] as Julio2022,
                            PivotTable.[202208] as Agosto2022,
                            PivotTable.[202209] as Septiembre2022,
                            PivotTable.[202210] as Octubre2022,
                            PivotTable.[202211] as Noviembre2022,
                            PivotTable.[202212] as Diciembre2022,
                            Total= (
                            isnull(PivotTable.[201501],0)+
isnull(PivotTable.[201502],0)+
isnull(PivotTable.[201503],0)+
isnull(PivotTable.[201504],0)+
isnull(PivotTable.[201505],0)+
isnull(PivotTable.[201506],0)+
isnull(PivotTable.[201507],0)+
isnull(PivotTable.[201508],0)+
isnull(PivotTable.[201509],0)+
isnull(PivotTable.[201510],0)+
isnull(PivotTable.[201511],0)+
isnull(PivotTable.[201512],0)+
isnull(PivotTable.[201601],0)+
isnull(PivotTable.[201602],0)+
isnull(PivotTable.[201603],0)+
isnull(PivotTable.[201604],0)+
isnull(PivotTable.[201605],0)+
isnull(PivotTable.[201606],0)+
isnull(PivotTable.[201607],0)+
isnull(PivotTable.[201608],0)+
isnull(PivotTable.[201609],0)+
isnull(PivotTable.[201610],0)+
isnull(PivotTable.[201611],0)+
isnull(PivotTable.[201612],0)+
isnull(PivotTable.[201701],0)+
isnull(PivotTable.[201702],0)+
isnull(PivotTable.[201703],0)+
isnull(PivotTable.[201704],0)+
isnull(PivotTable.[201705],0)+
isnull(PivotTable.[201706],0)+
isnull(PivotTable.[201707],0)+
isnull(PivotTable.[201708],0)+
isnull(PivotTable.[201709],0)+
isnull(PivotTable.[201710],0)+
isnull(PivotTable.[201711],0)+
isnull(PivotTable.[201712],0)+
isnull(PivotTable.[201801],0)+
isnull(PivotTable.[201802],0)+
isnull(PivotTable.[201803],0)+
isnull(PivotTable.[201804],0)+
isnull(PivotTable.[201805],0)+
isnull(PivotTable.[201806],0)+
isnull(PivotTable.[201807],0)+
isnull(PivotTable.[201808],0)+
isnull(PivotTable.[201809],0)+
isnull(PivotTable.[201810],0)+
isnull(PivotTable.[201811],0)+
isnull(PivotTable.[201812],0)+
isnull(PivotTable.[201901],0)+
isnull(PivotTable.[201902],0)+
isnull(PivotTable.[201903],0)+
isnull(PivotTable.[201904],0)+
isnull(PivotTable.[201905],0)+
isnull(PivotTable.[201906],0)+
isnull(PivotTable.[201907],0)+
isnull(PivotTable.[201908],0)+
isnull(PivotTable.[201909],0)+
isnull(PivotTable.[201910],0)+
isnull(PivotTable.[201911],0)+
isnull(PivotTable.[201912],0)+
isnull(PivotTable.[202001],0)+
isnull(PivotTable.[202002],0)+
isnull(PivotTable.[202003],0)+
isnull(PivotTable.[202004],0)+
isnull(PivotTable.[202005],0)+
isnull(PivotTable.[202006],0)+
isnull(PivotTable.[202007],0)+
isnull(PivotTable.[202008],0)+
isnull(PivotTable.[202009],0)+
isnull(PivotTable.[202010],0)+
isnull(PivotTable.[202011],0)+
isnull(PivotTable.[202012],0)+
isnull(PivotTable.[202101],0)+
isnull(PivotTable.[202102],0)+
isnull(PivotTable.[202103],0)+
isnull(PivotTable.[202104],0)+
isnull(PivotTable.[202105],0)+
isnull(PivotTable.[202106],0)+
isnull(PivotTable.[202107],0)+
isnull(PivotTable.[202108],0)+
isnull(PivotTable.[202109],0)+
isnull(PivotTable.[202110],0)+
isnull(PivotTable.[202111],0)+
	    isnull(PivotTable.[202112],0)+
		isnull(PivotTable.[202201],0)+
		isnull(PivotTable.[202202],0)+
		isnull(PivotTable.[202203],0)+
		isnull(PivotTable.[202204],0)+
		isnull(PivotTable.[202205],0)+
		isnull(PivotTable.[202206],0)+
		isnull(PivotTable.[202207],0)+
		isnull(PivotTable.[202208],0)+
		isnull(PivotTable.[202209],0)+
		isnull(PivotTable.[202210],0)+
		isnull(PivotTable.[202211],0)+
		isnull(PivotTable.[202212],0)

                            )


FROM
(
  select  ORDEN = 30 ,CTA_AUXILIAR_2 ='DPTO. DE SEGURIDAD Y SALUD LABORAL',  ANIOMES, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras2()
 WHERE AÑO BETWEEN $AniIni AND $AniFin AND NMES BETWEEN $MesIni AND $MesFin AND EMPRESA='EJECUTADO' AND AREA like '%%' AND CC_MAYOR='6 - ADMINISTRACION' AND CENTRO_DE_COSTO='60228-SEGURIDAD Y SALUD LABORAL'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND CTA_AUXILIAR NOT IN ('511025 - ASESORIA JURIDICA','511095 - OTROS - HONORARIOS')
        
GROUP BY ORDEN,CTA_AUXILIAR_2,ANIOMES 
) AS SourceTable 

PIVOT(SUM(NETO) FOR ANIOMES IN([201501],
[201502],
[201503],
[201504],
[201505],
[201506],
[201507],
[201508],
[201509],
[201510],
[201511],
[201512],
[201601],
[201602],
[201603],
[201604],
[201605],
[201606],
[201607],
[201608],
[201609],
[201610],
[201611],
[201612],
[201701],
[201702],
[201703],
[201704],
[201705],
[201706],
[201707],
[201708],
[201709],
[201710],
[201711],
[201712],
[201801],
[201802],
[201803],
[201804],
[201805],
[201806],
[201807],
[201808],
[201809],
[201810],
[201811],
[201812],
[201901],
[201902],
[201903],
[201904],
[201905],
[201906],
[201907],
[201908],
[201909],
[201910],
[201911],
[201912],
[202001],
[202002],
[202003],
[202004],
[202005],
[202006],
[202007],
[202008],
[202009],
[202010],
[202011],
[202012],
[202101],
[202102],
[202103],
[202104],
[202105],
[202106],
[202107],
[202108],
[202109],
[202110],
[202111],
[202112],
[202201],
[202202],
[202203],
[202204],
[202205],
[202206],
[202207],
[202208],
[202209],
[202210],
[202211],
[202212]
)) AS PivotTable

UNION ALL

SELECT ORDEN,CTA_AUXILIAR_2,
                            PivotTable.[201501] as Enero2015,
                            PivotTable.[201502] as Febrero2015,
                            PivotTable.[201503] as Marzo2015,
                            PivotTable.[201504] as Abril2015,
                            PivotTable.[201505] as Mayo2015,
                            PivotTable.[201506] as Junio2015,
                            PivotTable.[201507] as Julio2015,
                            PivotTable.[201508] as Agosto2015,
                            PivotTable.[201509] as Septiembre2015,
                            PivotTable.[201510] as Octubre2015,
                            PivotTable.[201511] as Noviembre2015,
                            PivotTable.[201512] as Diciembre2015,
                            PivotTable.[201601] as Enero2016,
                            PivotTable.[201602] as Febrero2016,
                            PivotTable.[201603] as Marzo2016,
                            PivotTable.[201604] as Abril2016,
                            PivotTable.[201605] as Mayo2016,
                            PivotTable.[201606] as Junio2016,
                            PivotTable.[201607] as Julio2016,
                            PivotTable.[201608] as Agosto2016,
                            PivotTable.[201609] as Septiembre2016,
                            PivotTable.[201610] as Octubre2016,
                            PivotTable.[201611] as Noviembre2016,
                            PivotTable.[201612] as Diciembre2016,
                            PivotTable.[201701] as Enero2017,
                            PivotTable.[201702] as Febrero2017,
                            PivotTable.[201703] as Marzo2017,
                            PivotTable.[201704] as Abril2017,
                            PivotTable.[201705] as Mayo2017,
                            PivotTable.[201706] as Junio2017,
                            PivotTable.[201707] as Julio2017,
                            PivotTable.[201708] as Agosto2017,
                            PivotTable.[201709] as Septiembre2017,
                            PivotTable.[201710] as Octubre2017,
                            PivotTable.[201711] as Noviembre2017,
                            PivotTable.[201712] as Diciembre2017,
                            PivotTable.[201801] as Enero2018,
                            PivotTable.[201802] as Febrero2018,
                            PivotTable.[201803] as Marzo2018,
                            PivotTable.[201804] as Abril2018,
                            PivotTable.[201805] as Mayo2018,
                            PivotTable.[201806] as Junio2018,
                            PivotTable.[201807] as Julio2018,
                            PivotTable.[201808] as Agosto2018,
                            PivotTable.[201809] as Septiembre2018,
                            PivotTable.[201810] as Octubre2018,
                            PivotTable.[201811] as Noviembre2018,
                            PivotTable.[201812] as Diciembre2018,
                            PivotTable.[201901] as Enero2019,
                            PivotTable.[201902] as Febrero2019,
                            PivotTable.[201903] as Marzo2019,
                            PivotTable.[201904] as Abril2019,
                            PivotTable.[201905] as Mayo2019,
                            PivotTable.[201906] as Junio2019,
                            PivotTable.[201907] as Julio2019,
                            PivotTable.[201908] as Agosto2019,
                            PivotTable.[201909] as Septiembre2019,
                            PivotTable.[201910] as Octubre2019,
                            PivotTable.[201911] as Noviembre2019,
                            PivotTable.[201912] as Diciembre2019,
                            PivotTable.[202001] as Enero2020,
                            PivotTable.[202002] as Febrero2020,
                            PivotTable.[202003] as Marzo2020,
                            PivotTable.[202004] as Abril2020,
                            PivotTable.[202005] as Mayo2020,
                            PivotTable.[202006] as Junio2020,
                            PivotTable.[202007] as Julio2020,
                            PivotTable.[202008] as Agosto2020,
                            PivotTable.[202009] as Septiembre2020,
                            PivotTable.[202010] as Octubre2020,
                            PivotTable.[202011] as Noviembre2020,
                            PivotTable.[202012] as Diciembre2020,
                            PivotTable.[202101] as Enero2021,
                            PivotTable.[202102] as Febrero2021,
                            PivotTable.[202103] as Marzo2021,
                            PivotTable.[202104] as Abril2021,
                            PivotTable.[202105] as Mayo2021,
                            PivotTable.[202106] as Junio2021,
                            PivotTable.[202107] as Julio2021,
                            PivotTable.[202108] as Agosto2021,
                            PivotTable.[202109] as Septiembre2021,
                            PivotTable.[202110] as Octubre2021,
                            PivotTable.[202111] as Noviembre2021,
                                                        PivotTable.[202112] as Diciembre2021,
                            PivotTable.[202201] as Enero2022,
                            PivotTable.[202202] as Febrero2022,
                            PivotTable.[202203] as Marzo2022,
                            PivotTable.[202204] as Abril2022,
                            PivotTable.[202205] as Mayo2022,
                            PivotTable.[202206] as Junio2022,
                            PivotTable.[202207] as Julio2022,
                            PivotTable.[202208] as Agosto2022,
                            PivotTable.[202209] as Septiembre2022,
                            PivotTable.[202210] as Octubre2022,
                            PivotTable.[202211] as Noviembre2022,
                            PivotTable.[202212] as Diciembre2022,
                            Total= (
                            isnull(PivotTable.[201501],0)+
isnull(PivotTable.[201502],0)+
isnull(PivotTable.[201503],0)+
isnull(PivotTable.[201504],0)+
isnull(PivotTable.[201505],0)+
isnull(PivotTable.[201506],0)+
isnull(PivotTable.[201507],0)+
isnull(PivotTable.[201508],0)+
isnull(PivotTable.[201509],0)+
isnull(PivotTable.[201510],0)+
isnull(PivotTable.[201511],0)+
isnull(PivotTable.[201512],0)+
isnull(PivotTable.[201601],0)+
isnull(PivotTable.[201602],0)+
isnull(PivotTable.[201603],0)+
isnull(PivotTable.[201604],0)+
isnull(PivotTable.[201605],0)+
isnull(PivotTable.[201606],0)+
isnull(PivotTable.[201607],0)+
isnull(PivotTable.[201608],0)+
isnull(PivotTable.[201609],0)+
isnull(PivotTable.[201610],0)+
isnull(PivotTable.[201611],0)+
isnull(PivotTable.[201612],0)+
isnull(PivotTable.[201701],0)+
isnull(PivotTable.[201702],0)+
isnull(PivotTable.[201703],0)+
isnull(PivotTable.[201704],0)+
isnull(PivotTable.[201705],0)+
isnull(PivotTable.[201706],0)+
isnull(PivotTable.[201707],0)+
isnull(PivotTable.[201708],0)+
isnull(PivotTable.[201709],0)+
isnull(PivotTable.[201710],0)+
isnull(PivotTable.[201711],0)+
isnull(PivotTable.[201712],0)+
isnull(PivotTable.[201801],0)+
isnull(PivotTable.[201802],0)+
isnull(PivotTable.[201803],0)+
isnull(PivotTable.[201804],0)+
isnull(PivotTable.[201805],0)+
isnull(PivotTable.[201806],0)+
isnull(PivotTable.[201807],0)+
isnull(PivotTable.[201808],0)+
isnull(PivotTable.[201809],0)+
isnull(PivotTable.[201810],0)+
isnull(PivotTable.[201811],0)+
isnull(PivotTable.[201812],0)+
isnull(PivotTable.[201901],0)+
isnull(PivotTable.[201902],0)+
isnull(PivotTable.[201903],0)+
isnull(PivotTable.[201904],0)+
isnull(PivotTable.[201905],0)+
isnull(PivotTable.[201906],0)+
isnull(PivotTable.[201907],0)+
isnull(PivotTable.[201908],0)+
isnull(PivotTable.[201909],0)+
isnull(PivotTable.[201910],0)+
isnull(PivotTable.[201911],0)+
isnull(PivotTable.[201912],0)+
isnull(PivotTable.[202001],0)+
isnull(PivotTable.[202002],0)+
isnull(PivotTable.[202003],0)+
isnull(PivotTable.[202004],0)+
isnull(PivotTable.[202005],0)+
isnull(PivotTable.[202006],0)+
isnull(PivotTable.[202007],0)+
isnull(PivotTable.[202008],0)+
isnull(PivotTable.[202009],0)+
isnull(PivotTable.[202010],0)+
isnull(PivotTable.[202011],0)+
isnull(PivotTable.[202012],0)+
isnull(PivotTable.[202101],0)+
isnull(PivotTable.[202102],0)+
isnull(PivotTable.[202103],0)+
isnull(PivotTable.[202104],0)+
isnull(PivotTable.[202105],0)+
isnull(PivotTable.[202106],0)+
isnull(PivotTable.[202107],0)+
isnull(PivotTable.[202108],0)+
isnull(PivotTable.[202109],0)+
isnull(PivotTable.[202110],0)+
isnull(PivotTable.[202111],0)+
	    isnull(PivotTable.[202112],0)+
		isnull(PivotTable.[202201],0)+
		isnull(PivotTable.[202202],0)+
		isnull(PivotTable.[202203],0)+
		isnull(PivotTable.[202204],0)+
		isnull(PivotTable.[202205],0)+
		isnull(PivotTable.[202206],0)+
		isnull(PivotTable.[202207],0)+
		isnull(PivotTable.[202208],0)+
		isnull(PivotTable.[202209],0)+
		isnull(PivotTable.[202210],0)+
		isnull(PivotTable.[202211],0)+
		isnull(PivotTable.[202212],0)

                            )


FROM
(
  select  ORDEN = 31 ,CTA_AUXILIAR_2 ='HONORARIOS ABOGADO',  ANIOMES, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras2()
WHERE AÑO BETWEEN $AniIni AND $AniFin AND NMES BETWEEN $MesIni AND $MesFin AND EMPRESA='EJECUTADO' AND AREA like '%%' AND CC_MAYOR='6 - ADMINISTRACION' AND CENTRO_DE_COSTO='60228-SEGURIDAD Y SALUD LABORAL'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND CTA_AUXILIAR = '511025 - ASESORIA JURIDICA'
        
GROUP BY ORDEN,CTA_AUXILIAR_2,ANIOMES 
) AS SourceTable 

PIVOT(SUM(NETO) FOR ANIOMES IN([201501],
[201502],
[201503],
[201504],
[201505],
[201506],
[201507],
[201508],
[201509],
[201510],
[201511],
[201512],
[201601],
[201602],
[201603],
[201604],
[201605],
[201606],
[201607],
[201608],
[201609],
[201610],
[201611],
[201612],
[201701],
[201702],
[201703],
[201704],
[201705],
[201706],
[201707],
[201708],
[201709],
[201710],
[201711],
[201712],
[201801],
[201802],
[201803],
[201804],
[201805],
[201806],
[201807],
[201808],
[201809],
[201810],
[201811],
[201812],
[201901],
[201902],
[201903],
[201904],
[201905],
[201906],
[201907],
[201908],
[201909],
[201910],
[201911],
[201912],
[202001],
[202002],
[202003],
[202004],
[202005],
[202006],
[202007],
[202008],
[202009],
[202010],
[202011],
[202012],
[202101],
[202102],
[202103],
[202104],
[202105],
[202106],
[202107],
[202108],
[202109],
[202110],
[202111],
[202112],
[202201],
[202202],
[202203],
[202204],
[202205],
[202206],
[202207],
[202208],
[202209],
[202210],
[202211],
[202212]
)) AS PivotTable

UNION ALL

SELECT ORDEN,CTA_AUXILIAR_2,
                            PivotTable.[201501] as Enero2015,
                            PivotTable.[201502] as Febrero2015,
                            PivotTable.[201503] as Marzo2015,
                            PivotTable.[201504] as Abril2015,
                            PivotTable.[201505] as Mayo2015,
                            PivotTable.[201506] as Junio2015,
                            PivotTable.[201507] as Julio2015,
                            PivotTable.[201508] as Agosto2015,
                            PivotTable.[201509] as Septiembre2015,
                            PivotTable.[201510] as Octubre2015,
                            PivotTable.[201511] as Noviembre2015,
                            PivotTable.[201512] as Diciembre2015,
                            PivotTable.[201601] as Enero2016,
                            PivotTable.[201602] as Febrero2016,
                            PivotTable.[201603] as Marzo2016,
                            PivotTable.[201604] as Abril2016,
                            PivotTable.[201605] as Mayo2016,
                            PivotTable.[201606] as Junio2016,
                            PivotTable.[201607] as Julio2016,
                            PivotTable.[201608] as Agosto2016,
                            PivotTable.[201609] as Septiembre2016,
                            PivotTable.[201610] as Octubre2016,
                            PivotTable.[201611] as Noviembre2016,
                            PivotTable.[201612] as Diciembre2016,
                            PivotTable.[201701] as Enero2017,
                            PivotTable.[201702] as Febrero2017,
                            PivotTable.[201703] as Marzo2017,
                            PivotTable.[201704] as Abril2017,
                            PivotTable.[201705] as Mayo2017,
                            PivotTable.[201706] as Junio2017,
                            PivotTable.[201707] as Julio2017,
                            PivotTable.[201708] as Agosto2017,
                            PivotTable.[201709] as Septiembre2017,
                            PivotTable.[201710] as Octubre2017,
                            PivotTable.[201711] as Noviembre2017,
                            PivotTable.[201712] as Diciembre2017,
                            PivotTable.[201801] as Enero2018,
                            PivotTable.[201802] as Febrero2018,
                            PivotTable.[201803] as Marzo2018,
                            PivotTable.[201804] as Abril2018,
                            PivotTable.[201805] as Mayo2018,
                            PivotTable.[201806] as Junio2018,
                            PivotTable.[201807] as Julio2018,
                            PivotTable.[201808] as Agosto2018,
                            PivotTable.[201809] as Septiembre2018,
                            PivotTable.[201810] as Octubre2018,
                            PivotTable.[201811] as Noviembre2018,
                            PivotTable.[201812] as Diciembre2018,
                            PivotTable.[201901] as Enero2019,
                            PivotTable.[201902] as Febrero2019,
                            PivotTable.[201903] as Marzo2019,
                            PivotTable.[201904] as Abril2019,
                            PivotTable.[201905] as Mayo2019,
                            PivotTable.[201906] as Junio2019,
                            PivotTable.[201907] as Julio2019,
                            PivotTable.[201908] as Agosto2019,
                            PivotTable.[201909] as Septiembre2019,
                            PivotTable.[201910] as Octubre2019,
                            PivotTable.[201911] as Noviembre2019,
                            PivotTable.[201912] as Diciembre2019,
                            PivotTable.[202001] as Enero2020,
                            PivotTable.[202002] as Febrero2020,
                            PivotTable.[202003] as Marzo2020,
                            PivotTable.[202004] as Abril2020,
                            PivotTable.[202005] as Mayo2020,
                            PivotTable.[202006] as Junio2020,
                            PivotTable.[202007] as Julio2020,
                            PivotTable.[202008] as Agosto2020,
                            PivotTable.[202009] as Septiembre2020,
                            PivotTable.[202010] as Octubre2020,
                            PivotTable.[202011] as Noviembre2020,
                            PivotTable.[202012] as Diciembre2020,
                            PivotTable.[202101] as Enero2021,
                            PivotTable.[202102] as Febrero2021,
                            PivotTable.[202103] as Marzo2021,
                            PivotTable.[202104] as Abril2021,
                            PivotTable.[202105] as Mayo2021,
                            PivotTable.[202106] as Junio2021,
                            PivotTable.[202107] as Julio2021,
                            PivotTable.[202108] as Agosto2021,
                            PivotTable.[202109] as Septiembre2021,
                            PivotTable.[202110] as Octubre2021,
                            PivotTable.[202111] as Noviembre2021,
                                                        PivotTable.[202112] as Diciembre2021,
                            PivotTable.[202201] as Enero2022,
                            PivotTable.[202202] as Febrero2022,
                            PivotTable.[202203] as Marzo2022,
                            PivotTable.[202204] as Abril2022,
                            PivotTable.[202205] as Mayo2022,
                            PivotTable.[202206] as Junio2022,
                            PivotTable.[202207] as Julio2022,
                            PivotTable.[202208] as Agosto2022,
                            PivotTable.[202209] as Septiembre2022,
                            PivotTable.[202210] as Octubre2022,
                            PivotTable.[202211] as Noviembre2022,
                            PivotTable.[202212] as Diciembre2022,
                            Total= (
                            isnull(PivotTable.[201501],0)+
isnull(PivotTable.[201502],0)+
isnull(PivotTable.[201503],0)+
isnull(PivotTable.[201504],0)+
isnull(PivotTable.[201505],0)+
isnull(PivotTable.[201506],0)+
isnull(PivotTable.[201507],0)+
isnull(PivotTable.[201508],0)+
isnull(PivotTable.[201509],0)+
isnull(PivotTable.[201510],0)+
isnull(PivotTable.[201511],0)+
isnull(PivotTable.[201512],0)+
isnull(PivotTable.[201601],0)+
isnull(PivotTable.[201602],0)+
isnull(PivotTable.[201603],0)+
isnull(PivotTable.[201604],0)+
isnull(PivotTable.[201605],0)+
isnull(PivotTable.[201606],0)+
isnull(PivotTable.[201607],0)+
isnull(PivotTable.[201608],0)+
isnull(PivotTable.[201609],0)+
isnull(PivotTable.[201610],0)+
isnull(PivotTable.[201611],0)+
isnull(PivotTable.[201612],0)+
isnull(PivotTable.[201701],0)+
isnull(PivotTable.[201702],0)+
isnull(PivotTable.[201703],0)+
isnull(PivotTable.[201704],0)+
isnull(PivotTable.[201705],0)+
isnull(PivotTable.[201706],0)+
isnull(PivotTable.[201707],0)+
isnull(PivotTable.[201708],0)+
isnull(PivotTable.[201709],0)+
isnull(PivotTable.[201710],0)+
isnull(PivotTable.[201711],0)+
isnull(PivotTable.[201712],0)+
isnull(PivotTable.[201801],0)+
isnull(PivotTable.[201802],0)+
isnull(PivotTable.[201803],0)+
isnull(PivotTable.[201804],0)+
isnull(PivotTable.[201805],0)+
isnull(PivotTable.[201806],0)+
isnull(PivotTable.[201807],0)+
isnull(PivotTable.[201808],0)+
isnull(PivotTable.[201809],0)+
isnull(PivotTable.[201810],0)+
isnull(PivotTable.[201811],0)+
isnull(PivotTable.[201812],0)+
isnull(PivotTable.[201901],0)+
isnull(PivotTable.[201902],0)+
isnull(PivotTable.[201903],0)+
isnull(PivotTable.[201904],0)+
isnull(PivotTable.[201905],0)+
isnull(PivotTable.[201906],0)+
isnull(PivotTable.[201907],0)+
isnull(PivotTable.[201908],0)+
isnull(PivotTable.[201909],0)+
isnull(PivotTable.[201910],0)+
isnull(PivotTable.[201911],0)+
isnull(PivotTable.[201912],0)+
isnull(PivotTable.[202001],0)+
isnull(PivotTable.[202002],0)+
isnull(PivotTable.[202003],0)+
isnull(PivotTable.[202004],0)+
isnull(PivotTable.[202005],0)+
isnull(PivotTable.[202006],0)+
isnull(PivotTable.[202007],0)+
isnull(PivotTable.[202008],0)+
isnull(PivotTable.[202009],0)+
isnull(PivotTable.[202010],0)+
isnull(PivotTable.[202011],0)+
isnull(PivotTable.[202012],0)+
isnull(PivotTable.[202101],0)+
isnull(PivotTable.[202102],0)+
isnull(PivotTable.[202103],0)+
isnull(PivotTable.[202104],0)+
isnull(PivotTable.[202105],0)+
isnull(PivotTable.[202106],0)+
isnull(PivotTable.[202107],0)+
isnull(PivotTable.[202108],0)+
isnull(PivotTable.[202109],0)+
isnull(PivotTable.[202110],0)+
isnull(PivotTable.[202111],0)+
	    isnull(PivotTable.[202112],0)+
		isnull(PivotTable.[202201],0)+
		isnull(PivotTable.[202202],0)+
		isnull(PivotTable.[202203],0)+
		isnull(PivotTable.[202204],0)+
		isnull(PivotTable.[202205],0)+
		isnull(PivotTable.[202206],0)+
		isnull(PivotTable.[202207],0)+
		isnull(PivotTable.[202208],0)+
		isnull(PivotTable.[202209],0)+
		isnull(PivotTable.[202210],0)+
		isnull(PivotTable.[202211],0)+
		isnull(PivotTable.[202212],0)

                            )


FROM
(
  select  ORDEN=32 ,CTA_AUXILIAR_2 ='HONORARIOS MEDICO LABORAL' ,  ANIOMES, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras2()
  WHERE AÑO BETWEEN $AniIni AND $AniFin AND NMES BETWEEN $MesIni AND $MesFin AND EMPRESA='EJECUTADO' AND AREA like '%%' AND CC_MAYOR='6 - ADMINISTRACION' AND CENTRO_DE_COSTO='60228-SEGURIDAD Y SALUD LABORAL'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND CTA_AUXILIAR = '511095 - OTROS - HONORARIOS'
    
GROUP BY ORDEN,CTA_AUXILIAR_2,ANIOMES 
) AS SourceTable 

PIVOT(SUM(NETO) FOR ANIOMES IN([201501],
[201502],
[201503],
[201504],
[201505],
[201506],
[201507],
[201508],
[201509],
[201510],
[201511],
[201512],
[201601],
[201602],
[201603],
[201604],
[201605],
[201606],
[201607],
[201608],
[201609],
[201610],
[201611],
[201612],
[201701],
[201702],
[201703],
[201704],
[201705],
[201706],
[201707],
[201708],
[201709],
[201710],
[201711],
[201712],
[201801],
[201802],
[201803],
[201804],
[201805],
[201806],
[201807],
[201808],
[201809],
[201810],
[201811],
[201812],
[201901],
[201902],
[201903],
[201904],
[201905],
[201906],
[201907],
[201908],
[201909],
[201910],
[201911],
[201912],
[202001],
[202002],
[202003],
[202004],
[202005],
[202006],
[202007],
[202008],
[202009],
[202010],
[202011],
[202012],
[202101],
[202102],
[202103],
[202104],
[202105],
[202106],
[202107],
[202108],
[202109],
[202110],
[202111],
[202112],
[202201],
[202202],
[202203],
[202204],
[202205],
[202206],
[202207],
[202208],
[202209],
[202210],
[202211],
[202212]
)) AS PivotTable

UNION ALL
SELECT  ORDEN,CTA_AUXILIAR_2,
                            PivotTable.[201501] as Enero2015,
                            PivotTable.[201502] as Febrero2015,
                            PivotTable.[201503] as Marzo2015,
                            PivotTable.[201504] as Abril2015,
                            PivotTable.[201505] as Mayo2015,
                            PivotTable.[201506] as Junio2015,
                            PivotTable.[201507] as Julio2015,
                            PivotTable.[201508] as Agosto2015,
                            PivotTable.[201509] as Septiembre2015,
                            PivotTable.[201510] as Octubre2015,
                            PivotTable.[201511] as Noviembre2015,
                            PivotTable.[201512] as Diciembre2015,
                            PivotTable.[201601] as Enero2016,
                            PivotTable.[201602] as Febrero2016,
                            PivotTable.[201603] as Marzo2016,
                            PivotTable.[201604] as Abril2016,
                            PivotTable.[201605] as Mayo2016,
                            PivotTable.[201606] as Junio2016,
                            PivotTable.[201607] as Julio2016,
                            PivotTable.[201608] as Agosto2016,
                            PivotTable.[201609] as Septiembre2016,
                            PivotTable.[201610] as Octubre2016,
                            PivotTable.[201611] as Noviembre2016,
                            PivotTable.[201612] as Diciembre2016,
                            PivotTable.[201701] as Enero2017,
                            PivotTable.[201702] as Febrero2017,
                            PivotTable.[201703] as Marzo2017,
                            PivotTable.[201704] as Abril2017,
                            PivotTable.[201705] as Mayo2017,
                            PivotTable.[201706] as Junio2017,
                            PivotTable.[201707] as Julio2017,
                            PivotTable.[201708] as Agosto2017,
                            PivotTable.[201709] as Septiembre2017,
                            PivotTable.[201710] as Octubre2017,
                            PivotTable.[201711] as Noviembre2017,
                            PivotTable.[201712] as Diciembre2017,
                            PivotTable.[201801] as Enero2018,
                            PivotTable.[201802] as Febrero2018,
                            PivotTable.[201803] as Marzo2018,
                            PivotTable.[201804] as Abril2018,
                            PivotTable.[201805] as Mayo2018,
                            PivotTable.[201806] as Junio2018,
                            PivotTable.[201807] as Julio2018,
                            PivotTable.[201808] as Agosto2018,
                            PivotTable.[201809] as Septiembre2018,
                            PivotTable.[201810] as Octubre2018,
                            PivotTable.[201811] as Noviembre2018,
                            PivotTable.[201812] as Diciembre2018,
                            PivotTable.[201901] as Enero2019,
                            PivotTable.[201902] as Febrero2019,
                            PivotTable.[201903] as Marzo2019,
                            PivotTable.[201904] as Abril2019,
                            PivotTable.[201905] as Mayo2019,
                            PivotTable.[201906] as Junio2019,
                            PivotTable.[201907] as Julio2019,
                            PivotTable.[201908] as Agosto2019,
                            PivotTable.[201909] as Septiembre2019,
                            PivotTable.[201910] as Octubre2019,
                            PivotTable.[201911] as Noviembre2019,
                            PivotTable.[201912] as Diciembre2019,
                            PivotTable.[202001] as Enero2020,
                            PivotTable.[202002] as Febrero2020,
                            PivotTable.[202003] as Marzo2020,
                            PivotTable.[202004] as Abril2020,
                            PivotTable.[202005] as Mayo2020,
                            PivotTable.[202006] as Junio2020,
                            PivotTable.[202007] as Julio2020,
                            PivotTable.[202008] as Agosto2020,
                            PivotTable.[202009] as Septiembre2020,
                            PivotTable.[202010] as Octubre2020,
                            PivotTable.[202011] as Noviembre2020,
                            PivotTable.[202012] as Diciembre2020,
                            PivotTable.[202101] as Enero2021,
                            PivotTable.[202102] as Febrero2021,
                            PivotTable.[202103] as Marzo2021,
                            PivotTable.[202104] as Abril2021,
                            PivotTable.[202105] as Mayo2021,
                            PivotTable.[202106] as Junio2021,
                            PivotTable.[202107] as Julio2021,
                            PivotTable.[202108] as Agosto2021,
                            PivotTable.[202109] as Septiembre2021,
                            PivotTable.[202110] as Octubre2021,
                            PivotTable.[202111] as Noviembre2021,
                                                        PivotTable.[202112] as Diciembre2021,
                            PivotTable.[202201] as Enero2022,
                            PivotTable.[202202] as Febrero2022,
                            PivotTable.[202203] as Marzo2022,
                            PivotTable.[202204] as Abril2022,
                            PivotTable.[202205] as Mayo2022,
                            PivotTable.[202206] as Junio2022,
                            PivotTable.[202207] as Julio2022,
                            PivotTable.[202208] as Agosto2022,
                            PivotTable.[202209] as Septiembre2022,
                            PivotTable.[202210] as Octubre2022,
                            PivotTable.[202211] as Noviembre2022,
                            PivotTable.[202212] as Diciembre2022,
                            Total= (
                            isnull(PivotTable.[201501],0)+
                            isnull(PivotTable.[201502],0)+
                            isnull(PivotTable.[201503],0)+
                            isnull(PivotTable.[201504],0)+
                            isnull(PivotTable.[201505],0)+
                            isnull(PivotTable.[201506],0)+
                            isnull(PivotTable.[201507],0)+
                            isnull(PivotTable.[201508],0)+
                            isnull(PivotTable.[201509],0)+
                            isnull(PivotTable.[201510],0)+
                            isnull(PivotTable.[201511],0)+
                            isnull(PivotTable.[201512],0)+
                            isnull(PivotTable.[201601],0)+
                            isnull(PivotTable.[201602],0)+
                            isnull(PivotTable.[201603],0)+
                            isnull(PivotTable.[201604],0)+
                            isnull(PivotTable.[201605],0)+
                            isnull(PivotTable.[201606],0)+
                            isnull(PivotTable.[201607],0)+
                            isnull(PivotTable.[201608],0)+
                            isnull(PivotTable.[201609],0)+
                            isnull(PivotTable.[201610],0)+
                            isnull(PivotTable.[201611],0)+
                            isnull(PivotTable.[201612],0)+
                            isnull(PivotTable.[201701],0)+
                            isnull(PivotTable.[201702],0)+
                            isnull(PivotTable.[201703],0)+
                            isnull(PivotTable.[201704],0)+
                            isnull(PivotTable.[201705],0)+
                            isnull(PivotTable.[201706],0)+
                            isnull(PivotTable.[201707],0)+
                            isnull(PivotTable.[201708],0)+
                            isnull(PivotTable.[201709],0)+
                            isnull(PivotTable.[201710],0)+
                            isnull(PivotTable.[201711],0)+
                            isnull(PivotTable.[201712],0)+
                            isnull(PivotTable.[201801],0)+
                            isnull(PivotTable.[201802],0)+
                            isnull(PivotTable.[201803],0)+
                            isnull(PivotTable.[201804],0)+
                            isnull(PivotTable.[201805],0)+
                            isnull(PivotTable.[201806],0)+
                            isnull(PivotTable.[201807],0)+
                            isnull(PivotTable.[201808],0)+
                            isnull(PivotTable.[201809],0)+
                            isnull(PivotTable.[201810],0)+
                            isnull(PivotTable.[201811],0)+
                            isnull(PivotTable.[201812],0)+
                            isnull(PivotTable.[201901],0)+
                            isnull(PivotTable.[201902],0)+
                            isnull(PivotTable.[201903],0)+
                            isnull(PivotTable.[201904],0)+
                            isnull(PivotTable.[201905],0)+
                            isnull(PivotTable.[201906],0)+
                            isnull(PivotTable.[201907],0)+
                            isnull(PivotTable.[201908],0)+
                            isnull(PivotTable.[201909],0)+
                            isnull(PivotTable.[201910],0)+
                            isnull(PivotTable.[201911],0)+
                            isnull(PivotTable.[201912],0)+
                            isnull(PivotTable.[202001],0)+
                            isnull(PivotTable.[202002],0)+
                            isnull(PivotTable.[202003],0)+
                            isnull(PivotTable.[202004],0)+
                            isnull(PivotTable.[202005],0)+
                            isnull(PivotTable.[202006],0)+
                            isnull(PivotTable.[202007],0)+
                            isnull(PivotTable.[202008],0)+
                            isnull(PivotTable.[202009],0)+
                            isnull(PivotTable.[202010],0)+
                            isnull(PivotTable.[202011],0)+
                            isnull(PivotTable.[202012],0)+
                            isnull(PivotTable.[202101],0)+
                            isnull(PivotTable.[202102],0)+
                            isnull(PivotTable.[202103],0)+
                            isnull(PivotTable.[202104],0)+
                            isnull(PivotTable.[202105],0)+
                            isnull(PivotTable.[202106],0)+
                            isnull(PivotTable.[202107],0)+
                            isnull(PivotTable.[202108],0)+
                            isnull(PivotTable.[202109],0)+
                            isnull(PivotTable.[202110],0)+
                            isnull(PivotTable.[202111],0)+
                            	    isnull(PivotTable.[202112],0)+
                    		isnull(PivotTable.[202201],0)+
                    		isnull(PivotTable.[202202],0)+
                    		isnull(PivotTable.[202203],0)+
                    		isnull(PivotTable.[202204],0)+
                    		isnull(PivotTable.[202205],0)+
                    		isnull(PivotTable.[202206],0)+
                    		isnull(PivotTable.[202207],0)+
                    		isnull(PivotTable.[202208],0)+
                    		isnull(PivotTable.[202209],0)+
                    		isnull(PivotTable.[202210],0)+
                    		isnull(PivotTable.[202211],0)+
                    		isnull(PivotTable.[202212],0))

FROM
(
    SELECT ORDEN=36 ,CTA_AUXILIAR_2 ='N° DE EMPLEADOS' , CAST(Año AS VARCHAR(4)) + IIF(len(Mes)=1,'0'+ cast(mes as varchar(2)),cast(mes as varchar(2))) as ANIOMES , SUM(MES_DE_TRABAJO) as CTEMPLEA
    FROM BaseEmpleadosIndicadorNomina
    WHERE EMPRESA='EJECUTADO' AND Año BETWEEN $AniIni AND $AniFin AND Mes BETWEEN $MesIni AND $MesFin
    GROUP BY Año, Mes
) AS SourceTable 

PIVOT(SUM(CTEMPLEA) FOR ANIOMES IN([201501],
[201502],
[201503],
[201504],
[201505],
[201506],
[201507],
[201508],
[201509],
[201510],
[201511],
[201512],
[201601],
[201602],
[201603],
[201604],
[201605],
[201606],
[201607],
[201608],
[201609],
[201610],
[201611],
[201612],
[201701],
[201702],
[201703],
[201704],
[201705],
[201706],
[201707],
[201708],
[201709],
[201710],
[201711],
[201712],
[201801],
[201802],
[201803],
[201804],
[201805],
[201806],
[201807],
[201808],
[201809],
[201810],
[201811],
[201812],
[201901],
[201902],
[201903],
[201904],
[201905],
[201906],
[201907],
[201908],
[201909],
[201910],
[201911],
[201912],
[202001],
[202002],
[202003],
[202004],
[202005],
[202006],
[202007],
[202008],
[202009],
[202010],
[202011],
[202012],
[202101],
[202102],
[202103],
[202104],
[202105],
[202106],
[202107],
[202108],
[202109],
[202110],
[202111],
[202112],
[202201],
[202202],
[202203],
[202204],
[202205],
[202206],
[202207],
[202208],
[202209],
[202210],
[202211],
[202212]

)) AS PivotTable


) K
ORDER BY ORDEN



"));
//dd($query);
 $querycomparativo=DB::connection('palmeras')->select(DB::raw("

SELECT *,

AANIO2015= (isnull(ANIO2015,0)),
AANIO2016= (isnull(ANIO2015,0)+isnull(ANIO2016,0)),
AANIO2017= (isnull(ANIO2015,0)+isnull(ANIO2016,0)+isnull(ANIO2017,0)),
AANIO2018= (isnull(ANIO2015,0)+isnull(ANIO2016,0)+isnull(ANIO2017,0)+isnull(ANIO2018,0)),
AANIO2019= (isnull(ANIO2015,0)+isnull(ANIO2016,0)+isnull(ANIO2017,0)+isnull(ANIO2018,0)+isnull(ANIO2019,0)),
AANIO2020= (isnull(ANIO2015,0)+isnull(ANIO2016,0)+isnull(ANIO2017,0)+isnull(ANIO2018,0)+isnull(ANIO2019,0)+isnull(ANIO2020,0)),
AANIO2021= (isnull(ANIO2015,0)+isnull(ANIO2016,0)+isnull(ANIO2017,0)+isnull(ANIO2018,0)+isnull(ANIO2019,0)+isnull(ANIO2020,0)+isnull(ANIO2021,0))

 
 FROM (
--CALCULO TOTAL EN TOTAL COSTOS SSL

SELECT ORDEN=9, CTA_AUXILIAR_2='TOTAL COSTOS SSL' , 
                    SUM(ANIO2015) as ANIO2015,
                    SUM(ANIO2016) as ANIO2016,
                    SUM(ANIO2017) as ANIO2017,
                    SUM(ANIO2018) as ANIO2018,
                    SUM(ANIO2019) as ANIO2019,
                    SUM(ANIO2020) as ANIO2020,
                    SUM(ANIO2021) as ANIO2021,
                    SUM(Total) as Total

FROM (

SELECT ORDEN,CTA_AUXILIAR_2,
                            PivotTable.[2015] as ANIO2015,
                            PivotTable.[2016] as ANIO2016,
                            PivotTable.[2017] as ANIO2017,
                            PivotTable.[2018] as ANIO2018,
                            PivotTable.[2019] as ANIO2019,
                            PivotTable.[2020] as ANIO2020,
                            PivotTable.[2021] as ANIO2021,
                            Total= (
                          
                            isnull(PivotTable.[2015],0)+
                            isnull(PivotTable.[2016],0)+
                            isnull(PivotTable.[2017],0)+
                            isnull(PivotTable.[2018],0)+
                            isnull(PivotTable.[2019],0)+
                            isnull(PivotTable.[2020],0)+
                            isnull(PivotTable.[2021],0))

                            


FROM
(
  select  ORDEN=29,CTA_AUXILIAR_2 ='COSTO NETO OTROS SSL',  AÑO, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras()
  WHERE AÑO BETWEEN $AniIni AND $AniFin AND NMES BETWEEN $MesIni AND $MesFin AND CTA_AUXILIAR_2 NOT IN ('TEMPORALES') AND EMPRESA='EJECUTADO' AND AREA like '%%'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS')  
        
GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
) AS SourceTable 

PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021])
) AS PivotTable

UNION ALL


SELECT ORDEN,CTA_AUXILIAR_2,
                                         PivotTable.[2015] as ANIO2015,
                            PivotTable.[2016] as ANIO2016,
                            PivotTable.[2017] as ANIO2017,
                            PivotTable.[2018] as ANIO2018,
                            PivotTable.[2019] as ANIO2019,
                            PivotTable.[2020] as ANIO2020,
                            PivotTable.[2021] as ANIO2021,
                            Total= (
                          
                            isnull(PivotTable.[2015],0)+
                            isnull(PivotTable.[2016],0)+
                            isnull(PivotTable.[2017],0)+
                            isnull(PivotTable.[2018],0)+
                            isnull(PivotTable.[2019],0)+
                            isnull(PivotTable.[2020],0)+
                            isnull(PivotTable.[2021],0))

                            


FROM
(
  select  ORDEN = 30 ,CTA_AUXILIAR_2 ='DPTO. DE SEGURIDAD Y SALUD LABORAL',  AÑO, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras2()
 WHERE AÑO BETWEEN $AniIni AND $AniFin AND NMES BETWEEN $MesIni AND $MesFin AND EMPRESA='EJECUTADO' AND AREA like '%%' AND CC_MAYOR='6 - ADMINISTRACION' AND CENTRO_DE_COSTO='60228-SEGURIDAD Y SALUD LABORAL'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND CTA_AUXILIAR NOT IN ('511025 - ASESORIA JURIDICA','511095 - OTROS - HONORARIOS')
        
GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
) AS SourceTable 

PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021]
)) AS PivotTable

UNION ALL

SELECT ORDEN,CTA_AUXILIAR_2,
                            PivotTable.[2015] as ANIO2015,
                            PivotTable.[2016] as ANIO2016,
                            PivotTable.[2017] as ANIO2017,
                            PivotTable.[2018] as ANIO2018,
                            PivotTable.[2019] as ANIO2019,
                            PivotTable.[2020] as ANIO2020,
                            PivotTable.[2021] as ANIO2021,
                            Total= (
                          
                            isnull(PivotTable.[2015],0)+
                            isnull(PivotTable.[2016],0)+
                            isnull(PivotTable.[2017],0)+
                            isnull(PivotTable.[2018],0)+
                            isnull(PivotTable.[2019],0)+
                            isnull(PivotTable.[2020],0)+
                            isnull(PivotTable.[2021],0))


FROM
(
  select  ORDEN = 31 ,CTA_AUXILIAR_2 ='HONORARIOS ABOGADO',  AÑO, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras2()
WHERE AÑO BETWEEN $AniIni AND $AniFin AND NMES BETWEEN $MesIni AND $MesFin AND EMPRESA='EJECUTADO' AND AREA like '%%' AND CC_MAYOR='6 - ADMINISTRACION' AND CENTRO_DE_COSTO='60228-SEGURIDAD Y SALUD LABORAL'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND CTA_AUXILIAR = '511025 - ASESORIA JURIDICA'
        
GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
) AS SourceTable 

PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021]
)) AS PivotTable

UNION ALL

SELECT ORDEN,CTA_AUXILIAR_2,
                           PivotTable.[2015] as ANIO2015,
                            PivotTable.[2016] as ANIO2016,
                            PivotTable.[2017] as ANIO2017,
                            PivotTable.[2018] as ANIO2018,
                            PivotTable.[2019] as ANIO2019,
                            PivotTable.[2020] as ANIO2020,
                            PivotTable.[2021] as ANIO2021,
                            Total= (
                          
                            isnull(PivotTable.[2015],0)+
                            isnull(PivotTable.[2016],0)+
                            isnull(PivotTable.[2017],0)+
                            isnull(PivotTable.[2018],0)+
                            isnull(PivotTable.[2019],0)+
                            isnull(PivotTable.[2020],0)+
                            isnull(PivotTable.[2021],0))


FROM
(
  select  ORDEN=32 ,CTA_AUXILIAR_2 ='HONORARIOS MEDICO LABORAL' ,  AÑO, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras2()
  WHERE AÑO BETWEEN $AniIni AND $AniFin AND NMES BETWEEN $MesIni AND $MesFin AND EMPRESA='EJECUTADO' AND AREA like '%%' AND CC_MAYOR='6 - ADMINISTRACION' AND CENTRO_DE_COSTO='60228-SEGURIDAD Y SALUD LABORAL'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND CTA_AUXILIAR = '511095 - OTROS - HONORARIOS'
    
GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
) AS SourceTable 

PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021]
)) AS PivotTable

) D

UNION ALL

 

--FIN CONSULTA TOTAL COSTOS SSL



SELECT ORDEN,CTA_AUXILIAR_2,
                             PivotTable.[2015] as ANIO2015,
                            PivotTable.[2016] as ANIO2016,
                            PivotTable.[2017] as ANIO2017,
                            PivotTable.[2018] as ANIO2018,
                            PivotTable.[2019] as ANIO2019,
                            PivotTable.[2020] as ANIO2020,
                            PivotTable.[2021] as ANIO2021,
                            Total= (
                          
                            isnull(PivotTable.[2015],0)+
                            isnull(PivotTable.[2016],0)+
                            isnull(PivotTable.[2017],0)+
                            isnull(PivotTable.[2018],0)+
                            isnull(PivotTable.[2019],0)+
                            isnull(PivotTable.[2020],0)+
                            isnull(PivotTable.[2021],0))


FROM
(
  select  ORDEN,CTA_AUXILIAR_2,  AÑO, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras()
  WHERE AÑO BETWEEN $AniIni AND $AniFin AND NMES BETWEEN $MesIni AND $MesFin AND CTA_AUXILIAR_2 NOT IN ('TEMPORALES') AND EMPRESA='EJECUTADO' AND AREA like '%%'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS')  
        
GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
) AS SourceTable 

PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021]
)) AS PivotTable

UNION ALL

SELECT ORDEN,CTA_AUXILIAR_2,
                            PivotTable.[2015] as ANIO2015,
                            PivotTable.[2016] as ANIO2016,
                            PivotTable.[2017] as ANIO2017,
                            PivotTable.[2018] as ANIO2018,
                            PivotTable.[2019] as ANIO2019,
                            PivotTable.[2020] as ANIO2020,
                            PivotTable.[2021] as ANIO2021,
                            Total= (
                          
                            isnull(PivotTable.[2015],0)+
                            isnull(PivotTable.[2016],0)+
                            isnull(PivotTable.[2017],0)+
                            isnull(PivotTable.[2018],0)+
                            isnull(PivotTable.[2019],0)+
                            isnull(PivotTable.[2020],0)+
                            isnull(PivotTable.[2021],0))

FROM
(
  select  ORDEN=29,CTA_AUXILIAR_2 ='COSTO NETO OTROS SSL',  AÑO, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras()
  WHERE AÑO BETWEEN $AniIni AND $AniFin AND NMES BETWEEN $MesIni AND $MesFin AND CTA_AUXILIAR_2 NOT IN ('TEMPORALES') AND EMPRESA='EJECUTADO' AND AREA like '%%'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS')  
        
GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
) AS SourceTable 

PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021]
)) AS PivotTable

UNION ALL


SELECT ORDEN,CTA_AUXILIAR_2,
                               PivotTable.[2015] as ANIO2015,
                            PivotTable.[2016] as ANIO2016,
                            PivotTable.[2017] as ANIO2017,
                            PivotTable.[2018] as ANIO2018,
                            PivotTable.[2019] as ANIO2019,
                            PivotTable.[2020] as ANIO2020,
                            PivotTable.[2021] as ANIO2021,
                            Total= (
                          
                            isnull(PivotTable.[2015],0)+
                            isnull(PivotTable.[2016],0)+
                            isnull(PivotTable.[2017],0)+
                            isnull(PivotTable.[2018],0)+
                            isnull(PivotTable.[2019],0)+
                            isnull(PivotTable.[2020],0)+
                            isnull(PivotTable.[2021],0))

FROM
(
  select  ORDEN = 30 ,CTA_AUXILIAR_2 ='DPTO. DE SEGURIDAD Y SALUD LABORAL',  AÑO, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras()
 WHERE AÑO BETWEEN $AniIni AND $AniFin AND NMES BETWEEN $MesIni AND $MesFin AND EMPRESA='EJECUTADO' AND AREA like '%%' AND CC_MAYOR='6 - ADMINISTRACION' AND CENTRO_DE_COSTO='60228-SEGURIDAD Y SALUD LABORAL'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND CTA_AUXILIAR NOT IN ('511025 - ASESORIA JURIDICA','511095 - OTROS - HONORARIOS')
        
GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
) AS SourceTable 

PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021])) AS PivotTable

UNION ALL

SELECT ORDEN,CTA_AUXILIAR_2,
                            PivotTable.[2015] as ANIO2015,
                            PivotTable.[2016] as ANIO2016,
                            PivotTable.[2017] as ANIO2017,
                            PivotTable.[2018] as ANIO2018,
                            PivotTable.[2019] as ANIO2019,
                            PivotTable.[2020] as ANIO2020,
                            PivotTable.[2021] as ANIO2021,
                            Total= (
                          
                            isnull(PivotTable.[2015],0)+
                            isnull(PivotTable.[2016],0)+
                            isnull(PivotTable.[2017],0)+
                            isnull(PivotTable.[2018],0)+
                            isnull(PivotTable.[2019],0)+
                            isnull(PivotTable.[2020],0)+
                            isnull(PivotTable.[2021],0))


FROM
(
  select  ORDEN = 31 ,CTA_AUXILIAR_2 ='HONORARIOS ABOGADO',  AÑO, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras2()
WHERE AÑO BETWEEN $AniIni AND $AniFin AND NMES BETWEEN $MesIni AND $MesFin AND EMPRESA='EJECUTADO' AND AREA like '%%' AND CC_MAYOR='6 - ADMINISTRACION' AND CENTRO_DE_COSTO='60228-SEGURIDAD Y SALUD LABORAL'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND CTA_AUXILIAR = '511025 - ASESORIA JURIDICA'
        
GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
) AS SourceTable 

PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021]
)) AS PivotTable

UNION ALL

SELECT ORDEN,CTA_AUXILIAR_2,
                                               PivotTable.[2015] as ANIO2015,
                            PivotTable.[2016] as ANIO2016,
                            PivotTable.[2017] as ANIO2017,
                            PivotTable.[2018] as ANIO2018,
                            PivotTable.[2019] as ANIO2019,
                            PivotTable.[2020] as ANIO2020,
                            PivotTable.[2021] as ANIO2021,
                            Total= (
                          
                            isnull(PivotTable.[2015],0)+
                            isnull(PivotTable.[2016],0)+
                            isnull(PivotTable.[2017],0)+
                            isnull(PivotTable.[2018],0)+
                            isnull(PivotTable.[2019],0)+
                            isnull(PivotTable.[2020],0)+
                            isnull(PivotTable.[2021],0))


FROM
(
  select  ORDEN=32 ,CTA_AUXILIAR_2 ='HONORARIOS MEDICO LABORAL' ,  AÑO, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras2()
  WHERE AÑO BETWEEN $AniIni AND $AniFin AND NMES BETWEEN $MesIni AND $MesFin AND EMPRESA='EJECUTADO' AND AREA like '%%' AND CC_MAYOR='6 - ADMINISTRACION' AND CENTRO_DE_COSTO='60228-SEGURIDAD Y SALUD LABORAL'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND CTA_AUXILIAR = '511095 - OTROS - HONORARIOS'
    
GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
) AS SourceTable 

PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021]
)) AS PivotTable

UNION ALL
SELECT  ORDEN,CTA_AUXILIAR_2,
                            PivotTable.[2015] as ANIO2015,
                            PivotTable.[2016] as ANIO2016,
                            PivotTable.[2017] as ANIO2017,
                            PivotTable.[2018] as ANIO2018,
                            PivotTable.[2019] as ANIO2019,
                            PivotTable.[2020] as ANIO2020,
                            PivotTable.[2021] as ANIO2021,
                            Total= (
                          
                            isnull(PivotTable.[2015],0)+
                            isnull(PivotTable.[2016],0)+
                            isnull(PivotTable.[2017],0)+
                            isnull(PivotTable.[2018],0)+
                            isnull(PivotTable.[2019],0)+    
                            isnull(PivotTable.[2020],0)+
                            isnull(PivotTable.[2021],0))    
FROM
(
    SELECT ORDEN=33 ,CTA_AUXILIAR_2 ='N° DE EMPLEADOS' , AÑO , SUM(MES_DE_TRABAJO) as CTEMPLEA
    FROM BaseEmpleadosIndicadorNomina
    WHERE EMPRESA='EJECUTADO' AND AÑO BETWEEN $AniIni AND $AniFin AND Mes BETWEEN $MesIni AND $MesFin
    GROUP BY AÑO, Mes
) AS SourceTable 

PIVOT(AVG(CTEMPLEA) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021],[2022])) AS PivotTable


) K


ORDER BY ORDEN
    "));

    //dd($querycomparativo);   


    //dd($request->all());

        if ($request->input('Tipo')=='01') {
            return view('ssl.comparativo', compact('querycomparativo','filtro'));
        }
        else if ($request->input('Tipo')=='02'){

            return view('ssl.cargarprestacional', compact('query','filtro','MesFin'));
        }
        else if ($request->input('Tipo')=='03'){

            return view('ssl.acumulado', compact('query','filtro'));    

        } else {

           return view('ssl.indicenominapalmeras');
        }

        
}
        
        
    }


      public function seleccionaranios(Request $request)
        {
                
                 set_time_limit(3000000);
                 ini_set('memory_limit', '-1'); 

   
                $mestope = $request->input('MesFinal');
                $Tipo= $request->input('Tipo');
                $FechaIni=strtotime($request->input('FechaInicio'));  
                $FechaFin=strtotime($request->input('FechaFin'));  
                $AniIni=date("Y", $FechaIni) ? '2015': date("Y", $FechaIni);  
                $MesIni=date("m", $FechaIni) ? $request->input('MesInicial'): date("m", $FechaIni);  
                $AniFin=date("Y", $FechaFin) ? '2021' : date("Y", $FechaFin);
                $MesFin=date("m", $FechaFin) ? $mestope : date("m", $FechaFin); 
                $area="'%".$request->input('area')."%'";  
                $anios = json_encode($request->input('eleAnio'),TRUE);
                $aniosarray = $request->input('eleAnio');

                $cambiar = array("]");
                $cambiar1 = array("[");
                $cambiar2 = array("\"");
                $cambiado =str_replace($cambiar, "",$anios);
                $cambiado1 =str_replace($cambiar1, "",$cambiado);
                $cambiado2 = str_replace($cambiar2, "'",$cambiado1);
                $conswhere ="IN (".$cambiado2.")";
                $queryanio = $FechaIni ? "BETWEEN". $AniIni ."AND". $AniFin : $conswhere;
               

                $filtro = "Informe Comparativo por Años Seleccionados ". $cambiado2. " Mes Inicial : ". $MesIni . " Mes Final: ". $MesFin . " Area: ". $request->input('area');
                
               $pres= $request->eleAnio== null ? '2015': $request->eleAnio[array_search('2021',$aniosarray)];
                

               //$maxarray=max(array_filter(array_keys($request->eleAnio)));
               //$ultimoanio =max(array_filter($request->eleAnio));
              // $anterioranio =array_filter($request->eleAnio);
               
               //dd($aniotope);     
           


            $tipo=$request->input('Tipo');
            if ($request->input('Tipo') =='03') {
                return view('ssl.escoger');
            } elseif ($request->input('Tipo') =='04') {

            $at=max($request->eleAnio);
            $aniotope ="K.ANIO".max($request->eleAnio);
            $aniotopeptto ="PRE.ANIO".max($request->eleAnio);
            $anioprev =max($request->eleAnio)-1;
            $anioanterior ="K.ANIO".$anioprev;
            //dd($aniotope,$anioanterior);

   
            
         $querycomparativo=DB::connection('palmeras')->select(DB::raw("

            SELECT  K.* , 

            PRE.ANIO2015 AS PRESP2015, 
            PRE.ANIO2016 AS PRESP2016,
            PRE.ANIO2017 AS PRESP2017,
            PRE.ANIO2018 AS PRESP2018,
            PRE.ANIO2019 AS PRESP2019,
            PRE.ANIO2020 AS PRESP2020,
            PRE.ANIO2021 AS PRESP2021,
            PRE.ANIO2022 AS PRESP2022,

                    --CALCULO EJECUCION ULTIMO AÑO - EJECUCION AÑO ANTERIOR
                    VARNETA = NULLIF((isnull($aniotope,0)-isnull($anioanterior,0)),0),
                    VARNETAPORCENTAJE = NULLIF((isnull($aniotope,0)-isnull($anioanterior,0))/NULLIF($anioanterior,0),0),


                    --CALCULO PRESUPUESTO - EJECUCION
                    VARPRES = NULLIF((isnull($aniotopeptto,0)-isnull($aniotope,0)),0),
                    VARPRESPORCENTAJE = NULLIF((isnull($aniotopeptto,0)-isnull($aniotope,0))/NULLIF($aniotope,0),0)
 
 FROM (
--CALCULO TOTAL EN TOTAL COSTOS SSL

SELECT ORDEN=35, CTA_AUXILIAR_2='TOTAL COSTOS SSL' , 
                    SUM(ANIO2015) as ANIO2015,
                    SUM(ANIO2016) as ANIO2016,
                    SUM(ANIO2017) as ANIO2017,
                    SUM(ANIO2018) as ANIO2018,
                    SUM(ANIO2019) as ANIO2019,
                    SUM(ANIO2020) as ANIO2020,
                    SUM(ANIO2021) as ANIO2021,
                    SUM(ANIO2022) as ANIO2022,
                    SUM(Total) as Total

FROM (

SELECT ORDEN,CTA_AUXILIAR_2,
                            PivotTable.[2015] as ANIO2015,
                            PivotTable.[2016] as ANIO2016,
                            PivotTable.[2017] as ANIO2017,
                            PivotTable.[2018] as ANIO2018,
                            PivotTable.[2019] as ANIO2019,
                            PivotTable.[2020] as ANIO2020,
                            PivotTable.[2021] as ANIO2021,
                            PivotTable.[2022] as ANIO2022,
                            Total= (
                          
                            isnull(PivotTable.[2015],0)+
                            isnull(PivotTable.[2016],0)+
                            isnull(PivotTable.[2017],0)+
                            isnull(PivotTable.[2018],0)+
                            isnull(PivotTable.[2019],0)+
                            isnull(PivotTable.[2020],0)+
                            isnull(PivotTable.[2021],0)+
                            isnull(PivotTable.[2022],0)    
                            )

                            


FROM
(
  select  ORDEN=29,CTA_AUXILIAR_2 ='COSTO NETO OTROS SSL',  AÑO, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras()
  WHERE AÑO $queryanio AND NMES BETWEEN $MesIni AND $MesFin AND CTA_AUXILIAR_2 NOT IN ('TEMPORALES') AND EMPRESA='EJECUTADO' AND AREA like '%%'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS')  
        
GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
) AS SourceTable 

PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021],[2022])
) AS PivotTable

UNION ALL


SELECT ORDEN,CTA_AUXILIAR_2,
                                         PivotTable.[2015] as ANIO2015,
                            PivotTable.[2016] as ANIO2016,
                            PivotTable.[2017] as ANIO2017,
                            PivotTable.[2018] as ANIO2018,
                            PivotTable.[2019] as ANIO2019,
                            PivotTable.[2020] as ANIO2020,
                            PivotTable.[2021] as ANIO2021,
                            PivotTable.[2022] as ANIO2022,
                            Total= (
                          
                            isnull(PivotTable.[2015],0)+
                            isnull(PivotTable.[2016],0)+
                            isnull(PivotTable.[2017],0)+
                            isnull(PivotTable.[2018],0)+
                            isnull(PivotTable.[2019],0)+
                            isnull(PivotTable.[2020],0)+
                            isnull(PivotTable.[2021],0)+
                            isnull(PivotTable.[2022],0))

                            


FROM
(
  select  ORDEN = 30 ,CTA_AUXILIAR_2 ='DPTO. DE SEGURIDAD Y SALUD LABORAL',  AÑO, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras2()
 WHERE AÑO $queryanio AND NMES BETWEEN $MesIni AND $MesFin AND EMPRESA='EJECUTADO' AND AREA like '%%' AND CC_MAYOR='6 - ADMINISTRACION' AND CENTRO_DE_COSTO='60228-SEGURIDAD Y SALUD LABORAL'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND CTA_AUXILIAR NOT IN ('511025 - ASESORIA JURIDICA','511095 - OTROS - HONORARIOS')
        
GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
) AS SourceTable 

PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021],[2022]
)) AS PivotTable

UNION ALL

SELECT ORDEN,CTA_AUXILIAR_2,
                            PivotTable.[2015] as ANIO2015,
                            PivotTable.[2016] as ANIO2016,
                            PivotTable.[2017] as ANIO2017,
                            PivotTable.[2018] as ANIO2018,
                            PivotTable.[2019] as ANIO2019,
                            PivotTable.[2020] as ANIO2020,
                            PivotTable.[2021] as ANIO2021,
                            PivotTable.[2022] as ANIO2022,
                            Total= (
                          
                            isnull(PivotTable.[2015],0)+
                            isnull(PivotTable.[2016],0)+
                            isnull(PivotTable.[2017],0)+
                            isnull(PivotTable.[2018],0)+
                            isnull(PivotTable.[2019],0)+
                            isnull(PivotTable.[2020],0)+
                            isnull(PivotTable.[2021],0)+
                            isnull(PivotTable.[2022],0))


FROM
(
  select  ORDEN = 31 ,CTA_AUXILIAR_2 ='HONORARIOS ABOGADO',  AÑO, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras2()
WHERE AÑO $queryanio AND NMES BETWEEN $MesIni AND $MesFin AND EMPRESA='EJECUTADO' AND AREA like '%%' AND CC_MAYOR='6 - ADMINISTRACION' AND CENTRO_DE_COSTO='60228-SEGURIDAD Y SALUD LABORAL'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND CTA_AUXILIAR = '511025 - ASESORIA JURIDICA'
        
GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
) AS SourceTable 

PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021],[2022]
)) AS PivotTable

UNION ALL

SELECT ORDEN,CTA_AUXILIAR_2,
                           PivotTable.[2015] as ANIO2015,
                            PivotTable.[2016] as ANIO2016,
                            PivotTable.[2017] as ANIO2017,
                            PivotTable.[2018] as ANIO2018,
                            PivotTable.[2019] as ANIO2019,
                            PivotTable.[2020] as ANIO2020,
                            PivotTable.[2021] as ANIO2021,
                            PivotTable.[2022] as ANIO2022,
                            Total= (
                          
                            isnull(PivotTable.[2015],0)+
                            isnull(PivotTable.[2016],0)+
                            isnull(PivotTable.[2017],0)+
                            isnull(PivotTable.[2018],0)+
                            isnull(PivotTable.[2019],0)+
                            isnull(PivotTable.[2020],0)+
                            isnull(PivotTable.[2021],0)+
                            isnull(PivotTable.[2022],0))


FROM
(
  select  ORDEN=32 ,CTA_AUXILIAR_2 ='HONORARIOS MEDICO LABORAL' ,  AÑO, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras2()
  WHERE AÑO $queryanio AND NMES BETWEEN $MesIni AND $MesFin AND EMPRESA='EJECUTADO' AND AREA like '%%' AND CC_MAYOR='6 - ADMINISTRACION' AND CENTRO_DE_COSTO='60228-SEGURIDAD Y SALUD LABORAL'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND CTA_AUXILIAR = '511095 - OTROS - HONORARIOS'
    
GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
) AS SourceTable 

PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021],[2022]
)) AS PivotTable

) D

UNION ALL

 

--FIN CONSULTA TOTAL COSTOS SSL


-- CALCULO NETO SSL - HONORARIOS

SELECT ORDEN=34, CTA_AUXILIAR_2='COSTOS NETO SSL- HON' , 
                    SUM(ANIO2015) as ANIO2015,
                    SUM(ANIO2016) as ANIO2016,
                    SUM(ANIO2017) as ANIO2017,
                    SUM(ANIO2018) as ANIO2018,
                    SUM(ANIO2019) as ANIO2019,
                    SUM(ANIO2020) as ANIO2020,
                    SUM(ANIO2021) as ANIO2021,
                    SUM(ANIO2022) as ANIO2022,
                    SUM(Total) as Total

FROM (


SELECT ORDEN,CTA_AUXILIAR_2,
                                         PivotTable.[2015] as ANIO2015,
                            PivotTable.[2016] as ANIO2016,
                            PivotTable.[2017] as ANIO2017,
                            PivotTable.[2018] as ANIO2018,
                            PivotTable.[2019] as ANIO2019,
                            PivotTable.[2020] as ANIO2020,
                            PivotTable.[2021] as ANIO2021,
                            PivotTable.[2022] as ANIO2022,
                            Total= (
                          
                            isnull(PivotTable.[2015],0)+
                            isnull(PivotTable.[2016],0)+
                            isnull(PivotTable.[2017],0)+
                            isnull(PivotTable.[2018],0)+
                            isnull(PivotTable.[2019],0)+
                            isnull(PivotTable.[2020],0)+
                            isnull(PivotTable.[2021],0)+
                            isnull(PivotTable.[2022],0))

                            


FROM
(
  select  ORDEN = 30 ,CTA_AUXILIAR_2 ='DPTO. DE SEGURIDAD Y SALUD LABORAL',  AÑO, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras2()
 WHERE AÑO $queryanio AND NMES BETWEEN $MesIni AND $MesFin AND EMPRESA='EJECUTADO' AND AREA like '%%' AND CC_MAYOR='6 - ADMINISTRACION' AND CENTRO_DE_COSTO='60228-SEGURIDAD Y SALUD LABORAL'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND CTA_AUXILIAR NOT IN ('511025 - ASESORIA JURIDICA','511095 - OTROS - HONORARIOS')
        
GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
) AS SourceTable 

PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021],[2022]
)) AS PivotTable

UNION ALL

SELECT ORDEN,CTA_AUXILIAR_2,
                            PivotTable.[2015] as ANIO2015,
                            PivotTable.[2016] as ANIO2016,
                            PivotTable.[2017] as ANIO2017,
                            PivotTable.[2018] as ANIO2018,
                            PivotTable.[2019] as ANIO2019,
                            PivotTable.[2020] as ANIO2020,
                            PivotTable.[2021] as ANIO2021,
                            PivotTable.[2022] as ANIO2022,
                            Total= (
                          
                            isnull(PivotTable.[2015],0)+
                            isnull(PivotTable.[2016],0)+
                            isnull(PivotTable.[2017],0)+
                            isnull(PivotTable.[2018],0)+
                            isnull(PivotTable.[2019],0)+
                            isnull(PivotTable.[2020],0)+
                            isnull(PivotTable.[2021],0)+
                            isnull(PivotTable.[2022],0))


FROM
(
  select  ORDEN = 31 ,CTA_AUXILIAR_2 ='HONORARIOS ABOGADO',  AÑO, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras2()
WHERE AÑO $queryanio AND NMES BETWEEN $MesIni AND $MesFin AND EMPRESA='EJECUTADO' AND AREA like '%%' AND CC_MAYOR='6 - ADMINISTRACION' AND CENTRO_DE_COSTO='60228-SEGURIDAD Y SALUD LABORAL'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND CTA_AUXILIAR = '511025 - ASESORIA JURIDICA'
        
GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
) AS SourceTable 

PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021],[2022]
)) AS PivotTable

UNION ALL

SELECT ORDEN,CTA_AUXILIAR_2,
                           PivotTable.[2015] as ANIO2015,
                            PivotTable.[2016] as ANIO2016,
                            PivotTable.[2017] as ANIO2017,
                            PivotTable.[2018] as ANIO2018,
                            PivotTable.[2019] as ANIO2019,
                            PivotTable.[2020] as ANIO2020,
                            PivotTable.[2021] as ANIO2021,
                            PivotTable.[2022] as ANIO2022,
                            Total= (
                          
                            isnull(PivotTable.[2015],0)+
                            isnull(PivotTable.[2016],0)+
                            isnull(PivotTable.[2017],0)+
                            isnull(PivotTable.[2018],0)+
                            isnull(PivotTable.[2019],0)+
                            isnull(PivotTable.[2020],0)+
                            isnull(PivotTable.[2021],0)+
                            isnull(PivotTable.[2022],0))


FROM
(
  select  ORDEN=32 ,CTA_AUXILIAR_2 ='HONORARIOS MEDICO LABORAL' ,  AÑO, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras2()
  WHERE AÑO $queryanio AND NMES BETWEEN $MesIni AND $MesFin AND EMPRESA='EJECUTADO' AND AREA like '%%' AND CC_MAYOR='6 - ADMINISTRACION' AND CENTRO_DE_COSTO='60228-SEGURIDAD Y SALUD LABORAL'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND CTA_AUXILIAR = '511095 - OTROS - HONORARIOS'
    
GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
) AS SourceTable 

PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021],[2022])) AS PivotTable

) D

UNION ALL

 

--FIN CONSULTA CALCULO


SELECT ORDEN,CTA_AUXILIAR_2,
                             PivotTable.[2015] as ANIO2015,
                            PivotTable.[2016] as ANIO2016,
                            PivotTable.[2017] as ANIO2017,
                            PivotTable.[2018] as ANIO2018,
                            PivotTable.[2019] as ANIO2019,
                            PivotTable.[2020] as ANIO2020,
                            PivotTable.[2021] as ANIO2021,
                            PivotTable.[2022] as ANIO2022,
                            Total= (
                          
                            isnull(PivotTable.[2015],0)+
                            isnull(PivotTable.[2016],0)+
                            isnull(PivotTable.[2017],0)+
                            isnull(PivotTable.[2018],0)+
                            isnull(PivotTable.[2019],0)+
                            isnull(PivotTable.[2020],0)+
                            isnull(PivotTable.[2021],0)+
                            isnull(PivotTable.[2022],0))


FROM
(
  select  ORDEN,CTA_AUXILIAR_2,  AÑO, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras()
  WHERE AÑO $queryanio AND NMES BETWEEN $MesIni AND $MesFin AND CTA_AUXILIAR_2 NOT IN ('TEMPORALES') AND EMPRESA='EJECUTADO' AND AREA like '%%'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS')  
        
GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
) AS SourceTable 

PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021],[2022]
)) AS PivotTable

UNION ALL

SELECT ORDEN,CTA_AUXILIAR_2,
                            PivotTable.[2015] as ANIO2015,
                            PivotTable.[2016] as ANIO2016,
                            PivotTable.[2017] as ANIO2017,
                            PivotTable.[2018] as ANIO2018,
                            PivotTable.[2019] as ANIO2019,
                            PivotTable.[2020] as ANIO2020,
                            PivotTable.[2021] as ANIO2021,
                            PivotTable.[2022] as ANIO2022,
                            Total= (
                          
                            isnull(PivotTable.[2015],0)+
                            isnull(PivotTable.[2016],0)+
                            isnull(PivotTable.[2017],0)+
                            isnull(PivotTable.[2018],0)+
                            isnull(PivotTable.[2019],0)+
                            isnull(PivotTable.[2020],0)+
                            isnull(PivotTable.[2021],0)+
                            isnull(PivotTable.[2022],0))

FROM
(
  select  ORDEN=29,CTA_AUXILIAR_2 ='COSTO NETO OTROS SSL',  AÑO, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras()
  WHERE AÑO $queryanio AND NMES BETWEEN $MesIni AND $MesFin AND CTA_AUXILIAR_2 NOT IN ('TEMPORALES') AND EMPRESA='EJECUTADO' AND AREA like '%%'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS')  
        
GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
) AS SourceTable 

PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021],[2022]
)) AS PivotTable

UNION ALL


SELECT ORDEN,CTA_AUXILIAR_2,
                               PivotTable.[2015] as ANIO2015,
                            PivotTable.[2016] as ANIO2016,
                            PivotTable.[2017] as ANIO2017,
                            PivotTable.[2018] as ANIO2018,
                            PivotTable.[2019] as ANIO2019,
                            PivotTable.[2020] as ANIO2020,
                            PivotTable.[2021] as ANIO2021,
                            PivotTable.[2022] as ANIO2022,
                            Total= (
                          
                            isnull(PivotTable.[2015],0)+
                            isnull(PivotTable.[2016],0)+
                            isnull(PivotTable.[2017],0)+
                            isnull(PivotTable.[2018],0)+
                            isnull(PivotTable.[2019],0)+
                            isnull(PivotTable.[2020],0)+
                            isnull(PivotTable.[2021],0)+
                            isnull(PivotTable.[2022],0))

FROM
(
  select  ORDEN = 30 ,CTA_AUXILIAR_2 ='DPTO. DE SEGURIDAD Y SALUD LABORAL',  AÑO, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras2()
 WHERE AÑO $queryanio AND NMES BETWEEN $MesIni AND $MesFin AND EMPRESA='EJECUTADO' AND AREA like '%%' AND CC_MAYOR='6 - ADMINISTRACION' AND CENTRO_DE_COSTO='60228-SEGURIDAD Y SALUD LABORAL'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND CTA_AUXILIAR NOT IN ('511025 - ASESORIA JURIDICA','511095 - OTROS - HONORARIOS')
        
GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
) AS SourceTable 

PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021],[2022])) AS PivotTable

UNION ALL

SELECT ORDEN,CTA_AUXILIAR_2,
                            PivotTable.[2015] as ANIO2015,
                            PivotTable.[2016] as ANIO2016,
                            PivotTable.[2017] as ANIO2017,
                            PivotTable.[2018] as ANIO2018,
                            PivotTable.[2019] as ANIO2019,
                            PivotTable.[2020] as ANIO2020,
                            PivotTable.[2021] as ANIO2021,
                            PivotTable.[2022] as ANIO2022,
                            Total= (
                          
                            isnull(PivotTable.[2015],0)+
                            isnull(PivotTable.[2016],0)+
                            isnull(PivotTable.[2017],0)+
                            isnull(PivotTable.[2018],0)+
                            isnull(PivotTable.[2019],0)+
                            isnull(PivotTable.[2020],0)+
                            isnull(PivotTable.[2021],0)+
                            isnull(PivotTable.[2022],0))


FROM
(
  select  ORDEN = 31 ,CTA_AUXILIAR_2 ='HONORARIOS ABOGADO',  AÑO, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras2()
WHERE AÑO $queryanio AND NMES BETWEEN $MesIni AND $MesFin AND EMPRESA='EJECUTADO' AND AREA like '%%' AND CC_MAYOR='6 - ADMINISTRACION' AND CENTRO_DE_COSTO='60228-SEGURIDAD Y SALUD LABORAL'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND CTA_AUXILIAR = '511025 - ASESORIA JURIDICA'
        
GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
) AS SourceTable 

PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021],[2022]
)) AS PivotTable

UNION ALL

SELECT ORDEN,CTA_AUXILIAR_2,
                                               PivotTable.[2015] as ANIO2015,
                            PivotTable.[2016] as ANIO2016,
                            PivotTable.[2017] as ANIO2017,
                            PivotTable.[2018] as ANIO2018,
                            PivotTable.[2019] as ANIO2019,
                            PivotTable.[2020] as ANIO2020,
                            PivotTable.[2021] as ANIO2021,
                            PivotTable.[2022] as ANIO2022,
                            Total= (
                          
                            isnull(PivotTable.[2015],0)+
                            isnull(PivotTable.[2016],0)+
                            isnull(PivotTable.[2017],0)+
                            isnull(PivotTable.[2018],0)+
                            isnull(PivotTable.[2019],0)+
                            isnull(PivotTable.[2020],0)+
                            isnull(PivotTable.[2021],0)+
                            isnull(PivotTable.[2022],0))


FROM
(
  select  ORDEN=32 ,CTA_AUXILIAR_2 ='HONORARIOS MEDICO LABORAL' ,  AÑO, SUM(NETO) AS NETO from CostoSSL_EmpleadosPalmeras2()
  WHERE AÑO $queryanio AND NMES BETWEEN $MesIni AND $MesFin AND EMPRESA='EJECUTADO' AND AREA like '%%' AND CC_MAYOR='6 - ADMINISTRACION' AND CENTRO_DE_COSTO='60228-SEGURIDAD Y SALUD LABORAL'
        AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND CTA_AUXILIAR = '511095 - OTROS - HONORARIOS'
    
GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
) AS SourceTable 

PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021],[2022]
)) AS PivotTable

UNION ALL
SELECT  ORDEN,CTA_AUXILIAR_2,
                            PivotTable.[2015] as ANIO2015,
                            PivotTable.[2016] as ANIO2016,
                            PivotTable.[2017] as ANIO2017,
                            PivotTable.[2018] as ANIO2018,
                            PivotTable.[2019] as ANIO2019,
                            PivotTable.[2020] as ANIO2020,
                            PivotTable.[2021] as ANIO2021,
                            PivotTable.[2022] as ANIO2022,
                            Total= (
                          
                            isnull(PivotTable.[2015],0)+
                            isnull(PivotTable.[2016],0)+
                            isnull(PivotTable.[2017],0)+
                            isnull(PivotTable.[2018],0)+
                            isnull(PivotTable.[2019],0)+
                            isnull(PivotTable.[2020],0)+
                            isnull(PivotTable.[2021],0)+
                            isnull(PivotTable.[2022],0))
FROM
(
    SELECT ORDEN=36 ,CTA_AUXILIAR_2 ='N° DE EMPLEADOS' , AÑO , SUM(MES_DE_TRABAJO) as CTEMPLEA
    FROM BaseEmpleadosIndicadorNomina
    WHERE EMPRESA='EJECUTADO' AND AÑO $queryanio AND MES BETWEEN $MesIni AND $MesFin
    GROUP BY AÑO, Mes
) AS SourceTable 

PIVOT(AVG(CTEMPLEA) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021],[2022])) AS PivotTable


) K

LEFT JOIN CostoSSL_EmpleadosPresupuesto($at) AS PRE ON PRE.ORDEN = K.ORDEN

ORDER BY ORDEN
            "));
//dd($querycomparativo);

               
                return view('ssl.comparativo', compact('querycomparativo','filtro','at','anioprev'));


            }
            return view('ssl.selectanios');
        }
     
     public function escogeranios(Request $request)
        {
            
            
            return view('ssl.escoger');
        }

        public function comparativo(Request $request)
        {

           
           
            //return view('ssl.comparativo',compact('querycomparativo'));
        }
}
