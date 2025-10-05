@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Pasien dengan Tag: {{ $tag->name }}</h1>
    </div>

    <div class="mb-3">
        <a href="{{ route('tags.index', $project->id) }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Tags
        </a>
    </div>


    <section class="section">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No Rekam Medis</th>
                    <th>Nama</th>
                    <th>Rumah Sakit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($patients as $patient)
                    <tr>
                        <td>{{ $patient->rekam_medis }}</td>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->site->name }}</td>
                        <td>
                            <a href="{{ route('patients.show', [$patient->site->project_id, $patient->site_id, $patient->id]) }}"
                                class="btn btn-sm btn-info">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada pasien dengan tag ini</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection
