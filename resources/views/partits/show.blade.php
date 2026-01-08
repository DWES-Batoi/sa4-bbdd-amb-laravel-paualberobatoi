@extends('layouts.app')
@section('title', "Detall del Partit")

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-200">
        {{-- Cabecera con la Fecha y Jornada --}}
        <div class="bg-gray-800 text-white text-center py-4">
            <p class="text-sm uppercase tracking-widest font-semibold">Jornada {{ $partit->jornada }}</p>
            <p class="text-lg">{{ \Carbon\Carbon::parse($partit->data)->format('d/m/Y - H:i') }}h</p>
        </div>

        {{-- Cuerpo del marcador --}}
        <div class="p-10 flex flex-col md:flex-row items-center justify-around gap-8">
            {{-- Equipo Local --}}
            <div class="text-center w-full md:w-1/3">
                <h2 class="text-3xl font-extrabold text-blue-900 mb-2">{{ $partit->local->nom }}</h2>
                <span class="text-gray-500 font-medium italic">Local</span>
            </div>

            {{-- Marcador --}}
            <div class="flex items-center justify-center bg-gray-100 rounded-lg px-8 py-4 border-2 border-blue-600 shadow-inner">
                @if($partit->gols_local !== null)
                    <span class="text-6xl font-black text-blue-800">{{ $partit->gols_local }}</span>
                    <span class="text-4xl font-light text-gray-400 mx-4">-</span>
                    <span class="text-6xl font-black text-blue-800">{{ $partit->gols_visitant }}</span>
                @else
                    <span class="text-4xl font-bold text-gray-400 italic px-4">VS</span>
                @endif
            </div>

            {{-- Equipo Visitante --}}
            <div class="text-center w-full md:w-1/3">
                <h2 class="text-3xl font-extrabold text-blue-900 mb-2">{{ $partit->visitant->nom }}</h2>
                <span class="text-gray-500 font-medium italic">Visitant</span>
            </div>
        </div>

        {{-- Detalles del Estadio --}}
        <div class="bg-gray-50 border-t border-gray-200 p-6 text-center">
            <div class="flex items-center justify-center gap-2 text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span class="text-xl font-semibold">Estadi: {{ $partit->estadi->nom }}</span>
            </div>
            <p class="text-gray-500 text-sm mt-1">Capacitat: {{ number_format($partit->estadi->capacitat) }} espectadors</p>
        </div>
    </div>

    {{-- Botón Volver --}}
    <div class="mt-8 text-center">
        <a href="{{ route('partits.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-700 text-white font-bold rounded-full hover:bg-blue-800 transition shadow-lg">
            &larr; Tornar al Calendari
        </a>
    </div>
</div>
@endsection