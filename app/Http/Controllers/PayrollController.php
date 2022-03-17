<?php

namespace App\Http\Controllers;

use App\Http\Requests\PayrollStoreRequest;
use App\Http\Requests\PayrollUpdateRequest;
use App\Models\Payroll;
use App\Models\Basecontabilidadpresupuesto;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use DB;

class PayrollController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    set_time_limit(18000);
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


    
    return view('payroll.index', compact('procedure','mes','areas','area'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('payroll.create');
    }

    /**
     * @param \App\Http\Requests\PayrollStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PayrollStoreRequest $request)
    {
        $payroll = Payroll::create($request->validated());

        $request->session()->flash('payroll.id', $payroll->id);

        return redirect()->route('payroll.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Payroll $payroll
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Payroll $payroll)
    {

             

        return view('payroll.show', compact('payroll'));
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
        
            //dd($request->all());
            $FechaIni=strtotime($request->input('FechaInicio'));  
            $FechaFin=strtotime($request->input('FechaFin'));  
            $AniIni=date("Y", $FechaIni);  
            $MesIni=date("m", $FechaIni);  
            $AniFin=date("Y", $FechaFin);
            $MesFin=date("m", $FechaFin); 
            $area="'%".$request->input('area')."%'";  
            $informe= $request->input('Tipo')=='01' ? "Informe Comparativo Anual" : "Informe Carga Prestacional Mes ";
            $AnioActual=date("Y");  

            //dd($area,$AniIni, $MesIni, $AniFin, $MesFin, $AnioActual);
            $filtro = $informe." Año Inicial: ". $AniIni." Año Final: ". $AniFin . " Mes Inicial : ". $MesIni . " Mes Final: ". $MesFin. " Area: ". $request->input('area');
           
             //dd($filtro);   
           $query=DB::connection('palmeras')->select(DB::raw("SELECT ORDEN,CTA_AUXILIAR_2,
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
  select  ORDEN,CTA_AUXILIAR_2,  ANIOMES, SUM(NETO) AS NETO from CargaPrestacionalNominaPalmeras() 
  WHERE AÑO BETWEEN $AniIni AND $AniFin AND NMES BETWEEN $MesIni AND $MesFin AND CTA_AUXILIAR_2 NOT IN ('TEMPORALES') AND EMPRESA='EJECUTADO' AND AREA like $area
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
 ORDER BY ORDEN
"));

 $querycomparativo=DB::connection('palmeras')->select(DB::raw("SELECT PivotTable.ORDEN, PivotTable.CTA_AUXILIAR_2,ISNULL(PivotTable.[2015],0) AS ANIO2015,ISNULL(PivotTable.[2016],0) AS ANIO2016
,ISNULL(PivotTable.[2017],0) AS ANIO2017,ISNULL(PivotTable.[2018],0) AS ANIO2018 , ISNULL(PivotTable.[2019],0) AS ANIO2019,ISNULL(PivotTable.[2020],0) AS ANIO2020,ISNULL(Z.[2021],0) AS EJECUCION,ISNULL(D.[2021],0) AS PRESP
, EVAR= (NULLIF((NULLIF(Z.[2021],0)-NULLIF(PivotTable.[2020],0)),0))
, PVAR= (NULLIF((NULLIF(Z.[2021],0)-NULLIF(D.[2021],0)),0))
,VPPTO= (NULLIF(Z.[2021],0)-NULLIF(D.[2021],0))
,PVPPTO= ((NULLIF(Z.[2021],0)-NULLIF(D.[2021],0))/NULLIF(D.[2021],0))

FROM
(
  select  ORDEN,CTA_AUXILIAR_2,  AÑO, SUM(NETO) AS NETO from CargaPrestacionalNominaPalmeras() 
  WHERE AÑO BETWEEN $AniIni AND $AniFin AND NMES BETWEEN $MesIni AND $MesFin AND CTA_AUXILIAR_2 NOT IN ('TEMPORALES') AND AREA like $area
  AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND EMPRESA='EJECUTADO'
GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
) AS SourceTable 

PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021])) as PivotTable

LEFT JOIN(

SELECT PivotTable.ORDEN, PivotTable.[2021]

FROM
(
  select  ORDEN,CTA_AUXILIAR_2,  AÑO, SUM(NETO) AS NETO from CargaPrestacionalNominaPalmeras() 
  WHERE AÑO BETWEEN YEAR(GETDATE()) AND YEAR(GETDATE()) AND NMES BETWEEN $MesIni AND $MesFin AND CTA_AUXILIAR_2 NOT IN ('TEMPORALES') AND AREA like $area AND EMPRESA='PRESUPUESTO'
  AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS')
 GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
) AS SourceTable 

PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021])) as PivotTable ) AS D ON D.ORDEN = PivotTable.ORDEN

LEFT JOIN(

SELECT PivotTable.ORDEN, PivotTable.[2021]

FROM
(
  select  ORDEN,CTA_AUXILIAR_2,  AÑO, SUM(NETO) AS NETO from CargaPrestacionalNominaPalmeras() 
  WHERE AÑO BETWEEN YEAR(GETDATE()) AND YEAR(GETDATE()) AND NMES BETWEEN $MesIni AND $MesFin AND CTA_AUXILIAR_2 NOT IN ('TEMPORALES') AND AREA like $area AND EMPRESA='EJECUTADO'
  AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS')
GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
) AS SourceTable 

PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021])) as PivotTable ) AS Z ON Z.ORDEN = PivotTable.ORDEN

ORDER BY ORDEN

    "));

    //dd($querycomparativo);   


    //dd($request->all());

        if ($request->input('Tipo')=='01') {
            return view('payroll.comparativo', compact('querycomparativo','filtro'));
        }
        else if ($request->input('Tipo')=='02'){

            return view('payroll.cargarprestacional', compact('query','filtro'));

        } else {

           return view('payroll.indicenominapalmeras');;
        }

        

        
        
    }


      public function seleccionaranios(Request $request)
        {
                
                //dd($request->all());
                //$messel = json_encode($request->input('Mes'),TRUE);
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

                $cambiar = array("]");
                $cambiar1 = array("[");
                $cambiar2 = array("\"");
                $cambiado =str_replace($cambiar, "",$anios);
                $cambiado1 =str_replace($cambiar1, "",$cambiado);
                $cambiado2 = str_replace($cambiar2, "'",$cambiado1);
                $conswhere ="IN (".$cambiado2.")";
                $queryanio = $FechaIni ? "BETWEEN". $AniIni ."AND". $AniFin : $conswhere;
               

                $filtro = "Informe Comparativo por Años Seleccionados ". $cambiado2. " Mes Inicial : ". $MesIni . " Mes Final: ". $MesFin . " Area: ". $request->input('area');
                
               /* $cambiarmes = array("]");
                $cambiarmes1 = array("[");
                $cambiarmes2 = array("\"");
                $cambiadomes =str_replace($cambiarmes, "",$messel);
                $cambiadomes1 =str_replace($cambiarmes1, "",$cambiadomes);
                $cambiadomes2 = str_replace($cambiarmes2, "'",$cambiadomes1);
                $cambiado2mes = str_replace($cambiarmes2, "'",$cambiadomes1);
                $conswheremes ="IN (".$cambiado2mes.")";
                $querymes = $messel ? "BETWEEN". $MesIni ."AND". $MesFin : $conswheremes;*/


                //dd($MesIni,$MesFin);

           


            $tipo=$request->input('Tipo');
            if ($request->input('Tipo') =='03') {
                return view('payroll.escoger');
            } elseif ($request->input('Tipo') =='04') {


            


            //dd($anios, $mestope,$Tipo,$FechaIni,$FechaFin,$AniIni,$MesIni,$AniFin,$MesFin,$area);     
            
         $querycomparativo=DB::connection('palmeras')->select(DB::raw("SELECT PivotTable.ORDEN, PivotTable.CTA_AUXILIAR_2,ISNULL(PivotTable.[2015],0) AS ANIO2015,ISNULL(PivotTable.[2016],0) AS ANIO2016
            ,ISNULL(PivotTable.[2017],0) AS ANIO2017,ISNULL(PivotTable.[2018],0) AS ANIO2018 , ISNULL(PivotTable.[2019],0) AS ANIO2019,ISNULL(PivotTable.[2020],0) AS ANIO2020,ISNULL(Z.[2021],0) AS EJECUCION,ISNULL(D.[2021],0) AS PRESP
            , EVAR= (NULLIF((NULLIF(Z.[2021],0)-NULLIF(PivotTable.[2020],0)),0))
            , PVAR= (NULLIF((NULLIF(Z.[2021],0)-NULLIF(D.[2021],0)),0))
            ,VPPTO= (NULLIF(Z.[2021],0)-NULLIF(D.[2021],0))
            ,PVPPTO= ((NULLIF(Z.[2021],0)-NULLIF(D.[2021],0))/NULLIF(D.[2021],0))

            FROM
            (
              select  ORDEN,CTA_AUXILIAR_2,  AÑO, SUM(NETO) AS NETO from CargaPrestacionalNominaPalmeras() 
              WHERE AÑO $queryanio AND NMES BETWEEN $MesIni AND $MesFin AND CTA_AUXILIAR_2 NOT IN ('TEMPORALES') AND AREA like $area
              AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS') AND EMPRESA='EJECUTADO'
              GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
              ) AS SourceTable 

            PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021])) as PivotTable

            LEFT JOIN(

                SELECT PivotTable.ORDEN, PivotTable.[2021]

                FROM
                (
                  select  ORDEN,CTA_AUXILIAR_2,  AÑO, SUM(NETO) AS NETO from CargaPrestacionalNominaPalmeras() 
                  WHERE AÑO $queryanio AND NMES BETWEEN $MesIni AND $MesFin AND CTA_AUXILIAR_2 NOT IN ('TEMPORALES') AND AREA like $area AND EMPRESA='PRESUPUESTO'
                  AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS')
                  GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
                  ) AS SourceTable 

                PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021])) as PivotTable ) AS D ON D.ORDEN = PivotTable.ORDEN

            LEFT JOIN(

                SELECT PivotTable.ORDEN, PivotTable.[2021]

                FROM
                (
                  select  ORDEN,CTA_AUXILIAR_2,  AÑO, SUM(NETO) AS NETO from CargaPrestacionalNominaPalmeras() 
                  WHERE AÑO $queryanio AND NMES BETWEEN $MesIni AND $MesFin AND CTA_AUXILIAR_2 NOT IN ('TEMPORALES') AND AREA like $area AND EMPRESA='EJECUTADO'
                  AND COMPROBANTE NOT IN ('09 - DISTRIBUCION CENTROS DE COSTOS','16 - PRODUCCION','90 - CIERRE CUENTAS TRIBUTARIAS')
                  GROUP BY ORDEN,CTA_AUXILIAR_2,AÑO 
                  ) AS SourceTable 

                PIVOT(SUM(NETO) FOR AÑO IN([2015],[2016],[2017],[2018],[2019],[2020],[2021])) as PivotTable ) AS Z ON Z.ORDEN = PivotTable.ORDEN

            ORDER BY ORDEN

            "));

               
                return view('payroll.comparativo', compact('querycomparativo','filtro'));


            }
            return view('payroll.selectanios');
        }
     
     public function escogeranios(Request $request)
        {
            
            
            return view('payroll.escoger');
        }

        public function comparativo(Request $request)
        {

           
           
            //return view('payroll.comparativo',compact('querycomparativo'));
        }
  

}
