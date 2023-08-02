@section('title', 'Profile Sekolah')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Profil Sekolah
        @endslot
        @slot('li_1')
            Profil
        @endslot
        @slot('li_2')
            Sekolah
        @endslot
    @endcomponent
    <x-alert />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-md-6 col-12">
                            <label>Nama Sekolah</label>
                            <input type="text" class="form-control" value="{{ $school->name }}" readonly>
                        </div>
                        <div class="col-md-6 col-12">
                            <label>NPSN</label>
                            <input type="text" class="form-control" value="{{ $school->npsn }}" readonly>
                        </div>
                        <div class="col-md-6 col-12">
                            <label>Alamat</label>
                            <input type="text" class="form-control" value="{{ $school->address }}" readonly>
                        </div>
                        <div class="col-md-6 col-12">
                            <label>Kelurahan</label>
                            <input type="text" class="form-control" value="{{ $school->kelurahan }}" readonly>
                        </div>
                        <div class="col-md-6 col-12">
                            <label>Kecamatan</label>
                            <input type="text" class="form-control" value="{{ $school->kecamatan }}" readonly>
                        </div>
                        <div class="col-12">
                            <div class="d-flex">
                                <a href="{{ route('school.edit', $school->id) }}"
                                    class="btn btn-sm btn-primary ms-auto">Edit Sekolah</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
