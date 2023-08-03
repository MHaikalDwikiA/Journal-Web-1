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
                                <select name="vocational_program" class="select select2-hidden-accessible"
                                    value="{{ old('vocational_program', $classroom->vocational_program) }}" required>
                                    <option selected disabled>Pilih Program Keahlian Kalian</option>
                                    <option @if (old('vocational_program', $classroom->vocational_program) === 'Teknik Pemanasan Tata Udara & Pendinginan') selected @endif>Teknik Pemanasan Tata Udara &
                                        Pendinginan</option>
                                    <option @if (old('vocational_program', $classroom->vocational_program) === 'Teknik Instalasi Tenaga Listrik') selected @endif>Teknik Instalasi Tenaga
                                        Listrik</option>
                                    <option @if (old('vocational_program', $classroom->vocational_program) === 'Teknik Otomasi Industri') selected @endif>Teknik Otomasi Industri
                                    </option>
                                    <option @if (old('vocational_program', $classroom->vocational_program) === 'Desain Permodelan dan Informasi Bangunan') selected @endif>Desain Permodelan dan
                                        Informasi Bangunan</option>
                                    <option @if (old('vocational_program', $classroom->vocational_program) === 'Rekayasa Perangkat Lunak') selected @endif>Rekayasa Perangkat Lunak
                                    </option>
                                    <option @if (old('vocational_program', $classroom->vocational_program) === 'Teknik Komputer dan Jaringan') selected @endif>Teknik Komputer dan Jaringan
                                    </option>
                                    <option @if (old('vocational_program', $classroom->vocational_program) === 'Teknik Kendaraan Ringan') selected @endif>Teknik Kendaraan Ringan
                                    </option>
                                    <option @if (old('vocational_program', $classroom->vocational_program) === 'Teknik Bodi Kendaraan Ringan') selected @endif>Teknik Bodi Kendaraan Ringan
                                    </option>
                                    <option @if (old('vocational_program', $classroom->vocational_program) === 'Teknik Elektronika Industri') selected @endif>Teknik Elektronika Industri
                                    </option>
                                    <option @if (old('vocational_program', $classroom->vocational_program) === 'Teknik Pemesinan') selected @endif>Teknik Pemesinan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Program Kompetensi<span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="vocational_competency" class="select select2-hidden-accessible"
                                    value="{{ old('vocational_competency', $classroom->vocational_competency) }}" required>
                                    <option selected disabled>Pilih Program Kompetensi Kalian</option>
                                    <option <?php echo $classroom->vocational_competency === 'Teknik Ketenagalistrikan' ? 'selected' : ''; ?>>Teknik Ketenagalistrikan</option>
                                    <option <?php echo $classroom->vocational_competency === 'Teknik Desain Permodelan dan Informasi Bangunan' ? 'selected' : ''; ?>>Teknik Desain Permodelan dan Informasi Bangunan</option>
                                    <option <?php echo $classroom->vocational_competency === 'Pengembangan Perangkat Lunak dan Gim' ? 'selected' : ''; ?>>Pengembangan Perangkat Lunak dan Gim</option>
                                    <option <?php echo $classroom->vocational_competency === 'Teknik Jaringan Komputer dan Telekomunikasi' ? 'selected' : ''; ?>>Teknik Jaringan Komputer dan Telekomunikasi</option>
                                    <option <?php echo $classroom->vocational_competency === 'Teknik Otomotif' ? 'selected' : ''; ?>>Teknik Otomotif</option>
                                    <option <?php echo $classroom->vocational_competency === 'Teknik Mesin' ? 'selected' : ''; ?>>Teknik Mesin</option>
                                    <option <?php echo $classroom->vocational_competency === 'Teknik Elektronika' ? 'selected' : ''; ?>>Teknik Elektronika</option>
                                </select>
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
