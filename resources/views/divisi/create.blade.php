@extends('layouts.user')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Divisi</h1>
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
                <h4>Tambah Divisi</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.divisi.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="divisi">Divisi</label>
                        <select name="divisi" id="divisi" class="form-control @error('divisi') is-invalid @enderror">
                            <option value="" selected>Pilih Divisi</option>
                            @foreach ($divisiCollection as $divisi)
                            <option value="{{ $divisi->id }}" @if ($divisi->id == old('divisi')) selected
                                @endif>{{ $divisi->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Bagian</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" required
                            value="{{ old('nama') }}">
                        @error('nama')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
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
