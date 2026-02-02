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
        $jugadoras = $this->servei->getAll();
        return view('jugadoras.index', compact('jugadoras'));
    }

    public function create()
    {
        $equips = Equip::all();
        return view('jugadoras.create', compact('equips'));
    }

    public function store(StoreJugadoraRequest $request)
    {
        $foto = $request->file('foto');
        
        $this->servei->guardar($request->validated(), $foto);
        
        return redirect()->route('jugadoras.index')
            ->with('success', 'Jugadora creada correctament.');
    }

    public function show($id)
    {
        $jugadora = Jugadora::findOrFail($id); 
        return view('jugadoras.show', compact('jugadora'));
    }

    public function edit(Jugadora $jugadora)
    {
        $equips = Equip::all();
        return view('jugadoras.edit', compact('jugadora', 'equips'));
    }

    public function update(Request $request, Jugadora $jugadora)
    {
        $data = $request->validate([
            'nom' => 'required|min:3',
            'dorsal' => 'required|integer',
            'equip_id' => 'required|exists:equips,id',
            'posicio' => 'required|string',      
            'edat' => 'required|integer|min:0|max:120',  
            'foto' => 'nullable|image|max:2048'   
        ]);

        $foto = $request->file('foto');

        if (array_key_exists('foto', $data)) {
            unset($data['foto']);
        }

        $this->servei->actualitzar($jugadora->id, $data, $foto);

        return redirect()->route('jugadoras.index')
            ->with('success', 'Jugadora actualitzada!');
    }

    public function destroy($id)
    {
        $this->servei->eliminar($id);
        return redirect()->route('jugadoras.index')
            ->with('success', 'Jugadora eliminada correctament.');
    }
}