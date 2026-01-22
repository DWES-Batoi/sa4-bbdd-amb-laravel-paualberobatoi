@extends('layouts.app')

@section('title', __("Fitxa de la Jugadora"))

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-8 rounded shadow-lg">
        <div class="flex flex-col md:flex-row gap-8 items-center md:items-start">
            <div class="flex-shrink-0">
                @if($jugadora->foto)
                    <img src="{{ asset('storage/' . $jugadora->foto) }}" class="w-64 h-64 object-cover rounded shadow-md">
                @else
                    <div class="w-64 h-64 bg-gray-200 rounded flex items-center justify-center text-gray-500 text-xl">
                        {{ __('Sense foto') }}
                    </div>
                @endif
            </div>

            <div class="flex-grow">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $jugadora->nom }}</h1>
                <div class="text-2xl text-blue-600 font-semibold mb-6">
                    #{{ $jugadora->dorsal }} - {{ $jugadora->posicio }}
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-lg">
                    <div class="p-4 bg-gray-50 rounded">
                        <span class="block text-gray-500 text-sm">{{ __('Equip') }}</span>
                        <span class="font-bold text-gray-800">{{ $jugadora->equip->nom ?? 'Sense Equip' }}</span>
                    </div>
                    
                    <div class="p-4 bg-gray-50 rounded">
                        <span class="block text-gray-500 text-sm">{{ __('Edat') }}</span>
                        <span class="font-bold text-gray-800">
                            {{ $jugadora->edat }} {{ __('anys') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        @auth
            <div class="mt-8 flex gap-4 border-t pt-6">
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('jugadoras.edit', $jugadora) }}" class="btn btn--primary">{{ __('Editar Fitxa') }}</a>
                @endif
                
                <a href="{{ route('jugadoras.index') }}" class="btn btn--ghost">{{ __('Tornar al llistat') }}</a>
            </div>
        @endauth
    </div>
@endsection