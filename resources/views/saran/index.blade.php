@extends('layouts.default')

@section('style')
<style>
    .spinner-container {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.3);
        z-index: 3;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .spinner-grow {
        height: 4rem;
        width: 4rem;
    }
</style>
@endsection

@section('content')
<div class="spinner-container d-none">
    <div class="spinner-grow text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
@if (session('message'))
<div class="alert alert-danger alert dismissible show fade">
    {{ session('message')}}
</div>
@endif
<div class="card card-primary">
    <div class="card-header">
        <h4>Form Pengajuan Saran</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('saran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="divisi">Divisi</label>
                <select name="divisi" class="form-control @error('divisi') is-invalid @enderror divisi">
                    <option value="" selected disabled>Pilih Divisi</option>
                    @foreach ($divisiCollection as $divisi)
                    <option value="{{ $divisi->id }}" @if(old('divisi')==$divisi->id) selected
                        @endif>{{ $divisi->nama }}</option>
                    @endforeach
                </select>
                @error('divisi')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="sub_divisi">Sub Divisi</label>
                <select name="sub_divisi" class="form-control @error('sub_divisi') is-invalid @enderror sub-divisi">
                    <option value="" selected disabled>Pilih Sub Divisi</option>
                    @if (old('sub_divisi'))
                    @foreach (session('subDivisiCollection') as $subDivisi)
                    <option value="{{ $subDivisi->id }}" @if (old('sub_divisi')==$subDivisi->id) selected
                        @endif>{{ $subDivisi->nama }}</option>
                    @endforeach
                    @endif
                </select>
                @error('sub_divisi')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="topik_saran">Topik Saran</label>
                <input type="text" class="form-control @error('topik_saran') is-invalid @enderror" name="topik_saran"
                    placeholder="Contoh: Kebersihan" value="{{ old('topik_saran') }}">
                @error('topik_saran')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="saran">Keluhan/Saran</label>
                <textarea name="saran" cols="30" rows="10"
                    class="form-control @error('saran') is-invalid @enderror" placeholder="Keluhan, Waktu terjadinya keluhan, Deskripsi/Alur secara rinci">{{ old('saran') }}</textarea>
                @error('saran')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="bukti_pendukung">Bukti Pendukung <span class="font-weight-bold">( Jika ada )</span></label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="bukti-pendukung" name="bukti_pendukung"
                        accept="image/*">
                    <label class="custom-file-label" for="bukti_pendukung" id="bukti_pendukung_label">Pilih File</label>
                </div>
                <span class="font-weight-bold d-flex mt-3">
                    *Adanya bukti pendukung akan memudahkan manajemen untuk melakukan tindakan perbaikan dengan segera.
                </span>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input identitas-checkbox" id="identitas-checkbox">
                <label class="custom-control-label" for="identitas-checkbox">Cantumkan identitas</label>
            </div>
            <div class="identitas-container mt-3 d-none">
                <div class="form-group">
                    <label for="nama_pengirim">Nama Pengirim</label>
                    <input type="text" class="form-control" name="nama_pengirim" placeholder="Made Doe"
                        value="{{ old('nama_pengirim') }}">
                </div>
                <div class="form-group">
                    <label for="telepon">Telepon/Whatsapp</label>
                    <input type="tel" class="form-control @error('telepon') is-invalid @enderror" name="telepon"
                        placeholder="6281987654321" value="{{ old('telepon') }}">
                    @error('telepon')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <input type="submit" id="submit" class="d-none">
        </form>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary btn-block g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"
            data-callback='onSubmit' data-action='sumbit'>Kirim Saran</button>
    </div>
</div>
@endsection

@section('script')
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    function onSubmit(token) {
        document.querySelector('.spinner-container').classList.remove('d-none');
        document.getElementById('submit').click();
    }
</script>
<script>
    $(document).ready(function() {
        const identitasCheckbox = $('.identitas-checkbox');
        const identitasContainer = $('.identitas-container');

        identitasCheckbox.change(function() {
            const isChecked = $(this).is(':checked');
            if(isChecked) {
                identitasContainer.removeClass('d-none');
            } else {
                identitasContainer.addClass('d-none');
                $('input[name="nama_pengirim"]').val("");
                $('input[name="telepon"]').val("");
            }
        });

        const divisiSelect = $('.divisi');
        const subDivisiSelect = $('.sub-divisi');
        const spinner = $('.spinner-container');

        divisiSelect.change(function() {
            const divisiId = $(this).val();
            spinner.removeClass('d-none');
            $.get("{{ route('divisi.ajax.sub_divisi') }}/" + divisiId)
            .done(function(res) {
                let subDivisiOptions =  '<option value="" selected disabled>Pilih Sub Divisi</option>';
                res.data.forEach(divisi => {
                    subDivisiOptions += '<option value="'+ divisi.id +'">'+ divisi.nama +'</option>';
                });
                subDivisiSelect.html(subDivisiOptions);
            }).fail(function(err) {
                console.error(err);
            }).always(function() {
                spinner.addClass('d-none');
            });
        });

        const buktiPendukungInput = $('#bukti-pendukung');
        buktiPendukungInput.change(function() {
            const fileName = $(this)[0].files[0].name;
            $(this).next('.custom-file-label').html(fileName);
        })
    });
</script>
@endsection
