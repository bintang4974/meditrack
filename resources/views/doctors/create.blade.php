@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
    </div>

    <section class="section">

        {{-- Error Handler --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('doctors.store', $project->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama Dokter</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option value="doctor" {{ old('role') == 'doctor' ? 'selected' : '' }}>Doctor</option>
                    <option value="supervisor" {{ old('role') == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Spesialisasi</label>
                <input type="text" name="specialty" class="form-control" value="{{ old('specialty') }}">
            </div>

            <div class="mb-3">
                <label>Notes</label>
                <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
            </div>

            <div class="mb-3">
                <label>Pilih Rumah Sakit</label>
                <div class="row">
                    @forelse ($sites as $site)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" name="sites[]" value="{{ $site->id }}" class="form-check-input"
                                    id="site_{{ $site->id }}">
                                <label class="form-check-label" for="site_{{ $site->id }}">{{ $site->name }}</label>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-warning">
                            Belum ada rumah sakit di project ini. Silakan tambah rumah sakit terlebih dahulu.
                        </div>
                    @endforelse
                </div>
                <small class="text-muted">Pilih satu atau lebih rumah sakit</small>
            </div>

            <button type="submit" class="btn btn-success" {{ $sites->isEmpty() ? 'disabled' : '' }}>
                Simpan
            </button>
        </form>
    </section>
@endsection
