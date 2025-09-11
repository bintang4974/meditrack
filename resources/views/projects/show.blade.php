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
                <h3>{{ $project->name }}</h3>
                <p>{{ $project->description }}</p>
                <p><strong>Kode Voucher:</strong> {{ $project->voucher_code }}</p>

                <a href="{{ route('entries.create', ['project' => $project->id]) }}" class="btn btn-success mb-3">
                    Tambah Entry Aktivitas
                </a>

                <a href="{{ route('projects.entries.create', $project->id) }}" class="btn btn-primary">+ Tambah Entry</a>

                <h4>Entries</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Kode Entry</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Dibuat Oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($entries as $entry)
                            <tr>
                                <td>{{ $entry->entry_key }}</td>
                                <td>{{ $entry->category->category_main }} - {{ $entry->category->category_sub }}</td>
                                <td>{{ Str::limit($entry->entry_description, 50) }}</td>
                                <td>{{ $entry->entry_date }}</td>
                                <td>{{ $entry->createdBy->name ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('entries.show', $entry->id) }}"
                                        class="btn btn-sm btn-info">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada entries di project ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
