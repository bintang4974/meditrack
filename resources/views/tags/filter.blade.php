@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Filter Pasien Berdasarkan Tags</h1>
    </div>

    <section class="section">
        <div class="mb-3">
            <a href="{{ route('tags.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Tags
            </a>
        </div>

        <form action="{{ route('tags.filter') }}" method="GET" class="mb-4">
            <div class="mb-3">
                <label>Pilih Tag</label>
                <div class="row">
                    @foreach ($tags as $tag)
                        <div class="col-md-3">
                            <div class="form-check">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                    id="tag_{{ $tag->id }}" class="form-check-input"
                                    {{ in_array($tag->id, $selectedTags ?? []) ? 'checked' : '' }}>
                                <label for="tag_{{ $tag->id }}" class="form-check-label">
                                    {{ $tag->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Cari Pasien</button>
        </form>

        @if (!empty($selectedTags))
            <h5>Hasil Filter:</h5>
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
                            <td colspan="4" class="text-center">Tidak ada pasien dengan kombinasi tag ini</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @endif
    </section>
@endsection
