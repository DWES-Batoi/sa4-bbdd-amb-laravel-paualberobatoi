@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold mb-4 text-blue-800">Editar Resultat / Dades Partit</h1>
<form action="{{ route('partits.update', $partit) }}" method="POST" class="bg-white p-6 shadow rounded">
    @csrf @method('PUT')
    <div class="flex items-center justify-between mb-6 bg-gray-100 p-4 rounded">
        <span class="font-bold">{{ $partit->local->nom }}</span>
        <div class="flex gap-2">
            <input type="number" name="gols_local" value="{{ $partit->gols_local }}" class="w-16 border p-2 text-center">
            <span class="self-center">-</span>
            <input type="number" name="gols_visitant" value="{{ $partit->gols_visitant }}" class="w-16 border p-2 text-center">
        </div>
        <span class="font-bold">{{ $partit->visitant->nom }}</span>
    </div>
    <label>Data:</label>
    <input type="datetime-local" name="data" value="{{ \Carbon\Carbon::parse($partit->data)->format('Y-m-d\TH:i') }}" class="border p-2 w-full mb-4">
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Actualitzar Partit</button>
</form>
@endsection