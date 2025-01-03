<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Asistencia;
use PHPUnit\Framework\Attributes\Group;
use Illuminate\Support\Facades\Auth;

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

       

        
        Asistencia::create([
            'alumno_id'=>$userId,
            'fecha'=>$request->fecha,
            'hora_registro'=>$request->hora_registro,
            'estado'=>$request->asistencia
        ]);
        
        return redirect('/qr-scan')->with('success','Asistencia registrada');
    }
}
