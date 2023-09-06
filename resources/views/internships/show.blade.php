@section('title', 'Ploting')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Data PKL
        @endslot
        @slot('li_1')
            Daftar PKL
        @endslot
        @slot('li_2')
            Lihat
        @endslot
    @endcomponent

    <x-alert />

    <div class="card mb-0" style="width: 100%;">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-view">
                        <div class="profile-img-wrap">
                            <div class="profile-img">
                                <a href=""><img alt="Profile Image"
                                        src="{{ $internship->student->photo ?? asset('assets/img/user.jpg') }}"></a>
                            </div>
                        </div>
                        <div class="profile-basic">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="profile-info-left">
                                        <h4 class="user-name m-t-0 mb-0" style="width: 100%;">
                                            {{ $internship->student->name ?? 'Data belum diisi' }}</h4>
                                        <div class="staff-id">
                                            <h6 class="text-muted">
                                                {{ $internship->student->classroom->name ?? 'Data belum diisi' }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">NIS:</div>
                                            <div class="text">{{ $internship->student->identity ?? 'Data belum diisi' }}
                                            </div>
                                        </li>
                                        <li>
                                            <div class="title">Tahun Pelajaran:</div>
                                            <div class="text">{{ $internship->schoolYear->name ?? 'Data belum diisi' }}
                                            </div>
                                        </li>
                                        <li>
                                            <div class="title">Perusahaan:</div>
                                            <div class="text">{{ $internship->company->name ?? 'Data belum diisi' }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Pembimbing Sekolah:</div>
                                            <div class="text">{{ $internship->schoolAdvisor->name ?? 'Data belum diisi' }}
                                            </div>
                                        </li>
                                        <li>
                                            <div class="title">Pembimbing Perusahaan:</div>
                                            <div class="text">
                                                {{ $internship->companyAdvisor->name ?? 'Data belum diisi' }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Hari Kerja:</div>
                                            <div class="text">{{ $internship->working_day ?? 'Data belum diisi' }}</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card tab-box">
        <div class="row user-tabs">
            <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="nav-item"><a href="#informasi_data" data-bs-toggle="tab" class="nav-link active">Informasi
                            Data</a>
                    </li>
                    <li class="nav-item"><a href="#data_staff" data-bs-toggle="tab" class="nav-link">Data Staff/Karyawan</a>
                    </li>
                    <li class="nav-item"><a href="#data_tugas_staff" data-bs-toggle="tab" class="nav-link">Data Tugas
                            Staff/Karyawan</a></li>
                    <li class="nav-item"><a href="#data_peralatan" data-bs-toggle="tab" class="nav-link">Data
                            Peralatan/Mesin</a></li>
                    <li class="nav-item"><a href="#data_kompetensi" data-bs-toggle="tab" class="nav-link">Data
                            Kompetensi</a></li>
                    <li class="nav-item"><a href="#data_saran_masukan" data-bs-toggle="tab" class="nav-link">Data Saran dan
                            Masukan</a></li>
                    <li class="nav-item"><a href="#data_jurnal" data-bs-toggle="tab" class="nav-link">Data Jurnal</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div id="informasi_data" class="pro-overview tab-pane fade show active">
            <div class="row">
                <div class="d-flex">
                    <div class="card profile-box flex-fill">
                        <div class="card-header bg-info">
                            <h4 class="card-title mb-0 text-center text-white">Identitas Siswa Praktikan</h4>
                        </div>
                        <div class="card-body">
                            <ul class="personal-info">
                                <li>
                                    <div class="title">Nama</div>
                                    <div class="text">{{ $internship->student->name ?? 'Data belum diisi' }}</div>
                                </li>
                                <li>
                                    <div class="title">NIS</div>
                                    <div class="text">{{ $internship->student->identity ?? 'Data belum diisi' }}</div>
                                </li>
                                <li>
                                    <div class="title">Tempat/Tanggal Lahir</div>
                                    <div class="text">
                                        {{ $internship->student->birth_place ?? 'Data belum diisi' }},
                                        {{ $internship->student->birth_date ?? 'Data belum diisi' }}
                                    </div>
                                </li>
                                <li>
                                    <div class="title">Jenis Kelamin</div>
                                    <div class="text">{{ $internship->student->gender ?? 'Data belum diisi' }}</div>
                                </li>
                                <li>
                                    <div class="title">Agama</div>
                                    <div class="text">{{ $internship->student->religion ?? 'Data belum diisi' }}</div>
                                </li>
                                <li>
                                    <div class="title">Gol Darah</div>
                                    <div class="text">{{ $internship->student->blood_type ?? 'Data belum diisi' }}</div>
                                </li>
                                <li>
                                    <div class="title">No Telepon</div>
                                    <div class="text">{{ $internship->student->phone ?? 'Data belum diisi' }}</div>
                                </li>
                                <li>
                                    <div class="title">Alamat</div>
                                    <div class="text">{{ $internship->student->address ?? 'Data belum diisi' }}</div>
                                </li>
                                <li>
                                    <div class="title">Nama Orang Tua</div>
                                    <div class="text">{{ $internship->student->parent_name ?? 'Data belum diisi' }}
                                    </div>
                                </li>
                                <li>
                                    <div class="title">No Telepon Orang Tua</div>
                                    <div class="text">{{ $internship->student->parent_phone ?? 'Data belum diisi' }}
                                    </div>
                                </li>
                                <li>
                                    <div class="title">Alamat Orang Tua</div>
                                    <div class="text">{{ $internship->student->parent_address ?? 'Data belum diisi' }}
                                    </div>
                                </li>
                                <li>
                                    <div class="title">Nama Pembimbing Sekolah</div>
                                    <div class="text">{{ $internship->schoolAdvisor->name ?? 'Data belum diisi' }}</div>
                                </li>
                                <li>
                                    <div class="title">No Telepon Pembimbing Sekolah</div>
                                    <div class="text">{{ $internship->schoolAdvisor->phone ?? 'Data belum diisi' }}
                                    </div>
                                </li>
                                <li>
                                    <div class="title">Alamat Pembimbing Sekolah</div>
                                    <div class="text">{{ $internship->schoolAdvisor->address ?? 'Data belum diisi' }}
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="card profile-box flex-fill">
                        <div class="card-header bg-info">
                            <h4 class="card-title mb-0 text-center text-white">Identitas Dunia Kerja</h4>
                        </div>
                        <div class="card-body">
                            <ul class="personal-info">
                                <li>
                                    <div class="title">Nama Dunia Kerja</div>
                                    <div class="text">{{ $internship->company->name ?? 'Data belum diisi' }}</div>
                                </li>
                                <li>
                                    <div class="title">Tahun Berdiri</div>
                                    <div class="text">{{ $internship->internshipCompany->since ?? 'Data belum diisi' }}
                                    </div>
                                </li>
                                @php
                                    $sectors = json_decode($internship->internshipCompany->sectors ?? 'Data belum diisi');
                                @endphp
                                @if (is_array($sectors) && count($sectors) > 0)
                                    <ul>
                                        @foreach ($sectors as $sector)
                                            <li>
                                                <div class="title">Bidang Usaha/Kerja</div>
                                                <div class="text">
                                                    {{ $sector }}
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>Data belum diisi</p>
                                @endif
                                @php
                                    $services = json_decode($internship->internshipCompany->services ?? 'Data belum diisi');
                                @endphp
                                @if (is_array($services) && count($services) > 0)
                                    <ul>
                                        @foreach ($services as $service)
                                            <li>
                                                <div class="title">Produk/Jasa yang Dilayani</div>
                                                <div class="text">
                                                    {{ $service }}
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>Data belum diisi</p>
                                @endif
                                <li>
                                    <div class="title">Alamat</div>
                                    <div class="text">
                                        {{ $internship->internshipCompany->address ?? 'Data belum diisi' }}
                                    </div>
                                </li>
                                <li>
                                    <div class="title">Nomor Telp./Fax</div>
                                    <div class="text">
                                        {{ $internship->internshipCompany->telephone ?? 'Data belum diisi' }}</div>
                                </li>
                                <li>
                                    <div class="title">Email</div>
                                    <div class="text">{{ $internship->internshipCompany->email ?? 'Data belum diisi' }}
                                    </div>
                                </li>
                                <li>
                                    <div class="title">Website</div>
                                    <div class="text">
                                        {{ $internship->internshipCompany->website ?? 'Data belum diisi' }}
                                    </div>
                                </li>
                                <li>
                                    <div class="title">Nama Direktur/Pemimpin</div>
                                    <div class="text">
                                        {{ $internship->internshipCompany->director ?? 'Data belum diisi' }}</div>
                                </li>
                                <li>
                                    <div class="title">Nomor HP/WA</div>
                                    <div class="text">
                                        {{ $internship->companyAdvisor->phone ?? 'Data belum diisi' }}</div>
                                </li>
                                @php
                                    $advisors = json_decode($internship->internshipCompany->advisors ?? 'Data belum diisi');
                                @endphp
                                @if (is_array($advisors) && count($advisors) > 0)
                                    <ul>
                                        @foreach ($advisors as $advisor)
                                            <li>
                                                <div class="title">Pembimbing</div>
                                                <div class="text">
                                                    {{ $advisor }}
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>Data belum diisi</p>
                                @endif
                                <li>
                                    <div class="title">Nomor HP/WA</div>
                                    <div class="text">
                                        {{ $internship->companyAdvisor->phone ?? 'Data belum diisi' }}
                                        <br>
                                        {{ $internship->schoolAdvisor->phone ?? 'Data belum diisi' }}
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div class="pro-overview tab-pane fade show" id="data_staff">
            <div class="card profile-box flex-fill">
                <div class="card-header bg-info">
                    <h4 class="card-title mb-0 text-center text-white">Pengenalan Staf dan Karyawan Di Tempat PKL</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table no-footer mb-0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Tanda-Tangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($internship->companyEmployees as $employee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $employee->name ?? 'Data belum diisi' }}</td>
                                        <td>{{ $employee->jobTitle->name ?? 'Data belum diisi' }}</td>
                                        <td>{{ $employee->approval_by ?? 'Data belum diisi' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="pro-overview tab-pane fade show" id="data_tugas_staff">
            <div class="card profile-box flex-fill">
                <div class="card-header bg-info">
                    <h4 class="card-title mb-0 text-center text-white">Deskripsi Uraian Tugas Staf/Karyawan di Tempat PKL
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table no-footer mb-0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jabatan</th>
                                    <th>Deskripsi Tugas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($internship->companyJobTitles as $jobTitle)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $jobTitle->name ?? 'Data belum diisi' }}</td>
                                        <td>{{ $jobTitle->description ?? 'Data belum diisi' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="pro-overview tab-pane fade show" id="data_peralatan">
            <div class="card profile-box flex-fill">
                <div class="card-header bg-info">
                    <h4 class="card-title mb-0 text-center text-white">Peralatan/Mesin yang Digunakan di Tempat PKL</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table no-footer mb-0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Alat/Mesin</th>
                                    <th>Spesifikasi</th>
                                    <th>Kegunaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($internship->equipments as $equipment)
                                    <tr>
                                        <td>{{ $loop->iteration ?? 'Data belum diisi' }}</td>
                                        <td>{{ $equipment->tool ?? 'Data belum diisi' }}</td>
                                        <td>{{ $equipment->spesification ?? 'Data belum diisi' }}</td>
                                        <td>{{ $equipment->utility ?? 'Data belum diisi' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="pro-overview tab-pane fade show" id="data_kompetensi">
            <div class="card profile-box flex-fill">
                <div class="card-header bg-info">
                    <h4 class="mb-0 text-center text-white">Daftar Kompetensi yang Didapatkan di Tempat PKL</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table no-footer mb-0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kompetensi</th>
                                    <th>Jenis Pekerjaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($internship->competencies as $competency)
                                    <tr>
                                        <td>{{ $loop->iteration ?? 'Data belum diisi' }}</td>
                                        <td>{{ $competency->competency ?? 'Data belum diisi' }}</td>
                                        <td>{{ $competency->description ?? 'Data belum diisi' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="pro-overview tab-pane fade show" id="data_saran_masukan">
            <div class="card profile-box flex-fill">
                <div class="card-header bg-info">
                    <h4 class="card-title mb-0 text-center text-white">Saran dan Masukan Dari Pembimbing Dunia Kerja Untuk
                        Siswa dan Sekolah</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table no-footer mb-0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Saran-Saran</th>
                                    <th>Paraf</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($internship->suggestions as $suggestion)
                                    <tr>
                                        <td>{{ $loop->iteration ?? 'Data belum diisi' }}</td>
                                        <td>{{ $suggestion->employee->name ?? 'Data belum diisi' }}</td>
                                        <td>{{ $suggestion->employee->jobTitle->name ?? 'Data belum diisi' }}</td>
                                        <td>{{ $suggestion->suggest ?? 'Data belum diisi' }}</td>
                                        <td>
                                            {{ $suggestion->user->name }}
                                            <h6 style="color: #0d6efd">{{ $suggestion->approval_by }}</h6>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="pro-overview tab-pane fade show" id="data_jurnal">
            <div class="card profile-box flex-fill">
                <div class="card-header bg-info">
                    <h4 class="card-title mb-0 text-center text-white">Jurnal Kegiatan Siswa Praktikan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table no-footer mb-0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Hari/Tanggal</th>
                                    <th>Kegiatan yang Dilakukan</th>
                                    <th>Foto Kegiatan</th>
                                    <th>Kompetensi yang Didapatkan</th>
                                    <th>Paraf Pembimbing</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($internship->journals as $journal)
                                    <tr>
                                        <td>{{ $loop->iteration ?? 'Data belum diisi' }}</td>
                                        <td>{{ $journal->date ?? 'Data belum diisi' }}</td>
                                        <td>{{ $journal->activity ?? 'Data belum diisi' }}</td>
                                        <td>{{ $journal->activity_image ?? 'Data belum diisi' }}</td>
                                        <td>{{ $journal->competency->competency ?? 'Data belum diisi' }}</td>
                                        <td>
                                            {{ $journal->user->name ?? 'Data belum diisi' }}
                                            <h6 style="color: #0d6efd">{{ $journal->approval_by ?? 'Data belum diisi' }}
                                            </h6>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
