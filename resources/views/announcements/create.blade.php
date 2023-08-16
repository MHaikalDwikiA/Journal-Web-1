@section('title', 'Tambah Pengumuman')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Pengumuman
        @endslot
        @slot('li_1')
            Pengumuman
        @endslot
        @slot('li_2')
            Form Tambah Baru
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card">
                <form action="{{ route('announcements.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tanggal <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="date" name="date"
                                    class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}">
                                <div class="invalid-feedback">
                                    @error('date')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Judul <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                                <div class="invalid-feedback">
                                    @error('title')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Deskripsi <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                <div class="invalid-feedback">
                                    @error('description')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <span class="text-muted float-start">
                            <strong class="text-danger">*</strong> Harus diisi
                        </span>
                        <a class="btn btn-secondary" href="{{ route('announcements.index') }}">Kembali</a>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
