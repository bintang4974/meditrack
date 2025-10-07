@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <form action="" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label for="month" class="form-label">Bulan</label>
                        <select id="month" name="month" class="form-select" required>
                            @foreach (range(1, 12) as $m)
                                <option value="{{ $m }}">
                                    {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="year" class="form-label">Tahun</label>
                        <select id="year" name="year" class="form-select" required>
                            @foreach ($years as $y)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <a href="#" id="exportExcel" class="btn btn-success me-2">
                            <i class="bi bi-file-earmark-excel"></i> Export Excel
                        </a>
                        <a href="#" id="exportPdf" class="btn btn-danger">
                            <i class="bi bi-file-earmark-pdf"></i> Export PDF
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const baseUrl = "{{ route('reports.index', $project->id) }}";
            const excelUrl = "{{ route('reports.exportExcel', $project->id) }}";
            const pdfUrl = "{{ route('reports.exportPdf', $project->id) }}";

            const month = document.getElementById('month');
            const year = document.getElementById('year');
            const exportExcel = document.getElementById('exportExcel');
            const exportPdf = document.getElementById('exportPdf');

            exportExcel.addEventListener('click', e => {
                e.preventDefault();
                window.location.href = `${excelUrl}?month=${month.value}&year=${year.value}`;
            });

            exportPdf.addEventListener('click', e => {
                e.preventDefault();
                window.location.href = `${pdfUrl}?month=${month.value}&year=${year.value}`;
            });
        });
    </script>
@endsection
