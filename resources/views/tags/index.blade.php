@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Daftar Tags</h1>
    </div>

    <section class="section">
        <div class="mb-3">
            <a href="{{ route('tags.filter') }}" class="btn btn-success">
                <i class="bi bi-funnel"></i> Filter Pasien Berdasarkan Tags
            </a>
        </div>

        <ul class="list-group">
            @foreach ($tags as $tag)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $tag->name }}</span>
                    <a href="{{ route('tags.show', $tag->id) }}" class="btn btn-sm btn-primary">Lihat Pasien</a>
                </li>
            @endforeach
        </ul>
    </section>
@endsection
