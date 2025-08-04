@extends('layouts.sbadmin')

@section('title', 'Assign Karyawan')

@section('content')
    <h1 class="h3 mb-4 text-gray-800 fw-bold">
        <i class="bi bi-calendar-check"></i> Assign Karyawan
    </h1>

    {{-- Alert Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Form Assign --}}
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white fw-bold">
            <i class="bi bi-person-check-fill"></i> Assign Baru
        </div>
        <div class="card-body">
            <form action="{{ route('assignments.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <!-- Karyawan -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Karyawan</label>
                        <select id="employeeSelect" name="employee_id" class="form-select" onchange="setEmployeeEmail()" required>
                            <option value="">-- Pilih Karyawan --</option>
                            @foreach($employees as $emp)
                                @php
                                    $defaultEmails = [
                                        'Ahmad Aulia Fahmi'   => 'arief.nugraha@saasten.com',
                                        'Anggi Dwiki Annisa'    => 'fahrulynur@saasten.com',
                                        'Arief Rachman Nugraha'  => 'doddy.kusumadhynata@saasten.com',
                                        'Ariya Sacca Utama'     => 'arief.nugraha@saasten.com',
                                        'Bagus Aries Setiawan'  => 'fahrulynur@saasten.com',
                                        'Calista Elysia'  => 'arief.nugraha@saasten.com',
                                        'Fahrulynur Asyidiq'  => 'doddy.kusumadhynata@saasten.com',
                                        'Gentha Muhammad Djamal'  => 'arief.nugraha@saasten.com',
                                        'Lingga Adi Atmadja'  => 'arief.nugraha@saasten.com',
                                        'Muhammad Bustamil Adam'  => 'fahrulynur@saasten.com',
                                        'Muhammad Iqbal'  => 'doddy.kusumadhynata@saasten.com',
                                        'Parli'  => 'ahmad.parliyanto@saasten.com',
                                        'Reihan Setya Abida'  => 'arief.nugraha@saasten.com',
                                        'Solihat Khairun Nisa'  => 'suwandi.suhardi@saasten.com',
                                        'Usamah Ridha'  => 'fahrulynur@saasten.com',
                                        'Reza Maulana'  => 'candra.bima@saasten.com',
                                        'Rifki Chairil'  => 'candra.bima@saasten.com',
                                        'Syafiq'  => 'candra.bima@saasten.com',
                                        'Novi'  => 'candra.bima@saasten.com',
                                    ];
                                    $empEmail = $defaultEmails[$emp->name] ?? 'default@company.com';
                                @endphp
                                <option value="{{ $emp->id }}" data-email="{{ $empEmail }}">
                                    {{ $emp->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Requestor -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Requestor</label>
                        <input type="text" name="requestor" class="form-control" placeholder="Nama Requestor" required>
                    </div>

                    <!-- Company -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Company</label>
                        <input type="text" name="company" class="form-control" placeholder="Nama Perusahaan" required>
                    </div>

                    <!-- Meeting Type -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Offline / Online Meeting ?</label>
                        <select name="meeting_type" class="form-select" required>
                            <option value="">-- Pilih Keterangan --</option>
                            <option value="Online">Online</option>
                            <option value="Offline">Offline</option>
                        </select>
                    </div>

                    <!-- Purpose -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Purpose</label>
                        <input type="text" name="purpose" class="form-control" placeholder="Keterangan Meeting" required>
                    </div>

                    <!-- Email Tujuan -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email Tujuan</label>
                        <input type="email" id="target_email" name="target_email" class="form-control" placeholder="Email otomatis sesuai dengan approval karyawannya" readonly required>
                    </div>

                    <!-- Tanggal -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tanggal</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>

                    <!-- Jam Mulai -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jam Mulai</label>
                        <input type="time" name="start_time" class="form-control" required>
                    </div>

                    <!-- Jam Selesai -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jam Selesai</label>
                        <input type="time" name="end_time" class="form-control" required>
                    </div>

                    <!-- Submit -->
                    <div class="col-12 text-end mt-3">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="bi bi-plus-circle"></i> Assign
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Daftar Assignment --}}
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white fw-bold">
            <i class="bi bi-table"></i> Daftar Assignment
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
            <table class="table table-striped mb-0 id="assignTable">
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
            <th>Status Karyawan</th> <!-- Kolom Baru -->
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($assignments as $as)
            <tr>
                <td>{{ $assignments->firstItem() + $loop->index }}</td>
                <td>{{ $as->employee->name }}</td>
                <td>{{ $as->requestor }}</td>
                <td>{{ $as->company }}</td>
                <td>{{ $as->purpose }}</td>
                <td>{{ $as->meeting_type }}</td>
                <td>{{ $as->date }}</td>
                <td>{{ $as->start_time }} - {{ $as->end_time }}</td>
                <td>
                    @if($as->status == 'Approved')
                        <span class="badge bg-success text-white px-3 py-2">Approved</span>
                    @elseif($as->status == 'Rejected')
                        <span class="badge bg-danger">Rejected</span>
                    @else
                        <span class="badge bg-warning text-dark text-white px-3 py-2">Waiting</span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('assignments.destroy', $as->id) }}" method="POST" class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $as->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="10" class="text-center text-muted">Tidak ada assignment.</td>
            </tr>
        @endforelse
    </tbody>
</table>

            <div class="mt-3 px-3">
                {{ $assignments->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

    <script>
        function setEmployeeEmail() {
            const select = document.getElementById('employeeSelect');
            const emailField = document.getElementById('target_email');
            const selectedOption = select.options[select.selectedIndex];
            const email = selectedOption.getAttribute('data-email');
            emailField.value = email || '';
        }
        
        // reload halaman setiap 60 detik
        setInterval(() => {
            location.reload(); 
        }, 60000);

        // modal konfirmasi hapus untuk meremove assignment 
         document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            let form = this.closest('.delete-form');
            Swal.fire({
                title: 'Yakin mau hapus?',
                text: "Data ini tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
    </script>
@endsection
