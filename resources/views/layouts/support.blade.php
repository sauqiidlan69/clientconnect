@extends('layouts.app')

@push('styles')
<style>
    .support-panel {
        background-color: #f8f9fa;
    }
</style>
@endpush

@section('content')
<div class="support-panel">
    @yield('content')
</div>
@endsection