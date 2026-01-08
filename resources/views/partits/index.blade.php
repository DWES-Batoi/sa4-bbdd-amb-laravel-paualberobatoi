@extends('layouts.app')
@section('title', "Calendari de Partits")

@section('content')
<h1 class="text-3xl font-bold text-blue-800 mb-6">Calendari de la Lliga</h1>

@if (session('success'))
  <div class="bg-green-100 text-green-700 p-2 mb-4">{{ session('success') }}</div>
@endif

{{-- Botó per afegir nou partit --}}
<p class="mb-4">
  <a href="{{ route('partits.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-700">
    Nou Partit
  </a>
</p>

<table class="w-full border-collapse border border-gray-300">
  <thead class="bg-gray-200">
    <tr>
      <th class="border border-gray-300 p-2 text-left">Data</th>
      <th class="border border-gray-300 p-2 text-right">Local</th>
      <th class="border border-gray-300 p-2 text-center">Resultat</th>
      <th class="border border-gray-300 p-2 text-left">Visitant</th>
      <th class="border border-gray-300 p-2 text-left">Estadi / Detalls</th>
    </tr>
  </thead>
  <tbody>
  @foreach($partits as $partit)
    <tr class="hover:bg-gray-100">
      <td class="border border-gray-300 p-2 text-sm">
        {{ \Carbon\Carbon::parse($partit->data)->format('d/m/Y H:i') }}
      </td>
      <td class="border border-gray-300 p-2 text-right font-bold">
        {{ $partit->local->nom }}
      </td>
      <td class="border border-gray-300 p-2 text-center bg-gray-50">
        @if($partit->gols_local !== null)
            <span class="text-lg font-mono font-bold">{{ $partit->gols_local }} - {{ $partit->gols_visitant }}</span>
        @else
            <span class="text-gray-400 italic">vs</span>
        @endif
      </td>
      <td class="border border-gray-300 p-2 text-left font-bold">
        {{ $partit->visitant->nom }}
      </td>
      <td class="border border-gray-300 p-2 text-sm text-gray-600">
        {{-- Enllaç al SHOW del partit --}}
        <a href="{{ route('partits.show', $partit->id) }}" class="text-blue-700 hover:underline font-semibold">
          {{ $partit->estadi->nom }} (Veure Fitxa)
        </a>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection