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
        <input type="text" name="operator_{{ $i }}" class="form-control">
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
    <input type="text" name="entry_supervisor" class="form-control">
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
