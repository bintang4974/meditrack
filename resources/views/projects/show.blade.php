@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Home</a></li>
                <li class="breadcrumb-item">Project</li>
                <li class="breadcrumb-item active">{{ $project->name }}</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="card mb-3">
            <div class="card-body">
                <h4 class="card-title">{{ $project->name }}</h4>
                <p>{{ $project->description }}</p>
                <p><strong>Kode:</strong> {{ $project->project_code }}</p>
                <p><strong>Voucher:</strong> {{ $project->voucher_code }}</p>
            </div>
        </div>

        {{-- Tombol join request hanya untuk owner --}}
        @if ($project->owner_id === auth()->id())
            <a href="{{ route('projects.joinRequests', $project->id) }}" class="btn btn-warning mb-4">
                Lihat Permintaan Join
                @if ($pendingCount > 0)
                    <span class="badge bg-danger">{{ $pendingCount }}</span>
                @endif
            </a>
        @endif

        {{-- Card Menu --}}
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('sites.index', $project->id) }}"
                    class="card text-center shadow-sm p-3 text-decoration-none">
                    <h5>🏥 Rumah Sakit</h5>
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{ route('doctors.index', $project->id) }}"
                    class="card text-center shadow-sm p-3 text-decoration-none">
                    <h5>👨‍⚕️ Dokter</h5>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('tags.index', $project->id) }}"
                    class="card text-center shadow-sm p-3 text-decoration-none">
                    <h5>🏷️ Tags</h5>
                </a>
            </div>
            <div class="col-md-3">
                {{-- <a href="{{ route('labels.index', $project->id) }}" --}}
                <a href=""
                    class="card text-center shadow-sm p-3 text-decoration-none">
                    <h5>🔖 Labels</h5>
                </a>
            </div>
            <div class="col-md-3 mt-3">
                {{-- <a href="{{ route('categories.index', $project->id) }}" --}}
                <a href=""
                    class="card text-center shadow-sm p-3 text-decoration-none">
                    <h5>📂 Categories</h5>
                </a>
            </div>
        </div>
    </section>
@endsection
