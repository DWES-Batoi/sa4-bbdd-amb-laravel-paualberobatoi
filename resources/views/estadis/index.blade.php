@extends('layouts.app')

@section('title', __('Llistat d\'Estadis'))

@section('content')
<div class="max-w-7xl mx-auto mt-8">
    <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
        
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h1 class="text-2xl font-bold text-gray-800">{{ __('Llistat d\'Estadis') }}</h1>
            @if(auth()->user() && auth()->user()->role === 'admin')
                <a class="btn btn--primary" href="{{ route('estadis.create') }}">{{ __('Nou Estadi') }}</a>
            @endif
        </div>

        <div class="grid-cards">
            @foreach ($estadis as $estadi)
            <article class="card">
                <header class="card__header">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="width: 40px; height: 40px; background: #e0e7ff; color: #1e40af; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h2 class="card__title">{{ $estadi->nom }}</h2>
                    </div>
                    <span class="card__badge">{{ __('Capacitat') }}: {{ number_format($estadi->capacitat, 0, ',', '.') }}</span>
                </header>

                <div class="card__body">
                    <p><strong>{{ __('Nom') }}:</strong> {{ $estadi->nom }}</p>
                    <p><strong>{{ __('Aforament') }}:</strong> {{ $estadi->capacitat }} {{ __('espectadors') }}</p>
                </div>

                <footer class="card__footer">
                    <a class="btn btn--ghost" href="{{ route('estadis.show', $estadi) }}">{{ __('Veure') }}</a>
                    
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a class="btn btn--primary" href="{{ route('estadis.edit', $estadi) }}">{{ __('Editar') }}</a>
                            
                            <form method="POST" action="{{ route('estadis.destroy', $estadi) }}" class="inline" 
                                    onsubmit="return confirm('{{ __('Segur que vols eliminar aquest estadi?') }}');">
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