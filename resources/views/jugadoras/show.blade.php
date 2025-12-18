@extends('layouts.app')
@section('title', "Detall de la Jugadora")

@section('content')
    <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6 border border-gray-200">
        <h1 class="text-3xl font-bold text-blue-800 mb-4">{{ $jugadora->nom }}</h1>

        <div class="space-y-2">
            <p><strong>Equip:</strong> {{ $jugadora->equip->nom ?? 'Sense equip' }}</p>
            <p><strong>Dorsal:</strong> {{ $jugadora->dorsal }}</p>
            <p><strong>Data de naixement:</strong> {{ $jugadora->data_naixement }}</p>
        </div>

        <div class="mt-6">
            <a href="{{ route('jugadoras.index') }}" class="text-blue-600 hover:underline">
                &larr; Tornar al llistat
            </a>
        </div>
    </div>
@endsection