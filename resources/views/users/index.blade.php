@section('title', 'Daftar Pengguna')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Daftar Pengguna
        @endslot
        @slot('li_1')
            Pengguna
        @endslot
        @slot('li_2')
            Daftar
        @endslot
        @slot('action_button')
            <a href="{{ route('users.create') }}" class="btn add-btn">
                <i class="fa fa-plus"></i> Tambah Pengguna Baru
            </a>
        @endslot
    @endcomponent

    <x-alert/>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link {{ Request::get('view') != 'inactive' ? 'active' : '' }}">
                                Aktif&nbsp;
                                <span class="badge badge-primary">{{ $activeCount }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?view=inactive" class="nav-link {{ Request::get('view') == 'inactive' ? 'active' : '' }}">
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
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    <img src="{{ !empty($user->photo) ? \Storage::url($user->photo) : asset('assets/img/user.jpg') }}" class="img-fluid" style="max-width: 50px;">
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>
                                                    @switch($user->role)
                                                        @case(App\Enums\UserRole::Admin)
                                                            <span class="badge badge-success">
                                                                Admin
                                                            </span>
                                                            @break
                                                        @case(App\Enums\UserRole::Student)
                                                            <span class="badge badge-info">
                                                                Pengguna
                                                            </span>
                                                            @break

                                                        @case(App\Enums\UserRole::SchoolAdvisor)
                                                            <span class="badge badge-primary">
                                                                Pembimbing Sekolah
                                                            </span>
                                                            @break
                                                        @case(App\Enums\UserRole::CompanyAdvisor)
                                                            <span class="badge badge-warning">
                                                                Pembimbing Perusahaan
                                                            </span>
                                                            @break

                                                        @default
                                                            -
                                                    @endswitch
                                                </td>
                                                <td class="text-end">
                                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success btn-sm">
                                                        Ubah
                                                    </a>
                                                    @if($currentId != $user->id)
                                                    <button type="button"
                                                        data-action="{{ route('users.remove', $user->id) }}"
                                                        data-confirm-text="Anda yakin menghapus pengguna ini?"
                                                        class="btn btn-danger btn-sm btn-delete btn-sm"
                                                    >
                                                        Hapus
                                                    </button>
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
