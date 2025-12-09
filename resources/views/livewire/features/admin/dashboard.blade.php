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

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Top Competitions Chart -->
            <div
                class="lg:col-span-2 bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                    <i class="bi bi-bar-chart-fill text-indigo-400 mr-2"></i>
                    Top 5 Kompetisi
                </h3>
                {{-- DEBUG: Count = {{ $topCompetitions->count() }} --}}
                @if ($topCompetitions->count() > 0)
                    <div id="topCompetitionsChart" style="min-height: 350px;"></div>
                    {{-- DEBUG: Data exists, chart should render --}}
                    <script>
                        console.log('Top Competitions Data:', @json($topCompetitions->pluck('title')->toArray()));
                        console.log('Participants Count:', @json($topCompetitions->pluck('participants_count')->toArray()));
                    </script>
                @else
                    <div class="text-center py-12">
                        <i class="bi bi-inbox text-slate-600 text-6xl"></i>
                        <p class="text-slate-400 mt-4">Belum ada kompetisi</p>
                    </div>
                @endif
            </div>

            <!-- Competition Status Chart -->
            <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                    <i class="bi bi-pie-chart-fill text-indigo-400 mr-2"></i>
                    Status Kompetisi
                </h3>
                @if ($stats['totalCompetitions'] > 0)
                    <div id="competitionStatusChart"></div>
                @else
                    <div class="text-center py-8">
                        <i class="bi bi-inbox text-slate-600 text-5xl"></i>
                        <p class="text-slate-400 mt-4">Belum ada data</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recent Competitions & User Breakdown -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Recent Competitions -->
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

            <!-- User Role Chart -->
            <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-2xl p-6">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                    <i class="bi bi-people text-indigo-400 mr-2"></i>
                    User by Role
                </h3>
                @if ($stats['totalUsers'] > 0)
                    <div id="userRoleChart"></div>
                @else
                    <div class="text-center py-8">
                        <i class="bi bi-inbox text-slate-600 text-5xl"></i>
                        <p class="text-slate-400 mt-4">Belum ada user</p>
                    </div>
                @endif
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
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        // Function to wait for ApexCharts to load
        function waitForApexCharts(callback, maxAttempts = 20, attempt = 1) {
            if (typeof ApexCharts !== 'undefined') {
                console.log('✅ ApexCharts loaded successfully');
                callback();
            } else if (attempt < maxAttempts) {
                console.log(`⏳ Waiting for ApexCharts... (attempt ${attempt}/${maxAttempts})`);
                setTimeout(() => waitForApexCharts(callback, maxAttempts, attempt + 1), 100);
            } else {
                console.error('❌ ApexCharts failed to load after', maxAttempts, 'attempts');
            }
        }

        function renderDashboardCharts() {
            console.log('🎨 Rendering dashboard charts...');

            // Check theme
            const isDark = document.body.classList.contains('dark-theme');
            const textColor = isDark ? '#e2e8f0' : '#0f172a';
            const gridColor = isDark ? '#334155' : '#e2e8f0';

            // Top Competitions Bar Chart
            @if ($topCompetitions->count() > 0)
                try {
                    if (document.querySelector("#topCompetitionsChart")) {
                        document.querySelector("#topCompetitionsChart").innerHTML = '';

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
                                },
                                foreColor: textColor,
                                background: 'transparent',
                                animations: {
                                    enabled: true,
                                    easing: 'easeinout',
                                    speed: 800,
                                    animateGradually: {
                                        enabled: true,
                                        delay: 150
                                    },
                                    dynamicAnimation: {
                                        enabled: true,
                                        speed: 350
                                    }
                                }
                            },
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '60%',
                                    distributed: true,
                                    dataLabels: {
                                        position: 'top',
                                    },
                                }
                            },
                            dataLabels: {
                                enabled: true,
                                offsetY: -25,
                                style: {
                                    fontSize: '14px',
                                    fontWeight: 'bold',
                                    colors: [textColor]
                                },
                                formatter: function(val) {
                                    return val + ' peserta';
                                }
                            },
                            xaxis: {
                                categories: @json($topCompetitions->pluck('title')->toArray()),
                                labels: {
                                    style: {
                                        colors: textColor,
                                        fontSize: '12px',
                                        fontWeight: 500
                                    },
                                    rotate: -45,
                                    rotateAlways: false,
                                    hideOverlappingLabels: true,
                                    trim: true,
                                    maxHeight: 120
                                },
                                axisBorder: {
                                    show: true,
                                    color: gridColor
                                },
                                axisTicks: {
                                    show: true,
                                    color: gridColor
                                }
                            },
                            yaxis: {
                                title: {
                                    text: 'Jumlah Partisipasi',
                                    style: {
                                        color: textColor,
                                        fontSize: '14px',
                                        fontWeight: 600
                                    }
                                },
                                labels: {
                                    style: {
                                        colors: textColor,
                                        fontSize: '12px'
                                    },
                                    formatter: function(val) {
                                        return Math.floor(val);
                                    }
                                }
                            },
                            grid: {
                                borderColor: gridColor,
                                strokeDashArray: 4,
                                xaxis: {
                                    lines: {
                                        show: false
                                    }
                                },
                                yaxis: {
                                    lines: {
                                        show: true
                                    }
                                },
                                padding: {
                                    top: 0,
                                    right: 0,
                                    bottom: 0,
                                    left: 10
                                }
                            },
                            colors: ['#6366f1', '#8b5cf6', '#ec4899', '#f59e0b', '#10b981'],
                            fill: {
                                type: 'gradient',
                                gradient: {
                                    shade: 'dark',
                                    type: 'vertical',
                                    shadeIntensity: 0.5,
                                    gradientToColors: ['#8b5cf6', '#ec4899', '#f59e0b', '#10b981', '#06b6d4'],
                                    inverseColors: false,
                                    opacityFrom: 0.95,
                                    opacityTo: 0.7,
                                    stops: [0, 100]
                                }
                            },
                            legend: {
                                show: false
                            },
                            tooltip: {
                                enabled: true,
                                theme: isDark ? 'dark' : 'light',
                                y: {
                                    formatter: function(val) {
                                        return val + ' peserta berpartisipasi';
                                    },
                                    title: {
                                        formatter: function() {
                                            return '';
                                        }
                                    }
                                },
                                style: {
                                    fontSize: '13px'
                                }
                            },
                            states: {
                                hover: {
                                    filter: {
                                        type: 'lighten',
                                        value: 0.1
                                    }
                                },
                                active: {
                                    filter: {
                                        type: 'darken',
                                        value: 0.2
                                    }
                                }
                            }
                        };

                        const topCompChart = new ApexCharts(document.querySelector("#topCompetitionsChart"),
                            topCompOptions);
                        topCompChart.render();
                        console.log('✅ Top Competitions chart rendered');
                    }
                } catch (error) {
                    console.error('❌ Error rendering Top Competitions chart:', error);
                }
            @endif

            // Competition Status Donut Chart
            @if ($stats['totalCompetitions'] > 0)
                try {
                    if (document.querySelector("#competitionStatusChart")) {
                        document.querySelector("#competitionStatusChart").innerHTML = '';

                        const statusOptions = {
                            series: [
                                {{ $competitionsByStatus['draft'] }},
                                {{ $competitionsByStatus['active'] }},
                                {{ $competitionsByStatus['inactive'] }}
                            ],
                            chart: {
                                type: 'donut',
                                height: 280,
                                foreColor: textColor,
                                background: 'transparent'
                            },
                            labels: ['Draft', 'Active', 'Inactive'],
                            colors: ['#64748b', '#10b981', '#ef4444'],
                            legend: {
                                position: 'bottom',
                                labels: {
                                    colors: textColor
                                }
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
                                                color: textColor,
                                                formatter: function(w) {
                                                    return {{ $stats['totalCompetitions'] }}
                                                }
                                            },
                                            value: {
                                                color: textColor
                                            }
                                        }
                                    }
                                }
                            },
                            dataLabels: {
                                enabled: true,
                                style: {
                                    colors: ['#ffffff']
                                }
                            },
                            stroke: {
                                show: false
                            }
                        };

                        const statusChart = new ApexCharts(document.querySelector("#competitionStatusChart"),
                            statusOptions);
                        statusChart.render();
                        console.log('✅ Competition Status chart rendered');
                    }
                } catch (error) {
                    console.error('❌ Error rendering Competition Status chart:', error);
                }
            @endif

            // User Role Donut Chart
            @if ($stats['totalUsers'] > 0)
                try {
                    console.log('👥 User Role Chart - Users exist:', {{ $stats['totalUsers'] }});
                    console.log('👥 User Role Data:', @json($usersByRole));

                    const userRoleElement = document.querySelector("#userRoleChart");
                    if (userRoleElement) {
                        console.log('✅ #userRoleChart element found');
                        userRoleElement.innerHTML = '';

                        const roleOptions = {
                            series: [
                                {{ $usersByRole['peserta'] ?? 0 }},
                                {{ $usersByRole['qualifier'] ?? 0 }},
                                {{ $usersByRole['admin'] ?? 0 }}
                            ],
                            chart: {
                                type: 'donut',
                                height: 280,
                                foreColor: textColor,
                                background: 'transparent'
                            },
                            labels: ['Peserta', 'Qualifier', 'Admin'],
                            colors: ['#6366f1', '#8b5cf6', '#ec4899'],
                            legend: {
                                position: 'bottom',
                                labels: {
                                    colors: textColor
                                }
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
                                                color: textColor,
                                                formatter: function(w) {
                                                    return {{ $stats['totalUsers'] }}
                                                }
                                            },
                                            value: {
                                                color: textColor
                                            }
                                        }
                                    }
                                }
                            },
                            dataLabels: {
                                enabled: true,
                                style: {
                                    colors: ['#ffffff']
                                }
                            },
                            stroke: {
                                show: false
                            }
                        };

                        const roleChart = new ApexCharts(userRoleElement, roleOptions);
                        roleChart.render();
                        console.log('✅ User Role chart rendered successfully');
                    } else {
                        console.error('❌ #userRoleChart element not found!');
                    }
                } catch (error) {
                    console.error('❌ Error rendering User Role chart:', error);
                }
            @else
                console.log('⚠️ No users found, skipping User Role chart');
            @endif
        }

        // Initialize charts on page load
        document.addEventListener('DOMContentLoaded', function() {
            waitForApexCharts(renderDashboardCharts);
        });

        // Re-render charts on Livewire navigation
        document.addEventListener('livewire:navigated', function() {
            waitForApexCharts(renderDashboardCharts);
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
