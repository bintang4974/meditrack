@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Waitlist Tracking</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pasien: {{ $entry->patient->name }} ({{ $entry->patient->rekam_medis }})</h5>
                        <p>Rumah Sakit: {{ $entry->patient->site->name }}</p>
                        <p>Status Saat Ini: <strong>{{ $entry->waitlist_status }}</strong></p>

                        <form action="{{ route('entries.update', $entry->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label>Status Waitlist</label>
                                <select name="waitlist_status" id="waitlist_status" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    <option value="ACTIVE" {{ $entry->waitlist_status == 'ACTIVE' ? 'selected' : '' }}>
                                        ACTIVE</option>
                                    <option value="SCHEDULED"
                                        {{ $entry->waitlist_status == 'SCHEDULED' ? 'selected' : '' }}>SCHEDULED</option>
                                    <option value="COMPLETED"
                                        {{ $entry->waitlist_status == 'COMPLETED' ? 'selected' : '' }}>COMPLETED</option>
                                    <option value="SUSPENDED"
                                        {{ $entry->waitlist_status == 'SUSPENDED' ? 'selected' : '' }}>SUSPENDED</option>
                                </select>
                            </div>

                            <div id="waitlist-fields">
                                {{-- Dynamic form akan ditampilkan via JS sesuai status --}}
                            </div>

                            <button type="submit" class="btn btn-primary">Update Status</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const statusSelect = document.getElementById('waitlist_status');
        const container = document.getElementById('waitlist-fields');

        function renderFields(status) {
            container.innerHTML = '';
            if (status === 'ACTIVE') {
                container.innerHTML +=
                    `<div class="mb-3"><label>Tanggal Masuk</label><input type="date" name="waitlist_entry_date" class="form-control"></div>`;
                container.innerHTML +=
                    `<div class="mb-3"><label>Group</label><input type="text" name="waitlist_group" class="form-control"></div>`;
                container.innerHTML +=
                    `<div class="mb-3"><label>Tipe</label><input type="text" name="waitlist_type" class="form-control"></div>`;
            }
            if (status === 'SCHEDULED') {
                container.innerHTML +=
                    `<div class="mb-3"><label>Tanggal Dijadwalkan</label><input type="date" name="waitlist_scheduled_date" class="form-control"></div>`;
                container.innerHTML +=
                    `<div class="mb-3"><label>Operating Room</label><input type="text" name="waitlist_operating_room" class="form-control"></div>`;
            }
            if (status === 'COMPLETED') {
                container.innerHTML +=
                    `<div class="mb-3"><label>Tanggal Selesai</label><input type="date" name="waitlist_completed_date" class="form-control"></div>`;
                container.innerHTML +=
                    `<div class="mb-3"><label>Alasan</label><input type="text" name="waitlist_completion_reason" class="form-control"></div>`;
            }
            if (status === 'SUSPENDED') {
                container.innerHTML +=
                    `<div class="mb-3"><label>Tanggal Ditunda</label><input type="date" name="waitlist_suspended_date" class="form-control"></div>`;
                container.innerHTML +=
                    `<div class="mb-3"><label>Alasan</label><input type="text" name="waitlist_suspended_reason" class="form-control"></div>`;
            }
        }

        statusSelect.addEventListener('change', e => renderFields(e.target.value));
        renderFields(statusSelect.value);
    </script>
@endpush
