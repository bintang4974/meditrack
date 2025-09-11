{{-- <div class="mb-3">
    <label for="patient_id">Pasien</label>
    <select id="patient_id" name="patient_id" class="form-control" required>
        <option value="">-- Pilih Pasien --</option>
        @foreach ($patients as $p)
            <option value="{{ $p->id }}">
                {{ $p->rekam_medis }} - {{ $p->name }}
            </option>
        @endforeach
    </select>
</div> --}}
<div class="mb-3">
    <label>Tanggal Operasi</label>
    <input type="date" name="surgical_date_id" class="form-control">
</div>
<div class="mb-3">
    <label>Lokasi Operasi</label>
    <input type="text" name="surgical_site_key" class="form-control">
</div>
<div class="mb-3">
    <label>Jam Mulai</label>
    <input type="time" name="surgery_start_time" class="form-control">
</div>
<div class="mb-3">
    <label>Jam Selesai</label>
    <input type="time" name="surgery_end_time" class="form-control">
</div>
<div class="mb-3">
    <label>Operator 1</label>
    <input type="text" name="operator_1" class="form-control">
</div>
<div class="mb-3">
    <label>Operator 2</label>
    <input type="text" name="operator_2" class="form-control">
</div>
<div class="mb-3">
    <label>Operator 3</label>
    <input type="text" name="operator_3" class="form-control">
</div>
<div class="mb-3">
    <label>Operator 4</label>
    <input type="text" name="operator_4" class="form-control">
</div>
<div class="mb-3">
    <label>Diagnosis Pre Operatif</label>
    <textarea name="preoperative_diagnosis" class="form-control"></textarea>
</div>
<div class="mb-3">
    <label>Diagnosis Intra Operatif</label>
    <textarea name="intraoperative_diagnosis" class="form-control"></textarea>
</div>
<div class="mb-3">
    <label>Tindakan</label>
    <input type="text" name="surgical_procedure" class="form-control">
</div>
<div class="mb-3">
    <label>Perkiraan Kehilangan Darah</label>
    <input type="number" name="estimated_blood_loss" class="form-control">
</div>
<div class="mb-3">
    <label>Catatan</label>
    <textarea name="surgical_notes" class="form-control"></textarea>
</div>
