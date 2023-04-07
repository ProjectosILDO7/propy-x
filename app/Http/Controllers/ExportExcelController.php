<?php

namespace App\Http\Controllers;

use App\Exports\Disciplinas_cursosExport;
use App\Exports\emolumentoExport;
use App\Exports\transporteExport;
use App\Exports\uniformeExport;
use App\Models\Emolumento;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelController extends Controller
{
    public function export($user) 
    {
        return Excel::download(new Disciplinas_cursosExport($user), 'disciplinas e cursos.xlsx');
    }

    public function exportEmolumento($user) 
    {
        
        return Excel::download(new emolumentoExport($user), 'Lista de emolumentos.xlsx');
    }

    public function exportUniforme($user) 
    {
        
        return Excel::download(new uniformeExport($user), 'Lista de uniformes.xlsx');
    }

    public function exportTransporte($user) 
    {
        
        return Excel::download(new transporteExport($user), 'Lista de transporte.xlsx');
    }

}