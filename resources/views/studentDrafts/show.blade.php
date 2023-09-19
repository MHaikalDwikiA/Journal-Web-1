@section('title', 'Persetujuan Data Siswa')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Persetujuan Data Siswa
        @endslot
        @slot('li_1')
            Persetujuan Data Siswa
        @endslot
        @slot('li_2')
            Lihat Persetujuan Data Siswa
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <p>Informasi Pribadi</p>
                </div>
                <div class="card-body">
                    @if (isset($studentDraft->description))
                        @php
                            $description = json_decode($studentDraft->description, true);
                        @endphp
                        @if (is_array($description))
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Nama Siswa</label>
                                <div class="col-lg-9">
                                    @if (isset($description['name']))
                                        <input type="text" class="form-control" value="{{ $description['name'] }}"
                                            readonly>
                                    @else
                                        <input type="text" class="form-control" value="-" readonly>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Tempat Lahir</label>
                                <div class="col-lg-9">
                                    @if (isset($description['birth_place']))
                                        <input type="text" class="form-control" value="{{ $description['birth_place'] }}"
                                            readonly>
                                    @else
                                        <input type="text" class="form-control" value="-" readonly>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Tanggal Lahir</label>
                                <div class="col-lg-9">
                                    @if (isset($description['birth_date']))
                                        <input type="date" class="form-control" value="{{ $description['birth_date'] }}"
                                            readonly>
                                    @else
                                        <input type="date" class="form-control" value="-" readonly>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Nomer Telepon</label>
                                <div class="col-lg-9">
                                    @if (isset($description['phone']))
                                        <input type="text" class="form-control" value="{{ $description['phone'] }}"
                                            readonly>
                                    @else
                                        <input type="text" class="form-control" value="-" readonly>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Kelamin</label>
                                <div class="col-lg-9">
                                    @if (isset($description['gender']))
                                        <input type="text" class="form-control" value="{{ $description['gender'] }}"
                                            readonly>
                                    @else
                                        <input type="text" class="form-control" value="-" readonly>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Agama</label>
                                <div class="col-lg-9">
                                    @if (isset($description['religion']))
                                        <input type="text" class="form-control" value="{{ $description['religion'] }}"
                                            readonly>
                                    @else
                                        <input type="text" class="form-control" value="-" readonly>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Golongan Darah</label>
                                <div class="col-lg-9">
                                    @if (isset($description['blood_type']))
                                        <input type="text" class="form-control" value="{{ $description['blood_type'] }}"
                                            readonly>
                                    @else
                                        <input type="text" class="form-control" value="-" readonly>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Alamat</label>
                                <div class="col-lg-9">
                                    @if (isset($description['address']))
                                        <input type="text" class="form-control" value="{{ $description['address'] }}"
                                            readonly>
                                    @else
                                        <input type="text" class="form-control" value="-" readonly>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <p>Data Orang Tua</p>
                </div>
                <div class="card-body">
                    @if (isset($studentDraft->description))
                        @php
                            $description = json_decode($studentDraft->description, true);
                        @endphp
                        @if (is_array($description))
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Nama Orang Tua/Wali</label>
                                <div class="col-lg-9">
                                    @if (isset($description['parent_name']))
                                        <input type="text" class="form-control" value="{{ $description['parent_name'] }}"
                                            readonly>
                                    @else
                                        <input type="text" class="form-control" value="-" readonly>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Nomer Orang Tua/Wali</label>
                                <div class="col-lg-9">
                                    @if (isset($description['parent_phone']))
                                        <input type="text" class="form-control"
                                            value="{{ $description['parent_phone'] }}" readonly>
                                    @else
                                        <input type="text" class="form-control" value="-" readonly>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Alamat Orang Tua/Wali</label>
                                <div class="col-lg-9">
                                    @if (isset($description['parent_address']))
                                        <input type="text" class="form-control"
                                            value="{{ $description['parent_address'] }}" readonly>
                                    @else
                                        <input type="text" class="form-control" value="-" readonly>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <p>Data Sekolah</p>
                </div>
                <div class="card-body">
                    @if (isset($studentDraft->description))
                        @php
                            $description = json_decode($studentDraft->description, true);
                        @endphp
                        @if (is_array($description))
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Jadwal PKL</label>
                                <div class="col-lg-9">
                                    @if (isset($description['working_day']))
                                        <input type="text" class="form-control"
                                            value="{{ $description['working_day'] }}" readonly>
                                    @else
                                        <input type="text" class="form-control" value="-" readonly>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
            <div class="card-footer text-end">
                <form id="updateForm" action="{{ route('studentDrafts.update') }}" method="POST"
                    style="display: none;">
                    @method('put')
                    @csrf
                    <input type="hidden" name="student_id" id="student_id">
                    <input type="hidden" name="approval_user_id" id="approval_user_id">
                    <input type="hidden" name="approval_status" id="approval_status">
                </form>
                @if ($studentDraft->approval_status === 'Menunggu Persetujuan')
                    <button class="btn btn-danger" onclick="tolak()">Tolak</button>
                    <button class="btn btn-success" onclick="terima()">Terima</button>
                @endif
                <a class="btn btn-secondary" href="{{ route('studentDrafts.index') }}">Kembali</a>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function tolak() {
            document.getElementById("student_id").value = {{ $studentDraft->student->id }};
            document.getElementById("approval_user_id").value = {{ auth()->user()->id }};

            document.getElementById("approval_status").value = "Tolak";

            document.getElementById("updateForm").submit();
        }

        function terima() {
            document.getElementById("student_id").value = {{ $studentDraft->student->id }};
            document.getElementById("approval_user_id").value = {{ auth()->user()->id }};

            document.getElementById("approval_status").value = "Terima";

            document.getElementById("updateForm").submit();
        }
    </script>
@endpush
