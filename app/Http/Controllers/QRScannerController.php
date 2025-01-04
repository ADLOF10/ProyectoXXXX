<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Asistencia;
use PHPUnit\Framework\Attributes\Group;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
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

            
                
                $horaActual = Carbon::now('America/Mexico_City')->format('Y-m-d H:i:s'); // Hora actual en formato Y-m-d H:i:s
                $horaActualCarbon = Carbon::now('America/Mexico_City'); // Hora actual como objeto Carbon en la zona horaria correcta
                $inicio_de_clase = Carbon::parse($request->hora_inicio_clase, 'America/Mexico_City'); // Inicio de clase como Carbon con zona horaria
                $asistencia = (int)$request->asistencia; // Tolerancia para asistencia (en minutos)
                $retardo = (int)$request->retardo; // Tolerancia para retardo (en minutos)
                
                // Diferencia en minutos desde el inicio de clase
                $diferenciaEnMinutos = $horaActualCarbon->diffInMinutes($inicio_de_clase, false);
                
                if ($diferenciaEnMinutos >= 0 && $diferenciaEnMinutos <= $asistencia) {
                    $estado = 'asistencia'; // Dentro de la tolerancia para asistencia
                } elseif ($diferenciaEnMinutos > $asistencia && $diferenciaEnMinutos <= $retardo) {
                    $estado = 'retardo'; // Dentro de la tolerancia para retardo
                } else {
                    $estado = 'falta'; // Fuera de la tolerancia
                }
            


                    // Crear la entrada en la base de datos
                    Asistencia::create([
                        'alumno_id' => $userId,
                        'grupo_id' => $request->id_grupo,
                        'fecha' => $request->fecha,
                        'hora_registro' => $inicio_de_clase,
                        'estado' => $estado
                    ]);

                
                return redirect('/qr-scan')->with('success','Asistencia registrada');
            }
}
