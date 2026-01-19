@extends('layouts.app')

@section('title', __('Editar Estadi'))

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">{{ __('Editar Estadi') }}</h1>

    <form action="{{ route('estadis.update', $estadi) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium">{{ __('Nom de l\'Estadi') }}</label>
            <input type="text" name="nom" value="{{ old('nom', $estadi->nom) }}" class="w-full border rounded p-2">
            @error('nom') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">{{ __('Capacitat') }}</label>
            <input type="number" name="capacitat" value="{{ old('capacitat', $estadi->capacitat) }}" class="w-full border rounded p-2">
            @error('capacitat') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mt-4 flex gap-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">{{ __('Actualitzar') }}</button>
            <a href="{{ route('estadis.index') }}" class="text-gray-600 py-2 hover:underline">{{ __('Cancel·lar') }}</a>
        </div>
    </form>
</div>
@endsection