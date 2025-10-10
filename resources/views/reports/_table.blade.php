@if ($entries->isEmpty())
    <div class="alert alert-warning">Tidak ada data ditemukan untuk filter ini.</div>
@else
    <h5>Hasil Filter ({{ $entries->count() }} data)</h5>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Pasien</th>
                    <th>Rumah Sakit</th>
                    <th>Kategori</th>
                    <th>Sub Kategori</th>
                    <th>Kompetensi</th>
                    <th>Label</th>
                    <th>Tag</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($entries as $i => $entry)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $entry->entry_date ?? '-' }}</td>
                        <td>{{ $entry->patient->name ?? '-' }}</td>
                        <td>{{ $entry->patient->site->name ?? '-' }}</td>
                        <td>{{ $entry->subCategory->category->name ?? '-' }}</td>
                        <td>{{ $entry->subCategory->name ?? '-' }}</td>
                        <td>{{ $entry->competence_level ?? '-' }}</td>
                        <td>{{ $entry->labels->pluck('name')->join(', ') }}</td>
                        <td>{{ $entry->patient->tags->pluck('name')->join(', ') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-end mt-3">
        <a href="{{ route('reports.export.excel', request()->query()) }}" class="btn btn-success me-2"><i
                class="bi bi-file-earmark-excel"></i> Export Excel</a>
        <a href="{{ route('reports.export.pdf', request()->query()) }}" class="btn btn-danger"><i
                class="bi bi-file-earmark-pdf"></i> Export PDF</a>
    </div>
@endif
