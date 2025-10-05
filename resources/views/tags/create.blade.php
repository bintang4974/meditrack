@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
    </div>

    <section class="section">
        <a href="{{ route('tags.index', $project->id) }}" class="btn btn-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <form action="{{ route('tags.store', $project->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nama Tag</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <button class="btn btn-primary">Simpan</button>
        </form>
    </section>
@endsection
