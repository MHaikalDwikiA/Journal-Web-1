@section('title', 'Daftar Pengumuman')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Daftar Pengumuman
        @endslot
        @slot('li_1')
            Pengumuman
        @endslot
        @slot('li_2')
            Daftar
        @endslot
        @slot('action_button')
            <a href="{{ route('announcements.create') }}" class="btn add-btn">
                <i class="fa fa-plus"></i> Tambah Pengumuman Baru
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
                                            <th>Tanggal</th>
                                            <th>Judul</th>
                                            <th>Deskripsi</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($announcements as $announcement)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $announcement->date }}</td>
                                                <td>{{ $announcement->title }}</td>
                                                <td>{{ Str::substr($announcement->description, 0, 50) }}</td>
                                                <td class="text-end">
                                                    <a href="{{ route('announcements.edit', $announcement->id) }}"
                                                        class="btn btn-success btn-sm">
                                                        Ubah
                                                    </a>
                                                    <a href="{{ route('announcements.show', $announcement->id) }}"
                                                        class="btn btn-sm btn-primary">Detail</a>
                                                    <button type="button"
                                                        data-action="{{ route('announcements.destroy', $announcement->id) }}"
                                                        data-confirm-text="Anda yakin menghapus Pengumuman ini?"
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
