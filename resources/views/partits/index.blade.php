@extends('layouts.equip')

@section('title', __('Calendari de Partits'))

@section('content')
<div class="container">
  {{-- Capçalera amb Títol i Botó d'Afegir --}}
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
      <h1 class="title">{{ __('Calendari de Partits') }}</h1>
      <a class="btn btn--primary" href="{{ route('partits.create') }}">{{ __('Nou Partit') }}</a>
  </div>

  <div class="grid-cards">
    @foreach ($partits as $partit)
      <article class="card">
        <header class="card__header">
          {{-- Títol: Local vs Visitant --}}
          <h2 class="card__title" style="font-size: 1rem;">
            {{ $partit->local->nom }} <span style="color: #888;">vs</span> {{ $partit->visitant->nom }}
          </h2>
          {{-- Badge: Data --}}
          <span class="card__badge">{{ \Carbon\Carbon::parse($partit->data)->format('d/m') }}</span>
        </header>

        <div class="card__body">
          {{-- Resultat destacat al mig --}}
          <div style="text-align: center; margin-bottom: 0.5rem;">
            @if($partit->gols_local !== null)
                <span style="font-size: 1.5rem; font-weight: bold; color: #1e3a8a;">
                    {{ $partit->gols_local }} - {{ $partit->gols_visitant }}
                </span>
            @else
                <span style="color: gray; font-style: italic; font-weight: bold;">-- vs --</span>
            @endif
          </div>

          <p><strong>{{ __('Hora') }}:</strong> {{ \Carbon\Carbon::parse($partit->data)->format('H:i') }}</p>
          <p><strong>{{ __('Estadi') }}:</strong> {{ $partit->estadi->nom ?? __('Desconegut') }}</p>
        </div>

        <footer class="card__footer">
          {{-- Botons d'Acció --}}
          <a class="btn btn--ghost" href="{{ route('partits.show', $partit) }}">{{ __('Veure') }}</a>
          <a class="btn btn--primary" href="{{ route('partits.edit', $partit) }}">{{ __('Editar') }}</a>

          {{-- Formulari per eliminar --}}
          <form method="POST" action="{{ route('partits.destroy', $partit) }}" class="inline" onsubmit="return confirm('{{ __('Segur que vols esborrar aquest partit?') }}');">
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