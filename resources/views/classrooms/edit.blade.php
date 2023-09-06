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
                            <label class="col-lg-3 col-form-label">Tahun Pelajaran <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="school_year_id" class="select select2-hidden-accessible">
                                    @foreach ($schoolYears as $year)
                                        <option
                                            value="{{ $year->id }}"{{ old('school_year_id', $classroom->school_year_id) == $year->id ? ' selected' : '' }}>
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
                                    value="{{ old('name', $classroom->name) }}">
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
                                    <option value="" disabled selected>Pilih Program Keahlian </option>
                                    @foreach ($vocationalPrograms as $program)
                                        <option value="{{ $program }}"
                                            {{ old('vocational_program', $classroom->vocational_program) == $program ? 'selected' : '' }}>
                                            {{ $program }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('vocational_program')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row hide-input" id="vocationalCompetencyContainer"
                            style="{{ old('vocational_program', $classroom->vocational_program) ? '' : 'display: none;' }}">
                            <label class="col-lg-3 col-form-label">Kompetensi Keahlian<span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="vocational_competency" id="vocational_competency"
                                    class="select select2-hidden-accessible @error('vocational_competency') is-invalid @enderror">
                                    @foreach ($vocationalCompetencies as $competency)
                                        <option value="{{ $competency }}"
                                            {{ old('vocational_competency', $classroom->vocational_competency) == $competency ? 'selected' : '' }}>
                                            {{ $competency }}
                                        </option>
                                    @endforeach
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

            function updateVocationalCompetencyDropdown() {
                const selectedVocationalProgram = $("#vocational_program").val();
                vocationalCompetencyDropdown.empty();
                if (dataMapping.hasOwnProperty(selectedVocationalProgram)) {
                    const competencyOptions = dataMapping[selectedVocationalProgram];
                    competencyOptions.forEach(function(competency) {
                        vocationalCompetencyDropdown.append($('<option>', {
                            value: competency,
                            text: competency
                        }));
                    });
                    vocationalCompetencyContainer.show();
                } else {
                    vocationalCompetencyContainer.hide();
                }
            }

            updateVocationalCompetencyDropdown();

            $("#vocational_program").change(function() {
                updateVocationalCompetencyDropdown();
            });
        });
    </script>
@endpush
