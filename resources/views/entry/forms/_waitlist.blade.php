<div class="mb-3">
    <label>Status</label>
    <select name="waitlist_status" id="waitlist_status" class="form-control">
        <option value="">-- Pilih Status --</option>
        <option value="ACTIVE">ACTIVE</option>
        <option value="SCHEDULED">SCHEDULED</option>
        <option value="COMPLETED">COMPLETED</option>
        <option value="SUSPENDED">SUSPENDED</option>
    </select>
</div>

<div id="waitlist-fields"></div>

@push('scripts')
    <script>
        document.getElementById('waitlist_status').addEventListener('change', function() {
            let status = this.value;
            let container = document.getElementById('waitlist-fields');
            container.innerHTML = '';

            if (status === 'ACTIVE') {
                container.innerHTML += `
            <div class="mb-3"><label>Tanggal Masuk</label><input type="date" name="waitlist_entry_date" class="form-control"></div>
            <div class="mb-3"><label>Group</label><input type="text" name="waitlist_group" class="form-control"></div>
            <div class="mb-3"><label>Tipe</label><input type="text" name="waitlist_type" class="form-control"></div>
            <div class="mb-3"><label>Durasi</label><input type="text" readonly value="auto-calc" class="form-control"></div>
            <div class="mb-3"><label>Planned Procedure</label><input type="text" name="waitlist_planned_procedure" class="form-control"></div>
            <div class="mb-3"><label>Operator</label><select name="waitlist_operator_key" class="form-control"><option value="">-- pilih --</option></select></div>
            <div class="mb-3"><label>Scheduling Status</label><input type="text" name="waitlist_scheduling_status" class="form-control"></div>
        `;
            }

            if (status === 'SCHEDULED') {
                container.innerHTML += `
            <div class="mb-3"><label>Tanggal Dijadwalkan</label><input type="date" name="waitlist_scheduled_date" class="form-control"></div>
            <div class="mb-3"><label>Operating Room</label><input type="text" name="waitlist_operating_room" class="form-control"></div>
            <div class="mb-3"><label>Surgery Round</label><input type="text" name="waitlist_surgery_round" class="form-control"></div>
        `;
            }

            if (status === 'COMPLETED') {
                container.innerHTML += `
            <div class="mb-3"><label>Tanggal Selesai</label><input type="date" name="waitlist_completed_date" class="form-control"></div>
            <div class="mb-3"><label>Alasan</label><input type="text" name="waitlist_completion_reason" class="form-control"></div>
            <div class="mb-3"><label>Catatan</label><textarea name="waitlist_completion_notes" class="form-control"></textarea></div>
            <div class="mb-3"><label>Durasi Completed</label><input type="text" readonly value="auto-calc" class="form-control"></div>
        `;
            }

            if (status === 'SUSPENDED') {
                container.innerHTML += `
            <div class="mb-3"><label>Tanggal Ditunda</label><input type="date" name="waitlist_suspended_date" class="form-control"></div>
            <div class="mb-3"><label>Alasan</label><input type="text" name="waitlist_suspended_reason" class="form-control"></div>
            <div class="mb-3"><label>Catatan</label><textarea name="waitlist_suspended_notes" class="form-control"></textarea></div>
        `;
            }
        });
    </script>
@endpush
