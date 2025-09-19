@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Permintaan Join Project</h1>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                @forelse($requests as $req)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <div>
                            <strong>{{ $req->user->name }}</strong> ({{ $req->user->email }})
                            <br>
                            <small>Diajukan pada {{ $req->created_at->format('d M Y H:i') }}</small>
                        </div>
                        <div>
                            <form action="{{ route('projects.approveRequest', [$project, $req]) }}" method="POST"
                                class="d-inline">
                                @csrf
                                <select name="role_in_project" class="form-select form-select-sm d-inline w-auto">
                                    <option value="member">Member</option>
                                    <option value="supervisor">Supervisor</option>
                                </select>
                                <button class="btn btn-success btn-sm">Approve</button>
                            </form>

                            <form action="{{ route('projects.rejectRequest', [$project, $req]) }}" method="POST"
                                class="d-inline">
                                @csrf
                                <button class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">Tidak ada permintaan join saat ini.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
