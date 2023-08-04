@section('title', 'Kelas')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Daftar Kelas
        @endslot
        @slot('li_1')
            Kelas
        @endslot
        @slot('li_2')
            Daftar
        @endslot
        @slot('action_button')
            <a href="{{ route('classrooms.create') }}" class="btn add-btn">
                <i class="fa fa-plus"></i> Tambah Kelas Baru
            </a>
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-12">
            <form method="get">
                <div class="row filter-row">
                    <div class="col-sm-2">
                        <div class="form-group form-focus select-focus">
                            <select name="year" class="form-control">
                                @php
                                    $allYears = $activeSchoolYears->merge($inactiveSchoolYears);
                                @endphp
                                <option value="all" {{ request('year') === 'all' ? 'selected' : '' }}>Semua</option>
                                @foreach ($allYears as $year)
                                    @if ($year->is_active)
                                        <option value="{{ $year->id }}"
                                            {{ request('year') == $year->id ? 'selected' : '' }}>
                                            {{ $year->name }}
                                        </option>
                                    @else
                                        <option value="{{ $year->id }}"
                                            {{ request('year') == $year->id ? 'selected' : '' }}>
                                            {{ $year->name }} (Non-Aktif)
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <script>
                                $(document).ready(function() {
                                    $('select[name="year"]').change(function() {
                                        var selectedYear = $(this).val();
                                        var Filter = "{{ route('classrooms.index') }}" + "?year=" + selectedYear;
                                        $('#btn-filter').attr('href', Filter);
                                    });
                                });
                            </script>
                            <label class="focus-label">Tahun</label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" id="btn-filter" class="btn btn-primary w-100">Filter</button>
                    </div>
                </div>
            </form>
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <table class="table table-striped custom-table no-footer mb-0 datatable">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th>Tahun Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Program Keahlian</th>
                                    <th>Program Kompetensi</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($classrooms as $classroom)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $classroom->schoolYear->name }}</td>
                                        <td>{{ $classroom->name }}</td>
                                        <td>{{ $classroom->vocational_program }}</td>
                                        <td>{{ $classroom->vocational_competency }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('classrooms.edit', $classroom->id) }}"
                                                class="btn btn-sm btn-success">Edit</a>
                                            <button type="button"
                                                data-action="{{ route('classrooms.remove', $classroom->id) }}"
                                                data-confirm-text="Anda yakin menghapus kelas ini?"
                                                class="btn btn-danger btn-sm btn-delete btn-sm">
                                                Hapus
                                            </button>
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
