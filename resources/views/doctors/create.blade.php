@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
    </div>

    <section class="section">
        <form action="{{ route('doctors.store', $project->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nama Dokter</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option value="doctor">Doctor</option>
                    <option value="supervisor">Supervisor</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Spesialisasi</label>
                <input type="text" name="specialty" class="form-control">
            </div>
            <div class="mb-3">
                <label>Notes</label>
                <textarea name="notes" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label>Rumah Sakit</label>
                <select name="sites[]" class="form-control" multiple required>
                    @foreach ($sites as $site)
                        <option value="{{ $site->id }}">{{ $site->name }}</option>
                    @endforeach
                </select>
                <small>Pilih satu atau lebih rumah sakit</small>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </section>
@endsection
