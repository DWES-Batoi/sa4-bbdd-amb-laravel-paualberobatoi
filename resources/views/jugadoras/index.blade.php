@extends('layouts.app')

@section('title', __('Llistat de Jugadores'))

@section('content')
<div class="max-w-7xl mx-auto mt-8">
    <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
        
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h1 class="text-2xl font-bold text-gray-800">{{ __('Llistat de Jugadores') }}</h1>
            @if(auth()->user() && auth()->user()->role === 'admin')
                <a class="btn btn--primary" href="{{ route('jugadoras.create') }}">{{ __('Nova Jugadora') }}</a>
            @endif
        </div>

        <div class="grid-cards">
            @foreach ($jugadoras as $jugadora)
            <article class="card">
                <header class="card__header">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        @if($jugadora->foto)
                            <img src="{{ asset('storage/' . $jugadora->foto) }}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                        @else
                            <div style="width: 40px; height: 40px; background: #ddd; border-radius: 50%;"></div>
                        @endif
                        <div>
                            <h2 class="card__title">{{ $jugadora->nom }}</h2>
                            <span style="font-size: 0.8rem; color: #666;">{{ $jugadora->posicio }}</span>
                        </div>
                    </div>
                    <span class="card__badge">#{{ $jugadora->dorsal }}</span>
                </header>

                <div class="card__body">
                    <p><strong>{{ __('Equip') }}:</strong> {{ $jugadora->equip->nom ?? __('Sense equip') }}</p>
                    <p><strong>{{ __('Edat') }}:</strong> {{ $jugadora->edat }} {{ __('anys') }}</p>
                </div>

                <footer class="card__footer">
                    <a class="btn btn--ghost" href="{{ route('jugadoras.show', $jugadora) }}">{{ __('Veure') }}</a>
                    
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a class="btn btn--primary" href="{{ route('jugadoras.edit', $jugadora) }}">{{ __('Editar') }}</a>
                            
                            <form method="POST" action="{{ route('jugadoras.destroy', $jugadora) }}" class="inline" 
                                    onsubmit="return confirm('{{ __('Segur que vols eliminar aquesta jugadora?') }}');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn--danger" type="submit">{{ __('Eliminar') }}</button>
                            </form>
                        @endif
                    @endauth
                </footer>
            </article>
            @endforeach
        </div>
    </div>
</div>
@endsection