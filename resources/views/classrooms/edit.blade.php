@section('title', 'Kelas')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Kelas
        @endslot
        @slot('li_1')
            Kelas
        @endslot
        @slot('li_2')
            Form Edit Kelas Baru
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card">
                <form method="POST" action="{{ route('classrooms.update', $classroom->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tahun Pelajaran<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="school_year_id" class="select select2-hidden-accessible">
                                    @foreach ($schoolYears as $year)
                                        <option value="{{ $year->id }}"
                                            {{ old('school_year_id', $classroom->school_year_id) == $year->id ? 'selected' : '' }}>
                                            {{ $year->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tingkat Kelas<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="name" class="select select2-hidden-accessible">
                                    @foreach (['XI', 'XII'] as $kelas)
                                        <option value="{{ $kelas }}"
                                            @if (old('name', $classroom->name) === $kelas) selected @endif>
                                            {{ $kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Program Keahlian<span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="vocational_program"
                                    class="form-control @error('vocational_program') is-invalid @enderror"
                                    value="{{ old('vocational_program', $classroom->vocational_program) }}">
                                <div class="invalid-feedback">
                                    @error('vocational_program')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Program Kompetensi<span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="vocational_competency"
                                    class="form-control @error('vocational_competency') is-invalid @enderror"
                                    value="{{ old('vocational_competency', $classroom->vocational_competency) }}">
                                <div class="invalid-feedback">
                                    @error('vocational_competency')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a class="btn btn-secondary" href="{{ route('classrooms.index') }}">Kembali</a>
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
