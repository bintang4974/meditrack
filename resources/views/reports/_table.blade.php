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
                        <td>
                            @switch($entry->competence_level)
                                @case('1')
                                    Tingkat 1 (Asisten)
                                @break

                                @case('2')
                                    Tingkat 2 (Mandiri Terbimbing)
                                @break

                                @case('3')
                                    Tingkat 3 (Mandiri Penuh)
                                @break

                                @default
                                    {{ $entry->competence_level ?? '-' }}
                            @endswitch
                        </td>
                        <td>{{ $entry->labels->pluck('name')->join(', ') ?: '-' }}</td>
                        <td>{{ $entry->patient->tags->pluck('name')->join(', ') ?: '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    
    <div class="text-end mt-3">
        <form id="exportExcelForm" method="POST" action="{{ route('reports.export.excel') }}" class="d-inline">
            @csrf
            <input type="hidden" name="filters" id="excelFilters">
            <button type="submit" class="btn btn-success me-2">
                <i class="bi bi-file-earmark-excel"></i> Export Excel
            </button>
        </form>

        <form id="exportPdfForm" method="POST" action="{{ route('reports.export.pdf') }}" class="d-inline">
            @csrf
            <input type="hidden" name="filters" id="pdfFilters">
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-file-earmark-pdf"></i> Export PDF
            </button>
        </form>
    </div>
@endif
