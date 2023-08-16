@section('title', 'Ploting')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Daftar Ploting
        @endslot
        @slot('li_1')
            Ploting
        @endslot
        @slot('li_2')
            Daftar
        @endslot
    @endcomponent

    <x-alert />

    <div class="card mb-0">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-view">
                        <div class="profile-img-wrap">
                            <div class="profile-img">
                                <a href=""><img alt="Profile Image" src="{{ $internships->student->photo }}"></a>
                            </div>
                        </div>
                        <div class="profile-basic">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="profile-info-left">
                                        <h3 class="user-name m-t-0 mb-0">{{ $internships->student->name }}</h3>
                                        <h6 class="text-muted">{{ $internships->student->identity }}</h6>
                                        {{-- <small class="text-muted">{{ $internships->user->role }}</small> --}}
                                        <div class="staff-id">{{ $internships->student->classroom->vocational_program }}
                                        </div>
                                        <div class="small doj text-muted">
                                            {{ $internships->student->classroom->vocational_competency }}</div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Tahun Pelajaran:</div>
                                            <div class="text"><a href="">{{ $internships->schoolYear->name }}</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="title">NIS:</div>
                                            <div class="text">{{ $internships->student->identity }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Perusahaan:</div>
                                            <div class="text">{{ $internships->company->name }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Pembimbing Sekolah:</div>
                                            {{-- <div class="text">{{ $internships->schoolAdvisor->name }}</div> --}}
                                        </li>
                                        <li>
                                            <div class="title">Pembimbing Perusahaan:</div>
                                            <div class="text">
                                                {{-- <a href="{{ route('company-advisors.index') }}"> --}}
                                                {{-- {{ $internships->companyAdvisor->name }} </a> --}}
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="pro-edit">
                            <a data-bs-target="#profile_info" data-bs-toggle="modal" class="edit-icon" href="#">
                                <i class="fa fa-pencil"></i>
                            </a>
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
                    <li class="nav-item"><a href="#emp_profile" data-bs-toggle="tab" class="nav-link active">Informasi
                            Data</a>
                    </li>
                    <li class="nav-item"><a href="#emp_projects" data-bs-toggle="tab" class="nav-link">Projects</a></li>
                    <li class="nav-item"><a href="#bank_statutory" data-bs-toggle="tab" class="nav-link">Bank & Statutory
                            <small class="text-danger">(Admin Only)</small></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div id="emp_profile" class="pro-overview tab-pane fade show active">
            <div class="row">
                <div class="col-md-6 d-flex">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <h3 class="card-title">Data Pribadi</h3>
                            <ul class="personal-info">
                                <li>
                                    <div class="title">Nama</div>
                                    <div class="text">{{ $internships->student->name }}</div>
                                </li>
                                <li>
                                    <div class="title">NIS</div>
                                    <div class="text">{{ $internships->student->identity }}</div>
                                </li>
                                <li>
                                    <div class="title">Tempat/Tanggal Lahir</div>
                                    <div class="text">
                                        {{ $internships->student->birth_place }}, {{ $internships->student->birth_date }}
                                    </div>
                                </li>
                                <li>
                                    <div class="title">Jenis Kelamin</div>
                                    <div class="text">{{ $internships->student->gender }}</div>
                                </li>
                                <li>
                                    <div class="title">Agama</div>
                                    <div class="text">{{ $internships->student->religion }}</div>
                                </li>
                                <li>
                                    <div class="title">Gol Darah</div>
                                    <div class="text">{{ $internships->student->blood_type }}</div>
                                </li>
                                <li>
                                    <div class="title">No Telepon</div>
                                    <div class="text">{{ $internships->student->phone }}</div>
                                </li>
                                <li>
                                    <div class="title">Alamat</div>
                                    <div class="text">{{ $internships->student->address }}</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <h3 class="card-title">Data Orang Tua</h3>
                            <ul class="personal-info">
                                <li>
                                    <div class="title">Nama Orang Tua</div>
                                    <div class="text">{{ $internships->student->parent_name }}</div>
                                </li>
                                <li>
                                    <div class="title">No Hp Orang Tua</div>
                                    <div class="text">{{ $internships->student->parent_phone }}</div>
                                </li>
                                <li>
                                    <div class="title">Alamat Orang Tua</div>
                                    <div class="text">{{ $internships->student->parent_address }}</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 d-flex">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <h3 class="card-title">Bank information</h3>
                            <ul class="personal-info">
                                <li>
                                    <div class="title">Bank name</div>
                                    <div class="text">ICICI Bank</div>
                                </li>
                                <li>
                                    <div class="title">Bank account No.</div>
                                    <div class="text">159843014641</div>
                                </li>
                                <li>
                                    <div class="title">IFSC Code</div>
                                    <div class="text">ICI24504</div>
                                </li>
                                <li>
                                    <div class="title">PAN No</div>
                                    <div class="text">TC000Y56</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <h3 class="card-title">Family Informations <a href="#" class="edit-icon"
                                    data-bs-toggle="modal" data-bs-target="#family_info_modal"><i
                                        class="fa fa-pencil"></i></a></h3>
                            <div class="table-responsive">
                                <table class="table table-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Relationship</th>
                                            <th>Date of Birth</th>
                                            <th>Phone</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Leo</td>
                                            <td>Brother</td>
                                            <td>Feb 16th, 2019</td>
                                            <td>9876543210</td>
                                            <td class="text-end">
                                                <div class="dropdown dropdown-action">
                                                    <a aria-expanded="false" data-bs-toggle="dropdown"
                                                        class="action-icon dropdown-toggle" href="#"><i
                                                            class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="#" class="dropdown-item"><i
                                                                class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <a href="#" class="dropdown-item"><i
                                                                class="fa-regular fa-trash-can m-r-5"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 d-flex">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <h3 class="card-title">Education Informations <a href="#" class="edit-icon"
                                    data-bs-toggle="modal" data-bs-target="#education_info"><i
                                        class="fa fa-pencil"></i></a></h3>
                            <div class="experience-box">
                                <ul class="experience-list">
                                    <li>
                                        <div class="experience-user">
                                            <div class="before-circle"></div>
                                        </div>
                                        <div class="experience-content">
                                            <div class="timeline-content">
                                                <a href="#/" class="name">International College of Arts and Science
                                                    (UG)</a>
                                                <div>Bsc Computer Science</div>
                                                <span class="time">2000 - 2003</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="experience-user">
                                            <div class="before-circle"></div>
                                        </div>
                                        <div class="experience-content">
                                            <div class="timeline-content">
                                                <a href="#/" class="name">International College of Arts and Science
                                                    (PG)</a>
                                                <div>Msc Computer Science</div>
                                                <span class="time">2000 - 2003</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <h3 class="card-title">Experience <a href="#" class="edit-icon" data-bs-toggle="modal"
                                    data-bs-target="#experience_info"><i class="fa fa-pencil"></i></a></h3>
                            <div class="experience-box">
                                <ul class="experience-list">
                                    <li>
                                        <div class="experience-user">
                                            <div class="before-circle"></div>
                                        </div>
                                        <div class="experience-content">
                                            <div class="timeline-content">
                                                <a href="#/" class="name">Web Designer at Zen Corporation</a>
                                                <span class="time">Jan 2013 - Present (5 years 2 months)</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="experience-user">
                                            <div class="before-circle"></div>
                                        </div>
                                        <div class="experience-content">
                                            <div class="timeline-content">
                                                <a href="#/" class="name">Web Designer at Ron-tech</a>
                                                <span class="time">Jan 2013 - Present (5 years 2 months)</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="experience-user">
                                            <div class="before-circle"></div>
                                        </div>
                                        <div class="experience-content">
                                            <div class="timeline-content">
                                                <a href="#/" class="name">Web Designer at Dalt Technology</a>
                                                <span class="time">Jan 2013 - Present (5 years 2 months)</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
