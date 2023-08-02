@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Siswa
        @endslot
        @slot('li_1')
            Siswa
        @endslot
        @slot('li_2')
            Daftar
        @endslot
        @slot('action_button')
            <a href="{{ route('students.create') }}" class="btn add-btn">
                <i class="fa fa-plus"></i> Tambah Siswa Baru
            </a>
            <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data" class="d-inline">
                @csrf
                <input type="file" name="import_file" accept=".xls,.xlsx">
                <button type="submit" class="btn btn-primary">Import Excel</button>
            </form>
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table no-footer mb-0 datatable">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Gender</th>
                                    <th>Nomer Handphone</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $student->identity }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->gender }}</td>
                                        <td>{{ $student->phone }}</td>
                                        <td>{{ $student->user_id }}</td>
                                        <td>{{ $student->password_hint }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('students.edit', $student->id) }}"
                                                class="btn btn-sm btn-success">Edit</a>
                                            <form class="d-inline" action="{{ route('students.remove', $student->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
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
@endsection
