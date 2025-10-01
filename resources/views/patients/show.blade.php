@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Pasien</li>
                <li class="breadcrumb-item active">{{ $patient->name }}</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <!-- Info Pasien -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>{{ $patient->name }}</h4>
                        </div>
                        <p><strong>No. RM:</strong> {{ $patient->rekam_medis }}</p>
                        <p><strong>Tanggal Lahir:</strong> {{ $patient->dob ?? '-' }}</p>
                        <p><strong>Usia:</strong> {{ $patient->age ?? '-' }} tahun</p>
                        <p><strong>No. HP:</strong> {{ $patient->phone_number ?? '-' }}</p>
                        <p><strong>Alamat:</strong> {{ $patient->address ?? '-' }}</p>
                        <p><strong>Assessment Kerja:</strong> {{ $patient->working_assessment ?? '-' }}</p>
                        <p><strong>Ringkasan Konteks:</strong> {{ $patient->context_summary ?? '-' }}</p>
                        <p><strong>Diagnosis:</strong> {{ $patient->diagnosis ?? '-' }}</p>

                        <hr>
                        <small class="text-muted">
                            Dibuat oleh: {{ $patient->creator->name ?? 'System' }} pada
                            {{ $patient->created_at->format('d M Y H:i') }} <br>
                            Terakhir diubah oleh: {{ $patient->lastModifier->name ?? 'System' }} pada
                            {{ $patient->updated_at->format('d M Y H:i') }}
                        </small>
                    </div>
                </div>
            </div>

            <!-- List Entries -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title">Riwayat Entries</h5>
                            <a href="{{ route('entries.create', [
                                'project' => $project->id,
                                'site' => $site->id,
                                'patient' => $patient->id,
                            ]) }}"
                                class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Tambah Entry
                            </a>
                        </div>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Deskripsi</th>
                                    <th>File</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($entries as $entry)
                                    <tr>
                                        <td>{{ $entry->entry_date ?? '-' }}</td>
                                        <td>{{ $entry->category->name ?? '-' }}</td>
                                        <td>{{ $entry->entry_description ?? '-' }}</td>
                                        <td>
                                            @php
                                                $hasImage = !empty($entry->image_file);
                                                $hasDoc = !empty($entry->document_file);
                                            @endphp

                                            @if ($hasImage)
                                                <div class="mb-2">
                                                    <img src="{{ asset('storage/' . $entry->image_file) }}"
                                                        alt="entry image" class="img-thumbnail" style="max-width: 100px;">
                                                </div>
                                            @endif

                                            @if ($hasDoc)
                                                <a href="{{ asset('storage/' . $entry->document_file) }}" target="_blank"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-file-earmark-text"></i> Lihat Dokumen
                                                </a>
                                            @endif

                                            @if (!$hasImage && !$hasDoc)
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('entries.show', [
                                                'project' => $project->id,
                                                'site' => $site->id,
                                                'patient' => $patient->id,
                                                'entry' => $entry->id,
                                            ]) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada entry</td>
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
