@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Home</a></li>
                <li class="breadcrumb-item">Sites</li>
                <li class="breadcrumb-item active">{{ $site->name }}</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h4 class="card-title">{{ $site->name }}</h4>
                <p><strong>Lokasi:</strong> {{ $site->location ?? '-' }}</p>
                <p><strong>Institusi:</strong> {{ $site->institution ?? '-' }}</p>
                <p><strong>Tipe:</strong> {{ ucfirst($site->site_type ?? '-') }}</p>
                <p><strong>Deskripsi:</strong> {{ $site->description ?? '-' }}</p>
                <p><strong>Koordinat:</strong> {{ $site->coordinates ?? '-' }}</p>
                <p><strong>Status:</strong>
                    <span class="badge {{ $site->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                        {{ ucfirst($site->status) }}
                    </span>
                </p>
                @if ($site->status === 'inactive')
                    <p><strong>Catatan Nonaktif:</strong> {{ $site->deactivation_note ?? '-' }}</p>
                @endif

                <hr>
                <small class="text-muted">
                    Dibuat oleh: {{ $site->creator->name ?? 'System' }} pada {{ $site->created_at->format('d M Y H:i') }}
                    <br>
                    Terakhir diubah oleh: {{ $site->lastModifier->name ?? 'System' }} pada
                    {{ $site->updated_at->format('d M Y H:i') }}
                </small>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('patients.create', [$project->id, $site->id]) }}"
                                class="btn btn-primary mb-3">
                                <i class="bi bi-bookmark-plus-fill"></i> Tambah Pasien
                            </a>
                        </div>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No. RM</th>
                                    <th>Nama</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($site->patients as $patient)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $patient->rekam_medis }}</td>
                                        <td>{{ $patient->name }}</td>
                                        <td>{{ $patient->dob ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('patients.show', [$project->id, $site->id, $patient->id]) }}"
                                                class="btn btn-sm btn-info">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada pasien</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
