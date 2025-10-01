@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Project</a></li>
                <li class="breadcrumb-item"><a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a></li>
                <li class="breadcrumb-item active">Rumah Sakit</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Daftar Rumah Sakit</h4>
            <a href="{{ route('sites.create', $project->id) }}" class="btn btn-primary">+ Tambah Rumah Sakit</a>
        </div>

        <div class="row">
            @forelse($sites as $site)
                <div class="col-md-4">
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $site->name }}</h5>
                            <p><strong>Lokasi:</strong> {{ $site->location ?? '-' }}</p>
                            <p><strong>Institusi:</strong> {{ $site->institution ?? '-' }}</p>
                            <p><strong>Tipe:</strong> {{ $site->site_type ?? '-' }}</p>
                            <p><strong>Status:</strong>
                                <span class="badge {{ $site->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ ucfirst($site->status) }}
                                </span>
                            </p>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('sites.show', [$project->id, $site->id]) }}"
                                    class="btn btn-sm btn-info">👁 Lihat</a>
                                <a href="{{ route('sites.edit', [$project->id, $site->id]) }}"
                                    class="btn btn-sm btn-warning">✏️ Edit</a>
                                <form action="{{ route('sites.destroy', [$project->id, $site->id]) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Yakin ingin menghapus rumah sakit ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">🗑 Hapus</button>
                                </form>
                            </div>
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
