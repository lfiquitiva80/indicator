<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\Queue\ShouldQueue;
use DB;


class EmpleadosExport implements FromCollection ,ShouldQueue,Responsable,WithHeadings
{
    
     use Exportable;


      public function __construct($AniFin,$AniIni,$MesIni,$MesFin) 
    {
        $this->AniFin = $AniFin;
        $this->AniIni = $AniIni;
        $this->MesIni = $MesIni;
        $this->MesFin = $MesFin;
      
    }
     

    private $fileName = 'Empleados.xlsx';
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
            set_time_limit(3000000);
            ini_set('memory_limit', '-1'); 

        return $empleados=collect(DB::connection('palmeras')->select(DB::raw("

                SELECT * FROM [PALMERAS2013].[dbo].[BaseEmpleadosIndicadorNomina] WHERE Año BETWEEN $this->AniIni AND $this->AniFin AND MES BETWEEN $this->MesIni AND $this->MesFin

            ")));
       
     }


       public function headings(): array
    {
        return [

            'GRUPO',
            'CODIGO',
            'CEDULA',
            'NOMBRES',
            'APELLIDOS',
            'CARGO_MAESTRO',
            'CARGO',
            'CENTRO_COSTOS',
            'FECING',
            'FECRETIRO',
            'VALORHORA',
            'HORASMES',
            'SALARIO',
            'TURNO',
            'PREFIJO',
            'SUCURSAL',
            'TIPCONTRA',
            'DEPENPENCIA_UBICACION',
            'CC_MAYOR',
            'CC_SUB_MAYOR',
            'TEMPORAL',
            'AÑO_DE_RETIRO',
            'Año',
            'MES',
            'MES_DE_TRABAJO',
            'EMPRESA'


        ];
    }




}
