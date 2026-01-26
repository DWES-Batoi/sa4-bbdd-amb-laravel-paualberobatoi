<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PartitRequest;
use App\Http\Resources\PartitResource;
use App\Models\Partit;
use Illuminate\Http\Request;

class PartitController extends BaseController
{
    public function index()
    {
        return PartitResource::collection(
            Partit::with(['local', 'visitant', 'estadi'])->orderBy('data_partit', 'desc')->paginate(10)
        );
    }

    public function show(Partit $partit)
    {
        return $this->sendResponse(new PartitResource($partit->load(['local', 'visitant', 'estadi'])), 'Partit retrieved successfully.');
    }

    public function store(PartitRequest $request)
    {
        $partit = Partit::create($request->validated());

        return $this->sendResponse(new PartitResource($partit), 'Partit created successfully.', 201);
    }

    public function update(PartitRequest $request, Partit $partit)
    {
        $partit->update($request->validated());

        return $this->sendResponse(new PartitResource($partit), 'Partit updated successfully.');
    }

    public function destroy(Partit $partit)
    {
        $partit->delete();

        return $this->sendResponse([], 'Partit deleted successfully.', 204);
    }
}
