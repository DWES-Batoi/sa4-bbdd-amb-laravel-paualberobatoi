@extends('layouts.app')

@section('title', __('Llistat de Partits'))

@section('content')
<div class="max-w-7xl mx-auto mt-8">
    <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
        
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h1 class="text-2xl font-bold text-gray-800">{{ __('Llistat de Partits') }}</h1>
            @if(auth()->user() && auth()->user()->role === 'admin')
                <a class="btn btn--primary" href="{{ route('partits.create') }}">{{ __('Nou Partit') }}</a>
            @endif
        </div>

        <div class="grid-cards">
            @foreach ($partits as $partit)
            <article class="card">
                <header class="card__header">
                    {{-- Títol: Local vs Visitant --}}
                    <h2 class="card__title" style="font-size: 1rem;">
                        {{ $partit->local->nom ?? '?' }} <span style="color: #888;">vs</span> {{ $partit->visitant->nom ?? '?' }}
                    </h2>
                    {{-- Badge: Data --}}
                    <span class="card__badge">{{ \Carbon\Carbon::parse($partit->data_partit)->format('d/m H:i') }}</span>
                </header>

                <div class="card__body">
                    {{-- Resultat destacat al mig --}}
                    <div style="text-align: center; margin-bottom: 0.5rem;">
                        @if($partit->gols_local !== null)
                            <span style="font-size: 1.5rem; font-weight: bold; color: #1e3a8a;">
                                {{ $partit->gols_local }} - {{ $partit->gols_visitant }}
                            </span>
                        @else
                            <span style="color: #666; font-style: italic;">{{ __('Pendent de jugar') }}</span>
                        @endif
                    </div>
                    
                    <p style="font-size: 0.9rem; color: #555;">
                        <strong>{{ __('Estadi') }}:</strong> {{ $partit->estadi->nom ?? __('Desconegut') }}
                    </p>
                </div>

                <footer class="card__footer">
                    <a class="btn btn--ghost" href="{{ route('partits.show', $partit) }}">{{ __('Veure') }}</a>
                    
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a class="btn btn--primary" href="{{ route('partits.edit', $partit) }}">{{ __('Editar') }}</a>
                            
                            <form method="POST" action="{{ route('partits.destroy', $partit) }}" class="inline" 
                                    onsubmit="return confirm('{{ __('Segur que vols eliminar aquest partit?') }}');">
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