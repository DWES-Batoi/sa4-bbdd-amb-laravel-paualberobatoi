<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\StoreEstadiRequest;
use App\Http\Requests\UpdateEstadiRequest;
use App\Http\Resources\EstadiResource;
use App\Models\Estadi;
use Illuminate\Http\Request;

class EstadiController extends BaseController
{
    public function index()
    {
        return EstadiResource::collection(Estadi::paginate(10));
    }

    public function show(Estadi $estadi)
    {
        return $this->sendResponse(new EstadiResource($estadi), 'Estadi recuperat correctament.');
    }

    public function store(StoreEstadiRequest $request)
    {
        $estadi = Estadi::create($request->validated());
        return $this->sendResponse(new EstadiResource($estadi), 'Estadi creat correctament.', 201);
    }

    public function update(UpdateEstadiRequest $request, Estadi $estadi)
    {
        $estadi->update($request->validated());
        return $this->sendResponse(new EstadiResource($estadi), 'Estadi actualitzat correctament.');
    }

    public function destroy(Estadi $estadi)
    {
        $estadi->delete();
        return $this->sendResponse([], 'Estadi eliminat correctament.', 204);
    }
}
