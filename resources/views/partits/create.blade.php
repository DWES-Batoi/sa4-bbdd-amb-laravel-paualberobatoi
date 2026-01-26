@extends('layouts.app')

@section('title', __('Programar Partit'))

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4 text-blue-800">{{ __('Programar Nou Partit') }}</h1>

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('partits.store') }}" method="POST" class="space-y-4">
        @csrf
        
        <div>
            <label for="equip_local_id" class="block font-bold mb-1">{{ __('Equip Local') }}:</label>
            <select name="equip_local_id" id="equip_local_id" class="border p-2 w-full rounded">
                @foreach ($equips as $equip)
                    <option value="{{ $equip->id }}" {{ old('equip_local_id') == $equip->id ? 'selected' : '' }}>
                        {{ $equip->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="equip_visitant_id" class="block font-bold mb-1">{{ __('Equip Visitant') }}:</label>
            <select name="equip_visitant_id" id="equip_visitant_id" class="border p-2 w-full rounded">
                @foreach ($equips as $equip)
                    <option value="{{ $equip->id }}" {{ old('equip_visitant_id') == $equip->id ? 'selected' : '' }}>
                        {{ $equip->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="estadi_id" class="block font-bold mb-1">{{ __('Estadi') }}:</label>
            <select name="estadi_id" id="estadi_id" class="border p-2 w-full rounded">
                @foreach ($estadis as $estadi)
                    <option value="{{ $estadi->id }}" {{ old('estadi_id') == $estadi->id ? 'selected' : '' }}>
                        {{ $estadi->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="data_partit" class="block font-bold mb-1">{{ __('Data i Hora') }}:</label>
            <input type="datetime-local" name="data_partit" id="data_partit" value="{{ old('data_partit') }}" class="border p-2 w-full rounded">
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Guardar Partit') }}
            </button>
            <a href="{{ route('partits.index') }}" class="text-gray-600 ml-4 hover:underline">{{ __('Cancel·lar') }}</a>
        </div>
    </form>
</div>
@endsection