@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
    </div>

    <section class="section">
        <a href="{{ route('tags.index', $project->id) }}" class="btn btn-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <form action="{{ route('tags.update', [$project->id, $tag->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Nama Tag</label>
                <input type="text" name="name" class="form-control" value="{{ $tag->name }}" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control">{{ $tag->description }}</textarea>
            </div>
            <button class="btn btn-primary">Update</button>
        </form>
    </section>
@endsection
