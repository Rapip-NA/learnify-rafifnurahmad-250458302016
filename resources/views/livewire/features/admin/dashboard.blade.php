<div>
    <div class="page-heading mb-4">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3 class="mb-2">
                        <i class="bi bi-speedometer2 text-primary me-2"></i>
                        Admin Dashboard
                    </h3>
                    <p class="text-subtitle text-muted">Monitoring dan analitik sistem</p>
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
            {{-- Total Users --}}
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon purple mb-2">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Total Users</h6>
                                <h6 class="font-extrabold mb-0">{{ $stats['totalUsers'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Competitions --}}
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
                                <h6 class="text-muted font-semibold">Kompetisi</h6>
                                <h6 class="font-extrabold mb-0">{{ $stats['totalCompetitions'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Questions --}}
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon green mb-2">
                                    <i class="bi bi-question-circle-fill"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Total Soal</h6>
                                <h6 class="font-extrabold mb-0">{{ $stats['totalQuestions'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Participations --}}
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon red mb-2">
                                    <i class="bi bi-person-check-fill"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Partisipasi</h6>
                                <h6 class="font-extrabold mb-0">{{ number_format($stats['totalParticipations'], 0) }}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CHARTS SECTION --}}
        <div class="row mb-4">
            {{-- Top Competitions Chart --}}
            <div class="col-lg-12 col-md-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="bi bi-bar-chart-fill text-primary me-2"></i>
                            Top 5 Kompetisi
                        </h4>
                    </div>
                    <div class="card-body">
                        @if ($topCompetitions->count() > 0)
                            <div id="topCompetitionsChart"></div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted mt-3">Belum ada kompetisi</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Competition Status Chart --}}
            <div class="col-lg-4 col-md-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="bi bi-pie-chart-fill text-primary me-2"></i>
                            Status Kompetisi
                        </h4>
                    </div>
                    <div class="card-body">
                        @if ($stats['totalCompetitions'] > 0)
                            <div id="competitionStatusChart"></div>
                        @else
                            <div class="text-center py-4">
                                <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted mt-3">Belum ada data</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- RECENT COMPETITIONS & USER BREAKDOWN --}}
        <div class="row mb-4">
            {{-- Recent Competitions --}}
            <div class="col-lg-8 col-md-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="bi bi-clock-history text-primary me-2"></i>
                            Kompetisi Terbaru
                        </h4>
                    </div>
                    <div class="card-body">
                        @if ($recentCompetitions->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Kompetisi</th>
                                            <th>Status</th>
                                            <th>Pembuat</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentCompetitions as $competition)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-trophy text-warning me-2"></i>
                                                        <strong>{{ $competition->title }}</strong>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($competition->status === 'active')
                                                        <span class="badge bg-success">Active</span>
                                                    @elseif ($competition->status === 'draft')
                                                        <span class="badge bg-secondary">Draft</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <small
                                                        class="text-muted">{{ $competition->creator->name ?? '-' }}</small>
                                                </td>
                                                <td>
                                                    <small
                                                        class="text-muted">{{ $competition->created_at->format('d M Y') }}</small>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted mt-3">Belum ada kompetisi</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- User Breakdown Chart --}}
            <div class="col-lg-4 col-md-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="bi bi-people text-primary me-2"></i>
                            User by Role
                        </h4>
                    </div>
                    <div class="card-body">
                        @if ($stats['totalUsers'] > 0)
                            <div id="userRoleChart"></div>
                        @else
                            <div class="text-center py-4">
                                <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted mt-3">Belum ada user</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- ADDITIONAL METRICS --}}
        <div class="row">
            {{-- Average Score --}}
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-star-fill text-warning" style="font-size: 2.5rem;"></i>
                        <h5 class="mt-3 mb-1">{{ number_format($metrics['avgScore'], 2) }}</h5>
                        <p class="text-muted small mb-0">Rata-rata Skor</p>
                    </div>
                </div>
            </div>

            {{-- Completion Rate --}}
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 2.5rem;"></i>
                        <h5 class="mt-3 mb-1">{{ $metrics['completionRate'] }}%</h5>
                        <p class="text-muted small mb-0">Tingkat Penyelesaian</p>
                    </div>
                </div>
            </div>

            {{-- Active Users --}}
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-person-badge-fill text-primary" style="font-size: 2.5rem;"></i>
                        <h5 class="mt-3 mb-1">{{ number_format($metrics['activeUsers'], 0) }}</h5>
                        <p class="text-muted small mb-0">User Aktif (30 hari)</p>
                    </div>
                </div>
            </div>

            {{-- Total Answers --}}
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-chat-left-text-fill text-info" style="font-size: 2.5rem;"></i>
                        <h5 class="mt-3 mb-1">{{ number_format($metrics['totalAnswers'], 0) }}</h5>
                        <p class="text-muted small mb-0">Total Jawaban</p>
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
        // Top Competitions Bar Chart
        @if ($topCompetitions->count() > 0)
            const topCompOptions = {
                series: [{
                    name: 'Partisipasi',
                    data: @json($topCompetitions->pluck('participants_count')->toArray())
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
                        horizontal: true,
                        dataLabels: {
                            position: 'top',
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                    offsetX: 30,
                    style: {
                        fontSize: '12px',
                        colors: ["#304758"]
                    }
                },
                xaxis: {
                    categories: @json($topCompetitions->pluck('title')->toArray()),
                    title: {
                        text: 'Jumlah Partisipasi'
                    }
                },
                colors: ['#435ebe'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: 'horizontal',
                        shadeIntensity: 0.3,
                        opacityFrom: 0.9,
                        opacityTo: 0.7,
                    }
                }
            };

            const topCompChart = new ApexCharts(document.querySelector("#topCompetitionsChart"),
            topCompOptions);
            topCompChart.render();
        @endif

        // Competition Status Donut Chart
        @if ($stats['totalCompetitions'] > 0)
            const statusOptions = {
                series: [
                    {{ $competitionsByStatus['draft'] }},
                    {{ $competitionsByStatus['active'] }},
                    {{ $competitionsByStatus['inactive'] }}
                ],
                chart: {
                    type: 'donut',
                    height: 280
                },
                labels: ['Draft', 'Active', 'Inactive'],
                colors: ['#6c757d', '#198754', '#dc3545'],
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
                                        return {{ $stats['totalCompetitions'] }}
                                    }
                                }
                            }
                        }
                    }
                },
                dataLabels: {
                    enabled: true
                }
            };

            const statusChart = new ApexCharts(document.querySelector("#competitionStatusChart"),
            statusOptions);
            statusChart.render();
        @endif

        // User Role Donut Chart
        @if ($stats['totalUsers'] > 0)
            const roleOptions = {
                series: [
                    {{ $usersByRole['peserta'] }},
                    {{ $usersByRole['qualifier'] }},
                    {{ $usersByRole['admin'] }}
                ],
                chart: {
                    type: 'donut',
                    height: 280
                },
                labels: ['Peserta', 'Qualifier', 'Admin'],
                colors: ['#435ebe', '#9694ff', '#ff7976'],
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
                                        return {{ $stats['totalUsers'] }}
                                    }
                                }
                            }
                        }
                    }
                },
                dataLabels: {
                    enabled: true
                }
            };

            const roleChart = new ApexCharts(document.querySelector("#userRoleChart"), roleOptions);
            roleChart.render();
        @endif
    });
</script>
