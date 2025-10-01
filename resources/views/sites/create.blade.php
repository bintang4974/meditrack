@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Project</a></li>
                <li class="breadcrumb-item"><a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a></li>
                <li class="breadcrumb-item active">Tambah Rumah Sakit</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-secondary">
                                <i class="bi bi-skip-backward"></i> Kembali
                            </a>
                        </div>

                        <!-- Vertical Form -->
                        <form class="row g-3" action="{{ route('sites.store', $project->id) }}" method="POST">
                            @csrf

                            <div class="col-12">
                                <label for="name" class="form-label">Nama Rumah Sakit</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="location" class="form-label">Lokasi</label>
                                <input type="text" name="location" class="form-control" id="location"
                                    value="{{ old('location') }}">
                                @error('location')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="institution" class="form-label">Institusi</label>
                                <input type="text" name="institution" class="form-control" id="institution"
                                    value="{{ old('institution') }}">
                                @error('institution')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="site_type" class="form-label">Tipe</label>
                                <select name="site_type" id="site_type" class="form-control">
                                    @foreach (['Hospital', 'Clinic', 'Private Practice', 'Diagnostic Center', 'Medical School', 'Other'] as $type)
                                        <option value="{{ $type }}"
                                            {{ old('site_type') == $type ? 'selected' : '' }}>
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('site_type')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="coordinates" class="form-label">Koordinat</label>
                                <input type="text" name="coordinates" class="form-control" id="coordinates"
                                    value="{{ old('coordinates') }}" placeholder="-7.250445, 112.768845">
                                @error('coordinates')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                                @error('status')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="deactivation_note" class="form-label">Catatan Nonaktif</label>
                                <textarea name="deactivation_note" class="form-control" rows="2">{{ old('deactivation_note') }}</textarea>
                                @error('deactivation_note')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-floppy"></i> Submit
                                </button>
                                <button type="reset" class="btn btn-danger">
                                    <i class="bi bi-x-octagon"></i> Reset
                                </button>
                            </div>
                        </form>
                        <!-- End Form -->
                    </div>
                </div>
            </div>
    </section>
@endsection
