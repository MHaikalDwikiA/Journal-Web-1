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

    <div class="d-flex justify-content-between align-items-center mb-3">
        <form action="{{ route('internships.index') }}" method="GET" id="filter-form" class="flex-grow-1">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="school_year_id" class="form-label">Tahun Pelajaran:</label>
                    <select name="school_year_id" id="school_year_id" class="js-example-basic-single form-control">
                        @foreach ($schoolYears as $schoolYear)
                            <option value="{{ $schoolYear->id }}"
                                {{ request('school_year_id') == $schoolYear->id ? 'selected' : '' }}>
                                {{ $schoolYear->name }}{{ $schoolYear->is_active ? '' : ' (Non-Aktif)' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="classroom_id" class="form-label">Kelas:</label>
                    <select name="classroom_id" id="classroom_id" class="js-example-basic-single form-control">
                        <option selected disabled>Semua Kelas</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
    </div>


    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table no-footer mb-0 datatable" style="width: 100%;">
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
                                                {{ $student->internship->company->name }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            @if ($student->internship)
                                                <a href="{{ route('internships.show', $student->internship->id) }}"
                                                    class="btn btn-sm btn-primary">
                                                    Lihat Siswa
                                                </a>
                                                <a href="https://wa.me/62{{ substr($student->phone, 1) }}?text=Username%3A%20{{ $student->user->username }}%0APassword%3A%20{{ $student->password_hint }}"
                                                    target="_blank" class="btn btn-sm btn-warning">Kirim Akun</a>
                                            @else
                                                <button class="btn btn-sm btn-success open-modal"
                                                    data-student-id="{{ $student->id }}"
                                                    data-school-year-id="{{ $student->school_year_id }}">Daftar
                                                    Perusahaan</button>
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
    <div class="modal fade" id="modalInternship" tabindex="-1" aria-labelledby="internshipModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="internshipModalLabel">Nama Perusahaan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('internships.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="student_id" id="student_id">
                    <input type="hidden" name="school_year_id" id="schoolYearId">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="company_id" class="form-label">Masukan Nama Perusahaan</label>
                            <div>
                                <select name="company_id" class="select-hidden-accessible form-control" id="company_id">
                                    <option disabled selected>Pilih Perusahaan</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}">
                                            {{ $company->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="company_advisor_id" class="form-label">Masukan Nama Pembimbing Perusahaan</label>
                            <div>
                                <select name="company_advisor_id" class="select-hidden-accessible form-control"
                                    id="">
                                    <option disabled selected>Pilih Pembimbing Perusahaan</option>
                                    @foreach ($companyAdvisors as $advisors)
                                        <option value="{{ $advisors->id }}">
                                            {{ $advisors->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="school_advisor_id" class="form-label">Masukan Nama Pembimbing Sekolah</label>
                            <div>
                                <select name="school_advisor_id" class="select-hidden-accessible form-control"
                                    id="">
                                    <option disabled selected>Pilih Pembimbing Sekolah</option>
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
            $('.js-example-basic-single').select2();
            var schoolYearSelect = $("#school_year_id");
            var classroomSelect = $("#classroom_id");
            var studentData = $("#student-data");
            var classrooms = @json($classrooms);

            function updateClassroomOptions(selectedSchoolYear) {
                classroomSelect.empty().append('<option value="" selected disabled>Semua Kelas</option>');
                for (var i = 0; i < classrooms.length; i++) {
                    if (classrooms[i].school_year_id == selectedSchoolYear) {
                        classroomSelect.append(
                            `<option value="${classrooms[i].id}">${classrooms[i].name}</option>`);
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
    <script>
        $(document).ready(function() {
            $(document).on('click', '.open-modal', function() {
                var studentId = $(this).data('student-id');
                var schoolYearId = $(this).data('school-year-id');
                $('#student_id').val(studentId);
                $('#schoolYearId').val(schoolYearId);
                $('#modalInternship').modal('show');
            });
        });
    </script>
@endpush
