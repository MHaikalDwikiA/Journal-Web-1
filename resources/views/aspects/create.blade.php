@section('title', 'Aspek Penilaian')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Aspek Penilaian
        @endslot
        @slot('li_1')
            Aspek Penilaian
        @endslot
        @slot('li_2')
            Form Tambah Aspek Penilaian Baru
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card">
                <form method="POST" action="{{ route('aspects.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama Aspek <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror">
                                <div class="invalid-feedback">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <span class="text-muted float-start">
                                <strong class="text-danger">*</strong> Harus diisi
                            </span>
                            <a class="btn btn-secondary" href="{{ route('aspects.index') }}">Kembali</a>
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
