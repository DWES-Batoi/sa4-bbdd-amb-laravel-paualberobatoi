@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold mb-4">Editar Jugadora: {{ $jugadora->nom }}</h1>
<form action="{{ route('jugadoras.update', $jugadora) }}" method="POST" class="bg-white p-6 shadow rounded">
    @csrf @method('PUT')
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label>Nom:</label>
            <input type="text" name="nom" value="{{ $jugadora->nom }}" class="border p-2 w-full mb-4">
        </div>
        <div>
            <label>Dorsal:</label>
            <input type="number" name="dorsal" value="{{ $jugadora->dorsal }}" class="border p-2 w-full mb-4">
        </div>
    </div>
    <label>Equip:</label>
    <select name="equip_id" class="border p-2 w-full mb-4">
        @foreach($equips as $equip)
            <option value="{{ $equip->id }}" {{ $jugadora->equip_id == $equip->id ? 'selected' : '' }}>{{ $equip->nom }}</option>
        @endforeach
    </select>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar Canvis</button>
</form>
@endsection