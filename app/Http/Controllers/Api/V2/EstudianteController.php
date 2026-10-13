<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Estudiante;

class EstudianteController extends Controller
{
private function formato(Estudiante $estudiante): array
{
    return [
        'id' => $estudiante->id,
        'nombre' => $estudiante->nombre,
        'correo' => $estudiante->correo,
        'carrera' => [
            'nombre' => $estudiante->carrera,
        ],
    ];
}

public function index()
{
    return response()->json(
        Estudiante::all()->map(fn ($e) => $this->formato($e)),
        200
    );
}

public function store(Request $request)
{
    $datos = $request->validate([
        'nombre' => 'required|string|max:100',
        'correo' => ['required', 'email', 'max:150', 'unique:estudiantes,correo'],
        'carrera' => 'required|string|max:100',
    ]);

    $estudiante = Estudiante::create($datos);

    return response()->json($this->formato($estudiante), 201);
}

public function show(Estudiante $estudiante)
{
    return response()->json($this->formato($estudiante), 200);
}

public function update(Request $request, Estudiante $estudiante)
{
    $datos = $request->validate([
        'nombre' => 'sometimes|required|string|max:100',
        'correo' => ['sometimes', 'required', 'email', 'max:150',
                     'unique:estudiantes,correo,' . $estudiante->id],
        'carrera' => 'sometimes|required|string|max:100',
    ]);

    $estudiante->update($datos);

    return response()->json($this->formato($estudiante), 200);
}

public function destroy(Estudiante $estudiante)
{
    $estudiante->delete();

    return response()->noContent();
}
}
