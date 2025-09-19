@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Project</a></li>
                <li class="breadcrumb-item active">Hasil Pencarian</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title">{{ $project->name }}</h4>
                <p>{{ $project->description }}</p>
                <p><strong>Kode Project:</strong> {{ $project->project_code }}</p>

                <form action="{{ route('projects.join', $project->id) }}" method="POST" class="mt-3">
                    @csrf
                    <div class="mb-3">
                        <label>Masukkan Voucher Code untuk Join</label>
                        <input type="text" name="voucher_code" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Join Project</button>
                </form>
            </div>
        </div>
    </section>
@endsection
