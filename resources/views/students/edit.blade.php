@extends('layout.mainlayout')

@section('title', 'Edit Siswa')

@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Edit Siswa
        @endslot
        @slot('li_1')
            Siswa
        @endslot
        @slot('li_2')
            Edit Siswa
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card">
                <form method="POST" action="{{ route('students.update', $student->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tahun Pelajaran<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="school_year_id" class="select select2-hidden-accessible">
                                    @foreach ($schoolYears as $year)
                                        <option value="{{ $year->id }}">{{ $year->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Kelas<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="classroom_id" class="select select2-hidden-accessible">
                                    @foreach ($classrooms as $classroom)
                                        <option value="{{ $classroom->id }}">{{ $classroom->name }}
                                            {{ $classroom->vocational_program }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">NIS<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="identity" class="form-control" value="{{ $student->identity }}"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="name" class="form-control" value="{{ $student->name }}"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="gender" class="form-control" value="{{ $student->gender }}"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nomer Handphone<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="phone" class="form-control" value="{{ $student->phone }}"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">User<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="user_id" class="form-control" disabled>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ $student->user_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->username }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Password<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" value="{{ $hashed_random_password }}" name="password_hint"
                                    class="form-control" readonly required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a class="btn btn-secondary" href="{{ route('students.index') }}">Kembali</a>
                        <button class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
