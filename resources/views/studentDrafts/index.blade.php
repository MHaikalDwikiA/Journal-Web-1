@section('title', 'Data Siswa')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Data Siswa
        @endslot
        @slot('li_1')
            Data Siswa
        @endslot
        @slot('li_2')
            List Data
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table no-footer mb-0 datatable" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>Nama Student</th>
                                            <th>Tanggal Pembuatan</th>
                                            <th>Status</th>
                                            <th>Tanggal Diterima</th>
                                            <th>Admin yang Mensetujui Data</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($studentDrafts as $studentDraft)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $studentDraft->student->name }}</td>
                                                <td>{{ $studentDraft->request_date }}</td>
                                                <td>{{ $studentDraft->approval_status }}</td>
                                                <td>{{ $studentDraft->approval_date ?? '-' }}</td>
                                                <td>{{ $studentDraft->approvalUser->name ?? '-' }}</td>
                                                <td class="text-end">
                                                    <a href="{{ route('studentDrafts.show', $studentDraft->id) }}"
                                                        class="btn btn-sm btn-primary">Lihat</a>
                                                    @if ($studentDraft->approval_status === 'Pending' || $studentDraft->approval_status === 'Tolak')
                                                        <a class="btn btn-sm btn-success open-modal"
                                                            data-student-id="{{ $studentDraft->student->id }}"
                                                            data-approval-user-id="{{ auth()->user()->id }}">
                                                            Ubah Status
                                                        </a>
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
        </div>
    </div>
@endsection
@push('after-body')
    <div class="modal fade" id="studentDraft" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Status</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('studentDrafts.update') }}" method="POST">
                    @method('put')
                    @csrf
                    <input type="hidden" name="student_id" id="student_id">
                    <input type="hidden" name="approval_user_id" id="approval_user_id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <div>
                                <select name="approval_status" id="approvalStatus"
                                    class="select-hidden-accessible form-control">
                                    <option disabled selected>Pending
                                    </option>
                                    <option value="Terima">Terima</option>
                                    <option value="Tolak">Tolak</option>
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
            $(document).on('click', '.open-modal', function() {
                var studentDraftStudent = $(this).data('student-id');
                var approvalUserId = $(this).data('approval-user-id');

                $('#student_id').val(studentDraftStudent);
                $('#approval_user_id').val(approvalUserId);
                $('#studentDraft').modal('show');
            });
        });
    </script>
@endpush
