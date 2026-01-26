@extends('layouts.app')

@section('title', __("Detall de l'Estadi"))

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-8 rounded shadow-lg">
        <div class="flex items-center gap-6 mb-6">
            <div class="p-4 bg-blue-100 text-blue-600 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <div>
                <h1 class="text-4xl font-bold text-gray-800">{{ $estadi->nom }}</h1>
                <p class="text-xl text-gray-500">{{ __('Aforament total') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-lg">
            <div class="p-6 bg-gray-50 rounded border border-gray-200">
                <span class="block text-gray-500 text-sm uppercase tracking-wide">{{ __('Capacitat') }}</span>
                <span class="font-bold text-3xl text-blue-900">{{ number_format($estadi->capacitat, 0, ',', '.') }}</span>
                <span class="text-gray-600">{{ __('espectadors') }}</span>
            </div>
            
            <div class="p-6 bg-gray-50 rounded border border-gray-200">
                <span class="block text-gray-500 text-sm uppercase tracking-wide">{{ __('ID del Sistema') }}</span>
                <span class="font-mono text-xl text-gray-700">#{{ $estadi->id }}</span>
            </div>
        </div>

        @auth
            <div class="mt-8 flex gap-4 border-t pt-6">
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('estadis.edit', $estadi) }}" class="btn btn--primary">{{ __('Editar Estadi') }}</a>
                @endif
                
                <a href="{{ route('estadis.index') }}" class="btn btn--ghost">{{ __('Tornar al llistat') }}</a>
            </div>
        @endauth
    </div>
@endsection