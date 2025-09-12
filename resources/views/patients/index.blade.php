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
        <div class="row">
            <div class="col-lg-12">

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <div class="card-title"><a href="{{ route('patients.create') }}" class="btn btn-primary mb-3"><i
                                    class="bi bi-bookmark-plus-fill"></i> Tambah</a></div>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Rekam Medis</th>
                                    <th>Nama</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Rumah Sakit</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($patients as $p)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $p->rekam_medis }}</td>
                                        <td>{{ $p->name ?? '-' }}</td>
                                        <td>{{ $p->dob ?? '-' }}</td>
                                        <td>{{ $p->site->name }}</td>
                                        <td>
                                            <a href="{{ route('patients.edit', $p->id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('patients.destroy', $p->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin hapus pasien ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada pasien.</td>
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
