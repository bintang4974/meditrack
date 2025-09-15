@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Home</a></li>
                <li class="breadcrumb-item active">{{ $project->name }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card mb-4">
            <div class="card-body">
                <h5>Deskripsi</h5>
                <p>{{ $project->description }}</p>
                <p><strong>Kode:</strong> {{ $project->project_code }}</p>
                <p><strong>Voucher:</strong> {{ $project->voucher_code }}</p>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Daftar Rumah Sakit</h4>
            <a href="{{ route('sites.create', $project->id) }}" class="btn btn-primary">+ Tambah Rumah Sakit</a>
        </div>

        <div class="row">
            @forelse($project->sites as $site)
                <div class="col-md-4">
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $site->name }}</h5>
                            <p class="card-text">{{ $site->location }}</p>
                            <a href="{{ route('sites.show', [$project->id, $site->id]) }}" class="btn btn-sm btn-info">
                                Lihat Pasien
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>Belum ada rumah sakit pada project ini.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection
