@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
    </div>

    <section class="section">
        <form action="{{ route('labels.store', $project->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nama Label</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('labels.index', $project->id) }}" class="btn btn-secondary">Kembali</a>
        </form>
    </section>
@endsection
