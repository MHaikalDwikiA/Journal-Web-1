@section('title', 'Ubah Pengumuman')
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
            Form Ubah Pengumuman
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card">
                <form action="{{ route('announcements.update', $announcement->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tanggal <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="date" name="date"
                                    class="form-control @error('date') is-invalid @enderror"
                                    value="{{ old('date', $announcement->date) }}">
                                <div class="invalid-feedback">
                                    @error('date')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Judul <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="title" class="form-control"
                                    @error('title') is-invalid @enderror value="{{ old('title', $announcement->title) }}">
                                <div class="invalid-feedback">
                                    @error('title')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Deskripsi <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <textarea rows="5" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description', $announcement->description) }}</textarea>
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
