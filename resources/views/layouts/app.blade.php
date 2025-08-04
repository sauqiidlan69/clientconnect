@extends('layouts.base')

@section('title', 'CRM Application')

@section('content')
<div class="container py-4">
    @include('components.alerts')
    @yield('page-content')
</div>
@endsection
