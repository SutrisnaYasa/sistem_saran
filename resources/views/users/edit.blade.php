@extends('layouts.user')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Users</h1>
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
                <h4>Tambah users</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="divisi">Divisi</label>
                        <select name="divisi" id="divisi" required
                            class="form-control @error('divisi') is-invalid @enderror">
                            <option value="" selected>Pilih Divisi</option>
                            @foreach ($divisiCollection as $divisi)
                            <option value="{{ $divisi->id }}" @if ($divisi->id == $user->divisi_id) selected
                                @endif>{{ $divisi->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required
                            value="{{ $user->name }}">
                        @error('name')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">username</label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                            required value="{{ $user->username }}">
                        @error('username')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name="password" class="form-control @error('password') is-invalid @enderror"
                            value="{{ old('password') }}">
                        @error('password')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="akses">Hak akses admin</label>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="akses" id="akses" value="1"
                                @if($user->akses == 1) checked @endif>
                            <label class="custom-control-label" for="akses">Admin</label>
                        </div>
                    </div>
                    <input type="submit" value="submit" id="submit" class="d-none">
                </form>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary btn-icon icon-left"
                    onclick="document.getElementById('submit').click();"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</section>
@endsection
