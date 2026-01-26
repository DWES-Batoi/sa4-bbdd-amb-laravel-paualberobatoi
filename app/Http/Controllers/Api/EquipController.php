<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\EquipRequest;
use App\Http\Resources\EquipResource;
use App\Models\Equip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EquipController extends BaseController
{
    public function index()
    {
        return EquipResource::collection(
            Equip::with('estadi')->paginate(10)
        );
    }

    public function show(Equip $equip)
    {
        return $this->sendResponse(new EquipResource($equip->load('estadi')), 'Equip retrieved successfully.');
    }

    public function store(EquipRequest $request)
    {
        $data = $request->validated();
        
        if ($request->hasFile('escut')) {
            $path = $request->file('escut')->store('escuts', 'public');
            $data['escut'] = $path;
        }

        $equip = Equip::create($data);

        return $this->sendResponse(new EquipResource($equip), 'Equip created successfully.', 201);
    }

    public function update(EquipRequest $request, Equip $equip)
    {
        $data = $request->validated();

        if ($request->hasFile('escut')) {
            if ($equip->escut) {
                Storage::disk('public')->delete($equip->escut);
            }
            $path = $request->file('escut')->store('escuts', 'public');
            $data['escut'] = $path;
        }

        $equip->update($data);

        return $this->sendResponse(new EquipResource($equip), 'Equip updated successfully.');
    }

    public function destroy(Equip $equip)
    {
        if ($equip->escut) {
            Storage::disk('public')->delete($equip->escut);
        }
        
        $equip->delete();

        return $this->sendResponse([], 'Equip deleted successfully.', 204);
    }
}
