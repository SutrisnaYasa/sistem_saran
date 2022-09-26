@extends('layouts.user')

@section('css-libraries')
<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
@endsection

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
                <h4>Daftar Divisi</h4>
                <div class="card-header-action">
                    <a href="{{ route('dashboard.divisi.create') }}" class="btn btn-primary btn-icon icon-left">
                        <i class="fas fa-plus"></i> Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Bagian</th>
                                <th>Divisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($divisiCollection as $divisi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $divisi->nama }}</td>
                                <td>{{ $divisi->parent_divisi ?? '' }}</td>
                                <td>
                                    <a href="{{ route('dashboard.divisi.edit', $divisi->id) }}" data-toggle="tooltip"
                                        data-original-title="Edit bagian"
                                        class="btn btn-warning btn-sm btn-icon icon-only"><i
                                            class="fas fa-fw fa-edit"></i></a>
                                    <form action="{{ route('dashboard.divisi.destroy', $divisi->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" data-toggle="tooltip" data-original-title="Hapus bagian"
                                            class="btn btn-danger btn-sm btn-icon icon-only"
                                            onclick="return confirm('Hapus {{ $divisi->nama }}?');"><i
                                                class="fas fa-fw fa-times"></i></button>
                                    </form>
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
<script>
    $(document).ready(function() {
        $('#table').dataTable({
            order: []
        });
    });
</script>
@endsection
