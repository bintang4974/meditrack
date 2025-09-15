@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <form
                    action="{{ route('entries.store', [
                        'project' => $project->id,
                        'site' => $site->id,
                        'patient' => $patient->id,
                    ]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="category_id">Kategori</label>
                        <select id="category_id" name="category_id" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_main }} - {{ $cat->category_sub }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div id="form-fields">
                        <p class="text-muted">Silakan pilih kategori untuk menampilkan form tambahan.</p>
                    </div>

                    <div class="mb-3">
                        <label for="entry_date">Tanggal Entry</label>
                        <input type="date" name="entry_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="entry_label">Label</label>
                        <input type="text" name="entry_label" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="entry_description">Deskripsi</label>
                        <textarea name="entry_description" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('patients.show', [
                        'project' => $project->id,
                        'site' => $site->id,
                        'patient' => $patient->id,
                    ]) }}"
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
            if (!catId) return;

            fetch(`{{ url('/entries/form-fields') }}/${catId}`)
                .then(res => res.text())
                .then(html => {
                    document.getElementById('form-fields').innerHTML = html;
                })
                .catch(err => {
                    document.getElementById('form-fields').innerHTML =
                        `<p class="text-danger">Gagal load form (${err.message})</p>`;
                });
        });
    </script>
@endpush
