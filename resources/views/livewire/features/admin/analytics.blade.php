<div>
    <div class="page-heading mb-4">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3 class="mb-2">
                        <i class="bi bi-graph-up text-primary me-2"></i>
                        Dashboard Analisis Admin
                    </h3>
                    <p class="text-subtitle text-muted">Analisis performa kompetisi dan tingkat keberhasilan soal</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Analisis</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        {{-- Competition Selector --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label for="competitionSelect" class="form-label fw-bold">
                                    <i class="bi bi-trophy text-warning me-2"></i>Pilih Kompetisi
                                </label>
                            </div>
                            <div class="col-md-9">
                                @if ($competitions->isNotEmpty())
                                    <select wire:model.live="selectedCompetition" id="competitionSelect"
                                        class="form-select form-select-lg">
                                        @foreach ($competitions as $competition)
                                            <option value="{{ $competition->id }}">
                                                {{ $competition->title }}
                                                @if ($competition->status === 'active')
                                                    <span>(Aktif)</span>
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <div class="alert alert-info mb-0">
                                        <i class="bi bi-info-circle me-2"></i>
                                        Belum ada kompetisi tersedia
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($selectedCompetition)
            {{-- Charts Row --}}
            <div class="row">
                {{-- Score Distribution Chart --}}
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary">
                            <h4 class="card-title text-white mb-0">
                                <i class="bi bi-bar-chart-fill me-2"></i>
                                Distribusi Skor
                            </h4>
                        </div>
                        <div class="card-body">
                            @if (!empty($scoreDistribution['ranges']) && array_sum($scoreDistribution['counts']) > 0)
                                <div id="scoreDistributionChart"></div>
                                <div class="mt-3 p-3 bg-light rounded">
                                    <p class="mb-1 small text-muted">
                                        <i class="bi bi-info-circle me-1"></i>
                                        <strong>Keterangan:</strong> Grafik ini menunjukkan bagaimana nilai peserta
                                        tersebar dari rendah hingga tinggi, membantu menilai tingkat kesulitan kompetisi
                                        secara
                                        keseluruhan.
                                    </p>
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                                    <p class="text-muted mt-3">Belum ada data distribusi skor untuk kompetisi ini</p>
                                    <small class="text-muted">Data akan muncul setelah ada peserta yang menyelesaikan
                                        kompetisi</small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Question Success Rate Chart --}}
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-success">
                            <h4 class="card-title text-white mb-0">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                Tingkat Keberhasilan Per Soal
                            </h4>
                        </div>
                        <div class="card-body">
                            @if (!empty($questionSuccessRates['questions']) && count($questionSuccessRates['questions']) > 0)
                                <div id="questionSuccessChart"></div>
                                <div class="mt-3 p-3 bg-light rounded">
                                    <p class="mb-1 small text-muted">
                                        <i class="bi bi-info-circle me-1"></i>
                                        <strong>Keterangan:</strong> Grafik ini menghitung persentase jawaban benar pada
                                        tiap
                                        soal sehingga admin bisa melihat soal mana yang terlalu mudah, terlalu sulit, atau
                                        bermasalah.
                                    </p>
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                                    <p class="text-muted mt-3">Belum ada data keberhasilan soal untuk kompetisi ini</p>
                                    <small class="text-muted">Data akan muncul setelah ada peserta yang menjawab
                                        soal</small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Statistics Summary --}}
            @if (!empty($scoreDistribution['ranges']) && array_sum($scoreDistribution['counts']) > 0)
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-clipboard-data text-info me-2"></i>
                                    Ringkasan Statistik
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-md-3 col-6 mb-3">
                                        <div class="p-3 bg-light rounded">
                                            <i class="bi bi-people-fill text-primary" style="font-size: 2rem;"></i>
                                            <h4 class="mt-2 mb-0">{{ array_sum($scoreDistribution['counts']) }}</h4>
                                            <small class="text-muted">Total Peserta Selesai</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6 mb-3">
                                        <div class="p-3 bg-light rounded">
                                            <i class="bi bi-question-circle-fill text-success" style="font-size: 2rem;"></i>
                                            <h4 class="mt-2 mb-0">{{ count($questionSuccessRates['questions']) }}</h4>
                                            <small class="text-muted">Total Soal</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6 mb-3">
                                        <div class="p-3 bg-light rounded">
                                            <i class="bi bi-graph-up-arrow text-warning" style="font-size: 2rem;"></i>
                                            <h4 class="mt-2 mb-0">
                                                @if (!empty($questionSuccessRates['successRates']))
                                                    {{ round(max($questionSuccessRates['successRates']), 2) }}%
                                                @else
                                                    0%
                                                @endif
                                            </h4>
                                            <small class="text-muted">Soal Termudah</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6 mb-3">
                                        <div class="p-3 bg-light rounded">
                                            <i class="bi bi-graph-down-arrow text-danger" style="font-size: 2rem;"></i>
                                            <h4 class="mt-2 mb-0">
                                                @if (!empty($questionSuccessRates['successRates']))
                                                    {{ round(min($questionSuccessRates['successRates']), 2) }}%
                                                @else
                                                    0%
                                                @endif
                                            </h4>
                                            <small class="text-muted">Soal Tersulit</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>

