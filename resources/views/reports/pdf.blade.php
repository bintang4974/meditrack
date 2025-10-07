<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Bulanan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
        }
    </style>
</head>

<body>
    <h3 style="text-align:center;">Laporan Portofolio Bulanan</h3>
    <p><strong>Project:</strong> {{ $project->name }}</p>
    <p><strong>Periode:</strong> {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}
        {{ $year }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Pasien</th>
                <th>Rumah Sakit</th>
                <th>Deskripsi</th>
                <th>Tingkat Objektif</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entries as $i => $entry)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $entry->created_at->format('d-m-Y') }}</td>
                    <td>{{ $entry->patient->name ?? '-' }}</td>
                    <td>{{ $entry->patient->site->name ?? '-' }}</td>
                    <td>{{ $entry->description ?? '-' }}</td>
                    <td>{{ $entry->competence_level ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
