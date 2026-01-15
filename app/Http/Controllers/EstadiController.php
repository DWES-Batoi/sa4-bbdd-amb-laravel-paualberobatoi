<?php

namespace App\Http\Controllers;

use App\Models\Estadi;
use Illuminate\Http\Request;

class EstadiController extends Controller
{
    // GET /estadis
    public function index()
    {
        $estadis = Estadi::all();
        return view('estadis.index', compact('estadis'));
    }

    // GET /estadis/{estadi}
    public function show(Estadi $estadi)
    {
        return view('estadis.show', compact('estadi'));
    }

    // GET /estadis/create
    public function create()
    {
        return view('estadis.create');
    }

    // POST /estadis
    public function store(Request $request)
    {
        $estadi = new Estadi($request->all());
        $estadi->save();

        return redirect()
            ->route('estadis.index')
            ->with('success', 'Estadi afegit correctament!');
    }

    // GET /estadis/{estadi}/edit
    public function edit(Estadi $estadi)
    {
        return view('estadis.edit', compact('estadi'));
    }

    public function update(Request $request, Estadi $estadi)
    {
        $request->validate(['nom' => 'required', 'capacitat' => 'required|integer|min:1']);
        $estadi->update($request->all());
        return redirect()->route('estadis.index')->with('success', 'Estadi actualitzat!');
    }


    // DELETE /estadis/{estadi}
    public function destroy(Estadi $estadi)
    {
        $estadi->delete();

        return redirect()
            ->route('estadis.index')
            ->with('success', 'Estadi esborrat correctament!');
    }
}