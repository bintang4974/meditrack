{{-- ======================== --}}
{{-- Normal Entry Form --}}
{{-- ======================== --}}
<h5 class="mt-3">Form Normal Entry</h5>

<div class="mb-3">
    <label>Deskripsi</label>
    <textarea name="entry_description" class="form-control"></textarea>
</div>

<div class="mb-3">
    <label>Label Entry</label>
    <input type="text" name="entry_label" class="form-control">
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label>Tanggal</label>
        <input type="date" name="entry_date" class="form-control">
    </div>
    <div class="col-md-6 mb-3">
        <label>Waktu</label>
        <input type="time" name="entry_time" class="form-control">
    </div>
</div>

<div class="mb-3">
    <label>Upload Gambar</label>
    <input type="file" name="image_file" class="form-control" multiple>
</div>

<div class="mb-3">
    <label>Upload Dokumen</label>
    <input type="file" name="document_file" class="form-control" multiple>
</div>

<div class="mb-3">
    <label>Supervisor</label>
    <input type="text" name="entry_supervisor" class="form-control">
</div>

<div class="mb-3">
    <label>Tingkat Kompetensi</label>
    <input type="text" name="competence_level" class="form-control">
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
