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
            <div class="col-lg-3 col-6">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Projects</h5>
                        <h6>{{ $stats['projects'] }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Sites</h5>
                        <h6>{{ $stats['sites'] }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Doctors</h5>
                        <h6>{{ $stats['doctors'] }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Patients</h5>
                        <h6>{{ $stats['patients'] }}</h6>
                    </div>
                </div>
            </div>

            {{-- Chart Entries by Category --}}
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Entries per Category</h5>
                        <canvas id="entriesCategoryChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Chart Entries by Month --}}
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Entries per Month</h5>
                        <canvas id="entriesMonthChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Recent Entries --}}
            <div class="col-lg-12">
                <div class="card recent-sales">
                    <div class="card-body">
                        <h5 class="card-title">Recent Entries</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal</th>
                                    <th>Dibuat Oleh</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentEntries as $e)
                                    <tr>
                                        <td>{{ $e->entry_key }}</td>
                                        <td>{{ $e->category->category_main ?? '-' }}</td>
                                        <td>{{ Str::limit($e->entry_description, 50) }}</td>
                                        <td>{{ $e->entry_date }}</td>
                                        <td>{{ $e->createdBy->name ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart by Category
        new Chart(document.getElementById('entriesCategoryChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($entriesByCategory->keys()) !!},
                datasets: [{
                    data: {!! json_encode($entriesByCategory->values()) !!},
                    backgroundColor: ['#36a2eb', '#ff6384', '#ffce56', '#4bc0c0']
                }]
            }
        });

        // Chart by Month
        new Chart(document.getElementById('entriesMonthChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode($entriesByMonth->keys()) !!},
                datasets: [{
                    label: 'Entries',
                    data: {!! json_encode($entriesByMonth->values()) !!},
                    borderColor: '#36a2eb',
                    fill: false
                }]
            }
        });
    </script>
@endpush
