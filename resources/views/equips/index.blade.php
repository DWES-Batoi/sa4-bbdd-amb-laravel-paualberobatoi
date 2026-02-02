@extends('layouts.app')

@section('title', __('Llistat d\'Equips'))

@section('content')
<div class="max-w-7xl mx-auto mt-8">
    <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
        
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h1 class="text-2xl font-bold text-gray-800">{{ __('Llistat d\'Equips') }}</h1>
            @if(auth()->user() && auth()->user()->role === 'admin')
                <a class="btn btn--primary" href="{{ route('equips.create') }}">{{ __('Nou Equip') }}</a>
            @endif
        </div>

        <div class="grid-cards">
            @foreach ($equips as $equip)
            <article class="card">
                <header class="card__header">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        @if($equip->escut)
                            <img src="{{ asset('storage/' . $equip->escut) }}" style="width: 40px; height: 40px; object-fit: contain;">
                        @else
                            <div style="width: 40px; height: 40px; background: #eee; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #555;">
                                {{ substr($equip->nom, 0, 1) }}
                            </div>
                        @endif
                        <h2 class="card__title">{{ $equip->nom }}</h2>
                    </div>
                    <span class="card__badge" title="{{ __('Títols') }}">🏆 {{ $equip->titols }}</span>
                </header>

                <div class="card__body">
                    <p><strong>{{ __('Estadi') }}:</strong> {{ $equip->estadi->nom ?? __('Sense estadi') }}</p>
                    <p><strong>{{ __('Manager') }}:</strong> {{ $equip->manager->name ?? __('Sense assignar') }}</p>
                </div>

                <footer class="card__footer">
                    <a class="btn btn--ghost" href="{{ route('equips.show', $equip) }}">{{ __('Veure') }}</a>
                    
                    @auth
                        @if(auth()->user()->role === 'admin' || (auth()->user()->role === 'manager' && auth()->user()->equip_id === $equip->id))
                            <a class="btn btn--primary" href="{{ route('equips.edit', $equip) }}">{{ __('Editar') }}</a>
                        @endif

                        @if(auth()->user()->role === 'admin')
                            <form method="POST" action="{{ route('equips.destroy', $equip) }}" class="inline" 
                                    onsubmit="return confirm('{{ __('Segur que vols eliminar aquest equip?') }}');">
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