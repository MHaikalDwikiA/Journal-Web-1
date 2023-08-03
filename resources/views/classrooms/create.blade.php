@section('title', 'Kelas')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Kelas
        @endslot
        @slot('li_1')
            Kelas
        @endslot
        @slot('li_2')
            Form Tambah Kelas Baru
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card">
                <form method="POST" action="{{ route('classrooms.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tahun Pelajaran<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="school_year_id" class="select select2-hidden-accessible">
                                    @foreach ($schoolYears as $year)
                                        <option value="{{ $year->id }}">{{ $year->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama Kelas<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="name" class="select select2-hidden-accessible">
                                    <option selected disabled>Pilih Kelas Kalian</option>
                                    <option>XI</option>
                                    <option>XII</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Program Keahlian<span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="vocational_program" class="select select2-hidden-accessible">
                                    <option selected disabled>Pilih Program Keahlian Kalian</option>
                                    <option>Teknik Pemanasan Tata Udara & Pendinginan</option>
                                    <option>Teknik Instalasi Tenaga Listrik</option>
                                    <option>Teknik Otomasi Industri</option>
                                    <option>Desain Permodelan dan Informasi Bangunan</option>
                                    <option>Rekayasa Perangkat Lunak</option>
                                    <option>Teknik Komputer dan Jaringan</option>
                                    <option>Teknik Kendaraan Ringan</option>
                                    <option>Teknik Bodi Kendaraan Ringan</option>
                                    <option>Teknik Elektronika Industri</option>
                                    <option>Teknik Pemesinan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Program Kompetensi<span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="vocational_competency" class="select select2-hidden-accessible">
                                    <option selected disabled>Pilih Program Kompetensi Kalian</option>
                                    <option>Teknik Ketenagalistrikan</option>
                                    <option>Teknik Desain Permodelan dan Informasi Bangunan</option>
                                    <option>Pengembangan Perangkat Lunak dan Gim</option>
                                    <option>Teknik Jaringan Komputer dan Telekomunikasi</option>
                                    <option>Teknik Otomotif</option>
                                    <option>Teknik Mesin</option>
                                    <option>Teknik Elektronika</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a class="btn btn-secondary" href="{{ route('classrooms.index') }}">Kembali</a>
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                </form>
            </div>
        @endsection
