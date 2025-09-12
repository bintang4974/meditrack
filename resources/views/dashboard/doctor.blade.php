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

        {{-- Stat Cards --}}
        <div class="col-lg-4 col-6">
            <div class="card info-card">
                <div class="card-body">
                    <h5 class="card-title">Projects</h5>
                    <h6>{{ $stats['projects'] }}</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="card info-card">
                <div class="card-body">
                    <h5 class="card-title">Patients</h5>
                    <h6>{{ $stats['patients'] }}</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="card info-card">
                <div class="card-body">
                    <h5 class="card-title">My Entries</h5>
                    <h6>{{ $stats['entries'] }}</h6>
                </div>
            </div>
        </div>

        {{-- Recent Entries --}}
        <div class="col-lg-6">
            <div class="card recent-sales">
                <div class="card-body">
                    <h5 class="card-title">My Recent Entries</h5>
                    <ul class="list-group">
                        @forelse($entries as $e)
                            <li class="list-group-item">
                                {{ $e->entry_key }} - {{ $e->category->category_main ?? '-' }} 
                                <small class="text-muted">({{ $e->entry_date }})</small>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Belum ada entry</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        {{-- Upcoming Schedule --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Upcoming Scheduled Operations</h5>
                    <ul class="list-group">
                        @forelse($upcoming as $e)
                            <li class="list-group-item">
                                {{ $e->patient->name ?? 'Pasien' }} - {{ $e->waitlist_scheduled_date }}
                                <small class="text-muted">({{ $e->category->category_sub ?? '-' }})</small>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Tidak ada jadwal</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

    </div>
    </section>
@endsection

