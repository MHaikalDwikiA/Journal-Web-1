@extends('layout.mainlayout')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Selamat datang, {{ auth()->user()->name }}!</h3>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Chart Section -->
    <div class="card">
        <div class="card-header bg-blue">
            <h4 class="card-title">Grafik Pengisian Jurnal</h4>
        </div>
        <div class="card-body">
            <canvas id="journalChart" width="100" height="10"></canvas>
        </div>
    </div>
    <!-- /Chart Section -->
@endsection

@push('styles')
    <style>
        .card {
            width: 87%;
            margin: 0 auto;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        var data = @json($chartData);
        var ctx = document.getElementById('journalChart').getContext('2d');
        var maxDataPerChart = 7;
        console.log(data);

        function createChart(labels, counts, index) {
            var chartCanvas = document.createElement('canvas');
            ctx.canvas.parentNode.appendChild(chartCanvas);
            var chartCtx = chartCanvas.getContext('2d');

            new Chart(chartCtx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Pengisian per Hari',
                        data: counts,
                        backgroundColor: 'blue',
                        borderColor: 'blue',
                        borderRadius: 4,
                        barPercentage: 0.5,
                        minBarLength: 2,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: true,
                        title: {
                            display: true,
                            text: 'Grafik Pengisian Jurnal Per Minggu (Bagian ' + (index + 1) + ')'
                        }
                    },
                    scales: {
                        x: {
                            display: true,
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
                            label: function(tooltipItem) {
                                return tooltipItem.yLabel;
                            }
                        }
                    }
                }
            });
        }

        for (var i = 0; i * maxDataPerChart < data.labels.length; i++) {
            var startIndex = i * maxDataPerChart;
            var labelsSubset = data.labels.slice(startIndex, startIndex + maxDataPerChart).map(date => moment(date).format(
                'dddd, D MMM'));
            var countsSubset = data.counts.slice(startIndex, startIndex + maxDataPerChart);

            createChart(labelsSubset, countsSubset, i);
        }
    </script>
@endpush
