@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
    </div>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($project)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $project->name }}</h5>
                <p>{{ $project->description }}</p>
                <p><strong>Kode Project:</strong> {{ $project->project_code }}</p>
                <p><strong>Voucher:</strong> {{ $project->voucher_code }}</p>

                <form action="{{ route('projects.join', $project->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Gabung ke Project Ini</button>
                </form>
            </div>
        </div>
    @endif
@endsection
