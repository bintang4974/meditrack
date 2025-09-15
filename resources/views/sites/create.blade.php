@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Project</li>
                <li class="breadcrumb-item active">Tambah Rumah Sakit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-secondary"><i
                                    class="bi bi-skip-backward"></i> Kembali</a>
                        </div>
                        <!-- Vertical Form -->
                        <form class="row g-3" action="{{ route('sites.store', $project->id) }}" method="POST">
                            @csrf
                            <div class="col-12">
                                <label for="name" class="form-label">Nama Rumah Sakit</label>
                                <input type="text" name="name" class="form-control" id="name">
                                @error('name')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="location" class="form-label">Lokasi</label>
                                <input type="text" name="location" class="form-control" id="location">
                                @error('location')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Submit</button>
                                <button type="reset" class="btn btn-danger"><i class="bi bi-x-octagon"></i> Reset</button>

                            </div>
                        </form><!-- Vertical Form -->
                    </div>
                </div>
            </div>
    </section>
@endsection
