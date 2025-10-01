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
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h4 class="card-title">{{ $project->name }}</h4>
                <p>{{ $project->description ?? '-' }}</p>

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Kode Project:</strong> {{ $project->project_code }}</p>
                        <p><strong>Kode Voucher:</strong> {{ $project->voucher_code }}</p>
                        <p><strong>Status:</strong>
                            <span class="badge {{ $project->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($project->status) }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Tanggal Mulai:</strong>
                            {{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('d M Y') : '-' }}
                        </p>
                        <p><strong>Tanggal Selesai:</strong>
                            {{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('d M Y') : '-' }}</p>
                        <p><strong>Dibuat oleh:</strong> {{ $project->creator->name ?? 'System' }}</p>
                        <p><strong>Terakhir diubah oleh:</strong> {{ $project->lastModifier->name ?? 'System' }}</p>
                    </div>
                </div>

                <hr>
                <small class="text-muted">
                    Dibuat pada {{ $project->created_at->format('d M Y H:i') }},
                    terakhir diperbarui {{ $project->updated_at->format('d M Y H:i') }}
                </small>
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
                <a href="{{ route('labels.index', $project->id) }}"
                    class="card text-center shadow-sm p-3 text-decoration-none">
                    <h5>🔖 Labels</h5>
                </a>
            </div>
            <div class="col-md-3 mt-3">
                <a href="#" class="card text-center shadow-sm p-3 text-decoration-none">
                    <h5>📂 Categories</h5>
                </a>
            </div>
        </div>
    </section>
@endsection


{{-- <a href="{{ route('categories.index', $project->id) }}" --}}
