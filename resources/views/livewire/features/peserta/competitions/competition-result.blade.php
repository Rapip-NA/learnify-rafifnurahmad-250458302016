<div>
    <div class="page-heading">
        <h3>Hasil Kompetisi</h3>
    </div>

    <div class="page-content">

        {{-- HEADER --}}
        <div class="card shadow mb-4">
            <div class="card-body">

                <h2 class="fw-bold mb-2">{{ $competition->title }}</h2>

                <div class="row g-3 mt-4">
                    <div class="col-md-4">
                        <div class="card text-center bg-light border-0 shadow-sm">
                            <div class="card-body">
                                <p class="text-muted small mb-1">Total Skor</p>
                                <h2 class="text-primary fw-bolder mb-0">{{ $participant->total_score }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card text-center bg-light border-0 shadow-sm">
                            <div class="card-body">
                                <p class="text-muted small mb-1">Jawaban Benar</p>
                                <h2 class="text-success fw-bolder mb-0">{{ $correctAnswers }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card text-center bg-light border-0 shadow-sm">
                            <div class="card-body">
                                <p class="text-muted small mb-1">Jawaban Salah</p>
                                <h2 class="text-danger fw-bolder mb-0">{{ $wrongAnswers }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- VISUALISASI PERFORMA INDIVIDU --}}
        <div class="card shadow mb-4">
            <div class="card-body">
                <h4 class="fw-bold mb-3">
                    <i class="bi bi-graph-up text-primary me-2"></i>
                    Visualisasi Performa Individu
                </h4>

                <p class="text-muted mb-3">
                    Grafik berikut menunjukkan perkembangan skor Anda dari awal hingga akhir kuis.
                </p>

                {{-- Toggle Mode --}}
                <div class="btn-group mb-4" role="group">
                    <button type="button" class="btn btn-primary" id="togglePerQuestion"
                        onclick="switchChartMode('perQuestion')">
                        <i class="bi bi-list-ol me-1"></i>
                        Per Soal
                    </button>
                    <button type="button" class="btn btn-outline-primary" id="togglePerTime"
                        onclick="switchChartMode('perTime')">
                        <i class="bi bi-clock me-1"></i>
                        Per Waktu
                    </button>
                </div>

                {{-- Chart Container --}}
                <div id="performanceChart" style="min-height: 350px;"></div>
            </div>
        </div>

        {{-- REVIEW JAWABAN --}}
        @foreach ($answers as $index => $participantAnswer)
            <div class="card shadow mb-4">
                <div class="card-body">

                    {{-- Badge Info --}}
                    <div class="d-flex justify-content-between align-items-start mb-3">

                        <div>
                            <span class="badge bg-secondary">
                                Soal {{ $index + 1 }}
                            </span>

                            <span class="badge bg-primary ms-2">
                                {{ $participantAnswer->question->category->name }}
                            </span>
                        </div>

                        {{-- Status Benar / Salah --}}
                        @if ($participantAnswer->is_correct)
                            <span class="badge bg-success d-flex align-items-center px-3 py-2">
                                <i class="bi bi-check-circle me-1"></i> Benar
                            </span>
                        @else
                            <span class="badge bg-danger d-flex align-items-center px-3 py-2">
                                <i class="bi bi-x-circle me-1"></i> Salah
                            </span>
                        @endif

                    </div>

                    {{-- SOAL --}}
                    <h5 class="fw-bold mb-4">{{ $participantAnswer->question->question_text }}</h5>

                    {{-- DAFTAR JAWABAN --}}
                    @foreach ($participantAnswer->question->answers as $answer)
                        <div
                            class="p-3 rounded border mb-2
                        @if ($answer->is_correct) border-success bg-success bg-opacity-10
                        @elseif($answer->id == $participantAnswer->answer_id)
                            border-danger bg-danger bg-opacity-10
                        @else
                            border-light bg-light @endif
                    ">

                            <div class="d-flex align-items-start">

                                {{-- Ikon --}}
                                @if ($answer->is_correct)
                                    <i class="bi bi-check-circle text-success fs-5 me-2 mt-1"></i>
                                @elseif($answer->id == $participantAnswer->answer_id)
                                    <i class="bi bi-x-circle text-danger fs-5 me-2 mt-1"></i>
                                @else
                                    <div class="me-3" style="width: 22px;"></div>
                                @endif

                                {{-- Teks jawaban --}}
                                <div class="flex-grow-1">
                                    {{ $answer->answer_text }}
                                </div>

                                {{-- Label --}}
                                @if ($answer->is_correct)
                                    <span class="badge bg-success ms-2">Jawaban Benar</span>
                                @elseif($answer->id == $participantAnswer->answer_id)
                                    <span class="badge bg-danger ms-2">Jawaban Anda</span>
                                @endif

                            </div>

                        </div>
                    @endforeach

                    {{-- Detail --}}
                    <div class="mt-3 text-muted small">
                        Bobot: {{ $participantAnswer->question->point_weight }} poin |
                        Waktu: {{ $participantAnswer->time_spent }} detik
                    </div>

                </div>
            </div>
        @endforeach

        {{-- BACK BUTTON --}}
        <div class="text-center mt-4">
            <a href="{{ route('peserta.competitions.list') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-arrow-left-circle me-1"></i>
                Kembali ke Daftar Kompetisi
            </a>
        </div>

    </div>

</div>

{{-- ApexCharts Library --}}
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    // Performance data from backend
    const performanceData = @json($performanceData);

    let currentMode = 'perQuestion';
    let chart = null;

    // Initialize chart on page load
    document.addEventListener('DOMContentLoaded', function() {
        renderChart('perQuestion');
    });

    function switchChartMode(mode) {
        currentMode = mode;

        // Update button states
        document.getElementById('togglePerQuestion').classList.toggle('btn-primary', mode === 'perQuestion');
        document.getElementById('togglePerQuestion').classList.toggle('btn-outline-primary', mode !== 'perQuestion');
        document.getElementById('togglePerTime').classList.toggle('btn-primary', mode === 'perTime');
        document.getElementById('togglePerTime').classList.toggle('btn-outline-primary', mode !== 'perTime');

        // Re-render chart
        renderChart(mode);
    }

    function renderChart(mode) {
        const data = mode === 'perQuestion' ? performanceData.perQuestion : performanceData.perTime;

        // Destroy existing chart if it exists
        if (chart) {
            chart.destroy();
        }

        const options = {
            series: [{
                name: 'Skor Kumulatif',
                data: data
            }],
            chart: {
                type: 'line',
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
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800
                }
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            markers: {
                size: 5,
                hover: {
                    size: 7
                }
            },
            colors: ['#435ebe'],
            xaxis: {
                title: {
                    text: mode === 'perQuestion' ? 'Nomor Soal' : 'Waktu (menit)',
                    style: {
                        fontSize: '14px',
                        fontWeight: 600
                    }
                },
                labels: {
                    formatter: function(value) {
                        if (mode === 'perQuestion') {
                            return 'Soal ' + Math.round(value);
                        } else {
                            return value.toFixed(1) + ' min';
                        }
                    }
                }
            },
            yaxis: {
                title: {
                    text: 'Skor Kumulatif',
                    style: {
                        fontSize: '14px',
                        fontWeight: 600
                    }
                },
                labels: {
                    formatter: function(value) {
                        return Math.round(value);
                    }
                }
            },
            tooltip: {
                custom: function({
                    series,
                    seriesIndex,
                    dataPointIndex,
                    w
                }) {
                    const point = data[dataPointIndex];
                    const questionPreview = point.questionText.length > 50 ?
                        point.questionText.substring(0, 50) + '...' :
                        point.questionText;

                    return '<div class="p-3" style="background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">' +
                        '<div style="font-weight: 600; margin-bottom: 8px; color: #435ebe;">' +
                        (mode === 'perQuestion' ? 'Soal ' + point.x : 'Waktu: ' + point.x + ' menit') +
                        '</div>' +
                        '<div style="font-size: 12px; color: #6c757d; margin-bottom: 8px;">' + questionPreview +
                        '</div>' +
                        '<div style="font-size: 13px;">' +
                        '<strong>Skor didapat:</strong> <span style="color: #198754;">+' + point.scoreEarned +
                        '</span><br/>' +
                        '<strong>Total skor:</strong> <span style="color: #435ebe;">' + point.y + '</span>' +
                        '</div>' +
                        '</div>';
                }
            },
            grid: {
                borderColor: '#e7e7e7',
                strokeDashArray: 3
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'light',
                    type: 'vertical',
                    shadeIntensity: 0.3,
                    opacityFrom: 0.7,
                    opacityTo: 0.3,
                }
            }
        };

        chart = new ApexCharts(document.querySelector("#performanceChart"), options);
        chart.render();
    }
</script>
