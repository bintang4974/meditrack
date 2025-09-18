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
                <div class="card">
                    <div class="card-body">
                        <h4>{{ $patient->name }}</h4>
                        <p><strong>No. RM:</strong> {{ $patient->rekam_medis }}</p>
                        <p><strong>Tanggal Lahir:</strong> {{ $patient->dob ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- List Entries -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title">Riwayat Entries</h5>
                            <a href="{{ route('entries.create', ['project' => $project->id, 'site' => $site->id, 'patient' => $patient->id]) }}"
                                class="btn btn-primary"><i class="bi bi-plus-circle"></i> Tambah Entry</a>
                        </div>

                        <table class="table table-bordered">
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
                                        <td>{{ $entry->entry_date }}</td>
                                        <td>{{ $entry->subCategory->category->category_main }} >
                                            {{ $entry->subCategory->name }}</td>
                                        <td>{{ $entry->entry_description }}</td>
                                        <td>
                                            @if ($entry->image_file)
                                                <a href="{{ asset('storage/' . $entry->image_file) }}"
                                                    target="_blank">Gambar</a><br>
                                            @endif
                                            @if ($entry->document_file)
                                                <a href="{{ asset('storage/' . $entry->document_file) }}"
                                                    target="_blank">Dokumen</a>
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
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Belum ada entry</td>
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
