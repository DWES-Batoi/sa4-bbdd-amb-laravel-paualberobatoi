@extends('layouts.equip')

@section('title', 'Llistat d\'Equips')

@section('content')
<div class="container">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
      <h1 class="title">Llistat d'Equips</h1>
      @if(auth()->user() && auth()->user()->role === 'admin')
        <a class="btn btn--primary" href="{{ route('equips.create') }}">Afegir Equip</a>
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
          <span class="card__badge">ID: {{ $equip->id }}</span>
        </header>

        <div class="card__body">
          <p><strong>Estadi:</strong> {{ $equip->estadi->nom ?? 'Sense estadi' }}</p>
          {{-- Afegim el manager gràcies a la relació que ja tens configurada --}}
          <p><strong>Manager:</strong> {{ $equip->manager->name ?? 'Sense assignar' }}</p>
          <p><strong>Títols:</strong> {{ $equip->titols }}</p>
        </div>

        <footer class="card__footer">
          <a class="btn btn--ghost" href="{{ route('equips.show', $equip) }}">Veure</a>
          
          @auth
            {{-- Editar: Només si és Admin O si és el Manager d'aquest equip específic --}}
            @if(auth()->user()->role === 'admin' || (auth()->user()->role === 'manager' && auth()->user()->equip_id === $equip->id))
              <a class="btn btn--primary" href="{{ route('equips.edit', $equip) }}">Editar</a>
            @endif

            {{-- Eliminar: Restringit només a l'Administrador --}}
            @if(auth()->user()->role === 'admin')
              <form method="POST" action="{{ route('equips.destroy', $equip) }}" class="inline" onsubmit="return confirm('Segur que vols esborrar aquest equip?');">
                @csrf
                @method('DELETE')
                <button class="btn btn--danger" type="submit">Eliminar</button>
              </form>
            @endif
          @endauth
        </footer>
      </article>
    @endforeach
  </div>
</div>
@endsection