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
                        <h5 class="card-title">Form Tambah</h5>
                        <!-- Vertical Form -->
                        <form class="row g-3" action="{{ route('patients.store') }}" method="POST">
                            @csrf
                            <div class="col12">
                                <div class="form-floating mb-3">
                                    <select name="site_id" class="form-select" id="floatingSelect" aria-label="State">
                                        <option value="">-- Pilih Rumah Sakit --</option>
                                        @foreach ($sites as $site)
                                            <option value="{{ $site->id }}">{{ $site->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelect">Rumah Sakit</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="rekam_medis" class="form-label">Rekam Medis</label>
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
                                <label for="dob" class="form-label">Tanggal lahir</label>
                                <input type="date" name="dob" class="form-control" id="dob">
                                @error('dob')
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
