@section('title', 'Edit Sekolah')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Profil Sekolah
        @endslot
        @slot('li_1')
            Sekolah
        @endslot
        @slot('li_2')
            Form Ubah
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card">
                <form action="{{ route('school.update', $school->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $school->name) }}">
                                <div class="invalid-feedback">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">NPSN <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="npsn"
                                    class="form-control @error('npsn') is-invalid @enderror"
                                    value="{{ old('npsn', $school->npsn) }}">
                                <div class="invalid-feedback">
                                    @error('npsn')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Alamat <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="address"
                                    class="form-control @error('address') is-invalid @enderror"
                                    value="{{ old('address', $school->address) }}">
                                <div class="invalid-feedback">
                                    @error('address')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Kelurahan <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="kelurahan"
                                    class="form-control @error('kelurahan') is-invalid @enderror"
                                    value="{{ old('kelurahan', $school->kelurahan) }}">
                                <div class="invalid-feedback">
                                    @error('kelurahan')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Kecamatan <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="kecamatan"
                                    class="form-control @error('kecamatan') is-invalid @enderror"
                                    value="{{ old('kecamatan', $school->kecamatan) }}">
                                <div class="invalid-feedback">
                                    @error('kecamatan')
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
                        <a class="btn btn-secondary" href="{{ route('school.index') }}">Kembali</a>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
