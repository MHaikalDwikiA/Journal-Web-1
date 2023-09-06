@section('title', 'Siswa')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Membuat Siswa
        @endslot
        @slot('li_1')
            Siswa {{ $classroom->name }}
        @endslot
        @slot('li_2')
            Form tambah siswa baru
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card">
                <form method="POST" action="{{ route('classrooms.studentStore', $classroomId) }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">NIS <span class="text-danger">*</span></label>
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
                            <label class="col-lg-3 col-form-label">Nama <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                <div class="invalid-feedback">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">No Telepon <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="phone"
                                    class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                                <div class="invalid-feedback">
                                    @error('phone')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Password <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <input type="password" name="password_hint"
                                        class="form-control @error('password_hint') is-invalid @enderror" id="passwordInput"
                                        value="{{ old('password_hint') }}">
                                    <button class="btn btn-outline-secondary" style="width: 50px" type="button"
                                        id="togglePassword">
                                        <span class="fa fa-eye-slash"></span>
                                    </button>
                                    <button class="btn btn-outline-secondary" id="generatePassword"
                                        type="button">Generate</button>
                                    <div class="invalid-feedback">
                                        @error('password_hint')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a class="btn btn-secondary"
                            href="{{ route('classrooms.studentIndex', $classroomId) }}">Kembali</a>
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
