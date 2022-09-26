@extends('layouts.user')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Semua Saran</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalSaran }}
                    </div>
                </div>
            </div>
        </div>
        @if(Auth::user()->isAdmin())
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Divisi</th>
                                    <th>Total Saran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($totalSaranPerDivisi as $saran)
                                <tr>
                                    <td>
                                        <a
                                            href="{{ route('dashboard.saran.show', $saran->divisi_id) }}">{{ $saran->divisi }}</a>
                                    </td>
                                    <td>{{ $saran->total_saran }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @enderror
    </div>
</section>
@endsection
