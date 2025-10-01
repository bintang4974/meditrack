@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Project</a></li>
                <li class="breadcrumb-item"><a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a></li>
                <li class="breadcrumb-item active">Edit Rumah Sakit</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('sites.index', $project->id) }}" class="btn btn-secondary">
                                <i class="bi bi-skip-backward"></i> Kembali
                            </a>
                        </div>

                        <form class="row g-3" action="{{ route('sites.update', [$project->id, $site->id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <div class="col-12">
                                <label for="name" class="form-label">Nama Rumah Sakit</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $site->name) }}">
                            </div>

                            <div class="col-12">
                                <label for="location" class="form-label">Lokasi</label>
                                <input type="text" name="location" class="form-control"
                                    value="{{ old('location', $site->location) }}">
                            </div>

                            <div class="col-12">
                                <label for="institution" class="form-label">Institusi</label>
                                <input type="text" name="institution" class="form-control"
                                    value="{{ old('institution', $site->institution) }}">
                            </div>

                            <div class="col-12">
                                <label for="site_type" class="form-label">Tipe</label>
                                <select name="site_type" class="form-control">
                                    @foreach (['Hospital', 'Clinic', 'Private Practice', 'Diagnostic Center', 'Medical School', 'Other'] as $type)
                                        <option value="{{ $type }}"
                                            {{ $site->site_type === $type ? 'selected' : '' }}>{{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="coordinates" class="form-label">Koordinat</label>
                                <input type="text" name="coordinates" class="form-control"
                                    value="{{ old('coordinates', $site->coordinates) }}">
                            </div>

                            <div class="col-12">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="active" {{ $site->status === 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="inactive" {{ $site->status === 'inactive' ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="deactivation_note" class="form-label">Catatan Nonaktif</label>
                                <textarea name="deactivation_note" class="form-control">{{ old('deactivation_note', $site->deactivation_note) }}</textarea>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
@endsection
