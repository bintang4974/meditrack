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
        <div class="row">
            <div class="col-lg-12">
                <h3>{{ $pageTitle }} (Project: {{ $project->name }})</h3>

                <form action="{{ route('projects.entries.store', $project->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="patient_id">Pasien</label>
                        <select id="patient_id" name="patient_id" class="form-control" required>
                            <option value="">-- Pilih Pasien --</option>
                            @foreach ($patients as $p)
                                <option value="{{ $p->id }}">
                                    {{ $p->rekam_medis }} - {{ $p->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="category_id">Kategori</label>
                        <select id="category_id" name="category_id" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">
                                    {{ $cat->category_main }} - {{ $cat->category_sub }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div id="form-fields">
                        <p class="text-muted">Silakan pilih kategori untuk menampilkan form.</p>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Simpan Entry</button>
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
                .then(res => {
                    if (!res.ok) throw new Error("HTTP status " + res.status);
                    return res.text();
                })
                .then(html => {
                    document.getElementById('form-fields').innerHTML = html;
                })
                .catch(err => {
                    console.error("Fetch error:", err);
                    document.getElementById('form-fields').innerHTML =
                        `<p class="text-danger">Gagal load form (${err.message})</p>`;
                });
        });
    </script>
@endpush
