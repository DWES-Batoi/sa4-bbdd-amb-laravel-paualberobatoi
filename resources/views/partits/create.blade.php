@extends('layouts.app')
@section('title', 'Afegir nou partit')

@section('content')
<h1 class="text-2xl font-bold mb-4 text-blue-800">Afegir nou partit</h1>

@if ($errors->any())
  <div class="bg-red-100 text-red-700 p-2 mb-4">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form action="{{ route('partits.store') }}" method="POST" class="space-y-4 bg-white p-6 shadow rounded-lg">
  @csrf

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
      <label for="local_id" class="block font-bold">Equip Local:</label>
      <select name="local_id" id="local_id" class="border p-2 w-full">
        @foreach($equips as $equip)
          <option value="{{ $equip->id }}">{{ $equip->nom }}</option>
        @endforeach
      </select>
    </div>

    <div>
      <label for="visitant_id" class="block font-bold">Equip Visitant:</label>
      <select name="visitant_id" id="visitant_id" class="border p-2 w-full">
        @foreach($equips as $equip)
          <option value="{{ $equip->id }}">{{ $equip->nom }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div>
    <label for="estadi_id" class="block font-bold">Estadi:</label>
    <select name="estadi_id" id="estadi_id" class="border p-2 w-full">
      @foreach($estadis as $estadi)
        <option value="{{ $estadi->id }}">{{ $estadi->nom }}</option>
      @endforeach
    </select>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
      <label for="data" class="block font-bold">Data i Hora:</label>
      <input type="datetime-local" name="data" id="data" class="border p-2 w-full" value="{{ old('data') }}">
    </div>

    <div>
      <label for="jornada" class="block font-bold">Jornada:</label>
      <input type="number" name="jornada" id="jornada" class="border p-2 w-full" value="{{ old('jornada', 1) }}">
    </div>
  </div>

  <div class="flex gap-4 pt-4">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
      Guardar Partit
    </button>
    <a href="{{ route('partits.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 text-center">
      Cancelar
    </a>
  </div>
</form>
@endsection