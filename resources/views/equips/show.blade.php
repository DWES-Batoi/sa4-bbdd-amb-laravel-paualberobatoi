@extends('layouts.app')

@section('title', __("Detall d'Equip"))

@section('content')
    <div style="margin-bottom: 2rem;">
        <x-equip :equip="$equip" />
    </div>

    @auth
        <div class="flex gap-4">
            @if(auth()->user()->role === 'admin' || (auth()->user()->role === 'manager' && auth()->user()->equip_id === $equip->id))
                <a href="{{ route('equips.edit', $equip) }}" class="btn btn--primary">{{ __('Editar') }}</a>
            @endif
            
            <a href="{{ route('equips.index') }}" class="btn btn--ghost">{{ __('Tornar al llistat') }}</a>
        </div>
    @endauth
@endsection