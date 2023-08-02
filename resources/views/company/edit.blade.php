@section('title', 'Edit Perusahaan')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Perusahaan
        @endslot
        @slot('li_1')
            Perusahaan
        @endslot
        @slot('li_2')
            Form Ubah
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card">
                <form action="{{ route('companies.update', $company->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="name" maxlength="255" minlength="5"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $company->name) }}">
                                <div class="invalid-feedback">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Alamat <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <textarea name="address" rows="5" class="form-control @error('address') is-invalid @enderror">{{ old('address', $company->address) }}</textarea>
                                <div class="invalid-feedback">
                                    @error('address')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Direktur Perusahaan <span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="director" maxlength="255" minlength="5"
                                    class="form-control @error('director') is-invalid @enderror"
                                    value="{{ old('director', $company->director) }}">
                                <div class="invalid-feedback">
                                    @error('director')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label class="col-lg-3 col-form-label">Status</label>
                            <div class="col-lg-9">
                                <select class="form-control" name="is_active">
                                    <option value="0" @if (old('is_active', $company->is_active) == 0) selected @endif>Tidak Aktif
                                    </option>
                                    <option value="1" @if (old('is_active', $company->is_active) == 1) selected @endif>Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <span class="text-muted float-start">
                            <strong class="text-danger">*</strong> Harus diisi
                        </span>
                        <a class="btn btn-secondary" href="{{ route('companies.index') }}">Kembali</a>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
