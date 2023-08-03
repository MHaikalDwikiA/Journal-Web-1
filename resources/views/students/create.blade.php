@section('title', 'Siswa')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Siswa
        @endslot
        @slot('li_1')
            Siswa
        @endslot
        @slot('li_2')
            Form Tambah Siswa Baru
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card">
                <form method="POST" action="{{ route('students.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Kelas<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="classroom_id" class="select select2-hidden-accessible">
                                    @foreach ($classrooms as $classroom)
                                        <option value="{{ $classroom->id }}">{{ $classroom->name }} {{$classroom->vocational_program}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">NIS<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="identity" class="form-control @error('identity') is-invalid @enderror">
                                <div class="invalid-feedback">@error('identity') {{ $message }} @enderror</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                            </div>
                            <div class="invalid-feedback">@error('name') {{ $message }} @enderror</div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="gender" class="select select2-hidden-accessible @error('gender') is-invalid @enderror">
                                    <option selected disabled>Pilih Kelamin Kalian</option>
                                    <option>Laki-laki</option>
                                    <option>Perempuan</option>
                                </select>
                            </div>
                            <div class="invalid-feedback">@error('gender') {{ $message }} @enderror</div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nomer Handphone<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror">
                            </div>
                            <div class="invalid-feedback">@error('phone') {{ $message }} @enderror</div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">User<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="user_id" class="select select2-hidden-accessible @error('user_id') is-invalid @enderror">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                                    @endforeach
                                    <div class="invalid-feedback">@error('user_id') {{ $message }} @enderror</div>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Password<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" value="{{ $hashed_random_password }}" name="password_hint"
                                    class="form-control @error('password_hint') is-invalid @enderror">
                            </div>
                            <div class="invalid-feedback">@error('password_hint') {{ $message }} @enderror</div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a class="btn btn-secondary" href="{{ route('students.index') }}">Kembali</a>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
