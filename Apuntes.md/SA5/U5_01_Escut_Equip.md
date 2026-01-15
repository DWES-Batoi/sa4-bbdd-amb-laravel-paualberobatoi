# 1. 🛡️ Afegir un escut a l’equip (Branca `escut`)

## Objectiu
Afegir la possibilitat de **pujar una imatge (escut)** per a cada equip, guardar-la a `storage/public`, persistir-ne la ruta a BD i mostrar-la a les vistes.

---

## 1) Crear una migració per afegir un camp `escut` a la taula `equips`

### Crear la migració
```bash
make artisan CMD="make:migration add_escut_to_equips_table"
```

### Modificar la migració
Obre el fitxer creat a `database/migrations/...add_escut_to_equips_table.php` i deixa’l així:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('equips', function (Blueprint $table) {
            $table->string('escut')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('equips', function (Blueprint $table) {
            $table->dropColumn('escut');
        });
    }
};
```

### Aplicar la migració
```bash
make artisan CMD="migrate"
```

---

## 2) Modificar el model `Equip` (mass assignment)

A `app/Models/Equip.php` inclou el camp `escut` a `$fillable`:

```php
protected $fillable = ['nom', 'estadi_id', 'titols', 'escut'];
```

---

## 3) Preparar Laravel per servir fitxers (storage link)

Crear l’enllaç simbòlic perquè `public/storage` apunti a `storage/app/public`:

```bash
make artisan CMD="storage:link"
```

> Això és imprescindible perquè el navegador pugui carregar `storage/...`.

---

## 4) Modificar la vista `equips.create` (pujar fitxer)

### Important
- Afegir `enctype="multipart/form-data"` al `<form>`.
- Afegir `<input type="file" ...>` per `escut`.

```blade
<form action="{{ route('equips.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- ... camps existents ... -->

    <div class="mb-4">
        <label for="escut" class="block text-sm font-medium text-gray-700 mb-1">Escut:</label>
        <input type="file" name="escut" id="escut"
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        @error('escut')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- submit -->
</form>
```

---

## 5) Crear la vista `equips.edit`

Crea `resources/views/equips/edit.blade.php` (exemple base):

```blade
@extends('layouts.app')
@section('title', "Editar equip")

@section('content')
<form action="{{ route('equips.update', $equip) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label class="block text-sm font-medium">Nom</label>
        <input type="text" name="nom" value="{{ old('nom', $equip->nom) }}" class="w-full border rounded p-2">
        @error('nom') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Estadi</label>
        <select name="estadi_id" class="w-full border rounded p-2">
            @foreach($estadis as $estadi)
                <option value="{{ $estadi->id }}" @selected(old('estadi_id', $equip->estadi_id) == $estadi->id)>
                    {{ $estadi->nom }}
                </option>
            @endforeach
        </select>
        @error('estadi_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium">Títols</label>
        <input type="number" name="titols" value="{{ old('titols', $equip->titols) }}" class="w-full border rounded p-2">
        @error('titols') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    @if($equip->escut)
        <div class="flex items-center gap-3">
            <img src="{{ asset('storage/' . $equip->escut) }}" class="h-12 w-12 object-cover rounded-full" alt="Escut">
            <p class="text-sm text-gray-600">Escut actual</p>
        </div>
    @endif

    <div>
        <label class="block text-sm font-medium">Nou escut (opcional)</label>
        <input type="file" name="escut" class="w-full border rounded p-2">
        @error('escut') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <button class="px-4 py-2 bg-blue-600 text-white rounded">Desar</button>
</form>
@endsection
```

---

## 6) Actualitzar FormRequests (validació del fitxer)

### `StoreEquipRequest`
```php
'escut' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
```

*(Opcional, si vols que el nom sigui únic)*

```php
'nom' => 'required|min:3|unique:equips,nom',
```

### `UpdateEquipRequest`
```php
'escut' => 'sometimes|nullable|image|mimes:jpeg,png,jpg|max:2048',
```
---


## 7) Modificar el controlador EquipControles per passar el fitxer al servei

```php
//En public function store(StoreEquipRequest $request) revisar esta sentencia
$this->servei->guardar($request->validated(), $request->file('escut'));
//En public function update(UpdateEquipRequest $request, Equip $equip) revisar esta sentencia
$this->servei->actualitzar($equip->id, $request->validated(), $request->file('escut'));
```

---

## 8) Actualitzar el servei app/Services/EquipService.php per gestionar el fitxer (`store`, `update`, `destroy`)

Exemple d’implementació (guardant a `public/escuts` i esborrant el fitxer quan toca):

```php
<?php
namespace App\Services;

use App\Models\Equip;
use App\Repositories\BaseRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class EquipService {
    public function __construct(private BaseRepository $repo) {}

    public function guardar(array $data, ?UploadedFile $escut = null): Equip {
        if ($escut) {
            $data['escut'] = $escut->store('escuts', 'public');
        }
        return $this->repo->create($data);
    }

    public function actualitzar(int $id, array $data, ?UploadedFile $escut = null): Equip {
        $equip = $this->repo->find($id);

        if ($escut) {
            if ($equip->escut) {
                Storage::disk('public')->delete($equip->escut);
            }
            $data['escut'] = $escut->store('escuts', 'public');
        }

        return $this->repo->update($id, $data);
    }

    public function eliminar(int $id): void {
        $equip = $this->repo->find($id);

        if ($equip->escut) {
            Storage::disk('public')->delete($equip->escut);
        }

        $this->repo->delete($id);
    }

    public function llistar() {
        return $this->repo->getAll();
    }
}
```

---

## 9) Mostrar l’escut a les vistes (component + show)

### Component `components/equip.blade.php`
> **Nota:** dins d’un `<div>` no s’hauria d’usar `<td>` (HTML invàlid). Millor usar directament `<img>`.

```blade
<div class="equip border rounded-lg shadow-md p-4 bg-white">
    @if ($equip->escut)
        <img src="{{ asset('storage/' . $equip->escut) }}"
             alt="Escut de {{ $equip->nom }}"
             class="h-12 w-12 object-cover rounded-full mb-2">
    @endif

    <h2 class="text-xl font-bold text-blue-800">{{ $equip->nom }}</h2>
    <p><strong>Estadi:</strong> {{ $equip->estadi->nom }}</p>
    <p><strong>Títols:</strong> {{ $equip->titols }}</p>
</div>
```

### `equips/show.blade.php`
```blade
@extends('layouts.app')
@section('title', "Detall d'Equip")

@section('content')
    <x-equip :equip="$equip" />
@endsection
```

##10) Para evitar errores de dependencias 
### Añade en la cavbecera de app/Providers/AppServiceProvider

```
use App\Repositories\BaseRepository;
use App\Repositories\EquipRepository;
```

### En EquipController actualizar update

```
 // GET /equips/{id}/edit
    public function edit(Equip $equip) {
        $estadis = Estadi::all();
        return view('equips.edit', compact('equip', 'estadis'));
    }
```



