@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Daftar Labels</h1>
    </div>

    <section class="section">
        <div class="mb-3">
            <a href="{{ route('labels.filter') }}" class="btn btn-success">
                <i class="bi bi-funnel"></i> Filter Entries Berdasarkan Labels
            </a>
        </div>

        <ul class="list-group">
            @foreach ($labels as $label)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $label->name }}</span>
                    <a href="{{ route('labels.show', $label->id) }}" class="btn btn-sm btn-primary">Lihat Entries</a>
                </li>
            @endforeach
        </ul>
    </section>
@endsection
