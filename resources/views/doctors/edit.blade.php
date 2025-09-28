@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Edit Dokter</h1>
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

        <form action="{{ route('doctors.update', [$project->id, $doctor->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Dokter</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $doctor->name) }}" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $doctor->email) }}"
                    required>
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option value="doctor" {{ $doctor->role == 'doctor' ? 'selected' : '' }}>Doctor</option>
                    <option value="supervisor" {{ $doctor->role == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Spesialisasi</label>
                <input type="text" name="specialty" class="form-control"
                    value="{{ old('specialty', $doctor->specialty) }}">
            </div>

            <div class="mb-3">
                <label>Notes</label>
                <textarea name="notes" class="form-control">{{ old('notes', $doctor->notes) }}</textarea>
            </div>

            <div class="mb-3">
                <label>Pilih Rumah Sakit</label>
                <div class="row">
                    @foreach ($sites as $site)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" name="sites[]" value="{{ $site->id }}" class="form-check-input"
                                    id="site_{{ $site->id }}"
                                    {{ $doctor->sites->contains($site->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="site_{{ $site->id }}">{{ $site->name }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </section>
@endsection
