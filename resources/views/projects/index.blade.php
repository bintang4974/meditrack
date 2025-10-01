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
                {{-- 🔍 Search Project by Code --}}
                <form action="{{ route('projects.search') }}" method="GET" class="d-flex">
                    <input type="text" name="project_code" class="form-control me-2"
                        placeholder="Masukkan Kode Project atau Voucher" required>
                    <button class="btn btn-outline-secondary">Search</button>
                </form>
            </div>
        </div>

        <div class="row">
            @forelse($projects as $project)
                <div class="col-md-4">
                    <div class="card shadow-sm mb-3 h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $project->name }}</h5>
                            <p class="card-text">{{ Str::limit($project->description, 100) }}</p>

                            {{-- Informasi Tambahan --}}
                            <p><strong>Kode:</strong> {{ $project->project_code }}</p>
                            <p><strong>Voucher:</strong> {{ $project->voucher_code }}</p>
                            <p><strong>Status:</strong>
                                @if ($project->status == 'active')
                                    <span class="badge bg-success">Aktif</span>
                                @elseif($project->status == 'inactive')
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @else
                                    <span class="badge bg-info">Selesai</span>
                                @endif
                            </p>

                            <div class="mt-auto">
                                <a href="{{ route('projects.show', $project->id) }}" class="btn btn-sm btn-primary">
                                    Masuk Project
                                </a>

                                {{-- Tombol edit/delete hanya untuk owner --}}
                                @if ($project->owner_id === auth()->id())
                                    <a href="{{ route('projects.edit', $project->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>

                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin ingin menghapus project ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                @endif
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
