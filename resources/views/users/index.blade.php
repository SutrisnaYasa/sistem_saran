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
                <h4>Daftar users</h4>
                <div class="card-header-action">
                    <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary btn-icon icon-left">
                        <i class="fas fa-plus"></i> Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Divisi</th>
                                <th>Akses</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->divisi->nama ?? '' }}</td>
                                <td>
                                    @if ($user->isAdmin())
                                    <div class="badge badge-primary">Admin</div>
                                    @else
                                    <div class="badge badge-info">User</div>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('dashboard.users.edit', $user->id) }}" data-toggle="tooltip"
                                        data-original-title="Edit user"
                                        class="btn btn-warning btn-sm btn-icon icon-only"><i
                                            class="fas fa-fw fa-edit"></i></a>
                                    <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" data-toggle="tooltip" data-original-title="Hapus user"
                                            class="btn btn-danger btn-sm btn-icon icon-only"
                                            onclick="return confirm('Hapus {{ $user->name }}?');"><i
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
