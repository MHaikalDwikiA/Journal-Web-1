@section('title', 'Tahun Pelajaran')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Daftar Tahun Pelajaran
        @endslot
        @slot('li_1')
            Tahun Pelajaran
        @endslot
        @slot('li_2')
            Daftar
        @endslot
        @slot('action_button')
            <a href="{{ route('school-years.create') }}" class="btn add-btn">
                <i class="fa fa-plus"></i> Tambah Tahun Pelajaran Baru
            </a>
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
                                            <th>Tahun Pelajaran</th>
                                            <th>Nama Kepala Sekolah</th>
                                            <th>Status</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($school_years as $school_year)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $school_year->name }}</td>
                                                <td>{{ $school_year->headmaster_name }}</td>
                                                <td>
                                                    @switch($school_year->is_active)
                                                        @case($school_year->is_active = true)
                                                            <span class="badge badge-success">
                                                                Active
                                                            </span>
                                                        @break

                                                        @case($school_year->is_active = false)
                                                            <span class="badge badge-info">
                                                                Inactive
                                                            </span>
                                                        @break

                                                        @default
                                                            -
                                                    @endswitch
                                                </td>
                                                <td class="text-end">
                                                    <a href="{{ route('school-years.edit', $school_year->id) }}"
                                                        class="btn btn-success btn-sm">Ubah</a>
                                                    <button type="button"
                                                        data-action="{{ route('school-years.remove', $school_year->id) }}"
                                                        data-confirm-text="Anda yakin menghapus tahun pelajaran ini?"
                                                        class="btn btn-danger btn-sm btn-delete btn-sm">Hapus</button>
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
