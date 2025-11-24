<div>
    <div class="page-heading mb-4">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3 class="mb-2">
                        <i class="bi bi-speedometer2 text-primary me-2"></i>
                        Dashboard Peserta
                    </h3>
                    <p class="text-subtitle text-muted">Selamat datang kembali, {{ Auth::user()->name }}!</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        {{-- STATISTICS CARDS --}}
        <div class="row mb-4">
            {{-- Total Kompetisi --}}
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon blue mb-2">
                                    <i class="bi bi-trophy-fill"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Total Kompetisi</h6>
                                <h6 class="font-extrabold mb-0">{{ $stats['totalParticipations'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kompetisi Selesai --}}
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon green mb-2">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Selesai</h6>
                                <h6 class="font-extrabold mb-0">{{ $stats['completedCompetitions'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Skor --}}
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon purple mb-2">
                                    <i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Total Skor</h6>
                                <h6 class="font-extrabold mb-0">{{ number_format($stats['totalScore'], 0) }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Rata-rata Skor --}}
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon red mb-2">
                                    <i class="bi bi-graph-up"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Rata-rata</h6>
                                <h6 class="font-extrabold mb-0">{{ number_format($stats['avgScore'], 2) }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CHARTS SECTION --}}
        <div class="row mb-4">
            {{-- Performance Bar Chart --}}
            <div class="col-lg-8 col-md-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="bi bi-bar-chart-fill text-primary me-2"></i>
                            Performa Kompetisi
                        </h4>
                    </div>
                    <div class="card-body">
                        @if (count($chartData['competitions']) > 0)
                            <div id="performanceBarChart"></div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted mt-3">Belum ada kompetisi yang diselesaikan</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Completion Donut Chart --}}
            <div class="col-lg-4 col-md-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="bi bi-pie-chart-fill text-primary me-2"></i>
                            Status Kompetisi
                        </h4>
                    </div>
                    <div class="card-body">
                        @if ($stats['totalParticipations'] > 0)
                            <div id="completionDonutChart"></div>
                            <div class="text-center mt-3">
                                <h5 class="mb-0">{{ $completionData['percentage'] }}%</h5>
                                <p class="text-muted small">Tingkat Penyelesaian</p>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted mt-3">Belum ada kompetisi</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- RECENT ACTIVITIES --}}
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="bi bi-clock-history text-primary me-2"></i>
                            Aktivitas Terbaru
                        </h4>
                    </div>
                    <div class="card-body">
                        @if ($recentActivities->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Kompetisi</th>
                                            <th>Status</th>
                                            <th>Skor</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentActivities as $activity)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-trophy text-warning me-2"></i>
                                                        <strong>{{ $activity->competition->title }}</strong>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($activity->finished_at)
                                                        <span class="badge bg-success">
                                                            <i class="bi bi-check-circle me-1"></i>
                                                            Selesai
                                                        </span>
                                                    @else
                                                        <span class="badge bg-warning">
                                                            <i class="bi bi-hourglass-split me-1"></i>
                                                            Dalam Progress
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong class="text-primary">{{ $activity->total_score }}</strong>
                                                </td>
                                                <td>
                                                    <small class="text-muted">
                                                        {{ $activity->started_at?->format('d M Y, H:i') ?? '-' }}
                                                    </small>
                                                </td>
                                                <td>
                                                    @if ($activity->finished_at)
                                                        <a href="{{ route('peserta.competitions.result', $activity->competition_id) }}"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="bi bi-eye me-1"></i>
                                                            Lihat Hasil
                                                        </a>
                                                    @else
                                                        <a href="{{ route('peserta.competitions.quiz', $activity->competition_id) }}"
                                                            class="btn btn-sm btn-success">
                                                            <i class="bi bi-play-fill me-1"></i>
                                                            Lanjutkan
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted mt-3 mb-3">Belum ada aktivitas</p>
                                <a href="{{ route('peserta.competitions.list') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-1"></i>
                                    Mulai Kompetisi
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ApexCharts Library --}}
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Performance Bar Chart
        @if (count($chartData['competitions']) > 0)
            const performanceOptions = {
                series: [{
                    name: 'Skor',
                    data: @json($chartData['scores'])
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: {
                        show: true,
                        tools: {
                            download: true,
                            selection: false,
                            zoom: false,
                            zoomin: false,
                            zoomout: false,
                            pan: false,
                            reset: false
                        }
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 8,
                        dataLabels: {
                            position: 'top',
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                    offsetY: -20,
                    style: {
                        fontSize: '12px',
                        colors: ["#304758"]
                    }
                },
                xaxis: {
                    categories: @json($chartData['competitions']),
                    labels: {
                        rotate: -45,
                        rotateAlways: true,
                        style: {
                            fontSize: '11px'
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: 'Skor'
                    }
                },
                colors: ['#435ebe'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: 'vertical',
                        shadeIntensity: 0.3,
                        opacityFrom: 0.9,
                        opacityTo: 0.7,
                    }
                }
            };

            const performanceChart = new ApexCharts(document.querySelector("#performanceBarChart"),
                performanceOptions);
            performanceChart.render();
        @endif

        // Completion Donut Chart
        @if ($stats['totalParticipations'] > 0)
            const donutOptions = {
                series: [{{ $completionData['completed'] }}, {{ $completionData['inProgress'] }}],
                chart: {
                    type: 'donut',
                    height: 280
                },
                labels: ['Selesai', 'Dalam Progress'],
                colors: ['#198754', '#ffc107'],
                legend: {
                    position: 'bottom'
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total',
                                    formatter: function(w) {
                                        return {{ $stats['totalParticipations'] }}
                                    }
                                }
                            }
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val, opts) {
                        return opts.w.config.series[opts.seriesIndex]
                    }
                }
            };

            const donutChart = new ApexCharts(document.querySelector("#completionDonutChart"), donutOptions);
            donutChart.render();
        @endif
    });
</script>
