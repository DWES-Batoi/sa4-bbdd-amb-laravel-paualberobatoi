@extends('layouts.app')

@section('title', __('Crear Estadi'))

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4 text-blue-800">{{ __('Nou Estadi') }}</h1>

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('estadis.store') }}" method="POST" class="space-y-4">
        @csrf
        
        <div>
            <label for="nom" class="block font-bold mb-1">{{ __('Nom de l\'Estadi') }}:</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="border p-2 w-full rounded" placeholder="Ex: Camp Nou">
        </div>

        <div>
            <label for="capacitat" class="block font-bold mb-1">{{ __('Capacitat (Espectadors)') }}:</label>
            <input type="number" name="capacitat" id="capacitat" value="{{ old('capacitat') }}" class="border p-2 w-full rounded" min="0">
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Guardar Estadi') }}
            </button>
            <a href="{{ route('estadis.index') }}" class="text-gray-600 ml-4 hover:underline">{{ __('Cancel·lar') }}</a>
        </div>
    </form>
</div>
@endsection