@extends('layouts.equip')

@section('title', __('Llistat d\'Equips'))

@section('content')
<div class="container">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
      <h1 class="title">{{ __('Llistat d\'Equips') }}</h1>
      @if(auth()->user() && auth()->user()->role === 'admin')
        <a class="btn btn--primary" href="{{ route('equips.create') }}">{{ __('Crear Equip') }}</a>
      @endif
  </div>

  <div class="grid-cards">
    @foreach ($equips as $equip)
      <article class="card">
        <header class="card__header">
          <div style="display: flex; align-items: center; gap: 10px;">
            @if($equip->escut)
                <img src="{{ asset('storage/' . $equip->escut) }}" style="width: 30px; height: 30px; object-fit: contain;">
            @endif
            <h2 class="card__title">{{ $equip->nom }}</h2>
          </div>
          <span class="card__badge">{{ __('ID') }}: {{ $equip->id }}</span>
        </header>

        <div class="card__body">
          <p><strong>{{ __('Estadi') }}:</strong> {{ $equip->estadi->nom ?? __('Sense estadi') }}</p>
          <p><strong>{{ __('Manager') }}:</strong> {{ $equip->manager->name ?? __('Sense assignar') }}</p>
          <p><strong>{{ __('Titols') }}:</strong> {{ $equip->titols }}</p>
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
@endsection