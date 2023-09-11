@section('title', 'Tahun Pelajaran')
@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Pengguna
        @endslot
        @slot('li_1')
            Pengguna
        @endslot
        @slot('li_2')
            Tahun Pelajaran Ubah
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card">
                <form method="POST" action="{{ route('school-years.update', $schoolYear->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tahun Pelajaran <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="name"
                                    class="js-example-basic-single form-control @error('name') is-invalid @enderror"
                                    required>
                                    @php
                                        $currentYear = date('Y');
                                        $yearsRange = range($currentYear, $currentYear + 10);
                                    @endphp
                                    @foreach ($yearsRange as $year)
                                        @php
                                            $nextYear = $year + 1;
                                            $academicYear = $year . '/' . $nextYear;
                                        @endphp
                                        <option value="{{ $academicYear }}"
                                            {{ old('name', $schoolYear->name) == $academicYear ? 'selected' : '' }}>
                                            {{ $academicYear }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama Kepala Sekolah<span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="headmaster_name" maxlength="255" minlength="5"
                                    class="form-control @error('headmaster_name') is-invalid @enderror"
                                    value="{{ old('headmaster_name', $schoolYear->headmaster_name) }}">
                                <div class="invalid-feedback">
                                    @error('headmaster_name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label class="col-lg-3 col-form-label">Status</label>
                            <div class="col-lg-9">
                                <select class="form-control" name="is_active">
                                    <option value="0"
                                        {{ old('is_active', $schoolYear->is_active) == 0 ? 'selected' : '' }}>Tidak Aktif
                                    </option>
                                    <option value="1"
                                        {{ old('is_active', $schoolYear->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <span class="text-muted float-start">
                            <strong class="text-danger">*</strong> Harus diisi
                        </span>
                        <a class="btn btn-secondary" href="{{ route('school-years.index') }}">Kembali</a>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
