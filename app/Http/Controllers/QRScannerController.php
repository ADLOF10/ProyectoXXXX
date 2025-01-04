<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Asistencia;
use PHPUnit\Framework\Attributes\Group;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class QRScannerController extends Controller

{
    
    public function scanView()
    {
        return view('scan');
    }

            public function store(Request $request)
            {


                $userId = Auth::user()->id;
                ///cek data
                $cek=Asistencia::Where([      
                    'alumno_id'=>$userId,
                    'fecha'=>$request->fecha,       
                ])->first();
                

                if ($cek) {
                    
                    return redirect('/qr-scan')->with('success','No te puedes registrar por segunda vez');
                }


        // Crear la entrada en la base de datos
        Asistencia::create([
            'alumno_id' => $userId,
            'grupo_id' => $request->id_grupo,
            'fecha' => $request->fecha,
            'hora_registro' => $request->hora_inicio_clase,
            'estado' => $request->falta
        ]);

                
                return redirect('/qr-scan')->with('success','Asistencia registrada');
            }
}
