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

    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h4>{{ $site->name }}</h4>
                </div>
                <p><strong>Lokasi:</strong> {{ $site->location ?? '-' }}</p>
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
                                class="btn btn-primary mb-3"><i class="bi bi-bookmark-plus-fill"></i>Tambah Pasien
                            </a>
                        </div>

                        <!-- Table with stripped rows -->
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
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
