<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-lg border-0">
                <div class="card-body">
                    <h5 class="card-title text-primary mb-3">
                        <i class="fas fa-ticket-alt mr-2"></i>Tickets by Status
                    </h5>
                    <canvas id="statusChart" height="220"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-lg border-0">
                <div class="card-body">
                    <h5 class="card-title text-success mb-3">
                        <i class="fas fa-exclamation-circle mr-2"></i>Tickets by Priority
                    </h5>
                    <canvas id="priorityChart" height="220"></canvas>
                </div>
            </div>
        </div>
    </div>

    @if(auth()->user()->role === 'admin')
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-lg border-0">
                <div class="card-body">
                    <h5 class="card-title text-info mb-3">
                        <i class="fas fa-chart-line mr-2"></i>Tickets Created Over Time
                    </h5>
                    <canvas id="createdChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@push('scripts')
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const statusChart = new Chart(document.getElementById('statusChart'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($statusLabels) !!},
            datasets: [{
                data: {!! json_encode($statusCounts) !!},
                backgroundColor: [
                    '#ffc107', '#28a745', '#dc3545', '#6c757d', '#007bff', '#17a2b8'
                ],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { font: { size: 14 } }
                }
            }
        }
    });

    const priorityChart = new Chart(document.getElementById('priorityChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($priorityLabels) !!},
            datasets: [{
                label: 'Tickets',
                data: {!! json_encode($priorityCounts) !!},
                backgroundColor: [
                    '#007bff', '#ffc107', '#dc3545', '#28a745', '#6c757d'
                ],
                borderRadius: 8
            }]
        },
        options: {
            plugins: {
                legend: { display: false },
                tooltip: { enabled: true }
            },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 13 } } },
                y: { beginAtZero: true, grid: { color: '#f0f0f0' } }
            }
        }
    });

    const createdChart = new Chart(document.getElementById('createdChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($dateLabels) !!},
            datasets: [{
                label: 'Tickets Created',
                data: {!! json_encode($createdCounts) !!},
                fill: true,
                borderColor: '#17a2b8',
                backgroundColor: 'rgba(23, 162, 184, 0.15)',
                tension: 0.4,
                pointBackgroundColor: '#17a2b8',
                pointRadius: 4
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: { font: { size: 14 } }
                }
            },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 13 } } },
                y: { beginAtZero: true, grid: { color: '#e9ecef' } }
            }
        }
    });
</script>
@endpush
