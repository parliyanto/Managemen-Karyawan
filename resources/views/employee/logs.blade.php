{{-- ambil partials dari layouts sbadmin --}}
@extends('layouts.sbadmin')
@section('title', 'Employee Assignment Log')
@section('content')
    <h1 class="h3 mb-4 text-gray-800 fw-bold">
        <i class="bi bi-clock-history"></i> Employee Assignment Log
    </h1>

    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-primary text-white fw-bold">
            <i class="bi bi-list-check"></i> Log Riwayat Penugasan
        </div>
        <div class="card-body">
            {{-- container table --}}

            <a href="{{ route('employee.logs.export') }}" class="btn btn-success mb-3">
            <i class="bi bi-file-earmark-excel-fill"></i> Export to Excel
            </a>  
            <div class="table-responsive">
                {{-- table  --}}
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="bg-success text-white">
                        <tr>
                            <th>NO</th>
                            <th>Karyawan</th>
                            <th>Requestor</th>
                            <th>Company</th>
                            <th>Purpose</th>
                            <th>Keterangan Meeting</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Status</th>
                            <th>Approved By </th> <!-- 🆕 Tambahan -->
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $index => $log)
                            <tr>
                                <td>{{ $logs->firstItem() + $index }}</td>
                                <td>{{ $log->employee->name ?? 'N/A' }}</td>
                                <td>{{ $log->requestor ?? '-' }}</td>
                                <td>{{ $log->company }}</td>
                                <td>{{ $log->purpose }}</td>
                                <td>{{ $log->meeting_type }}</td>
                                <td>{{ \Carbon\Carbon::parse($log->date)->format('Y-m-d') }}</td>
                                <td>{{ \Carbon\Carbon::parse($log->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($log->end_time)->format('H:i') }}</td>
                                <td><span class="badge bg-success text-white px-3 py-2">Approved</span></td>
                                <td>{{ $log->approved_by_email ?? '-' }}</td> <!-- 🆕 Tambahan -->
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted">Tidak ada log.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $logs->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#logTable').DataTable({
                responsive: true,
                autoWidth: false
            });
        });
    </script>
@endsection
