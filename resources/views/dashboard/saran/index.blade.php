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
        <div class="card card-primary">
            <div class="card-header">
                <h4>Daftar Saran</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Divisi</th>
                                <th>Topik</th>
                                <th>Saran</th>
                                <th>Bukti</th>
                                <th>Pengirim</th>
                                <th>Tanggal Pelaporan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($saranCollection as $saran)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @if(Auth::user()->isAdmin())
                                <td>
                                    <a
                                        href="{{ route('dashboard.saran.show', $saran->divisi->id) }}">{{ @$saran->divisi->nama }}</a>
                                </td>
                                @else
                                <td>{{ @$saran->divisi->nama }}</td>
                                @endif
                                <td>{{ $saran->topik_saran }}</td>
                                <td>{{ $saran->saran }}</td>
                                <td>
                                    <div class="gallery">
                                        <div class="gallery-item"
                                            data-image="{{ asset('uploads/' . $saran->file_bukti) }}"
                                            data-title="Image 1" href="{{ asset('uploads/'. $saran->file_bukti) }}"
                                            title="{{ $saran->file_bukti }}"
                                            style="background-image: url({{ asset('uploads/'. $saran->file_bukti) }});">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ @$saran->nama_pengirim }} / <a href="https://wa.me/{{ @$saran->telepon }}"
                                        target="_blank">{{ @$saran->telepon }}</a>
                                </td>
                                <td>
                                    {{ date('j F Y', strtotime($saran->created_at))}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