{{-- ApexCharts Library --}}
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        renderCharts();
    });

    // Re-render charts when Livewire updates
    document.addEventListener('livewire:navigated', function() {
        renderCharts();
    });

    Livewire.on('chartDataUpdated', function() {
        renderCharts();
    });

    function renderCharts() {
        // Score Distribution Chart
        @if (!empty($scoreDistribution['ranges']) && array_sum($scoreDistribution['counts']) > 0)
            if (document.querySelector("#scoreDistributionChart")) {
                // Clear previous chart
                document.querySelector("#scoreDistributionChart").innerHTML = '';

                const scoreDistOptions = {
                    series: [{
                        name: 'Jumlah Peserta',
                        data: @json($scoreDistribution['counts'])
                    }],
                    chart: {
                        type: 'bar',
                        height: 400,
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
                            columnWidth: '60%'
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
                        categories: @json($scoreDistribution['ranges']),
                        title: {
                            text: 'Rentang Skor'
                        },
                        labels: {
                            rotate: -45,
                            rotateAlways: false
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Jumlah Peserta'
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
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val + " peserta"
                            }
                        }
                    }
                };

                const scoreDistChart = new ApexCharts(document.querySelector("#scoreDistributionChart"),
                    scoreDistOptions);
                scoreDistChart.render();
            }
        @endif

        // Question Success Rate Chart
        @if (!empty($questionSuccessRates['questions']) && count($questionSuccessRates['questions']) > 0)
            if (document.querySelector("#questionSuccessChart")) {
                // Clear previous chart
                document.querySelector("#questionSuccessChart").innerHTML = '';

                const questionSuccessOptions = {
                    series: [{
                        name: 'Tingkat Keberhasilan',
                        data: @json($questionSuccessRates['successRates'])
                    }],
                    chart: {
                        type: 'bar',
                        height: 400,
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
                            borderRadius: 6,
                            horizontal: true,
                            dataLabels: {
                                position: 'top',
                            },
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        offsetX: 30,
                        formatter: function(val) {
                            return val + "%"
                        },
                        style: {
                            fontSize: '11px',
                            colors: ["#304758"]
                        }
                    },
                    xaxis: {
                        categories: @json($questionSuccessRates['questions']),
                        title: {
                            text: 'Persentase Jawaban Benar (%)'
                        },
                        max: 100
                    },
                    colors: ['#198754'],
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'light',
                            type: 'horizontal',
                            shadeIntensity: 0.3,
                            opacityFrom: 0.9,
                            opacityTo: 0.7,
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val + "% jawaban benar"
                            }
                        }
                    }
                };

                const questionSuccessChart = new ApexCharts(document.querySelector("#questionSuccessChart"),
                    questionSuccessOptions);
                questionSuccessChart.render();
            }
        @endif
    }
</script>
