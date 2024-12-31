<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Grupo; // Modelo 'Grupo' para interactuar con la base de datos
use BaconQrCode\Encoder\QrCode;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Writer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GenerarqrController extends Controller
{

    ///ver tabla grupo
    public function verGrupo()
    {

        $grupos = Grupo::paginate(10);
        return view('qr_profe', compact('grupos'));
    }


   /////generar el codigo qr
     public function generate_qr($id, Request $request)
     {
         // Obtén los datos del grupo desde la base de datos
         $grupo = Grupo::findOrFail($id);

         $campoManual = $request->input('campo_manual');
 
         // Prepara los datos para el QR
         $data = "Grupo: {$grupo->nombre_grupo}\nMateria: {$grupo->materia}\nProfesor: {$grupo->profesor}\nCampoManual: {$campoManual}";
 
         // Configura el renderizador de QR
         $renderer = new ImageRenderer(
             new RendererStyle(300), // Tamaño del QR
             new SvgImageBackEnd()  // Backend para generar la imagen
         );
 
         $writer = new Writer($renderer);
 
         // Genera el QR como SVG
         $qrCode = $writer->writeString($data);
 
         // Devuelve la vista con el QR
         return view('vista_qr', compact('qrCode', 'grupo','campoManual'));
     }
     

     //////escanear qr y registrar

     public function scanView()
     {
         return view('asistencia_alum');
     }
 
     
    
     
     public function store(Request $request)
     {
         // Validar que se reciba el campo "data"
         $request->validate([
             'data' => 'required|string',
         ]);
 
         // Parsear los datos del QR
         $data = explode("\n", $request->data); // Dividir los datos por línea
         $nombre_grupo = str_replace("Grupo: ", "", $data[0]);
         $materia = str_replace("Materia: ", "", $data[1]);
         $profesor = str_replace("Profesor: ", "", $data[2]);
 
         // Crear un nuevo grupo en la base de datos
         $grupo = Grupo::create([
             'nombre_grupo' => $nombre_grupo,
             'materia' => $materia,
             'profesor' => $profesor,
         ]);
 
         return response()->json(['success' => true, 'message' => 'Grupo registrado con éxito', 'grupo' => $grupo]);
     }
      

}
