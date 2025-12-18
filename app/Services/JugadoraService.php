<?php

namespace App\Services;

use App\Repositories\JugadoraRepository;

class JugadoraService
{
    public function __construct(private JugadoraRepository $repository) {}

    public function llistar()
    {
        return $this->repository->getAll();
    }

    public function trobar($id)
    {
        return $this->repository->find($id);
    }

    public function guardar(array $dades)
    {
        // Aquí podrías añadir lógica para procesar la foto si llega un archivo
        return $this->repository->create($dades);
    }

    public function actualitzar($id, array $dades)
    {
        return $this->repository->update($id, $dades);
    }

    public function eliminar($id)
    {
        return $this->repository->delete($id);
    }
}