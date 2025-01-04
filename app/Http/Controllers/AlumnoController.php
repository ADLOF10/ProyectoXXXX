<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno; // Modelo que interactúa con la tabla alumnos
use Illuminate\Support\Facades\DB;


class AlumnoController extends Controller
{

    public function uploadAlumnos(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);
    
        $file = $request->file('file');
        $filePath = $file->getRealPath();
    
        $alumnos = [];
        $duplicados = [];
    
        try {
            $fileHandle = fopen($filePath, 'r');
            $header = fgetcsv($fileHandle);
    
            // Validar columnas
            $expectedColumns = ['nombre', 'apellidos', 'correo_institucional', 'numero_cuenta', 'grupo', 'semestre', 'licenciatura'];
            if ($header !== $expectedColumns) {
                return back()->with('error', 'El archivo no tiene las columnas requeridas.');
            }
    
            while (($row = fgetcsv($fileHandle, 1000, ',')) !== false) {
                $alumno = [
                    'nombre' => $row[0],
                    'apellidos' => $row[1],
                    'correo_institucional' => $row[2],
                    'numero_cuenta' => $row[3],
                    'grupo' => $row[4],
                    'semestre' => $row[5],
                    'licenciatura' => $row[6],
                ];
    
                // Verificar duplicados en la base de datos
                $existe = DB::table('alumnos')
                    ->where('correo_institucional', $alumno['correo_institucional'])
                    ->orWhere('numero_cuenta', $alumno['numero_cuenta'])
                    ->exists();
    
                if ($existe) {
                    $duplicados[] = $alumno;
                } else {
                    $alumnos[] = $alumno;
                }
            }
    
            fclose($fileHandle);
    
            // Guardar en sesión
            session(['alumnos' => $alumnos, 'duplicados' => $duplicados]);
    
            return back()->with('success', 'Archivo procesado correctamente. Revisa la tabla de alumnos.');
        } catch (\Exception $e) {
            return back()->with('error', 'Hubo un error al procesar el archivo: ' . $e->getMessage());
        }
    }
    

        public function previewAlumnos(Request $request)
    {
        $file = $request->file('file');
        $filePath = $file->getRealPath();

        $alumnos = [];
        $duplicados = [];

        try {
            $fileHandle = fopen($filePath, 'r');
            $header = fgetcsv($fileHandle);

            // Validar columnas
            $expectedColumns = ['nombre', 'apellidos', 'correo_institucional', 'numero_cuenta', 'grupo', 'semestre', 'licenciatura'];
            if ($header !== $expectedColumns) {
                return back()->with('error', 'El archivo no tiene las columnas requeridas.');
            }

            while (($row = fgetcsv($fileHandle, 1000, ',')) !== false) {
                $alumno = [
                    'nombre' => $row[0],
                    'apellidos' => $row[1],
                    'correo_institucional' => $row[2],
                    'numero_cuenta' => $row[3],
                    'grupo' => $row[4],
                    'semestre' => $row[5],
                    'licenciatura' => $row[6],
                ];

                // Validar duplicados en la base de datos
                $existe = DB::table('alumnos')
                    ->where('correo_institucional', $alumno['correo_institucional'])
                    ->orWhere('numero_cuenta', $alumno['numero_cuenta'])
                    ->exists();

                if ($existe) {
                    $duplicados[] = $alumno;
                } else {
                    $alumnos[] = $alumno;
                }
            }

            fclose($fileHandle);

            // Guardar en sesión para mostrar en la vista
            session(['alumnos' => $alumnos, 'duplicados' => $duplicados]);

            return view('crudalumno_profe', compact('alumnos', 'duplicados'));
        } catch (\Exception $e) {
            return back()->with('error', 'Hubo un error al procesar el archivo: ' . $e->getMessage());
        }
    }


        public function updateAlumno(Request $request, $index)
    {
        $alumnos = session('alumnos');
        if (!$alumnos || !isset($alumnos[$index])) {
            return response()->json(['success' => false, 'message' => 'Alumno no encontrado']);
        }

        $alumnos[$index][$request->field] = $request->value;
        session(['alumnos' => $alumnos]);

        return response()->json(['success' => true]);
    }

    public function deleteAlumno($index)
    {
        $alumnos = session('alumnos');
        if (!$alumnos || !isset($alumnos[$index])) {
            return response()->json(['success' => false, 'message' => 'Alumno no encontrado']);
        }

        unset($alumnos[$index]);
        session(['alumnos' => array_values($alumnos)]);

        return response()->json(['success' => true]);
    }

    public function storeAll(Request $request)
    {
        $selectedIndexes = $request->input('selected_alumnos');
        $alumnos = session('alumnos');
    
        if (!$selectedIndexes) {
            return back()->with('error', 'No se seleccionaron alumnos para registrar.');
        }
    
        $alumnosToInsert = [];
        foreach ($selectedIndexes as $index) {
            $alumno = $alumnos[$index];
    
            // Verificar si el alumno ya existe en la base de datos
            $existe = DB::table('alumnos')
                ->where('correo_institucional', $alumno['correo_institucional'])
                ->orWhere('numero_cuenta', $alumno['numero_cuenta'])
                ->exists();
    
            if (!$existe) {
                $alumnosToInsert[] = [
                    'nombre' => $alumno['nombre'],
                    'apellidos' => $alumno['apellidos'],
                    'correo_institucional' => $alumno['correo_institucional'],
                    'numero_cuenta' => $alumno['numero_cuenta'],
                    'semestre' => $alumno['semestre'],
                    'licenciatura' => $alumno['licenciatura'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                
            }
        }
    
        if (!empty($alumnosToInsert)) {
            // Insertar los alumnos válidos en la base de datos
            DB::table('alumnos')->insert($alumnosToInsert);
    
            // Limpiar los datos de la sesión después de registrar
            session()->forget('alumnos');
            session()->forget('duplicados');
    
            return back()->with('success', 'Alumnos registrados correctamente.');
        }
    
        return back()->with('error', 'Todos los alumnos seleccionados ya están registrados.');
    }
    
    

        public function deleteDuplicados()
    {
        session()->forget('duplicados');
        return back()->with('success', 'Duplicados eliminados correctamente. Puedes continuar.');
        return response()->json(['success' => true]);
    }
    
}