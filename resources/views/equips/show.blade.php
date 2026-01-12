@extends('layouts.app')
@section('title', "Detall d'Equip")

@section('content')
    <x-equip :equip="$equip" />
@endsection