@extends('layouts.app')

@section('title', __('Crear Jugadora'))

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4 text-blue-800">{{ __('Nova Jugadora') }}</h1>

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('jugadoras.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        
        <div>
            <label for="nom" class="block font-bold mb-1">{{ __('Nom') }}:</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="border p-2 w-full rounded">
        </div>

        <div>
            <label for="dorsal" class="block font-bold mb-1">{{ __('Dorsal') }}:</label>
            <input type="number" name="dorsal" id="dorsal" value="{{ old('dorsal') }}" class="border p-2 w-full rounded">
        </div>

        <div>
            <label for="posicio" class="block font-bold mb-1">{{ __('Posició') }}:</label>
            <select name="posicio" id="posicio" class="border p-2 w-full rounded">
                @foreach(['Portera', 'Defensa', 'Migcampista', 'Davantera'] as $pos)
                    <option value="{{ $pos }}" {{ old('posicio') == $pos ? 'selected' : '' }}>{{ $pos }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="data_naixement" class="block font-bold mb-1">{{ __('Data Naixement') }}:</label>
            <input type="date" name="data_naixement" id="data_naixement" value="{{ old('data_naixement') }}" class="border p-2 w-full rounded">
        </div>

        <div>
            <label for="equip_id" class="block font-bold mb-1">{{ __('Equip') }}:</label>
            <select name="equip_id" id="equip_id" class="border p-2 w-full rounded">
                @foreach ($equips as $equip)
                    <option value="{{ $equip->id }}" {{ old('equip_id') == $equip->id ? 'selected' : '' }}>
                        {{ $equip->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="foto" class="block font-bold mb-1">{{ __('Foto (Opcional)') }}:</label>
            <input type="file" name="foto" id="foto" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Guardar') }}
            </button>
            <a href="{{ route('jugadoras.index') }}" class="text-gray-600 ml-4 hover:underline">{{ __('Cancel·lar') }}</a>
        </div>
    </form>
</div>
@endsection