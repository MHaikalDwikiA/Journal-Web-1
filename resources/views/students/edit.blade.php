@section('title', 'Edit Siswa')

@extends('layout.mainlayout')
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
                                <select name="gender"
                                    class="select select2-hidden-accessible @error('gender') is-invalid @enderror">
                                    <option selected disabled>Pilih Kelamin Kalian</option>
                                    <option @if (old('gender', $student->gender) === 'Laki-laki') selected @endif>Laki-laki</option>
                                    <option @if (old('gender', $student->gender) === 'Perempuan') selected @endif>Perempuan</option>
                                </select>
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
                                <select name="user_id" class="form-control">
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
                                    class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a class="btn btn-secondary" href="{{ route('students.index') }}">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
