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
        @slot('action_button')
            <a href="{{ route('classrooms.create') }}" class="btn add-btn">
                <i class="fa fa-plus"></i> Tambah Tahun Pelajaran Baru
            </a>
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
                            <label class="col-lg-3 col-form-label">Nama Kelas<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input name="name" class="form-control" type="text"
                                    value="{{ old('name', $classroom->name) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Program Keahlian<span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input name="vocational_program" class="form-control" type="text"
                                    value="{{ old('vocational_program', $classroom->vocational_program) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Program Kompetensi<span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input name="vocational_competency" class="form-control" type="text"
                                    value="{{ old('vocational_competency', $classroom->vocational_competency) }}">
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
