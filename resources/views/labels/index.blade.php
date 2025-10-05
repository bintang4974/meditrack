@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Daftar Labels</h1>
    </div>

    <section class="section">
        <div class="d-flex justify-content-between align-items-center mb-3">
            {{-- 🔹 Dropdown filter status --}}
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Filter: {{ ucfirst($status) }}
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item {{ $status === 'active' ? 'fw-bold' : '' }}"
                            href="{{ route('labels.index', [$project->id, 'status' => 'active']) }}">Aktif</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ $status === 'inactive' ? 'fw-bold' : '' }}"
                            href="{{ route('labels.index', [$project->id, 'status' => 'inactive']) }}">Nonaktif</a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ $status === 'all' ? 'fw-bold' : '' }}"
                            href="{{ route('labels.index', [$project->id, 'status' => 'all']) }}">Semua</a>
                    </li>
                </ul>
            </div>

            <div class="d-flex gap-2">
                {{-- 🔹 Tombol menuju halaman filter --}}
                <a href="{{ route('labels.filter', $project->id) }}" class="btn btn-success">
                    <i class="bi bi-funnel"></i> Filter Entries Berdasarkan Labels
                </a>

                {{-- 🔹 Tombol tambah label hanya untuk owner --}}
                @if (auth()->id() === $project->owner_id)
                    <a href="{{ route('labels.create', $project->id) }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Tambah Label
                    </a>
                @endif
            </div>
        </div>

        <ul class="list-group">
            @forelse ($labels as $label)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $label->name }}</strong><br>
                        <small class="text-muted">{{ $label->description ?? '-' }}</small>
                        <div class="mt-1">
                            <span class="badge {{ $label->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($label->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="btn-group">
                        <a href="{{ route('labels.show', [$project->id, $label->id]) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i>
                        </a>

                        @if (auth()->id() === $project->owner_id)
                            <a href="{{ route('labels.edit', [$project->id, $label->id]) }}"
                                class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('labels.toggle', [$project->id, $label->id]) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="btn btn-sm {{ $label->status === 'active' ? 'btn-outline-secondary' : 'btn-outline-success' }}">
                                    {{ $label->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </form>

                            <form action="{{ route('labels.destroy', [$project->id, $label->id]) }}" method="POST"
                                class="d-inline" onsubmit="return confirm('Yakin ingin menghapus label ini?');">
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
                    Belum ada label untuk filter <strong>{{ ucfirst($status) }}</strong>.
                </li>
            @endforelse
        </ul>
    </section>
@endsection
