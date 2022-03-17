<?php

namespace App\Http\Controllers;


use App\Http\Requests\FletesStoreRequest;
use App\Http\Requests\FletesUpdateRequest;
use DB;

use Illuminate\Http\Request;

class FletesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        


    
        return view('flete.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('flete.create');
    }

    /**
     * @param \App\Http\Requests\FletesStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(FletesStoreRequest $request)
    {
        //$flete = Flete::create($request->validated());

        //$request->session()->flash('flete.id', $flete->id);

        return redirect()->route('flete.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\flete $flete
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return view('flete.show', compact('flete'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\flete $flete
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return view('flete.edit', compact('flete'));
    }

    /**
     * @param \App\Http\Requests\FletesUpdateRequest $request
     * @param \App\flete $flete
     * @return \Illuminate\Http\Response
     */
    public function update(FletesUpdateRequest $request)
    {
        //$flete->update($request->validated());

        //$request->session()->flash('flete.id', $flete->id);

        return redirect()->route('flete.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\flete $flete
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //$flete->delete();

        return redirect()->route('flete.index');
    }

    public function fletesmes(Request $request)

    {
    
    
            $FechaIni=strtotime($request->input('FechaInicio'));  
            $FechaFin=strtotime($request->input('FechaFin'));  
            $AniIni=date("Y", $FechaIni);  
            $MesIni=date("m", $FechaIni);  
            $AniFin=date("Y", $FechaFin);
            $MesFin=date("m", $FechaFin);
            
            $filtro = "<strong>Mes o Acumulado al mes de : </strong> <u>" . $request->input('FechaInicio') . "</u> Hasta:  <u>" . $request->input('FechaFin') ."</u>" ; 
            

    $query=DB::connection('duquesa')->select(DB::raw("

SELECT * FROM (
SELECT D.RUTA,T.ZONA, VLR_FLETE=(SUM(D.VLR_FLETE)/SUM(D.Kilos)), SUM(D.Kilos) AS Kilos, TNETO=((SUM(D.VLR_FLETE)/SUM(D.Kilos)) * SUM(D.Kilos)),
    P.VALOR_PPTO,
    P.KILOS_PTTO,
    P.COSTO_NETO,

VARNETA =((SUM(D.VLR_FLETE)/SUM(D.Kilos)) * SUM(D.Kilos))- P.COSTO_NETO,
PVARNETA=(((SUM(D.VLR_FLETE)/SUM(D.Kilos)) * SUM(D.Kilos))- P.COSTO_NETO)/IIF(P.COSTO_NETO=0,1,P.COSTO_NETO) ,
VARTARIFA=((SUM(D.VLR_FLETE)/SUM(D.Kilos))-P.VALOR_PPTO)/IIF(P.VALOR_PPTO=0,1,P.VALOR_PPTO),
VARVOLUM=(SUM(D.Kilos)- P.KILOS_PTTO)/IIF(P.KILOS_PTTO=0,1,P.KILOS_PTTO),
VARPRECIO=((SUM(D.VLR_FLETE)/SUM(D.Kilos))-P.VALOR_PPTO)*p.KILOS_PTTO,
VARCANT=(SUM(D.Kilos)-p.KILOS_PTTO)*(SUM(D.VLR_FLETE)/SUM(D.Kilos))

FROM (
SELECT
       RUTA = CASE
               WHEN CODALTERNO ='900155107-1' THEN '900155107-1'
               WHEN CODALTERNO ='900059238-5' THEN '900059238-5'    
               WHEN CODRUTA IN ('B04','B03','B01','B02','B05','B06','B07','B08','B09','B10','B11','B12','B13','B14','B15','B16','B17','B18','B19','B20','B21') THEN 'B'
               
              ELSE CODRUTA  END ,    
    
       sum(TKILOSCE) as Kilos,
       sum(VALOR_FLETE) AS VLR_FLETE,
       sum(Total_Neto) AS TNETO
  FROM [DUQUESA].[dbo].[CostosFletes] where ano =$AniFin and periodo BETWEEN $MesIni AND $MesFin
  group by CODRUTA, NOMRUTA, TKILOSCE,VALOR_FLETE,Total_Neto,CODALTERNO
  ) D


LEFT JOIN 
(
SELECT CODZONA, AVG(VALOR_PPTO) AS VALOR_PPTO, SUM(KILOS_PTTO) AS KILOS_PTTO, SUM(COSTO_NETO) AS COSTO_NETO FROM FletesPtto
WHERE ANIO=$AniFin  AND MES BETWEEN $MesIni AND $MesFin
GROUP BY CODZONA

) P ON P.CODZONA = D.RUTA


LEFT JOIN (
 SELECT DISTINCT CODZONA,ZONA FROM FletesPtto
 ) T ON T.CODZONA = D.RUTA


  GROUP BY D.RUTA, T.ZONA,P.COSTO_NETO,P.KILOS_PTTO,P.VALOR_PPTO

UNION ALL

SELECT RUTA='TOTAL', ZONA='TOTAL PLATAFORMA', (SUM(T.TNETO)/SUM(T.Kilos)), SUM(T.Kilos), SUM(T.TNETO), (SUM(T.COSTO_NETO)/SUM(T.KILOS_PTTO)), SUM(T.KILOS_PTTO),SUM(T.COSTO_NETO)
,(SUM(T.TNETO)-SUM(T.COSTO_NETO))  --VARNETA
,(SUM(T.TNETO)-SUM(T.COSTO_NETO))/SUM(T.COSTO_NETO)*100  --PVARNETA
,((SUM(T.TNETO)/SUM(T.Kilos))-(SUM(T.COSTO_NETO)/SUM(T.KILOS_PTTO)))/((SUM(T.COSTO_NETO)/SUM(T.KILOS_PTTO)))*100 --VARTARIFA
,(SUM(T.Kilos)-SUM(T.KILOS_PTTO))/SUM(T.KILOS_PTTO)*100 --VARVOLUM
,((SUM(T.TNETO)/SUM(T.Kilos))-(SUM(T.COSTO_NETO)/SUM(T.KILOS_PTTO)))* SUM(T.KILOS_PTTO) --VARPRECIO
,(SUM(T.Kilos)-SUM(T.KILOS_PTTO))*(SUM(T.COSTO_NETO)/SUM(T.KILOS_PTTO)) --VARCANT




FROM (
    SELECT D.RUTA,T.ZONA, VLR_FLETE=(SUM(D.VLR_FLETE)/SUM(D.Kilos)), SUM(D.Kilos) AS Kilos, TNETO=((SUM(D.VLR_FLETE)/SUM(D.Kilos)) * SUM(D.Kilos)),
    P.VALOR_PPTO,
    P.KILOS_PTTO,
    P.COSTO_NETO,

VARNETA =((SUM(D.VLR_FLETE)/SUM(D.Kilos)) * SUM(D.Kilos))- P.COSTO_NETO,
PVARNETA=(((SUM(D.VLR_FLETE)/SUM(D.Kilos)) * SUM(D.Kilos))- P.COSTO_NETO)/IIF(P.COSTO_NETO=0,1,P.COSTO_NETO) ,
VARTARIFA=((SUM(D.VLR_FLETE)/SUM(D.Kilos))-P.VALOR_PPTO)/IIF(P.VALOR_PPTO=0,1,P.VALOR_PPTO),
VARVOLUM=(SUM(D.Kilos)- P.KILOS_PTTO)/IIF(P.KILOS_PTTO=0,1,P.KILOS_PTTO),
VARPRECIO=((SUM(D.VLR_FLETE)/SUM(D.Kilos))-P.VALOR_PPTO)*p.KILOS_PTTO,
VARCANT=(SUM(D.Kilos)-p.KILOS_PTTO)*(SUM(D.VLR_FLETE)/SUM(D.Kilos))

FROM (
SELECT
       RUTA = CASE
               WHEN CODALTERNO ='900155107-1' THEN '900155107-1'
               WHEN CODALTERNO ='900059238-5' THEN '900059238-5'    
               WHEN CODRUTA IN ('B04','B03','B01','B02','B05','B06','B07','B08','B09','B10','B11','B12','B13','B14','B15','B16','B17','B18','B19','B20','B21') THEN 'B'
               
              ELSE CODRUTA  END ,    
    
       sum(TKILOSCE) as Kilos,
       sum(VALOR_FLETE) AS VLR_FLETE,
       sum(Total_Neto) AS TNETO
  FROM [DUQUESA].[dbo].[CostosFletes] where ano =$AniFin and periodo BETWEEN $MesIni AND $MesFin
  group by CODRUTA, NOMRUTA, TKILOSCE,VALOR_FLETE,Total_Neto,CODALTERNO
  ) D


LEFT JOIN 
(
SELECT CODZONA, AVG(VALOR_PPTO) AS VALOR_PPTO, SUM(KILOS_PTTO) AS KILOS_PTTO, SUM(COSTO_NETO) AS COSTO_NETO FROM FletesPtto
WHERE ANIO=$AniFin  AND MES BETWEEN $MesIni AND $MesFin
GROUP BY CODZONA

) P ON P.CODZONA = D.RUTA


LEFT JOIN (
 SELECT DISTINCT CODZONA,ZONA FROM FletesPtto
 ) T ON T.CODZONA = D.RUTA


  GROUP BY D.RUTA, T.ZONA,P.COSTO_NETO,P.KILOS_PTTO,P.VALOR_PPTO

) T
    WHERE T.RUTA IN ('900059238-5','900155107-1')
) P

WHERE P.RUTA IN ('900059238-5','900155107-1','TOTAL')


            "));

$bogota=DB::connection('duquesa')->select(DB::raw(" 


SELECT * FROM (
SELECT D.RUTA,T.ZONA, VLR_FLETE=(SUM(D.VLR_FLETE)/SUM(D.Kilos)), SUM(D.Kilos) AS Kilos, TNETO=((SUM(D.VLR_FLETE)/SUM(D.Kilos)) * SUM(D.Kilos)),
    P.VALOR_PPTO,
    P.KILOS_PTTO,
    P.COSTO_NETO,

VARNETA =((SUM(D.VLR_FLETE)/SUM(D.Kilos)) * SUM(D.Kilos))- P.COSTO_NETO,
PVARNETA=(((SUM(D.VLR_FLETE)/SUM(D.Kilos)) * SUM(D.Kilos))- P.COSTO_NETO)/IIF(P.COSTO_NETO=0,1,P.COSTO_NETO) ,
VARTARIFA=((SUM(D.VLR_FLETE)/SUM(D.Kilos))-P.VALOR_PPTO)/IIF(P.VALOR_PPTO=0,1,P.VALOR_PPTO),
VARVOLUM=(SUM(D.Kilos)- P.KILOS_PTTO)/IIF(P.KILOS_PTTO=0,1,P.KILOS_PTTO),
VARPRECIO=((SUM(D.VLR_FLETE)/SUM(D.Kilos))-P.VALOR_PPTO)*p.KILOS_PTTO,
VARCANT=(SUM(D.Kilos)-p.KILOS_PTTO)*(SUM(D.VLR_FLETE)/SUM(D.Kilos))

FROM (
SELECT
       RUTA = CASE
               WHEN CODALTERNO ='900155107-1' THEN '900155107-1'
               WHEN CODALTERNO ='900059238-5' THEN '900059238-5'    
               WHEN CODRUTA IN ('B04','B03','B01','B02','B05','B06','B07','B08','B09','B10','B11','B12','B13','B14','B15','B16','B17','B18','B19','B20','B21') THEN 'B'
               
              ELSE CODRUTA  END ,    
    
       sum(TKILOSCE) as Kilos,
       sum(VALOR_FLETE) AS VLR_FLETE,
       sum(Total_Neto) AS TNETO
  FROM [DUQUESA].[dbo].[CostosFletes] where ano =$AniFin and periodo BETWEEN $MesIni AND $MesFin
  group by CODRUTA, NOMRUTA, TKILOSCE,VALOR_FLETE,Total_Neto,CODALTERNO
  ) D


LEFT JOIN 
(
SELECT CODZONA, AVG(VALOR_PPTO) AS VALOR_PPTO, SUM(KILOS_PTTO) AS KILOS_PTTO, SUM(COSTO_NETO) AS COSTO_NETO FROM FletesPtto
WHERE ANIO=$AniFin  AND MES BETWEEN $MesIni AND $MesFin
GROUP BY CODZONA

) P ON P.CODZONA = D.RUTA


LEFT JOIN (
 SELECT DISTINCT CODZONA,ZONA FROM FletesPtto
 ) T ON T.CODZONA = D.RUTA


  GROUP BY D.RUTA, T.ZONA,P.COSTO_NETO,P.KILOS_PTTO,P.VALOR_PPTO

UNION ALL

SELECT RUTA='TOTAL', ZONA='TOTAL BOGOTA', (SUM(T.TNETO)/SUM(T.Kilos)), SUM(T.Kilos), SUM(T.TNETO), (SUM(T.COSTO_NETO)/SUM(T.KILOS_PTTO)), SUM(T.KILOS_PTTO),SUM(T.COSTO_NETO)
,(SUM(T.TNETO)-SUM(T.COSTO_NETO))  --VARNETA
,(SUM(T.TNETO)-SUM(T.COSTO_NETO))/SUM(T.COSTO_NETO)*100  --PVARNETA
,((SUM(T.TNETO)/SUM(T.Kilos))-(SUM(T.COSTO_NETO)/SUM(T.KILOS_PTTO)))/((SUM(T.COSTO_NETO)/SUM(T.KILOS_PTTO)))*100 --VARTARIFA
,(SUM(T.Kilos)-SUM(T.KILOS_PTTO))/SUM(T.KILOS_PTTO)*100 --VARVOLUM
,((SUM(T.TNETO)/SUM(T.Kilos))-(SUM(T.COSTO_NETO)/SUM(T.KILOS_PTTO)))* SUM(T.KILOS_PTTO) --VARPRECIO
,(SUM(T.Kilos)-SUM(T.KILOS_PTTO))*(SUM(T.COSTO_NETO)/SUM(T.KILOS_PTTO)) --VARCANT




FROM (
    SELECT D.RUTA,T.ZONA, VLR_FLETE=(SUM(D.VLR_FLETE)/SUM(D.Kilos)), SUM(D.Kilos) AS Kilos, TNETO=((SUM(D.VLR_FLETE)/SUM(D.Kilos)) * SUM(D.Kilos)),
    P.VALOR_PPTO,
    P.KILOS_PTTO,
    P.COSTO_NETO,

VARNETA =((SUM(D.VLR_FLETE)/SUM(D.Kilos)) * SUM(D.Kilos))- P.COSTO_NETO,
PVARNETA=(((SUM(D.VLR_FLETE)/SUM(D.Kilos)) * SUM(D.Kilos))- P.COSTO_NETO)/IIF(P.COSTO_NETO=0,1,P.COSTO_NETO) ,
VARTARIFA=((SUM(D.VLR_FLETE)/SUM(D.Kilos))-P.VALOR_PPTO)/IIF(P.VALOR_PPTO=0,1,P.VALOR_PPTO),
VARVOLUM=(SUM(D.Kilos)- P.KILOS_PTTO)/IIF(P.KILOS_PTTO=0,1,P.KILOS_PTTO),
VARPRECIO=((SUM(D.VLR_FLETE)/SUM(D.Kilos))-P.VALOR_PPTO)*p.KILOS_PTTO,
VARCANT=(SUM(D.Kilos)-p.KILOS_PTTO)*(SUM(D.VLR_FLETE)/SUM(D.Kilos))

FROM (
SELECT
       RUTA = CASE
               WHEN CODALTERNO ='900155107-1' THEN '900155107-1'
               WHEN CODALTERNO ='900059238-5' THEN '900059238-5'    
               WHEN CODRUTA IN ('B04','B03','B01','B02','B05','B06','B07','B08','B09','B10','B11','B12','B13','B14','B15','B16','B17','B18','B19','B20','B21') THEN 'B'
               
              ELSE CODRUTA  END ,    
    
       sum(TKILOSCE) as Kilos,
       sum(VALOR_FLETE) AS VLR_FLETE,
       sum(Total_Neto) AS TNETO
  FROM [DUQUESA].[dbo].[CostosFletes] where ano =$AniFin and periodo BETWEEN $MesIni AND $MesFin
  group by CODRUTA, NOMRUTA, TKILOSCE,VALOR_FLETE,Total_Neto,CODALTERNO
  ) D


LEFT JOIN 
(
SELECT CODZONA, AVG(VALOR_PPTO) AS VALOR_PPTO, SUM(KILOS_PTTO) AS KILOS_PTTO, SUM(COSTO_NETO) AS COSTO_NETO FROM FletesPtto
WHERE ANIO=$AniFin  AND MES BETWEEN $MesIni AND $MesFin
GROUP BY CODZONA

) P ON P.CODZONA = D.RUTA


LEFT JOIN (
 SELECT DISTINCT CODZONA,ZONA FROM FletesPtto
 ) T ON T.CODZONA = D.RUTA


  GROUP BY D.RUTA, T.ZONA,P.COSTO_NETO,P.KILOS_PTTO,P.VALOR_PPTO

) T
    WHERE T.RUTA IN ('B','B22')
) P

WHERE P.RUTA IN ('B','B22','TOTAL')
    

    "));


$nacional=DB::connection('duquesa')->select(DB::raw("


SELECT * FROM (
SELECT D.RUTA,T.ZONA, VLR_FLETE=(SUM(D.VLR_FLETE)/SUM(D.Kilos)), SUM(D.Kilos) AS Kilos, TNETO=((SUM(D.VLR_FLETE)/SUM(D.Kilos)) * SUM(D.Kilos)),
    P.VALOR_PPTO,
    P.KILOS_PTTO,
    P.COSTO_NETO,

VARNETA =((SUM(D.VLR_FLETE)/SUM(D.Kilos)) * SUM(D.Kilos))- P.COSTO_NETO,
PVARNETA=(((SUM(D.VLR_FLETE)/SUM(D.Kilos)) * SUM(D.Kilos))- P.COSTO_NETO)/IIF(P.COSTO_NETO=0,1,P.COSTO_NETO) ,
VARTARIFA=((SUM(D.VLR_FLETE)/SUM(D.Kilos))-P.VALOR_PPTO)/IIF(P.VALOR_PPTO=0,1,P.VALOR_PPTO),
VARVOLUM=(SUM(D.Kilos)- P.KILOS_PTTO)/IIF(P.KILOS_PTTO=0,1,P.KILOS_PTTO),
VARPRECIO=((SUM(D.VLR_FLETE)/SUM(D.Kilos))-P.VALOR_PPTO)*p.KILOS_PTTO,
VARCANT=(SUM(D.Kilos)-p.KILOS_PTTO)*(SUM(D.VLR_FLETE)/SUM(D.Kilos))

FROM (
SELECT
       RUTA = CASE
               WHEN CODALTERNO ='900155107-1' THEN '900155107-1'
               WHEN CODALTERNO ='900059238-5' THEN '900059238-5'    
               WHEN CODRUTA IN ('B04','B03','B01','B02','B05','B06','B07','B08','B09','B10','B11','B12','B13','B14','B15','B16','B17','B18','B19','B20','B21') THEN 'B'
               
              ELSE CODRUTA  END ,    
    
       sum(TKILOSCE) as Kilos,
       sum(VALOR_FLETE) AS VLR_FLETE,
       sum(Total_Neto) AS TNETO
  FROM [DUQUESA].[dbo].[CostosFletes] where ano =$AniFin and periodo BETWEEN $MesIni AND $MesFin
  group by CODRUTA, NOMRUTA, TKILOSCE,VALOR_FLETE,Total_Neto,CODALTERNO
  ) D


LEFT JOIN 
(
SELECT CODZONA, AVG(VALOR_PPTO) AS VALOR_PPTO, SUM(KILOS_PTTO) AS KILOS_PTTO, SUM(COSTO_NETO) AS COSTO_NETO FROM FletesPtto
WHERE ANIO=$AniFin  AND MES BETWEEN $MesIni AND $MesFin
GROUP BY CODZONA

) P ON P.CODZONA = D.RUTA


LEFT JOIN (
 SELECT DISTINCT CODZONA,ZONA FROM FletesPtto
 ) T ON T.CODZONA = D.RUTA


  GROUP BY D.RUTA, T.ZONA,P.COSTO_NETO,P.KILOS_PTTO,P.VALOR_PPTO

UNION ALL

SELECT RUTA='TOTAL', ZONA='TOTAL FUERA BTA', (SUM(T.TNETO)/SUM(T.Kilos)), SUM(T.Kilos), SUM(T.TNETO), (SUM(T.COSTO_NETO)/SUM(T.KILOS_PTTO)), SUM(T.KILOS_PTTO),SUM(T.COSTO_NETO)
,(SUM(T.TNETO)-SUM(T.COSTO_NETO))  --VARNETA
,(SUM(T.TNETO)-SUM(T.COSTO_NETO))/SUM(T.COSTO_NETO)*100  --PVARNETA
,((SUM(T.TNETO)/SUM(T.Kilos))-(SUM(T.COSTO_NETO)/SUM(T.KILOS_PTTO)))/((SUM(T.COSTO_NETO)/SUM(T.KILOS_PTTO)))*100 --VARTARIFA
,(SUM(T.Kilos)-SUM(T.KILOS_PTTO))/SUM(T.KILOS_PTTO)*100 --VARVOLUM
,((SUM(T.TNETO)/SUM(T.Kilos))-(SUM(T.COSTO_NETO)/SUM(T.KILOS_PTTO)))* SUM(T.KILOS_PTTO) --VARPRECIO
,(SUM(T.Kilos)-SUM(T.KILOS_PTTO))*(SUM(T.COSTO_NETO)/SUM(T.KILOS_PTTO)) --VARCANT



FROM (
    SELECT D.RUTA,T.ZONA, VLR_FLETE=(SUM(D.VLR_FLETE)/SUM(D.Kilos)), SUM(D.Kilos) AS Kilos, TNETO=((SUM(D.VLR_FLETE)/SUM(D.Kilos)) * SUM(D.Kilos)),
    P.VALOR_PPTO,
    P.KILOS_PTTO,
    P.COSTO_NETO,

VARNETA =((SUM(D.VLR_FLETE)/SUM(D.Kilos)) * SUM(D.Kilos))- P.COSTO_NETO,
PVARNETA=(((SUM(D.VLR_FLETE)/SUM(D.Kilos)) * SUM(D.Kilos))- P.COSTO_NETO)/IIF(P.COSTO_NETO=0,1,P.COSTO_NETO) ,
VARTARIFA=((SUM(D.VLR_FLETE)/SUM(D.Kilos))-P.VALOR_PPTO)/IIF(P.VALOR_PPTO=0,1,P.VALOR_PPTO),
VARVOLUM=(SUM(D.Kilos)- P.KILOS_PTTO)/IIF(P.KILOS_PTTO=0,1,P.KILOS_PTTO),
VARPRECIO=((SUM(D.VLR_FLETE)/SUM(D.Kilos))-P.VALOR_PPTO)*p.KILOS_PTTO,
VARCANT=(SUM(D.Kilos)-p.KILOS_PTTO)*(SUM(D.VLR_FLETE)/SUM(D.Kilos))

FROM (
SELECT
       RUTA = CASE
               WHEN CODALTERNO ='900155107-1' THEN '900155107-1'
               WHEN CODALTERNO ='900059238-5' THEN '900059238-5'    
               WHEN CODRUTA IN ('B04','B03','B01','B02','B05','B06','B07','B08','B09','B10','B11','B12','B13','B14','B15','B16','B17','B18','B19','B20','B21') THEN 'B'
               
              ELSE CODRUTA  END ,    
    
       sum(TKILOSCE) as Kilos,
       sum(VALOR_FLETE) AS VLR_FLETE,
       sum(Total_Neto) AS TNETO
  FROM [DUQUESA].[dbo].[CostosFletes] where ano =$AniFin and periodo BETWEEN $MesIni AND $MesFin
  group by CODRUTA, NOMRUTA, TKILOSCE,VALOR_FLETE,Total_Neto,CODALTERNO
  ) D


LEFT JOIN 
(
SELECT CODZONA, AVG(VALOR_PPTO) AS VALOR_PPTO, SUM(KILOS_PTTO) AS KILOS_PTTO, SUM(COSTO_NETO) AS COSTO_NETO FROM FletesPtto
WHERE ANIO=$AniFin  AND MES BETWEEN $MesIni AND $MesFin

GROUP BY CODZONA
) P ON P.CODZONA = D.RUTA


LEFT JOIN (
 SELECT DISTINCT CODZONA,ZONA FROM FletesPtto
 ) T ON T.CODZONA = D.RUTA


  GROUP BY D.RUTA, T.ZONA,P.COSTO_NETO,P.KILOS_PTTO,P.VALOR_PPTO

) T
    WHERE T.RUTA NOT IN ('B','B22','900059238-5','900155107-1')
) P

WHERE P.RUTA NOT IN  ('B','B22','900059238-5','900155107-1')
    

"));

$total=DB::connection('duquesa')->select(DB::raw("
SELECT * FROM (
SELECT D.RUTA,T.ZONA, VLR_FLETE=(SUM(D.VLR_FLETE)/SUM(D.Kilos)), SUM(D.Kilos) AS Kilos, TNETO=((SUM(D.VLR_FLETE)/SUM(D.Kilos)) * SUM(D.Kilos)),
    P.VALOR_PPTO,
    P.KILOS_PTTO,
    P.COSTO_NETO,

VARNETA =((SUM(D.VLR_FLETE)/SUM(D.Kilos)) * SUM(D.Kilos))- P.COSTO_NETO,
PVARNETA=(((SUM(D.VLR_FLETE)/SUM(D.Kilos)) * SUM(D.Kilos))- P.COSTO_NETO)/IIF(P.COSTO_NETO=0,1,P.COSTO_NETO) ,
VARTARIFA=((SUM(D.VLR_FLETE)/SUM(D.Kilos))-P.VALOR_PPTO)/IIF(P.VALOR_PPTO=0,1,P.VALOR_PPTO),
VARVOLUM=(SUM(D.Kilos)- P.KILOS_PTTO)/IIF(P.KILOS_PTTO=0,1,P.KILOS_PTTO),
VARPRECIO=((SUM(D.VLR_FLETE)/SUM(D.Kilos))-P.VALOR_PPTO)*p.KILOS_PTTO,
VARCANT=(SUM(D.Kilos)-p.KILOS_PTTO)*(SUM(D.VLR_FLETE)/SUM(D.Kilos))

FROM (
SELECT
       RUTA = CASE
               WHEN CODALTERNO ='900155107-1' THEN '900155107-1'
               WHEN CODALTERNO ='900059238-5' THEN '900059238-5'    
               WHEN CODRUTA IN ('B04','B03','B01','B02','B05','B06','B07','B08','B09','B10','B11','B12','B13','B14','B15','B16','B17','B18','B19','B20','B21') THEN 'B'
               
              ELSE CODRUTA  END ,    
    
       sum(TKILOSCE) as Kilos,
       sum(VALOR_FLETE) AS VLR_FLETE,
       sum(Total_Neto) AS TNETO
  FROM [DUQUESA].[dbo].[CostosFletes] where ano =$AniFin and periodo BETWEEN $MesIni AND $MesFin
  group by CODRUTA, NOMRUTA, TKILOSCE,VALOR_FLETE,Total_Neto,CODALTERNO
  ) D


LEFT JOIN 
(
SELECT CODZONA, AVG(VALOR_PPTO) AS VALOR_PPTO, SUM(KILOS_PTTO) AS KILOS_PTTO, SUM(COSTO_NETO) AS COSTO_NETO FROM FletesPtto
WHERE ANIO=$AniFin  AND MES BETWEEN $MesIni AND $MesFin
GROUP BY CODZONA

) P ON P.CODZONA = D.RUTA


LEFT JOIN (
 SELECT DISTINCT CODZONA,ZONA FROM FletesPtto
 ) T ON T.CODZONA = D.RUTA


  GROUP BY D.RUTA, T.ZONA,P.COSTO_NETO,P.KILOS_PTTO,P.VALOR_PPTO

UNION ALL

SELECT RUTA='TOTAL', ZONA='TOTAL', (SUM(T.TNETO)/SUM(T.Kilos)), SUM(T.Kilos), SUM(T.TNETO), (SUM(T.COSTO_NETO)/SUM(T.KILOS_PTTO)), SUM(T.KILOS_PTTO),SUM(T.COSTO_NETO)
,(SUM(T.TNETO)-SUM(T.COSTO_NETO))  --VARNETA
,(SUM(T.TNETO)-SUM(T.COSTO_NETO))/SUM(T.COSTO_NETO)*100  --PVARNETA
,((SUM(T.TNETO)/SUM(T.Kilos))-(SUM(T.COSTO_NETO)/SUM(T.KILOS_PTTO)))/((SUM(T.COSTO_NETO)/SUM(T.KILOS_PTTO)))*100 --VARTARIFA
,(SUM(T.Kilos)-SUM(T.KILOS_PTTO))/SUM(T.KILOS_PTTO)*100 --VARVOLUM
,((SUM(T.TNETO)/SUM(T.Kilos))-(SUM(T.COSTO_NETO)/SUM(T.KILOS_PTTO)))* SUM(T.KILOS_PTTO) --VARPRECIO
,(SUM(T.Kilos)-SUM(T.KILOS_PTTO))*(SUM(T.COSTO_NETO)/SUM(T.KILOS_PTTO)) --VARCANT




FROM (
    SELECT D.RUTA,T.ZONA, VLR_FLETE=(SUM(D.VLR_FLETE)/SUM(D.Kilos)), SUM(D.Kilos) AS Kilos, TNETO=((SUM(D.VLR_FLETE)/SUM(D.Kilos)) * SUM(D.Kilos)),
    P.VALOR_PPTO,
    P.KILOS_PTTO,
    P.COSTO_NETO,

VARNETA =((SUM(D.VLR_FLETE)/SUM(D.Kilos)) * SUM(D.Kilos))- P.COSTO_NETO,
PVARNETA=(((SUM(D.VLR_FLETE)/SUM(D.Kilos)) * SUM(D.Kilos))- P.COSTO_NETO)/IIF(P.COSTO_NETO=0,1,P.COSTO_NETO) ,
VARTARIFA=((SUM(D.VLR_FLETE)/SUM(D.Kilos))-P.VALOR_PPTO)/IIF(P.VALOR_PPTO=0,1,P.VALOR_PPTO),
VARVOLUM=(SUM(D.Kilos)- P.KILOS_PTTO)/IIF(P.KILOS_PTTO=0,1,P.KILOS_PTTO),
VARPRECIO=((SUM(D.VLR_FLETE)/SUM(D.Kilos))-P.VALOR_PPTO)*p.KILOS_PTTO,
VARCANT=(SUM(D.Kilos)-p.KILOS_PTTO)*(SUM(D.VLR_FLETE)/SUM(D.Kilos))

FROM (
SELECT
       RUTA = CASE
               WHEN CODALTERNO ='900155107-1' THEN '900155107-1'
               WHEN CODALTERNO ='900059238-5' THEN '900059238-5'    
               WHEN CODRUTA IN ('B04','B03','B01','B02','B05','B06','B07','B08','B09','B10','B11','B12','B13','B14','B15','B16','B17','B18','B19','B20','B21') THEN 'B'
               
              ELSE CODRUTA  END ,    
    
       sum(TKILOSCE) as Kilos,
       sum(VALOR_FLETE) AS VLR_FLETE,
       sum(Total_Neto) AS TNETO
  FROM [DUQUESA].[dbo].[CostosFletes] where ano =$AniFin and periodo BETWEEN $MesIni AND $MesFin
  group by CODRUTA, NOMRUTA, TKILOSCE,VALOR_FLETE,Total_Neto,CODALTERNO
  ) D


LEFT JOIN 
(
SELECT CODZONA, AVG(VALOR_PPTO) AS VALOR_PPTO, SUM(KILOS_PTTO) AS KILOS_PTTO, SUM(COSTO_NETO) AS COSTO_NETO FROM FletesPtto
WHERE ANIO=$AniFin  AND MES BETWEEN $MesIni AND $MesFin
GROUP BY CODZONA

) P ON P.CODZONA = D.RUTA


LEFT JOIN (
 SELECT DISTINCT CODZONA,ZONA FROM FletesPtto
 ) T ON T.CODZONA = D.RUTA


  GROUP BY D.RUTA, T.ZONA,P.COSTO_NETO,P.KILOS_PTTO,P.VALOR_PPTO

) T

) P

WHERE P.RUTA IN  ('TOTAL')
    
"));    



        return view('flete.fletemes',compact('query','filtro','bogota','nacional', 'total'));

    }
}
