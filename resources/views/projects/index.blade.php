@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Project</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row mb-4">
            <div class="col-md-6">
                <a href="{{ route('projects.create') }}" class="btn btn-primary">+ Buat Project Baru</a>
            </div>
            <div class="col-md-6">
                <form action="{{ route('projects.search') }}" method="GET" class="d-flex">
                    <input type="text" name="project_code" class="form-control me-2"
                        placeholder="Cari Project dengan Kode">
                    <button class="btn btn-outline-secondary">Search</button>
                </form>
            </div>
        </div>

        <div class="row">
            @forelse($projects as $project)
                <div class="col-md-4">
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->name }}</h5>
                            <p class="card-text">{{ Str::limit($project->description, 100) }}</p>
                            <span class="badge bg-secondary">Kode: {{ $project->project_code }}</span>
                            <div class="mt-3">
                                <a href="{{ route('projects.show', $project->id) }}" class="btn btn-sm btn-primary">
                                    Masuk Project
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>Belum ada project yang kamu buat atau ikuti.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection
