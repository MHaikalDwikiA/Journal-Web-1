@section('title', 'Aspek Penilaian')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Daftar Aspek Penilaian
        @endslot
        @slot('li_1')
            Aspek Penilaian
        @endslot
        @slot('li_2')
            Daftar
        @endslot
        @slot('action_button')
            <a href="{{ route('aspects.create') }}" class="btn add-btn">
                <i class="fa fa-plus"></i> Tambah Aspek Penilaian Baru
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
                                <table class="table table-striped custom-table no-footer mb-0 datatable" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>Nama Aspek</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($aspects as $aspect)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $aspect->name }}</td>
                                                <td class="text-end">
                                                    <a href="{{ route('aspects.edit', $aspect->id) }}"
                                                        class="btn btn-success btn-sm">
                                                        Ubah
                                                    </a>
                                                    <button type="button"
                                                        data-action="{{ route('aspects.destroy', $aspect->id) }}"
                                                        data-confirm-text="Anda yakin menghapus aspek ini?"
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
