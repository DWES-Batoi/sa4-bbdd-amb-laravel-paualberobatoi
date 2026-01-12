@extends(view: 'layouts.equip') 
@section('title', 'Afegir nou equip')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4 text-blue-800">Afegir nou equip</h1>

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('equips.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        
        <div>
            <label for="nom" class="block font-bold mb-1">Nom de l'Equip:</label>
            <input
                type="text"
                name="nom"
                id="nom"
                value="{{ old('nom') }}"
                class="border p-2 w-full rounded"
                placeholder="Ex: FC Barcelona"
            >
        </div>

        <div>
            <label for="escut" class="block font-bold mb-1">Escut (Imatge):</label>
            <input 
                type="file" 
                name="escut" 
                id="escut"
                class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100"
            >
            @error('escut')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="estadi_id" class="block font-bold mb-1">Estadi:</label>
            <select name="estadi_id" id="estadi_id" class="border p-2 w-full rounded">
                @foreach ($estadis as $estadi)
                    <option value="{{ $estadi->id }}" {{ old('estadi_id') == $estadi->id ? 'selected' : '' }}>
                        {{ $estadi->nom }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="titols" class="block font-bold mb-1">Títols:</label>
            <input
                type="number"
                name="titols"
                id="titols"
                value="{{ old('titols', 0) }}"
                class="border p-2 w-full rounded"
            >
        </div>

        <button type="submit" class="bg-blue-600 text-white font-bold px-4 py-2 rounded hover:bg-blue-700 w-full">
            Guardar Equip
        </button>
    </form>
</div>
@endsection