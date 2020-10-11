<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Legajo;
use App\Turno;

class PdfController extends Controller
{
    public function reporte($tipo, $juri='',$zona='',$estado=''){
        if ($juri!='todos' AND $juri!='') {
            if ($zona!='todos' AND $zona!='') {
                $cv = Legajo::where('tipo',$tipo)->where('juridiccion',$juri)->where('zona',$zona)->get();
            }else{
                $cv = Legajo::where('tipo',$tipo)->where('juridiccion',$juri)->get();
            }   
        }else{
            if ($zona!='todos' AND $zona!='') {
                $cv = Legajo::where('tipo',$tipo)->where('zona',$zona)->get();
            }else{
                $cv = Legajo::where('tipo',$tipo)->get();
            }
        }

        //return view('consultas.index1', ['cv' => $cv, 'tipo' => $tipo, 'zona' => $zona, 'juridiccion' => $juri, 'estado' => $mandato]);
    	$pdf = PDF::loadView('PDF/listadoPDF', compact(['cv', 'tipo', 'zona', 'juri', 'estado']));
    	return $pdf->stream();
    	//return $pdf->download('primer.pdf');
    }
    
    public function turno($id, $fecha){
        $turno = Turno::find($id);

        $pdf = PDF::loadView('PDF/turnoPDF', compact(['turno']));
        return $pdf->stream();
        //return $pdf->download('primer.pdf');
    }

    public function viewTurnos($fecha){
        $turnos = Turno::where('fecha', $fecha)->get();
    }
}
