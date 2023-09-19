@section('title', 'Data Siswa')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Persetujuan Data Siswa
        @endslot
        @slot('li_1')
            Persetujuan Data Siswa
        @endslot
        @slot('li_2')
            List Data Persetujuan Siswa
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="nav-item">
                        <a href="{{ route('studentDrafts.index') }}"
                            class="nav-link {{ Request::get('view') != 'approved' && Request::get('view') != 'reject' ? 'active' : '' }}">
                            Menunggu Persetujuan&nbsp;
                            <span class="badge badge-primary">{{ $pendingCount }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="?view=approved" class="nav-link {{ Request::get('view') == 'approved' ? 'active' : '' }}">
                            Terima&nbsp;
                            <span class="badge badge-success">{{ $approvedCount }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="?view=reject" class="nav-link {{ Request::get('view') == 'reject' ? 'active' : '' }}">
                            Tolak&nbsp;
                            <span class="badge badge-danger">{{ $rejectCount }}</span>
                        </a>
                    </li>
                </ul>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table no-footer mb-0 datatable"
                                    style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>Nama Siswa</th>
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
                                                <td>{{ \Carbon\Carbon::parse($studentDraft->request_date)->format('d F Y') }}
                                                </td>
                                                <td>{{ $studentDraft->approval_status }}</td>
                                                <td>
                                                    {{ $studentDraft->approval_date ? \Carbon\Carbon::parse($studentDraft->approval_date)->format('d F Y') : '-' }}
                                                </td>
                                                <td>{{ $studentDraft->approvalUser->name ?? '-' }}</td>
                                                <td class="text-end">
                                                    <a href="{{ route('studentDrafts.show', $studentDraft->id) }}"
                                                        class="btn btn-sm btn-primary">Lihat</a>
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
