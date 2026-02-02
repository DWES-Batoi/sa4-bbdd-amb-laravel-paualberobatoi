<?php

namespace App\Http\Controllers;

use App\Models\Partit;
use App\Models\Equip;
use App\Models\Estadi;
use App\Http\Requests\PartitRequest;

class PartitController extends Controller
{
    public function index()
    {
        $partits = Partit::with(['local', 'visitant', 'estadi'])
            ->orderBy('data_partit', 'asc')
            ->get();

        return view('partits.index', compact('partits'));
    }

    public function create()
    {
        $equips = Equip::all();
        $estadis = Estadi::all();
        return view('partits.create', compact('equips', 'estadis'));
    }

    public function store(PartitRequest $request)
    {
        Partit::create($request->validated());

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

    public function update(PartitRequest $request, Partit $partit)
    {
        $partit->update($request->validated());
        
        return redirect()->route('partits.index')->with('success', 'Partit actualitzat!');
    }

    public function destroy(Partit $partit)
    {
        $partit->delete();
        return redirect()->route('partits.index')->with('success', 'Partit eliminat.');
    }
}