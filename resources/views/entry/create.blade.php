@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Entry</li>
                <li class="breadcrumb-item active">Tambah Entry</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <form
                    action="{{ route('entries.store', ['project' => $project->id, 'site' => $site->id, 'patient' => $patient->id]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Category -->
                    <div class="mb-3">
                        <label for="category_id">Kategori</label>
                        <select id="category_id" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="sub_category_id">Sub Kategori</label>
                        <select name="sub_category_id" id="sub_category_id" class="form-control" required>
                            <option value="">-- Pilih Sub Kategori --</option>
                        </select>
                    </div>

                    <!-- Entry fields -->
                    <div class="mb-3">
                        <label for="entry_label">Judul / Label</label>
                        <input type="text" name="entry_label" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="entry_description">Deskripsi</label>
                        <textarea name="entry_description" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="entry_date">Tanggal</label>
                        <input type="date" name="entry_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="entry_time">Waktu</label>
                        <input type="time" name="entry_time" class="form-control">
                    </div>

                    <!-- Upload -->
                    <div class="mb-3">
                        <label for="image_file">Upload Gambar</label>
                        <input type="file" name="image_file" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="document_file">Upload Dokumen</label>
                        <input type="file" name="document_file" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('patients.show', ['project' => $project->id, 'site' => $site->id, 'patient' => $patient->id]) }}"
                        class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.getElementById('category_id').addEventListener('change', function() {
            let catId = this.value;
            let subSelect = document.getElementById('sub_category_id');
            subSelect.innerHTML = '<option value="">Loading...</option>';

            if (catId) {
                fetch(`/categories/${catId}/sub-categories`)
                    .then(res => res.json())
                    .then(data => {
                        subSelect.innerHTML = '<option value="">-- Pilih Sub Kategori --</option>';
                        data.forEach(sub => {
                            subSelect.innerHTML += `<option value="${sub.id}">${sub.name}</option>`;
                        });
                    })
                    .catch(() => {
                        subSelect.innerHTML = '<option value="">Gagal memuat</option>';
                    });
            } else {
                subSelect.innerHTML = '<option value="">-- Pilih Sub Kategori --</option>';
            }
        });
    </script>
@endpush
