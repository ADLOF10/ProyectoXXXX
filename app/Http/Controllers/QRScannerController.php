<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Asistencia;
use PHPUnit\Framework\Attributes\Group;

class QRScannerController extends Controller

{
    
    public function scanView()
    {
        return view('scan');
    }

    public function store(Request $request)
    {
        ///cek data
        $cek=Asistencia::Where([
            'numero_cuenta'=>$request->numero_cuenta,
            'fecha'=>$request->fecha,
            'hora_registro'=>$request->hora_registro,
            'estado'=>$request->estado,
            'grupo_id'=>$request->grupo_id,
            'alumno_id'=>$request->alumno_id
        ])->first();

        if ($cek) {
            return redirect('/qr-scan')->with('gagal','anda sudah absen');
        }
        Asistencia::create([
            'numero_cuenta'=>$request->numero_cuenta,
            'fecha'=>$request->fecha,
            'hora_registro'=>$request->hora_registro,
            'estado'=>$request->estado,
            'grupo_id'=>$request->grupo_id,
            'alumno_id'=>$request->alumno_id
        ]);
        
        return redirect('/qr-scan')->with('success','silahkan masuk');
    }
}
