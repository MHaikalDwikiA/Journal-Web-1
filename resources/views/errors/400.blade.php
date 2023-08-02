@extends('layout.errorlayout')
@section('content')
    <div class="error-box">
        <h1>400</h1>
        <h3><i class="fa fa-warning"></i> Oops!</h3>
        <p>{{ $exception->getMessage() }}</p>
        <a href="{{ route('dashboard.index') }}" class="btn btn-custom">Kembali ke beranda</a>
    </div>
@endsection
