@extends('layouts.app')

@section('title', __('Editar Equip'))

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">{{ __('Editar Equip') }}</h1>

    <form action="{{ route('equips.update', $equip) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium">{{ __('Nom') }}</label>
            <input type="text" name="nom" value="{{ old('nom', $equip->nom) }}" class="w-full border rounded p-2">
            @error('nom') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">{{ __('Estadi') }}</label>
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
            <label class="block text-sm font-medium">{{ __('Titols') }}</label>
            <input type="number" name="titols" value="{{ old('titols', $equip->titols) }}" class="w-full border rounded p-2">
            @error('titols') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        @if($equip->escut)
            <div class="flex items-center gap-3">
                <img src="{{ asset('storage/' . $equip->escut) }}" class="h-16 w-16 object-contain" alt="Escut">
                <p class="text-sm text-gray-600">{{ __('Escut actual') }}</p>
            </div>
        @endif

        <div>
            <label class="block text-sm font-medium">{{ __('Canviar Escut') }}</label>
            <input type="file" name="escut" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            @error('escut') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mt-4 flex gap-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">{{ __('Actualitzar') }}</button>
            <a href="{{ route('equips.index') }}" class="text-gray-600 py-2 hover:underline">{{ __('Cancel·lar') }}</a>
        </div>
    </form>
</div>
@endsection