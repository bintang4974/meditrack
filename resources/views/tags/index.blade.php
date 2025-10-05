{{-- @extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
    </div>

    <section class="section">
        <div class="mb-3 d-flex justify-content-between">
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Filter: {{ ucfirst($status) }}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('tags.index', [$project->id, 'status' => 'active']) }}">🟢
                            Aktif</a></li>
                    <li><a class="dropdown-item" href="{{ route('tags.index', [$project->id, 'status' => 'inactive']) }}">🔴
                            Nonaktif</a></li>
                    <li><a class="dropdown-item" href="{{ route('tags.index', [$project->id, 'status' => 'all']) }}">⚪
                            Semua</a></li>
                </ul>
            </div>

            <a href="{{ route('tags.filter', $project->id) }}" class="btn btn-success">
                <i class="bi bi-funnel"></i> Filter Pasien Berdasarkan Tags
            </a>

            🧩 Hanya owner yang bisa tambah tag
            @if (auth()->id() === $project->owner_id)
                <a href="{{ route('tags.create', $project->id) }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Tag
                </a>
            @endif
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="list-group">
            @forelse ($tags as $tag)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $tag->name }}</strong><br>
                        <small class="text-muted">{{ $tag->description ?? '-' }}</small>
                        <div>
                            <span class="badge {{ $tag->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($tag->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('tags.show', [$project->id, $tag->id]) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i>
                        </a>
                        @if ($isOwner)
                            <a href="{{ route('tags.edit', [$project->id, $tag->id]) }}"
                                class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('tags.toggle', [$project->id, $tag->id]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-secondary">
                                    {{ $tag->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </form>
                            <form action="{{ route('tags.destroy', [$project->id, $tag->id]) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus tag ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-center mt-3">Belum ada tag yang terdaftar.</p>
            @endforelse
        </div>
    </section>
@endsection --}}

@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Daftar Tags</h1>
    </div>

    <section class="section">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Filter: {{ ucfirst($status) }}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('tags.index', [$project->id, 'status' => 'active']) }}">🟢
                            Aktif</a></li>
                    <li><a class="dropdown-item" href="{{ route('tags.index', [$project->id, 'status' => 'inactive']) }}">🔴
                            Nonaktif</a></li>
                    <li><a class="dropdown-item" href="{{ route('tags.index', [$project->id, 'status' => 'all']) }}">⚪
                            Semua</a></li>
                </ul>
            </div>

            <a href="{{ route('tags.filter', $project->id) }}" class="btn btn-success">
                <i class="bi bi-funnel"></i> Filter Pasien Berdasarkan Tags
            </a>


            {{-- 🧩 Hanya owner yang bisa tambah tag --}}
            @if (auth()->id() === $project->owner_id)
                <a href="{{ route('tags.create', $project->id) }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Tag
                </a>
            @endif
        </div>

        <ul class="list-group">
            @forelse ($tags as $tag)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $tag->name }}</strong><br>
                        <small class="text-muted">{{ $tag->description ?? '-' }}</small>
                        <div class="mt-1">
                            <span class="badge {{ $tag->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($tag->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="btn-group">
                        <a href="{{ route('tags.show', [$project->id, $tag->id]) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i>
                        </a>

                        @if (auth()->id() === $project->owner_id)
                            <a href="{{ route('tags.edit', [$project->id, $tag->id]) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>

                            {{-- Tombol toggle aktif/nonaktif --}}
                            <form action="{{ route('tags.toggle', [$project->id, $tag->id]) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="btn btn-sm {{ $tag->status === 'active' ? 'btn-outline-secondary' : 'btn-outline-success' }}">
                                    {{ $tag->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </form>

                            {{-- Tombol hapus --}}
                            <form action="{{ route('tags.destroy', [$project->id, $tag->id]) }}" method="POST"
                                class="d-inline" onsubmit="return confirm('Yakin ingin menghapus tag ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </li>
            @empty
                <li class="list-group-item text-center">
                    Belum ada tag untuk filter <strong>{{ ucfirst($status) }}</strong>.
                </li>
            @endforelse
        </ul>
    </section>
@endsection
