<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Asistencia;
use PHPUnit\Framework\Attributes\Group;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\CarbonInterval; 
Carbon::setLocale('es'); // Opcional, para español


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

            
                
                $horaActual = Carbon::now('America/Mexico_City'); // Hora actual como objeto Carbon
                $inicioClase = Carbon::parse($request->hora_inicio_clase, 'America/Mexico_City'); // Hora de inicio de clase

                    // Determinar el estatus basado en la hora registrada
                    if ($horaActual <= $inicioClase->addMinutes(5)) {
                        // Asistió a tiempo (entre las 8:00 y 8:05)
                        $estatus = 'asistencia';
                    } elseif ($horaActual <= $inicioClase->addMinutes(10)) {
                        // Retardo (entre las 8:06 y 8:10)
                        $estatus = 'retardo';
                    } elseif ($horaActual <= $inicioClase->addMinutes(20)) {
                        // Falta (después de las 8:11)
                        $estatus = 'falta';
                        }

                    // Crear la entrada en la base de datos
                    Asistencia::create([
                        'alumno_id' => $userId,
                        'grupo_id' => $request->id_grupo,
                        'fecha' => $request->fecha,
                        'hora_registro' => $horaActual,
                        'estado' => $estatus
                    ]);

                
                return redirect('/qr-scan')->with('success','Asistencia registrada');
            }
}
