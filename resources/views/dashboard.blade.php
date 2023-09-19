@extends('layout.mainlayout')

@section('content')
    <div class="page-header">
        <h3 class="page-title">Selamat datang, {{ auth()->user()->name }}!</h3>
    </div>

    <!-- Chart Section -->
    <div class="card">
        <div class="card-header bg-blue">
            <h5 class="chart-title text-white">Grafik Pengisian Jurnal -
                {{ \Carbon\Carbon::createFromDate($selectedYear, $selectedMonth, 1)->format('F Y') }}</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('dashboard.index') }}" id="monthForm">
                <div class="d-flex">
                    <input type="month" class="form-control" name="selected_month" id="selected_month"
                        value="{{ request('selected_month', \Carbon\Carbon::now()->format('Y-m')) }}">
                </div>
            </form>

            @if (count($chartData['labels']) < 1)
                <div class="no-data-message">
                    <p>Tidak ada data yang tersedia untuk bulan ini.</p>
                </div>
            @endif

            <div class="chart-container mt-3">
                <canvas id="journalChart" style="max-height: 300px;"></canvas>
            </div>

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    <li class="page-item"><a class="page-link" id="prevButton" disabled>Sebelumnya</a></li>
                    @for ($i = 1; $i <= ceil(count($chartData['labels']) / 7); $i++)
                        <li class="page-item"><a class="page-link" id="page{{ $i }}">{{ $i }}</a></li>
                    @endfor
                    <li class="page-item"><a class="page-link" id="nextButton"
                            @if (count($chartData['labels']) <= 7) disabled @endif>Selanjutnya</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- /Chart Section -->
@endsection

@push('styles')
    <style>
        .chart-title {
            text-align: center;
            margin-top: 10px;
        }

        .card {
            width: 87%;
            margin: 0 auto;
        }

        .chart-container {
            position: relative;
            width: 100%;
            max-width: 870px;
            transition: height 1s ease-in-out;
            padding: 20px;
        }

        .chart {
            display: none;
            width: 100%;
        }

        .no-data-message {
            text-align: center;
            font-size: 18px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #888;
        }
    </style>
@endpush

@push('scripts')
    <script>
        const data = @json($chartData);
        const itemsPerPage = 7;
        let currentPage = 0;

        const ctx = document.getElementById('journalChart').getContext('2d');
        const journalChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.labels.slice(0, itemsPerPage),
                datasets: [{
                    label: 'Jumlah Pengisian per Hari',
                    data: data.counts.slice(0, itemsPerPage),
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    borderRadius: 4,
                    minBarLength: 2,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: false,
                        text: `Grafik Pengisian Jurnal`
                    }
                },
                scales: {
                    x: {
                        display: true,
                        grid: {
                            display: false
                        },
                    },
                    y: {
                        display: false,
                    }
                },
                tooltips: {
                    enabled: true,
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label: tooltipItem => tooltipItem.yLabel,
                    }
                }
            }
        });

        document.getElementById('selected_month').addEventListener('change', () => {
            document.getElementById('monthForm').submit();
        });

        function updateChart() {
            const startIndex = currentPage * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            journalChart.data.datasets[0].data = data.counts.slice(startIndex, endIndex);
            journalChart.data.labels = data.labels.slice(startIndex, endIndex);
            journalChart.update();
        }

        document.getElementById('prevButton').addEventListener('click', () => {
            if (currentPage > 0) {
                currentPage--;
                updateChart();
                document.getElementById('nextButton').disabled = false;
            }

            document.getElementById('prevButton').disabled = currentPage === 0;
        });

        document.getElementById('nextButton').addEventListener('click', () => {
            const totalItems = data.labels.length;
            const maxPage = Math.ceil(totalItems / itemsPerPage);

            if (currentPage < maxPage - 1) {
                currentPage++;
                updateChart();
                document.getElementById('prevButton').disabled = false;
            }

            document.getElementById('nextButton').disabled = currentPage === maxPage - 1;
        });

        if (data.labels.length <= itemsPerPage) {
            document.getElementById('nextButton').disabled = true;
        }
    </script>
@endpush
