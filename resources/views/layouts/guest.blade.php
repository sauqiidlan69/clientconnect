@extends('layouts.base')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @include('components.alerts')
            @yield('content')
        </div>
    </div>
</div>
@endsection
