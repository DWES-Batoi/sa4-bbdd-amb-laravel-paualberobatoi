<?php

namespace App\Http\Controllers;

use App\Models\Partit;
use App\Models\Equip;   // <--- ESTO FALTABA
use App\Models\Estadi;  // <--- ESTO FALTABA
use Illuminate\Http\Request;

class PartitController extends Controller
{
    public function index()
    {
        $partits = Partit::with(['local', 'visitant', 'estadi'])
                    ->orderBy('data', 'asc')
                    ->get();

        return view('partits.index', compact('partits'));
    }

    public function create()
    {
        $equips = Equip::all();
        $estadis = Estadi::all();
        return view('partits.create', compact('equips', 'estadis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'local_id' => 'required|exists:equips,id',
            'visitant_id' => 'required|exists:equips,id',
            'estadi_id' => 'required|exists:estadis,id',
            'data' => 'required|date',
        ]);

        Partit::create($request->all());
        return redirect()->route('partits.index')->with('success', 'Partit creat!');
    }

    public function show($id)
    {
        $partit = Partit::with(['local', 'visitant', 'estadi'])->findOrFail($id);
        return view('partits.show', compact('partit'));
    }

    public function edit(Partit $partit)
    {
        $equips = Equip::all();
        $estadis = Estadi::all();
        return view('partits.edit', compact('partit', 'equips', 'estadis'));
    }

    public function update(Request $request, Partit $partit)
    {
        $partit->update($request->all());
        return redirect()->route('partits.index')->with('success', 'Partit actualitzat!');
    }

    public function destroy(Partit $partit)
    {
        $partit->delete();
        return redirect()->route('partits.index')->with('success', 'Partit eliminat.');
    }
}