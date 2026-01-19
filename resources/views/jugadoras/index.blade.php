@extends('layouts.equip')

@section('title', __('Llistat de Jugadores'))

@section('content')
<div class="container">
  {{-- Capçalera amb Títol i Botó d'Afegir --}}
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
      <h1 class="title">{{ __('Llistat de Jugadores') }}</h1>
      <a class="btn btn--primary" href="{{ route('jugadoras.create') }}">{{ __('Nova Jugadora') }}</a>
  </div>

  <div class="grid-cards">
    @foreach ($jugadoras as $jugadora)
      <article class="card">
        <header class="card__header">
          <h2 class="card__title">{{ $jugadora->nom }}</h2>
          {{-- Posem el Dorsal com a "badge" --}}
          <span class="card__badge">#{{ $jugadora->dorsal }}</span>
        </header>

        <div class="card__body">
          <p><strong>{{ __('Equip') }}:</strong> {{ $jugadora->equip->nom ?? __('Sense equip') }}</p>
          {{-- Si tens la data de naixement i la vols mostrar: --}}
          {{-- <p><strong>Edat:</strong> {{ \Carbon\Carbon::parse($jugadora->data_naixement)->age }} anys</p> --}}
        </div>

        <footer class="card__footer">
          {{-- Botons d'Acció --}}
          <a class="btn btn--ghost" href="{{ route('jugadoras.show', $jugadora) }}">{{ __('Veure') }}</a>
          <a class="btn btn--primary" href="{{ route('jugadoras.edit', $jugadora) }}">{{ __('Editar') }}</a>

          {{-- Formulari per eliminar --}}
          <form method="POST" action="{{ route('jugadoras.destroy', $jugadora) }}" class="inline" onsubmit="return confirm('{{ __('Segur que vols esborrar aquesta jugadora?') }}');">
            @csrf
            @method('DELETE')
            <button class="btn btn--danger" type="submit">{{ __('Eliminar') }}</button>
          </form>
        </footer>
      </article>
    @endforeach
  </div>
</div>
@endsection