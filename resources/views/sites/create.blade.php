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
                <form action="{{ route('sites.store', $project->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Nama Rumah Sakit</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="location">Lokasi</label>
                        <input type="text" class="form-control" name="location">
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('projects.show', $project->id) }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </section>
@endsection
