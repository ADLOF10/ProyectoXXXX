<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
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
        $cek=Grupo::Where([
            'nombre_grupo'=>$request->nombre_grupo,
            'materia'=>$request->materia,
            'profesor'=>$request->profesor
        ])->first();

        if ($cek) {
            return redirect('/qr-scan')->with('gagal','anda sudah absen');
        }
        Grupo::create([
            'nombre_grupo'=>$request->nombre_grupo,
            'materia'=>$request->materia,
            'profesor'=>$request->profesor
        ]);
        
        return redirect('/qr-scan')->with('success','silahkan masuk');
    }
}
