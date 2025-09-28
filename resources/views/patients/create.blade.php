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
                            <a href="{{ route('sites.show', [$project->id, $site->id]) }}" class="btn btn-secondary"><i
                                    class="bi bi-skip-backward"></i> Kembali</a>
                        </div>
                        <!-- Vertical Form -->
                        <form class="row g-3" action="{{ route('patients.store', [$project->id, $site->id]) }}"
                            method="POST">
                            @csrf
                            <div class="col-12">
                                <label for="rekam_medis" class="form-label">No. Rekam Medis</label>
                                <input type="text" name="rekam_medis" class="form-control" id="rekam_medis">
                                @error('rekam_medis')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" name="name" class="form-control" id="name">
                                @error('name')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="dob" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="dob" class="form-control" id="dob">
                                @error('dob')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="tags" class="form-label">Tags</label>
                                <div class="row">
                                    @foreach ($tags as $tag)
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                                    class="form-check-input" id="tag_{{ $tag->id }}">
                                                <label class="form-check-label"
                                                    for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
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
