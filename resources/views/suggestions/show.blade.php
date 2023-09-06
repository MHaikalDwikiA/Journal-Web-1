@section('title', 'Detail Saran Siswa PKL')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Detail Saran Siswa PKL
        @endslot
        @slot('li_1')
            Saran Siswa PKL
        @endslot
        @slot('li_2')
            Detail
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Nama Karyawan</td>
                                    <td>{{ $suggest->employee->name }}</td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td>{{ $suggest->employee->jobTitle->name }}</td>
                                </tr>
                                <tr>
                                    <td>Saran</td>
                                    <td>{{ $suggest->suggest }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Siswa</td>
                                    <td>{{ $suggest->internship->student->name }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="text-end m-4">
                    <a href="{{ route('suggestions.index') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
