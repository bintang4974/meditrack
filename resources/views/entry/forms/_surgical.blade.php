{{-- ======================== --}}
{{-- Surgical Care Form --}}
{{-- ======================== --}}
<h5 class="mt-3">Form Surgical Care</h5>

<div class="mb-3">
    <label>Entry Key</label>
    <input type="text" name="entry_key" class="form-control">
</div>

<div class="mb-3">
    <label>Tanggal Operasi</label>
    <input type="date" name="surgical_date" class="form-control">
</div>

<div class="mb-3">
    <label>Lokasi Operasi</label>
    <input type="text" name="surgical_site_key" class="form-control">
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label>Jam Mulai</label>
        <input type="time" name="surgery_start_time" class="form-control">
    </div>
    <div class="col-md-6 mb-3">
        <label>Jam Selesai</label>
        <input type="time" name="surgery_end_time" class="form-control">
    </div>
</div>

@for ($i = 1; $i <= 4; $i++)
    <div class="mb-3">
        <label>Operator {{ $i }}</label>
        <select name="operator_{{ $i }}" class="form-control">
            <option value="">-- Pilih Dokter --</option>
            @foreach ($doctors as $doc)
                <option value="{{ $doc->id }}">{{ $doc->name }} ({{ ucfirst($doc->role) }})</option>
            @endforeach
        </select>
    </div>
@endfor

<div class="mb-3">
    <label>Preoperative Diagnosis</label>
    <textarea name="preoperative_diagnosis" class="form-control"></textarea>
</div>

<div class="mb-3">
    <label>Intraoperative Diagnosis</label>
    <textarea name="intraoperative_diagnosis" class="form-control"></textarea>
</div>

<div class="mb-3">
    <label>Tindakan Operasi</label>
    <textarea name="surgical_procedure" class="form-control"></textarea>
</div>

<div class="mb-3">
    <label>Perkiraan Kehilangan Darah (ml)</label>
    <input type="number" name="estimated_blood_loss" class="form-control">
</div>

<div class="mb-3">
    <label>Catatan Operasi</label>
    <textarea name="surgical_notes" class="form-control"></textarea>
</div>

<div class="mb-3">
    <label>Supervisor</label>
    <select name="entry_supervisor" class="form-control">
        <option value="">-- Pilih Supervisor --</option>
        @foreach ($supervisors as $sup)
            <option value="{{ $sup->id }}">{{ $sup->name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Tingkat Kompetensi</label>
    <input type="text" name="competence_level" class="form-control">
</div>

<div class="mb-3">
    <label>Status Asuransi</label>
    <input type="text" name="insurance_status" class="form-control">
</div>

<div class="mb-3">
    <label>Catatan Asuransi</label>
    <textarea name="insurance_notes" class="form-control"></textarea>
</div>

{{-- Pilih Labels --}}
<div class="mb-3">
    <label>Pilih Labels</label>
    <div class="row">
        @foreach ($labels as $label)
            <div class="col-md-3">
                <div class="form-check">
                    <input type="checkbox" name="labels[]" value="{{ $label->id }}" class="form-check-input"
                        id="label_{{ $label->id }}">
                    <label class="form-check-label" for="label_{{ $label->id }}">
                        {{ $label->name }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>
    <small class="text-muted">Pilih satu atau lebih label untuk entry ini</small>
</div>
