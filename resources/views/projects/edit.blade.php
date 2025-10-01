@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('projects.index') }}" class="btn btn-secondary"><i
                                    class="bi bi-skip-backward"></i> Kembali</a>
                        </div>

                        <form class="row g-3" action="{{ route('projects.update', $project->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="col-12">
                                <label for="name" class="form-label">Nama Project</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ old('name', $project->name) }}">
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea name="description" class="form-control">{{ old('description', $project->description) }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Tanggal Mulai</label>
                                <input type="date" name="start_date" class="form-control"
                                    value="{{ old('start_date', $project->start_date) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="end_date" class="form-label">Tanggal Selesai</label>
                                <input type="date" name="end_date" class="form-control"
                                    value="{{ old('end_date', $project->end_date) }}">
                            </div>
                            <div class="col-12">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="active" {{ $project->status == 'active' ? 'selected' : '' }}>Aktif
                                    </option>
                                    <option value="inactive" {{ $project->status == 'inactive' ? 'selected' : '' }}>Nonaktif
                                    </option>
                                    <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>
                                        Selesai</option>
                                </select>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('projects.show', $project->id) }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
    </section>
@endsection
