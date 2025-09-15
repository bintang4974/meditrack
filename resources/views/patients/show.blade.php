@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    <section class="section">
        <div class="row">
            <div class="col-md-4">
                <!-- Info Pasien -->
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>{{ $patient->name }}</h4>
                        </div>
                        <p><strong>No. RM:</strong> {{ $patient->rekam_medis }}</p>
                        <p><strong>Tanggal Lahir:</strong> {{ $patient->dob ?? '-' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">

                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>Rekam Medik</h4>
                            <a href="{{ route('projects.entries.create', $project->id) }}?patient_id={{ $patient->id }}"
                                class="btn btn-primary mb-3"><i class="bi bi-bookmark-plus-fill"></i> Tambah Entry</a>
                        </div>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Entry</th>
                                    <th>Kategori</th>
                                    <th>Tanggal</th>
                                    <th>Dibuat Oleh</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($entries as $entry)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $entry->entry_key }}</td>
                                        <td>{{ $entry->category->category_main }} - {{ $entry->category->category_sub }}
                                        </td>
                                        <td>{{ $entry->entry_date }}</td>
                                        <td>{{ $entry->createdBy->name ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('entries.show', $entry->id) }}"
                                                class="btn btn-sm btn-info">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada rekam medis</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
