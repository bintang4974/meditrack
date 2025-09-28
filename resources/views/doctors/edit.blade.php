@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
    </div>

    <section class="section">
        <form action="{{ route('doctors.update', [$project->id, $doctor->id]) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="mb-3">
                <label>Nama Dokter</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $doctor->name) }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $doctor->email) }}"
                    required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Role --}}
            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option value="doctor" {{ $doctor->role == 'doctor' ? 'selected' : '' }}>Doctor</option>
                    <option value="supervisor" {{ $doctor->role == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                </select>
            </div>

            {{-- Spesialisasi --}}
            <div class="mb-3">
                <label>Spesialisasi</label>
                <input type="text" name="specialty" class="form-control"
                    value="{{ old('specialty', $doctor->specialty) }}">
            </div>

            {{-- Notes --}}
            <div class="mb-3">
                <label>Notes</label>
                <textarea name="notes" class="form-control">{{ old('notes', $doctor->notes) }}</textarea>
            </div>

            {{-- Status Dokter --}}
            <div class="mb-3">
                <label>Status Dokter</label>
                <select name="status" class="form-control">
                    <option value="active" {{ $doctor->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $doctor->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            {{-- Rumah Sakit --}}
            <div class="mb-3">
                <label>Pilih Rumah Sakit</label>
                <div class="row">
                    @forelse ($sites as $site)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" name="sites[]" value="{{ $site->id }}" class="form-check-input"
                                    id="site_{{ $site->id }}"
                                    {{ isset($doctorSiteStatuses[$site->id]) && $doctorSiteStatuses[$site->id] == 'active' ? 'checked' : '' }}>
                                <label class="form-check-label" for="site_{{ $site->id }}">{{ $site->name }}</label>
                            </div>
                        </div>
                    @empty
                        <p class="text-danger">Belum ada rumah sakit pada project ini.</p>
                    @endforelse
                </div>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </section>
@endsection
