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
                        <h5 class="card-title">Form Edit</h5>
                        <!-- Vertical Form -->
                        <form class="row g-3" action="{{ route('sites.update', $site->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="col-12">
                                <label for="name" class="form-label">Nama Rumah Sakit</label>
                                <input type="text" name="name" value="{{ $site->name }}" class="form-control" id="name">
                                @error('name')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="location" class="form-label">Lokasi</label>
                                <input type="text" name="location" value="{{ $site->location }}" class="form-control" id="location">
                                @error('location')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- Vertical Form -->
                    </div>
                </div>
            </div>
    </section>
@endsection
