@extends('layouts.base')

@section('template')
<div class="main-wrapper main-wrapper-1">
    @include('layouts.dashboard.navbar')
    @include('layouts.dashboard.sidebar')
    <div class="main-content">
        @yield('content')
    </div>
    <footer class="main-footer">
        <div class="footer-left">
        </div>
        <div class="footer-right">
            Made with <i class="fas fa-heart text-danger"></i> by PPTI STMIK Primakara
        </div>
    </footer>
</div>
@endsection
