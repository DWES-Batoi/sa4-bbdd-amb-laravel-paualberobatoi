@extends('layouts.app')

@section('title', "Detall d'Equip")

@section('content')
    <div style="margin-bottom: 2rem;">
        <x-equip :equip="$equip" />
    </div>

    @auth
        <div class="flex gap-4">
            {{-- Permiso de edición --}}
            @if(auth()->user()->role === 'admin' || (auth()->user()->role === 'manager' && auth()->user()->equip_id === $equip->id))
                <a href="{{ route('equips.edit', $equip) }}" class="btn btn--primary">Editar dades</a>
            @endif
            
            <a href="{{ route('equips.index') }}" class="btn btn--ghost">Tornar al llistat</a>
        </div>
    @endauth
@endsection