@extends('layouts.app')

@section('title', __("Detall del Partit"))

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-8 rounded shadow-lg text-center">
        
        <div class="mb-6">
            <span class="bg-gray-200 text-gray-700 py-1 px-3 rounded-full text-sm">
                {{ \Carbon\Carbon::parse($partit->data_partit)->format('d \d\e F, Y - H:i') }}
            </span>
            <h2 class="text-lg text-gray-500 mt-2">{{ $partit->estadi->nom ?? 'Estadi desconegut' }}</h2>
        </div>

        <div class="flex justify-center items-center gap-8 mb-8">
            <div class="flex flex-col items-center w-1/3">
                @if($partit->local->escut)
                    <img src="{{ asset('storage/' . $partit->local->escut) }}" class="h-24 w-24 object-contain mb-2">
                @else
                    <div class="h-24 w-24 bg-gray-200 rounded-full flex items-center justify-center text-2xl font-bold text-gray-500">L</div>
                @endif
                <h3 class="text-xl font-bold">{{ $partit->local->nom }}</h3>
            </div>

            <div class="text-5xl font-bold text-blue-800">
                @if($partit->gols_local !== null)
                    {{ $partit->gols_local }} - {{ $partit->gols_visitant }}
                @else
                    <span class="text-4xl text-gray-400">VS</span>
                @endif
            </div>

            <div class="flex flex-col items-center w-1/3">
                @if($partit->visitant->escut)
                    <img src="{{ asset('storage/' . $partit->visitant->escut) }}" class="h-24 w-24 object-contain mb-2">
                @else
                    <div class="h-24 w-24 bg-gray-200 rounded-full flex items-center justify-center text-2xl font-bold text-gray-500">V</div>
                @endif
                <h3 class="text-xl font-bold">{{ $partit->visitant->nom }}</h3>
            </div>
        </div>

        @auth
            <div class="mt-8 flex justify-center gap-4 border-t pt-6">
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('partits.edit', $partit) }}" class="btn btn--primary">{{ __('Editar Resultat') }}</a>
                @endif
                
                <a href="{{ route('partits.index') }}" class="btn btn--ghost">{{ __('Tornar al llistat') }}</a>
            </div>
        @endauth
    </div>
@endsection