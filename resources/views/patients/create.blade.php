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
            <form action="{{ route('patients.store', [$project->id, $site->id]) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>No. Rekam Medis</label>
                    <input type="text" name="rekam_medis" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Nama Pasien</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="dob" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('sites.show', [$project->id, $site->id]) }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</section>
@endsection
