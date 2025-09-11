<h3>Riwayat Pasien: {{ $patient->name }} ({{ $patient->rekam_medis }})</h3>

<ul class="timeline">
    @foreach ($patient->entries()->orderBy('created_at')->get() as $entry)
        <li>
            <strong>{{ $entry->created_at->format('d M Y') }}</strong>
            - {{ $entry->category->category_sub }}
            - Status: {{ $entry->waitlist_status ?? 'N/A' }}
            @if ($entry->surgical_procedure)
                <br>Prosedur: {{ $entry->surgical_procedure }}
            @endif
        </li>
    @endforeach
</ul>
