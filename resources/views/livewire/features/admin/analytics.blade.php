<div>
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <i class="bi bi-graph-up text-indigo-500"></i>
                    Dashboard Analisis Admin
                </h3>
                <p class="text-slate-500 dark:text-slate-400 mt-1">Analisis performa kompetisi dan tingkat keberhasilan
                    soal</p>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                    <li><a href="{{ route('admin.dashboard') }}"
                            class="hover:text-indigo-500 transition-colors">Dashboard</a></li>
                    <li><span class="text-slate-300 dark:text-slate-600">/</span></li>
                    <li class="text-indigo-500 font-medium" aria-current="page">Analisis</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="space-y-6">
        {{-- Competition Selector --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-700">
            <div class="flex flex-col md:flex-row md:items-center gap-4">
                <div class="md:w-1/4">
                    <label for="competitionSelect" class="block font-bold text-slate-700 dark:text-slate-200">
                        <i class="bi bi-trophy text-yellow-500 me-2"></i>Pilih Kompetisi
                    </label>
                </div>
                <div class="md:w-3/4">
                    @if ($competitions->isNotEmpty())
                        <select wire:model.live="selectedCompetition" id="competitionSelect"
                            class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 transition-all">
                            @foreach ($competitions as $competition)
                                <option value="{{ $competition->id }}">
                                    {{ $competition->title }}
                                    @if ($competition->status === 'active')
                                        (Aktif)
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    @else
                        <div
                            class="bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 p-4 rounded-xl flex items-center gap-3">
                            <i class="bi bi-info-circle text-xl"></i>
                            Belum ada kompetisi tersedia
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @if ($selectedCompetition)
            {{-- Charts Row --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Score Distribution Chart --}}
                <div
                    class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden flex flex-col">
                    <div
                        class="p-4 border-b border-slate-100 dark:border-slate-700 bg-gradient-to-r from-indigo-500 to-violet-600">
                        <h4 class="text-lg font-bold text-white flex items-center gap-2">
                            <i class="bi bi-bar-chart-fill"></i>
                            Distribusi Skor
                        </h4>
                    </div>
                    <div class="p-6 flex-1">
                        @if (!empty($scoreDistribution['ranges']) && array_sum($scoreDistribution['counts']) > 0)
                            <div id="scoreDistributionChart" class="w-full"></div>
                            <div
                                class="mt-4 p-4 bg-slate-50 dark:bg-slate-900/50 rounded-xl border border-slate-100 dark:border-slate-700">
                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    <i class="bi bi-info-circle me-1 text-indigo-500"></i>
                                    <strong>Keterangan:</strong> Grafik ini menunjukkan bagaimana nilai peserta
                                    tersebar dari rendah hingga tinggi, membantu menilai tingkat kesulitan kompetisi
                                    secara keseluruhan.
                                </p>
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center py-12 text-center">
                                <div
                                    class="w-16 h-16 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center mb-4">
                                    <i class="bi bi-inbox text-3xl text-slate-400 dark:text-slate-500"></i>
                                </div>
                                <p class="text-slate-500 dark:text-slate-400 font-medium">Belum ada data distribusi skor
                                </p>
                                <p class="text-sm text-slate-400 dark:text-slate-500 mt-1">Data akan muncul setelah ada
                                    peserta yang menyelesaikan kompetisi</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Question Success Rate Chart --}}
                <div
                    class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden flex flex-col">
                    <div
                        class="p-4 border-b border-slate-100 dark:border-slate-700 bg-gradient-to-r from-emerald-500 to-teal-600">
                        <h4 class="text-lg font-bold text-white flex items-center gap-2">
                            <i class="bi bi-check-circle-fill"></i>
                            Tingkat Keberhasilan Per Soal
                        </h4>
                    </div>
                    <div class="p-6 flex-1">
                        @if (!empty($questionSuccessRates['questions']) && count($questionSuccessRates['questions']) > 0)
                            <div id="questionSuccessChart" class="w-full"></div>
                            <div
                                class="mt-4 p-4 bg-slate-50 dark:bg-slate-900/50 rounded-xl border border-slate-100 dark:border-slate-700">
                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    <i class="bi bi-info-circle me-1 text-emerald-500"></i>
                                    <strong>Keterangan:</strong> Grafik ini menghitung persentase jawaban benar pada
                                    tiap soal sehingga admin bisa melihat soal mana yang terlalu mudah, terlalu sulit,
                                    atau
                                    bermasalah.
                                </p>
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center py-12 text-center">
                                <div
                                    class="w-16 h-16 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center mb-4">
                                    <i class="bi bi-inbox text-3xl text-slate-400 dark:text-slate-500"></i>
                                </div>
                                <p class="text-slate-500 dark:text-slate-400 font-medium">Belum ada data keberhasilan
                                    soal</p>
                                <p class="text-sm text-slate-400 dark:text-slate-500 mt-1">Data akan muncul setelah ada
                                    peserta yang menjawab soal</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Statistics Summary --}}
            @if (!empty($scoreDistribution['ranges']) && array_sum($scoreDistribution['counts']) > 0)
                <div
                    class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 dark:border-slate-700">
                        <h5 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <i class="bi bi-clipboard-data text-blue-500"></i>
                            Ringkasan Statistik
                        </h5>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            <div
                                class="bg-slate-50 dark:bg-slate-900/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-700 text-center hover:shadow-md transition-shadow">
                                <div
                                    class="w-12 h-12 mx-auto bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mb-3">
                                    <i class="bi bi-people-fill text-blue-600 dark:text-blue-400 text-xl"></i>
                                </div>
                                <h4 class="text-2xl font-bold text-slate-900 dark:text-white mb-1">
                                    {{ array_sum($scoreDistribution['counts']) }}</h4>
                                <small class="text-slate-500 dark:text-slate-400 font-medium">Total Peserta
                                    Selesai</small>
                            </div>

                            <div
                                class="bg-slate-50 dark:bg-slate-900/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-700 text-center hover:shadow-md transition-shadow">
                                <div
                                    class="w-12 h-12 mx-auto bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center mb-3">
                                    <i
                                        class="bi bi-question-circle-fill text-emerald-600 dark:text-emerald-400 text-xl"></i>
                                </div>
                                <h4 class="text-2xl font-bold text-slate-900 dark:text-white mb-1">
                                    {{ count($questionSuccessRates['questions']) }}</h4>
                                <small class="text-slate-500 dark:text-slate-400 font-medium">Total Soal</small>
                            </div>

                            <div
                                class="bg-slate-50 dark:bg-slate-900/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-700 text-center hover:shadow-md transition-shadow">
                                <div
                                    class="w-12 h-12 mx-auto bg-amber-100 dark:bg-amber-900/30 rounded-full flex items-center justify-center mb-3">
                                    <i class="bi bi-graph-up-arrow text-amber-600 dark:text-amber-400 text-xl"></i>
                                </div>
                                <h4 class="text-2xl font-bold text-slate-900 dark:text-white mb-1">
                                    @if (!empty($questionSuccessRates['successRates']))
                                        {{ round(max($questionSuccessRates['successRates']), 2) }}%
                                    @else
                                        0%
                                    @endif
                                </h4>
                                <small class="text-slate-500 dark:text-slate-400 font-medium">Soal Termudah</small>
                            </div>

                            <div
                                class="bg-slate-50 dark:bg-slate-900/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-700 text-center hover:shadow-md transition-shadow">
                                <div
                                    class="w-12 h-12 mx-auto bg-rose-100 dark:bg-rose-900/30 rounded-full flex items-center justify-center mb-3">
                                    <i class="bi bi-graph-down-arrow text-rose-600 dark:text-rose-400 text-xl"></i>
                                </div>
                                <h4 class="text-2xl font-bold text-slate-900 dark:text-white mb-1">
                                    @if (!empty($questionSuccessRates['successRates']))
                                        {{ round(min($questionSuccessRates['successRates']), 2) }}%
                                    @else
                                        0%
                                    @endif
                                </h4>
                                <small class="text-slate-500 dark:text-slate-400 font-medium">Soal Tersulit</small>
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
        const isDarkMode = document.documentElement.classList.contains('dark') || document.body.classList.contains(
            'dark-theme');
        const textColor = isDarkMode ? '#94a3b8' : '#64748b';
        const gridColor = isDarkMode ? '#334155' : '#e2e8f0';

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
                        height: 350,
                        fontFamily: 'Plus Jakarta Sans, sans-serif',
                        background: 'transparent',
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 6,
                            columnWidth: '50%',
                            distributed: true,
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: false
                    },
                    xaxis: {
                        categories: @json($scoreDistribution['ranges']),
                        labels: {
                            style: {
                                colors: textColor,
                                fontSize: '12px'
                            },
                            rotate: -45,
                            rotateAlways: false
                        },
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: textColor,
                            }
                        }
                    },
                    grid: {
                        borderColor: gridColor,
                        strokeDashArray: 4,
                    },
                    colors: ['#6366f1', '#8b5cf6', '#ec4899', '#f43f5e', '#10b981', '#3b82f6'],
                    tooltip: {
                        theme: isDarkMode ? 'dark' : 'light',
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
                        height: 350,
                        fontFamily: 'Plus Jakarta Sans, sans-serif',
                        background: 'transparent',
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 6,
                            horizontal: true,
                            barHeight: '60%',
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        textAnchor: 'start',
                        style: {
                            colors: ['#fff']
                        },
                        formatter: function(val, opt) {
                            return Math.round(val) + "%"
                        },
                        offsetX: 0,
                    },
                    xaxis: {
                        categories: @json($questionSuccessRates['questions']),
                        max: 100,
                        labels: {
                            style: {
                                colors: textColor,
                                fontSize: '12px'
                            }
                        },
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: textColor,
                            },
                            maxWidth: 200
                        }
                    },
                    grid: {
                        borderColor: gridColor,
                        strokeDashArray: 4,
                        xaxis: {
                            lines: {
                                show: true
                            }
                        },
                        yaxis: {
                            lines: {
                                show: false
                            }
                        },
                    },
                    colors: ['#10b981'],
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'light',
                            type: 'horizontal',
                            shadeIntensity: 0.25,
                            gradientToColors: ['#34d399'],
                            inverseColors: true,
                            opacityFrom: 1,
                            opacityTo: 1,
                            stops: [0, 100]
                        }
                    },
                    tooltip: {
                        theme: isDarkMode ? 'dark' : 'light',
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
