@extends('layouts.sbadmin')

@section('title', 'Dashboard')

@section('content')
    <h1 class="h3 mb-4 text-gray-800 font">Dashboard Manajemen Karyawan</h1>

    <!-- Cards Statistik -->
    <div class="row">
        <!-- Total Karyawan -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Karyawan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Available -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Available</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $available }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assigned -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                Assigned</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $assigned }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tasks fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Team -->
    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-success">
                    <h6 class="m-0 font-weight-bold text-white text-center">Distribusi Tim (Pie Chart)</h6>
                </div>
                <div class="card-body">
                    <canvas id="teamPieChart"></canvas>
                </div>
            </div>
        </div>
        <!-- Grafik Top 5 Karyawan -->
<div class="col-xl-6 col-lg-6">
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-info">
            <h6 class="m-0 font-weight-bold text-white text-center">
                <i class="fas fa-user-check"></i> Karyawan Paling Sering di Assign
            </h6>
        </div>
        <div class="card-body">
            <canvas id="topEmployeesChart" height="180"></canvas>
        </div>
    </div>
</div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const teamLabels = {!! json_encode($teams->keys()) !!};
    const teamValues = {!! json_encode($teams->values()) !!};

    // Pie Chart
    new Chart(document.getElementById('teamPieChart'), {
        type: 'pie',
        data: {
            labels: teamLabels,
            datasets: [{
                data: teamValues,
                backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6c757d'],
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false
        }
    });

    // Bar Chart
    new Chart(document.getElementById('teamBarChart'), {
        type: 'bar',
        data: {
            labels: teamLabels,
            datasets: [{
                label: 'Jumlah Karyawan',
                data: teamValues,
                backgroundColor: '#17a2b8'
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    const topEmpLabels = {!! json_encode($topEmployees->pluck('name')) !!};
    const topEmpValues = {!! json_encode($topEmployees->pluck('total')) !!};

    new Chart(document.getElementById('topEmployeesChart'), {
        type: 'bar',
        data: {
            labels: topEmpLabels,
            datasets: [{
                label: 'Jumlah Assignment',
                data: topEmpValues,
                backgroundColor: 'rgba(75, 192, 192, 0.7)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });
</script>
@endpush
