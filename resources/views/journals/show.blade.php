@section('title', 'Detail Jurnal PKL')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Detail Jurnal PKL
        @endslot
        @slot('li_1')
            Jurnal PKL
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
                                    <td>Nama</td>
                                    <td>{{ $journal->internship->student->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>{{ $journal->date ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Aktivitas</td>
                                    <td>{{ $journal->activity ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Gambar Aktivitas</td>
                                    <td><img src="{{ \Storage::url($journal->activity_image ?? '') }}" class="img-fluid"
                                            width="500">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kompetensi</td>
                                    <td>{{ $journal->competency->competency ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Deskripsi</td>
                                    <td>{{ $journal->competency->description ?? '' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="text-end m-4">
                    <a href="{{ route('journals.index') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
