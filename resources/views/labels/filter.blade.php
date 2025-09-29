@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Filter Entries Berdasarkan Labels</h1>
    </div>

    <section class="section">
        <form action="{{ route('labels.filter') }}" method="GET" class="mb-4">
            <div class="mb-3">
                <label>Pilih Labels</label>
                <div class="row">
                    @foreach ($labels as $label)
                        <div class="col-md-3">
                            <div class="form-check">
                                <input type="checkbox" name="labels[]" value="{{ $label->id }}"
                                    id="label_{{ $label->id }}" class="form-check-input"
                                    {{ in_array($label->id, $selectedLabels ?? []) ? 'checked' : '' }}>
                                <label for="label_{{ $label->id }}" class="form-check-label">
                                    {{ $label->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Cari Entries</button>
            <a href="{{ route('labels.index') }}" class="btn btn-secondary">Kembali</a>
        </form>

        @if (empty($selectedLabels))
            <div class="alert alert-info">
                Silakan pilih satu atau lebih label untuk memulai filter.
            </div>
        @else
            @if ($entries->isEmpty())
                <div class="alert alert-warning">
                    Tidak ada entry dengan kombinasi labels ini.
                </div>
            @else
                <h5>Hasil Filter:</h5>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Entry Key</th>
                            <th>Pasien</th>
                            <th>Rumah Sakit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($entries as $entry)
                            <tr>
                                <td>{{ $entry->entry_key }}</td>
                                <td>{{ $entry->patient->name }}</td>
                                <td>{{ $entry->patient->site->name }}</td>
                                <td>
                                    <a href="{{ route('entries.show', [$entry->project_id, $entry->patient->site_id, $entry->patient_id, $entry->id]) }}"
                                        class="btn btn-sm btn-info">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        @endif
    </section>
@endsection
