<?php

namespace App\Http\Controllers;

use App\Models\Partit;
use Illuminate\Http\Request;

class PartitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cargamos los partidos con sus relaciones para no hacer 1000 consultas
        $partits = Partit::with(['local', 'visitant', 'estadi'])
            ->orderBy('data', 'asc')
            ->get();

        return view('partits.index', compact('partits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equips = \App\Models\Equip::all();
        $estadis = \App\Models\Estadi::all();

        return view('partits.create', compact('equips', 'estadis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $partit = Partit::with(['local', 'visitant', 'estadi'])->findOrFail($id);
        return view('partits.show', compact('partit'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
