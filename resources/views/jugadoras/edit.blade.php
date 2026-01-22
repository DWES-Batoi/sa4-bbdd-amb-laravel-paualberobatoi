@extends('layouts.app')

@section('title', __('Editar Jugadora'))

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">{{ __('Editar Jugadora') }}</h1>

    <form action="{{ route('jugadoras.update', $jugadora) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium">{{ __('Nom') }}</label>
            <input type="text" name="nom" value="{{ old('nom', $jugadora->nom) }}" class="w-full border rounded p-2">
            @error('nom') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">{{ __('Dorsal') }}</label>
            <input type="number" name="dorsal" value="{{ old('dorsal', $jugadora->dorsal) }}" class="w-full border rounded p-2">
            @error('dorsal') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">{{ __('Posició') }}</label>
            <select name="posicio" class="w-full border rounded p-2">
                @foreach(['Portera', 'Defensa', 'Migcampista', 'Davantera'] as $pos)
                    <option value="{{ $pos }}" @selected(old('posicio', $jugadora->posicio) == $pos)>{{ $pos }}</option>
                @endforeach
            </select>
            @error('posicio') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">{{ __('Edat') }}</label>
            <input type="number" name="edat" value="{{ old('edat', $jugadora->edat) }}" class="w-full border rounded p-2">
            @error('edat') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">{{ __('Equip') }}</label>
            <select name="equip_id" class="w-full border rounded p-2">
                @foreach($equips as $equip)
                    <option value="{{ $equip->id }}" @selected(old('equip_id', $jugadora->equip_id) == $equip->id)>
                        {{ $equip->nom }}
                    </option>
                @endforeach
            </select>
            @error('equip_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        @if($jugadora->foto)
            <div class="flex items-center gap-3">
                <img src="{{ asset('storage/' . $jugadora->foto) }}" class="h-16 w-16 object-cover rounded-full" alt="Foto">
                <p class="text-sm text-gray-600">{{ __('Foto actual') }}</p>
            </div>
        @endif

        <div>
            <label class="block text-sm font-medium">{{ __('Canviar Foto') }}</label>
            <input type="file" name="foto" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            @error('foto') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mt-4 flex gap-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">{{ __('Actualitzar') }}</button>
            <a href="{{ route('jugadoras.index') }}" class="text-gray-600 py-2 hover:underline">{{ __('Cancel·lar') }}</a>
        </div>
    </form>
</div>
@endsection