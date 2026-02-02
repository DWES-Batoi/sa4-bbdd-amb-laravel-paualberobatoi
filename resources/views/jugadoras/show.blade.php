@extends('layouts.app')

@section('title', __("Fitxa de la Jugadora"))

@section('content')
    <x-jugadora :jugadora="$jugadora" />

        @auth
            <div class="mt-8 flex gap-4 border-t pt-6">
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('jugadoras.edit', $jugadora) }}" class="btn btn--primary">{{ __('Editar Fitxa') }}</a>
                @endif
                
                <a href="{{ route('jugadoras.index') }}" class="btn btn--ghost">{{ __('Tornar al llistat') }}</a>
            </div>
        @endauth
    </div>
@endsection