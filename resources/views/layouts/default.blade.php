@extends('layouts.base')

@section('template')
<section class="section">
    <div class="container mt-3">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2">
                <div class="login-brand">
                    <img src="{{ asset('img/logo.png') }}" alt="logo" width="200">
                </div>
                @yield('content')
                <div class="simple-footer">
                    Made with <i class="fas fa-heart text-danger"></i> by PPTI STMIK Primakara
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
