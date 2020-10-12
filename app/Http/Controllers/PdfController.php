<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Turno;

class PdfController extends Controller
{
       
    public function turno($id, $fecha){
        $turno = Turno::find($id);

        $pdf = PDF::loadView('PDF/turnoPDF', compact(['turno']));
        return $pdf->stream();
        //return $pdf->download('primer.pdf');
    }

    public function viewTurnos($fecha){
        $turnos = Turno::where('fecha', $fecha)->get();
        
        $pdf = PDF::loadView('PDF/turnosPDF', compact(['turnos', 'fecha']));
        return $pdf->stream();
           
    }
}
