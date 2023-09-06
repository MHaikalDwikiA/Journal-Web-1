@section('title', 'Siswa')

@extends('layout.mainlayout')
@section('content')
    <div class="mb-3">
        <a href="{{ route('classrooms.index') }}"><i class="fa-solid fa-arrow-left fa-2xl"></i></a>
    </div>
    @component('components.breadcrumb')
        @slot('title')
            Siswa
        @endslot
        @slot('li_1')
            Kelas
        @endslot
        @slot('li_2')
            Siswa {{ $classroom->name }}
        @endslot
        @slot('li_3')
            Daftar
        @endslot
        @slot('action_button')
            <a href="{{ route('classrooms.studentCreate', $classroomId) }}" class="btn add-btn">
                <i class="fa fa-plus"></i> Tambah Siswa Baru
            </a>
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ImportSiswaModal">
                    Import Data Siswa
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table no-footer mb-0 datatable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>No Telepon</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $student->identity }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->phone }}</td>
                                        <td>{{ $student->user->username }}</td>
                                        <td>{{ $student->password_hint }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('classrooms.studentEdit', ['classroomId' => $classroomId, 'studentId' => $student->id]) }}"
                                                class="btn btn-sm btn-success">Edit</a>
                                            <form class="d-inline"
                                                action="{{ route('classrooms.studentRemove', [$student->id, $student->classroom->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    data-action="{{ route('classrooms.studentRemove', ['classroomId' => $classroomId, 'studentId' => $student->id]) }}"
                                                    data-confirm-text="Anda yakin menghapus siswa ini?"
                                                    class="btn btn-danger btn-sm btn-delete btn-sm">Hapus</button>
                                            </form>
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
    <div class="modal fade" id="ImportSiswaModal" tabindex="-1" aria-labelledby="ImportSiswaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ImportSiswaModalLabel">Import Data Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('classrooms.studentImport', $classroomId) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="formFileSm" class="form-label">Pilih File</label>
                            <input class="form-control" id="formFileSm" type="file" name="import_file"
                                accept=".xls,.xlsx">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <a href="{{ asset('files/Insert-Siswa.xlsx') }}">Unduh Template Excel</a>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush
@push('scripts')
    <script>
        $(document).ready(function() {
            $('select[name="classrooms"]').change(function() {
                var selectedClassroom = $(this).val();
                var Filter = "{{ route('classrooms.studentIndex', $student->id ?? '') }}" +
                    "?classrooms=" + selectedClassroom;
                $('#btn-filter').attr('href', Filter);
            });
        });
    </script>
@endpush
