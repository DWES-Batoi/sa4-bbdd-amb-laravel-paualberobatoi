<?php

namespace App\Http\Controllers;

use App\Services\JugadoraService;
use App\Models\Equip;
use App\Http\Requests\StoreJugadoraRequest;
use App\Http\Requests\UpdateJugadoraRequest;
use Illuminate\Http\Request;

class JugadoraController extends Controller
{
    /**
     * Inyectamos el servicio de Jugadoras en el controlador.
     */
    public function __construct(private JugadoraService $servei) {}

    /**
     * Muestra el listado de todas las jugadoras.
     */
    public function index()
    {
        $jugadoras = $this->servei->llistar();
        return view('jugadoras.index', compact('jugadoras'));
    }

    /**
     * Muestra el formulario para crear una nueva jugadora.
     */
    public function create()
    {
        // Necesitamos los equipos para rellenar el <select> del formulario
        $equips = Equip::all();
        return view('jugadoras.create', compact('equips'));
    }

    /**
     * Guarda una nueva jugadora en la base de datos.
     * Utiliza StoreJugadoraRequest para la validación.
     */
    public function store(StoreJugadoraRequest $request)
    {
        // $request->validated() devuelve solo los datos que han pasado la validación
        $this->servei->guardar($request->validated());

        return redirect()->route('jugadoras.index')
                         ->with('success', 'Jugadora creada correctamente.');
    }

    /**
     * Muestra el detalle de una jugadora específica.
     */
    public function show($id)
    {
        $jugadora = $this->servei->trobar($id);
        return view('jugadoras.show', compact('jugadora'));
    }

    /**
     * Muestra el formulario para editar una jugadora existente.
     */
    public function edit($id)
    {
        $jugadora = $this->servei->trobar($id);
        $equips = Equip::all();
        return view('jugadoras.edit', compact('jugadora', 'equips'));
    }

    /**
     * Actualiza los datos de la jugadora en la base de datos.
     * Utiliza UpdateJugadoraRequest para la validación.
     */
    public function update(UpdateJugadoraRequest $request, $id)
    {
        $this->servei->actualitzar($id, $request->validated());

        return redirect()->route('jugadoras.index')
                         ->with('success', 'Jugadora actualizada correctamente.');
    }

    /**
     * Elimina una jugadora de la base de datos.
     */
    public function destroy($id)
    {
        $this->servei->eliminar($id);

        return redirect()->route('jugadoras.index')
                         ->with('success', 'Jugadora eliminada correctamente.');
    }
}