<?php

namespace App\Http\Controllers;

use App\Models\Jugadora;
use App\Models\Equip;
use App\Services\JugadoraService;
use App\Http\Requests\StoreJugadoraRequest;
use Illuminate\Http\Request;

class JugadoraController extends Controller
{
    public function __construct(private JugadoraService $servei)
    {
    }

    public function index()
    {
        $jugadoras = $this->servei->llistar();
        return view('jugadoras.index', compact('jugadoras'));
    }

    public function create()
    {
        $equips = Equip::all();
        return view('jugadoras.create', compact('equips'));
    }

    public function store(StoreJugadoraRequest $request)
    {
        $this->servei->guardar($request->validated());
        return redirect()->route('jugadoras.index')->with('success', 'Jugadora creada correctament.');
    }

    public function show($id)
    {
        $jugadora = $this->servei->trobar($id);
        return view('jugadoras.show', compact('jugadora'));
    }

    public function edit(Jugadora $jugadora)
    {
        $equips = Equip::all();
        return view('jugadoras.edit', compact('jugadora', 'equips'));
    }

    public function update(Request $request, Jugadora $jugadora)
    {
        $request->validate([
            'nom' => 'required',
            'dorsal' => 'required',
            'equip_id' => 'required'
        ]);

        $jugadora->update($request->all());
        return redirect()->route('jugadoras.index')->with('success', 'Jugadora actualitzada!');
    }

    public function destroy($id)
    {
        $this->servei->eliminar($id);
        return redirect()->route('jugadoras.index')->with('success', 'Jugadora eliminada correctament.');
    }
}