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

    // Mostrar el formulario de configuración del QR
    public function verFormulario($id)
    {
        $grupo = Grupo::findOrFail($id);
        return view('vista_qr', compact('grupo'));
    }

    // Generar el QR con los datos del formulario
    public function generate_qr(Request $request, $id)
    {
        $grupo = Grupo::findOrFail($id);

        // Obtener datos del formulario
        $fecha_clase = $request->input('fecha_clase');
        $horario_inicio = $request->input('horario_inicio');
        $horario_fin = $request->input('horario_fin');
        $asistencia = $request->input('asistencia');
        $retardo = $request->input('retardo');
        $inasistencia = $request->input('inasistencia');

          // Fecha y hora de creación
        $created_at = Carbon::now('America/Mexico_City')->format('Y-m-d H:i:s');


        // Construir los datos para el QR
        $data = "{$grupo->nombre_grupo}\n{$grupo->materia}\n{$grupo->profesor}\n{$fecha_clase}\n{$horario_inicio}\n{$horario_fin}\n{$asistencia}\n{$retardo}\n{$inasistencia}\n{$created_at}";

        // Generar el QR
        $qrCode = (new Writer(new ImageRenderer(new RendererStyle(300), new SvgImageBackEnd())))->writeString($data);

        // Redirigir a la vista del formulario con el QR generado
        return redirect()->route('vistaQr', $grupo->id)->with([
            'qrCode' => $qrCode,
            'fecha_clase' => $fecha_clase,
            'horario_clase' => $horario_inicio,
            'horario_clase_final' => $horario_fin,
            'horario_registro' => "Asistencia: {$asistencia} min, Retardo: {$retardo} min, Inasistencia: {$inasistencia} min",
            'fecha_hora_creacion' => $created_at,
        ]);
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
        $fecha_clase = str_replace("Fecha Clase: ", "", $data[3]);

         // Crear un nuevo grupo en la base de datos
        $grupo = Grupo::create([
            'nombre_grupo' => $nombre_grupo,
            'materia' => $materia,
            'profesor' => $profesor,
        ]);

            return response()->json(['success' => true, 'message' => 'Grupo registrado con éxito', 'grupo' => $grupo]);
        }
    
        
        public function editarQr(Request $request, $id)
{
    $grupo = Grupo::findOrFail($id);

    // Procesar los datos enviados
    $fecha_clase = $request->input('fecha_clase');
    $horario_inicio = $request->input('horario_inicio');
    $horario_fin = $request->input('horario_fin');
    $asistencia = $request->input('asistencia');
    $retardo = $request->input('retardo');
    $inasistencia = $request->input('inasistencia');

    // Actualizar la fecha de modificación en la base de datos
    $grupo->touch(); // Esto actualiza 'updated_at' automáticamente

    // Formatear los parámetros de registro
    $horario_registro = "Asistencia: {$asistencia} min, Retardo: {$retardo} min, Inasistencia: {$inasistencia} min";

    // Obtener la fecha y hora de actualización
    $fecha_hora_actualizacion = $grupo->updated_at->format('Y-m-d H:i:s');

    // Datos del QR
    $data = "Grupo: {$grupo->nombre_grupo}\n"
          . "Materia: {$grupo->materia}\n"
          . "Profesor: {$grupo->profesor}\n"
          . "Fecha Clase: {$fecha_clase}\n"
          . "Horario: {$horario_inicio} - {$horario_fin}\n"
          . "Parámetros: {$horario_registro}\n"
          . "Última Actualización: {$fecha_hora_actualizacion}";

    $qrCode = (new Writer(new ImageRenderer(new RendererStyle(300), new SvgImageBackEnd())))->writeString($data);

    // Redirigir con los datos actualizados
    return redirect()->route('vistaQr', $grupo->id)->with([
        'qrCode' => $qrCode,
        'fecha_clase' => $fecha_clase,
        'horario_clase' => $horario_inicio,
        'horario_clase_final' => $horario_fin,
        'horario_registro' => $horario_registro,
        'fecha_hora_creacion' => $fecha_hora_actualizacion, // Actualizado correctamente
        'success' => 'QR actualizado correctamente.',
    ]);
}

        
        public function eliminarQr($id)
        {
            $grupo = Grupo::findOrFail($id);
        
            // Aquí puedes realizar alguna acción adicional como eliminar registros relacionados
            // En este caso, simplemente redirigimos y limpiamos la sesión del QR
            session()->forget(['qrCode', 'fecha_clase', 'horario_clase', 'horario_clase_final', 'horario_registro', 'fecha_hora_creacion']);
        
            return redirect()->route('vistaQr', $grupo->id)->with('success', 'QR eliminado correctamente.');
        }
        
}
