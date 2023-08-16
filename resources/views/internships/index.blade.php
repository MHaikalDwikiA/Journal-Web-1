@section('title', 'Daftar PKL')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Daftar PKL
        @endslot
        @slot('li_1')
            PKL
        @endslot
        @slot('li_2')
            Daftar
        @endslot
    @endcomponent

    <x-alert />

    <form action="{{ route('internships.index') }}" method="GET" id="filter-form">
        <div class="row">
            <div class="col-md-4">
                <label for="school_year_id" class="form-label">Tahun Pelajaran:</label>
                <select name="school_year_id" id="school_year_id" class="form-control">
                    <option value="" selected>Semua Tahun Pelajaran</option>
                    @foreach ($schoolYears as $schoolYear)
                        @if ($schoolYear->is_active)
                            <option value="{{ $schoolYear->id }}"
                                {{ request('school_year_id') == $schoolYear->id ? 'selected' : '' }}>
                                {{ $schoolYear->name }}
                            </option>
                        @else
                            <option value="{{ $schoolYear->id }}"
                                {{ request('school_year_id') == $schoolYear->id ? 'selected' : '' }}>
                                {{ $schoolYear->name }} (Non-Aktif)
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="classroom_id" class="form-label">Kelas:</label>
                <select name="classroom_id" id="classroom_id" class="form-control">
                    <option value="" selected>Semua Kelas</option>
                </select>
            </div>
            <div class="col-md-4 d-flex">
                <button type="submit" class="btn btn-primary mt-4">Filter</button>
            </div>
        </div>
    </form>

    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table no-footer mb-0 datatable">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>No Telepon Siswa</th>
                                    <th>Nama Perusahaan</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="student-data" class="hidden">
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $student->identity }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->phone }}</td>
                                        <td>
                                            @if ($student->internship)
                                                {{ $student->internship ? $student->internship->company->name : '' }}
                                        <td class="text-end">
                                            <a href="{{ route('internships.show', $student->internship->id) }}"
                                                class="btn btn-sm btn-primary">
                                                Lihat Siswa
                                            </a>
                                        </td>
                                    @else
                                        -
                                        <td class="text-end">
                                            <a class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $student->id }}">
                                                Daftar Perusahaan
                                            </a>
                                        </td>
                                @endif
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-body')
    <div class="modal fade" id="exampleModal{{ $student->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nama Perusahaan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('internships.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <input type="hidden" name="school_year_id" value="{{ $student->school_year_id }}">
                    <input type="hidden" name="company_advisor_id" value="{{ $student->company_advisor_id }}">
                    <input type="hidden" name="school_advisor_id" value="{{ $student->school_advisor_id }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="company_id" class="form-label">Masukan Nama
                                Perusahaan</label>
                            <div>
                                <select name="company_id" class="select-hidden-accessible form-control">
                                    <option value="" disabled selected>Pilih Perusahaan
                                    </option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}">
                                            {{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="company_advisor_id" class="form-label">Masukan Nama
                                Pembimbing Perusahaan</label>
                            <div>
                                <select name="company_advisor_id" class="select-hidden-accessible form-control">
                                    <option value="" disabled selected>Pilih Pembimbing
                                        Perusahaan
                                    </option>
                                    @foreach ($companyAdvisors as $advisors)
                                        <option value="{{ $advisors->id }}">
                                            {{ $advisors->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="school_advisor_id" class="form-label">Masukan Nama
                                Pembimbing Sekolah</label>
                            <div>
                                <select name="school_advisor_id" class="select-hidden-accessible form-control">
                                    <option value="" disabled selected>Pilih Pembimbing
                                        Sekolah
                                    </option>
                                    @foreach ($schoolAdvisors as $advisor)
                                        <option value="{{ $advisor->id }}">
                                            {{ $advisor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush
@push('scripts')
    <script>
        $(document).ready(function() {
            var schoolYearSelect = $("#school_year_id");
            var classroomSelect = $("#classroom_id");
            var studentData = $("#student-data");
            var classes = @json($classes);

            function updateClassroomOptions(selectedSchoolYear) {
                classroomSelect.empty().append('<option value="" selected>Semua Kelas</option>');
                for (var i = 0; i < classes.length; i++) {
                    if (classes[i].school_year_id == selectedSchoolYear) {
                        classroomSelect.append(`<option value="${classes[i].id}">${classes[i].name}</option>`);
                    }
                }
            }

            schoolYearSelect.on("change", function() {
                updateClassroomOptions(schoolYearSelect.val());
                studentData.toggleClass('hidden', !(schoolYearSelect.val() && classroomSelect.val()));
            });

            updateClassroomOptions(schoolYearSelect.val());
        });
    </script>
@endpush
