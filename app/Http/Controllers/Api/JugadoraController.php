<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\JugadoraRequest;
use App\Http\Resources\JugadoraResource;
use App\Models\Jugadora;
use Illuminate\Http\Request;

class JugadoraController extends BaseController
{
    public function index()
    {
        // Paginació recomanada
        return JugadoraResource::collection(
            Jugadora::query()->paginate(10)
        );
    }

    public function show(Jugadora $jugadora)
    {
        // return new JugadoraResource($jugadora);
        // O si vols usar sendResponse per uniformitat (però Resource::make és estàndard)
        return $this->sendResponse(new JugadoraResource($jugadora), 'Jugadora retrieved successfully.');
    }

    public function store(JugadoraRequest $request)
    {
        $jugadora = Jugadora::create($request->validated());

        return $this->sendResponse(new JugadoraResource($jugadora), 'Jugadora created successfully.', 201);
    }

    public function update(JugadoraRequest $request, Jugadora $jugadora)
    {
        $jugadora->update($request->validated());

        return $this->sendResponse(new JugadoraResource($jugadora), 'Jugadora updated successfully.');
    }

    public function destroy(Jugadora $jugadora)
    {
        $jugadora->delete();

        return $this->sendResponse([], 'Jugadora deleted successfully.', 204);
        // Nota: 204 No Content a vegades no torna cos, així que 'sendResponse' pot ser redundant en cos, però útil per headers.
        // Si vols ser estricte 204 sense cos: return response()->noContent();
    }
}
