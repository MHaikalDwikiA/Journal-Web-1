@section('title', 'Daftar Saran Siswa PKL')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Daftar Saran Siswa PKL
        @endslot
        @slot('li_1')
            Saran Siswa PKL
        @endslot
        @slot('li_2')
            Daftar
        @endslot
        @slot('action_button')
            <form action="{{ route('suggestions.approveAll') }}" method="post">
                @method('put')
                @csrf
                <button type="submit" class="btn btn-primary rounded-5">
                    <i class="fa-solid fa-list-check"></i> Validasi Semua Saran Siswa
                </button>
            </form>
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4>
                        Tahun Pelajaran :
                        @foreach ($schoolYear as $year)
                            {{ $year->name }}
                        @endforeach
                    </h4>
                    <div class="tab-content">
                        <div class="tab-pane show active">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table no-footer mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>Nama Siswa</th>
                                            <th>Saran</th>
                                            <th>Nama Karyawan</th>
                                            <th>Status</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($suggestions as $suggest)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $suggest->internship->student->name }}</td>
                                                <td>{{ $suggest->suggest }}</td>
                                                <td>{{ $suggest->employee->name }}</td>
                                                <td>
                                                    @switch($suggest->status)
                                                        @case($suggest->status = 'approved')
                                                            <span class="badge badge-success">
                                                                Approved
                                                            </span>
                                                        @break

                                                        @case($suggest->status = 'pending')
                                                            <span class="badge badge-warning">
                                                                Pending
                                                            </span>
                                                        @break

                                                        @case($suggest->status = 'rejected')
                                                            <span class="badge badge-danger">
                                                                Rejected
                                                            </span>
                                                        @break

                                                        @default
                                                            -
                                                    @endswitch
                                                </td>
                                                <td class="d-flex gap-1 justify-content-end">
                                                    <a href="{{ route('suggestions.show', $suggest->id) }}"
                                                        class="btn btn-primary btn-sm">
                                                        Detail
                                                    </a>
                                                    @switch($suggest->status)
                                                        @case($suggest->status == 'pending')
                                                            <form action="{{ route('suggestions.approve', $suggest->id) }}"
                                                                method="post">
                                                                @method('put')
                                                                @csrf
                                                                <button type="submit" class="btn btn-success btn-sm">
                                                                    Approv
                                                                </button>
                                                            </form>
                                                            <form action="{{ route('suggestions.reject', $suggest->id) }}"
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
