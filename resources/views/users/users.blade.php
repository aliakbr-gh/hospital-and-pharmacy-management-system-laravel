@extends('layout.layout')

@section('title', 'Users')

@section('page-title', 'Users')

@section('content')
    <div class="text-center">
        <h1>Users</h1>
        {{ $users }}
    </div>
@endsection
