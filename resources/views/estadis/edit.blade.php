@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold mb-4">Editar Estadi: {{ $estadi->nom }}</h1>
<form action="{{ route('estadis.update', $estadi) }}" method="POST" class="bg-white p-6 shadow rounded">
    @csrf @method('PUT')
    <label class="block mb-2">Nom:</label>
    <input type="text" name="nom" value="{{ $estadi->nom }}" class="border p-2 w-full mb-4">
    <label class="block mb-2">Capacitat:</label>
    <input type="number" name="capacitat" value="{{ $estadi->capacitat }}" class="border p-2 w-full mb-4">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Actualitzar</button>
</form>
@endsection