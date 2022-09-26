@extends('layouts.default')

@section('style')
<style>
    p.thankyout {
        font-size: 1.1em;
    }
</style>
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4>Pengajuan Saran Berhasil</h4>
    </div>
    <div class="card-body d-flex flex-column align-items-center">
        <img src="{{ asset('img/thankyou.svg') }}" alt="Thank You" class="w-75">
        <p class="my-3 text-center thankyou">Terima Kasih telah memberi saran untuk <strong class="text-primary">STMIK
                Primakara</strong>
            yang lebih baik.
        </p>
        <a href="{{ route('saran.index') }}" class="btn btn-primary btn-icon icon-left"><i
                class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-footer">
    </div>
</div>
@endsection
