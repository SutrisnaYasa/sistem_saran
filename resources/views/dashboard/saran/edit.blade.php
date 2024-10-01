{{-- tambahan dari bagus --}}
@extends('layouts.user')

@section('css-libraries')
<link rel="stylesheet" href="{{ asset('css/chocolat.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Saran</h1>
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
                <h4>Saran - {{ $saran->topik_saran }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.saran.update', $saran->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="divisi">Topik</label>
                        <input type="text" name="name" class="form-control @error('divisi') is-invalid @enderror" disabled required
                            value="{{ $saran->topik_saran }}">
                        @error('divisi')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="saran">Saran</label>
                        <textarea  type="text" name="saran" class="form-control @error('saran') is-invalid @enderror"disabled required
                            value="{{ $saran->saran }}">{{ $saran->saran }}</textarea>
                        @error('saran')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="nama_pengirim">Nama Pengirim</label>
                                <input type="text" name="nama_pengirim" class="form-control @error('nama_pengirim') is-invalid @enderror"
                                disabled value="{{ $saran->nama_pengirim }}">
                                @error('nama_pengirim')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror"
                                disabled value="{{ $saran->telepon }}">
                                @error('telepon')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="telepon">Bukti</label>
                                <div class="gallery">
                                    <div class="gallery-item"
                                        data-image="{{ asset('uploads/' . $saran->file_bukti) }}"
                                        data-title="Image 1" href="{{ asset('uploads/'. $saran->file_bukti) }}"
                                        title="{{ $saran->file_bukti }}"
                                        style="background-image: url({{ asset('uploads/'. $saran->file_bukti) }});">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                    
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" required
                            class="form-control @error('status') is-invalid @enderror">
                            @if ($saran->status == 0)
                            <option value="{{ $saran->status }}" selected>Pending</option>
                            <option value="1">Done</option>
                            <option value="2" >Rejected</option>
                            <option value="3" >Progress</option>
                            @elseif($saran->status == 1)
                            <option value="0" >Pending</option>
                            <option value="{{ $saran->status }}" selected>Done</option>
                            <option value="2" >Rejected</option>
                            <option value="3" >Progress</option>
                            @elseif($saran->status == 2)
                            <option value="0">Pending</option>
                            <option value="1">Done</option>
                            <option value="{{ $saran->status }}" selected>Rejected</option>
                            <option value="3" >Progress</option>
                            @elseif($saran->status == 3)
                            <option value="0">Pending</option>
                            <option value="1">Done</option>
                            <option value="2">Rejected</option>
                            <option value="{{ $saran->status }}" selected >Progress</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tindak_lanjut">Follow-up</label>
                        <textarea  type="text" name="tindak_lanjut" class="form-control @error('tindak_lanjut') is-invalid @enderror" required
                            value="{{ $saran->tindak_lanjut }}">{{ $saran->tindak_lanjut }}</textarea>
                        @error('tindak_lanjut')
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

@section('js-libraries')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
@endsection

@section('script')
<script src="{{ asset('js/jquery.chocolat.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#table').dataTable({
            order: []
        });
    });
</script>
@endsection
