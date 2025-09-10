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
            <div class="col-lg-12">
                <h3>Daftar Project Saya</h3>
                <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Buat Project Baru</a>

                <form action="{{ route('projects.join') }}" method="POST" class="mb-3">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="voucher_code" class="form-control" placeholder="Masukkan Kode Voucher"
                            required>
                        <button class="btn btn-success">Join Project</button>
                    </div>
                </form>

                <ul class="list-group">
                    @foreach ($projects as $project)
                        <li class="list-group-item d-flex justify-content-between">
                            {{ $project->name }}
                            <span class="badge bg-secondary">Kode: {{ $project->voucher_code }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
@endsection
