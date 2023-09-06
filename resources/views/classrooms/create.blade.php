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
            Form Tambah Kelas Baru
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card">
                <form method="POST" action="{{ route('classrooms.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tahun Pelajaran <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="school_year_id" class="select select2-hidden-accessible">
                                    @foreach ($schoolYears as $year)
                                        <option
                                            value="{{ $year->id }}"{{ $year->id == $activeSchoolYear->id ? ' selected' : '' }}>
                                            {{ $year->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama Kelas <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Contoh : XII RPL 1">
                                <div class="invalid-feedback">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Program Keahlian <span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="vocational_program" id="vocational_program"
                                    class="select select2-hidden-accessible @error('vocational_program') is-invalid @enderror">
                                    <option selected disabled>Pilih Program Keahlian</option>
                                    <option value="Teknik Listrik">Teknik Listrik</option>
                                    <option value="Desain Permodelan dan Informasi Bangunan">Desain Permodelan dan Informasi
                                        Bangunan</option>
                                    <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                    <option value="Teknik Komputer dan Jaringan">Teknik Komputer dan Jaringan </option>
                                    <option value="Teknik Otomotif">Teknik Otomotif </option>
                                    <option value="Teknik Pemesinan">Teknik Pemesinan </option>
                                    <option value="Teknik Elektronika Industri">Teknik Elektronika Industri </option>
                                </select>
                                <div class="invalid-feedback">
                                    @error('vocational_program')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row hide-input" id="vocationalCompetencyContainer" style="display: none;">
                            <label class="col-lg-3 col-form-label">Kompetensi Keahlian<span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="vocational_competency" id="vocational_competency"
                                    class="select select2-hidden-accessible @error('vocational_competency') is-invalid @enderror">
                                </select>
                                <div class="invalid-feedback">
                                    @error('vocational_competency')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <span class="text-muted float-start">
                                <strong class="text-danger">*</strong> Harus diisi
                            </span>
                            <a class="btn btn-secondary" href="{{ route('classrooms.index') }}">Kembali</a>
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            const dataMapping = {
                "Teknik Listrik": ["Teknik Instalasi Tenaga Listrik", "Teknik Pendingin dan Tata Udara",
                    "Teknik Otomasi Industri"
                ],
                "Desain Permodelan dan Informasi Bangunan": ["Desain Permodelan dan Informasi Bangunan"],
                "Rekayasa Perangkat Lunak": ["Pengembangan Perangkat Lunak dan Gim"],
                "Teknik Komputer dan Jaringan": ["Teknik Komputer Jaringan dan Teknologi"],
                "Teknik Otomotif": ["Teknik Kendaraan Ringan", "Teknik Body Otomotif"],
                "Teknik Pemesinan": ["Teknik Pemesinan"],
                "Teknik Elektronika Industri": ["Teknik Elektronika Industri"],
            };
            const vocationalCompetencyDropdown = $("#vocational_competency");
            const vocationalCompetencyContainer = $("#vocationalCompetencyContainer");
            $("#vocational_program").change(function() {
                const selectedvocational_competency = $(this).val();
                vocationalCompetencyDropdown.empty();
                if (dataMapping.hasOwnProperty(selectedvocational_competency)) {
                    const programOptions = dataMapping[selectedvocational_competency];
                    $.each(programOptions, function(index, value) {
                        vocationalCompetencyDropdown.append($('<option>', {
                            value: value,
                            text: value
                        }));
                    });
                    vocationalCompetencyContainer.show();
                } else {
                    vocationalCompetencyContainer.hide();
                }
            });
            $("#vocational_competency").trigger("change");
        });
    </script>
@endpush
