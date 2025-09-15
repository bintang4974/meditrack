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
        <form action="{{ route('projects.search') }}" method="GET" class="mb-3">
            <input type="text" name="project_code" placeholder="Masukkan Kode Project"
                value="{{ request('project_code') }}" class="form-control mb-2">
            <button class="btn btn-primary">Cari</button>
        </form>

        @if ($project)
            <div class="card">
                <div class="card-body">
                    <h5>{{ $project->name }}</h5>
                    <p>{{ $project->description }}</p>
                    <form action="{{ route('projects.join', $project->id) }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <input type="text" name="voucher_code" placeholder="Masukkan Voucher" class="form-control"
                                required>
                        </div>
                        <button type="submit" class="btn btn-success">Gabung</button>
                    </form>
                </div>
            </div>
        @elseif(request('project_code'))
            <p class="text-danger">Project tidak ditemukan.</p>
        @endif
    </section>
@endsection
