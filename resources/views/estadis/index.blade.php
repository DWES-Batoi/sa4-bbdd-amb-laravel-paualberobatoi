@extends('layouts.equip')

@section('title', __('Llistat d\'Estadis'))

@section('content')
<div class="container">
  {{-- Cabecera con Título y Botón de Añadir --}}
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
      <h1 class="title">{{ __('Llistat d\'Estadis') }}</h1>
      <a class="btn btn--primary" href="{{ route('estadis.create') }}">{{ __('Afegir Estadi') }}</a>
  </div>

  <div class="grid-cards">
    @foreach ($estadis as $estadi)
      <article class="card">
        <header class="card__header">
          <h2 class="card__title">{{ $estadi->nom }}</h2>
          <span class="card__badge">{{ __('ID') }}: {{ $estadi->id }}</span>
        </header>

        <div class="card__body">
          <p><strong>{{ __('Capacitat') }}:</strong> {{ number_format($estadi->capacitat) }} {{ __('espectadors') }}</p>
          {{-- Si quieres mostrar cuántos equipos juegan aquí, puedes descomentar esto: --}}
          {{-- <p><strong>Equips:</strong> {{ $estadi->equips->count() }}</p> --}}
        </div>

        <footer class="card__footer">
          {{-- Botones de Acción --}}
          <a class="btn btn--ghost" href="{{ route('estadis.show', $estadi) }}">{{ __('Veure') }}</a>
          <a class="btn btn--primary" href="{{ route('estadis.edit', $estadi) }}">{{ __('Editar') }}</a>

          {{-- Formulario de Eliminar (Opcional, según tu ejemplo) --}}
          <form method="POST" action="{{ route('estadis.destroy', $estadi) }}" class="inline" onsubmit="return confirm('{{ __('Estàs segur de voler esborrar aquest estadi?') }}');">
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