@extends('layouts.user')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Profile</h1>
    </div>
    <div class="section-body">
        @if (session('error') || session('success'))
        <div
            class="alert @if(session('error')) alert-danger @else alert-primary @endif alert-has-icon alert-dismissible show fade">
            <div class="alert-icon"><i class="fas @if(session('error')) fa-times @else fa-check @endif"></i></div>
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                @if (session('error'))
                <div class="alert-title">Gagal</div>
                {{ session('error') }}
                @else
                <div class="alert-title">Berhasil</div>
                {{ session('success') }}
                @endif
            </div>
        </div>
        @endif
        <div class="card card-primary">
            <div class="card-header">
                <h4>Ubah Profile</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.profile.store') }}" method="POSt">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" disabled value="{{ $user->username }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ $user->name }}">
                        @error('name')
                        <span class="invalid-feedbak">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="section-title">Ganti Password</div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="new_password">Password Baru</label>
                        <input type="password" name="new_password" class="form-control">
                    </div>
                    <input type="submit" id="submit" value="submit" class="d-none">
                </form>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary btn-icon icon-left"
                    onclick="document.getElementById('submit').click();"><i class="fas fa-save"></i> Simpan
                    Perubahan</button>
            </div>
        </div>
    </div>
</section>
@endsection
