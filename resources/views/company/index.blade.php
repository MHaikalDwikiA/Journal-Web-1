@section('title', 'Daftar Perusahaan')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Daftar Perusahaan
        @endslot
        @slot('li_1')
            Perusahaan
        @endslot
        @slot('li_2')
            Daftar
        @endslot
        @slot('action_button')
            <a href="{{ route('companies.create') }}" class="btn add-btn">
                <i class="fa fa-plus"></i> Tambah Perusahaan Baru
            </a>
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item">
                            <a href="{{ route('companies.index') }}"
                                class="nav-link {{ Request::get('view') != 'inactive' ? 'active' : '' }}">
                                Aktif&nbsp;
                                <span class="badge badge-primary">{{ $activeCount }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?view=inactive"
                                class="nav-link {{ Request::get('view') == 'inactive' ? 'active' : '' }}">
                                Tidak Aktif&nbsp;
                                <span class="badge badge-danger">{{ $inactiveCount }}</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table no-footer mb-0 datatable" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Direktur</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($companies as $company)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $company->name }}</td>
                                                <td>{{ $company->address }}</td>
                                                <td>{{ $company->director }}</td>
                                                <td class="text-end">
                                                    <a href="{{ route('companies.edit', $company->id) }}"
                                                        class="btn btn-success btn-sm">
                                                        Ubah
                                                    </a>
                                                    <button type="button"
                                                        data-action="{{ route('companies.destroy', $company->id) }}"
                                                        data-confirm-text="Anda yakin menghapus perusahaan ini?"
                                                        class="btn btn-danger btn-sm btn-delete btn-sm">
                                                        Hapus
                                                    </button>
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
