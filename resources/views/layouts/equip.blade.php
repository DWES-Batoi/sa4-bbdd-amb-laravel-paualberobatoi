{{-- resources/views/layouts/equip.blade.php --}}
<x-app-layout>
    {{-- Slot para el título que aparece en la barra superior blanca --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @yield('title', 'Guia de Futbol Femení')
        </h2>
    </x-slot>

    {{-- Mensajes de éxito del sistema --}}
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
    </div>

    {{-- Contenedor principal de tus vistas (Equips, Jugadoras, etc.) --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    {{-- Footer opcional dentro del diseño --}}
    <footer class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-8 text-center text-gray-500 text-sm">
        <p>&copy; {{ date('Y') }} Guia de Futbol Femení</p>
    </footer>
</x-app-layout>