<?php $page = 'error-500'; ?>
@extends('layout.mainlayout')
@section('content')

    <body class="error-page">

        <!-- Main Wrapper -->
        <div class="main-wrapper">

		<div class="error-box">
			<h1>500</h1>
			<h3><i class="fa fa-warning"></i> Oops! Something went wrong</h3>
			<br><br>
			<a href="{{ route('dashboard.index') }}" class="btn btn-custom">Kembali ke beranda</a>
		</div>
@endsection
