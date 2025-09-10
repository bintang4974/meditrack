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
                <h3>Detail Entry</h3>

                <div class="card mb-3">
                    <div class="card-header">
                        {{ $entry->category->category_main }} - {{ $entry->category->category_sub }}
                    </div>
                    <div class="card-body">
                        <p><strong>Kode Entry:</strong> {{ $entry->entry_key }}</p>
                        <p><strong>Deskripsi:</strong> {{ $entry->entry_description }}</p>
                        <p><strong>Tanggal:</strong> {{ $entry->entry_date }} {{ $entry->entry_time }}</p>
                        <p><strong>Dibuat Oleh:</strong> {{ $entry->createdBy->name ?? '-' }}</p>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">Operator & Supervisor</div>
                    <div class="card-body">
                        <p><strong>Operator 1:</strong> {{ $entry->operator1->name ?? '-' }}</p>
                        <p><strong>Operator 2:</strong> {{ $entry->operator2->name ?? '-' }}</p>
                        <p><strong>Operator 3:</strong> {{ $entry->operator3->name ?? '-' }}</p>
                        <p><strong>Operator 4:</strong> {{ $entry->operator4->name ?? '-' }}</p>
                        <p><strong>Supervisor:</strong> {{ $entry->supervisor->name ?? '-' }}</p>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">Informasi Operasi</div>
                    <div class="card-body">
                        <p><strong>Tanggal Operasi:</strong> {{ $entry->surgical_date_id }}</p>
                        <p><strong>Jam Mulai:</strong> {{ $entry->surgery_start_time }}</p>
                        <p><strong>Jam Selesai:</strong> {{ $entry->surgery_end_time }}</p>
                        <p><strong>Diagnosis Pre-Operatif:</strong> {{ $entry->preoperative_diagnosis }}</p>
                        <p><strong>Diagnosis Intra-Operatif:</strong> {{ $entry->intraoperative_diagnosis }}</p>
                        <p><strong>Tindakan:</strong> {{ $entry->surgical_procedure }}</p>
                        <p><strong>Perkiraan Kehilangan Darah:</strong> {{ $entry->estimated_blood_loss }} ml</p>
                        <p><strong>Catatan:</strong> {{ $entry->surgical_notes }}</p>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">Lampiran</div>
                    <div class="card-body">
                        @if ($entry->log_image_files)
                            <p><strong>Gambar:</strong></p>
                            @foreach (json_decode($entry->log_image_files, true) as $img)
                                <img src="{{ asset($img) }}" alt="img" class="img-thumbnail me-2 mb-2"
                                    width="150">
                            @endforeach
                        @endif

                        @if ($entry->log_document_files)
                            <p><strong>Dokumen:</strong></p>
                            <ul>
                                @foreach (json_decode($entry->log_document_files, true) as $doc)
                                    <li><a href="{{ asset($doc) }}" target="_blank">{{ basename($doc) }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <a href="{{ route('entries.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </section>
@endsection
