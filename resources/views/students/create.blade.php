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
                                    <option selected disabled>Pilih Kelas Kalian</option>
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
                                <input type="text" name="identity"
                                    class="form-control @error('identity') is-invalid @enderror"
                                    value="{{ old('identity') }}">
                                <div class="invalid-feedback">
                                    @error('identity')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                            </div>
                            <div class="invalid-feedback">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">User<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="user_username"
                                    class="form-control @error('user_username') is-invalid @enderror"
                                    value="{{ old('user_username') }}">
                            </div>
                            <div class="invalid-feedback">
                                @error('user_username')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Password <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <input type="password" name="password_hint"
                                        class="form-control @error('password_hint') is-invalid @enderror"
                                        id="passwordInput">
                                    <button class="btn btn-outline-secondary" style="width: 50px" type="button"
                                        id="togglePassword">
                                        <span class="fa fa-eye-slash"></span>
                                    </button>
                                    <button class="btn btn-outline-secondary" id="generatePassword"
                                        type="button">Generate</button>
                                </div>
                                <div class="invalid-feedback" id="passwordError">
                                    @error('password_hint')
                                        {{ $message }}
                                    @enderror
                                </div>
                                </select>
                            </div>
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
@push('scripts')
    <script>
        const passwordInput = document.getElementById('passwordInput');
        const toggleButton = document.getElementById('togglePassword');
        const passwordError = document.getElementById('passwordError');
        const generateButton = document.getElementById('generatePassword');

        toggleButton.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.innerHTML = '<span class="fa fa-eye"></span>';
            } else {
                passwordInput.type = 'password';
                toggleButton.innerHTML = '<span class="fa fa-eye-slash"></span>';
            }
        });

        generateButton.addEventListener("click", function() {
            const length = 5;
            const charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            let password = "";

            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * charset.length);
                password += charset[randomIndex];
            }

            passwordInput.value = password;
        });
    </script>
@endpush
