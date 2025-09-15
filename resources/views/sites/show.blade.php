<section class="section">
    <div class="card mb-3">
        <div class="card-body">
            <h4>{{ $site->name }}</h4>
            <p><strong>Lokasi:</strong> {{ $site->location ?? '-' }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5>Daftar Pasien di {{ $site->name }}</h5>

            <a href="{{ route('patients.create', [$project->id, $site->id]) }}" class="btn btn-primary mb-3">
                Tambah Pasien
            </a>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No. RM</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($site->patients as $patient)
                        <tr>
                            <td>{{ $patient->rekam_medis }}</td>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->dob }}</td>
                            <td>
                                <a href="{{ route('patients.show', [$project->id, $site->id, $patient->id]) }}"
                                    class="btn btn-sm btn-info">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada pasien</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
