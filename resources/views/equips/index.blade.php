@extends('layouts.equip')

@section('title', 'Llistat d\'Equips')

@section('content')
<div class="container">
  {{-- Capçalera amb Títol i Botó d'Afegir --}}
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
      <h1 class="title">Llistat d'Equips</h1>
      <a class="btn btn--primary" href="{{ route('equips.create') }}">Afegir Equip</a>
  </div>

  <div class="grid-cards">
    @foreach ($equips as $equip)
      <article class="card">
        <header class="card__header">
          <h2 class="card__title">{{ $equip->nom }}</h2>
          {{-- Pots deixar l'ID si vols, o treure'l --}}
          <span class="card__badge">ID: {{ $equip->id }}</span>
        </header>

        <div class="card__body">
          <p><strong>Estadi:</strong> {{ $equip->estadi->nom ?? 'Sense estadi' }}</p>
          <p><strong>Títols:</strong> {{ $equip->titols }}</p>
        </div>

        <footer class="card__footer">
          {{-- Botons d'Acció --}}
          <a class="btn btn--ghost" href="{{ route('equips.show', $equip) }}">Veure</a>
          <a class="btn btn--primary" href="{{ route('equips.edit', $equip) }}">Editar</a>

          {{-- Formulari per eliminar (opcional) --}}
          <form method="POST" action="{{ route('equips.destroy', $equip) }}" class="inline" onsubmit="return confirm('Segur que vols esborrar aquest equip?');">
            @csrf
            @method('DELETE')
            <button class="btn btn--danger" type="submit">Eliminar</button>
          </form>
        </footer>
      </article>
    @endforeach
  </div>
</div>
@endsection