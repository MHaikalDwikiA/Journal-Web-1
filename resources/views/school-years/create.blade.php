@section('title', 'Tahun Pelajaran')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Tahun Pelajaran
        @endslot
        @slot('li_1')
            Tahun Pelajaran
        @endslot
        @slot('li_2')
            Form Tambah Tahun Pelajaran Baru
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card">
                <form method="POST" action="{{ route('school-years.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tahun Pelajaran <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="name"
                                    class="select select2-hidden-accessible @error('name') is-invalid @enderror" required>
                                    @php
                                        $currentYear = date('Y');
                                        $yearsRange = range($currentYear, $currentYear + 5);
                                    @endphp
                                    @foreach ($yearsRange as $year)
                                        @php
                                            $nextYear = $year + 1;
                                            $academicYear = $year . '/' . $nextYear;
                                        @endphp
                                        <option value="{{ $academicYear }}"
                                            {{ old('name') == $academicYear ? 'selected' : '' }}>
                                            {{ $academicYear }}
                                        </option>
                                    @endforeach
                                    <div class="invalid-feedback">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </div>
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
                                <input type="text" name="headmaster_name"
                                    class="form-control @error('headmaster_name') is-invalid @enderror"
                                    value="{{ old('headmaster_name') }}">
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
                                    <option value="0" @if (old('is_active') == 0) selected @endif>Tidak Aktif
                                    </option>
                                    <option value="1" @if (old('is_active') == 1) selected @endif>Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a class="btn btn-secondary" href="{{ route('school-years.index') }}">Kembali</a>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
