@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <form class="row g-3" action="{{ route('patients.update', [$project->id, $site->id, $patient->id]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')

                    <div class="col-12">
                        <label>No. Rekam Medis</label>
                        <input type="text" name="rekam_medis" value="{{ old('rekam_medis', $patient->rekam_medis) }}"
                            class="form-control">
                    </div>
                    <div class="col-12">
                        <label>Nama</label>
                        <input type="text" name="name" value="{{ old('name', $patient->name) }}" class="form-control">
                    </div>
                    <div class="col-12">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="dob" value="{{ old('dob', $patient->dob) }}" class="form-control">
                    </div>
                    <div class="col-12">
                        <label>Umur</label>
                        <input type="number" name="age" value="{{ old('age', $patient->age) }}" class="form-control">
                    </div>
                    <div class="col-12">
                        <label>No. Telepon</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', $patient->phone_number) }}"
                            class="form-control">
                    </div>
                    <div class="col-12">
                        <label>Alamat</label>
                        <textarea name="address" class="form-control">{{ old('address', $patient->address) }}</textarea>
                    </div>
                    <div class="col-12">
                        <label>Working Assessment</label>
                        <textarea name="working_assessment" class="form-control">{{ old('working_assessment', $patient->working_assessment) }}</textarea>
                    </div>
                    <div class="col-12">
                        <label>Context Summary</label>
                        <textarea name="context_summary" class="form-control">{{ old('context_summary', $patient->context_summary) }}</textarea>
                    </div>

                    <div class="col-12">
                        <label>Tags</label>
                        <div class="row">
                            @foreach ($tags as $tag)
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                            class="form-check-input"
                                            {{ in_array($tag->id, $selectedTags) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $tag->name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('patients.show', [$project->id, $site->id, $patient->id]) }}"
                            class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
