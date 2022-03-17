<?php

namespace App\Http\Controllers;

use App\Excel;
use App\Http\Requests\ExcelStoreRequest;
use App\Http\Requests\ExcelUpdateRequest;
use Illuminate\Http\Request;
use App\Exports\EmpleadosExport;

class ExcelController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
    $FechaIni=strtotime($request->input('FechaInicio'));  
    $FechaFin=strtotime($request->input('FechaFin'));  
    $AniIni=date("Y", $FechaIni);  
    $MesIni=date("m", $FechaIni);  
    $AniFin=date("Y", $FechaFin);
    $MesFin=date("m", $FechaFin);         

        return new EmpleadosExport($AniFin,$AniIni,$MesIni,$MesFin);




        //return view('excel.index', compact('excels'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('excel.create');
    }

    /**
     * @param \App\Http\Requests\ExcelStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExcelStoreRequest $request)
    {
        $excel = Excel::create($request->validated());

        $request->session()->flash('excel.id', $excel->id);

        return redirect()->route('excel.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\excel $excel
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
         

          return view('excel.show');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\excel $excel
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Excel $excel)
    {
        return view('excel.edit', compact('excel'));
    }

    /**
     * @param \App\Http\Requests\ExcelUpdateRequest $request
     * @param \App\excel $excel
     * @return \Illuminate\Http\Response
     */
    public function update(ExcelUpdateRequest $request, Excel $excel)
    {
        $excel->update($request->validated());

        $request->session()->flash('excel.id', $excel->id);

        return redirect()->route('excel.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\excel $excel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Excel $excel)
    {
        $excel->delete();

        return redirect()->route('excel.index');
    }
}
