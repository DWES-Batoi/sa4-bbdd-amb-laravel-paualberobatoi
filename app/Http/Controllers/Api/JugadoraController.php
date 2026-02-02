<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\JugadoraRequest;
use App\Http\Resources\JugadoraResource;
use App\Models\Jugadora;
use Illuminate\Http\Request;

class JugadoraController extends BaseController
{
    public function __construct(private \App\Services\JugadoraService $service)
    {
    }

    public function index()
    {
        // Paginació recomanada
        return JugadoraResource::collection(
            Jugadora::query()->paginate(10)
        );
    }

    public function show(Jugadora $jugadora)
    {
        return $this->sendResponse(new JugadoraResource($jugadora), 'Jugadora retrieved successfully.');
    }

    public function store(JugadoraRequest $request)
    {
        $data = $request->validated();
        $foto = $request->file('foto');

        // El servicio espera la foto como argumento separado
        if (isset($data['foto'])) {
            unset($data['foto']);
        }

        $jugadora = $this->service->guardar($data, $foto);

        return $this->sendResponse(new JugadoraResource($jugadora), 'Jugadora created successfully.', 201);
    }

    public function update(JugadoraRequest $request, Jugadora $jugadora)
    {
        $data = $request->validated();
        $foto = $request->file('foto');

        // El servicio espera la foto como argumento separado
        if (isset($data['foto'])) {
            unset($data['foto']);
        }

        $jugadora = $this->service->actualitzar($jugadora->id, $data, $foto);

        return $this->sendResponse(new JugadoraResource($jugadora), 'Jugadora updated successfully.');
    }

    public function destroy(Jugadora $jugadora)
    {
        $this->service->eliminar($jugadora->id);

        return $this->sendResponse([], 'Jugadora deleted successfully.', 204);
    }
}
