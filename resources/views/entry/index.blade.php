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

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Datatables</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
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
                                        <td>{{ $entry->category->category_main }} - {{ $entry->category->category_sub }}
                                        </td>
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
                                        <td colspan="6" class="text-center">Belum ada entries.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
