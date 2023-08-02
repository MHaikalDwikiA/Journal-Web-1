<?php $page="error-404";?>
@extends('layout.errorlayout')
@section('content')
    <div class="error-box">
        <h1>404</h1>
        <h3><i class="fa fa-warning"></i> Oops! Halaman yang anda cari tidak ada!</h3>
        <br><br>
        <a href="{{ route('dashboard.index') }}" class="btn btn-custom">Kembali ke beranda</a>
    </div>
@endsection
