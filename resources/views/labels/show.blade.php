@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Entries dengan Label: {{ $label->name }}</h1>
    </div>

    <section class="section">
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
                @forelse ($entries as $entry)
                    <tr>
                        <td>{{ $entry->entry_key }}</td>
                        <td>{{ $entry->patient->name }}</td>
                        <td>{{ $entry->patient->site->name }}</td>
                        <td>
                            <a href="{{ route('entries.show', [$entry->project_id, $entry->patient->site_id, $entry->patient_id, $entry->id]) }}"
                                class="btn btn-sm btn-info">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada entry dengan label ini</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection
