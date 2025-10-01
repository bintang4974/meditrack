@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
    </div>

    <section class="section">
        <a href="{{ route('doctors.create', $project->id) }}" class="btn btn-primary mb-3">+ Tambah Dokter</a>

        <div class="card">
            <div class="card-body">
                <div class="card-title">Dokter</div>

                <table class="table datatable table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Spesialisasi</th>
                            <th>Status</th>
                            <th>Rumah Sakit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($doctors as $doctor)
                            <tr>
                                <td>{{ $doctor->name }}</td>
                                <td>{{ $doctor->email }}</td>
                                <td>{{ ucfirst($doctor->role) }}</td>
                                <td>{{ $doctor->specialty ?? '-' }}</td>
                                <td>
                                    <span class="badge {{ $doctor->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $doctor->status }}
                                    </span>
                                </td>
                                <td>
                                    @foreach ($doctor->sites as $site)
                                        <span class="badge bg-info">{{ $site->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('doctors.edit', [$project->id, $doctor->id]) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('doctors.destroy', [$project->id, $doctor->id]) }}"
                                        method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada dokter</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
