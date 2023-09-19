@section('title', 'Input Nilai Siswa')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Input Nilai Siswa
        @endslot
        @slot('li_1')
            Nilai Siswa
        @endslot
        @slot('li_2')
            Daftar
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
                                <table class="table table-striped custom-table no-footer mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>Nama</th>
                                            <th>Kegiatan</th>
                                            <th>Kompetensi</th>
                                            <th>Status</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($internshipJournals as $journal)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $journal->internship->student->name }}</td>
                                                <td>{{ $journal->activity }}</td>
                                                <td>{{ $journal->competency->competency }}</td>
                                                <td>
                                                    @switch($journal->status)
                                                        @case($journal->status = 'approved')
                                                            <span class="badge badge-success">
                                                                Approved
                                                            </span>
                                                        @break

                                                        @case($journal->status = 'pending')
                                                            <span class="badge badge-warning">
                                                                Pending
                                                            </span>
                                                        @break

                                                        @case($journal->status = 'rejected')
                                                            <span class="badge badge-danger">
                                                                Rejected
                                                            </span>
                                                        @break

                                                        @default
                                                            -
                                                    @endswitch
                                                </td>
                                                <td class="d-flex gap-1 justify-content-end">
                                                    <a href="{{ route('journals.show', $journal->id) }}"
                                                        class="btn btn-primary btn-sm">
                                                        Detail
                                                    </a>
                                                    @switch($journal->status)
                                                        @case($journal->status = 'pending')
                                                            <form action="{{ route('journals.approve', $journal->id) }}"
                                                                method="post">
                                                                @method('put')
                                                                @csrf
                                                                <button type="submit" class="btn btn-success btn-sm">
                                                                    Approve
                                                                </button>
                                                            </form>
                                                            <form action="{{ route('journals.reject', $journal->id) }}"
                                                                method="post">
                                                                @method('put')
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm btn-delete btn-sm">
                                                                    Reject
                                                                </button>
                                                            </form>
                                                        @break

                                                        @default
                                                    @endswitch
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
