<div>
    <div>
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1
                        class="text-3xl font-bold text-transparent bg-gradient-to-r from-indigo-400 to-pink-400 bg-clip-text mb-2">
                        <i class="bi bi-speedometer2 mr-2"></i>Admin Dashboard
                    </h1>
                    <p class="text-slate-400">Monitoring dan analitik sistem</p>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Users -->
            <div
                class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6 hover:shadow-xl hover:shadow-purple-500/20 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 rounded-xl gradient-primary flex items-center justify-center glow-pulse">
                        <i class="bi bi-people-fill text-white text-2xl"></i>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-white mb-1">{{ $stats['totalUsers'] }}</h3>
                <p class="text-slate-400 text-sm">Total Users</p>
            </div>

            <!-- Total Competitions -->
            <div
                class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6 hover:shadow-xl hover:shadow-blue-500/20 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-14 h-14 rounded-xl bg-gradient-to-r from-blue-500 to-cyan-500 flex items-center justify-center">
                        <i class="bi bi-trophy-fill text-white text-2xl"></i>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-white mb-1">{{ $stats['totalCompetitions'] }}</h3>
                <p class="text-slate-400 text-sm">Kompetisi</p>
            </div>

            <!-- Total Questions -->
            <div
                class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6 hover:shadow-xl hover:shadow-green-500/20 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-14 h-14 rounded-xl bg-gradient-to-r from-green-500 to-emerald-500 flex items-center justify-center">
                        <i class="bi bi-question-circle-fill text-white text-2xl"></i>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-white mb-1">{{ $stats['totalQuestions'] }}</h3>
                <p class="text-slate-400 text-sm">Total Soal</p>
            </div>

            <!-- Total Participations -->
            <div
                class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6 hover:shadow-xl hover:shadow-red-500/20 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 rounded-xl gradient-accent flex items-center justify-center">
                        <i class="bi bi-person-check-fill text-white text-2xl"></i>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-white mb-1">{{ number_format($stats['totalParticipations'], 0) }}
                </h3>
                <p class="text-slate-400 text-sm">Partisipasi</p>
            </div>
        </div>

        <!-- Recent Competitions & User Breakdown -->
        <div class="grid grid-cols-1 lg:grid-cols-2 my-8">
            <div
                class="lg:col-span-2 bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                    <i class="bi bi-clock-history text-indigo-400 mr-2"></i>
                    Kompetisi Terbaru
                </h3>
                @if ($recentCompetitions->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-slate-700">
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-slate-300">Kompetisi</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-slate-300">Status</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-slate-300">Pembuat</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-slate-300">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentCompetitions as $competition)
                                    <tr class="border-b border-slate-700/50 hover:bg-slate-800/50 transition">
                                        <td class="py-3 px-4">
                                            <div class="flex items-center gap-2">
                                                <i class="bi bi-trophy text-yellow-400"></i>
                                                <span class="font-semibold text-white">{{ $competition->title }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4">
                                            @if ($competition->status === 'active')
                                                <span
                                                    class="px-3 py-1 rounded-full text-xs font-semibold bg-green-500/20 text-green-400 border border-green-500/30">Active</span>
                                            @elseif ($competition->status === 'draft')
                                                <span
                                                    class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-500/20 text-gray-400 border border-gray-500/30">Draft</span>
                                            @else
                                                <span
                                                    class="px-3 py-1 rounded-full text-xs font-semibold bg-red-500/20 text-red-400 border border-red-500/30">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4 text-slate-400 text-sm">
                                            {{ $competition->creator->name ?? '-' }}</td>
                                        <td class="py-3 px-4 text-slate-400 text-sm">
                                            {{ $competition->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="bi bi-inbox text-slate-600 text-6xl"></i>
                        <p class="text-slate-400 mt-4">Belum ada kompetisi</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 my-8 gap-6">
            <!-- User by Role Chart -->
            <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                    <i class="bi bi-people-fill text-indigo-400 mr-2"></i>
                    User by Role
                </h3>
                <div id="userByRoleChart" style="min-height: 350px;"></div>
            </div>

            <!-- Competition Statistics Chart -->
            <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                    <i class="bi bi-bar-chart-fill text-indigo-400 mr-2"></i>
                    Statistik Kompetisi Aktif
                </h3>
                <div id="competitionStatsChart" style="min-height: 350px;"></div>
            </div>
        </div>

        <!-- Additional Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Average Score -->
            <div
                class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6 text-center">
                <div
                    class="w-16 h-16 mx-auto mb-4 rounded-xl bg-gradient-to-r from-yellow-500 to-orange-500 flex items-center justify-center">
                    <i class="bi bi-star-fill text-white text-2xl"></i>
                </div>
                <h4 class="text-2xl font-bold text-white mb-1">{{ number_format($metrics['avgScore'], 2) }}</h4>
                <p class="text-slate-400 text-sm">Rata-rata Skor</p>
            </div>

            <!-- Completion Rate -->
            <div
                class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6 text-center">
                <div
                    class="w-16 h-16 mx-auto mb-4 rounded-xl bg-gradient-to-r from-green-500 to-emerald-500 flex items-center justify-center">
                    <i class="bi bi-check-circle-fill text-white text-2xl"></i>
                </div>
                <h4 class="text-2xl font-bold text-white mb-1">{{ $metrics['completionRate'] }}%</h4>
                <p class="text-slate-400 text-sm">Tingkat Penyelesaian</p>
            </div>

            <!-- Active Users -->
            <div
                class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-xl gradient-primary flex items-center justify-center">
                    <i class="bi bi-person-badge-fill text-white text-2xl"></i>
                </div>
                <h4 class="text-2xl font-bold text-white mb-1">{{ number_format($metrics['activeUsers'], 0) }}</h4>
                <p class="text-slate-400 text-sm">User Aktif (30 hari)</p>
            </div>

            <!-- Total Answers -->
            <div
                class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6 text-center">
                <div
                    class="w-16 h-16 mx-auto mb-4 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 flex items-center justify-center">
                    <i class="bi bi-chat-left-text-fill text-white text-2xl"></i>
                </div>
                <h4 class="text-2xl font-bold text-white mb-1">{{ number_format($metrics['totalAnswers'], 0) }}</h4>
                <p class="text-slate-400 text-sm">Total Jawaban</p>
            </div>
        </div>
    </div>

    <!-- ApexCharts Library -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.45.0/dist/apexcharts.min.js"></script>

    <script>
        let userByRoleChart = null;
        let competitionStatsChart = null;

        function initCharts() {
            // Determine if light theme is active
            const isLightTheme = document.body.classList.contains('light-theme');

            // User by Role Chart Data
            const userRoleData = {
                labels: @json($usersByRoleChart['labels']),
                values: @json($usersByRoleChart['values'])
            };

            // Competition Stats Chart Data
            const competitionData = {
                labels: @json($topActiveCompetitionsChart['labels']),
                values: @json($topActiveCompetitionsChart['values'])
            };

            // Color scheme based on theme
            const chartColors = isLightTheme ? {
                text: '#0f172a',
                grid: '#e2e8f0',
                background: '#ffffff'
            } : {
                text: '#e2e8f0',
                grid: '#334155',
                background: 'transparent'
            };

            // Initialize User by Role Chart (Donut)
            const userRoleOptions = {
                series: userRoleData.values,
                chart: {
                    type: 'donut',
                    height: 350,
                    background: chartColors.background,
                    toolbar: {
                        show: false
                    },
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 800
                    }
                },
                labels: userRoleData.labels,
                colors: ['#8b5cf6', '#3b82f6', '#10b981'],
                dataLabels: {
                    enabled: true,
                    style: {
                        colors: ['#ffffff']
                    }
                },
                legend: {
                    position: 'bottom',
                    labels: {
                        colors: chartColors.text
                    }
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '65%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total Users',
                                    fontSize: '16px',
                                    color: chartColors.text,
                                    formatter: function(w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                    }
                                },
                                value: {
                                    fontSize: '24px',
                                    color: chartColors.text
                                }
                            }
                        }
                    }
                },
                tooltip: {
                    theme: isLightTheme ? 'light' : 'dark',
                    y: {
                        formatter: function(val) {
                            return val + ' users'
                        }
                    }
                }
            };

            // Initialize Competition Stats Chart (Bar)
            const competitionOptions = {
                series: [{
                    name: 'Partisipan',
                    data: competitionData.values
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    background: chartColors.background,
                    toolbar: {
                        show: false
                    },
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 800
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        borderRadius: 8,
                        dataLabels: {
                            position: 'top'
                        },
                        distributed: true
                    }
                },
                colors: ['#8b5cf6', '#3b82f6', '#10b981', '#f59e0b', '#ef4444'],
                dataLabels: {
                    enabled: true,
                    offsetX: 30,
                    style: {
                        colors: [chartColors.text]
                    }
                },
                xaxis: {
                    categories: competitionData.labels,
                    labels: {
                        style: {
                            colors: chartColors.text
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: chartColors.text
                        },
                        maxWidth: 200
                    }
                },
                grid: {
                    borderColor: chartColors.grid,
                    strokeDashArray: 4
                },
                legend: {
                    show: false
                },
                tooltip: {
                    theme: isLightTheme ? 'light' : 'dark',
                    y: {
                        formatter: function(val) {
                            return val + ' partisipan'
                        }
                    }
                }
            };

            // Destroy existing charts if they exist
            if (userByRoleChart) {
                userByRoleChart.destroy();
            }
            if (competitionStatsChart) {
                competitionStatsChart.destroy();
            }

            // Render charts
            userByRoleChart = new ApexCharts(document.querySelector("#userByRoleChart"), userRoleOptions);
            userByRoleChart.render();

            competitionStatsChart = new ApexCharts(document.querySelector("#competitionStatsChart"), competitionOptions);
            competitionStatsChart.render();
        }

        // Initialize charts on page load
        document.addEventListener('DOMContentLoaded', function() {
            initCharts();
        });

        // Re-initialize charts on Livewire navigation
        document.addEventListener('livewire:navigated', function() {
            setTimeout(() => {
                initCharts();
            }, 100);
        });

        // Re-initialize charts on theme change
        window.addEventListener('theme-changed', function() {
            setTimeout(() => {
                initCharts();
            }, 100);
        });
    </script>

    <style>
        /* Light theme adjustments */
        body.light-theme .bg-gradient-to-br {
            background: white !important;
            border-color: #e2e8f0 !important;
        }

        body.light-theme .text-white {
            color: #0f172a !important;
        }

        body.light-theme .text-slate-300,
        body.light-theme .text-slate-400 {
            color: #64748b !important;
        }

        body.light-theme .border-slate-700 {
            border-color: #e2e8f0 !important;
        }

        body.light-theme .hover\:bg-slate-800\/50:hover {
            background-color: rgba(241, 245, 249, 0.5) !important;
        }

        body.light-theme .bi-inbox {
            color: #cbd5e1 !important;
        }
    </style>

</div>
