@section('title', 'Daftar Pembimbing Sekolah')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Daftar Pembimbing Sekolah
        @endslot
        @slot('li_1')
            Pembimbing Sekolah
        @endslot
        @slot('li_2')
            Daftar
        @endslot
        @slot('action_button')
            <a href="{{ route('school-advisors.create') }}" class="btn add-btn">
                <i class="fa fa-plus"></i> Tambah Pembimbing Sekolah Baru
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
                            <a href="{{ route('school-advisors.index') }}"
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
                                <table class="table table-striped custom-table no-footer mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>No Hp</th>
                                            <th>Alamat</th>
                                            <th>Jenis kelamin</th>
                                            <th>Password</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($advisors as $advisor)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $advisor->identity }}</td>
                                                <td>{{ $advisor->name }}</td>
                                                <td>{{ $advisor->phone }}</td>
                                                <td>{{ $advisor->address }}</td>
                                                <td>{{ $advisor->gender }}</td>
                                                <td>{{ $advisor->password_hint }}</td>
                                                <td class="text-end">
                                                    <a href="{{ route('school-advisors.edit', $advisor->id) }}"
                                                        class="btn btn-success btn-sm">
                                                        Ubah
                                                    </a>
                                                    <button type="button"
                                                        data-action="{{ route('school-advisors.remove', $advisor->id) }}"
                                                        data-confirm-text="Anda yakin menghapus Pembimbing Sekolah ini?"
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
