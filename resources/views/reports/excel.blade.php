<table>
    <tr>
        <th colspan="7" style="text-align:center; font-size:16px;">
            LEMBAR PORTOFOLIO DOKTER RESIDEN
        </th>
    </tr>
    <tr>
        <td colspan="7" style="text-align:center;">
            Periode: {{ \Carbon\Carbon::createFromDate(null, (int) $month)->translatedFormat('F') }} {{ $year }}
        </td>
    </tr>
    <tr>
        <td colspan="7"></td>
    </tr>

    <tr>
        <th>No</th>
        <th>Nama Pasien</th>
        <th>Rumah Sakit</th>
        <th>Jenis Kegiatan / Kasus</th>
        <th>Tanggal</th>
        <th>Tingkat Objektif Pendidikan</th>
        <th>Keterangan</th>
    </tr>

    @forelse($entries as $entry)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $entry->patient->name ?? '-' }}</td>
            <td>{{ $entry->patient->site->name ?? '-' }}</td>
            <td>{{ $entry->activity_name ?? '-' }}</td>
            <td>{{ \Carbon\Carbon::parse($entry->created_at)->format('d-m-Y') }}</td>
            <td style="text-align:center;">{{ $entry->competence_level }}</td>
            <td>{{ $entry->notes ?? '-' }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="7" style="text-align:center;">Tidak ada data pada bulan ini</td>
        </tr>
    @endforelse
</table>
