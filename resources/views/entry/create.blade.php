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
                <h3>Tambah Entry Aktivitas</h3>
                <form action="{{ route('entries.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Kategori</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->category_id }}">{{ $cat->category_main }} - {{ $cat->category_sub }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="entry_description" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Tanggal</label>
                        <input type="date" name="entry_date" class="form-control" required>
                    </div>
                    <button class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </section>
@endsection
