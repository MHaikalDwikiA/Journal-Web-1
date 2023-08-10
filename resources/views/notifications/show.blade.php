@section('title', 'Detail Notifikasi')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Notifikasi
        @endslot
        @slot('li_1')
            Notifikasi
        @endslot
        @slot('li_2')
            Detail Notifikasi
        @endslot
    @endcomponent

    <x-alert />

    <div class="card">
        <div class="card-header">
            <h4 style="font-weight: 600">Detail Notifikasi</h4>
        </div>
        <div class="card-body">
            <h4 style="font-weight: 600">Judul Notifikasi</h4>
            <div>
                <p>{{ $notifications->title }}</p>
                <h4 style="font-weight: 600">Deskripsi</h4>
                <p>{{ $notifications->description }}</p>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <p class="text-muted">Tanggal Dibuat : {{ $notifications->date }}</p>
            <a class="btn btn-secondary" href="{{ route('notifications.index') }}">Kembali</a>
        </div>
    </div>
@endsection
