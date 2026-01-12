@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold mb-4">Editar Equip: {{ $equip->nom }}</h1>
<form action="{{ route('equips.update', $equip) }}" method="POST" class="bg-white p-6 shadow rounded">
    @csrf @method('PUT')
    <label class="block mb-2">Nom de l'Equip:</label>
    <input type="text" name="nom" value="{{ $equip->nom }}" class="border p-2 w-full mb-4">
    
    <label class="block mb-2">Estadi:</label>
    <select name="estadi_id" class="border p-2 w-full mb-4">
        @foreach($estadis as $estadi)
            <option value="{{ $estadi->id }}" {{ $equip->estadi_id == $estadi->id ? 'selected' : '' }}>{{ $estadi->nom }}</option>
        @endforeach
    </select>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Actualitzar Equip</button>
</form>
@endsection