@section('title', 'Detail Pengumuman')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Pengumuman
        @endslot
        @slot('li_1')
            Pengumuman
        @endslot
        @slot('li_2')
            Detail Pengumuman
        @endslot
    @endcomponent

    <x-alert />

    <div class="card bg-light">
        <div class="card-header">
            <h4 style="font-weight: 600">Detail Pengumuman</h4>
        </div>
        <div class="card-body">
            <h4 style="font-weight: 600">Judul Pengumuman</h4>
            <div>
                <p>{{ $announcement->title }}</p>
                <h4 style="font-weight: 600">Deskripsi</h4>
                <p>{{ $announcement->description }}</p>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <p class="text-muted">Tanggal Dibuat : {{ $announcement->date }}</p>
            <a class="btn btn-secondary" href="{{ route('announcements.index') }}">Kembali</a>
        </div>
    </div>
@endsection
