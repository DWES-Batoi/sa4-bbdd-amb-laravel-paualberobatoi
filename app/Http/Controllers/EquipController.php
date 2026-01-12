<?php

namespace App\Http\Controllers;

use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Http\Request; // <--- ESTO FALTABA
use App\Http\Controllers\Controller;

class EquipController extends Controller
{
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

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'estadi_id' => 'required|exists:estadis,id',
            'titols' => 'integer|min:0'
        ]);

        Equip::create($request->all());
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

    public function update(Request $request, Equip $equip)
    {
        $request->validate([
            'nom' => 'required',
            'estadi_id' => 'required|exists:estadis,id'
        ]);
        
        $equip->update($request->all());
        return redirect()->route('equips.index')->with('success', 'Equip actualitzat!');
    }

    public function destroy(Equip $equip)
    {
        $equip->delete();
        return redirect()->route('equips.index')->with('success', 'Equip eliminat.');
    }
}