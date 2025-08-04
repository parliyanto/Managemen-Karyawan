@extends('layouts.sbadmin')

@section('title', 'Manajemen Karyawan')

@section('content')
    <h1 class="h3 mb-4 text-gray-800 fw-bold">
        <i class="bi bi-people-fill"></i> Manajemen Karyawan
    </h1>

    {{-- Form Tambah Karyawan --}}
{{-- <div class="card shadow border-0 rounded-3 mb-4">
    <div class="card-header bg-primary text-white fw-bold">
        <i class="bi bi-person-plus-fill"></i> Tambah Karyawan
    </div>
    <div class="card-body">
        <form action="{{ route('employee.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="team" class="form-label">Tim</label>
                    <input type="text" name="team" id="team" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="Available">Available</option>
                        <option value="Busy">Busy</option>
                        <option value="Leave">Leave</option>
                    </select>
                </div>
            </div>
            <div class="mt-3 text-end">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save-fill"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div> --}}


    {{-- Alert Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tabel Karyawan --}}
    <div class="card shadow-lg border-0 rounded-3">
        <!-- Search Bar -->
        <div class="d-flex justify-content-between align-items-center p-3 bg-dark text-white fw-bold card-header">
            <h5 class="mb-0"><i class="bi bi-list-check"></i> Daftar Karyawan</h5>
            <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Cari Karyawan..." style="width: 200px;">
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0" id="employeeTable">
                    <thead class="bg-success text-white">
                        <tr>
                            <th class="text-center">NO</th>
                            <th>Nama</th>
                            <th>Tim</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
    @forelse($employees as $emp)
        <tr>
            <td data-label="NO" class="text-center">{{ $employees->firstItem() + $loop->index }}</td>
            <td data-label="Nama">{{ $emp->name }}</td>
            <td data-label="Tim"><span class="fw-bold text-primary">{{ $emp->team }}</span></td>
            <td data-label="Status">
                @if($emp->status)
                    <span class="badge bg-{{ strtolower($emp->status) == 'available' ? 'success' : 'secondary' }} text-white px-3 py-2">
                        {{ ucfirst($emp->status) }}
                    </span>
                @else
                    <span class="badge bg-secondary text-white px-3 py-2">-</span>
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center text-muted py-3">Tidak ada karyawan.</td>
        </tr>
    @endforelse
</tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $employees->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Init DataTable dengan destroy true agar tidak error saat re-init
        var table = $('#employeeTable').DataTable({
    destroy: true,
    paging: false,       // Matikan pagination bawaan DataTables
    searching: true,    // Matikan search bawaan
    ordering: true,
    info: false,         // Hilangkan "Showing X to Y of Z"
    lengthChange: false, // Hilangkan dropdown "Show entries"
    dom: 't',            // Tampilkan hanya tabel
    language: {
        zeroRecords: "Tidak ditemukan data"
    }
});


        // Hubungkan custom search
        $('#searchInput').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
</script>
@endpush
