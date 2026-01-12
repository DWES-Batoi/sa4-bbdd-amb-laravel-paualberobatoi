<?php

namespace App\Http\Controllers;

use App\Models\Equip;
use App\Models\Estadi;
use App\Services\EquipService;
use App\Http\Requests\StoreEquipRequest;
use App\Http\Requests\UpdateEquipRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EquipController extends Controller
{
    // Inyectamos el servicio en el constructor
    public function __construct(private EquipService $servei)
    {
    }

    public function index()
    {
        $equips = Equip::with('estadi')->get();
        return view('equips.index', compact('equips'));
    }

    public function create()
    {
        $estadis = Estadi::all();
        return view('equips.create', compact('estadis'));
    }

    public function store(StoreEquipRequest $request)
    {
        // Pasamos los datos validados y el archivo del escudo al servicio
        $this->servei->guardar($request->validated(), $request->file('escut'));

        return redirect()->route('equips.index')->with('success', 'Equip creat correctament!');
    }

    public function show(Equip $equip)
    {
        return view('equips.show', compact('equip'));
    }

    public function edit(Equip $equip)
    {
        $estadis = Estadi::all();
        return view('equips.edit', compact('equip', 'estadis'));
    }

    public function update(UpdateEquipRequest $request, Equip $equip)
    {
        // Pasamos el ID, los datos validados y el archivo (si hay uno nuevo)
        $this->servei->actualitzar($equip->id, $request->validated(), $request->file('escut'));

        return redirect()->route('equips.index')->with('success', 'Equip actualitzat!');
    }

    public function destroy(Equip $equip)
    {
        // Usamos el servicio para borrar también el archivo físico del escudo si existe
        $this->servei->eliminar($equip->id);

        return redirect()->route('equips.index')->with('success', 'Equip eliminat.');
    }
}