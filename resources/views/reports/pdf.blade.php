<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Aktivitas</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #555;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #f0f0f0;
        }
    </style>
</head>

<body>
    <h2 style="text-align:center;">Laporan Aktivitas Project: {{ $project->name }}</h2>
    <p>Periode: {{ $filters['from_date'] ?? '-' }} s/d {{ $filters['to_date'] ?? '-' }}</p>

    <table>
        <thead>
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
                    <td>{{ $entry->entry_date }}</td>
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
</body>

</html>
