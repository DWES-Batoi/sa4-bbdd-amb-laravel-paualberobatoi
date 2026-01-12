@extends('layouts.app')

@section('title', 'Llistat d\'Estadis')

@section('content')
<div class="container">
  {{-- Cabecera con Título y Botón de Añadir --}}
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
      <h1 class="title">Llistat d'Estadis</h1>
      <a class="btn btn--primary" href="{{ route('estadis.create') }}">Afegir Estadi</a>
  </div>

  <div class="grid-cards">
    @foreach ($estadis as $estadi)
      <article class="card">
        <header class="card__header">
          <h2 class="card__title">{{ $estadi->nom }}</h2>
          <span class="card__badge">ID: {{ $estadi->id }}</span>
        </header>

        <div class="card__body">
          <p><strong>Capacitat:</strong> {{ number_format($estadi->capacitat) }} espectadors</p>
          {{-- Si quieres mostrar cuántos equipos juegan aquí, puedes descomentar esto: --}}
          {{-- <p><strong>Equips:</strong> {{ $estadi->equips->count() }}</p> --}}
        </div>

        <footer class="card__footer">
          {{-- Botones de Acción --}}
          <a class="btn btn--ghost" href="{{ route('estadis.show', $estadi) }}">Veure</a>
          <a class="btn btn--primary" href="{{ route('estadis.edit', $estadi) }}">Editar</a>

          {{-- Formulario de Eliminar (Opcional, según tu ejemplo) --}}
          <form method="POST" action="{{ route('estadis.destroy', $estadi) }}" class="inline" onsubmit="return confirm('Estàs segur de voler esborrar aquest estadi?');">
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