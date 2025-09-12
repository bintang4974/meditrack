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
                        <form class="row g-3" action="{{ route('categories.store') }}" method="POST">
                            @csrf
                            <div class="col-12">
                                <label for="project_key" class="form-label">Project Key</label>
                                <input type="text" name="project_key" class="form-control" id="project_key">
                                @error('project_key')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="category_main" class="form-label">Main Kategori</label>
                                <input type="text" name="category_main" class="form-control" id="category_main">
                                @error('category_main')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="category_sub" class="form-label">Sub Kategori</label>
                                <input type="text" name="category_sub" class="form-control" id="category_sub">
                                @error('category_sub')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="category_sub_description" class="form-label">Deskripsi Sub Kategori</label>
                                <input type="text" name="category_sub_description" class="form-control" id="category_sub_description">
                                @error('category_sub_description')
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
