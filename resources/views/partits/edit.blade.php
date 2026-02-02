@extends('layouts.app')

@section('title', __('Editar Partit'))

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">{{ __('Editar Partit') }}</h1>

    <form action="{{ route('partits.update', $partit) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium">{{ __('Equip Local') }}</label>
            <select name="equip_local_id" class="w-full border rounded p-2">
                @foreach($equips as $equip)
                    <option value="{{ $equip->id }}" @selected(old('equip_local_id', $partit->equip_local_id) == $equip->id)>
                        {{ $equip->nom }}
                    </option>
                @endforeach
            </select>
            @error('equip_local_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">{{ __('Equip Visitant') }}</label>
            <select name="equip_visitant_id" class="w-full border rounded p-2">
                @foreach($equips as $equip)
                    <option value="{{ $equip->id }}" @selected(old('equip_visitant_id', $partit->equip_visitant_id) == $equip->id)>
                        {{ $equip->nom }}
                    </option>
                @endforeach
            </select>
            @error('equip_visitant_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">{{ __('Estadi') }}</label>
            <select name="estadi_id" class="w-full border rounded p-2">
                @foreach($estadis as $estadi)
                    <option value="{{ $estadi->id }}" @selected(old('estadi_id', $partit->estadi_id) == $estadi->id)>
                        {{ $estadi->nom }}
                    </option>
                @endforeach
            </select>
            @error('estadi_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">{{ __('Data i Hora') }}</label>
            <input type="datetime-local" name="data_partit" value="{{ old('data_partit', $partit->data_partit) }}" class="w-full border rounded p-2">
            @error('data_partit') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <hr class="my-4">
        <h3 class="font-bold text-gray-700">{{ __('Resultat (Opcional)') }}</h3>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">{{ __('Gols Local') }}</label>
                <input type="number" name="gols_local" value="{{ old('gols_local', $partit->gols_local) }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block text-sm font-medium">{{ __('Gols Visitant') }}</label>
                <input type="number" name="gols_visitant" value="{{ old('gols_visitant', $partit->gols_visitant) }}" class="w-full border rounded p-2">
            </div>
        </div>

        <div class="mt-4 flex gap-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">{{ __('Actualitzar') }}</button>
            <a href="{{ route('partits.index') }}" class="text-gray-600 py-2 hover:underline">{{ __('Cancel·lar') }}</a>
        </div>
    </form>
</div>
@endsection