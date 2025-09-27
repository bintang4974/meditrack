@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
    </div>

    <section class="section">
        <form action="{{ route('doctors.update', [$project->id, $doctor->id]) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label>Nama Dokter</label>
                <input type="text" name="name" class="form-control" value="{{ $doctor->name }}" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $doctor->email }}" required>
            </div>
            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option value="doctor" @selected($doctor->role == 'doctor')>Doctor</option>
                    <option value="supervisor" @selected($doctor->role == 'supervisor')>Supervisor</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Spesialisasi</label>
                <input type="text" name="specialty" class="form-control" value="{{ $doctor->specialty }}">
            </div>
            <div class="mb-3">
                <label>Notes</label>
                <textarea name="notes" class="form-control">{{ $doctor->notes }}</textarea>
            </div>
            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="active" @selected($doctor->status == 'active')>Active</option>
                    <option value="inactive" @selected($doctor->status == 'inactive')>Inactive</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Rumah Sakit</label>
                <select name="sites[]" class="form-control" multiple required>
                    @foreach ($sites as $site)
                        <option value="{{ $site->id }}" @selected($doctor->sites->contains($site->id))>
                            {{ $site->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </section>
@endsection
