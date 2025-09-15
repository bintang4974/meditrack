@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('patients.show', ['project' => $project->id, 'site' => $site->id, 'patient' => $patient->id]) }}">Pasien</a>
                </li>
                <li class="breadcrumb-item active">Detail Entry</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <!-- Info Header -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Detail Entry</h4>
                        <p><strong>Kode Entry:</strong> {{ $entry->entry_key }}</p>
                        <p><strong>Kategori:</strong> {{ $entry->category->category_main }} -
                            {{ $entry->category->category_sub }}</p>
                        <p><strong>Label:</strong> {{ $entry->entry_label ?? '-' }}</p>
                        <p><strong>Tanggal:</strong> {{ $entry->entry_date }} {{ $entry->entry_time }}</p>
                    </div>
                    <div class="card-footer text-muted d-flex justify-content-between">
                        <div>
                            <small>Dibuat oleh: <b>{{ $entry->createdBy->name ?? '-' }}</b></small><br>
                            <small>Tgl. Buat: {{ $entry->created_at->format('M d, Y H:i:s') }}</small>
                        </div>
                        <div class="text-end">
                            <small>Update oleh:
                                <b>{{ optional(App\Models\User::find($entry->last_modified_by))->name ?? '-' }}</b></small><br>
                            <small>Tgl. Update: {{ $entry->updated_at->format('M d, Y H:i:s') }}</small>
                        </div>
                    </div>
                </div>

                <!-- Tabs -->
                <ul class="nav nav-tabs" id="entryTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general"
                            type="button" role="tab">Informasi Umum</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="operation-tab" data-bs-toggle="tab" data-bs-target="#operation"
                            type="button" role="tab">Operasi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="waitlist-tab" data-bs-toggle="tab" data-bs-target="#waitlist"
                            type="button" role="tab">Waitlist</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="attachments-tab" data-bs-toggle="tab" data-bs-target="#attachments"
                            type="button" role="tab">Lampiran</button>
                    </li>
                </ul>

                <div class="tab-content mt-3">
                    <!-- General Info -->
                    <div class="tab-pane fade show active" id="general" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <p><strong>Deskripsi:</strong> {{ $entry->entry_description ?? '-' }}</p>
                                <p><strong>Supervisor:</strong> {{ $entry->supervisor->name ?? '-' }}</p>
                                <p><strong>Kompetensi:</strong> {{ $entry->competence_level ?? '-' }}</p>
                                <p><strong>Status Asuransi:</strong> {{ $entry->insurance_status ?? '-' }}</p>
                                <p><strong>Catatan Asuransi:</strong> {{ $entry->insurance_notes ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Operation Info -->
                    <div class="tab-pane fade" id="operation" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <p><strong>Tanggal Operasi:</strong> {{ $entry->surgical_date_id ?? '-' }}</p>
                                <p><strong>Jam Mulai:</strong> {{ $entry->surgery_start_time ?? '-' }}</p>
                                <p><strong>Jam Selesai:</strong> {{ $entry->surgery_end_time ?? '-' }}</p>
                                <p><strong>Operator 1:</strong> {{ $entry->operator1->name ?? '-' }}</p>
                                <p><strong>Operator 2:</strong> {{ $entry->operator2->name ?? '-' }}</p>
                                <p><strong>Operator 3:</strong> {{ $entry->operator3->name ?? '-' }}</p>
                                <p><strong>Operator 4:</strong> {{ $entry->operator4->name ?? '-' }}</p>
                                <p><strong>Diagnosis Pre-Operatif:</strong> {{ $entry->preoperative_diagnosis ?? '-' }}</p>
                                <p><strong>Diagnosis Intra-Operatif:</strong> {{ $entry->intraoperative_diagnosis ?? '-' }}
                                </p>
                                <p><strong>Tindakan:</strong> {{ $entry->surgical_procedure ?? '-' }}</p>
                                <p><strong>Perkiraan Kehilangan Darah:</strong>
                                    {{ $entry->estimated_blood_loss ? $entry->estimated_blood_loss . ' ml' : '-' }}</p>
                                <p><strong>Catatan Operasi:</strong> {{ $entry->surgical_notes ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Waitlist Info -->
                    <div class="tab-pane fade" id="waitlist" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <p><strong>Status:</strong> {{ $entry->waitlist_status ?? '-' }}</p>
                                <p><strong>Tanggal Masuk:</strong> {{ $entry->waitlist_entry_date ?? '-' }}</p>
                                <p><strong>Group:</strong> {{ $entry->waitlist_group ?? '-' }}</p>
                                <p><strong>Tipe:</strong> {{ $entry->waitlist_type ?? '-' }}</p>
                                <p><strong>Durasi:</strong> {{ $entry->waitlist_duration ?? '-' }}</p>
                                <p><strong>Planned Procedure:</strong> {{ $entry->waitlist_planned_procedure ?? '-' }}</p>
                                <p><strong>Operator:</strong> {{ $entry->waitlistOperator->name ?? '-' }}</p>
                                <p><strong>Scheduling Status:</strong> {{ $entry->waitlist_scheduling_status ?? '-' }}</p>
                                <p><strong>Tanggal Dijadwalkan:</strong> {{ $entry->waitlist_scheduled_date ?? '-' }}</p>
                                <p><strong>Ruang Operasi:</strong> {{ $entry->waitlist_operating_room ?? '-' }}</p>
                                <p><strong>Round:</strong> {{ $entry->waitlist_surgery_round ?? '-' }}</p>
                                <p><strong>Tanggal Selesai:</strong> {{ $entry->waitlist_completed_date ?? '-' }}</p>
                                <p><strong>Alasan Selesai:</strong> {{ $entry->waitlist_completion_reason ?? '-' }}</p>
                                <p><strong>Catatan Selesai:</strong> {{ $entry->waitlist_completion_notes ?? '-' }}</p>
                                <p><strong>Tanggal Ditunda:</strong> {{ $entry->waitlist_suspended_date ?? '-' }}</p>
                                <p><strong>Alasan Ditunda:</strong> {{ $entry->waitlist_suspended_reason ?? '-' }}</p>
                                <p><strong>Catatan Penundaan:</strong> {{ $entry->waitlist_suspended_notes ?? '-' }}</p>
                                <p><strong>Log Komunikasi:</strong> {{ $entry->waitlist_communication_log ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Attachments -->
                    <div class="tab-pane fade" id="attachments" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                @if ($entry->log_image_files)
                                    <p><strong>Gambar:</strong></p>
                                    <div class="d-flex flex-wrap">
                                        {{-- @foreach (json_decode($entry->log_image_files, true) as $img)
                                            <img src="{{ asset($img) }}" class="img-thumbnail me-2 mb-2" width="150">
                                        @endforeach --}}
                                    </div>
                                @endif

                                @if ($entry->log_document_files)
                                    <p><strong>Dokumen:</strong></p>
                                    <ul>
                                        {{-- @foreach (json_decode($entry->log_document_files, true) as $doc)
                                            <li><a href="{{ asset($doc) }}" target="_blank">{{ basename($doc) }}</a>
                                            </li>
                                        @endforeach --}}
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('patients.show', ['project' => $project->id, 'site' => $site->id, 'patient' => $patient->id]) }}"
                    class="btn btn-secondary mt-3">Kembali ke Pasien</a>
            </div>
        </div>
    </section>
@endsection
