<?php

namespace App\Services;

use App\Models\Jugadora;
use App\Repositories\JugadoraRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class JugadoraService
{
    public function __construct(private JugadoraRepository $repo)
    {
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function guardar(array $data, ?UploadedFile $foto = null): Jugadora
    {
        if ($foto) {
            $data['foto'] = $foto->store('jugadoras', 'public');
        }

        return $this->repo->create($data);
    }

    public function actualitzar(int $id, array $data, ?UploadedFile $foto = null): Jugadora
    {
        $jugadora = $this->repo->find($id);

        if ($foto) {
            if ($jugadora->foto) {
                Storage::disk('public')->delete($jugadora->foto);
            }
            $data['foto'] = $foto->store('jugadoras', 'public');
        }

        return $this->repo->update($id, $data);
    }

    public function eliminar(int $id): void
    {
        $jugadora = $this->repo->find($id);

        if ($jugadora->foto) {
            Storage::disk('public')->delete($jugadora->foto);
        }

        $this->repo->delete($id);
    }
}