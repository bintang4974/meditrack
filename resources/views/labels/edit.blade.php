@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
    </div>

    <section class="section">
        <form action="{{ route('labels.update', [$project->id, $label->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Label</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $label->name) }}" required>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $label->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('labels.index', $project->id) }}" class="btn btn-secondary">Kembali</a>
        </form>
    </section>
@endsection
