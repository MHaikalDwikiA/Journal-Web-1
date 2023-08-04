@section('title', 'Edit Pembimbing Sekolah')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Pembimbing Sekolah
        @endslot
        @slot('li_1')
            Pembimbing Sekolah
        @endslot
        @slot('li_2')
            Form Ubah
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card">
                <form action="{{ route('school-advisors.update', $advisor->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">NIP <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="identity"
                                    class="form-control @error('identity') is-invalid @enderror"
                                    value="{{ old('identity', $advisor->identity) }}">
                                <div class="invalid-feedback">
                                    @error('identity')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $advisor->name) }}">
                                <div class="invalid-feedback">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">No HP <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="phone"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ old('phone', $advisor->phone) }}">
                                <div class="invalid-feedback">
                                    @error('phone')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Alamat <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <textarea name="address" rows="5" class="form-control @error('address') is-invalid @enderror">{{ old('address', $advisor->address) }}</textarea>
                                <div class="invalid-feedback">
                                    @error('address')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">No HP <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="phone"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ old('phone', $advisor->phone) }}">
                                <div class="invalid-feedback">
                                    @error('phone')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Jenis kelamin</label>
                            <div class="col-lg-9">
                                <select name="gender" class="form-control">
                                    <option value="Laki-laki" @if (old('gender', $advisor->gender) == 'Laki-laki') selected @endif>Laki-laki
                                    </option>
                                    <option value="Perempuan" @if (old('gender', $advisor->gender) == 'Perempuan') selected @endif>Perempuan
                                    </option>
                                </select>
                                <div class="invalid-feedback">
                                    @error('gender')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label class="col-lg-3 col-form-label">Status</label>
                            <div class="col-lg-9">
                                <select class="form-control" name="is_active">
                                    <option value="0" @if (old('is_active', $advisor->is_active) == 0) selected @endif>Tidak Aktif
                                    </option>
                                    <option value="1" @if (old('is_active', $advisor->is_active) == 1) selected @endif>Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <span class="text-muted float-start">
                            <strong class="text-danger">*</strong> Harus diisi
                        </span>
                        <a class="btn btn-secondary" href="{{ route('school-advisors.index') }}">Kembali</a>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
