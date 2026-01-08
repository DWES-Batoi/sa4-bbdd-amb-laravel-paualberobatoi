<nav>
  <ul class="flex space-x-4">
    <li><a class="text-white hover:underline" href="/">Inici</a></li>

    {{-- Opcional: activarem l'enllaç d'equips quan el service estiga creat --}}
    <li><a class="text-white hover:underline" href="{{ route('equips.index') }}">Guia d'Equips</a></li>

    <li><a class="text-white hover:underline" href="{{ route(name: 'estadis.index') }}">Llistat d'Estadis</a></li>

    <li><a class="text-white hover:underline" href="{{ route(name: 'jugadoras.index') }}">Llistat de Jugadores</a></li>

    <li><a class="text-white hover:underline" href="{{ route('partits.index') }}">Calendari de Partits</a></li>

  </ul>
</nav>