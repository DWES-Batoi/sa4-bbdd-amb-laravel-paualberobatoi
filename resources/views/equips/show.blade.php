@extends('layouts.app')

@section('title', __("Detall de l'Equip"))

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-8 rounded shadow-lg">
        <div class="flex flex-col md:flex-row gap-8 items-center md:items-start">
            <div class="flex-shrink-0">
                @if($equip->escut)
                    <img src="{{ asset('storage/' . $equip->escut) }}" class="w-48 h-48 object-contain">
                @else
                    <div class="w-48 h-48 bg-gray-200 rounded flex items-center justify-center text-gray-500 text-xl font-bold">
                        {{ substr($equip->nom, 0, 1) }}
                    </div>
                @endif
            </div>

            <div class="flex-grow">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $equip->nom }}</h1>
                <div class="text-2xl text-yellow-600 font-semibold mb-6 flex items-center gap-2">
                    🏆 {{ $equip->titols }} {{ __('Títols') }}
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-lg">
                    <div class="p-4 bg-gray-50 rounded">
                        <span class="block text-gray-500 text-sm uppercase">{{ __('Estadi Local') }}</span>
                        <span class="font-bold text-gray-800">{{ $equip->estadi->nom ?? __('Sense estadi') }}</span>
                    </div>
                    
                    <div class="p-4 bg-gray-50 rounded">
                        <span class="block text-gray-500 text-sm uppercase">{{ __('Manager') }}</span>
                        <span class="font-bold text-gray-800">
                            {{ $equip->manager->name ?? __('Sense manager assignat') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        @auth
            <div class="mt-8 flex gap-4 border-t pt-6">
                @if(auth()->user()->role === 'admin' || (auth()->user()->role === 'manager' && auth()->user()->equip_id === $equip->id))
                    <a href="{{ route('equips.edit', $equip) }}" class="btn btn--primary">{{ __('Editar Equip') }}</a>
                @endif
                
                <a href="{{ route('equips.index') }}" class="btn btn--ghost">{{ __('Tornar al llistat') }}</a>
            </div>
        @endauth
    </div>
@endsection