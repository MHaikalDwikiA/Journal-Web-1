@section('title', 'Notifikasi')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Daftar Notifikasi
        @endslot
        @slot('li_1')
            Notifikasi
        @endslot
        @slot('li_2')
            Daftar
        @endslot
        @slot('action_button')
            <a href="{{ route('notifications.create') }}" class="btn add-btn">
                <i class="fa fa-plus"></i> Tambah Notifikasi Baru
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
                                        @foreach ($notifications as $notification)
                                            <tr>
                                                <td>{{ $notification->id }}</td>
                                                <td>{{ $notification->date }}</td>
                                                <td>{{ $notification->title }}</td>
                                                <td>{{ Str::substr($notification->description, 0, 50)  }}</td>
                                                <td class="text-end">
                                                    <a href="{{ route('notifications.edit', $notification->id) }}"
                                                        class="btn btn-sm btn-success">Edit</a>
                                                    <a href="{{ route('notifications.show', $notification->id) }}"
                                                        class="btn btn-sm btn-primary">Detail</a>
                                                    <form class="d-inline"
                                                        action="{{ route('notifications.remove', $notification->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            data-action="{{ route('notifications.remove', $notification->id) }}"
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
        </div>
    </div>
@endsection
