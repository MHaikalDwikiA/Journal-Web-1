@section('title', 'Notifikasi')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Notifikasi
        @endslot
        @slot('li_1')
            Notifikasi
        @endslot
        @slot('li_2')
            Form Tambah Notifikasi Baru
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card">
                <form action="{{ route('notifications.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tanggal<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="date" name="date" class="form-control @error('date') @enderror">
                                <div class="invalid-feedback">
                                    @error('date')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Judul<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror">
                                <div class="invalid-feedback">
                                    @error('title')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Deskripsi<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <textarea rows="5" name="description"
                                    class="form-control @error('description') is-invalid @enderror"></textarea>
                            </div>
                            <div class="invalid-feedback">
                                @error('description')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a class="btn btn-secondary" href="{{ route('notifications.index') }}">Kembali</a>
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
