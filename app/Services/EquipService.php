<?php

namespace App\Services;

use App\Models\Equip;
use App\Repositories\EquipRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class EquipService 
{
    public function __construct(private EquipRepository $repo) 
    {
    }

    public function guardar(array $data, ?UploadedFile $escut = null): Equip 
    {
        if ($escut) {
            // Guarda el fitxer a la carpeta 'escuts' dins de 'public'
            $data['escut'] = $escut->store('escuts', 'public');
        }
        return $this->repo->create($data);
    }

    public function actualitzar(int $id, array $data, ?UploadedFile $escut = null): Equip 
    {
        $equip = $this->repo->find($id);

        if ($escut) {
            // Si ja tenia un escut, esborrem el fitxer antic
            if ($equip->escut) {
                Storage::disk('public')->delete($equip->escut);
            }
            // Guardem el nou
            $data['escut'] = $escut->store('escuts', 'public');
        }

        return $this->repo->update($id, $data);
    }

    public function eliminar(int $id): void 
    {
        $equip = $this->repo->find($id);

        // Si l'equip té escut, l'esborrem del disc abans d'eliminar l'equip de la BD
        if ($equip->escut) {
            Storage::disk('public')->delete($equip->escut);
        }

        $this->repo->delete($id);
    }

    public function llistar() 
    {
        return $this->repo->getAll();
    }

    public function trobar(int $id): Equip 
    {
        return $this->repo->find($id);
    }
}