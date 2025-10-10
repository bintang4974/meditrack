<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Aktivitas</title>

    {{-- Bootstrap minimal styling untuk PDF --}}
    <style>
        @page {
            size: A4 landscape;
            margin: 1.2cm;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th,
        .table td {
            border: 1px solid #ccc;
            padding: 6px 8px;
            text-align: left;
            vertical-align: middle;
        }

        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header h2 {
            margin-bottom: 0;
        }

        .header small {
            color: #777;
        }

        .info-table {
            margin-top: 10px;
            width: 100%;
            font-size: 11px;
        }

        .info-table td {
            padding: 4px 6px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Laporan Aktivitas</h2>
        <small>{{ $project->name ?? '-' }}</small>
    </div>

    {{-- Informasi Filter --}}
    <table class="info-table">
        <tr>
            <td><strong>Rentang Waktu:</strong></td>
            <td>{{ $filters['from_date'] ?? '-' }} s/d {{ $filters['to_date'] ?? '-' }}</td>
            <td><strong>Scope:</strong></td>
            <td>
                @if (($filters['scope'] ?? 'all') === 'mine')
                    Data Saya Saja
                @else
                    Cetak Semua Data Project
                @endif
            </td>
        </tr>
        <tr>
            <td><strong>Rumah Sakit:</strong></td>
            <td>
                @php
                    $siteId = is_array($filters['site_id'] ?? null)
                        ? $filters['site_id'][0]
                        : $filters['site_id'] ?? null;
                    $site = $siteId && $siteId !== 'all' ? \App\Models\Site::find($siteId) : null;
                @endphp

                {{ $site?->name ?? 'Semua Rumah Sakit' }}
            </td>

            <td><strong>Tanggal Cetak:</strong></td>
            <td>{{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }}</td>
        </tr>
    </table>

    {{-- Tabel Data --}}
    <table class="table">
        <thead>
            <tr>
                <th style="width: 4%">No</th>
                <th style="width: 10%">Tanggal</th>
                <th style="width: 15%">Pasien</th>
                <th style="width: 15%">Rumah Sakit</th>
                <th style="width: 15%">Kategori</th>
                <th style="width: 15%">Sub-Kategori</th>
                <th style="width: 10%">Kompetensi</th>
                <th style="width: 13%">Label</th>
                <th style="width: 13%">Tag</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($entries as $index => $entry)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
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
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">Tidak ada data untuk rentang dan filter yang
                            dipilih.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 30px; text-align: right; font-size: 11px; color: #777;">
            Dicetak oleh: <strong>{{ Auth::user()->name ?? 'User' }}</strong><br>
            {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }}
        </div>

    </body>

    </html>
